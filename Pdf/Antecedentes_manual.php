<?php
require_once('../Conexion/ServicioWeb.php');
require_once('../Conexion/conexion.php');
//include('../Conexion/permisos.php');
$var = base64_decode($_GET['var']);
$cve_mov = base64_decode($_GET['cve_mov']);
$mot_mov = base64_decode($_GET['mot_mov']);
//  echo $mot_mov;
$usuario = "Paty";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <title>Tabla de Registros</title>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link href="../Css/tablaAntecedentes7.css?v=<?php echo (rand()); ?>" rel="stylesheet" type="text/css">
  <script src="../Js/ajax2.js?v=<?php echo (rand()); ?>"></script>
  <script>
    $(document).ready(function() {
      $("input").attr("autocomplete", "on");
    });

    window.onload = function() {
      $('#plaza_ant').on('change', function(e) {
        if (this.checked) {
          $('#exampleModalM').modal();
          /*$('#close').click(function (e) {
             $('#plaza_ant').prop('checked', false);
           })*/
        }
      });
    }

    function cambia_de_pagina() {
      window.close();
    }
  </script>

  <script type="text/javascript">
    function menu_origenes(o1, o2, o3, o4, o5, o6, o7, o8, o9, o10) {
      if (o1 == 1) {
        $("#Todos").show();
        $('#Todos').removeAttr('disabled');
      }
      if (o1 == 1) {
        $("#Temporales").show();
        $('#Temporales').removeAttr('disabled');
      }
      if (o2 == 1) {
        $("#Permisos").show();
        $('#Permisos').removeAttr('disabled');
      }
      if (o3 == 1) {
        $("#Definitivos").show();
        $('#Definitivos').removeAttr('disabled');
      }
      if (o4 == 1) {
        $("#Reingreso").show();
        $('#Reingreso').removeAttr('disabled');
      }
      if (o5 == 1) {
        $("#Historico").show();
        $('#Historico').removeAttr('disabled');
      }
      if (o6 == 1) {
        $("#Historico_o").show();
        $('#Historico_o').removeAttr('disabled');
      }
      if (o7 == 1) {
        $("#Num_Docto").show();
        $('#Num_Docto').removeAttr('disabled');
      }
      if (o8 == 1) {
        $("#TodosSND").show();
        $('#TodosSND').removeAttr('disabled');
      }
      if (o9 == 1) {
        $("#TodosPrueba").show();
        $('#TodosPrueba').removeAttr('disabled');
      }
      if (o10 == 1) {
        $("#Movimientos").show();
        $('#Movimientos').removeAttr('disabled');
      }
    }


    $(function() {
      $('#tbody tr').click(function(e) {
        var a = $(this).closest('tr').find('a')
        e.preventDefault()
      })
    })

    $(document).on('click', '.envio', function(event) {
      var hermano = $(this).parent();
      $("#tabla2 tbody").prepend("<tr>\
              <td style='text-align: center; font-size:80%; padding:0px; '><input type='image' src='../Logo/subtract2.png' class='borrar' /></td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(0)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(1)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(2)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(3)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(4)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(5)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(6)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(7)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(8)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(9)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(10)").text() + "</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(11)").text() + "</td>\
              <td style='display:none;' >" + hermano.siblings("td:eq(12)").text() + "</td>\
              <td style='display:none;'>" + hermano.siblings("td:eq(14)").text() + "</td>\
              <td style='display:none;'>" + hermano.siblings("td:eq(15)").text() + "</td>\
              <td style='display:none;'>" + hermano.siblings("td:eq(16)").text() + "</td>\
              <td style='display:none;'>" + hermano.siblings("td:eq(17)").text() + "</td>\
            </tr>")
    });

    $(document).on('click', '.borrar', function(event) {
      event.preventDefault();
      $(this).closest('tr').remove();
    });
  </script>
  <script>
    function mostrar(id) {
      let va = "<?php echo $var ?>";
      if (id == "Num_Docto") {
        $("#por_documento").show();
        $("#por_movimiento").hide();
      } else {
        $("#por_documento").hide();
      }
      if (id == "Movimientos") {
        //$("#por_movimiento").show();
        $.ajax({
          url: 'get_motivos.php',
          type: 'POST',
          dataType: 'json',
          data: {
            var: va
          },
          success: function(motivos) {
            const $select = $('#por_movimiento');
            $.each(motivos, function(index, motivo) {
              $select.append($('<option>', {
                value: motivo,
                text: motivo
              }));
            });
            $select.show();
          },
          error: function(xhtt, status, error) {
            alert('No se pudieron cargar los motivos' + xhtt + ' ' + status + ' ' + error);

          }
        });


      } else {
        $("#por_movimiento").hide();
      }
    }

    function mostrar_movs(id) {
      console.log(id);

    }
  </script>
  <?php
  include "../Scripts/script_Tabla_manual.php";
  ?>
</head>

<body>

  <!--button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#exampleModalM">Abrir Modal</button-->
  <div class="modal fade" id="exampleModalM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">

          <?php
          //$buscar = 2211285213;
          $id_consulta_Mov =  191;
          $JSON_Mov = "[{\"Valor\":\"$var\"}]";
          $array_Mov = json_decode(json_encode($JSON_Mov), True);
          $params_Mov = array('Resultado' => $id_consulta_Mov, 'Argumento' => $array_Mov); //para conseguir la consulta
          $resultados_Mov = $cliente->getConsulta($params_Mov);
          $arrayR_Mov = json_decode(json_encode($resultados_Mov), True);
          //var_dump($arrayR_Mov);
          $xml = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
          $json = json_encode($xml);
          $array = json_decode($json, TRUE);
          //var_dump($array);
          //var_dump($array['NewDataSet']['table']);
          if (!empty($array)) {

            $cve_movM       = "";
            $mot_movM       = "";
            $partidaM       = "";
            $cod_pagoM      = "";
            $unidadM      = "";
            $subunidadM     = "";
            $cat_puestoM    = "";
            $horasM       = "";
            $cons_plazaM    = "";
            $qna_ini_empM     = "";
            $qna_fin_empM     = "";
            $qna_inisusM    = "";
            $qna_finsusM    = "";
            $nom_empsusM    = "";
            $rfcsusM      = "";
            $mot_movsusM    = "";
            $num_doctosusM    = "";
            $ctM        = "";
            $nivel_sueldonvoM = "";
            $descripcion2M    = "";
            $descripcion1M    = "";

            $b = 0;
            $id = 0;
          ?>
            <div id="divTablas" class="table-responsive">
              <table class="table table-striped" id="movs">
                <thead class="thead-dark">
                  <tr>
                    <th><strong>Agregar</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>one</strong></th>
                    <th class="dt-head-center"><strong>TM</strong></th>
                    <th class="dt-head-center"><strong>MO</strong></th>
                    <th class="dt-head-center"><strong>PDA</strong></th>
                    <th class="dt-head-center"><strong>Cod.Pago</strong></th>
                    <th class="dt-head-center"><strong>Unidad</strong></th>
                    <th class="dt-head-center"><strong>Subunidad</strong></th>
                    <th class="dt-head-center"><strong>Puesto</strong></th>
                    <th class="dt-head-center"><strong>Horas</strong></th>
                    <th class="dt-head-center"><strong>Plaza</strong></th>
                    <th class="dt-head-center"><strong>Qna. Ini</strong></th>
                    <th class="dt-head-center"><strong>Qna. Fin</strong></th>

                    <th class="dt-head-center"><strong>Nombre Sus</strong></th>
                    <th class="dt-head-center"><strong>RFC Sus</strong></th>
                    <th class="dt-head-center"><strong>MO Sus</strong></th>
                    <th class="dt-head-center"><strong>Qna Ini Sus</strong></th>
                    <th class="dt-head-center"><strong>Qna Fin Sus</strong></th>
                    <th class="dt-head-center"><strong>Num Docto Sus</strong></th>
                    <th class="dt-head-center"><strong>CT</strong></th>
                    <th class="dt-head-center"><strong>Nvl Sueldo</strong></th>
                    <th class="dt-head-center"><strong>Descripcion</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>Cons_Doc</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>Area</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>Num_Oficio</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>Operador</strong></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ver = $array['NewDataSet']['table'];
                  $ver2 = $array['NewDataSet'];
                  $CATEGORIA_MOV = "";
                  $QNA_INISUS_MOV     = "";
                  $QNA_FINSUS_MOV     = "";
                  $NOMBRE_SUS_MOV     = "";
                  $RFCSUS_MOV         = "";
                  $MOT_MOVSUS         = "";
                  $NUM_DOCUMENTOSUS   = "";
                  $NIVEL_SUELDO_NUEVO = "";
                  $SUBUNIDAD_MOV = "";
                  $UNIDAD_MOV = "";
                  $PARTIDA_MOV = "";
                  $M = "";
                  $TM = "";
                  $MO1 = "";
                  $MO = "";
                  $CODIGO_PAGO_MOV1 = "";
                  $CODIGO_PAGO_MOV = "";
                  $HORAS_MOV = "";
                  $PLAZA_MOV = "";
                  $numero = "";
                  $DESCRIPCION1 = "";
                  $DESCRIPCION2 = "";
                  $OPERADOR = "";
                  $NUM_OFICIO = "";
                  $AREA_PLA = "";
                  $CONS_DOC = "";
                  $CT_MOV = "";
                  if (!isset($ver[0])) {
                    $tot_resul_mov = count($ver2);


                    while ($b < $tot_resul_mov) { //$total_res*30 //2do while getDatosPDF_Mov
                      //if($b == $tot_resul_mov*24){
                      if (isset($ver['cve_mov'])) {
                        $M                  = $ver['cve_mov'];
                        $TM                 = str_pad($M, 2, "0", STR_PAD_LEFT);
                      }
                      if (isset($ver['mot_mov'])) {
                        $MO1                = $ver['mot_mov']; //10";
                        $MO                 = str_pad($MO1, 2, "0", STR_PAD_LEFT);
                      }
                      if (isset($ver['partida'])) {
                        $PARTIDA_MOV        = $ver['partida'];
                      }
                      if (isset($ver['cod_pago'])) {
                        $CODIGO_PAGO_MOV1   = $ver['cod_pago'];
                        $CODIGO_PAGO_MOV    = str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
                      }
                      if (isset($ver['unidad'])) {
                        $UNIDAD_MOV         = $ver['unidad'];
                      }
                      if (isset($ver['subunidad'])) {
                        $SUBUNIDAD_MOV      = $ver['subunidad'];
                      }
                      if (isset($ver['cat_puesto'])) {
                        if ($ver['cat_puesto'] == "" || $ver['cat_puesto'] == " ") {
                          $CATEGORIA_MOV      = $ver['cat_puesto'];
                        }
                      } else {
                        $CATEGORIA_MOV      = "";
                      }
                      if (isset($ver['horas'])) {
                        $HORAS_MOV          = $ver['horas'];
                      }
                      if (isset($ver['cons_plaza'])) {
                        $numero             = $ver['cons_plaza'];
                        $PLAZA_MOV          = str_pad($numero, 6, "0", STR_PAD_LEFT);
                      }
                      $DESDE_MOV          = $ver['qna_ini_emp'];
                      $HASTA_MOV          = $ver['qna_fin_emp'];
                      if (isset($ver['qna_inisus'])) {
                        $QNA_INISUS_MOV     = $ver['qna_inisus'];
                      }
                      /*if($QNA_INISUS_MOV == ""){$QNA_INISUS_MOV = "NULL";}
        if($QNA_INISUS_MOV == "NULL" ){$QNA_INISUS_MOV1 = "";}else{$QNA_INISUS_MOV1 =     $ver['qna_inisus'];}*/
                      if (isset($ver['qna_finsus'])) {
                        $QNA_FINSUS_MOV     = $ver['qna_finsus'];
                      }
                      /*if($QNA_FINSUS_MOV == "NULL" ){$QNA_FINSUS_MOV1 = "";}else{$QNA_FINSUS_MOV1 =     $ver['qna_finsus'];}
        if($QNA_FINSUS_MOV == ""){$QNA_FINSUS_MOV = "NULL";}*/
                      if (isset($ver['nom_empsus'])) {
                        $NOMBRE_SUS_MOVs     = $ver['nom_empsus'];
                        $NOMBRE_SUS_MOV     = trim($NOMBRE_SUS_MOVs);
                      }
                      /*if($NOMBRE_SUS_MOV == "" ){$NOMBRE_SUS_MOV = "NULL";}
        if($NOMBRE_SUS_MOV == "NULL" ){$NOMBRE_SUS_MOV1 = "";}else{$NOMBRE_SUS_MOV1 =     $ver['nom_empsus'];}*/
                      if (isset($ver['rfcsus'])) {
                        $RFCSUS_MOV         = $ver['rfcsus'];
                      }
                      /*if($RFCSUS_MOV == ""){$RFCSUS_MOV = "NULL";}
        if($RFCSUS_MOV == "NULL" ){$RFCSUS_MOV1 = "";}else{$RFCSUS_MOV1 =     $ver['rfcsus'];}*/
                      if (isset($ver['mot_movsus'])) {
                        $MOT_MOVSUS         = $ver['mot_movsus'];
                      }
                      /*if($MOT_MOVSUS == ""){$MOT_MOVSUS = "NULL";}
        if($MOT_MOVSUS == "NULL" ){$MOT_MOVSUS1 = "";}else{$MOT_MOVSUS1 =     $ver['mot_movsus'];}*/
                      if (isset($ver['num_doctosus'])) {
                        $NUM_DOCUMENTOSUS   = $ver['num_doctosus'];
                      }
                      /*if($NUM_DOCUMENTOSUS == ""){$NUM_DOCUMENTOSUS = "NULL";}
        if($NUM_DOCUMENTOSUS == "NULL" ){$NUM_DOCUMENTOSUS1 = "";}else{$NUM_DOCUMENTOSUS1=$ver['num_doctosus'];}*/
                      if (isset($ver['ctnvo'])) {
                        $CT_MOV             = $ver['ctnvo'];
                      }
                      if (isset($ver['nivel_sueldonvo'])) {
                        $NIVEL_SUELDO_NUEVO = $ver['nivel_sueldonvo'];
                      }
                      /*if($NIVEL_SUELDO_NUEVO == ""){$NIVEL_SUELDO_NUEVO = "0";}*/
                      if (isset($ver['descripcion2'])) {
                        $DESCRIPCION1       = $ver['descripcion2'];
                      }
                      if (isset($ver['descripcion1'])) {
                        $DESCRIPCION2       = $ver['descripcion1'];
                      }
                      $DESCRIPCION        = $DESCRIPCION1 . " " . $DESCRIPCION2;
                      if (isset($ver['cons_doc'])) {
                        $CONS_DOC           = $ver['cons_doc'];
                      }
                      if (isset($ver['area'])) {
                        $AREA_PLA           = $ver['area'];
                      }
                      if (isset($ver['num_oficio'])) {
                        $NUM_OFICIO         = $ver['num_oficio'];
                      }
                      if (isset($ver['operador'])) {
                        $OPERADOR           = $ver['operador'];
                      }

                  ?>
                      <tr id="<?php echo $id; ?>">
                        <td id="adds" style="display: none;"><?php echo $id; ?></td>
                        <td id="adds" style="text-align: center; font-size:80%; padding:0px;">
                          <input type="checkbox" id="<?php echo $id; ?>" class="selecheck" value="<?php echo $id; ?>">
                        </td>
                        <td id="tm" style="text-align: center; font-size:80%; padding:0px; "><?php echo $TM ?></td>
                        <td id="mo" style="text-align: center; font-size:80%; padding:0px; "><?php echo $MO ?></td>
                        <td id="pda" style="text-align: center; font-size:80%; padding:0px; "><?php echo $PARTIDA_MOV ?></td>
                        <td id="cps" style="text-align: center; font-size:80%; padding:0px; "><?php echo $CODIGO_PAGO_MOV ?></td>
                        <td id="uns" style="text-align: center; font-size:80%; padding:0px; "><?php echo $UNIDAD_MOV ?></td>
                        <td id="subs" style="text-align: center; font-size:80%; padding:0px; "><?php echo $SUBUNIDAD_MOV ?></td>
                        <td id="cats" style="text-align: center; font-size:80%; padding:0px; "><?php echo $CATEGORIA_MOV ?></td>
                        <td id="hrs" style="text-align: center; font-size:80%; padding:0px; "><?php echo $HORAS_MOV ?></td>
                        <td id="pla" style="text-align: center; font-size:80%; padding:0px; "><?php echo $PLAZA_MOV ?></td>
                        <td id="qinis" style="text-align: center; font-size:80%; padding:0px; "><?php echo $DESDE_MOV ?></td>
                        <td id="qfins" style="text-align: center; font-size:80%; padding:0px; "><?php echo $HASTA_MOV ?></td>
                        <td id="nomsus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $NOMBRE_SUS_MOV; ?></td>
                        <td id="rfcsus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $RFCSUS_MOV; ?></td>
                        <td id="mosus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $MOT_MOVSUS; ?></td>
                        <td id="qinisus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $QNA_INISUS_MOV ?></td>
                        <td id="qfinsus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $QNA_FINSUS_MOV; ?></td>
                        <td id="nds" style="text-align: center; font-size:80%; padding:0px; "><?php echo $NUM_DOCUMENTOSUS; ?></td>
                        <td id="cts" style="text-align: center; font-size:80%; padding:0px; "><?php echo $CT_MOV; ?></td>
                        <td id="nsn" style="text-align: center; font-size:80%; padding:0px; "><?php echo $NIVEL_SUELDO_NUEVO; ?></td>
                        <td id="des" style="text-align: center; font-size:80%; padding:0px; "><?php echo $DESCRIPCION; ?></td>
                        <td id="des" style="display: none;"><?php echo $CONS_DOC; ?></td>
                        <td id="des" style="display: none;"><?php echo $AREA_PLA; ?></td>
                        <td id="des" style="display: none;"><?php echo $NUM_OFICIO; ?></td>
                        <td id="des" style="display: none;"><?php echo $OPERADOR; ?></td>
                      </tr>

                    <?php
                      $id = $id + 1;
                      $b++;
                    } //fin 2do while getDatosPDF_Mov   

                  } else {
                    $tot_resul_mov = count($ver);
                    while ($b < $tot_resul_mov) { //$total_res*30 //2do while getDatosPDF_Mov
                      //if($b == $tot_resul_mov*24){
                      if (isset($ver[$b]['cve_mov'])) {
                        $M                  = $ver[$b]['cve_mov'];
                        $TM                 = str_pad($M, 2, "0", STR_PAD_LEFT);
                      }
                      if (isset($ver[$b]['mot_mov'])) {
                        $MO1                = $ver[$b]['mot_mov']; //10";
                        $MO                 = str_pad($MO1, 2, "0", STR_PAD_LEFT);
                      }
                      if (isset($ver[$b]['partida'])) {
                        $PARTIDA_MOV        = $ver[$b]['partida'];
                      }
                      if (isset($ver[$b]['cod_pago'])) {
                        $CODIGO_PAGO_MOV1   = $ver[$b]['cod_pago'];
                        $CODIGO_PAGO_MOV    = str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
                      }
                      if (isset($ver[$b]['unidad'])) {
                        $UNIDAD_MOV         = $ver[$b]['unidad'];
                      }
                      if (isset($ver[$b]['subunidad'])) {
                        $SUBUNIDAD_MOV      = $ver[$b]['subunidad'];
                      }
                      if (isset($ver[$b]['cat_puesto'])) {
                        if ($ver[$b]['cat_puesto'] == "" || $ver[$b]['cat_puesto'] == " ") {
                          $CATEGORIA_MOV      = $ver[$b]['cat_puesto'];
                        }
                      } else {
                        $CATEGORIA_MOV      = "";
                      }
                      if (isset($ver[$b]['horas'])) {
                        $HORAS_MOV          = $ver[$b]['horas'];
                      }
                      if (isset($ver[$b]['cons_plaza'])) {
                        $numero             = $ver[$b]['cons_plaza'];
                        $PLAZA_MOV          = str_pad($numero, 6, "0", STR_PAD_LEFT);
                      }
                      $DESDE_MOV          = $ver[$b]['qna_ini_emp'];
                      $HASTA_MOV          = $ver[$b]['qna_fin_emp'];
                      if (isset($ver[$b]['qna_inisus'])) {
                        $QNA_INISUS_MOV     = $ver[$b]['qna_inisus'];
                      }
                      /*if($QNA_INISUS_MOV == ""){$QNA_INISUS_MOV = "NULL";}
        if($QNA_INISUS_MOV == "NULL" ){$QNA_INISUS_MOV1 = "";}else{$QNA_INISUS_MOV1 =     $ver[$b]['qna_inisus'];}*/
                      if (isset($ver[$b]['qna_finsus'])) {
                        $QNA_FINSUS_MOV     = $ver[$b]['qna_finsus'];
                      }
                      /*if($QNA_FINSUS_MOV == "NULL" ){$QNA_FINSUS_MOV1 = "";}else{$QNA_FINSUS_MOV1 =     $ver[$b]['qna_finsus'];}
        if($QNA_FINSUS_MOV == ""){$QNA_FINSUS_MOV = "NULL";}*/
                      if (isset($ver[$b]['nom_empsus'])) {
                        $NOMBRE_SUS_MOVs     = $ver[$b]['nom_empsus'];
                        $NOMBRE_SUS_MOV     = trim($NOMBRE_SUS_MOVs);
                      }
                      /*if($NOMBRE_SUS_MOV == "" ){$NOMBRE_SUS_MOV = "NULL";}
        if($NOMBRE_SUS_MOV == "NULL" ){$NOMBRE_SUS_MOV1 = "";}else{$NOMBRE_SUS_MOV1 =     $ver[$b]['nom_empsus'];}*/
                      if (isset($ver[$b]['rfcsus'])) {
                        $RFCSUS_MOV         = $ver[$b]['rfcsus'];
                      }
                      /*if($RFCSUS_MOV == ""){$RFCSUS_MOV = "NULL";}
        if($RFCSUS_MOV == "NULL" ){$RFCSUS_MOV1 = "";}else{$RFCSUS_MOV1 =     $ver[$b]['rfcsus'];}*/
                      if (isset($ver[$b]['mot_movsus'])) {
                        $MOT_MOVSUS         = $ver[$b]['mot_movsus'];
                      }
                      /*if($MOT_MOVSUS == ""){$MOT_MOVSUS = "NULL";}
        if($MOT_MOVSUS == "NULL" ){$MOT_MOVSUS1 = "";}else{$MOT_MOVSUS1 =     $ver[$b]['mot_movsus'];}*/
                      if (isset($ver[$b]['num_doctosus'])) {
                        $NUM_DOCUMENTOSUS   = $ver[$b]['num_doctosus'];
                      }
                      /*if($NUM_DOCUMENTOSUS == ""){$NUM_DOCUMENTOSUS = "NULL";}
        if($NUM_DOCUMENTOSUS == "NULL" ){$NUM_DOCUMENTOSUS1 = "";}else{$NUM_DOCUMENTOSUS1=$ver[$b]['num_doctosus'];}*/
                      if (isset($ver[$b]['ctnvo'])) {
                        $CT_MOV             = $ver[$b]['ctnvo'];
                      }

                      if (isset($ver[$b]['nivel_sueldonvo'])) {
                        $NIVEL_SUELDO_NUEVO = $ver[$b]['nivel_sueldonvo'];
                      }
                      /*if($NIVEL_SUELDO_NUEVO == ""){$NIVEL_SUELDO_NUEVO = "0";}*/
                      if (isset($ver[$b]['descripcion2'])) {
                        $DESCRIPCION1       = $ver[$b]['descripcion2'];
                      }
                      if (isset($ver[$b]['descripcion1'])) {
                        $DESCRIPCION2       = $ver[$b]['descripcion1'];
                      }
                      $DESCRIPCION        = $DESCRIPCION1 . " " . $DESCRIPCION2;
                      if (isset($ver[$b]['cons_doc'])) {
                        $CONS_DOC           = $ver[$b]['cons_doc'];
                      }
                      if (isset($ver[$b]['area'])) {
                        $AREA_PLA           = $ver[$b]['area'];
                      }
                      if (isset($ver[$b]['num_oficio'])) {
                        $NUM_OFICIO         = $ver[$b]['num_oficio'];
                      }
                      if (isset($ver[$b]['operador'])) {
                        $OPERADOR           = $ver[$b]['operador'];
                      }
                    ?>
                      <tr id="<?php echo $id; ?>">
                        <td id="adds" style="display: none;"><?php echo $id; ?></td>
                        <td id="adds" style="text-align: center; font-size:80%; padding:0px;">
                          <input type="checkbox" id="<?php echo $id; ?>" class="selecheck" value="<?php echo $id; ?>">
                        </td>
                        <td id="tm" style="text-align: center; font-size:80%; padding:0px; "><?php echo $TM ?></td>
                        <td id="mo" style="text-align: center; font-size:80%; padding:0px; "><?php echo $MO ?></td>
                        <td id="pda" style="text-align: center; font-size:80%; padding:0px; "><?php echo $PARTIDA_MOV ?></td>
                        <td id="cps" style="text-align: center; font-size:80%; padding:0px; "><?php echo $CODIGO_PAGO_MOV ?></td>
                        <td id="uns" style="text-align: center; font-size:80%; padding:0px; "><?php echo $UNIDAD_MOV ?></td>
                        <td id="subs" style="text-align: center; font-size:80%; padding:0px; "><?php echo $SUBUNIDAD_MOV ?></td>
                        <td id="cats" style="text-align: center; font-size:80%; padding:0px; "><?php echo $CATEGORIA_MOV ?></td>
                        <td id="hrs" style="text-align: center; font-size:80%; padding:0px; "><?php echo $HORAS_MOV ?></td>
                        <td id="pla" style="text-align: center; font-size:80%; padding:0px; "><?php echo $PLAZA_MOV ?></td>
                        <td id="qinis" style="text-align: center; font-size:80%; padding:0px; "><?php echo $DESDE_MOV ?></td>
                        <td id="qfins" style="text-align: center; font-size:80%; padding:0px; "><?php echo $HASTA_MOV ?></td>
                        <td id="nomsus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $NOMBRE_SUS_MOV; ?></td>
                        <td id="rfcsus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $RFCSUS_MOV; ?></td>
                        <td id="mosus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $MOT_MOVSUS; ?></td>
                        <td id="qinisus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $QNA_INISUS_MOV ?></td>
                        <td id="qfinsus" style="text-align: center; font-size:80%; padding:0px; "><?php echo $QNA_FINSUS_MOV; ?></td>
                        <td id="nds" style="text-align: center; font-size:80%; padding:0px; "><?php echo $NUM_DOCUMENTOSUS; ?></td>
                        <td id="cts" style="text-align: center; font-size:80%; padding:0px; "><?php echo $CT_MOV; ?></td>
                        <td id="nsn" style="text-align: center; font-size:80%; padding:0px; "><?php echo $NIVEL_SUELDO_NUEVO; ?></td>
                        <td id="des" style="text-align: center; font-size:80%; padding:0px; "><?php echo $DESCRIPCION; ?></td>
                        <td id="des" style="display: none;"><?php echo $CONS_DOC; ?></td>
                        <td id="des" style="display: none;"><?php echo $AREA_PLA; ?></td>
                        <td id="des" style="display: none;"><?php echo $NUM_OFICIO; ?></td>
                        <td id="des" style="display: none;"><?php echo $OPERADOR; ?></td>
                      </tr>

                  <?php
                      $id = $id + 1;
                      $b++;
                    } //fin 2do while getDatosPDF_Mov   

                  }
                  //var_dump($ver);
                  //echo ($tot_resul_mov*24);


                  ?>
                </tbody>
              </table>
            </div>

          <?php
          } else {
          ?>
            <div id="divTablas" class="table-responsive">
              <table class="table table-striped" id="movs">
                <thead class="thead-dark">
                  <tr>
                    <th><strong>Agregar</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>one</strong></th>
                    <th class="dt-head-center"><strong>TM</strong></th>
                    <th class="dt-head-center"><strong>MO</strong></th>
                    <th class="dt-head-center"><strong>PDA</strong></th>
                    <th class="dt-head-center"><strong>Cod.Pago</strong></th>
                    <th class="dt-head-center"><strong>Unidad</strong></th>
                    <th class="dt-head-center"><strong>Subunidad</strong></th>
                    <th class="dt-head-center"><strong>Puesto</strong></th>
                    <th class="dt-head-center"><strong>Horas</strong></th>
                    <th class="dt-head-center"><strong>Plaza</strong></th>
                    <th class="dt-head-center"><strong>Qna. Ini</strong></th>
                    <th class="dt-head-center"><strong>Qna. Fin</strong></th>

                    <th class="dt-head-center"><strong>Nombre Sus</strong></th>
                    <th class="dt-head-center"><strong>RFC Sus</strong></th>
                    <th class="dt-head-center"><strong>MO Sus</strong></th>
                    <th class="dt-head-center"><strong>Qna Ini Sus</strong></th>
                    <th class="dt-head-center"><strong>Qna Fin Sus</strong></th>
                    <th class="dt-head-center"><strong>Num Docto Sus</strong></th>
                    <th class="dt-head-center"><strong>CT</strong></th>
                    <th class="dt-head-center"><strong>Nvl Sueldo</strong></th>
                    <th class="dt-head-center"><strong>Descripcion</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>Cons_Doc</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>Area</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>Num_Oficio</strong></th>
                    <th class="dt-head-center" style="display: none;"><strong>Operador</strong></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center" colspan="21">Sin Datos</td>
                  </tr>
                </tbody>
              </table>
            </div>
          <?php
          }
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="close">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h1>
            Por favor espere... <br>
            Creando FUP.
          </h1>
        </div>
      </div>
    </div>
  </div>

  <div id="divModal" class="modal-body">
    <h5 class="modal-title" id="exampleModalLabel1">Antecedentes de "<?php echo $var; ?>".</h5>
    <select name="mot_mov1" id="mot_mov1" class="form-control" onchange="mostrar(this.value);">
      <option value="" disabled selected hidden>Seleccionar </option> <!-- selected="yes" -->
      <option value="Todos" id="Todos" style="display: none;">Todos</option>
      <option value="TodosPrueba" id="TodosPrueba" style="display: none;">Todos Prueba</option>
      <option value="TodosSND" id="TodosSND" style="display: none;">Todos Sin Numero Documento</option>
      <!--option value="Temporales"  id="Temporales"  style="display: none;">Temporales</option>
     <option value="Permisos"    id="Permisos"    style="display: none;">Permisos</option>
     <option value="Definitivos" id="Definitivos" style="display: none;">Definitivos</option>
     <option value="Reingreso"   id="Reingreso"   style="display: none;">Reingreso</option-->
      <option value="Historico" id="Historico" style="display: none;">Histórico de Plazas del Movimiento</option>
      <option value="Historico_o" id="Historico_o" style="display: none;">Histórico Otras Plazas</option>
      <option value="Num_Docto" id="Num_Docto" style="display: none;">Por Documento</option>
      <option value="Movimientos" id="Movimientos" style="display: none;">Movimientos</option>
    </select>
    <input type="hidden" name="cve_mov" id="cve_mov" value="<?php echo $cve_mov ?>" />
    <input type="hidden" name="var" id="var" value="<?php echo $var ?>" />
    <input type="hidden" name="mot_mov" id="mot_mov" value="<?php echo $mot_mov ?>" />


    <button type="submit" name="btn_search" class="btn btn-primary btn-sm" id="btn_search" onclick="load()">Ver Registros</button>
    <button type="submit" name="btnGetData" class="btn btn-danger btn-sm" id="btnGetData">Generar FUP Original</button>
    <!--button type = "submit" name="btnGetDataC" class = "btn btn-success btn-sm" id = "btnGetDataC" >Generar FUP Copia</button-->

    <?php
    if ($mot_mov == "31" || $mot_mov == "75") {
    ?>
      <input type="date" name="dia1" class="form-control" placeholder="DIA" id="dia1" maxlength="2" />
      <!--button type = "submit" name="btnGetData2" class = "btn btn-warning btn-sm" id = "btnGetData2" style="display:none;">Generar FUP Con DIA</button-->
      <!--button type = "submit" name="btnGetData2C" class = "btn btn-success btn-sm" id = "btnGetData2C" style="display:none;" >Generar FUP Con DIA Copia</button-->
      <!--button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalM" id="mdal" style="display: none;">Mostrar Plazas Anteriores</button-->
    <?php
    }
    ?>
    <select name="por_movimiento" id="por_movimiento" class="form-control" onchange="mostrar_movs(this.value);" style="display: none;">
      <option value="" disabled selected>Seleccionar </option> <!-- selected="yes" -->
    </select>
    <input type="checkbox" id="plaza_ant" name="plaza_ant" value="0">
    <label for="plaza_ant" id="label_plaza_ant">Mostrar Plaza Anterior</label><br>
    <?php

    $id_consulta = 157;
    $JSON = "[{\"num_docto\":\"$var\"}]";
    $arrayR1 = json_decode(json_encode($JSON), True);
    $params = array('Resultado' => $id_consulta, 'Argumento' => $arrayR1); //para conseguir la consulta
    //var_dump($params);
    $resultadoss = $cliente->getConsulta($params);
    $arrayR3 = json_decode(json_encode($resultadoss), True);
    //var_dump($arrayR3); 
    $xml1 = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
    $json1 = json_encode($xml1);
    $array1 = json_decode($json1, TRUE);
    //var_dump($array1);
    //var_dump($array['NewDataSet']['table']);
    if (!empty($array1)) {

      $ver2 = $array1['NewDataSet']['table'];
      $total_res = count($array1['NewDataSet']['table']);

      $doc_anexa1_a = "";
      $doc_anexa2_a = "";
      $doc_anexa3_a = "";
      $doc_anexa4_a = "";
      $doc_anexa5_a = "";
      $obsrv1_a     = "";
      $obsrv2_a     = "";
      $obsrv3_a     = "";
      $obsrv4_a     = "";
      $obsrv5_a     = "";
      $fec_imp_a    = "";
      //var_dump($ver2);
      //foreach($arrayR3 as $valuess){
      if (isset($ver2["doc_anexa1"])) {

        $doc_anexa1_a1 = trim($ver2["doc_anexa1"]);
        if (strlen($doc_anexa1_a1 == "NULL")) {
          $doc_anexa1_a1 = "";
        } else {
          $doc_anexa1_a1_ = rtrim($doc_anexa1_a1);
          $doc_anexa1_a = htmlspecialchars($doc_anexa1_a1_);
        }
      }
      if (isset($ver2["doc_anexa2"])) {
        $doc_anexa2_a1 = trim($ver2["doc_anexa2"]);
        if ($doc_anexa2_a1 == "NULL") {
          $doc_anexa2_a1_ = "";
        } else {
          $doc_anexa2_a1_ = rtrim($doc_anexa2_a1);
          $doc_anexa2_a = htmlspecialchars($doc_anexa2_a1_);
        }
      }
      //var_dump($ver2["doc_anexa3"]);
      if (isset($ver2["doc_anexa3"])) {
        $doc_anexa3_a1 = trim($ver2["doc_anexa3"]);
        if ($doc_anexa3_a1 == "NULL") {
          $doc_anexa3_a = "";
        } else {
          $doc_anexa3_a2 = rtrim($doc_anexa3_a1);
          $doc_anexa3_a = htmlspecialchars($doc_anexa3_a2);
        }
      }
      if (isset($ver2["doc_anexa4"])) {
        $doc_anexa4_a1 = trim($ver2["doc_anexa4"]);
        if (strlen($doc_anexa4_a1 == "NULL")) {
          $doc_anexa4_a = "";
        } else {
          $doc_anexa4_a2 = rtrim($doc_anexa4_a1);
          $doc_anexa4_a = htmlspecialchars($doc_anexa4_a2);
        }
      }
      if (isset($ver2["doc_anexa5"])) {
        $doc_anexa5_a1 = trim($ver2["doc_anexa5"]);
        if (strlen($doc_anexa5_a1 == "NULL")) {
          $doc_anexa5_a = "";
        } else {
          $doc_anexa5_a2 = rtrim($doc_anexa5_a1);
          $doc_anexa5_a = htmlspecialchars($doc_anexa5_a2);
        }
      }
      if (isset($ver2["obsrv1"])) {
        $obsrv1_a1     = trim($ver2["obsrv1"]);
        if (strlen($obsrv1_a1 == "NULL")) {
          $obsrv1_a = "";
        } else {
          $obsrv1_a2 = rtrim($obsrv1_a1);
          $obsrv1_a = htmlspecialchars($obsrv1_a2);
        }
      }
      if (isset($ver2["obsrv2"])) {
        $obsrv2_a1     = trim($ver2["obsrv2"]);
        if ($obsrv2_a1 == "NULL") {
          $obsrv2_a = "";
        } else {
          $obsrv2_a2 = trim($obsrv2_a1);
          $obsrv2_a = htmlspecialchars($obsrv2_a2);
        }
      }
      if (isset($ver2["obsrv3"])) {
        $obsrv3_a1     = trim($ver2["obsrv3"]);
        if (($obsrv3_a1 == "NULL")) {
          $obsrv3_a = "";
        } else {
          $obsrv3_a2 = rtrim($obsrv3_a1);
          $obsrv3_a = htmlspecialchars($obsrv3_a2);
        }
      }
      if (isset($ver2["obsrv4"])) {
        $obsrv4_a1     = trim($ver2["obsrv4"]);
        if (($obsrv4_a1 == "NULL")) {
          $obsrv4_a = "";
        } else {
          $obsrv4_a2 = rtrim($obsrv4_a1);
          $obsrv4_a = htmlspecialchars($obsrv4_a2);
        }
      }
      if (isset($ver2["fec_imp"])) {
        $fec_imp_a     = $ver2["fec_imp"];
        if ($fec_imp_a == "NULL" || $fec_imp_a == "" || $fec_imp_a == " ") {
          $fec_imp_a = date('Y-m-d');
        } else {
          $fec_imp_a = date('Y-m-d', strtotime($fec_imp_a));
        }
      } else {
        $fec_imp_a = date('Y-m-d');
      }

    ?>
      <!--label id="chec2"> Documentacion Anexa ->:</label-->
      <input type="textarea" id="documentacion1" placeholder="Documentacion Anexa 1" value="<?php echo $doc_anexa1_a; ?>" maxlength="64" style="text-transform:uppercase;">
      <input type="textarea" id="documentacion2" placeholder="Documentacion Anexa 2" value="<?php echo $doc_anexa2_a; ?>" maxlength="64" style="text-transform:uppercase;">
      <input type="textarea" id="documentacion3" placeholder="Documentacion Anexa 3" value="<?php echo $doc_anexa3_a; ?>" maxlength="64" style="text-transform:uppercase;">
      <input type="textarea" id="documentacion4" placeholder="Documentacion Anexa 4" value="<?php echo $doc_anexa4_a; ?>" maxlength="64" style="text-transform:uppercase;">
      <input type="textarea" id="documentacion5" placeholder="Documentacion Anexa 5" value="<?php echo $doc_anexa5_a; ?>" maxlength="64" style="text-transform:uppercase;">
      <!--label id="chec"> Observaciones de Convocatoria ->:</label-->
      <input type="textarea" id="observacion1" placeholder="Observacion 1" value="<?php echo $obsrv1_a; ?>" maxlength="64" style="text-transform:uppercase;">
      <input type="textarea" id="observacion2" placeholder="Observacion 2" value="<?php echo $obsrv2_a; ?>" maxlength="64" style="text-transform:uppercase;">
      <input type="textarea" id="observacion3" placeholder="Observacion 3" value="<?php echo $obsrv3_a; ?>" maxlength="64" style="text-transform:uppercase;">
      <input type="textarea" id="observacion4" placeholder="Observacion 4" value="<?php echo $obsrv4_a; ?>" maxlength="64" style="text-transform:uppercase;">
      <input type="date" id="fec_imp_a" class="form-control" value="<?php echo $fec_imp_a ?>">
      <input type="text" id="por_documento" placeholder="Por Documento" value="" maxlength="10" style="display: none;">

      <br>
      <input type="textarea" id="observacion5" placeholder="¿Porqué se Generó este FUP?" value="" maxlength="64" style="text-transform:uppercase;">
    <?php
      //}
    }
    ?>


    <div id="divTabla" style="height:250px" class="table-responsive">
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th><strong>Agregar</strong></th>
            <th class="dt-head-center cod_pago"><strong>Cod. Pago</strong></th>
            <th class="dt-head-center unidad"><strong>Unidad</strong></th>
            <th class="dt-head-center subunidad"><strong>Subunidad</strong></th>
            <th class="dt-head-center cat_puesto"><strong>Puesto</strong></th>
            <th class="dt-head-center horas"><strong>Horas</strong></th>
            <th class="dt-head-center cons_plaza"><strong>Plaza</strong></th>
            <th class="dt-head-center mot_mov1"><strong>Motivo</strong></th>
            <th class="dt-head-center nivel_sueldo"><strong>Nivel Sueldo</strong></th>
            <th class="dt-head-center qna_ini"><strong>Qna. Inicial</strong></th>
            <th class="dt-head-center qna_fin"><strong>Qna. Fin</strong></th>
            <th class="dt-head-center num_docto"><strong>N°. de Documento</strong></th>
            <th class="dt-head-center ct"><strong>Centro Trabajo</strong></th>
          </tr>
        </thead>
        <tbody id="load_data" class="thead-light">
        </tbody>
      </table>
    </div>

    <!--div id="div2" class = "form-inline"-->
    <div id="divTabla2" style="height:220px" class="table-responsive">
      <table id="tabla2" class="table table-striped">

        <thead class="thead-dark">
          <tr>
            <th class="dt-head-center cod_pago"><strong>Eliminar</strong></th>
            <th class="dt-head-center cod_pago"><strong>Codigo Pago</strong></th>
            <th class="dt-head-center unidad"><strong>Unidad</strong></th>
            <th class="dt-head-center subunidad"><strong>Subunidad</strong></th>
            <th class="dt-head-center cat_puesto"><strong>Puesto</strong></th>
            <th class="dt-head-center horas"><strong>Horas</strong></th>
            <th class="dt-head-center cons_plaza"><strong>Plaza</strong></th>
            <th class="dt-head-center mot_mov1"><strong>Motivo</strong></th>
            <th class="dt-head-center nivel_sueldo"><strong>Nivel Sueldo</strong></th>
            <th class="dt-head-center qna_ini"><strong>Qna. Inicial</strong></th>
            <th class="dt-head-center qna_fin"><strong>Qna. Fin</strong></th>
            <th class="dt-head-center num_docto"><strong>N°. Documento</strong></th>
            <th class="dt-head-center ct"><strong>Centro Trabajo</strong></th>
            <th style="display:none;" class="valor2"><strong>Valor2</strong></th>
          </tr>
        </thead>
        <tbody class="thead-light">
        </tbody>
      </table>
    </div>
  </div>
</body>
<?php
/*-------------------------------------------- cve_mov -----------------------------------------------------------*/
if ($cve_mov == "1" || $cve_mov == "2" || $cve_mov == "4" || $cve_mov == "6" || $cve_mov == "7" || $cve_mov == "10" || $cve_mov == "11" || $cve_mov == "12" || $cve_mov == "17" || $cve_mov == "18" || $cve_mov == "19" || $cve_mov == "30") {
?>
  <script type="text/javascript">
    menu_origenes(1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
  </script>
<?php
}
if ($cve_mov == "3" || $cve_mov == "9" || $cve_mov == "16") {
?>
  <script type="text/javascript">
    menu_origenes(1, 0, 1, 1, 1, 1, 1, 1, 1, 1);
  </script>
<?php
}
?>

</html>
<?php
//}
?>