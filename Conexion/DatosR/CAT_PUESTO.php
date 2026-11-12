<?php
if(isset($_POST['query'])){

		require_once('../wsdl.php');

		$keyword = strtoupper($_POST['query']);
		$term = "{$keyword}%";

		$id_consultaRS2_catp = 21;
	    $JSONRS2_catp="[{\"datos\":\"$term\"}]";
	    $arrayRS2_catp = json_decode(json_encode($JSONRS2_catp), True);
	    $paramsRS2_catp = array('Resultado'=>$id_consultaRS2_catp, 'Argumento'=>$arrayRS2_catp, 'Accion'=>"select"); //para conseguir la consulta
	    $resultadosRS2_catp=$cliente->getConsulta($paramsRS2_catp);
	    $arrayR3= json_decode(json_encode($resultadosRS2_catp), True);

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
				 	$countryResult[] = array((string)$ver['cat_puesto']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['cat_puesto']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
}	
?>