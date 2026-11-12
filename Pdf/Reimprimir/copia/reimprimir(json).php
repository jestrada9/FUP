<?php
//2117274861
		//ini_set("soap.wsdl_cache_enabled", "0");
		$copia="copia";
		$meses = array("1","2","3","4","5","6","7","8","9","10","11","12");
		include '../../Cascaron/Cascaron.php';			
		include_once '../../Codigo_Barras/barcode.php';
		require_once('../../lib/nusoap.php');
		require_once('../../Conexion/wsdl.php'); 	
		//require '../../PHPMailer/src/PHPMailer.php';
		//require '../../PHPMailer/src/SMTP.php';		
		//include '../../Errores/errores.php';			
		
		$buscar = $_GET['buscar'];
		$activo = $_GET["dia"];
		$dia = $_GET['dia'];
		$pdf=new PDF('L','mm','LEGAL');
		$pdf->SetAutoPageBreak(false);
		//$pdf->SetProtection('print');

		function importe($valuesx2,$total_resP,$filas,$pdf){
			//var_dump($valuesx2);
			//echo $total_resP;
		
			$numd = 0;
			$di = 0;
			$numeroFormateado = 0;
			$tot1=0;
			$tot=0;
		
			if($total_resP>10){
				$di=$filas*34;//140;
			}			

			
	        while ($di <= $total_resP*33){//inicio while $y2

	                $tot=      $valuesx2[$di+10]['prei07'];
	                $tot1 += $tot;

	                $di = $di + 34;
	        } 

	        $numeroFormateado = number_format($tot1, 2);
	        $pdf->SetFont('Arial','',7);
			$pdf->SetXY(100,75); 
			$pdf->Cell(45,3,"$".$numeroFormateado,0,0,'L');

		}
		function oficio_capturo($OFICIO,$CAPTURO,$pdf){
			include 'Mostrar/oficio_capturo.php';
		}

		function info_autorizaciones($NOMBRE_EMPLEADO,$FECHA,$pdf){//info_aurorizaciones
			include 'Mostrar/pdfautorizaciones.php';
		}//info_aurorizaciones	
/*
		function dia($dias,$docto_num,$cliente,$pdf,$num,$i){
			$onlyconsonants = str_replace("/", "-", $dias);
		    $date = date_create($onlyconsonants);
		    $DESDE_MOVf = date_format($date, 'Y-m-d ');
		    $DESDE_MOVs = date_format($date, 'd/m/Y ');	

			$id_consultaF1 = 	64;//año-mes-dia

			$metodo_consulta="ConsultaDia_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';				

			if($num==2){
			$pdf->SetXY(70,131+($i)+($i)+($i));//91  
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');
			}
			if($num==1){

			$pdf->SetXY(70,131+($i)+($i)+($i));  //121
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');
			}
			if($num==0){
			$pdf->SetXY(70,131+($i)+($i)+($i));//121
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');				
			}
	
			
		}
*/
		function firmas_funcion($FECHAD,$pdf,$cliente){

			$num_firma=0;
			$num_funcion_firma=2;
			$num_nombre_firma=0;
			$num_tipo_archivo=3;
			$num_firmas=1;

			$id_consulta_firmas = 9;

			$metodo_consulta="ConsultaFirmas_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';			
	        
		    //var_dump($arrayR_firmas);
		    $tot_regis_firmas = count($arrayR_firmas['return']);
		    //echo $tot_regis_firmas;

		    foreach($arrayR_firmas as $value){//foreach

		      	while($num_firma<$tot_regis_firmas){//while
					
			        $func 				   = $value[$num_funcion_firma]["funcion_firma"];
			        $NOMBRE_AUTORIZACIONES = $value[$num_nombre_firma]["nombre_firma"];
			        $TEMPIMGLOC 		   = $value[$num_tipo_archivo]["tipo_archivo_"];
			        $imagen1 			   = hex2bin($value[$num_firmas]["firmas"]);
					$alto=166;
			        $pic1 = "data: image/png;base64,".base64_encode($imagen1)."";
			        $dataPieces = explode(',',$pic1);
			        $encodedImg = $dataPieces[1];
			        $decodedImg = base64_decode($encodedImg);
			       
				    if($func == 0){  
 						if( $decodedImg!==false )
				      	{
				          if( file_put_contents("tempimg".$TEMPIMGLOC,$decodedImg)!==false )
				          {
				               $pdf->SetXY(90,$alto);
		                	   $pdf->MultiCell(85,42, $pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
		                	   unlink("tempimg".$TEMPIMGLOC);
				          }
				      	}				    	
				        $pdf->SetXY(105,186);
				        $pdf->SetFont('Arial','',8);
				        $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');
			    	}

			    	if($func == 1){ 
				      if( $decodedImg!==false )
				      {
				          if( file_put_contents("tempimg1".$TEMPIMGLOC,$decodedImg)!==false )
				          {
				              $pdf->SetXY(175,$alto);
				              $pdf->MultiCell(90,40, $pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
				              unlink("tempimg1".$TEMPIMGLOC);
				          }
				      }			    		
				        $pdf->SetXY(190,186);
				        $pdf->SetFont('Arial','',8);
				        $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');
				    }

					
					$num_funcion_firma=$num_funcion_firma+4;
					/*if($num_funcion_firma > 6){
						break;
					}*/
					$num_nombre_firma=$num_nombre_firma+4;
					$num_tipo_archivo=$num_tipo_archivo+4;
					$num_firmas=$num_firmas+4;

					//echo $num_firma;	
					$num_firma++;
					if($num_funcion_firma > 8){
						break;
					}
				}//while
	      	}//foreach

	    }//Fin Funcion Firmas

function acomodarRegistros($columnas,$filas,$registro,$pdf){
	
	    $pdf->SetXY($columnas,$filas);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(15,3,$registro,0,0,'C');	
}


function ant($valuespres,$tot_resul_pre,$pdf,$cliente,$filas,$retornar,$buscar){//funcionant
	$ID_PLA = "1";
	
	$numinsert=0;
	//var_dump($valuess[202]['_plaza']);
	$a=0;
	$t=1;
	$tot_reg = 1;
	$columnas = 5;
	$recorrido = 1;			
	$num_doctos = "";
	$mot_movs = ""; 
	$qna_inis = ""; 
	$qna_finis = ""; 
	$PLAZAss = ""; 
	$CONCEPTO = "";
	$IMPORTE = 0;
	$prepartida    	 = "";
	$precod_pago1    = "";
	$precod_pago    = "";
	$preunidad 	   	 = "";
	$presubunidad  	 = "";
	$precat_puesto   = "";
	$prehoras 	   	 = "";
	$precons_plaza1  = "";
	$precons_plaza  = "";
	$premot_mov      = "";
	$pre07 		   	 = "";
	$prei071 	   	 = "";
	$prei07 	   	 = "";
	$preqna_ini    	 = "";
	$preqna_fin    	 = "";
	$prenum_doctopla1 = "";
	$prenum_doctopla = "";
	$preDR   		 = "";
	$preiDR1 		 = "";	
	$preiDR 		 = "";	
	$preiDRqna_ini 	 = "";
	$preiDRqna_fin   = "";
	$preDRnum_docto  = "";
	$preBS 			 = "";
	$preiBS 		 = "";
	$preBSqna_ini 	 = "";
	$preBSqna_fin    = "";
	$preBSnum_docto  = "";
	$preI4 			 = "";
	$preiI4 		 = "";
	$preI4qna_ini 	 = "";
	$preI4qna_fin 	 = "";
	$preI4num_docto  = "";
	$preE3 		 	 = "";
	$preiE3 		 = "";
	$preE3qna_ini 	 = "";
	$preE3qna_fin 	 = "";
	$preE3num_docto  = "";
	$tot 			 = "";
	$importe_total = 0;
	$importe_tot = 0;
	$tot_reg2=0;
	$Pagina = "";
	$numero5 = "";
	$cto_izquierda = 120;
	$cto_izquierda2 = 120;
	$cto_izquierda3 = 120;
	$cto_izquierda4 = 120;
	$cto_izquierda5 = 120;
	$imte_izquierda = 130;
	$qini_izquierda = 141;
	$qfin_izquierda = 151;
	$ndoc_izquierda = 161;
				
	//var_dump($valuespres);
	$json = json_decode($valuespres, true); 
	//echo $tot_resul_pre;
	//var_dump($json[0]);
	 foreach($json as $valuess){ //regs. antecedentes
	
	 	if($t<=$tot_resul_pre || $t>$tot_resul_pre){//menor a 10
			//echo $t;
			if ( isset($valuess['prepartida']) ) {
				$prepartida    	 = $valuess['prepartida'];
				if($prepartida=="0"){
					$prepartida = "";
				}
			}	
			if ( isset($valuess['precod_pago']) ) {
				$precod_pago1    = $valuess['precod_pago'];
				$precod_pago 	 = str_pad($precod_pago1, 2, "0", STR_PAD_LEFT);
			}

			if ( isset($valuess['preunidad']) ) {
				$preunidad 	   	 = $valuess['preunidad'];
			}	
			if ( isset($valuess['presubunidad']) ) {
				$presubunidad  	 = $valuess['presubunidad'];
			}
			if ( isset($valuess['precat_puesto']) ) {
				$precat_puesto   = $valuess['precat_puesto'];
			}
			if ( isset($valuess['prehoras']) ) {
				$prehoras 	   	 = $valuess['prehoras'];
			}
			if ( isset($valuess['precons_plaza']) ) {
				$precons_plaza1  = $valuess['precons_plaza'];
				$precons_plaza   = str_pad($precons_plaza1, 6, "0", STR_PAD_LEFT);
			}	
			if ( isset($valuess['premot_mov']) ) {
				$premot_mov      = $valuess['premot_mov'];
			}	
			if ( isset($valuess['pre07']) ) {
				$pre07 		   	 = $valuess['pre07'];
			}
			if ( isset($valuess['prei07']) ) {
				$prei071 	   	 = $valuess['prei07'];
				if($prei071!="" || $prei071!="0.00"){$prei07 	   	 = number_format($prei071,2);}
			}
			if ( isset($valuess['preqna_ini']) ) {
				$preqna_ini    	 = $valuess['preqna_ini'];
			}
			if ( isset($valuess['preqna_fin']) ) {
				$preqna_fin    	 = $valuess['preqna_fin'];
			}	
			if ( isset($valuess['prenum_doctopla']) ) {
				$prenum_doctopla1 = $valuess['prenum_doctopla'];
				$prenum_doctopla = str_pad($prenum_doctopla1, 10, "0", STR_PAD_LEFT);
			}	
			if ( isset($valuess['preDR']) ) {
				$preDR   		 = $valuess['preDR'];
			}
			if ( isset($valuess['preiDR']) ) {
				$preiDR1 		 = $valuess['preiDR'];
				if($preiDR1!="" || $preiDR1!="0.00"){$preiDR 	   	 = number_format($preiDR1,2);}
				if($preiDR=="0.00"){$preiDR 	   	 = "";}
			}
			if ( isset($valuess['preiDRqna_ini']) ) {
				$preiDRqna_ini 	 = $valuess['preiDRqna_ini'];
				if($preiDRqna_ini=="0"){$preiDRqna_ini 	   	 = "";}
			}
			if ( isset($valuess['preiDRqna_fin']) ) {
				$preiDRqna_fin   = $valuess['preiDRqna_fin'];
				if($preiDRqna_fin=="0"){$preiDRqna_fin 	   	 = "";}
			}	
			if ( isset($valuess['preDRnum_docto']) ) {
				$preDRnum_docto  = $valuess['preDRnum_docto'];
				if($preDRnum_docto=="0"){$preDRnum_docto 	   	 = "";}
			}	
			if ( isset($valuess['preBS']) ) {
				$preBS 			 = $valuess['preBS'];
			}
			if ( isset($valuess['preiBS']) ) {
				$preiBS 		 = $valuess['preiBS'];
				if($preiBS=="0.00"){$preiBS 	   	 = "";}
			}
			if ( isset($valuess['preBSqna_ini']) ) {
				$preBSqna_ini 	 = $valuess['preBSqna_ini'];
				if($preBSqna_ini=="0"){$preBSqna_ini 	   	 = "";}
			}
			if ( isset($valuess['preBSqna_fin']) ) {
				$preBSqna_fin    = $valuess['preBSqna_fin'];
				if($preBSqna_fin=="0"){$preBSqna_fin 	   	 = "";}
			}
			if ( isset($valuess['preBSnum_docto']) ) {
				$preBSnum_docto  = $valuess['preBSnum_docto'];
				if($preBSnum_docto=="0"){$preBSnum_docto 	   	 = "";}
			}	
			if ( isset($valuess['preI4']) ) {
				$preI4 			 = $valuess['preI4'];
			}
			if ( isset($valuess['preiI4']) ) {
				$preiI4 		 = $valuess['preiI4'];
				if($preiI4=="0.00"){$preiI4 	   	 = "";}
			}
			if ( isset($valuess['preI4qna_ini']) ) {
				$preI4qna_ini 	 = $valuess['preI4qna_ini'];
				if($preI4qna_ini=="0"){$preI4qna_ini 	   	 = "";}
			}
			if ( isset($valuess['preI4qna_fin']) ) {
				$preI4qna_fin 	 = $valuess['preI4qna_fin'];
				if($preI4qna_fin=="0"){$preI4qna_fin 	   	 = "";}
			}	
			if ( isset($valuess['preI4num_docto']) ) {
				$preI4num_docto  = $valuess['preI4num_docto'];
				if($preI4num_docto=="0"){$preI4num_docto 	   	 = "";}
			}	
			if ( isset($valuess['preE3']) ) {
				$preE3 		 	 = $valuess['preE3'];
			}
			if ( isset($valuess['preiE3']) ) {
				$preiE3 		 = $valuess['preiE3'];
				if($preiE3=="0.00"){$preiE3 	   	 = "";}
			}
			if ( isset($valuess['preE3qna_ini']) ) {
				$preE3qna_ini 	 = $valuess['preE3qna_ini'];
				if($preE3qna_ini=="0"){$preE3qna_ini 	   	 = "";}
			}
			if ( isset($valuess['preE3qna_fin']) ) {
				$preE3qna_fin 	 = $valuess['preE3qna_fin'];
				if($preE3qna_fin=="0"){$preE3qna_fin 	   	 = "";}
			}
			if ( isset($valuess['preE3num_docto']) ) {
				$preE3num_docto  = $valuess['preE3num_docto'];
				if($preE3num_docto=="0"){$preE3num_docto 	   	 = "";}
			}
			if ( isset($valuess['tot']) ) {
				$tot 			 = $valuess['tot'];
			}

			include 'Mostrar/R_seccionAntecedentes.php';
 
			
		}//mayor a 10
		$t++;
}//registros

	
}//funcionant

/*------------------------------------------------TRABAJADOR------------------------------------------------*/			
function tra($valuestra,$tot_resul_tra,$pdf,$cliente){//funciontra
//var_dump($valuestra);
		$perarea 		  = "";
		$pernum_docto 	  = "";
		$perrfc 		  = "";
		$pernom_emp		  = "";
		$peredo_nac	  	  = "";
		$persexo 		  =	"";
		$peredo_civil 	  = "";
		$peremp_dom 	  = "";
		$peremp_dom_cp	  =	"";
		$peremp_dom_col	  = "";
		$peremp_dom_pob	  = "";
		$perniv_academico = "";
		$perqna_ing_gob   = "";
		$perqna_ing_sep	  = "";
		$pernum_tit 		= "";
		$pernum_lic  		= "";
		$perq 		 	  =	"";
		$pera 			  = "";
		$perl 			  = "";
		$pert 			  =	"";
		$perct1 		  =	"";
		$perhr1 		  =	"";
		$perct2 		  =	"";
		$perhr2 		  = "";
		$perct3 		  = "";
		$perhr3 		  = "";
		$perct4 		  = "";
		$perhr4 		  = "";
		$perct5  		  = "";
		$perhr5 	 	  = "";
		$perct6 		  = "";
		$perhr6 		  = "";
		$perrfc_nuevo 	  = "";
		$pernom_area 	  = "";
		$percurp 		  = "";
		$perdoc_anexa1	  = "";
		$perdoc_anexa2	  = "";
		$perdoc_anexa3 	  = "";
		$perdoc_anexa4 	  = "";
		$perdoc_anexa5 	  = "";
		$perobsrv1	      = "";
		$perobsrv2 		  = "";
		$perobsrv3 		  = "";
		$perobsrv4 		  = "";
		$pernum_oficio 	  = "";
		$peroperador 	  = "";
		$percpr 		  = "";
		$percaptura  	  = "";
		$percve_mov 	  = "";

	$y = 0;
	        while ($y <= $tot_resul_tra*48){//while
	        	
	        	if ( isset($valuestra[$y+1]["perarea"]) ) {
	        		$perarea 		  = $valuestra[$y+1]["perarea"];
	        	}
	        	if ( isset($valuestra[$y+2]["pernum_docto"]) ) {
	        		$pernum_docto 	  = $valuestra[$y+2]["pernum_docto"];
	        	}
	        	if ( isset($valuestra[$y+3]["perrfc"]) ) {
	        		$perrfc 		  = $valuestra[$y+3]['perrfc'];
	        	}
	        	if ( isset($valuestra[$y+4]["pernom_emp"]) ) {
	        		$pernom_emp		  = $valuestra[$y+4]['pernom_emp'];
	        	}
				if ( isset($valuestra[$y+5]["peredo_nac"]) ) {
					$peredo_nac	  	  = $valuestra[$y+5]['peredo_nac'];
				}
				if ( isset($valuestra[$y+6]["persexo"]) ) {
					$persexo 		  =	$valuestra[$y+6]['persexo'];
				}
				if ( isset($valuestra[$y+7]["peredo_civil"]) ) {
					$peredo_civil 	  = $valuestra[$y+7]['peredo_civil'];
				}
				if ( isset($valuestra[$y+8]["peremp_dom"]) ) {
					$peremp_dom 	  = $valuestra[$y+8]['peremp_dom'];
				}
				if ( isset($valuestra[$y+9]["peremp_dom_cp"]) ) {
					$peremp_dom_cp	  =	$valuestra[$y+9]['peremp_dom_cp'];
				}
				if ( isset($valuestra[$y+10]["peremp_dom_col"]) ) {
					$peremp_dom_col	  = $valuestra[$y+10]['peremp_dom_col'];
				}
				if ( isset($valuestra[$y+11]["peremp_dom_pob"]) ) {
					$peremp_dom_pob	  = $valuestra[$y+11]['peremp_dom_pob'];
				}
				if ( isset($valuestra[$y+12]["perniv_academico"]) ) {
					$perniv_academico = $valuestra[$y+12]['perniv_academico'];
				}
				if ( isset($valuestra[$y+13]["perqna_ing_gob"]) ) {
					$perqna_ing_gob   = $valuestra[$y+13]['perqna_ing_gob'];
				}
				if ( isset($valuestra[$y+14]["perqna_ing_sep"]) ) {
					$perqna_ing_sep	  = $valuestra[$y+14]['perqna_ing_sep'];
				}
				if ( isset($valuestra[$y+15]["pernum_tit"]) ) {
					$pernum_tit2		  = $valuestra[$y+15]['pernum_tit'];
					$pernum_tit = 		str_pad($pernum_tit2, 9, "0", STR_PAD_LEFT);
				}
				if ( isset($valuestra[$y+16]["pernum_lic"]) ) {
					$pernum_lic2		  = $valuestra[$y+16]['pernum_lic'];
					$pernum_lic = 		str_pad($pernum_lic2, 9, "0", STR_PAD_LEFT);
				}
				if ( isset($valuestra[$y+17]["perq"]) ) {
					$perq 		 	  =	$valuestra[$y+17]['perq'];
				}
				if ( isset($valuestra[$y+18]["pera"]) ) {
				$pera 			  = $valuestra[$y+18]['pera'];
				}
				if ( isset($valuestra[$y+19]["perl"]) ) {
					$perl 			  = $valuestra[$y+19]['perl'];
				}
				if ( isset($valuestra[$y+20]["pert"]) ) {
					$pert 			  =	$valuestra[$y+20]['pert'];
				}
				if ( isset($valuestra[$y+21]["perct1"]) ) {
					$perct1 		  =	$valuestra[$y+21]['perct1'];
				}
				if ( isset($valuestra[$y+22]["perhr1"]) ) {
					$perhr1 		  =	$valuestra[$y+22]['perhr1'];
				}
				if ( isset($valuestra[$y+23]["perct2"]) ) {
					$perct2 		  =	$valuestra[$y+23]['perct2'];
				}
				if ( isset($valuestra[$y+24]["perhr2"]) ) {
					$perhr2 		  = $valuestra[$y+24]['perhr2'];
				}
				if ( isset($valuestra[$y+25]["perct3"]) ) {
					$perct3 		  = $valuestra[$y+25]['perct3'];
				}
				if ( isset($valuestra[$y+26]["perhr3"]) ) {
					$perhr3 		  = $valuestra[$y+26]['perhr3'];
				}
				if ( isset($valuestra[$y+27]["perct4"]) ) {
					$perct4 		  = $valuestra[$y+27]['perct4'];
				}
				if ( isset($valuestra[$y+28]["perhr4"]) ) {
					$perhr4 		  = $valuestra[$y+28]['perhr4'];
				}
				if ( isset($valuestra[$y+29]["perct5"]) ) {
					$perct5  		  = $valuestra[$y+29]['perct5'];
				}
				if ( isset($valuestra[$y+30]["perhr5"]) ) {
					$perhr5 	 	  = $valuestra[$y+30]['perhr5'];
				}
				if ( isset($valuestra[$y+31]["perct6"]) ) {
					$perct6 		  = $valuestra[$y+31]['perct6'];
				}
				if ( isset($valuestra[$y+32]["perhr6"]) ) {
					$perhr6 		  = $valuestra[$y+32]['perhr6'];
				}
				if ( isset($valuestra[$y+33]["perrfc_nuevo"]) ) {
					$perrfc_nuevo 	  = $valuestra[$y+33]['perrfc_nuevo'];
				}
				if ( isset($valuestra[$y+34]["pernom_area"]) ) {
					$pernom_area 	  = $valuestra[$y+34]['pernom_area'];
				}
				if ( isset($valuestra[$y+35]["percurp"]) ) {
					$percurp 		  = $valuestra[$y+35]['percurp'];
				}
				if ( isset($valuestra[$y+36]["perdoc_anexa1"]) ) {
					$perdoc_anexa1	  = trim($valuestra[$y+36]['perdoc_anexa1']);
					if($perdoc_anexa1 == "NULL"){$perdoc_anexa1 = "";}
				}
				if ( isset($valuestra[$y+37]["perdoc_anexa2"]) ) {
					$perdoc_anexa2	  = trim($valuestra[$y+37]['perdoc_anexa2']);
					if($perdoc_anexa2 == "NULL"){$perdoc_anexa2 = "";}
				}
				if ( isset($valuestra[$y+38]["perdoc_anexa3"]) ) {
					$perdoc_anexa3 	  = trim($valuestra[$y+38]['perdoc_anexa3']);
					if($perdoc_anexa3 == "NULL"){$perdoc_anexa3 = "";}
				}
				if ( isset($valuestra[$y+39]["perdoc_anexa4"]) ) {
					$perdoc_anexa4 	  = trim($valuestra[$y+39]['perdoc_anexa4']);
					if($perdoc_anexa4 == "NULL"){$perdoc_anexa4 = "";}
				}
				if ( isset($valuestra[$y+40]["perdoc_anexa5"]) ) {
					$perdoc_anexa5 	  = trim($valuestra[$y+40]['perdoc_anexa5']);
					if($perdoc_anexa5 == "NULL"){$perdoc_anexa5 = "";}
				}
				if ( isset($valuestra[$y+41]["perobsrv1"]) ) {
					$perobsrv1	      = trim($valuestra[$y+41]['perobsrv1']);
					if($perobsrv1 == "NULL"){$perobsrv1 = "";}
				}
				if ( isset($valuestra[$y+42]["perobsrv2"]) ) {
					$perobsrv2 		  = trim($valuestra[$y+42]['perobsrv2']);
					if($perobsrv2 == "NULL"){$perobsrv2 = "";}
				}
				if ( isset($valuestra[$y+43]["perobsrv3"]) ) {
					$perobsrv3 		  = trim($valuestra[$y+43]['perobsrv3']);
					if($perobsrv3 == "NULL"){$perobsrv3 = "";}
				}
				if ( isset($valuestra[$y+44]["perobsrv4"]) ) {
					$perobsrv4 		  = trim($valuestra[$y+44]['perobsrv4']);
					if($perobsrv4 == "NULL"){$perobsrv4 = "";}
				}
				if ( isset($valuestra[$y+45]["pernum_oficio"]) ) {
					$pernum_oficio 	  = $valuestra[$y+45]['pernum_oficio'];
				}
				if ( isset($valuestra[$y+46]["peroperador"]) ) {
					$peroperador 	  = $valuestra[$y+46]['peroperador'];
				}
				if ( isset($valuestra[$y+47]["percpr"]) ) {
					$percpr 		  = $valuestra[$y+47]['percpr'];
				}
				if ( isset($valuestra[$y+48]["percaptura"]) ) {
					$percaptura1 	  = $valuestra[$y+48]['percaptura'];
					$percaptura  = 		date('d-m-Y', strtotime($percaptura1));
				}
				if ( isset($valuestra[$y+49]["percve_mov"]) ) {	   
					$percve_mov 	  = $valuestra[$y+49]['percve_mov'];
				}     		

				firmas_funcion($percaptura1,$pdf,$cliente);
				info_autorizaciones($pernom_emp,$percaptura,$pdf);								
				oficio_capturo($pernum_oficio,$peroperador,$pdf);
				
				include 'Mostrar/R_seccionPersonales.php';

				

				$y = $y + 49;
			}//while
}//funciontra
/*------------------------------------------------TRABAJADOR------------------------------------------------*/	

function cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar){//funcioncmp
//var_dump($valuescmp);
	$pdfC = 0;
	$cmp=0; 
    $i=0;
    $cmppartidaR1    	  = "";
	$cmpcod_pagoR1   	  = "";
	$cmpunidadR1     	  = "";
	$cmpsubunidadR1  	  = "";
	$cmpcat_puestoR1	  = "";
	$cmphorasR1      	  = "";
	$cmpcons_plazaR1 	  = "";
	$cmpimporteanteriorR1 = "";
	$cmpqna_iniR1 		  = "";
	$cmpqna_finR1 		  = "";
	$cmpanio_procR1 	  = "";
	$cmpfijoR1 			  = "";
	$cmpprogramaR1 		  = "";
	$cmpsubprogramaR1 	  = "";
	$cmpproyectoR1 		  = "";
	$cmpunidad_respR1 	  = "";
	$cmpconceptoR1 		  = "";
	$cmpabcR1 			  = "";
	$cmpimportenuevoR11   = "";
	$cmpjustificacionR11  = "";

    //include 'encabezadoscmp.php';
    	if($tot_resul_cmp>5){
			$pdfC=$filas*20;//140;
			//202
			//$tot_resul_pre = $resultados;
		}
		while($pdfC<=$tot_resul_cmp*19){//whilecmp
			
			if ( isset($valuescmp[$pdfC+1]["cmppartidaR1"]) ) {
				$cmppartida      	  = $valuescmp[$pdfC+1]["cmppartidaR1"];
				$cmppartidaR1    	  = str_pad($cmppartida, 4, "0", STR_PAD_LEFT);
			}
			if ( isset($valuescmp[$pdfC+2]["cmpcod_pagoR1"]) ) {
				$cmpcod_pago 	   	  = $valuescmp[$pdfC+2]["cmpcod_pagoR1"];
	        	$cmpcod_pagoR1   	  = str_pad($cmpcod_pago, 2, "0", STR_PAD_LEFT);
	    	}
			if ( isset($valuescmp[$pdfC+3]["cmpunidadR1"]) ) {
				$cmpunidad       	  = $valuescmp[$pdfC+3]["cmpunidadR1"];
	        	$cmpunidadR1     	  = str_pad($cmpunidad, 2, "0", STR_PAD_LEFT);
	        }
			if ( isset($valuescmp[$pdfC+4]["cmpsubunidadR1"]) ) {
				$cmpsubunidad    	  = $valuescmp[$pdfC+4]["cmpsubunidadR1"];
	        	$cmpsubunidadR1  	  = str_pad($cmpsubunidad, 2, "0", STR_PAD_LEFT);
	        }
			if ( isset($valuescmp[$pdfC+5]["cmpcat_puestoR1"]) ) {
				$cmpcat_puestoR1	  = $valuescmp[$pdfC+5]["cmpcat_puestoR1"];
			}
			if ( isset($valuescmp[$pdfC+6]["cmphorasR1"]) ) {
				$cmphoras        	  = $valuescmp[$pdfC+6]["cmphorasR1"];
				$cmphorasR1      	  = str_pad($cmphoras, 2, "0", STR_PAD_LEFT);
			}
			if ( isset($valuescmp[$pdfC+7]["cmpcons_plazaR1"]) ) {
				$cmpcons_plazaR1 	  = $valuescmp[$pdfC+7]["cmpcons_plazaR1"];
	        	if($cmpcons_plazaR1 == "0"){ $cmpcons_plazaR1 = ""; }
	        }
			if ( isset($valuescmp[$pdfC+8]["cmpimporteanteriorR1"]) ) {
				$cmpimporteanteriorR11 = $valuescmp[$pdfC+8]["cmpimporteanteriorR1"];
				$cmpimporteanteriorR1  = number_format($cmpimporteanteriorR11,2);	 
			}
			if ( isset($valuescmp[$pdfC+9]["cmpqna_iniR1"]) ) {
				$cmpqna_iniR1 		  = $valuescmp[$pdfC+9]["cmpqna_iniR1"];
			}
			if ( isset($valuescmp[$pdfC+10]["cmpqna_finR1"]) ) {
				$cmpqna_finR1 		  = $valuescmp[$pdfC+10]["cmpqna_finR1"];
			}
			if ( isset($valuescmp[$pdfC+11]["cmpanio_procR1"]) ) {
				$cmpanio_procR1 	  = $valuescmp[$pdfC+11]["cmpanio_procR1"];
			}
			if ( isset($valuescmp[$pdfC+12]["cmpfijoR1"]) ) {
				$cmpfijoR1 			  = $valuescmp[$pdfC+12]["cmpfijoR1"];
			}
			if ( isset($valuescmp[$pdfC+13]["cmpprogramaR1"]) ) {
				$cmpprogramaR1 		  = $valuescmp[$pdfC+13]["cmpprogramaR1"];
			}
			if ( isset($valuescmp[$pdfC+14]["cmpsubprogramaR1"]) ) {
				$cmpsubprogramaR1 	  = $valuescmp[$pdfC+14]["cmpsubprogramaR1"];
			}
			if ( isset($valuescmp[$pdfC+15]["cmpproyectoR1"]) ) {
				$cmpproyectoR1 		  = $valuescmp[$pdfC+15]["cmpproyectoR1"];
			}
			if ( isset($valuescmp[$pdfC+16]["cmpunidad_respR1"]) ) {
				$cmpunidad_respR1 	  = $valuescmp[$pdfC+16]["cmpunidad_respR1"];
			}
			if ( isset($valuescmp[$pdfC+17]["cmpconceptoR1"]) ) {
				$cmpconceptoR1 		  = $valuescmp[$pdfC+17]["cmpconceptoR1"];
			}
			if ( isset($valuescmp[$pdfC+18]["cmpabcR1"]) ) {
				$cmpabcR1 			  = $valuescmp[$pdfC+18]["cmpabcR1"];
	        	if($cmpabcR1 == "A"){	$cmpabcR1 = "ALTA"; }
	        	if($cmpabcR1 == "B"){	$cmpabcR1 = "BAJA"; }
	        }
			if ( isset($valuescmp[$pdfC+19]["cmpimportenuevoR1"]) ) {
				$cmpimportenuevoR11 	  = $valuescmp[$pdfC+19]["cmpimportenuevoR1"]; 
				$cmpimportenuevoR1   = number_format($cmpimportenuevoR11, 2 );
			}
			if ( isset($valuescmp[$pdfC+20]["cmpjustificacionR1"]) ) {
				$cmpjustificacionR1   = $valuescmp[$pdfC+20]["cmpjustificacionR1"];
	     	    //$cmpjustificacionR11  = htmlspecialchars_decode($cmpjustificacionR1);
	     	    $cmpjustificacionR11  = utf8_decode($cmpjustificacionR1);

	    	}
	    	
	        $cmpAutorizado1 = $cmpimportenuevoR11 - $cmpimporteanteriorR11;
	        $cmpAutorizado 			= number_format($cmpAutorizado1,2);	 
	        if($cmpimportenuevoR1 == 0.00 && $cmpimporteanteriorR1 == 0.00){
	            $cmpAutorizado = "0.00";
	        }

			//include 'Mostrar/R_seccionCmp.php';

			$pdfC = $pdfC + 20;
		  	$cmp++;
		}//whilecmp
				
}//funcioncmp

function mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas,$docto_num,$activo){//funcionm,$diasov
	//var_dump($valuesPla);
	//var_dump($valuesPla[339]);//405;
	
	$ID_PLA = "1";
	$placve_mov		= "";
	$plamot_mov		= "";
	$plapartida		= "";
	$placod_pago		= "";
	$plaunidad 		= "";
	$plasubunidad		= "";
	$placat_puesto		= "";
	$plahoras		= "";
	$placons_plaza		= "";
	$plaqna_ini		= "";
	$plaqna_fin		= "";
	$planom_emp		= "";
	$plarfc		= "";
	$plamot_movsub		= "";
	$plaqna_inisub		= "";
	$plaqna_finsub		= "";
	$planum_doctosub		= "";
	$plactnvo		= "";
	$planivel_sueldonvo		= "";
	$plabasificacion		= "";
	$plapromocion		= "";
	$plaqna_ing_sub		= "";
	$pladescripcion1		= "";
	$pladescripcion2		= "";
	$fecha_defu		= "";
	$DESCRIPCION 		= "";
	
	$b=0;
	$i=0;
	$e = $tot_resul_pla + 1;

	$json = json_decode($valuesPla, true); 
	 foreach($json as $valuess){ //regs. plazas
	 	//var_dump($valuess);
		if ( isset($valuess["placve_mov"]) ) {
  			$M			  		= $valuess['placve_mov'];
  			$placve_mov 		= str_pad($M, 2, "0", STR_PAD_LEFT);
  		}
  		if ( isset($valuess["plamot_mov"]) ) {
  			$MO1 				= $valuess['plamot_mov'];//10";
			$plamot_mov 		= str_pad($MO1, 2, "0", STR_PAD_LEFT);
		}
  		if ( isset($valuess["plapartida"]) ) {
  			$plapartida			= $valuess['plapartida'];
  		}
  		if ( isset($valuess["placod_pago"]) ) {
  			$CODIGO_PAGO_MOV1	= $valuess['placod_pago'];
			$placod_pago 		= str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
		}
  		if ( isset($valuess["plaunidad"]) ) {
  			$plaunidad 			= $valuess['plaunidad'];
  		}
  		if ( isset($valuess["plasubunidad"]) ) {
  			$plasubunidad 	    = $valuess['plasubunidad'];
  		}
  		if ( isset($valuess["placat_puesto"]) ) {
  			$placat_puesto		= $valuess['placat_puesto'];
  		}
  		if ( isset($valuess["plahoras"]) ) {
  			$plahoras 			= $valuess['plahoras'];
  		}
  		if ( isset($valuess["placons_plaza"]) ) {
  			$numero 			= $valuess['placons_plaza'];
			$placons_plaza 		= str_pad($numero, 6, "0", STR_PAD_LEFT);
		}
  		if ( isset($valuess["plaqna_ini"]) ) {
  			$plaqna_ini 		= $valuess['plaqna_ini'];
  		}
  		if ( isset($valuess["plaqna_fin"]) ) {
  			$plaqna_fin 		= $valuess['plaqna_fin'];
  		}
  		if ( isset($valuess["planom_emp"]) ) {
  			$planom_emp  		= $valuess['planom_emp'];
			if($planom_emp == "NULL"){$planom_emp = "";}
		}
  		if ( isset($valuess["plarfc"]) ) {
  			$plarfc 			= $valuess['plarfc'];
			if($plarfc == "NULL"){$plarfc = "";}
		}
  		if ( isset($valuess["plamot_movsub"]) ) {
  			$plamot_movsub 		= $valuess['plamot_movsub'];
  			if($plamot_movsub == "NULL"){$plamot_movsub = "";}
		}
  		if ( isset($valuess["plaqna_inisub"]) ) {
			$plaqna_inisub 		= $valuess['plaqna_inisub'];
			if($plaqna_inisub == "NULL"){$plaqna_inisub = "";}
		}
  		if ( isset($valuess["plaqna_finsub"]) ) {
  			$plaqna_finsub		= $valuess['plaqna_finsub'];
			if($plaqna_finsub == "NULL"){$plaqna_finsub = "";}
		}
  		if ( isset($valuess["planum_doctosub"]) ) {
  			$planum_doctosub	= $valuess['planum_doctosub'];
			if($planum_doctosub == "NULL"){$planum_doctosub = "";}
		}
  		if ( isset($valuess["plactnvo"]) ) {
  			$plactnvo			= $valuess['plactnvo'];
		}
  		if ( isset($valuess["planivel_sueldonvo"]) ) {
			$planivel_sueldonvo	= $valuess['planivel_sueldonvo'];
			if($planivel_sueldonvo == "0"){$planivel_sueldonvo = "";}
		}
  		if ( isset($valuess["plabasificacion"]) ) {
			$plabasificacion	= $valuess['plabasificacion'];
			if($plabasificacion=="0"){$plabasificacion="";}
		}
  		if ( isset($valuess["plapromocion"]) ) {
  			$plapromocion	 	= $valuess['plapromocion'];
			if($plapromocion=="0"){$plapromocion="";}	

		}
  		if ( isset($valuess["plaqna_ing_sub"]) ) {	
  			$plaqna_ing_sub		= $valuess['plaqna_ing_sub'];
			if($plaqna_ing_sub=="NULL" || $plaqna_ing_sub=="0"){$plaqna_ing_sub="";}	
		}
  		if ( isset($valuess["descripcion1"]) && isset($valuess["descripcion2"])) {
  			$pladescripcion1 	= $valuess['descripcion1'];  //pladescripcion1 
  			$pladescripcion2	= $valuess['descripcion2'];  //pladescripcion2                            
  			$DESCRIPCION 		= htmlspecialchars_decode($pladescripcion2." ".$pladescripcion1);	
		}
  		if ( isset($valuess["fecha_defu"]) ) {
  			$fec			= $valuess['fecha_defu'];
			$fecha_defu 		= date('d/m/Y', strtotime($fec));
		}
		
		include 'Mostrar/R_seccionPlazas.php';
		$i++;
	}
/*	
	if($tot_resul_pla>10){
		
		$b=$filas*26;//330;//($tot_resul_pla*33)
		//$tot_resul_pla = $e;
	}
	
  	while ($b <= $tot_resul_pla*25){//$total_res*30 //2do while getDatosPDF_Mov
  		if ( isset($valuesPla[$b+1]["placve_mov"]) ) {
  			$M			  		= $valuesPla[$b+1]['placve_mov'];
  			$placve_mov 		= str_pad($M, 2, "0", STR_PAD_LEFT);
  		}
  		if ( isset($valuesPla[$b+2]["plamot_mov"]) ) {
  			$MO1 				= $valuesPla[$b+2]['plamot_mov'];//10";
			$plamot_mov 		= str_pad($MO1, 2, "0", STR_PAD_LEFT);
		}
  		if ( isset($valuesPla[$b+4]["plapartida"]) ) {
  			$plapartida			= $valuesPla[$b+4]['plapartida'];
  		}
  		if ( isset($valuesPla[$b+5]["placod_pago"]) ) {
  			$CODIGO_PAGO_MOV1	= $valuesPla[$b+5]['placod_pago'];
			$placod_pago 		= str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
		}
  		if ( isset($valuesPla[$b+6]["plaunidad"]) ) {
  			$plaunidad 			= $valuesPla[$b+6]['plaunidad'];
  		}
  		if ( isset($valuesPla[$b+7]["plasubunidad"]) ) {
  			$plasubunidad 	    = $valuesPla[$b+7]['plasubunidad'];
  		}
  		if ( isset($valuesPla[$b+8]["placat_puesto"]) ) {
  			$placat_puesto		= $valuesPla[$b+8]['placat_puesto'];
  		}
  		if ( isset($valuesPla[$b+9]["plahoras"]) ) {
  			$plahoras 			= $valuesPla[$b+9]['plahoras'];
  		}
  		if ( isset($valuesPla[$b+10]["placons_plaza"]) ) {
  			$numero 			= $valuesPla[$b+10]['placons_plaza'];
			$placons_plaza 		= str_pad($numero, 6, "0", STR_PAD_LEFT);
		}
  		if ( isset($valuesPla[$b+11]["plaqna_ini"]) ) {
  			$plaqna_ini 		= $valuesPla[$b+11]['plaqna_ini'];
  		}
  		if ( isset($valuesPla[$b+12]["plaqna_fin"]) ) {
  			$plaqna_fin 		= $valuesPla[$b+12]['plaqna_fin'];
  		}
  		if ( isset($valuesPla[$b+13]["planom_emp"]) ) {
  			$planom_emp  		= $valuesPla[$b+13]['planom_emp'];
			if($planom_emp == "NULL"){$planom_emp = "";}
		}
  		if ( isset($valuesPla[$b+14]["plarfc"]) ) {
  			$plarfc 			= $valuesPla[$b+14]['plarfc'];
			if($plarfc == "NULL"){$plarfc = "";}
		}
  		if ( isset($valuesPla[$b+15]["plamot_movsub"]) ) {
  			$plamot_movsub 		= $valuesPla[$b+15]['plamot_movsub'];
  			if($plamot_movsub == "NULL"){$plamot_movsub = "";}
		}
  		if ( isset($valuesPla[$b+16]["plaqna_inisub"]) ) {
			$plaqna_inisub 		= $valuesPla[$b+16]['plaqna_inisub'];
			if($plaqna_inisub == "NULL"){$plaqna_inisub = "";}
		}
  		if ( isset($valuesPla[$b+17]["plaqna_finsub"]) ) {
  			$plaqna_finsub		= $valuesPla[$b+17]['plaqna_finsub'];
			if($plaqna_finsub == "NULL"){$plaqna_finsub = "";}
		}
  		if ( isset($valuesPla[$b+18]["planum_doctosub"]) ) {
  			$planum_doctosub	= $valuesPla[$b+18]['planum_doctosub'];
			if($planum_doctosub == "NULL"){$planum_doctosub = "";}
		}
  		if ( isset($valuesPla[$b+19]["plactnvo"]) ) {
  			$plactnvo			= $valuesPla[$b+19]['plactnvo'];
		}
  		if ( isset($valuesPla[$b+20]["planivel_sueldonvo"]) ) {
			$planivel_sueldonvo	= $valuesPla[$b+20]['planivel_sueldonvo'];
			if($planivel_sueldonvo == "0"){$planivel_sueldonvo = "";}
		}
  		if ( isset($valuesPla[$b+21]["plabasificacion"]) ) {
			$plabasificacion	= $valuesPla[$b+21]['plabasificacion'];
			if($plabasificacion=="0"){$plabasificacion="";}
		}
  		if ( isset($valuesPla[$b+22]["plapromocion"]) ) {
  			$plapromocion	 	= $valuesPla[$b+22]['plapromocion'];
			if($plapromocion=="0"){$plapromocion="";}	

		}
  		if ( isset($valuesPla[$b+23]["plaqna_ing_sub"]) ) {	
  			$plaqna_ing_sub		= $valuesPla[$b+23]['plaqna_ing_sub'];
			if($plaqna_ing_sub=="NULL" || $plaqna_ing_sub=="0"){$plaqna_ing_sub="";}	
		}
  		if ( isset($valuesPla[$b+24]["pladescripcion1"]) ) {
  			$pladescripcion1 	= $valuesPla[$b+24]['pladescripcion1'];                                 
		}
  		if ( isset($valuesPla[$b+25]["pladescripcion2"]) ) {
  			$pladescripcion2	= $valuesPla[$b+25]['pladescripcion2'];
		}
  		if ( isset($valuesPla[$b+26]["fecha_defu"]) ) {
  			$fec			= $valuesPla[$b+26]['fecha_defu'];
			$fecha_defu 		= date('d/m/Y', strtotime($fec));
		}
  		$DESCRIPCION 		= htmlspecialchars_decode($pladescripcion2." ".$pladescripcion1);	

		include 'Mostrar/R_seccionPlazas.php';


		$i++;
	$b = $b + 26;
    }//fin 2do while getDatosPDF_Mov
*/    
    
}//funcionmov

/*---------------------------------------------------------CONSULTAS---------------------------------------------------------*/
/*<---------------------------------------------------ANTECEDENTES----------------------------------------->*/
	$tot_resul_pre = 0;
    $id_consultaFupPre =  95;//11//53
    $JSONFupPre="[{\"num_docto\":\"$buscar\"}]";
    $arrayFupPre = json_decode(json_encode($JSONFupPre), True);
    $paramsFupPre = array('Resultado'=>$id_consultaFupPre, 'Argumento'=>$arrayFupPre, 'Accion'=>"select"); //para conseguir la consulta
    //var_dump($paramsP);
    /*$resultadosFupPre=$cliente->getConsulta($paramsFupPre);   
    $arrayRFupPre= json_decode(json_encode($resultadosFupPre), True);*/

    $resultadosFupPre=$cliente->obtdatosfjsnxId($paramsFupPre);
    foreach($resultadosFupPre as $valuespre){ 
        $arrayRFupPre = json_decode($valuespre, true); 
        $tot_resul_pre = count($arrayRFupPre);
    }
    //var_dump($arrayRFupPre);
/*
    if(!empty($arrayRFupPre)){
        foreach($arrayRFupPre as $valuespre){//foreachpre
        	$tot_resul_pre=$valuespre[0]["tot_resu"];
    	}//finforeachpre 	
    }
*/
/*<---------------------------------------------------ANTECEDENTES----------------------------------------->*/	
/*<---------------------------------------------------IMPORTES----------------------------------------->*/
	$total_resP = 0;
	$id_consultaAcumulado =   95;//FUPPre obtener importes;
    $JSONAcumulado="[{\"num_docto\":\"$buscar\"}]";
	$arrayRAcumulado = json_decode(json_encode($JSONAcumulado), True);
    $paramsAcumulado = array('Resultado'=>$id_consultaAcumulado, 'Argumento'=>$arrayRAcumulado, 'Accion'=>"select"); //para conseguir la consulta
    $resultadoAcumulado=$cliente->getConsulta($paramsAcumulado); 
    $arrayAcumulado= json_decode(json_encode($resultadoAcumulado), True);
    //var_dump($arrayAcumulado);
    foreach($arrayAcumulado as $valuesx2){ //inicio foreach arrayR5
      $total_resP= $valuesx2[0]["tot_resu"];
    }	
/*<---------------------------------------------------IMPORTES----------------------------------------->*/		        
/*<---------------------------------------------------CMP----------------------------------------->*/			

		//if($cve_r == "3" || $cve_r == "4"){//0403CMP
	$tot_resul_cmp = 0;
	$id_consultaCMP =  189;//189//125
    $JSONCMP="[{\"num_docto\":\"$buscar\"}]";
    $arrayRCMP = json_decode(json_encode($JSONCMP), True);
    $paramsCMP = array('Resultado'=>$id_consultaCMP, 'Argumento'=>$arrayRCMP, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosCMP=$cliente->getConsulta($paramsCMP);
    $arrayRsCMP= json_decode(json_encode($resultadosCMP), True); 
    //var_dump($arrayRsCMP);
    if(!empty($arrayRsCMP)){
	    foreach($arrayRsCMP as $valuescmp){
	            $tot_resul_cmp=$valuescmp[0]["tot_resu"];
	    }   
    }else{
    	$tot_resul_cmp = 0;
    }    	
		//}//0403CMP
		
/*<---------------------------------------------------CMP----------------------------------------->*/	
/*<---------------------------------------------------MOVIMIENTOS----------------------------------------->*/
		$tot_resul_pla = 0;
	    $id_consultaPla =  96;//190;//96
	    $JSONPla="[{\"num_docto\":\"$buscar\"}]";
	    $arrayPla = json_decode(json_encode($JSONPla), True);
	    $paramsPla = array('Resultado'=>$id_consultaPla, 'Argumento'=>$arrayPla, 'Accion'=>"select"); //para conseguir la consulta
	    //var_dump($paramsPla);
	    $resultadosPla=$cliente->obtdatosfjsnxId($paramsPla);
	    foreach($resultadosPla as $valuesPla){ 
	        $arrayMPla = json_decode($valuesPla, true); 
	        $tot_resul_pla = count($arrayMPla);
	    }
/*
	    $resultadosPla=$cliente->getConsulta($paramsPla);  
	    $arrayMPla= json_decode(json_encode($resultadosPla), True);
	    //var_dump($arrayMPla);
		
			if(!empty($arrayMPla)){
			    foreach($arrayMPla as $valuesPla){//2do foreach getDatosPDF_Mov
					$tot_resul_pla=$valuesPla[0]["tot_resu"];
				}//fin 2do foreach getDatosPDF_Mov	   
		    }else{
		    	$tot_resul_pla = 0;
		    }
*/ 
/*<---------------------------------------------------MOVIMIENTOS----------------------------------------->*/
/*<---------------------------------------------------TRABAJADOR----------------------------------------->*/
	$tot_resul_tra = 0;
	$percaptura1 = "";
	$nom_area1  = "";
	$perpercurp1  = "";
    $id_consultaTra =  186;//68;//13
    $JSONTra="[{\"num_docto\":\"$buscar\"}]";
    $arrayTra = json_decode(json_encode($JSONTra), True);
    $paramsTra = array('Resultado'=>$id_consultaTra, 'Argumento'=>$arrayTra, 'Accion'=>"select"); //para conseguir la consulta
    $resultadosTra=$cliente->getConsulta($paramsTra);
    $arrayRTra= json_decode(json_encode($resultadosTra), True);
    //var_dump($arrayRTra);
    foreach($arrayRTra as $valuesTra){ //inicio foreach arrayRsT
    	$tot_resul_tra = $valuesTra[0]["tot_resu"];
    	$nom_area1 	   = $valuesTra[34]['pernom_area'];
    	$perpercurp1   = $valuesTra[35]['percurp'];
    	$percaptura1   = $valuesTra[48]['percaptura'];
    }
/*<---------------------------------------------------TRABAJADOR----------------------------------------->*/	        

/*---------------------------------------------------------CONSULTAS---------------------------------------------------------*/	
	$tot_glo = max($tot_resul_pre,$tot_resul_cmp,$tot_resul_pla);//$tot_resul_pla
	//echo $tot_resul_pre." - ".$tot_resul_cmp." - ".$tot_resul_pla;
	//echo $tot_glo;
	$LimiteA = 10;
	$LimiteC =  5; 
	$LimiteM = 10;
	$reccG=1;

	while($reccG<=$tot_glo){//recorrido_global 
	
		if($tot_resul_cmp<=5 && $tot_resul_pla > $tot_resul_pre){//$tot_resul_cmp<=5 && $tot_resul_pla > $tot_resul_pre

			if($reccG%$LimiteM==0){//$reccG%$LimiteM==0
				$pdf->AddPage();
				if($tot_resul_tra!=0){//tra!=0
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
				}//tra!=0		

				if($tot_resul_tra!=0){

					if($reccG<=$LimiteM){//$reccG==$LimiteM
						if($tot_resul_pre<$LimiteA){
							if($tot_resul_pre!=0){
								$filasAnt = $tot_resul_pre - $tot_resul_pre%$LimiteM;
								ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasAnt,"importes",$buscar);
								importe($valuesx2,$tot_resul_pre,$filasAnt,$pdf);
							}

						}else{

							if($tot_resul_pre!=0){
								$filasAnt = $tot_resul_pre - $tot_resul_pre%$LimiteM;
								ant($valuespre,$reccG,$pdf,$cliente,$filasAnt,"importes",$buscar);
								importe($valuesx2,$reccG,$filasAnt,$pdf);
							}
						}
					}else{//$reccG==$LimiteM	

							if($tot_resul_pre!=0){
								$reg =  $tot_resul_pre - $LimiteM;
								$filasAnt = $tot_resul_pre - $tot_resul_pre%$LimiteM;
								ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasAnt,"importes",$buscar);
								importe($valuesx2,$reg,$filasAnt,$pdf);
							}
						
					
					}//$reccG==$LimiteM

				}//tra!=0

				if($tot_resul_pla!=0){//mov!=0
					$filas = $reccG - $LimiteM;
					mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
				}//mov!=0								

				if($tot_resul_cmp!=0){//tra!=0
					cmp($valuescmp,$tot_resul_cmp,$filas,$pdf,$cliente,$buscar);
				}

			}else{//else $reccG%$LimiteM==0
					
				if($reccG%$tot_glo==0){//reccG==tot_resul_pre

					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
					}//tra!=0									
					$reg =  $tot_resul_pre - $LimiteM;
					if($reccG==$tot_resul_pre){
						if($tot_resul_pre!=0){
						$filas = $reccG - $tot_resul_pla%$LimiteM;	
						ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
						importe($valuesx2,$reccG,$filas,$pdf);													
						}
					}elseif($tot_resul_pla>$tot_resul_pre && $tot_resul_pre<$LimiteA){
						if($tot_resul_pre!=0){
						$filas = $reccG - $tot_resul_pre%$LimiteM;
						ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filas,"importes",$buscar);
						importe($valuesx2,$tot_resul_pre,$filas,$pdf);
						}
					}
					if($tot_resul_pla!=0){//mov!=0
						$filas = $reccG - $tot_resul_pla%$LimiteM;
						mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
					}//mov!=0

					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
					}																			
																		
				}//reccG==tot_resul_pre					
			}//else
		}//$tot_resul_cmp<=5 && $tot_resul_pla > $tot_resul_pre	

/*--------------------------------------------------------------------------------------------------------------------------------*/
		if($tot_resul_cmp<=5 && $tot_resul_pre > $tot_resul_pla){//inicio
			//echo $reccG;

			if($reccG%$LimiteM==0){////else
				$pdf->AddPage();

				if($tot_resul_tra!=0){//tra!=0

					tra($valuesTra,$tot_resul_tra,$pdf,$cliente);

				}//tra!=0								
				if($tot_resul_pre!=0){//ant!=0
					if($reccG==$LimiteA){
						$filasAnt = $reccG - $tot_resul_pre%$LimiteM;		
						ant($valuespre,$reccG,$pdf,$cliente,$filasAnt,"importes",$buscar);
						importe($valuesx2,$reccG,$filasAnt,$pdf);									
					}elseif($reccG<$LimiteA){
						$filasAnt = $reccG - $tot_resul_pre%$LimiteM;
						ant($valuespre,$reccG,$pdf,$cliente,$filasAnt,"importes",$buscar);
						importe($valuesx2,$reccG,$filasAnt,$pdf);
					}else{
						$filasAnt = $tot_resul_pre - $tot_resul_pre%$LimiteM;
						ant($valuespre,$reccG,$pdf,$cliente,$filasAnt,"importes",$buscar);
						importe($valuesx2,$reccG,$filasAnt,$pdf);
					}
				}//ant!=0

				if($tot_resul_pla!=0){//mov!=0
					//$filas = $reccG - $LimiteM;
					//mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
					//$filas = $tot_resul_pla - $LimiteM
					//$filas1 = $tot_resul_pla - $filas;
					//mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas1,$buscar,$activo);
					//mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas1,$docto_num,$dias);
					//echo $tot_resul_pla;
					//echo $tot_resul_pre;

					if($tot_resul_pla>$LimiteM){
						$filas = $tot_resul_pla - $LimiteM;
						$filas1 = $tot_resul_pla - $filas;
						mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas1,$buscar,$activo);
					}elseif($tot_resul_pla<$LimiteM){
						$filas = $reccG - $LimiteM;
						mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
					}

				}//mov!=0							
				if($tot_resul_cmp!=0){//tra!=0
					cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
				}							
					
			}else{//else
				if($reccG==$tot_resul_pre){//reccG==tot_resul_pre

					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
					}//tra!=0									
					if($tot_resul_pre!=0){//ant!=0
						$filas = $reccG - $tot_resul_pre%$LimiteM;	
						//ant($valuespre,$reccG,$dia,$pdf,$cliente,$filas,NULL);
						ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
						importe($valuesx2,$reccG,$filas,$pdf);
					}//ant!=0
					if($tot_resul_pla!=0){//mov!=0

						//$filas = ($reccG - $tot_resul_pla%$LimiteM)-1;	
						/*if($tot_resul_pla>$LimiteM){
							$filas = $tot_resul_pla - $LimiteM;
							$filas1 = $tot_resul_pla - $filas;
							mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas1,$buscar,$activo);
						}elseif($tot_resul_pre>$LimiteM && $tot_resul_pla<$LimiteM){
							$filas1 = $tot_resul_pla - $filas;
							mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas1,$buscar,$activo);
						}elseif($tot_resul_pre<$LimiteM && $tot_resul_pla<$LimiteM){
							$filas1 = $tot_resul_pla - $filas;
							mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas1,$buscar,$activo);
						}*/
					
						/*if($tot_resul_pre<$tot_resul_pla ){
							$filas1 = $tot_resul_pla - $filas;
							mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas1,$buscar,$activo);
						}else*/if($tot_resul_pre>$tot_resul_pla && $tot_resul_pla>$LimiteM){//si ant > mov
							$filas1 = $tot_resul_pla - $filas;
							mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas1,$buscar,$activo);
						}elseif($tot_resul_pre>$tot_resul_pla && $tot_resul_pre<$LimiteM){//si ant > mov
							$filas1 = $tot_resul_pla - $filas;
							mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas1,$buscar,$activo);
						}

					}//mov!=0									

					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
					}								
									
				}//reccG==tot_resul_pre	
			}//else
		}//inicio	
		
/*--------------------------------------------------------------------------------------------------------------------------------*/
		if( $tot_resul_cmp<=5 && $tot_resul_pla == $tot_resul_pre){//$tot_resul_cmp<=5 && $tot_resul_pla > $tot_resul_pre

			if($reccG%$LimiteM==0){//$reccG%$LimiteM==0
				$pdf->AddPage();
				if($tot_resul_tra!=0){//tra!=0
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
				}//tra!=0							
				//if($LimiteM<=$tot_resul_pre){
				//echo $reccG;

					if($reccG==$LimiteA){

						$filasAnt = $reccG - $reccG%$LimiteM;	
						ant($valuespre,$reccG,$pdf,$cliente,$filasAnt,"importes",$buscar);
						importe($valuesx2,$reccG,$filasAnt,$pdf);
					}else{

						$filasAnt = $reccG - $reccG%$LimiteM;	
						ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasAnt,"importes",$buscar);
						importe($valuesx2,$reccG,$filasAnt,$pdf);
					}
					
														
					//}
				if($tot_resul_pla!=0){//mov!=0
					$filas = $reccG - $LimiteM;					
					mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
				}//mov!=0								
				if($tot_resul_cmp!=0){//tra!=0
					cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
				}							
			}else{//else $reccG%$LimiteM==0
				if($reccG%$tot_glo==0){//reccG%tot_glo==0
					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
					}//tra!=0	
					if($tot_resul_pre!=0){//ant!=0
						if($tot_resul_pre<$reccG){
							$filas = $reccG - $tot_resul_pre%$LimiteM;
							ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
							importe($valuesx2,$reccG,$filas,$pdf);
						}else{
							$filasA = $tot_resul_pre - ($tot_resul_pre%$LimiteA);
							//echo $reccG;
							ant($valuespre,$reccG,$pdf,$cliente,$filasA,"importes",$buscar);
							importe($valuesx2,$tot_resul_pre,$filasA,$pdf);
						}	
					}//ant!=0
					if($tot_resul_pla!=0){//mov!=0
						$filas = $reccG - $tot_resul_pla%$LimiteM;
						mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
					}//mov!=0										
					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
					}										
				}//reccG%tot_glo==0													
			}//else

		}//$tot_resul_cmp<=5 && $tot_resul_pla > $tot_resul_pre	


	if($tot_resul_cmp>5 && $tot_resul_pla == $tot_resul_pre){//cmp>5&pla==pre
		if($reccG%$LimiteC==0){//$reccG%$LimiteC==0
			$pdf->AddPage();
			if($tot_resul_cmp!=0){//cmp!=0
				$filas = $reccG - $LimiteC;		
				cmp($valuescmp,$reccG,$pdf,$filas,$cliente,$buscar);
			}	
			if($tot_resul_tra!=0){//tra!=0
				tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
			}//tra!=0				

			if($tot_resul_pre<=$LimiteM){
				$filasAnt = $reccG - $reccG%$LimiteM;	
				ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasAnt,"importes",$buscar);
				importe($valuesx2,$tot_resul_pre,$filasAnt,$pdf);										
			}
			if($tot_resul_pla!=0){//mov!=0
				$filas = $reccG - $LimiteM;					
				mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
			}//mov!=0				
		}else{//$reccG%$LimiteC==0
			if($reccG%$tot_glo==0){//reccG%tot_glo==0
				$pdf->AddPage();
				if($tot_resul_cmp!=0){//cmp!=0
					$filas = $reccG - $tot_resul_cmp%$LimiteC;
					cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
				}
				if($tot_resul_tra!=0){//tra!=0
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
				}//tra!=0	
				if($tot_resul_pre!=0 && $tot_resul_pre > $LimiteM){//ant!=0
					$filas = $reccG - $tot_resul_pre%$LimiteM;
					ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
					importe($valuesx2,$reccG,$filas,$pdf);
				}//ant!=0
				if($tot_resul_pla!=0 && $tot_resul_pla > $LimiteM){//mov!=0
					$filas = $reccG - $tot_resul_pla%$LimiteM;
					mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
				}//mov!=0				
			}//reccG%tot_glo==0
		}//$reccG%$LimiteC==0
	}
if($tot_resul_cmp>5 && $tot_resul_pla > $tot_resul_pre){//cmp>5&pla==pre
		if($reccG%$LimiteC==0){//$reccG%$LimiteC==0
			$pdf->AddPage();
			if($tot_resul_cmp!=0){//cmp!=0
				$filas = $reccG - $LimiteC;		
				cmp($valuescmp,$reccG,$pdf,$filas,$cliente,$buscar);
			}	
			if($tot_resul_tra!=0){//tra!=0
				tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
			}//tra!=0				

			if($tot_resul_pre<=$LimiteM){
				$filasAnt = $reccG - $reccG%$LimiteM;	
				ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasAnt,"importes",$buscar);
				importe($valuesx2,$tot_resul_pre,$filasAnt,$pdf);										
			}
			if($tot_resul_pla!=0){//mov!=0
				$filas = $reccG - $LimiteM;					
				mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
			}//mov!=0				
		}else{//$reccG%$LimiteC==0
			if($reccG%$tot_glo==0){//reccG%tot_glo==0
				$pdf->AddPage();
				if($tot_resul_cmp!=0){//cmp!=0
					$filas = $reccG - $tot_resul_cmp%$LimiteC;
					cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
				}
				if($tot_resul_tra!=0){//tra!=0
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
				}//tra!=0	
				if($tot_resul_pre!=0 && $tot_resul_pre > $LimiteM){//ant!=0
					$filas = $reccG - $tot_resul_pre%$LimiteM;
					ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
					importe($valuesx2,$reccG,$filas,$pdf);
				}//ant!=0
				if($tot_resul_pla!=0 && $tot_resul_pla > $LimiteM){//mov!=0
					$filas = $reccG - $tot_resul_pla%$LimiteM;
					mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
				}//mov!=0				
			}//reccG%tot_glo==0
		}//$reccG%$LimiteC==0
	}
if($tot_resul_cmp>5 && $tot_resul_pla < $tot_resul_pre){//cmp>5&pla==pre
		if($reccG%$LimiteC==0){//$reccG%$LimiteC==0
			$pdf->AddPage();
			if($tot_resul_cmp!=0){//cmp!=0
				$filas = $reccG - $LimiteC;		
				cmp($valuescmp,$reccG,$pdf,$filas,$cliente,$buscar);
			}	
			if($tot_resul_tra!=0){//tra!=0
				tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
			}//tra!=0				

			if($tot_resul_pre<=$LimiteM){
				$filasAnt = $reccG - $reccG%$LimiteM;	
				ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasAnt,"importes",$buscar);
				importe($valuesx2,$tot_resul_pre,$filasAnt,$pdf);										
			}
			if($tot_resul_pla!=0){//mov!=0
				$filas = $reccG - $LimiteM;					
				mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
			}//mov!=0				
		}else{//$reccG%$LimiteC==0
			if($reccG%$tot_glo==0){//reccG%tot_glo==0
				$pdf->AddPage();
				if($tot_resul_cmp!=0){//cmp!=0
					$filas = $reccG - $tot_resul_cmp%$LimiteC;
					cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
				}
				if($tot_resul_tra!=0){//tra!=0
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente);
				}//tra!=0	
				if($tot_resul_pre!=0 && $tot_resul_pre > $LimiteM){//ant!=0
					$filas = $reccG - $tot_resul_pre%$LimiteM;
					ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
					importe($valuesx2,$reccG,$filas,$pdf);
				}//ant!=0
				if($tot_resul_pla!=0 && $tot_resul_pla > $LimiteM){//mov!=0
					$filas = $reccG - $tot_resul_pla%$LimiteM;
					mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,$activo);
				}//mov!=0				
			}//reccG%tot_glo==0
		}//$reccG%$LimiteC==0		
	}//cmp>5&pla==pre
		$reccG = $reccG+1;

	}//recorrido_global


//$pdf->Output('I','COPIA_Qna.pdf');

	$nom_area2 = trim($nom_area1);
	if($dia == "activo"){
		$pdf->Output('I',$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_COPIA_Fecha.pdf');
    	$pdf->Output('F','../../FUPs/Masivo_Copia/'.$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_COPIA_Fecha.pdf');
    	/*if($descargar=="descargar"){
			echo '../FUPs/Masivo_Copia/'.$nom_area1.'_'.$CURP.'_'.$buscar.'_COPIA_Fecha.pdf';
		}*/
	}else{
		$pdf->Output('I',$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_COPIA_Qna.pdf');
		$pdf->Output('F','../../FUPs/Masivo_Copia/'.$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_COPIA_Qna.pdf');
    	/*$pdf->Output('F','../../FUPs/Masivo_Copia/'.$nom_area1.'_'.$CURP.'_'.$docto_num.'_COPIA_Qna.pdf');
    	if($descargar=="descargar"){
 			echo '../FUPs/Masivo_ORIGINAL/'.$nom_area1.'_'.$CURP.'_'.$docto_num.'_COPIA_Qna.pdf';
		}*/
	}

?>