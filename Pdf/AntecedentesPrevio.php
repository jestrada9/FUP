<?php
	require_once('../Conexion/wsdl.php'); 	
	$seleccion     = $_POST['seleccion'];
	$docto_numFUP  = $_POST['id'];
	$num_oficioFUP = $_POST['oficio'];
	$rfcFUP 	   = $_POST['rfc'];
	$areaFUP 	   = $_POST['area'];
	$por_documento = $_POST['por_documento']; // Numero de Doc agregado por usuario

    $c=0;
    $cve_mov = "";
    $cod_pago =     "";
    $unidad =       "";
    $subunidad =    "";
    $cat_puesto =   "";
    $horas =        "";
    $cons_plaza =   "";
    $mot_mov1 =     "";
    $nivel_sueldo = "";
    $qna_ini =      "";
    $qna_fin =      "";
    $num_docto =    "";
   
    $ent_fed =      "";
    $ct_clasif =    "";
    $ct_id =        "";
    $num2 =         "";
    $ct_secuencial = ""; 
    $ct_digito_ver =  "";

    $partida =  "";
    $concepto =  "";
    $importe_Ante =  "";
    $id = 0;
    
    if($seleccion != ""){
      if($seleccion == "Actuales")
        {
          $id_consulta =  1281;
          $JSON="[{\"var\":\"$docto_numFUP\",\"rfc\":\"$rfcFUP\",\"area\":\"$areaFUP\",\"num_oficio\":\"$num_oficioFUP\"}]";
        }
    	if($seleccion == "Todos")
        {
          $id_consulta = 1284;
          $JSON="[{\"var\":\"$docto_numFUP\",\"rfc\":\"$rfcFUP\",\"area\":\"$areaFUP\"}]";
        } 
        if($seleccion == "TodosSND")
        {
          $id_consulta = 1285;
          $JSON="[{\"var\":\"$docto_numFUP\",\"rfc\":\"$rfcFUP\"}]";
        }       
        if($seleccion == "Historico")
        {
           $id_consulta = 1286;
           $not = "";
           $JSON="[{\"var\":\"$docto_numFUP\",\"num_oficio\":\"$num_oficioFUP\",\"not\":\"$not\"}]";
        }  
            
        if($seleccion == "Historico_o")
        {
            $id_consulta = 1286;
          	$not = "not";
          	$JSON="[{\"var\":\"$docto_numFUP\",\"num_oficio\":\"$num_oficioFUP\",\"not\":\"$not\"}]";
        }
        
        if($seleccion == "Num_Docto")
        {
          $id_consulta = 1287;
          $JSON="[{\"var\":\"$por_documento\"}]";
        }

    //$JSON_Mov="[{\"num_docto\":\"$docto_numFUP\",\"rfc\":\"$rfcFUP\",\"area\":\"$areaFUP\",\"num_oficio\":\"$num_oficioFUP\"}]";
    $array_Mov = json_decode(json_encode($JSON), True);
    $params_Mov = array('Resultado'=>$id_consulta, 'Argumento'=>$array_Mov); //para conseguir la consulta    
    //var_dump($params_Mov);
    $resultados_Mov=$cliente->getConsulta($params_Mov);
    $arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
    
    if(!empty($arrayR_Mov)){

	$xml = simplexml_load_string($arrayR_Mov['getConsultaResult']['any'], "SimpleXMLElement", LIBXML_NOCDATA);
	$json = json_encode($xml);
	$array = json_decode($json,TRUE);	

	if(!empty($array)){
      $ver = $array['NewDataSet']['table'];
      $vers = $array['NewDataSet'];
      
      if(!isset($ver[0])){
        $total_res=count($vers);
          if ( isset($ver["cod_pago"]) ) {
              $cod_pago =     $ver["cod_pago"];
            }
            if ( isset($ver["unidad"]) ) {
              $unidad =       $ver["unidad"];
            }
            if ( isset($ver["subunidad"]) ) {
              $subunidad =    $ver["subunidad"];
            }
            if ( isset($ver["cat_puesto"]) ) {
              $cat_puesto =   $ver["cat_puesto"];
            }
            if ( isset($ver["horas"]) ) {
              $horas =        $ver["horas"];
            }
            if ( isset($ver["cons_plaza"]) ) {
              $cons_plaza =   $ver["cons_plaza"];
            }
            if ( isset($ver["mot_mov"]) ) {
              $mot_mov1 =     $ver["mot_mov"];
            }
            if ( isset($ver["nivel_sueldo"]) ) {
              $nivel_sueldo = $ver["nivel_sueldo"];
            }
            if ( isset($ver["qna_ini"]) ) {
              $qna_ini =      $ver["qna_ini"];
            }
            if ( isset($ver["qna_fin"]) ) {
              $qna_fin =      $ver["qna_fin"];
            }
            if ( isset($ver["num_docto"]) ) {
              $num_docto =    $ver["num_docto"];
            }
            if ( isset($ver["ct"]) ) {
              $ct =      $ver["ct"];
            }    
/*
            if ( isset($ver["ent_fed"]) ) {
              $ent_fed =      $ver["ent_fed"];
            }
            if ( isset($ver["ct_clasif"]) ) {
              $ct_clasif =    $ver["ct_clasif"];
            }
            if ( isset($ver["ct_id"]) ) {
              $ct_id =        $ver["ct_id"];
            }
            if ( isset($ver["ct_secuencial"]) ) {
              $num2 =         $ver["ct_secuencial"];
              $ct_secuencial = str_pad($num2, 4, "0", STR_PAD_LEFT); 
            }
            if ( isset($ver["ct_digito_ver"]) ) {
              $ct_digito_ver =  $ver["ct_digito_ver"];
            }
*/            
            if ( isset($ver["partida"]) ) {
              $partida =      $ver["partida"];
            }          
            if ( isset($ver["area"]) ) {
              $area =        $ver["area"];
            }
          
            ?>

              <tr id="<?php echo $id; ?>">
              <td id="add" style="text-align: center; font-size:80%; padding:0px; "><input type="image" src="../Logo/addthis2.png" class="envio" /></td>
              <td contenteditable='true' id="cp" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cod_pago ?></td>              
              <td contenteditable='true' id="uni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $unidad ?></td>
              <td contenteditable='true' id="suni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $subunidad ?></td>
              <td contenteditable='true' id="cat" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cat_puesto ?></td>
              <td contenteditable='true' id="hr" style="text-align: center; font-size:80%; padding:0px; "><?php echo $horas ?></td>
              <td contenteditable='true' id="cons" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cons_plaza ?></td>
              <td contenteditable='true' id="mot" style="text-align: center; font-size:80%; padding:0px; "><?php echo $mot_mov1 ?></td>
              <td contenteditable='true' id="niv" style="text-align: center; font-size:80%; padding:0px; "><?php echo $nivel_sueldo ?></td>
              <td contenteditable='true' id="qini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_ini ?></td>
              <td contenteditable='true' id="qfini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_fin ?></td>
              <td contenteditable='true' id="nd" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $num_docto ?></td>
              <td contenteditable='true' id="ct" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $ct; ?></td>
              <td id="valor" style="display:none;"><?php echo $id; ?></td>
              <td style="display:none;"><?php echo $cve_mov; ?></td>
              <td style="display:none;"><?php echo $partida; ?></td>
              <td style="display:none;"><?php echo $area; ?></td></tr>
          
            <?php
       
              $id = $id+1;
      }else{
        $total_res=count($ver);
        while ($c < $total_res){//regs. antecedentes

            if ( isset($ver[$c]["cod_pago"]) ) {
              $cod_pago =     $ver[$c]["cod_pago"];
            }
            if ( isset($ver[$c]["unidad"]) ) {
              $unidad =       $ver[$c]["unidad"];
            }
            if ( isset($ver[$c]["subunidad"]) ) {
              $subunidad =    $ver[$c]["subunidad"];
            }
            if ( isset($ver[$c]["cat_puesto"]) ) {
              $cat_puesto =   $ver[$c]["cat_puesto"];
            }
            if ( isset($ver[$c]["horas"]) ) {
              $horas =        $ver[$c]["horas"];
            }
            if ( isset($ver[$c]["cons_plaza"]) ) {
              $cons_plaza =   $ver[$c]["cons_plaza"];
            }
            if ( isset($ver[$c]["mot_mov"]) ) {
              $mot_mov1 =     $ver[$c]["mot_mov"];
            }
            if ( isset($ver[$c]["nivel_sueldo"]) ) {
              $nivel_sueldo = $ver[$c]["nivel_sueldo"];
            }
            if ( isset($ver[$c]["qna_ini"]) ) {
              $qna_ini =      $ver[$c]["qna_ini"];
            }
            if ( isset($ver[$c]["qna_fin"]) ) {
              $qna_fin =      $ver[$c]["qna_fin"];
            }
            if ( isset($ver[$c]["num_docto"]) ) {
              $num_docto =    $ver[$c]["num_docto"];
            }
            if ( isset($ver[$c]["ct"]) ) {
              $ct =      $ver[$c]["ct"];
            }
            /*
            if ( isset($ver[$c]["ent_fed"]) ) {
              $ent_fed =      $ver[$c]["ent_fed"];
            }
            if ( isset($ver[$c]["ct_clasif"]) ) {
              $ct_clasif =    $ver[$c]["ct_clasif"];
            }
            if ( isset($ver[$c]["ct_id"]) ) {
              $ct_id =        $ver[$c]["ct_id"];
            }
            if ( isset($ver[$c]["ct_secuencial"]) ) {
              $num2 =         $ver[$c]["ct_secuencial"];
              $ct_secuencial = str_pad($num2, 4, "0", STR_PAD_LEFT); 
            }
            if ( isset($ver[$c]["ct_digito_ver"]) ) {
              $ct_digito_ver =  $ver[$c]["ct_digito_ver"];
            }
            */
            if ( isset($ver[$c]["partida"]) ) {
              $partida =      $ver[$c]["partida"];
            }          
            if ( isset($ver[$c]["area"]) ) {
              $area =        $ver[$c]["area"];
            }
           
            ?>

              <tr id="<?php echo $id; ?>">
              <td id="add" style="text-align: center; font-size:80%; padding:0px; "><input type="image" src="../Logo/addthis2.png" class="envio" /></td>
              <td contenteditable='true' id="cp" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cod_pago ?></td>              
              <td contenteditable='true' id="uni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $unidad ?></td>
              <td contenteditable='true' id="suni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $subunidad ?></td>
              <td contenteditable='true' id="cat" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cat_puesto ?></td>
              <td contenteditable='true' id="hr" style="text-align: center; font-size:80%; padding:0px; "><?php echo $horas ?></td>
              <td contenteditable='true' id="cons" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cons_plaza ?></td>
              <td contenteditable='true' id="mot" style="text-align: center; font-size:80%; padding:0px; "><?php echo $mot_mov1 ?></td>
              <td contenteditable='true' id="niv" style="text-align: center; font-size:80%; padding:0px; "><?php echo $nivel_sueldo ?></td>
              <td contenteditable='true' id="qini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_ini ?></td>
              <td contenteditable='true' id="qfini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_fin ?></td>
              <td contenteditable='true' id="nd" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $num_docto ?></td>
              <td contenteditable='true' id="ct" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $ct; ?></td>
              <td id="valor" style="display:none;"><?php echo $id; ?></td>
              <td style="display:none;"><?php echo $cve_mov; ?></td>
              <td style="display:none;"><?php echo $partida; ?></td>
              <td style="display:none;"><?php echo $area; ?></td></tr>
          
            <?php
           
              //$data[] = [$num_docto,$cod_pago,$unidad,$subunidad,$cat_puesto,$horas,$cons_plaza,$mot_mov1,$nivel_sueldo,$qna_ini,$qna_fin,$num_docto,$ct,$partida,$area];
              $id = $id+1;
              $c++;
          } //regs. antecedentes
      }  
  }
      	//$results = array("data"=>$data);
		//echo json_encode($results);
}else{
	//$data[] = ["","","","","","","","","","","","","","",""];
	//$results = array("data"=>"");
	//echo json_encode($results);
}
    }
		
?>