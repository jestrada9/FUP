<?php
ini_set("soap.wsdl_cache_enabled", "0");
//$cliente = new SoapClient("http://localhost:8084/WebService_Consultas/WS?wsdl", array( 'exceptions' => true, ));
$cliente = new SoapClient("https://appcgia.seslp.gob.mx/WebService_FUP/WebService.asmx?WSDL", array('exceptions' => true,));
//$cliente = new SoapClient("https://appcgia.seslp.gob.mx/WebService_FUP_Pruebas/WebService.asmx?WSDL", array('exceptions' => true,));
?>