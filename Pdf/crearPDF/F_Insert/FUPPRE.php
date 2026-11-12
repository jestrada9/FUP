<?php
	   	$id_consulta_FUPPre = 	149;
	    $JSON_FUPPre="[{\"AREA_PRE\":\"$arweas\",\"NUM_DOCUMENTO\":\"$Valor2\",\"NUM_PAGINA\":\"$Pagina\",\"ID_PRE\":\"$ID_PLA\",
	    				\"PARTIDA\":\"$PDA\",\"CODIGO_PAGO\":\"$CODIGO_PAGO\",\"UNIDAD\":\"$UNIDAD\",\"SUBUNIDAD\":\"$SUBUNIDAD\",
	    				\"CATEGORIA\":\"$CATEGORIA\",\"HORAS\":\"$HORAS2\",\"PLAZA\":\"$PLAZA\",\"ALTA\":\"$ALTA\",
	    				\"CONCEPTO\":\"$CONCEPTO\",\"IMPORTE\":\"$numero5\",\"HASTA\":\"$DESDE\",\"DESDE\":\"$HASTA\",
	    				\"Valor\":\"$Valor\",\"preDR\":\"$DR\",\"preiDR\":\"$iDR\",\"preDRqna_ini\":\"$DRqna_ini\",
	    				\"preDRqna_fin\":\"$DRqna_fin\",\"preDRnum_docto\":\"$DRnum_docto\",\"preBS\":\"$BS\",\"preiBS\":\"$iBS\",
	    				\"preBSqna_ini\":\"$BSqna_ini\",\"preBSqna_fin\":\"$BSqna_fin\",\"preBSnum_docto\":\"$BSnum_docto\",
	    				\"preI4\":\"$I4\",\"preiI4\":\"$iI4\",\"preI4qna_ini\":\"$I4qna_ini\",\"preI4qna_fin\":\"$I4qna_fin\",
	    				\"preI4num_docto\":\"$I4num_docto\",\"preE3\":\"$E3\",\"preiE3\":\"$iE3\",\"preE3qna_ini\":\"$E3qna_ini\",
	    				\"preE3qna_fin\":\"$E3qna_fin\",\"preE3num_docto\":\"$E3num_docto\"}]";
	    $arrayR1_FUPPre = json_decode(json_encode($JSON_FUPPre), True);
	    $params_FUPPre = array('Resultado'=>$id_consulta_FUPPre, 'Argumento'=>$arrayR1_FUPPre, 'Accion'=>"insert");//para conseguir la consulta
	    //var_dump($params_FUPPre);
	   	$resultadoss_FUPPre=$cliente->getConsulta($params_FUPPre);
		$arrayR3_FUPPre= json_decode(json_encode($resultadoss_FUPPre), True);
?>