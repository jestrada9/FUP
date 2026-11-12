<?php
require_once('../Conexion/ServicioWeb.php');

	$num_docto 	 = (int)$_POST['num_d'];
	$area 		 = $_POST['area'];
	$num_oficio  = $_POST['num_oficio'];
	$usuario 	 = $_POST['usuario'];
	$operacion 	 = $_POST['obs'];
	$observacion = $_POST['obs'];

    $id_consulta = 156;
    $JSON="[{\"num_docto\":\"$num_docto\"}]";
    $arrayR1 = json_decode(json_encode($JSON), True);
    $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
    $resultadoss=$cliente->getConsulta($params);
  
  	$id_consulta_Mov_D =  205;
    $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$num_docto\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
    $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
    $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
    $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);
    
    if($resultados_Mov_D==true){
    	echo "Documento ".$num_docto." Cancelado.";
  	}

?> 