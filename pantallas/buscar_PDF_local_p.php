<?php

$get = "2405311315";//(isset($_POST['id'])  && !empty($_POST['id']));
if($get) {

   
	$documento = "2405311315";//$_POST['id'];
	$directorio = "../FUPs/Masivo_Original/";
	$directorioCT = "../FUPs/Masivo_Original/CCT/";
	$directorio_total = glob($directorio."*.pdf");
	$directorio_totalCT = glob($directorioCT."*.pdf");
	//var_dump($directorio_total);
    
	$qna = "Fecha";
	$qna1 = "Qna";
	/*
	$Object = new DateTime();  
	$Object->setTimezone(new DateTimeZone('America/Mexico_City'));
	$DateAndTime = $Object->format("d-m-Y h:i:s a");  
    $contenido = $DateAndTime.'-'.$qna.'-'.$qna1."\r\n";
    $archivo = fopen('archivo1.txt','a');
    fputs($archivo,$contenido);
    fclose($archivo);	
    */
	//no existe - 2205281189
	//existe 2 veces - 2203280454
	//existe 1 vez - 2205281198
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
		echo $value;//este echo manda liga completa de fup para mostrar en Pendientes
	}//function abrir_pdf
	$matches_qna = "";
	$matches_qna1 = "";
	$matches = array_filter($directorio_total, function($var) use ($documento) { return preg_match("/$documento/i", $var); });
	$matchesCT = array_filter($directorio_totalCT, function($var) use ($documento) { return preg_match("/$documento/i", $var); });
//var_dump($matches);
//var_dump($matchesCT);

	if($matches && !$matchesCT){
		echo "normal";
		foreach ($matches as $value){//foreach
			$matches_qna = strrpos($value, $qna);
			
			$matches_qna1 = strrpos($value, $qna1);

		}//foreach	

		if($matches_qna  == true && $matches_qna1 == true){ //baja un archivo archivos
			abrir_pdf($value);
		}
		else if ($matches_qna  == true && $matches_qna1 != true){ //cuando es por fecha
			abrir_pdf($value);
		}
		else if ($matches_qna  != true && $matches_qna1 == true){//cuando es por qna
			abrir_pdf($value);
		}
	}
	if(!$matches && $matchesCT){
		echo "normalCT";
		foreach ($matchesCT as $value){//foreach
			$matches_qna = strrpos($value, $qna);
			
			$matches_qna1 = strrpos($value, $qna1);

		}//foreach	
var_dump($matches_qna);
var_dump($matches_qna1);
		if($matches_qna  == true && $matches_qna1 == true){ //baja un archivo archivos
			abrir_pdf($value);
		}
		else if ($matches_qna  == true && $matches_qna1 != true){ //cuando es por fecha
			abrir_pdf($value);
		}
		else if ($matches_qna  != true && $matches_qna1 == true){//cuando es por qna
			abrir_pdf($value);
		}
	}
}
?>