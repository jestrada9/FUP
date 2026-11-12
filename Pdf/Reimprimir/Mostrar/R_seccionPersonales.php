<?php
include_once __DIR__."/../../crearPDF/normaliza_xml.php";
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(5,25.5);
    $pdf->Cell(37.5,3.8,$perrfc,0);
    
    $pdf->SetFont('Arial','',8);
    $pdf->SetXY(41,25.5);
    $pdf->Cell(40,3.8,utf8_decode($pernom_emp),0);

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
    $pdf->Cell(73,3,utf8_decode($peremp_dom),0);

    $pdf->SetXY(320,22.5);
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,3,$peremp_dom_cp,0);

    $pdf->SetXY(225,25.8);
    $pdf->SetFont('Arial','',8);
    if($peremp_dom_col != "NULL"){
        $pdf->Cell(121,3,utf8_decode($peremp_dom_col),0);
        //$pdf->Cell(121,3,$peremp_dom_col,0);
    }
    

    $pdf->SetXY(233,29);
    $pdf->SetFont('Arial','',8);
    if($peremp_dom_pob != "NULL"){
        $pdf->Cell(30,3,utf8_decode($peremp_dom_pob),0);
        //$pdf->Cell(30,3,$peremp_dom_pob,0);
    }

    $pdf->SetXY(5,35);
    $pdf->SetFont('Arial','',8);
    $pdf->MultiCell(15,3,fup_txt($perniv_academico),0,'C',false);

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

    barcode('../../Codigo_Barras/'.$percpr.'.png', $percpr, 45, 'horizontal', 'code128', true);
    $image = '../../Codigo_Barras/'.$percpr.'.png';
    $pdf->Image($image,150,2,50,20,'PNG');
    //unlink($image);

    $pdf->SetFont('Arial','',11);
    $pdf->SetXY(70,19);
    $pdf->Cell(80,4,utf8_decode($pernom_area),0,0,'L');//C = CENTRAR
    
    $pdf->SetFont('Arial','B',8);
    $pdf->SetXY(15,19);
    $pdf->Cell(35,3,$percurp,0,0,'L');//C = CENTRAR

    $pdf->SetXY(265,16);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(80,3,$pernum_docto.'/'/*.$pdf->GroupPageNo().'/'*/.$pdf->GroupPageNo()/*.'/{nb}'*/,0,0,'L');

    $pdf->SetXY(297,16);
    $pdf->Cell(40,3,$percaptura,0,0,'C');

    $DOC_OBSRV1 = htmlspecialchars_decode($perobsrv1);
    $DOC_OBSRV2 = htmlspecialchars_decode($perobsrv2);
    $DOC_OBSRV3 = htmlspecialchars_decode($perobsrv3);
    $DOC_OBSRV4 = htmlspecialchars_decode($perobsrv4);

    $DOC_ANEXA1 = htmlspecialchars_decode($perdoc_anexa1);
    $DOC_ANEXA2 = htmlspecialchars_decode($perdoc_anexa2);
    $DOC_ANEXA3 = htmlspecialchars_decode($perdoc_anexa3);
    $DOC_ANEXA4 = htmlspecialchars_decode($perdoc_anexa4);
    $DOC_ANEXA5 = htmlspecialchars_decode($perdoc_anexa5);

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,165); 
    $pdf->Cell(85,3,$DOC_ANEXA1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,168); 
    $pdf->Cell(85,3,utf8_decode($DOC_ANEXA2),0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,171); 
    $pdf->Cell(85,3,$DOC_ANEXA3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,174); 
    $pdf->Cell(85,3,$DOC_ANEXA4,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(5,177); 
    $pdf->Cell(85,3,$DOC_ANEXA5,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(90,165); 
    $pdf->Cell(100,3,$DOC_OBSRV1,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(90,168); 
    $pdf->Cell(100,3,$DOC_OBSRV2,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(90,171); 
    $pdf->Cell(100,3,$DOC_OBSRV3,0,0,'L');

    $pdf->SetFont('Arial','',6);
    $pdf->SetXY(90,174); 
    $pdf->Cell(100,3,$DOC_OBSRV4,0,0,'L');

    if($pdf->PageNo() == 2){
        if($pdf->PageNo()>1){
            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(90,174); 
            $pdf->Cell(85,3,'COMPLEMENTARIO',0,0,'L');
        }   
    }   
?>