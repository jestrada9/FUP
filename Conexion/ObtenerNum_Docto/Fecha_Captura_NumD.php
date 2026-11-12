<?php
if(isset($_POST['rfc_num_docto'])){

	require_once('../../lib/nusoap.php'); 
	require_once('../ServicioWeb.php');

	$html="";
	$rfc = $_POST['rfc_num_docto'];

	$id_consultaRS2_fc_nd = 76;
    $JSONRS2_fc_nd="[{\"datos\":\"$rfc\"}]";
    $arrayRS2_fc_nd = json_decode(json_encode($JSONRS2_fc_nd), True);
    $paramsRS2_fc_nd = array('Resultado'=>$id_consultaRS2_fc_nd, 'Argumento'=>$arrayRS2_fc_nd, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_fc_nd=$cliente->getConsulta($paramsRS2_fc_nd);
    $arrayR3= json_decode(json_encode($resultadosRS2_fc_nd), True);
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
