<?php 
  require_once('../Conexion/ServicioWeb.php');
  //$var= base64_decode("eyJuZXdhcnJheXMiOlt7InRvdGFscyI6Mn0seyJudW1fZG9jdG8iOiIyMTA2MjcwMTkyIn0seyJhcmEiOiIzMTExIn0seyJubyI6IjEzMTExMDAyMTIifSx7Im51bV9kb2N0byI6IjIxMDYyNzAyMTcifSx7ImFyYSI6IjMxMTEifSx7Im5vIjoiMTMxMTEwMDIyMiJ9XX0=");  
  $var=base64_decode($_POST['men']);  
  
  
  //$area        = $_POST['area_'];
  //$num_oficio  = $_POST['num_o'];
  $observacion = "Autorizo Original";
  $usuario     = $_POST['us_'];
  $operacion   = "Autorizo Original";
  
  $num_doctos="";
  $a=0;

  $arrays = json_decode($var, true);
    foreach ( $arrays as $valuesant ) {//inicio_foreach
      $tot_resul_ant = $valuesant[0]['totals'];
        while($a<$tot_resul_ant*3){
          $num_docto     = $valuesant[$a+1]['num_docto'];
          $area          = $valuesant[$a+2]['ara'];
          $num_oficio    = $valuesant[$a+3]['no'];          
          if($tot_resul_ant>1){
            $id_consulta_Mov_D =  210;
            $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$num_docto\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
            $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
            $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
            $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);

            $num_doctos = $num_doctos.$num_docto."','";
          }else{
            $num_doctos = $num_docto;

            $id_consulta_Mov_D =  210;
            $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$num_docto\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
            $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
            $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
            $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);
          }
        $a=$a+3;
        }
    }//inicio_foreach
    
    if($tot_resul_ant>1){
      $tam3 = strlen($num_doctos);
      $cadena4 = substr($num_doctos,0, $tam3-3);
    }else{
      $cadena4 = $num_doctos;
    }
/*
  $id_consulta_Mov =  210;
  $JSON_Mov="[{\"NUM_DOCUMENTO\":\"$cadena4\"}]";
  $array_Mov = json_decode(json_encode($JSON_Mov), True);
  $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
  $resultados_Mov=$cliente->getConsulta($params_Mov);
 */

  if($resultados_Mov_D==true){
    //echo "Se Crearon ".$tot_resul_ant." Documentos.";
    echo "hecho";
  }
?>