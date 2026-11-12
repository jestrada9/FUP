<?php
if(isset($_POST['rfc_num_doctoR'])){
	
	require_once('../ServicioWeb.php');
	$html="";
	$cap_nd = $_POST['rfc_num_doctoR'];

	$id_consultaRS2_Cap_ND = 74;
    $JSONRS2_Cap_ND="[{\"datos\":\"$cap_nd\"}]";
    $arrayRS2_Cap_ND = json_decode(json_encode($JSONRS2_Cap_ND), True);
    $paramsRS2_Cap_ND = array('Resultado'=>$id_consultaRS2_Cap_ND, 'Argumento'=>$arrayRS2_Cap_ND, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_Cap_ND=$cliente->getConsulta($paramsRS2_Cap_ND);
    $arrayR3= json_decode(json_encode($resultadosRS2_Cap_ND), True);
	//var_dump($arrayR3);
	$xml = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
	$json = json_encode($xml);
	$array = json_decode($json,TRUE);
	//var_dump($array);

	if(!empty($array)){
	
		$ver = $array['NewDataSet']['table'];
		$total_res= count($ver);
	    
		$x = 0;
		 while ($x < $total_res){	
			$html .= '
			<option value="'.$ver[$x]['num_docto'].'">'.$ver[$x]['num_docto'].'</option>';
			$x++;
		}
		
	}else{
		$html .= '<option value="No hay Numeros de Documento">No hay Numeros de Documento</option>';
	} 
	echo $html;
}
?>
