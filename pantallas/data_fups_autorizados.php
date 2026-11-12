<?php
  require_once('../Conexion/ServicioWeb.php');
  $seleccion = $_GET['cons'];

  switch ($seleccion) {
			case 1:
				 $id_consulta_Mov =  209; //consulta TODOS
				break;
			case 2:
				 $id_consulta_Mov =  1277; //consulta TODOS CT
				break;
			case 3:
				 $id_consulta_Mov =  2323; //consulta TODOS CT
				break;
			default:
				 $id_consulta_Mov =  -1;
				break;
	}
      	$var="";
        //$id_consulta_Mov =  209;
        $JSON_Mov="[{\"Valor\":\"$var\"}]";
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

          $num_docto = "";
          $b=0;
          $data = array();
          $id=0;
		      $valuesmov = $array['NewDataSet']['table'];
					$valuesmovs = $array['NewDataSet'];

						if(!isset($valuesmov[0])){
							$tot_resul_mov= count($valuesmovs);			 			
					      	while ($b < $tot_resul_mov){//while
							    		$num_docto  = $valuesmov['idnum_docto'];
							    		$rfc 	    	= $valuesmov['rfc'];
							    		$mot_mov1   = $valuesmov['mot_mov'];
							    		$mot_mov 	= str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
							    		$area    		= $valuesmov['area'];
							    		$num_oficio = $valuesmov['num_oficio'];
							    		//$datoalt    = $valuesmov[$b+6]['datoalt_'];
					        		$data[] = [$num_docto,$num_docto,$rfc,$mot_mov,$area,$num_oficio,""];
					        	$id = $id+1;	
						      $b++;
						    }//fin 2do while getDatosPDF_Mov    
						}else{
								  $tot_resul_mov= count($valuesmov);			 			
					      	while ($b < $tot_resul_mov){//while
					      		
							    		$num_docto  = $valuesmov[$b]['idnum_docto'];
							    		$rfc 	    	= $valuesmov[$b]['rfc'];
							    		$mot_mov1   = $valuesmov[$b]['mot_mov'];
							    		$mot_mov 	= str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
							    		$area    		= $valuesmov[$b]['area'];
							    		$num_oficio = $valuesmov[$b]['num_oficio'];
							    		//$datoalt    = $valuesmov[$b+6]['datoalt_'];
					        		$data[] = [$num_docto,$num_docto,$rfc,$mot_mov,$area,$num_oficio,""];
					        	$id = $id+1;	
						      $b++;
						    }//fin 2do while getDatosPDF_Mov  							
						}//fin 2do foreach getDatosPDF_Mov    

						$results = array(
						"data"=>$data);
						echo json_encode($results);
		}else{
			$data[] = ["","","","","","",""];
			$results = array(
						"data"=>"");
						echo json_encode($results);
		}      

		 
?>        