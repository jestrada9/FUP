<?php
if(isset($_POST['query'])){

	require_once('../wsdl.php');

	$keyword = strtoupper($_POST['query']);
	$contar = strlen($keyword);
  	if($contar>=6){//contar
		$term = "{$keyword}%";

		$id_consultaRS2_rfc = 73;//50
	    $JSONRS2_rfc="[{\"datos\":\"$term\"}]";
	    $arrayRS2_rfc = json_decode(json_encode($JSONRS2_rfc), True);
	    $paramsRS2_rfc = array('Resultado'=>$id_consultaRS2_rfc, 'Argumento'=>$arrayRS2_rfc, 'Accion'=>"select"); //para conseguir la consulta
	    $resultadosRS2_rfc=$cliente->getConsulta($paramsRS2_rfc);
	    $arrayRRS2_rfc= json_decode(json_encode($resultadosRS2_rfc), True);

		$xml = simplexml_load_string($arrayRRS2_rfc['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);	    

		if(!empty($array)){
		
			$ver = $array['NewDataSet']['table'];
			$ver2 = $array['NewDataSet'];
		    if(!isset($ver[0])){
		    	$total_res= count($ver2);
		    	$x = 0;
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver['rfc']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['rfc']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
	}	
}
?>