<?php
if(isset($_POST['rfc_num_doctoR'])){

	require_once('../ServicioWeb.php');

	$htmlRS2_rfc_ND="";

	$rfcRS2_rfc_ND = strtoupper($_POST['rfc_num_doctoR']);
	$tot=strlen($rfcRS2_rfc_ND);
	if($tot==13){
		$id_consultarfc_ND = 260;
		$JSONRS2_Curp_ND="[{\"datos\":\"$rfcRS2_rfc_ND\"}]";
		$arrayRS2_rfc_ND = json_decode(json_encode($JSONRS2_Curp_ND), True);
		$paramsRS2_rfc_ND = array('Resultado'=>$id_consultarfc_ND, 'Argumento'=>$arrayRS2_rfc_ND); //para conseguir la consulta
	    $resultadosRS2_rfc_ND=$cliente->getConsulta($paramsRS2_rfc_ND);
	    $arrayNRS2_rfc_ND= json_decode(json_encode($resultadosRS2_rfc_ND), True);
		$xml = simplexml_load_string($arrayNRS2_rfc_ND['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);

		if(!empty($array)){
		
			$ver = $array['NewDataSet']['table'];
			$ver2 = $array['NewDataSet'];

			$xRS2_rfc_ND = 0;
		
			 	if(!isset($ver[0])){
			 		$total_resRS2_rfc_ND= count($ver2);
				 		$htmlRS2_rfc_ND .= '
							<option value="'.$ver['num_docto'].'">'.$ver['num_docto'].'</option>';
						$xRS2_rfc_ND++;
					
			 	}else{
			 		$total_resRS2_rfc_ND= count($ver);
					while ($xRS2_rfc_ND < $total_resRS2_rfc_ND){
			 			$htmlRS2_rfc_ND .= '
						<option value="'.$ver[$xRS2_rfc_ND]['num_docto'].'">'.$ver[$xRS2_rfc_ND]['num_docto'].'</option>';
						$xRS2_rfc_ND++;
					}
			 	}
				
		}else{
			$htmlRS2_rfc_ND .= '<option value="No hay Numeros de Documento">No hay Numeros de Documento</option>';	    
		}
		echo $htmlRS2_rfc_ND;	
	}
}
?>