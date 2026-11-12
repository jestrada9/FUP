<?php
//2117274861
		ini_set("soap.wsdl_cache_enabled", "0");
		$meses = array("1","2","3","4","5","6","7","8","9","10","11","12");

		include '../../Cascaron/Cascaron.php';			
		include_once '../../Codigo_Barras/barcode.php';
		require_once('../../lib/nusoap.php');
		require_once('../../Conexion/wsdl.php'); 	
		
		$descargar = $_POST['descargar'];
		$docto_num = $_POST['valor'];
		$men = base64_decode($_POST['men']);
		$movs = base64_decode($_POST['movs']);
		$dia = base64_decode($_POST['dia']);
		$dias = base64_decode($_POST['dias']);//dia agregado por usuario
		$fec = base64_decode($_POST['fec']);//fec_imp agregado por usuario		
		$cve_r = $_POST['cve'];
		$pa = $_POST['pa'];
		$copiaUoriginal = "original";//$_POST['copiaUoriginal'];
		$observacion = $_POST['obs'];
		$operacion = $_POST['ops'];
		$usuario = "Paty";//$_POST['usu'];

		//Anexo
		$checA1 = base64_decode($_POST['checA1']);
		$checA2 = base64_decode($_POST['checA2']);
		$checA3 = base64_decode($_POST['checA3']);
		$checA4 = base64_decode($_POST['checA4']);
		$checA5 = base64_decode($_POST['checA5']);
		//Observaciones

		$checs1 = base64_decode($_POST['checO1']);
		$checs2 = base64_decode($_POST['checO2']);
		$checs3 = base64_decode($_POST['checO3']);
		$checs4 = base64_decode($_POST['checO4']);

		$FECHA  = date('d-m-Y', strtotime($fec));//date('d')."-".$meses[date('n')-1]. "-".date('Y') ;
		$FECHAD = date('Y-m-d', strtotime($fec));//date('Y')."-".$meses[date('n')-1]. "-".date('d') ;		

		$pdf=new PDF('L','mm','LEGAL');
		$pdf->SetAutoPageBreak(false);
		$pdf->StartPageGroup();
		//$pdf->SetProtection('print');

		function insertarBitacora($AREA_PLA,$docto_num,$OFICIO,$usuario,$operacion,$observacion,$cliente){
			//include 'F_Insert/Bitacora.php';
		}		
		function insertarFUPID($AREA_PLA,$docto_num,$Pagina,$cliente){
			//include 'F_Insert/FUPID4.php';
		}
		function insertarFUPPRE($arweas,$Valor2,$Pagina,$ID_PLA,$PDA,$CODIGO_PAGO,$UNIDAD,$SUBUNIDAD,$CATEGORIA,$HORAS2,$PLAZA,$ALTA,$CONCEPTO,$numero5,$DESDE,$HASTA,$Valor,$DR,$iDR,$DRqna_ini,$DRqna_fin,$DRnum_docto,$BS,$iBS,$BSqna_ini,$BSqna_fin,$BSnum_docto,    $I4,$iI4,$I4qna_ini,$I4qna_fin,$I4num_docto,$E3,$iE3,$E3qna_ini,$E3qna_fin,$E3num_docto,$cliente){
			//include 'F_Insert/FUPPRE.php';
		}	
		function insertarFUPCMP($AREA_PLA,$docto_num,$Pagina,$ID_PLA,$cmppartidaR1,$cmpcod_pagoR1,$cmpunidadR1,$cmpsubunidadR1,$cmpcat_puestoR1,$cmphorasR1,$cmpcons_plazaR1,$cmpimporteanteriorR1,$cmpqna_iniR1,$cmpqna_finR1,$cmpanio_procR1,$cmpfijoR1,$cmpprogramaR1,$cmpsubprogramaR1,$cmpproyectoR1,$cmpunidad_respR1,$cmpconceptoR1,$cmpabcR1,$cmpimportenuevoR11,$cmpjustificacionR11,$cliente){
			//include 'F_Insert/FUPCMP.php';
		}			
		function insertarFUPMOV($AREA_PLA,$docto_num,$Pagina,$ID_PLA,$TM,$MO,$CONS_DOC,$PARTIDA_MOV,$CODIGO_PAGO_MOV,$UNIDAD_MOV,$SUBUNIDAD_MOV,$CATEGORIA_MOV,$HORAS_MOV,$PLAZA_MOV,$DESDE_MOV,$HASTA_MOV,$NOMBRE_SUS_MOV1,$RFCSUS_MOV1,$MOT_MOVSUS1,$QNA_INISUS_MOV1,$QNA_FINSUS_MOV1,$NUM_DOCUMENTOSUS1,$CT_MOV,$NIVEL_SUELDO_NUEVO,$PLA_BASIFICACION,$PLA_PROMOCION,$PLAQNA_ING_SUB,$cliente){
			//include 'F_Insert/FUPPLA.php';
		}
		function insertarFUPPER($AREA_PER,$docto_num,$RFC,$NOMBRE_EMPLEADO,$EDO_NAC,$SEXO,$EDO_CIVIL,$CALLE,$LOCACION,$MUNICIPIO,$COD_POSTAL,$PUESTO,$QNA_INI_GOB,$QNA_ING_SEP,$numero1,$numero2,$PERQ,$PERA,$PERL,$PERT,$PERCT1,$PERHR1_,$PERCT2,$PERHR2_,$PERCT3,$PERHR3_,$PERCT4,$PERHR4_,$PERCT5,$PERHR5_,$PERCT6,$PERHR6_,$PERRFC_NUEVO,$cliente){
			//include 'F_Insert/FUPPER.php';
		}	
		function importe($importe_total,$pdf){
			$pdf->SetFont('Arial','',7);
			$pdf->SetXY(100,75); 
			$pdf->Cell(45,3,"$".number_format($importe_total,2),0,0,'L');
		}
		function oficio_capturo($OFICIO,$CAPTURO,$pdf){
			include 'Mostrar/oficio_capturo.php';
		}

		function Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal){
			if($copiaUoriginal=="original"){
				include 'Mostrar/anexos_observaciones.php';
			}else{
				include 'Mostrar/anexos_observaciones_copia.php';
			}
		}
		function info_autorizaciones($NOMBRE_EMPLEADO,$FECHA,$IMPRIMIO,$REVISO,$pdf,$copiaUoriginal,$usuario){//info_aurorizaciones
			if($copiaUoriginal=="original"){
				include 'Mostrar/pdfautorizaciones.php';
			}else{
				include 'Mostrar/pdfautorizaciones_copia.php';
			}			
		}//info_aurorizaciones
		function dia($dias,$docto_num,$cliente,$pdf,$num,$i){
			$onlyconsonants = str_replace("/", "-", $dias);
		    $date = date_create($dias);
		    //var_dump($date);
		    $DESDE_MOVf = date_format($date, 'Y-m-d');
		    $DESDE_MOVs = date_format($date, 'd/m/Y');	

			$id_consultaF1 = 	64;//año-mes-dia 64

			$metodo_consulta="ConsultaDia_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';				

			if($num==2){
			$pdf->SetXY(70,121+($i)+($i)+($i));//91  
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');
			}
			if($num==1){
			$pdf->SetXY(70,121+($i)+($i)+($i));  //121
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');
			}
			if($num==0){
			$pdf->SetXY(70,121+($i)+($i)+($i));//121
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(11,3,$DESDE_MOVs,0,0,'L');				
			}
	
			
		}
		function firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal){//copiaUoriginal){
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
				          	if($copiaUoriginal == "original"){//copiaUoriginal
				               $pdf->SetXY(90,$alto);
		                	   $pdf->MultiCell(85,42, $pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45),0,"C");
		                	   unlink("tempimg".$TEMPIMGLOC);
		                	}
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
				          	if($copiaUoriginal == "original"){//copiaUoriginal	
				              $pdf->SetXY(175,$alto);
				              $pdf->MultiCell(90,40, $pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45) ,0,"C");
				              unlink("tempimg1".$TEMPIMGLOC);
				          	}
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


function ant($valuesants,$tot_resul_ant,$dia,$pdf,$cliente,$filas,$retornar,$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario){//funcionant
			$ID_PLA = "1";
			
			$numinsert=0;
			//var_dump($valuesants[202]['_plaza']);
			$a = 0;
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
			$cts = array();
			$hrs = array();	

				
//var_dump($valuesants);
if($valuesants!=null){//undefined
		$resultados = $tot_resul_ant + 1;

		if($tot_resul_ant>10){
			$a=$filas*14;
			//$tot_resul_ant = $resultados;
		}/*else{
			$a=$filas*14;
		}*/

		while($a<=$tot_resul_ant*13){
			/*if ( isset($valuespres[$a+1]['prepartida']) ) {

			}*/
			$Cod_Pago1 =  $valuesants[$a+1]['_cod_pago'];
			$Unidad1 = 	  $valuesants[$a+2]['_unidad'];
			$Subunidad1 = $valuesants[$a+3]['_subunidad'];
			$Puesto1 = 	  $valuesants[$a+4]['_puesto'];
			$Horas1 = 	  $valuesants[$a+5]['_horas'];
			$Plaza1 = 	  $valuesants[$a+6]['_plaza'];
			$Mot_Mov1 =   $valuesants[$a+7]['_mot_mov'];
			$Nivel_Sdo1 = $valuesants[$a+8]['_nivel_sdo'];
			$Qna_Ini1 =   $valuesants[$a+9]['_qna_ini'];
			$Qna_Fin1 =   $valuesants[$a+10]['_qna_fin'];
			$Valor = 	  $valuesants[$a+11]['_num_doc'];
			$partida =    "NULL";//$value['Partida'];
			if($partida=="NULL"){
				$partida2 = "";
			}
			$CT_A1 = 	  $valuesants[$a+12]['_ct'];
			$Valor2= 	  $valuesants[$a+13]['_valor2'];
			$arweas = 	  $valuesants[$a+14]['_areas'];
			$CT_A = 	  str_pad($CT_A1, 4, "0", STR_PAD_LEFT);
			
			array_push($cts, $CT_A);
			array_push($hrs, $Horas1);
			

			$num_doctos = $num_doctos.$Valor2."','";
			$mot_movs = $mot_movs.$Mot_Mov1."','";	
			$qna_inis = $qna_inis.$Qna_Ini1."','";	
			$qna_finis = $qna_finis.$Qna_Fin1."','";

			$CODIGO_PAGO =  str_pad($Cod_Pago1, 2, "0", STR_PAD_LEFT);
			$UNIDAD = 	    $Unidad1;
			$SUBUNIDAD =    $Subunidad1;
			$CATEGORIA =    $Puesto1;
			$numero3 = 		$Horas1;
			$HORAS1 = 		str_pad($numero3, 2, "0", STR_PAD_LEFT);
			$HORAS = 		str_pad($HORAS1, 4, ".0", STR_PAD_RIGHT);
			$numero = 		$Plaza1;
			$PLAZA = 		str_pad($numero, 6, "0", STR_PAD_LEFT);
			$ALTA = 		$Mot_Mov1;
			$DESDE = 		$Qna_Ini1;
			$HASTA = 		$Qna_Fin1;
			$MOT_M = 		$Mot_Mov1;
			$PLAZAss = 		$PLAZAss.$Plaza1."','";
			$PDA=  			$partida;
			$PDA2=  			$partida2;

			$tam = strlen($num_doctos);
			$tam1 = strlen($mot_movs);
			$tam2 = strlen($qna_inis);
			$tam3 = strlen($qna_finis);
			$tam4 = strlen($PLAZAss);	

			$cadena1 = substr($num_doctos,0, $tam-3);
			$cadena2 = substr($mot_movs,0, $tam1-3);
			$cadena3 = substr($qna_inis,0, $tam2-3);
			$cadena4 = substr($qna_finis,0, $tam3-3);
			$cadena5 = substr($PLAZAss,0, $tam4-3);

		
			$id_consultaAT =  155;//concepto e importe

			$metodo_consulta="ConsultaConceptoImporte_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';			
		    //var_dump($arrayAT);
		    $A0T = 0;
			foreach($arrayAT as $valuessAT){
				$total_resAT=$valuessAT[0]["tot_resu"];
			 while($A0T <= $total_resAT*2){
			 	
				$importe_tot = $valuessAT[$A0T+3]["importe_total"];
				$importe_total = $importe_total + $importe_tot;
				$CONCEPTO = $valuessAT[$A0T+1]["conceptos"];
				$numero5 =  $valuessAT[$A0T+2]["importes"];
				$IMPORTE = number_format($numero5,2);

				$im = 0;//importe($importe_total,$pdf);
				//importe($importe_total,$pdf);
				$A0T = $A0T + 3;
				}
			}

/*<---------------------------------------------------Parte2----------------------------------------->*/	
			$DR = 'NULL';
			$iDR = "0.00";
			$DRqna_ini = "0";
			$DRqna_fin = "0";
			$DRnum_docto = "0"; 
			$BS = 'NULL';
			$iBS = "0.00";
			$BSqna_ini ="0";
			$BSqna_fin = "0";
			$BSnum_docto = "0";
			$I4 = 'NULL';
			$iI4 = "0.00";
			$I4qna_ini ="0";
			$I4qna_fin = "0";
			$I4num_docto ="0";
			$E3 = 'NULL';
			$iE3 = "0.00";
			$E3qna_ini = "0";
			$E3qna_fin = "0";
			$E3num_docto = "0";	
/*
			//parte2($rfc, $DESDE, $HASTA, $pdf, $cliente, $tot_reg, $tot_reg2, $arrayparte2);
			$id_consulta_Parte2 = 	185;//nuevo id
			$metodo_consulta="ConsultaParte2_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';	    	
			//var_dump($arrayR3_Parte2);
		    $recorrer = 0;
		    $columnas_c = 118;
		    $columnas_i = 128;
		    $columnas_qi = 138;
		    $columnas_qf = 148;
		    $columnas_nd = 160;

			$DR = 'NULL';
			$iDR = "0.00";
			$DRqna_ini = "0";
			$DRqna_fin = "0";
			$DRnum_docto = "0"; 
			$BS = 'NULL';
			$iBS = "0.00";
			$BSqna_ini ="0";
			$BSqna_fin = "0";
			$BSnum_docto = "0";
			$I4 = 'NULL';
			$iI4 = "0.00";
			$I4qna_ini ="0";
			$I4qna_fin = "0";
			$I4num_docto ="0";
			$E3 = 'NULL';
			$iE3 = "0.00";
			$E3qna_ini = "0";
			$E3qna_fin = "0";
			$E3num_docto = "0";	
			//var_dump($arrayR3_Parte2);
		    if(!empty($arrayR3_Parte2)){//!empty

			    $filas = 41.5 + ($tot_reg+$tot_reg+$tot_reg);
			    foreach ($arrayR3_Parte2 as $valueP2){//foreachP2


		    		$DR = $valueP2[1]['conceptosDR'];
		    		if($DR!=""){
			    		$DR 		 = $valueP2[1]['conceptosDR'];	
			    		$iDR 		 = $valueP2[2]['importesDR'];					
			    		$DRqna_ini	 = $valueP2[3]['qna_iniDR'];
			    		$DRqna_fin	 = $valueP2[4]['qna_finDR'];
			    		$DRnum_docto = $valueP2[5]['num_docDR'];

		    			acomodarRegistros($columnas_c,$filas,$DR,$pdf);
		    			acomodarRegistros($columnas_i,$filas,$iDR,$pdf);
		    			acomodarRegistros($columnas_qi,$filas,$DRqna_ini,$pdf);
		    			acomodarRegistros($columnas_qf,$filas,$DRqna_fin,$pdf);
		    			acomodarRegistros($columnas_nd,$filas,$DRnum_docto,$pdf);

			    		$columnas_c = $columnas_c + 55;
			    		$columnas_i = $columnas_i + 55;
			    		$columnas_qi = $columnas_qi + 55;
			    		$columnas_qf = $columnas_qf + 55;
			    		$columnas_nd = $columnas_nd + 55;	    			
	    			}else{
						$DR = 'NULL';
		    			$iDR = "0.00";
						$DRqna_ini = "0";
						$DRqna_fin = "0";
						$DRnum_docto = "0";    				
	    			}
					$BS = $valueP2[6]['conceptosBS'];						
	    			if($BS!=""){
			    		$BS 	 	 = $valueP2[6]['conceptosBS'];						
			    		$iBS 		 = $valueP2[7]['importesBS'];
			    		$BSqna_ini	 = $valueP2[8]['qna_iniBS'];
			    		$BSqna_fin	 = $valueP2[9]['qna_finBS'];
			    		$BSnum_docto = $valueP2[10]['num_docBS'];

			    		acomodarRegistros($columnas_c,$filas,$BS,$pdf);
		    			acomodarRegistros($columnas_i,$filas,$iBS,$pdf);
		    			acomodarRegistros($columnas_qi,$filas,$BSqna_ini,$pdf);
		    			acomodarRegistros($columnas_qf,$filas,$BSqna_fin,$pdf);
		    			acomodarRegistros($columnas_nd,$filas,$BSnum_docto,$pdf);	
		    			
		    			$columnas_c = $columnas_c + 55;
			    		$columnas_i = $columnas_i + 55;
			    		$columnas_qi = $columnas_qi + 55;
			    		$columnas_qf = $columnas_qf + 55;
			    		$columnas_nd = $columnas_nd + 55;
		    		}else{
						$BS = 'NULL';
						$iBS = "0.00";
						$BSqna_ini ="0";
						$BSqna_fin = "0";
						$BSnum_docto = "0";

		    		}	
		    		$I4 = $valueP2[11]['conceptosI4'];	
		    		if($I4!=""){	    		
			    		$I4 		 = $valueP2[11]['conceptosI4'];						
			    		$iI4 		 = $valueP2[12]['importesI4'];
			    		$I4qna_ini	 = $valueP2[13]['qna_iniI4'];
			    		$I4qna_fin	 = $valueP2[14]['qna_finI4'];
			    		$I4num_docto = $valueP2[15]['num_docI4'];
						    		
			    		acomodarRegistros($columnas_c,$filas,$I4,$pdf);
		    			acomodarRegistros($columnas_i,$filas,$iI4,$pdf);
		    			acomodarRegistros($columnas_qi,$filas,$I4qna_ini,$pdf);
		    			acomodarRegistros($columnas_qf,$filas,$I4qna_fin,$pdf);
		    			acomodarRegistros($columnas_nd,$filas,$I4num_docto,$pdf);	

			    		$columnas_c = $columnas_c + 55;
			    		$columnas_i = $columnas_i + 55;
			    		$columnas_qi = $columnas_qi + 55;
			    		$columnas_qf = $columnas_qf + 55;
			    		$columnas_nd = $columnas_nd + 55;	
		    		}else{
						$I4 = 'NULL';
						$iI4 = "0.00";
						$I4qna_ini ="0";
						$I4qna_fin = "0";
						$I4num_docto ="0";

		    		} 
		    		$E3 = $valueP2[16]['conceptosE3'];
		    		if($E3!=""){   							    		
			    		$E3 		 = $valueP2[16]['conceptosE3'];						
			    		$iE3 		 = $valueP2[17]['importesE3'];
			    		$E3qna_ini	 = $valueP2[18]['qna_iniE3'];
			    		$E3qna_fin	 = $valueP2[19]['qna_finE3'];
			    		$E3num_docto = $valueP2[20]['num_docE3'];		
					    		
			    		acomodarRegistros($columnas_c,$filas,$E3,$pdf);
		    			acomodarRegistros($columnas_i,$filas,$iE3,$pdf);
		    			acomodarRegistros($columnas_qi,$filas,$E3qna_ini,$pdf);
		    			acomodarRegistros($columnas_qf,$filas,$E3qna_fin,$pdf);
		    			acomodarRegistros($columnas_nd,$filas,$E3num_docto,$pdf);					    		
	    			}else{
						$E3 = 'NULL';
						$iE3 = "0.00";
						$E3qna_ini = "0";
						$E3qna_fin = "0";
						$E3num_docto = "0";		    				
	    			}
		    }//foreachP2	
		}//!empty	 		
*/
		$Pagina = $pdf->PageNo();
/*
		//aqui
		if($Nivel_Sdo1==4){
			$CONCEPTO1 = "7A";
			$CONCEPTO  = "7A";
		}
		if($Nivel_Sdo1==5){
			$CONCEPTO1 = "7B";
			$CONCEPTO  = "7B";
		}
		if($Nivel_Sdo1==6){
			$CONCEPTO1 = "BC";
			$CONCEPTO  = "BC";
		}
		if($Nivel_Sdo1==7){
			$CONCEPTO1 = "7C";
			$CONCEPTO  = "7C";
		}
		if($Nivel_Sdo1==8){
			$CONCEPTO1 = "7D";
			$CONCEPTO  = "7D";
		}
		if($Nivel_Sdo1==9){
			$CONCEPTO1 = "7E";
			$CONCEPTO  = "7E";
		}	
*/											
		include 'Mostrar/pdfant_manual.php';	
		//var_dump($CONCEPTO);
		if($PDA=="NULL"){
			$PDA = "0";
		}
		if($CONCEPTO==""){
			$CONCEPTO1 =  " ";
		}else{

			$CONCEPTO1 = $CONCEPTO;
		
		}
		if($numero5==""){
			$numero6 = "0.00";
		}else{

			$numero6 = $numero5;
		
		}
/*<---------------------------------------------------Parte2----------------------------------------->*/	
			
		if($dia!="si"){
			//if($copiaUoriginal=="original"){
				insertarFUPPRE($arweas,$Valor2,$Pagina,$ID_PLA,$PDA,$CODIGO_PAGO,$UNIDAD,$SUBUNIDAD,$CATEGORIA,$HORAS1,$Plaza1,$ALTA,$CONCEPTO1,$numero6,$DESDE,$HASTA,$Valor,$DR,$iDR,$DRqna_ini,$DRqna_fin,$DRnum_docto,$BS,$iBS,$BSqna_ini,$BSqna_fin,$BSnum_docto,$I4,$iI4,$I4qna_ini,$I4qna_fin,$I4num_docto,$E3,$iE3,$E3qna_ini,$E3qna_fin,$E3num_docto,$cliente);
			//}
		}	
			



			$t++;
			$a = $a+14;
			$tot_reg++;
	}//inicio_while*/
}//undefined
/*------------------------------------------------TRABAJADOR------------------------------------------------*/				
$y = 0;
	        while ($y <= $tot_resul_tra*20){ //2do while getDatosPDF
	        	//if($y==21){
	        		
			    $code1 = 			$valuestra[$y+1]["cpr"];
			    $CURP = 			$valuestra[$y+2]["curp"];
				$NUM_DOCUMENTO= 	$valuestra[$y+3]['num_doctoT'];
				$RFC= 				$valuestra[$y+4]['rfc'];
				$NOMBRE_EMPLEADO= 	htmlspecialchars_decode($valuestra[$y+5]['nom_emp']);
				$EDO_NAC=			$valuestra[$y+6]['edo_nac'];
				$SEXO= 				$valuestra[$y+7]['sexo'];
				$EDO_CIVIL= 		$valuestra[$y+8]['edo_civil'];
				$DOMICILIO=			"PARTICULAR";
				$CALLE= 			htmlspecialchars_decode($valuestra[$y+9]['emp_dom']);
				$COD_POSTAL= 		$valuestra[$y+10]['emp_dom_cp'];
				$LOCACION1= 		$valuestra[$y+11]['emp_dom_col'];
				$LOCACION= 			htmlspecialchars_decode($LOCACION1);
				$MUNICIPIO1= 		$valuestra[$y+12]['emp_dom_pob'];
				$MUNICIPIO= 		htmlspecialchars_decode($MUNICIPIO1);
				$PUESTO=  			$valuestra[$y+13]['puesto'];
				$QNA_INI_GOB= 		$valuestra[$y+14]['qna_ing_gob'];
				$QNA_ING_SEP= 		$valuestra[$y+15]['qna_ing_sep'];
				$numero1 =  		$valuestra[$y+16]['num_tit'];
				$NUM_TITULO = 		str_pad($numero1, 9, "0", STR_PAD_LEFT);
				$numero2 =  		$valuestra[$y+17]['num_lic'];
				$NUM_LICENCIATURA = str_pad($numero2, 9, "0", STR_PAD_LEFT);
				$LICENCIATURA=		"";//"LIC.";
				$TITULO=			"";//"TIT.";
				$MA=				"";//"MA.";
				$DO=				"";//"DO.";
				$CT= 				$valuestra[$y+18]['ct'];
				$IMPRIMIO= "";//"IMPRIMIO";
				$REVISO= "";//"REVISO";
				$nom_area= 						$valuestra[$y+20]['nom_area'];
				$AREA_PER= 						$valuestra[$y+21]['area_per'];
				$RAMA="";//$AREA_PER;
				$NUM_DOCTO_cpr = substr($docto_num,4,10);
				$CURP_cpr = substr($CURP,15,18);
				$CPR1 = $CURP_cpr.$NUM_DOCTO_cpr;
				$code = $CPR1;
			//}	
				$y = $y + 21;
			}//2do while getDatosPDF

		include 'Mostrar/pdftra.php';

	    $PERQ = "NULL";
		$PERA = "NULL";
		$PERL = "NULL";
		$PERT = "NULL";
		$PERCT1 = "NULL";
		$PERHR1_ = "NULL";

		$PERCT2 = "NULL";
		$PERHR2_ = "NULL";
		$PERCT3 = "NULL";
		$PERHR3_ = "NULL";
		$PERHR3 = "";
		$PERCT4 = "NULL";
		$PERHR4_ = "NULL";
		$PERCT5 = "NULL";
		$PERHR5_ = "NULL";
		$PERCT6 = "NULL";
		$PERHR6_ = "NULL";
		$PERRFC_NUEVO = "NULL";


		$pre = 0;
		//var_dump($cts);
		foreach($cts as $valuex_pre){
		  $total_res_pre = count($cts)-1;
			while ($pre <= $total_res_pre){	
				if($pre == 0){
				$PERCT1 = $cts[$pre];
				if($PERCT1 == ""){
					$PERCT1 = "NULL";
				}
				else{
					$PERCT1 = "'".$cts[$pre]."'";
				}
				}
				if($pre == 1){
				$PERCT2 = $cts[$pre];
				if($PERCT2 == ""){
					$PERCT2 = "NULL";
				}
				else{
					$PERCT2 = "'".$cts[$pre]."'";
				}
				}
				if($pre == 2){
				$PERCT3 = $cts[$pre];
								if($PERCT2 == ""){
					$PERCT3 = "NULL";
				}
				else{
					$PERCT3 = "'".$cts[$pre]."'";
				}
				}
				if($pre == 3){
				$PERCT4 = $cts[$pre];
								if($PERCT2 == ""){
					$PERCT4 = "NULL";
				}
				else{
					$PERCT4 = "'".$cts[$pre]."'";
				}
				}
				if($pre == 4){
				$PERCT5 = $cts[$pre];
								if($PERCT2 == ""){
					$PERCT5 = "NULL";
				}
				else{
					$PERCT5 = "'".$cts[$pre]."'";
				}
				}
				if($pre == 5){
				$PERCT6 = $cts[$pre];
				if($PERCT2 == ""){
					$PERCT6 = "NULL";
				}
				else{
					$PERCT6 = "'".$cts[$pre]."'";
				}
				}
				$pre = $pre + 1;
			}
		}
		$prehrs = 0;
		foreach($hrs as $valuex_prehrs){

		  $total_res_prehrs = count($hrs)-1;
			while ($prehrs <= $total_res_prehrs){	
				if($prehrs == 0){
				$PERHR1_ = $hrs[$prehrs];
				}
				if($prehrs == 1){
				$PERHR2_ = $hrs[$prehrs];
				}
				if($prehrs == 2){
				$PERHR3_ = $hrs[$prehrs];
				}
				if($prehrs == 3){
				$PERHR4_ = $hrs[$prehrs];
				}
				if($prehrs == 4){
				$PERHR5_ = $hrs[$prehrs];
				}
				if($prehrs == 5){
				$PERHR6_ = $hrs[$prehrs];
				}
				$prehrs = $prehrs + 1;
			}
		}

		info_autorizaciones($NOMBRE_EMPLEADO,$FECHA,$IMPRIMIO,$REVISO,$pdf,$copiaUoriginal,$usuario);
		 
		if($pdf->PageNo()==1){
			if($dia!="si"){
				if($copiaUoriginal=="original"){
					insertarFUPPER($AREA_PER,$docto_num,$RFC,$NOMBRE_EMPLEADO,$EDO_NAC,$SEXO,$EDO_CIVIL,$CALLE,$LOCACION,$MUNICIPIO,$COD_POSTAL,$PUESTO,$QNA_INI_GOB,$QNA_ING_SEP,$numero1,$numero2,$PERQ,$PERA,$PERL,$PERT,$PERCT1,$PERHR1_,$PERCT2,$PERHR2_,$PERCT3,$PERHR3_,$PERCT4,$PERHR4_,$PERCT5,$PERHR5_,$PERCT6,$PERHR6_,$PERRFC_NUEVO,$cliente);
				}
			}
		}	
/*------------------------------------------------TRABAJADOR------------------------------------------------*/	
	
	$DOC_OBSRV1_ = str_replace(array('"',"'"), '\"', $checs1);
	$DOC_OBSRV2_ = str_replace(array('"',"'"), '\"', $checs2);
	$DOC_OBSRV3_ = str_replace(array('"',"'"), '\"', $checs3);
	$DOC_OBSRV4_ = str_replace(array('"',"'"), '\"', $checs4,$dia);

	$DOC_ANEXA1_ = str_replace(array('"',"'"), '\"', $checA1);
	$DOC_ANEXA2_ = str_replace(array('"',"'"), '\"', $checA2);
	$DOC_ANEXA3_ = str_replace(array('"',"'"), '\"', $checA3);
	$DOC_ANEXA4_ = str_replace(array('"',"'"), '\"', $checA4);
	$DOC_ANEXA5_ = str_replace(array('"',"'"), '\"', $checA5);

	if($DOC_OBSRV1_== ""){$DOC_OBSRV1_ = "NULL";}
	if($DOC_OBSRV2_== ""){$DOC_OBSRV2_ = "NULL";}
	if($DOC_OBSRV3_== ""){$DOC_OBSRV3_ = "NULL";}
	if($DOC_OBSRV4_== ""){$DOC_OBSRV4_ = "NULL";}

	if($DOC_ANEXA1_== ""){$DOC_ANEXA1_ = "NULL";}
	if($DOC_ANEXA2_== ""){$DOC_ANEXA2_ = "NULL";}
	if($DOC_ANEXA3_== ""){$DOC_ANEXA3_ = "NULL";}
	if($DOC_ANEXA4_== ""){$DOC_ANEXA4_ = "NULL";}
	if($DOC_ANEXA5_== ""){$DOC_ANEXA5_ = "NULL";}

	$DOC_ANEXA1_M = strtoupper(utf8_encode($DOC_ANEXA1_));
	$DOC_ANEXA2_M = strtoupper(utf8_encode($DOC_ANEXA2_));
	$DOC_ANEXA3_M = strtoupper(utf8_encode($DOC_ANEXA3_));
	$DOC_ANEXA4_M = strtoupper(utf8_encode($DOC_ANEXA4_));
	$DOC_ANEXA5_M = strtoupper(utf8_encode($DOC_ANEXA5_));

	$DOC_OBSRV1_M = strtoupper(utf8_encode($DOC_OBSRV1_));
	$DOC_OBSRV2_M = strtoupper(utf8_encode($DOC_OBSRV2_));
	$DOC_OBSRV3_M = strtoupper(utf8_encode($DOC_OBSRV3_));
	$DOC_OBSRV4_M = strtoupper(utf8_encode($DOC_OBSRV4_));


	/*
	$id_consultaDOCS = 	136;
	$metodo_consulta="ConsultaDocs_Original1";
	include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
	*/
	if($retornar=="importes"){
		return $importe_total;
	}
}//funcionant


		function cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,$copiaUoriginal){//funcioncmp
			//var_dump($valuescmp);
			
			$ID_PLA = "1";
			$pdfC = 0;
			$cmp=0; 
		    $i=0;
		    include 'Mostrar/encabezadoscmp.php';
		    
	 		while($pdfC<=$tot_resul_cmp*14){//whilecmp
				$cmparea      			= "NULL";//$valuescmp[$pdfC+1]["partida_cmp"];	
				$cmppartida      		= $valuescmp[$pdfC+1]["partida_cmp"];
	            if($cmppartida==0){
	            	$cmppartida = "";
	            	$cmppartidaR1 = "NULL";
	            }else{
	            	$cmppartidaR1    		= str_pad($cmppartida, 4, "0", STR_PAD_LEFT);
	            	$cmppartida    		= str_pad($cmppartida, 4, "0", STR_PAD_LEFT);
	            }
	            $cmpcod_pago 	   		= $valuescmp[$pdfC+2]["cod_pago_cmp"];
	            if($cmpcod_pago==0){
	             	$cmpcod_pago = "";
	             	$cmpcod_pagoR1 = "NULL";
	            }else{
	            	$cmpcod_pagoR1   		= str_pad($cmpcod_pago, 2, "0", STR_PAD_LEFT);
	            	$cmpcod_pago   		= str_pad($cmpcod_pago, 2, "0", STR_PAD_LEFT);
	            }
	            $cmpunidad       		= $valuescmp[$pdfC+3]["unidad_cmp"];
	            if($cmpunidad==0){
	            	$cmpunidad = "";
	            	$cmpunidadR1 = "NULL";
	            }else{
	            	$cmpunidadR1     		= str_pad($cmpunidad, 2, "0", STR_PAD_LEFT);
	            	$cmpunidad     		= str_pad($cmpunidad, 2, "0", STR_PAD_LEFT);
	            }
	            $cmpsubunidad    		= $valuescmp[$pdfC+4]["subunidad_cmp"];
	            if($cmpsubunidad==0){
	            	$cmpsubunidad = "";
	            	$cmpsubunidadR1 = "NULL";
	            }else{
	            	$cmpsubunidadR1  		= str_pad($cmpsubunidad, 2, "0", STR_PAD_LEFT);
	            	$cmpsubunidad  		= str_pad($cmpsubunidad, 2, "0", STR_PAD_LEFT);
	            }
	            $cmpcat_puesto = $valuescmp[$pdfC+5]["cat_puesto_cmp"];
	            if($cmpcat_puesto=="" || $cmpcat_puesto=="       " || $cmpcat_puesto=="NULL"){
	            	$cmpcat_puesto 	 = "";
	            	$cmpcat_puestoR1 = "NULL";
	            }else{
	            	$cmpcat_puestoR1 	= $valuescmp[$pdfC+5]["cat_puesto_cmp"];
	            	$cmpcat_puesto	 	= $valuescmp[$pdfC+5]["cat_puesto_cmp"];
	            }
	            $cmphoras        		= $valuescmp[$pdfC+6]["horas_cmp"];
	            if($cmpsubunidad==0 && $cmphoras==0.0){
	            	$cmphoras = "";
	            	$cmphorasR1 = 0;
	            }else{
	            	$cmphorasR1      		= str_pad($cmphoras, 2, "0", STR_PAD_LEFT);
	            	$cmphoras = str_pad($cmphoras, 2, "0", STR_PAD_LEFT);
	            }

	            $cmpcons_plaza 		= $valuescmp[$pdfC+7]["cons_plaza_cmp"];
	            if($cmpcons_plaza=="" || $cmpcons_plaza==0){
	            	$cmpcons_plazaR1 = "NULL";
	            	$cmpcons_plaza="";
	            }else{
	            	$cmpcons_plazaR1 		= $valuescmp[$pdfC+7]["cons_plaza_cmp"];
	            	$cmpcons_plaza 	= $valuescmp[$pdfC+7]["cons_plaza_cmp"];
	            }
	            $cmpperc_ded 			= $valuescmp[$pdfC+8]["perc_ded_cmp"]; 
				$cmpconcepto 			= $valuescmp[$pdfC+9]["concepto_cmp"];
				if($cmpconcepto==""){
					$cmpconcepto="";
					$cmpconceptoR1 = "NULL";
				}else{
					$cmpconceptoR1 			= $valuescmp[$pdfC+9]["concepto_cmp"];
					$cmpconcepto 			= $valuescmp[$pdfC+9]["concepto_cmp"];
				}
				$cmpabc 				= $valuescmp[$pdfC+10]["abc_cmp"];
				if($cmpabc==""){
					$cmpabc = "";
					$cmpabcR1="NULL";
				}else{
					$cmpabcR1 				= $valuescmp[$pdfC+10]["abc_cmp"];
					$cmpabc = $valuescmp[$pdfC+10]["abc_cmp"];
					if($cmpabcR1 == "A"){	$cmpabcR1 = "ALTA"; }
		            if($cmpabcR1 == "B"){	$cmpabcR1 = "BAJA"; }
		            if($cmpabc == "A"){	$cmpabc = "ALTA"; }
		            if($cmpabc == "B"){	$cmpabc = "BAJA"; }
				}
	            $cmpimporteanterior 	= $valuescmp[$pdfC+11]["importeanterior_cmp"];//actual
	            if($cmpimporteanterior == "0" || $cmpimporteanterior==""){
	            	$cmpimporteanterior = 0.0;
	            	$cmpimporteanteriorR1 = "0";
	            }else{
	            	$cmpimporteanteriorR1 	= $valuescmp[$pdfC+11]["importeanterior_cmp"];
	            	$cmpimporteanterior 	= $valuescmp[$pdfC+11]["importeanterior_cmp"];
	            }
	            $cmpimportenuevo 	= $valuescmp[$pdfC+12]["importenuevo_cmp"];//inc
	            if($cmpimportenuevo==0 || $cmpimportenuevo==""){
	            	$cmpimportenuevo = 0.0;
	            	$cmpimportenuevoR11 = 0;
	            	$nombre_format = 0.00;
	            }else{
	            	$cmpimportenuevoR11 	= $valuescmp[$pdfC+12]["importenuevo_cmp"];
	            	$cmpimportenuevo 	= $valuescmp[$pdfC+12]["importenuevo_cmp"];
	            	$nombre_format 			= number_format($cmpimportenuevoR11,2);	 
	            }
	           
				$cmpqna_ini 			= $valuescmp[$pdfC+13]["qna_ini_cmp"];
				if($cmpqna_ini == ""){
					$cmpqna_ini = "";
					$cmpqna_iniR1 = 0;
				}else{
					$cmpqna_iniR1 			= $valuescmp[$pdfC+13]["qna_ini_cmp"];
					$cmpqna_ini 			= $valuescmp[$pdfC+13]["qna_ini_cmp"];
				}
	            $cmpqna_fin			= $valuescmp[$pdfC+14]["qna_fin_cmp"];
	            if($cmpqna_fin==""){
	            	$cmpqna_fin = "";
	            	$cmpqna_finR1=0;
	            }else{
	            	$cmpqna_finR1 			= $valuescmp[$pdfC+14]["qna_fin_cmp"];
	            	$cmpqna_fin 			= $valuescmp[$pdfC+14]["qna_fin_cmp"];
	            }
	            $cmpjustificacion  	= $valuescmp[$pdfC+15]["justificacion_cmp"];
	            if($cmpjustificacion==""){
	            	$$cmpjustificacion="";
	            	$cmpjustificacionR11="NULL";
	            }
	            else{
	            	$cmpjustificacionR11 	= "ESTIMULO POR ANTIGUEDAD, 40 AÑOS DE SERVICIO.";//utf8_decode($cmpjustificacion);
	            	$cmpjustificacion 	= utf8_decode($cmpjustificacion);
	            }	            
				if($cmpimportenuevo=="" && $cmpimporteanterior=="" || $cmpimportenuevo==0 && $cmpimporteanterior==0){
					$cmpAutorizado1 = 0.0;
				}else{
					$cmpAutorizado = $cmpimportenuevoR11 - $cmpimporteanteriorR1;
					$cmpimportenuevoR11 = $cmpimportenuevoR11 - $cmpimporteanteriorR1;
					$cmpAutorizado1 = number_format($cmpimportenuevoR11,2);	
				}
	            
	            /*if($cmpAutorizado!="0"){
	            	 	
	            }*/
	            
	            //$cmpAutorizado 		= "0.00";

				include 'Mostrar/pdfcmp.php';

	            $cmpanio_procR1 = "NULL";
	            $cmpfijoR1 = "NULL";
	            $cmpprogramaR1 = "NULL";
	            $cmpsubprogramaR1 = "NULL";
	            $cmpproyectoR1 = "NULL";
	            $cmpunidad_respR1 = "NULL";

				$Pagina = $pdf->PageNo();
				
				if($dia!="si"){
					//if($copiaUoriginal=="original"){
						insertarFUPCMP($cmparea,$docto_num,$Pagina,$ID_PLA,$cmppartidaR1,$cmpcod_pagoR1,$cmpunidadR1,$cmpsubunidadR1,$cmpcat_puestoR1,$cmphorasR1,$cmpcons_plazaR1,$cmpimporteanteriorR1,$cmpqna_iniR1,$cmpqna_finR1,$cmpanio_procR1,$cmpfijoR1,$cmpprogramaR1,$cmpsubprogramaR1,$cmpproyectoR1,$cmpunidad_respR1,$cmpconceptoR1,$cmpabcR1,$cmpimportenuevoR11,$cmpjustificacionR11,$cliente);
					//}
				}

				$pdfC = $pdfC + 15;
			  	$cmp++;
				}//whilecmp
				
		}//funcioncmp


	if($pa==1){//pa==1	
		function mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion){//funcionm,$diasov
			$OFICIO="";
			$CAPTURO=""; 
			$AREA_PLA=""; 
			$Pagina = 0;
			$ID_PLA = "1";
			$NOMBRE_SUS_MOV1="";
			$RFCSUS_MOV1="";
			$MOT_MOVSUS1="";
			$QNA_INISUS_MOV1="";
			$QNA_FINSUS_MOV1="";
			$NUM_DOCUMENTOSUS1="";
			$b=0;
			$i=0;
			$e = $tot_resul_mov + 1;

			if($tot_resul_mov>10){
				
				$b=$filas*24;//330;//($tot_resul_mov*33)
				//$tot_resul_mov = $e;
			}
			
		  	while ($b <= $tot_resul_mov*23){//$total_res*30 //2do while getDatosPDF_Mov
				$M= 					$valuesmov[$b+1]['cve_movM'];
				$TM = 					str_pad($M, 2, "0", STR_PAD_LEFT);
				$MO1= 					$valuesmov[$b+2]['mot_movM'];//10";
				$MO = 					str_pad($MO1, 2, "0", STR_PAD_LEFT);
				$PARTIDA_MOV= 			$valuesmov[$b+3]['partidaM'];
				if($PARTIDA_MOV==""){
					$PARTIDA_MOV = "NULL";
					$PARTIDA_MOVR = "";
				}else{
					$PARTIDA_MOV = $valuesmov[$b+3]['partidaM'];
					$PARTIDA_MOVR = $valuesmov[$b+3]['partidaM'];
				}
				$CODIGO_PAGO_MOV1= 		$valuesmov[$b+4]['cod_pagoM'];
				if($CODIGO_PAGO_MOV1==00 || $CODIGO_PAGO_MOV1 == ""){
					$CODIGO_PAGO_MOV = "NULL";
					$CODIGO_PAGO_MOVR = "";
				}else{
					$CODIGO_PAGO_MOV =      str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
					$CODIGO_PAGO_MOVR =      str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
				}
				$UNIDAD_MOV= 			$valuesmov[$b+5]['unidadM'];
				if($UNIDAD_MOV == 0){
					$UNIDAD_MOV = "NULL";
					$UNIDAD_MOVR = "";
				}else{
					$UNIDAD_MOV = $valuesmov[$b+5]['unidadM'];
					$UNIDAD_MOVR = $valuesmov[$b+5]['unidadM'];
				}				
				$SUBUNIDAD_MOV= 		$valuesmov[$b+6]['subunidadM'];
				if($SUBUNIDAD_MOV == 0){
					$SUBUNIDAD_MOV = "NULL";
					$SUBUNIDAD_MOVR = "";
				}else{
					$SUBUNIDAD_MOV = $valuesmov[$b+6]['subunidadM'];
					$SUBUNIDAD_MOVR = $valuesmov[$b+6]['subunidadM'];
				}				
				$CATEGORIA_MOV= 		$valuesmov[$b+7]['cat_puestoM'];
				if($CATEGORIA_MOV == ""/* || $CATEGORIA_MOV = "       "*/){
					$CATEGORIA_MOV = "NULL";
					$CATEGORIA_MOVR = "";
				}else{
					$CATEGORIA_MOV = $valuesmov[$b+7]['cat_puestoM'];
					$CATEGORIA_MOVR = $valuesmov[$b+7]['cat_puestoM'];
				}				
				$HORAS_MOV =  			$valuesmov[$b+8]['horasM'];
				if($SUBUNIDAD_MOV==0 && $HORAS_MOV == 0.0){
					$HORAS_MOV = 0;
					$HORAS_MOVR = 0.0;
				}else{
					$HORAS_MOV = $valuesmov[$b+8]['horasM'];
					$HORAS_MOVR = $valuesmov[$b+8]['horasM'];
				}				
				$numero =  				$valuesmov[$b+9]['cons_plazaM'];
				$PLAZA_MOV = 			str_pad($numero, 6, "0", STR_PAD_LEFT);
				if($PLAZA_MOV==000000){
					$PLAZA_MOV = "NULL";
					$PLAZA_MOVR = "";
				}else{
					$PLAZA_MOV = str_pad($numero, 6, "0", STR_PAD_LEFT);;
					$PLAZA_MOVR = str_pad($numero, 6, "0", STR_PAD_LEFT);
				}				
				$DESDE_MOV= 			$valuesmov[$b+10]['qna_ini_empM'];
				$HASTA_MOV= 			$valuesmov[$b+11]['qna_fin_empM'];
				$NOMBRE_SUS_MOV =  		"";//$valuesmov[$b+12]['nom_empsusM'];
				if($NOMBRE_SUS_MOV == "" ){$NOMBRE_SUS_MOV = "NULL";}
				if($NOMBRE_SUS_MOV == "NULL" ){$NOMBRE_SUS_MOV1 = "";}else{$NOMBRE_SUS_MOV1 =  		"";}//$valuesmov[$b+12]['nom_empsusM'];}
				$RFCSUS_MOV =  			"";//$valuesmov[$b+13]['rfcsusM'];
				if($RFCSUS_MOV == ""){$RFCSUS_MOV = "NULL";}
				if($RFCSUS_MOV == "NULL" ){$RFCSUS_MOV1 = "";}else{$RFCSUS_MOV1 =  		"";}//$valuesmov[$b+13]['rfcsusM'];}
				$MOT_MOVSUS =  			$valuesmov[$b+14]['mot_movsusM'];
				if($MOT_MOVSUS == ""){$MOT_MOVSUS = "NULL";}
				if($MOT_MOVSUS == "NULL" ){$MOT_MOVSUS1 = "";}else{$MOT_MOVSUS1 =  		$valuesmov[$b+14]['mot_movsusM'];}
				$QNA_INISUS_MOV =  		$valuesmov[$b+15]['qna_inisusM'];
				if($QNA_INISUS_MOV == ""){
					$QNA_INISUS_MOV = "";
					$QNA_INISUS_MOV1= "0";
				}else{
					$QNA_INISUS_MOV1 =  	$valuesmov[$b+15]['qna_inisusM'];
					$QNA_INISUS_MOV =  		$valuesmov[$b+15]['qna_inisusM'];
				}
				$QNA_FINSUS_MOV =  		$valuesmov[$b+16]['qna_finsusM'];
				if($QNA_FINSUS_MOV == ""){
					$QNA_FINSUS_MOV = "";
					$QNA_FINSUS_MOV1= "0";
				}else{
					$QNA_FINSUS_MOV1 =  	$valuesmov[$b+16]['qna_finsusM'];
					$QNA_FINSUS_MOV =  		$valuesmov[$b+16]['qna_finsusM'];
				}
				$NUM_DOCUMENTOSUS= 		$valuesmov[$b+17]['num_doctosusM'];
				if($NUM_DOCUMENTOSUS == ""){$NUM_DOCUMENTOSUS = "NULL";}
				if($NUM_DOCUMENTOSUS == "NULL" ){$NUM_DOCUMENTOSUS1 = "";}else{$NUM_DOCUMENTOSUS1=$valuesmov[$b+17]['num_doctosusM'];}
				$CT_MOV= 				$valuesmov[$b+18]['ctM'];
				$NIVEL_SUELDO_NUEVO= 	$valuesmov[$b+19]['nivel_sueldonvoM'];
				if($NIVEL_SUELDO_NUEVO == ""){$NIVEL_SUELDO_NUEVO = "0";}
				$PLA_BASIFICACION1="";//"BASIF";
				if($PLA_BASIFICACION1==""){$PLA_BASIFICACION="0";}
				$PLA_PROMOCION1="";//"PROMOC";
				if($PLA_PROMOCION1==""){$PLA_PROMOCION="0";}				
				$PLAQNA_ING_SUB1="";//"SUBSIS";
				if($PLAQNA_ING_SUB1==""){$PLAQNA_ING_SUB="0";}				
				/*$DESCRIPCION1 =  		$valuesmov[$b+20]['descripcion2M'];                                 
				$DESCRIPCION2 =  		$valuesmov[$b+21]['descripcion1M'];*/
				$DESCRIPCION =          $valuesmov[$b+20]['_descripcion'];//$DESCRIPCION1." ".$DESCRIPCION2;	
				$CONS_DOC=				$valuesmov[$b+21]['cons_docM'];
				$AREA_PLA=				$valuesmov[$b+22]['areaM'];
				$OFICIO= 				$valuesmov[$b+23]['num_oficioM'];
				$CAPTURO= 				$usuario;//$valuesmov[$b+24]['operadorM'];


				
				include 'Mostrar/pdfmov.php';
				$Pagina =  $pdf->PageNo();
				if($dia!="si"){
					if($copiaUoriginal=="original"){
						insertarFUPMOV($AREA_PLA,$docto_num,$Pagina,$ID_PLA,$TM,$MO,$CONS_DOC,$PARTIDA_MOV,$CODIGO_PAGO_MOV,$UNIDAD_MOV,$SUBUNIDAD_MOV,$CATEGORIA_MOV,$HORAS_MOV,$PLAZA_MOV,$DESDE_MOV,$HASTA_MOV,$NOMBRE_SUS_MOV,$RFCSUS_MOV,$MOT_MOVSUS,$QNA_INISUS_MOV1,$QNA_FINSUS_MOV1,$NUM_DOCUMENTOSUS,$CT_MOV,$NIVEL_SUELDO_NUEVO,$PLA_BASIFICACION,$PLA_PROMOCION,$PLAQNA_ING_SUB,$cliente);
					}
				}
				$i++;
			$b = $b + 24;
	        }//fin 2do while getDatosPDF_Mov
	        oficio_capturo($OFICIO,$CAPTURO,$pdf);
	        
	        if($dia!="si"){
	        	if($copiaUoriginal=="original"){
	        		insertarFUPID($AREA_PLA,$docto_num,$Pagina,$cliente);
	        		insertarBitacora($AREA_PLA,$docto_num,$OFICIO,$usuario,$operacion,$observacion,$cliente);
	        	}
	        	if($copiaUoriginal=="copia"){
	        		insertarBitacora($AREA_PLA,$docto_num,$OFICIO,$usuario,$operacion,$observacion,$cliente);
	        	}
	        }else{
	        	if($copiaUoriginal=="original"){
	        		insertarBitacora($AREA_PLA,$docto_num,$OFICIO,$usuario,$operacion,$observacion,$cliente);
	        	}
	        	if($copiaUoriginal=="copia"){
	        		insertarBitacora($AREA_PLA,$docto_num,$OFICIO,$usuario,$operacion,$observacion,$cliente);
	        	}
	        }
		}//funcionmov
	}//pa==1	
	else{
		function mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion){//funcionm,$diasov
			//var_dump($valuesmov[339]);//405;
			$OFICIO="";
			$CAPTURO=""; 
			$AREA_PLA=""; 
			$Pagina = 0;
			$ID_PLA = "1";
			$NOMBRE_SUS_MOV1="";
			$RFCSUS_MOV1="";
			$MOT_MOVSUS1="";
			$QNA_INISUS_MOV1="";
			$QNA_FINSUS_MOV1="";
			$NUM_DOCUMENTOSUS1="";
			$b=0;
			$i=0;
			$e = $tot_resul_mov + 1;

			if($tot_resul_mov>10){
				
				$b=$filas*33;//330;//($tot_resul_mov*33)
				//$tot_resul_mov = $e;
			}
			
		  	while ($b <= $tot_resul_mov*32){//$total_res*30 //2do while getDatosPDF_Mov
				$M= 					$valuesmov[$b+1]['cve_movM'];
				$TM = 					str_pad($M, 2, "0", STR_PAD_LEFT);
				$MO1= 					$valuesmov[$b+2]['mot_movM'];//10";
				$MO = 					str_pad($MO1, 2, "0", STR_PAD_LEFT);
				$PARTIDA_MOV= 			$valuesmov[$b+3]['partidaM'];
				if($PARTIDA_MOV==""){
					$PARTIDA_MOV = "NULL";
					$PARTIDA_MOVR = "";
				}else{
					$PARTIDA_MOV = $valuesmov[$b+3]['partidaM'];
					$PARTIDA_MOVR = $valuesmov[$b+3]['partidaM'];
				}
				$CODIGO_PAGO_MOV1= 		$valuesmov[$b+4]['cod_pagoM'];
				if($CODIGO_PAGO_MOV1==00){
					$CODIGO_PAGO_MOV = "NULL";
					$CODIGO_PAGO_MOVR = "";
				}else{
					$CODIGO_PAGO_MOV =      str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
					$CODIGO_PAGO_MOVR =      str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
				}
				$UNIDAD_MOV= 			$valuesmov[$b+5]['unidadM'];
				if($UNIDAD_MOV == 0){
					$UNIDAD_MOV = "NULL";
					$UNIDAD_MOVR = "";
				}else{
					$UNIDAD_MOV = $valuesmov[$b+5]['unidadM'];
					$UNIDAD_MOVR = $valuesmov[$b+5]['unidadM'];
				}
				$SUBUNIDAD_MOV= 		$valuesmov[$b+6]['subunidadM'];
				if($SUBUNIDAD_MOV == 0){
					$SUBUNIDAD_MOV = "NULL";
					$SUBUNIDAD_MOVR = "";
				}else{
					$SUBUNIDAD_MOV = $valuesmov[$b+6]['subunidadM'];
					$SUBUNIDAD_MOVR = $valuesmov[$b+6]['subunidadM'];
				}
				$CATEGORIA_MOV= 		$valuesmov[$b+7]['cat_puestoM'];
				if($CATEGORIA_MOV == "" /*|| $CATEGORIA_MOV = "       "*/){
					$CATEGORIA_MOV = "NULL";
					$CATEGORIA_MOVR = "";
				}else{
					$CATEGORIA_MOV = $valuesmov[$b+7]['cat_puestoM'];;
					$CATEGORIA_MOVR = $valuesmov[$b+7]['cat_puestoM'];;
				}
				$HORAS_MOV =  			$valuesmov[$b+8]['horasM'];
				if($SUBUNIDAD_MOV==0 && $HORAS_MOV == 0.0){
					$HORAS_MOV = 0;
					$HORAS_MOVR = 0.0;
				}else{
					$HORAS_MOV = $valuesmov[$b+8]['horasM'];
					$HORAS_MOVR = $valuesmov[$b+8]['horasM'];
				}
				$numero =  				$valuesmov[$b+9]['cons_plazaM'];
				$PLAZA_MOV = 			str_pad($numero, 6, "0", STR_PAD_LEFT);
				if($PLAZA_MOV==000000){
					$PLAZA_MOV = "NULL";
					$PLAZA_MOVR = "";
				}else{
					$PLAZA_MOV = str_pad($numero, 6, "0", STR_PAD_LEFT);
					$PLAZA_MOVR = str_pad($numero, 6, "0", STR_PAD_LEFT);
				}
				$DESDE_MOV= 			$valuesmov[$b+10]['qna_ini_empM'];
				$HASTA_MOV= 			$valuesmov[$b+11]['qna_fin_empM'];
				$QNA_INISUS_MOV =  		$valuesmov[$b+12]['qna_inisusM'];
				if($QNA_INISUS_MOV == ""){
					$QNA_INISUS_MOV = "";
					$QNA_INISUS_MOV1= "0";
				}else{
					$QNA_INISUS_MOV1 =  	$valuesmov[$b+12]['qna_inisusM'];
					$QNA_INISUS_MOV =  		$valuesmov[$b+12]['qna_inisusM'];
				}
				$QNA_FINSUS_MOV =  		$valuesmov[$b+13]['qna_finsusM'];
				if($QNA_FINSUS_MOV == ""){
					$QNA_FINSUS_MOV = "";
					$QNA_FINSUS_MOV1= "0";
				}else{
					$QNA_FINSUS_MOV1 =  	$valuesmov[$b+13]['qna_finsusM'];
					$QNA_FINSUS_MOV =  		$valuesmov[$b+13]['qna_finsusM'];
				}
				$NOMBRE_SUS_MOV =  		$valuesmov[$b+14]['nom_empsusM'];
				if($NOMBRE_SUS_MOV == "" ){$NOMBRE_SUS_MOV = "NULL";}
				if($NOMBRE_SUS_MOV == "NULL" ){$NOMBRE_SUS_MOV1 = "";}else{$NOMBRE_SUS_MOV1 =  		$valuesmov[$b+14]['nom_empsusM'];}
				$RFCSUS_MOV =  			$valuesmov[$b+15]['rfcsusM'];
				if($RFCSUS_MOV == ""){$RFCSUS_MOV = "NULL";}
				if($RFCSUS_MOV == "NULL" ){$RFCSUS_MOV1 = "";}else{$RFCSUS_MOV1 =  		$valuesmov[$b+15]['rfcsusM'];}
				$MOT_MOVSUS =  			$valuesmov[$b+16]['mot_movsusM'];
				if($MOT_MOVSUS == ""){$MOT_MOVSUS = "NULL";}
				if($MOT_MOVSUS == "NULL" ){$MOT_MOVSUS1 = "";}else{$MOT_MOVSUS1 =  		$valuesmov[$b+16]['mot_movsusM'];}
				$NUM_DOCUMENTOSUS= 		$valuesmov[$b+17]['num_doctosusM'];
				if($NUM_DOCUMENTOSUS == ""){$NUM_DOCUMENTOSUS = "0";}
				else{$NUM_DOCUMENTOSUS1=$valuesmov[$b+17]['num_doctosusM'];}
				$CT_MOV= 				$valuesmov[$b+18]['ctM'];
				$NIVEL_SUELDO_NUEVO= 	$valuesmov[$b+19]['nivel_sueldonvoM'];
				if($NIVEL_SUELDO_NUEVO == ""){$NIVEL_SUELDO_NUEVO = "0";}
				$PLA_BASIFICACION1="";//"BASIF";
				if($PLA_BASIFICACION1==""){$PLA_BASIFICACION="0";}
				$PLA_PROMOCION1="";//"PROMOC";
				if($PLA_PROMOCION1==""){$PLA_PROMOCION="0";}				
				$PLAQNA_ING_SUB1="";//"SUBSIS";
				if($PLAQNA_ING_SUB1==""){$PLAQNA_ING_SUB="0";}				
				$DESCRIPCION1 =  		$valuesmov[$b+20]['descripcion2M'];                                 
				$DESCRIPCION2 =  		$valuesmov[$b+21]['descripcion1M'];
				$DESCRIPCION =          $DESCRIPCION1." ".$DESCRIPCION2;	
				$OFICIO= 				$valuesmov[$b+30]['num_oficioM'];

				$CAPTURO= 				$valuesmov[$b+31]['operadorM'];
				if($CAPTURO==""){
					$CAPTURO = "MPLO";
				}
				$AREA_PLA=				$valuesmov[$b+32]['areaM'];
				$CONS_DOC=				$valuesmov[$b+33]['cons_docM'];
				
				include 'Mostrar/pdfmov.php';
				$Pagina =  $pdf->PageNo();
				if($dia!="si"){
					if($copiaUoriginal=="original"){
						insertarFUPMOV($AREA_PLA,$docto_num,$Pagina,$ID_PLA,$TM,$MO,$CONS_DOC,$PARTIDA_MOV,$CODIGO_PAGO_MOV,$UNIDAD_MOV,$SUBUNIDAD_MOV,$CATEGORIA_MOV,$HORAS_MOV,$PLAZA_MOV,$DESDE_MOV,$HASTA_MOV,$NOMBRE_SUS_MOV,$RFCSUS_MOV,$MOT_MOVSUS,$QNA_INISUS_MOV1,$QNA_FINSUS_MOV1,$NUM_DOCUMENTOSUS,$CT_MOV,$NIVEL_SUELDO_NUEVO,$PLA_BASIFICACION,$PLA_PROMOCION,$PLAQNA_ING_SUB,$cliente);
					}
				}
				$i++;
			$b = $b + 33;
	        }//fin 2do while getDatosPDF_Mov
	        oficio_capturo($OFICIO,$CAPTURO,$pdf);
	        if($dia!="si"){
	        	if($copiaUoriginal=="original"){
	        		insertarFUPID($AREA_PLA,$docto_num,$Pagina,$cliente);
	        		insertarBitacora($AREA_PLA,$docto_num,$OFICIO,$usuario,$operacion,$observacion,$cliente);
	        	}
	        	if($copiaUoriginal=="copia"){
	        		insertarBitacora($AREA_PLA,$docto_num,$OFICIO,$usuario,$operacion,$observacion,$cliente);
	        	}
	        }else{
	        	if($copiaUoriginal=="original"){
	        		insertarBitacora($AREA_PLA,$docto_num,$OFICIO,$usuario,$operacion,$observacion,$cliente);
	        	}
	        	if($copiaUoriginal=="copia"){
	        		insertarBitacora($AREA_PLA,$docto_num,$OFICIO,$usuario,$operacion,$observacion,$cliente);
	        	}
	        }

		}//funcionmov
		
	}
/*---------------------------------------------------------CONSULTAS---------------------------------------------------------*/
		$tot_resul_ant=0;
		$tot_resul_cmp=0;
		$tot_resul_mov=0;
/*<---------------------------------------------------ANTECEDENTES----------------------------------------->*/
		
		if($men != "undefined" ){//undefined
		  $arrays = json_decode($men, true);
		  //$arrays= json_encode(json_decode($men), True);	
		  //var_dump($arrays);
		  foreach ( $arrays as $valuesant ) {//inicio_foreach
		  	$tot_resul_ant = $valuesant[0]['_total'];
		  }//inicio_foreach
		}//undefined
/*<---------------------------------------------------ANTECEDENTES----------------------------------------->*/		
/*<---------------------------------------------------CMP----------------------------------------->*/			
		//if($cve_r == "3" || $cve_r == "4"){//0403CMP
			$id_consultacmp = 	171;//158;

			$metodo_consulta="ConsultaCMP_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
			//var_dump($arrayR3_cmp);
			$ycmp=0;
    		foreach($arrayR3_cmp as $valuescmp){//foreachcmp
	            $tot_resul_cmp=$valuescmp[0]["tot_resu"];
	            //cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num);
            }//finforeachcmp            	
		//}//0403CMP
/*<---------------------------------------------------CMP----------------------------------------->*/	
/*<---------------------------------------------------MOVIMIENTOS----------------------------------------->*/
		//if($cve_r == "3" || $cve_r == "4"){
			/*  $id_consulta_Mov = 	161;//MOVIMIENTOS
			}else{
			  $id_consulta_Mov = 	137;//MOVIMIENTOS 	
			}*/
			if($pa=="1"){
				/*$id_consulta_Mov = 	188;//MOVIMIENTOS 
				$metodo_consulta="ConsultaMovimientos_Original1";
				include '../../Conexion/Metodos_Consultas/metodos_consultas.php';*/
				 
			    if($movs != "undefined" ){//undefined
			    	$arrayR_Mov = json_decode($movs, true);
			    	//var_dump($arrayR_Mov);
			    	
					foreach($arrayR_Mov as $valuesmov){//2do foreach getDatosPDF_Mov
						$tot_resul_mov=$valuesmov[0]["totals"];	
					}//fin 2do foreach getDatosPDF_Mov	
					
				}
			}else{
				if($movs == "undefined" ){//undefined
					$id_consulta_Mov = 	137;//MOVIMIENTOS 
					$metodo_consulta="ConsultaMovimientos_Original1";
					include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
					/*
					if(empty($arrayR_Mov)){
						$id_consulta_Mov = 	187;//MOVIMIENTOS 	
						$metodo_consulta="ConsultaMovimientos_Original1";
						include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
					}
					*/
				    //var_dump($arrayR_Mov);
						foreach($arrayR_Mov as $valuesmov){//2do foreach getDatosPDF_Mov
							$tot_resul_mov=$valuesmov[0]["tot_resu"];	
						}//fin 2do foreach getDatosPDF_Mov	
				}//undefined	
			}	
	
				
				/*if($men == "undefined" ){//undefined
					$id_consulta_Mov = 	187;//MOVIMIENTOS 	
				}//undefined
				else{
					$id_consulta_Mov = 	137;//MOVIMIENTOS 	
				}*/
			
			/*$metodo_consulta="ConsultaMovimientos_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
		    //var_dump($arrayR_Mov);
			foreach($arrayR_Mov as $valuesmov){//2do foreach getDatosPDF_Mov
				$tot_resul_mov=$valuesmov[0]["tot_resu"];	
			}//fin 2do foreach getDatosPDF_Mov	
			*/
			//var_dump($valuesmov);
		//}
/*<---------------------------------------------------MOVIMIENTOS----------------------------------------->*/
/*<---------------------------------------------------TRABAJADOR----------------------------------------->*/
		/*if($cve_r == "3" || $cve_r == "4"){
			$id_consulta_TRA = 	163;//TRABAJADOR
		}else{
			$id_consulta_TRA = 	129;//TRABAJADOR
		}*/
		/*if($men == "undefined" ){//undefined
			$id_consulta_TRA = 	163;//TRABAJADOR 	
		}//undefined
		else{
			$id_consulta_TRA = 	129;//TRABAJADOR 	
		}*/
		
		$id_consulta_TRA = 	129;//TRABAJADOR 
		$metodo_consulta="ConsultaTrabajador_Original1";
		include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
	    //var_dump($arrayR3_TRA);
		
	    $CURPtra       = "";
    	$rfc 		   = "";
    	$nom_area      = "";
    	if(!empty($arrayR3_TRA)){
			foreach($arrayR3_TRA as $valuestra){ //foreach trabajador
	        	$tot_resul_tra = $valuestra[0]["tot_resu"];
	        	$CURPtra       = $valuestra[2]['curp'];
	        	$rfc 		   = $valuestra[4]["rfc"];
	        	$nom_area      = $valuestra[20]['nom_area'];
	        }
        } //foreach trabajador			
/*<---------------------------------------------------TRABAJADOR----------------------------------------->*/	        

/*---------------------------------------------------------CONSULTAS---------------------------------------------------------*/	

	$tot_glo = max($tot_resul_ant,$tot_resul_cmp,$tot_resul_mov);//$tot_resul_mov
	
	$LimiteA = 10;
	$LimiteC =  5; 
	$LimiteM = 10;
	$reccG=1;
	$reccG2=1;

	while($reccG<=$tot_glo){//recorrido_global 
	
		if($tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant){//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant

			if($reccG%$LimiteM==0){//$reccG%$LimiteM==0

				$pdf->AddPage();
				//echo $pdf->PageNo();
				if($tot_resul_tra!=0){//tra!=0
					firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
					Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
				}//tra!=0		

				if($tot_resul_tra!=0){

					if($reccG<=$LimiteM){//$reccG==$LimiteM
						if($tot_resul_ant<$LimiteA){
							if($tot_resul_ant!=0){

								$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
								$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
								importe($importe_total,$pdf);
							}else{
								ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							}	

						}else{

							if($tot_resul_ant!=0){
								
									$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
									$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
									importe($importe_total,$pdf);
								/*
									$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
									$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4);
									importe($importe_total,$pdf);
								*/
								
							}else{
								ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							}
						}
					}else{//$reccG==$LimiteM	

						if($tot_resul_ant==$LimiteM){//$reccG==$tot_resul_ant

							ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							
						}else{//$reccG==$tot_resul_ant

							if($tot_resul_ant!=0){
								/*
								$reg =  $tot_resul_ant - $LimiteM;
								$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
								$importe_total = ant($valuesant,$reg,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4);
								importe($importe_total,$pdf);
								*/
								$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
									$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
									importe($importe_total,$pdf);
							}else{
								ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							}
						}//$reccG==$tot_resul_ant
					
					}//$reccG==$LimiteM

				}//tra!=0

				if($tot_resul_mov!=0){//mov!=0
					$filas = $reccG - $LimiteM;
					mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);

				}//mov!=0								

				if($tot_resul_cmp!=0){//tra!=0
					cmp($valuescmp,$tot_resul_cmp,$pdf,$dia,$copiaUoriginal);
				}
if($dia == "si"){
				$pdf->AddPage();
				//echo $pdf->PageNo();
				if($tot_resul_tra!=0){//tra!=0
					firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
					Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
				}//tra!=0		

				if($tot_resul_tra!=0){

					if($reccG<=$LimiteM){//$reccG==$LimiteM
						if($tot_resul_ant<$LimiteA){
							if($tot_resul_ant!=0){

								$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
								$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
								importe($importe_total,$pdf);
							}else{
								ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							}	

						}else{

							if($tot_resul_ant!=0){
								
									$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
									$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
									importe($importe_total,$pdf);
								/*
									$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
									$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4);
									importe($importe_total,$pdf);
								*/
								
							}else{
								ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							}
						}
					}else{//$reccG==$LimiteM	

						if($tot_resul_ant==$LimiteM){//$reccG==$tot_resul_ant

							ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							
						}else{//$reccG==$tot_resul_ant

							if($tot_resul_ant!=0){
								/*
								$reg =  $tot_resul_ant - $LimiteM;
								$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
								$importe_total = ant($valuesant,$reg,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4);
								importe($importe_total,$pdf);
								*/
								$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
									$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
									importe($importe_total,$pdf);
							}else{
								ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							}
						}//$reccG==$tot_resul_ant
					
					}//$reccG==$LimiteM

				}//tra!=0

				if($tot_resul_mov!=0){//mov!=0
					$filas = $reccG - $LimiteM;
					mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);

				}//mov!=0								

				if($tot_resul_cmp!=0){//tra!=0
					cmp($valuescmp,$tot_resul_cmp,$pdf,"no",$copiaUoriginal);
				}

}
			}else{//else $reccG%$LimiteM==0
					
				if($reccG%$tot_glo==0){//reccG==tot_resul_ant

					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
					}//tra!=0									
					$reg =  $tot_resul_ant - $LimiteM;
					if($reccG==$tot_resul_ant){
						if($tot_resul_ant!=0){
						$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);														
						}else{
							ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						}
					}else{
						if($tot_resul_ant!=0){
						if($tot_resul_ant>$LimiteA){
						$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
						//echo $filas;
						$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);
						//cambio 19/09/2022	
						}elseif($tot_resul_ant<$LimiteA){
							ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						}else{
						$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
							
							$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);
							
						
						}
						//cambio 19/09/2022
					}else{
						ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
					}
				}

					if($tot_resul_mov!=0){//mov!=0
						$filas = $reccG - $tot_resul_mov%$LimiteM;
						mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
					}//mov!=0

					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,$copiaUoriginal);
					}																			
if($dia == "si"){
					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
					}//tra!=0									
					$reg =  $tot_resul_ant - $LimiteM;
					if($reccG==$tot_resul_ant){
						if($tot_resul_ant!=0){
						$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);														
						}else{
							ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						}
					}else{
						if($tot_resul_ant!=0){
						if($tot_resul_ant>$LimiteA){
						$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
						//echo $filas;
						$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);
						//cambio 19/09/2022	
						}elseif($tot_resul_ant<$LimiteA){
							ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						}else{
						$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
							//echo $filas;
							
							$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);
							
						
						}
						//cambio 19/09/2022
					}else{
						ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
					}
				}

					if($tot_resul_mov!=0){//mov!=0
						$filas = $reccG - $tot_resul_mov%$LimiteM;
						mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
					}//mov!=0

					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",$copiaUoriginal);
					}

}																		
				}//reccG==tot_resul_ant					
			}//else
		}//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant	

		if($tot_resul_cmp<=5 && $tot_resul_ant > $tot_resul_mov){//inicio
			if($reccG%$LimiteM==0){////else
				$pdf->AddPage();

				if($tot_resul_tra!=0){//tra!=0
					firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
					Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
				}//tra!=0								
				if($tot_resul_ant!=0){//ant!=0
					if($reccG==$LimiteA){
						$filasAnt = $reccG - $tot_resul_ant%$LimiteM;		
						$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);									
					}elseif($reccG<$LimiteA){
						$filasAnt = $reccG - $tot_resul_ant%$LimiteM;
						$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);
					}else{
						$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
					$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);
					}
				}//ant!=0

				if($tot_resul_mov!=0){//mov!=0
					//$filas = $reccG - $LimiteM;
					//$filas = $tot_resul_mov - $LimiteM;
					$filas = $tot_resul_mov - $LimiteM;
					$filas1 = $tot_resul_mov - $filas;
					//echo $filas1;
					//echo $reccG;
					if($tot_resul_mov>$tot_resul_ant && $tot_resul_mov>$LimiteM){
						mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas1,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
					}elseif($tot_resul_mov<$tot_resul_ant && $tot_resul_mov<$LimiteM){
						mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
					}
					
				}//mov!=0							
				if($tot_resul_cmp!=0){//tra!=0
					cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,$copiaUoriginal);
				}							
if($dia == "si"){
				$pdf->AddPage();

				if($tot_resul_tra!=0){//tra!=0
					firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
					Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
				}//tra!=0								
				if($tot_resul_ant!=0){//ant!=0
					if($reccG==$LimiteA){
						$filasAnt = $reccG - $tot_resul_ant%$LimiteM;		
						$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);									
					}elseif($reccG<$LimiteA){
						$filasAnt = $reccG - $tot_resul_ant%$LimiteM;
						$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);
					}else{
						$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
					$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);
					}
				}//ant!=0

				if($tot_resul_mov!=0){//mov!=0
					//$filas = $reccG - $LimiteM;
					//$filas = $tot_resul_mov - $LimiteM;
					$filas = $tot_resul_mov - $LimiteM;
					$filas1 = $tot_resul_mov - $filas;
					//echo $filas1;
					//echo $reccG;
					if($tot_resul_mov>$tot_resul_ant && $tot_resul_mov>$LimiteM){
						mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas1,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
					}elseif($tot_resul_mov<$tot_resul_ant && $tot_resul_mov<$LimiteM){
						mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
					}
					
				}//mov!=0							
				if($tot_resul_cmp!=0){//tra!=0
					cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",$copiaUoriginal);
				}
}					
			}else{//else pagina mayor a 1
				if($reccG==$tot_resul_ant){//reccG==tot_resul_ant
					$pdf->AddPage();
					
					if($tot_resul_tra!=0){//tra!=0
						firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
						//tra($valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$pdf,$cliente,$dia);
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
					}//tra!=0									
					if($tot_resul_ant!=0){//ant!=0
						$filas = $reccG - $tot_resul_ant%$LimiteM;	
						//ant($valuesant,$reccG,$dia,$pdf,$cliente,$filas,NULL);
						$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);
					}//ant!=0
					if($tot_resul_mov!=0){//mov!=0

						/*if($tot_resul_ant<$tot_resul_mov ){
							$filas1 = $tot_resul_mov - $filas;
							mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_num,$dias);
						}else*/if($tot_resul_ant>$tot_resul_mov && $tot_resul_mov>$LimiteM){//si ant > mov
							$filas1 = $tot_resul_mov - $filas;
							mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
						}elseif($tot_resul_ant>$tot_resul_mov && $tot_resul_ant<$LimiteM){//si ant > mov
							$filas1 = $tot_resul_mov - $filas;
							mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
						}
						//$filas = ($reccG - $tot_resul_mov%$LimiteM);	
						//$filas = $tot_resul_mov - $LimiteM;

					}//mov!=0									

					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,$copiaUoriginal);
					}								
if($dia == "si"){
					$pdf->AddPage();
					
					if($tot_resul_tra!=0){//tra!=0
						firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
						//tra($valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$pdf,$cliente,$dia);
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
					}//tra!=0									
					if($tot_resul_ant!=0){//ant!=0
						$filas = $reccG - $tot_resul_ant%$LimiteM;	
						//ant($valuesant,$reccG,"no",$pdf,$cliente,$filas,NULL);
						$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);
					}//ant!=0
					if($tot_resul_mov!=0){//mov!=0

						/*if($tot_resul_ant<$tot_resul_mov ){
							$filas1 = $tot_resul_mov - $filas;
							mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_num,$dias);
						}else*/if($tot_resul_ant>$tot_resul_mov && $tot_resul_mov>$LimiteM){//si ant > mov
							$filas1 = $tot_resul_mov - $filas;
							mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
						}elseif($tot_resul_ant>$tot_resul_mov && $tot_resul_ant<$LimiteM){//si ant > mov
							$filas1 = $tot_resul_mov - $filas;
							mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
						}
						//$filas = ($reccG - $tot_resul_mov%$LimiteM);	
						//$filas = $tot_resul_mov - $LimiteM;

					}//mov!=0									

					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",$copiaUoriginal);
					}
}									
				}//reccG==tot_resul_ant	
			}//else
		}//inicio	

		if($tot_resul_cmp<=5 && $tot_resul_mov == $tot_resul_ant){//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant
			if($reccG%$LimiteM==0){//$reccG%$LimiteM==0
				$pdf->AddPage();
				if($tot_resul_tra!=0){//tra!=0
					firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
					Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
				}//tra!=0							
				if($LimiteM<=$tot_resul_ant){
					
					if($reccG==$LimiteA){
						$filasAnt = $reccG - $reccG%$LimiteM;	
						$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);
					}													
				}
				if($tot_resul_mov!=0){//mov!=0
					$filas = $reccG - $LimiteM;
					mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
				}//mov!=0								
				if($tot_resul_cmp!=0){//tra!=0
					cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,$copiaUoriginal);
				}	
if($dia == "si"){
				$pdf->AddPage();
				if($tot_resul_tra!=0){//tra!=0
					firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
					Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
				}//tra!=0							
				if($LimiteM<=$tot_resul_ant){
					
					if($reccG==$LimiteA){
						$filasAnt = $reccG - $reccG%$LimiteM;	
						$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
						importe($importe_total,$pdf);
					}													
				}
				if($tot_resul_mov!=0){//mov!=0
					$filas = $reccG - $LimiteM;
					mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
				}//mov!=0								
				if($tot_resul_cmp!=0){//tra!=0
					cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",$copiaUoriginal);
				}	

}										
			}else{//else $reccG%$LimiteM==0
				if($reccG%$tot_glo==0){//reccG%tot_glo==0
					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
					}//tra!=0	
					if($tot_resul_ant!=0){//ant!=0

						if($tot_resul_ant<$reccG){
							
							$filasA = $tot_resul_ant - ($tot_resul_ant%$LimiteA);
							$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasA,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
								importe($importe_total,$pdf);
						}else{
							if($tot_resul_ant>$LimiteA){
							$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
							if($tot_resul_ant==15){
								$tot_resul_ant = $tot_resul_ant+1;
								//$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
							}
							//echo $filas;
							//echo $tot_resul_ant;
						$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);	
							}else{
							$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
						$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);			
							}

						}
					}//ant!=0
					if($tot_resul_mov!=0){//mov!=0
						$filas = $reccG - $tot_resul_mov%$LimiteM;
						mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
					}//mov!=0										
					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,$copiaUoriginal);
					}
if($dia == "si"){
					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						firmas_funcion($FECHAD,$pdf,$cliente,$copiaUoriginal);//copiaUoriginal);
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$copiaUoriginal);
					}//tra!=0	
					if($tot_resul_ant!=0){//ant!=0

						if($tot_resul_ant<$reccG){
							
							$filasA = $tot_resul_ant - ($tot_resul_ant%$LimiteA);
							$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasA,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
								importe($importe_total,$pdf);
						}else{
							if($tot_resul_ant>$LimiteA){
							$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
							if($tot_resul_ant==15){
								$tot_resul_ant = $tot_resul_ant+1;
								//$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
							}
							//echo $filas;
							//echo $tot_resul_ant;
						$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);	
							}else{
							$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
						$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$copiaUoriginal,$usuario);
							importe($importe_total,$pdf);			
							}

						}
					}//ant!=0
					if($tot_resul_mov!=0){//mov!=0
						$filas = $reccG - $tot_resul_mov%$LimiteM;
						mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_num,$dias,$copiaUoriginal,$usuario,$operacion,$observacion);
					}//mov!=0										
					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",$copiaUoriginal);
					}

}															
				}//reccG%tot_glo==0													
			}//else

		}//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant	

		$reccG = $reccG+1;
		$reccG2++;	
	}//recorrido_global

	$nom_area1 = trim($nom_area);
	if($nom_area!=""){
		$cadena = $nom_area1;//str_replace(' ', '_', $nom_area1);

		if($dia == "si"){
			/*
			$pdf->Output('I',$nom_area1.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Fecha.pdf');
			$pdf->Output('F','../../FUPs/Masivo_ORIGINAL/'.$nom_area1.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Fecha.pdf');
	    	*/
			if($copiaUoriginal=="original"){
				$pdf->Output('F','../../FUPs/Masivo_ORIGINAL/'.$cadena.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Fecha.pdf');
		    	//if($descargar=="descargar"){
					echo '../FUPs/Masivo_ORIGINAL/'.$cadena.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Fecha.pdf';
				//}
			}else{
		    	$pdf->Output('F','../../FUPs/Masivo_COPIA/'.$cadena.'_'.$CURPtra.'_'.$docto_num.'_COPIA_Fecha.pdf');
		    	//if($descargar=="descargar"){
					echo '../FUPs/Masivo_COPIA/'.$cadena.'_'.$CURPtra.'_'.$docto_num.'_COPIA_Fecha.pdf';
				//}
			}		

		}else{
			/*
			$pdf->Output('I',$nom_area1.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Qna.pdf');
			$pdf->Output('F','../../FUPs/Masivo_ORIGINAL/'.$nom_area1.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Qna.pdf');
			*/
			if($copiaUoriginal=="original"){	
				$pdf->Output('F','../../FUPs/Masivo_ORIGINAL/'.$cadena.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Qna.pdf');
	    		//if($descargar=="descargar"){
	 				echo '../FUPs/Masivo_ORIGINAL/'.$cadena.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Qna.pdf';
				//}						    	
			}else{
		    	$pdf->Output('F','../../FUPs/Masivo_COPIA/'.$cadena.'_'.$CURPtra.'_'.$docto_num.'_COPIA_Qna.pdf');
		    	//if($descargar=="descargar"){
		 			echo '../FUPs/Masivo_COPIA/'.$cadena.'_'.$CURPtra.'_'.$docto_num.'_COPIA_Qna.pdf';
				//}
			}	
		}
	}