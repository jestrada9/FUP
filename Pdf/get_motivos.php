<?php
require_once('../Conexion/wsdl.php');
$var = $_POST['var'];


$id_consulta = 1266;
$JSON = "[{\"var\":\"$var\"}]";
$arrayR1 = json_decode(json_encode($JSON), True);
$params = array('Resultado' => $id_consulta, 'Argumento' => $arrayR1); //para conseguir la consulta
//var_dump($params);
$resultadoss = $cliente->getConsulta($params);
$arrayR3 = json_decode(json_encode($resultadoss), True);
//var_dump($arrayR3); 
$xml1 = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
$json1 = json_encode($xml1);
$array1 = json_decode($json1, TRUE);
$rfc = "";
$area = "";
$id = 0;
$c = 0;

if (!empty($array1)) {
    $ver2 = $array1['NewDataSet']['table'];
    if (isset($ver2["rfc"])) {
        $rfc = $ver2["rfc"];
        $area = $ver2["area"];
    }
}
$id_consulta =  1316;
$JSON = "[{\"var\":\"$var\",\"rfc\":\"$rfc\",\"area\":\"$area\"}]";

$array_Mov = json_decode(json_encode($JSON), True);
$params_Mov = array('Resultado' => $id_consulta, 'Argumento' => $array_Mov); //para conseguir la consulta    
//var_dump($params_Mov);
$resultados_Mov = $cliente->getConsulta($params_Mov);
$arrayR_Mov = json_decode(json_encode($resultados_Mov), True);

if (!empty($arrayR_Mov)) {


    $xml = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
    $json = json_encode($xml);
    $array = json_decode($json, TRUE);

    if (!empty($array)) {
        $ver = $array['NewDataSet']['table'];
        $vers = $array['NewDataSet'];

        if (!isset($ver[0])) {
            $total_res = count($vers);
            if (isset($ver["mot_mov"])) {
                $mot_mov = $ver["mot_mov"];
                $data[] = array("id" => $mot_mov, "nombre" => $mot_mov);
            }
            $id = $id + 1;
        } else {
            $total_res = count($ver);

            while ($c < $total_res) { //regs. antecedentes
                if (isset($ver[$c]["mot_mov"])) {
                    $mot_mov = $ver[$c]["mot_mov"];
                    $data[] = array("id" => $mot_mov, "nombre" => $mot_mov);
                }
                $id = $id + 1;
                $c++;
            } //regs. antecedentes
        }
        $results = array("data" => $data);
        echo json_encode($results);
    } else {
        //$data[] = [""];
        $data[] = array("id" => "", "nombre" => "");
        $results = array("data" => "");
        echo json_encode($results);
    }
} else {
    echo json_encode(["data" => []]);
    exit;
}
