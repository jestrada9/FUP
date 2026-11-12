<?php
	ini_set("soap.wsdl_cache_enabled", "0");

	include '../../Cascaron/Cascaron.php';			
	include_once '../../Codigo_Barras/barcode.php';
	require_once('../../lib/nusoap.php');
	require_once('../../Conexion/wsdl.php'); 	

	$usuario = $_POST['usuario'];
	$docto_numFUP = $_POST['buscar'];
	$num_oficioFUP = $_POST['oficio'];
	$rfcFUP 	   = $_POST['rfc'];
	$areaFUP 	   = $_POST['area'];

	$tam = strlen($rfcFUP);
	$rfc = substr($rfcFUP,0,$tam-3);

	$dia = "no";
	$dias = "";
	$fec_def = "";

	$fec = date('d-m-Y');
	$observacion = "Creacion Original";
	$operacion = "Creacion Original";
					
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
			
					
	$id_consultaAnt = 1281; //PRODUCCION
	$metodo_consulta="ConsultaAntecedente_Original_CT";
	include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
	//var_dump($arrayR3_Ant);
	/*
	if($arrayR3_Ant!=null){

	}
	*/
	$xmlAnt = simplexml_load_string($arrayR3_Ant['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
	$jsonAnt = json_encode($xmlAnt);
	$arrayAnt = json_decode($jsonAnt,TRUE);	
	$yAnt=0;
	if(!empty($arrayAnt)){
		$valuesant = $arrayAnt['NewDataSet']['table'];
		$valuesants = $arrayAnt['NewDataSet'];
		if(!isset($valuesant[0])){
        	$tot_resul_ant=count($valuesants);	
		}else{
			$tot_resul_ant=count($valuesant);				
		}				        	
	}
							
	$id_consulta_Mov = 	1282;//MOVIMIENTOS 
	$metodo_consulta="ConsultaMovimientos_Original_CT";
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
			//echo "hola";
        	$tot_resul_mov=count($valuesmovs);		
		}else{
			//echo "adios";
			$tot_resul_mov=count($valuesmov);			
		}							
	}
					
	$id_consulta_TRA = 	1283;//TRABAJADOR 
	$metodo_consulta="ConsultaTrabajador_Original_CT";
	include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
	$xmltra = simplexml_load_string($arrayR3_TRA['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
	$jsontra = json_encode($xmltra);
	$arraytra = json_decode($jsontra,TRUE);			
    $CURPtra       = "";
	$rfc 		   = "";
	$nom_area      = "";
	$tot_resul_tra = 0;
	//var_dump($arraytra);
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
									$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);
								}else{
									ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}	

							}else{

								if($tot_resul_ant!=0){
									
										$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
										$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);

									
								}else{
									ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}
							}
						}else{//$reccG==$LimiteM	

							if($tot_resul_ant==$LimiteM){//$reccG==$tot_resul_ant

								ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								
							}else{//$reccG==$tot_resul_ant

								if($tot_resul_ant!=0){
									
									$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
										$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);
								}else{
									ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}
							}//$reccG==$tot_resul_ant
						
						}//$reccG==$LimiteM

					}//tra!=0

					if($tot_resul_mov!=0){//mov!=0
						$filas = $reccG - $LimiteM;

						mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);

					}//mov!=0								

					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,"no",);
					}

	}//dia si
					$pdf->AddPage();
					//echo $pdf->PageNo();
					if($tot_resul_tra!=0){//tra!=0
						
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
					}//tra!=0		

					if($tot_resul_tra!=0){

						if($reccG<=$LimiteM){//$reccG==$LimiteM
							if($tot_resul_ant<$LimiteA){
								
								if($tot_resul_ant!=0){
									$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
									//var_dump($valuesant);
									//var_dump($tot_resul_ant);
									//goal
									$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);

									importe($importe_total,$pdf);
								}else{

									ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}	

							}else{

								if($tot_resul_ant!=0){
									
										$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
										$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);												
								}else{
									ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}
							}
						}else{//$reccG==$LimiteM	

							if($tot_resul_ant==$LimiteM){//$reccG==$tot_resul_ant

								ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								
							}else{//$reccG==$tot_resul_ant

								if($tot_resul_ant!=0){
									
									$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
										$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
										importe($importe_total,$pdf);
								}else{
									ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}
							}//$reccG==$tot_resul_ant
						
						}//$reccG==$LimiteM

					}//tra!=0

					if($tot_resul_mov!=0){//mov!=0
						$filas = $reccG - $LimiteM;

						mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);

					}//mov!=0								

					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$dia,);
					}

				}else{//else $reccG%$LimiteM==0
						
					if($reccG%$tot_glo==0){//reccG==tot_resul_ant
	if($dia == "si"){
						$pdf->AddPage();

						if($tot_resul_tra!=0){//tra!=0
							
							Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
						}//tra!=0									
						$reg =  $tot_resul_ant - $LimiteM;
						if($reccG==$tot_resul_ant){
							if($tot_resul_ant!=0){
							$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);														
							}else{
								ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							}
						}else{

							if($tot_resul_ant!=0){
							if($tot_resul_ant>$LimiteA){
							$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
							//echo $filas;
							$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);
							//cambio 19/09/2022	
							}elseif($tot_resul_ant<$LimiteA){
								ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							}else{
							$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
								//echo $filas;
								
								$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);
								
							
							}
							//cambio 19/09/2022
						}else{
							ant(NULL,NULL,"no",$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
						}
					}

						if($tot_resul_mov!=0){//mov!=0
							$filas = $reccG - $tot_resul_mov%$LimiteM;
							mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
						}//mov!=0

						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,"no",);
						}

	}
						$pdf->AddPage();
						//echo $pdf->PageNo();
						if($tot_resul_tra!=0){//tra!=0
							
							Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
						}//tra!=0									
						$reg =  $tot_resul_ant - $LimiteM;
						if($reccG==$tot_resul_ant){

							if($tot_resul_ant!=0){
								$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);														
							}else{

								ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							}
						}else{
							//echo "ayiq";
							if($tot_resul_ant!=0){

							if($tot_resul_ant>$LimiteA){

							$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
							//echo $filas;
							$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);

							}elseif($tot_resul_ant<$LimiteA){

								if($tot_resul_ant==0){
									ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								}else{
													
									$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
								
								$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);
									//ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);			
								}
							}else{
								$filas = $tot_resul_ant - $tot_resul_ant%$LimiteM;
								
								$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);
								
							
							}
							//cambio 19/09/2022
						}else{
							ant(NULL,NULL,$dia,$pdf,$cliente,NULL,"importes",NULL,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
						}
					}
						if($tot_resul_mov>$LimiteA){

						if($tot_resul_mov!=0){//mov!=0
								$filas = $reccG - $tot_resul_mov%$LimiteM;
								mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
							}//mov!=0
						}else{
							if($tot_resul_mov!=0){//mov!=0
								$filas = $reccG - $tot_resul_mov%$LimiteM;
								mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
							}//mov!=0
						}
						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,$dia,);
						}																			
																			
					}//reccG==tot_resul_ant					
				}//else
			}//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant	

			if($tot_resul_cmp<=5 && $tot_resul_ant > $tot_resul_mov){//inicio
				if($reccG%$LimiteM==0){////else
	if($dia == "si"){
					$pdf->AddPage();

					if($tot_resul_tra!=0){//tra!=0
						
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
					}//tra!=0								
					if($tot_resul_ant!=0){//ant!=0
						if($reccG==$LimiteA){
							$filasAnt = $reccG - $tot_resul_ant%$LimiteM;		
							$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							importe($importe_total,$pdf);									
						}elseif($reccG<$LimiteA){
							$filasAnt = $reccG - $tot_resul_ant%$LimiteM;
							$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							importe($importe_total,$pdf);
						}else{
							$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
						$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
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
							mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
						}elseif($tot_resul_mov<$tot_resul_ant && $tot_resul_mov<$LimiteM){
							mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
						}
						
					}//mov!=0							
					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,"no",);
					}
	}				
					$pdf->AddPage();

					if($tot_resul_tra!=0){//tra!=0
						
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
					}//tra!=0								
					if($tot_resul_ant!=0){//ant!=0
						if($reccG==$LimiteA){
							$filasAnt = $reccG - $tot_resul_ant%$LimiteM;		
							$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							importe($importe_total,$pdf);									
						}elseif($reccG<$LimiteA){
							$filasAnt = $reccG - $tot_resul_ant%$LimiteM;
							$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							importe($importe_total,$pdf);
						}else{
							$filasAnt = $tot_resul_ant - $tot_resul_ant%$LimiteM;
						$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
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
							mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
						}elseif($tot_resul_mov<$tot_resul_ant && $tot_resul_mov<$LimiteM){
							mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
						}elseif($tot_resul_mov<$tot_resul_ant && $tot_resul_mov>$LimiteM){
							mov($valuesmov,$filas1,$dia,$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
						}
						
					}//mov!=0							
					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,$dia,);
					}							
						
				}else{//else pagina mayor a 1
					if($reccG==$tot_resul_ant){//reccG==tot_resul_ant
	if($dia == "si"){
						$pdf->AddPage();
						
						if($tot_resul_tra!=0){//tra!=0
							
							//tra($valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$pdf,$cliente,$dia);
							Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
						}//tra!=0									
						if($tot_resul_ant!=0){//ant!=0
							$filas = $reccG - $tot_resul_ant%$LimiteM;	
							//ant($valuesant,$reccG,"no",$pdf,$cliente,$filas,NULL);
							$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							importe($importe_total,$pdf);
						}//ant!=0
						if($tot_resul_mov!=0){//mov!=0

							if($tot_resul_ant>$tot_resul_mov && $tot_resul_mov>$LimiteM){//si ant > mov
								$filas1 = $tot_resul_mov - $filas;
								mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
							}elseif($tot_resul_ant>$tot_resul_mov && $tot_resul_ant<$LimiteM){//si ant > mov
								$filas1 = $tot_resul_mov - $filas;
								mov($valuesmov,$tot_resul_mov,"no",$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
							}
							//$filas = ($reccG - $tot_resul_mov%$LimiteM);	
							//$filas = $tot_resul_mov - $LimiteM;

						}//mov!=0									

						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,"no",);
						}
	}					
						$pdf->AddPage();
						
						if($tot_resul_tra!=0){//tra!=0
							
							//tra($valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$pdf,$cliente,$dia);
							Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
						}//tra!=0									
						if($tot_resul_ant!=0){//ant!=0
							$filas = $reccG - $tot_resul_ant%$LimiteM;	
							//ant($valuesant,$reccG,$dia,$pdf,$cliente,$filas,NULL);
							$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							importe($importe_total,$pdf);
						}//ant!=0
						if($tot_resul_mov!=0){//mov!=0
							if($tot_resul_ant>$tot_resul_mov && $tot_resul_mov>$LimiteM){//si ant > mov
								$filas1 = $tot_resul_mov - $filas;
								$filas = $reccG - $tot_resul_ant%$LimiteM;
								//mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
								mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
							}elseif($tot_resul_ant>$tot_resul_mov && $tot_resul_ant<$LimiteM){//si ant > mov
								$filas1 = $tot_resul_mov - $filas;
								mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas1,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
							}
							//$filas = ($reccG - $tot_resul_mov%$LimiteM);	
							//$filas = $tot_resul_mov - $LimiteM;

						}//mov!=0									

						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,$dia,);
						}								
										
					}//reccG==tot_resul_ant	
				}//else
			}//inicio	

			if($tot_resul_cmp<=5 && $tot_resul_mov == $tot_resul_ant){//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant
				if($reccG%$LimiteM==0){//$reccG%$LimiteM==0
	if($dia == "si"){
					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
					}//tra!=0							
					if($LimiteM<=$tot_resul_ant){
						
						if($reccG==$LimiteA){
							$filasAnt = $reccG - $reccG%$LimiteM;	
							$importe_total = ant($valuesant,$reccG,"no",$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							importe($importe_total,$pdf);
						}													
					}
					if($tot_resul_mov!=0){//mov!=0
						$filas = $reccG - $LimiteM;
						mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
					}//mov!=0								
					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,"no",);
					}	

	}				
					$pdf->AddPage();
					if($tot_resul_tra!=0){//tra!=0
						
						Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
					}//tra!=0							
					if($LimiteM<=$tot_resul_ant){
						
						if($reccG==$LimiteA){
							$filasAnt = $reccG - $reccG%$LimiteM;	
							$importe_total = ant($valuesant,$reccG,$dia,$pdf,$cliente,$filasAnt,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
							importe($importe_total,$pdf);
						}													
					}
					if($tot_resul_mov!=0){//mov!=0
						$filas = $reccG - $LimiteM;
						mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
					}//mov!=0								
					if($tot_resul_cmp!=0){//tra!=0
						cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,$dia,);
					}	
											
				}else{//else $reccG%$LimiteM==0
					if($reccG%$tot_glo==0){//reccG%tot_glo==0
	if($dia == "si"){
						$pdf->AddPage();
						if($tot_resul_tra!=0){//tra!=0
							
							Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"activo");
						}//tra!=0	
						if($tot_resul_ant!=0){//ant!=0

							if($tot_resul_ant<$reccG){
								
								$filasA = $tot_resul_ant - ($tot_resul_ant%$LimiteA);
								$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filasA,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
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
							$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);	
								}else{
								$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
							$importe_total = ant($valuesant,$tot_resul_ant,"no",$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
								importe($importe_total,$pdf);			
								}

							}
						}//ant!=0
						if($tot_resul_mov!=0){//mov!=0
							$filas = $reccG - $tot_resul_mov%$LimiteM;
							mov($valuesmov,$reccG,"no",$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
						}//mov!=0										
						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,"no",);
						}

	}						
						$pdf->AddPage();
						//echo $pdf->PageNo();
						if($tot_resul_tra!=0){//tra!=0
							
							Anexos_Observaciones($checs1,$checs2,$checs3,$checs4,$checA1,$checA2,$checA3,$checA4,$checA5,$pdf,"noactivo");
						}//tra!=0	
						if($tot_resul_ant!=0){//ant!=0

							if($tot_resul_ant<$reccG){
								
								$filasA = $tot_resul_ant - ($tot_resul_ant%$LimiteA);
								$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filasA,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);
							}else{
								if($tot_resul_ant>$LimiteA){
									$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
									if($tot_resul_ant==15){
										$tot_resul_ant = $tot_resul_ant+1;
										//$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
									}
									//ant == mov
									//echo $filas;
									//echo $tot_resul_ant;
									$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);	
								}else{
									$filas = ($tot_resul_ant - ($tot_resul_ant%$LimiteA));
									$importe_total = ant($valuesant,$tot_resul_ant,$dia,$pdf,$cliente,$filas,"importes",$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario);
									importe($importe_total,$pdf);			
								}

							}
						}//ant!=0
						if($tot_resul_mov!=0){//mov!=0
							$filas = $reccG - $tot_resul_mov%$LimiteM;
							mov($valuesmov,$reccG,$dia,$pdf,$cliente,$filas,$docto_numFUP,$dias,$usuario,$operacion,$observacion,$fec_def);
						}//mov!=0										
						if($tot_resul_cmp!=0){//tra!=0
							cmp($valuescmp,$tot_resul_cmp,$pdf,$cliente,$docto_numFUP,$dia,);
						}
															
					}//reccG%tot_glo==0													
				}//else

			}//$tot_resul_cmp<=5 && $tot_resul_mov > $tot_resul_ant	

			$reccG = $reccG+1;
			$reccG2++;	
		}//recorrido_global

		$nom_area1 = trim($nom_area);
		$cadena = $nom_area1;//str_replace(' ', '_', $nom_area1);
		$dat = "";
		$ip = getRealIP();
		
		$pdf->Output('F','../../FUPs/Masivo_Original/Previo/'.$cadena.'_'.$CURPtra.'_'.$docto_numFUP.'_ORIGINAL_Qna_Previo.pdf');
	    
	    $dat = $cadena.'_'.$CURPtra.'_'.$docto_numFUP.'_ORIGINAL_Qna_Previo.pdf';
		
	    $Object = new DateTime();  
	    $Object->setTimezone(new DateTimeZone('America/Mexico_City'));
	    $DateAndTime = $Object->format("d-m-Y h:i:s a");  

	    $contenido = $DateAndTime.'-'.$dat.'-'.$usuario.'-'.$ip."\r\n";
	    $archivo = fopen('Creados_Original_CT_Previo.txt','a');

	    fputs($archivo,$contenido);
	    fclose($archivo);

	    echo '../FUPs/Masivo_Original/Previo/'.$cadena.'_'.$CURPtra.'_'.$docto_numFUP.'_ORIGINAL_Qna_Previo.pdf';


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

	function ant($valuesants,$tot_resul_ant,$dia,$pdf,$cliente,$filas,$retornar,$rfc,$valuestra,$FECHA,$FECHAD,$docto_numFUPFUP,$tot_resul_tra,$checA1,$checA2,$checA3,$checA4,$checA5,$checs1,$checs2,$checs3,$checs4,$usuario){//funcionant
			$ID_PLA = "1";
			
			$numinsert=0;
			//var_dump($valuesants[202]['plaza']);
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

			//var_dump($tot_resul_ant);
			if($valuesants!=null){//undefined
				//$resultados = $tot_resul_ant + 1;
				//echo $tot_resul_ant;
				if($tot_resul_ant>10){
					$a=$filas;
					//$b=$filas;
					//$tot_resul_ant = $resultados;
				}/*else{
					$a=$filas*14;
				}*/
				//var_dump($valuesants);
				//var_dump($tot_resul_ant);
				while($a<$tot_resul_ant){
					if(!isset($valuesants[0])){
						$Cod_Pago1 =  $valuesants['cod_pago'];
						$Unidad1 = 	  $valuesants['unidad'];
						$Subunidad1 = $valuesants['subunidad'];
						$Puesto1 = 	  $valuesants['cat_puesto'];
						$Horas1 = 	  $valuesants['horas'];
						$Plaza1 = 	  $valuesants['cons_plaza'];
						$Mot_Mov1 =   $valuesants['mot_mov'];
						$Nivel_Sdo1 = $valuesants['nivel_sueldo'];
						$Qna_Ini1 =   $valuesants['qna_ini'];
						$Qna_Fin1 =   $valuesants['qna_fin'];
						$Valor = 	  $valuesants['num_docto'];
						$partida =    "NULL";//$value['Partida'];
						if($partida=="NULL"){
							$partida2 = "";
						}
						$CT_A1 = 	  $valuesants['ct'];
						$Valor2= 	  $Valor;
						$arweas = 	  $valuesants['area'];
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
								if($importe_tot != ""){
									$importe_total  = $importe_total + $importe_tot;
								}
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
					
						$t++;
						$a++;
						$tot_reg++;
					}else{
						//var_dump($a);
						$Cod_Pago1 =  $valuesants[$a]['cod_pago'];
						$Unidad1 = 	  $valuesants[$a]['unidad'];
						$Subunidad1 = $valuesants[$a]['subunidad'];
						$Puesto1 = 	  $valuesants[$a]['cat_puesto'];
						$Horas1 = 	  $valuesants[$a]['horas'];
						$Plaza1 = 	  $valuesants[$a]['cons_plaza'];
						$Mot_Mov1 =   $valuesants[$a]['mot_mov'];
						$Nivel_Sdo1 = $valuesants[$a]['nivel_sueldo'];
						$Qna_Ini1 =   $valuesants[$a]['qna_ini'];
						$Qna_Fin1 =   $valuesants[$a]['qna_fin'];
						$Valor = 	  $valuesants[$a]['num_docto'];
						$partida =    "NULL";//$value['Partida'];
						if($partida=="NULL"){
							$partida2 = "";
						}
						$CT_A1 = 	  $valuesants[$a]['ct'];
						$Valor2= 	  $Valor;
						$arweas = 	  $valuesants[$a]['area'];
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
							
							 	if(isset($verAT["imp_ze2"])){
									$importe_tot 	= $verAT["imp_ze2"];
								}
								if($importe_tot != ""){
									$importe_total  = $importe_total + $importe_tot;
								}
								if(isset($verAT["concepto"])){
									$CONCEPTO 		= $verAT["concepto"];
								}
								if(isset($verAT["imp_ze2"])){
									$numero5 		= $verAT["imp_ze2"];
									$IMPORTE 		= number_format($numero5,2);
								}	
								$im = 0;//importe($importe_total,$pdf);							
						}
*/
						$Pagina = $pdf->PageNo();
						//echo $Pagina;			
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
					
			$t++;
			$a++;
			$tot_reg++;
		}//else isset
	}//inicio_while*/
}//undefined
/*------------------------------------------------TRABAJADOR------------------------------------------------*/				
$y = 0;
//var_dump($valuestra);
	        while ($y < $tot_resul_tra){ //2do while getDatosPDF
	        	//if($y==21){
	        		
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
						
						if($valuestra["emp_dom"][0] != "NULL"){
			  				$CALLE		= $valuestra['emp_dom'];
			  			}else{
			  				$CALLE		= "";
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
							$CALLE= 			$valuestra['emp_dom'];
						}
						*/
					}
					//var_dump($CALLE);
					if(isset($valuestra["emp_dom_cp"])){
						$COD_POSTAL= 		$valuestra['emp_dom_cp'];
					}
					if(isset($valuestra["emp_dom_col"])){
						$LOCACION1= 		$valuestra['emp_dom_col'];
						if($LOCACION1!="NULL"){
							$LOCACION = htmlspecialchars_decode($LOCACION1);	
							//$LOCACION = $LOCACION1;
						}else{
							$LOCACION = "";
						}
						
					}else{
							$LOCACION = "";
						}
					
					if(isset($valuestra["emp_dom_pob"])){
						$MUNICIPIO1= 		$valuestra['emp_dom_pob'];
						if($MUNICIPIO1!="NULL"){
							$MUNICIPIO= 		htmlspecialchars_decode($MUNICIPIO1);
							//$MUNICIPIO= 		$MUNICIPIO1;
						}else{
							$MUNICIPIO = "";
						}
						
					}else{
						$MUNICIPIO = "";
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
					$LICENCIATURA=		"";
					$TITULO=			"";
					$MA=				"";
					$DO=				"";
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
					$NUM_DOCTO_cpr = substr($docto_numFUPFUP,4,10);
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
					$LICENCIATURA=		"";
					$TITULO=			"";
					$MA=				"";
					$DO=				"";
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
					$NUM_DOCTO_cpr = substr($docto_numFUPFUP,4,10);
					$CURP_cpr = substr($CURP,15,18);
					$CPR1 = $CURP_cpr.$NUM_DOCTO_cpr;
					$code = $CPR1;
					$y++;					
				}
			}//2do while getDatosPDF

		include 'Mostrar/pdftraCCT.php';

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
			//var_dump($valuex_pre);
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

	$docto_numFUP = $docto_numFUPFUP;
	
	if($retornar=="importes"){
		return $importe_total;
	}
}//funcionant

	function mov($valuesmov,$tot_resul_mov,$dia,$pdf,$cliente,$filas,$docto_numFUPFUP,$dias,$usuario,$operacion,$observacion,$fec_def){//funcionm,$diasov
		//var_dump($valuesmov[339]);//405;
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
			
			$b=$filas;//330;//($tot_resul_mov*33)
			//$tot_resul_mov = $e;
		}
		//var_dump($tot_resul_mov);
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
					//if($NOMBRE_SUS_MOV == "" || $NOMBRE_SUS_MOV == " "){$NOMBRE_SUS_MOV = "NULL";}
					//if($NOMBRE_SUS_MOV == "NULL" ){$NOMBRE_SUS_MOV1 = "NULL";}else{$NOMBRE_SUS_MOV1 =  		$valuesmov['nom_empsus'];}
				}else{
					$NOMBRE_SUS_MOV1 = "NULL";
					//var_dump($NOMBRE_SUS_MOV1);
				}
				if(isset($valuesmov['rfcsus'])){
					$RFCSUS_MOV  =  			$valuesmov['rfcsus'];
					$RFCSUS_MOV1 =  			$valuesmov['rfcsus'];
					//if($RFCSUS_MOV == ""){$RFCSUS_MOV = "NULL";}
					//if($RFCSUS_MOV == "NULL" ){$RFCSUS_MOV1 = "NULL";}else{$RFCSUS_MOV1 =  		$valuesmov['rfcsus'];}
				}else{
					$RFCSUS_MOV1 = "NULL";
				}
				if(isset($valuesmov['mot_movsus'])){
					$MOT_MOVSUS =  			$valuesmov['mot_movsus'];
					$MOT_MOVSUS1 =  			$valuesmov['mot_movsus'];
					//if($MOT_MOVSUS == "" || $MOT_MOVSUS == " "){$MOT_MOVSUS1 = "NULL";}
					/*
					if($MOT_MOVSUS == "NULL" ){$MOT_MOVSUS1 = "NULL";}else{$MOT_MOVSUS1 =  		$valuesmov['mot_movsus'];}
					*/
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
				if($valuesmov['cve_mov']=="9" && $valuesmov['mot_mov']=="76"){
						$DESCRIPCION = "CAMBIO DE CT.";
				}else{
					if(isset($valuesmov['descripcion1']) && isset($valuesmov['descripcion2'])){			
					$DESCRIPCION1 =  		$valuesmov['descripcion2'];                                 
					$DESCRIPCION2 =  		$valuesmov['descripcion1'];
					$DESCRIPCION =          $DESCRIPCION1." ".$DESCRIPCION2;	
				}
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
				$i++;
			$b++;					
			}else{
				//var_dump($b);
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
					//var_dump($HORAS_MOV);
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
					//if($RFCSUS_MOV == ""){$RFCSUS_MOV = "NULL";}
					if($RFCSUS_MOV == "NULL" ){$RFCSUS_MOV1 = "NULL";}else{$RFCSUS_MOV1 =  		$valuesmov[$b]['rfcsus'];}
				}else{
					$RFCSUS_MOV1 = "NULL";
				}
				//var_dump($RFCSUS_MOV1);
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
				$i++;
			$b++;				
		}
        }//fin 2do while getDatosPDF_Mov
        oficio_capturo($OFICIO,$CAPTURO,$pdf);
	}//funcionmov
?>