<?php
if(isset($_POST['query'])){

	require_once('../wsdl.php');

	$keyword = strtoupper($_POST['query']);
	$contar = strlen($keyword);
  	if($contar>=7){//contar
		$term = "{$keyword}%";

		$id_consultaRS2_no = 33;
	    $JSONRS2_no="[{\"datos\":\"$term\"}]";
	    $arrayRS2_no = json_decode(json_encode($JSONRS2_no), True);
	    $paramsRS2_no = array('Resultado'=>$id_consultaRS2_no, 'Argumento'=>$arrayRS2_no, 'Accion'=>"select"); //para conseguir la consulta
	    $resultadosRS2_no=$cliente->getConsulta($paramsRS2_no);
		/*$arrayR1 = json_decode(json_encode($term), True);
		$params = array('Resultado'=>$arrayR1); //para conseguir la consulta
	    $resultadoss=$cliente->getNumOficio($params);*/
	    $arrayR3= json_decode(json_encode($resultadosRS2_no), True);
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
				 	$countryResult[] = array((string)$ver['num_oficio']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['num_oficio']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
	}//contar
}	
?>