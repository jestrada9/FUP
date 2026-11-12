<?php
			if($t == 0){
				$pdf->SetXY(162,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(19.5,3,$CT_A,0,'C');

				$pdf->SetXY(181,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,3,$HORAS1,0,'C');
			}
			if($t == 1){
				$pdf->SetXY(191,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(19.5,3,$CT_A,0,'C');

				$pdf->SetXY(210,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,3,$HORAS1,0,'C');
			}
			if($t == 2){
				$pdf->SetXY(220,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(19.5,3,$CT_A,0,'C');

				$pdf->SetXY(239,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,3,$HORAS1,0,'C');
			}
			if($t == 3){
				$pdf->SetXY(249,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(19.5,3,$CT_A,0,'C');	

				$pdf->SetXY(268,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,3,$HORAS1,0,'C');
			}
			if($t == 4){
				$pdf->SetXY(278,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(19.5,3,$CT_A,0,'C');	

				$pdf->SetXY(297,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,3,$HORAS1,0,'C');
			}
			if($t == 5){
				$pdf->SetXY(307,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(19.5,3,$CT_A,0,'C');	

				$pdf->SetXY(326,35);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(10,3,$HORAS1,0,'C');
			}

			
		$pdf->SetXY(12.5,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->MultiCell(5,3,mb_convert_encoding($CODIGO_PAGO, 'ISO-8859-1', 'UTF-8'),0,'R',false);

		$pdf->SetXY(17.5,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->MultiCell(5,3,mb_convert_encoding($UNIDAD, 'ISO-8859-1', 'UTF-8'),0,'R',false);

		$pdf->SetXY(21.5,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->MultiCell(5,3,mb_convert_encoding($SUBUNIDAD, 'ISO-8859-1', 'UTF-8'),0,'R',false);

		$pdf->SetXY(27,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',6);
		$pdf->MultiCell(11,3,mb_convert_encoding($CATEGORIA, 'ISO-8859-1', 'UTF-8'),0,'C',false);

		$pdf->SetXY(37.5,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->MultiCell(7,3,mb_convert_encoding($HORAS, 'ISO-8859-1', 'UTF-8'),0,'C',false);

		$pdf->SetXY(45,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',6.5);
		$pdf->MultiCell(12,3,mb_convert_encoding($PLAZA, 'ISO-8859-1', 'UTF-8'),0,'C',false);

		$pdf->SetXY(57,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(8,3,$ALTA,0,0,'C');

		$pdf->SetXY(84.5,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(10,3,$DESDE,0,0,'C');

		$pdf->SetXY(94,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(10,3,$HASTA,0,0,'C');

		$pdf->SetXY(5,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(8,3,$PDA2,0,0,'R');

		$pdf->SetXY(65,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(6,3,$CONCEPTO,0,0,'C');

		$pdf->SetXY(71,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		//$pdf->Cell(15,3,"$".$IMPORTE,0,0,'C');

		$Valor1 = str_pad($Valor, 10, "0", STR_PAD_LEFT);
		$pdf->SetXY(105,44.5+($t)+($t)+($t));
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(15,3,$Valor1,0,0,'C');
?>		