<?php
if(isset($_POST['valor'])){
//}else{

	require_once('../../Conexion/wsdl.php'); 	

	$num_docto = $_POST['valor'];

    $id_consultaExist =  152;
    $JSONExist="[{\"var\":\"$num_docto\"}]";
    $arrayExist = json_decode(json_encode($JSONExist), True);
    $paramsExist = array('Resultado'=>$id_consultaExist, 'Argumento'=>$arrayExist, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosExist=$cliente->getConsulta($paramsExist);
    $arrayRExist= json_decode(json_encode($resultadosExist), True);
    //var_dump($arrayRExist);
    $xml = simplexml_load_string($arrayRExist['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE); 

    if(!empty($array)){
    	echo "existe";
    }else{
    	echo "no";
    }
    /*foreach($arrayRExist as $valuesExist){ //inicio foreach arrayRsT
    	$tot_resul_tra = $valuesExist[0]["tot_resu"];
    	$idnum_docto   = $valuesExist[1]['idnum_docto'];
    }
    */
}
?>