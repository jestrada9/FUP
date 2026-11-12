<?php

		$cmpjustificacionR12 = properText($cmpjustificacionR11);
		$variable= utf8_encode( $cmpjustificacionR11);
		$id_consulta_FUPCMP = 	159;
		$JSON_FUPCMP="[{\"AREA_PLA\":\"$AREA_PLA\",\"NUM_DOC\":\"$docto_num\",\"NUM_PAGINA\":\"$Pagina\",\"ID_PLA\":\"$ID_PLA\",
	    				\"PARTIDA\":\"$cmppartidaR1\",\"CODIGO_PAGO\":\"$cmpcod_pagoR1\",\"UNIDAD\":\"$cmpunidadR1\",
	    				\"SUBUNIDAD\":\"$cmpsubunidadR1\",\"CATEGORIA\":\"$cmpcat_puestoR1\",\"HORAS\":\"$cmphorasR1\",
	    				\"PLAZA\":\"$cmpcons_plazaR1\",\"IMPORTE_A\":\"$cmpimporteanteriorR1\",\"QNA_INI\":\"$cmpqna_iniR1\",
	    				\"QNA_FIN\":\"$cmpqna_finR1\",\"ANIO_PROC\":\"$cmpanio_procR1\",\"FIJO\":\"$cmpfijoR1\",
	    				\"PROGRAMA\":\"$cmpprogramaR1\",\"SUBPROGRAMA\":\"$cmpsubprogramaR1\",\"PROYECTO\":\"$cmpproyectoR1\",
	    				\"UNIDAD_R\":\"$cmpunidad_respR1\",\"CONCEPTO\":\"$cmpconceptoR1\",\"ABC\":\"$cmpabcR1\",
	    				\"IMPORTENUEVO\":\"$cmpimportenuevoR11\",\"JUSTIFICACION\":\"$variable\"}]";
	    $arrayR1_FUPCMP = json_decode(json_encode($JSON_FUPCMP), True);
	    $params_FUPCMP = array('Resultado'=>$id_consulta_FUPCMP, 'Argumento'=>$arrayR1_FUPCMP, 'Accion'=>"insert"); //para conseguir la consulta
	    //var_dump($params_FUPCMP);
	    
	    $resultadoss_FUPCMP=$cliente->getConsulta($params_FUPCMP);
		$arrayR3_FUPCMP= json_decode(json_encode($resultadoss_FUPCMP), True);
		
?>		