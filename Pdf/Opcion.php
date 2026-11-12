<?php
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
      function checarDocto($num_doc,$keys,$array,$cliente){//checarDocto
      //var_dump($arrayRsP1);
      
      if(!empty($array)){//inicio else
        $ver = $array['NewDataSet']['table'];
        $total_res= count($ver);
          /*
          $num_doc    =$values1[1]["idnum_docto"];
          $cve_mov    =$values1[2]["placve_mov"];
          $mot_mov    =$values1[3]["plamot_mov"];
          $idAutorizar=$values1[4]["idAutorizar"];
          */
          $num_doc    =$ver["idnum_docto"];
          $cve_mov    =$ver["placve_mov"];
          $mot_mov    =$ver["plamot_mov"];
          $idAutorizar=$ver["idAutorizar"];          
        
        if($idAutorizar==0){
          echo " 
        <script>
         $('#form').submit();
        window.alert('El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización Captura');
        window.close();
        </script>";
        }elseif ($idAutorizar==1) {
          echo " 
        <script>
         $('#form').submit();
        window.alert('El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización CGRH');
        window.close();
        </script>";
        }
        elseif ($idAutorizar==2) {
          echo " 
        <script>
         $('#form').submit();
        window.alert('El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización Dirección');
        window.close();
        </script>";
        }
        elseif ($idAutorizar==3) {
          echo " 
        <script>
         $('#form').submit();
        window.alert('El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización Original');
        window.close();
        </script>";
        }
        elseif ($idAutorizar==4) {//idAutorizar4
        echo " 
        <script>
         $('#form').submit();
        window.alert('El Número: ".$num_doc.", Se Encuentra Creado En Original');
        window.close();
        </script>";
        }
      }else{//else
        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";
        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
        $arrayR3= json_decode(json_encode($resultadoss), True);
        $xml2 = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
        $json2 = json_encode($xml2);
        $array2 = json_decode($json2,TRUE);  
        if(!empty($array2)){//inicio else
          $ver2 = $array2['NewDataSet']['table'];
          $total_res= count($ver2);
          $cve_mov=$ver2["cve"];
          $mot_mov=$ver2["mot"];
        }        

?>
      <script>
        window.onload=function() {
          var miUrl = "Antecedentes.php?cve_mov=<?php echo base64_encode($cve_mov);?>&var=<?php echo base64_encode($num_doc);?>&mot_mov=<?php echo base64_encode($mot_mov);?>&key=<?php echo $keys;?>&mots=<?php echo $array;?>";
          window.open(miUrl,"_blank");
          $("#form").submit();
        }
      </script>
<?php      
      }//fin else
  }//checarDocto
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

      $id_consultaP1 =  204;
      $JSONP1="[{\"var\":\"$num_doc\"}]";
      $arrayRP1 = json_decode(json_encode($JSONP1), True);
      $paramsP1 = array('Resultado'=>$id_consultaP1, 'Argumento'=>$arrayRP1); //para conseguir la consulta
      $resultadosP1=$cliente->getConsulta($paramsP1);   
      $arrayRsP1= json_decode(json_encode($resultadosP1), True);
      //var_dump($arrayRsP1);
      $xml = simplexml_load_string($arrayRsP1['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);  

    if ($columna == "num_oficio") {
        $num_doc = $_POST['rfc_num_docto'];
        checarDocto($num_doc,$keys,$array,$cliente);
    }
    if ($columna == "num_docto") {
        $num_doc = $_POST['num_docto1'];
        checarDocto($num_doc,$keys,$array,$cliente);
    }
    if ($columna == "rfc") {
        $num_doc = $_POST['rfc_num_docto'];
        checarDocto($num_doc,$keys,$array,$cliente);
    }
    if ($columna == "captura") {
        $num_doc = $_POST['rfc_num_docto'];
        checarDocto($num_doc,$keys,$array,$cliente);
    }
    if ($columna == "fecha_captura") {
        $num_doc = $_POST['rfc_num_docto'];
        checarDocto($num_doc,$keys,$array,$cliente);
    } 
    if ($columna == "fecha_cancelacion") {
        $num_doc = $_POST['rfc_num_docto'];
        checarDocto($num_doc,$keys,$array,$cliente);
    }
    if ($columna == "plazas") {
        $num_doc = $_POST['rfc_num_docto'];
        checarDocto($num_doc,$keys,$array,$cliente);
    }
    if ($columna == "estatus") {
        $num_doc = $_POST['rfc_num_docto'];
        checarDocto($num_doc,$keys,$array,$cliente);
    }   
    if ($columna == "relacion_oficio") {
        $num_doc = $_POST['rfc_num_docto'];
        checarDocto($num_doc,$keys,$array,$cliente);
    }
    if ($columna == "curp") {
        $num_doc = $_POST['rfc_num_docto'];
        checarDocto($num_doc,$keys,$array,$cliente);    
    }
//}
?>

<!--script>
  
var dataString = 'item='+<?php //echo $num_doc;?>;
var miUrls = "Antecedentes.php?cve_mov=<?php //echo base64_encode($cve_mov);?>&var=<?php //echo base64_encode($num_doc);?>&mot_mov=<?php //echo base64_encode($mot_mov);?>&key=<?php //echo  $keys;?>";
var locacion = "../index.php?key=<?php //echo  $keys;?>";

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
          //window.location="../index.php?key=<?php //echo  $keys;?>";
          $("#form").submit();
        }
      }
    });
  } );
  </script>
     <div id="dialog-confirm" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>El Número: <?php //echo $num_doc; ?> ya existe en Original. ¿Quieres Eliminarlo para crearlo de nuevo?</p>
</div>   
     <div id="dialog-confirm2" title="¿Borrar Número de Documento?"  style="display: none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro que desea borrar el Número: <?php //echo $num_doc; ?>?</p>
</div> 
*/
?>

