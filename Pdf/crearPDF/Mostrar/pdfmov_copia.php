<?php
	$pdf->SetXY(5,121+($i)+($i)+($i));   
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(4.5,3,$TM,0,0,'L');
	
	$pdf->SetXY(9.5,121+($i)+($i)+($i));
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(4.5,3,$MO,0,0,'L');

	$pdf->SetXY(14,121+($i)+($i)+($i)); 
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(7.5,3,$PARTIDA_MOVR,0,0,'L');

	$pdf->SetXY(21.8,121+($i)+($i)+($i));  
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(6,3,$CODIGO_PAGO_MOVR,0,0,'L');

	$pdf->SetXY(28,121+($i)+($i)+($i));  
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(6,3,$UNIDAD_MOVR,0,0,'L');

	$pdf->SetXY(34,121+($i)+($i)+($i)); 
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(6,3,$SUBUNIDAD_MOVR,0,0,'L');

	$pdf->SetXY(40,121+($i)+($i)+($i)); 
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(11,3,$CATEGORIA_MOVR,0,0,'L');

	$pdf->SetXY(51,121+($i)+($i)+($i)); 
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(9,3,$HORAS_MOVR,0,0,'L');

	$pdf->SetXY(59,121+($i)+($i)+($i)); 
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(11,3,$PLAZA_MOVR,0,0,'L');
	

	if($dia == "si"){
		dia($dias,$docto_num,$cliente,$pdf,1,$i);	
	}else{

		$pdf->SetXY(70,121+($i)+($i)+($i));  
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(11,3,$DESDE_MOV,0,0,'L');

		$pdf->SetXY(81,121+($i)+($i)+($i)); 
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(11,3,$HASTA_MOV,0,0,'L');	
	}
/*	
	if( ($TM == "01") || ($TM == "02") || ($M == "1") || ($M == "2") || ($TM == "17") || ($TM == "30") ){
		$pdf->SetXY(93,121+($i)+($i)+($i)); 
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(72,3,utf8_decode($NOMBRE_SUS_MOV1),0,0,'L');

		$pdf->SetXY(165,121+($i)+($i)+($i)); 
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(24,3,$RFCSUS_MOV1,0,0,'L');

		$pdf->SetXY(189,121+($i)+($i)+($i)); 
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(7,3,$MOT_MOVSUS1,0,0,'L');

		$pdf->SetXY(196,121+($i)+($i)+($i)); 
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(10,3,$QNA_INISUS_MOV,0,0,'L');

		$pdf->SetXY(206,121+($i)+($i)+($i));  
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(10,3,$QNA_FINSUS_MOV,0,0,'L');

		$pdf->SetXY(220,121+($i)+($i)+($i)); 
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(18,3,$NUM_DOCUMENTOSUS1,0,0,'L');
	}
*/	
	$pdf->SetXY(237.5,121+($i)+($i)+($i));  
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(16.5,3,$CT_MOV,0,0,'L');

	$pdf->SetXY(254.5,121+($i)+($i)+($i));  
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(8,3,$NIVEL_SUELDO_NUEVO,0,0,'C');

	$pdf->SetXY(266,121+($i)+($i)+($i)); 
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(9,3,$PLA_BASIFICACION1,0,0,'L');

	$pdf->SetXY(275,121+($i)+($i)+($i));  
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(14.5,3,$PLA_PROMOCION1,0,0,'L');

	$pdf->SetXY(288,121+($i)+($i)+($i));  
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(13,3,$PLAQNA_ING_SUB1,0,0,'L');
					//119
	$pdf->SetXY(302,121+($i)+($i)+($i)); 
	$pdf->SetFont('Arial','',7);
	$pdf->Cell(41,3,utf8_decode($DESCRIPCION),0,0,'L');
?>			