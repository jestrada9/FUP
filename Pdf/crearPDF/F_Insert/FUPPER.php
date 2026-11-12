<?php
include_once __DIR__."/../normaliza_xml.php";

/* -----------------------------------------------------------------
   Blindaje: los nodos XML vacios o con atributos (xsi:nil) llegan
   como array desde json_decode(json_encode(simplexml_load_string())).
   Al interpolarlos en el JSON de abajo PHP lanza
   "Array to string conversion". Aqui se convierte TODO a cadena.
   El log solo se escribe si algun campo llego como array/objeto,
   para poder identificar cual es; si no, no hace nada.
   ----------------------------------------------------------------- */
$campos_FUPPer = array(
    'AREA_PER'        => &$AREA_PER,
    'NUM_DOCUMENTO'   => &$docto_num,
    'RFC'             => &$RFC,
    'NOMBRE_EMPLEADO' => &$NOMBRE_EMPLEADO,
    'EDO_NAC'         => &$EDO_NAC,
    'SEXO'            => &$SEXO,
    'EDO_CIVIL'       => &$EDO_CIVIL,
    'CALLE'           => &$CALLE,
    'LOCACION'        => &$LOCACION,
    'MUNICIPIO'       => &$MUNICIPIO,
    'COD_POSTAL'      => &$COD_POSTAL,
    'PUESTO'          => &$PUESTO,
    'QNA_INI_GOB'     => &$QNA_INI_GOB,
    'QNA_ING_SEP'     => &$QNA_ING_SEP,
    'NUM_TITULO'      => &$numero1,
    'NUM_LICENCIATURA'=> &$numero2,
    'PERQ'            => &$PERQ,
    'PERA'            => &$PERA,
    'PERL'            => &$PERL,
    'PERT'            => &$PERT,
    'PERCT1'          => &$PERCT1,
    'PERHR1'          => &$PERHR1_,
    'PERCT2'          => &$PERCT2,
    'PERHR2'          => &$PERHR2_,
    'PERCT3'          => &$PERCT3,
    'PERHR3'          => &$PERHR3_,
    'PERCT4'          => &$PERCT4,
    'PERHR4'          => &$PERHR4_,
    'PERCT5'          => &$PERCT5,
    'PERHR5'          => &$PERHR5_,
    'PERCT6'          => &$PERCT6,
    'PERHR6'          => &$PERHR6_,
    'PERRFC_NUEVO'    => &$PERRFC_NUEVO,
);
$noEscalares_FUPPer = array();
foreach($campos_FUPPer as $nombre_FUPPer => &$ref_FUPPer){
    if(is_array($ref_FUPPer) || is_object($ref_FUPPer)){
        $noEscalares_FUPPer[$nombre_FUPPer] = $ref_FUPPer;
    }
    $ref_FUPPer = fup_txt($ref_FUPPer);
}
unset($ref_FUPPer, $campos_FUPPer);
if(!empty($noEscalares_FUPPer)){
    @file_put_contents(
        __DIR__."/FUPPER_campos_array.log",
        date("Y-m-d H:i:s")." docto=".$docto_num." ".var_export($noEscalares_FUPPer, true)."\r\n",
        FILE_APPEND
    );
}

$id_consulta_FUPPer = 	146;
$JSON_FUPPer="[{\"AREA_PER\":\"$AREA_PER\",\"NUM_DOCUMENTO\":\"$docto_num\",\"RFC\":\"$RFC\",\"NOMBRE_EMPLEADO\":\"$NOMBRE_EMPLEADO\",
				\"EDO_NAC\":\"$EDO_NAC\",\"SEXO\":\"$SEXO\",\"EDO_CIVIL\":\"$EDO_CIVIL\",\"CALLE\":\"$CALLE\",
				\"LOCACION\":\"$LOCACION\",\"MUNICIPIO\":\"$MUNICIPIO\",\"COD_POSTAL\":\"$COD_POSTAL\",
				\"PUESTO\":\"$PUESTO\",\"QNA_INI_GOB\":\"$QNA_INI_GOB\",\"QNA_ING_SEP\":\"$QNA_ING_SEP\",
				\"NUM_TITULO\":\"$numero1\",\"NUM_LICENCIATURA\":\"$numero2\",\"PERQ\":\"$PERQ\",\"PERA\":\"$PERA\",
				\"PERL\":\"$PERL\",\"PERT\":\"$PERT\",\"PERCT1\":\"$PERCT1\",\"PERHR1\":\"$PERHR1_\",\"PERCT2\":\"$PERCT2\",
				\"PERHR2\":\"$PERHR2_\",\"PERCT3\":\"$PERCT3\",\"PERHR3\":\"$PERHR3_\",\"PERCT4\":\"$PERCT4\",\"PERHR4\":\"$PERHR4_\",
				\"PERCT5\":\"$PERCT5\",\"PERHR5\":\"$PERHR5_\",\"PERCT6\":\"$PERCT6\",\"PERHR6\":\"$PERHR6_\",
				\"PERRFC_NUEVO\":\"$PERRFC_NUEVO\"}]";
$arrayR1_FUPPer = json_decode(json_encode($JSON_FUPPer), True);
$params_FUPPer = array('Resultado'=>$id_consulta_FUPPer, 'Argumento'=>$arrayR1_FUPPer, 'Accion'=>"insert"); //para conseguir la consulta
//var_dump($params_FUPPer);
$resultadoss_FUPPer=$cliente->getConsulta($params_FUPPer);
$arrayR3_FUPPer= json_decode(json_encode($resultadoss_FUPPer), True);
?>