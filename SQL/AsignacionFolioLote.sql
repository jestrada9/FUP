/* =====================================================================
   *** OPCIONAL - NO HACE FALTA EJECUTARLO ***

   El web service ya trae este mismo T-SQL embebido en BDSQL.cs
   (método SqlDelLote), precisamente para no depender de crear objetos
   nuevos en la base. Con el servicio publicado, la foliación en lote
   funciona SIN correr este archivo.

   Guárdalo para cuando tengas permisos de DDL: como procedimiento
   compilado rinde un poco mejor (plan reutilizado, no se re-arma el
   batch en cada llamada) y deja de haber límite de 400 documentos por
   bloque. Al instalarlo, cambia en BDSQL.cs la llamada de SqlDelLote
   por el procedimiento con TVP.
   =====================================================================

   AsignacionFolioLote
   Folía N documentos en UNA sola transacción.

   Sustituye a llamar AsignacionFolio N veces: pasa de N transacciones
   (cada una peleándose por la fila contador numdocto/area=1001) a una
   sola reserva en bloque. Es lo que elimina la contención.

   Requiere el tipo dbo.FolioLoteTipo que se crea aquí mismo.

   Resultado (un renglón por documento):
     reng | num_docto_original | num_docto_nuevo | estado | mensaje
     estado = FOLIADO | YA_FOLIADO | ERROR
   ===================================================================== */

USE mpsege;
GO

/* ---------------------------------------------------------------------
   1) Tipo tabla que recibe el lote
   --------------------------------------------------------------------- */
IF TYPE_ID('dbo.FolioLoteTipo') IS NULL
BEGIN
    CREATE TYPE dbo.FolioLoteTipo AS TABLE
    (
        reng       INT,
        area       INT,
        num_docto  BIGINT,
        num_oficio BIGINT
    );
END
GO


/* ---------------------------------------------------------------------
   2) Procedimiento de lote
   --------------------------------------------------------------------- */
IF OBJECT_ID('dbo.AsignacionFolioLote', 'P') IS NOT NULL
    DROP PROCEDURE dbo.AsignacionFolioLote;
GO

CREATE PROCEDURE dbo.AsignacionFolioLote
    @docs    dbo.FolioLoteTipo READONLY,
    @usuario VARCHAR(50)
AS
BEGIN
    SET NOCOUNT ON;
    SET XACT_ABORT ON;

    DECLARE @omdm  BIGINT = 1000000,
            @wqp   INT,
            @waaqq BIGINT,
            @N     INT,
            @base  BIGINT;

    /* Tabla de resultado. Al ser variable de tabla NO se revierte con el
       ROLLBACK, así que podemos reportar qué pasó aunque falle todo. */
    DECLARE @res TABLE
    (
        reng               INT PRIMARY KEY,
        num_docto_original BIGINT,
        num_docto_nuevo    BIGINT      NULL,
        estado             VARCHAR(20),
        mensaje            VARCHAR(300)
    );

    /* --- 2.1 Clasificación inicial ---------------------------------- */
    INSERT INTO @res (reng, num_docto_original, num_docto_nuevo, estado, mensaje)
    SELECT d.reng,
           d.num_docto,
           NULL,
           CASE WHEN d.num_docto % 1000000 <> 1 THEN 'YA_FOLIADO' ELSE 'PENDIENTE' END,
           CASE WHEN d.num_docto % 1000000 <> 1
                THEN 'No termina en 000001; se conserva el número actual.'
                ELSE '' END
    FROM @docs d;

    /* --- 2.2 Descartar los que no tienen exactamente una fila -------- */
    UPDATE r
       SET estado  = 'ERROR',
           mensaje = 'No existe, ya tiene folio, o hay más de una fila con esa clave.'
    FROM @res r
    JOIN @docs d ON d.reng = r.reng
    CROSS APPLY (SELECT COUNT(*) AS c
                   FROM mpsege..rel_doctos t
                  WHERE t.area       = d.area
                    AND t.num_docto  = d.num_docto
                    AND t.num_oficio = d.num_oficio) x
    WHERE r.estado = 'PENDIENTE'
      AND x.c <> 1;

    SELECT @N = COUNT(*) FROM @res WHERE estado = 'PENDIENTE';

    /* --- 2.3 Nada que foliar ---------------------------------------- */
    IF @N = 0
    BEGIN
        UPDATE @res SET num_docto_nuevo = num_docto_original WHERE estado = 'YA_FOLIADO';
        SELECT reng, num_docto_original, num_docto_nuevo, estado, mensaje
          FROM @res ORDER BY reng;
        RETURN;
    END

    /* --- 2.4 Quincena en proceso (fuera de la transacción) ----------- */
    SELECT TOP (1) @wqp = qna_proc FROM mpsege..ctrlqnaproc;

    IF @wqp IS NULL
    BEGIN
        UPDATE @res
           SET estado = 'ERROR', mensaje = 'No se pudo obtener qna_proc de ctrlqnaproc.'
         WHERE estado = 'PENDIENTE';
        UPDATE @res SET num_docto_nuevo = num_docto_original WHERE estado = 'YA_FOLIADO';
        SELECT reng, num_docto_original, num_docto_nuevo, estado, mensaje
          FROM @res ORDER BY reng;
        RETURN;
    END

    SET @waaqq = @wqp % 200000;

    BEGIN TRY
        BEGIN TRANSACTION;

            /* --- 2.5 Reserva del bloque completo: UNA sentencia ------
               Se piden los N consecutivos de un jalón. deleted.num_docto
               es el valor ANTERIOR, o sea la base del bloque.          */
            DECLARE @o TABLE (anterior BIGINT);

            UPDATE mpsege..numdocto WITH (ROWLOCK)
               SET num_docto = num_docto + @N,
                   autoriza  = 1
            OUTPUT deleted.num_docto INTO @o (anterior)
             WHERE area = 1001;

            SELECT @base = anterior FROM @o;

            IF @base IS NULL
                THROW 50004, 'No existe el contador numdocto para area=1001.', 1;

            /* --- 2.6 Repartir los folios del bloque ------------------ */
            ;WITH pend AS
            (
                SELECT reng, ROW_NUMBER() OVER (ORDER BY reng) AS rn
                  FROM @res
                 WHERE estado = 'PENDIENTE'
            )
            UPDATE r
               SET num_docto_nuevo = (@waaqq * @omdm) + @base + p.rn
            FROM @res r
            JOIN pend p ON p.reng = r.reng;

            /* --- 2.7 Aplicar a rel_doctos --------------------------- */
            UPDATE t
               SET t.num_docto   = r.num_docto_nuevo,
                   t.estatus     = 2,
                   t.fec_captura = GETDATE()
            FROM mpsege..rel_doctos t
            JOIN @docs d ON d.area       = t.area
                        AND d.num_docto  = t.num_docto
                        AND d.num_oficio = t.num_oficio
            JOIN @res  r ON r.reng = d.reng
            WHERE r.estado = 'PENDIENTE';

            IF @@ROWCOUNT <> @N
                THROW 50005, 'El número de documentos actualizados no coincide con el lote.', 1;

            /* --- 2.8 Bitácora, ya con el folio definitivo ------------ */
            INSERT INTO mpsege..bit_captura
                  (area, num_docto, num_doctoalt, num_oficio, usuario, fecha,
                   operacion, datoalt, tipo, dato, campo)
            SELECT d.area,
                   r.num_docto_nuevo,
                   r.num_docto_nuevo,
                   d.num_oficio,
                   @usuario,
                   GETDATE(),
                   'Asig.Folio',
                   r.num_docto_original,
                   '', '', ''
              FROM @res r
              JOIN @docs d ON d.reng = r.reng
             WHERE r.estado = 'PENDIENTE';

        COMMIT TRANSACTION;

        UPDATE @res SET estado = 'FOLIADO' WHERE estado = 'PENDIENTE';

    END TRY
    BEGIN CATCH

        IF XACT_STATE() <> 0
            ROLLBACK TRANSACTION;

        /* Se revirtió todo el lote: ningún documento quedó foliado. */
        UPDATE @res
           SET estado          = 'ERROR',
               num_docto_nuevo = NULL,
               mensaje         = LEFT('Error ' + CONVERT(VARCHAR(20), ERROR_NUMBER())
                                      + ': ' + ERROR_MESSAGE(), 300)
         WHERE estado = 'PENDIENTE';

    END CATCH

    UPDATE @res SET num_docto_nuevo = num_docto_original WHERE estado = 'YA_FOLIADO';

    SELECT reng, num_docto_original, num_docto_nuevo, estado, mensaje
      FROM @res
     ORDER BY reng;
END
GO


/* =====================================================================
   PERMISOS: el usuario del web service necesita EXECUTE sobre el tipo.
   Ajusta el nombre del login si es distinto.
   ===================================================================== */
-- GRANT EXECUTE ON TYPE::dbo.FolioLoteTipo TO invent1;
-- GRANT EXECUTE ON dbo.AsignacionFolioLote TO invent1;
GO


/* =====================================================================
   PRUEBA
   ===================================================================== */
/*
DECLARE @t dbo.FolioLoteTipo;
INSERT INTO @t (reng, area, num_docto, num_oficio) VALUES
    (1, 2310, 1812004721, 1231004721),
    (2, 2313, 2418318864, 1231300412);

EXEC dbo.AsignacionFolioLote @docs = @t, @usuario = 'JEAD3';
*/
