<?php
  require_once('../Conexion/ServicioWeb.php');

 		$conulta= $_GET["cons"]; 
        $relacion= base64_decode($_GET["relacion"]);
        //echo $relacion;
        $relacion = str_replace("'", "-", $relacion);
        //echo $relacion;
		// $id_consulta_Mov2 =  221;
		// $id_consulta_Mov1 =  212;
		switch ($conulta) {
			case 1:
				 $id_consulta_Mov =  193; //consulta DOCENTES Todos
				break;
			case 2:
				 $id_consulta_Mov =  214; //consulta DOCENTES Bajas
				break;
			case 3:
				 $id_consulta_Mov =  236; //consulta DOCENTES Guiones
				break;
			case 4:
				 $id_consulta_Mov =  254; //consulta RELACION
				break;		
			case 10:
				 $id_consulta_Mov =  1265; //consulta RELACION
				 $con = "re";
				break;
			case 11:
				 $id_consulta_Mov =  1269; //consulta CAMBIOS_CT
				break;										
			default:
				 $id_consulta_Mov =  -1;
				break;
		}

        $JSON_Mov="[{\"relacion\":\"$relacion\"}]";
        $array_Mov = json_decode(json_encode($JSON_Mov), True);
        $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
        //var_dump($params_Mov);        
        $resultados_Mov=$cliente->getConsulta($params_Mov);
        $arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
		    //var_dump($arrayR_Mov);
				$xml = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
				$json = json_encode($xml);
				$array = json_decode($json,TRUE);	
				//var_dump($array);
        if(!empty($array)){
        	$fecha = "";
        	$ct_anterior = "";
          $num_docto  = "";
		  $mot_movs  = "";
          $plazas 		= "";
          $datoalt		= "";
		  $incompleto   = "";
          $b=0;
          $data = array();
          $id=0;
			 			//foreach($arrayR_Mov as $valuesmov){//2do foreach getDatosPDF_Mov
          $ver = $array['NewDataSet']['table'];
					$vers = $array['NewDataSet'];
          //var_dump($ver);

					
					      //$tot_resul_mov =$valuesmov[0]["tot_resu"]; 
					if(!isset($ver[0])){
						$tot_resul_mov= count($vers);
					      	
							   		$num_docto   = $ver['idnum_docto'];
									if(Completed($num_docto,$cliente) == "false"){
										$incompleto = "Falta Información";
									}
						    		$rfc 	   		 = $ver['rfc'];
						    		if(isset($ver['plaza'])){
						    			$plazas      = $ver['plaza'];	
						    		}
									if(isset($ver['fecha'])){
										$fecha       = $ver['fecha'];	
									}
									if(isset($ver['mot_mov'])){
										$mot_mov1    = $ver['mot_mov'];
						    			$mot_movs 	 = str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
									}
						    		
								   	$area_nombre = $ver['area_nombre'];
						    		$area    	   = $ver['area'];
						    		$num_oficio  = $ver['num_oficio'];
						    		if(isset($ver['datoalt'])){
						    			$datoalt     = $ver['datoalt'];	
						    		}								    		

					        	$data[] = [$num_docto,$num_docto,$rfc,$plazas,$fecha,$mot_movs,"",$area_nombre,$area,$num_oficio,$datoalt,$incompleto,""];
					       
						//}//fin 2do foreach getDatosPDF_Mov    
					}else{

							$tot_resul_mov= count($ver);
								while ($b < $tot_resul_mov){//while
						   		$num_docto   = $ver[$b]['idnum_docto'];
								if(Completed($num_docto,$cliente) == "false"){
									$incompleto = "Falta Información";
								}
					    		$rfc 	   		 = $ver[$b]['rfc'];
					    		if(isset($ver[$b]['plaza'])){
					    			$plazas      = $ver[$b]['plaza'];						    		
					    		}
					    		if(isset($ver[$b]['fecha'])){
					   				$fecha       = $ver[$b]['fecha'];	
					   			}
								if(isset($ver[$b]['mot_mov'])){
									$mot_mov1    = $ver[$b]['mot_mov'];
									$mot_movs 	 = str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
								}
							   	$area_nombre = $ver[$b]['area_nombre'];
					    		$area    	   = $ver[$b]['area'];
					    		$num_oficio  = $ver[$b]['num_oficio'];
					    		if(isset($ver[$b]['datoalt'])){
					    			$datoalt     = $ver[$b]['datoalt'];							    		
					    		}

				        	$data[] = [$num_docto,$num_docto,$rfc,$plazas,$fecha,$mot_movs,"",$area_nombre,$area,$num_oficio,$datoalt,$incompleto,""];
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

		function Completed($num_doc,$cliente){
			$id_consulta_Mov =  1312;
			$JSON_Mov="[{\"num_docto\":\"$num_doc\"}]";
			$array_Mov = json_decode(json_encode($JSON_Mov), True);
			$params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
			$resultados_Mov=$cliente->getConsulta($params_Mov);
			//var_dump($resultados_Mov);
			$arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
			//var_dump($arrayR_Mov);
			if(!empty($arrayR_Mov)){
				$xml2 = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
				$json2 = json_encode($xml2);
				$array2 = json_decode($json2,TRUE);

				$ver2 = $array2['NewDataSet']['table'];	
				return ($ver2["error"]);
			}
		}
  //     	$var="";
		    	
  //       $id_consulta_Mov =  240;
  //       $JSON_Mov="[{\"Valor\":\"$var\"}]";
  //       $array_Mov = json_decode(json_encode($JSON_Mov), True);
  //       $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
  //       $resultados_Mov=$cliente->getConsulta($params_Mov);
  //       //var_dump($resultados_Mov);
  //       $arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
  //       //var_dump($arrayR_Mov);

  //       if(!empty($arrayR_Mov)){


  //          $num_docto       = "";
  //          $b=0;
  //          $data = array();
  //          $id=0;
		// 	 			foreach($arrayR_Mov as $valuesmov){//2do foreach getDatosPDF_Mov
		// 			      $tot_resul_mov=$valuesmov[0]["tot_resu"]; 
		// 			      	while ($b < $tot_resul_mov*9){//while
		// 					    		$num_docto   = $valuesmov[$b+1]['num_docto'];
		// 					    		$rfc 	     = $valuesmov[$b+2]['rfc'];
		// 					    		$plaza       = $valuesmov[$b+3]['plaza_'];
		// 					    		$fecha       = $valuesmov[$b+4]['fecha_'];	
		// 					    		$mot_mov     = $valuesmov[$b+5]['mot_mov'];
		// 						    	$area_nombre = $valuesmov[$b+6]['area_Nombre'];
		// 					    		$area    	 = $valuesmov[$b+7]['area'];
		// 					    		$num_oficio  = $valuesmov[$b+8]['num_ofici'];
		// 					    		$dato_alt    = $valuesmov[$b+9]['datoalt_'];

		// 			        		$data[] = [$id,$num_docto,$rfc,$plaza,$fecha,$mot_mov,"",$area_nombre,$area,$num_oficio,$dato_alt,""];
		// 			        	$id = $id+1;	
		// 				      $b = $b + 9;
		// 				    }//fin 2do while getDatosPDF_Mov    
		// 				}//fin 2do foreach getDatosPDF_Mov    

		// 				$results = array(
		// 				"data"=>$data);
		// 				echo json_encode($results);
		// }else{
		// 	$data[] = ["","","","","","","","","","","",""];
		// 	$results = array(
		// 				"data"=>"");
		// 				echo json_encode($results);
		// } 
?>