<?php
//error_reporting(0);
require_once('../../Conexion/ServicioWeb.php');

if(!empty($_POST['num_d']) ){

    $num_d = $_POST['num_d'];
    //$num_d = "2005259968";
    $contar = strlen($num_d);
    if($contar==10){//contar

      $id_consulta = 97;
      $JSON="[{\"var1\":\"$num_d\"}]";
      $arrayR1 = json_decode(json_encode($JSON), True);
      $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
      //var_dump($params);
      $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
     // var_dump($arrayR3);
      $xml = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);
      //var_dump($array);

      $placve_movR1="";
      $plamot_movR1="";
      $placat_puestoR1="";
      $plaqna_iniR1="";
      $plaqna_finR1="";
      $descripcion1R1="";
      $curpR1="";
      $perrfcR1="";
      $pernom_empR1="";
//11marzo2022 billiger      $pernom_empR2="";
      $idFupid_="0";

          if(!empty($array)){
              $ver = $array['NewDataSet']['table'];
              $total_res= count($ver);
              $x = 0;
              while ($x < $total_res){
                $placve_movR1   =$ver["placve_mov"];
                $plamot_movR1   =$ver["plamot_mov"];
                $placat_puestoR1=$ver["placat_puesto"];
                $plaqna_iniR1   =$ver["plaqna_ini"];
                $plaqna_finR1   =$ver["plaqna_fin"];
                $descripcion1R1 =$ver["descripcion1"];
                $curpR1         =$ver["curp"];
                $perrfcR1       =$ver["perrfc"];
                $pernom_empR1   =$ver["pernom_emp"];
                $descripcion2R1 =$ver["descripcion2"];
                $idFupid_       =$ver["idnum_docto"];
                $x++;
             }
            echo '<label id="nomEmp1Rl">Tipo Movimiento</label><input type="text" name="nomEmp1R" class = "form-control" value="'.$placve_movR1.'" id = "nomEmp1R" disabled/>';
            echo '<label id="nomEmp2Rl">Movimiento</label><input type="text" name="nomEmp1R1" class = "form-control" value="'.$plamot_movR1.'" id = "nomEmp1R1" disabled/>';
            echo '<label id="nomEmp3Rl">Categoria</label><input type="text" name="nomEmp1R2" class = "form-control" value="'.$placat_puestoR1.'" id = "nomEmp1R2" disabled/>';
            echo '<label id="nomEmp4Rl">Qna ini</label><input type="text" name="nomEmp1R3" class = "form-control" value="'.$plaqna_iniR1.'" id = "nomEmp1R3" disabled/>';
            echo '<label id="nomEmp5Rl">Qna fin</label><input type="text" name="nomEmp1R4" class = "form-control" value="'.$plaqna_finR1.'" id = "nomEmp1R4" disabled/>';
            echo '<label id="nomEmp6Rl">Descripcion</label><input type="text" name="nomEmp1R5" class = "form-control" value="'.$descripcion1R1.'" id = "nomEmp1R5" disabled/>';
            echo '<label id="nomEmp7Rl">Curp</label><input type="text" name="nomEmp1R6" class = "form-control" value="'.$curpR1.'" id = "nomEmp1R6" disabled/>';
            echo '<label id="nomEmp8Rl">RFC</label><input type="text" name="nomEmp1R7" class = "form-control" value="'.$perrfcR1.'" id = "nomEmp1R7" disabled/>';
            echo '<label id="nomEmp9Rl">Nombre Emp.</label><input type="text" name="nomEmp1R8" class = "form-control" value="'.$pernom_empR1.'" id = "nomEmp1R8" disabled/>';
            if(($placve_movR1 == "6"||$placve_movR1 == "7") && ($plamot_movR1 == "31" || $plamot_movR1 == "33" || $plamot_movR1 == "75")){
              ?>
                <button type = "button" name="btnGetData2" class = "btn btn-warning" id = "btnGetData2" onclick="clickaction(this,'F')">Generar FUP con fmt DiA</button>
              <?php
            }
            if($idFupid_=="0") {
              echo '<label id="auslAvisoNDinex">Aviso:</label><input type="text" name="austAvisoNDinex" class = "form-control" value="¡ NO HAY ORIGINAL !" id="austAvisoNDinex" disabled><script type="text/javascript">_eeap("DivCapa1", "visibility", "hidden", 0);</script>';
            }
            else {
              echo '<script type="text/javascript">_eeap("DivCapa1", "visibility", "visible", 0);</script>';
            }
          }
          else {
            echo '<label id="auslAvisoNDinex">Aviso:</label><input type="text" name="austAvisoNDinex" class = "form-control" value="¡ DOC. INEXISTENTE !" id="austAvisoNDinex" disabled><script type="text/javascript">_eeap("DivCapa1", "visibility", "hidden", 0);</script>';
          }
          
    }//contar
}
?>