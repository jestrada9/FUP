<?php

$get = (isset($_POST['id'])  && !empty($_POST['id']));
if($get) {

	$documento = $_POST['id'];
	$directorioCT = "../FUPs/Masivo_Original/CCT/";
	$directorio_totalCT = glob($directorioCT."*.pdf");

    function getRealIP() {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
    }

	function abrir_pdf($value){
		$Object = new DateTime();
		$Object->setTimezone(new DateTimeZone('America/Mexico_City'));
		$DateAndTime = $Object->format("d-m-Y h:i:s a");

		$ip = getRealIP();

		$contenido = "".$DateAndTime." Documento_Mostrado:".$value."-".$ip."\r\n";
		$archivo = fopen('Documento_Mostrado.txt','a');
		fputs($archivo,$contenido);
		fclose($archivo);

		/* Fecha real de la ultima generacion del PDF.
		   Antes se intentaba sacar la fecha del nombre del archivo y, si no
		   venia, se le restaban 18 horas al filemtime: eso mostraba una fecha
		   que no correspondia al archivo. */
		$timestamp = @filemtime($value);
		if($timestamp === false){
			$fechaModificacion = $DateAndTime;
			$version = time();
		}else{
			$f = new DateTime("@".$timestamp);
			$f->setTimezone(new DateTimeZone('America/Mexico_City'));
			$fechaModificacion = $f->format("d-m-Y H:i:s");
			$version = $timestamp;
		}

		/* El nombre del PDF no cambia al reeditar el FUP, asi que el navegador
		   seguia mostrando en el iframe la copia que tenia en cache. El ?v= con
		   la fecha de modificacion lo obliga a pedir el archivo de nuevo. */
		return array(
			'archivo'    => $value.'?v='.$version,
			'fecha_hora' => $fechaModificacion
		);
	}

	$resultado = array('archivo' => '', 'fecha_hora' => '');

	/* Se busca el num_docto como segmento completo del nombre del archivo
	   (_<num_docto>_), no en cualquier parte de la ruta. */
	$patron = '/_'.preg_quote($documento, '/').'_/i';
	$matchesCT = array_filter($directorio_totalCT, function($var) use ($patron) {
		return preg_match($patron, basename($var));
	});

	if(!$matchesCT){
		/* Respaldo: coincidencia simple, como se hacia antes. */
		$matchesCT = array_filter($directorio_totalCT, function($var) use ($documento) {
			return strpos(basename($var), $documento) !== false;
		});
	}

	if($matchesCT){
		/* Si hay varios archivos del mismo documento (por ejemplo cuando el
		   area cambio entre ediciones y el nombre quedo distinto), gana el mas
		   reciente. Antes se tomaba el ultimo que devolvia glob(), que es el
		   ultimo en orden alfabetico, no el mas nuevo. */
		$elegido = '';
		$mejor   = -1;
		foreach ($matchesCT as $value){
			$m = @filemtime($value);
			if($m === false){ $m = 0; }
			if($m > $mejor){
				$mejor   = $m;
				$elegido = $value;
			}
		}
		if($elegido != ''){
			$resultado = abrir_pdf($elegido);
		}
	}

	header('Content-Type: application/json');
	echo json_encode($resultado);
}
?>
