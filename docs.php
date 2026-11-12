<?php
	require_once('Conexion/wsdl.php'); 	
	$documento = $_GET['buscar'];

  	$id_consultaP1 =  152;
  	$JSONP1="[{\"var\":\"$documento\"}]";
  	$arrayRP1 = json_decode(json_encode($JSONP1), True);
  	$paramsP1 = array('Resultado'=>$id_consultaP1, 'Argumento'=>$arrayRP1); //para conseguir la consulta
  	//var_dump($paramsP1);
  	$resultadosP1=$cliente->getConsulta($paramsP1);   
  	$arrayRsP1= json_decode(json_encode($resultadosP1), True);
  	//var_dump($arrayRsP1);
	  if(!empty($arrayRsP1)){	
		$directorio = "FUPs/Masivo_Copia/";
		$directorio_total = glob($directorio."*.pdf");
		$qna = "Qna";
		$fecha = "Fecha";
		//no existe - 2205281189
		//existe 2 veces - 2203280454
		//existe 1 vez - 2205281198
		function abrir_pdf($value){//function abrir_pdf
			echo '<script>
					window.open("'.$value.'","_blank");
				  </script>';
		}//function abrir_pdf
		function close(){//function close
			echo '<script>
					window.close();
				  </script>';
		}//function close	
		$matches = array_filter($directorio_total, function($var) use ($documento) { return preg_match("/$documento/i", $var); });
		if($matches){//matches
			foreach ($matches as $value){//foreach
				$matches_qna = strrpos($value, $qna);
				if($matches_qna == true){ //"encontrado qna";
					abrir_pdf($value);			
				}
				$matches_fecha = strrpos($value, $fecha);	
				if($matches_fecha == true){ //"encontrado fecha";
					abrir_pdf($value);
				}
			}//foreach	
			if($matches_qna == true && $matches_fecha == false){
				close();
			}
		}else{//matches_else
			echo '
			<script>
			alert("Numero de Documento No Existe");
			window.close();
			</script>';
		}//matches

	}else{
		echo '
			<script>
			alert("Numero de Documento No Existe o No Está Autorizado");
			window.close();
			</script>';		
	}	
?>