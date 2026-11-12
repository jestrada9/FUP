<?php
  require_once('../Conexion/ServicioWeb.php');
  $cve_mov="";
  $mot_mov="";
  $keys = $_POST['key'];

      if(isset($_POST['descripcion']) || empty($_POST['descripcion'])){
        $columna = $_POST['descripcion'];
      }else{
        $columna = $_POST['descripcion'];
      }

      if(!isset($_POST['num_docto']) || empty($_POST['num_docto'])){
        $num_doc = $_POST['rfc_num_docto'];
      }else{
         $num_doc = $_POST['num_docto'];
      }

      function checarDocto($num_doc,$arrayRsP1,$cliente,$keys){//checarDocto
      //var_dump($arrayRsP1);
      
      $xml = simplexml_load_string($arrayRsP1['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);
      //var_dump($array);
      //var_dump($array['NewDataSet']['table']);
      if(!empty($array)){
        
          $ver = $array['NewDataSet']['table'];
          $ver2 = $array['NewDataSet'];
          if(!isset($ver[0])){
                $total_res= count($ver2); 
                $num_doc    =$ver["idnum_docto"];
                $cve_mov    =$ver["placve_mov"];
                $mot_mov    =$ver["plamot_mov"];
                $idAutorizar=$ver["idAutorizar"];
          }else{
            $total_res= count($ver);
            $a=0;
            while($a<$total_res){
                $num_doc    =$ver[$a]["idnum_docto"];
                $cve_mov    =$ver[$a]["placve_mov"];
                $mot_mov    =$ver[$a]["plamot_mov"];
                $idAutorizar=$ver[$a]["idAutorizar"];
                $a++;
            }
          }
        if($idAutorizar==0){
          echo "El Número: $num_doc ,Se Encuentra En Pendientes Autorización Captura.'";
        }elseif ($idAutorizar==1) {
          echo "El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización CGRH.'";
        }elseif ($idAutorizar==2) {
          echo "El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización Dirección.'";
        }elseif ($idAutorizar==3) {
          echo "El Número: ".$num_doc.", Se Encuentra En Pendientes Autorización Original.'";
        }elseif ($idAutorizar==4) {//idAutorizar4
          echo "El Número: ".$num_doc.", Se Encuentra Creado En Original.'";
        }elseif ($idAutorizar==5) {//idAutorizar4
            echo "El Número: ".$num_doc.", De Cambio de CT, Se Encuentra Creado En Original Con Estatus 5.'";
        }
      }else{//else
        $data = array();
        class ArrayValue implements JsonSerializable {
            public function __construct(array $array) {
                $this->array = $array;
            }

            public function jsonSerialize() {
                return $this->array;
            }
        }

        $id_consulta = 66;
        $JSON="[{\"datos\":\"$num_doc\"}]";
        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
        $arrayR3= json_decode(json_encode($resultadoss), True);
      
        $xml = simplexml_load_string($arrayR3['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $arrays = json_decode($json,TRUE);
        //var_dump($arrays);
        //var_dump($array['NewDataSet']['table']);
        if(!empty($arrays)){
            $ver = $arrays['NewDataSet']['table'];
            $vers = $arrays['NewDataSet'];
            if(!isset($ver[0])){
                //echo "hola";
                $total_res=count($ver);
                $cve_mov=$ver["cve_mov"];
                $mot_mov=$ver["mot_mov"];   
            }else{
                //echo "adios";
                $total_res=count($vers);
                $x = 0;
                //
                while ($x < $total_res){
                    $cve_mov=$ver[$x]["cve_mov"];
                    $mot_mov=$ver[$x]["mot_mov"];               
                    $x++;
                }                               
            }   
           
        }          

      $cve_mov1 =  base64_encode($cve_mov);
      $var1 = base64_encode($num_doc);
      $mot_mov1 = base64_encode($mot_mov);
      $key1 =  $keys;

      //$objeto = "[{\"cve_mov\":\"$cve_mov1\",\"var\":\"$var1\",\"mot_mov\":\"$mot_mov1\", \"key\":\"$key1\"}]";
      //$objeto = "[{cve_mov:$cve_mov1,var:$var1,mot_mov:$mot_mov1, key:$key1}]";
      /*
      $objeto = '{
      "archivos":
        [
          {
          "cve_mov":$cve_mov1,
          "var":$var1,
          "mot_mov":$mot_mov1,
          "key":$key1
          }
        ]
      }';

      $arrays = json_encode($objeto, true);
      echo $arrays;
      */
      $array = ['cve_mov' => $cve_mov1, 'var' => $var1, 'mot_mov' => $mot_mov1, 'key' => $key1];
        echo json_encode(new ArrayValue($array), JSON_PRETTY_PRINT);
      }//fin else
  }//checarDocto


      $id_consultaP1 =  204;
      $JSONP1="[{\"var\":\"$num_doc\"}]";
      $arrayRP1 = json_decode(json_encode($JSONP1), True);
      $paramsP1 = array('Resultado'=>$id_consultaP1, 'Argumento'=>$arrayRP1); //para conseguir la consulta
      $resultadosP1=$cliente->getConsulta($paramsP1);   
      $arrayRsP1= json_decode(json_encode($resultadosP1), True);

      if(!empty($arrayRsP1)){


            if ($columna == "num_oficioma") {
                $num_doc = $_POST['rfc_num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);
            }
            if ($columna == "num_doctoma") {
                $num_doc = $_POST['num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);
            }
            if ($columna == "rfcma") {
                $num_doc = $_POST['rfc_num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);
            }
            if ($columna == "capturama") {
                $num_doc = $_POST['rfc_num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);
            }
            if ($columna == "fecha_capturama") {
                $num_doc = $_POST['rfc_num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);
            } 
            if ($columna == "fecha_cancelacionma") {
                $num_doc = $_POST['rfc_num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);
            }
            if ($columna == "plazasma") {
                $num_doc = $_POST['rfc_num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);
            }
            if ($columna == "estatusma") {
                $num_doc = $_POST['rfc_num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);
            }   
            if ($columna == "relacion_oficioma") {
                $num_doc = $_POST['rfc_num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);
            }
            if ($columna == "curpma") {
                $num_doc = $_POST['rfc_num_docto'];
                checarDocto($num_doc,$arrayRsP1,$cliente,$keys);    
            }
      }

?>
