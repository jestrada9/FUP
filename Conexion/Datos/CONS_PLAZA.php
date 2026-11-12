<?php
if(isset($_POST['query'])){

		require_once('../wsdl.php');

		$keyword = strtoupper($_POST['query']);
		$term = "{$keyword}%";

		$id_consultaRS2_consp = 23;
	    $JSONRS2_consp="[{\"datos\":\"$term\"}]";
	    $arrayRS2_consp = json_decode(json_encode($JSONRS2_consp), True);
	    $paramsRS2_consp = array('Resultado'=>$id_consultaRS2_consp, 'Argumento'=>$arrayRS2_consp, 'Accion'=>"select"); //para conseguir la consulta
	    $resultadosRS2_consp=$cliente->getConsulta($paramsRS2_consp);
	    $arrayR3= json_decode(json_encode($resultadosRS2_consp), True);

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
				 	$countryResult[] = array((string)$ver['cons_plaza']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['cons_plaza']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
	}
?>