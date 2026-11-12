<?php 
  require_once('../Conexion/ServicioWeb.php');
  $var=$_POST['doc'];  
  $a=0;
  $mensaje = "";

  $id_consulta_Mov =  1305;
  $JSON_Mov="[{\"num_docto\":\"$var\"}]";
  $array_Mov = json_decode(json_encode($JSON_Mov), True);
  $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
  $resultados_Mov=$cliente->getConsulta($params_Mov);
  $arrayR_Editar= json_decode(json_encode($resultados_Mov), True);

  $xmlEditar = simplexml_load_string($arrayR_Editar['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
  $jsonEditar = json_encode($xmlEditar);
  $arrayEditar = json_decode($jsonEditar,TRUE);	   
  
  if(!empty($arrayEditar)){//InicioforeachEditar 
    $verEditar = $arrayEditar['NewDataSet']['table'];
    $mensaje 		  = $verEditar["mensaje"];
  }//finforeachEditar  
  echo $mensaje;
?>