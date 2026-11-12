<?php
//if(isset($_POST['rfc_num_docto'])){

	require_once('../ServicioWeb.php');
	$html="";
	$rfcN = $_POST['rfc_num_docto'];

	$id_consultaRS2_RN_ND = 44;
    $JSONRS2_RN_ND="[{\"datos\":\"$rfcN\"}]";
    $arrayRS2_RN_ND = json_decode(json_encode($JSONRS2_RN_ND), True);
    $paramsRS2_RN_ND = array('Resultado'=>$id_consultaRS2_RN_ND, 'Argumento'=>$arrayRS2_RN_ND, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_RN_ND=$cliente->getConsulta($paramsRS2_RN_ND);
    $arrayNRS2_RN_ND= json_decode(json_encode($resultadosRS2_RN_ND), True);
	$xml = simplexml_load_string($arrayNRS2_RN_ND['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
	$json = json_encode($xml);
	$array = json_decode($json,TRUE);
	//var_dump($array);

	if(!empty($array)){
	
		$ver = $array['NewDataSet']['table'];
		$total_res= count($ver);
	    
		$x = 0;
		 while ($x < $total_res){	
			$html .= '
			
			<input type="text" name="nomEmp1" class = "form-control" value="'.$ver['nom_emp'].'" id = "nomEmp1" disabled/>';
		$x++;
		}
		echo $html;
	} 
	   
//}
?>