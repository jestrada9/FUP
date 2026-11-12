<?php
    //error_reporting(0);
    $SelloCGRH21 = "../../Logo/sello/SelloCGRH21.png";
    $SelloAdm21 = "../../Logo/sello/SelloAdm21.png";

    $NOMBRE_AUTORIZACIONES = "";
    $NOMBRE_AUTORIZA = "";
    $activo = $_GET["dia"];
    $id_consultaP =     95;//11//53
    $JSONP="[{\"num_docto\":\"$buscar\"}]";

    $arrayRP = json_decode(json_encode($JSONP), True);
    $paramsP1 = array('Resultado'=>$id_consultaP, 'Argumento'=>$arrayRP); //para conseguir la consulta
    $resultadoP=$cliente->getConsulta($paramsP1);   
    $arrayRP5= json_decode(json_encode($resultadoP), True);
    //var_dump($arrayRP5);
    if (empty($arrayRP5)) {

            $id_consultaT =  68;//13
    $JSONT="[{\"num_docto\":\"$buscar\"}]";

    $arrayRT = json_decode(json_encode($JSONT), True);
    $paramsT = array('Resultado'=>$id_consultaT, 'Argumento'=>$arrayRT); //para conseguir la consulta
    $resultadosT=$cliente->getConsulta($paramsT);
    $arrayRsT= json_decode(json_encode($resultadosT), True);

    foreach($arrayRsT as $valuess){ //inicio foreach arrayRsT
    $total_resT=$valuess[0]["tot_resu"];
    $is3=0; 
    $y = 0;
    while ($y <= $total_resT*48){//inicio while $y
/*------------------------------------------------------------------------------------------------------------------------------------------------*/         
    $id_consultaM =  96;//14
    $JSONM="[{\"num_docto\":\"$buscar\"}]";

    $arrayRM = json_decode(json_encode($JSONM), True);
    $paramsM = array('Resultado'=>$id_consultaM, 'Argumento'=>$arrayRM); //para conseguir la consulta
    $resultadoss22=$cliente->getConsulta($paramsM);  
    $arrayM= json_decode(json_encode($resultadoss22), True);
    //var_dump($arrayM);
    $y11=0;
    foreach($arrayM as $valuess44){
        $total_resM=$valuess44[0]["tot_resu"];
        
    $is1=0;         
       
    while ($y11 <= $total_resM*24){

    $placve_mov1=        $valuess44[$y11+1]['placve_mov'];
    $placve_mov = str_pad($placve_mov1, 2, "0", STR_PAD_LEFT);
    $plamot_mov=        $valuess44[$y11+2]['plamot_mov'];
    $placons_doc=         $valuess44[$y11+3]['placons_doc'];
    $plapartida=        $valuess44[$y11+4]['plapartida'];
    if ($plapartida == "0"){
      $plapartida = "";
    } 
    $placod_pago1=         $valuess44[$y11+5]['placod_pago'];
    $placod_pago = str_pad($placod_pago1, 2, "0", STR_PAD_LEFT);
    if ($placod_pago == "0"){
      $placod_pago = "";
    } 
    $plaunidad=         $valuess44[$y11+6]['plaunidad'];
    if ($plaunidad == "0"){
      $plaunidad = "";
    } 
    $plasubunidad=        $valuess44[$y11+7]['plasubunidad'];
    if ($plasubunidad == "0"){
      $plasubunidad = "";
    }
    $placat_puesto=       $valuess44[$y11+8]['placat_puesto'];
    $plahoras=          $valuess44[$y11+9]['plahoras'];
    $placons_plaza=       $valuess44[$y11+10]['placons_plaza'];
    if ($placons_plaza == "0"){
      $placons_plaza = "";
    } 
    $plaqna_ini=        $valuess44[$y11+11]['plaqna_ini'];
    $plaqna_fin=          $valuess44[$y11+12]['plaqna_fin'];
    $planom_emp=        $valuess44[$y11+13]['planom_emp'];

    if($planom_emp == "NULL"){
      $plamot_movsub = "";
    }
    $plarfc=          $valuess44[$y11+14]['plarfc'];
    $plamot_movsub=       $valuess44[$y11+15]['plamot_movsub'];
    if($plamot_movsub == NULL){
      $plamot_movsub = "";
    }
    if($plamot_movsub == "0"){
      $plamot_movsub = "";
    }
    $plaqna_inisub=       $valuess44[$y11+16]['plaqna_inisub'];
    if($plaqna_inisub == NULL){
      $plaqna_inisub = "";
    }
    if($plaqna_inisub == "0"){
      $plaqna_inisub = "";
    }
    $plaqna_finsub=       $valuess44[$y11+17]['plaqna_finsub'];
    if($plaqna_finsub == NULL){
      $plaqna_finsub = "";
    }
    if($plaqna_finsub == "0"){
      $plaqna_finsub = "";
    }
    $planum_doctosub=       $valuess44[$y11+18]['planum_doctosub'];
    if($planum_doctosub == NULL){
      $planum_doctosub = "";
    }
    if($planum_doctosub == "0"){
      $planum_doctosub = "";
    }
    $plactnvo=          $valuess44[$y11+19]['plactnvo'];
    $planivel_sueldonvo=    $valuess44[$y11+20]['planivel_sueldonvo'];
    if($planivel_sueldonvo == NULL){
      $planivel_sueldonvo = "";
    }
    if($planivel_sueldonvo == "0"){
      $planivel_sueldonvo = "";
    }
    $plabasificacion=       $valuess44[$y11+21]['plabasificacion'];
    if($plabasificacion == NULL){
      $plabasificacion = "";
    }
    if($plabasificacion == "0"){
      $plabasificacion = "";
    }
    $plapromocion=        $valuess44[$y11+22]['plapromocion'];
    if($plapromocion == NULL){
      $plapromocion = "";
    }
    if($plapromocion == "0"){
      $plapromocion = "";
    }
    $plaqna_ing_sub=      $valuess44[$y11+23]['plaqna_ing_sub'];
    if($plaqna_ing_sub == NULL){
      $plaqna_ing_sub = "";
    }
    if($plaqna_ing_sub == "0"){
      $plaqna_ing_sub = "";
    }
    $DESCRIPCION2=         $valuess44[$y11+24]['pladescripcion1'];
    $DESCRIPCION1=         $valuess44[$y11+25]['pladescripcion2'];
    $DESCRIPCION =         $DESCRIPCION1." ".$DESCRIPCION2;
    $fecha_def=            $valuess44[$y11+26]['fecha_defu'];

  
if($placve_mov == "04" || $placve_mov == "03"){
    $id_consultaCMP =  125;//13
    $JSONCMP="[{\"num_docto\":\"$buscar\"}]";

    $arrayRCMP = json_decode(json_encode($JSONCMP), True);
    $paramsCMP = array('Resultado'=>$id_consultaCMP, 'Argumento'=>$arrayRCMP); //para conseguir la consulta
    $resultadosCMP=$cliente->getConsulta($paramsCMP);
    $arrayRsCMP= json_decode(json_encode($resultadosCMP), True);
    //var_dump($arrayRsCMP);
    $ycmp=0;
    foreach($arrayRsCMP as $valuescmp){
            $total_rescmp=$valuescmp[0]["tot_resu"];
            
      $cmp=0;         
           
            while ($ycmp <= $total_rescmp*19){
              $cmppartida = $valuescmp[$ycmp+1]["cmppartidaR1"];
              $cmppartidaR1 = str_pad($cmppartida, 4, "0", STR_PAD_LEFT);
              $cmpcod_pago = $valuescmp[$ycmp+2]["cmpcod_pagoR1"];
              $cmpcod_pagoR1 = str_pad($cmpcod_pago, 2, "0", STR_PAD_LEFT);
              $cmpunidad = $valuescmp[$ycmp+3]["cmpunidadR1"];
              $cmpunidadR1 = str_pad($cmpunidad, 2, "0", STR_PAD_LEFT);
              $cmpsubunidad = $valuescmp[$ycmp+4]["cmpsubunidadR1"];
              $cmpsubunidadR1 = str_pad($cmpsubunidad, 2, "0", STR_PAD_LEFT);
              $cmpcat_puestoR1 = $valuescmp[$ycmp+5]["cmpcat_puestoR1"];
              $cmphoras = $valuescmp[$ycmp+6]["cmphorasR1"];
              $cmphorasR1 = str_pad($cmphoras, 2, "0", STR_PAD_LEFT);
              $cmpcons_plazaR1 = $valuescmp[$ycmp+7]["cmpcons_plazaR1"];
              if($cmpcons_plazaR1 == 0){
                $cmpcons_plazaR1 = "";
              }
              $cmpqna_iniR1 = $valuescmp[$ycmp+9]["cmpqna_iniR1"];
              $cmpqna_finR1 = $valuescmp[$ycmp+10]["cmpqna_finR1"];
              $cmpanio_procR1 = $valuescmp[$ycmp+11]["cmpanio_procR1"];
              $cmpfijoR1 = $valuescmp[$ycmp+12]["cmpfijoR1"];
              $cmpprogramaR1 = $valuescmp[$ycmp+13]["cmpprogramaR1"];
              $cmpsubprogramaR1 = $valuescmp[$ycmp+14]["cmpsubprogramaR1"];
              $cmpproyectoR1 = $valuescmp[$ycmp+15]["cmpproyectoR1"];
              $cmpunidad_respR1 = $valuescmp[$ycmp+16]["cmpunidad_respR1"];
              $cmpconceptoR1 = $valuescmp[$ycmp+17]["cmpconceptoR1"];
              $cmpabcR1 = $valuescmp[$ycmp+18]["cmpabcR1"];
              $cmpimporteanteriorR1 = $valuescmp[$ycmp+8]["cmpimporteanteriorR1"];
              $cmpimportenuevoR1 = $valuescmp[$ycmp+19]["cmpimportenuevoR1"];
              $cmpAutorizado = $cmpimportenuevoR1 - $cmpimporteanteriorR1;
              if($cmpimporteanteriorR1 == 0.0000 ){
                $cmpimporteanteriorR1 = "0.00";
              }
              if($cmpimportenuevoR1 == 0.0000 ){
                $cmpimportenuevoR1 = "0.00";
              }              
              $cmpjustificacionR1 = $valuescmp[$ycmp+20]["cmpjustificacionR1"];
              if($cmpimportenuevoR1 == 0.00 && $cmpimporteanteriorR1 == 0.00){
                $cmpAutorizado = "0.00";
              }
              
    if($cmp >= 10 && $pdf->PageNo() == 1){
          $pdf->SetXY(5,121);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6,3,$cmppartidaR1,0,0,'L');



    }  
    else{

          $pdf->SetXY(130,77.5);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"M O D I F I C A C I O N E S  A:",0,0,'L');

          $pdf->SetXY(5,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,"PDA.",0,0,'L'); 

          $pdf->SetXY(13,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(4,3,"CP",0,0,'L'); 

          $pdf->SetXY(15,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"CLAVE DE PAGO AFECTADA",0,0,'L');

          $pdf->SetXY(18,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(4,3,"U",0,0,'L');

          $pdf->SetXY(21,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(4,3,"SU",0,0,'L');     

          $pdf->SetXY(28,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"CATEG.",0,0,'L');  

          $pdf->SetXY(39,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"HRS.",0,0,'L');    

          $pdf->SetXY(49,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"PLAZA",0,0,'L');                                              

          $pdf->SetXY(60,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"CLAVE PRESUPUESTARIA",0,0,'L');

          $pdf->SetXY(69,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(20,3,"Y CONCEPTO",0,0,'L'); 

          $pdf->SetXY(100,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"MOV.",0,0,'L'); 

          $pdf->SetXY(110,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"ACTUAL",0,0,'L'); 

          $pdf->SetXY(118,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"IMPORTES MENSUALES",0,0,'L');

          $pdf->SetXY(125,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"INC./DISM.",0,0,'L'); 

          $pdf->SetXY(145,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"AUTORIZADO",0,0,'L'); 

          $pdf->SetXY(168,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"EFECTOS",0,0,'L');

          $pdf->SetXY(165,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"DESDE",0,0,'L'); 

          $pdf->SetXY(175,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"HASTA",0,0,'L'); 

          $pdf->SetXY(190,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"JUSTIFICACION",0,0,'L');

          $pdf->SetXY(5,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmppartidaR1,0,0,'L');      

          $pdf->SetXY(13,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpcod_pagoR1,0,0,'L'); 

          $pdf->SetXY(17,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpunidadR1,0,0,'L'); 

          $pdf->SetXY(21,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpsubunidadR1,0,0,'L'); 

          $pdf->SetXY(28,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,$cmpcat_puestoR1,0,0,'L'); 

          $pdf->SetXY(39,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmphorasR1,0,0,'L'); 

          $pdf->SetXY(47,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(12,3,$cmpcons_plazaR1,0,0,'L'); 

          $pdf->SetXY(60,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpanio_procR1.".",0,0,'L'); 

          $pdf->SetXY(66.5,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpfijoR1.".",0,0,'L'); 

          $pdf->SetXY(74,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpprogramaR1.".",0,0,'L'); 

          $pdf->SetXY(78,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpsubprogramaR1.".",0,0,'L'); 

          $pdf->SetXY(82,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpproyectoR1.".",0,0,'L'); 

          $pdf->SetXY(86,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpunidad_respR1,0,0,'L'); 

          $pdf->SetXY(94,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpconceptoR1,0,0,'L');

          $pdf->SetXY(100,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpabcR1,0,0,'L'); 

          $pdf->SetXY(110,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(14,3,"$".$cmpimporteanteriorR1,0,0,'L');                                                                                  
          $pdf->SetXY(126,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(14,3,"$".$cmpAutorizado,0,0,'L');

          $pdf->SetXY(144,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(17,3,"$".$cmpimportenuevoR1,0,0,'L');          

          $pdf->SetXY(165,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpqna_iniR1,0,0,'L'); 

          $pdf->SetXY(175,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpqna_finR1,0,0,'L'); 

          $pdf->SetXY(190,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(50,3,$cmpjustificacionR1,0,0,'L');                                                                              

    }
              $ycmp = $ycmp + 20;//aqui
            }

           } 
         }

    if($is1 >= 10 && $pdf->PageNo() == 1){
    $pdf->AddPage();  
    $pdf->SetXY(5,121);   
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$placve_mov,0,0,'L');

    $pdf->SetXY(9.5,121);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$plamot_mov,0,0,'L');

    $pdf->SetXY(14,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7.5,3,$plapartida,0,0,'L');

    $pdf->SetXY(21.8,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$placod_pago,0,0,'L');

    $pdf->SetXY(28,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plaunidad,0,0,'L');

    $pdf->SetXY(34,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plasubunidad,0,0,'L');

    $pdf->SetXY(40,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placat_puesto,0,0,'L');

    $pdf->SetXY(51,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plahoras,0,0,'L');

    $pdf->SetXY(59,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placons_plaza,0,0,'L');

    $pdf->SetXY(70,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_ini,0,0,'L');

    $pdf->SetXY(81,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_fin,0,0,'L');

    $pdf->SetXY(93,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(72,3,$planom_emp,0,0,'L');

    $pdf->SetXY(165,121); 
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(24,3,$plarfc,0,0,'L');

    $pdf->SetXY(189,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7,3,$plamot_movsub,0,0,'L');

    $pdf->SetXY(196,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_inisub,0,0,'L');

    $pdf->SetXY(206,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_finsub,0,0,'L');

    $pdf->SetXY(220,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(18,3,$planum_doctosub,0,0,'L');

    $pdf->SetXY(237.5,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(16.5,3,$plactnvo,0,0,'L');

    $pdf->SetXY(254.5,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$planivel_sueldonvo,0,0,'C');

    $pdf->SetXY(266,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plabasificacion,0,0,'L');

    $pdf->SetXY(275,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(12.5,3,$plapromocion,0,0,'L');

    $pdf->SetXY(288,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(13,3,$plaqna_ing_sub,0,0,'L');
            //119
    $pdf->SetXY(300,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(41,3,utf8_decode($DESCRIPCION),0,0,'L');
    $is1++;

    }else{

    if($pdf->PageNo() == 1 && $is1 < 10){
    $pdf->SetXY(5,121+($is1)+($is1)+($is1));   
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$placve_mov,0,0,'L');

    $pdf->SetXY(9.5,121+($is1)+($is1)+($is1));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$plamot_mov,0,0,'L');

    $pdf->SetXY(14,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7.5,3,$plapartida,0,0,'L');

    $pdf->SetXY(21.8,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$placod_pago,0,0,'L');

    $pdf->SetXY(28,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plaunidad,0,0,'L');

    $pdf->SetXY(34,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plasubunidad,0,0,'L');

    $pdf->SetXY(40,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placat_puesto,0,0,'L');

    $pdf->SetXY(51,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plahoras,0,0,'L');

    $pdf->SetXY(59,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placons_plaza,0,0,'L');

if($placve_mov == "06" && $plamot_mov == "75" && $activo == "activo"){



      $DESDE_MOVs1 = substr( $fecha_def, 0,11  );
      $date = date_create($DESDE_MOVs1);
      $DESDE_MOVs = date_format($date, 'd-m-Y ');
      //$DESDE_MOVs = substr_replace($fechaEntera, $dias, 0, 0);

    $pdf->SetXY(70,121+($is1)+($is1)+($is1));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');
  }else
   if(($placve_mov == "06" && $plamot_mov == "31" && $activo != "activo") || ($placve_mov == "06" && $plamot_mov == "33" && $activo != "activo")){

    
    $onlyconsonants = str_replace("/", "-", $fecha_def);
    $date = date_create($onlyconsonants);
    $DESDE_MOV = date_format($date, 'd-m-Y ');
    //echo $DESDE_MOV;
$pdf->SetXY(70,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$DESDE_MOV,0,0,'L');
    

    }else{
    
    $pdf->SetXY(70,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_ini,0,0,'L');

    $pdf->SetXY(81,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_fin,0,0,'L');
 
  
  }

     if($placve_mov == "01" || $placve_mov == "02" || $placve_mov == "17" || $placve_mov == "30"){
          $pdf->SetXY(93,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(72,3,$planom_emp,0,0,'L');

    $pdf->SetXY(165,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(24,3,$plarfc,0,0,'L');

    $pdf->SetXY(189,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7,3,$plamot_movsub,0,0,'L');

    $pdf->SetXY(196,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_inisub,0,0,'L');

    $pdf->SetXY(206,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_finsub,0,0,'L');

    $pdf->SetXY(220,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(18,3,$planum_doctosub,0,0,'L');
  }

    $pdf->SetXY(237.5,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(16.5,3,$plactnvo,0,0,'L');

    $pdf->SetXY(254.5,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$planivel_sueldonvo,0,0,'C');

    $pdf->SetXY(266,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plabasificacion,0,0,'L');

    $pdf->SetXY(275,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(12.5,3,$plapromocion,0,0,'L');

    $pdf->SetXY(288,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(13,3,$plaqna_ing_sub,0,0,'L');
            //119
    $pdf->SetXY(300,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(41,3,utf8_decode($DESCRIPCION),0,0,'L');
    $is1++;
  }
  
  if($pdf->PageNo() == 2){
    $pdf->SetXY(5,91+($is1)+($is1)+($is1));   
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$placve_mov,0,0,'L');

    $pdf->SetXY(9.5,91+($is1)+($is1)+($is1));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$plamot_mov,0,0,'L');

    $pdf->SetXY(14,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7.5,3,$plapartida,0,0,'L');

    $pdf->SetXY(21.8,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$placod_pago,0,0,'L');

    $pdf->SetXY(28,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plaunidad,0,0,'L');

    $pdf->SetXY(34,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plasubunidad,0,0,'L');

    $pdf->SetXY(40,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placat_puesto,0,0,'L');

    $pdf->SetXY(51,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plahoras,0,0,'L');

    $pdf->SetXY(59,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placons_plaza,0,0,'L');

   if($placve_mov == "06" && $plamot_mov == "75" && $activo == "activo"){



      $DESDE_MOVs1 = substr( $fecha_def, 0,11  );
      $date = date_create($DESDE_MOVs1);
      $DESDE_MOVs = date_format($date, 'd-m-Y ');
      //$DESDE_MOVs = substr_replace($fechaEntera, $dias, 0, 0);

    $pdf->SetXY(70,121+($is1)+($is1)+($is1));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');
  }else
   if(($placve_mov == "06" && $plamot_mov == "31" && $activo != "activo")  || ($placve_mov == "06" && $plamot_mov == "33") && $activo != "activo"){
    
    
    $onlyconsonants = str_replace("/", "-", $fecha_def);
    $date = date_create($onlyconsonants);
    $DESDE_MOV = date_format($date, 'd-m-Y ');
    //echo $DESDE_MOV;
$pdf->SetXY(70,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$DESDE_MOV,0,0,'L');

    }else{
    
    $pdf->SetXY(70,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_ini,0,0,'L');

    $pdf->SetXY(81,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_fin,0,0,'L');
   
  }

    if($placve_mov == "01" || $placve_mov == "02" || $placve_mov == "17" || $placve_mov == "30"){
    $pdf->SetXY(93,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(72,3,$planom_emp,0,0,'L');

    $pdf->SetXY(165,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(24,3,$plarfc,0,0,'L');

    $pdf->SetXY(189,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7,3,$plamot_movsub,0,0,'L');

    $pdf->SetXY(196,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_inisub,0,0,'L');
    
    $pdf->SetXY(206,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_finsub,0,0,'L');

    $pdf->SetXY(220,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(18,3,$planum_doctosub,0,0,'L');
  }
    $pdf->SetXY(237.5,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(16.5,3,$plactnvo,0,0,'L');

    $pdf->SetXY(254.5,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$planivel_sueldonvo,0,0,'C');

    $pdf->SetXY(266,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plabasificacion,0,0,'L');

    $pdf->SetXY(275,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(12.5,3,$plapromocion,0,0,'L');

    $pdf->SetXY(288,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(13,3,$plaqna_ing_sub,0,0,'L');
            //119
    $pdf->SetXY(300,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(41,3,utf8_decode($DESCRIPCION),0,0,'L');
$is1++;
  } 
}

$y11 = $y11 + 25;

 
    $FECHA= date('d')."/".$meses[date('n')-1]. "/".date('Y') ;
    $si=              $valuess[$y+1]['perarea'];
    //echo $si;
    if ($si == "3153" ){
    $perarea=           " ";
    }else{
    $perarea=           $valuess[$y+1]['perarea'];
    }
    $pernum_docto=      $valuess[$y+2]['pernum_docto'];
    $perrfc=            $valuess[$y+3]['perrfc'];
    $pernom_emp=        $valuess[$y+4]['pernom_emp'];
    $peredo_nac=        $valuess[$y+5]['peredo_nac'];
    $persexo=           $valuess[$y+6]['persexo'];
    $peredo_civil=      $valuess[$y+7]['peredo_civil'];
    $peremp_dom=        $valuess[$y+8]['peremp_dom'];
    $peremp_dom_cp=     $valuess[$y+9]['peremp_dom_cp'];
    $peremp_dom_col=    $valuess[$y+10]['peremp_dom_col'];
    $peremp_dom_pb=     $valuess[$y+11]['peremp_dom_pob'];
    $perniv_academico=  $valuess[$y+12]['perniv_academico'];
    $perqna_ing_gob=    $valuess[$y+13]['perqna_ing_gob'];
    $perqna_ing_sep=    $valuess[$y+14]['perqna_ing_sep'];
    //$pernum_tit=        $valuess[$y+15]['pernum_tit'];
    $numero1 =          $valuess[$y+15]['pernum_tit'];
    $pernum_tit =       str_pad($numero1, 9, "0", STR_PAD_LEFT);
    //$pernum_lic=        $valuess[$y+16]['pernum_lic'];
    $numero2 =          $valuess[$y+16]['pernum_lic'];
    $pernum_lic =       str_pad($numero2, 9, "0", STR_PAD_LEFT);
    $perq=              $valuess[$y+17]['perq'];
    $pera=              $valuess[$y+18]['pera'];
    $perl=              $valuess[$y+19]['perl'];
    $pert=              $valuess[$y+20]['pert'];
    $perct1=            $valuess[$y+21]['perct1'];
    $perhr1=            $valuess[$y+22]['perhr1'];
    $perct2=            $valuess[$y+23]['perct2'];
    $perhr2=            $valuess[$y+24]['perhr2'];
    $perct3=            $valuess[$y+25]['perct3'];
    $perhr3=            $valuess[$y+26]['perhr3'];
    $perct4=            $valuess[$y+27]['perct4'];
    $perhr4=            $valuess[$y+28]['perhr4'];
    $perct5=            $valuess[$y+29]['perct5'];
    $perhr5=            $valuess[$y+30]['perhr5'];
    $perct6=            $valuess[$y+31]['perct6'];
    $perhr6=            $valuess[$y+32]['perhr6'];
    $perrfc_nuevo=      $valuess[$y+33]['perrfc_nuevo'];
    $nom_area=          $valuess[$y+34]['pernom_area'];
    $curp=              $valuess[$y+35]['percurp'];
    $doc_anexa1=        $valuess[$y+36]['perdoc_anexa1'];
    $doc_anexa2=        $valuess[$y+37]['perdoc_anexa2'];
    $doc_anexa3=        $valuess[$y+38]['perdoc_anexa3'];
    $doc_anexa4=        $valuess[$y+39]['perdoc_anexa4'];
    $obsrv1=            $valuess[$y+40]['perobsrv1'];
    $obsrv2=            $valuess[$y+41]['perobsrv2'];
    $obsrv3=            $valuess[$y+42]['perobsrv3'];
    $obsrv4=            $valuess[$y+43]['perobsrv4'];
    $num_oficio=        $valuess[$y+44]['pernum_oficio'];
    $operador=          $valuess[$y+45]['peroperador'];
    $code =             $valuess[$y+46]['percpr'];
    $FEC_IMP=           $valuess[$y+47]['percaptura'];
    $fechaEntera1 = substr( $FEC_IMP, 0 ,10 );
    $onlyconsonants1 = str_replace("/", "-", $fechaEntera1);
    $date1 = date_create($onlyconsonants1);
    $FEC_IMPS = date_format($date1, 'd-m-Y ');
    //echo $FEC_IMPS;
    $cve_mov=           $valuess[$y+48]['percve_mov'];
    /*$cmpabc=          $valuess[$y+1]['cmpabc'];
    $cmpconcepto=       $valuess[$y+19]['cmpconcepto'];*/

    if($pdf->PageNo() == 1 && $is3 <= 1){

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(5,25.5);
    $pdf->Cell(37.5,3.8,$perrfc,0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(41,25.5);
    $pdf->Cell(40,3.8, utf8_decode($pernom_emp),0);

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(133,25.5);
    $pdf->Cell(10,3.8,$peredo_nac,0);

    $pdf->SetXY(152,25.5);
    $pdf->Cell(10,3.8,$persexo,0);

    $pdf->SetXY(170,25.5);
    $pdf->Cell(10,3.8,$peredo_civil,0);

    $pdf->SetXY(190,25.5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(100,3.8,"PARTICULAR",0);

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(228,22.5);
    $pdf->Cell(73,3,$peremp_dom,0);

    $pdf->SetXY(320,22.5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,3,$peremp_dom_cp,0);

    $pdf->SetXY(225,25.8);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(121,3,$peremp_dom_col,0);

    $pdf->SetXY(233,29);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,3,$peremp_dom_pb,0);

    $pdf->SetXY(5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->MultiCell(15,3,$perniv_academico,0,'C',false);

    $pdf->SetXY(20,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,$perqna_ing_gob,0,'C');

    $pdf->SetXY(35,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,$perqna_ing_sep,0,'C');

    $pdf->SetXY(50,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14.5,3,$perarea,0,'C');

    $pdf->SetXY(67,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pernum_tit,0,'C');

    $pdf->SetXY(84,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pernum_lic,0,'C');

    $pdf->SetXY(104,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$perq,0,'C');

    $pdf->SetXY(110,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pera,0,'C');

    $pdf->SetXY(118,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13.6,3,$perl,0,'C');

    $pdf->SetXY(131,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(10.5,3,$pert,0,'C');

    $pdf->SetXY(141,35);
    $pdf->SetFont('Arial','',8);
    //$pdf->Cell(10.5,3,"MA",0,'C');
    $pdf->Cell(10.5,3,"",0,'C');

    $pdf->SetXY(152,35);
    $pdf->SetFont('Arial','',8);
    //$pdf->Cell(10.5,3,"DO",0,'C');
    $pdf->Cell(10.5,3,"",0,'C');
  
    $pdf->SetXY(162,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(18,3,$perct1,0,'C');

    $pdf->SetXY(181,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(18,3,$perhr1,0,'C');
    
    $pdf->SetXY(190,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perct2,0,'C');

    $pdf->SetXY(209,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19.5,3,$perhr2,0,'C');

    $pdf->SetXY(220,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct3,0,'C');

    $pdf->SetXY(240,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perhr3,0,'C');

    $pdf->SetXY(252,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct4,0,'C');

    $pdf->SetXY(271,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(11,3,$perhr4,0,'C');

    $pdf->SetXY(282,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct5,0,'C');

    $pdf->SetXY(301,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(11.5,3,$perhr5,0,'C');

    $pdf->SetXY(312.5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct6,0,'C');

    $pdf->SetXY(331.5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perhr6,0,'C');

    $pdf->SetXY(40,162);
    $pdf->MultiCell(85,42, $pdf->Image($SelloCGRH21, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
  
    $pdf->SetXY(240,160);
    $pdf->MultiCell(85,42, $pdf->Image($SelloAdm21, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");

                barcode('../../Codigo_Barras/'.$code.'.png', $code, 45, 'horizontal', 'code128', true);
                $image = '../../Codigo_Barras/'.$code.'.png';
                $pdf->Image($image,150,2,50,20,'PNG');
                unlink($image);
    $pdf->SetFont('Arial','',11);
    $pdf->SetXY(70,19);
    $pdf->Cell(80,4,utf8_decode($nom_area),0,0,'L');//C = CENTRAR
    //$pdf->Cell(101,11, $pdf->Image('codigos/'.$code.'.png', $pdf->GetX(), $pdf->GetY(),110),1);

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(15,19);
    $pdf->Cell(35,3,$curp,0,0,'L');//C = CENTRAR

    $pdf->SetXY(265,16);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(80,3,$buscar.'/'.$pdf->PageNo()/*.'/{nb}'*/,0,0,'L');

    $pdf->SetXY(297,16);
    $pdf->Cell(40,3,$FECHA,0,0,'C');

/*if($cve_mov == 3){
    $Des = $cmpabc."-PERC./DEDUC. CONCEPTO: ".$cmpconcepto;
    $pdf->SetXY(300,122); 
    $pdf->SetFont('Arial','',6.7);
    $pdf->Cell(41,3,utf8_decode($Des),0,0,'L');
}
else if($cve_mov == 4){
    $Des = $cmpabc."-GUION: ".$cmpconcepto;
    $pdf->SetXY(300,122); 
    $pdf->SetFont('Arial','',6.7);
    $pdf->Cell(41,3,utf8_decode($Des),0,0,'L');
}*/
    

/*<-------------------------------------------------------------------------PROPONE SNTE----------------------------------------------------------------->*/   
    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,166); 
    $pdf->Cell(45,3,$doc_anexa1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,170); 
    $pdf->Cell(45,3,$doc_anexa2,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,174); 
    $pdf->Cell(45,3,$doc_anexa3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,178); 
    $pdf->Cell(45,3,$doc_anexa4,0,0,'L');

    $pdf->SetXY(21,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(21,4,$num_oficio,0,0,'L');

    $pdf->SetXY(60,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(29,4,$FECHA,0,0,'L');

    $pdf->SetXY(21,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13,4,$operador,0,0,'L');

    $pdf->SetXY(48,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"",0,0,'L');//IMPRIMIO

    $pdf->SetXY(76,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4, "",0,0,'L');//REVISO
        $fec = date("Y-m-d",strtotime($FEC_IMP1));
    //echo $fec;
    if($FEC_IMP10 <= "2021-11-16"){
      $jefes_n = "2021-11-16";
        $id_consulta = 9;
        $JSON="[{\"FEC_IMP\":\"$jefes_n\"}]";
        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultados=$cliente->getConsulta($params);
        $arrayR = json_decode(json_encode($resultados), True);
    //var_dump($arrayR);
      foreach($arrayR as $value){
        $si = $value[2]["funcion_firma"];
        $sis = $value[5]["funcion_firma"];

        if($si == 0){
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"];
        if($NOMBRE_AUTORIZACIONES == ""){
        $NOMBRE_AUTORIZACIONES="";
        }else{
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"]; 
        }
        $imagen = hex2bin($value[1]["firmas"]);
        $TEMPIMGLOC = 'tempimg.png';      
        // se prepara un base64 encoded "data url"
        $pic = "data: image/png;base64,".base64_encode($imagen)."";
        $dataPieces = explode(',',$pic);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

        //  Check if image was properly decoded
        if( $decodedImg!==false )
        {
            //  Save image to a temporary location
            if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false )
            {
                //  Open new PDF document and print image
                $pdf->SetXY(90,162);
                
                $pdf->MultiCell(85,42, $pdf->Image($TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
                    //  Delete image from server
                unlink($TEMPIMGLOC);
            }
        }

      }
      if($sis == 1){
    $NOMBRE_AUTORIZA= $value[3]["nombre_firma"];
    if($NOMBRE_AUTORIZA == ""){
      $NOMBRE_AUTORIZA="";
        }else{
        $NOMBRE_AUTORIZA=$value[3]["nombre_firma"]; 
        }
         $imagen1 = hex2bin($value[4]["firmas"]);
        
        $TEMPIMGLOC1 = 'tempimg1.gif';      
        // se prepara un base64 encoded "data url"
        $pic1 = "data: image/png;base64,".base64_encode($imagen1)."";
        $dataPieces = explode(',',$pic1);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

      //  Check if image was properly decoded
      if( $decodedImg!==false )
      {
          //  Save image to a temporary location
          if( file_put_contents($TEMPIMGLOC1,$decodedImg)!==false )
          {
              //  Open new PDF document and print image
              $pdf->SetXY(175,166);
          
              $pdf->MultiCell(90,40, $pdf->Image($TEMPIMGLOC1, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
              //  Delete image from server
              unlink($TEMPIMGLOC1);
          }
      }

    }
  }

    }else{
      //echo "hola";
    //se muestran las firmas de Raul y Sandra
      $jefes_v = "2021-10-13";
      $id_consulta = 9;
      $JSON="[{\"FEC_IMP\":\"$jefes_v\"}]";
      $arrayR1 = json_decode(json_encode($JSON), True);
      $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
      //var_dump($params);
      $resultados=$cliente->getConsulta($params);
      $arrayR = json_decode(json_encode($resultados), True);
      //var_dump($arrayR);
      foreach($arrayR as $value){
        $si = $value[2]["funcion_firma"];
        $sis = $value[5]["funcion_firma"];

        if($si == 0){
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"];
        if($NOMBRE_AUTORIZACIONES == ""){
        $NOMBRE_AUTORIZACIONES="";
        }else{
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"]; 
        }
        $imagen = hex2bin($value[1]["firmas"]);
        $TEMPIMGLOC = 'tempimg.gif';      
        // se prepara un base64 encoded "data url"
        $pic = "data: image/png;base64,".base64_encode($imagen)."";
        $dataPieces = explode(',',$pic);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

        //  Check if image was properly decoded
        if( $decodedImg!==false )
        {
            //  Save image to a temporary location
            if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false )
            {
                //  Open new PDF document and print image
                $pdf->SetXY(90,162);
                
                $pdf->MultiCell(85,42, $pdf->Image($TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
                    //  Delete image from server
                unlink($TEMPIMGLOC);
            }
        }

      }
      if($sis == 1){
    $NOMBRE_AUTORIZA= $value[3]["nombre_firma"];
    if($NOMBRE_AUTORIZA == ""){
      $NOMBRE_AUTORIZA="";
        }else{
        $NOMBRE_AUTORIZA=$value[3]["nombre_firma"]; 
        }
         $imagen1 = hex2bin($value[4]["firmas"]);
        
        $TEMPIMGLOC1 = 'tempimg1.gif';      
        // se prepara un base64 encoded "data url"
        $pic1 = "data: image/png;base64,".base64_encode($imagen1)."";
        $dataPieces = explode(',',$pic1);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

      //  Check if image was properly decoded
      if( $decodedImg!==false )
      {
          //  Save image to a temporary location
          if( file_put_contents($TEMPIMGLOC1,$decodedImg)!==false )
          {
              //  Open new PDF document and print image
              $pdf->SetXY(175,166);
          
            $pdf->MultiCell(90,40, $pdf->Image($TEMPIMGLOC1, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
              //  Delete image from server
              unlink($TEMPIMGLOC1);
          }
      }

    }
  }
    
}


    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,166); 
    $pdf->Cell(45,3,$obsrv1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,170); 
    $pdf->Cell(45,3,$obsrv2,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,174); 
    $pdf->Cell(45,3,$obsrv3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,178); 
    $pdf->Cell(45,3,$obsrv4,0,0,'L');

    $pdf->Line(5, 181.2, 122-5, 181.2); // PARTE DE ARRIBA
    $pdf->Line(160, 181.2, 352-5, 181.2); // PARTE DE ARRIBA 2
    $pdf->Line(90.1, 162.3, 90.1, 204.4);//linea vertical derecha
    $pdf->SetXY(35,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"PROPONE SNTE",0,0,'L');

    $pdf->SetXY(5,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(32,4,"OFICIO NO.",0,0,'L');  

    $pdf->Line(22, 189.2, 45-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(45,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(42,4,"FECHA",0,0,'L'); 
    
    $pdf->Line(60, 189.2, 93-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(5,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,4,"CAPTURO:",0,0,'L');

    $pdf->Line(22, 199.3, 38-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(33,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,4,"IMPRIMIO:",0,0,'L');

    $pdf->Line(48, 199.3, 69-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(64,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13,4,"REVISO:",0,0,'L'); 

    $pdf->Line(77, 199.3, 94-5, 199.3); // PARTE DE ABAJO DE RESPUESTA


    $pdf->Line(190.1, 162.3, 190.1, 181.2);//linea vertical derecha
    $TEXTO="SE HACE CONSTAR QUE EL TRABAJADOR PROTESTA DESEMPEÑAR LEAL Y PATRIOTICAMENTE EL PUESTO QUE SE LE HA CONFERIDO Y GUARDAR Y HACER GUARDAR LA CONSTITUCION POLITICA DE LOS ESTADOS UNIDOS MEXICANOS Y LAS LEYES QUE DE ELLA EMANEN";
    $pdf->SetXY(190,162.3);
    $pdf->SetFont('Arial','',7);
    //$pdf->SetX(190); // abscissa of Horizontal position 
    $pdf->MultiCell(80,3.5,utf8_decode($TEXTO),0,'J',false);

//<------------------------------------------------------------------------AUTORIZACIONES------------------------------------------------------------------->
    $pdf->SetXY(120,177);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(42,4,"AUTORIZACIONES",0,0,'L');

    $pdf->SetXY(125,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,3,"OTORGA VIGENCIA",0,0,'L');

    $pdf->SetXY(90,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

    $pdf->Line(105, 189.2, 175-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(90,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4,"FIRMA",0,0,'L');

    $pdf->Line(105, 193.2, 175-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(90,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(105, 198.5, 175-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(175.2, 181.2, 175.2, 204.3);//linea vertical derecha
//<-----------------------------------------------------------------FIN DE AUTORIZACIONES------------------------------------------------------------------->
//<------------------------------------------------------------------------AUTORIZA------------------------------------------------------------------------->
    $pdf->SetXY(210,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"AUTORIZA",0,0,'L');

    $pdf->SetXY(175,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

    $pdf->Line(260, 189.2, 195-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(175,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4,"FIRMA",0,0,'L');

    $pdf->Line(260, 193.2, 195-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(175,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(260, 198.5, 195-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(265.4, 181.2, 265.4, 204.3);//linea vertical derecha


//<------------------------------------------------------------------------FIN DE AUTORIZA-------------------------------------------------------------->
/*<-------------------------------------------------------------------------AUTORIZACIONES--------------------------------------------------------------->*/
    $pdf->SetXY(105,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');

    //$pdf->SetXY(100,162);
    //$pdf->MultiCell(85,42, $pdf->Image("../../Logo/firma.png", $pdf->GetX()+10, $pdf->GetY()+3, 80),0,"C");

    $pdf->SetXY(105,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($FECHA),0,0,'L');
/*<-------------------------------------------------------------------------AUTORIZA-------------------------------------------------------------------->*/
    $pdf->SetXY(190,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZA),0,0,'L');

    //$pdf->SetXY(185,162);
    //$pdf->MultiCell(90,40, $pdf->Image("../../Logo/firma2.png", $pdf->GetX()+10, $pdf->GetY()+3, 80) ,0,"C");

    $pdf->SetXY(190,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($FECHA),0,0,'L');
/*<-------------------------------------------------------------------------INTERESADO------------------------------------------------------------------->*/
    $pdf->SetXY(280,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($pernom_emp),0,0,'L');

    $pdf->SetXY(280,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(60,3, utf8_decode($FECHA),0,0,'L');


    $pdf->SetXY(206,206);  
    $pdf->SetFont('Arial','',15);
    $pdf->Cell(14,3,utf8_decode("FUP COPIA TRAMITADO"),0,0,'L');
         
    $pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN

    $pdf->SetXY(6,205);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L'); 

    $TEXTO1="DECLARO BAJO PROTESTA DE DECIR VERDAD QUE _______ ME ENCUENTRO DESEMPEÑANDO OTRO EMPLEO O COMISIÓN DENTRO DE OTRA ENTIDAD DE LA ADMINISTRACIÓN PÚBLICA FEDERAL";//"DECLARO BAJO PROTESTA DE DECIR VERDAD QUE _______ ME ENCUENTRO DESEMPEÑANDO OTRO EMPLEO O COMISIÓN DENTRO DE OTRA ENTIDAD DE LA ADMINISTRACIÓN PÚBLICA FEDERAL";

    $pdf->Line(270.2, 162.3, 270.2, 181.2);//linea vertical derecha

    $pdf->SetXY(270,162);
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(74,4.5,utf8_decode($TEXTO1),0,'J',false);

    $pdf->SetXY(292,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"INTERESADO",0,0,'L');

    $pdf->SetXY(265,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,"NOMBRE",0,0,'L');

    $pdf->Line(340,188.4, 285-5, 188.4); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(265,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FIRMA",0,0,'L');

    $pdf->Line(340, 193.2, 285-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(265,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(340, 198.5, 285-5, 198.5); // PARTE DE ABAJO DE RESPUESTA
    $is3++;
}
/*if($pdf->PageNo() == 2){
    
    $pdf->SetXY(100,75);
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(80,3,$numeroFormateado,0);
      echo $numeroFormateado;
}*/
if($pdf->PageNo() == 2 && $is3 <= 2){

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(5,25.5);
    $pdf->Cell(37.5,3.8,$perrfc,0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(41,25.5);
    $pdf->Cell(40,3.8,$pernom_emp,0);

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(133,25.5);
    $pdf->Cell(10,3.8,$peredo_nac,0);

    $pdf->SetXY(152,25.5);
    $pdf->Cell(10,3.8,$persexo,0);

    $pdf->SetXY(170,25.5);
    $pdf->Cell(10,3.8,$peredo_civil,0);

    $pdf->SetXY(190,25.5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(100,3.8,"PARTICULAR",0);

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(228,22.5);
    $pdf->Cell(73,3,$peremp_dom,0);

    $pdf->SetXY(320,22.5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,3,$peremp_dom_cp,0);

    $pdf->SetXY(225,25.8);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(121,3,$peremp_dom_col,0);

    $pdf->SetXY(233,29);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,3,$peremp_dom_pb,0);

    $pdf->SetXY(5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->MultiCell(15,3,$perniv_academico,0,'C',false);

    $pdf->SetXY(20,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,$perqna_ing_gob,0,'C');

    $pdf->SetXY(35,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,$perqna_ing_sep,0,'C');

    $pdf->SetXY(50,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14.5,3,$perarea,0,'C');

    $pdf->SetXY(67,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pernum_tit,0,'C');

    $pdf->SetXY(84,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pernum_lic,0,'C');

    $pdf->SetXY(104,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$perq,0,'C');

    $pdf->SetXY(110,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pera,0,'C');

    $pdf->SetXY(118,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13.6,3,$perl,0,'C');

    $pdf->SetXY(131,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(10.5,3,$pert,0,'C');

    $pdf->SetXY(141,35);
    $pdf->SetFont('Arial','',8);
    //$pdf->Cell(10.5,3,"MA",0,'C');
    $pdf->Cell(10.5,3,"",0,'C');

    $pdf->SetXY(152,35);
    $pdf->SetFont('Arial','',8);
    //$pdf->Cell(10.5,3,"DO",0,'C');
    $pdf->Cell(10.5,3,"",0,'C');
  
    $pdf->SetXY(162,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(18,3,$perct1,0,'C');

    $pdf->SetXY(181,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(18,3,$perhr1,0,'C');
    
    $pdf->SetXY(190,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perct2,0,'C');

    $pdf->SetXY(209,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19.5,3,$perhr2,0,'C');

    $pdf->SetXY(220,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct3,0,'C');

    $pdf->SetXY(240,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perhr3,0,'C');

    $pdf->SetXY(252,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct4,0,'C');

    $pdf->SetXY(271,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(11,3,$perhr4,0,'C');

    $pdf->SetXY(282,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct5,0,'C');

    $pdf->SetXY(301,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(11.5,3,$perhr5,0,'C');

    $pdf->SetXY(312.5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct6,0,'C');

    $pdf->SetXY(331.5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perhr6,0,'C');

    $pdf->SetXY(40,162);
    $pdf->MultiCell(85,42, $pdf->Image($SelloCGRH21, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
  
    $pdf->SetXY(240,160);
    $pdf->MultiCell(85,42, $pdf->Image($SelloAdm21, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");

    barcode('../../Codigo_Barras/'.$code.'.png', $code, 45, 'horizontal', 'code128', true);
    $image = '../../Codigo_Barras/'.$code.'.png';
    $pdf->Image($image,150,2,50,20,'PNG');
    unlink($image);

    $pdf->SetFont('Arial','',11);
    $pdf->SetXY(70,19);
    $pdf->Cell(80,4,utf8_decode($nom_area),0,0,'L');//C = CENTRAR
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(15,19);
    $pdf->Cell(35,3,$curp,0,0,'L');//C = CENTRAR

    $pdf->SetXY(265,16);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(80,3,$buscar.'/'.$pdf->PageNo()/*.'/{nb}'*/,0,0,'L');

    $pdf->SetXY(297,16);
    $pdf->Cell(40,3,$FEC_IMPS,0,0,'C');

/*if($cve_mov == 3){
    $Des = $cmpabc."-PERC./DEDUC. CONCEPTO: ".$cmpconcepto;
    $pdf->SetXY(300,122); 
    $pdf->SetFont('Arial','',6.7);
    $pdf->Cell(41,3,utf8_decode($Des),0,0,'L');
}
else if($cve_mov == 4){
    $Des = $cmpabc."-GUION: ".$cmpconcepto;
    $pdf->SetXY(300,122); 
    $pdf->SetFont('Arial','',6.7);
    $pdf->Cell(41,3,utf8_decode($Des),0,0,'L');
}*/
    

/*<--------------------------------------------------------------PROPONE SNTE----------------------------------------------------------------->*/   
    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,166); 
    $pdf->Cell(45,3,$doc_anexa1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,170); 
    $pdf->Cell(45,3,$doc_anexa2,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,174); 
    $pdf->Cell(45,3,$doc_anexa3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,178); 
    $pdf->Cell(45,3,$doc_anexa4,0,0,'L');

    $pdf->SetXY(21,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(21,4,$num_oficio,0,0,'L');

    $pdf->SetXY(60,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(29,4,$FECHA,0,0,'L');

    $pdf->SetXY(21,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13,4,$operador,0,0,'L');

    $pdf->SetXY(48,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"",0,0,'L');//IMPRIMIO

    $pdf->SetXY(76,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4, "",0,0,'L');//REVISO
    $fec = date("Y-m-d",strtotime($FEC_IMP1));
    //echo $fec;
    if($FEC_IMP10 <= "2021-11-16"){
      $jefes_n = "2021-11-16";
        $id_consulta = 9;
        $JSON="[{\"FEC_IMP\":\"$jefes_n\"}]";
        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultados=$cliente->getConsulta($params);
        $arrayR = json_decode(json_encode($resultados), True);
    //var_dump($arrayR);
      foreach($arrayR as $value){
        $si = $value[2]["funcion_firma"];
        $sis = $value[5]["funcion_firma"];

        if($si == 0){
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"];
        if($NOMBRE_AUTORIZACIONES == ""){
        $NOMBRE_AUTORIZACIONES="";
        }else{
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"]; 
        }
        $imagen = hex2bin($value[1]["firmas"]);
        $TEMPIMGLOC = 'tempimg.png';      
        // se prepara un base64 encoded "data url"
        $pic = "data: image/png;base64,".base64_encode($imagen)."";
        $dataPieces = explode(',',$pic);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

        //  Check if image was properly decoded
        if( $decodedImg!==false )
        {
            //  Save image to a temporary location
            if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false )
            {
                //  Open new PDF document and print image
                $pdf->SetXY(90,162);
                
                $pdf->MultiCell(85,42, $pdf->Image($TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
                    //  Delete image from server
                unlink($TEMPIMGLOC);
            }
        }

      }
      if($sis == 1){
    $NOMBRE_AUTORIZA= $value[3]["nombre_firma"];
    if($NOMBRE_AUTORIZA == ""){
      $NOMBRE_AUTORIZA="";
        }else{
        $NOMBRE_AUTORIZA=$value[3]["nombre_firma"]; 
        }
         $imagen1 = hex2bin($value[4]["firmas"]);
        
        $TEMPIMGLOC1 = 'tempimg1.gif';      
        // se prepara un base64 encoded "data url"
        $pic1 = "data: image/png;base64,".base64_encode($imagen1)."";
        $dataPieces = explode(',',$pic1);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

      //  Check if image was properly decoded
      if( $decodedImg!==false )
      {
          //  Save image to a temporary location
          if( file_put_contents($TEMPIMGLOC1,$decodedImg)!==false )
          {
              //  Open new PDF document and print image
              $pdf->SetXY(175,166);
          
              $pdf->MultiCell(90,40, $pdf->Image($TEMPIMGLOC1, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
              //  Delete image from server
              unlink($TEMPIMGLOC1);
          }
      }

    }
  }

    }else{
      //echo "hola";
    //se muestran las firmas de Raul y Sandra
      $jefes_v = "2021-10-13";
      $id_consulta = 9;
      $JSON="[{\"FEC_IMP\":\"$jefes_v\"}]";
      $arrayR1 = json_decode(json_encode($JSON), True);
      $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
      //var_dump($params);
      $resultados=$cliente->getConsulta($params);
      $arrayR = json_decode(json_encode($resultados), True);
      //var_dump($arrayR);
      foreach($arrayR as $value){
        $si = $value[2]["funcion_firma"];
        $sis = $value[5]["funcion_firma"];

        if($si == 0){
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"];
        if($NOMBRE_AUTORIZACIONES == ""){
        $NOMBRE_AUTORIZACIONES="";
        }else{
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"]; 
        }
        $imagen = hex2bin($value[1]["firmas"]);
        $TEMPIMGLOC = 'tempimg.gif';      
        // se prepara un base64 encoded "data url"
        $pic = "data: image/png;base64,".base64_encode($imagen)."";
        $dataPieces = explode(',',$pic);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

        //  Check if image was properly decoded
        if( $decodedImg!==false )
        {
            //  Save image to a temporary location
            if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false )
            {
                //  Open new PDF document and print image
                $pdf->SetXY(90,162);
                
                $pdf->MultiCell(85,42, $pdf->Image($TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
                    //  Delete image from server
                unlink($TEMPIMGLOC);
            }
        }

      }
      if($sis == 1){
    $NOMBRE_AUTORIZA= $value[3]["nombre_firma"];
    if($NOMBRE_AUTORIZA == ""){
      $NOMBRE_AUTORIZA="";
        }else{
        $NOMBRE_AUTORIZA=$value[3]["nombre_firma"]; 
        }
         $imagen1 = hex2bin($value[4]["firmas"]);
        
        $TEMPIMGLOC1 = 'tempimg1.gif';      
        // se prepara un base64 encoded "data url"
        $pic1 = "data: image/png;base64,".base64_encode($imagen1)."";
        $dataPieces = explode(',',$pic1);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

      //  Check if image was properly decoded
      if( $decodedImg!==false )
      {
          //  Save image to a temporary location
          if( file_put_contents($TEMPIMGLOC1,$decodedImg)!==false )
          {
              //  Open new PDF document and print image
              $pdf->SetXY(175,166);
          
            $pdf->MultiCell(90,40, $pdf->Image($TEMPIMGLOC1, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
              //  Delete image from server
              unlink($TEMPIMGLOC1);
          }
      }

    }
  }
    
}

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,166); 
    $pdf->Cell(45,3,$obsrv1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,170); 
    $pdf->Cell(45,3,$obsrv2,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,174); 
    $pdf->Cell(45,3,$obsrv3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,178); 
    $pdf->Cell(45,3,$obsrv4,0,0,'L');

    $pdf->Line(5, 181.2, 122-5, 181.2); // PARTE DE ARRIBA
    $pdf->Line(160, 181.2, 352-5, 181.2); // PARTE DE ARRIBA 2
    $pdf->Line(90.1, 162.3, 90.1, 204.4);//linea vertical derecha
    $pdf->SetXY(35,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"PROPONE SNTE",0,0,'L');

    $pdf->SetXY(5,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(32,4,"OFICIO NO.",0,0,'L');  

    $pdf->Line(22, 189.2, 45-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(45,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(42,4,"FECHA",0,0,'L'); 
    
    $pdf->Line(60, 189.2, 93-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(5,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,4,"CAPTURO:",0,0,'L');

    $pdf->Line(22, 199.3, 38-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(33,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,4,"IMPRIMIO:",0,0,'L');

    $pdf->Line(48, 199.3, 69-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(64,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13,4,"REVISO:",0,0,'L'); 

    $pdf->Line(77, 199.3, 94-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(190.1, 162.3, 190.1, 181.2);//linea vertical derecha
    $TEXTO="SE HACE CONSTAR QUE EL TRABAJADOR PROTESTA DESEMPEÑAR LEAL Y PATRIOTICAMENTE EL PUESTO QUE SE LE HA CONFERIDO Y GUARDAR Y HACER GUARDAR LA CONSTITUCION POLITICA DE LOS ESTADOS UNIDOS MEXICANOS Y LAS LEYES QUE DE ELLA EMANEN";
    $pdf->SetXY(190,162.3);
    $pdf->SetFont('Arial','',7);
    //$pdf->SetX(190); // abscissa of Horizontal position 
    $pdf->MultiCell(80,3.5,utf8_decode($TEXTO),0,'J',false);

//<------------------------------------------------------------------------AUTORIZACIONES------------------------------------------------------------------->
    $pdf->SetXY(120,177);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(42,4,"AUTORIZACIONES",0,0,'L');

    $pdf->SetXY(125,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,3,"OTORGA VIGENCIA",0,0,'L');

    $pdf->SetXY(90,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

    $pdf->Line(105, 189.2, 175-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(90,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4,"FIRMA",0,0,'L');

    $pdf->Line(105, 193.2, 175-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(90,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(105, 198.5, 175-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(175.2, 181.2, 175.2, 204.3);//linea vertical derecha
//<-----------------------------------------------------------------FIN DE AUTORIZACIONES------------------------------------------------------------------->
//<------------------------------------------------------------------------AUTORIZA------------------------------------------------------------------------->
    $pdf->SetXY(210,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"AUTORIZA",0,0,'L');

    $pdf->SetXY(175,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

    $pdf->Line(260, 189.2, 195-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(175,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4,"FIRMA",0,0,'L');

    $pdf->Line(260, 193.2, 195-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(175,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(260, 198.5, 195-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(265.4, 181.2, 265.4, 204.3);//linea vertical derecha


//<------------------------------------------------------------------------FIN DE AUTORIZA-------------------------------------------------------------->
    
/*<------------------------------------------------------------------------AUTORIZACIONES--------------------------------------------------------------->*/
    $pdf->SetXY(105,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');

    //$pdf->SetXY(100,162);
    //$pdf->MultiCell(85,42, $pdf->Image("../../Logo/firma.png", $pdf->GetX()+10, $pdf->GetY()+3, 80),0,"C");

    $pdf->SetXY(105,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($FEC_IMPS),0,0,'L');
/*<-------------------------------------------------------------------------AUTORIZA-------------------------------------------------------------------->*/
    $pdf->SetXY(190,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZA),0,0,'L');

    //$pdf->SetXY(185,162);
    //$pdf->MultiCell(90,40, $pdf->Image("../../Logo/firma2.png", $pdf->GetX()+10, $pdf->GetY()+3, 80) ,0,"C");

    $pdf->SetXY(190,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($FEC_IMPS),0,0,'L');
/*<-------------------------------------------------------------------------INTERESADO------------------------------------------------------------------->*/
    $pdf->SetXY(280,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($pernom_emp),0,0,'L');

    $pdf->SetXY(280,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(60,3, utf8_decode($FEC_IMPS),0,0,'L');


    $pdf->SetXY(206,206);  
    $pdf->SetFont('Arial','',15);
    $pdf->Cell(14,3,utf8_decode("FUP COPIA TRAMITADO"),0,0,'L');
         
    $pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN

    $pdf->SetXY(6,205);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L'); 

    $TEXTO1="DECLARO BAJO PROTESTA DE DECIR VERDAD QUE _______ ME ENCUENTRO DESEMPEÑANDO OTRO EMPLEO O COMISIÓN DENTRO DE OTRA ENTIDAD DE LA ADMINISTRACIÓN PÚBLICA FEDERAL";//"DECLARO BAJO PROTESTA DE DECIR VERDAD QUE _______ ME ENCUENTRO DESEMPEÑANDO OTRO EMPLEO O COMISIÓN DENTRO DE OTRA ENTIDAD DE LA ADMINISTRACIÓN PÚBLICA FEDERAL";

    $pdf->Line(270.2, 162.3, 270.2, 181.2);//linea vertical derecha

    $pdf->SetXY(270,162);
    $pdf->SetFont('Arial','',7);
    //$this->SetX(270); // abscissa of Horizontal position 
    $pdf->MultiCell(74,4.5,utf8_decode($TEXTO1),0,'J',false);

    $pdf->SetXY(292,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"INTERESADO",0,0,'L');

    $pdf->SetXY(265,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,"NOMBRE",0,0,'L');

    $pdf->Line(340,188.4, 285-5, 188.4); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(265,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FIRMA",0,0,'L');

    $pdf->Line(340, 193.2, 285-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(265,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

   

    $pdf->Line(340, 198.5, 285-5, 198.5); // PARTE DE ABAJO DE RESPUESTA
    $is3++;
}

}//fin while $y11

}//fin arrayR44


       $y = $y + 49;
          
    }//fin while $y
  } //fin foreach arrayR4

    }else{
        $id_consultaP =     95;//11//53
        $JSONP="[{\"num_docto\":\"$buscar\"}]";
        $arrayRP = json_decode(json_encode($JSONP), True);
        $paramsP1 = array('Resultado'=>$id_consultaP, 'Argumento'=>$arrayRP); //para conseguir la consulta
        $resultadoP=$cliente->getConsulta($paramsP1);   
        $arrayRP5= json_decode(json_encode($resultadoP), True);
    //var_dump($arrayRP5);
        $numd = 0;
        $di = 0;
        foreach($arrayRP5 as $valuesx2){ //inicio foreach arrayR5
        $total_resP= $valuesx2[0]["tot_resu"];
        
          while ($di <= $total_resP*33){//inicio while $y2
          $tot=        $valuesx2[$di+34]['tot'];
          $numeroFormateado = "$ ".number_format($tot, 2);
          
          $di = $di + 34;
          }
        }
    }

    $id_consultaP1 =  95;//11//53
    $JSONP1="[{\"num_docto\":\"$buscar\"}]";
    $arrayRP1 = json_decode(json_encode($JSONP1), True);
    $paramsP1 = array('Resultado'=>$id_consultaP1, 'Argumento'=>$arrayRP1); //para conseguir la consulta
    //var_dump($paramsP);
    $resultadosP1=$cliente->getConsulta($paramsP1);   
    $arrayRsP1= json_decode(json_encode($resultadosP1), True);
    //var_dump($arrayRsP1);
    $TOTAL = 0;
    foreach($arrayRsP1 as $valuess2){ //inicio foreach arrayRsP1
    $total_resP1= $valuess2[0]["tot_resu"];
    $is2=0; 
      
    while ($y2 <= $total_resP1*33){//inicio while $y2


 /*------------------------------------------------------------------------------------------------------------------------------------------------*/        
    $id_consultaT =  68;//13
    $JSONT="[{\"num_docto\":\"$buscar\"}]";

    $arrayRT = json_decode(json_encode($JSONT), True);
    $paramsT = array('Resultado'=>$id_consultaT, 'Argumento'=>$arrayRT); //para conseguir la consulta
    $resultadosT=$cliente->getConsulta($paramsT);
    $arrayRsT= json_decode(json_encode($resultadosT), True);

    foreach($arrayRsT as $valuess){ //inicio foreach arrayRsT
    $total_resT=$valuess[0]["tot_resu"];
    $is3=0; 
    $y = 0;
    while ($y <= $total_resT*48){//inicio while $y
/*------------------------------------------------------------------------------------------------------------------------------------------------*/         
    $id_consultaM =  96;//14
    $JSONM="[{\"num_docto\":\"$buscar\"}]";

    $arrayRM = json_decode(json_encode($JSONM), True);
    $paramsM = array('Resultado'=>$id_consultaM, 'Argumento'=>$arrayRM); //para conseguir la consulta
    $resultadoss22=$cliente->getConsulta($paramsM);  
    $arrayM= json_decode(json_encode($resultadoss22), True);
 // var_dump($arrayM);
    $y11=0;
    foreach($arrayM as $valuess44){
        $total_resM=$valuess44[0]["tot_resu"];
        
    $is1=0;         
       
    while ($y11 <= $total_resM*25){

    $placve_mov1=        $valuess44[$y11+1]['placve_mov'];
    $placve_mov = str_pad($placve_mov1, 2, "0", STR_PAD_LEFT);
    $plamot_mov1=        $valuess44[$y11+2]['plamot_mov'];
    $plamot_mov = str_pad($plamot_mov1, 2, "0", STR_PAD_LEFT);
    $placons_doc=         $valuess44[$y11+3]['placons_doc'];
    $plapartida=        $valuess44[$y11+4]['plapartida'];
    if ($plapartida == "0"){
      $plapartida = "";
    } 
    $placod_pago1=         $valuess44[$y11+5]['placod_pago'];
    $placod_pago = str_pad($placod_pago1, 2, "0", STR_PAD_LEFT);
    if ($placod_pago == "0"){
      $placod_pago = "";
    } 
    $plaunidad=         $valuess44[$y11+6]['plaunidad'];
    if ($plaunidad == "0"){
      $plaunidad = "";
    } 
    $plasubunidad=        $valuess44[$y11+7]['plasubunidad'];
    if ($plasubunidad == "0"){
      $plasubunidad = "";
    }
    $placat_puesto=       $valuess44[$y11+8]['placat_puesto'];
    $plahoras=          $valuess44[$y11+9]['plahoras'];
    $placons_plaza=       $valuess44[$y11+10]['placons_plaza'];
    if ($placons_plaza == "0"){
      $placons_plaza = "";
    } 
    $plaqna_ini=        $valuess44[$y11+11]['plaqna_ini'];
    $plaqna_fin=          $valuess44[$y11+12]['plaqna_fin'];
    $planom_emp=        $valuess44[$y11+13]['planom_emp'];
        if($planom_emp == "NULL"){
      $planom_emp = "";
    }
    $plarfc=          $valuess44[$y11+14]['plarfc'];

        if($plarfc == "NULL"){
      $plarfc = "";
    }
    $plamot_movsub=       $valuess44[$y11+15]['plamot_movsub'];
    if($plamot_movsub == "NULL"){
      $plamot_movsub = "";
    }
    if($plamot_movsub == "0"){
      $plamot_movsub = "";
    }
    $plaqna_inisub=       $valuess44[$y11+16]['plaqna_inisub'];
    if($plaqna_inisub == "NULL"){
      $plaqna_inisub = "";
    }
    if($plaqna_inisub == "0"){
      $plaqna_inisub = "";
    }
    $plaqna_finsub=       $valuess44[$y11+17]['plaqna_finsub'];
    if($plaqna_finsub == "NULL"){
      $plaqna_finsub = "";
    }
    if($plaqna_finsub == "0"){
      $plaqna_finsub = "";
    }
    $planum_doctosub=       $valuess44[$y11+18]['planum_doctosub'];
    if($planum_doctosub == "NULL"){
      $planum_doctosub = "";
    }
    if($planum_doctosub == "0"){
      $planum_doctosub = "";
    }
    $plactnvo=          $valuess44[$y11+19]['plactnvo'];
    $planivel_sueldonvo=    $valuess44[$y11+20]['planivel_sueldonvo'];
    if($planivel_sueldonvo == "NULL"){
      $planivel_sueldonvo = "";
    }
    if($planivel_sueldonvo == "0"){
      $planivel_sueldonvo = "";
    }
    $plabasificacion=       $valuess44[$y11+21]['plabasificacion'];
    if($plabasificacion == "NULL"){
      $plabasificacion = "";
    }
    if($plabasificacion == "0"){
      $plabasificacion = "";
    }
    $plapromocion=        $valuess44[$y11+22]['plapromocion'];
    if($plapromocion == "NULL"){
      $plapromocion = "";
    }
    if($plapromocion == "0"){
      $plapromocion = "";
    }
    $plaqna_ing_sub=      $valuess44[$y11+23]['plaqna_ing_sub'];
    if($plaqna_ing_sub == "NULL"){
      $plaqna_ing_sub = "";
    }
    if($plaqna_ing_sub == "0"){
      $plaqna_ing_sub = "";
    }
 $DESCRIPCION2=         $valuess44[$y11+24]['pladescripcion1'];
    $DESCRIPCION1=         $valuess44[$y11+25]['pladescripcion2'];
    $DESCRIPCION =         $DESCRIPCION1." ".$DESCRIPCION2;
    $fecha_def=            $valuess44[$y11+26]['fecha_defu'];
         //echo $fecha_def;  

  
if($placve_mov == "04" || $placve_mov == "03"){
    $id_consultaCMP =  125;//13
    $JSONCMP="[{\"num_docto\":\"$buscar\"}]";

    $arrayRCMP = json_decode(json_encode($JSONCMP), True);
    $paramsCMP = array('Resultado'=>$id_consultaCMP, 'Argumento'=>$arrayRCMP); //para conseguir la consulta
    $resultadosCMP=$cliente->getConsulta($paramsCMP);
    $arrayRsCMP= json_decode(json_encode($resultadosCMP), True);
    //var_dump($arrayRsCMP);
    $ycmp=0;
    foreach($arrayRsCMP as $valuescmp){
            $total_rescmp=$valuescmp[0]["tot_resu"];
            
      $cmp=0;         
           
            while ($ycmp <= $total_rescmp*19){
              $cmppartida = $valuescmp[$ycmp+1]["cmppartidaR1"];
              $cmppartidaR1 = str_pad($cmppartida, 4, "0", STR_PAD_LEFT);
              $cmpcod_pago = $valuescmp[$ycmp+2]["cmpcod_pagoR1"];
              $cmpcod_pagoR1 = str_pad($cmpcod_pago, 2, "0", STR_PAD_LEFT);
              $cmpunidad = $valuescmp[$ycmp+3]["cmpunidadR1"];
              $cmpunidadR1 = str_pad($cmpunidad, 2, "0", STR_PAD_LEFT);
              $cmpsubunidad = $valuescmp[$ycmp+4]["cmpsubunidadR1"];
              $cmpsubunidadR1 = str_pad($cmpsubunidad, 2, "0", STR_PAD_LEFT);
              $cmpcat_puestoR1 = $valuescmp[$ycmp+5]["cmpcat_puestoR1"];
              $cmphoras = $valuescmp[$ycmp+6]["cmphorasR1"];
              $cmphorasR1 = str_pad($cmphoras, 2, "0", STR_PAD_LEFT);
              $cmpcons_plazaR1 = $valuescmp[$ycmp+7]["cmpcons_plazaR1"];
              if($cmpcons_plazaR1 == 0){
                $cmpcons_plazaR1 = "";
              }
              $cmpqna_iniR1 = $valuescmp[$ycmp+9]["cmpqna_iniR1"];
              $cmpqna_finR1 = $valuescmp[$ycmp+10]["cmpqna_finR1"];
              $cmpanio_procR1 = $valuescmp[$ycmp+11]["cmpanio_procR1"];
              $cmpfijoR1 = $valuescmp[$ycmp+12]["cmpfijoR1"];
              $cmpprogramaR1 = $valuescmp[$ycmp+13]["cmpprogramaR1"];
              $cmpsubprogramaR1 = $valuescmp[$ycmp+14]["cmpsubprogramaR1"];
              $cmpproyectoR1 = $valuescmp[$ycmp+15]["cmpproyectoR1"];
              $cmpunidad_respR1 = $valuescmp[$ycmp+16]["cmpunidad_respR1"];
              $cmpconceptoR1 = $valuescmp[$ycmp+17]["cmpconceptoR1"];
              $cmpabcR1 = $valuescmp[$ycmp+18]["cmpabcR1"];
              $cmpimporteanteriorR1 = $valuescmp[$ycmp+8]["cmpimporteanteriorR1"];
              $cmpimportenuevoR1 = $valuescmp[$ycmp+19]["cmpimportenuevoR1"];
              $cmpAutorizado = $cmpimportenuevoR1 - $cmpimporteanteriorR1;
              if($cmpimporteanteriorR1 == 0.0000 ){
                $cmpimporteanteriorR1 = "0.00";
              }
              if($cmpimportenuevoR1 == 0.0000 ){
                $cmpimportenuevoR1 = "0.00";
              }              
              $cmpjustificacionR1 = $valuescmp[$ycmp+20]["cmpjustificacionR1"];
              if($cmpimportenuevoR1 == 0.00 && $cmpimporteanteriorR1 == 0.00){
                $cmpAutorizado = "0.00";
              }
              
    if($cmp >= 10 && $pdf->PageNo() == 1){
          $pdf->SetXY(5,121);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6,3,$cmppartidaR1,0,0,'L');



    }  
    else{

          $pdf->SetXY(130,77.5);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"M O D I F I C A C I O N E S  A:",0,0,'L');

          $pdf->SetXY(5,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,"PDA.",0,0,'L'); 

          $pdf->SetXY(13,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(4,3,"CP",0,0,'L'); 

          $pdf->SetXY(15,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"CLAVE DE PAGO AFECTADA",0,0,'L');

          $pdf->SetXY(18,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(4,3,"U",0,0,'L');

          $pdf->SetXY(21,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(4,3,"SU",0,0,'L');     

          $pdf->SetXY(28,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"CATEG.",0,0,'L');  

          $pdf->SetXY(39,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"HRS.",0,0,'L');    

          $pdf->SetXY(49,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"PLAZA",0,0,'L');                                              

          $pdf->SetXY(60,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"CLAVE PRESUPUESTARIA",0,0,'L');

          $pdf->SetXY(69,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(20,3,"Y CONCEPTO",0,0,'L'); 

          $pdf->SetXY(100,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"MOV.",0,0,'L'); 

          $pdf->SetXY(110,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"ACTUAL",0,0,'L'); 

          $pdf->SetXY(118,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"IMPORTES MENSUALES",0,0,'L');

          $pdf->SetXY(125,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"INC./DISM.",0,0,'L'); 

          $pdf->SetXY(145,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"AUTORIZADO",0,0,'L'); 

          $pdf->SetXY(168,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"EFECTOS",0,0,'L');

          $pdf->SetXY(165,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"DESDE",0,0,'L'); 

          $pdf->SetXY(175,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"HASTA",0,0,'L'); 

          $pdf->SetXY(190,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"JUSTIFICACION",0,0,'L');

          $pdf->SetXY(5,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmppartidaR1,0,0,'L');      

          $pdf->SetXY(13,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpcod_pagoR1,0,0,'L'); 

          $pdf->SetXY(17,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpunidadR1,0,0,'L'); 

          $pdf->SetXY(21,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpsubunidadR1,0,0,'L'); 

          $pdf->SetXY(28,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,$cmpcat_puestoR1,0,0,'L'); 

          $pdf->SetXY(39,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmphorasR1,0,0,'L'); 

          $pdf->SetXY(47,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(12,3,$cmpcons_plazaR1,0,0,'L'); 

          $pdf->SetXY(60,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpanio_procR1.".",0,0,'L'); 

          $pdf->SetXY(66.5,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpfijoR1.".",0,0,'L'); 

          $pdf->SetXY(74,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpprogramaR1.".",0,0,'L'); 

          $pdf->SetXY(78,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpsubprogramaR1.".",0,0,'L'); 

          $pdf->SetXY(82,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpproyectoR1.".",0,0,'L'); 

          $pdf->SetXY(86,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpunidad_respR1,0,0,'L'); 

          $pdf->SetXY(94,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpconceptoR1,0,0,'L');

          $pdf->SetXY(100,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpabcR1,0,0,'L'); 

          $pdf->SetXY(110,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(14,3,"$".$cmpimporteanteriorR1,0,0,'L');                                                                                  
          $pdf->SetXY(126,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(14,3,"$".$cmpAutorizado,0,0,'L');

          $pdf->SetXY(144,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(17,3,"$".$cmpimportenuevoR1,0,0,'L');          

          $pdf->SetXY(165,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpqna_iniR1,0,0,'L'); 

          $pdf->SetXY(175,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpqna_finR1,0,0,'L'); 

          $pdf->SetXY(190,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(50,3,$cmpjustificacionR1,0,0,'L');                                                                              

    }
              $ycmp = $ycmp + 20;//aqui
            }

           } 
         }

    if($is1 >= 10 && $pdf->PageNo() == 1){
    $pdf->AddPage();  
    $pdf->SetXY(5,121);   
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$placve_mov,0,0,'L');

    $pdf->SetXY(9.5,121);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$plamot_mov,0,0,'L');

    $pdf->SetXY(14,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7.5,3,$plapartida,0,0,'L');

    $pdf->SetXY(21.8,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$placod_pago,0,0,'L');

    $pdf->SetXY(28,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plaunidad,0,0,'L');

    $pdf->SetXY(34,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plasubunidad,0,0,'L');

    $pdf->SetXY(40,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placat_puesto,0,0,'L');

    $pdf->SetXY(51,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plahoras,0,0,'L');

    $pdf->SetXY(59,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placons_plaza,0,0,'L');

    $pdf->SetXY(70,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_ini,0,0,'L');

    $pdf->SetXY(81,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_fin,0,0,'L');

    $pdf->SetXY(93,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(72,3,$planom_emp,0,0,'L');

    $pdf->SetXY(165,121); 
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(24,3,$plarfc,0,0,'L');

    $pdf->SetXY(189,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7,3,$plamot_movsub,0,0,'L');

    $pdf->SetXY(196,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_inisub,0,0,'L');

    $pdf->SetXY(206,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_finsub,0,0,'L');

    $pdf->SetXY(220,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(18,3,$planum_doctosub,0,0,'L');

    $pdf->SetXY(237.5,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(16.5,3,$plactnvo,0,0,'L');

    $pdf->SetXY(254.5,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$planivel_sueldonvo,0,0,'C');

    $pdf->SetXY(266,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plabasificacion,0,0,'L');

    $pdf->SetXY(275,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(12.5,3,$plapromocion,0,0,'L');

    $pdf->SetXY(288,121);  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(13,3,$plaqna_ing_sub,0,0,'L');
            //119
    $pdf->SetXY(300,121); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(41,3,utf8_decode($DESCRIPCION),0,0,'L');
    $is1++;

    }else{

    if($pdf->PageNo() == 1 && $is1 < 10){
    $pdf->SetXY(5,121+($is1)+($is1)+($is1));   
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$placve_mov,0,0,'L');

    $pdf->SetXY(9.5,121+($is1)+($is1)+($is1));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$plamot_mov,0,0,'L');

    $pdf->SetXY(14,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7.5,3,$plapartida,0,0,'L');

    $pdf->SetXY(21.8,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$placod_pago,0,0,'L');

    $pdf->SetXY(28,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plaunidad,0,0,'L');

    $pdf->SetXY(34,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plasubunidad,0,0,'L');

    $pdf->SetXY(40,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placat_puesto,0,0,'L');

    $pdf->SetXY(51,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plahoras,0,0,'L');

    $pdf->SetXY(59,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placons_plaza,0,0,'L');
   if($placve_mov == "06" && $plamot_mov == "75" && $activo == "activo"){



      $DESDE_MOVs1 = substr( $fecha_def, 0,11  );
      $date = date_create($DESDE_MOVs1);
      $DESDE_MOVs = date_format($date, 'd-m-Y ');
      //$DESDE_MOVs = substr_replace($fechaEntera, $dias, 0, 0);

    $pdf->SetXY(70,121+($is1)+($is1)+($is1));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');
  }
   if($placve_mov == "06" && $plamot_mov == "31" && $activo != "activo" || $placve_mov == "06" && $plamot_mov == "33" && $activo != "activo"){
    
    $pdf->SetXY(70,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_ini,0,0,'L');

    $pdf->SetXY(81,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_fin,0,0,'L');

    }else{
    
 
    
    $onlyconsonants = str_replace("/", "-", $fecha_def);
    $date = date_create($onlyconsonants);
    $DESDE_MOV = date_format($date, 'd-m-Y ');
    //echo $DESDE_MOV;
    $pdf->SetXY(70,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$DESDE_MOV,0,0,'L');
  
  }

    if($placve_mov == "01" || $placve_mov == "02" || $placve_mov == "17" || $placve_mov == "30"){
          $pdf->SetXY(93,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(72,3,$planom_emp,0,0,'L');

    $pdf->SetXY(165,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(24,3,$plarfc,0,0,'L');

    $pdf->SetXY(189,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7,3,$plamot_movsub,0,0,'L');

    $pdf->SetXY(196,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_inisub,0,0,'L');

    $pdf->SetXY(206,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_finsub,0,0,'L');

    $pdf->SetXY(220,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(18,3,$planum_doctosub,0,0,'L');
  }

    $pdf->SetXY(237.5,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(16.5,3,$plactnvo,0,0,'L');

    $pdf->SetXY(254.5,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$planivel_sueldonvo,0,0,'C');

    $pdf->SetXY(266,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plabasificacion,0,0,'L');

    $pdf->SetXY(275,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(12.5,3,$plapromocion,0,0,'L');

    $pdf->SetXY(288,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(13,3,$plaqna_ing_sub,0,0,'L');
            //119
    $pdf->SetXY(300,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(41,3,utf8_decode($DESCRIPCION),0,0,'L');
    $is1++;
  }
  
  if($pdf->PageNo() == 2){
    $pdf->SetXY(5,91+($is1)+($is1)+($is1));   
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$placve_mov,0,0,'L');

    $pdf->SetXY(9.5,91+($is1)+($is1)+($is1));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$plamot_mov,0,0,'L');

    $pdf->SetXY(14,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7.5,3,$plapartida,0,0,'L');

    $pdf->SetXY(21.8,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$placod_pago,0,0,'L');

    $pdf->SetXY(28,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plaunidad,0,0,'L');

    $pdf->SetXY(34,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plasubunidad,0,0,'L');

    $pdf->SetXY(40,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placat_puesto,0,0,'L');

    $pdf->SetXY(51,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plahoras,0,0,'L');

    $pdf->SetXY(59,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placons_plaza,0,0,'L');

if($placve_mov == "06" && $plamot_mov == "75" && $activo == "activo"){



      $DESDE_MOVs1 = substr( $fecha_def, 0,11  );
      $date = date_create($DESDE_MOVs1);
      $DESDE_MOVs = date_format($date, 'd-m-Y ');
      //$DESDE_MOVs = substr_replace($fechaEntera, $dias, 0, 0);

    $pdf->SetXY(70,121+($is1)+($is1)+($is1));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');
  }
   if($placve_mov == "06" && $plamot_mov == "31" && $activo != "activo" || $placve_mov == "06" && $plamot_mov == "33" && $activo != "activo"){
    
    $pdf->SetXY(70,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_ini,0,0,'L');

    $pdf->SetXY(81,121+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$plaqna_fin,0,0,'L');

    }else{
    
 
    
    $onlyconsonants = str_replace("/", "-", $fecha_def);
    $date = date_create($onlyconsonants);
    $DESDE_MOV = date_format($date, 'd-m-Y ');
    //echo $DESDE_MOV;
$pdf->SetXY(70,121+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$DESDE_MOV,0,0,'L');
  
  }

   if($placve_mov == "01" || $placve_mov == "02" || $placve_mov == "17" || $placve_mov == "30"){
    $pdf->SetXY(93,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(72,3,$planom_emp,0,0,'L');

    $pdf->SetXY(165,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(24,3,$plarfc,0,0,'L');

    $pdf->SetXY(189,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7,3,$plamot_movsub,0,0,'L');

    $pdf->SetXY(196,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_inisub,0,0,'L');
    
    $pdf->SetXY(206,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$plaqna_finsub,0,0,'L');

    $pdf->SetXY(220,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(18,3,$planum_doctosub,0,0,'L');
  }

    $pdf->SetXY(237.5,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(16.5,3,$plactnvo,0,0,'L');

    $pdf->SetXY(254.5,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$planivel_sueldonvo,0,0,'C');

    $pdf->SetXY(266,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plabasificacion,0,0,'L');

    $pdf->SetXY(275,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(12.5,3,$plapromocion,0,0,'L');

    $pdf->SetXY(288,91+($is1)+($is1)+($is1));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(13,3,$plaqna_ing_sub,0,0,'L');
            //119
    $pdf->SetXY(300,91+($is1)+($is1)+($is1)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(41,3,utf8_decode($DESCRIPCION),0,0,'L');
$is1++;
  } 
}

$y11 = $y11 + 26;

    if ($y2 <= $total_resP1*33){
    $prepartida=        $valuess2[$y2+1]['prepartida'];
    if($prepartida == "0"){
      $prepartida = "";
    }else{
    $prepartida=        $valuess2[$y2+1]['prepartida']; 
    }
    $precod_pago1=      $valuess2[$y2+2]['precod_pago'];
    $precod_pago = str_pad($precod_pago1, 2, "0", STR_PAD_LEFT);
    $preunidad=         $valuess2[$y2+3]['preunidad'];
    $presubunidad=        $valuess2[$y2+4]['presubunidad'];
    $precat_puesto=       $valuess2[$y2+5]['precat_puesto'];
    $prehoras=          $valuess2[$y2+6]['prehoras'];
    $precons_plaza=       $valuess2[$y2+7]['precons_plaza'];
    $premot_mov=        $valuess2[$y2+8]['premot_mov'];
    $pre07=           $valuess2[$y2+9]['pre07'];
    $prei07=          $valuess2[$y2+10]['prei07'];
    //echo $prei07;
    if($prei07 == NULL){
      $prei07 = "";
    }
    if($prei07 == "0"){
      $prei07 = "0";
    }
    
    if($prei07 == "0.0000"){
      $prei07 = "0";
    }
    $numeroFormateado2 = "$ ".number_format($prei07, 2);  

    $preqna_ini=        $valuess2[$y2+11]['preqna_ini'];
    if($preqna_ini == NULL){
      $preqna_ini = "";
    }
    if($preqna_ini == "0.0000"){
      $preqna_ini = "";
    }
    $preqna_fin=        $valuess2[$y2+12]['preqna_fin'];
    if($preqna_fin == NULL){
      $preqna_fin = "";
    }
    if($preqna_fin == "0"){
      $preqna_fin = "";
    }
    $prenum_doctopla=       $valuess2[$y2+13]['prenum_doctopla'];
    if($prenum_doctopla == NULL){
      $prenum_doctopla = "";
    }
    if($prenum_doctopla == "0"){
      $prenum_doctopla = "";
    }
    $preDR=           $valuess2[$y2+14]['preDR'];
    $preiDR=          $valuess2[$y2+15]['preiDR'];
    if($preiDR == NULL){
      $preiDR = "";
    }
    if($preiDR == "0"){
      $preiDR = "";
    }
    $preiDRqna_ini=       $valuess2[$y2+16]['preiDRqna_ini'];
    if($preiDRqna_ini == NULL){
      $preiDRqna_ini = "";
    }
    if($preiDRqna_ini == "0"){
      $preiDRqna_ini = "";
    }
    $preiDRqna_fin=       $valuess2[$y2+17]['preiDRqna_fin'];
    if($preiDRqna_fin == NULL){
      $preiDRqna_fin = "";
    }
    if($preiDRqna_fin == "0"){
      $preiDRqna_fin = "";
    }
    $preDRnum_docto=      $valuess2[$y2+18]['preDRnum_docto'];
    if($preDRnum_docto == NULL){
      $preDRnum_docto = "";
    }
    if($preDRnum_docto == "0"){
      $preDRnum_docto = "";
    }
    $preBS=           $valuess2[$y2+19]['preBS'];
    $preiBS=          $valuess2[$y2+20]['preiBS'];
    if($preiBS == NULL){
      $preiBS = "";
    }
    if($preiBS == "0"){
      $preiBS = "";
    }
    $preBSqna_ini=        $valuess2[$y2+21]['preBSqna_ini'];
    if($preBSqna_ini == NULL){
      $preBSqna_ini = "";
    }
    if($preBSqna_ini == "0"){
      $preBSqna_ini = "";
    }
    $preBSqna_fin=        $valuess2[$y2+22]['preBSqna_fin'];
    if($preBSqna_fin == NULL){
      $preBSqna_fin = "";
    }
    if($preBSqna_fin == "0"){
      $preBSqna_fin = "";
    }
    $preBSnum_docto=        $valuess2[$y2+23]['preBSnum_docto'];
    if($preBSnum_docto == NULL){
      $preBSnum_docto = "";
    }
    if($preBSnum_docto == "0"){
      $preBSnum_docto = "";
    }
    $preI4=           $valuess2[$y2+24]['preI4'];
    $preiI4=          $valuess2[$y2+25]['preiI4'];
    if($preiI4 == NULL){
      $preiI4 = "";
    }
    if($preiI4 == "0"){
      $preiI4 = "";
    }
    $preI4qna_ini=        $valuess2[$y2+26]['preI4qna_ini'];
    if($preI4qna_ini == NULL){
      $preI4qna_ini = "";
    }
    if($preI4qna_ini == "0"){
      $preI4qna_ini = "";
    }
    $preI4qna_fin=        $valuess2[$y2+27]['preI4qna_fin'];
    if($preI4qna_fin == NULL){
      $preI4qna_fin = "";
    }
    if($preI4qna_fin == "0"){
      $preI4qna_fin = "";
    }
    $preI4num_docto=      $valuess2[$y2+28]['preI4num_docto'];
    if($preI4num_docto == NULL){
      $preI4num_docto = "";
    }
    if($preI4num_docto == "0"){
      $preI4num_docto = "";
    }
    $preE3=           $valuess2[$y2+29]['preE3'];
    $preiE3=            $valuess2[$y2+30]['preiE3'];
    if($preiE3 == NULL){
      $preiE3 = "";
    }
    if($preiE3 == "0"){
      $preiE3 = "";
    }
    $preE3qna_ini=        $valuess2[$y2+31]['preE3qna_ini'];
    if($preE3qna_ini == NULL){
      $preE3qna_ini = "";
    }
    if($preE3qna_ini == "0"){
      $preE3qna_ini = "";
    }
    $preE3qna_fin=        $valuess2[$y2+32]['preE3qna_fin'];
    if($preE3qna_fin == NULL){
      $preE3qna_fin = "";
    }
    if($preE3qna_fin == "0"){
      $preE3qna_fin = "";
    }
    $preE3num_docto=      $valuess2[$y2+33]['preE3num_docto'];
    if($preE3num_docto == NULL){
      $preE3num_docto = "";
    }
    if($preE3num_docto == "0"){
      $preE3num_docto = "";
    }
    


if($is2 >= 10 && $pdf->PageNo() == 1){
    $pdf->AddPage();
    $pdf->SetXY(5,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$prepartida,0,0,'R');

    $pdf->SetXY(12.5,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(5,3,utf8_decode($precod_pago),0,'R',false);

    $pdf->SetXY(17.5,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(5,3,utf8_decode($preunidad),0,'R',false);

    $pdf->SetXY(22,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(5,3,utf8_decode($presubunidad),0,'R',false);

    $pdf->SetXY(27,44.5);
    $pdf->SetFont('Arial','',6);
    $pdf->MultiCell(11,3,utf8_decode($precat_puesto),0,'C',false);

    $pdf->SetXY(37.5,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(7,3,utf8_decode($prehoras),0,'C',false);

    $pdf->SetXY(45,44.5);
    $pdf->SetFont('Arial','',6.5);
    $pdf->MultiCell(12,3,utf8_decode($precons_plaza),0,'C',false);

    $pdf->SetXY(57,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$premot_mov,0,0,'C');

    $pdf->SetXY(65,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$pre07,0,0,'C');

    $pdf->SetXY(71,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$numeroFormateado2,0,0,'C');

    $pdf->SetXY(84,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preqna_ini,0,0,'C');

    $pdf->SetXY(94,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preqna_fin,0,0,'C');

    $pdf->SetXY(105,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$prenum_doctopla,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(120,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$preDR,0,0,'C');

    $pdf->SetXY(126,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preiDR,0,0,'C');

    $pdf->SetXY(139.5,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiDRqna_ini,0,0,'C');

    $pdf->SetXY(146.5,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preiDRqna_fin,0,0,'C');

    $pdf->SetXY(160.5,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preDRnum_docto,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(174,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preBS,0,0,'C');

    $pdf->SetXY(184,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiBS,0,0,'C');

    $pdf->SetXY(193,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preBSqna_ini,0,0,'C');

    $pdf->SetXY(206,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preBSqna_fin,0,0,'C');

    $pdf->SetXY(219,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preBSnum_docto,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(230,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preI4,0,0,'C');

    $pdf->SetXY(240,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiI4,0,0,'C');

    $pdf->SetXY(249,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preI4qna_ini,0,0,'C');

    $pdf->SetXY(262,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preI4qna_fin,0,0,'C');

    $pdf->SetXY(276,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preI4num_docto,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(286,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preE3,0,0,'C');

    $pdf->SetXY(296,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiE3,0,0,'C');

    $pdf->SetXY(305,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preE3qna_ini,0,0,'C');

    $pdf->SetXY(318,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preE3qna_fin,0,0,'C');

    $pdf->SetXY(331,44.5);
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preE3num_docto,0,0,'C');

    //$is2++;
    }else{
      if($pdf->PageNo() == 1 && $is2 < 10){
      if ($is2 <= 1){ 

      $pdf->SetXY(100,75);
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(80,3,$numeroFormateado,0);

      }

    $pdf->SetXY(5,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$prepartida,0,0,'R');

    $pdf->SetXY(12.5,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(5,3,utf8_decode($precod_pago),0,'R',false);

    $pdf->SetXY(17.5,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(5,3,utf8_decode($preunidad),0,'R',false);

    $pdf->SetXY(22,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(5,3,utf8_decode($presubunidad),0,'R',false);

    $pdf->SetXY(27,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',6);
    $pdf->MultiCell(11,3,utf8_decode($precat_puesto),0,'C',false);

    $pdf->SetXY(37.5,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(7,3,utf8_decode($prehoras),0,'C',false);

    $pdf->SetXY(45,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',6.5);
    $pdf->MultiCell(12,3,utf8_decode($precons_plaza),0,'C',false);

    $pdf->SetXY(57,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$premot_mov,0,0,'C');

    $pdf->SetXY(65,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$pre07,0,0,'C');

    $pdf->SetXY(71,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$numeroFormateado2,0,0,'C');

    $pdf->SetXY(84,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preqna_ini,0,0,'C');

    $pdf->SetXY(94,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preqna_fin,0,0,'C');

    $pdf->SetXY(105,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$prenum_doctopla,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(120,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$preDR,0,0,'C');

    $pdf->SetXY(126,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preiDR,0,0,'C');

    $pdf->SetXY(139.5,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiDRqna_ini,0,0,'C');

    $pdf->SetXY(146.5,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preiDRqna_fin,0,0,'C');

    $pdf->SetXY(160.5,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preDRnum_docto,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(174,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preBS,0,0,'C');

    $pdf->SetXY(184,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiBS,0,0,'C');

    $pdf->SetXY(193,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preBSqna_ini,0,0,'C');

    $pdf->SetXY(206,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preBSqna_fin,0,0,'C');

    $pdf->SetXY(219,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preBSnum_docto,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(230,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preI4,0,0,'C');

    $pdf->SetXY(240,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiI4,0,0,'C');

    $pdf->SetXY(249,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preI4qna_ini,0,0,'C');

    $pdf->SetXY(262,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preI4qna_fin,0,0,'C');

    $pdf->SetXY(276,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preI4num_docto,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(286,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preE3,0,0,'C');

    $pdf->SetXY(296,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiE3,0,0,'C');

    $pdf->SetXY(305,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preE3qna_ini,0,0,'C');

    $pdf->SetXY(318,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preE3qna_fin,0,0,'C');

    $pdf->SetXY(331,44.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preE3num_docto,0,0,'C');

    $is2++;
    }

    if($pdf->PageNo() == 2){
    if ($is2 <= 10){  
    $pdf->SetXY(100,75);
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(80,3,$numeroFormateado,0);


    }
        
    $pdf->SetXY(5,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$prepartida,0,0,'R');

    $pdf->SetXY(12.5,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(5,3,utf8_decode($precod_pago),0,'R',false);

    $pdf->SetXY(17.5,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(5,3,utf8_decode($preunidad),0,'R',false);

    $pdf->SetXY(22,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(5,3,utf8_decode($presubunidad),0,'R',false);

    $pdf->SetXY(27,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',6);
    $pdf->MultiCell(11,3,utf8_decode($precat_puesto),0,'C',false);

    $pdf->SetXY(37.5,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(7,3,utf8_decode($prehoras),0,'C',false);

    $pdf->SetXY(45,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',6.5);
    $pdf->MultiCell(12,3,utf8_decode($precons_plaza),0,'C',false);

    $pdf->SetXY(57,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(8,3,$premot_mov,0,0,'C');

    $pdf->SetXY(65,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$pre07,0,0,'C');

    $pdf->SetXY(71,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$numeroFormateado2,0,0,'C');

    $pdf->SetXY(84,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preqna_ini,0,0,'C');

    $pdf->SetXY(94,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preqna_fin,0,0,'C');

    $pdf->SetXY(105,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$prenum_doctopla,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(120,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$preDR,0,0,'C');

    $pdf->SetXY(126,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preiDR,0,0,'C');

    $pdf->SetXY(139.5,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiDRqna_ini,0,0,'C');

    $pdf->SetXY(146.5,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preiDRqna_fin,0,0,'C');

    $pdf->SetXY(160.5,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preDRnum_docto,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(174,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preBS,0,0,'C');

    $pdf->SetXY(184,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiBS,0,0,'C');

    $pdf->SetXY(193,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preBSqna_ini,0,0,'C');

    $pdf->SetXY(206,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preBSqna_fin,0,0,'C');

    $pdf->SetXY(219,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preBSnum_docto,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(230,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preI4,0,0,'C');

    $pdf->SetXY(240,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiI4,0,0,'C');

    $pdf->SetXY(249,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preI4qna_ini,0,0,'C');

    $pdf->SetXY(262,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preI4qna_fin,0,0,'C');

    $pdf->SetXY(276,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preI4num_docto,0,0,'C');
/*-------------------------------------------------------------------------------*/
    $pdf->SetXY(286,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preE3,0,0,'C');

    $pdf->SetXY(296,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preiE3,0,0,'C');

    $pdf->SetXY(305,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(15,3,$preE3qna_ini,0,0,'C');

    $pdf->SetXY(318,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preE3qna_fin,0,0,'C');

    $pdf->SetXY(331,17.5+($is2)+($is2)+($is2));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(10,3,$preE3num_docto,0,0,'C');
    $is2++;
    }   

    }//fin else
    $y2 = $y2 + 34;
    }

    $FECHA= date('d')."/".$meses[date('n')-1]. "/".date('Y') ;
    $si=              $valuess[$y+1]['perarea'];
    //echo $si;
    if ($si == "3153" ){
    $perarea=           " ";
    }else{
    $perarea=           $valuess[$y+1]['perarea'];
    }
    $pernum_docto=      $valuess[$y+2]['pernum_docto'];
    $perrfc=            $valuess[$y+3]['perrfc'];
    $pernom_emp=        $valuess[$y+4]['pernom_emp'];
    $peredo_nac=        $valuess[$y+5]['peredo_nac'];
    $persexo=           $valuess[$y+6]['persexo'];
    $peredo_civil=      $valuess[$y+7]['peredo_civil'];
    $peremp_dom=        $valuess[$y+8]['peremp_dom'];
    $peremp_dom_cp=     $valuess[$y+9]['peremp_dom_cp'];
    $peremp_dom_col=    $valuess[$y+10]['peremp_dom_col'];
    $peremp_dom_pb=     $valuess[$y+11]['peremp_dom_pob'];
    $perniv_academico=  $valuess[$y+12]['perniv_academico'];
    $perqna_ing_gob=    $valuess[$y+13]['perqna_ing_gob'];
    $perqna_ing_sep=    $valuess[$y+14]['perqna_ing_sep'];
    //$pernum_tit=        $valuess[$y+15]['pernum_tit'];
    $numero1 =          $valuess[$y+15]['pernum_tit'];
    $pernum_tit =       str_pad($numero1, 9, "0", STR_PAD_LEFT);
    //$pernum_lic=        $valuess[$y+16]['pernum_lic'];
    $numero2 =          $valuess[$y+16]['pernum_lic'];
    $pernum_lic =       str_pad($numero2, 9, "0", STR_PAD_LEFT);
    $perq=              $valuess[$y+17]['perq'];
    $pera=              $valuess[$y+18]['pera'];
    $perl=              $valuess[$y+19]['perl'];
    $pert=              $valuess[$y+20]['pert'];
    $perct1=            $valuess[$y+21]['perct1'];
    $perhr1=            $valuess[$y+22]['perhr1'];
    $perct2=            $valuess[$y+23]['perct2'];
    $perhr2=            $valuess[$y+24]['perhr2'];
    $perct3=            $valuess[$y+25]['perct3'];
    $perhr3=            $valuess[$y+26]['perhr3'];
    $perct4=            $valuess[$y+27]['perct4'];
    $perhr4=            $valuess[$y+28]['perhr4'];
    $perct5=            $valuess[$y+29]['perct5'];
    $perhr5=            $valuess[$y+30]['perhr5'];
    $perct6=            $valuess[$y+31]['perct6'];
    $perhr6=            $valuess[$y+32]['perhr6'];
    $perrfc_nuevo=      $valuess[$y+33]['perrfc_nuevo'];
    $nom_area=          $valuess[$y+34]['pernom_area'];
    $curp=              $valuess[$y+35]['percurp'];
    $doc_anexa1=        $valuess[$y+36]['perdoc_anexa1'];
    $doc_anexa2=        $valuess[$y+37]['perdoc_anexa2'];
    $doc_anexa3=        $valuess[$y+38]['perdoc_anexa3'];
    $doc_anexa4=        $valuess[$y+39]['perdoc_anexa4'];
    $obsrv1=            $valuess[$y+40]['perobsrv1'];
    $obsrv2=            $valuess[$y+41]['perobsrv2'];
    $obsrv3=            $valuess[$y+42]['perobsrv3'];
    $obsrv4=            $valuess[$y+43]['perobsrv4'];
    $num_oficio=        $valuess[$y+44]['pernum_oficio'];
    $operador=          $valuess[$y+45]['peroperador'];
    $code =             $valuess[$y+46]['percpr'];
    $FEC_IMP=           $valuess[$y+47]['percaptura'];
        $fechaEntera1 = substr( $FEC_IMP, 0 ,10 );
    $onlyconsonants1 = str_replace("/", "-", $fechaEntera1);
    $date1 = date_create($onlyconsonants1);
    $FEC_IMPS = date_format($date1, 'd-m-Y ');
    //echo $FEC_IMPS;
    //echo $FEC_IMP;
    $cve_mov=           $valuess[$y+48]['percve_mov'];
    /*$cmpabc=          $valuess[$y+1]['cmpabc'];
    $cmpconcepto=       $valuess[$y+19]['cmpconcepto'];*/

    if($pdf->PageNo() == 1 && $is3 <= 1){

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(5,25.5);
    $pdf->Cell(37.5,3.8,$perrfc,0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(41,25.5);
    $pdf->Cell(40,3.8, utf8_decode($pernom_emp),0);

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(133,25.5);
    $pdf->Cell(10,3.8,$peredo_nac,0);

    $pdf->SetXY(152,25.5);
    $pdf->Cell(10,3.8,$persexo,0);

    $pdf->SetXY(170,25.5);
    $pdf->Cell(10,3.8,$peredo_civil,0);

    $pdf->SetXY(190,25.5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(100,3.8,"PARTICULAR",0);

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(228,22.5);
    $pdf->Cell(73,3,$peremp_dom,0);

    $pdf->SetXY(320,22.5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,3,$peremp_dom_cp,0);

    $pdf->SetXY(225,25.8);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(121,3,$peremp_dom_col,0);

    $pdf->SetXY(233,29);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,3,$peremp_dom_pb,0);

    $pdf->SetXY(5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->MultiCell(15,3,$perniv_academico,0,'C',false);

    $pdf->SetXY(20,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,$perqna_ing_gob,0,'C');

    $pdf->SetXY(35,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,$perqna_ing_sep,0,'C');

    $pdf->SetXY(50,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14.5,3,$perarea,0,'C');

    $pdf->SetXY(67,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pernum_tit,0,'C');

    $pdf->SetXY(84,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pernum_lic,0,'C');

    $pdf->SetXY(104,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$perq,0,'C');

    $pdf->SetXY(110,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pera,0,'C');

    $pdf->SetXY(118,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13.6,3,$perl,0,'C');

    $pdf->SetXY(131,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(10.5,3,$pert,0,'C');

    $pdf->SetXY(141,35);
    $pdf->SetFont('Arial','',8);
    //$pdf->Cell(10.5,3,"MA",0,'C');
    $pdf->Cell(10.5,3,"",0,'C');

    $pdf->SetXY(152,35);
    $pdf->SetFont('Arial','',8);
    //$pdf->Cell(10.5,3,"DO",0,'C');
    $pdf->Cell(10.5,3,"",0,'C');
  
    $pdf->SetXY(162,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(18,3,$perct1,0,'C');

    $pdf->SetXY(181,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(18,3,$perhr1,0,'C');
    
    $pdf->SetXY(190,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perct2,0,'C');

    $pdf->SetXY(209,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19.5,3,$perhr2,0,'C');

    $pdf->SetXY(220,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct3,0,'C');

    $pdf->SetXY(240,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perhr3,0,'C');

    $pdf->SetXY(252,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct4,0,'C');

    $pdf->SetXY(271,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(11,3,$perhr4,0,'C');

    $pdf->SetXY(282,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct5,0,'C');

    $pdf->SetXY(301,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(11.5,3,$perhr5,0,'C');

    $pdf->SetXY(312.5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct6,0,'C');

    $pdf->SetXY(331.5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perhr6,0,'C');

    $pdf->SetXY(40,162);
    $pdf->MultiCell(85,42, $pdf->Image($SelloCGRH21, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
  
    $pdf->SetXY(240,160);
    $pdf->MultiCell(85,42, $pdf->Image($SelloAdm21, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");

                barcode('../../Codigo_Barras/'.$code.'.png', $code, 45, 'horizontal', 'code128', true);
                $image = '../../Codigo_Barras/'.$code.'.png';
                $pdf->Image($image,150,2,50,20,'PNG');
                unlink($image);
    $pdf->SetFont('Arial','',11);
    $pdf->SetXY(70,19);
    $pdf->Cell(80,4,utf8_decode($nom_area),0,0,'L');//C = CENTRAR
    //$pdf->Cell(101,11, $pdf->Image('codigos/'.$code.'.png', $pdf->GetX(), $pdf->GetY(),110),1);

    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(15,19);
    $pdf->Cell(35,3,$curp,0,0,'L');//C = CENTRAR

    $pdf->SetXY(265,16);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(80,3,$buscar.'/'.$pdf->PageNo()/*.'/{nb}'*/,0,0,'L');

    

    $pdf->SetXY(297,16);
    $pdf->Cell(40,3,$FEC_IMPS,0,0,'C');

/*if($cve_mov == 3){
    $Des = $cmpabc."-PERC./DEDUC. CONCEPTO: ".$cmpconcepto;
    $pdf->SetXY(300,122); 
    $pdf->SetFont('Arial','',6.7);
    $pdf->Cell(41,3,utf8_decode($Des),0,0,'L');
}
else if($cve_mov == 4){
    $Des = $cmpabc."-GUION: ".$cmpconcepto;
    $pdf->SetXY(300,122); 
    $pdf->SetFont('Arial','',6.7);
    $pdf->Cell(41,3,utf8_decode($Des),0,0,'L');
}*/
    

/*<-------------------------------------------------------------------------PROPONE SNTE----------------------------------------------------------------->*/   
    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,166); 
    $pdf->Cell(45,3,$doc_anexa1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,170); 
    $pdf->Cell(45,3,$doc_anexa2,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,174); 
    $pdf->Cell(45,3,$doc_anexa3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,178); 
    $pdf->Cell(45,3,$doc_anexa4,0,0,'L');

    $pdf->SetXY(21,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(21,4,$num_oficio,0,0,'L');

    $pdf->SetXY(60,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(29,4,$FEC_IMPS,0,0,'L');

    $pdf->SetXY(21,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13,4,$operador,0,0,'L');

    $pdf->SetXY(48,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"",0,0,'L');//IMPRIMIO

    $pdf->SetXY(76,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4, "",0,0,'L');//REVISO
$fec = date("Y-m-d",strtotime($FEC_IMP));
//echo $fec;
    if($fec <= "2021-09-29"){
      $id_consulta = 9;
      $JSON="[{\"FEC_IMP\":\"$fec\"}]";
      $arrayR1 = json_decode(json_encode($JSON), True);
      $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
      $resultados=$cliente->getConsulta($params);
      $arrayR = json_decode(json_encode($resultados), True);
      //var_dump($arrayR);
      foreach($arrayR as $value){
        $si = $value[2]["funcion_firma"];
        $sis = $value[5]["funcion_firma"];

        if($si == 0){
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"];
        if($NOMBRE_AUTORIZACIONES == ""){
        $NOMBRE_AUTORIZACIONES="";
        }else{
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"]; 
        }
        $imagen = hex2bin($value[1]["firmas"]);
        $TEMPIMGLOC = 'tempimg.gif';      
        // se prepara un base64 encoded "data url"
        $pic = "data: image/png;base64,".base64_encode($imagen)."";
        $dataPieces = explode(',',$pic);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

        //  Check if image was properly decoded
        if( $decodedImg!==false )
        {
            //  Save image to a temporary location
            if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false )
            {
                //  Open new PDF document and print image
                $pdf->SetXY(90,162);
                //$pdf->Image($TEMPIMGLOC,20,20,'C');
                $pdf->MultiCell(85,42, $pdf->Image($TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
                    //  Delete image from server
                unlink($TEMPIMGLOC);
            }
        }

      }
      if($sis == 1){
    $NOMBRE_AUTORIZA= $value[3]["nombre_firma"];
    if($NOMBRE_AUTORIZA == ""){
      $NOMBRE_AUTORIZA="";
        }else{
        $NOMBRE_AUTORIZA=$value[3]["nombre_firma"]; 
        }
         $imagen1 = hex2bin($value[4]["firmas"]);
        
        $TEMPIMGLOC1 = 'tempimg1.gif';      
        // se prepara un base64 encoded "data url"
        $pic1 = "data: image/png;base64,".base64_encode($imagen1)."";
        $dataPieces = explode(',',$pic1);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

      //  Check if image was properly decoded
      if( $decodedImg!==false )
      {
          //  Save image to a temporary location
          if( file_put_contents($TEMPIMGLOC1,$decodedImg)!==false )
          {
              //  Open new PDF document and print image
              $pdf->SetXY(175,162);
          //$pdf->Image($TEMPIMGLOC,20,20,'C');
          $pdf->MultiCell(90,40, $pdf->Image($TEMPIMGLOC1, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
              //  Delete image from server
              unlink($TEMPIMGLOC1);
          }
      }

    }
  }

    }else{
    
    $id_consulta = 9;
    $JSON="[{\"FEC_IMP\":\"$fec\"}]";
    $arrayR1 = json_decode(json_encode($JSON), True);
    $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
    $resultados=$cliente->getConsulta($params);
    $arrayR = json_decode(json_encode($resultados), True);
    //var_dump($arrayR);
      foreach($arrayR as $value){
        $si = $value[2]["funcion_firma"];
        $sis = $value[5]["funcion_firma"];

        if($si == 0){
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"];
        if($NOMBRE_AUTORIZACIONES == ""){
        $NOMBRE_AUTORIZACIONES="";
        }else{
        $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"]; 
        }
        $imagen = hex2bin($value[1]["firmas"]);
        $TEMPIMGLOC = 'tempimg.png';      
        // se prepara un base64 encoded "data url"
        $pic = "data: image/png;base64,".base64_encode($imagen)."";
        $dataPieces = explode(',',$pic);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

        //  Check if image was properly decoded
        if( $decodedImg!==false )
        {
            //  Save image to a temporary location
            if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false )
            {
                //  Open new PDF document and print image
                $pdf->SetXY(90,162);
                //$pdf->Image($TEMPIMGLOC,20,20,'C');
                $pdf->MultiCell(85,42, $pdf->Image($TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
                    //  Delete image from server
                unlink($TEMPIMGLOC);
            }
        }

      }
      if($sis == 1){
    $NOMBRE_AUTORIZA= $value[3]["nombre_firma"];
    if($NOMBRE_AUTORIZA == ""){
      $NOMBRE_AUTORIZA="";
        }else{
        $NOMBRE_AUTORIZA=$value[3]["nombre_firma"]; 
        }
         $imagen1 = hex2bin($value[4]["firmas"]);
        
        $TEMPIMGLOC1 = 'tempimg1.gif';      
        // se prepara un base64 encoded "data url"
        $pic1 = "data: image/png;base64,".base64_encode($imagen1)."";
        $dataPieces = explode(',',$pic1);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

      //  Check if image was properly decoded
      if( $decodedImg!==false )
      {
          //  Save image to a temporary location
          if( file_put_contents($TEMPIMGLOC1,$decodedImg)!==false )
          {
              //  Open new PDF document and print image
              $pdf->SetXY(175,177);
          //$pdf->Image($TEMPIMGLOC,20,20,'C');
          $pdf->MultiCell(90,40, $pdf->Image($TEMPIMGLOC1, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
              //  Delete image from server
              unlink($TEMPIMGLOC1);
          }
      }

    }
  }
}


    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,166); 
    $pdf->Cell(45,3,$obsrv1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,170); 
    $pdf->Cell(45,3,$obsrv2,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,174); 
    $pdf->Cell(45,3,$obsrv3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,178); 
    $pdf->Cell(45,3,$obsrv4,0,0,'L');

    $pdf->Line(5, 181.2, 122-5, 181.2); // PARTE DE ARRIBA
    $pdf->Line(160, 181.2, 352-5, 181.2); // PARTE DE ARRIBA 2
    $pdf->Line(90.1, 162.3, 90.1, 204.4);//linea vertical derecha
    $pdf->SetXY(35,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"PROPONE SNTE",0,0,'L');

    $pdf->SetXY(5,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(32,4,"OFICIO NO.",0,0,'L');  

    $pdf->Line(22, 189.2, 45-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(45,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(42,4,"FECHA",0,0,'L'); 
    
    $pdf->Line(60, 189.2, 93-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(5,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,4,"CAPTURO:",0,0,'L');

    $pdf->Line(22, 199.3, 38-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(33,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,4,"IMPRIMIO:",0,0,'L');

    $pdf->Line(48, 199.3, 69-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(64,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13,4,"REVISO:",0,0,'L'); 

    $pdf->Line(77, 199.3, 94-5, 199.3); // PARTE DE ABAJO DE RESPUESTA


    $pdf->Line(190.1, 162.3, 190.1, 181.2);//linea vertical derecha
    $TEXTO="SE HACE CONSTAR QUE EL TRABAJADOR PROTESTA DESEMPEÑAR LEAL Y PATRIOTICAMENTE EL PUESTO QUE SE LE HA CONFERIDO Y GUARDAR Y HACER GUARDAR LA CONSTITUCION POLITICA DE LOS ESTADOS UNIDOS MEXICANOS Y LAS LEYES QUE DE ELLA EMANEN";
    $pdf->SetXY(190,162.3);
    $pdf->SetFont('Arial','',7);
    //$pdf->SetX(190); // abscissa of Horizontal position 
    $pdf->MultiCell(80,3.5,utf8_decode($TEXTO),0,'J',false);

//<------------------------------------------------------------------------AUTORIZACIONES------------------------------------------------------------------->
    $pdf->SetXY(120,177);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(42,4,"AUTORIZACIONES",0,0,'L');

    $pdf->SetXY(125,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,3,"OTORGA VIGENCIA",0,0,'L');

    $pdf->SetXY(90,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

    $pdf->Line(105, 189.2, 175-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(90,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4,"FIRMA",0,0,'L');

    $pdf->Line(105, 193.2, 175-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(90,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(105, 198.5, 175-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(175.2, 181.2, 175.2, 204.3);//linea vertical derecha
//<-----------------------------------------------------------------FIN DE AUTORIZACIONES------------------------------------------------------------------->
//<------------------------------------------------------------------------AUTORIZA------------------------------------------------------------------------->
    $pdf->SetXY(210,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"AUTORIZA",0,0,'L');

    $pdf->SetXY(175,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

    $pdf->Line(260, 189.2, 195-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(175,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4,"FIRMA",0,0,'L');

    $pdf->Line(260, 193.2, 195-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(175,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(260, 198.5, 195-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(265.4, 181.2, 265.4, 204.3);//linea vertical derecha


//<------------------------------------------------------------------------FIN DE AUTORIZA-------------------------------------------------------------->
/*<-------------------------------------------------------------------------AUTORIZACIONES--------------------------------------------------------------->*/
    $pdf->SetXY(105,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');

    //$pdf->SetXY(100,162);
    //$pdf->MultiCell(85,42, $pdf->Image("../../Logo/firma.png", $pdf->GetX()+10, $pdf->GetY()+3, 80),0,"C");

    $pdf->SetXY(105,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($FEC_IMPS),0,0,'L');
/*<-------------------------------------------------------------------------AUTORIZA-------------------------------------------------------------------->*/
    $pdf->SetXY(190,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZA),0,0,'L');

    //$pdf->SetXY(185,162);
    //$pdf->MultiCell(90,40, $pdf->Image("../../Logo/firma2.png", $pdf->GetX()+10, $pdf->GetY()+3, 80) ,0,"C");

    $pdf->SetXY(190,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($FEC_IMPS),0,0,'L');
/*<-------------------------------------------------------------------------INTERESADO------------------------------------------------------------------->*/
    $pdf->SetXY(280,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($pernom_emp),0,0,'L');

    $pdf->SetXY(280,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(60,3, utf8_decode($FEC_IMPS),0,0,'L');


    $pdf->SetXY(206,206);  
    $pdf->SetFont('Arial','',15);
    $pdf->Cell(14,3,utf8_decode("FUP COPIA TRAMITADO"),0,0,'L');
         
    $pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN

    $pdf->SetXY(6,205);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L'); 

    $TEXTO1="DECLARO BAJO PROTESTA DE DECIR VERDAD QUE _______ ME ENCUENTRO DESEMPEÑANDO OTRO EMPLEO O COMISIÓN DENTRO DE OTRA ENTIDAD DE LA ADMINISTRACIÓN PÚBLICA FEDERAL";//"DECLARO BAJO PROTESTA DE DECIR VERDAD QUE _______ ME ENCUENTRO DESEMPEÑANDO OTRO EMPLEO O COMISIÓN DENTRO DE OTRA ENTIDAD DE LA ADMINISTRACIÓN PÚBLICA FEDERAL";

    $pdf->Line(270.2, 162.3, 270.2, 181.2);//linea vertical derecha

    $pdf->SetXY(270,162);
    $pdf->SetFont('Arial','',7);
    $pdf->MultiCell(74,4.5,utf8_decode($TEXTO1),0,'J',false);

    $pdf->SetXY(292,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"INTERESADO",0,0,'L');

    $pdf->SetXY(265,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,"NOMBRE",0,0,'L');

    $pdf->Line(340,188.4, 285-5, 188.4); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(265,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FIRMA",0,0,'L');

    $pdf->Line(340, 193.2, 285-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(265,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(340, 198.5, 285-5, 198.5); // PARTE DE ABAJO DE RESPUESTA
    $is3++;
}
/*if($pdf->PageNo() == 2){
    
    $pdf->SetXY(100,75);
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(80,3,$numeroFormateado,0);
      echo $numeroFormateado;
}*/
if($pdf->PageNo() == 2 && $is3 <= 2){

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(5,25.5);
    $pdf->Cell(37.5,3.8,$perrfc,0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(41,25.5);
    $pdf->Cell(40,3.8,$pernom_emp,0);

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(133,25.5);
    $pdf->Cell(10,3.8,$peredo_nac,0);

    $pdf->SetXY(152,25.5);
    $pdf->Cell(10,3.8,$persexo,0);

    $pdf->SetXY(170,25.5);
    $pdf->Cell(10,3.8,$peredo_civil,0);

    $pdf->SetXY(190,25.5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(100,3.8,"PARTICULAR",0);

    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(228,22.5);
    $pdf->Cell(73,3,$peremp_dom,0);

    $pdf->SetXY(320,22.5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,3,$peremp_dom_cp,0);

    $pdf->SetXY(225,25.8);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(121,3,$peremp_dom_col,0);

    $pdf->SetXY(233,29);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,3,$peremp_dom_pb,0);

    $pdf->SetXY(5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->MultiCell(15,3,$perniv_academico,0,'C',false);

    $pdf->SetXY(20,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,$perqna_ing_gob,0,'C');

    $pdf->SetXY(35,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,$perqna_ing_sep,0,'C');

    $pdf->SetXY(50,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14.5,3,$perarea,0,'C');

    $pdf->SetXY(67,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pernum_tit,0,'C');

    $pdf->SetXY(84,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pernum_lic,0,'C');

    $pdf->SetXY(104,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$perq,0,'C');

    $pdf->SetXY(110,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,3,$pera,0,'C');

    $pdf->SetXY(118,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13.6,3,$perl,0,'C');

    $pdf->SetXY(131,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(10.5,3,$pert,0,'C');

    $pdf->SetXY(141,35);
    $pdf->SetFont('Arial','',8);
    //$pdf->Cell(10.5,3,"MA",0,'C');
    $pdf->Cell(10.5,3,"",0,'C');

    $pdf->SetXY(152,35);
    $pdf->SetFont('Arial','',8);
    //$pdf->Cell(10.5,3,"DO",0,'C');
    $pdf->Cell(10.5,3,"",0,'C');
  
    $pdf->SetXY(162,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(18,3,$perct1,0,'C');

    $pdf->SetXY(181,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(18,3,$perhr1,0,'C');
    
    $pdf->SetXY(190,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perct2,0,'C');

    $pdf->SetXY(209,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19.5,3,$perhr2,0,'C');

    $pdf->SetXY(220,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct3,0,'C');

    $pdf->SetXY(240,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perhr3,0,'C');

    $pdf->SetXY(252,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct4,0,'C');

    $pdf->SetXY(271,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(11,3,$perhr4,0,'C');

    $pdf->SetXY(282,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct5,0,'C');

    $pdf->SetXY(301,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(11.5,3,$perhr5,0,'C');

    $pdf->SetXY(312.5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(19,3,$perct6,0,'C');

    $pdf->SetXY(331.5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(12,3,$perhr6,0,'C');

    $pdf->SetXY(40,162);
    $pdf->MultiCell(85,42, $pdf->Image($SelloCGRH21, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
  
    $pdf->SetXY(240,160);
    $pdf->MultiCell(85,42, $pdf->Image($SelloAdm21, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");

                barcode('../../Codigo_Barras/'.$code.'.png', $code, 45, 'horizontal', 'code128', true);
                $image = '../../Codigo_Barras/'.$code.'.png';
                $pdf->Image($image,150,2,50,20,'PNG');
                unlink($image);
    $pdf->SetFont('Arial','',11);
    $pdf->SetXY(70,19);
    $pdf->Cell(80,4,utf8_decode($nom_area),0,0,'L');//C = CENTRAR
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(15,19);
    $pdf->Cell(35,3,$curp,0,0,'L');//C = CENTRAR

    $pdf->SetXY(265,16);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(80,3,$buscar.'/'.$pdf->PageNo()/*.'/{nb}'*/,0,0,'L');

    $pdf->SetXY(297,16);
    $pdf->Cell(40,3,$FECHA,0,0,'C');

/*if($cve_mov == 3){
    $Des = $cmpabc."-PERC./DEDUC. CONCEPTO: ".$cmpconcepto;
    $pdf->SetXY(300,122); 
    $pdf->SetFont('Arial','',6.7);
    $pdf->Cell(41,3,utf8_decode($Des),0,0,'L');
}
else if($cve_mov == 4){
    $Des = $cmpabc."-GUION: ".$cmpconcepto;
    $pdf->SetXY(300,122); 
    $pdf->SetFont('Arial','',6.7);
    $pdf->Cell(41,3,utf8_decode($Des),0,0,'L');
}*/
    

/*<--------------------------------------------------------------PROPONE SNTE----------------------------------------------------------------->*/   
    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,166); 
    $pdf->Cell(45,3,$doc_anexa1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,170); 
    $pdf->Cell(45,3,$doc_anexa2,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,174); 
    $pdf->Cell(45,3,$doc_anexa3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,178); 
    $pdf->Cell(45,3,$doc_anexa4,0,0,'L');

    $pdf->SetXY(21,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(21,4,$num_oficio,0,0,'L');

    $pdf->SetXY(60,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(29,4,$FECHA,0,0,'L');

    $pdf->SetXY(21,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13,4,$operador,0,0,'L');

    $pdf->SetXY(48,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"",0,0,'L');//IMPRIMIO

    $pdf->SetXY(76,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4, "",0,0,'L');//REVISO

      $id_consulta = 9;
      $JSON="[{\"FEC_IMP\":\"$fec\"}]";
      $arrayR1 = json_decode(json_encode($JSON), True);
      $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
      $resultados=$cliente->getConsulta($params);
      $arrayR = json_decode(json_encode($resultados), True);

      foreach($arrayR as $value){
  
        $si = $value[2]["funcion_firma"];
        $sis = $value[5]["funcion_firma"];

        if($si == 0){
          $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"];
        if($NOMBRE_AUTORIZACIONES == ""){
          $NOMBRE_AUTORIZACIONES="";
        }else{
          $NOMBRE_AUTORIZACIONES=$value[0]["nombre_firma"]; 
        }
        $imagen = hex2bin($value[1]["firmas"]);
        $TEMPIMGLOC = 'tempimg.gif';      
        // se prepara un base64 encoded "data url"
        $pic = "data: image/png;base64,".base64_encode($imagen)."";
        $dataPieces = explode(',',$pic);
        $encodedImg = $dataPieces[1];
        $decodedImg = base64_decode($encodedImg);

      //  Check if image was properly decoded
      if( $decodedImg!==false )
      {
          //  Save image to a temporary location
          if( file_put_contents($TEMPIMGLOC,$decodedImg)!==false )
          {
              //  Open new PDF document and print image
              $pdf->SetXY(90,162);
              //$pdf->Image($TEMPIMGLOC,20,20,'C');
              $pdf->MultiCell(85,42, $pdf->Image($TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
              //  Delete image from server
              unlink($TEMPIMGLOC);
          }
      }

        }
      if($sis == 1){
         $NOMBRE_AUTORIZA= $value[3]["nombre_firma"];
      if($NOMBRE_AUTORIZA == ""){
         $NOMBRE_AUTORIZA="";
      }else{
         $NOMBRE_AUTORIZA=$value[3]["nombre_firma"]; 
      }
      $imagen1 = hex2bin($value[4]["firmas"]);
    
      $TEMPIMGLOC1 = 'tempimg1.gif';      
      // se prepara un base64 encoded "data url"
      $pic1 = "data: image/png;base64,".base64_encode($imagen1)."";
      $dataPieces = explode(',',$pic1);
      $encodedImg = $dataPieces[1];
      $decodedImg = base64_decode($encodedImg);

      //  Check if image was properly decoded
      if( $decodedImg!==false )
      {
          //  Save image to a temporary location
          if( file_put_contents($TEMPIMGLOC1,$decodedImg)!==false )
          {
              //  Open new PDF document and print image
              $pdf->SetXY(175,162);
          //$pdf->Image($TEMPIMGLOC,20,20,'C');
          $pdf->MultiCell(90,40, $pdf->Image($TEMPIMGLOC1, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
              //  Delete image from server
              unlink($TEMPIMGLOC1);
          }
      }

          }
        }


    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,166); 
    $pdf->Cell(45,3,$obsrv1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,170); 
    $pdf->Cell(45,3,$obsrv2,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,174); 
    $pdf->Cell(45,3,$obsrv3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(95,178); 
    $pdf->Cell(45,3,$obsrv4,0,0,'L');

    $pdf->Line(5, 181.2, 122-5, 181.2); // PARTE DE ARRIBA
    $pdf->Line(160, 181.2, 352-5, 181.2); // PARTE DE ARRIBA 2
    $pdf->Line(90.1, 162.3, 90.1, 204.4);//linea vertical derecha
    $pdf->SetXY(35,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"PROPONE SNTE",0,0,'L');

    $pdf->SetXY(5,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(32,4,"OFICIO NO.",0,0,'L');  

    $pdf->Line(22, 189.2, 45-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(45,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(42,4,"FECHA",0,0,'L'); 
    
    $pdf->Line(60, 189.2, 93-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(5,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,4,"CAPTURO:",0,0,'L');

    $pdf->Line(22, 199.3, 38-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(33,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(16,4,"IMPRIMIO:",0,0,'L');

    $pdf->Line(48, 199.3, 69-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(64,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(13,4,"REVISO:",0,0,'L'); 

    $pdf->Line(77, 199.3, 94-5, 199.3); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(190.1, 162.3, 190.1, 181.2);//linea vertical derecha
    $TEXTO="SE HACE CONSTAR QUE EL TRABAJADOR PROTESTA DESEMPEÑAR LEAL Y PATRIOTICAMENTE EL PUESTO QUE SE LE HA CONFERIDO Y GUARDAR Y HACER GUARDAR LA CONSTITUCION POLITICA DE LOS ESTADOS UNIDOS MEXICANOS Y LAS LEYES QUE DE ELLA EMANEN";
    $pdf->SetXY(190,162.3);
    $pdf->SetFont('Arial','',7);
    //$pdf->SetX(190); // abscissa of Horizontal position 
    $pdf->MultiCell(80,3.5,utf8_decode($TEXTO),0,'J',false);

//<------------------------------------------------------------------------AUTORIZACIONES------------------------------------------------------------------->
    $pdf->SetXY(120,177);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(42,4,"AUTORIZACIONES",0,0,'L');

    $pdf->SetXY(125,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,3,"OTORGA VIGENCIA",0,0,'L');

    $pdf->SetXY(90,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

    $pdf->Line(105, 189.2, 175-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(90,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4,"FIRMA",0,0,'L');

    $pdf->Line(105, 193.2, 175-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(90,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(105, 198.5, 175-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(175.2, 181.2, 175.2, 204.3);//linea vertical derecha
//<-----------------------------------------------------------------FIN DE AUTORIZACIONES------------------------------------------------------------------->
//<------------------------------------------------------------------------AUTORIZA------------------------------------------------------------------------->
    $pdf->SetXY(210,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"AUTORIZA",0,0,'L');

    $pdf->SetXY(175,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

    $pdf->Line(260, 189.2, 195-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(175,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,4,"FIRMA",0,0,'L');

    $pdf->Line(260, 193.2, 195-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(175,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

    $pdf->Line(260, 198.5, 195-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

    $pdf->Line(265.4, 181.2, 265.4, 204.3);//linea vertical derecha


//<------------------------------------------------------------------------FIN DE AUTORIZA-------------------------------------------------------------->
    
/*<------------------------------------------------------------------------AUTORIZACIONES--------------------------------------------------------------->*/
    $pdf->SetXY(105,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');

    //$pdf->SetXY(100,162);
    //$pdf->MultiCell(85,42, $pdf->Image("../../Logo/firma.png", $pdf->GetX()+10, $pdf->GetY()+3, 80),0,"C");

    $pdf->SetXY(105,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($FECHA),0,0,'L');
/*<-------------------------------------------------------------------------AUTORIZA-------------------------------------------------------------------->*/
    $pdf->SetXY(190,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZA),0,0,'L');

    //$pdf->SetXY(185,162);
    //$pdf->MultiCell(90,40, $pdf->Image("../../Logo/firma2.png", $pdf->GetX()+10, $pdf->GetY()+3, 80) ,0,"C");

    $pdf->SetXY(190,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($FECHA),0,0,'L');
/*<-------------------------------------------------------------------------INTERESADO------------------------------------------------------------------->*/
    $pdf->SetXY(280,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(65,3, utf8_decode($pernom_emp),0,0,'L');

    $pdf->SetXY(280,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(60,3, utf8_decode($FECHA),0,0,'L');


    $pdf->SetXY(206,206);  
    $pdf->SetFont('Arial','',15);
    $pdf->Cell(14,3,utf8_decode("FUP COPIA TRAMITADO"),0,0,'L');
         
    $pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN

    $pdf->SetXY(6,205);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L'); 

    $TEXTO1="DECLARO BAJO PROTESTA DE DECIR VERDAD QUE _______ ME ENCUENTRO DESEMPEÑANDO OTRO EMPLEO O COMISIÓN DENTRO DE OTRA ENTIDAD DE LA ADMINISTRACIÓN PÚBLICA FEDERAL";//"DECLARO BAJO PROTESTA DE DECIR VERDAD QUE _______ ME ENCUENTRO DESEMPEÑANDO OTRO EMPLEO O COMISIÓN DENTRO DE OTRA ENTIDAD DE LA ADMINISTRACIÓN PÚBLICA FEDERAL";

    $pdf->Line(270.2, 162.3, 270.2, 181.2);//linea vertical derecha

    $pdf->SetXY(270,162);
    $pdf->SetFont('Arial','',7);
    //$this->SetX(270); // abscissa of Horizontal position 
    $pdf->MultiCell(74,4.5,utf8_decode($TEXTO1),0,'J',false);

    $pdf->SetXY(292,181);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(42,4,"INTERESADO",0,0,'L');

    $pdf->SetXY(265,186);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(15,3,"NOMBRE",0,0,'L');

    $pdf->Line(340,188.4, 285-5, 188.4); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(265,191);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FIRMA",0,0,'L');

    $pdf->Line(340, 193.2, 285-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

    $pdf->SetXY(265,196);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(14,3,"FECHA",0,0,'L');

   

    $pdf->Line(340, 198.5, 285-5, 198.5); // PARTE DE ABAJO DE RESPUESTA
    $is3++;
}

}//fin while $y11

}//fin arrayR44


       $y = $y + 49;
          
    }//fin while $y
  } //fin foreach arrayR4


          }//fin while $y2

        }//fin foreach arrayR5

$nom_area1 = trim($nom_area);
$pdf->Output('I','../../FUPs/Masivo_Copia/'.$nom_area1.'_'.$curp.'_'.$docto_num_get.'.pdf');
?>
  