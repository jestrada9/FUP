<?php 
      $id = $_POST['id'];//"2303296035";
      $observacion = "Autorizo Original";
      $usuario     = $_POST['us'];
      $operacion   = "Autorizo Original";
      $area        = $_POST['ara'];
      $num_oficio  = $_POST['no'];
      $num_doctos="";
      $a=0;
      $directorio = "";

      $id_consultaDIR =  1274;
      $JSONDIR ="[{\"buscar\":\"$id\"}]";
      $arrayDIR  = json_decode(json_encode($JSONDIR ), True);
      $paramsDIR  = array('Resultado'=>$id_consultaDIR , 'Argumento'=>$arrayDIR , 'Accion'=>"select"); //para conseguir la consulta
      $resultadosDIR =$cliente->getConsulta($paramsDIR );
      $arrayRDIR = json_decode(json_encode($resultadosDIR ), True);   
      $xmlDIR  = simplexml_load_string($arrayRDIR ['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
      $jsonDIR  = json_encode($xmlDIR );
      $arrayDIR_  = json_decode($jsonDIR ,TRUE);

        
      if(!empty($arrayDIR_)){

        
        $ver1 = $arrayDIR_['NewDataSet']['table'];    
        $ver1_ = $arrayDIR_['NewDataSet'];  
        //var_dump($valuestra);
        if(!isset($ver1[0])){
          //echo "hola";
              $tot_resul_tra=count($ver1_);   
              $cve_mov       = $ver1['cve_mov'];
              $mot_mov       = $ver1["mot_mov"];
              
              if($cve_mov== "9" && $mot_mov == "76"){
                  $directorio = "../FUPs/Masivo_Original/CCT/";
              }else{
                $directorio = "../FUPs/Masivo_Original/";
              }
        }else{
          //echo "adios";
            $tot_resul_tra=count($ver1);    
          
              $cve_mov       = $ver1[0]['cve_mov'];
              $mot_mov       = $ver1[0]["mot_mov"];  
              if($cve_mov== "9" && $mot_mov == "76"){
                  $directorio = "../FUPs/Masivo_Original/CCT/";
              }else{
                  $directorio = "../FUPs/Masivo_Original/";
              }   
        } 

      //$directorio = "../FUPs/Masivo_Original/";
      $directorio_total = glob($directorio."*.pdf");
      $qna = "Qna";
      $fecha = "Fecha";
      $id_consulta_Mov_D =  210;

      $matches = array_filter($directorio_total, function($var) use ($id) { return preg_match("/$id/i", $var); });
      
      if($matches){//matches
        foreach ($matches as $value){//foreach
          $matches_qna = strrpos($value, $qna);
          $matches_fecha = strrpos($value, $fecha);
        } //foreach 
          if ($matches_qna  == true && $matches_fecha != true){ //cuando es por qna
/*
              $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$id\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
              $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
              $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
              $resultados_Mov_D1=$cliente->getConsulta($params_Mov_D);
*/
              if($resultados_Mov_D1==true){
                echo $value;
              } 
          }
          else if ($matches_qna  != true && $matches_fecha == true){//cuando es por fecha
/*
            $JSON_Mov_D2="[{\"area\":\"$area\",\"num_docto\":\"$id\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
            $array_Mov_D2 = json_decode(json_encode($JSON_Mov_D2), True);
            $params_Mov_D2 = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D2); //para conseguir la consulta
            $resultados_Mov_D2=$cliente->getConsulta($params_Mov_D2);
*/
            if($resultados_Mov_D2==true){
              echo $value;
            } 
          }
      }//matches
    }
?>