<?php
if(isset($_POST['query'])){

	require_once('../wsdl.php');

	$keyword = strtoupper($_POST['query']);
	$contar = strlen($keyword);
  	if($contar>=8){//contar
		$term = "{$keyword}%";


		$id_consultaRS2_nd = 32;
	    $JSONRS2_nd="[{\"datos\":\"$term\"}]";
	    $arrayRS2_nd = json_decode(json_encode($JSONRS2_nd), True);
	    $paramsRS2_nd = array('Resultado'=>$id_consultaRS2_nd, 'Argumento'=>$arrayRS2_nd, 'Accion'=>"select"); //para conseguir la consulta
	    $resultadosRS2_nd=$cliente->getConsulta($paramsRS2_nd);
		/*$arrayR1 = json_decode(json_encode($term), True);
		$params = array('Resultado'=>$arrayR1); //para conseguir la consulta
	    $resultadoss=$cliente->getNumDocto($params);*/
	    $arrayR3= json_decode(json_encode($resultadosRS2_nd), True);
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
				 	$countryResult[] = array((string)$ver['num_docto']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['num_docto']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
 	}//contar	
}
?>