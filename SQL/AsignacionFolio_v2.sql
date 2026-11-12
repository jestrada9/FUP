/* =====================================================================
   AsignacionFolio - versión mínima-invasiva (anti-bloqueos)
   Módulo: FUP Cambio CT  (index.php#auto_crearfup_ct_)

   MISMAS CONSULTAS, MISMO ORDEN Y MISMA LÓGICA que el original.
   Lo único que cambia es el manejo de transacción/errores:

   1. SET XACT_ABORT ON  -> si el cliente cancela por timeout, SQL aborta
      la transacción y libera los locks. Sin esto la transacción queda
      abierta bloqueando a todos.
   2. SET NOCOUNT ON     -> evita mensajes de conteo innecesarios.
   3. CATCH: valida XACT_STATE() antes del ROLLBACK (el ROLLBACK a secas
      puede fallar con error 3903 y dejar la transacción abierta) y hace
      THROW para que el error llegue a la aplicación en vez de tragarse
      con PRINT.
   4. Si algo falla, @rnum_docto@ regresa NULL (antes podía regresar un
      folio que en realidad nunca se guardó).

   Las mejoras de rendimiento (quitar el UPDATE hardcodeado y el
   LIKE '%000001') quedan comentadas al final, NO aplicadas.
   ===================================================================== */

ALTER PROCEDURE [dbo].[AsignacionFolio]
    @area@       INT,
    @num_docto@  BIGINT,
    @num_oficio@ BIGINT,
    @usuario@    VARCHAR(50),
    @rnum_docto@ BIGINT OUTPUT
AS

SET NOCOUNT ON;
SET XACT_ABORT ON;

DECLARE @wqp INT;
DECLARE @omdm INT; SET @omdm = 1000000;
DECLARE @waaqq BIGINT;
DECLARE @num_doctoR BIGINT;
DECLARE @wnum_docto BIGINT;

BEGIN
    SET @rnum_docto@ = NULL;

    BEGIN TRY
        BEGIN TRANSACTION;

            update rel_doctos set fec_captura=getdate() where area=2310 and num_docto=1812004721 and num_oficio=1231004721 and estatus=6

            update mpsege..numdocto set autoriza = case when autoriza='false' then 'true' else 'false' end where area=1001;

            Select @wqp=qna_proc from mpsege..ctrlqnaproc;

            select @num_doctoR=num_docto from mpsege..numdocto where area=1001;

            SET @waaqq = (@wqp % 200000)
            SET @wnum_docto = (@waaqq * @omdm) + @num_doctoR + 1;

            update mpsege..rel_doctos set num_docto=@wnum_docto , estatus=2 where area=@area@ and num_docto=@num_docto@ and num_oficio=@num_oficio@ and num_docto like '%000001';

            update mpsege..numdocto set num_docto = num_docto +  1, autoriza = 1 where area=1001;

            insert into mpsege..bit_captura (area,num_docto,num_doctoalt,num_oficio,usuario,fecha,operacion,datoalt,tipo,dato,campo) values (@area@,@num_docto@,@num_docto@,@num_oficio@,@usuario@,GETDATE(),'Asig.Folio',@num_docto@,'','','');

            update mpsege..bit_captura set num_docto = @wnum_docto,num_doctoalt = @wnum_docto where area=@area@ and num_docto=@num_docto@ and num_oficio=@num_oficio@ and num_docto like '%000001';

        COMMIT TRANSACTION;

        SET @rnum_docto@ = @wnum_docto;   -- sólo se devuelve si el COMMIT ocurrió
    END TRY
    BEGIN CATCH
        IF XACT_STATE() <> 0
            ROLLBACK TRANSACTION;

        SET @rnum_docto@ = NULL;

        THROW;   -- el error debe llegar al cliente (antes: PRINT 'error')
    END CATCH;

    RETURN;
END
GO


/* =====================================================================
   MEJORAS OPCIONALES (NO aplicadas). Si algún día se puede tocar la
   lógica, éstas son las que más reducen los bloqueos:

   a) Borrar el UPDATE con valores fijos:
        update rel_doctos set fec_captura=getdate()
        where area=2310 and num_docto=1812004721 ...
      Se ejecuta en CADA llamada sobre la misma fila -> todas las
      sesiones se serializan ahí.

   b) Sustituir  num_docto like '%000001'  (columna BIGINT -> conversión
      implícita -> scan completo + escalamiento a lock de tabla) por:
        and num_docto % 1000000 = 1
      o mejor, validar el parámetro antes de entrar a la transacción:
        IF (@num_docto@ % 1000000) <> 1 ... salir

   c) Mover  Select @wqp=qna_proc from mpsege..ctrlqnaproc  ANTES del
      BEGIN TRANSACTION.

   d) Reservar el consecutivo en una sola sentencia atómica al final,
      en vez del toggle de 'autoriza' al inicio (que bloquea la fila
      contador durante toda la transacción):
        UPDATE mpsege..numdocto SET num_docto = num_docto + 1, autoriza = 1
        OUTPUT inserted.num_docto INTO @folio WHERE area = 1001;

   e) Índices:
      CREATE UNIQUE INDEX IX_rel_doctos_area_docto_oficio
          ON mpsege..rel_doctos (area, num_docto, num_oficio) INCLUDE (estatus);
      CREATE INDEX IX_bit_captura_area_docto_oficio
          ON mpsege..bit_captura (area, num_docto, num_oficio);
   ===================================================================== */


/* =====================================================================
   DIAGNÓSTICO: sesiones DORMIDAS con transacción abierta (las que traban)
   ===================================================================== */
/*
SELECT  s.session_id,
        s.status,                       -- 'sleeping' + tran abierta = fuga
        s.login_name, s.host_name, s.program_name,
        s.last_request_end_time,
        DATEDIFF(SECOND, tat.transaction_begin_time, GETDATE()) AS seg_abierta,
        r.blocking_session_id,
        t.text AS ultimo_sql
FROM    sys.dm_tran_session_transactions st
JOIN    sys.dm_tran_active_transactions  tat ON tat.transaction_id = st.transaction_id
JOIN    sys.dm_exec_sessions             s   ON s.session_id = st.session_id
LEFT JOIN sys.dm_exec_requests           r   ON r.session_id = s.session_id
OUTER APPLY sys.dm_exec_sql_text(r.sql_handle) t
WHERE   s.is_user_process = 1
ORDER BY seg_abierta DESC;

-- Cadena de bloqueos actual:
SELECT r.session_id, r.blocking_session_id, r.wait_type, r.wait_time,
       r.wait_resource, t.text
FROM   sys.dm_exec_requests r
OUTER APPLY sys.dm_exec_sql_text(r.sql_handle) t
WHERE  r.blocking_session_id <> 0;

-- Matar la sesión colgada (último recurso):  KILL <session_id>;
*/
