<?php
	date_default_timezone_set('America/Mexico_City');
	require_once('../fpdf181/fpdf_protection.php');
	require_once('../fpdi/autoload.php');		
	require_once('../lib/nusoap.php');
	require_once('../Conexion/wsdl.php'); 	
	require_once ("../vendor/autoload.php");
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\Worksheet;
	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Style\Border;
	use PhpOffice\PhpSpreadsheet\Style\Fill;
	use PhpOffice\PhpSpreadsheet\Style\Style;

	$buscar1 = base64_decode($_POST['num_docto']);
	$usuario = $_POST['usu'];
	$total = 0;
	$pendientes = "Impresion Original y Estatus 6";
    $area = "";
    $num_oficio  = "";
	$arrays = json_decode($buscar1, true);
	$horarioVerano = date('I');
	$FECHA = date('d-m-Y');
	if ($horarioVerano) {
	  	$HORA = date('H-i-s-a', strtotime('-1 hour'));
	}else{
		$HORA = date('H-i-s-a');
	}
	$spread = new Spreadsheet();

	$nt = 1;
	$nd = 1;
	$b = 0;
	$row = 2;
	$buscar = "";
	$resultado = "";
    $pdf = new \setasign\Fpdi\Fpdi('L','mm','LEGAL');
    
    foreach ( $arrays as $valuesant ) {//inicio_foreach
	 	$tot_resul_a = $valuesant[0]['totals'];
	 	
	  	while($nt<=$tot_resul_a){
			$buscar = $valuesant[$nt+0]['num_docto'];
			$resultado .= $buscar . ", ";
			$directorio = "../FUPs/Masivo_Original/";
		    $directorio_total = glob($directorio."*.pdf");
		    $qna = "Qna";
		    $matches_qna = "";
		    $matches = array_filter($directorio_total, function($var) use ($buscar) { return preg_match("/$buscar/i", $var); });
		    //var_dump($directorio_total);
		    if($matches){
		        
		        foreach ($matches as $value){//foreach
		            $matches_qna = strrpos($value, $qna);
		        }//foreach  
		        //var_dump($matches_qna);
		        if ($matches_qna  == true ){ //cuando es por qna
		        	$pageNo = $pdf->setSourceFile($value);
		        	$templateId = $pdf->importPage($pageNo);
		            $size = $pdf->getTemplateSize($templateId);
		            $pdf->AddPage('L', array($size['width'], $size['height']));//$size['height']+4.2
		            $pdf->useTemplate($templateId);
		            $pdf->SetAutoPageBreak(false);
					$pdf->SetXY(50,196);
	                $pdf->SetFont('Arial','',8);
	                $pdf->Cell(15,4,$usuario,0,0,'L');//IMPRIMIO    
		        }
		    }
			//$nt=$nt+3;					
			$nt++;
		}//crear pdf array
		$resultado = rtrim($resultado, ", ");	
		$nombreArchivoZip = crearZIP($spread,$FECHA,$HORA,$arrays,$b,$row,$resultado,$cliente,$pdf,$nd,$usuario,$pendientes,$total,$value); 				
	}//fin_foreach	
	echo $nombreArchivoZip;

	function crearZIP($spread,$FECHA,$HORA,$arrays,$b,$row,$resultado,$cliente,$pdf,$nd,$usuario,$pendientes,$total,$value){//CREARZIP
		//OBTENER PLAZA, QNAS Y CT
		$name = "";
		if ($total=="") {
			
			$name = $pdf->Output('F','../FUPs/Masivo_ORIGINAL/Masivo_Original_Qna_'.$FECHA.'_'.$HORA.'.pdf');
			
			
			$observacion = 'Reporte Documentos_'.$FECHA.'_'.$HORA.'.zip';
			//ACTUALIZAR ESTATUS 6 REL_DOCTOS E INSERTAR EN BIT_CAPTURA
/*			
			foreach ( $arrays as $valuesAc ) {//inicio_foreach
			 	$tot_resul_Ac = $valuesAc[0]['totals'];
			  	while($nd<=$tot_resul_Ac*3){
			  		$num_docto  = $valuesAc[$nd+0]['num_docto'];
					$area 	    = $valuesAc[$nd+1]['ara'];
					$num_oficio = $valuesAc[$nd+2]['no'];

					$id_consulta_Mov_D =  1278;
		            $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$num_docto\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$pendientes\",\"datoalt\":\"$observacion\"}]";	
		            $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
		            $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
		            $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);
		            
		            $nd=$nd+3;
		        	}
		    	}
*/			
		
		else{
			$name = $pdf->Output('F','../FUPs/Masivo_ORIGINAL/Masivo_Original_Qna_'.$FECHA.'_'.$HORA.'.pdf');
		}
		return $name;
	}//CREARZIP
?>