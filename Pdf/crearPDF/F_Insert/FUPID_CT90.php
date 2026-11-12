<?php
		// /*Insertar a Tabla FUPId*/
		// $idAutoriza = 6;
	    // $id_consulta_FUPId = 	150;
	    // $JSON_FUPId="[{\"AREA_ID\":\"$AREA_PLA\",\"NUM_DOCUMENTO\":\"$docto_num\",\"NUM_PAGINA\":\"$Pagina\",\"idAutoriza\":\"$idAutoriza\",\"num_oficio\":\"$OFICIO\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
	    // $arrayR1_FUPId = json_decode(json_encode($JSON_FUPId), True);
	    // $params_FUPId = array('Resultado'=>$id_consulta_FUPId, 'Argumento'=>$arrayR1_FUPId, 'Accion'=>"insert");
	    // //var_dump($params_FUPId);
	    // $resultadoss_FUPId=$cliente->getConsulta($params_FUPId);
		// $arrayR3_FUPId= json_decode(json_encode($resultadoss_FUPId), True);


		// $observacionCS = "Cambio CT 90";
        // $operacionCS   = "Cambio CT 90";
        // $id_consulta_Mov_CS  = 195;
        // //bitacora y autorizar
        // $JSON_Mov_D="[{\"area\":\"$AREA_PLA\",\"num_docto\":\"$docto_num\",\"num_oficio\":\"$OFICIO\",\"usuario\":\"$usuario\",\"operacion\":\"$operacionCS\",\"datoalt\":\"$observacionCS\"}]";
        // $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
        // $params_Mov_D = array('Resultado'=>$id_consulta_Mov_CS, 'Argumento'=>$array_Mov_D);
        // $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);  
		// 
		$observacion = "Cambio CT 90";
		$operacion   = "Cambio CT 90";
		/*Insertar a Tabla FUPId*/
		$idAutoriza = 6;
		$id_consulta_FUPId = 	1295;
		$JSON_FUPId="[{\"AREA_ID\":\"$AREA_PLA\",\"NUM_DOCUMENTO\":\"$docto_num\",\"NUM_PAGINA\":\"$Pagina\",\"idAutoriza\":\"$idAutoriza\",\"num_oficio\":\"$OFICIO\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
		$arrayR1_FUPId = json_decode(json_encode($JSON_FUPId), True);
		$params_FUPId = array('Resultado'=>$id_consulta_FUPId, 'Argumento'=>$arrayR1_FUPId, 'Accion'=>"insert");
		//var_dump($params_FUPId);
		$resultadoss_FUPId=$cliente->getConsulta($params_FUPId);
		$arrayR3_FUPId= json_decode(json_encode($resultadoss_FUPId), True);
		
		
		// ?>