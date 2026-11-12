<?php
    require_once('../fpdf181/fpdf_protection.php');
    require_once('../fpdi/autoload.php');
    require_once('../Conexion/wsdl.php'); 

    $num_doctos="";
    $activo = "inactivo";//$_GET["dia"];
    $dia = "noactivo";//$_GET['dia'];   
 
    $buscar1 = "2218291728";//$_GET['buscar'];//2216286286 //2016263538
    $usuario = "Paty";//$_GET['usuario'];
    $pendientes = "Admin";//$_GET['rO'];
    $tot_resul_ant = 0;
    $area = "";
    $num_oficio  = "";
    buscar($buscar1,$dia,$usuario,$activo,$cliente,$tot_resul_ant,$pendientes,$area,$num_oficio);         
    


    function firmas_funcion($FECHAD,$pdf,$cliente,$pendientes){//firmas
        $num_firma=0;
        $num_funcion_firma=2;
        $num_nombre_firma=0;
        $num_tipo_archivo=3;
        $num_firmas=1;

        $id_consulta_firmas = 9;
        $metodo_consulta="ConsultaFirmas_Original1";
        include '../Conexion/Metodos_Consultas/metodos_consultas.php';        

        $tot_regis_firmas = count($arrayR_firmas['return']);
        
        foreach($arrayR_firmas as $value){//foreach

            while($num_firma<$tot_regis_firmas){//while
                        
                $func                  = $value[$num_funcion_firma]["funcion_firma"];
                $NOMBRE_AUTORIZACIONES = $value[$num_nombre_firma]["nombre_firma"];
                $TEMPIMGLOC            = $value[$num_tipo_archivo]["tipo_archivo_"];
                $imagen1               = hex2bin($value[$num_firmas]["firmas"]);
                $alto=175;
                $pic1 = "data: image/png;base64,".base64_encode($imagen1)."";
                $dataPieces = explode(',',$pic1);
                $encodedImg = $dataPieces[1];
                $decodedImg = base64_decode($encodedImg);
                //$tamaño = getimagesize($nombre_fichero);
                if($func == 0){  
                    if( $decodedImg!==false )
                    {
                      if( file_put_contents("tempimg".$TEMPIMGLOC,$decodedImg)!==false )
                      {
                        if($pendientes == "CGRH"){
                           $pdf->SetXY(90,$alto);
                           //$pdf->MultiCell(85,42, $pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
                           $pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
                           unlink("tempimg".$TEMPIMGLOC);
                        }
                      }                
                    }        
                    if($pendientes == "CGRH"){
                        $pdf->SetFont('Arial','',8);               
                        $pdf->SetXY(105,186);
                        $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');
                    }
                }

                if($func == 1){ 
                  if( $decodedImg!==false )
                  {
                      if( file_put_contents("tempimg1".$TEMPIMGLOC,$decodedImg)!==false )
                      { 
                        if($pendientes == "Admin"){    
                          $pdf->SetXY(175,$alto);
                          //$pdf->MultiCell(90,40, $pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
                          $pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
                          unlink("tempimg1".$TEMPIMGLOC);
                        }
                      }
                  }                 
                    if($pendientes == "Admin"){    
                        $pdf->SetXY(190,186);
                        $pdf->SetFont('Arial','',8);
                        $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');
                    }
                }
                    $num_funcion_firma=$num_funcion_firma+4;
                    /*if($num_funcion_firma > 6){
                        break;
                    }*/
                    $num_nombre_firma=$num_nombre_firma+4;
                    $num_tipo_archivo=$num_tipo_archivo+4;
                    $num_firmas=$num_firmas+4;

                    $num_firma++;
                    if($num_funcion_firma > 8){
                        break;
                    }
            }//while
        }//foreach
    }//Fin Funcion Firmas

    function abrir_pdf($value,$reviso,$fec_imp,$pdf,$cliente,$pendientes,$buscar,$usuario){//function abrir_pdf

            $pageCount = $pdf->setSourceFile($value);
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            $pdf->AddPage('L', array($size['width'], $size['height']));//$size['height']+4.2
         
            $pdf->useTemplate($templateId);
            $pdf->SetAutoPageBreak(false);

            //$fec = "09/05/2022";
            $FECHAD =          date('Y-m-d', strtotime($fec_imp));//produccion
            $FECHA  =          date('d-m-Y', strtotime($fec_imp));//pruebas

            firmas_funcion($FECHAD,$pdf,$cliente,$pendientes); 
            
            if($pendientes=="activo"){
                $pdf->SetXY(50,196);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(15,4,$usuario,0,0,'L');
            }
            if($pendientes=="Captura"){
                $pdf->SetFont('Arial','',8);
                $pdf->SetXY(76,196);
                $pdf->Cell(14,4,$reviso,0,0,'L');
            }
            if($pendientes == "CGRH"){
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
            }
            if($pendientes == "Admin"){
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
                $pdf->Cell(65,3, utf8_decode("2022-09-20"),0,0,'L');       

                $pdf->SetXY(206,206);  
                $pdf->SetFont('Arial','',15);
                $pdf->Cell(14,3,utf8_decode("FUP ORIGINAL TRAMITADO"),0,0,'L');
                $pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN  
            
                $pdf->SetXY(6,205);
                $pdf->SetFont('Arial','B',8);
                $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L');                          
            }
            if($pendientes == "activo"){
                $pdf->SetXY(50,196);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(15,4, $usuario,0,0,'L');//IMPRIMIO            
            }    
        }

        if($pendientes == "activo"){
            $pdf->Output($value, 'I'); 
        }else{
            $pdf->Output($value, 'I');    
        }    
        echo "hecho";
    }//function abrir_pdf

function buscar($buscar,$dia,$usuario,$activo,$cliente,$total,$pendientes,$area,$num_oficio){

    $pdf = new \setasign\Fpdi\Fpdi('L','mm','LEGAL');

    //$buscar1 = "1402110386";//base64_decode($_POST['num_docto']);
    $directorio = "../FUPs/Masivo_Original/";
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
        if(!empty($arrayRExist1)){
            foreach($arrayRExist1 as $valuesmov1){//2do foreach getDatosPDF_Mov
                $tot_resul_mov1 = $valuesmov1[0]["tot_resu"];   
                $reviso         = $valuesmov1[1]["usuario"];    
            }
        }else{
            //hay que revisar si pasa, porque hay que corregir
            $reviso = "MPLO";
        }
        $id_consultaDatos =  250;
        $JSONDatos="[{\"num_docto\":\"$buscar\"}]";
        $arrayDatos = json_decode(json_encode($JSONDatos), True);
        $paramsDatos = array('Resultado'=>$id_consultaDatos, 'Argumento'=>$arrayDatos, 'Accion'=>"select"); //para conseguir la consulta
        $resultadosDatos=$cliente->getConsulta($paramsDatos);
        $arrayRDatos= json_decode(json_encode($resultadosDatos), True);  
        //var_dump($arrayRDatos);
        
        if(!empty($arrayRDatos)){
            foreach($arrayRDatos as $valuesDatos){//2do foreach getDatosPDF_Mov
                $fec_imp    = $valuesDatos[1]["fec_imp"];   
                $area       = $valuesDatos[2]["area"];    
                $num_oficio = $valuesDatos[3]["num_ofici"];    
            }
        }        
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
    