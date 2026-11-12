<?php 
require_once('../Conexion/ServicioWeb.php');
//$var = base64_decode("eyJuZXdhcnJheXMiOlt7InRvdGFscyI6MX0seyJudW1fZG9jdG8iOiIyNDE4MzE4ODY0In0seyJudW1fb2ZpY2lvIjoiMTIzMTMwMDQxMiJ9LHsicmZjIjoiUkFKTjkzMTExNzhYMCJ9LHsiYXJlYSI6IjIzMTMifV19");  
$var = base64_decode($_POST['num_docto']);  
$resultados_Mov_D = false;
$observacion = "Autorizo CT Ori";
$usuario     = $_POST['usu'];
$operacion   = "Autorizo CT Ori";
$num_doctos = "";

$arrays = json_decode($var, true);

if ($arrays === null || !isset($arrays['newarrays'])) {
    die("Error: Estructura de datos inválida");
}

$data = $arrays['newarrays'];
$tot_resul_ant = $data[0]["totals"];

// Procesar cada registro
for ($i = 0; $i < $tot_resul_ant; $i++) {
    $base_index = ($i * 4) + 1;
    
    if (isset($data[$base_index], $data[$base_index + 1], $data[$base_index + 2], $data[$base_index + 3])) {
        
        $docto_numFUP  = $data[$base_index]['num_docto'] ?? '';
        $num_oficioFUP = $data[$base_index + 1]['num_oficio'] ?? '';
        $rfcFUP        = $data[$base_index + 2]['rfc'] ?? '';
        $areaFUP       = $data[$base_index + 3]['area'] ?? '';
        
        // Construir el JSON como STRING (no como array)
        $JSON_Mov_D = "[{
            \"area\":\"$areaFUP\",
            \"num_docto\":\"$docto_numFUP\",
            \"num_oficio\":\"$num_oficioFUP\",
            \"usuario\":\"$usuario\",
            \"operacion\":\"$operacion\",
            \"datoalt\":\"$observacion\"
        }]";
        
        // Pasar el JSON como STRING directamente, sin convertirlo a array
        $params_Mov_D = array(
            'Resultado' => 1318, 
            'Argumento' => $JSON_Mov_D  // Pasar el string JSON directamente
        );
        
        $resultados_Mov_D = $cliente->getConsulta($params_Mov_D);
        
        // Construir lista de documentos
        if ($tot_resul_ant > 1) {
            $num_doctos .= $docto_numFUP . "','";
        } else {
            $num_doctos = $docto_numFUP;
        }
    }
}

// Limpiar cadena si hay múltiples documentos
if ($tot_resul_ant > 1 && strlen($num_doctos) > 0) {
    $cadena4 = substr($num_doctos, 0, -3);
} else {
    $cadena4 = $num_doctos;
}

if ($resultados_Mov_D) {
    echo "hecho";
} else {
    echo "error";
}
?>