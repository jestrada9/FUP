<?php 
 
    $dias2 = "";
    $linea = "";

    $pdf->SetXY(5,121+($i)+($i)+($i));   
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$placve_mov,0,0,'L');

    $pdf->SetXY(9.5,121+($i)+($i)+($i));
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(4.5,3,$plamot_mov,0,0,'L');

    $pdf->SetXY(14,121+($i)+($i)+($i)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(7.5,3,$plapartida,0,0,'L');

    $pdf->SetXY(21.8,121+($i)+($i)+($i));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$placod_pago,0,0,'L');

    $pdf->SetXY(28,121+($i)+($i)+($i));  
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plaunidad,0,0,'L');

    $pdf->SetXY(34,121+($i)+($i)+($i)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(6,3,$plasubunidad,0,0,'L');

    $pdf->SetXY(40,121+($i)+($i)+($i)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placat_puesto,0,0,'L');

    $pdf->SetXY(51,121+($i)+($i)+($i)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(9,3,$plahoras,0,0,'L');

    $pdf->SetXY(59,121+($i)+($i)+($i)); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell(11,3,$placons_plaza,0,0,'L');


    if(($placve_mov == "06") && ($plamot_mov == "75") && ($activo == "activo")){

    $id_consultaFupFecha =  233;
    $JSONFupFecha="[{\"qna\":\"$plaqna_ini\"}]";
    $arrayFupFecha = json_decode(json_encode($JSONFupFecha), True);
    $paramsFupFecha = array('Resultado'=>$id_consultaFupFecha, 'Argumento'=>$arrayFupFecha, 'Accion'=>"select"); //para conseguir la consulta
    //var_dump($paramsP);
    $resultadosFupFecha=$cliente->getConsulta($paramsFupFecha);   
    $arrayRFupFecha= json_decode(json_encode($resultadosFupFecha), True);
    //var_dump($arrayRFupFecha);
            $xml1 = simplexml_load_string($arrayRFupFecha['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
        $json1 = json_encode($xml1);
        $array1 = json_decode($json1,TRUE);
    if(!empty($array1)){
        $ver1 = $array1['NewDataSet']['table'];
          $qnaOri=$ver1["fecha"];
                $pdf->SetXY(70,121+($i)+($i)+($i));  
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(11,3,$qnaOri,0,0,'L');
      }

    }elseif( ($placve_mov == "06") && ($plamot_mov == "33") && ($activo == "activo")){//06 - 33

      $id_consultaFupFecha =  233;
      $JSONFupFecha="[{\"qna\":\"$plaqna_ini\"}]";
      $arrayFupFecha = json_decode(json_encode($JSONFupFecha), True);
      $paramsFupFecha = array('Resultado'=>$id_consultaFupFecha, 'Argumento'=>$arrayFupFecha, 'Accion'=>"select"); //para conseguir la consulta
      //var_dump($paramsP);
      $resultadosFupFecha=$cliente->getConsulta($paramsFupFecha);   
      $arrayRFupFecha= json_decode(json_encode($resultadosFupFecha), True);
      //var_dump($arrayRFupFecha);
              $xml1 = simplexml_load_string($arrayRFupFecha['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
          $json1 = json_encode($xml1);
          $array1 = json_decode($json1,TRUE);
      if(!empty($array1)){
          $ver1 = $array1['NewDataSet']['table'];
            $qnaOri=$ver1["fecha"];
                  $pdf->SetXY(70,121+($i)+($i)+($i));  
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(11,3,$qnaOri,0,0,'L');
        }


     }elseif(($placve_mov == "06") && ($plamot_mov == "31") && ($activo == "activo")){//06 - 31
      //echo "06 31 activo";
        $qnaOri= "";
        $id_consultaFupFecha =  61;
        $JSONFupFecha="[{\"num_docto\":\"$docto_num\"}]";
        $arrayFupFecha = json_decode(json_encode($JSONFupFecha), True);
        $paramsFupFecha = array('Resultado'=>$id_consultaFupFecha, 'Argumento'=>$arrayFupFecha, 'Accion'=>"select"); //para conseguir la consulta
        //var_dump($paramsFupFecha);
        $resultadosFupFecha=$cliente->getConsulta($paramsFupFecha);   
        $arrayRFupFecha= json_decode(json_encode($resultadosFupFecha), True);
        //var_dump($arrayRFupFecha);
        
        $xml1 = simplexml_load_string($arrayRFupFecha['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
        $json1 = json_encode($xml1);
        $array1 = json_decode($json1,TRUE);
//var_dump($array1);

        if (!empty($array1) && isset($array1['NewDataSet']['table'])) {
    $rows = $array1['NewDataSet']['table'];

    // Si el array de filas no está vacío
    if (!empty($rows)) {
        // Si es un array asociativo (una sola fila), lo convertimos en array de una fila para uniformar
        if (!isset($rows[0])) {
            $rows = [$rows];
        }

        // Tomamos la primera fila (o la que necesites)
        $primeraFila = $rows[0];

        // Verificamos que exista 'fecha_def' y que no sea null
        if (isset($primeraFila['fecha_def']) && $primeraFila['fecha_def'] !== null) {
            $qnaOri = $primeraFila['fecha_def'];

            $pdf->SetXY(70, 121 + ($i) * 3);  // o 121+$i+$i+$i, es lo mismo
            $pdf->SetFont('Arial', '', 7);
            $pdf->Cell(11, 3, $qnaOri, 0, 0, 'L');
        }
    }
}
  
      }else{//06 - 33 fin

        $pdf->SetXY(70,121+($i)+($i)+($i));  
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(11,3,$plaqna_ini,0,0,'L');

        $pdf->SetXY(81,121+($i)+($i)+($i)); 
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(11,3,$plaqna_fin,0,0,'L');

      }//06 - 33 fin
/*         
    if(($placve_mov == "01") || ($placve_mov == "02") || ($placve_mov == "17") || ($placve_mov == "30")){//pla 01-02
      $pdf->SetXY(93,121+($i)+($i)+($i)); 
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(72,3,$planom_emp,0,0,'L');

      $pdf->SetXY(165,121+($i)+($i)+($i)); 
      $pdf->SetFont('Arial','B',7);
      $pdf->Cell(24,3,$plarfc,0,0,'L');

      $pdf->SetXY(189,121+($i)+($i)+($i)); 
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(7,3,$plamot_movsub,0,0,'L');

      $pdf->SetXY(196,121+($i)+($i)+($i)); 
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(10,3,$plaqna_inisub,0,0,'L');

      $pdf->SetXY(206,121+($i)+($i)+($i));  
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(10,3,$plaqna_finsub,0,0,'L');

      $pdf->SetXY(220,121+($i)+($i)+($i)); 
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(18,3,$planum_doctosub,0,0,'L');
    }//pla 01-02
*/    
      $pdf->SetXY(237.5,121+($i)+($i)+($i));  
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(16.5,3,$plactnvo,0,0,'L');

      $pdf->SetXY(254.5,121+($i)+($i)+($i));  
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(8,3,$planivel_sueldonvo,0,0,'C');

      $pdf->SetXY(266,121+($i)+($i)+($i)); 
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(9,3,$plabasificacion,0,0,'L');

      $pdf->SetXY(275,121+($i)+($i)+($i));  
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(12.5,3,$plapromocion,0,0,'L');

      $pdf->SetXY(288,121+($i)+($i)+($i));  
      $pdf->SetFont('Arial','',7);
      $pdf->Cell(13,3,$plaqna_ing_sub,0,0,'L');
              
      $pdf->SetXY(300,121+($i)+($i)+($i)); 
      $pdf->SetFont('Arial','',6.5);
      $pdf->Cell(41,3,utf8_decode($DESCRIPCION),0,0,'L');  
?>