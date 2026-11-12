<?php
  $pdf->SetXY(5,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(6.5,3,$cmppartida,0,0,'L');      

  $pdf->SetXY(13,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(6.5,3,$cmpcod_pago,0,0,'L'); 

  $pdf->SetXY(17,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(6.5,3,$cmpunidad,0,0,'L'); 

  $pdf->SetXY(21,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(6.5,3,$cmpsubunidad,0,0,'L'); 

  $pdf->SetXY(28,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(10,3,$cmpcat_puesto,0,0,'L'); 

  $pdf->SetXY(39,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(6.5,3,$cmphoras,0,0,'L'); 

  $pdf->SetXY(47,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(12,3,$cmpcons_plaza,0,0,'L'); 

  $pdf->SetXY(110,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(14,3,"$".$cmpimporteanterior,0,0,'L');

  $pdf->SetXY(144,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(17,3,"$".$nombre_format,0,0,'L'); 

  $pdf->SetXY(165,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(6.5,3,$cmpqna_ini,0,0,'L'); 

  $pdf->SetXY(175,87+$cmp+$cmp+$cmp);   
  $pdf->SetFont('Arial','',7);
  $pdf->Cell(6.5,3,$cmpqna_fin,0,0,'L');

	  $pdf->SetXY(74,87+$cmp+$cmp+$cmp);   
	  $pdf->SetFont('Arial','',7);
	  $pdf->Cell(6.5,3,$cmpconcepto,0,0,'L');

	  $pdf->SetXY(100,87+$cmp+$cmp+$cmp);   
	  $pdf->SetFont('Arial','',7);
	  $pdf->Cell(6.5,3,$cmpabc,0,0,'L'); 

	  $pdf->SetXY(126,87+$cmp+$cmp+$cmp);   
	  $pdf->SetFont('Arial','',7);
	  $pdf->Cell(14,3,"$".$nombre_format,0,0,'L');

	  $pdf->SetXY(190,87+$cmp+$cmp+$cmp);   
	  $pdf->SetFont('Arial','',7);
	  $pdf->Cell(50,3,$cmpjustificacion,0,0,'L'); 
?>