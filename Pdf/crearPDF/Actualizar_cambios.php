<?php
		ini_set("soap.wsdl_cache_enabled", "0");

		
		require_once('../../lib/nusoap.php');
		require_once('../../Conexion/wsdl.php'); 	
		

		$usuario = $_POST['usu'];
		$arrayCosas0 = base64_decode($_POST['num_docto']);

		$arrays = json_decode($arrayCosas0, true);
//		var_dump($arrays);
		$rnum_docto = "0";
		$nos = 0;
		$z=0;
		$total = 0;
		foreach ( $arrays as $valuesa ) {//inicio_foreach
			$total = $valuesa[0]["totals"];
			while($nos < ($total*3)){//while_array
				
			  	$docto_numFUP  = $valuesa[$nos+1]['num_docto'];
			  	$num_oficioFUP = $valuesa[$nos+3]['num_oficio'];
			  	$areaFUP 	   = $valuesa[$nos+2]['area'];
                $observacion = "Cambio CT P";
                $operacion   = "Cambio CT P";
                
				$id_consulta_Mov_D =  1311;
				$JSON_Mov_D="[{\"area\":\"$areaFUP\",\"num_docto\":\"$docto_numFUP\",\"num_oficio\":\"$num_oficioFUP\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
				$array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
				$params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
				//var_dump($params_Mov_D);
				$resultados_Mov_D=$cliente->getConsulta($params_Mov_D);


 				 $nos=$nos+3;
 				$z++;
			}//while_array
            //Actualizar Cambios CT Pendientes
           echo "hecho";
    	}//inicio_foreach
?>