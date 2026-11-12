<?php
//2117274861
		ini_set("soap.wsdl_cache_enabled", "0");
		include '../../Cascaron/Cascaron.php';			
		include_once '../../Codigo_Barras/barcode.php';
		require_once('../../Conexion/wsdl.php'); 	
		require_once('../../Conexion/wsdl_foliacion.php'); 	
		
		function like_match($pattern, $subject)
		{
		    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
		    return (bool) preg_match("/^{$pattern}$/i", $subject);
		}
		
		$docto_numFUP = "2418318662";//$_POST['id'];
        $num_oficioFUP = "1311200558";//$_POST['oficio'];
        $areaFUP = "3112";//$_POST['area'];
        $rfcFUP = "MOHG700324A67";//$_POST['rfc'];
        $men = base64_decode("eyJuZXdhcnJheSI6W3siX3RvdGFsIjoyfSx7Il9jb2RfcGFnbyI6IjcifSx7Il91bmlkYWQiOiIyNCJ9LHsiX3N1YnVuaWRhZCI6IjEzIn0seyJfcHVlc3RvIjoiICBFMDM2MyJ9LHsiX2hvcmFzIjoiMTkifSx7Il9wbGF6YSI6IjE0OTgifSx7Il9tb3RfbW92IjoiMTAifSx7Il9uaXZlbF9zZG8iOiIzIn0seyJfcW5hX2luaSI6IjIwMjAwOCJ9LHsiX3FuYV9maW4iOiI5OTk5OTkifSx7Il9udW1fZG9jIjoiMjAwODI2MTIxMyJ9LHsiX2N0IjoiMjRERVMwNjZJIn0seyJfdmFsb3IyIjoiMSJ9LHsiX2FyZWFzIjoiMzEzMyJ9LHsiX2NvZF9wYWdvIjoiNyJ9LHsiX3VuaWRhZCI6IjI0In0seyJfc3VidW5pZGFkIjoiMTMifSx7Il9wdWVzdG8iOiIgIEUwMzYzIn0seyJfaG9yYXMiOiI1In0seyJfcGxhemEiOiIxNzMxIn0seyJfbW90X21vdiI6IjEwIn0seyJfbml2ZWxfc2RvIjoiMyJ9LHsiX3FuYV9pbmkiOiIyMDIwMDgifSx7Il9xbmFfZmluIjoiOTk5OTk5In0seyJfbnVtX2RvYyI6IjIwMDgyNjEyMTMifSx7Il9jdCI6IjI0REVTMDY2SSJ9LHsiX3ZhbG9yMiI6IjAifSx7Il9hcmVhcyI6IjMxMzMifV19"/*$_POST['men']*/);
        $usuario = "Jonathan";//$_POST['usu'];
        $observacion = "Creacion Original CT";//$_POST['obs'];
        $operacion = "Creacion Original CT";//$_POST['ops'];
		$rnum_docto = "0";
		$fec = date('d-m-Y');
		$dia = "no";
		$dias = "";
		$fec_def = "";	

		$sin_folear = like_match('%000001%',$docto_numFUP);
 		if($sin_folear == true){
 			/*FOLIACION*/
			$JSON_Foliacion="[{\"area\":\"$areaFUP\",\"num_docto\":\"$docto_numFUP\",\"num_oficio\":\"$num_oficioFUP\",\"usuario\":\"$usuario\",\"rnum_docto\":\"$rnum_docto\"}]";
		    $array_Foliacion = json_decode(json_encode($JSON_Foliacion), True);
		    $params_Foliacion = array('Argumento'=>$array_Foliacion); //para conseguir la consulta	    
		    $resultados_Foliacion=$cliente2->getFolio($params_Foliacion);
			$arrayR_Foliacion= json_decode(json_encode($resultados_Foliacion), True);					
			/*FOLIACION*/	
			if($arrayR_Foliacion['getFolioResult']!=""){//null
				$docto_num = $arrayR_Foliacion['getFolioResult'];
			}//null
		}else{
			$docto_num = $docto_numFUP;
		}	
		

		//if($arrayR_Foliacion['getFolioResult']!=""){//null
			//$docto_num = $arrayR_Foliacion['getFolioResult'];
			
			$tam = strlen($rfcFUP);
			$rfc = substr($rfcFUP,0,$tam-3);
			//Anexo
			$checA1 = base64_decode("");
			$checA2 = base64_decode("");
			$checA3 = base64_decode("");
			$checA4 = base64_decode("");
			$checA5 = base64_decode("");
			//Observaciones
			$checs1 = base64_decode("");
			$checs2 = base64_decode("");
			$checs3 = base64_decode("");
			$checs4 = base64_decode("");

			$FECHA  = date('d-m-Y', strtotime($fec));
			$FECHAD = date('Y-m-d', strtotime($fec));

			$pdf=new PDF('L','mm','LEGAL');
			$pdf->SetAutoPageBreak(false);
			$pdf->StartPageGroup();
				
			$tot_resul_ant=0;
			$tot_resul_cmp=0;
			$tot_resul_mov=0;
				
						
			if($men != "undefined" ){//undefined
			  $arrays = json_decode($men, true);
			  foreach ( $arrays as $valuesant ) {//inicio_foreach
			  	$tot_resul_ant = $valuesant[0]['_total'];
			  }//inicio_foreach
			}//undefined
			
								
			$id_consulta_Mov = 	137;//MOVIMIENTOS 
			$metodo_consulta="ConsultaMovimientos_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
			$xmlmov = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
			$jsonmov = json_encode($xmlmov);
			$arraymov = json_decode($jsonmov,TRUE);	
			$ycmp=0;
			//var_dump($arraymov);
			if(!empty($arraymov)){
				$valuesmov = $arraymov['NewDataSet']['table'];		
				$valuesmovs = $arraymov['NewDataSet'];	
				if(!isset($valuesmov[0])){
		        	$tot_resul_mov=count($valuesmovs);		
				}else{
					$tot_resul_mov=count($valuesmov);			
				}							
			}

			$id_consulta_TRA = 	129;//TRABAJADOR 
			$metodo_consulta="ConsultaTrabajador_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
			$xmltra = simplexml_load_string($arrayR3_TRA['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
			$jsontra = json_encode($xmltra);
			$arraytra = json_decode($jsontra,TRUE);			
		    $CURPtra       = "";
	    	$rfc 		   = "";
	    	$nom_area      = "";
	    	$tot_resul_tra = 0;
	    	if(!empty($arraytra)){
				$valuestra = $arraytra['NewDataSet']['table'];		
				$valuestras = $arraytra['NewDataSet'];	

				if(!isset($valuestra[0])){
		        	$tot_resul_tra=count($valuestras);		
		        	$CURPtra       = $valuestra['curp'];
		        	$rfc 		   = $valuestra["rfc"];
		        	$nom_area      = $valuestra['nombre_area'];		
				}else{
					$tot_resul_tra=count($valuestra);		
		        	$CURPtra       = $valuestra[0]['curp'];
		        	$rfc 		   = $valuestra[0]["rfc"];
		        	$nom_area      = $valuestra[0]['nombre_area'];			
				}							
						
	        }//trabajador			


			$tot_glo = max($tot_resul_ant,$tot_resul_cmp,$tot_resul_mov);//$tot_resul_mov

			$LimiteA = 10;
			$LimiteC =  5; 
			$LimiteM = 10;
			$reccG=1;
			$reccG2=1;

			while($reccG<=$tot_glo){//recorrido_global 
				if($tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant){//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant
					if($reccG%$LimiteM==0){//$reccG%$LimiteM==0
						if($dia == "si"){
							$pdf->AddPage();
							if($tot_resul_tra!=0){//tra!=0
								Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
							}//tra!=0		

							if($tot_resul_tra!=0){

								if($reccG<=$LimiteM){//$reccG==$LimiteM
									if($tot_resul_ant<$LimiteA){
										if($tot_resul_ant!=0){
											$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
											$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
											importe($importe_total,$pdf);
										}else{
											ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										}	

									}else{
										if($tot_resul_ant!=0){
											$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
											$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
											importe($importe_total,$pdf);											
										}else{
											ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										}
									}
								}else{//$reccG==$LimiteM	
									if($tot_resul_ant==$LimiteM){//$reccG==$tot_resul_ant
										ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									}else{//$reccG==$tot_resul_ant
										if($tot_resul_ant!=0){
											$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
												$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
												importe($importe_total,$pdf);
										}else{
											ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										}
									}//$reccG==$tot_resul_ant
											
								}//$reccG==$LimiteM
							}//tra!=0
							if($tot_resul_mov!=0){//mov!=0
								$filas = $reccG - $LimiteM;

								mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);

							}//mov!=0								

							if($tot_resul_cmp!=0){//tra!=0
								cmp($valuescmp,$tot_resul_cmp,$pdf,"no",);
							}

						}//dia si
						$pdf->AddPage();
						if($tot_resul_tra!=0){//tra!=0
							firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
							Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
						}//tra!=0		

						if($tot_resul_tra!=0){
							if($reccG<=$LimiteM){//$reccG==$LimiteM
								if($tot_resul_ant<$LimiteA){
									if($tot_resul_ant!=0){
										$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
										$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);

										importe($importe_total,$pdf);
									}else{
										ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									}	
								}else{
									if($tot_resul_ant!=0){
											$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
											$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
											importe($importe_total,$pdf);												
									}else{
										ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									}
								}
							}else{//$reccG==$LimiteM	
								if($tot_resul_ant==$LimiteM){//$reccG==$tot_resul_ant
									ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}else{//$reccG==$tot_resul_ant
									if($tot_resul_ant!=0){
										$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
											$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
											importe($importe_total,$pdf);
									}else{
										ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									}
								}//$reccG==$tot_resul_ant
							}//$reccG==$LimiteM
						}//tra!=0

						if($tot_resul_mov!=0){//mov!=0
							$filas = $reccG - $LimiteM;
							mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
						}//mov!=0								

						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$dia,);
						}

					}else{//else $reccG%$LimiteM==0
						if($reccG%$tot_glo==0){//reccG==tot_resul_ant
							if($dia == "si"){
								$pdf->AddPage();
								if($tot_resul_tra!=0){//tra!=0
									firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
									Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
								}//tra!=0									
								$reg =  $tot_resul_ant - $LimiteM;
								if($reccG==$tot_resul_ant){
									if($tot_resul_ant!=0){
									$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);														
									}else{
										ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									}
								}else{
									if($tot_resul_ant!=0){
										if($tot_resul_ant>$LimiteA){
											$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
											$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
												importe($importe_total,$pdf);
											//cambio 19/09/2022	
										}elseif($tot_resul_ant<$LimiteA){
											ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										}else{
											$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
											$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
											importe($importe_total,$pdf);
										}
									//cambio 19/09/2022
									}else{
										ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									}
								}
								if($tot_resul_mov!=0){//mov!=0
									$filas = $reccG - $tot_resul_mov%$LimiteM;
									mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
								}//mov!=0

								if($tot_resul_cmp!=0){//tra!=0
									cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",);
								}
							}//dia
							$pdf->AddPage();
							if($tot_resul_tra!=0){//tra!=0
								firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
								Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
							}//tra!=0									
							$reg =  $tot_resul_ant - $LimiteM;
							if($reccG==$tot_resul_ant){
								if($tot_resul_ant!=0){
									$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);														
								}else{

									ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}
							}else{
								if($tot_resul_ant!=0){

									if($tot_resul_ant>$LimiteA){

									$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
									$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);
									}elseif($tot_resul_ant<$LimiteA){
										if($tot_resul_ant==0){
											ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										}else{
											ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);		
										}
									}else{
										$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
										
										$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);
									}
								//cambio 19/09/2022
								}else{
									ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}
							}
							if($tot_resul_mov>$LimiteA){
								if($tot_resul_mov!=0){//mov!=0
									$filas = $reccG - $tot_resul_mov%$LimiteM;
									mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
								}//mov!=0
							}else{
								if($tot_resul_mov!=0){//mov!=0
									$filas = $reccG - $tot_resul_mov%$LimiteM;
									mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
								}//mov!=0
							}
							if($tot_resul_cmp!=0){//tra!=0
								cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,);
							}																			
																								
						}//reccG==tot_resul_ant					
					}//else
				}//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant	

				if($tot_resul_cmp<=5 && $tot_resul_ant > $tot_resul_mov){//inicio
					if($reccG%$LimiteM==0){//else
						if($dia == "si"){
							$pdf->AddPage();

							if($tot_resul_tra!=0){//tra!=0
								firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
								Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
							}//tra!=0								
							if($tot_resul_ant!=0){//ant!=0
								if($reccG==$LimiteA){
									$filasAnt = $reccG - $tot_resul_ant%$LimiteM;		
									$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);									
								}elseif($reccG<$LimiteA){
									$filasAnt = $reccG - $tot_resul_ant%$LimiteM;
									$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);
								}else{
									$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
								$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);
								}
							}//ant!=0

							if($tot_resul_mov!=0){//mov!=0
								$filas = $tot_resul_mov - $LimiteM;
								$filas1 = $tot_resul_mov - $filas;
								if($tot_resul_mov>$tot_resul_ant && $tot_resul_mov>$LimiteM){
									mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas1,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
								}elseif($tot_resul_mov<$tot_resul_ant && $tot_resul_mov<$LimiteM){
									mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
								}
							}//mov!=0							
							if($tot_resul_cmp!=0){//tra!=0
								cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",);
							}
						}//dia				
						$pdf->AddPage();

						if($tot_resul_tra!=0){//tra!=0
							firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
							Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
						}//tra!=0								
						if($tot_resul_ant!=0){//ant!=0
							if($reccG==$LimiteA){
								$filasAnt = $reccG - $tot_resul_ant%$LimiteM;		
								$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);									
							}elseif($reccG<$LimiteA){
								$filasAnt = $reccG - $tot_resul_ant%$LimiteM;
								$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);
							}else{
								$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
							$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);
							}
						}//ant!=0

						if($tot_resul_mov!=0){//mov!=0
							$filas = $tot_resul_mov - $LimiteM;
							$filas1 = $tot_resul_mov - $filas;
							if($tot_resul_mov>$tot_resul_ant && $tot_resul_mov>$LimiteM){
								mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas1,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
							}elseif($tot_resul_mov<$tot_resul_ant && $tot_resul_mov<$LimiteM){
								mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
							}elseif($tot_resul_mov<$tot_resul_ant && $tot_resul_mov>$LimiteM){
								mov($valuesmov,$filas1,$dia,$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
							}
							
						}//mov!=0							
						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,);
						}							
											
					}else{//else pagina mayor a 1
						if($reccG==$tot_resul_ant){//reccG==tot_resul_ant
							if($dia == "si"){
								$pdf->AddPage();
								if($tot_resul_tra!=0){//tra!=0
									firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
									Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
								}//tra!=0									
								if($tot_resul_ant!=0){//ant!=0
									$filas = $reccG - $tot_resul_ant%$LimiteM;	
									$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);
								}//ant!=0
								if($tot_resul_mov!=0){//mov!=0
									if($tot_resul_ant>$tot_resul_mov && $tot_resul_mov>$LimiteM){//si ant > mov
										$filas1 = $tot_resul_mov - $filas;
										mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
									}elseif($tot_resul_ant>$tot_resul_mov && $tot_resul_ant<$LimiteM){//si ant > mov
										$filas1 = $tot_resul_mov - $filas;
										mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
									}
								}//mov!=0									
								if($tot_resul_cmp!=0){//tra!=0
									cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",);
								}
							}					
							$pdf->AddPage();
							
							if($tot_resul_tra!=0){//tra!=0
								firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
								//tra($valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$pdf,$cliente,$dia);
								Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
							}//tra!=0									
							if($tot_resul_ant!=0){//ant!=0
								$filas = $reccG - $tot_resul_ant%$LimiteM;	
								//ant($valuesant,$reccG,$dia,$pdf,$cliente,$filas,NULL);
								$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);
							}//ant!=0
							if($tot_resul_mov!=0){//mov!=0
								if($tot_resul_ant>$tot_resul_mov && $tot_resul_mov>$LimiteM){//si ant > mov
									$filas1 = $tot_resul_mov - $filas;
									mov($valuesmov,$filas1,$dia,$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
									//mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
								}elseif($tot_resul_ant>$tot_resul_mov && $tot_resul_ant<$LimiteM){//si ant > mov
									$filas1 = $tot_resul_mov - $filas;
									mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
								}
								//$filas = ($reccG - $tot_resul_mov%$LimiteM);	
								//$filas = $tot_resul_mov - $LimiteM;

							}//mov!=0									

							if($tot_resul_cmp!=0){//tra!=0
								cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,);
							}								
						}//reccG==tot_resul_ant	
					}//else
				}//inicio	

				if($tot_resul_cmp<=5 && $tot_resul_mov == $tot_resul_ant){//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant
					if($reccG%$LimiteM==0){//$reccG%$LimiteM==0
						if($dia == "si"){
							$pdf->AddPage();
							if($tot_resul_tra!=0){//tra!=0
								firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
								Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
							}//tra!=0							
							if($LimiteM<=$tot_resul_ant){
								if($reccG==$LimiteA){
									$filasAnt = $reccG - $reccG%$LimiteM;	
									$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);
								}													
							}
							if($tot_resul_mov!=0){//mov!=0
								$filas = $reccG - $LimiteM;
								mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
							}//mov!=0								
							if($tot_resul_cmp!=0){//tra!=0
								cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",);
							}	
						}//dia				
						$pdf->AddPage();
						if($tot_resul_tra!=0){//tra!=0
							firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
							Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
						}//tra!=0							
						if($LimiteM<=$tot_resul_ant){
							
							if($reccG==$LimiteA){
								$filasAnt = $reccG - $reccG%$LimiteM;	
								$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);
							}													
						}
						if($tot_resul_mov!=0){//mov!=0
							$filas = $reccG - $LimiteM;
							mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
						}//mov!=0								
						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,);
						}	
																
					}else{//else $reccG%$LimiteM==0
						if($reccG%$tot_glo==0){//reccG%tot_glo==0
							if($dia == "si"){
								$pdf->AddPage();
								if($tot_resul_tra!=0){//tra!=0
									firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
									Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
								}//tra!=0	
								if($tot_resul_ant!=0){//ant!=0
									if($tot_resul_ant<$reccG){
										$filasA = $tot_resul_ant - ($tot_resul_ant%$LimiteA);
										$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasA,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
											importe($importe_total,$pdf);
									}else{
										if($tot_resul_ant>$LimiteA){
											$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
										if($tot_resul_ant==15){
											$tot_resul_ant = $tot_resul_ant+1;
										}
										$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);	
										}else{
											$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
											$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
											importe($importe_total,$pdf);			
										}
									}
								}//ant!=0
								if($tot_resul_mov!=0){//mov!=0
									$filas = $reccG - $tot_resul_mov%$LimiteM;
									mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
								}//mov!=0										
								if($tot_resul_cmp!=0){//tra!=0
									cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,"no",);
								}
							}//dia						
							$pdf->AddPage();
							if($tot_resul_tra!=0){//tra!=0
								firmas_funcion($FECHAD,$pdf,$cliente);//copiaUoriginal);
								Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
							}//tra!=0	
							if($tot_resul_ant!=0){//ant!=0
								if($tot_resul_ant<$reccG){
									$filasA = $tot_resul_ant - ($tot_resul_ant%$LimiteA);
									$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasA,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);
								}else{
									if($tot_resul_ant>$LimiteA){
										$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
										if($tot_resul_ant==15){
											$tot_resul_ant = $tot_resul_ant+1;
										}
										$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);	
									}else{
										$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
										$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);			
									}
								}
							}//ant!=0
							if($tot_resul_mov!=0){//mov!=0
								$filas = $reccG - $tot_resul_mov%$LimiteM;
								mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def);
							}//mov!=0										
							if($tot_resul_cmp!=0){//tra!=0
								cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_num,$dia,);
							}
						}//reccG%tot_glo==0													
					}//else

				}//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant	
				$reccG = $reccG+1;
				$reccG2++;	
			}//recorrido_global

			/*CREAR FUP CT EDITAR*/
			$nom_area1 = trim($nom_area);
			$cadena = $nom_area1;//str_replace(' ', '_', $nom_area1);
			$dat = "";
			$ip = getRealIP();
			
			$pdf->Output('F','../../FUPs/Masivo_Original/CCT/'.$cadena.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Qna.pdf');
		    
		    $dat = $cadena.'_'.$CURPtra.'_'.$docto_num.'_ORIGINAL_Qna.pdf';
			
		    $Object = new DateTime();  
		    $Object->setTimezone(new DateTimeZone('America/Mexico_City'));
		    $DateAndTime = $Object->format("d-m-Y h:i:s a");  

		    $contenido = $DateAndTime.'-'.$dat.'-'.$usuario.'-'.$ip."\r\n";
		    $archivo = fopen('Creados_Original_CT_Editados.txt','a');

		    fputs($archivo,$contenido);
		    fclose($archivo); 	
		 				
		//}//null
		    
		function getRealIP() {

            if (!empty($_SERVER['HTTP_CLIENT_IP']))
                return $_SERVER['HTTP_CLIENT_IP'];
               
            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
           
            return $_SERVER['REMOTE_ADDR'];
        }		
		function properText($str){
		    $str = mb_convert_encoding($str, 'ISO-8859-1', 'UTF-8');
		    $str = preg_replace('[a-zA-Z áéíóúÁÉÍÓÚñÑ.]',htmlentities('${1}'),$str);
		    return($str); 
		}
		function insertarPDFID($ID,$pdf){
			include 'Mostrar/pdfID.php';
		}	
		function insertarFUPID($AREA_PLA,$docto_num,$Pagina,$OFICIO,$usuario,$operacion,$observacion,$cliente){
			include 'F_Insert/FUPID_CT_Editar.php';
		}	
		function insertarFUPPRE($arweas,$docto_num,$Pagina,$ID_PLA,$PDA,$CODIGO_PAGO,$UNIDAD,$SUBUNIDAD,$CATEGORIA,$HORAS2,$PLAZA,$ALTA,$CONCEPTO,$numero5,$DESDE,$HASTA,$Valor,$DR,$iDR,$DRqna_ini,$DRqna_fin,$DRnum_docto,$BS,$iBS,$BSqna_ini,$BSqna_fin,$BSnum_docto,    $I4,$iI4,$I4qna_ini,$I4qna_fin,$I4num_docto,$E3,$iE3,$E3qna_ini,$E3qna_fin,$E3num_docto,$cliente){
			include 'F_Insert/FUPPRECT.php';
		}				
		function insertarFUPMOV($AREA_PLA,$docto_num,$Pagina,$ID_PLA,$TM,$MO,$CONS_DOC,$PARTIDA_MOV,$CODIGO_PAGO_MOV,$UNIDAD_MOV,$SUBUNIDAD_MOV,$CATEGORIA_MOV,$HORAS_MOV,$PLAZA_MOV,$DESDE_MOV,$HASTA_MOV,$NOMBRE_SUS_MOV1,$RFCSUS_MOV1,$MOT_MOVSUS1,$QNA_INISUS_MOV1,$QNA_FINSUS_MOV1,$NUM_DOCUMENTOSUS1,$CT_MOV,$NIVEL_SUELDO_NUEVO,$PLA_BASIFICACION,$PLA_PROMOCION,$PLAQNA_ING_SUB,$cliente){
			include 'F_Insert/FUPPLA.php';
		}
		function insertarFUPPER($AREA_PER,$docto_num,$RFC,$NOMBRE_EMPLEADO,$EDO_NAC,$SEXO,$EDO_CIVIL,$CALLE,$LOCACION,$MUNICIPIO,$COD_POSTAL,$PUESTO,$QNA_INI_GOB,$QNA_ING_SEP,$numero1,$numero2,$PERQ,$PERA,$PERL,$PERT,$PERCT1,$PERHR1_,$PERCT2,$PERHR2_,$PERCT3,$PERHR3_,$PERCT4,$PERHR4_,$PERCT5,$PERHR5_,$PERCT6,$PERHR6_,$PERRFC_NUEVO,$cliente){
			include 'F_Insert/FUPPER.php';
		}	
		function importe($importe_total,$pdf){
			$pdf->SetFont('Arial','',7);
			$pdf->SetXY(100,75); 
			//$pdf->Cell(45,3,"$".number_format($importe_total,2),0,0,'L');
		}
		function oficio_capturo($OFICIO,$CAPTURO,$pdf){
			include 'Mostrar/oficio_capturo.php';
		}

		function Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,$baja){
			include 'Mostrar/anexos_observaciones.php';
		}
		function info_autorizaciones($NOMBRE_EMPLEADO,$FECHA,$IMPRIMIO,$REVISO,$pdf,$usuario){//info_aurorizaciones
				include 'Mostrar/pdfautorizaciones.php';
		}//info_aurorizaciones
		function dia($dias,$docto_num,$cliente,$pdf,$num,$i){
			$onlyconsonants = str_replace("/", "-", $dias);
		    $date = date_create($onlyconsonants);
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
	          
        	while($num_firma<$tot_regis_firmas){//while_firmas
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
	                       	//$pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
	                       	unlink("tempimg".$TEMPIMGLOC);
	                    }                
                    }        	                    
                    $pdf->SetFont('Arial','',8);               
                    $pdf->SetXY(105,186);
                    //$pdf->Cell(65,4, mb_convert_encoding($NOMBRE_AUTORIZACIONES),0,0,'L');	                    
                }
	                	                
                if($func == "true"){ 
                  if( $decodedImg!==false )
                  {
                  	if( file_put_contents("tempimg1".$TEMPIMGLOC,$decodedImg)!==false )
                  	{ 	                         
                    	$pdf->SetXY(175,$alto);
                    	//$pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
                    	unlink("tempimg1".$TEMPIMGLOC);
                  	}
                  	$pdf->SetXY(190,186);
                    $pdf->SetFont('Arial','',8);
                    //$pdf->Cell(65,4, mb_convert_encoding($NOMBRE_AUTORIZACIONES),0,0,'L');
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
	        }//while_firmas
            
		}//Fin Funcion Firmas
		function ant($valuesants,$tot_resul_ant,$dia,$pdf,$cliente,$filas,$retornar,$rfc,$valuestra,$FECHA,$FECHAD,$docto_num,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario){//funcionant
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
//var_dump($valuesants);
if($valuesants!=null){//undefined
		$resultados = $tot_resul_ant + 1;

		if($tot_resul_ant>10){
			$a=$filas*14;
			//$tot_resul_ant = $resultados;
		}/*else{
			$a=$filas*14;
		}*/
		//var_dump($valuesants);
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

			$importe_tot = "";
			$CONCEPTO = "";
			$IMPORTE = "";
			$numero5 = "";
/*
			$id_consultaAT =  155;//concepto e importe

			$metodo_consulta="ConsultaConceptoImporte_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';			
		    //var_dump($arrayAT);
		    $A0T = 0;
		    $xmlA0T = simplexml_load_string($arrayAT['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
			$jsonA0T = json_encode($xmlA0T);
			$arrayA0T = json_decode($jsonA0T,TRUE);	

			if(!empty($arrayA0T)){
		
				$verAT = $arrayA0T['NewDataSet']['table'];
				$total_resAT= count($verAT);
				//var_dump($verAT);
				
				 //while($A0T < $total_resAT){
				 	if(isset($verAT["imp_ze2"])){
						$importe_tot 	= $verAT["imp_ze2"];
					}
					$importe_total  = $importe_total + $importe_tot;
					if(isset($verAT["concepto"])){
						$CONCEPTO 		= $verAT["concepto"];
					}
					if(isset($verAT["imp_ze2"])){
						$numero5 		= $verAT["imp_ze2"];
						$IMPORTE 		= number_format($numero5,2);
					}	
					$im = 0;//importe($importe_total,$pdf);
					//importe($importe_total,$pdf);
					//$A0T++;
				//}
				
			}
*/
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
		if($Nivel_Sdo1==3){
			$CONCEPTO1 = "07";
			$CONCEPTO  = "07";
		}
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
		include 'Mostrar/pdfant.php';	
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
			
				insertarFUPPRE($arweas,$docto_num,$Pagina,$ID_PLA,$PDA,$CODIGO_PAGO,$UNIDAD,$SUBUNIDAD,$CATEGORIA,$HORAS1,$Plaza1,$ALTA,$CONCEPTO1,$numero6,$DESDE,$HASTA,$Valor,$DR,$iDR,$DRqna_ini,$DRqna_fin,$DRnum_docto,$BS,$iBS,$BSqna_ini,$BSqna_fin,$BSnum_docto,$I4,$iI4,$I4qna_ini,$I4qna_fin,$I4num_docto,$E3,$iE3,$E3qna_ini,$E3qna_fin,$E3num_docto,$cliente);
		}	
			$t++;
			$a = $a+14;
			$tot_reg++;
	}//inicio_while*/
}//undefined
/*------------------------------------------------TRABAJADOR------------------------------------------------*/				
$y = 0;

	        while ($y < $tot_resul_tra){ //2do while getDatosPDF
	        	//if($y==21){
	        	//var_dump($valuestra);	
	        	if(!isset($valuestra[0])){
	        		if(isset($valuestra["cpr"])){
	        			$code1 = 			$valuestra["cpr"];	
	        		}
				    if(isset($valuestra["curp"])){
				    	$CURP = 			$valuestra["curp"];	
				    }
				    if(isset($valuestra["num_docto"])){
						$NUM_DOCUMENTO= 	$valuestra['num_docto'];
					}
					if(isset($valuestra["rfc"])){
						$RFC= 				$valuestra['rfc'];
					}
					if(isset($valuestra["nom_emp"])){
						$NOMBRE_EMPLEADO= 	htmlspecialchars_decode($valuestra['nom_emp']);
					}
					if(isset($valuestra["edo_nac"])){
						$EDO_NAC=			$valuestra['edo_nac'];
					}
					if(isset($valuestra["sexo"])){
						$SEXO= 				$valuestra['sexo'];
					}
					if(isset($valuestra["edo_civil"])){
						$EDO_CIVIL= 		$valuestra['edo_civil'];
					}
					$DOMICILIO=			"PARTICULAR";
					if(isset($valuestra["emp_dom"])){
						
						if($valuestra["emp_dom"][0] == "                                                            " || $valuestra["emp_dom"][0] == "" || $valuestra["emp_dom"] == "                                                            " || $valuestra["emp_dom"] == ""){
			  				$CALLE		= "NULL";
			  			}else{
			  				$CALLE		= $valuestra['emp_dom'];	
			  			}

			  			/*
						if(!isset($valuestra[0]["emp_dom"])){
							$ca = $valuestra["emp_dom"];
							
						}else{
							$ca = $valuestra[0]["emp_dom"];

						}
						var_dump($ca);
						if(!isset($ca[0]){
							$ca = $valuestra["emp_dom"];
							
						}else{
							$ca = $valuestra[0]["emp_dom"];

						}
						if($ca=="" || $ca==" "){
							$CALLE= 			"NULL";
						}else{
							//$CALLE= 			htmlspecialchars_decode($valuestra['emp_dom']);
							$CALLE= 			"";//$valuestra['emp_dom'];
						}
						*/
					}
					//var_dump($CALLE);
					if(isset($valuestra["emp_dom_cp"])){
						$COD_POSTAL= 		$valuestra['emp_dom_cp'];
					}
					if(isset($valuestra["emp_dom_col"])){
						$LOCACION1= 		$valuestra['emp_dom_col'];
						$LOCACION= 			htmlspecialchars_decode($LOCACION1);
					}
					if(isset($valuestra["emp_dom_pob"])){
						$MUNICIPIO1= 		$valuestra['emp_dom_pob'];
						$MUNICIPIO= 		htmlspecialchars_decode($MUNICIPIO1);
					}
					if(isset($valuestra["Puesto"])){
						$PUESTO=  			$valuestra['Puesto'];
					}
					if(isset($valuestra["qna_ing_gob"])){
						$QNA_INI_GOB= 		$valuestra['qna_ing_gob'];
					}
					if(isset($valuestra["qna_ing_sep"])){
						$QNA_ING_SEP= 		$valuestra['qna_ing_sep'];
					}
					if(isset($valuestra["num_tit"])){
						$numero1 =  		$valuestra['num_tit'];
						$NUM_TITULO = 		str_pad($numero1, 9, "0", STR_PAD_LEFT);
					}
					if(isset($valuestra["num_lic"])){
						$numero2 =  		$valuestra['num_lic'];
						$NUM_LICENCIATURA = str_pad($numero2, 9, "0", STR_PAD_LEFT);
					}
					$LICENCIATURA=		"";//"LIC.";
					$TITULO=			"";//"TIT.";
					$MA=				"";//"MA.";
					$DO=				"";//"DO.";
					if(isset($valuestra["ct"])){
						$CT= 				$valuestra['ct'];
					}
					$IMPRIMIO= "";
					$REVISO= "MPLO";
					if(isset($valuestra["nombre_area"])){
						$nom_area= 						$valuestra['nombre_area'];
					}
					if(isset($valuestra["area"])){
						$AREA_PER= 						$valuestra['area'];
					}
					$RAMA=$AREA_PER;
					$NUM_DOCTO_cpr = substr($docto_num,4,10);
					$CURP_cpr = substr($CURP,15,18);
					$CPR1 = $CURP_cpr.$NUM_DOCTO_cpr;
					$code = $CPR1;
				
					$y++;
				}else{
					if(isset($valuestra[$y]["cpr"])){
	        			$code1 = 			$valuestra[$y]["cpr"];	
	        		}
				    if(isset($valuestra[$y]["curp"])){
				    	$CURP = 			$valuestra[$y]["curp"];	
				    }
				    if(isset($valuestra[$y]["num_docto"])){
						$NUM_DOCUMENTO= 	$valuestra[$y]['num_docto'];
					}
					if(isset($valuestra[$y]["rfc"])){
						$RFC= 				$valuestra[$y]['rfc'];
					}
					if(isset($valuestra[$y]["nom_emp"])){
						$NOMBRE_EMPLEADO= 	htmlspecialchars_decode($valuestra[$y]['nom_emp']);
					}
					if(isset($valuestra[$y]["edo_nac"])){
						$EDO_NAC=			$valuestra[$y]['edo_nac'];
					}
					if(isset($valuestra[$y]["sexo"])){
						$SEXO= 				$valuestra[$y]['sexo'];
					}
					if(isset($valuestra[$y]["edo_civil"])){
						$EDO_CIVIL= 		$valuestra[$y]['edo_civil'];
					}
					$DOMICILIO=			"PARTICULAR";
					if(isset($valuestra[$y]["emp_dom"])){
						$CALLE= 			htmlspecialchars_decode($valuestra[$y]['emp_dom']);
					}
					if(isset($valuestra[$y]["emp_dom_cp"])){
						$COD_POSTAL= 		$valuestra[$y]['emp_dom_cp'];
					}
					if(isset($valuestra[$y]["emp_dom_col"])){
						$LOCACION1= 		$valuestra[$y]['emp_dom_col'];
						$LOCACION= 			htmlspecialchars_decode($LOCACION1);
					}
					if(isset($valuestra[$y]["emp_dom_pob"])){
						$MUNICIPIO1= 		$valuestra[$y]['emp_dom_pob'];
						$MUNICIPIO= 		htmlspecialchars_decode($MUNICIPIO1);
					}
					if(isset($valuestra[$y]["Puesto"])){
						$PUESTO=  			$valuestra[$y]['Puesto'];
					}
					if(isset($valuestra[$y]["qna_ing_gob"])){
						$QNA_INI_GOB= 		$valuestra[$y]['qna_ing_gob'];
					}
					if(isset($valuestra[$y]["qna_ing_sep"])){
						$QNA_ING_SEP= 		$valuestra[$y]['qna_ing_sep'];
					}
					if(isset($valuestra[$y]["num_tit"])){
						$numero1 =  		$valuestra[$y]['num_tit'];
						$NUM_TITULO = 		str_pad($numero1, 9, "0", STR_PAD_LEFT);
					}
					if(isset($valuestra[$y]["num_lic"])){
						$numero2 =  		$valuestra[$y]['num_lic'];
						$NUM_LICENCIATURA = str_pad($numero2, 9, "0", STR_PAD_LEFT);
					}
					$LICENCIATURA=		"";//"LIC.";
					$TITULO=			"";//"TIT.";
					$MA=				"";//"MA.";
					$DO=				"";//"DO.";
					if(isset($valuestra[$y]["ct"])){
						$CT= 				$valuestra[$y]['ct'];
					}
					$IMPRIMIO= "";
					$REVISO= "MPLO";
					if(isset($valuestra[$y]["nombre_area"])){
						$nom_area= 						$valuestra[$y]['nombre_area'];
					}
					if(isset($valuestra[$y]["area"])){
						$AREA_PER= 						$valuestra[$y]['area'];
					}
					$RAMA=$AREA_PER;
					$NUM_DOCTO_cpr = substr($docto_num,4,10);
					$CURP_cpr = substr($CURP,15,18);
					$CPR1 = $CURP_cpr.$NUM_DOCTO_cpr;
					$code = $CPR1;
					$y++;					
				}
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

		info_autorizaciones($NOMBRE_EMPLEADO,$FECHA,$IMPRIMIO,$REVISO,$pdf,$usuario);
		 
		//if($pdf->PageNo()==1){
			if($dia!="si"){
				
					insertarFUPPER($AREA_PER,$docto_num,$RFC,$NOMBRE_EMPLEADO,$EDO_NAC,$SEXO,$EDO_CIVIL,$CALLE,$LOCACION,$MUNICIPIO,$COD_POSTAL,$PUESTO,$QNA_INI_GOB,$QNA_ING_SEP,$numero1,$numero2,$PERQ,$PERA,$PERL,$PERT,$PERCT1,$PERHR1_,$PERCT2,$PERHR2_,$PERCT3,$PERHR3_,$PERCT4,$PERHR4_,$PERCT5,$PERHR5_,$PERCT6,$PERHR6_,$PERRFC_NUEVO,$cliente);
			}
		//}	
/*------------------------------------------------TRABAJADOR------------------------------------------------*/	
	
			$DOC_OBSRV1_ = str_replace(array('"',"'"), '\"', $checs1);
			$DOC_OBSRV2_ = str_replace(array('"',"'"), '\"', $checs2);
			$DOC_OBSRV3_ = str_replace(array('"',"'"), '\"', $checs3);
			$DOC_OBSRV4_ = str_replace(array('"',"'"), '\"', $checs4);

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

			$DOC_ANEXA1_M = strtoupper(mb_convert_encoding($DOC_ANEXA1_, 'ISO-8859-1', 'UTF-8'));
			$DOC_ANEXA2_M = strtoupper(mb_convert_encoding($DOC_ANEXA2_, 'ISO-8859-1', 'UTF-8'));
			$DOC_ANEXA3_M = strtoupper(mb_convert_encoding($DOC_ANEXA3_, 'ISO-8859-1', 'UTF-8'));
			$DOC_ANEXA4_M = strtoupper(mb_convert_encoding($DOC_ANEXA4_, 'ISO-8859-1', 'UTF-8'));
			$DOC_ANEXA5_M = strtoupper(mb_convert_encoding($DOC_ANEXA5_, 'ISO-8859-1', 'UTF-8'));

			$DOC_OBSRV1_M = strtoupper(mb_convert_encoding($DOC_OBSRV1_, 'ISO-8859-1', 'UTF-8'));
			$DOC_OBSRV2_M = strtoupper(mb_convert_encoding($DOC_OBSRV2_, 'ISO-8859-1', 'UTF-8'));
			$DOC_OBSRV3_M = strtoupper(mb_convert_encoding($DOC_OBSRV3_, 'ISO-8859-1', 'UTF-8'));
			$DOC_OBSRV4_M = strtoupper(mb_convert_encoding($DOC_OBSRV4_, 'ISO-8859-1', 'UTF-8'));


			
			 $id_consultaDOCS = 	136;
			 $metodo_consulta="ConsultaDocs_Original1";
			 include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
			
			if($retornar=="importes"){
				return $importe_total;
			}
		}//funcionant
		function mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas,$docto_num,$dias,$usuario,$operacion,$observacion,$fec_def){//funcionm,$diasov
			$OFICIO="";
			$CAPTURO=""; 
			$AREA_PLA=""; 
			$Pagina = 0;
			$ID_PLA = "1";
			$NOMBRE_SUS_MOV="";
			$NOMBRE_SUS_MOV1="NULL";
			$RFCSUS_MOV="";
			$RFCSUS_MOV1="NULL";
			$MOT_MOVSUS="";
			$MOT_MOVSUS1="NULL";
			$QNA_INISUS_MOV1="0";
			$QNA_FINSUS_MOV1="0";
			$NUM_DOCUMENTOSUS="";
			$NUM_DOCUMENTOSUS1="0";
			$PLA_BASIFICACION ="";
			$PLA_PROMOCION = "";
			$PLAQNA_ING_SUB  = "";

			$b=0;
			$i=0;
			$e = $tot_resul_mov + 1;

			if($tot_resul_mov>10){
				$b=$filas;
			}
		  	while ($b < $tot_resul_mov){//$total_res*30 //2do while getDatosPDF_Mov
		  		if(!isset($valuesmov[0])){
		  			if(isset($valuesmov['cve_mov'])){
						$M= 					$valuesmov['cve_mov'];
						$TM = 					str_pad($M, 2, "0", STR_PAD_LEFT);
					}
					if(isset($valuesmov['mot_mov'])){
						$MO1= 					$valuesmov['mot_mov'];//10";
						$MO = 					str_pad($MO1, 2, "0", STR_PAD_LEFT);
					}
					if(isset($valuesmov['partida'])){
						$PARTIDA_MOV= 			$valuesmov['partida'];
						if($PARTIDA_MOV=="" || $PARTIDA_MOV=="0"){
							$PARTIDA_MOV = "NULL";
							$PARTIDA_MOVR = "";
						}else{
							$PARTIDA_MOV = $valuesmov['partida'];
							$PARTIDA_MOVR = $valuesmov['partida'];
						}
					}else{
						$PARTIDA_MOV = "NULL";
						$PARTIDA_MOVR = "";
					}
					if(isset($valuesmov['cod_pago'])){
						$CODIGO_PAGO_MOV1= 		$valuesmov['cod_pago'];
						if($CODIGO_PAGO_MOV1==00){
							$CODIGO_PAGO_MOV = "NULL";
							$CODIGO_PAGO_MOVR = "";
						}else{
							$CODIGO_PAGO_MOV =      str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
							$CODIGO_PAGO_MOVR =      str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
						}
					}else{
						$CODIGO_PAGO_MOV = "NULL";
							$CODIGO_PAGO_MOVR = "";
					}
					if(isset($valuesmov['unidad'])){
						$UNIDAD_MOV= 			$valuesmov['unidad'];
						if($UNIDAD_MOV == 0){
							$UNIDAD_MOV = "NULL";
							$UNIDAD_MOVR = "";
						}else{
							$UNIDAD_MOV = $valuesmov['unidad'];
							$UNIDAD_MOVR = $valuesmov['unidad'];
						}
					}else{
						$UNIDAD_MOV = "NULL";
							$UNIDAD_MOVR = "";
					}
					if(isset($valuesmov['subunidad'])){
						$SUBUNIDAD_MOV= 		$valuesmov['subunidad'];
						if($SUBUNIDAD_MOV == 0){
							$SUBUNIDAD_MOV = "NULL";
							$SUBUNIDAD_MOVR = "";
						}else{
							$SUBUNIDAD_MOV = $valuesmov['subunidad'];
							$SUBUNIDAD_MOVR = $valuesmov['subunidad'];
						}
					}else{
						$SUBUNIDAD_MOV = "NULL";
							$SUBUNIDAD_MOVR = "";
					}
					if(isset($valuesmov['cat_puesto'])){
						$CATEGORIA_MOV= 		$valuesmov['cat_puesto'];

						if($CATEGORIA_MOV == "" || $CATEGORIA_MOV == "NULL   "){
							$CATEGORIA_MOV = "NULL";
							$CATEGORIA_MOVR = "";
						}else{
							$CATEGORIA_MOV = $valuesmov['cat_puesto'];
							$CATEGORIA_MOVR = $valuesmov['cat_puesto'];
						}
					}else{
						$CATEGORIA_MOV = "NULL";
							$CATEGORIA_MOVR = "";
					}
					if(isset($valuesmov['horas'])){
						$HORAS_MOV =  			$valuesmov['horas'];
						//var_dump($HORAS_MOV);
						if($SUBUNIDAD_MOV=="NULL" && $HORAS_MOV == "0"){
							$HORAS_MOV = "0.0";
							$HORAS_MOVR = "0.0";
						}else{
							$HORAS_MOV = $valuesmov['horas'];
							$HORAS_MOVR = $valuesmov['horas'];
						}
					}else{
						$HORAS_MOV = "0.0";
							$HORAS_MOVR = "0.0";
					}
					if(isset($valuesmov['cons_plaza'])){
						$numero =  				$valuesmov['cons_plaza'];
						$PLAZA_MOV = 			str_pad($numero, 6, "0", STR_PAD_LEFT);
						if($PLAZA_MOV==000000){
							$PLAZA_MOV = "NULL";
							$PLAZA_MOVR = "";
						}else{
							$PLAZA_MOV = str_pad($numero, 6, "0", STR_PAD_LEFT);
							$PLAZA_MOVR = str_pad($numero, 6, "0", STR_PAD_LEFT);
						}
					}else{
						$PLAZA_MOV = "NULL";
							$PLAZA_MOVR = "";
					}
					if(isset($valuesmov['qna_ini_emp'])){
						$DESDE_MOV= 			$valuesmov['qna_ini_emp'];
					}
					if(isset($valuesmov['qna_fin_emp'])){
						$HASTA_MOV= 			$valuesmov['qna_fin_emp'];
					}
					if(isset($valuesmov['qna_inisus'])){
						$QNA_INISUS_MOV =  		$valuesmov['qna_inisus'];
						if($QNA_INISUS_MOV == ""){
							$QNA_INISUS_MOV = "";
							$QNA_INISUS_MOV1= "0";
						}else{
							$QNA_INISUS_MOV1 =  	$valuesmov['qna_inisus'];
							$QNA_INISUS_MOV =  		$valuesmov['qna_inisus'];
						}
					}else{
						$QNA_INISUS_MOV1= "0";
					}
					if(isset($valuesmov['qna_finsus'])){
						$QNA_FINSUS_MOV =  		$valuesmov['qna_finsus'];
						if($QNA_FINSUS_MOV == ""){
							$QNA_FINSUS_MOV = "";
							$QNA_FINSUS_MOV1= "0";
						}else{
							$QNA_FINSUS_MOV1 =  	$valuesmov['qna_finsus'];
							$QNA_FINSUS_MOV =  		$valuesmov['qna_finsus'];
						}
					}else{
						$QNA_FINSUS_MOV1 =  	"0";
					}
					if(isset($valuesmov['nom_empsus'])){
						$NOMBRE_SUS_MOV =  		$valuesmov['nom_empsus'];
						$NOMBRE_SUS_MOV1 =  		$valuesmov['nom_empsus'];
					}else{
						$NOMBRE_SUS_MOV1 = "NULL";
					}
					if(isset($valuesmov['rfcsus'])){
						$RFCSUS_MOV  =  			$valuesmov['rfcsus'];
						$RFCSUS_MOV1 =  			$valuesmov['rfcsus'];
					}else{
						$RFCSUS_MOV1 = "NULL";
					}
					if(isset($valuesmov['mot_movsus'])){
						$MOT_MOVSUS =  			$valuesmov['mot_movsus'];
						$MOT_MOVSUS1 =  			$valuesmov['mot_movsus'];
					}else{
						$MOT_MOVSUS1 = "NULL";
					}
					if(isset($valuesmov['num_doctosus'])){
						$NUM_DOCUMENTOSUS= 		$valuesmov['num_doctosus'];
						if($NUM_DOCUMENTOSUS == ""){$NUM_DOCUMENTOSUS = "0";}
						else{$NUM_DOCUMENTOSUS1=$valuesmov['num_doctosus'];}
					}else{
						$NUM_DOCUMENTOSUS = "0";
					}
					if(isset($valuesmov['ctnvo'])){
						$CT_MOV= 				$valuesmov['ctnvo'];
					}
					if(isset($valuesmov['nivel_sueldonvo'])){
						$NIVEL_SUELDO_NUEVO= 	$valuesmov['nivel_sueldonvo'];
						if($NIVEL_SUELDO_NUEVO == ""){$NIVEL_SUELDO_NUEVO = "";}
					}else{
						$NIVEL_SUELDO_NUEVO = "";
					}
					$PLA_BASIFICACION1="";
					if($PLA_BASIFICACION1==""){$PLA_BASIFICACION="0";}
					$PLA_PROMOCION1="";
					if($PLA_PROMOCION1==""){$PLA_PROMOCION="0";}				
					$PLAQNA_ING_SUB1="";
					if($PLAQNA_ING_SUB1==""){$PLAQNA_ING_SUB="0";}	
					if(isset($valuesmov['descripcion1']) && isset($valuesmov['descripcion2'])){			
						$DESCRIPCION1 =  		$valuesmov['descripcion2'];                                 
						$DESCRIPCION2 =  		$valuesmov['descripcion1'];
						$DESCRIPCION =          $DESCRIPCION1." ".$DESCRIPCION2;	
					}
					if(isset($valuesmov['num_oficio'])){
						$OFICIO= 				$valuesmov['num_oficio'];
					}
					if(isset($valuesmov['operador'])){
						$CAPTURO= 				$valuesmov['operador'];
						if($CAPTURO==""){
							$CAPTURO = "MPLO";
						}
					}
					if(isset($valuesmov['area'])){
						$AREA_PLA=				$valuesmov['area'];
					}
					if(isset($valuesmov['cons_doc'])){
						$CONS_DOC=				$valuesmov['cons_doc'];
					}
					
					include 'Mostrar/pdfmov.php';
					$Pagina =  $pdf->PageNo();
					insertarFUPMOV($AREA_PLA,$docto_num,$Pagina,$ID_PLA,$TM,$MO,$CONS_DOC,$PARTIDA_MOV,$CODIGO_PAGO_MOV,$UNIDAD_MOV,$SUBUNIDAD_MOV,$CATEGORIA_MOV,$HORAS_MOV,$PLAZA_MOV,$DESDE_MOV,$HASTA_MOV,$NOMBRE_SUS_MOV1,$RFCSUS_MOV1,$MOT_MOVSUS1,$QNA_INISUS_MOV1,$QNA_FINSUS_MOV1,$NUM_DOCUMENTOSUS1,$CT_MOV,$NIVEL_SUELDO_NUEVO,$PLA_BASIFICACION,$PLA_PROMOCION,$PLAQNA_ING_SUB,$cliente);
					$i++;
					$b++;					
				}else{
					if(isset($valuesmov[$b]['cve_mov'])){
						$M= 					$valuesmov[$b]['cve_mov'];
						$TM = 					str_pad($M, 2, "0", STR_PAD_LEFT);
					}
					if(isset($valuesmov[$b]['mot_mov'])){
						$MO1= 					$valuesmov[$b]['mot_mov'];//10";
						$MO = 					str_pad($MO1, 2, "0", STR_PAD_LEFT);
					}
					if(isset($valuesmov[$b]['partida'])){
						$PARTIDA_MOV= 			$valuesmov[$b]['partida'];
						if($PARTIDA_MOV=="" || $PARTIDA_MOV=="0"){
							$PARTIDA_MOV = "NULL";
							$PARTIDA_MOVR = "";
						}else{
							$PARTIDA_MOV = $valuesmov[$b]['partida'];
							$PARTIDA_MOVR = $valuesmov[$b]['partida'];
						}
					}else{
						$PARTIDA_MOVR = "";
						$PARTIDA_MOV = "NULL";
					}
					if(isset($valuesmov[$b]['cod_pago'])){
						$CODIGO_PAGO_MOV1= 		$valuesmov[$b]['cod_pago'];
						if($CODIGO_PAGO_MOV1==00){
							$CODIGO_PAGO_MOV = "NULL";
							$CODIGO_PAGO_MOVR = "";
						}else{
							$CODIGO_PAGO_MOV =      str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
							$CODIGO_PAGO_MOVR =      str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
						}
					}else{
						$CODIGO_PAGO_MOVR = "";
						$CODIGO_PAGO_MOV = "NULL";
					}
					if(isset($valuesmov[$b]['unidad'])){
						$UNIDAD_MOV= 			$valuesmov[$b]['unidad'];
						if($UNIDAD_MOV == 0){
							$UNIDAD_MOV = "NULL";
							$UNIDAD_MOVR = "";
						}else{
							$UNIDAD_MOV = $valuesmov[$b]['unidad'];
							$UNIDAD_MOVR = $valuesmov[$b]['unidad'];
						}
					}else{
						$UNIDAD_MOVR = "";
						$UNIDAD_MOV = "NULL";
					}
					if(isset($valuesmov[$b]['subunidad'])){
						$SUBUNIDAD_MOV= 		$valuesmov[$b]['subunidad'];
						if($SUBUNIDAD_MOV == 0){
							$SUBUNIDAD_MOV = "NULL";
							$SUBUNIDAD_MOVR = "";
						}else{
							$SUBUNIDAD_MOV = $valuesmov[$b]['subunidad'];
							$SUBUNIDAD_MOVR = $valuesmov[$b]['subunidad'];
						}
					}else{
						$SUBUNIDAD_MOVR = "";
						$SUBUNIDAD_MOV = "NULL";
					}
					if(isset($valuesmov[$b]['cat_puesto'])){
						$CATEGORIA_MOV= 		$valuesmov[$b]['cat_puesto'];

						if($CATEGORIA_MOV == "" || $CATEGORIA_MOV == "NULL   "){
							$CATEGORIA_MOV = "NULL";
							$CATEGORIA_MOVR = "";
						}else{
							$CATEGORIA_MOV = $valuesmov[$b]['cat_puesto'];;
							$CATEGORIA_MOVR = $valuesmov[$b]['cat_puesto'];;
						}
					}else{
						$CATEGORIA_MOVR = "";
						$CATEGORIA_MOV = "NULL";
					}
					if(isset($valuesmov[$b]['horas'])){
						$HORAS_MOV =  			$valuesmov[$b]['horas'];
						if($SUBUNIDAD_MOV=="NULL" && $HORAS_MOV == "0"){
							$HORAS_MOV = "0.0";
							$HORAS_MOVR = "0.0";
						}else{
							$HORAS_MOV = $valuesmov[$b]['horas'];
							$HORAS_MOVR = $valuesmov[$b]['horas'];
						}
					}else{
						$HORAS_MOVR = "";
						$HORAS_MOV = "0.0";
					}
					if(isset($valuesmov[$b]['cons_plaza'])){
						$numero =  				$valuesmov[$b]['cons_plaza'];
						$PLAZA_MOV = 			str_pad($numero, 6, "0", STR_PAD_LEFT);
						if($PLAZA_MOV==000000){
							$PLAZA_MOV = "NULL";
							$PLAZA_MOVR = "";
						}else{
							$PLAZA_MOV = str_pad($numero, 6, "0", STR_PAD_LEFT);
							$PLAZA_MOVR = str_pad($numero, 6, "0", STR_PAD_LEFT);
						}
					}else{
						$PLAZA_MOVR = "";
						$PLAZA_MOV = "NULL";
					}
					if(isset($valuesmov[$b]['qna_ini_emp'])){
						$DESDE_MOV= 			$valuesmov[$b]['qna_ini_emp'];
					}
					if(isset($valuesmov[$b]['qna_fin_emp'])){
						$HASTA_MOV= 			$valuesmov[$b]['qna_fin_emp'];
					}
					if(isset($valuesmov[$b]['qna_inisus'])){
						$QNA_INISUS_MOV =  		$valuesmov[$b]['qna_inisus'];
						if($QNA_INISUS_MOV == ""){
							$QNA_INISUS_MOV = "";
							$QNA_INISUS_MOV1= "0";
						}else{
							$QNA_INISUS_MOV1 =  	$valuesmov[$b]['qna_inisus'];
							$QNA_INISUS_MOV =  		$valuesmov[$b]['qna_inisus'];
						}
					}
					if(isset($valuesmov[$b]['qna_finsus'])){
						$QNA_FINSUS_MOV =  		$valuesmov[$b]['qna_finsus'];
						if($QNA_FINSUS_MOV == ""){
							$QNA_FINSUS_MOV = "";
							$QNA_FINSUS_MOV1= "0";
						}else{
							$QNA_FINSUS_MOV1 =  	$valuesmov[$b]['qna_finsus'];
							$QNA_FINSUS_MOV =  		$valuesmov[$b]['qna_finsus'];
						}
					}
					if(isset($valuesmov[$b]['nom_empsus'])){
						$NOMBRE_SUS_MOV =  		$valuesmov[$b]['nom_empsus'];
						if($NOMBRE_SUS_MOV == "" ){$NOMBRE_SUS_MOV = "NULL";}
						if($NOMBRE_SUS_MOV == "NULL" ){$NOMBRE_SUS_MOV1 = "NULL";}else{$NOMBRE_SUS_MOV1 =  		$valuesmov[$b]['nom_empsus'];}
					}else{
						$NOMBRE_SUS_MOV1 = "NULL";
					}
					if(isset($valuesmov[$b]['rfcsus'])){
						$RFCSUS_MOV =  			$valuesmov[$b]['rfcsus'];
						if($RFCSUS_MOV == "NULL" ){$RFCSUS_MOV1 = "NULL";}else{$RFCSUS_MOV1 =  		$valuesmov[$b]['rfcsus'];}
					}else{
						$RFCSUS_MOV1 = "NULL";
					}
					if(isset($valuesmov[$b]['mot_movsus'])){
						$MOT_MOVSUS =  			$valuesmov[$b]['mot_movsus'];
						if($MOT_MOVSUS == ""){$MOT_MOVSUS = "NULL";}
						if($MOT_MOVSUS == "NULL" ){$MOT_MOVSUS1 = "NULL";}else{$MOT_MOVSUS1 =  		$valuesmov[$b]['mot_movsus'];}
					}else{
						$MOT_MOVSUS1 = "NULL";
					}
					if(isset($valuesmov[$b]['num_doctosus'])){
						$NUM_DOCUMENTOSUS= 		$valuesmov[$b]['num_doctosus'];
						if($NUM_DOCUMENTOSUS == ""){$NUM_DOCUMENTOSUS = "0";}
						else{$NUM_DOCUMENTOSUS1=$valuesmov[$b]['num_doctosus'];}
					}else{
						$NUM_DOCUMENTOSUS = "0";
					}
					if(isset($valuesmov[$b]['ctnvo'])){
						$CT_MOV= 				$valuesmov[$b]['ctnvo'];
					}
					if(isset($valuesmov[$b]['nivel_sueldonvo'])){
						$NIVEL_SUELDO_NUEVO= 	$valuesmov[$b]['nivel_sueldonvo'];
						if($NIVEL_SUELDO_NUEVO == ""){$NIVEL_SUELDO_NUEVO = "";}
					}
					$PLA_BASIFICACION1="";
					if($PLA_BASIFICACION1==""){$PLA_BASIFICACION="0";}
					$PLA_PROMOCION1="";
					if($PLA_PROMOCION1==""){$PLA_PROMOCION="0";}				
					$PLAQNA_ING_SUB1="";
					if($PLAQNA_ING_SUB1==""){$PLAQNA_ING_SUB="0";}	
					if(isset($valuesmov[$b]['descripcion1']) && isset($valuesmov[$b]['descripcion2'])){			
						$DESCRIPCION1 =  		$valuesmov[$b]['descripcion2'];                                 
						$DESCRIPCION2 =  		$valuesmov[$b]['descripcion1'];
						$DESCRIPCION =          $DESCRIPCION1." ".$DESCRIPCION2;	
					}
					if(isset($valuesmov[$b]['num_oficio'])){
						$OFICIO= 				$valuesmov[$b]['num_oficio'];
					}
					if(isset($valuesmov[$b]['operador'])){
						$CAPTURO= 				$valuesmov[$b]['operador'];
						if($CAPTURO==""){
							$CAPTURO = "MPLO";
						}
					}
					if(isset($valuesmov[$b]['area'])){
						$AREA_PLA=				$valuesmov[$b]['area'];
					}
					if(isset($valuesmov[$b]['cons_doc'])){
						$CONS_DOC=				$valuesmov[$b]['cons_doc'];
					}
					
					include 'Mostrar/pdfmov.php';
					$Pagina =  $pdf->PageNo();
					insertarFUPMOV($AREA_PLA,$docto_num,$Pagina,$ID_PLA,$TM,$MO,$CONS_DOC,$PARTIDA_MOV,$CODIGO_PAGO_MOV,$UNIDAD_MOV,$SUBUNIDAD_MOV,$CATEGORIA_MOV,$HORAS_MOV,$PLAZA_MOV,$DESDE_MOV,$HASTA_MOV,$NOMBRE_SUS_MOV1,$RFCSUS_MOV1,$MOT_MOVSUS1,$QNA_INISUS_MOV1,$QNA_FINSUS_MOV1,$NUM_DOCUMENTOSUS1,$CT_MOV,$NIVEL_SUELDO_NUEVO,$PLA_BASIFICACION,$PLA_PROMOCION,$PLAQNA_ING_SUB,$cliente);
					$i++;
					$b++;				
				}
	        }//fin 2do while getDatosPDF_Mov
	        oficio_capturo($OFICIO,$CAPTURO,$pdf);
	        
        	insertarFUPID($AREA_PLA,$docto_num,$Pagina,$OFICIO,$usuario,$operacion,$observacion,$cliente);

	        $ID="";
			$id_consultaID = 	259;//desarrollo	        
			//$id_consultaID = 	251;//produccion	    
			$JSON_ID="[{\"num_docto\":\"$docto_num\"}]";
		    $array_ID = json_decode(json_encode($JSON_ID), True);
		    $params_ID = array('Resultado'=>$id_consultaID, 'Argumento'=>$array_ID, 'Accion'=>"select"); //para conseguir la consulta
		    //var_dump($params_ID);
		    $resultados_ID=$cliente->getConsulta($params_ID);
			$arrayR_ID= json_decode(json_encode($resultados_ID), True);
			//var_dump($arrayR_ID); 	  
			$xmlID = simplexml_load_string($arrayR_ID['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
			$jsonID = json_encode($xmlID);
			$arrayID = json_decode($jsonID,TRUE);	       
			if(!empty($arrayID)){
		
				$verID = $arrayID['NewDataSet']['table'];
				$total_resID    = count($verID);
		        $ID 		  = $verID["id"];

	        }//finforeachID   
	        insertarPDFID($ID,$pdf);
		}//funcionmov      
?>