<?php
if(isset($_POST['query'])){

	require_once('../wsdl.php');

	$keyword = strtoupper($_POST['query']);
	$term = "{$keyword}%";

	$id_consultaRS2_e = 29;
    $JSONRS2_e="[{\"datos\":\"$term\"}]";
    $arrayRS2_e = json_decode(json_encode($JSONRS2_e), True);
    $paramsRS2_e = array('Resultado'=>$id_consultaRS2_e, 'Argumento'=>$arrayRS2_e, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_e=$cliente->getConsulta($paramsRS2_e);
    $arrayR3= json_decode(json_encode($resultadosRS2_e), True);

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
				 	$countryResult[] = array((string)$ver['estatus']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['estatus']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
}	
?>