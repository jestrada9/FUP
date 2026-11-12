/*
		//if($cve_r == "3" || $cve_r == "4"){
			/*  $id_consulta_Mov = 	161;//MOVIMIENTOS
			}else{
			  $id_consulta_Mov = 	137;//MOVIMIENTOS 	
			}*/
			if($pa=="1"){
				$id_consulta_Mov = 	188;//MOVIMIENTOS 
				$metodo_consulta="ConsultaMovimientos_Original1";
				include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
			}else{
				if($men == "undefined" ){//undefined
					$id_consulta_Mov = 	187;//MOVIMIENTOS 	
				}//undefined
				else{
					$id_consulta_Mov = 	137;//MOVIMIENTOS 	
				}
			}
			$metodo_consulta="ConsultaMovimientos_Original1";
			include '../../Conexion/Metodos_Consultas/metodos_consultas.php';
		    //var_dump($arrayR_Mov);
			foreach($arrayR_Mov as $valuesmov){//2do foreach getDatosPDF_Mov
				$tot_resul_mov=$valuesmov[0]["tot_resu"];	
			}//fin 2do foreach getDatosPDF_Mov	
			//var_dump($valuesmov);
		//}

*/