<?php
		$pdf->SetXY(40,162);
		//$pdf->MultiCell(85,42, $pdf->Image('../../Logo/sello/SelloCGRH21.png', $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
	
		$pdf->SetXY(240,160);
		//$pdf->MultiCell(85,42, $pdf->Image('../../Logo/sello/SelloAdm21.png', $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");	
					
			$DOC_OBSRV1 = strtoupper(htmlspecialchars_decode($checs1));
			$DOC_OBSRV2 = strtoupper(htmlspecialchars_decode($checs2));
			$DOC_OBSRV3 = strtoupper(htmlspecialchars_decode($checs3));
			$DOC_OBSRV4 = strtoupper(htmlspecialchars_decode($checs4));

			$DOC_ANEXA1 = strtoupper(htmlspecialchars_decode($checA1));
			$DOC_ANEXA2 = strtoupper(htmlspecialchars_decode($checA2));
			$DOC_ANEXA3 = strtoupper(htmlspecialchars_decode($checA3));
			$DOC_ANEXA4 = strtoupper(htmlspecialchars_decode($checA4));
			$DOC_ANEXA5 = strtoupper(htmlspecialchars_decode($checA5));

			$pdf->SetFont('Arial','',6);
			$pdf->SetXY(5,165); 
			$pdf->Cell(85,3,$DOC_ANEXA1,0,0,'L');

			$pdf->SetFont('Arial','',6);
			$pdf->SetXY(5,168); 
			$pdf->Cell(85,3,$DOC_ANEXA2,0,0,'L');

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

		    if($pdf->PageNo()>1){
		        $pdf->SetFont('Arial','',6);
		        $pdf->SetXY(90,174); 
		        $pdf->Cell(85,3,'COMPLEMENTARIO',0,0,'L');
		    }			
?>	