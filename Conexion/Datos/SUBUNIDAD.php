<?php
if(isset($_POST['query'])){

	require_once('../wsdl.php');

	$keyword = strtoupper($_POST['query']);
	$term = "{$keyword}%";

	$id_consultaRS2_su = 26;
    $JSONRS2_su="[{\"datos\":\"$term\"}]";
    $arrayRS2_su = json_decode(json_encode($JSONRS2_su), True);
    $paramsRS2_su = array('Resultado'=>$id_consultaRS2_su, 'Argumento'=>$arrayRS2_su, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_su=$cliente->getConsulta($paramsRS2_su);
	/*$arrayR1 = json_decode(json_encode($term), True);
	$params = array('Resultado'=>$arrayR1); //para conseguir la consulta
    $resultadoss=$cliente->getSubUnidad($params);*/
    $arrayR3= json_decode(json_encode($resultadosRS2_su), True);
    //var_dump($arrayR3);

		$xml = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);

		if(!empty($array)){
		
			$ver = $array['NewDataSet']['table'];
			$ver2 = $array['NewDataSet'];
		    if(!isset($ver[0])){
		    	$total_res= count($ver2);
		    	$x = 0;
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver['subunidad']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['subunidad']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
}	
?>	