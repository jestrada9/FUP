<?php
//2117274861
		//ini_set("soap.wsdl_cache_enabled", "0");
		$meses = array("1","2","3","4","5","6","7","8","9","10","11","12");
		include '../../Cascaron/Cascaron.php';			
		include_once '../../Codigo_Barras/barcode.php';
		require_once('../../lib/nusoap.php');
		require_once('../../Conexion/wsdl.php'); 		
		
		$buscar = $_GET['buscar'];
		$copiaUoriginal="original";
		$usuario = $_GET['usuario'];

		$activo = "";//$_GET["dia"];
		$dia = "";//$_GET['dia'];

		$id_consultaP1 =  204;
		$JSONP1="[{\"var\":\"$buscar\"}]";
		$arrayRP1 = json_decode(json_encode($JSONP1), True);
		$paramsP1 = array('Resultado'=>$id_consultaP1, 'Argumento'=>$arrayRP1); //para conseguir la consulta
		//var_dump($paramsP1);
		$resultadosP1=$cliente->getConsulta($paramsP1);   
		$arrayRsP1= json_decode(json_encode($resultadosP1), True);
		//var_dump($arrayRsP1);
		$xml = simplexml_load_string($arrayRsP1['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);	  
		if(!empty($array)){

			$pdf=new PDF('L','mm','LEGAL');
			$pdf->SetAutoPageBreak(false);
			$pdf->StartPageGroup();
			//$pdf->SetProtection('print');
		    $FECHA  = 			date('d-m-Y');//date('d')."-".$meses[date('n')-1]. "-".date('Y') ;
			$FECHAD = 			date('Y-m-d');//date('Y')."-".$meses[date('n')-1]. "-".date('d') ;		

			function importe($valuesx2,$total_resP,$filas,$pdf){
				$numd = 0;
				$di = 0;
				$numeroFormateado = 0;
				$tot1=0;
				$tot=0;
			
				if($total_resP>10){
					$di=$filas;//140;
				}			

				
		        while ($di < $total_resP){//inicio while $y2
		        	if(!isset($valuesx2[0])){
		        		if (isset($valuesx2['prei07'])) {
		        			$tot=      $valuesx2['prei07'];
		        		}
		        		$tot1 += $tot;
		        	}else{
		        		if (isset($valuesx2[$di]['prei07'])) {
		        			$tot=      $valuesx2[$di]['prei07'];
		        		}
		        		$tot1 += $tot;
		        	}
		                $di++;
		        } 

		        $numeroFormateado = number_format($tot1, 2);
		        $pdf->SetFont('Arial','',7);
				$pdf->SetXY(100,75); 
				//$pdf->Cell(45,3,"$".$numeroFormateado,0,0,'L');
			
			}
			function oficio_capturo($OFICIO,$CAPTURO,$pdf){
				include 'Mostrar/oficio_capturo.php';
			}

			function info_autorizaciones($NOMBRE_EMPLEADO,$FECHA,$REVISO,$IMPRIMIO,$pdf){//info_aurorizaciones
				include 'Mostrar/pdfautorizaciones_rOriginal.php';
			}//info_aurorizaciones	

			function firmas_funcion($FECHAD,$pdf,$cliente){

				$num_firma=0;
				$num_funcion_firma=2;
				$num_nombre_firma=0;
				$num_tipo_archivo=3;
				$num_firmas=1;

				$id_consulta_firmas = 9;

				$metodo_consulta="ConsultaFirmas_Original1";
				include '../../Conexion/Metodos_Consultas/metodos_consultas.php';			
		        
			    $xml2 = simplexml_load_string($arrayR_firmas['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		        $json2 = json_encode($xml2);
		        $array2 = json_decode($json2,TRUE);

		        $ver2 = $array2['NewDataSet']['table'];		        
		        $tot_regis_firmas= count($ver2); 
		          
            	while($num_firma<$tot_regis_firmas){//while
	                        
	                $func                  = $ver2[$num_firma]["funcion"];
	                $NOMBRE_AUTORIZACIONES = $ver2[$num_firma]["nombre"];
	                $TEMPIMGLOC            = $ver2[$num_firma]["tipo_archivo"];
	                //$imagen1               = /*hex2bin(*/$ver2[$num_firma]["aut"]/*)*/;
	                $imagen1               = $ver2[$num_firma]["aut"];
	                $TEMPIMGLOC1 = str_replace(".", "", $TEMPIMGLOC);

	                $alto=175;//$alto=166;
	                $pic1 = "data: image/".$TEMPIMGLOC1.";base64,".$imagen1."";
	                $dataPieces = explode(',',$pic1);
	                $encodedImg = $dataPieces[1];
	                $decodedImg = base64_decode($encodedImg);

	                if($func == "false"){  
	                	
	                    if( $decodedImg!==false )
	                    {
	                    	
	                      if( file_put_contents("tempimg".$TEMPIMGLOC,$decodedImg)!==false )
	                      {  
	                           $pdf->SetXY(90,$alto);
	                           //$pdf->MultiCell(85,42, $pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
	                           $pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
	                           unlink("tempimg".$TEMPIMGLOC);
	                        
	                      }                
	                    }        	                    
	                        $pdf->SetFont('Arial','',8);               
	                        $pdf->SetXY(105,186);
	                        $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');	                    
	                }
	                	                
	                if($func == "true"){ 
	                  if( $decodedImg!==false )
	                  {
	                      if( file_put_contents("tempimg1".$TEMPIMGLOC,$decodedImg)!==false )
	                      { 	                         
	                          $pdf->SetXY(175,$alto);
	                          //$pdf->MultiCell(90,40, $pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
	                          $pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
	                          unlink("tempimg1".$TEMPIMGLOC);
	                        
	                      }
	                      	$pdf->SetXY(190,186);
	                        $pdf->SetFont('Arial','',8);
	                        $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');
	                  }                 
	                }
	                
	                    $num_funcion_firma=$num_funcion_firma+4;
	                    //if($num_funcion_firma > 6){break;}
	                    $num_nombre_firma=$num_nombre_firma+4;
	                    $num_tipo_archivo=$num_tipo_archivo+4;
	                    $num_firmas=$num_firmas+4;

	                    $num_firma++;
	                    if($num_funcion_firma > 8){
	                        break;
	                    }
	            }//while
            
		    }//Fin Funcion Firmas

	function acomodarRegistros($columnas,$filas,$registro,$pdf){
		
		    $pdf->SetXY($columnas,$filas);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(15,3,$registro,0,0,'C');	
	}


	function ant($valuespres,$tot_resul_pre,$pdf,$cliente,$filas,$retornar,$buscar){//funcionant
		$ID_PLA = "1";
		//var_dump($valuespres);
		$numinsert=0;
		//var_dump($valuespres[202]['_plaza']);
		$a=0;
		$t=0;
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
		$preunidad 	   	 = "";
		$presubunidad  	 = "";
		$precat_puesto   = "";
		$prehoras 	   	 = "";
		$precons_plaza1  = "";
		$premot_mov      = "";
		$pre07 		   	 = "";
		$prei071 	   	 = "";
		$preqna_ini    	 = "";
		$preqna_fin    	 = "";
		$prenum_doctopla1 = "";
		$preDR   		 = "";
		$preiDR1 		 = "";	
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
		if($valuespres!=null){//undefined
			$resultados = $tot_resul_pre + 1;

			if($tot_resul_pre>10){
				$a=$filas;//140;
				//202
				//$tot_resul_pre = $resultados;
			}
		
			while($a<$tot_resul_pre){

				if(!isset($valuespres[0])){

				if ( isset($valuespres['prepartida']) ) {
					$prepartida    	 = $valuespres['prepartida'];
					if($prepartida=="0"){
						$prepartida = "";
					}
				}	
				if ( isset($valuespres['precod_pago']) ) {
					$precod_pago1    = $valuespres['precod_pago'];
					$precod_pago 	 = str_pad($precod_pago1, 2, "0", STR_PAD_LEFT);
				}
	//----------------------------------------------------------------------------			
				if ( isset($valuespres['preunidad']) ) {
					$preunidad 	   	 = $valuespres['preunidad'];
				}	
				if ( isset($valuespres['presubunidad']) ) {
					$presubunidad  	 = $valuespres['presubunidad'];
				}
				if ( isset($valuespres['precat_puesto']) ) {
					$precat_puesto   = $valuespres['precat_puesto'];
				}
				if ( isset($valuespres['prehoras']) ) {
					$prehoras 	   	 = $valuespres['prehoras'];
				}
				if ( isset($valuespres['precons_plaza']) ) {
					$precons_plaza1  = $valuespres['precons_plaza'];
					$precons_plaza   = str_pad($precons_plaza1, 6, "0", STR_PAD_LEFT);
				}	
				if ( isset($valuespres['premot_mov']) ) {
					$premot_mov      = $valuespres['premot_mov'];
				}	
				if ( isset($valuespres['pre07']) ) {
					$pre07 		   	 = $valuespres['pre07'];
				}
				if ( isset($valuespres['prei07']) ) {
					$prei071 	   	 = $valuespres['prei07'];
					if($prei071!="" || $prei071!="0.00"){$prei07 	   	 = number_format($prei071,2);}
				}
				if ( isset($valuespres['preqna_ini']) ) {
					$preqna_ini    	 = $valuespres['preqna_ini'];
				}
				if ( isset($valuespres['preqna_fin']) ) {
					$preqna_fin    	 = $valuespres['preqna_fin'];
				}	
				if ( isset($valuespres['prenum_doctopla']) ) {
					$prenum_doctopla1 = $valuespres['prenum_doctopla'];
					$prenum_doctopla = str_pad($prenum_doctopla1, 10, "0", STR_PAD_LEFT);
				}	
				if ( isset($valuespres['preDR']) ) {
					$preDR   		 = $valuespres['preDR'];
				}
				if ( isset($valuespres['preiDR']) ) {
					$preiDR1 		 = $valuespres['preiDR'];
					if($preiDR1!="" || $preiDR1!="0.00"){$preiDR 	   	 = number_format($preiDR1,2);}
					if($preiDR=="0.00"){$preiDR 	   	 = "";}
				}
				if ( isset($valuespres['preiDRqna_ini']) ) {
					$preiDRqna_ini 	 = $valuespres['preiDRqna_ini'];
					if($preiDRqna_ini=="0"){$preiDRqna_ini 	   	 = "";}
				}
				if ( isset($valuespres['preiDRqna_fin']) ) {
					$preiDRqna_fin   = $valuespres['preiDRqna_fin'];
					if($preiDRqna_fin=="0"){$preiDRqna_fin 	   	 = "";}
				}	
				if ( isset($valuespres['preDRnum_docto']) ) {
					$preDRnum_docto  = $valuespres['preDRnum_docto'];
					if($preDRnum_docto=="0"){$preDRnum_docto 	   	 = "";}
				}	
				if ( isset($valuespres['preBS']) ) {
					$preBS 			 = $valuespres['preBS'];
				}
				if ( isset($valuespres['preiBS']) ) {
					$preiBS 		 = $valuespres['preiBS'];
					if($preiBS=="0.00"){$preiBS 	   	 = "";}
				}
				if ( isset($valuespres['preBSqna_ini']) ) {
					$preBSqna_ini 	 = $valuespres['preBSqna_ini'];
					if($preBSqna_ini=="0"){$preBSqna_ini 	   	 = "";}
				}
				if ( isset($valuespres['preBSqna_fin']) ) {
					$preBSqna_fin    = $valuespres['preBSqna_fin'];
					if($preBSqna_fin=="0"){$preBSqna_fin 	   	 = "";}
				}
				if ( isset($valuespres['preBSnum_docto']) ) {
					$preBSnum_docto  = $valuespres['preBSnum_docto'];
					if($preBSnum_docto=="0"){$preBSnum_docto 	   	 = "";}
				}	
				if ( isset($valuespres['preI4']) ) {
					$preI4 			 = $valuespres['preI4'];
				}
				if ( isset($valuespres['preiI4']) ) {
					$preiI4 		 = $valuespres['preiI4'];
					if($preiI4=="0.00"){$preiI4 	   	 = "";}
				}
				if ( isset($valuespres['preI4qna_ini']) ) {
					$preI4qna_ini 	 = $valuespres['preI4qna_ini'];
					if($preI4qna_ini=="0"){$preI4qna_ini 	   	 = "";}
				}
				if ( isset($valuespres['preI4qna_fin']) ) {
					$preI4qna_fin 	 = $valuespres['preI4qna_fin'];
					if($preI4qna_fin=="0"){$preI4qna_fin 	   	 = "";}
				}	
				if ( isset($valuespres['preI4num_docto']) ) {
					$preI4num_docto  = $valuespres['preI4num_docto'];
					if($preI4num_docto=="0"){$preI4num_docto 	   	 = "";}
				}	
				if ( isset($valuespres['preE3']) ) {
					$preE3 		 	 = $valuespres['preE3'];
				}
				if ( isset($valuespres['preiE3']) ) {
					$preiE3 		 = $valuespres['preiE3'];
					if($preiE3=="0.00"){$preiE3 	   	 = "";}
				}
				if ( isset($valuespres['preE3qna_ini']) ) {
					$preE3qna_ini 	 = $valuespres['preE3qna_ini'];
					if($preE3qna_ini=="0"){$preE3qna_ini 	   	 = "";}
				}
				if ( isset($valuespres['preE3qna_fin']) ) {
					$preE3qna_fin 	 = $valuespres['preE3qna_fin'];
					if($preE3qna_fin=="0"){$preE3qna_fin 	   	 = "";}
				}
				if ( isset($valuespres['preE3num_docto']) ) {
					$preE3num_docto  = $valuespres['preE3num_docto'];
					if($preE3num_docto=="0"){$preE3num_docto 	   	 = "";}
				}	


				include 'Mostrar/R_seccionAntecedentes.php';

				$t++;
				$a++;
				$tot_reg++;
			}else{
				if ( isset($valuespres[$a]['prepartida']) ) {
					$prepartida    	 = $valuespres[$a]['prepartida'];
					if($prepartida=="0"){
						$prepartida = "";
					}
				}	
				if ( isset($valuespres[$a]['precod_pago']) ) {
					$precod_pago1    = $valuespres[$a]['precod_pago'];
					$precod_pago 	 = str_pad($precod_pago1, 2, "0", STR_PAD_LEFT);
				}
	//----------------------------------------------------------------------------			
				if ( isset($valuespres[$a]['preunidad']) ) {
					$preunidad 	   	 = $valuespres[$a]['preunidad'];
				}	
				if ( isset($valuespres[$a]['presubunidad']) ) {
					$presubunidad  	 = $valuespres[$a]['presubunidad'];
				}
				if ( isset($valuespres[$a]['precat_puesto']) ) {
					$precat_puesto   = $valuespres[$a]['precat_puesto'];
				}
				if ( isset($valuespres[$a]['prehoras']) ) {
					$prehoras 	   	 = $valuespres[$a]['prehoras'];
				}
				if ( isset($valuespres[$a]['precons_plaza']) ) {
					$precons_plaza1  = $valuespres[$a]['precons_plaza'];
					$precons_plaza   = str_pad($precons_plaza1, 6, "0", STR_PAD_LEFT);
				}	
				if ( isset($valuespres[$a]['premot_mov']) ) {
					$premot_mov      = $valuespres[$a]['premot_mov'];
				}	
				if ( isset($valuespres[$a]['pre07']) ) {
					$pre07 		   	 = $valuespres[$a]['pre07'];
				}
				if ( isset($valuespres[$a]['prei07']) ) {
					$prei071 	   	 = $valuespres[$a]['prei07'];
					if($prei071!="" || $prei071!="0.00"){$prei07 	   	 = number_format($prei071,2);}
				}
				if ( isset($valuespres[$a]['preqna_ini']) ) {
					$preqna_ini    	 = $valuespres[$a]['preqna_ini'];
				}
				if ( isset($valuespres[$a]['preqna_fin']) ) {
					$preqna_fin    	 = $valuespres[$a]['preqna_fin'];
				}	
				if ( isset($valuespres[$a]['prenum_doctopla']) ) {
					$prenum_doctopla1 = $valuespres[$a]['prenum_doctopla'];
					$prenum_doctopla = str_pad($prenum_doctopla1, 10, "0", STR_PAD_LEFT);
				}	
				if ( isset($valuespres[$a]['preDR']) ) {
					$preDR   		 = $valuespres[$a]['preDR'];
				}
				if ( isset($valuespres[$a]['preiDR']) ) {
					$preiDR1 		 = $valuespres[$a]['preiDR'];
					if($preiDR1!="" || $preiDR1!="0.00"){$preiDR 	   	 = number_format($preiDR1,2);}
					if($preiDR=="0.00"){$preiDR 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preiDRqna_ini']) ) {
					$preiDRqna_ini 	 = $valuespres[$a]['preiDRqna_ini'];
					if($preiDRqna_ini=="0"){$preiDRqna_ini 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preiDRqna_fin']) ) {
					$preiDRqna_fin   = $valuespres[$a]['preiDRqna_fin'];
					if($preiDRqna_fin=="0"){$preiDRqna_fin 	   	 = "";}
				}	
				if ( isset($valuespres[$a]['preDRnum_docto']) ) {
					$preDRnum_docto  = $valuespres[$a]['preDRnum_docto'];
					if($preDRnum_docto=="0"){$preDRnum_docto 	   	 = "";}
				}	
				if ( isset($valuespres[$a]['preBS']) ) {
					$preBS 			 = $valuespres[$a]['preBS'];
				}
				if ( isset($valuespres[$a]['preiBS']) ) {
					$preiBS 		 = $valuespres[$a]['preiBS'];
					if($preiBS=="0.00"){$preiBS 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preBSqna_ini']) ) {
					$preBSqna_ini 	 = $valuespres[$a]['preBSqna_ini'];
					if($preBSqna_ini=="0"){$preBSqna_ini 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preBSqna_fin']) ) {
					$preBSqna_fin    = $valuespres[$a]['preBSqna_fin'];
					if($preBSqna_fin=="0"){$preBSqna_fin 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preBSnum_docto']) ) {
					$preBSnum_docto  = $valuespres[$a]['preBSnum_docto'];
					if($preBSnum_docto=="0"){$preBSnum_docto 	   	 = "";}
				}	
				if ( isset($valuespres[$a]['preI4']) ) {
					$preI4 			 = $valuespres[$a]['preI4'];
				}
				if ( isset($valuespres[$a]['preiI4']) ) {
					$preiI4 		 = $valuespres[$a]['preiI4'];
					if($preiI4=="0.00"){$preiI4 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preI4qna_ini']) ) {
					$preI4qna_ini 	 = $valuespres[$a]['preI4qna_ini'];
					if($preI4qna_ini=="0"){$preI4qna_ini 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preI4qna_fin']) ) {
					$preI4qna_fin 	 = $valuespres[$a]['preI4qna_fin'];
					if($preI4qna_fin=="0"){$preI4qna_fin 	   	 = "";}
				}	
				if ( isset($valuespres[$a]['preI4num_docto']) ) {
					$preI4num_docto  = $valuespres[$a]['preI4num_docto'];
					if($preI4num_docto=="0"){$preI4num_docto 	   	 = "";}
				}	
				if ( isset($valuespres[$a]['preE3']) ) {
					$preE3 		 	 = $valuespres[$a]['preE3'];
				}
				if ( isset($valuespres[$a]['preiE3']) ) {
					$preiE3 		 = $valuespres[$a]['preiE3'];
					if($preiE3=="0.00"){$preiE3 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preE3qna_ini']) ) {
					$preE3qna_ini 	 = $valuespres[$a]['preE3qna_ini'];
					if($preE3qna_ini=="0"){$preE3qna_ini 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preE3qna_fin']) ) {
					$preE3qna_fin 	 = $valuespres[$a]['preE3qna_fin'];
					if($preE3qna_fin=="0"){$preE3qna_fin 	   	 = "";}
				}
				if ( isset($valuespres[$a]['preE3num_docto']) ) {
					$preE3num_docto  = $valuespres[$a]['preE3num_docto'];
					if($preE3num_docto=="0"){$preE3num_docto 	   	 = "";}
				}
				if ( isset($valuespres[$a]['tot']) ) {
					$tot 			 = $valuespres[$a]['tot'];
				}	
				include 'Mostrar/R_seccionAntecedentes.php';

				$t++;
				$a++;
				$tot_reg++;
			}//else
		}//inicio_while


	}//undefined
		/*if($retornar=="importes"){
			return $importe_total;
		}*/
		
	}//funcionant

	/*------------------------------------------------TRABAJADOR------------------------------------------------*/			
	function tra($valuestra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD){//funciontra
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
		        while ($y < $tot_resul_tra){//while
		        	
		        	if ( isset($valuestra["perarea"]) ) {
		        		$perarea 		  = $valuestra["perarea"];
		        	}
		        	if ( isset($valuestra["pernum_docto"]) ) {
		        		$pernum_docto 	  = $valuestra["pernum_docto"];
		        	}
		        	if ( isset($valuestra["perrfc"]) ) {
		        		$perrfc 		  = $valuestra['perrfc'];
		        	}
		        	if ( isset($valuestra["pernom_emp"]) ) {
		        		$pernom_emp		  = $valuestra['pernom_emp'];
		        	}
					if ( isset($valuestra["peredo_nac"]) ) {
						$peredo_nac	  	  = $valuestra['peredo_nac'];
					}
					if ( isset($valuestra["persexo"]) ) {
						$persexo 		  =	$valuestra['persexo'];
					}
					if ( isset($valuestra["peredo_civil"]) ) {
						$peredo_civil 	  = $valuestra['peredo_civil'];
					}
					if ( isset($valuestra["peremp_dom"]) ) {
						$peremp_dom 	  = $valuestra['peremp_dom'];
					}
					if ( isset($valuestra["peremp_dom_cp"]) ) {
						$peremp_dom_cp	  =	$valuestra['peremp_dom_cp'];
					}
					if ( isset($valuestra["peremp_dom_col"]) ) {
						$peremp_dom_col	  = $valuestra['peremp_dom_col'];
					}
					if ( isset($valuestra["peremp_dom_pob"]) ) {
						$peremp_dom_pob	  = $valuestra['peremp_dom_pob'];
					}
					if ( isset($valuestra["perniv_academico"]) ) {
						$perniv_academico = $valuestra['perniv_academico'];
					}
					if ( isset($valuestra["perqna_ing_gob"]) ) {
						$perqna_ing_gob   = $valuestra['perqna_ing_gob'];
					}
					if ( isset($valuestra["perqna_ing_sep"]) ) {
						$perqna_ing_sep	  = $valuestra['perqna_ing_sep'];
					}
					if ( isset($valuestra["pernum_tit"]) ) {
						$pernum_tit2		  = $valuestra['pernum_tit'];
						$pernum_tit = 		str_pad($pernum_tit2, 9, "0", STR_PAD_LEFT);
					}
					if ( isset($valuestra["pernum_lic"]) ) {
						$pernum_lic2		  = $valuestra['pernum_lic'];
						$pernum_lic = 		str_pad($pernum_lic2, 9, "0", STR_PAD_LEFT);
					}
					if ( isset($valuestra["perq"]) ) {
						$perq 		 	  =	$valuestra['perq'];
					}
					if ( isset($valuestra["pera"]) ) {
						$pera 			  = $valuestra['pera'];
					}
					if ( isset($valuestra["perl"]) ) {
						$perl 			  = $valuestra['perl'];
					}
					if ( isset($valuestra["pert"]) ) {
						$pert 			  =	$valuestra['pert'];
					}
					if ( isset($valuestra["perct1"]) ) {
						$perct1 		  =	$valuestra['perct1'];
					}
					if ( isset($valuestra["perhr1"]) ) {
						$perhr1 		  =	$valuestra['perhr1'];
					}
					if ( isset($valuestra["perct2"]) ) {
						$perct2 		  =	$valuestra['perct2'];
					}
					if ( isset($valuestra["perhr2"]) ) {
						$perhr2 		  = $valuestra['perhr2'];
					}
					if ( isset($valuestra["perct3"]) ) {
						$perct3 		  = $valuestra['perct3'];
					}
					if ( isset($valuestra["perhr3"]) ) {
						$perhr3 		  = $valuestra['perhr3'];
					}
					if ( isset($valuestra["perct4"]) ) {
						$perct4 		  = $valuestra['perct4'];
					}
					if ( isset($valuestra["perhr4"]) ) {
						$perhr4 		  = $valuestra['perhr4'];
					}
					if ( isset($valuestra["perct5"]) ) {
						$perct5  		  = $valuestra['perct5'];
					}
					if ( isset($valuestra["perhr5"]) ) {
						$perhr5 	 	  = $valuestra['perhr5'];
					}
					if ( isset($valuestra["perct6"]) ) {
						$perct6 		  = $valuestra['perct6'];
					}
					if ( isset($valuestra["perhr6"]) ) {
						$perhr6 		  = $valuestra['perhr6'];
					}
					if ( isset($valuestra["perrfc_nuevo"]) ) {
						$perrfc_nuevo 	  = $valuestra['perrfc_nuevo'];
					}
					if ( isset($valuestra["nombre_area"]) ) {
						$pernom_area 	  = $valuestra['nombre_area'];
					}
					if ( isset($valuestra["curp"]) ) {
						$percurp 		  = $valuestra['curp'];
					}
					if ( isset($valuestra["doc_anexa1"]) ) {
						$perdoc_anexa1	  = trim($valuestra['doc_anexa1']);
						if($perdoc_anexa1 == "NULL"){$perdoc_anexa1 = "";}
					}
					if ( isset($valuestra["doc_anexa2"]) ) {
						$perdoc_anexa2	  = trim($valuestra['doc_anexa2']);
						if($perdoc_anexa2 == "NULL"){$perdoc_anexa2 = "";}
					}
					if ( isset($valuestra["doc_anexa3"]) ) {
						$perdoc_anexa3 	  = trim($valuestra['doc_anexa3']);
						if($perdoc_anexa3 == "NULL"){$perdoc_anexa3 = "";}
					}
					if ( isset($valuestra["doc_anexa4"]) ) {
						$perdoc_anexa4 	  = trim($valuestra['doc_anexa4']);
						if($perdoc_anexa4 == "NULL"){$perdoc_anexa4 = "";}
					}
					if ( isset($valuestra["doc_anexa5"]) ) {
						$perdoc_anexa5 	  = trim($valuestra['doc_anexa5']);
						if($perdoc_anexa5 == "NULL"){$perdoc_anexa5 = "";}
					}
					if ( isset($valuestra["obsrv1"]) ) {
						$perobsrv1	      = trim($valuestra['obsrv1']);
						if($perobsrv1 == "NULL"){$perobsrv1 = "";}
					}
					if ( isset($valuestra["obsrv2"]) ) {
						$perobsrv2 		  = trim($valuestra['obsrv2']);
						if($perobsrv2 == "NULL"){$perobsrv2 = "";}
					}
					if ( isset($valuestra["obsrv3"]) ) {
						$perobsrv3 		  = trim($valuestra['obsrv3']);
						if($perobsrv3 == "NULL"){$perobsrv3 = "";}
					}
					if ( isset($valuestra["obsrv4"]) ) {
						$perobsrv4 		  = trim($valuestra['obsrv4']);
						if($perobsrv4 == "NULL"){$perobsrv4 = "";}
					}
					if ( isset($valuestra["num_oficio"]) ) {
						$pernum_oficio 	  = $valuestra['num_oficio'];
					}
					if ( isset($valuestra["operador"]) ) {
						$peroperador 	  = $valuestra['operador'];
						if($peroperador==""){
							$peroperador = "MPLO";
						}
					}
					if ( isset($valuestra["cpr"]) ) {
						$percpr 		  = $valuestra['cpr'];
					}
					if ( isset($valuestra["captura"]) ) {
						$percaptura1 	  = $valuestra['captura'];
						$percaptura  = 		date('d-m-Y', strtotime($percaptura1));
					}
					if ( isset($valuestra["cve_mov"]) ) {	   
						$percve_mov 	  = $valuestra['cve_mov'];
					}     		

					firmas_funcion($FECHAD,$pdf,$cliente);
					//$fechaActual = date('d-m-y');
					$id_consultaExist1 =  207;
				    $JSONExist1="[{\"num_docto\":\"$pernum_docto\"}]";
				    $arrayExist1 = json_decode(json_encode($JSONExist1), True);
				    $paramsExist1 = array('Resultado'=>$id_consultaExist1, 'Argumento'=>$arrayExist1, 'Accion'=>"select"); //para conseguir la consulta
				    $resultadosExist1=$cliente->getConsulta($paramsExist1);
				    $arrayRExist1= json_decode(json_encode($resultadosExist1), True);

				    if(!empty($arrayRExist1)){
				    	$xmlus = simplexml_load_string($arrayRExist1['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
						$jsonus = json_encode($xmlus);
						$arrayus = json_decode($jsonus,TRUE);

						if(!empty($arrayus)){
					    	$verus = $arrayus['NewDataSet']['table'];
							$tot_resul_mov1= count($arrayus['NewDataSet']['table']);
							
							$reviso	   	    = $verus["usuario"];	
						}else{
							$reviso = "MPLO";
						}
						
					}
					
					$imprimio="";
				    $id_consultaImprimio =  242;
				    $JSONImprimio="[{\"usuario\":\"$usuario\"}]";
				    $arrayImprimio = json_decode(json_encode($JSONImprimio), True);
				    $paramsImprimio = array('Resultado'=>$id_consultaImprimio, 'Argumento'=>$arrayImprimio, 'Accion'=>"select"); //para conseguir la consulta
				    $resultadosImprimio=$cliente->getConsulta($paramsImprimio);
				    $arrayRImprimio= json_decode(json_encode($resultadosImprimio), True);
				    //var_dump($arrayRImprimio);
				    	
				    if(!empty($arrayRImprimio)){
					   $xmlus2 = simplexml_load_string($arrayRImprimio['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
						$jsonus2 = json_encode($xmlus2);
						$arrayus2 = json_decode($jsonus2,TRUE);

						if(!empty($arrayus2)){
					    	$verus = $arrayus2['NewDataSet']['table'];
							$tot_resul_mov1= count($arrayus2['NewDataSet']['table']);

							$imprimio	   	    = $verus["usuario"];	
						}else{
							$imprimio = "MPLO";
						}
					}else{
						$imprimio = "MPLO";
					}
					
					  $area        = $perarea;
					  $num_oficio  = $pernum_oficio;
					  $observacion = "Imprimio Original";
					  $operacion   = "Imprimio Original";
	  			
		            $id_consulta_Mov_D =  205;
		            $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$pernum_docto\",\"num_oficio\":\"$pernum_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
		            $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
		            $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
		            $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);
	            
	            if($usuario=="Jonathan"){
	            	info_autorizaciones($pernom_emp,$FECHAD,$reviso,"",$pdf);
	            }else{
	            	info_autorizaciones($pernom_emp,$FECHAD,$reviso,$imprimio,$pdf);	
	            }
					

					oficio_capturo($pernum_oficio,$peroperador,$pdf);
					
					include 'Mostrar/R_seccionPersonales.php';

					

					$y++;
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
				$pdfC=$filas;//140;
				//202
				//$tot_resul_pre = $resultados;
			}
			while($pdfC<$tot_resul_cmp){//whilecmp
				if(!isset($valuescmp[0])){

				if ( isset($valuescmp["cmppartidaR1"]) ) {
					$cmppartida      	  = $valuescmp["cmppartidaR1"];
					$cmppartidaR1    	  = str_pad($cmppartida, 4, "0", STR_PAD_LEFT);
				}
				if ( isset($valuescmp["cmpcod_pagoR1"]) ) {
					$cmpcod_pago 	   	  = $valuescmp["cmpcod_pagoR1"];
		        	$cmpcod_pagoR1   	  = str_pad($cmpcod_pago, 2, "0", STR_PAD_LEFT);
		    	}
				if ( isset($valuescmp["cmpunidadR1"]) ) {
					$cmpunidad       	  = $valuescmp["cmpunidadR1"];
		        	$cmpunidadR1     	  = str_pad($cmpunidad, 2, "0", STR_PAD_LEFT);
		        }
				if ( isset($valuescmp["cmpsubunidadR1"]) ) {
					$cmpsubunidad    	  = $valuescmp["cmpsubunidadR1"];
		        	$cmpsubunidadR1  	  = str_pad($cmpsubunidad, 2, "0", STR_PAD_LEFT);
		        }
				if ( isset($valuescmp["cmpcat_puestoR1"]) ) {
					$cmpcat_puestoR1	  = $valuescmp["cmpcat_puestoR1"];
					if($cmpcat_puestoR1=="NULL"){
						$cmpcat_puestoR1 = "";
					}
				}
				if ( isset($valuescmp["cmphorasR1"]) ) {
					$cmphoras        	  = $valuescmp["cmphorasR1"];
					$cmphorasR1      	  = str_pad($cmphoras, 2, "0", STR_PAD_LEFT);
				}
				if ( isset($valuescmp["cmpcons_plazaR1"]) ) {
					$cmpcons_plazaR1 	  = $valuescmp["cmpcons_plazaR1"];
		        	if($cmpcons_plazaR1 == "0"){ $cmpcons_plazaR1 = ""; }
		        }
				if ( isset($valuescmp["cmpimporteanteriorR1"]) ) {
					$cmpimporteanteriorR11 = $valuescmp["cmpimporteanteriorR1"];
					$cmpimporteanteriorR1  = number_format($cmpimporteanteriorR11,2);	 
				}
				if ( isset($valuescmp["cmpqna_iniR1"]) ) {
					$cmpqna_iniR1 		  = $valuescmp["cmpqna_iniR1"];
				}
				if ( isset($valuescmp["cmpqna_finR1"]) ) {
					$cmpqna_finR1 		  = $valuescmp["cmpqna_finR1"];
				}
				if ( isset($valuescmp["cmpanio_procR1"]) ) {
					$cmpanio_procR1 	  = $valuescmp["cmpanio_procR1"];
				}
				if ( isset($valuescmp["cmpfijoR1"]) ) {
					$cmpfijoR1 			  = $valuescmp["cmpfijoR1"];
				}
				if ( isset($valuescmp["cmpprogramaR1"]) ) {
					$cmpprogramaR1 		  = $valuescmp["cmpprogramaR1"];
				}
				if ( isset($valuescmp["cmpsubprogramaR1"]) ) {
					$cmpsubprogramaR1 	  = $valuescmp["cmpsubprogramaR1"];
				}
				if ( isset($valuescmp["cmpproyectoR1"]) ) {
					$cmpproyectoR1 		  = $valuescmp["cmpproyectoR1"];
				}
				if ( isset($valuescmp["cmpunidad_respR1"]) ) {
					$cmpunidad_respR1 	  = $valuescmp["cmpunidad_respR1"];
				}
				if ( isset($valuescmp["cmpconceptoR1"]) ) {
					$cmpconceptoR1 		  = $valuescmp["cmpconceptoR1"];
				}
				if ( isset($valuescmp["cmpabcR1"]) ) {
					$cmpabcR1 			  = $valuescmp["cmpabcR1"];
		        	if($cmpabcR1 == "A"){	$cmpabcR1 = "ALTA"; }
		        	if($cmpabcR1 == "B"){	$cmpabcR1 = "BAJA"; }
		        }
				if ( isset($valuescmp["cmpimportenuevoR1"]) ) {
					$cmpimportenuevoR11 	  = $valuescmp["cmpimportenuevoR1"]; 
					$cmpimportenuevoR1   = number_format($cmpimportenuevoR11, 2 );
				}
				if ( isset($valuescmp["cmpjustificacionR1"]) ) {
					$cmpjustificacionR1   = $valuescmp["cmpjustificacionR1"];
		     	    $cmpjustificacionR11  = utf8_decode($cmpjustificacionR1);
		    	}
		    	
		        $cmpAutorizado1 = $cmpimportenuevoR11 - $cmpimporteanteriorR11;
		        $cmpAutorizado 			= number_format($cmpAutorizado1,2);	 
		        if($cmpimportenuevoR1 == 0.00 && $cmpimporteanteriorR1 == 0.00){
		            $cmpAutorizado = "0.00";
		        }

				include 'Mostrar/R_seccionCmp.php';

				$pdfC++;
			  	$cmp++;
			  }else{
			  					if ( isset($valuescmp[$pdfC]["cmppartidaR1"]) ) {
					$cmppartida      	  = $valuescmp[$pdfC]["cmppartidaR1"];
					$cmppartidaR1    	  = str_pad($cmppartida, 4, "0", STR_PAD_LEFT);
				}
				if ( isset($valuescmp[$pdfC]["cmpcod_pagoR1"]) ) {
					$cmpcod_pago 	   	  = $valuescmp[$pdfC]["cmpcod_pagoR1"];
		        	$cmpcod_pagoR1   	  = str_pad($cmpcod_pago, 2, "0", STR_PAD_LEFT);
		    	}
				if ( isset($valuescmp[$pdfC]["cmpunidadR1"]) ) {
					$cmpunidad       	  = $valuescmp[$pdfC]["cmpunidadR1"];
		        	$cmpunidadR1     	  = str_pad($cmpunidad, 2, "0", STR_PAD_LEFT);
		        }
				if ( isset($valuescmp[$pdfC]["cmpsubunidadR1"]) ) {
					$cmpsubunidad    	  = $valuescmp[$pdfC]["cmpsubunidadR1"];
		        	$cmpsubunidadR1  	  = str_pad($cmpsubunidad, 2, "0", STR_PAD_LEFT);
		        }
				if ( isset($valuescmp[$pdfC]["cmpcat_puestoR1"]) ) {
					$cmpcat_puestoR1	  = $valuescmp[$pdfC]["cmpcat_puestoR1"];
					if($cmpcat_puestoR1=="NULL"){
						$cmpcat_puestoR1 = "";
					}
				}
				if ( isset($valuescmp[$pdfC]["cmphorasR1"]) ) {
					$cmphoras        	  = $valuescmp[$pdfC]["cmphorasR1"];
					$cmphorasR1      	  = str_pad($cmphoras, 2, "0", STR_PAD_LEFT);
				}
				if ( isset($valuescmp[$pdfC]["cmpcons_plazaR1"]) ) {
					$cmpcons_plazaR1 	  = $valuescmp[$pdfC]["cmpcons_plazaR1"];
		        	if($cmpcons_plazaR1 == "0"){ $cmpcons_plazaR1 = ""; }
		        }
				if ( isset($valuescmp[$pdfC]["cmpimporteanteriorR1"]) ) {
					$cmpimporteanteriorR11 = $valuescmp[$pdfC]["cmpimporteanteriorR1"];
					$cmpimporteanteriorR1  = number_format($cmpimporteanteriorR11,2);	 
				}
				if ( isset($valuescmp[$pdfC]["cmpqna_iniR1"]) ) {
					$cmpqna_iniR1 		  = $valuescmp[$pdfC]["cmpqna_iniR1"];
				}
				if ( isset($valuescmp[$pdfC]["cmpqna_finR1"]) ) {
					$cmpqna_finR1 		  = $valuescmp[$pdfC]["cmpqna_finR1"];
				}
				if ( isset($valuescmp[$pdfC]["cmpanio_procR1"]) ) {
					$cmpanio_procR1 	  = $valuescmp[$pdfC]["cmpanio_procR1"];
				}
				if ( isset($valuescmp[$pdfC]["cmpfijoR1"]) ) {
					$cmpfijoR1 			  = $valuescmp[$pdfC]["cmpfijoR1"];
				}
				if ( isset($valuescmp[$pdfC]["cmpprogramaR1"]) ) {
					$cmpprogramaR1 		  = $valuescmp[$pdfC]["cmpprogramaR1"];
				}
				if ( isset($valuescmp[$pdfC]["cmpsubprogramaR1"]) ) {
					$cmpsubprogramaR1 	  = $valuescmp[$pdfC]["cmpsubprogramaR1"];
				}
				if ( isset($valuescmp[$pdfC]["cmpproyectoR1"]) ) {
					$cmpproyectoR1 		  = $valuescmp[$pdfC]["cmpproyectoR1"];
				}
				if ( isset($valuescmp[$pdfC]["cmpunidad_respR1"]) ) {
					$cmpunidad_respR1 	  = $valuescmp[$pdfC]["cmpunidad_respR1"];
				}
				if ( isset($valuescmp[$pdfC]["cmpconceptoR1"]) ) {
					$cmpconceptoR1 		  = $valuescmp[$pdfC]["cmpconceptoR1"];
				}
				if ( isset($valuescmp[$pdfC]["cmpabcR1"]) ) {
					$cmpabcR1 			  = $valuescmp[$pdfC]["cmpabcR1"];
		        	if($cmpabcR1 == "A"){	$cmpabcR1 = "ALTA"; }
		        	if($cmpabcR1 == "B"){	$cmpabcR1 = "BAJA"; }
		        }
				if ( isset($valuescmp[$pdfC]["cmpimportenuevoR1"]) ) {
					$cmpimportenuevoR11 	  = $valuescmp[$pdfC]["cmpimportenuevoR1"]; 
					$cmpimportenuevoR1   = number_format($cmpimportenuevoR11, 2 );
				}
				if ( isset($valuescmp[$pdfC]["cmpjustificacionR1"]) ) {
					$cmpjustificacionR1   = $valuescmp[$pdfC]["cmpjustificacionR1"];
		     	    $cmpjustificacionR11  = utf8_decode($cmpjustificacionR1);
		    	}
		    	
		        $cmpAutorizado1 = $cmpimportenuevoR11 - $cmpimporteanteriorR11;
		        $cmpAutorizado 			= number_format($cmpAutorizado1,2);	 
		        if($cmpimportenuevoR1 == 0.00 && $cmpimporteanteriorR1 == 0.00){
		            $cmpAutorizado = "0.00";
		        }

				include 'Mostrar/R_seccionCmp.php';

				$pdfC++;
			  	$cmp++;
			  }
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

		if($tot_resul_pla>10){
			
			$b=$filas;//330;//($tot_resul_pla*33)
			//$tot_resul_pla = $e;
		}
		
	  	while ($b < $tot_resul_pla){//$total_res*30 //2do while getDatosPDF_Mov
			if(!isset($valuesPla[0])){
					  		if ( isset($valuesPla["placve_mov"]) ) {
	  			$M			  		= $valuesPla['placve_mov'];
	  			$placve_mov 		= str_pad($M, 2, "0", STR_PAD_LEFT);
	  		}
	  		if ( isset($valuesPla["plamot_mov"]) ) {
	  			$MO1 				= $valuesPla['plamot_mov'];//10";
				$plamot_mov 		= str_pad($MO1, 2, "0", STR_PAD_LEFT);
			}
	  		if ( isset($valuesPla["plapartida"]) ) {
	  			$plapartida			= $valuesPla['plapartida'];
	  			if($plapartida=="0"){
	  				$plapartida = "";
	  			}
	  		}
	  		if ( isset($valuesPla["placod_pago"]) ) {
	  			$CODIGO_PAGO_MOV1	= $valuesPla['placod_pago'];
				$placod_pago 		= str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
				if($placod_pago=="0"){
	  				$placod_pago = "";
	  			}
			}
	  		if ( isset($valuesPla["plaunidad"]) ) {
	  			$plaunidad 			= $valuesPla['plaunidad'];
				if($plaunidad=="0"){
	  				$plaunidad = "";
	  			}  			
	  		}
	  		if ( isset($valuesPla["plasubunidad"]) ) {
	  			$plasubunidad 	    = $valuesPla['plasubunidad'];
				if($plasubunidad=="0"){
	  				$plasubunidad = "";
	  			}  			
	  		}
	  		if ( isset($valuesPla["placat_puesto"]) ) {
	  			$placat_puesto		= $valuesPla['placat_puesto'];
	  			if($placat_puesto=="NULL"){
	  				$placat_puesto = "";
	  			}
	  		}	
	  		if ( isset($valuesPla["plahoras"]) ) {
	  			$plahoras 			= $valuesPla['plahoras'];
				/*if($plahoras=="0"){
	  				$plahoras = "";
	  			}*/  			
	  		}
	  		if ( isset($valuesPla["placons_plaza"]) ) {
	  			$numero 			= $valuesPla['placons_plaza'];
				$placons_plaza 		= str_pad($numero, 6, "0", STR_PAD_LEFT);
			}
	  		if ( isset($valuesPla["plaqna_ini"]) ) {
	  			$plaqna_ini 		= $valuesPla['plaqna_ini'];
	  		}
	  		if ( isset($valuesPla["plaqna_fin"]) ) {
	  			$plaqna_fin 		= $valuesPla['plaqna_fin'];
	  		}
	  		if ( isset($valuesPla["planom_emp"]) ) {
	  			$planom_emp  		= "";//$valuesPla['planom_emp'];
				if($planom_emp == "NULL"){$planom_emp = "";}
			}
	  		if ( isset($valuesPla["plarfc"]) ) {
	  			$plarfc 			= "";//$valuesPla['plarfc'];
				if($plarfc == "NULL"){$plarfc = "";}
			}
	  		if ( isset($valuesPla["plamot_movsub"]) ) {
	  			$plamot_movsub 		= $valuesPla['plamot_movsub'];
	  			if($plamot_movsub == "NULL" || $plamot_movsub == "0"){$plamot_movsub = "";}
			}
	  		if ( isset($valuesPla["plaqna_inisub"]) ) {
				$plaqna_inisub 		= $valuesPla['plaqna_inisub'];
				if($plaqna_inisub == "NULL" || $plaqna_inisub == "0"){$plaqna_inisub = "";}
			}
	  		if ( isset($valuesPla["plaqna_finsub"]) ) {
	  			$plaqna_finsub		= $valuesPla['plaqna_finsub'];
				if($plaqna_finsub == "NULL" || $plaqna_finsub == "0"){$plaqna_finsub = "";}
			}
	  		if ( isset($valuesPla["planum_doctosub"]) ) {
	  			$planum_doctosub	= $valuesPla['planum_doctosub'];
				if($planum_doctosub == "NULL" || $planum_doctosub == "0"){$planum_doctosub = "";}
			}  		
	  		if ( isset($valuesPla["plactnvo"]) ) {
	  			$plactnvo			= $valuesPla['plactnvo'];
			}
	  		if ( isset($valuesPla["planivel_sueldonvo"]) ) {
				$planivel_sueldonvo	= $valuesPla['planivel_sueldonvo'];
				if($planivel_sueldonvo == "0"){$planivel_sueldonvo = "";}
			}
	  		if ( isset($valuesPla["plabasificacion"]) ) {
				$plabasificacion	= $valuesPla['plabasificacion'];
				if($plabasificacion=="0"){$plabasificacion="";}
			}
	  		if ( isset($valuesPla["plapromocion"]) ) {
	  			$plapromocion	 	= $valuesPla['plapromocion'];
				if($plapromocion=="0"){$plapromocion="";}	

			}
	  		if ( isset($valuesPla["plaqna_ing_sub"]) ) {	
	  			$plaqna_ing_sub		= $valuesPla['plaqna_ing_sub'];
				if($plaqna_ing_sub=="NULL" || $plaqna_ing_sub=="0"){$plaqna_ing_sub="";}	
			}
	  		if ( isset($valuesPla["descripcion1"]) ) {
	  			$pladescripcion1 	= $valuesPla['descripcion1'];                                 
			}
	  		if ( isset($valuesPla["descripcion2"]) ) {
	  			$pladescripcion2	= $valuesPla['descripcion2'];
			}
	  		if ( isset($valuesPla["fecha_defu"]) ) {
	  			$fec			= $valuesPla['fecha_defu'];
				$fecha_defu 		= date('d/m/Y', strtotime($fec));
			}
	  		$DESCRIPCION 		= $pladescripcion2." ".$pladescripcion1;	

			include 'Mostrar/R_seccionPlazas.php';


			$i++;
		$b++;
			}else{
			if ( isset($valuesPla[$b]["placve_mov"]) ) {
	  			$M			  		= $valuesPla[$b]['placve_mov'];
	  			$placve_mov 		= str_pad($M, 2, "0", STR_PAD_LEFT);
	  		}
	  		if ( isset($valuesPla[$b]["plamot_mov"]) ) {
	  			$MO1 				= $valuesPla[$b]['plamot_mov'];//10";
				$plamot_mov 		= str_pad($MO1, 2, "0", STR_PAD_LEFT);
			}
	  		if ( isset($valuesPla[$b]["plapartida"]) ) {
	  			$plapartida			= $valuesPla[$b]['plapartida'];
	  			if($plapartida=="0"){
	  				$plapartida = "";
	  			}
	  		}
	  		if ( isset($valuesPla[$b]["placod_pago"]) ) {
	  			$CODIGO_PAGO_MOV1	= $valuesPla[$b]['placod_pago'];
				$placod_pago 		= str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
				if($placod_pago=="0"){
	  				$placod_pago = "";
	  			}
			}
	  		if ( isset($valuesPla[$b]["plaunidad"]) ) {
	  			$plaunidad 			= $valuesPla[$b]['plaunidad'];
				if($plaunidad=="0"){
	  				$plaunidad = "";
	  			}  			
	  		}
	  		if ( isset($valuesPla[$b]["plasubunidad"]) ) {
	  			$plasubunidad 	    = $valuesPla[$b]['plasubunidad'];
				if($plasubunidad=="0"){
	  				$plasubunidad = "";
	  			}  			
	  		}
	  		if ( isset($valuesPla[$b]["placat_puesto"]) ) {
	  			$placat_puesto		= $valuesPla[$b]['placat_puesto'];
	  			if($placat_puesto=="NULL"){
	  				$placat_puesto = "";
	  			}
	  		}	
	  		if ( isset($valuesPla[$b]["plahoras"]) ) {
	  			$plahoras 			= $valuesPla[$b]['plahoras'];
				/*if($plahoras=="0"){
	  				$plahoras = "";
	  			}*/  			
	  		}
	  		if ( isset($valuesPla[$b]["placons_plaza"]) ) {
	  			$numero 			= $valuesPla[$b]['placons_plaza'];
				$placons_plaza 		= str_pad($numero, 6, "0", STR_PAD_LEFT);
			}
	  		if ( isset($valuesPla[$b]["plaqna_ini"]) ) {
	  			$plaqna_ini 		= $valuesPla[$b]['plaqna_ini'];
	  		}
	  		if ( isset($valuesPla[$b]["plaqna_fin"]) ) {
	  			$plaqna_fin 		= $valuesPla[$b]['plaqna_fin'];
	  		}
	  		if ( isset($valuesPla[$b]["planom_emp"]) ) {
	  			$planom_emp  		= "";//$valuesPla[$b]['planom_emp'];
				if($planom_emp == "NULL"){$planom_emp = "";}
			}
	  		if ( isset($valuesPla[$b]["plarfc"]) ) {
	  			$plarfc 			= "";//$valuesPla[$b]['plarfc'];
				if($plarfc == "NULL"){$plarfc = "";}
			}
	  		if ( isset($valuesPla[$b]["plamot_movsub"]) ) {
	  			$plamot_movsub 		= $valuesPla[$b]['plamot_movsub'];
	  			if($plamot_movsub == "NULL" || $plamot_movsub == "0"){$plamot_movsub = "";}
			}
	  		if ( isset($valuesPla[$b]["plaqna_inisub"]) ) {
				$plaqna_inisub 		= $valuesPla[$b]['plaqna_inisub'];
				if($plaqna_inisub == "NULL" || $plaqna_inisub == "0"){$plaqna_inisub = "";}
			}
	  		if ( isset($valuesPla[$b]["plaqna_finsub"]) ) {
	  			$plaqna_finsub		= $valuesPla[$b]['plaqna_finsub'];
				if($plaqna_finsub == "NULL" || $plaqna_finsub == "0"){$plaqna_finsub = "";}
			}
	  		if ( isset($valuesPla[$b]["planum_doctosub"]) ) {
	  			$planum_doctosub	= $valuesPla[$b]['planum_doctosub'];
				if($planum_doctosub == "NULL" || $planum_doctosub == "0"){$planum_doctosub = "";}
			}  		
	  		if ( isset($valuesPla[$b]["plactnvo"]) ) {
	  			$plactnvo			= $valuesPla[$b]['plactnvo'];
			}
	  		if ( isset($valuesPla[$b]["planivel_sueldonvo"]) ) {
				$planivel_sueldonvo	= $valuesPla[$b]['planivel_sueldonvo'];
				if($planivel_sueldonvo == "0"){$planivel_sueldonvo = "";}
			}
	  		if ( isset($valuesPla[$b]["plabasificacion"]) ) {
				$plabasificacion	= $valuesPla[$b]['plabasificacion'];
				if($plabasificacion=="0"){$plabasificacion="";}
			}
	  		if ( isset($valuesPla[$b]["plapromocion"]) ) {
	  			$plapromocion	 	= $valuesPla[$b]['plapromocion'];
				if($plapromocion=="0"){$plapromocion="";}	

			}
	  		if ( isset($valuesPla[$b]["plaqna_ing_sub"]) ) {	
	  			$plaqna_ing_sub		= $valuesPla[$b]['plaqna_ing_sub'];
				if($plaqna_ing_sub=="NULL" || $plaqna_ing_sub=="0"){$plaqna_ing_sub="";}	
			}
	  		if ( isset($valuesPla[$b]["descripcion1"]) ) {
	  			$pladescripcion1 	= $valuesPla[$b]['descripcion1'];                                 
			}
	  		if ( isset($valuesPla[$b]["descripcion2"]) ) {
	  			$pladescripcion2	= $valuesPla[$b]['descripcion2'];
			}
	  		if ( isset($valuesPla[$b]["fecha_defu"]) ) {
	  			$fec			= $valuesPla[$b]['fecha_defu'];
				$fecha_defu 		= date('d/m/Y', strtotime($fec));
			}
	  		$DESCRIPCION 		= $pladescripcion2." ".$pladescripcion1;	

			include 'Mostrar/R_seccionPlazas.php';


			$i++;
		$b++;
			}
	    }//fin 2do while getDatosPDF_Mov
	    
	    
	}//funcionmov

	/*---------------------------------------------------------CONSULTAS---------------------------------------------------------*/
	/*<---------------------------------------------------ANTECEDENTES----------------------------------------->*/
		$tot_resul_pre = 0;
	    $id_consultaFupPre =  95;//11//53
	    $JSONFupPre="[{\"num_docto\":\"$buscar\"}]";
	    $arrayFupPre = json_decode(json_encode($JSONFupPre), True);
	    $paramsFupPre = array('Resultado'=>$id_consultaFupPre, 'Argumento'=>$arrayFupPre, 'Accion'=>"select"); //para conseguir la consulta
	    //var_dump($paramsP);
	    $resultadosFupPre=$cliente->getConsulta($paramsFupPre);   
	    $arrayRFupPre= json_decode(json_encode($resultadosFupPre), True);
	    //var_dump($arrayRFupPre);
		$xmlFupPre = simplexml_load_string($arrayRFupPre['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$jsonFupPre = json_encode($xmlFupPre);
		$arrayFupPre = json_decode($jsonFupPre,TRUE);	    

	    if(!empty($arrayFupPre)){
			$valuespre = $arrayFupPre['NewDataSet']['table'];
			$valuespres = $arrayFupPre['NewDataSet'];
			//var_dump($valuescmp);
			if(!isset($valuespre[0])){
	        	$tot_resul_pre=count($valuespres);	
			}else{
				$tot_resul_pre=count($valuespre);				
			}				        	
		}
	   
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
		$xmlFupAcumulado = simplexml_load_string($arrayAcumulado['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$jsonFupAcumulado = json_encode($xmlFupAcumulado);
		$arrayFupAcumulado = json_decode($jsonFupAcumulado,TRUE);	    

	    if(!empty($arrayFupAcumulado)){
			$valuesx2 = $arrayFupAcumulado['NewDataSet']['table'];
			$valuesx2s = $arrayFupAcumulado['NewDataSet'];
			//var_dump($valuescmp);
			if(!isset($valuesx2[0])){
	        	$total_resP=count($valuesx2s);	
			}else{
				$total_resP=count($valuesx2);				
			}				        	
		}	    

	/*<---------------------------------------------------IMPORTES----------------------------------------->*/		        
	/*<---------------------------------------------------CMP----------------------------------------->*/			

			//if($cve_r == "3" || $cve_r == "4"){//0403CMP
		$tot_resul_cmp = 0;
		$id_consultaCMP =  189;//125
	    $JSONCMP="[{\"num_docto\":\"$buscar\"}]";
	    //$JSONCMP="[{\"num_docto\":\"$buscar\"}]";
	    $arrayRCMP = json_decode(json_encode($JSONCMP), True);
	    $paramsCMP = array('Resultado'=>$id_consultaCMP, 'Argumento'=>$arrayRCMP, 'Accion'=>"select"); //para conseguir la consulta
	    $resultadosCMP=$cliente->getConsulta($paramsCMP);
	    $arrayRsCMP= json_decode(json_encode($resultadosCMP), True); 
	    //var_dump($arrayRsCMP);
		$xmlFupCMP = simplexml_load_string($arrayRsCMP['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$jsonFupCMP = json_encode($xmlFupCMP);
		$arrayFupCMP = json_decode($jsonFupCMP,TRUE);	    

	    if(!empty($arrayFupCMP)){
			$valuescmp = $arraycmp['NewDataSet']['table'];
			$valuescmps = $arraycmp['NewDataSet'];
			//var_dump($valuescmp);
			if(!isset($valuescmp[0])){
	        	$tot_resul_cmp=count($valuescmps);	
			}else{
				$tot_resul_cmp=count($valuescmp);				
			}				        	  
	    }else{
	    	$tot_resul_cmp = 0;
	    }    	
			//}//0403CMP
			
	/*<---------------------------------------------------CMP----------------------------------------->*/	
	/*<---------------------------------------------------MOVIMIENTOS----------------------------------------->*/
		    $tot_resul_pla = 0;
		    $m=0;
		   	$cve_movOri = ""; 
		   	$mot_movOri = "";
		    $id_consultaPla =  96;//14
		    $JSONPla="[{\"num_docto\":\"$buscar\"}]";
		    $arrayPla = json_decode(json_encode($JSONPla), True);
		    $paramsPla = array('Resultado'=>$id_consultaPla, 'Argumento'=>$arrayPla, 'Accion'=>"select"); //para conseguir la consulta
		    //var_dump($paramsPla);
		    $resultadosPla=$cliente->getConsulta($paramsPla);  
		    $arrayMPla= json_decode(json_encode($resultadosPla), True);
		    //var_dump($arrayMPla);
			$xmlFupPla = simplexml_load_string($arrayMPla['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
			$jsonFupPla = json_encode($xmlFupPla);
			$arrayFupPla = json_decode($jsonFupPla,TRUE);	    
			//var_dump($arrayFupPla);
		    if(!empty($arrayFupPla)){
				$valuesPla = $arrayFupPla['NewDataSet']['table'];
				$valuesPlas = $arrayFupPla['NewDataSet'];
				//var_dump($valuescmp);
				if(!isset($valuesPla[0])){
		        	$tot_resul_pla=count($valuesPlas);	
					$cve_movOri   =$valuesPla["placve_mov"];
					$mot_movOri   =$valuesPla["plamot_mov"];
				}else{
					$tot_resul_pla=count($valuesPla);
					while ($m < $tot_resul_pla){	
						$cve_movOri=$valuesPla[$m]["placve_mov"];
						$mot_movOri=$valuesPla[$m]["plamot_mov"];	
						$m++;								
					}
				}				        	  		    
			}	
	if(($cve_movOri=="6" && $mot_movOri =="31") || ($cve_movOri=="6" && $mot_movOri =="33") || ($cve_movOri=="6" && $mot_movOri =="75")){
			$activo 		= "activo";
			$dia 			= "si";
	}else{
			$activo 		= "noactivo";
			$dia 			= "no";
	}
	if(($cve_movOri=="9" && $mot_movOri =="76" && $usuario=="angeles") || ($cve_movOri=="9" && $mot_movOri =="76" && $usuario=="veronica") ){
		echo " 
	    <script>
	     window.location='../index.php';
	    window.alert('El Número: ".$buscar." es un Cambio de CT y no se puede Imprimir Original');
	    window.close();
	    </script>";
	}
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
		$xmlFupTra = simplexml_load_string($arrayRTra['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
		$jsonFupTra = json_encode($xmlFupTra);
		$arrayFupTra = json_decode($jsonFupTra,TRUE);	    
		//var_dump($arrayFupTra);
	    if(!empty($arrayFupTra)){
			$valuesTra = $arrayFupTra['NewDataSet']['table'];
			$valuesTras = $arrayFupTra['NewDataSet'];
			//var_dump($valuescmp);
			if(!isset($valuesTras[0])){
	        	$tot_resul_tra=count($valuesTras);	
		    	$nom_area1 	   = $valuesTra['nombre_area'];
		    	$perpercurp1   = $valuesTra['curp'];
		    	$percaptura1   = $valuesTra['captura'];
			}				        	  		    
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
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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
							tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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
	if($dia=="si"){
						$pdf->AddPage();
						
						if($tot_resul_tra!=0){//tra!=0
							tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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
							mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,"noactivo");
						}//mov!=0

						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
						}	
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

						tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);

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
							tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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
								mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas1,$buscar,"noactivo");
							}elseif($tot_resul_pre>$tot_resul_pla && $tot_resul_pre<$LimiteM){//si ant > mov
								$filas1 = $tot_resul_pla - $filas;
								mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas1,$buscar,"noactivo");
							}

						}//mov!=0									

						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
						}								
	if($dia=="si"){
						$pdf->AddPage();
						
						if($tot_resul_tra!=0){//tra!=0
							tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
						}//tra!=0									
						if($tot_resul_pre!=0){//ant!=0
							$filas = $reccG - $tot_resul_pre%$LimiteM;	
							//ant($valuespre,$reccG,$dia,$pdf,$cliente,$filas,NULL);
							ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
							importe($valuesx2,$reccG,$filas,$pdf);
						}//ant!=0
						if($tot_resul_pla!=0){//mov!=0
							if($tot_resul_pre>$tot_resul_pla && $tot_resul_pla>$LimiteM){//si ant > mov
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
	}									
					}//reccG==tot_resul_pre	
				}//else
			}//inicio	
			
	/*--------------------------------------------------------------------------------------------------------------------------------*/
			if( $tot_resul_cmp<=5 && $tot_resul_pla == $tot_resul_pre){//$tot_resul_cmp<=5 && $tot_resul_pla > $tot_resul_pre

				if($reccG%$LimiteM==0){//$reccG%$LimiteM==0
					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
					}//tra!=0							
					//if($LimiteM<=$tot_resul_pre){
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
						mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,"noactivo");
					}//mov!=0								
					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
					}	
	if($dia=="si"){
					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
					}//tra!=0							
					//if($LimiteM<=$tot_resul_pre){
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
	}										
				}else{//else $reccG%$LimiteM==0
					if($reccG%$tot_glo==0){//reccG%tot_glo==0
						$pdf->AddPage();
						if($tot_resul_tra!=0){//tra!=0
							tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
						}//tra!=0	
						if($tot_resul_pre!=0){//ant!=0
							if($tot_resul_pre<$reccG){
								$filas = $reccG - $tot_resul_pre%$LimiteM;
								ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
								importe($valuesx2,$reccG,$filas,$pdf);
							}else{
								$filasA = $tot_resul_pre - ($tot_resul_pre%$LimiteA);
								ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasA,"importes",$buscar);
								importe($valuesx2,$tot_resul_pre,$filasA,$pdf);
							}	
						}//ant!=0
						if($tot_resul_pla!=0){//mov!=0
							$filas = $reccG - $tot_resul_pla%$LimiteM;
							mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,"noactivo");
						}//mov!=0										
						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
						}		

					if($dia=="si"){
						$pdf->AddPage();
						if($tot_resul_tra!=0){//tra!=0
							tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
						}//tra!=0	
						if($tot_resul_pre!=0){//ant!=0
							if($tot_resul_pre<$reccG){
								$filas = $reccG - $tot_resul_pre%$LimiteM;
								ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
								importe($valuesx2,$reccG,$filas,$pdf);
							}else{
								$filasA = $tot_resul_pre - ($tot_resul_pre%$LimiteA);
								ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasA,"importes",$buscar);
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
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
				}//tra!=0				

				if($tot_resul_pre<=$LimiteM){
					$filasAnt = $reccG - $reccG%$LimiteM;	
					ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasAnt,"importes",$buscar);
					importe($valuesx2,$tot_resul_pre,$filasAnt,$pdf);										
				}
				if($tot_resul_pla!=0){//mov!=0
					$filas = $reccG - $LimiteM;					
					mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas,$buscar,"noactivo");
				}//mov!=0	
	if($dia=="si"){
				$pdf->AddPage();
				
				if($tot_resul_cmp!=0){//cmp!=0
					$filas = $reccG - $LimiteC;		
					cmp($valuescmp,$reccG,$pdf,$filas,$cliente,$buscar);
				}	
				if($tot_resul_tra!=0){//tra!=0
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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
	}						
			}else{//$reccG%$LimiteC==0
				if($reccG%$tot_glo==0){//reccG%tot_glo==0
					$pdf->AddPage();
					
					if($tot_resul_cmp!=0){//cmp!=0
						$filas = $reccG - $tot_resul_cmp%$LimiteC;
						cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
					}
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
					}//tra!=0	
					if($tot_resul_pre!=0 && $tot_resul_pre > $LimiteM){//ant!=0
						$filas = $reccG - $tot_resul_pre%$LimiteM;
						ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
						importe($valuesx2,$reccG,$filas,$pdf);
					}//ant!=0
					if($tot_resul_pla!=0 && $tot_resul_pla > $LimiteM){//mov!=0
						$filas = $reccG - $tot_resul_pla%$LimiteM;
						mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,"noactivo");
					}//mov!=0		
	if($dia=="si"){
					$pdf->AddPage();
					
					if($tot_resul_cmp!=0){//cmp!=0
						$filas = $reccG - $tot_resul_cmp%$LimiteC;
						cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
					}
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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
	}						
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
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
				}//tra!=0				

				if($tot_resul_pre<=$LimiteM){
					$filasAnt = $reccG - $reccG%$LimiteM;	
					ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasAnt,"importes",$buscar);
					importe($valuesx2,$tot_resul_pre,$filasAnt,$pdf);										
				}
				if($tot_resul_pla!=0){//mov!=0
					$filas = $reccG - $LimiteM;					
					mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas,$buscar,"noactivo");
				}//mov!=0	
	if($dia=="si"){
				$pdf->AddPage();
				
				if($tot_resul_cmp!=0){//cmp!=0
					$filas = $reccG - $LimiteC;		
					cmp($valuescmp,$reccG,$pdf,$filas,$cliente,$buscar);
				}	
				if($tot_resul_tra!=0){//tra!=0
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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
	}						
			}else{//$reccG%$LimiteC==0
				if($reccG%$tot_glo==0){//reccG%tot_glo==0
					$pdf->AddPage();
					
					if($tot_resul_cmp!=0){//cmp!=0
						$filas = $reccG - $tot_resul_cmp%$LimiteC;
						cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
					}
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
					}//tra!=0	
					if($tot_resul_pre!=0 && $tot_resul_pre > $LimiteM){//ant!=0
						$filas = $reccG - $tot_resul_pre%$LimiteM;
						ant($valuespre,$reccG,$pdf,$cliente,$filas,"importes",$buscar);
						importe($valuesx2,$reccG,$filas,$pdf);
					}//ant!=0
					if($tot_resul_pla!=0 && $tot_resul_pla > $LimiteM){//mov!=0
						$filas = $reccG - $tot_resul_pla%$LimiteM;
						mov($valuesPla,$reccG,$percaptura1,$pdf,$cliente,$filas,$buscar,"noactivo");
					}//mov!=0	
	if($dia=="si"){
					$pdf->AddPage();
					
					if($tot_resul_cmp!=0){//cmp!=0
						$filas = $reccG - $tot_resul_cmp%$LimiteC;
						cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
					}
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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
	}							
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
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
				}//tra!=0				

				if($tot_resul_pre<=$LimiteM){
					$filasAnt = $reccG - $reccG%$LimiteM;	
					ant($valuespre,$tot_resul_pre,$pdf,$cliente,$filasAnt,"importes",$buscar);
					importe($valuesx2,$tot_resul_pre,$filasAnt,$pdf);										
				}
				if($tot_resul_pla!=0){//mov!=0
					$filas = $reccG - $LimiteM;					
					mov($valuesPla,$tot_resul_pla,$percaptura1,$pdf,$cliente,$filas,$buscar,"noactivo");
				}//mov!=0				
	if($dia=="si"){
				$pdf->AddPage();
				
				if($tot_resul_cmp!=0){//cmp!=0
					$filas = $reccG - $LimiteC;		
					cmp($valuescmp,$reccG,$pdf,$filas,$cliente,$buscar);
				}	
				if($tot_resul_tra!=0){//tra!=0
					tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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
	}			
			}else{//$reccG%$LimiteC==0
				if($reccG%$tot_glo==0){//reccG%tot_glo==0
					$pdf->AddPage();
					
					if($tot_resul_cmp!=0){//cmp!=0
						$filas = $reccG - $tot_resul_cmp%$LimiteC;
						cmp($valuescmp,$tot_resul_cmp,$pdf,$filas,$cliente,$buscar);
					}
					if($tot_resul_tra!=0){//tra!=0
						tra($valuesTra,$tot_resul_tra,$pdf,$cliente,$usuario,$FECHAD);
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

	  
	  

		$nom_area2 = trim($nom_area1);
		if($dia == "si"){
			//$pdf->Output('I',$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_COPIA_Fecha.pdf');
		    	$pdf->Output('I','../../FUPs/Masivo_ORIGINAL/'.$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_ORIGINAL_Fecha.pdf');
		    	$pdf->Output('F','../../FUPs/Masivo_ORIGINAL/'.$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_ORIGINAL_Fecha.pdf');
		}else{
			//$pdf->Output('I',$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_COPIA_Qna.pdf');
				$pdf->Output('I','../../FUPs/Masivo_ORIGINAL/'.$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_ORIGINAL_Qna.pdf');
				$pdf->Output('F','../../FUPs/Masivo_ORIGINAL/'.$nom_area2.'_'.$perpercurp1.'_'.$buscar.'_ORIGINAL_Qna.pdf');
		}

}else{
		echo " 
    <script>
     window.location='../index.php';
    window.alert('El Número: ".$buscar." no está Autorizado');
    window.close();
    </script>";
	}

?>