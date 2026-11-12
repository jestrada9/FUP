<?php
  require_once('../Conexion/ServicioWeb.php');
        $relacion= base64_decode($_POST["relacion"]);
        //echo $relacion;
        $relacion = str_replace("'", "-", $relacion);

       	$id_consulta_Mov =  265; //consulta RELACION
        $JSON_Mov="[{\"relacion\":\"$relacion\"}]";
        $array_Mov = json_decode(json_encode($JSON_Mov), True);
        $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
        $resultados_Mov=$cliente->getConsulta($params_Mov);
        //var_dump($params_Mov);
        $arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
        //var_dump($arrayR_Mov);
				$xml = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
				$json = json_encode($xml);
				$array = json_decode($json,TRUE);	    
				//var_dump($array['NewDataSet']['table']);
				if(!empty($array)){
						
           $num_docto  = "";
           $plazas     = "";
           $datoalt 	 = "";
           $b=0;
           $data = array();
           $id=0;
			 			
					      $ver = $array['NewDataSet']['table'];
					      $vers = $array['NewDataSet'];
								//var_dump($ver);
								//var_dump($tot_resul_mov);
						if(!isset($ver[0])){
							$tot_resul_mov= count($vers);
					      	while ($b < $tot_resul_mov){//while
							   		$num_docto  = $ver['num_docto'];
						    		$operacion	= $ver['operacion'];
						    		$usuario    = $ver['usuario'];
						    		if(isset($ver['fecha'])){
						   				$fecha    = $ver['fecha'];	
						   			}	
						      $b++;
						    }//fin 2do while getDatosPDF_Mov 
						     $resultado = 	"El Documento: (" .$num_docto. "). Se Encuentra en : (" .$operacion."), Autorizado por el Usuario: (" .$usuario."), Con Fecha: (" .$fecha. ")."; 						
						}else{
							$num_doctos="";
							$operacions="";
							$usuarios="";
							$fechas="";
							$tot_resul_mov= count($ver);
					      	while ($b < $tot_resul_mov){//while
							   		$num_docto  = $ver[$b]['num_docto'];
							   		$num_doctos = $num_doctos."-".$ver[$b]['num_docto'];
						    		$operacion	= $ver[$b]['operacion'];
						    		$operacions	= $operacions."-".$ver[$b]['operacion'];
						    		$usuario    = $ver[$b]['usuario'];
						    		$usuarios 	= $usuarios."-".$ver[$b]['usuario'];
						   			$fecha      = $ver[$b]['fecha'];	
						   			$fechas      = $fechas."-".$ver[$b]['fecha'];
						      $b++;
						    }//fin 2do while getDatosPDF_Mov  		
						    $resultado = 	"Los Documentos: (" .$num_doctos. "). Se Encuentran en : (" .utf8_decode($operacions)."), Enviado por los Usuarios: (" .utf8_decode($usuarios)."), En Estas Fechas: (" .utf8_decode($fechas). ").";
						}		
  					echo $resultado;						
		}else{
			echo "vacio";
		} 
?>        