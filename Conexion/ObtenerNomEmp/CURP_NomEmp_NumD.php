<?php
if(isset($_POST['rfc_num_docto'])){

	require_once('../../lib/nusoap.php'); 
	require_once('../ServicioWeb.php');
	$html="";
	$rfc = $_POST['rfc_num_docto'];

	$id_consultaRS2_CN_ND = 16;
    $JSONRS2_CN_ND="[{\"datos\":\"$rfc\"}]";
    $arrayRS2_CN_ND = json_decode(json_encode($JSONRS2_CN_ND), True);
    $paramsRS2_CN_ND = array('Resultado'=>$id_consultaRS2_CN_ND, 'Argumento'=>$arrayRS2_CN_ND); //para conseguir la consulta
    $resultadosRS2_CN_ND=$cliente->getConsulta($paramsRS2_CN_ND);
    $arrayR3= json_decode(json_encode($resultadosRS2_CN_ND), True);
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
			<input type="text" id="nomEmp4" name="nomEmp4" class = "form-control"value="'.$ver['nom_emp'].'"  disabled/>';
			$x++;
		}		
	
		echo $html;
	
	}
}
//EADZ771007HVZSMR03
?>