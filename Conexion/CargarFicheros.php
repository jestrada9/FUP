<?php
  require_once('../lib/nusoap.php');
  $cfgFUP = require __DIR__ . '/config.php';
  ini_set("soap.wsdl_cache_enabled", "0");
  $cliente=new SOAPClient('http://localhost:8084/WebService_Consultas/WS?wsdl', array ('wsdl'));

  $params_ = array('Resultado'=>"",'Argumento'=>""); //para conseguir la consulta
  $resultadoss_=$cliente->Borrar($params_);
  $arrayR3_= json_decode(json_encode($resultadoss_), True);

  $fichero = $_FILES["file"];

  move_uploaded_file($fichero["tmp_name"], "subidas/".$fichero["name"]);

  exec('bcp CAD_trabajo..tmpnd in '.escapeshellarg('subidas/'.$fichero["name"]).' -S '.escapeshellarg($cfgFUP['bcp']['servidor']).' -U '.escapeshellarg($cfgFUP['bcp']['usuario']).' -P '.escapeshellarg($cfgFUP['bcp']['password']).' -t "|" -c');

  $params_ = array('Resultado'=>"",'Argumento'=>""); //para conseguir la consulta
  $resultadoss_=$cliente->tmpnd($params_);
  $arrayR4_= json_decode(json_encode($resultadoss_), True);
  //var_dump($arrayR4_);
  foreach($arrayR4_ as $valuess){ //1er foreach getDatosPDF
    $total_res=$valuess["tot_resu"];
  //echo $total_res;
      echo " 
        <script>
 	      window.alert('Se Procesarán ".$total_res." Numeros de Documentos');
		    location.href = '../index.php';
	    </script>
		  ";
  }
  unlink("subidas/".$fichero["name"]);
?>