<?php
  require_once('../Conexion/ServicioWeb.php');


      	$var="";
        $id_consulta_Mov =  243;
        $JSON_Mov="[{\"Valor\":\"$var\"}]";
        $array_Mov = json_decode(json_encode($JSON_Mov), True);
        $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
        $resultados_Mov=$cliente->getConsulta($params_Mov);
        //var_dump($resultados_Mov);
        $arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
        //var_dump($arrayR_Mov);

        if(!empty($arrayR_Mov)){

           $num_docto       = "";
           $b=0;
           $data = array();
           $id=0;
			 			foreach($arrayR_Mov as $valuesmov){//2do foreach getDatosPDF_Mov
					      $tot_resul_mov=$valuesmov[0]["tot_resu"]; 
					      	while ($b < $tot_resul_mov*6){//while
							    		$num_docto  = $valuesmov[$b+1]['num_docto'];
							    		$rfc 	      = $valuesmov[$b+2]['rfc'];
							    		$fecha   	  = $valuesmov[$b+3]['fecha_'];
							    		$area_nom   = $valuesmov[$b+4]['area_Nombre'];
							    		$area 		  = $valuesmov[$b+5]['area'];
							    		$num_oficio		  = $valuesmov[$b+6]['num_ofici'];
							    		//$datoalt    = $valuesmov[$b+6]['datoalt_'];
					        		$data[] = [$id,$num_docto,$rfc,$area_nom,$area,$num_oficio,$fecha,""];
					        	$id = $id+1;	
						      $b = $b + 6;
						    }//fin 2do while getDatosPDF_Mov    
						}//fin 2do foreach getDatosPDF_Mov    

						$results = array(
						"data"=>$data);
						echo json_encode($results);
		}else{
			$data[] = ["","","","","","","",""];
			$results = array(
						"data"=>"");
						echo json_encode($results);
		}      

		 
?>        