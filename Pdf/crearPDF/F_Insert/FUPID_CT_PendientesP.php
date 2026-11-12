<?php
		/*Insertar a Tabla FUPId*/
		$observacion = "Creacion Original CT";
		$operacion = "Creacion Original CT";
		$idAutoriza = 7;
	    $id_consulta_FUPId = 	1294;
	    $JSON_FUPId="[{\"AREA_ID\":\"$AREA_PLA\",\"NUM_DOCUMENTO\":\"$docto_num\",\"NUM_PAGINA\":\"$Pagina\",\"idAutoriza\":\"$idAutoriza\",\"num_oficio\":\"$OFICIO\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
	    $arrayR1_FUPId = json_decode(json_encode($JSON_FUPId), True);
	    $params_FUPId = array('Resultado'=>$id_consulta_FUPId, 'Argumento'=>$arrayR1_FUPId, 'Accion'=>"insert");
	    //var_dump($params_FUPId);
	    $resultadoss_FUPId=$cliente->getConsulta($params_FUPId);
		$arrayR3_FUPId= json_decode(json_encode($resultadoss_FUPId), True);



?>