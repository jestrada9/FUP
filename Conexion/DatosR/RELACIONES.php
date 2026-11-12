<?php
if(isset($_POST['query'])){

	require_once('../wsdl.php');

    $keyword1 = $_POST["query"];
    //$keyword1 = str_replace("%", "[%]",$keyword);
    //var_dump($keyword);
    $id_consultaRS2_re = 72;
    $JSONRS2_re="[{\"datos\":\"$keyword1\"}]";
    $arrayRS2_re = json_decode(json_encode($JSONRS2_re), True);
    $paramsRS2_re = array('Resultado'=>$id_consultaRS2_re, 'Argumento'=>$arrayRS2_re, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_re=$cliente->getConsulta($paramsRS2_re);
    $arrayR3= json_decode(json_encode($resultadosRS2_re), True);

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
				 	$countryResult[] = array((string)$ver['rel_cgr_cb']);
				 	$x++;
				}
		    }else{
		    	$x = 0;
		    	$total_res= count($ver);
				 while ($x < $total_res){	
				 	$countryResult[] = array((string)$ver[$x]['rel_cgr_cb']);
				 	$x++;
				}
		    }
			
			echo json_encode($countryResult);
		}
}	
?>