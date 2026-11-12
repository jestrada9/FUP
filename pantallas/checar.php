  <?php
  require_once('../Conexion/ServicioWeb.php');
      function checarDocto($num_doc,$array,$cliente){//checarDocto
      //var_dump($arrayRsP1);
      
      if(!empty($array)){//inicio else
          $ver = $array['NewDataSet']['table'];
          $ver2 = $array['NewDataSet'];
          //var_dump($ver);
          if(!isset($ver[0])){
            $total_res= count($ver);
              $num_doc    =$ver["idnum_docto"];
              $cve_mov    =$ver["placve_mov"];
              $mot_mov    =$ver["plamot_mov"];
              $idAutorizar=$ver["idAutorizar"];
          }else{
            $a=0;
            $total_res= count($ver2);
            while($a<$total_res){
              $num_doc    =$ver[$a]["idnum_docto"];
              $cve_mov    =$ver[$a]["placve_mov"];
              $mot_mov    =$ver[$a]["plamot_mov"];
              $idAutorizar=$ver[$a]["idAutorizar"];
              $a++;
            }
          }
          
        //foreach($arrayRsP1 as $values1){

        //}
        if($idAutorizar==0){
          $rresult = "'El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización Captura'";
        }elseif ($idAutorizar==1) {
          $rresult = "'El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización CGRH'";
        }elseif ($idAutorizar==2) {
          $rresult = "'El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización Dirección'";
        }elseif ($idAutorizar==3) {
          $rresult = "pasar";
          //$rresult = trim("pasar");
        }elseif ($idAutorizar==4) {
          $rresult = "pasar";
          //$rresult = trim("pasar");
        }elseif ($idAutorizar==5) {
          $rresult = "pasar";
          //$rresult = trim("pasar");
        }elseif ($idAutorizar==8) {
          $rresult = "pasar";
          //$rresult = trim("pasar");
        }elseif ($idAutorizar==9) {
          $rresult = "pasar";
          //$rresult = trim("pasar");
        }
      }else{
        $rresult = "No existe Original de ".$num_doc."";
      }
      echo $rresult;
  }//checarDocto
?>
  
<?php
      $num_doc = $_POST['docto'];
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
              
      checarDocto($num_doc,$array,$cliente);
    
?>

