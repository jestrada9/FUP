<?php 
		/*Insertar a Tabla FUPId*/

		$idAutoriza = 10;
	    $id_consulta_FUPId = 	150;
	    $JSON_FUPId="[{\"AREA_ID\":\"$AREA_PLA\",\"NUM_DOCUMENTO\":\"$docto_num\",\"NUM_PAGINA\":\"$Pagina\",\"idAutoriza\":\"$idAutoriza\",\"num_oficio\":\"$OFICIO\",\"usuario\":\"$usuario\",\"operacion\":\"$operacion\",\"datoalt\":\"$observacion\"}]";
	    $arrayR1_FUPId = json_decode(json_encode($JSON_FUPId), True);
	    $params_FUPId = array('Resultado'=>$id_consulta_FUPId, 'Argumento'=>$arrayR1_FUPId, 'Accion'=>"insert");
	    //var_dump($params_FUPId);
	    $resultadoss_FUPId=$cliente->getConsulta($params_FUPId);
		$arrayR3_FUPId= json_decode(json_encode($resultadoss_FUPId), True);

		/*
		$observacionCS = "Autoriza Captura";
        $operacionCS   = "Autoriza Captura";
        $id_consulta_Mov_CS  = 1304;//195;
        //bitacora y autorizar
        $JSON_Mov_D="[{\"area\":\"$AREA_PLA\",\"num_docto\":\"$docto_num\",\"num_oficio\":\"$OFICIO\",\"usuario\":\"$usuario\",\"operacion\":\"$operacionCS\",\"datoalt\":\"$observacionCS\"}]";
        $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
        $params_Mov_D = array('Resultado'=>$id_consulta_Mov_CS, 'Argumento'=>$array_Mov_D);
		//var_dump($params_Mov_D);
        $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);  		
		*/
?>