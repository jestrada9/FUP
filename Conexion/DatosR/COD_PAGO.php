<?php
if(isset($_POST['query'])){
 
		require_once('../wsdl.php');

		$keyword = strtoupper($_POST['query']);//
		$term = "{$keyword}%";

		$id_consultaRS2_codp = 22;
	    $JSONRS2_codp="[{\"datos\":\"$term\"}]";
	    $arrayRS2_codp = json_decode(json_encode($JSONRS2_codp), True);
	    $paramsRS2_codp = array('Resultado'=>$id_consultaRS2_codp, 'Argumento'=>$arrayRS2_codp, 'Accion'=>"select"); //para conseguir la consulta
	    $resultadosRS2_codp=$cliente->getConsulta($paramsRS2_codp);
	    $arrayR3= json_decode(json_encode($resultadosRS2_codp), True);

		$xml = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		//var_dump($array);
		if(!empty($array)){
		
			$ver = $array['NewDataSet']['table'];
			$ver2 = $array['NewDataSet'];
		    if(!isset($ver[0])){
		    	$total_res= count($ver2);
		    	$x = 0;
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver['cod_pago']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['cod_pago']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
}	
?>