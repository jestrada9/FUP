/* =====================================================================
   Consulta 1318 - "Autorizo CT Ori"
   Para cuando tengas acceso a editar el texto de la consulta.

   TEXTO ACTUAL
   ---------------------------------------------------------------------
     BEGIN TRANSACTION;
     insert into mpsege..bit_captura (area,num_docto,num_doctoalt,num_oficio,
            usuario,fecha,operacion,datoalt,tipo,dato,campo)
     values (@area@,@num_docto@,@num_docto@,@num_oficio@,'@usuario@',
             GETDATE(),'@operacion@','@datoalt@','','','');
     UPDATE pmp.dbo.FUPId SET idAutorizar = 1
      WHERE idnum_docto in ('@num_docto@');
     COMMIT;

   DOS PROBLEMAS
   ---------------------------------------------------------------------
   1. BEGIN TRANSACTION sin TRY/CATCH y sin XACT_ABORT. Si el UPDATE
      falla, o el cliente corta por timeout, la transacción queda ABIERTA
      reteniendo locks sobre bit_captura y FUPId. Es la misma causa que
      tenía AsignacionFolio antes de corregirlo.

   2. @num_docto@ se usa de dos formas incompatibles: como escalar en el
      INSERT y como lista dentro de IN (...). Por eso no se puede mandar
      una lista sin romper el INSERT, y por eso $cadena4 del PHP quedó
      muerto.

   Además, un lote real necesita area y num_oficio POR DOCUMENTO, no un
   solo valor para todos: por eso no basta con separar num_docto por
   comas.
   ===================================================================== */


/* =====================================================================
   OPCIÓN A - mínima. Un documento por llamada, como hoy, pero sin dejar
   transacciones abiertas. Es la que recomiendo aplicar primero: no
   cambia el contrato, el PHP actual sigue funcionando igual.
   ===================================================================== */

SET XACT_ABORT ON;

BEGIN TRY
    BEGIN TRANSACTION;

        INSERT INTO mpsege..bit_captura
              (area, num_docto, num_doctoalt, num_oficio, usuario, fecha,
               operacion, datoalt, tipo, dato, campo)
        VALUES (@area@, @num_docto@, @num_docto@, @num_oficio@, '@usuario@',
                GETDATE(), '@operacion@', '@datoalt@', '', '', '');

        UPDATE pmp.dbo.FUPId
           SET idAutorizar = 1
         WHERE idnum_docto = '@num_docto@';

        /* Avisar si el documento no existía en FUPId: hoy eso pasa
           inadvertido, con COMMIT limpio y cero filas afectadas. */
        IF @@ROWCOUNT = 0
            THROW 50010, 'El num_docto no existe en pmp.dbo.FUPId.', 1;

    COMMIT TRANSACTION;
END TRY
BEGIN CATCH
    IF XACT_STATE() <> 0
        ROLLBACK TRANSACTION;
    THROW;
END CATCH


/* =====================================================================
   OPCIÓN B - lote de verdad. Requiere SQL Server 2016+ con nivel de
   compatibilidad 130 o mayor (por OPENJSON). Verificar antes con:

       SELECT compatibility_level FROM sys.databases WHERE name = 'mpsege';

   El parámetro @num_docto@ pasa a recibir un JSON con la lista completa:

       [{"area":2310,"num_docto":1812004721,"num_oficio":1231004721}, ...]

   Con esto, autorizar 100 documentos es UNA llamada y UNA transacción.
   Si se aplica, avísame para cambiar el PHP: es quitar el foreach y
   mandar el arreglo completo.
   ===================================================================== */

/*
SET XACT_ABORT ON;

DECLARE @json NVARCHAR(MAX) = N'@num_docto@';

BEGIN TRY
    BEGIN TRANSACTION;

        INSERT INTO mpsege..bit_captura
              (area, num_docto, num_doctoalt, num_oficio, usuario, fecha,
               operacion, datoalt, tipo, dato, campo)
        SELECT j.area, j.num_docto, j.num_docto, j.num_oficio, '@usuario@',
               GETDATE(), '@operacion@', '@datoalt@', '', '', ''
          FROM OPENJSON(@json)
               WITH (area INT, num_docto BIGINT, num_oficio BIGINT) j;

        UPDATE f
           SET f.idAutorizar = 1
          FROM pmp.dbo.FUPId f
          JOIN OPENJSON(@json) WITH (num_docto BIGINT) j
            ON j.num_docto = f.idnum_docto;

    COMMIT TRANSACTION;
END TRY
BEGIN CATCH
    IF XACT_STATE() <> 0
        ROLLBACK TRANSACTION;
    THROW;
END CATCH
*/


/* =====================================================================
   NOTA DE SEGURIDAD
   Los valores se sustituyen por texto ('@usuario@' entre comillas), así
   que un dato con apóstrofo rompe la consulta y abre la puerta a
   inyección. No es algo que se arregle en este archivo: requiere que el
   servicio de consultas use parámetros en vez de reemplazo de cadenas.
   ===================================================================== */
