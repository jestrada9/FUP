<?php
require_once('../Conexion/ServicioWeb.php');
$conulta = $_GET["cons"];
$relacion = base64_decode($_GET["relacion"]);
//echo $relacion;
$relacion = str_replace("'", "-", $relacion);
//echo $relacion;
// $id_consulta_Mov2 =  221;
// $id_consulta_Mov1 =  212;
switch ($conulta) {
	case 1:
		$id_consulta_Mov =  232; //consulta DOCENTES  ORDENAMIENTO
		break;
	case 2:
		$id_consulta_Mov =  231; //consulta DOCENTES NO ORDENAMIENTO
		break;
	case 3:
		$id_consulta_Mov =  216; //consulta DOCENTES BAJAS
		break;
	case 4:
		$id_consulta_Mov =  217; //consulta DOCENTES LICENCIAS
		break;
	case 5:
		$id_consulta_Mov =  238; //consulta DOCENTES GUIONES

	case 6:
		//$id_consulta_Mov =  199; //consulta ADMIN  ORDENAMIENTO
		echo json_encode(["data" => []]); //DEVOLVER JSON VACIO PARA EVITAR EL ERROR
		exit;
	case 7:
		$id_consulta_Mov =  198; //consulta ADMIN NO ORDENAMIENTO
		break;
	case 8:
		$id_consulta_Mov =  225; //consulta ADMIN BAJAS
		break;
	case 9:
		$id_consulta_Mov =  226; //consulta ADMIN LICENCIAS
		break;
	case 10:
		$id_consulta_Mov =  237; //consulta ADMIN GUIONES
		break;
	case 11:
		$id_consulta_Mov =  252; //consulta TODOS
		break;
	case 12:
		$id_consulta_Mov =  255; //consulta RELACION
		break;
	case 13:
		$id_consulta_Mov =  263; //consulta GUIONES TODOS
		break;
	case 14:
		$id_consulta_Mov =  1270; //consulta CAMBIOS CT
		break;
	case 16:
		$id_consulta_Mov =  1314; //consulta CAMBIOS CT Pendientes
		break;
	case 17:
		$id_consulta_Mov =  2322; //consulta CAMBIOS CT Pendientes
		break;
	default:
		$id_consulta_Mov =  -1;
		break;
}

$JSON_Mov = "[{\"relacion\":\"$relacion\"}]";
$array_Mov = json_decode(json_encode($JSON_Mov), True);
$params_Mov = array('Resultado' => $id_consulta_Mov, 'Argumento' => $array_Mov); //para conseguir la consulta
$resultados_Mov = $cliente->getConsulta($params_Mov);
//var_dump($params_Mov);
$arrayR_Mov = json_decode(json_encode($resultados_Mov), True);
//var_dump($arrayR_Mov);
$xml = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json, TRUE);
//var_dump($array['NewDataSet']['table']);
if (!empty($array)) {
	$propuesta_cgrh = "";
	$fecha = "";
	$num_docto  = "";
	$plazas     = "";
	$datoalt 	 = "";
	$b = 0;
	$data = array();
	$id = 0;

	$ver = $array['NewDataSet']['table'];
	$vers = $array['NewDataSet'];
	//var_dump($ver);
	//var_dump($tot_resul_mov);
	if (!isset($ver[0])) {
		$tot_resul_mov = count($vers);
		while ($b < $tot_resul_mov) { //while
			if (isset($ver['propuesta'])) {
				$propuesta_cgrh = $ver['propuesta'];
				if ($propuesta_cgrh == "NULL") {
					$propuesta_cgrh = "";
				}
			}
			$num_docto  = $ver['idnum_docto'];
			$rfc 	   		= $ver['rfc'];
			if (isset($ver['plaza'])) {
				$plazas     = $ver['plaza'];
				if ($plazas == "NULL") {
					$plazas = "";
				}
			}
			if (isset($ver['fecha'])) {
				$fecha     = $ver['fecha'];
				if ($fecha == "NULL") {
					$fecha = "";
				}
			}
			if (isset($ver['mot_mov'])) {
				$mot_mov1     = $ver['mot_mov'];
				if ($mot_mov1 == "NULL") {
					$mot_movs = "";
				} else {
					$mot_movs 	= str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
				}
			}
			//$mot_mov1   = $ver[$b]['mot_mov'];
			//$mot_movs 	= str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
			$area_nombre = $ver['area_nombre'];
			$area    	   = $ver['area'];
			$num_oficio  = $ver['num_oficio'];
			if (isset($ver['datoalt'])) {
				$datoalt     = $ver['datoalt'];
			}
			$addoc       = $ver['addoc'];
			if ($addoc == "NULL") {
				$addoc = "";
			}

			$data[] = [$num_docto, $propuesta_cgrh, $num_docto, $rfc, $plazas, $fecha, $mot_movs, "", $area_nombre, $area, $num_oficio, $addoc, $datoalt, ""];
			$id = $id + 1;
			$b++;
		} //fin 2do while getDatosPDF_Mov  						
	} else {
		$tot_resul_mov = count($ver);
		while ($b < $tot_resul_mov) { //while
			if (isset($ver[$b]['propuesta'])) {
				$propuesta_cgrh = $ver[$b]['propuesta'];
				if ($propuesta_cgrh == "NULL") {
					$propuesta_cgrh = "";
				}
			}
			$num_docto  = $ver[$b]['idnum_docto'];
			$rfc 	   		= $ver[$b]['rfc'];
			if (isset($ver[$b]['plaza'])) {
				$plazas     = $ver[$b]['plaza'];
				if ($plazas == "NULL") {
					$plazas = "";
				}
			}
			if (isset($ver[$b]['fecha'])) {
				$fecha     = $ver[$b]['fecha'];
				if ($fecha == "NULL") {
					$fecha = "";
				}
			}
			if (isset($ver[$b]['mot_mov'])) {
				$mot_mov1     = $ver[$b]['mot_mov'];
				if ($mot_mov1 == "NULL") {
					$mot_movs = "";
				} else {
					$mot_movs 	= str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
				}
			}
			//$mot_mov1   = $ver[$b]['mot_mov'];
			//$mot_movs 	= str_pad($mot_mov1, 2, "0", STR_PAD_LEFT);
			$area_nombre = $ver[$b]['area_nombre'];
			$area    	   = $ver[$b]['area'];
			$num_oficio  = $ver[$b]['num_oficio'];
			if (isset($ver[$b]['datoalt'])) {
				$datoalt     = $ver[$b]['datoalt'];
			}
			$addoc       = $ver[$b]['addoc'];
			if ($addoc == "NULL") {
				$addoc = "";
			}
			$data[] = [$num_docto, $propuesta_cgrh, $num_docto, $rfc, $plazas, $fecha, $mot_movs, "", $area_nombre, $area, $num_oficio, $addoc, $datoalt, ""];
			$id = $id + 1;
			$b++;
		} //fin 2do while getDatosPDF_Mov  							
	}



	$results = array(
		"data" => $data
	);
	echo json_encode($results);
} else {
	$data[] = ["", "", "", "", "", "", "", "", "", "", "", "", "", "", ""];
	$results = array(
		"data" => ""
	);
	echo json_encode($results);
}
