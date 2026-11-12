<?php
    $usuario= ""; 
    include('../ValidarKey1.php');
    ?>
      <input type="hidden" name="key" id="key" value="<?php echo  $keys;?>" />
      <input type="hidden" name="us" id="usuario" value="<?php echo  $usuario;?>" />
    <?php
  require_once('../Conexion/ServicioWeb.php');  
  //require_once('../Conexion/conexion.php');  
  //include('../Conexion/permisos.php');
  $var = base64_decode($_GET['var']);
  $cve_mov = base64_decode($_GET['cve_mov']);
  $mot_mov = base64_decode($_GET['mot_mov']);
  //$ObjetosPermisos = new Permisos;
  //$menuPrincipal   = $ObjetosPermisos->Menu($app,$usuario,$con);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
    <title>Tabla de Registros</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../Css/tablaAntecedentes7.css?v=<?php echo(rand()); ?>" rel="stylesheet" type="text/css">
    <script src="../Js/ajax2.js?v=<?php echo(rand()); ?>"></script>
    <script>
    window.onload=function() {
        $('#plaza_ant').on('change', function(e){
            if (this.checked) {
               $('#exampleModalM').modal();
            }
        });
    } 
    function cambia_de_pagina(){
        window.close();
    }
    </script> 

<script type="text/javascript">

        function menu_origenes(o1,o2,o3,o4,o5,o6,o7,o8,o9,o10)
        {
        if(o1==1) {   $("#Todos").show();             $('#Todos').removeAttr('disabled');  }  
        if(o1==1) {   $("#Temporales").show();        $('#Temporales').removeAttr('disabled');  }
        if(o2==1) {   $("#Permisos").show();          $('#Permisos').removeAttr('disabled'); }
        if(o3==1) {   $("#Definitivos").show();       $('#Definitivos').removeAttr('disabled');  }
        if(o4==1) {   $("#Reingreso").show();         $('#Reingreso').removeAttr('disabled'); }
        if(o5==1) {   $("#Historico").show();         $('#Historico').removeAttr('disabled');  }
        if(o6==1) {   $("#Historico_o").show();       $('#Historico_o').removeAttr('disabled'); }
        if(o7==1) {   $("#Num_Docto").show();         $('#Num_Docto').removeAttr('disabled'); }
        if(o8==1) {   $("#TodosSND").show();          $('#TodosSND').removeAttr('disabled'); }
        if(o9==1) {   $("#TodosPrueba").show();       $('#TodosPrueba').removeAttr('disabled'); }
        if(o10==1) {  $("#Movimientos").show();       $('#Movimientos').removeAttr('disabled');  }  
        
        }


      $(function () {
        $('#tbody tr').click(function (e) {
          var a = $(this).closest('tr').find('a')
          e.preventDefault()
        })
      })

      $(document).on('click', '.envio', function (event) {
          var hermano=$(this).parent();
          $("#tabla2 tbody").prepend("<tr>\
              <td style='text-align: center; font-size:80%; padding:0px; '><input type='image' src='../Logo/subtract2.png' class='borrar' /></td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(0)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(1)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(2)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(3)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(4)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(5)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(6)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(7)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(8)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(9)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(10)").text()+"</td>\
              <td style='text-align: center; font-size:80%; padding:0px; '>"+hermano.siblings("td:eq(11)").text()+"</td>\
              <td style='display:none;' >"+hermano.siblings("td:eq(12)").text()+"</td>\
              <td style='display:none;'>"+hermano.siblings("td:eq(14)").text()+"</td>\
              <td style='display:none;'>"+hermano.siblings("td:eq(15)").text()+"</td>\
              <td style='display:none;'>"+hermano.siblings("td:eq(16)").text()+"</td>\
              <td style='display:none;'>"+hermano.siblings("td:eq(17)").text()+"</td>\
            </tr>")
      });

      $(document).on('click', '.borrar', function (event) {
            event.preventDefault();
            $(this).closest('tr').remove();
      });

    </script>
        <script>
        function mostrar(id) {
          let va = "<?php echo $var?>";
          if(id == "Num_Docto") {
            $("#por_documento").show(); 
            $("#por_movimiento").hide();
          }else{
            $("#por_documento").hide();
          }     
          if(id == "Movimientos") {
            $.ajax({
              url: 'get_motivos.php',
              type: 'POST',
              dataType: 'json',
              data: {
                var: va
              },
              success: function(motivos) {
                  const $select = $('#por_movimiento');
                      // Recorrido con for
                  for (let i = 0; i < motivos['data'].length; i++) {
                      const motivo_ = motivos['data'][i];
                      $select.append($('<option>', {
                          value: motivo_.id,
                          text: motivo_.nombre
                      }));
                  }
                  $select.show();
              },
              error: function() {
                  alert('No se pudieron cargar los motivos');
              }
          });
          }else{
            $("#por_movimiento").hide();
          }   
        }
        function mostrar_movs(id) {
          //console.log(id);
        }
        </script> 
   <?php
   include "../Scripts/script_Tabla.php";
   ?>
</head>
<body>  
<!-- Aqui va  el codigo para mostrar las plazas de seleccion manual, del archivo plazas_manual.txt --> 

<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
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


<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h1 id="modalMessage"></h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div id="divModal" class="modal-body">
    <h5 class="modal-title" id="exampleModalLabel1">Antecedentes de "<?php echo $var;?>".</h5>
    <select name="mot_mov1" id="mot_mov1" class = "form-control" onchange="mostrar(this.value);">
     <option value="" disabled selected hidden>Seleccionar  </option> <!-- selected="yes" -->
     <option value="Todos"  id="Todos"  style="display: none;">Todos</option>
     <option value="TodosPrueba"  id="TodosPrueba"  style="display: none;">Todos Prueba</option>
     <!--option value="TodosSND"  id="TodosSND"  style="display: none;">Todos Sin Numero Documento</option-->
     <option value="Historico"   id="Historico"   style="display: none;">Histórico de Plazas del Movimiento</option>
     <option value="Historico_o" id="Historico_o" style="display: none;">Histórico Otras Plazas</option>
     <option value="Num_Docto"   id="Num_Docto"   style="display: none;">Por Documento</option>
     <option value="Movimientos"  id="Movimientos"  style="display: none;">Movimientos</option>
    </select>
   <input type="hidden"  name="cve_mov" id = "cve_mov" value="<?php echo $cve_mov?>" />
   <input type="hidden"  name="var" id = "var" value="<?php echo $var?>" />
   <input type="hidden"  name="mot_mov" id = "mot_mov" value="<?php echo $mot_mov?>" />
        
             
    <button type = "submit" name="btn_search" class = "btn btn-primary btn-sm" id = "btn_search" onclick="load()">Ver Registros</button>
    <button type = "submit" name="btnGetData" class = "btn btn-danger btn-sm" id = "btnGetData" >Crear FUP</button>
     
     <?php
   if($mot_mov=="31" || $mot_mov=="75"){
   ?> 
    <input type="date" name="dia1" class = "form-control" placeholder = "DIA" id = "dia1"  maxlength="2" />
    <?php
    }
    ?>
    <select name="por_movimiento" id="por_movimiento" class = "form-control" onchange="mostrar_movs(this.value);" style="display: none;">
      <option value="" disabled selected >Seleccionar  </option> <!-- selected="yes" -->
    </select>
<!--    
    <input type="checkbox" id="plaza_ant" name="plaza_ant" value="0" >
    <label for="plaza_ant" id="label_plaza_ant" >Mostrar Plaza Anterior</label><br>
  -->
<?php
        $id_consulta = 157;
        $JSON="[{\"num_docto\":\"$var\"}]";
        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
        $arrayR3= json_decode(json_encode($resultadoss), True); 
        $xml1 = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
        $json1 = json_encode($xml1);
        $array1 = json_decode($json1,TRUE);
        if(!empty($array1)){
        
          $ver2 = $array1['NewDataSet']['table'];
          $total_res= count($array1['NewDataSet']['table']);         

        $doc_anexa1_a = "";
        $doc_anexa2_a = "";
        $doc_anexa3_a = "";
        $doc_anexa4_a = "";
        $doc_anexa5_a = "";
        $obsrv1_a     = "";
        $obsrv2_a     = "";
        $obsrv3_a     = "";
        $obsrv4_a     = "";
        $fec_imp_a    = "";

        if(isset($ver2["doc_anexa1"])){
          $doc_anexa1_a1 = trim($ver2["doc_anexa1"]); 
          if(strlen($doc_anexa1_a1=="NULL")){
              $doc_anexa1_a1 = "";
            }else{
              $doc_anexa1_a1_ = rtrim($doc_anexa1_a1);
              $doc_anexa1_a = htmlspecialchars($doc_anexa1_a1_);
            }
        }
        if(isset($ver2["doc_anexa2"])){
          $doc_anexa2_a1 = trim($ver2["doc_anexa2"]); 
          if($doc_anexa2_a1=="NULL"){
              $doc_anexa2_a1_ = "";
            }else{
              $doc_anexa2_a1_ = rtrim($doc_anexa2_a1);
              $doc_anexa2_a = htmlspecialchars($doc_anexa2_a1_);
            }
        }
        if(isset($ver2["doc_anexa3"])){
          $doc_anexa3_a1 = trim($ver2["doc_anexa3"]); 
            if($doc_anexa3_a1=="NULL"){
              $doc_anexa3_a = "";
            }else{
              $doc_anexa3_a2 = rtrim($doc_anexa3_a1);
              $doc_anexa3_a = htmlspecialchars($doc_anexa3_a2);
            }
        }
        if(isset($ver2["doc_anexa4"])){
          $doc_anexa4_a1 = trim($ver2["doc_anexa4"]); 
          if(strlen($doc_anexa4_a1=="NULL")){
              $doc_anexa4_a = "";
            }else{
              $doc_anexa4_a2 = rtrim($doc_anexa4_a1);
              $doc_anexa4_a = htmlspecialchars($doc_anexa4_a2);
            }
        }
        if(isset($ver2["doc_anexa5"])){
          $doc_anexa5_a1 = trim($ver2["doc_anexa5"]);
          if(strlen($doc_anexa5_a1=="NULL")){
              $doc_anexa5_a = "";
            }else{
              $doc_anexa5_a2 = rtrim($doc_anexa5_a1);
              $doc_anexa5_a = htmlspecialchars($doc_anexa5_a2);
            }          
        }
        if(isset($ver2["obsrv1"])){
          $obsrv1_a1     = trim($ver2["obsrv1"]);
          if(strlen($obsrv1_a1=="NULL")){
              $obsrv1_a = "";
            }else{
              $obsrv1_a2 = rtrim($obsrv1_a1);
              $obsrv1_a = htmlspecialchars($obsrv1_a2);
            }           
        }
        if(isset($ver2["obsrv2"])){
          $obsrv2_a1     = trim($ver2["obsrv2"]); 
          if($obsrv2_a1 =="NULL"){
            $obsrv2_a = "";
          }else{
            $obsrv2_a2 = trim($obsrv2_a1);
            $obsrv2_a = htmlspecialchars($obsrv2_a2);
          }         
        }
        if(isset($ver2["obsrv3"])){
          $obsrv3_a1     = trim($ver2["obsrv3"]);
          if( ($obsrv3_a1=="NULL")){
             $obsrv3_a = "";
          }else{
            $obsrv3_a2 = rtrim($obsrv3_a1);
            $obsrv3_a = htmlspecialchars($obsrv3_a2);
          }      
        }
        if(isset($ver2["obsrv4"])){  
          $obsrv4_a1     = trim($ver2["obsrv4"]); 
          if( ($obsrv4_a1 == "NULL")){
             $obsrv4_a = "";
          }else{
            $obsrv4_a2 = rtrim($obsrv4_a1);
            $obsrv4_a = htmlspecialchars($obsrv4_a2);
          }       
        } 
        if(isset($ver2["fec_imp"])){
          $fec_imp_a     = $ver2["fec_imp"];
          if($fec_imp_a == "NULL" || $fec_imp_a == "" || $fec_imp_a == " "){
            $fec_imp_a = date('Y-m-d');
          }else{
            $fec_imp_a = date('Y-m-d', strtotime($fec_imp_a));
          }
        }else{
          $fec_imp_a = date('Y-m-d');
        }

?>
<input type="textarea" id="documentacion1" placeholder="Documentacion Anexa 1" value="<?php echo $doc_anexa1_a; ?>" maxlength="64" style="text-transform:uppercase;" autocomplete="on">
<input type="textarea" id="documentacion2" placeholder="Documentacion Anexa 2" value="<?php echo $doc_anexa2_a; ?>" maxlength="64" style="text-transform:uppercase;" autocomplete="on">
<input type="textarea" id="documentacion3" placeholder="Documentacion Anexa 3" value="<?php echo $doc_anexa3_a; ?>" maxlength="64" style="text-transform:uppercase;" autocomplete="on">
<input type="textarea" id="documentacion4" placeholder="Documentacion Anexa 4" value="<?php echo $doc_anexa4_a; ?>" maxlength="64" style="text-transform:uppercase;" autocomplete="on">
<input type="textarea" id="documentacion5" placeholder="Documentacion Anexa 5" value="<?php echo $doc_anexa5_a; ?>" maxlength="64" style="text-transform:uppercase;" autocomplete="on">
<input type="textarea" id="observacion1" placeholder="Observacion 1" value="<?php echo $obsrv1_a; ?>" maxlength="64" style="text-transform:uppercase;" autocomplete="on">
<input type="textarea" id="observacion2" placeholder="Observacion 2" value="<?php echo $obsrv2_a; ?>" maxlength="64" style="text-transform:uppercase;" autocomplete="on">
<input type="textarea" id="observacion3" placeholder="Observacion 3" value="<?php echo $obsrv3_a; ?>" maxlength="64" style="text-transform:uppercase;" autocomplete="on">
<input type="textarea" id="observacion4" placeholder="Observacion 4" value="<?php echo $obsrv4_a; ?>" maxlength="64" style="text-transform:uppercase;" autocomplete="on">
<input type="date" id="fec_imp_a" class = "form-control" value="<?php echo $fec_imp_a ?>">
<input type="text" id="por_documento" placeholder="Por Documento" value="" maxlength="10" style="display: none;">
<?php
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
        if($cve_mov == "1" || $cve_mov == "2" || $cve_mov == "4" || $cve_mov == "6" || $cve_mov == "7" || $cve_mov == "10" || $cve_mov == "11" || $cve_mov == "12" || $cve_mov == "17" || $cve_mov == "18" || $cve_mov == "30")
        {
          ?>
          <script type="text/javascript">menu_origenes(1,1,1,1,1,1,1,1,1,1);</script>
          <?php
        }
        if($cve_mov == "3" || $cve_mov == "9" || $cve_mov == "16")
        {
          ?>
          <script type="text/javascript">menu_origenes(1,0,1,1,1,1,1,1,1,1);</script>
          <?php
        }
?>
</html>
<?php
  ?>