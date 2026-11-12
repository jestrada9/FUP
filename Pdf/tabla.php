<?php
/*if(!isset($_POST['var']))
   {
    require '../users/class/users.php';  
   }else{*/
require_once('../Conexion/ServicioWeb.php');
$buscar = $_POST['mot_mov1']; // mot_mov
$mot_mov = $_POST['mot_mov']; // mot_mov
$cve_mov = $_POST['cve_mov']; // cve_mov1
$var = $_POST['var']; // Numero de Doc
$por_documento = $_POST['por_documento']; // Numero de Doc agregado por usuario 
$por_movimiento = $_POST['por_movimiento']; // Numero de Doc agregado por usuario 

$id_consulta = 1266;
$JSON = "[{\"var\":\"$var\"}]";
$arrayR1 = json_decode(json_encode($JSON), True);
$params = array('Resultado' => $id_consulta, 'Argumento' => $arrayR1); //para conseguir la consulta
//var_dump($params);
$resultadoss = $cliente->getConsulta($params);
$arrayR3 = json_decode(json_encode($resultadoss), True);
//var_dump($arrayR3); 
$xml1 = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
$json1 = json_encode($xml1);
$array1 = json_decode($json1, TRUE);
$rfc = "";
$area = "";
if (!empty($array1)) {
  $ver2 = $array1['NewDataSet']['table'];
  if (isset($ver2["rfc"])) {
    $rfc = $ver2["rfc"];
    $area = $ver2["area"];
  }
  //}

  $JSON = "[{}]";
?>
  <?php
  //$mot_mov = "";
  $def = "";
  $id_consulta = "";
  /*-------------------------------------------- mot_mov -----------------------------------------------------------*/
  if ($buscar == "Temporales") {
    $mot_mov = "'9','20','22','24','25','75','76','79','84','86','99'";
    if ($cve_mov == "3" || $cve_mov == "4") {
      $id_consulta = 151;
    } else {
      $id_consulta = 153;
    }
    $JSON = "[{\"var\":\"$var\",\"cve_mov2\":\"$cve_mov\",\"mot_mov2\":\"$mot_mov\"}]";
  }
  if ($buscar == "Permisos") {
    $mot_mov = "'8','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','97'"; //43
    //'8','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','97'
    if ($cve_mov == "3" || $cve_mov == "4") {
      $id_consulta = 151;
    } else {
      $id_consulta = 153;
    }
    $JSON = "[{\"var\":\"$var\",\"cve_mov2\":\"$cve_mov\",\"mot_mov2\":\"$mot_mov\"}]";
  }
  if ($buscar == "Definitivos") {
    $mot_mov = "'3','10','31','32','33','34','35','36','37','38','39','71','73','74','77','80','86','83','95','96'";
    if ($cve_mov == "3" || $cve_mov == "4") {
      $id_consulta = 151;
    } else {
      $id_consulta = 153;
    }
    $JSON = "[{\"var\":\"$var\",\"cve_mov2\":\"$cve_mov\",\"mot_mov2\":\"$mot_mov\"}]";
  }
  if ($buscar == "Reingreso") {
    $mot_mov = "'60','61','62','63','64','65','66','67','70'";
    if ($cve_mov == "3" || $cve_mov == "4") {
      $id_consulta = 151;
    } else {
      $id_consulta = 153;
    }
    $JSON = "[{\"var\":\"$var\",\"cve_mov2\":\"$cve_mov\",\"mot_mov2\":\"$mot_mov\"}]";
  }
  if ($buscar == "Todos") {
    /*
          if($cve_mov == "3" || $cve_mov == "4"){
            $id_consulta = 151;
          }else{
            $id_consulta = 153;
          }
          */
    $id_consulta = 153;
    $JSON = "[{\"var\":\"$var\",\"rfc\":\"$rfc\",\"area\":\"$area\"}]";
  }
  if ($buscar == "TodosPrueba") {
    /*
          if($cve_mov == "3" || $cve_mov == "4"){
            $id_consulta = 151;
          }else{
            $id_consulta = 153;
          }
          */
    $id_consulta = 1299;
    $JSON = "[{\"var\":\"$var\",\"rfc\":\"$rfc\",\"area\":\"$area\"}]";
  }
  if ($buscar == "TodosSND") {
    /*
          if($cve_mov == "3" || $cve_mov == "4"){
            $id_consulta = 151;
          }else{
            $id_consulta = 153;
          }
          */
    $id_consulta = 1276;
    $JSON = "[{\"var\":\"$var\",\"rfc\":\"$rfc\"}]";
  }
  if ($buscar == "Historico") {
    if ($cve_mov == "3" || $cve_mov == "4") {
      $id_consulta = 151;
    } else {
      $id_consulta = 140;
    }
    $not = "";
    $JSON = "[{\"var\":\"$var\",\"cve_mov2\":\"$cve_mov\",\"not\":\"$not\"}]";
  }
  if ($buscar == "Historico_o") {
    if ($cve_mov == "3" || $cve_mov == "4") {
      $id_consulta = 151;
    } else {
      $id_consulta = 140;
    }
    $not = "not";
    $JSON = "[{\"var\":\"$var\",\"cve_mov2\":\"$cve_mov\",\"not\":\"$not\"}]";
  }
  if ($buscar == "Num_Docto") {
    $id_consulta = 170;
    $JSON = "[{\"var\":\"$por_documento\"}]";
  }
  if ($buscar == "Movimientos") {
    $id_consulta = 1317;
    $JSON = "[{\"var\":\"$var\",\"rfc\":\"$rfc\",\"area\":\"$area\",\"mot_mov\":\"$por_movimiento\"}]";
  }
  $c = 0;
  $cod_pago =     "";
  $unidad =       "";
  $subunidad =    "";
  $cat_puesto =   "";
  $horas =        "";
  $cons_plaza =   "";
  $mot_mov1 =     "";
  $nivel_sueldo = "";
  $qna_ini =      "";
  $qna_fin =      "";
  $num_docto =    "";

  $ent_fed =      "";
  $ct_clasif =    "";
  $ct_id =        "";
  $num2 =         "";
  $ct_secuencial = "";
  $ct_digito_ver =  "";

  $partida =  "";
  $concepto =  "";
  $importe_Ante =  "";
  $id = 0;

  $arrayR1 = json_decode(json_encode($JSON), True);
  $params = array('Resultado' => $id_consulta, 'Argumento' => $arrayR1);
  //var_dump($params);
  $resultadoss = $cliente->getConsulta($params);
  $arrayss = json_decode(json_encode($resultadoss), True);
  //AGREGAR VALIDACION PARA QUE NO ME SUELTE FALLAS
  if (!isset($arrayss['getConsultaResult']['any'])) {
    echo "<tr><td colspan='17' style='text-align:center; font-size:80%; padding:0px;'>No se encontraron resultados</td></tr>";
    exit();
  }

  $xml = simplexml_load_string($arrayss['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
  $json = json_encode($xml);
  $array = json_decode($json, TRUE);
  //var_dump($params);


  if (!empty($array)) {
    $ver = $array['NewDataSet']['table'];
    $vers = $array['NewDataSet'];

    if (!isset($ver[0])) {
      $total_res = count($vers);
      if (isset($ver["cod_pago"])) {
        $cod_pago =     $ver["cod_pago"];
      }
      if (isset($ver["unidad"])) {
        $unidad =       $ver["unidad"];
      }
      if (isset($ver["unidad"])) {
        $unidad =       $ver["unidad"];
      }
      if (isset($ver["subunidad"])) {
        $subunidad =    $ver["subunidad"];
      }
      if (isset($ver["cat_puesto"])) {
        $cat_puesto =   $ver["cat_puesto"];
      }
      if (isset($ver["horas"])) {
        $horas =        $ver["horas"];
      }
      if (isset($ver["cons_plaza"])) {
        $cons_plaza =   $ver["cons_plaza"];
      }
      if (isset($ver["mot_mov"])) {
        $mot_mov1 =     $ver["mot_mov"];
      }
      if (isset($ver["nivel_sueldo"])) {
        $nivel_sueldo = $ver["nivel_sueldo"];
      }
      if (isset($ver["qna_ini"])) {
        $qna_ini =      $ver["qna_ini"];
      }
      if (isset($ver["qna_fin"])) {
        $qna_fin =      $ver["qna_fin"];
      }
      if (isset($ver["num_docto"])) {
        $num_docto =    $ver["num_docto"];
      }
      if (isset($ver["ent_fed"])) {
        $ent_fed =      $ver["ent_fed"];
      }
      if (isset($ver["ct_clasif"])) {
        $ct_clasif =    $ver["ct_clasif"];
      }
      if (isset($ver["ct_id"])) {
        $ct_id =        $ver["ct_id"];
      }
      if (isset($ver["ct_secuencial"])) {
        $num2 =         $ver["ct_secuencial"];
        $ct_secuencial = str_pad($num2, 4, "0", STR_PAD_LEFT);
      }
      if (isset($ver["ct_digito_ver"])) {
        $ct_digito_ver =  $ver["ct_digito_ver"];
      }
      if (isset($ver["partida"])) {
        $partida =      $ver["partida"];
      }
      if (isset($ver["area"])) {
        $area =        $ver["area"];
      }
  ?>

      <tr id="<?php echo $id; ?>">
        <td id="add" style="text-align: center; font-size:80%; padding:0px; "><input type="image" src="../Logo/addthis2.png" class="envio" /></td>
        <td contenteditable='true' id="cp" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cod_pago ?></td>
        <td contenteditable='true' id="uni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $unidad ?></td>
        <td contenteditable='true' id="suni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $subunidad ?></td>
        <td contenteditable='true' id="cat" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cat_puesto ?></td>
        <td contenteditable='true' id="hr" style="text-align: center; font-size:80%; padding:0px; "><?php echo $horas ?></td>
        <td contenteditable='true' id="cons" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cons_plaza ?></td>
        <td contenteditable='true' id="mot" style="text-align: center; font-size:80%; padding:0px; "><?php echo $mot_mov1 ?></td>
        <td contenteditable='true' id="niv" style="text-align: center; font-size:80%; padding:0px; "><?php echo $nivel_sueldo ?></td>
        <td contenteditable='true' id="qini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_ini ?></td>
        <td contenteditable='true' id="qfini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_fin ?></td>
        <td contenteditable='true' id="nd" style="text-align: center; font-size:80%; padding:0px; "><?php echo $num_docto ?></td>
        <td contenteditable='true' id="ct" style="text-align: center; font-size:80%; padding:0px; "><?php echo $ent_fed . $ct_clasif . $ct_id . $ct_secuencial . $ct_digito_ver; ?></td>
        <td id="valor" style="display:none;"><?php echo $var; ?></td>
        <td style="display:none;"><?php echo $cve_mov; ?></td>
        <td style="display:none;"><?php echo $partida; ?></td>
        <td style="display:none;"><?php echo $area; ?></td>
      </tr>

      <?php
      $id = $id + 1;
    } else {
      $total_res = count($ver);
      while ($c < $total_res) {   //regs. antecedentes

        if (isset($ver[$c]["cod_pago"])) {
          $cod_pago =     $ver[$c]["cod_pago"];
        }
        if (isset($ver[$c]["unidad"])) {
          $unidad =       $ver[$c]["unidad"];
        }
        if (isset($ver[$c]["unidad"])) {
          $unidad =       $ver[$c]["unidad"];
        }
        if (isset($ver[$c]["subunidad"])) {
          $subunidad =    $ver[$c]["subunidad"];
        }
        if (isset($ver[$c]["cat_puesto"])) {
          $cat_puesto =   $ver[$c]["cat_puesto"];
        }
        if (isset($ver[$c]["horas"])) {
          $horas =        $ver[$c]["horas"];
        }
        if (isset($ver[$c]["cons_plaza"])) {
          $cons_plaza =   $ver[$c]["cons_plaza"];
        }
        if (isset($ver[$c]["mot_mov"])) {
          $mot_mov1 =     $ver[$c]["mot_mov"];
        }
        if (isset($ver[$c]["nivel_sueldo"])) {
          $nivel_sueldo = $ver[$c]["nivel_sueldo"];
        }
        if (isset($ver[$c]["qna_ini"])) {
          $qna_ini =      $ver[$c]["qna_ini"];
        }
        if (isset($ver[$c]["qna_fin"])) {
          $qna_fin =      $ver[$c]["qna_fin"];
        }
        if (isset($ver[$c]["num_docto"])) {
          $num_docto =    $ver[$c]["num_docto"];
        }
        if (isset($ver[$c]["ent_fed"])) {
          $ent_fed =      $ver[$c]["ent_fed"];
        }
        if (isset($ver[$c]["ct_clasif"])) {
          $ct_clasif =    $ver[$c]["ct_clasif"];
        }
        if (isset($ver[$c]["ct_id"])) {
          $ct_id =        $ver[$c]["ct_id"];
        }
        if (isset($ver[$c]["ct_secuencial"])) {
          $num2 =         $ver[$c]["ct_secuencial"];
          $ct_secuencial = str_pad($num2, 4, "0", STR_PAD_LEFT);
        }
        if (isset($ver[$c]["ct_digito_ver"])) {
          $ct_digito_ver =  $ver[$c]["ct_digito_ver"];
        }
        if (isset($ver[$c]["partida"])) {
          $partida =      $ver[$c]["partida"];
        }
        if (isset($ver[$c]["area"])) {
          $area =        $ver[$c]["area"];
        }
      ?>

        <tr id="<?php echo $id; ?>">
          <td contenteditable='true' id="add" style="text-align: center; font-size:80%; padding:0px; "><input type="image" src="../Logo/addthis2.png" class="envio" /></td>
          <td contenteditable='true' id="cp" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cod_pago ?></td>
          <td contenteditable='true' id="uni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $unidad ?></td>
          <td contenteditable='true' id="suni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $subunidad ?></td>
          <td contenteditable='true' id="cat" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cat_puesto ?></td>
          <td contenteditable='true' id="hr" style="text-align: center; font-size:80%; padding:0px; "><?php echo $horas ?></td>
          <td contenteditable='true' id="cons" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cons_plaza ?></td>
          <td contenteditable='true' id="mot" style="text-align: center; font-size:80%; padding:0px; "><?php echo $mot_mov1 ?></td>
          <td contenteditable='true' id="niv" style="text-align: center; font-size:80%; padding:0px; "><?php echo $nivel_sueldo ?></td>
          <td contenteditable='true' id="qini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_ini ?></td>
          <td contenteditable='true' id="qfini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_fin ?></td>
          <td contenteditable='true' id="nd" style="text-align: center; font-size:80%; padding:0px; "><?php echo $num_docto ?></td>
          <td contenteditable='true' id="ct" style="text-align: center; font-size:80%; padding:0px; "><?php echo $ent_fed . $ct_clasif . $ct_id . $ct_secuencial . $ct_digito_ver; ?></td>
          <td id="valor" style="display:none;"><?php echo $var; ?></td>
          <td style="display:none;"><?php echo $cve_mov; ?></td>
          <td style="display:none;"><?php echo $partida; ?></td>
          <td style="display:none;"><?php echo $area; ?></td>
        </tr>

  <?php
        $id = $id + 1;
        $c++;
      } //regs. antecedentes
    }
  }
  ?>
<?php
}
?>