<?php
	    $pdf->SetXY(300,206);  
  		$pdf->SetFont('Arial','',8);
		$pdf->Cell(14,3,mb_convert_encoding($ID, 'ISO-8859-1', 'UTF-8'),0,0,'L');
?>		