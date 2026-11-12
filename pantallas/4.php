<?php 
  require_once('../Conexion/ServicioWeb.php');
  
  //$cadena4 = "2222294179','2222294182','2222294183','2222294173','2222294184";
  //$cadena4 = "2301295134,2301295135,2301295136";




  $mot = "10";
  $ini = "199117";
  $fin = "999999";
  $pla = "111111";
  $prei07 = "0.0";
  $doc = "2208283632";
  $area = "3111";


  //update mpsege.dbo.rel_doctos set fec_imp = ('09/05/2022') where num_docto = 2202280045

  $id_consulta_Mov =  1273;
  //$JSON_Mov="[{\"mot\":\"$mot\",\"fin\":\"$fin\",\"var\":\"$var\"}]";
  $JSON_Mov="[{\"area\":\"$area\",\"doc\":\"$doc\"}]";
  $array_Mov = json_decode(json_encode($JSON_Mov), True);
  $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
  $resultados_Mov=$cliente->getConsulta($params_Mov);
  var_dump($resultados_Mov);

 
  /*
    $id_consulta_Mov =  156;
  $JSON_Mov="[{\"num_docto\":\"$cadena4\"}]";
  $array_Mov = json_decode(json_encode($JSON_Mov), True);
  $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
  $resultados_Mov=$cliente->getConsulta($params_Mov);
  */
/*
  $id_consulta_Mov =  195;
  $JSON_Mov="[{\"num_docto\":\"$cadena4\"}]";
  $array_Mov = json_decode(json_encode($JSON_Mov), True);
  $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
  $resultados_Mov=$cliente->getConsulta($params_Mov);
*/
/*
  $id_consulta_Mov =  64;
  $JSON_Mov="[{\"fecha_def\":\"$fecha\",\"num_docto\":\"$cadena4\"}]";
  $array_Mov = json_decode(json_encode($JSON_Mov), True);
  $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
  $resultados_Mov=$cliente->getConsulta($params_Mov);
*/

/*  
$AREA_PLA = "3112";
$docto_num = "2218291998";
$Pagina = "1";
$idAutoriza = "4";


      $idAutoriza = 4;
      $id_consulta_FUPId =  150;
      $JSON_FUPId="[{\"AREA_ID\":\"$AREA_PLA\",\"NUM_DOCUMENTO\":\"$docto_num\",\"NUM_PAGINA\":\"$Pagina\",\"idAutoriza\":\"$idAutoriza\"}]";
      $arrayR1_FUPId = json_decode(json_encode($JSON_FUPId), True);
      $params_FUPId = array('Resultado'=>$id_consulta_FUPId, 'Argumento'=>$arrayR1_FUPId, 'Accion'=>"insert");
      //var_dump($params_FUPId);
      $resultadoss_FUPId=$cliente->getConsulta($params_FUPId);
    $arrayR3_FUPId= json_decode(json_encode($resultadoss_FUPId), True);

*/    
 ?>