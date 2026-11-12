<?php
  require_once('../Conexion/ServicioWeb.php');

  			$conulta=$_GET["cons"]; 
        $fec1=$_GET["fec1"];
        $fec2=$_GET["fec2"];
        $quin=$_GET["quin"];
        $rfc=$_GET["rfc"];

switch ($conulta) {
			case 1://consulta DOCENTES  ORDENAMIENTO
				 if($fec1!="" && $fec2!=""){
				 	$argumento =  "rc4.cve_mov not in (6,11) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc;";
				 }
				 if($quin!=""){
				 	 $argumento =  "rc4.cve_mov not in (6,11) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
			 	if($rfc!=""){
					$argumento =  "rc4.cve_mov not in (6,11) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}					 
				break;
			case 2://consulta DOCENTES NO ORDENAMIENTO
				 if($fec1!="" && $fec2!=""){
				 	$argumento =  "rc4.cve_mov not in (6,11) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc  ;";
				 }
				 if($quin!=""){
				 	 $argumento =  "rc4.cve_mov not in (6,11) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 } 
			 	if($rfc!=""){
					$argumento =  "rc4.cve_mov not in (6,11) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}				 
				break;
			case 3://consulta DOCENTES BAJAS
				 if($fec1!="" && $fec2!=""){
				 	$argumento =  "rc4.cve_mov in (6) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc;";
				 }
				 if($quin!=""){
				 	 $argumento =  "rc4.cve_mov in (6) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc;";
				 }
			 	if($rfc!=""){
					$argumento =  "rc4.cve_mov in (6) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}					 
				break;
			case 4://consulta DOCENTES LICENCIAS
				 if($fec1!="" && $fec2!=""){
				 	$argumento =  "rc4.cve_mov in (11) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
				 if($quin!=""){
				 	 $argumento =  "rc4.cve_mov in (11) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }	
			 	if($rfc!=""){
					$argumento =  "rc4.cve_mov in (11) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}					 		
				break;
			case 5://consulta DOCENTES GUIONES
				 if($fec1!="" && $fec2!=""){
				 	$argumento =  "rc4.cve_mov in (3,4) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
				 if($quin!=""){
				 	 $argumento =  "rc4.cve_mov in (3,4) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
			 	if($rfc!=""){
					$argumento =  "rc4.cve_mov in (3,4) and (cp.niv_puesto = 0 and cp.niv_puesto_aux not in ('AD')) and rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}					 
				break;
			case 7://consulta ADMIN NO ORDENAMIENTO
				 if($fec1!="" && $fec2!=""){
				 	$argumento =  "(cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
				 if($quin!=""){
				 	 $argumento =  "(cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc;";
				 } 
			 	if($rfc!=""){
					$argumento =  "(cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}					 
				break;
			case 8://consulta ADMIN BAJAS
				 if($fec1!="" && $fec2!=""){
				 	$argumento =  "rc4.cve_mov in (6) and (cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
				 if($quin!=""){
				 	 $argumento =  "rc4.cve_mov in (6) and (cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc;";
				 }		
			 	if($rfc!=""){
					$argumento =  "rc4.cve_mov  in (6) and (cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}					 		 
				break;
			case 9://consulta ADMIN LICENCIAS
				 if($fec1!="" && $fec2!=""){
				 	$argumento =  "rc4.cve_mov in (11) and (cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
				 if($quin!=""){
				 	 $argumento =  "rc4.cve_mov in (11) and (cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
			 	if($rfc!=""){
					$argumento =  "rc4.cve_mov  in (11) and (cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}				 
				break;
			case 10://consulta ADMIN GUIONES
				 if($fec1!="" && $fec2!=""){
				 	$argumento =  "rc4.cve_mov  in (3,4) and (cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
				 if($quin!=""){
				 	 $argumento =  "rc4.cve_mov  in (3,4) and (cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc ;";
				 }
			 	if($rfc!=""){
					$argumento =  "rc4.cve_mov  in (3,4) and (cp.niv_puesto!=0 or (cp.niv_puesto=0 and cp.niv_puesto_aux='AD')) and rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}				 
				break;
			case 11://consulta TODOS
				if($fec1!="" && $fec2!=""){
					$argumento =  "bc4.fecha >= '".$fec1." 00:00:00' and bc4.fecha < dateadd(day, 1,'".$fec2." 23:59:59') and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";
			 	}
			 	if($quin!=""){
					$argumento =  "rd.qna = ".$quin." and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}
			 	if($rfc!=""){
					$argumento =  "rc4.rfc = '".$rfc."' and bc4.operacion = 'Autoriza CGRH       ' and id.idAutorizar in (2,3,4) and rd.num_docto not like '%000001' order by FecAutAdm,rc4.rfc asc";			 		
			 	}			 	
				break;			
			default:
				 $id_consulta_Mov =  -1;
				break;
		}
		
       	$id_consulta_Mov = 256;
        $JSON_Mov="[{\"argumento\":\"$argumento\"}]";
        $array_Mov = json_decode(json_encode($JSON_Mov), True);
        $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
        $resultados_Mov=$cliente->getConsulta($params_Mov);
        //var_dump($resultados_Mov);
        $arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
        //var_dump($arrayR_Mov);
        $xml = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
				$json = json_encode($xml);
				$array = json_decode($json,TRUE);	  
				
        if(!empty($array)){
        	
        	$propuesta_cgrh = ""; 
          $num_docto       = "";
          $qnaAfec = "";
          $plaza = "";
          $ct = "";
          $dir_ct = "";
          $b=0;
          $data = array();
          $id=0;
		      $valuesmov = $array['NewDataSet']['table'];
					$valuesmovs = $array['NewDataSet'];
					//var_dump($valuesmov);
			 			if(!isset($valuesmov[0])){
					      $tot_resul_mov= count($valuesmovs);
					      	while ($b < $tot_resul_mov){//while
					      			$captura 			= $valuesmov['captura'];
					      			if(isset($valuesmov['propuesta'])){
												$propuesta_cgrh = $valuesmov['propuesta'];
											}
							    		$num_docto = $valuesmov['num_docto'];
							    		$rfc 	     = $valuesmov['rfc'];							    		
							    		if(isset($valuesmov['plaza'])){				    		
							    			$plaza     = $valuesmov['plaza'];
							    		}
							    		if(isset($valuesmov['ct'])){
							    			$ct 		   = $valuesmov['ct'];
							    		}
							    		if(isset($valuesmov['dir_ct'])){
							    			$dir_ct    = $valuesmov['dir_ct'];
							    		}
							    		$qna_ini   = $valuesmov['qna_ini'];
							    		$qna_fin   = $valuesmov['qna_fin'];
							    		$mot_mov1  = $valuesmov['mot_mov'];
							    		$mot_mov 	 = str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
							    		$addor     = $valuesmov['addoc'];
							    		$fecAutAdm = $valuesmov['FecAutAdm'];
							    		if(isset($valuesmov['QnaAfec'])){
							    			$qnaAfec   = $valuesmov['QnaAfec'];
							    		}
							    		//$num_oficio = $valuesmov[$b+5]['ct'];

					        		$data[] = [$captura,$propuesta_cgrh,$num_docto,$rfc,$plaza,$ct,$dir_ct,$qna_ini,$qna_fin,$mot_mov,$addor,$fecAutAdm,$qnaAfec];
					        	$id = $id+1;	
						      $b++;
						    }//fin 2do while getDatosPDF_Mov    
						}else{
								$tot_resul_mov= count($valuesmov);
								while ($b < $tot_resul_mov){//while
											$captura = $valuesmov[$b]['captura'];
											if(isset($valuesmov[$b]['propuesta'])){
												$propuesta_cgrh = $valuesmov[$b]['propuesta'];
											}
							    		$num_docto = $valuesmov[$b]['num_docto'];
							    		$rfc 	     = $valuesmov[$b]['rfc'];			
							    		if(isset($valuesmov[$b]['plaza'])){				    		
							    			$plaza     = $valuesmov[$b]['plaza'];
							    		}
							    		if(isset($valuesmov[$b]['ct'])){
							    			$ct 		   = $valuesmov[$b]['ct'];
							    		}
							    		if(isset($valuesmov[$b]['dir_ct'])){
							    			$dir_ct    = $valuesmov[$b]['dir_ct'];
							    		}
							    		$qna_ini   = $valuesmov[$b]['qna_ini'];
							    		$qna_fin   = $valuesmov[$b]['qna_fin'];
							    		$mot_mov1  = $valuesmov[$b]['mot_mov'];
							    		$mot_mov 	 = str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
							    		$addor     = $valuesmov[$b]['addoc'];
							    		$fecAutAdm = $valuesmov[$b]['FecAutAdm'];
							    		if(isset($valuesmov[$b]['QnaAfec'])){
							    			$qnaAfec   = $valuesmov[$b]['QnaAfec'];
							    		}
							    		//$num_oficio = $valuesmov[$b+5]['ct'];

					        		$data[] = [$captura,$propuesta_cgrh,$num_docto,$rfc,$plaza,$ct,$dir_ct,$qna_ini,$qna_fin,$mot_mov,$addor,$fecAutAdm,$qnaAfec];
					        	$id = $id+1;	
						      $b++;
						    }//fin 2do while getDatosPDF_Mov
						}

						$results = array(
						"data"=>$data);
						echo json_encode($results);
						
		}else{
			$data[] = ["","","","","","","","","","","","",""];
			$results = array(
						"data"=>"");
						echo json_encode($results);
		}      

		 
?>        