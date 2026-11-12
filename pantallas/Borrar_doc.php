<?php 
  require_once('../Conexion/ServicioWeb.php');
  $var=$_POST['doc'];  
  $a=0;


  $id_consulta_Mov =  156;
  $JSON_Mov="[{\"num_docto\":\"$var\"}]";
  $array_Mov = json_decode(json_encode($JSON_Mov), True);
  $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
  $resultados_Mov=$cliente->getConsulta($params_Mov);


  if($resultados_Mov==true){
    echo "hecho";
  }
?>