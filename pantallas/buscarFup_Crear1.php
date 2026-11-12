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

	//$buscar1 = base64_decode("eyJuZXdhcnJheXMiOlt7InRvdGFscyI6Mn0seyJudW1fZG9jdG8iOiIyMjIxMjkzODA4In0seyJhcmEiOiIzMTUzIn0seyJubyI6IjIwMjIyOTM4MDgifSx7Im51bV9kb2N0byI6IjIyMDUyODEzOTYifSx7ImFyYSI6IjMxNTMifSx7Im5vIjoiMjAyMjI4MTM5NiJ9XX0=");
	$buscar1 = base64_decode($_POST['num_docto']);
	$usuario = $_POST['usu'];
	$dir = $_POST['dir'];
	$pendientes = "";
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
	$x=0;
	$xa=0;
	$buscar = "";
	$resultado = "";
	$id_consultaP1 =  204;
    $pdf = new \setasign\Fpdi\Fpdi('L','mm','LEGAL');
    
    foreach ( $arrays as $valuesant ) {//inicio_foreach
	 	$tot_resul_a = $valuesant[0]['totals'];
	 	
	  	while($nt<=$tot_resul_a*3){
			$buscar = $valuesant[$nt+0]['num_docto'];

			//echo $nt." - ".$buscar."<br>";
			$JSONP1="[{\"var\":\"$buscar\"}]";
			$arrayRP1 = json_decode(json_encode($JSONP1), True);
			$paramsP1 = array('Resultado'=>$id_consultaP1, 'Argumento'=>$arrayRP1); //para conseguir la consulta
			//var_dump($paramsP1);
			$resultadosP1=$cliente->getConsulta($paramsP1);   
			$arrayRsP1= json_decode(json_encode($resultadosP1), True);
			//var_dump($arrayRsP1);
			$xml = simplexml_load_string($arrayRsP1['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);	  

			if(!empty($array)){
		  		$valuesCons = $array['NewDataSet']['table'];
				$valuesCon = $array['NewDataSet'];
		  	
		  		if(!isset($valuesCons[0])){

					if ( isset($valuesCons["fec_imp"]) ) {
			    		$fec_impS 		 = $valuesCons["fec_imp"];
			    	}
			  		if ( isset($valuesCons["placve_mov"]) ) {
			    		$cve_mov 		 = $valuesCons["placve_mov"];
			    	}
			    	if ( isset($valuesCons['plamot_mov']) ) {
			    		$mot_mov 		 = $valuesCons['plamot_mov'];
			    	}
					   	
			    	if ( isset($valuesCons['idAutorizar']) ) {
			    		$idAutorizar = $valuesCons['idAutorizar'];
			    	}
		  		}else{
		  			$total_xa=count($valuesCon);
		  			while ($xa < $total_xa){
			  			if ( isset($valuesCons[$xa]["fec_imp"]) ) {
			    			$fec_impS 		 = $valuesCons[$xa]["fec_imp"];
				    	}
				  		if ( isset($valuesCons[$xa]["placve_mov"]) ) {
				    		$cve_mov 		 = $valuesCons[$xa]["placve_mov"];
				    	}
				    	if ( isset($valuesCons[$xa]['plamot_mov']) ) {
				    		$mot_mov 		 = $valuesCons[$xa]['plamot_mov'];
				    	}
							    	
				    	if ( isset($valuesCons[$xa]['idAutorizar']) ) {
				    		$idAutorizar = $valuesCons[$xa]['idAutorizar'];
				    	}
				    	$xa++;
				    }
		  		}
	  		}

	  		//echo $fec_impS."<br>";
	  		$newDate = date("d-m-Y", strtotime($fec_impS));
			$resultado .= $buscar . ", ";
			if($dir=="CT"){
				$directorio = "../FUPs/Masivo_Original/CCT/";
				$pendientes = "Impre Ori y Est 6";
			}else{
				$directorio = "../FUPs/Masivo_Original/";
				$pendientes = "Impresion Original";
			}

		    $directorio_total = glob($directorio."*.pdf");
		    $qna = "Qna";
		    $fecha = "Fecha";
		    $matches_qna = "";
		    $matches_fecha = "";
		    $matches = array_filter($directorio_total, function($var) use ($buscar) { return preg_match("/$buscar/i", $var); });
		    //var_dump($directorio_total);
		    if($matches){
		        
		        foreach ($matches as $value){//foreach
		            $matches_qna = strrpos($value, $qna);
		            $matches_fecha = strrpos($value, $fecha);
		        }//foreach  

		        if ($matches_qna  == true || $matches_fecha  == true ){ //cuando es por qna
		        	$pageNo = $pdf->setSourceFile($value);
		        	$templateId = $pdf->importPage($pageNo);
		            $size = $pdf->getTemplateSize($templateId);
		            $pdf->AddPage('L', array($size['width'], $size['height']));//$size['height']+4.2
		            $pdf->useTemplate($templateId);
		            $pdf->SetAutoPageBreak(false);

					firmas_funcion($fec_impS,$pdf,$cliente);

					$pdf->Line(5, 181.2, 122-5, 181.2); // PARTE DE ARRIBA
        			$pdf->Line(160, 181.2, 352-5, 181.2); // PARTE DE ARRIBA 2

					$pdf->SetXY(50,196);
	                $pdf->SetFont('Arial','',8);
	                $pdf->Cell(15,4,$usuario,0,0,'L');//IMPRIMIO    

	                $pdf->SetXY(120,177);
				    $pdf->SetFont('Arial','B',9);
				    $pdf->Cell(42,4,"AUTORIZACIONES",0,0,'L');

				    $pdf->SetXY(125,181);
				    $pdf->SetFont('Arial','B',8);
				    $pdf->Cell(42,3,"OTORGA VIGENCIA",0,0,'L');

				    $pdf->SetXY(90,186);
				    $pdf->SetFont('Arial','',8);
				    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

				    $pdf->Line(105, 189.2, 175-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

				    $pdf->SetXY(90,191);
				    $pdf->SetFont('Arial','',8);
				    $pdf->Cell(14,4,"FIRMA",0,0,'L');

				    $pdf->Line(105, 193.2, 175-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

				    $pdf->SetXY(90,196);
				    $pdf->SetFont('Arial','',8);
				    $pdf->Cell(14,3,"FECHA",0,0,'L');

				    $pdf->Line(105, 198.5, 175-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

				    $pdf->Line(175.2, 181.2, 175.2, 204.3);//linea vertical derecha

				    $pdf->SetXY(210,181);
				    $pdf->SetFont('Arial','B',8);
				    $pdf->Cell(42,4,"AUTORIZA",0,0,'L');

				    $pdf->SetXY(175,186);
				    $pdf->SetFont('Arial','',8);
				    $pdf->Cell(15,4,"NOMBRE",0,0,'L');

				    $pdf->Line(260, 189.2, 195-5, 189.2); // PARTE DE ABAJO DE RESPUESTA

				    $pdf->SetXY(175,191);
				    $pdf->SetFont('Arial','',8);
				    $pdf->Cell(14,4,"FIRMA",0,0,'L');

				    $pdf->Line(260, 193.2, 195-5, 193.2); // PARTE DE ABAJO DE RESPUESTA

				    $pdf->SetXY(175,196);
				    $pdf->SetFont('Arial','',8);
				    $pdf->Cell(14,3,"FECHA",0,0,'L');

				    $pdf->Line(260, 198.5, 195-5, 198.5); // PARTE DE ABAJO DE RESPUESTA

				    $pdf->Line(265.4, 181.2, 265.4, 204.3);//linea vertical derecha

				    //$FECHA = "13-12-2023";
				    //<----------------------------------------------------AUTORIZACIONES-------------------------------------------------------->
						$pdf->SetXY(105,196);
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(65,3, utf8_decode($newDate),0,0,'L');
					//<--------------------------------------------------------AUTORIZA---------------------------------------------------------->
						$pdf->SetXY(190,196);
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(65,3, utf8_decode($newDate),0,0,'L');

					$pdf->Line(190.1, 162.3, 190.1, 181.2);//linea vertical derecha
					$TEXTO="SE HACE CONSTAR QUE EL TRABAJADOR PROTESTA DESEMPEÑAR LEAL Y PATRIOTICAMENTE EL PUESTO QUE SE LE HA CONFERIDO Y GUARDAR Y HACER GUARDAR LA CONSTITUCION POLITICA DE LOS ESTADOS UNIDOS MEXICANOS Y LAS LEYES QUE DE ELLA EMANEN";
					$pdf->SetXY(190,162.3);
					 $pdf->SetFont('Arial','',7);
					$pdf->MultiCell(80,3.5,utf8_decode($TEXTO),0,'J',false);		
					$pdf->Line(5, 204.4, 352.1-5, 204.4); // PARTE DE ABAJO MARGEN
					$pdf->SetXY(6,205);
				    $pdf->SetFont('Arial','B',8);
				    $pdf->Cell(140,3,utf8_decode("He revisado el presente documento y cumple con los requisitos legales' Art. 56 de la Ley de Responsabilidades de los Servidores Públicos del Edo."),0,0,'L');     
		        }
		    }
			//$nt++;					
			$nt=$nt+3;
		}//crear pdf array
		$resultado = rtrim($resultado, ", ");	
		$nombreArchivoZip = crearZIP($spread,$fec_impS,$FECHA,$HORA,$arrays,$b,$row,$resultado,$cliente,$pdf,$nd,$usuario,$pendientes,$dir); 				
	}//fin_foreach	
	echo $nombreArchivoZip;

	function CrearHoja($spread,$Hoja,$num_hoja){
		$hojaActual = $spread->getSheetCount();
		$sheet = $spread->setActiveSheetIndex($num_hoja);
		$sheet->setTitle($Hoja);

		$sheet->getStyle('A1:J1')->getFont()->setBold(true)->setSize(12);
		$sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		$sheet->getColumnDimension('J')->setAutoSize(true);

		$sheet->setCellValueByColumnAndRow(1, 1, "RFC");
		$sheet->setCellValueByColumnAndRow(2, 1, "Codigo Pago");
		$sheet->setCellValueByColumnAndRow(3, 1, "Unidad");
		$sheet->setCellValueByColumnAndRow(4, 1, "Subunidad");
		$sheet->setCellValueByColumnAndRow(5, 1, "Categoria Puesto");
		$sheet->setCellValueByColumnAndRow(6, 1, "Horas");
		$sheet->setCellValueByColumnAndRow(7, 1, "Cons Plaza");
		$sheet->setCellValueByColumnAndRow(8, 1, "Quincena Inicial");
		$sheet->setCellValueByColumnAndRow(9, 1, "Quincena Final");
		$sheet->setCellValueByColumnAndRow(10, 1, "CT");
		
		return $sheet;
	}

	function crearZIP($spread,$fec_impS,$FECHA,$HORA,$arrays,$b,$row,$resultado,$cliente,$pdf,$nd,$usuario,$pendientes,$dir){//CREARZIP
		//OBTENER PLAZA, QNAS Y CT
		$name = "";
		if ($dir=="CT") {
			$spread->getProperties()->setCreator('Sistemas')
			    	->setTitle('Reporte de Documentos afectados_'.$FECHA.'_'.$HORA)
			    	->setDescription('');
		    $sheet = $spread->createSheet();
		    $sheet = $spread->createSheet();
		    //var_dump($resultado);
			//$id_consulta_pqc =  1291;
			$id_consulta_pqc =  1280;
	        $JSON_pqc="[{\"num_docto\":\"$resultado\"}]";
	        $array_pqc = json_decode(json_encode($JSON_pqc), True);
	        $params_pqc = array('Resultado'=>$id_consulta_pqc, 'Argumento'=>$array_pqc); //para conseguir la consulta
	        $resultados_pqc=$cliente->getConsulta($params_pqc);
	        $arrayR_pqc= json_decode(json_encode($resultados_pqc), True);
			$xml_pqc = simplexml_load_string($arrayR_pqc['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
			$json_pqc = json_encode($xml_pqc);
			$arraypqc = json_decode($json_pqc,TRUE);	

			if(!empty($arraypqc)){//if !empty($arraypqc)
				
				$value = $arraypqc['NewDataSet']['table'];
				$values = $arraypqc['NewDataSet'];

				if(!isset($value[0])){		 			
					$rfc   		= $value['rfc'];
			    	$cod_pago   = $value['cod_pago'];
		    		$unidad     = $value['unidad'];
		    		$subunidad  = $value['subunidad'];
		    		$cat_puesto = $value['cat_puesto'];
		    		$horas      = $value['horas'];
		    		$cons_plaza = $value['cons_plaza'];
		    		$qna_ini    = $value['qna_ini'];
		    		$qna_fin    = $value['qna_fin'];
		    		$ct         = $value['ct'];
		    		$Hoja       = $value['Hoja'];
		    		$Num_Hoja   = $value['Num_Hoja'];
		    		
		    		$sheet = CrearHoja($spread,$Hoja,$Num_Hoja);	

		    		$sheet->setCellValueByColumnAndRow(1, $row, $rfc);
					$sheet->getStyle('A',$row)->getAlignment()->setHorizontal('center');
	    			$sheet->setCellValueByColumnAndRow(2, $row, $cod_pago);
					$sheet->getStyle('B',$row)->getAlignment()->setHorizontal('center');
					$sheet->setCellValueByColumnAndRow(3, $row, $unidad);
					$sheet->getStyle('C',$row)->getAlignment()->setHorizontal('center');
					$sheet->setCellValueByColumnAndRow(4, $row, $subunidad);
					$sheet->getStyle('D',$row)->getAlignment()->setHorizontal('center');
					$sheet->setCellValueByColumnAndRow(5, $row, $cat_puesto);
					$sheet->getStyle('E',$row)->getAlignment()->setHorizontal('center');
					$sheet->setCellValueByColumnAndRow(6, $row, $horas);
					$sheet->getStyle('F',$row)->getAlignment()->setHorizontal('center');
					$sheet->setCellValueByColumnAndRow(7, $row, $cons_plaza);
					$sheet->getStyle('G',$row)->getAlignment()->setHorizontal('center');
					$sheet->setCellValueByColumnAndRow(8, $row, $qna_ini);
					$sheet->getStyle('H',$row)->getAlignment()->setHorizontal('center');
					$sheet->setCellValueByColumnAndRow(9, $row, $qna_fin);
					$sheet->getStyle('I',$row)->getAlignment()->setHorizontal('center');
					$sheet->setCellValueByColumnAndRow(10, $row, $ct);
					$sheet->getStyle('J',$row)->getAlignment()->setHorizontal('center');
	    		
				}else{
					$row1=0;
					$row2=2;
					$row3=0;
					$tot_resul_mov= count($value);			 			
			      	while ($b < $tot_resul_mov){//while
			      		$rfc   		= $value[$b]['rfc'];
				    	$cod_pago   = $value[$b]['cod_pago'];
			    		$unidad     = $value[$b]['unidad'];
			    		$subunidad  = $value[$b]['subunidad'];
			    		$cat_puesto = $value[$b]['cat_puesto'];
			    		$horas      = $value[$b]['horas'];
			    		$cons_plaza = $value[$b]['cons_plaza'];
			    		$qna_ini    = $value[$b]['qna_ini'];
			    		$qna_fin    = $value[$b]['qna_fin'];
			    		$ct         = $value[$b]['ct'];
		    			$Hoja       = $value[$b]['Hoja'];
		    			$Num_Hoja   = $value[$b]['Num_Hoja'];
		    			
		    			$sheet = CrearHoja($spread,$Hoja,$Num_Hoja);

				      	$b++;
			      	
				      	if($Num_Hoja=="1"){
		    				$sheet->setCellValueByColumnAndRow(1, $row, $rfc);
							$sheet->getStyle('A',$row)->getAlignment()->setHorizontal('center');
			    			$sheet->setCellValueByColumnAndRow(2, $row, $cod_pago);
							$sheet->getStyle('B',$row)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(3, $row, $unidad);
							$sheet->getStyle('C',$row)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(4, $row, $subunidad);
							$sheet->getStyle('D',$row)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(5, $row, $cat_puesto);
							$sheet->getStyle('E',$row)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(6, $row, $horas);
							$sheet->getStyle('F',$row)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(7, $row, $cons_plaza);
							$sheet->getStyle('G',$row)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(8, $row, $qna_ini);
							$sheet->getStyle('H',$row)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(9, $row, $qna_fin);
							$sheet->getStyle('I',$row)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(10, $row, $ct);
							$sheet->getStyle('J',$row)->getAlignment()->setHorizontal('center');
		    			}
	    			
		    			if($Num_Hoja=="2"){
		    				$row1= $row;
		    				$row3 =  ($row-$row)+$row2;

							$sheet->setCellValueByColumnAndRow(1, $row2, $rfc);
							$sheet->getStyle('A',$row2)->getAlignment()->setHorizontal('center');
			    			$sheet->setCellValueByColumnAndRow(2, $row2, $cod_pago);
							$sheet->getStyle('B',$row2)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(3, $row2, $unidad);
							$sheet->getStyle('C',$row2)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(4, $row2, $subunidad);
							$sheet->getStyle('D',$row2)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(5, $row2, $cat_puesto);
							$sheet->getStyle('E',$row2)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(6, $row2, $horas);
							$sheet->getStyle('F',$row2)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(7, $row2, $cons_plaza);
							$sheet->getStyle('G',$row2)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(8, $row2, $qna_ini);
							$sheet->getStyle('H',$row2)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(9, $row2, $qna_fin);
							$sheet->getStyle('I',$row2)->getAlignment()->setHorizontal('center');
							$sheet->setCellValueByColumnAndRow(10, $row2, $ct);
							$sheet->getStyle('J',$row2)->getAlignment()->setHorizontal('center');

							$row2++;
							$row3++;
		    			}
				      	$row++;
				    }//while							
				}//else
			}//if !empty($arraypqc)
				$writer = new Xlsx($spread);
				$writer->save('../FUPs/Masivo_ORIGINAL/manual/Reporte Documentos_'.$FECHA.'_'.$HORA.'.xlsx');

				//$pdf->Output('F','../FUPs/Masivo_ORIGINAL/manual/Masivo_Original_CT_Qna_'.$FECHA.'_'.$HORA.'.pdf');

				$zip = new ZipArchive();
				$nombreArchivoZip = '../FUPs/Masivo_ORIGINAL/manual/Reporte Documentos_'.$FECHA.'_'.$HORA.'.zip';
				$name = 'Reporte Documentos_'.$FECHA.'_'.$HORA.'.zip';

			if ($zip->open($nombreArchivoZip, ZipArchive::CREATE) === TRUE) {
			    // Rutas de los archivos que deseas agregar al ZIP
			    $archivo1 = '../FUPs/Masivo_ORIGINAL/manual/Reporte Documentos_'.$FECHA.'_'.$HORA.'.xlsx';
			    $archivo2 = '../FUPs/Masivo_ORIGINAL/manual/Masivo_Original_CT_Qna_'.$FECHA.'_'.$HORA.'.pdf';
			    // Agrega archivos al ZIP
			    $zip->addFile($archivo1, 'Reporte Documentos_'.$FECHA.'_'.$HORA.'.xlsx');
			    $zip->addFile($archivo2, 'Masivo_Original_CT_Qna_'.$FECHA.'_'.$HORA.'.pdf');
			    // Cierra el archivo ZIP
			    $zip->close();
			}
			
			$observacion = 'Reporte Documentos_'.$FECHA.'_'.$HORA.'.zip';
			//ACTUALIZAR ESTATUS 6 REL_DOCTOS E INSERTAR EN BIT_CAPTURA
			
			foreach ( $arrays as $valuesAc ) {//inicio_foreach
			 	$tot_resul_Ac = $valuesAc[0]['totals'];
			  	while($nd<=$tot_resul_Ac*3){//inicio_while
			  		$num_docto  = $valuesAc[$nd+0]['num_docto'];
					$area 	    = $valuesAc[$nd+1]['ara'];
					$num_oficio = $valuesAc[$nd+2]['no'];

					$id_consulta_Mov_D =  1278;
		            $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$num_docto\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$pendientes\",\"datoalt\":\"$pendientes\"}]";	
		            $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
		            $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
		            $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);
		            
		            $nd=$nd+3;
		        	}//inicio_while
		    	}//inicio_foreach
		}//id dir
		else{
			foreach ( $arrays as $valuesAc ) {//inicio_foreach
			 	$tot_resul_Ac = $valuesAc[0]['totals'];
			  	while($nd<=$tot_resul_Ac*3){//inicio_while
			  		$num_docto  = $valuesAc[$nd+0]['num_docto'];
					$area 	    = $valuesAc[$nd+1]['ara'];
					$num_oficio = $valuesAc[$nd+2]['no'];

					$id_consulta_Mov_D =  210;
		            $JSON_Mov_D="[{\"area\":\"$area\",\"num_docto\":\"$num_docto\",\"num_oficio\":\"$num_oficio\",\"usuario\":\"$usuario\",\"operacion\":\"$pendientes\",\"datoalt\":\"$pendientes\"}]";	
		            $array_Mov_D = json_decode(json_encode($JSON_Mov_D), True);
		            $params_Mov_D = array('Resultado'=>$id_consulta_Mov_D, 'Argumento'=>$array_Mov_D); //para conseguir la consulta
		            $resultados_Mov_D=$cliente->getConsulta($params_Mov_D);
		            
		            $nd=$nd+3;
		       	}//inicio_while
		    }//inicio_foreach

			//$pdf->Output('F','../FUPs/Masivo_ORIGINAL/manual/Masivo_Original_Qna_'.$FECHA.'_'.$HORA.'.pdf');
			$name='Masivo_Original_Qna_'.$FECHA.'_'.$HORA.'.pdf';
		}
		return $name;
	}//CREARZIP

	function firmas_funcion($FECHAD,$pdf,$cliente){

		$num_firma=0;
		$num_funcion_firma=2;
		$num_nombre_firma=0;
		$num_tipo_archivo=3;
		$num_firmas=1;

		$id_consulta_firmas = 9;

		$metodo_consulta="ConsultaFirmas_Original1";
		include '../Conexion/Metodos_Consultas/metodos_consultas.php';			
        
	    $xml2 = simplexml_load_string($arrayR_firmas['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
        $json2 = json_encode($xml2);
        $array2 = json_decode($json2,TRUE);

        $ver2 = $array2['NewDataSet']['table'];		        
        $tot_regis_firmas= count($ver2); 
          
    	while($num_firma<$tot_regis_firmas){//while
	                        
            $func                  = $ver2[$num_firma]["funcion"];
            $NOMBRE_AUTORIZACIONES = $ver2[$num_firma]["nombre"];
            $TEMPIMGLOC            = $ver2[$num_firma]["tipo_archivo"];
            $imagen1               = $ver2[$num_firma]["aut"];
            $TEMPIMGLOC1 = str_replace(".", "", $TEMPIMGLOC);

            $alto=175;//$alto=166;
            $pic1 = "data: image/".$TEMPIMGLOC1.";base64,".$imagen1."";
            $dataPieces = explode(',',$pic1);
            $encodedImg = $dataPieces[1];
            $decodedImg = base64_decode($encodedImg);

            if($func == "false"){  
                if( $decodedImg!==false )
                {
                	
                  if( file_put_contents("tempimg".$TEMPIMGLOC,$decodedImg)!==false )
                  {  
                       $pdf->SetXY(90,$alto);
                       $pdf->Image("tempimg".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
                       unlink("tempimg".$TEMPIMGLOC);
                  }                
                }        	                    
                $pdf->SetFont('Arial','',8);               
                $pdf->SetXY(105,186);
                $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');	                    
            }
	                	                
            if($func == "true"){ 
                if( $decodedImg!==false )
                {
                    if( file_put_contents("tempimg1".$TEMPIMGLOC,$decodedImg)!==false )
                    { 	                         
                      $pdf->SetXY(175,$alto);
                      $pdf->Image("tempimg1".$TEMPIMGLOC, $pdf->GetX()+10, $pdf->GetY()+3, 45);
                      unlink("tempimg1".$TEMPIMGLOC);
                    
                    }
                $pdf->SetXY(190,186);
                $pdf->SetFont('Arial','',8);
                $pdf->Cell(65,4, utf8_decode($NOMBRE_AUTORIZACIONES),0,0,'L');
                }                 
            }
	                
            $num_funcion_firma=$num_funcion_firma+4;
            //if($num_funcion_firma > 6){break;}
            $num_nombre_firma=$num_nombre_firma+4;
            $num_tipo_archivo=$num_tipo_archivo+4;
            $num_firmas=$num_firmas+4;

            $num_firma++;
            if($num_funcion_firma > 8){
                break;
            }
        }//while
	}//Fin Funcion Firmas
?>