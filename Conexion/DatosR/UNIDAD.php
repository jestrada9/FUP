<?php
if(isset($_POST['query'])){

	require_once('../wsdl.php');

	$keyword = strtoupper($_POST['query']);
	$term = "{$keyword}%";

	$id_consultaRS2_u = 24;
    $JSONRS2_u="[{\"datos\":\"$term\"}]";

    $arrayRS2_u = json_decode(json_encode($JSONRS2_u), True);
    $paramsRS2_u = array('Resultado'=>$id_consultaRS2_u, 'Argumento'=>$arrayRS2_u, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_u=$cliente->getConsulta($paramsRS2_u);
	/*$arrayR1 = json_decode(json_encode($term), True);
	$params = array('Resultado'=>$arrayR1); //para conseguir la consulta
    $resultadoss=$cliente->getUnidad($params);*/
    $arrayR3= json_decode(json_encode($resultadosRS2_u), True);
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
				 	$countryResult[] = array((string)$ver['unidad']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['unidad']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
}	
?>