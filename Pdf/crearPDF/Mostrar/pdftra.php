<?php
include_once __DIR__."/../normaliza_xml.php";

	barcode('../../Codigo_Barras/'.$code.'.png', $code, 45, 'horizontal', 'code128', true);
	$image = '../../Codigo_Barras/'.$code.'.png';
    $pdf->Image($image,150,2,50,20,'PNG');
    //unlink($image);

    $pdf->SetFont('Arial','',11);
    $pdf->SetXY(70,19);
    $pdf->Cell(900,4,$nom_area,0,0,'L');//C = CENTRAR

	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(15,19);
	$pdf->Cell(35,3,$CURP,0,0,'L');//C = CENTRAR

	$pdf->SetXY(265,16);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(80,3,$docto_num.'/'.$pdf->PageNo()/*.'/{nb}'*/,0,0,'L');

	$pdf->SetXY(297,16);
	$pdf->Cell(40,3,$FECHA,0,0,'C');

	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(5,25.5);
	$pdf->Cell(37.5,3.8," ".$RFC,0);
	
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(41,25.5);
	$pdf->Cell(40,3.8,mb_convert_encoding($NOMBRE_EMPLEADO, 'ISO-8859-1', 'UTF-8'),0);

	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(133,25.5);
	$pdf->Cell(10,3.8,$EDO_NAC,0);

	$pdf->SetXY(152,25.5);
	$pdf->Cell(10,3.8,$SEXO,0);

	$pdf->SetXY(170,25.5);
	$pdf->Cell(10,3.8,$EDO_CIVIL,0);

	$pdf->SetXY(192,25.5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(100,3.8,mb_convert_encoding($DOMICILIO, 'ISO-8859-1', 'UTF-8'),0);

	if($CALLE!="NULL"){
		$pdf->SetFont('Arial','',8);
		$pdf->SetXY(228,22.5);
		$pdf->Cell(73,3,mb_convert_encoding($CALLE, 'ISO-8859-1', 'UTF-8'),0);
		//$pdf->Cell(73,3,$CALLE,0);
	}


	$pdf->SetXY(320,22.5);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(30,3,$COD_POSTAL,0);

	$pdf->SetXY(225,25.8);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(121,3,mb_convert_encoding($LOCACION, 'ISO-8859-1', 'UTF-8'),0);

	$pdf->SetXY(233,29);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(30,3,mb_convert_encoding($MUNICIPIO, 'ISO-8859-1', 'UTF-8'),0);

	$pdf->SetXY(5,35);
	$pdf->SetFont('Arial','',8);
	$pdf->MultiCell(15,3,fup_txt($PUESTO),0,'C',false);

	$pdf->SetXY(20,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(15,3," ".fup_txt($QNA_INI_GOB),0,'C');

	$pdf->SetXY(35,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(15,3," ".fup_txt($QNA_ING_SEP),0,'C');

	$pdf->SetXY(50,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(14.5,3," ".$RAMA,0,'C');

	$pdf->SetXY(67,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(16,3,$NUM_TITULO,0,'C');

	$pdf->SetXY(84,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(16,3,$NUM_LICENCIATURA,0,'C');

	$pdf->SetXY(118,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(13.6,3,$LICENCIATURA,0,'C');

	$pdf->SetXY(131,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(10.5,3,$TITULO,0,'C');

	$pdf->SetXY(141,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(10.5,3,$MA,0,'C');

	$pdf->SetXY(152,35);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(10.5,3,$DO,0,'C');
	  

?>	    