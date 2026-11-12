<script type="text/javascript">
  function marcar(obj,chk) {
    
        if($('input:checkbox[id='+chk+']:checked').is(':checked')){
          console.log("Seleccionado");
          var newarrays= new Array();
          $(document).ready(function() {
            $("#btnGetData").click(function() {

              var tablas = document.getElementById('movs').getElementsByTagName('tbody')[0];
              var totals=tablas.rows.length;
              var total2  = new constructors();
                    total2.totals  = totals;
                  newarrays.push(total2);

               function BlockID1(newarrays) {
                return {                                                                                                         
                  newarrays
                };
              }                   
              for(j=0;j<total;j++){//for
                var one = tabla.rows[j].cells[0].childNodes[0].data;
                if(chk==one){
                  //var datas1   = tabla.rows[j].cells[1].childNodes[0].data;
                  var datas2   = tabla.rows[j].cells[2].childNodes[0].data;
                  var datas3   = tabla.rows[j].cells[3].childNodes[0].data;
                  var datas4   = tabla.rows[j].cells[4].childNodes[0].data;
                  var datas5   = tabla.rows[j].cells[5].childNodes[0].data;
                  var datas6   = tabla.rows[j].cells[6].childNodes[0].data;
                  var datas7   = tabla.rows[j].cells[7].childNodes[0].data;
                  var datas8   = tabla.rows[j].cells[8].childNodes[0].data;
                  var datas9   = tabla.rows[j].cells[9].childNodes[0].data;
                  var datas10  = tabla.rows[j].cells[10].childNodes[0].data;
                  var datas11  = tabla.rows[j].cells[11].childNodes[0].data;
                  var datas12  = tabla.rows[j].cells[12].childNodes[0].data;
                  var datas13  = tabla.rows[j].cells[13].childNodes[0].data;
                  var datas14  = tabla.rows[j].cells[14].childNodes[0].data;
                  var datas15  = tabla.rows[j].cells[15].childNodes[0].data;
                  var datas16  = tabla.rows[j].cells[16].childNodes[0].data;
                  var datas17  = tabla.rows[j].cells[17].childNodes[0].data;
                  var datas18  = tabla.rows[j].cells[18].childNodes[0].data;
                  var datas19  = tabla.rows[j].cells[19].childNodes[0].data;
                  var datas20  = tabla.rows[j].cells[20].childNodes[0].data;
                  var datas21  = tabla.rows[j].cells[21].childNodes[0].data;
                  
                  var tm1  = new constructors();
                  tm1.tm  = datas2;
                  var mo1  = new constructors();
                  mo1.mo  = datas3;
                  var pda1  = new constructors();
                  pda1.pda  = datas4;
                  var cod_pago1  = new constructors();
                  cod_pago1.cod_pago  = datas5;
                  var unidad1  = new constructors();
                  unidad1.unidad  = datas6;
                  var subunidad1  = new constructors();
                  subunidad1.subunidad  = datas7;
                  var puesto1  = new constructors();
                  puesto1.puesto  = datas8;
                  var horas1  = new constructors();
                  horas1.horas  = datas9;
                  var plaza1  = new constructors();
                  plaza1.plaza  = datas10;
                  var qna_ini1  = new constructors();
                  qna_ini1.qna_ini  = datas11;
                  var qna_fin1  = new constructors();
                  qna_fin1.qna_fin  = datas12;
                  var nombre_sus1  = new constructors();
                  nombre_sus1.nombre_sus  = datas13;
                  var rfc_sus1  = new constructors();
                  rfc_sus1.rfc_sus  = datas14;
                  var mot_mov1  = new constructors();
                  mot_mov1.mot_mov  = datas15;
                  var qna_ini_sus1  = new constructors();
                  qna_ini_sus1.qna_ini_sus  = datas16;
                  var qna_fin_sus1  = new constructors();
                  qna_fin_sus1.qna_fin_sus  = datas17;
                  var num_doc1  = new constructors();
                  num_doc1.num_doc  = datas18;
                  var ct1  = new constructors();
                  ct1.ct  = datas19;
                  var nivel_sdo1  = new constructors();
                  nivel_sdo1.nivel_sdo  = datas20;
                  var descripcion1  = new constructors();
                  descripcion1.descripcion  = datas21;

                  newarrays.push(tm1);
                  newarrays.push(mo1);
                  newarrays.push(pda1);
                  newarrays.push(cod_pago1);
                  newarrays.push(unidad1);
                  newarrays.push(subunidad1);
                  newarrays.push(puesto1);
                  newarrays.push(horas1);
                  newarrays.push(plaza1);
                  newarrays.push(qna_ini1);
                  newarrays.push(qna_fin1);
                  newarrays.push(nombre_sus1);
                  newarrays.push(rfc_sus1);
                  newarrays.push(mot_mov1);
                  newarrays.push(qna_ini_sus1);
                  newarrays.push(qna_fin_sus1);
                  newarrays.push(num_doc1);
                  newarrays.push(ct1);
                  newarrays.push(nivel_sdo1);
                  newarrays.push(descripcion1);
                }
              }//for
              if(total!=0){
                      json2 = JSON.stringify(BlockID1(newarrays));
                      console.log(json2);
                  }
          });
            });
        }else{
          console.log("borrado");
          $('input:checkbox[id='+chk+']:checked').val("");
          $('#movs').val("");
          newarray = [];
          newarray.length=0;
          var newarray= new Array();
        }
      
  }

</script>	
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#exampleModalM">Abrir Modal</button>

      <div class="modal" id="exampleModalM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
<?php 
		require '../../Conexion/wsdl.php'; 
		$buscar = 2211285214;
		$id_consulta_Mov = 	191;
		$JSON_Mov="[{\"Valor\":\"$buscar\"}]";
	    $array_Mov = json_decode(json_encode($JSON_Mov), True);
	    $params_Mov = array('Resultado'=>$id_consulta_Mov, 'Argumento'=>$array_Mov); //para conseguir la consulta
	    //var_dump($params_Mov);
	    $resultados_Mov=$cliente->getConsulta($params_Mov);
		$arrayR_Mov= json_decode(json_encode($resultados_Mov), True);
		//var_dump($arrayR_Mov);
		if(!empty($arrayR_Mov)){

        $cve_movM 		  = "";
        $mot_movM 		  = "";
        $partidaM 		  = "";
        $cod_pagoM 		  =	"";
        $unidadM 		  = "";
        $subunidadM 	  = "";
        $cat_puestoM 	  = "";
        $horasM 		  = "";
        $cons_plazaM 	  = "";
        $qna_ini_empM 	  = "";
        $qna_fin_empM 	  = "";
        $qna_inisusM 	  = "";
        $qna_finsusM 	  = "";
        $nom_empsusM 	  = "";
        $rfcsusM 		  = "";
        $mot_movsusM 	  = ""; 
        $num_doctosusM 	  = "";
        $ctM 			  = "";
        $nivel_sueldonvoM = "";
        $descripcion2M 	  = "";
        $descripcion1M 	  = "";

        $b=0;
        $id=0;
        ?>
          <div id="divTabla" style="height:350px" class="table-responsive">
            <table class="table table-striped" id="movs">
            <thead class="thead-dark">
              <tr>             
               <th><strong>Agregar</strong></th>
               <th class="dt-head-center" style="display: none;"><strong>one</strong></th>
               <th class="dt-head-center"><strong>TM</strong></th>
               <th class="dt-head-center"><strong>MO</strong></th>
               <th class="dt-head-center"><strong>PDA</strong></th>
               <th class="dt-head-center"><strong>Cod.Pago</strong></th>
               <th class="dt-head-center"><strong>Unidad</strong></th>
               <th class="dt-head-center"><strong>Subunidad</strong></th>
               <th class="dt-head-center"><strong>Puesto</strong></th>
               <th class="dt-head-center"><strong>Horas</strong></th>
               <th class="dt-head-center"><strong>Plaza</strong></th>
               <th class="dt-head-center"><strong>Qna. Ini</strong></th>
               <th class="dt-head-center"><strong>Qna. Fin</strong></th>

               <th class="dt-head-center"><strong>Nombre Sus</strong></th>
               <th class="dt-head-center"><strong>RFC Sus</strong></th>
               <th class="dt-head-center"><strong>MO Sus</strong></th>
               <th class="dt-head-center"><strong>Qna Ini Sus</strong></th>
               <th class="dt-head-center"><strong>Qna Fin Sus</strong></th>               
               <th class="dt-head-center"><strong>Num Docto Sus</strong></th>
               <th class="dt-head-center"><strong>CT</strong></th>
               <th class="dt-head-center"><strong>Nvl Sueldo</strong></th>
               <th class="dt-head-center"><strong>Descripcion</strong></th>
              </tr>
           </thead>
           <tbody>
		<?php

        foreach($arrayR_Mov as $valuesmov){//2do foreach getDatosPDF_Mov
				$tot_resul_mov=$valuesmov[0]["tot_resu"];	
			}//fin 2do foreach getDatosPDF_Mov

        while ($b <= $tot_resul_mov*22){//$total_res*30 //2do while getDatosPDF_Mov

				$M= 					$valuesmov[$b+1]['cve_movM'];
				$TM = 					str_pad($M, 2, "0", STR_PAD_LEFT);
				$MO1= 					$valuesmov[$b+2]['mot_movM'];//10";
				$MO = 					str_pad($MO1, 2, "0", STR_PAD_LEFT);
				$PARTIDA_MOV= 			$valuesmov[$b+3]['partidaM'];
				$CODIGO_PAGO_MOV1= 		$valuesmov[$b+4]['cod_pagoM'];
				$CODIGO_PAGO_MOV =      str_pad($CODIGO_PAGO_MOV1, 2, "0", STR_PAD_LEFT);
				$UNIDAD_MOV= 			$valuesmov[$b+5]['unidadM'];
				$SUBUNIDAD_MOV= 		$valuesmov[$b+6]['subunidadM'];
				$CATEGORIA_MOV= 		$valuesmov[$b+7]['cat_puestoM'];
				$HORAS_MOV =  			$valuesmov[$b+8]['horasM'];
				$numero =  				$valuesmov[$b+9]['cons_plazaM'];
				$PLAZA_MOV = 			str_pad($numero, 6, "0", STR_PAD_LEFT);
				$DESDE_MOV= 			$valuesmov[$b+10]['qna_ini_empM'];
				$HASTA_MOV= 			$valuesmov[$b+11]['qna_fin_empM'];
				$QNA_INISUS_MOV =  		$valuesmov[$b+12]['qna_inisusM'];
				/*if($QNA_INISUS_MOV == ""){$QNA_INISUS_MOV = "NULL";}
				if($QNA_INISUS_MOV == "NULL" ){$QNA_INISUS_MOV1 = "";}else{$QNA_INISUS_MOV1 =  		$valuesmov[$b+12]['qna_inisusM'];}*/
				$QNA_FINSUS_MOV =  		$valuesmov[$b+13]['qna_finsusM'];
				/*if($QNA_FINSUS_MOV == "NULL" ){$QNA_FINSUS_MOV1 = "";}else{$QNA_FINSUS_MOV1 =  		$valuesmov[$b+13]['qna_finsusM'];}
				if($QNA_FINSUS_MOV == ""){$QNA_FINSUS_MOV = "NULL";}*/
				$NOMBRE_SUS_MOV =  		$valuesmov[$b+14]['nom_empsusM'];
				/*if($NOMBRE_SUS_MOV == "" ){$NOMBRE_SUS_MOV = "NULL";}
				if($NOMBRE_SUS_MOV == "NULL" ){$NOMBRE_SUS_MOV1 = "";}else{$NOMBRE_SUS_MOV1 =  		$valuesmov[$b+14]['nom_empsusM'];}*/
				$RFCSUS_MOV =  			$valuesmov[$b+15]['rfcsusM'];
				/*if($RFCSUS_MOV == ""){$RFCSUS_MOV = "NULL";}
				if($RFCSUS_MOV == "NULL" ){$RFCSUS_MOV1 = "";}else{$RFCSUS_MOV1 =  		$valuesmov[$b+15]['rfcsusM'];}*/
				$MOT_MOVSUS =  			$valuesmov[$b+16]['mot_movsusM'];
				/*if($MOT_MOVSUS == ""){$MOT_MOVSUS = "NULL";}
				if($MOT_MOVSUS == "NULL" ){$MOT_MOVSUS1 = "";}else{$MOT_MOVSUS1 =  		$valuesmov[$b+16]['mot_movsusM'];}*/
				$NUM_DOCUMENTOSUS= 		$valuesmov[$b+17]['num_doctosusM'];
				/*if($NUM_DOCUMENTOSUS == ""){$NUM_DOCUMENTOSUS = "NULL";}
				if($NUM_DOCUMENTOSUS == "NULL" ){$NUM_DOCUMENTOSUS1 = "";}else{$NUM_DOCUMENTOSUS1=$valuesmov[$b+17]['num_doctosusM'];}*/
				$CT_MOV= 				$valuesmov[$b+18]['ctM'];
				$NIVEL_SUELDO_NUEVO= 	$valuesmov[$b+19]['nivel_sueldonvoM'];
				/*if($NIVEL_SUELDO_NUEVO == ""){$NIVEL_SUELDO_NUEVO = "0";}*/
				$DESCRIPCION1 =  		$valuesmov[$b+20]['descripcion2M'];                                 
				$DESCRIPCION2 =  		$valuesmov[$b+21]['descripcion1M'];
				$DESCRIPCION =          $DESCRIPCION1." ".$DESCRIPCION2;	
				$AREA_PLA=				$valuesmov[$b+22]['areaM'];	
        		$CONS_DOC=				$valuesmov[$b+23]['cons_docM'];
     ?>
    <tr id="<?php echo $id; ?>">
      <td id="add" style="display: none;"><?php echo $id;?></td>
      <td id="add" style="text-align: center; font-size:80%; padding:0px;">
      	<input type="checkbox" id="<?php echo $id;?>" value="<?php echo $id;?>" onclick="marcar(this.value,this.id)">
      </td>
      <td id="tm" style="text-align: center; font-size:80%; padding:0px; "><?php echo $TM ?></td>              
      <td id="mo" style="text-align: center; font-size:80%; padding:0px; "><?php echo $MO ?></td>
      <td id="pda" style="text-align: center; font-size:80%; padding:0px; "><?php echo $PARTIDA_MOV ?></td>
      <td id="cp" style="text-align: center; font-size:80%; padding:0px; "><?php echo $CODIGO_PAGO_MOV ?></td>
      <td id="su" style="text-align: center; font-size:80%; padding:0px; "><?php echo $UNIDAD_MOV ?></td>
      <td id="su" style="text-align: center; font-size:80%; padding:0px; "><?php echo $SUBUNIDAD_MOV ?></td>
      <td id="cat" style="text-align: center; font-size:80%; padding:0px; "><?php echo $CATEGORIA_MOV ?></td>
      <td id="hrs" style="text-align: center; font-size:80%; padding:0px; "><?php echo $HORAS_MOV ?></td>
      <td id="pla" style="text-align: center; font-size:80%; padding:0px; "><?php echo $PLAZA_MOV ?></td>
      <td id="qini" style="text-align: center; font-size:80%; padding:0px; "><?php echo $DESDE_MOV ?></td>
      <td id="qfin" style="text-align: center; font-size:80%; padding:0px; "><?php echo $HASTA_MOV ?></td>
      <td id="nomsus" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $NOMBRE_SUS_MOV; ?></td>
      <td id="rfcsus" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $RFCSUS_MOV; ?></td>
      <td id="mosus" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $MOT_MOVSUS; ?></td>
      <td id="qinisus" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $QNA_INISUS_MOV ?></td>
      <td id="qfinsus" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $QNA_FINSUS_MOV; ?></td>      
      <td id="nd" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $NUM_DOCUMENTOSUS; ?></td>
      <td id="ct" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $CT_MOV; ?></td>
      <td id="nsn" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $NIVEL_SUELDO_NUEVO; ?></td>
      <td id="des" style="text-align: center; font-size:80%; padding:0px; " ><?php echo $DESCRIPCION; ?></td>
  	</tr>

    <?php
      			$id = $id+1;
				$b = $b + 23;
	        }//fin 2do while getDatosPDF_Mov      	        
?>
</tbody>
</table>
</div>
<button type = "submit" name="btnGetData" class = "btn btn-danger" id = "btnGetData" >Generar FUP Original</button>
<?php
}
?>

          </div>
        </div>
      </div>
    </div>