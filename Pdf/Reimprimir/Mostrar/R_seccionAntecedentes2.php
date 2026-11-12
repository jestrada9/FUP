<?php
           
        $pdf->SetXY(5,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(8,3,$prepartida,0,0,'R');

        $pdf->SetXY(12.5,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->MultiCell(5,3,utf8_decode($precod_pago),0,'R',false);

        $pdf->SetXY(17.5,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->MultiCell(5,3,utf8_decode($preunidad),0,'R',false);

        $pdf->SetXY(22,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->MultiCell(5,3,utf8_decode($presubunidad),0,'R',false);

        $pdf->SetXY(27,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',6);
        $pdf->MultiCell(11,3,utf8_decode($precat_puesto),0,'C',false);

        $pdf->SetXY(37.5,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->MultiCell(7,3,utf8_decode($prehoras),0,'C',false);

        $pdf->SetXY(45,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',6.5);
        $pdf->MultiCell(12,3,utf8_decode($precons_plaza),0,'C',false);

        $pdf->SetXY(57,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(8,3,$premot_mov,0,0,'C');
        
        $pdf->SetXY(65,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(6,3,$pre07,0,0,'C');
/*
        $pdf->SetXY(71,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(15,3,"$".$prei07,0,0,'C');
*/
        $pdf->SetXY(84,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preqna_ini,0,0,'C');

        $pdf->SetXY(94,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preqna_fin,0,0,'C');

        $pdf->SetXY(105,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(15,3,$prenum_doctopla,0,0,'C');
    
        $pdf->SetXY(120,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(6,3,$preDR,0,0,'C');

        $pdf->SetXY(126,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(15,3,$preiDR,0,0,'C');

        $pdf->SetXY(139.5,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preiDRqna_ini,0,0,'C');

        $pdf->SetXY(146.5,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(15,3,$preiDRqna_fin,0,0,'C');

        $pdf->SetXY(160.5,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(15,3,$preDRnum_docto,0,0,'C');
    
        $pdf->SetXY(174,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preBS,0,0,'C');

        $pdf->SetXY(184,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preiBS,0,0,'C');

        $pdf->SetXY(193,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(15,3,$preBSqna_ini,0,0,'C');

        $pdf->SetXY(206,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preBSqna_fin,0,0,'C');

        $pdf->SetXY(219,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preBSnum_docto,0,0,'C');
    
        $pdf->SetXY(230,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preI4,0,0,'C');

        $pdf->SetXY(240,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preiI4,0,0,'C');

        $pdf->SetXY(249,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(15,3,$preI4qna_ini,0,0,'C');

        $pdf->SetXY(262,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preI4qna_fin,0,0,'C');

        $pdf->SetXY(276,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preI4num_docto,0,0,'C');
    
        $pdf->SetXY(286,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preE3,0,0,'C');

        $pdf->SetXY(296,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preiE3,0,0,'C');

        $pdf->SetXY(305,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(15,3,$preE3qna_ini,0,0,'C');

        $pdf->SetXY(318,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preE3qna_fin,0,0,'C');

        $pdf->SetXY(331,44.5+($t)+($t)+($t));
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(10,3,$preE3num_docto,0,0,'C');

?>