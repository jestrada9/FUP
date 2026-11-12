<?php
		/*Insertar a Tabla FUPId*/
		$idAutoriza = 4;
	    $id_consulta_FUPId = 	150;
	    $JSON_FUPId="[{\"AREA_ID\":\"$AREA_PLA\",\"NUM_DOCUMENTO\":\"$docto_num\",\"NUM_PAGINA\":\"$Pagina\",\"idAutoriza\":\"$idAutoriza\",\"num_oficio\":\"$OFICIO\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
	    $arrayR1_FUPId = json_decode(json_encode($JSON_FUPId), True);
	    $params_FUPId = array('Resultado'=>$id_consulta_FUPId, 'Argumento'=>$arrayR1_FUPId, 'Accion'=>"insert");
	    //var_dump($params_FUPId);
	    $resultadoss_FUPId=$cliente->getConsulta($params_FUPId);
		$arrayR3_FUPId= json_decode(json_encode($resultadoss_FUPId), True);

		$operacion_reimprimir = "Reimpresion";
		$observacion_reimprimir = "Reimpresion";
		$id_consulta_reimprimir =  205;
		$JSON_reimprimir="[{\"area\":\"$AREA_PLA\",\"num_docto\":\"$docto_num\",\"num_oficio\":\"$OFICIO\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion_reimprimir\",\"datoalt\":\"$observacion_reimprimir\"}]";
		$arrayR1_reimprimir = json_decode(json_encode($JSON_reimprimir), True);
		$params_reimprimir = array('Resultado'=>$id_consulta_reimprimir, 'Argumento'=>$arrayR1_reimprimir); //para conseguir la consulta
		//var_dump($params_reimprimir);
		$resultadoss_reimprimir=$cliente->getConsulta($params_reimprimir);
?>