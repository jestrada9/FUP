<?php
	$rutaConfig = __DIR__ . '/config.php';
	if (!is_file($rutaConfig)) {
		die('Falta Conexion/config.php. Copia Conexion/config.ejemplo.php como config.php y pon los datos reales.');
	}
	$cfgFUP = require $rutaConfig;

	$srv  = $cfgFUP['sqlsrv']['servidor'];
	$op1c = array("UID" => $cfgFUP['sqlsrv']['usuario'], "PWD" => $cfgFUP['sqlsrv']['password']);
	$con  = sqlsrv_connect($srv, $op1c) or die(print_r(sqlsrv_errors(), true));
?>
