<?php
if(isset($_POST['query'])){

	require_once('../wsdl.php');

	$keyword = strtoupper($_POST['query']);
	$term = "{$keyword}%";

	$id_consultaRS2_h = 28;
    $JSONRS2_h="[{\"datos\":\"$term\"}]";
    $arrayRS2_h = json_decode(json_encode($JSONRS2_h), True);
    $paramsRS2_h = array('Resultado'=>$id_consultaRS2_h, 'Argumento'=>$arrayRS2_h, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_h=$cliente->getConsulta($paramsRS2_h);
    $arrayR3= json_decode(json_encode($resultadosRS2_h), True);

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
				 	$countryResult[] = array((string)$ver['horas']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['horas']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
}	
?>