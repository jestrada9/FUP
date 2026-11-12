<?php
 	if($metodo_consulta=="ConsultaTrabajador_Original_CT"){
	 	$JSON_TRA="[{\"num_docto\":\"$docto_numFUP\",\"rfc\":\"$rfcFUP\",\"area\":\"$areaFUP\",\"num_oficio\":\"$num_oficioFUP\"}]";
		$arrayR1_TRA = json_decode(json_encode($JSON_TRA), True);
		$params_TRA = array('Resultado'=>$id_consulta_TRA, 'Argumento'=>$arrayR1_TRA, 'Accion'=>"select"); //para conseguir la consulta
		//var_dump($params_TRA);
		$resultados_TRA=$cliente->getConsulta($params_TRA);
	    $arrayR3_TRA= json_decode(json_encode($resultados_TRA), True);
 	}
 	if($metodo_consulta=="ConsultaTrabajador_Original1"){
	 	$JSON_TRA="[{\"Valor\":\"$docto_num\"}]";
		$arrayR1_TRA = json_decode(json_encode($JSON_TRA), True);
		$params_TRA = array('Resultado'=>$id_consulta_TRA, 'Argumento'=>$arrayR1_TRA, 'Accion'=>"select"); //para conseguir la consulta
		//var_dump($params_TRA);
		$resultados_TRA=$cliente->getConsulta($params_TRA);
	    $arrayR3_TRA= json_decode(json_encode($resultados_TRA), True);
 	}
 	if($metodo_consulta=="ConsultaTrabajador_Original90"){
	 	$JSON_TRA="[{\"Valor\":\"$docto_num\"}]";
		$arrayR1_TRA = json_decode(json_encode($JSON_TRA), True);
		$params_TRA = array('Resultado'=>$id_consulta_TRA, 'Argumento'=>$arrayR1_TRA, 'Accion'=>"select"); //para conseguir la consulta
		//var_dump($params_TRA);
		$resultados_TRA=$cliente->getConsulta($params_TRA);
	    $arrayR3_TRA= json_decode(json_encode($resultados_TRA), True);
 	}
 	if($metodo_consulta=="ConsultaMovimientos_Original_CT"){
		$JSON_Mov="[{\"num_docto\":\"$docto_numFUP\",\"rfc\":\"$rfcFUP\",\"area\":\"$areaFUP\",\"num_oficio\":\"$num_oficioFUP\"}]";
	    $array_Mov = json_decode(json_encode($JSON_Mov), True);
	    $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov, 'Accion'=>"select"); //para conseguir la consulta
	    //var_dump($params_Mov);
	    $resultados_Mov=$cliente->getConsulta($params_Mov);
		$arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
		//var_dump($arrayR_Mov); 
	} 	
 	if($metodo_consulta=="ConsultaMovimientos_Original1"){
		$JSON_Mov="[{\"Valor\":\"$docto_num\"}]";
	    $array_Mov = json_decode(json_encode($JSON_Mov), True);
	    $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov, 'Accion'=>"select"); //para conseguir la consulta
	    //var_dump($params_Mov);
	    $resultados_Mov=$cliente->getConsulta($params_Mov);
		$arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
		//var_dump($arrayR_Mov); 
	}
		//var_dump($arrayR_Mov); 
	
	if($metodo_consulta=="ConsultaMovimientos_Original90"){
		$JSON_Ant90="[{\"num_docto\":\"$docto_num\",\"rfc\":\"$rfcFUP\",\"area\":\"$areaFUP\",\"num_oficio\":\"$num_oficioFUP\"}]";
	    $array_Ant90 = json_decode(json_encode($JSON_Ant90), True);
	    $params_Ant90 = array('Resultado'=>$id_consulta_Ant90, 'Argumento'=>$array_Ant90, 'Accion'=>"select"); //para conseguir la consulta
	    //var_dump($params_Mov);
	    $resultados_Ant90=$cliente->getConsulta($params_Ant90);
		$arrayR_Ant90= json_decode(json_encode($resultados_Ant90), True);
	}
	if($metodo_consulta=="ConsultaAntecedente_Original_CT"){	
		$JSONAnt="[{\"num_docto\":\"$docto_numFUP\",\"rfc\":\"$rfcFUP\",\"area\":\"$areaFUP\",\"num_oficio\":\"$num_oficioFUP\"}]";
	    $arrayR1Ant = json_decode(json_encode($JSONAnt), True);
	    $paramsAnt = array('Resultado'=>$id_consultaAnt, 'Argumento'=>$arrayR1Ant, 'Accion'=>"select"); //para conseguir la consulta
	    //var_dump($paramsAnt);
	    $resultadoss_Ant=$cliente->getConsulta($paramsAnt);
		$arrayR3_Ant= json_decode(json_encode($resultadoss_Ant), True);
		//var_dump($arrayR3_Ant);
	}
	if($metodo_consulta=="ConsultaAntecedente_Original1"){	
		$JSONAnt="[{\"Valor\":\"$docto_num\",\"rfc\":\"$rfc\",\"area\":\"$areaFUP\",\"num_oficio\":\"$num_oficioFUP\"}]";
	    $arrayR1Ant = json_decode(json_encode($JSONAnt), True);
	    $paramsAnt = array('Resultado'=>$id_consultaAnt, 'Argumento'=>$arrayR1Ant, 'Accion'=>"select"); //para conseguir la consulta
	    //var_dump($paramsAnt);
	    $resultadoss_Ant=$cliente->getConsulta($paramsAnt);
		$arrayR3_Ant= json_decode(json_encode($resultadoss_Ant), True);
		//var_dump($arrayR3_Ant);
	}	
	if($metodo_consulta=="ConsultaCMP_Original1"){	
		$JSONcmp="[{\"Valor\":\"$docto_num\"}]";
	    $arrayR1cmp = json_decode(json_encode($JSONcmp), True);
	    $paramscmp = array('Resultado'=>$id_consultacmp, 'Argumento'=>$arrayR1cmp, 'Accion'=>"select"); //para conseguir la consulta
	    //var_dump($paramscmp);
	    $resultadoss_cmp=$cliente->getConsulta($paramscmp);
		$arrayR3_cmp= json_decode(json_encode($resultadoss_cmp), True);
		//var_dump($arrayR3_cmp);
	}
	if($metodo_consulta=="ConsultaConceptoImporte_Original1"){		
	 	$JSONAT="[{\"cat_puesto\":\"$CATEGORIA\",\"nivel_sueldo\":\"$Nivel_Sdo1\",\"qna_ini\":\"$DESDE\"}]";
	    $arrayRAT = json_decode(json_encode($JSONAT), True);
	    $paramsAT = array('Resultado'=>$id_consultaAT, 'Argumento'=>$arrayRAT, 'Accion'=>"select"); //para conseguir la consulta
	    $resultadossAT=$cliente->getConsulta($paramsAT);  
	    $arrayAT= json_decode(json_encode($resultadossAT), True);
	}
	if($metodo_consulta=="ConsultaParte2_Original1"){		
		/*
		$JSON_Parte2="[{\"rfc\":\"$rfc\",\"qna_ini\":\"$DESDE\",\"qna_fin\":\"$HASTA\"}]";
		$parametros_Parte2 = json_decode(json_encode($JSON_Parte2), True);
		$params_Parte2 = array('id'=>$id_consulta_Parte2, 'Parametros'=>$parametros_Parte2); //para conseguir la consulta
		//var_dump($params_Parte2);
		$resultados_Parte2=$cliente->id_consulta($params_Parte2);	
		$arrayR3_Parte2= json_decode(json_encode($resultados_Parte2), True);	
		*/
		$JSON_Parte2="[{\"rfc\":\"$rfc\",\"qna_ini\":\"$DESDE\",\"qna_fin\":\"$HASTA\"}]";
		$parametros_Parte2 = json_decode(json_encode($JSON_Parte2), True);
		$params_Parte2 = array('Resultado'=>$id_consulta_Parte2, 'Argumento'=>$parametros_Parte2, 'Accion'=>"select"); //para conseguir la consulta
		//var_dump($params_Parte2);
		$resultados_Parte2=$cliente->getConsulta($params_Parte2);	
		$arrayR3_Parte2= json_decode(json_encode($resultados_Parte2), True);		
	}
	if($metodo_consulta=="ConsultaFirmas_Original1"){
		$JSON_firmas="[{\"FEC_IMP\":\"$FECHAD\"}]";
        $arrayR1_firmas = json_decode(json_encode($JSON_firmas), True);
        $params_firmas = array('Resultado'=>$id_consulta_firmas, 'Argumento'=>$arrayR1_firmas, 'Accion'=>"select"); //para conseguir la consulta
        $resultados_firmas=$cliente->getConsulta($params_firmas);
        //var_dump($params_firmas);
        $arrayR_firmas = json_decode(json_encode($resultados_firmas), True);
	}
	if($metodo_consulta=="ConsultaDia_Original1"){
	    $JSONF1="[{\"fecha_def\":\"$DESDE_MOVf\",\"num_docto\":\"$docto_num\"}]";
	    $arrayF1 = json_decode(json_encode($JSONF1), True);
	    $paramsF1 = array('Resultado'=>$id_consultaF1, 'Argumento'=>$arrayF1, 'Accion'=>"insert"); //para conseguir la consulta
	    $resultadosF1=$cliente->getConsulta($paramsF1);
		$arrayRF1= json_decode(json_encode($resultadosF1), True);
	}
	if($metodo_consulta=="ConsultaDocs_Original1"){
		$JSONDOCS="[{\"cpr\":\"$CPR1\",\"fec_imp\":\"$FECHAD\",\"num_docto\":\"$docto_num\",\"doc_anexa1\":\"$DOC_ANEXA1_M\",\"doc_anexa2\":\"$DOC_ANEXA2_M\",\"doc_anexa3\":\"$DOC_ANEXA3_M\",\"doc_anexa4\":\"$DOC_ANEXA4_M\",\"doc_anexa5\":\"$DOC_ANEXA5_M\",\"obsrv1\":\"$DOC_OBSRV1_M\",\"obsrv2\":\"$DOC_OBSRV2_M\",\"obsrv3\":\"$DOC_OBSRV3_M\",\"obsrv4\":\"$DOC_OBSRV4_M\"}]";
		$arrayDOCS = json_decode(json_encode($JSONDOCS), True);
		$paramsDOCS = array("Resultado"=>$id_consultaDOCS, "Argumento"=>$arrayDOCS, 'Accion'=>"insert"); //para conseguir la consulta
		//var_dump($paramsDOCS);
		$resultadosDOCS=$cliente->getConsulta($paramsDOCS);
		$arrayR3= json_decode(json_encode($resultadosDOCS), True);
	}
	if($metodo_consulta=="ConsultaDocs_Original1CT"){
		$FECHAD2 = date('Ymd', strtotime($FECHAD));
		$JSONDOCS="[{\"cpr\":\"$CPR1\",\"fec_imp\":\"$FECHAD2\",\"num_docto\":\"$docto_num\",\"doc_anexa1\":\"$DOC_ANEXA1_M\",\"doc_anexa2\":\"$DOC_ANEXA2_M\",\"doc_anexa3\":\"$DOC_ANEXA3_M\",\"doc_anexa4\":\"$DOC_ANEXA4_M\",\"doc_anexa5\":\"$DOC_ANEXA5_M\",\"obsrv1\":\"$DOC_OBSRV1_M\",\"obsrv2\":\"$DOC_OBSRV2_M\",\"obsrv3\":\"$DOC_OBSRV3_M\",\"obsrv4\":\"$DOC_OBSRV4_M\"}]";
		$arrayDOCS = json_decode(json_encode($JSONDOCS), True);
		$paramsDOCS = array("Resultado"=>$id_consultaDOCS, "Argumento"=>$arrayDOCS, 'Accion'=>"update"); //para conseguir la consulta
		//var_dump($paramsDOCS);
		$resultadosDOCS=$cliente->getConsulta($paramsDOCS);
		$arrayR3= json_decode(json_encode($resultadosDOCS), True);
	}















?>