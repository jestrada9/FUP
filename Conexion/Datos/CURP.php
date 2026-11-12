<?php
if(isset($_POST['query'])){

	require_once('../wsdl.php');

	$keyword = strtoupper($_POST['query']);
	$term = "{$keyword}%";
	//echo $term;
	$id_consultaRS2_curp = 	15;
    $JSONRS2_curp="[{\"datos\":\"$term\"}]";
    $arrayRS2_curp = json_decode(json_encode($JSONRS2_curp), True);
    $paramsRS2_curp = array('Resultado'=>$id_consultaRS2_curp, 'Argumento'=>$arrayRS2_curp, 'Accion'=>"select"); //para conseguir la consulta
    //var_dump($params1);
    $resultadosRS2_curp=$cliente->getConsulta($paramsRS2_curp);	
    $arrayR3= json_decode(json_encode($resultadosRS2_curp), True);
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
				 	$countryResult[] = array((string)$ver['curp']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['curp']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
}
?>