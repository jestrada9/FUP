<?php 
		$pdf->SetXY(40,162);
		//$pdf->MultiCell(85,42, $pdf->Image('../../Logo/sello/SelloCGRH21.png', $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
	
		$pdf->SetXY(240,160);
		//$pdf->MultiCell(85,42, $pdf->Image('../../Logo/sello/SelloAdm21.png', $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");	

		$pdf->Line(5, 181.2, 122-5, 181.2); // PARTE DE ARRIBA
        $pdf->Line(160, 181.2, 352-5, 181.2); // PARTE DE ARRIBA 2
        $pdf->Line(90.1, 162.3, 90.1, 204.4);//linea vertical derecha
        $pdf->SetXY(35,181);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(42,4,"PROPONE SNTE",0,0,'L');

        $pdf->SetXY(5,186);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(32,4,"OFICIO No.",0,0,'L');

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
        
    	$TEXTO1="DECLARO BAJO PROTESTA DE DECIR VERDAD QUE _______ ME ENCUENTRO DESEMPEÑANDO OTRO EMPLEO O COMISIÓN DENTRO DE OTRA ENTIDAD DE LA ADMINISTRACIÓN PÚBLICA FEDERAL";

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

    	$pdf->Line(340, 198.5, 285-5, 198.5);
/*<--------------------------------------------PROPONE SNTE----------------------------------------------------------------->*/	
		$pdf->SetXY(60,186);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(29,4, $FECHA,0,0,'L');

		$pdf->SetXY(50,196);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(15,4, $IMPRIMIO,0,0,'L');

		$pdf->SetXY(76,196);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(14,4, $REVISO,0,0,'L');

//<-----------------------------------------------------AUTORIZACIONES------------------------------------------------------------------->
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
//<-------------------------------------------------FIN DE AUTORIZACIONES------------------------------------------------------------------->
//<--------------------------------------------------------AUTORIZA------------------------------------------------------------------------->
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
/*<----------------------------------------------------FIN DE AUTORIZA------------------------------------------------------->*/
	
/*<----------------------------------------------------AUTORIZACIONES-------------------------------------------------------->*/
		$pdf->SetXY(105,196);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(65,3, utf8_decode($FECHA),0,0,'L');
/*<--------------------------------------------------------AUTORIZA---------------------------------------------------------->*/
		$pdf->SetXY(190,196);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(65,3, utf8_decode($FECHA),0,0,'L');
/*<-------------------------------------------------------INTERESADO--------------------------------------------------------->*/
		$pdf->Line(190.1, 162.3, 190.1, 181.2);//linea vertical derecha
		$TEXTO="SE HACE CONSTAR QUE EL TRABAJADOR PROTESTA DESEMPEÑAR LEAL Y PATRIOTICAMENTE EL PUESTO QUE SE LE HA CONFERIDO Y GUARDAR Y HACER GUARDAR LA CONSTITUCION POLITICA DE LOS ESTADOS UNIDOS MEXICANOS Y LAS LEYES QUE DE ELLA EMANEN";
		$pdf->SetXY(190,162.3);
		 $pdf->SetFont('Arial','',7);
		$pdf->MultiCell(80,3.5,utf8_decode($TEXTO),0,'J',false);

	    $pdf->SetXY(280,186);
	    $pdf->SetFont('Arial','',8);  
		$pdf->Cell(65,3, utf8_decode($NOMBRE_EMPLEADO),0,0,'L');

		$pdf->SetXY(280,196);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(60,3, utf8_decode($FECHA),0,0,'L');

		$pdf->SetXY(206,206);  
	  	$pdf->SetFont('Arial','',15);
		$pdf->Cell(14,3,utf8_decode("FUP ORIGINAL TRAMITADO"),0,0,'L');
	  	$pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN

	    $pdf->SetXY(6,205);
	    $pdf->SetFont('Arial','B',8);
	    $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L'); 


?>	    