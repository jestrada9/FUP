<?php
/* =====================================================================
   Foliacion_Lote.php
   Folía uno o varios FUP en UNA sola llamada al web service.

   Usa el método nuevo getFolioLote, que del lado de SQL Server reserva
   los N folios consecutivos en una sola transacción
   (dbo.AsignacionFolioLote). Antes era una llamada SOAP y una
   transacción por documento.

   NO reemplaza a CreacionFUPOriginal_CT_Editar.php: sólo folía y
   devuelve el resultado; la generación del PDF sigue donde ya está.

   ---------------------------------------------------------------------
   ENTRADA (POST)
     documentos : base64( JSON )
                  [ {"area":"2310","num_docto":"1812004721",
                     "num_oficio":"1231004721"}, ... ]
     usu        : usuario

   SALIDA: JSON
     { "total":3, "foliados":2, "omitidos":1, "errores":0, "mensaje":"",
       "detalle":[ {"reng":1,"num_docto":"...","folio":"2418000123",
                    "estado":"FOLIADO","mensaje":""}, ... ] }

     estado = FOLIADO | YA_FOLIADO | ERROR
   ===================================================================== */

ini_set("soap.wsdl_cache_enabled", "0");
ini_set('default_socket_timeout', 300);
set_time_limit(0);
ignore_user_abort(true);

require_once('../../Conexion/wsdl_foliacion.php');   // $cliente2

header('Content-Type: application/json; charset=utf-8');


function fup_responder($arr)
{
    echo json_encode($arr);
    exit;
}


/* --------------------------- Entrada ------------------------------- */

$usuario = isset($_POST['usu']) ? trim($_POST['usu']) : '';
$crudo   = isset($_POST['documentos']) ? base64_decode($_POST['documentos'], true) : false;

if ($crudo === false) {
    fup_responder(array(
        'total' => 0, 'foliados' => 0, 'omitidos' => 0, 'errores' => 0,
        'mensaje' => 'Parámetro documentos ausente o mal codificado.',
        'detalle' => array()
    ));
}

$documentos = json_decode($crudo, true);

if (!is_array($documentos) || count($documentos) === 0) {
    fup_responder(array(
        'total' => 0, 'foliados' => 0, 'omitidos' => 0, 'errores' => 0,
        'mensaje' => 'No se recibieron documentos.',
        'detalle' => array()
    ));
}


/* --------- Normalizar: sólo las llaves que el servicio espera ------- */

$limpios = array();
foreach ($documentos as $d) {
    $limpios[] = array(
        'area'       => isset($d['area'])       ? (string)$d['area']       : '',
        'num_docto'  => isset($d['num_docto'])  ? (string)$d['num_docto']  : '',
        'num_oficio' => isset($d['num_oficio']) ? (string)$d['num_oficio'] : ''
    );
}

/* El JSON se arma con json_encode, no concatenando comillas escapadas */
$payload = json_encode(array(
    'usuario'    => $usuario,
    'documentos' => $limpios
));


/* ------------------------ Llamada única ---------------------------- */

try {

    $r = $cliente2->getFolioLote(array('Argumento' => $payload));
    $r = json_decode(json_encode($r), true);

    $texto = isset($r['getFolioLoteResult']) ? $r['getFolioLoteResult'] : '';

    if ($texto === '' || $texto === null) {
        fup_responder(array(
            'total' => count($limpios), 'foliados' => 0, 'omitidos' => 0,
            'errores' => count($limpios),
            'mensaje' => 'El web service de foliación no devolvió respuesta.',
            'detalle' => array()
        ));
    }

    $salida = json_decode($texto, true);

    if (!is_array($salida)) {
        fup_responder(array(
            'total' => count($limpios), 'foliados' => 0, 'omitidos' => 0,
            'errores' => count($limpios),
            'mensaje' => 'Respuesta no interpretable del servicio: ' . substr($texto, 0, 200),
            'detalle' => array()
        ));
    }

    fup_responder($salida);

} catch (SoapFault $e) {

    /* El SoapClient se crea con 'exceptions' => true: sin este catch un
       fault revienta el script a media transacción. */
    fup_responder(array(
        'total' => count($limpios), 'foliados' => 0, 'omitidos' => 0,
        'errores' => count($limpios),
        'mensaje' => 'SOAP: ' . $e->getMessage(),
        'detalle' => array()
    ));

} catch (Exception $e) {

    fup_responder(array(
        'total' => count($limpios), 'foliados' => 0, 'omitidos' => 0,
        'errores' => count($limpios),
        'mensaje' => $e->getMessage(),
        'detalle' => array()
    ));
}
