<?php
class Permisos
{
	private $permisos;
	public function Menu($app, $usuario, $con)
	{

		global $opc_n;
		$opc_n = 0;
		global $opc;
		$opc = "null";
		$array_opc = array();

		/*$sql = "select opc from seguridad..mvc_permisos_opciones where clave_app = ".$app." and usuario = '".$usuario."' order by opc desc";*/
		$sql = "select opc from [SVRDWH\SBDCGIAPASO].seguridad.dbo.mvc_permisos_opciones where clave_app = " . $app . " and usuario = '" . $usuario . "' order by opc desc";
		$stmt = sqlsrv_query($con, $sql);
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			//echo $row['opc'];
			$opc = $row['opc'];
			array_push($array_opc, $opc);
			//$array_opc[] = ["opc",$opc];
		}
		//sqlsrv_free_stmt( $stmt);
		//var_dump($array_opc);

		return $array_opc;
	}
}
