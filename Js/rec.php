<?php
  require_once('../Conexion/ServicioWeb.php');
  $num_doc = "2310299796";
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
        $cve_mov="";
        $mot_mov="";
        $array=  array("");

        if(!empty($arrays)){
            $ver = $arrays['NewDataSet']['table'];
            $vers = $arrays['NewDataSet'];
            if(!isset($ver[0])){
                
                $total_res=count($vers);
                $cve_mov=$ver["cve_mov"];
                $mot_mov=$ver["mot_mov"];   
                $array = array(
                        "array"    => $mot_mov
                    );
            }else{
                
                $total_res=count($ver);
                $x = 0;
                $x1 = 1;
                //
                while ($x < $total_res){
                    $cve_mov=$ver[$x]["cve_mov"];
                    $mot_mov=$ver[$x]["mot_mov"];              
                    $array = array(
                        "total"    => $x1,
                        "array"    => $mot_mov
                    );
                    //var_dump($array);
                    $x++;
                    $x1++;
                } 
                var_dump($array);                              
            }   
           
        } 
?>        

