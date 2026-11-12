<?php
			require_once('../Conexion/ServicioWeb.php');

			$relacion = "";
			$id_consulta_Mov =  1296; //consulta TODOS CAMBIO CT PRUEBAS
      $JSON_Mov="[{\"relacion\":\"$relacion\"}]";
      $array_Mov = json_decode(json_encode($JSON_Mov), True);
      $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta    
      $resultados_Mov=$cliente->getConsulta($params_Mov);
      $arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
			$xml = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);	

        if(!empty($array)){
        	$ctnvo = "";
        	$ct_anterior = "";
          $num_docto  = "";
          $plazas 		= "";
          $datoalt		= "";
          $bc=0;
          $data = array();
          $id=0;
		  $idAutorizar = "";

          $ver = $array['NewDataSet']['table'];
					$vers = $array['NewDataSet'];

					if(!isset($ver[0])){
							$tot_resul_mov= count($vers);
					      	
				   		$num_docto   = $ver['num_docto'];
				   		$num_oficio   = $ver['num_oficio'];
			    		$rfc 	   		 = $ver['rfc'];
			    		if(isset($ver['plaza'])){
			    			$plazas      = $ver['plaza'];	
			    		}
			    		$area    	   = $ver['area'];
			    		if(isset($ver['ctnvo'])){
			    			$ctnvo = $ver['ctnvo'];
			    		}
			    		
			    		if(isset($ver['ct_anterior'])){
			    			$ct_anterior = $ver['ct_anterior'];
			    		}
			    		
			    		$area_hide = $ver['area_hide'];
						if(isset($ver['idAutorizar'])){
							$idAutorizar = $ver['idAutorizar'];
						}
				    		
		        	$data[] = [$num_oficio,$num_oficio,$num_docto,$num_oficio,$rfc,$plazas,$area,$ctnvo,$ct_anterior,$area_hide,$idAutorizar,$idAutorizar];
					}else{

							$tot_resul_mov= count($ver);
							
								while ($bc < $tot_resul_mov){//while									
						   		$num_docto   = $ver[$bc]['num_docto'];
						   		$num_oficio   = $ver[$bc]['num_oficio'];
					    		$rfc 	   		 = $ver[$bc]['rfc'];
					    		if(isset($ver[$bc]['plaza'])){
					    			$plazas      = $ver[$bc]['plaza'];						    		
					    		}
					    		$area    	   = $ver[$bc]['area'];
					    		if(isset($ver[$bc]['ctnvo'])){
					    			$ctnvo = $ver[$bc]['ctnvo'];
					    		}
					    		
					    		if(isset($ver[$bc]['ct_anterior'])){
					    			$ct_anterior = $ver[$bc]['ct_anterior'];
					    		}
			    				
			    				$area_hide = $ver[$bc]['area_hide'];
								if(isset($ver[$bc]['idAutorizar'])){
			    					$idAutorizar = $ver[$bc]['idAutorizar'];
			    				}

				        	$data[] = [$num_oficio,$num_oficio,$num_docto,$num_oficio,$rfc,$plazas,$area,$ctnvo,$ct_anterior,$area_hide,$idAutorizar,$idAutorizar];
				         	$id = $id+1;	
					      $bc++;
					    }//fin 2do while getDatosPDF_Mov   
					}	    
						$results = array("data"=>$data);
						echo json_encode($results);
			}else{
				$data[] = ["","","","","","","","","",""];
				$results = array("data"=>"");
				echo json_encode($results);
			}      

?>