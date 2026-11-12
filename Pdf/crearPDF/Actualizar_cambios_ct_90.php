<?php
ini_set("soap.wsdl_cache_enabled", "0");

require_once('../../Conexion/wsdl.php'); 	

$usuario = $_POST['usu'];
$arrayCosas0 = base64_decode($_POST['num_docto']);

$arrays = json_decode($arrayCosas0, true);

// Verificar que se recibieron datos
if(empty($arrays) || !isset($arrays['newarrays'])) {
    echo "Error: No se recibieron datos válidos";
    exit;
}

$newarrays = $arrays['newarrays'];
$total = isset($newarrays[0]['totals']) ? $newarrays[0]['totals'] : 0;

if($total == 0) {
    echo "Error: No hay documentos seleccionados";
    exit;
}

$procesados = 0;
$errores = 0;

// Procesar cada documento seleccionado
for($i = 1; $i <= $total; $i++) {
    // Obtener el número de documento del array
    $docto_numFUP = isset($newarrays[$i]['nd']) ? $newarrays[$i]['nd'] : '';
    
    if(empty($docto_numFUP)) {
        $errores++;
        continue;
    }
    
    // Si los datos vienen en posiciones específicas del array (ajusta según tu estructura)
    // Ejemplo: Si envías oficio, rfc, area en índices específicos
    $num_oficioFUP = isset($newarrays[$i]['num_oficio']) ? $newarrays[$i]['num_oficio'] : '';
    $rfcFUP = isset($newarrays[$i]['rfc']) ? $newarrays[$i]['rfc'] : '';
    $areaFUP = isset($newarrays[$i]['area']) ? $newarrays[$i]['area'] : '';
    
    $observacion = "Cambio CT 90";
    $operacion = "Cambio CT 90";
    
    // Actualizar Cambios CT 90
    $id_consulta_Mov_D = 1309;
    $JSON_Mov_D = "[{\"area\":\"$areaFUP\",\"num_docto\":\"$docto_numFUP\",\"num_oficio\":\"$num_oficioFUP\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
    
    $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
    $params_Mov_D = array('Resultado' => $id_consulta_Mov_D, 'Argumento' => $array_Mov_D);
    
    try {
        $resultados_Mov_D = $cliente->getConsulta($params_Mov_D);
        $procesados++;
    } catch(Exception $e) {
        $errores++;
        error_log("Error procesando documento $docto_numFUP: " . $e->getMessage());
    }
}

// Respuesta final
if($errores == 0) {
    echo "hecho";
} else {
    echo "Error: $procesados procesados, $errores errores";
}
?>