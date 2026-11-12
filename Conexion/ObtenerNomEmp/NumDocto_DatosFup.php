<?php
if(isset($_POST['rfc_num_docto'])){

	require_once('../ServicioWeb.php');
	$html="";
	$rfc = $_POST['rfc_num_docto'];

	$id_consultaRS2_CN_DF = 44;
    $JSONRS2_CN_DF="[{\"datos\":\"$rfc\"}]";
    $arrayRS2_CN_DF = json_decode(json_encode($JSONRS2_CN_DF), True);
    $paramsRS2_CN_DF = array('Resultado'=>$id_consultaRS2_CN_DF, 'Argumento'=>$arrayRS2_CN_DF, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosRS2_CN_DF=$cliente->getConsulta($paramsRS2_CN_DF);
	/*$arrayR1 = json_decode(json_encode($rfc), True);
	$params = array('Resultado'=>$arrayR1); //para conseguir la consulta
    $resultadoss=$cliente->getRFC_Nom_Emp($params);*/
    $arrayR3= json_decode(json_encode($resultadosRS2_CN_DF), True);
	//var_dump($arrayR3);
    foreach($arrayR3 as $valuess){
		$total_res=$valuess[0]["tot_resu"];	
		$x = 1;
		 while ($x <= $total_res){	
			$html .= '
			<input type="text" name="nomEmp1" class = "form-control" value="'.$valuess[$x]['RFC_nom_emp'].'" id = "nomEmp1" disabled/>';
		$x++;
		}
	  echo $html;
	}
}
?>