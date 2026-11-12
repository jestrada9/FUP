<?php
  $id_consulta_Mov_D =  205;
  $JSON_Mov_D="[{\"area\":\"$AREA_PLA\",\"num_docto\":\"$docto_num\",\"num_oficio\":\"$OFICIO\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
  $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
  $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
  //var_dump($params_Mov_D);
  $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);

?>