<?php
    require_once('../fpdf181/fpdf_protection.php');
    require_once('../fpdi/autoload.php');
    require_once('../Conexion/wsdl.php'); 

    $num_doctos="";
    $activo = "inactivo";//$_GET["dia"];
    $dia = "noactivo";//$_GET['dia'];  
/*
    if(isset($_POST['pendientes']))
    {
        $buscar1 = base64_decode($_POST['num_docto']);
        $usuario = $_POST['usu'];
        $pendientes = $_POST['pendientes'];
        $dir = $_POST['dir'];
        $a=0;
        $arrays = json_decode($buscar1, true);
        foreach ( $arrays as $valuesant ) {//inicio_foreach
          $tot_resul_ant = $valuesant[0]['totals'];
            while($a<$tot_resul_ant*3){
              $num_docto     = $valuesant[$a+1]['num_docto'];
              $area          = $valuesant[$a+2]['area'];
              $num_oficio    = $valuesant[$a+3]['num_oficio'];          
              if($tot_resul_ant>1){
                buscar($num_docto,$dia,$usuario,$activo,$cliente,$tot_resul_ant,$pendientes,$area,$num_oficio,$dir);         
              }else{
                $num_doctos = $num_docto;   
                buscar($num_docto,$dia,$usuario,$activo,$cliente,$tot_resul_ant,$pendientes,$area,$num_oficio,$dir);         
              }
            $a=$a+3;
            }
        }//inicio_foreach        
    }
*/
/*
    if(isset($_GET['rO']))
    {
*/        
        $buscar1 = "2403310353";//$_GET['buscar'];
        $usuario = "Jonathan";//$_GET['usuario'];
        $pendientes = "Admin";//$_GET['rO'];
        $tot_resul_ant = 0;
        $area = "";
        $num_oficio  = "";
        $dir = "";
        $id_consultaDIR =  1274;
        $JSONDIR ="[{\"buscar\":\"$buscar1\"}]";
        $arrayDIR  = json_decode(json_encode($JSONDIR ), True);
        $paramsDIR  = array('Resultado'=>$id_consultaDIR , 'Argumento'=>$arrayDIR , 'Accion'=>"select"); //para conseguir la consulta
        $resultadosDIR =$cliente->getConsulta($paramsDIR );
        $arrayRDIR = json_decode(json_encode($resultadosDIR ), True);   
        $xmlDIR  = simplexml_load_string($arrayRDIR ['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
        $jsonDIR  = json_encode($xmlDIR );
        $arrayDIR_  = json_decode($jsonDIR ,TRUE);

        if(!empty($arrayDIR_)){//empty
            $ver1 = $arrayDIR_['NewDataSet']['table'];    
            $ver1_ = $arrayDIR_['NewDataSet'];      

            if(!isset($ver1[0])){
                $cve_mov = $ver1["cve_mov"];
                $mot_mov = $ver1["mot_mov"];

                if( ($cve_mov=="9" && $mot_mov="76" && $usuario=="angeles") || ($cve_mov=="9" && $mot_mov="76" && $usuario=="Veronica") || ($cve_mov=="9" && $mot_mov="76" && $usuario=="Rosaura")){
                    echo " 
                    <script>
                     window.location='../index.php';
                    window.alert('El Número: ".$buscar1." es un Cambio de CT y no se puede Imprimir Original.');
                    window.close();
                    </script>";
                    
                }else if($cve_mov=="9" && $mot_mov="76"){
                    $dir="CT";
                }else{
                    $dir = "";
                }                
            }else{
                $tot_resul_tra=count($ver1);    
              
                  $cve_mov       = $ver1[0]['cve_mov'];
                  $mot_mov       = $ver1[0]["mot_mov"];  
                  if( ($cve_mov=="9" && $mot_mov="76" && $usuario=="angeles") || ($cve_mov=="9" && $mot_mov="76" && $usuario=="Veronica") || ($cve_mov=="9" && $mot_mov="76" && $usuario=="Rosaura")){
                    echo " 
                    <script>
                     window.location='../index.php';
                    window.alert('El Número: ".$buscar1." es un Cambio de CT y no se puede Imprimir Original.');
                    window.close();
                    </script>";
                    
                    }else if($cve_mov=="9" && $mot_mov="76"){
                      $dir="CT";
                  }else{
                    $dir = "";
                  } 
            }
        }//empty

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
        buscar($buscar1,$dia,$usuario,$activo,$cliente,$tot_resul_ant,$pendientes,$area,$num_oficio,$dir);         
/*        
    }
*/    
        function getRealIP() {

            if (!empty($_SERVER['HTTP_CLIENT_IP']))
                return $_SERVER['HTTP_CLIENT_IP'];
               
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
           
            return $_SERVER['REMOTE_ADDR'];
        }

            function firmas_funcion($FECHAD,$pdf,$cliente,$pendientes){
                //var_dump($FECHAD);
                $num_firma=0;
                $num_funcion_firma=2;
                $num_nombre_firma=0;
                $num_tipo_archivo=3;
                $num_firmas=1;

                $id_consulta_firmas = 9;

                $metodo_consulta="ConsultaFirmas_Original1";
                include '../Conexion/Metodos_Consultas/metodos_consultas.php';           
                
                $xml2 = simplexml_load_string($arrayR_firmas['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
                $json2 = json_encode($xml2);
                $array2 = json_decode($json2,TRUE);

                $ver2 = $array2['NewDataSet']['table'];             
                $tot_regis_firmas= count($ver2); 
                  
                while($num_firma<$tot_regis_firmas){//while
                            
                    $func                  = $ver2[$num_firma]["funcion"];
                    $NOMBRE_AUTORIZACIONES = $ver2[$num_firma]["nombre"];
                    $TEMPIMGLOC            = $ver2[$num_firma]["tipo_archivo"];
                    //$imagen1               = /*hex2bin(*/$ver2[$num_firma]["aut"]/*)*/;
                    $imagen1               = $ver2[$num_firma]["aut"];
                    $TEMPIMGLOC1 = str_replace(".", "", $TEMPIMGLOC);

                    $alto=175;//$alto=166;
                    $pic1 = "data: image/".$TEMPIMGLOC1.";base64,".$imagen1."";
                    $dataPieces = explode(',',$pic1);
                    $encodedImg = $dataPieces[1];
                    $decodedImg = base64_decode($encodedImg);

                    if($func == "false"){//0 
                        
                        if( $decodedImg!==false )
                        {
                            
                          if( file_put_contents("tempimg".$TEMPIMGLOC,$decodedImg)!==false )
                          {  
                            if($pendientes == "CGRH"){
                               $pdf->SetXY(90,$alto);
                               //$pdf->MultiCell(85,42, $pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
                               $pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
                               //unlink("tempimg".$TEMPIMGLOC);
                            }
                          }                
                        }           
                        if($pendientes == "CGRH"){                    
                            $pdf->SetFont('Arial','',8);               
                            $pdf->SetXY(105,186);
                            $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');                      
                        }    
                    }
                                        
                    if($func == "true"){//1 
                      if( $decodedImg!==false )
                      {
                          if( file_put_contents("tempimg1".$TEMPIMGLOC,$decodedImg)!==false )
                          {                       
                            if($pendientes == "Admin"){       
                              $pdf->SetXY(175,$alto);
                              //$pdf->MultiCell(90,40, $pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
                              $pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
                              //unlink("tempimg1".$TEMPIMGLOC);
                            }
                          }
                           if($pendientes == "Admin"){
                            $pdf->SetXY(190,186);
                            $pdf->SetFont('Arial','',8);
                            $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');
                           } 
                      }                 
                    }
                    
                        $num_funcion_firma=$num_funcion_firma+4;
                        //if($num_funcion_firma > 6){break;}
                        $num_nombre_firma=$num_nombre_firma+4;
                        $num_tipo_archivo=$num_tipo_archivo+4;
                        $num_firmas=$num_firmas+4;

                        $num_firma++;
                        if($num_funcion_firma > 8){
                            break;
                        }
                }//while
            
            }//Fin Funcion Firmas

    function abrir_pdf($value,$reviso,$fec_imp,$pdf,$cliente,$pendientes,$buscar,$usuario){//function abrir_pdf
                
            $archivos = fopen('abiertos.txt','a');


            $pageCount = $pdf->setSourceFile($value);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            $pdf->AddPage('L', array($size['width'], $size['height']));//$size['height']+4.2
         
            $pdf->useTemplate($templateId);
            $pdf->SetAutoPageBreak(false);

            //$fec = "09/05/2022";
            $FECHAD =         date('Y-m-d', strtotime($fec_imp));//produccion
            //$FECHA =          date('Y-m-d', strtotime($fec_imp));//produccion
            $FECHA =          date('d-m-Y', strtotime($fec_imp));//pruebas
            
            $Object1 = new DateTime();  
            $Object1->setTimezone(new DateTimeZone('America/Mexico_City'));
            $DateAndTime1 = $Object1->format("d-m-Y h:i:s a"); 
            $ip = getRealIP();

            if($pendientes=="activo"){
                if($usuario=="Paty"){
                    $usuario = "MPLO";
                }
                $pdf->SetXY(50,196);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(15,4,$usuario,0,0,'L');
            }
            if($pendientes=="Captura"){
                $pdf->SetFont('Arial','',8);
                $pdf->SetXY(76,196);
                $pdf->Cell(14,4,$reviso,0,0,'L');

                $contenido1 = $DateAndTime1.'-'.$pendientes.'-'.$usuario.'-'.$reviso.'-'.$value.'-'.$ip."\r\n";
                $archivo1 = fopen('Autoriza_Captura.txt','a');

                fputs($archivo1,$contenido1);
                fclose($archivo1);
            }
            if($pendientes == "CGRH"){
                firmas_funcion($FECHAD,$pdf,$cliente,$pendientes); 

                $pdf->Line(5, 181.2, 122-5, 181.2); // PARTE DE ARRIBA

                $pdf->SetXY(120,177);
                $pdf->SetFont('Arial','B',9);
                $pdf->Cell(42,4,"AUTORIZACION",0,0,'L');

                $pdf->SetXY(125,181);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(42,3,"OTORGA VIGE",0,0,'L');

                $pdf->SetXY(98.5,186);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(15,4,"RE",0,0,'L');

                $pdf->Line(105, 189.2, 175-5, 189.2); // PARTE DE ABAJO DE RESPUESTA    

                $pdf->Line(105, 193.2, 175-5, 193.2); // PARTE DE ABAJO DE RESPUESTA //FIRMA

                $pdf->SetXY(97.6,196);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(14,3,"A",0,0,'L');

                $pdf->SetXY(105,196);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(65,3, utf8_decode($FECHA),0,0,'L');

                $pdf->Line(105, 198.5, 175-5, 198.5); // PARTE DE ABAJO DE RESPUESTA     

                $pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN  
                
                $pdf->SetXY(6,205);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L'); 

                $contenido2 = $DateAndTime1.'-'.$pendientes.'-'.$usuario.'-'.$reviso.'-'.$value.'-'.$ip."\r\n";
                $archivo2 = fopen('Autorizados_CGRH.txt','a');

                fputs($archivo2,$contenido2);
                fclose($archivo2);                              
            }
            if($pendientes == "Admin"){
                //firmas_funcion($FECHAD,$pdf,$cliente,$pendientes); 

                $pdf->Line(190, 162.3, 190, 181.2);//linea vertical derecha

                $pdf->Line(160, 181.2, 352-5, 181.2); // PARTE DE ARRIBA 2

                $TEXTO="SE HACE CONSTAR QUE EL TRABAJADOR PROTESTA DESEMPEÑAR LEAL Y PATRIOTICAMENTE EL PUESTO QUE SE LE HA CONFERIDO Y GUARDAR Y HACER GUARDAR LA CONSTITUCION POLITICA DE LOS ESTADOS UNIDOS MEXICANOS Y LAS LEYES QUE DE ELLA EMANEN";

                $pdf->SetXY(190,162.3);
                $pdf->SetFont('Arial','',7);
                $pdf->MultiCell(80,3.5,utf8_decode($TEXTO),0,'J',false);

                $pdf->SetXY(210,181);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(42,4,"AUTORIZA",0,0,'L');

                $pdf->SetXY(183.5,186);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(15,4,"RE",0,0,'L');

                $pdf->Line(260, 189.2, 195-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

                $pdf->Line(260, 193.2, 195-5, 193.2); // PARTE DE ABAJO DE RESPUESTA //FIRMA

                $pdf->SetXY(175,196);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(14,3,"FECHA",0,0,'L');    

                $pdf->Line(260, 198.5, 195-5, 198.5); // PARTE DE ABAJO DE RESPUESTA   

                $pdf->SetXY(190,196);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(65,3, utf8_decode($FECHA),0,0,'L');       

                $pdf->SetXY(206,206);  
                $pdf->SetFont('Arial','',15);
                $pdf->Cell(14,3,utf8_decode("FUP ORIGINAL TRAMITADO"),0,0,'L');
                
                $pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN  
                
                $pdf->SetXY(6,205);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L');             
                

                $contenido3 = $DateAndTime1.'-'.$pendientes.'-'.$usuario.'-'.$reviso.'-'.$value.'-'.$ip."\r\n";
                $archivo3 = fopen('Autorizados_Admin.txt','a');

                fputs($archivo3,$contenido3);
                fclose($archivo3);                   
            }

            if($pendientes == "activo"){
                $pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN  
                
                $pdf->SetXY(6,205);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L'); 

                $pdf->SetXY(50,196);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(15,4,$usuario,0,0,'L');//IMPRIMIO            
            }    
        }

        if($pendientes == "activo"){
            $pdf->Output($value, 'I'); 
            //$pdf->Output($value, 'F');
        }else{
            $pdf->Output($value, 'I');    
        }    
        //echo "hecho";
        $hecho = "hecho";
        $contenidos = $DateAndTime1.'-'.$pendientes.'-'.$usuario.'-'.$hecho.'-'.$buscar.'-'.$ip."\r\n";
        fputs($archivos,$contenidos);
        fclose($archivos); 
    }//function abrir_pdf

function buscar($buscar,$dia,$usuario,$activo,$cliente,$total,$pendientes,$area,$num_oficio,$dir){

    $pdf = new \setasign\Fpdi\Fpdi('L','mm','LEGAL');
    $pendientes1 = "";
    //$buscar1 = "1402110386";//base64_decode($_POST['num_docto']);
    if($dir!="CT"){
        $directorio = "../FUPs/Masivo_Original/";
    }else{
        $directorio = "../FUPs/Masivo_Original/CCT/";
        $pendientes1 = "Captura";
    }
    
    //
    $directorio_total = glob($directorio."*.pdf");
    $qna = "Fecha";
    $qna1 = "Qna";

    $matches_qna = "";
    $matches_qna1 = "";
    $matches = array_filter($directorio_total, function($var) use ($buscar) { return preg_match("/$buscar/i", $var); });
    if($matches){

        $id_consultaExist1 =  207;
        $JSONExist1="[{\"num_docto\":\"$buscar\"}]";
        $arrayExist1 = json_decode(json_encode($JSONExist1), True);
        $paramsExist1 = array('Resultado'=>$id_consultaExist1, 'Argumento'=>$arrayExist1, 'Accion'=>"select"); //para conseguir la consulta
        $resultadosExist1=$cliente->getConsulta($paramsExist1);
        $arrayRExist1= json_decode(json_encode($resultadosExist1), True);   
        $xml = simplexml_load_string($arrayRExist1['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        //var_dump($array);
        if(empty($array)){
                $reviso = "MPLO";
        }else{
            //hay que revisar si pasa, porque hay que corregir
            $ver = $array['NewDataSet']['table'];
            $reviso         = $ver["usuario"];    
        }
        $id_consultaDatos =  250;
        $JSONDatos="[{\"num_docto\":\"$buscar\"}]";
        $arrayDatos = json_decode(json_encode($JSONDatos), True);
        $paramsDatos = array('Resultado'=>$id_consultaDatos, 'Argumento'=>$arrayDatos, 'Accion'=>"select"); //para conseguir la consulta
        $resultadosDatos=$cliente->getConsulta($paramsDatos);
        $arrayRDatos= json_decode(json_encode($resultadosDatos), True);  
        //var_dump($arrayRDatos);
        $xml1 = simplexml_load_string($arrayRDatos['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
        $json1 = json_encode($xml1);
        $array1 = json_decode($json1,TRUE);
        if(!empty($array1)){
            $ver1 = $array1['NewDataSet']['table'];

            $fec_imp    = $ver1["fecha"];   
            if($fec_imp == "" || $fec_imp == "NULL"){
                $fec_imp = date('Y-m-d');
            }
            /*
            if($fec_imp<="2014-10-29 00:00:00.0"){
                include '../../Cascaron/Cascaron_man2013.php';
            }elseif($fec_imp>"2014-10-29 00:00:00.0" && $fec_imp<="2021-11-15 00:00:00.0"){
                include '../../Cascaron/Cascaron_man.php';
            }else{  
                include '../../Cascaron/Cascaron.php';
            }
            */
            $area       = $ver1["area"];    
            $num_oficio = $ver1["num_oficio"];   
        }

        $id_consulta_Mov_D="";
        $Object = new DateTime();  
        $Object->setTimezone(new DateTimeZone('America/Mexico_City'));
        $DateAndTime = $Object->format("d-m-Y h:i:s a");      

        $ip = getRealIP();

        if($pendientes1=="Captura"){
            $observacion = "Autoriza Captura";
            $operacion   = "Autoriza Captura";
            $id_consulta_Mov_D  = 195;

            $contenido = $DateAndTime.'-'.$pendientes.'-'.$usuario.'-'.$reviso.'-'.$buscar.'-'.$ip."\r\n";
            $archivo = fopen('Autoriza_Captura_bitacora_195.txt','a');

            fputs($archivo,$contenido);
            fclose($archivo);            
        }

        switch ($pendientes) {
            case 'Captura':
                $observacion = "Autoriza Captura";
                $operacion   = "Autoriza Captura";
                $id_consulta_Mov_D  = 195;
 
                $contenido = $DateAndTime.'-'.$pendientes.'-'.$usuario.'-'.$reviso.'-'.$buscar.'-'.$ip."\r\n";
                $archivo = fopen('Autoriza_Captura_bitacora_195.txt','a');

                fputs($archivo,$contenido);
                fclose($archivo);

                break;
            case 'CGRH':
                $observacion = "Autoriza CGRH";
                $operacion   = "Autoriza CGRH";
                $id_consulta_Mov_D  = 246;

                $contenido = $DateAndTime.'-'.$pendientes.'-'.$usuario.'-'.$reviso.'-'.$buscar.'-'.$ip."\r\n";
                $archivo = fopen('Autoriza_CGRH_bitacora_246.txt','a');

                fputs($archivo,$contenido);
                fclose($archivo);

                break;      
            case 'Admin':
                $observacion = "Autoriza Admin";
                $operacion   = "Autoriza Admin";
                $id_consulta_Mov_D  = 247;

                $contenido = $DateAndTime.'-'.$pendientes.'-'.$usuario.'-'.$reviso.'-'.$buscar.'-'.$ip."\r\n";
                $archivo = fopen('Autoriza_Admin_bitacora_247.txt','a');

                fputs($archivo,$contenido);
                fclose($archivo);

                break;                                          
            case 'activo'://rO
                $observacion = "Imprimio Original";
                $operacion   = "Imprimio Original";
                $id_consulta_Mov_D  = 210;

                $contenido = $DateAndTime.'-'.$pendientes.'-'.$usuario.'-'.$reviso.'-'.$buscar.'-'.$ip."\r\n";
                $archivo = fopen('Imprimio_Original_bitacora_210.txt','a');

                fputs($archivo,$contenido);
                fclose($archivo);

                break;    
        }
        //bitacora y autorizar
        $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$buscar\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
        $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
        $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D);
        $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);        
        
        foreach ($matches as $value){//foreach
            $matches_qna = strrpos($value, $qna);
            $matches_qna1 = strrpos($value, $qna1);
        }//foreach  

        if ($matches_qna  == true && $matches_qna1 != true){ //cuando es por fecha
            abrir_pdf($value,$reviso,$fec_imp,$pdf,$cliente,$pendientes,$buscar,$usuario);
        }
        else if ($matches_qna  != true && $matches_qna1 == true){//cuando es por qna
            abrir_pdf($value,$reviso,$fec_imp,$pdf,$cliente,$pendientes,$buscar,$usuario);
        }
    }
}//buscar
?>