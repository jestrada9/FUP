<?php
if(isset($_POST['rfc_num_docto'])){

	//require_once('../../lib/nusoap.php'); 
	//require_once('../ServicioWeb.php');
	require_once('../../Conexion/wsdl.php');

	//[{"datos":"MARM900904MZSRNY06"}]
	$html2="";
	$rfc = $_POST['rfc_num_docto'];
	$id_consultaCurp_ND = 259;
	$JSONRS2_Curp_ND="[{\"datos\":\"$rfc\"}]";
	$arrayRS2_Curp_ND = json_decode(json_encode($JSONRS2_Curp_ND), True);
	$paramsRS2_Curp_ND = array('Resultado'=>$id_consultaCurp_ND, 'Argumento'=>$arrayRS2_Curp_ND); //para conseguir la consulta
	//var_dump($paramsRS2_Curp_ND);
    $resultadosRS2_Curp_ND=$cliente->getConsulta($paramsRS2_Curp_ND);
    $arrayR32= json_decode(json_encode($resultadosRS2_Curp_ND), True);
	//var_dump($arrayR32['getConsultaResult']['any']);
	$xml = simplexml_load_string($arrayR32['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
	$json = json_encode($xml);
	$array = json_decode($json,TRUE);
	//var_dump($array);
	//var_dump($array['NewDataSet']['table']);
	if(empty($arrayR32)){
		$html2 .= '<option value="No hay Numeros de Documento">No hay Numeros de Documento</option>';
	}else{	

			$ver = $array['NewDataSet']['table'];
			$total_res= count($array['NewDataSet']['table']);	
			
			$x = 0;
			 while ($x < $total_res){	
				$html2 .= '
				<option value="'.$ver[$x]['num_docto'].'">'.$ver[$x]['num_docto'].'</option>';
			$x++;
			}		
	}
	echo $html2;	
}
?>