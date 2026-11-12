<?php
          $pdf->SetXY(130,77.5);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"M O D I F I C A C I O N E S  A:",0,0,'L');

          $pdf->SetXY(5,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,"PDA.",0,0,'L'); 

          $pdf->SetXY(13,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(4,3,"CP",0,0,'L'); 

          $pdf->SetXY(15,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"CLAVE DE PAGO AFECTADA",0,0,'L');

          $pdf->SetXY(18,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(4,3,"U",0,0,'L');

          $pdf->SetXY(21,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(4,3,"SU",0,0,'L');     

          $pdf->SetXY(28,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"CATEG.",0,0,'L');  

          $pdf->SetXY(39,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"HRS.",0,0,'L');    

          $pdf->SetXY(49,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"PLAZA",0,0,'L');                                              

          $pdf->SetXY(60,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"CLAVE PRESUPUESTARIA",0,0,'L');

          $pdf->SetXY(69,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(20,3,"Y CONCEPTO",0,0,'L'); 

          $pdf->SetXY(100,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"MOV.",0,0,'L'); 

          $pdf->SetXY(110,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"ACTUAL",0,0,'L'); 

          $pdf->SetXY(118,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"IMPORTES MENSUALES",0,0,'L');

          $pdf->SetXY(125,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"INC./DISM.",0,0,'L'); 

          $pdf->SetXY(145,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"AUTORIZADO",0,0,'L'); 

          $pdf->SetXY(168,81);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(40,3,"EFECTOS",0,0,'L');

          $pdf->SetXY(165,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"DESDE",0,0,'L'); 

          $pdf->SetXY(175,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"HASTA",0,0,'L'); 

          $pdf->SetXY(190,84);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,"JUSTIFICACION",0,0,'L');

          $pdf->SetXY(5,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmppartidaR1,0,0,'L');      

          $pdf->SetXY(13,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpcod_pagoR1,0,0,'L'); 

          $pdf->SetXY(17,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpunidadR1,0,0,'L'); 

          $pdf->SetXY(21,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpsubunidadR1,0,0,'L'); 

          $pdf->SetXY(28,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(10,3,$cmpcat_puestoR1,0,0,'L'); 

          $pdf->SetXY(39,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmphorasR1,0,0,'L'); 

          $pdf->SetXY(47,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(12,3,$cmpcons_plazaR1,0,0,'L'); 

          /*$pdf->SetXY(60,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpperc_ded.".",0,0,'L'); */

          $pdf->SetXY(74,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpconceptoR1,0,0,'L');

          $pdf->SetXY(100,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpabcR1,0,0,'L'); 

          $pdf->SetXY(110,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(14,3,"$".$cmpimporteanteriorR1,0,0,'L');            
                                                                                
          $pdf->SetXY(126,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(14,3,"$".$cmpAutorizado,0,0,'L');

          $pdf->SetXY(144,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(17,3,"$".$cmpimportenuevoR1,0,0,'L');          

          $pdf->SetXY(165,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpqna_iniR1,0,0,'L'); 

          $pdf->SetXY(175,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(6.5,3,$cmpqna_finR1,0,0,'L'); 
          
          $pdf->SetXY(190,87+$cmp+$cmp+$cmp);   
          $pdf->SetFont('Arial','',7);
          $pdf->Cell(50,3,$cmpjustificacionR11,0,0,'L');        
                                                                                
?>