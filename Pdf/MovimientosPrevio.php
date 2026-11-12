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
		if($seleccion == "Actuales")
    {
      $id_consulta =  1297;
      $JSON="[{\"num_docto\":\"$docto_numFUP\",\"rfc\":\"$rfcFUP\",\"area\":\"$areaFUP\",\"num_oficio\":\"$num_oficioFUP\"}]";
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
        if ( isset($ver["area"]) ) {
          $area =        $ver["area"];
        }
        if ( isset($ver["cve_mov"]) ) {
          $cve_mov =      $ver["cve_mov"];
        }  
        if ( isset($ver["mot_mov"]) ) {
          $mot_mov =      $ver["mot_mov"];
        }    
        if ( isset($ver["partida"]) ) {
          $partida =      $ver["partida"];
        }  
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
        if ( isset($ver["nivel_sueldonvo"]) ) {
          $nivel_sueldo = $ver["nivel_sueldonvo"];
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
        if ( isset($ver["descripcion"]) ) {
          $descripcion =      $ver["descripcion"];
        }    
        if ( isset($ver["cons_doc"]) ) {
          $cons_doc =      $ver["cons_doc"];
        } 
        if ( isset($ver["num_oficio"]) ) {
          $num_oficio = $ver["num_oficio"];
        } 
        if ( isset($ver["operador"]) ) {
          $operador =      $ver["operador"];
        }  
        ?>

          <tr id="<?php echo $id; ?>">
          <td id="add" style="text-align: center; font-size:80%; padding:0px; "><input type="image" src="../Logo/addthis2.png" class="envio" /></td>
          <td contenteditable='true' id="a" style="text-align: center; font-size:80%; padding:0px; "><?php echo $area ?></td>     
          <td contenteditable='true' id="cm" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cve_mov ?></td>     
          <td contenteditable='true' id="mm" style="text-align: center; font-size:80%; padding:0px; "><?php echo $mot_mov ?></td>     
          <td contenteditable='true' id="p" style="text-align: center; font-size:80%; padding:0px; "><?php echo $partida ?></td>    
          <td contenteditable='true' id="cp" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cod_pago ?></td>              
          <td contenteditable='true' id="uni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $unidad ?></td>
          <td contenteditable='true' id="suni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $subunidad ?></td>
          <td contenteditable='true' id="cat" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cat_puesto ?></td>
          <td contenteditable='true' id="hr" style="text-align: center; font-size:80%; padding:0px; "><?php echo $horas ?></td>
          <td contenteditable='true' id="cons" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cons_plaza ?></td>
          <td contenteditable='true' id="qini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_ini ?></td>
          <td contenteditable='true' id="qfini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_fin ?></td>
          <td contenteditable='true' id="niv" style="text-align: center; font-size:80%; padding:0px; "><?php echo $nivel_sueldo ?></td>
          <td contenteditable='true' id="ct" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $ct; ?></td>

          <td style="display:none;"><?php echo $descripcion; ?></td>
          <td style="display:none;"><?php echo $cons_doc; ?></td>
          <td style="display:none;"><?php echo $num_oficio; ?></td>
          <td style="display:none;"><?php echo $operador; ?></td>
        </tr>
        <?php
       
              $id = $id+1;
      }else{
        $total_res=count($ver);
        while ($c < $total_res){//regs. antecedentes
        if ( isset($ver[$c]["area"]) ) {
          $area =        $ver[$c]["area"];
        }
        if ( isset($ver[$c]["partida"]) ) {
          $partida =      $ver[$c]["partida"];
        }      
        if ( isset($ver[$c]["cve_mov"]) ) {
          $cve_mov =      $ver[$c]["cve_mov"];
        }  
        if ( isset($ver[$c]["mot_mov"]) ) {
          $mot_mov =      $ver[$c]["mot_mov"];
        }    
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
        if ( isset($ver[$c]["nivel_sueldonvo"]) ) {
          $nivel_sueldo = $ver[$c]["nivel_sueldonvo"];
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
        if ( isset($ver[$c]["descripcion"]) ) {
          $descripcion =      $ver[$c]["descripcion"];
        }    
        if ( isset($ver[$c]["cons_doc"]) ) {
          $cons_doc =      $ver[$c]["cons_doc"];
        } 
        if ( isset($ver[$c]["num_oficio"]) ) {
          $num_oficio = $ver[$c]["num_oficio"];
        } 
        if ( isset($ver[$c]["operador"]) ) {
          $operador =      $ver[$c]["operador"];
        }    
            ?>

              <tr id="<?php echo $id; ?>">
              <td id="add" style="text-align: center; font-size:80%; padding:0px; "><input type="image" src="../Logo/addthis2.png" class="envio" /></td>
              <td contenteditable='true' id="a" style="text-align: center; font-size:80%; padding:0px; "><?php echo $area ?></td>     
              <td contenteditable='true' id="cm" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cve_mov ?></td>     
              <td contenteditable='true' id="mm" style="text-align: center; font-size:80%; padding:0px; "><?php echo $mot_mov ?></td>     
              <td contenteditable='true' id="p" style="text-align: center; font-size:80%; padding:0px; "><?php echo $partida ?></td>    
              <td contenteditable='true' id="cp" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cod_pago ?></td>              
              <td contenteditable='true' id="uni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $unidad ?></td>
              <td contenteditable='true' id="suni" style="text-align: center; font-size:80%; padding:0px; "><?php echo $subunidad ?></td>
              <td contenteditable='true' id="cat" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cat_puesto ?></td>
              <td contenteditable='true' id="hr" style="text-align: center; font-size:80%; padding:0px; "><?php echo $horas ?></td>
              <td contenteditable='true' id="cons" style="text-align: center; font-size:80%; padding:0px; "><?php echo $cons_plaza ?></td>
              <td contenteditable='true' id="niv" style="text-align: center; font-size:80%; padding:0px; "><?php echo $nivel_sueldo ?></td>
              <td contenteditable='true' id="qini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_ini ?></td>
              <td contenteditable='true' id="qfini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $qna_fin ?></td>
              <td contenteditable='true' id="nd" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $num_docto ?></td>
              <td contenteditable='true' id="ct" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $ct; ?></td>
          
              <td style="display:none;"><?php echo $descripcion; ?></td>
              <td style="display:none;"><?php echo $cons_doc; ?></td>
              <td style="display:none;"><?php echo $num_oficio; ?></td>
              <td style="display:none;"><?php echo $operador; ?></td>
            </tr>
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
?>