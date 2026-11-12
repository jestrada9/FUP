<?php
if(isset($_POST['rfc_num_doctoR'])){
	
	require_once('../../lib/nusoap.php'); 
	require_once('../ServicioWeb.php');

	$htmlRS2_no_nd="";
	$rfcRS2_no_nd = $_POST['rfc_num_doctoR'];

	$id_consultaRS2_no_nd = 39;
    $JSONRS2_no_nd="[{\"datos\":\"$rfcRS2_no_nd\"}]";
    $arrayRS2_no_nd = json_decode(json_encode($JSONRS2_no_nd), True);
    $paramsRS2_no_nd = array('Resultado'=>$id_consultaRS2_no_nd, 'Argumento'=>$arrayRS2_no_nd, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_no_nd=$cliente->getConsulta($paramsRS2_no_nd);
    $arrayR3RS2_no_nd= json_decode(json_encode($resultadosRS2_no_nd), True);
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
