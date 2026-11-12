<?php
if(isset($_POST['rfc_num_doctoR'])){

	require_once('../../lib/nusoap.php'); 
	require_once('../ServicioWeb.php');

	$html="";
	$rfc = $_POST['rfc_num_doctoR'];
	
	$id_consultaRS2_est_nd = 75;
    $JSONRS2_est_nd="[{\"datos\":\"$rfc\"}]";
    $arrayRS2_est_nd = json_decode(json_encode($JSONRS2_est_nd), True);
    $paramsRS2_est_nd = array('Resultado'=>$id_consultaRS2_est_nd, 'Argumento'=>$arrayRS2_est_nd, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_est_nd=$cliente->getConsulta($paramsRS2_est_nd);
    $arrayR3= json_decode(json_encode($resultadosRS2_est_nd), True);
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
