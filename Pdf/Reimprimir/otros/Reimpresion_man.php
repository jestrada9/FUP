<?php
	require_once('../../Conexion/wsdl.php'); 	
	//require '../../PHPMailer/src/PHPMailer.php';
	//require '../../PHPMailer/src/SMTP.php';		
	//include '../../Errores/errores.php';			
	
	$buscar = "2016263538";//$_GET['buscar'];	
	

			$tot_resul_pla = 0;
		    $id_consultaPla =  96;//14
		    $JSONPla="[{\"num_docto\":\"$buscar\"}]";
		    $arrayPla = json_decode(json_encode($JSONPla), True);
		    $paramsPla = array('Resultado'=>$id_consultaPla, 'Argumento'=>$arrayPla); //para conseguir la consulta
		    //var_dump($paramsPla);
		    $resultadosPla=$cliente->getConsulta($paramsPla);  
		    $arrayMPla= json_decode(json_encode($resultadosPla), True);
		    var_dump($arrayMPla['getConsultaResult']['any']);
		    $xml = simplexml_load_string($arrayMPla['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);
			var_dump($array);
			/*
				if(!empty($arrayMPla)){
				    foreach($arrayMPla as $valuesPla){//2do foreach getDatosPDF_Mov
						$tot_resul_pla=$valuesPla[0]["tot_resu"];
					}//fin 2do foreach getDatosPDF_Mov	   
			    }else{
			    	$tot_resul_pla = 0;
			    }
			*/    
?>