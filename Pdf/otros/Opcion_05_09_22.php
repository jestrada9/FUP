<?php
//error_reporting(0);
//if(!isset($_POST['descripcion'])){
    
//}else{
  require_once('../lib/nusoap.php');
  require_once('../Conexion/ServicioWeb.php');
  $cve_mov="";
  $mot_mov="";
  $usuario= "";
  $keys = ""; 
  include('../ValidarKey1.php');

  ?> 
  <form style="display: none" action="../index.php" method="POST" id="form">
    <input type="hidden" name="key" id="key" value="<?php echo  $keys;?>" />
    <input type="hidden" name="us" id="usuario" value="<?php echo  $usuario;?>" />
  </form>    
    
  <?php
  if(isset($_POST['descripcion']) || empty($_POST['descripcion'])){
    $columna = $_POST['descripcion'];
  }else{
    $columna = $_POST['descripcion'];
  }

  if(!isset($_POST['num_docto1']) || empty($_POST['num_docto1'])){
    $num_doc = $_POST['rfc_num_docto'];
  }else{
     $num_doc = $_POST['num_docto1'];
  }

?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script type="text/javascript">
  function MiArchivoCargado(){

  }

   function loadScript(url, callback){

        var head = document.getElementsByTagName('head')[0];
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;
        script.onreadystatechange = callback;
        script.onload = callback;
        head.appendChild(script);
    }

</script>
  
<?php

      $id_consultaP1 =  152;
      $JSONP1="[{\"var\":\"$num_doc\"}]";
      $arrayRP1 = json_decode(json_encode($JSONP1), True);
      $paramsP1 = array('Resultado'=>$id_consultaP1, 'Argumento'=>$arrayRP1); //para conseguir la consulta
      $resultadosP1=$cliente->getConsulta($paramsP1);   
      $arrayRsP1= json_decode(json_encode($resultadosP1), True);
      //var_dump($arrayRsP1);

    if ($columna == "num_oficio") {
        $num_doc = $_POST['rfc_num_docto'];
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
        $arrayR3= json_decode(json_encode($resultadoss), True);
      }
       foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
        }

      if (!empty($arrayRsP1)) {
        
    /*echo " 
    <script>
     window.location='../index.php';
    window.alert('El Número: ".$num_doc." ya existe en Original');
    window.close();
    </script>";*/
    ?>
        
<script>
  
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

          loadScript("../Js/js.js", MiArchivoCargado);

        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          $("#form").submit();
        }
      }
    });
  } );
  </script>
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div> 

  <?php 
    }else{  
?>

    <script>
    window.alert('El Número: ".$num_doc." ya existe en Original');
    window.close();
    $("#form").submit();
    </script>
<script>
 /* window.onload=function() {
    var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo $keys;?>";
    window.open(miUrl,"_blank");
    $("#form").submit();
  }*/
</script>
<?php      
}
}

if ($columna == "num_docto") {
      $num_doc = $_POST['num_docto1'];
      //echo $num_doc;
      $id_consulta = 66;
      $JSON="[{\"datos\":\"$num_doc\"}]";
      $arrayR1 = json_decode(json_encode($JSON), True);
      $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
      $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);

      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
        $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
        $arrayR3= json_decode(json_encode($resultadoss), True);
      }
      //var_dump($arrayR3);
        foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
        }
      //var_dump($arrayRsP1);
      if (empty($arrayRsP1)) {
/*        
        if($cve_mov == 19){
           echo " 
    <script>
    $('#form').submit();
     //window.location='../index.php';
    window.alert('El Número: ".$num_doc." con cve_mov:".$cve_mov." No Puede Crearse en Original');
    window.close();
    </script>";
        }else{
*/          
   /*     
    echo " 
    <script>
     window.location='../index.php';
    window.alert('El Número: ".$num_doc." ya existe en Original');
    window.close();
    </script>";*/

    ?>


<script>
    window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      $("#form").submit();
  }
  /*  
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 
            loadScript("../Js/js.js", MiArchivoCargado);
        },
        Cancelar: function() {
          $( this ).dialog( "close" );
            $("#form").submit();
        }
      }
    });
  } );
  */
  </script>
     <!--div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div--> 

  <?php 
//}//else cve19
    }else{      
echo " 
    <script>
    $('#form').submit();
    window.alert('El Número: ".$num_doc." ya existe en Original');
    window.close();
    </script>";
?>
<script>
 /* window.onload=function() {
    var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo $keys;?>";
    window.open(miUrl,"_blank");
    $("#form").submit();
  }*/
</script>
<?php      
}
}
if ($columna == "rfc") {
      $num_doc = $_POST['rfc_num_docto'];
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }
      foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
      }
        if(empty($arrayRsP1)) {
        
    ?>
        
<script>
    window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      $("#form").submit();
  }
/*
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

          loadScript("../Js/js.js", MiArchivoCargado);

        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          //window.location="../index.php?key=<?php echo  $keys;?>";
          $("#form").submit();
        }
      }
    });
  } );
  */
  </script>
  <!--
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div> 
-->
  <?php 
    
    }else{  
echo " 
    <script>
    $('#form').submit();
    window.alert('El Número: ".$num_doc." ya existe en Original');
    window.close();
    </script>";      
?>
<script>
  /*
  window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      //window.location="../index.php?key=<?php echo  $keys;?>";
      $("#form").submit();
  }
  */
</script>
<?php
}
}
if ($columna == "captura") {
      $num_doc = $_POST['rfc_num_docto'];
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }
      foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
      }
            if (!empty($arrayRsP1)) {
        
    ?>
        
<script>
  
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

          loadScript("../Js/js.js", MiArchivoCargado);

        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          //window.location="../index.php?key=<?php echo  $keys;?>";
          $("#form").submit();
        }
      }
    });
  } );
  </script>
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div> 

  <?php 
    
    }else{  
?>
<script>
  window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      //window.location="../index.php?key=<?php echo  $keys;?>";
      $("#form").submit();
  }
</script>
<?php      
}
}
if ($columna == "fecha_captura") {
      $num_doc = $_POST['rfc_num_docto'];
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }
      foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
      }
            if (!empty($arrayRsP1)) {
        
    ?>
        
<script>
  
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

          loadScript("../Js/js.js", MiArchivoCargado);

        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          //window.location="../index.php?key=<?php echo  $keys;?>";
          $("#form").submit();
        }
      }
    });
  } );
  </script>
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div> 

  <?php 
    
    }else{  
 ?>
 <script>
  window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      //window.location="../index.php?key=<?php echo  $keys;?>";
      $("#form").submit();

  }
</script>
<?php      
}
}
if ($columna == "fecha_cancelacion") {
    $num_doc = $_POST['rfc_num_docto'];
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }
    foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
    }
          if (!empty($arrayRsP1)) {
        
    ?>
        
<script>
  
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

          loadScript("../Js/js.js", MiArchivoCargado);

        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          //window.location="../index.php?key=<?php echo  $keys;?>";
          $("#form").submit();
        }
      }
    });
  } );
  </script>
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div> 

  <?php 
    
    }else{  
?>
<script>
  window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      //window.location="../index.php?key=<?php echo  $keys;?>";
      $("#form").submit();
  }
</script>
<?php      
}
}
if ($columna == "plazas") {
    $num_doc = $_POST['rfc_num_docto'];
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }
    foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
    }
          if (!empty($arrayRsP1)) {
        
    ?>
        
<script>
  
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

          loadScript("../Js/js.js", MiArchivoCargado);

        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          //window.location="../index.php?key=<?php echo  $keys;?>";
          $("#form").submit();
        }
      }
    });
  } );
  </script>
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div> 

  <?php 
    
    }else{  
?>
<script>
  window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      //window.location="../index.php?key=<?php echo  $keys;?>";
      $("#form").submit();
  }
</script>
<?php      
}
}
if ($columna == "estatus") {
      $num_doc = $_POST['rfc_num_docto'];
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }
      foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
     }
           if (!empty($arrayRsP1)) {
        
    ?>
 <script>
  
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

          loadScript("../Js/js.js", MiArchivoCargado);

        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          //window.location="../index.php?key=<?php echo  $keys;?>";
          $("#form").submit();
        }
      }
    });
  } );
  </script>
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div> 

  <?php 
    
    }else{  
?>
<script>
  window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      //window.location="../index.php?key=<?php echo  $keys;?>";
      $("#form").submit();
  }
</script>
<?php      
}
}
if ($columna == "relacion_oficio") {
    $num_doc = $_POST['rfc_num_docto'];
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }
      foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
      }
            if (!empty($arrayRsP1)) {
        
    ?>
        
<script>
  
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

          loadScript("../Js/js.js", MiArchivoCargado);

        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          //window.location="../index.php?key=<?php echo  $keys;?>";
          $("#form").submit();
        }
      }
    });
  } );
  </script>
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div> 
  <?php 
    
    }else{  
?>
<script>
  window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      //window.location="../index.php?key=<?php echo  $keys;?>";
      $("#form").submit();

  }
</script>
<?php      
}
}
if ($columna == "curp") {
    $num_doc = $_POST['rfc_num_docto'];
    //echo $num_doc;
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      if(empty($arrayR3)){
        $id_consulta = 65;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }else{
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";

        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
      $arrayR3= json_decode(json_encode($resultadoss), True);
      }
    //var_dump($arrayR3);
    foreach($arrayR3 as $values1){
          $cve_mov=$values1[0]["cve"];
          $mot_mov=$values1[1]["mot"];
    }
          if (!empty($arrayRsP1)) {
        
    ?>
        
<script>
  
var dataString = 'item='+<?php echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
var locacion = "../index.php?key=<?php echo  $keys;?>";

 $("#dialog-confirm2").hide();
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

          loadScript("../Js/js.js", MiArchivoCargado);

        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          //window.location="../index.php?key=<?php echo  $keys;?>";
          $("#form").submit();
        }
      }
    });
  } );
  </script>
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php echo $num_doc; ?>?</p>
</div>  

  <?php 
    
    }else{  
?>
<script>
  window.onload=function() {
    
       var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo  $keys;?>";
      window.open(miUrl,"_blank");
      //window.location="../index.php?key=<?php echo  $keys;?>";
      $("#form").submit();
  }
</script>
<?php      
}
}
//}
?>