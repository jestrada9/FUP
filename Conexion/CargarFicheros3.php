<?php
	//require "../Scripts/scriptM.php";
	require_once('../lib/nusoap.php');
  $cfgFUP = require __DIR__ . '/config.php';
	ini_set("soap.wsdl_cache_enabled", "0");
	$cliente=new SOAPClient('http://localhost:8084/WebService_Consultas/WS?wsdl', array ('wsdl'));

	$params_ = array('Resultado'=>"",'Argumento'=>""); //para conseguir la consulta
	$resultadoss_=$cliente->Borrar($params_);
	$arrayR3_= json_decode(json_encode($resultadoss_), True);

	$fichero = $_FILES["file"];

	//echo $fichero["name"];

	move_uploaded_file($fichero["tmp_name"], "subidas/".$fichero["name"]);

	exec('bcp CAD_trabajo..tmpnd in '.escapeshellarg('subidas/'.$fichero['name']).' -S '.escapeshellarg($cfgFUP['bcp']['servidor']).' -U '.escapeshellarg($cfgFUP['bcp']['usuario']).' -P '.escapeshellarg($cfgFUP['bcp']['password']).' -t "|" -c');


	$params_ = array('Resultado'=>"",'Argumento'=>""); //para conseguir la consulta
	$resultadoss_=$cliente->tmpnd($params_);
	$arrayR4_= json_decode(json_encode($resultadoss_), True);
	//var_dump($arrayR4_);
	foreach($arrayR4_ as $valuess){ 
        $total_res=$valuess["tot_resu"];

	if($total_res == 0){

	}        
		//echo $total_res;
		else{
		 echo " 

		<script>
		window.alert('Se Procesarán ".$total_res." Numeros de Documentos');

		</script>
		";
		}
		}
		?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
		<link href="../../../Css/reportes_cs17.css" rel="stylesheet"/>
		<table id="example">
		<thead class="thead-dark">
		<tr> 
		<th class="dt-head-center"><strong>Número de Documento</strong></th>
		</tr>
		</thead>
		<?php        
			$params_ = array('Resultado'=>"",'Argumento'=>""); //para conseguir la consulta
			$resultadoss_=$cliente->tmpnd_not($params_);
			$arrayR5_= json_decode(json_encode($resultadoss_), True);
			//var_dump($arrayR5_);
			$num_docto2 = "";
			foreach($arrayR5_ as $valuess){ //1er foreach getDatosPDF
		        $total_res=$valuess[0]["tot_resu"];
		        //$num_docto=$valuess[1]["CURP"];

			$y = 0;
		        while ($y <= $total_res-1){
		        	$num_doctos = $valuess[$y+1]["CURP"];

					
			?>
		 <tbody>       		
		 <tr>
		 <td class="dt-body-center"><?php  echo $num_doctos."<br>"?></td>   
		 </tr> 
		 </tbody>
		 </table> 
		<?php

		        	
		        	 $y = $y + 1;//Fin 2do while getDatosPDF
		        }	
		}

		//unlink("subidas/".$fichero["name"]);
?>