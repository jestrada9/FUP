<?php
require_once('../lib/nusoap.php'); 
require_once('ServicioWeb.php');

  $id_consulta = 85;
  $rfc = "";
    $JSON="[{\"datos\":\"$rfc\"}]";

    $arrayR1 = json_decode(json_encode($JSON), True);
    $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
    $resultadoss=$cliente->getConsulta($params);
    $arrayR3= json_decode(json_encode($resultadoss), True);
    //var_dump($arrayR3);

        foreach($arrayR3 as $valores){
        $total_res=$valores[0]["tot_resu"]; 
  $x = 1;
   while ($x <= $total_res){  
    echo '<option value="'.$valores[$x]['idocu'].'">'.utf8_encode($valores[$x]['idocu']).'</option>';
  $x++;
  }
}
?>
  