<?php

$get = (isset($_POST['id'])  && !empty($_POST['id']));
if($get) {

	$documento = $_POST['id'];
	$directorio = "../FUPs/Masivo_Original/";
	$directorioCT = "../FUPs/Masivo_Original/CCT/";
	$directorio_total = glob($directorio."*.pdf");
	$directorio_totalCT = glob($directorioCT."*.pdf");

    function getRealIP() {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        return $_SERVER['REMOTE_ADDR'];
    }

	function abrir_pdf($value){//function abrir_pdf

		$Object = new DateTime();
		$Object->setTimezone(new DateTimeZone('America/Mexico_City'));
		$DateAndTime = $Object->format("d-m-Y h:i:s a");

		$ip = getRealIP();

		$contenido = "".$DateAndTime." Documento_Mostrado:".$value."-".$ip."\r\n";
		$archivo = fopen('Documento_Mostrado.txt','a');

		fputs($archivo,$contenido);
		fclose($archivo);

		/* El nombre del PDF no cambia cuando el documento se vuelve a generar,
		   asi que el navegador seguia mostrando en el iframe la copia que tenia
		   en cache. El ?v= con la fecha de modificacion lo obliga a pedirlo de
		   nuevo. El JavaScript le concatena despues el #toolbar=0&..., que es un
		   fragmento y por eso no servia para romper la cache. */
		$version = @filemtime($value);
		if($version === false){ $version = time(); }

		echo $value.'?v='.$version;//este echo manda la liga completa del fup
	}//function abrir_pdf

	/* Busca el num_docto como segmento completo del nombre del archivo
	   (_<num_docto>_) y no en cualquier parte de la ruta. */
	function coincidencias($lista, $documento){
		$patron = '/_'.preg_quote($documento, '/').'_/i';
		$r = array_filter($lista, function($var) use ($patron) {
			return preg_match($patron, basename($var));
		});
		if(!$r){
			/* Respaldo: coincidencia simple, como se hacia antes. */
			$r = array_filter($lista, function($var) use ($documento) {
				return strpos(basename($var), $documento) !== false;
			});
		}
		return $r;
	}

	/* De todos los archivos que coinciden, gana el mas reciente. Antes se
	   tomaba el ultimo que devolvia glob(), que es el ultimo en orden
	   alfabetico y no el mas nuevo: con dos PDFs del mismo documento
	   (por ejemplo cuando el area cambio entre ediciones y el nombre quedo
	   distinto) se mostraba el viejo. */
	function mas_reciente($listas){
		$elegido = '';
		$mejor   = -1;
		foreach ($listas as $lista){
			foreach ($lista as $value){
				$m = @filemtime($value);
				if($m === false){ $m = 0; }
				if($m > $mejor){
					$mejor   = $m;
					$elegido = $value;
				}
			}
		}
		return $elegido;
	}

	$matches   = coincidencias($directorio_total, $documento);
	$matchesCT = coincidencias($directorio_totalCT, $documento);

	/* Antes habia dos bloques, if($matches && !$matchesCT) y
	   if(!$matches && $matchesCT): cuando el mismo num_docto existia en las
	   dos carpetas no entraba a ninguno y no se mostraba nada. Ahora se
	   juntan las dos listas y gana el archivo mas reciente. */
	if($matches || $matchesCT){
		$elegido = mas_reciente(array($matches, $matchesCT));
		if($elegido != ''){
			abrir_pdf($elegido);
		}
	}
}
?>
