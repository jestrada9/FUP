<?php
if(isset($_POST['rfc_num_doctoR'])){

	require_once('../ServicioWeb.php');
	$html="";
	$rfc = $_POST['rfc_num_doctoR'];
	if ($rfc != ""){

		$id_consultaRS2_CN_ND_R = 16;
	    $JSONRS2_CN_ND_R="[{\"datos\":\"$rfc\"}]";
	    $arrayRS2_CN_ND_R = json_decode(json_encode($JSONRS2_CN_ND_R), True);
	    $paramsRS2_CN_ND_R = array('Resultado'=>$id_consultaRS2_CN_ND_R, 'Argumento'=>$arrayRS2_CN_ND_R, 'Accion'=>"select"); //para conseguir la consulta
	    $resultadosRS2_CN_ND_R=$cliente->getConsulta($paramsRS2_CN_ND_R);
	    $arrayR3= json_decode(json_encode($resultadosRS2_CN_ND_R), True);
		//var_dump($arrayR3);
		$xml = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);

		//var_dump($array);

		if(!empty($arrayR3)){
			
			$ver = $array['NewDataSet']['table'];
			$total_res= count($ver);	
			
			$x = 0;
			 while ($x < $total_res){	
				$html .= '
				<input type="text" id="nomEmp4R" name="nomEmp4R" class = "form-control"value="'.$ver['nom_emp'].'"  disabled/>';
				$x++;
			}		
		
			echo $html;
		
		}
	}
}
//EADZ771007HVZSMR03
?>