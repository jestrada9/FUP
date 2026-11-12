<?php
try{ 
  require_once('Conexion/wsdl.php');
  $usuario= ""; 
  $app= ""; 
  include('ValidarKey3.php');
  require_once('Conexion/conexion.php');  
  include('Conexion/permisos.php');
  $ObjetosPermisos = new Permisos;
  $menuPrincipal   = $ObjetosPermisos->Menu($app,$usuario,$con);
?>      
<!DOCTYPE html>
  <html lang = "es">
  <head>
  <title>Formato Único Personal - FUP</title>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/> 
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">  
  <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">     
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="Js/Numeros.js"></script>
  <script src="Js/Modals_index.js"></script>
  <script src="Js/Scripsma50.js"></script>
  <script src="Js/Scrips49.js"></script>
  <script src="Js/ScripsR8.js"></script>
  <script src="Js/validacion.js"></script>
  <script src="Js/func8.js"></script> 
  <script src="Js/funciones_index2.js"></script>
  <script src="Js/Num_Documento_Index_ma.js"></script>
  <script src="Js/enviar_ma4.js"></script>
  <script src="Js/enviar6.js"></script>
<script type="text/javascript">
  $(document).ready(function () {


  $('#p_inicio').click(function() {
      $("#fup").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $('#auto_fup_autorizado').hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide(); 
      $("#auto_rAut").hide();  
      $("#fupma").hide();   
      $('#num_oficio1ma').hide();
      $('#num_oficio1ma').val("");
      $('#rfc1ma').hide();
      $('#rfc1ma').val("");
      $('#labelma').hide();
      $('#rfc_num_doctoma').hide();
      $('#rfc_num_doctoma').prop('selectedIndex',0);
      $('#captura1ma').hide();
      $('#captura1ma').val("");
      $('#fec_captura1ma').hide();
      $('#fec_captura1ma').val("");
      $('#fec_cancelacion1ma').hide();
      $('#fec_cancelacion1ma').val("");
      $('#plaza1ma').hide();
      $('#plaza1ma').val("");
      $('#plaza2ma').hide();
      $('#plaza2ma').val("");
      $('#plaza3ma').hide();
      $('#plaza3ma').val("");
      $('#plaza4ma').hide();
      $('#plaza4ma').val("");
      $('#plaza5ma').hide();
      $('#plaza5ma').val("");
      $('#plaza6ma').hide();
      $('#plaza6ma').val("");      
      $('#buscar6ma').hide();
      $('#buscar6ma').val("");
      $('#estatus1ma').hide();
      $('#estatus1ma').val("");
      $('#relacion2ma').hide();
      $('#relacion2ma').val("");
      $('#curp1ma').hide();
      $('#curp1ma').val("");
      $('#num_docto1ma').hide();
      $('#num_docto1ma').val("");
      $('#formulario_ma').trigger("reset");
      $("#auto_crearfup_ct_90").hide();
      $("#inicio").show();
    }); 

  $('#p_fup').click(function() {
      $("#inicio").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $('#auto_fup_autorizado').hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide();  
      $("#auto_rAut").hide();    
      $("#fupma").hide();
      $('#num_oficio1').hide();
      $('#num_oficio1').val("");
      $('#rfc1').hide();
      $('#rfc1').val("");
      $('#label').hide();
      $('#rfc_num_docto').hide();
      $('#rfc_num_docto').prop('selectedIndex',0);
      $('#captura1').hide();
      $('#captura1').val("");
      $('#fec_captura1').hide();
      $('#fec_captura1').val("");
      $('#fec_cancelacion1').hide();
      $('#fec_cancelacion1').val("");
      $('#plaza1').hide();
      $('#plaza1').val("");
      $('#plaza2').hide();
      $('#plaza2').val("");
      $('#plaza3').hide();
      $('#plaza3').val("");
      $('#plaza4').hide();
      $('#plaza4').val("");
      $('#plaza5').hide();
      $('#plaza5').val("");
      $('#plaza6').hide("");
      $('#plaza6').val("");
      $('#buscar6').hide();
      $('#buscar6').val("");
      $('#estatus1').hide();
      $('#estatus1').val("");
      $('#relacion2').hide();
      $('#relacion2').val("");
      $('#curp1').hide();
      $('#curp1').val("");
      $('#num_docto1').hide();
      $('#num_docto1').val("");
      $("#nomEmp1").hide();
      $('#nomEmp1').val("");      
      $('#formulario').trigger("reset");
      $("#auto_crearfup_ct_90").hide();
      $("#fup").show();
    });  

  $('#p_fupma').click(function() {
      $("#fup").hide();
      $("#inicio").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $("#auto_fup_autorizado").hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide();
      $("#auto_rAut").hide();
      $('#num_oficio1ma').hide();
      $('#num_oficio1ma').val("");
      $('#rfc1ma').hide();
      $('#rfc1ma').val("");
      $('#labelma').hide();
      $('#rfc_num_doctoma').hide();
      $('#rfc_num_doctoma').prop('selectedIndex',0);
      $('#captura1ma').hide();
      $('#captura1ma').val("");
      $('#fec_captura1ma').hide();
      $('#fec_captura1ma').val("");
      $('#fec_cancelacion1ma').hide();
      $('#fec_cancelacion1ma').val("");
      $('#plaza1ma').hide();
      $('#plaza1ma').val("");
      $('#plaza2ma').hide();
      $('#plaza2ma').val("");
      $('#plaza3ma').hide();
      $('#plaza3ma').val("");
      $('#plaza4ma').hide();
      $('#plaza4ma').val("");
      $('#plaza5ma').hide();
      $('#plaza5ma').val("");
      $('#plaza6ma').hide();
      $('#plaza6ma').val("");
      $('#estatus1ma').hide();
      $('#estatus1ma').val("");
      $('#relacion2ma').hide();
      $('#relacion2ma').val("");
      $('#curp1ma').hide();
      $('#curp1ma').val("");
      $('#num_docto1ma').hide();
      $('#num_docto1ma').val("");
      $("#nomEmp1m").hide();
      $('#nomEmp1m').val("");    
      $('#formulario_ma').trigger("reset");    
      $("#auto_crearfup_ct_90").hide();  
      $("#fupma").show();
    });  
    $('#p_crearfup_ct').click(function() {
      $("#fup").hide();
      $("#inicio").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $("#auto_fup_autorizado").hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide();
      $("#auto_rAut").hide();
      $('#num_oficio1ma').hide();
      $('#num_oficio1ma').val("");
      $('#rfc1ma').hide();
      $('#rfc1ma').val("");
      $('#labelma').hide();
      $('#rfc_num_doctoma').hide();
      $('#rfc_num_doctoma').prop('selectedIndex',0);
      $('#captura1ma').hide();
      $('#captura1ma').val("");
      $('#fec_captura1ma').hide();
      $('#fec_captura1ma').val("");
      $('#fec_cancelacion1ma').hide();
      $('#fec_cancelacion1ma').val("");
      $('#plaza1ma').hide();
      $('#plaza1ma').val("");
      $('#plaza2ma').hide();
      $('#plaza2ma').val("");
      $('#plaza3ma').hide();
      $('#plaza3ma').val("");
      $('#plaza4ma').hide();
      $('#plaza4ma').val("");
      $('#plaza5ma').hide();
      $('#plaza5ma').val("");
      $('#plaza6ma').hide();
      $('#plaza6ma').val("");
      $('#estatus1ma').hide();
      $('#estatus1ma').val("");
      $('#relacion2ma').hide();
      $('#relacion2ma').val("");
      $('#curp1ma').hide();
      $('#curp1ma').val("");
      $('#num_docto1ma').hide();
      $('#num_docto1ma').val("");
      $("#nomEmp1m").hide();
      $('#nomEmp1m').val("");    
      $('#formulario_ma').trigger("reset");      
      $("#fupma").hide();
      $("#auto_crearfup_ct_90").hide();
      $("#auto_crearfup_ct").show();
      $('#auto_crearfup_ct_').attr('src', "pantallas/FUP_CambioCT.php?usuario=<?php echo $usuario; ?>");
    });
      $('#p_crearfup_ct_90').click(function() {
      $("#fup").hide();
      $("#inicio").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $("#auto_fup_autorizado").hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide();
      $("#auto_rAut").hide();
      $('#num_oficio1ma').hide();
      $('#num_oficio1ma').val("");
      $('#rfc1ma').hide();
      $('#rfc1ma').val("");
      $('#labelma').hide();
      $('#rfc_num_doctoma').hide();
      $('#rfc_num_doctoma').prop('selectedIndex',0);
      $('#captura1ma').hide();
      $('#captura1ma').val("");
      $('#fec_captura1ma').hide();
      $('#fec_captura1ma').val("");
      $('#fec_cancelacion1ma').hide();
      $('#fec_cancelacion1ma').val("");
      $('#plaza1ma').hide();
      $('#plaza1ma').val("");
      $('#plaza2ma').hide();
      $('#plaza2ma').val("");
      $('#plaza3ma').hide();
      $('#plaza3ma').val("");
      $('#plaza4ma').hide();
      $('#plaza4ma').val("");
      $('#plaza5ma').hide();
      $('#plaza5ma').val("");
      $('#plaza6ma').hide();
      $('#plaza6ma').val("");
      $('#estatus1ma').hide();
      $('#estatus1ma').val("");
      $('#relacion2ma').hide();
      $('#relacion2ma').val("");
      $('#curp1ma').hide();
      $('#curp1ma').val("");
      $('#num_docto1ma').hide();
      $('#num_docto1ma').val("");
      $("#nomEmp1m").hide();
      $('#nomEmp1m').val("");    
      $('#formulario_ma').trigger("reset");      
      $("#fupma").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_90").show();
      $('#auto_crearfup_ct_90_').attr('src', "pantallas/FUP_CambioCT90.php?usuario=<?php echo $usuario; ?>");
    });
  $('#p_crearfup_ct_P').click(function() {
      $("#fup").hide();
      $("#inicio").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $("#auto_fup_autorizado").hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide();
      $("#auto_rAut").hide();
      $('#num_oficio1ma').hide();
      $('#num_oficio1ma').val("");
      $('#rfc1ma').hide();
      $('#rfc1ma').val("");
      $('#labelma').hide();
      $('#rfc_num_doctoma').hide();
      $('#rfc_num_doctoma').prop('selectedIndex',0);
      $('#captura1ma').hide();
      $('#captura1ma').val("");
      $('#fec_captura1ma').hide();
      $('#fec_captura1ma').val("");
      $('#fec_cancelacion1ma').hide();
      $('#fec_cancelacion1ma').val("");
      $('#plaza1ma').hide();
      $('#plaza1ma').val("");
      $('#plaza2ma').hide();
      $('#plaza2ma').val("");
      $('#plaza3ma').hide();
      $('#plaza3ma').val("");
      $('#plaza4ma').hide();
      $('#plaza4ma').val("");
      $('#plaza5ma').hide();
      $('#plaza5ma').val("");
      $('#plaza6ma').hide();
      $('#plaza6ma').val("");
      $('#estatus1ma').hide();
      $('#estatus1ma').val("");
      $('#relacion2ma').hide();
      $('#relacion2ma').val("");
      $('#curp1ma').hide();
      $('#curp1ma').val("");
      $('#num_docto1ma').hide();
      $('#num_docto1ma').val("");
      $("#nomEmp1m").hide();
      $('#nomEmp1m').val("");    
      $('#formulario_ma').trigger("reset");      
      $("#fupma").hide();
      $("#auto_crearfup_ct_90").hide();
      $("#auto_crearfup_ct_P").show();
      $('#auto_crearfup_ct__P').attr('src', "pantallas/FUP_CambioCT_Pendientes.php?usuario=<?php echo $usuario; ?>");
    });   
 
  $('#p_captura').click(function() {
      $("#fup").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#inicio").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $('#auto_fup_autorizado').hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide(); 
      $("#auto_rAut").hide();    
      $("#fupma").hide(); 
      $("#auto_crearfup_ct_90").hide();
      $("#auto_captura").show();
      $('#auto_captura_').attr('src', "pantallas/Pendientes_Paty.php?usuario=<?php echo $usuario; ?>");
    }); 

  $('#p_cgrh').click(function() {
      $("#fup").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#inicio").hide();
      $("#auto_captura").hide();
      $("#auto_admin").hide();
      $('#auto_fup_autorizado').hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide(); 
      $("#auto_rAut").hide(); 
      $("#fupma").hide();    
      $("#auto_crearfup_ct_90").hide();
      $("#auto_cgrh").show();
      $('#auto_cgrh_').attr('src', "pantallas/Pendientes_Maestra_Guadalupe.php?usuario=<?php echo $usuario; ?>");
    }); 

  $('#p_admin').click(function() {
      $("#fup").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#inicio").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $('#auto_fup_autorizado').hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide(); 
      $("#auto_rAut").hide();   
      $("#fupma").hide();  
      $("#auto_crearfup_ct_90").hide();
      $("#auto_admin").show();
      $('#auto_admin_').attr('src', "pantallas/Pendientes_Directora.php?usuario=<?php echo $usuario; ?>");
    });
  $('#p_fup_autorizado').click(function() {
      $("#fup").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#inicio").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide(); 
      $("#auto_rAut").hide();     
      $("#fupma").hide();
      $("#auto_crearfup_ct_90").hide();
      $("#auto_fup_autorizado").show();
      $('#auto_fup_autorizado_').attr('src', "pantallas/Fups_Autorizados.php?usuario=<?php echo $usuario; ?>");
    });
  $('#p_rOriginal').click(function() {
      $("#fup").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#inicio").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $("#auto_fup_autorizado").hide();
      $("#auto_FAutorizado4").hide(); 
      $("#auto_rAut").hide();   
      $("#fupma").hide();  
      $("#auto_crearfup_ct_90").hide();
      $("#auto_rOriginal").show();
      $('#auto_rOriginal_').attr('src', "pantallas/Reimpresion_Original.php?usuario=<?php echo $usuario; ?>");
    }); 
  $('#p_FAutorizado4').click(function() {
      $("#fup").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#inicio").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $("#auto_fup_autorizado").hide();
      $("#auto_rOriginal").hide();
      $("#auto_rAut").hide();
      $("#fupma").hide();
      $("#auto_crearfup_ct_90").hide();
      $("#auto_FAutorizado4").show();
      $('#auto_FAutorizado4_').attr('src', "pantallas/Fups_Autorizados_ID4.php?usuario=<?php echo $usuario; ?>");
    }); 
  $('#p_rAut').click(function() {
      $("#fup").hide();
      $("#auto_crearfup_ct").hide();
      $("#auto_crearfup_ct_P").hide();
      $("#inicio").hide();
      $("#auto_captura").hide();
      $("#auto_cgrh").hide();
      $("#auto_admin").hide();
      $("#auto_fup_autorizado").hide();
      $("#auto_rOriginal").hide();
      $("#auto_FAutorizado4").hide();
      $("#fupma").hide();
      $("#auto_crearfup_ct_90").hide();
      $("#auto_rAut").show();
      $('#auto_rAut_').attr('src', "pantallas/Reporte_Autorizados.php?usuario=<?php echo $usuario; ?>");
    });   
/*  
  $('#cerrar').click(function() {
    location.replace(this.href);
  });
*/
 });

</script>

  <!--link rel="shortcut icon" href="Logo/favicon.ico" type="image/x-icon" /-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="Css/css_index34.css" rel="stylesheet"/>
  <script type="text/javascript">

$(document).ready(function() {

  let url = window.location.href;
  const tabs = ["p_inicio_li", "p_fup_li", "p_captura_li", "p_cgrh_li", "p_admin_li", "p_admin_li","p_rOriginal_li","p_FAutorizado4_li","p_fup_autorizado_li","p_CS_li","p_rAut_li","p_fupma_li","p_crearfup_ct_li","p_crearfup_ct_li_P","p_crearfup_ct_90_li"];
  $(".nav-item").on('click', function(event) {
    var este = "#"+this.id;

    tabs.forEach(e => {
      if ("#"+e==este) {
        setActive("#" + e);
      }else{//else
        setNoActive("#" + e);
      }//else
    });
  });
 
});
// Funcion que asigna la clase active
function setActive(id) {
  if("#p_inicio_li"!=id){
    $(id).attr("class", "nav-item active");
  }
}
function setNoActive(id) {
    $(id).attr("class", "nav-item");
}
    function close_tab_window() {
      //window.open('http://cgia.seslp.gob.mx/ISCC/Default2.aspx','_blank').close();
      //window.open('http://cgia.seslp.gob.mx/ISCC/Default2.aspx','_blank').close();
      //window.open('','_blank').close();
      //window.close('');
      //return false;
    }
  </script>
  </head>
  <img id="img2"/>
<body>
  
  <!--av id="nav" class="navbar navbar-expand-sm justify-content-center navbar-custom navbar-fixed-top"-->
<nav id="nav" class="navbar navbar-expand-lg py-md-1 navbar-dark bg-dark">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>    

  <div class="collapse navbar-collapse justify-content-center" id="navbarTogglerDemo02">
    <ul class="navbar-nav "> 
      <li class="nav-item" id="p_inicio_li">
        <a class="navbar-brand" id="p_inicio" href="#inicio">INICIO</a>
      </li>     
    <?php
    if ($usuario!="Paty" && $usuario!="Jonathan") {
      
  foreach($menuPrincipal as $key => $val) { 
    if($val=="Autorizacion_FUP    "){
  ?>
      <li class="nav-item" id="p_fup_li">
        <a class="navbar-brand" id="p_fup" href="#fup">FUP</a>
      </li>     
  <?php
      }
    }
  foreach($menuPrincipal as $key => $val) { 
    if($val=="FUP_Manual          "){
  ?>
      <li class="nav-item" id="p_fupma_li">
        <a class="navbar-brand" id="p_fupma" href="#fupma">FUP Manual</a>
      </li>     
  <?php
      }
    }    
  foreach($menuPrincipal as $key => $val) {    
      if($val=="CrearFUP_CambioCT   "){
  ?>    
      <li class="nav-item" id="p_crearfup_ct_li">
        <a class="navbar-brand" id="p_crearfup_ct" href="#auto_crearfup_ct_">FUP CAMBIO CT</a>
      </li>
  <?php
      }     
    }     
    foreach($menuPrincipal as $key => $val) {    
      if($val=="CrearFUP_CambioCT   "){
  ?>    
      <li class="nav-item" id="p_crearfup_ct_90_li">
        <a class="navbar-brand" id="p_crearfup_ct_90" href="#auto_crearfup_ct_90_">FUP CCT 90</a>
      </li>
      
  <?php
      }     
    } 
  foreach($menuPrincipal as $key => $val) {    
      if($val=="CrearFUP_CCT_Pendien"){
  ?>    
      <li class="nav-item" id="p_crearfup_ct_li_P">
        <a class="navbar-brand" id="p_crearfup_ct_P" href="#auto_crearfup_ct__P">FUP CCT Pendientes</a>
      </li>
  <?php
      }     
    }      
  foreach($menuPrincipal as $key => $val) {    
      if($val=="Autorizacion_Captura"){
  ?>    
      <li class="nav-item" id="p_captura_li">
        <a class="navbar-brand" id="p_captura" href="#auto_captura_">REVISIÓN CAPTURA</a>
      </li>
  <?php
      }     
    }    
  foreach($menuPrincipal as $key => $val) {     
      if($val=="Autorizacion_Cgrh   "){
  ?>  
      <li class="nav-item" id="p_cgrh_li">
        <a class="navbar-brand" id="p_cgrh" href="#auto_cgrh_">AUTORIZACIÓN CGRH</a>
      </li>
  <?php
      }
    }
  foreach($menuPrincipal as $key => $val) {     
      if($val=="Autorizacion_Admin  "){
  ?>  
      <li class="nav-item"  id="p_admin_li">
        <a class="navbar-brand" id="p_admin" href="#auto_admin_">AUTORIZACIÓN ADMIN</a>
      </li>
  <?php
      }
    } 
      if($usuario=="Paty"){
  ?>  
      <li class="nav-item"  id="p_admin_li">
        <a class="navbar-brand" id="p_admin" href="#auto_admin_">AUTORIZACIÓN ADMIN</a>
      </li>
  <?php
      }
  foreach($menuPrincipal as $key => $val) {     
      if($val=="Impresion_Original  "){
  ?>    
       <li class="nav-item" id="p_fup_autorizado_li">
        <a class="navbar-brand" id="p_fup_autorizado" href="#auto_fup_autorizado_">FUP´S PARA AUTORIZAR</a>
      </li>
  <?php
      }       
  }    
  foreach($menuPrincipal as $key => $val) {    
      if($val=="Reimpresion_Original"){
  ?>    
      <li class="nav-item" id="p_rOriginal_li">
        <a class="navbar-brand" id="p_rOriginal" href="#auto_rOriginal_">REIMPRESION ORIGINAL</a>
      </li> 
  <?php
      }     
    }    
  foreach($menuPrincipal as $key => $val) {    
      if($val=="Reporte_Autorizar   "){
  ?>    
      <li class="nav-item" id="p_rAut_li">
        <a class="navbar-brand" id="p_rAut" href="#auto_rAut_">REPORTE AUT.</a>
      </li> 
  <?php
      }     
    } 
    }else{

      ?> 
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          OPCIONES
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
               <?php
  foreach($menuPrincipal as $key => $val) { 
    if($val=="Autorizacion_FUP    "){
  ?>
      <!--li class="nav-item" id="p_fup_li"-->
        <a class="dropdown-item" id="p_fup" href="#fup">FUP</a>
      <!--/li-->     
  <?php
      }
    }
  foreach($menuPrincipal as $key => $val) { 
    if($val=="FUP_Manual          "){
  ?>
      <!--li class="nav-item" id="p_fupma_li"-->
        <a class="dropdown-item" id="p_fupma" href="#fupma">FUP Manual</a>
      <!--/li-->     
  <?php
      }
    }    
  foreach($menuPrincipal as $key => $val) {    
      if($val=="CrearFUP_CambioCT   "){
  ?>    
      <!--li class="nav-item" id="p_crearfup_ct_li"-->
        <a class="dropdown-item" id="p_crearfup_ct" href="#auto_crearfup_ct_">FUP CAMBIO CT</a>
      <!--/li-->
  <?php
      }     
    }     
    foreach($menuPrincipal as $key => $val) {    
      if($val=="CrearFUP_CambioCT   "){
  ?>    
      <!--li class="nav-item" id="p_crearfup_ct_90_li"-->
        <a class="dropdown-item" id="p_crearfup_ct_90" href="#auto_crearfup_ct_90_">FUP CCT 90</a>
      <!--/li-->
      
  <?php
      }     
    } 
  foreach($menuPrincipal as $key => $val) {    
      if($val=="CrearFUP_CCT_Pendien"){
  ?>    
      <!--li class="nav-item" id="p_crearfup_ct_li_P"-->
        <a class="dropdown-item" id="p_crearfup_ct_P" href="#auto_crearfup_ct__P">FUP CCT Pendientes</a>
      <!--/li-->
  <?php
      }     
    }      
  foreach($menuPrincipal as $key => $val) {    
      if($val=="Autorizacion_Captura"){
  ?>    
      <!--li class="nav-item" id="p_captura_li"-->
        <a class="dropdown-item" id="p_captura" href="#auto_captura_">REVISIÓN CAPTURA</a>
      <!--/li-->
  <?php
      }     
    }    
  foreach($menuPrincipal as $key => $val) {     
      if($val=="Autorizacion_Cgrh   "){
  ?>  
      <!--li class="nav-item" id="p_cgrh_li"-->
        <a class="dropdown-item" id="p_cgrh" href="#auto_cgrh_">AUTORIZACIÓN CGRH</a>
      <!--/li-->
  <?php
      }
    }
  foreach($menuPrincipal as $key => $val) {     
      if($val=="Autorizacion_Admin  "){
  ?>  
      <!--li class="nav-item"  id="p_admin_li"-->
        <a class="dropdown-item" id="p_admin" href="#auto_admin_">AUTORIZACIÓN ADMIN</a>
      <!--/li-->
  <?php
      }
    } 
      if($usuario=="Paty"){
  ?>  
      <!--li class="nav-item"  id="p_admin_li"-->
        <a class="dropdown-item" id="p_admin" href="#auto_admin_">AUTORIZACIÓN ADMIN</a>
      <!--/li-->
  <?php
      }
  foreach($menuPrincipal as $key => $val) {     
      if($val=="Impresion_Original  "){
  ?>    
       <!--li class="nav-item" id="p_fup_autorizado_li"-->
        <a class="dropdown-item" id="p_fup_autorizado" href="#auto_fup_autorizado_">FUP´S PARA AUTORIZAR</a>
      <!--/li-->
  <?php
      }       
  }    
  foreach($menuPrincipal as $key => $val) {    
      if($val=="Reimpresion_Original"){
  ?>    
      <!--li class="nav-item" id="p_rOriginal_li"-->
        <a class="dropdown-item" id="p_rOriginal" href="#auto_rOriginal_">REIMPRESION ORIGINAL</a>
      <!--/li--> 
  <?php
      }     
    }    
  foreach($menuPrincipal as $key => $val) {    
      if($val=="Reporte_Autorizar   "){
  ?>    
      <!--li class="nav-item" id="p_rAut_li"-->
        <a class="dropdown-item" id="p_rAut" href="#auto_rAut_">REPORTE AUT.</a>
      <!--/li--> 
  <?php
      }     
    }    
    }   
?>
        </div>
      </li>

      <li class="nav-item" id="p_CS_li">
        <a class="navbar-brand" id="cerrar" href="http://cgia.seslp.gob.mx/ISCC/Default2.aspx"></a>
      </li>
    </ul>
  </div>
  
  </nav>  

  <div id="inicio" >
     <h2>FORMATO ÚNICO PERSONAL</h2>
        <label  name="labs2"   id="labs2" ><?php echo "Bienvenido/a: ".$usuario;?></label>
  </div>
  <div id="auto_crearfup_ct" style="display: none;">
    <iframe  name="auto_crearfup_ct_" id="auto_crearfup_ct_"></iframe>
  </div>
  <div id="auto_crearfup_ct_90" style="display: none;">
    <iframe  name="auto_crearfup_ct_90_" id="auto_crearfup_ct_90_"></iframe>
  </div>
  <div id="auto_crearfup_ct_P" style="display: none;">
    <iframe  name="auto_crearfup_ct__P" id="auto_crearfup_ct__P"></iframe>
  </div>
  <div id="auto_captura" style="display: none;">
    <iframe  name="auto_captura_" id="auto_captura_"></iframe>
  </div>
  <div id="auto_cgrh" style="display: none;">
    <iframe  name="auto_cgrh_" id="auto_cgrh_"></iframe>
  </div>
  <div id="auto_admin" style="display: none;">
    <iframe  name="auto_admin_" id="auto_admin_"></iframe>
  </div>
  <div id="auto_fup_autorizado" style="display: none;">
    <iframe  name="auto_fup_autorizado_" id="auto_fup_autorizado_"></iframe>
  </div>
  <div id="auto_rOriginal" style="display: none;">
    <iframe  name="auto_rOriginal_" id="auto_rOriginal_"></iframe>
  </div>  
  <div id="auto_FAutorizado4" style="display: none;">
    <iframe  name="auto_FAutorizado4_" id="auto_FAutorizado4_"></iframe>
  </div>   
  <div id="auto_rAut" style="display: none;">
    <iframe  name="auto_rAut_" id="auto_rAut_"></iframe>
  </div>   
<div id="fupma" style="display: none;">
      <section class = "row-fluid">
      <section class = "col-sm-20">
      <section class="panel-heading">
        <form id="formulario_ma" name="formulario_ma" method="POST" class="needs-validation" novalidate>
        <?php echo "Bienvenido/a: "; ?> 
          <label  name="labsma"   id="labsma" ><?php echo $usuario;?></label>
          <h1>FORMATO ÚNICO PERSONAL</h1>
        <?php
          foreach($menuPrincipal as $key => $val) { 
        if($val=="Buscar_Documento    "){

        ?>
        <label id="buscrma">BUSCAR POR:</label>
        <select id="descripcionma" name="descripcionma" class = "form-control" onchange="mostrarSma(this.value);" required >
          <option value="" disabled selected hidden>Selecciona Uno...</option>
          <option id="num_oficioma" name="num_oficioma" value="num_oficioma" >NUMERO DE PROPUESTA</option>
          <option id="num_doctoma" name="num_doctoma" value="num_doctoma">NUMERO DE DOCUMENTO</option>
          <option id="rfcma" name="rfcma" value="rfcma">FILIACION</option>
          <option id="capturama" name="capturama" value="capturama">CAPTURA</option>
          <option id="fec_capturama" name="fec_capturama" value="fecha_capturama">FECHA CAPTURA</option>
          <option id="fec_cancelacionma" name="fec_cancelacionma" value="fecha_cancelacionma">FECHA CANCELACION</option>
          <option id="plazama" name="plazama" value="plazasma">PLAZA</option>
          <option id="estatusma" name="estatusma" value="estatusma">ESTATUS</option>
          <option id="relacion1ma" name="relacion1ma" value="relacion_oficioma">RELACION OFICIO</option>
          <option id="curpma" name="curpma" value="curpma">CURP</option>
        </select>
        <input type="text" name="num_oficio1ma" class="form-control" placeholder="NUM. DE PROPUESTA" id="num_oficio1ma" style="display: none;"  onkeypress="return numeros(event)" autofocus required />
        <input type="text" name="num_docto1ma" class="form-control" placeholder="NUM. DE DOCUMENTO" id="num_docto1ma" style="display: none;" onkeypress="return numeros(event) " required autofocus maxlength="10" />
        <input type="text" name="rfc1ma" class = "form-control" placeholder = "FILIACION" id = "rfc1ma" style="display: none;" required/>
       
        <div id="nomEmpsma">  
        </div>
        <input type="date" name="captura1ma" class = "form-control" placeholder = "CAPTURA" id = "captura1ma" style="display: none;" required/>
        <input type="date" name="fec_captura1ma" class = "form-control" placeholder = "FECHA DE CAPTURA" id = "fec_captura1ma" style="display: none;" required/>
        <input type="date" name="fec_cancelacion1ma" class = "form-control" placeholder = "FECHA DE CANCELACION" id = "fec_cancelacion1ma" style="display: none;" required/> 

        <input type="text" name="estatus1ma" class = "form-control" placeholder = "ESTATUS" id = "estatus1ma" style="display: none;" onkeypress="return numeros(event)" required/>
        <input type="text" name="relacion2ma" class = "form-control" placeholder = "RELACION OFICIO" id = "relacion2ma" style="display: none;" required/> 
        <input type="text" name="curp1ma" class = "form-control" placeholder = "CURP" id = "curp1ma" style="display: none;" required/>
         <div id="nomEmp3ma" >
         </div>
        <div id="plazaasma" >
          <input type="text" name="buscar1ma" class = "form-control" placeholder = "CODIGO DE PAGO" id = "plaza1ma" style="display: none;" onkeypress="return numeros(event)" required/>
        </div> 
        <div id="plazaas1ma" >      
          <input type="text" name="buscar2ma" class = "form-control" placeholder = "UNIDAD" id = "plaza2ma" style="display: none;" onkeypress="return numeros(event)" required/>
        </div> 
        <div id="plazaas2ma" >      
          <input type="text" name="buscar3ma" class = "form-control" placeholder = "SUBUNIDAD" id = "plaza3ma" style="display: none;" onkeypress="return numeros(event)" required/>
        </div> 
        <div id="plazaas3ma" >      
          <input type="text" name="buscar4ma" class = "form-control" placeholder = "CATEGORIA PUESTO" id = "plaza4ma" style="display: none;"  required/>
        </div> 
        <div id="plazaas4ma" >      
          <input type="text" name="buscar5ma" class = "form-control" placeholder = "HORAS" id = "plaza5ma" style="display: none;" onkeypress="return numeros(event)" required/>
        </div>
        <div id="plazaas5ma" >      
          <input type="text" name="buscar6ma" class = "form-control" placeholder = "CONS PLAZA" id = "plaza6ma" style="display: none;" onkeypress="return numeros(event)" required/> 
        </div>      
        <div id="labelsma">
          <label id="labelma" style="display: none;">Numero de Documento</label>
        </div>
        <div id="rfc_num_doctosma" >          
          <select id="rfc_num_doctoma" name="rfc_num_doctoma" class = "form-control" style="display: none;" required >
            <option value="" disabled selected hidden>Selecciona Uno...</option>
          </select>
        </div>                 
        <div id="radioma" >

              <div class="form-check">
              
                      <label>
                          <input type="radio" name="opc" value="Original" checked> Crear
                      </label>
                      <label>
                          <input type="radio" name="opc" value="Borrar"> Borrar
                      </label>
              
              </div>
              <div id="bttma" >     
                <button type = "button" name="btn_searchma" class = "btn_s" id="btn_searchma">
                  <span class = "glyphicon glyphicon-search" > ACEPTAR </span>
                </button>
              </div>
                <!--div id="bttRma" > 
                <button type="reset" name="btn_search2ma" class = "btn btn-outline-danger" id = "btn_search2ma" >
                  <span class = "glyphicon glyphicon-search" > BORRAR </span>
                </button>
              </div-->
          </div>
        <input type="hidden" name="key" id="key" value="<?php echo $keys;?>" />
        <input type="hidden" name="us" id="usuario" value="<?php echo  $usuario;?>" />
      <?php 
            }
        }
          ?>
        </form>
        <div id='dialog-confirmPDFma' title='¡Aviso!'  style='display: none;'>
          <label id="textobsma"></label>
        </div>
        </section>
        </section>
        </section>
  </div>  


    <div id="fup" style="display: none;">
      <section class = "row-fluid">
      <section class = "col-sm-20">
      <section class="panel-heading">
        <form id="formulario" name="formulario" method="POST" class="needs-validation" novalidate>
          <ul class="nav navbar-nav navbar-right">
            <?php
            foreach($menuPrincipal as $key => $val) { 
        if($val=="Reimpresion         "){
          ?>
              <button type="button" data-toggle="modal" data-target="#exampleModal" id="refup" class="text-white" onclick="reim();">Re-impresión FUP </button>
          <?php

            }
          } 
            ?>           
            <!--button type="button" data-toggle="modal" data-target="#exampleModal1" id="mfup" class="text-white" onclick="modal();" style="display: none;">Multi-FUP</button-->
          </ul>
        <?php echo "Bienvenido/a: "; ?> 
          <label  name="labs"   id="labs" ><?php echo $usuario;?></label>
          <h1>FORMATO ÚNICO PERSONAL</h1>
        <?php
          foreach($menuPrincipal as $key => $val) { 
        if($val=="Buscar_Documento    "){

        ?>
        <label id="buscr">BUSCAR POR:</label>
        <select id="descripcion" name="descripcion" class = "form-control" onchange="mostrarS(this.value);" required >
          <option value="" disabled selected hidden>Selecciona Uno...</option>
          <option id="num_oficio" name="num_oficio" value="num_oficio" >NUMERO DE PROPUESTA</option>
          <option id="num_docto" name="num_docto" value="num_docto">NUMERO DE DOCUMENTO</option>
          <option id="rfc" name="rfc" value="rfc">FILIACION</option>
          <option id="captura" name="captura" value="captura">CAPTURA</option>
          <option id="fec_captura" name="fec_captura" value="fecha_captura">FECHA CAPTURA</option>
          <option id="fec_cancelacion" name="fec_cancelacion" value="fecha_cancelacion">FECHA CANCELACION</option>
          <option id="plaza" name="plaza" value="plazas">PLAZA</option>
          <option id="estatus" name="estatus" value="estatus">ESTATUS</option>
          <option id="relacion1" name="relacion1" value="relacion_oficio">RELACION OFICIO</option>
          <option id="curp" name="curp" value="curp">CURP</option>
        </select>
        <input type="text" name="num_oficio1" class="form-control" placeholder="NUM. DE PROPUESTA" id="num_oficio1" style="display: none;"  onkeypress="return numeros(event)" autofocus required />
        <input type="text" name="num_docto1" class="form-control" placeholder="NUM. DE DOCUMENTO" id="num_docto1" style="display: none;" onkeypress="return numeros(event) " required autofocus maxlength="10" />
        <input type="text" name="rfc1" class = "form-control" placeholder = "FILIACION" id = "rfc1" style="display: none;" required/>
       
        <div id="nomEmps">  
        </div>
        <input type="date" name="captura1" class = "form-control" placeholder = "CAPTURA" id = "captura1" style="display: none;" required/>
        <input type="date" name="fec_captura1" class = "form-control" placeholder = "FECHA DE CAPTURA" id = "fec_captura1" style="display: none;" required/>
        <input type="date" name="fec_cancelacion1" class = "form-control" placeholder = "FECHA DE CANCELACION" id = "fec_cancelacion1" style="display: none;" required/> 

        <input type="text" name="estatus1" class = "form-control" placeholder = "ESTATUS" id = "estatus1" style="display: none;" onkeypress="return numeros(event)" required/>
        <input type="text" name="relacion2" class = "form-control" placeholder = "RELACION OFICIO" id = "relacion2" style="display: none;" required/> 
        <input type="text" name="curp1" class = "form-control" placeholder = "CURP" id = "curp1" style="display: none;" required/>
         <div id="nomEmp3" >
         </div>
        <div id="plazaas" >
          <input type="text" name="buscar1" class = "form-control" placeholder = "CODIGO DE PAGO" id = "plaza1" style="display: none;" onkeypress="return numeros(event)" required/>
        </div> 
        <div id="plazaas1" >      
          <input type="text" name="buscar2" class = "form-control" placeholder = "UNIDAD" id = "plaza2" style="display: none;" onkeypress="return numeros(event)" required/>
        </div> 
        <div id="plazaas2" >      
          <input type="text" name="buscar3" class = "form-control" placeholder = "SUBUNIDAD" id = "plaza3" style="display: none;" onkeypress="return numeros(event)" required/>
        </div> 
        <div id="plazaas3" >      
          <input type="text" name="buscar4" class = "form-control" placeholder = "CATEGORIA PUESTO" id = "plaza4" style="display: none;"  required/>
        </div> 
        <div id="plazaas4" >      
          <input type="text" name="buscar5" class = "form-control" placeholder = "HORAS" id = "plaza5" style="display: none;" onkeypress="return numeros(event)" required/>
        </div>
        <div id="plazaas5" >      
          <input type="text" name="buscar6" class = "form-control" placeholder = "CONS PLAZA" id = "plaza6" style="display: none;" onkeypress="return numeros(event)" required/> 
        </div>      
        <div id="labels">
          <label id="label" style="display: none;">Numero de Documento</label>
        </div>
        <div id="rfc_num_doctos" >          
          <select id="rfc_num_docto" name="rfc_num_docto" class = "form-control" style="display: none;" required >
            <option value="" disabled selected hidden>Selecciona Uno...</option>
          </select>
        </div>                 
        <div id="radio" >

              <!--div class="form-check">
              <div class="custom-control form-control-lg custom-checkbox"> 
                <input type="radio" class="custom-control-input" id="original" name="optradio" value="original" required checked >
                <label class="custom-control-label" for="original" value="original">Original</label>
              </div>
              </div-->
              <div id="btt" >     
                <button type = "button" name="btn_search" class = "btn_s" id = "btn_search">
                  <span class = "glyphicon glyphicon-search" > BUSCAR </span>
                </button>
              </div>
                <div id="bttR" > 
                <button type="reset" name="btn_search2" class = "btn btn-outline-danger" id = "btn_search2" >
                  <span class = "glyphicon glyphicon-search" > BORRAR </span>
                </button>
              </div>
          </div>
        <input type="hidden" name="key" id="key" value="<?php echo $keys;?>" />
        <input type="hidden" name="us" id="usuario" value="<?php echo  $usuario;?>" />
      <?php 
            }
        }
          ?>
        </form>
        <div id='dialog-confirmPDF' title='¡Aviso!'  style='display: none;'>
          <label id="textobs"></label>
        </div>
        </section>
        </section>
        </section>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
  <div class="modal-body">
  <div class = "form-inline">
    <form id="formulario2">
      <h5 class="modal-title d-inline-block" id="exampleModalLabel">Re-impresion de FUP "<?php echo $usuario;?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cambia_de_pagina();">
          <span aria-hidden="true">&times;</span>
        </button>
         <div class="modal-footer">
         <label id="buscarR_">BUSCAR POR:</label>
         <select id="descripcionR" name="descripcionR" class = "form-control" onchange="mostrarR_(this.value);" required >
          <option value="" disabled selected hidden>Selecciona Uno...</option>
          <option id="num_oficioR_" name="num_oficioR_" value="num_oficioR_" >NUMERO DE PROPUESTA</option>
          <option id="num_doctoR_" name="num_doctoR_" value="num_doctoR_">NUMERO DE DOCUMENTO</option>
          <option id="num_doctoR_A" name="num_doctoR_A" value="num_doctoR_A">NUMERO DE DOCUMENTO ARCHIVO</option>
          <option id="rfcR_" name="rfcR_" value="rfcR_">FILIACION</option>
          <option id="capturaR_" name="capturaR_" value="capturaR_">CAPTURA</option>
          <option id="fec_capturaR_" name="fec_captura" value="fecha_capturaR_">FECHA CAPTURA</option>
          <option id="fec_cancelacionR_" name="fec_cancelacionR_" value="fecha_cancelacionR_">FECHA CANCELACION</option>
          <option id="plazaR_" name="plazaR_" value="plazasR_">PLAZA</option>
          <option id="estatusR_" name="estatusR_" value="estatusR_">ESTATUS</option>
          <option id="relacionR_" name="relacionR_" value="relacion_oficioR_">RELACION OFICIO</option>
          <option id="curpR_" name="curpR_" value="curpR_">CURP</option>
        </select>
        <input type="text" name="num_oficioR" class="form-control" placeholder="NUM. DE PROPUESTA" id="num_oficioR" style="display: none;"  onkeypress="return numeros(event)" autofocus required />
        <input type="text" name="num_doctoR" class="form-control" placeholder="NUM. DE DOCUMENTO" id="num_doctoR" style="display: none;" onkeypress="return numeros(event)"   autofocus maxlength="10" onkeydown="CAD_checkEnter(event);" required/>
        <input type="text" name="num_doctoRA" class="form-control" placeholder="NUM. DE DOCUMENTO ARCHIVO" id="num_doctoRA" style="display: none;" onkeypress="return numeros(event)"   autofocus maxlength="10" onkeydown="CAD_checkEnter(event);" required/>
        <input type="text" name="rfcR" class = "form-control" placeholder = "FILIACION" id = "rfcR" style="display: none;" required/>
       
        <div id="nomEmpsR">  
        </div>
        <input type="date" name="capturaR" class = "form-control" placeholder = "CAPTURA" id = "capturaR" style="display: none;" required/>
        <input type="date" name="fec_capturaR" class = "form-control" placeholder = "FECHA DE CAPTURA" id = "fec_capturaR" style="display: none;" required/>
        <input type="date" name="fec_cancelacionR" class = "form-control" placeholder = "FECHA DE CANCELACION" id = "fec_cancelacionR" style="display: none;" required/> 

        <input type="text" name="estatusR" class = "form-control" placeholder = "ESTATUS" id = "estatusR" style="display: none;" onkeypress="return numeros(event)" required/>
        <input type="text" name="relacionR" class = "form-control" placeholder = "RELACION OFICIO" id = "relacionR" style="display: none;" required/> 
        <input type="text" name="curpR" class = "form-control" placeholder = "CURP" id = "curpR" style="display: none;" required/>
         <div id="nomEmp3R" >
         </div>
        <div id="plazaasR" >
          <input type="text" name="buscarR" class = "form-control" placeholder = "CODIGO DE PAGO" id = "plazaR" style="display: none;" onkeypress="return numeros(event)" required/>
        </div> 
        <div id="plazaas1R" >      
          <input type="text" name="buscar2R" class = "form-control" placeholder = "UNIDAD" id = "plaza2R" style="display: none;" onkeypress="return numeros(event)" required/>
        </div> 
        <div id="plazaas2R" >      
          <input type="text" name="buscar3R" class = "form-control" placeholder = "SUBUNIDAD" id = "plaza3R" style="display: none;" onkeypress="return numeros(event)" required/>
        </div> 
        <div id="plazaas3R" >      
          <input type="text" name="buscar4R" class = "form-control" placeholder = "CATEGORIA PUESTO" id = "plaza4R" style="display: none;"  required/>
        </div> 
        <div id="plazaas4R" >      
          <input type="text" name="buscar5R" class = "form-control" placeholder = "HORAS" id = "plaza5R" style="display: none;" onkeypress="return numeros(event)" required/>
        </div>
        <div id="plazaas5R" >      
          <input type="text" name="buscar6R" class = "form-control" placeholder = "CONS PLAZA" id = "plaza6R"  style="display: none;"  onkeypress="return numeros(event)" required /> 
        </div>      
        <div id="labelsR">
          <label id="labelR" style="display: none;">Numero de Documento</label>
        </div>
        <div id="rfc_num_doctosR" >          
          <select id="rfc_num_doctoR" name="rfc_num_doctoR" class = "form-control" style="display: none;"  onchange="var optionVal = $(this).find(':selected').val(); " required >
            
          </select>
        </div>      
        <div id="bttR2_" >
         <button type = "button" name="btnGetDataR" style="visibility:visible" class = "btnGetDataR" id = "btnGetDataR" onclick="clickaction(this,'Q')">Generar FUP</button>
         </div>  
                 <input type="hidden" name="key" id="key" value="<?php echo $keys;?>" />
        <input type="hidden" name="us" id="usuario" value="<?php echo  $usuario;?>" />      
    </form>
    
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>


   
  </body>
         
  <?php
  include 'Js/Auto_completarma.php';
  include 'Js/Auto_completar.php';
  include 'Js/Auto_completarR.php';
  include 'Conexion/mostrar_boton/boton.php';
  include 'Conexion/mostrar_boton/botonR.php';
//01marzo02022 esto no es necesario ya que es posteado con ajax desde boton.php:: include 'boton1.php';
  ?>
<script src="Js/botonesR17.js"></script>

</html>    
<?php 
} catch ( SoapFault $e ) { echo '
<!DOCTYPE html> 
<html lang=&quot;es&quot;>      
<head>    
<meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=utf-8&quot; />           
 <style> 
 ::-moz-selection {background: #b3d4fc; text-shadow: none;}             
 ::selection {background: #b3d4fc; text-shadow: none;}            
 html {padding: 30px 10px; font-size: 16px; line-height: 1.4; color: #737373; background: #f0f0f0;                 -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}             html,             input {font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;}             body {max-width:700px; _width: 700px; padding: 30px 20px 50px; border: 1px solid #b3b3b3;                 border-radius: 4px;margin: 0 auto; box-shadow: 0 1px 10px #a7a7a7, inset 0 1px 0 #fff;                 background: #fcfcfc;}             h1 {margin: 0 10px; font-size: 50px; text-align: center;}             h1 span {color: #bbb;}             h2 {color: #D35780;margin: 0 10px;font-size: 40px;text-align: center;}             h2 span {color: #bbb;font-size: 80px;}             h3 {margin: 1.5em 0 0.5em;}             p {margin: 1em 0;}             ul {padding: 0 0 0 40px;margin: 1em 0;}             .container {max-width: 380px;_width: 480px;margin: 0 auto;}             input::-moz-focus-inner {padding: 0;border: 0;}         
 </style>     
 </head>     
 <body>         
 <div class=&quot;container&quot;>             
<h2><span>=´(<br></span></h2>              
 <p>¡Vaya! Algo salió mal.<br /><br />Trata de volver a cargar esta página o no dudes en contactar con el Departamento de Desarrollo si el problema persiste.</p>         
 </div>     
 </body> 
 </html>'; 
}
?>