<?php
ini_set("soap.wsdl_cache_enabled", "0");
$cliente2 = new SoapClient("https://appcgia.seslp.gob.mx/WebService_FUP_Foliacion/WebService.asmx?WSDL", array( 'exceptions' => true, ));
//$cliente2 = new SoapClient("https://appcgia.seslp.gob.mx/WebService_FUP_Foliacion_Pruebas/WebService.asmx?WSDL", array( 'exceptions' => true, ));
?>