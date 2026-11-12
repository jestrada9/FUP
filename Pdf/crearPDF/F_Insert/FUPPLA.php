<?php
if($NIVEL_SUELDO_NUEVO==""){
    $NIVEL_SUELDO_NUEVO = "0";
}
        $id_consulta_FUPPla =   138;
        $JSON_FUPPla="[{\"AREA_PLA\":\"$AREA_PLA\",\"NUM_DOC\":\"$docto_num\",\"NUM_PAGINA\":\"$Pagina\",\"ID_PLA\":\"$ID_PLA\",
                    \"TM\":\"$TM\",\"MO\":\"$MO\",\"CONS_DOC\":\"$CONS_DOC\",\"PARTIDA_MOV\":\"$PARTIDA_MOV\",
                    \"CODIGO_PAGO_MOV\":\"$CODIGO_PAGO_MOV\",\"UNIDAD_MOV\":\"$UNIDAD_MOV\",\"SUBUNIDAD_MOV\":\"$SUBUNIDAD_MOV\",
                    \"CATEGORIA_MOV\":\"$CATEGORIA_MOV\",\"HORAS_MOV\":\"$HORAS_MOV\",\"PLAZA_MOV\":\"$PLAZA_MOV\",
                    \"DESDE_MOV\":\"$DESDE_MOV\",\"HASTA_MOV\":\"$HASTA_MOV\",\"NOMBRE_SUS_MOV\":\"$NOMBRE_SUS_MOV1\",
                    \"RFCSUS_MOV\":\"$RFCSUS_MOV1\",\"MOT_MOVSUS\":\"$MOT_MOVSUS1\",\"QNA_INISUS_MOV\":\"$QNA_INISUS_MOV1\",
                    \"QNA_FINSUS_MOV\":\"$QNA_FINSUS_MOV1\",\"NUM_DOCUMENTOSUS\":\"$NUM_DOCUMENTOSUS1\",\"CT_MOV\":\"$CT_MOV\",
                    \"NIVEL_SUELDO_NUEVO\":\"$NIVEL_SUELDO_NUEVO\",\"PLA_BASIFICACION\":\"$PLA_BASIFICACION\",
                    \"PLA_PROMOCION\":\"$PLA_PROMOCION\",\"PLAQNA_ING_SUB\":\"$PLAQNA_ING_SUB\"}]";
        $arrayR1_FUPPla = json_decode(json_encode($JSON_FUPPla), True);
        $params_FUPPla = array('Resultado'=>$id_consulta_FUPPla, 'Argumento'=>$arrayR1_FUPPla, 'Accion'=>"insert"); //para conseguir la consulta
        //var_dump($params_FUPPla);
        $resultadoss_FUPPla=$cliente->getConsulta($params_FUPPla);
        $arrayR3_FUPPla= json_decode(json_encode($resultadoss_FUPPla), True);
?>