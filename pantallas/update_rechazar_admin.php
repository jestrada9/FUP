<?php 
  require_once('../Conexion/ServicioWeb.php');
  
  $num_docto   = $_POST['num_d'];
  $area        = $_POST['area_'];
  $num_oficio  = $_POST['num_o'];
  $observacion = $_POST['obs_'];
  $usuario     = $_POST['us_'];
  $operacion   = "Rechazo FUP Admin";

  $id_consulta_Mov =  245;
  $JSON_Mov="[{\"num_docto\":\"$num_docto\",\"operacion\":\"$operacion\"}]";
  $array_Mov = json_decode(json_encode($JSON_Mov), True);
  $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
  $resultados_Mov=$cliente->getConsulta($params_Mov);

  $id_consulta_Mov_D =  249;
  $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$num_docto\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
  $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
  $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
  //var_dump($params_Mov_D);
  $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);

  /*insert into mpsege..bit_captura (area,num_docto,num_doctoalt,num_oficio,usuario,fecha,operacion,datoalt)
  values (3111,2020266543,2020266543,2020266543,'Jonathan',GETDATE(),'Rechazo FUP','Efectos Incorrectos Plaza Movimientos')*/

  if($resultados_Mov==true){
    echo "Se Rechazó el numero de documento: ".$num_docto.".";
  }
  else
  {
    echo "No se pudo rechazar el numero de documento: ".$num_docto.".";
  }

?>