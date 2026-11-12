<?php
  require_once('../Conexion/ServicioWeb.php');


      	$var="";
		$id_consulta_Mov2 =  220;
		$id_consulta_Mov1 =  211;      	
        $id_consulta_Mov =  223;
        $JSON_Mov="[{\"Valor\":\"$var\"}]";
        $array_Mov = json_decode(json_encode($JSON_Mov), True);
        $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
        $resultados_Mov=$cliente->getConsulta($params_Mov);
        //var_dump($resultados_Mov);
        $arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
        //var_dump($arrayR_Mov);
        if(!empty($arrayR_Mov)){

        function plaza($num_docto,$id_consulta_Mov2,$cliente){
        	$JSON_Mov2="[{\"num_docto\":\"$num_docto\"}]";
	        $array_Mov2 = json_decode(json_encode($JSON_Mov2), True);
	        $params_Mov2 = array('Resultado'=>$id_consulta_Mov2, 'Argumento'=>$array_Mov2); //para conseguir la consulta
	        $resultados_Mov2=$cliente->getConsulta($params_Mov2);
	        $arrayR_Mov2= json_decode(json_encode($resultados_Mov2), True);
	        //var_dump($arrayR_Mov2);
	        if(!empty($arrayR_Mov2)){
	        foreach($arrayR_Mov2 as $valuesmov2){
	        	$plazas   = $valuesmov2[1]['plaza_'];
	        }
	    	}else{
	    		$plazas = "";
	    	}
	    	return $plazas;	
        }	

		function motv($num_docto,$id_consulta_Mov1,$cliente){
 			$JSON_Mov1="[{\"num_docto\":\"$num_docto\"}]";
	        $array_Mov1 = json_decode(json_encode($JSON_Mov1), True);
	        $params_Mov1 = array('Resultado'=>$id_consulta_Mov1, 'Argumento'=>$array_Mov1); //para conseguir la consulta
	        $resultados_Mov1=$cliente->getConsulta($params_Mov1);
	        $arrayR_Mov1= json_decode(json_encode($resultados_Mov1), True);
	        if(!empty($arrayR_Mov1)){
	        foreach($arrayR_Mov1 as $valuesmov1){
	        	$mot_mov1   = $valuesmov1[1]['mot_mov'];
	        	$mot_mov 	= str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
	        }
	    	}else{
	    		$mot_mov = "";
	    	}
	    	return $mot_mov;
		}
           $num_docto       = "";
           $b=0;
           $data = array();
           $id=0;
			 			foreach($arrayR_Mov as $valuesmov){//2do foreach getDatosPDF_Mov
					      $tot_resul_mov=$valuesmov[0]["tot_resu"]; 
					      	while ($b < $tot_resul_mov*8){//while
							    		$num_docto  = $valuesmov[$b+1]['num_docto'];
							    		$rfc 	    = $valuesmov[$b+2]['rfc'];
							    		$plaza      = $valuesmov[$b+3]['plaza_'];

								    	$plazas = 	plaza($num_docto,$id_consulta_Mov2,$cliente);

							    		$fecha     = $valuesmov[$b+4]['fecha_'];	

							    		$mot_mov = motv($num_docto,$id_consulta_Mov1,$cliente);
									       
								    	$area_nombre = $valuesmov[$b+5]['area_Nombre'];
							    		$area    	   = $valuesmov[$b+6]['area'];
							    		$num_oficio  = $valuesmov[$b+7]['num_ofici'];
							    		$datoalt     = $valuesmov[$b+8]['datoalt_'];

					        		$data[] = [$id,$num_docto,$rfc,$plaza,$plazas,$fecha,$mot_mov,"",$area_nombre,$area,$num_oficio,$datoalt,""];
					        	$id = $id+1;	
						      $b = $b + 8;
						    }//fin 2do while getDatosPDF_Mov    
						}//fin 2do foreach getDatosPDF_Mov    

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