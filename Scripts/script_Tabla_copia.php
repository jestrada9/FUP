 <script type="text/javascript">
   class constructor{ //class constructor Antecedentes
      get total(){return this._total;}
      set total(total){this._total = total;}
      get cod_pago(){return this._cod_pago;}
      set cod_pago(cod_pago){this._cod_pago = cod_pago;}
      get unidad(){return this.unidad;}
      set unidad(unidad){this._unidad = unidad;}
      get subunidad(){return this._subunidad;}
      set subunidad(subunidad){this._subunidad = subunidad;}               
      get puesto(){return this._puesto;}
      set puesto(puesto){this._puesto = puesto;}
      get horas(){return this._horas;}
      set horas(horas){this._horas = horas;}
      get plaza(){return this._plaza;}
      set plaza(plaza){this._plaza = plaza;}
      get mot_mov(){return this._mot_mov;}
      set mot_mov(mot_mov){this._mot_mov = mot_mov;}
      get nivel_sdo(){return this._nivel_sdo;}
      set nivel_sdo(nivel_sdo){this._nivel_sdo = nivel_sdo;}
      get qna_ini(){return this._qna_ini;}
      set qna_ini(qna_ini){this._qna_ini = qna_ini;}
      get qna_fin(){return this._qna_fin;}
      set qna_fin(qna_fin){this._qna_fin = qna_fin;}
      get num_doc(){return this._num_doc;}
      set num_doc(num_doc){this._num_doc = num_doc;}
      get ct(){return this._ct;}
      set ct(ct){this._ct = ct;}
      get valor2(){return this._valor2;}
      set valor2(valor2){this._valor2 = valor2;}
      get areas(){return this._areas;}
      set areas(areas){this._areas = areas;}
  } //class constructor Antecedentes
 </script>
<script type="text/javascript">
   class constructors{ //class constructor Plazas Selecionadas
      get total(){return this._total;}
      set total(total){this._total = total;}
      get tm(){return this.cve_movM;}
      set tm(tm){this.cve_movM = tm;}
      get mo(){return this.mot_movM;}
      set mo(mo){this.mot_movM = mo;}
      get pda(){return this.partidaM;}
      set pda(pda){this.partidaM = pda;}
      get cod_pago(){return this.cod_pagoM;}
      set cod_pago(cod_pago){this.cod_pagoM = cod_pago;}
      get unidad(){return this.unidadM;}
      set unidad(unidad){this.unidadM = unidad;}
      get subunidad(){return this.subunidadM;}
      set subunidad(subunidad){this.subunidadM = subunidad;}               
      get puesto(){return this.cat_puestoM;}
      set puesto(puesto){this.cat_puestoM = puesto;}
      get horas(){return this.horasM;}
      set horas(horas){this.horasM = horas;}
      get plaza(){return this.cons_plazaM;}
      set plaza(plaza){this.cons_plazaM = plaza;}
      get qna_ini(){return this.qna_ini_empM;}
      set qna_ini(qna_ini){this.qna_ini_empM = qna_ini;}                 
      get qna_fin(){return this.qna_fin_empM;}
      set qna_fin(qna_fin){this.qna_fin_empM = qna_fin;}  
      get nombre_sus(){return this.nom_empsusM;}
      set nombre_sus(nombre_sus){this.nom_empsusM = nombre_sus;}
      get rfc_sus(){return this.rfcsusM;}
      set rfc_sus(rfc_sus){this.rfcsusM = rfc_sus;}                                                            
      get mot_mov(){return this.mot_movsusM;}
      set mot_mov(mot_mov){this.mot_movsusM = mot_mov;}
      get qna_ini_sus(){return this.qna_inisusM;}
      set qna_ini_sus(qna_ini_sus){this.qna_inisusM = qna_ini_sus;}                   
      get qna_fin_sus(){return this.qna_finsusM;}
      set qna_fin_sus(qna_fin_sus){this.qna_finsusM = qna_fin_sus;}                     
      get num_doc(){return this.num_doctosusM;}
      set num_doc(num_doc){this.num_doctosusM = num_doc;}          
      get ct(){return this.ctM;}
      set ct(ct){this.ctM = ct;} 
      get nivel_sdo(){return this.nivel_sueldonvoM;}
      set nivel_sdo(nivel_sdo){this.nivel_sueldonvoM = nivel_sdo;}        
      get descripcion(){return this._descripcion;}
      set descripcion(descripcion){this._descripcion = descripcion;}
      get num_oficio(){return this.num_oficioM;}
      set num_oficio(num_oficio){this.num_oficioM = num_oficio;}
      get operador(){return this.operadorM;}
      set operador(operador){this.operadorM = operador;}
      get area(){return this.areaM;}
      set area(area){this.areaM = area;}
      get cons_doc(){return this.cons_docM;}
      set cons_doc(cons_doc){this.cons_docM = cons_doc;}         
  } //class constructor Plazas Selecionadas
 </script> 
 <script type="text/javascript">
  $(document).ready(function() {
/*----------------------------------------------------------- BOTON ORIGINAL ----------------------------------------------------------*/    
      $("#btnGetData").click(function() {
        var usuarios = $('#usuario').val();
        var json2 = "undefined"; 
        var json1 = "undefined";
        var descargar = "descargar";
        var url = "crearPDF/crearFUP.php";
        var url2 = "crearPDF/crearFUP.php";
        var url_C = "crearPDF/COriginal.php";
        var newarrays= new Array();
        var resus= new Array();
        var total2  = new constructors();
        var ids;
        var msgForIn = '';
        ids = $('input[class=selecheck]:checked').map(function() {
            return $(this).attr('id');
        }).get();
                resus.push(ids);
        total2.totals  = resus[0].length;
        newarrays.push(total2);

        for (i = 0; i < resus[0].length; i++) {//for_i
          msgForIn = resus[0][i]; //for_i
        
          var tablas = document.getElementById('movs').getElementsByTagName('tbody')[0]; 
          var totals=tablas.rows.length;

          function BlockID1(newarrays) {
           return {                                                                                                         
             newarrays
           };
          }                   
          for(j=0;j<totals;j++){//for
            var one = tablas.rows[j].cells[0].childNodes[0].data;
            if(msgForIn==one){
              var datas2   = tablas.rows[j].cells[2].childNodes[0].data;
              var datas3   = tablas.rows[j].cells[3].childNodes[0].data;
              var datas4   = tablas.rows[j].cells[4].childNodes[0].data;
              var datas5   = tablas.rows[j].cells[5].childNodes[0].data;
              var datas6   = tablas.rows[j].cells[6].childNodes[0].data;
              var datas7   = tablas.rows[j].cells[7].childNodes[0].data;
              var datas8   = tablas.rows[j].cells[8].childNodes[0].data;
              var datas9   = tablas.rows[j].cells[9].childNodes[0].data;
              var datas10  = tablas.rows[j].cells[10].childNodes[0].data;
              var datas11  = tablas.rows[j].cells[11].childNodes[0].data;
              var datas12  = tablas.rows[j].cells[12].childNodes[0].data;
              var datas13  = tablas.rows[j].cells[13].childNodes[0].data;
              var datas14  = tablas.rows[j].cells[14].childNodes[0].data;
              var datas15  = tablas.rows[j].cells[15].childNodes[0].data;
              var datas16  = tablas.rows[j].cells[16].childNodes[0].data;
              var datas17  = tablas.rows[j].cells[17].childNodes[0].data;
              var datas18  = tablas.rows[j].cells[18].childNodes[0].data;
              var datas19  = tablas.rows[j].cells[19].childNodes[0].data;
              var datas20  = tablas.rows[j].cells[20].childNodes[0].data;
              var datas21  = tablas.rows[j].cells[21].childNodes[0].data;

              var datas22  = tablas.rows[j].cells[22].childNodes[0].data;//cons_doc
              var datas23  = tablas.rows[j].cells[23].childNodes[0].data;//area
              var datas24  = tablas.rows[j].cells[24].childNodes[0].data;//oficio
              var datas25  = tablas.rows[j].cells[25].childNodes[0].data;//operador
              
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
              nombre_sus1.nombre_sus  = unescape( encodeURIComponent( datas13 ) );
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
              descripcion1.descripcion  = unescape( encodeURIComponent( datas21 ));
              var cons_doc1  = new constructors();
              cons_doc1.cons_doc  = datas22;
              var area1  = new constructors();
              area1.area  = datas23;
              var oficio1  = new constructors();
              oficio1.num_oficio  = datas24;
              var operador1  = new constructors();
              operador1.operador  = datas25;

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
              newarrays.push(cons_doc1);
              newarrays.push(area1);
              newarrays.push(oficio1);
              newarrays.push(operador1);
            }
          }//for
}//for_i

          var fec_imp = $("#fec_imp_a").val(); 

          var xe1 = $("#observacion1").val();
          var xe2 = $("#observacion2").val();
          var xe3 = $("#observacion3").val();
          var xe4 = $("#observacion4").val();

          var xf1 = $("#documentacion1").val(); 
          var xf2 = $("#documentacion2").val(); 
          var xf3 = $("#documentacion3").val(); 
          var xf4 = $("#documentacion4").val(); 
          var xf5 = $("#documentacion5").val(); 
          var pa  = $("#plaza_ant").val(); 
          

           var newarray= new Array();

           var tabla = document.getElementById('tabla2').getElementsByTagName('tbody')[0];
           var total=tabla.rows.length;
           
           var total1  = new constructor();
               total1.total  = total;
           newarray.push(total1);

           function BlockID(newarray) {
            return {                                                                                                         
              newarray
            };
          }                                                         
                 for(j=0;j<total;j++){

                    var datas    = tabla.rows[j].cells[1].childNodes[0].data;
                    var datas1   = tabla.rows[j].cells[2].childNodes[0].data;
                    var datas2   = tabla.rows[j].cells[3].childNodes[0].data;
                    var datas3   = tabla.rows[j].cells[4].childNodes[0].data;
                    var datas4   = tabla.rows[j].cells[5].childNodes[0].data;
                    var datas5   = tabla.rows[j].cells[6].childNodes[0].data;
                    var datas6   = tabla.rows[j].cells[7].childNodes[0].data;
                    var datas7   = tabla.rows[j].cells[8].childNodes[0].data;
                    var datas8   = tabla.rows[j].cells[9].childNodes[0].data;
                    var datas9   = tabla.rows[j].cells[10].childNodes[0].data;
                    var datas10  = tabla.rows[j].cells[11].childNodes[0].data;
                    var datas11  = tabla.rows[j].cells[12].childNodes[0].data;
                    var datas12  = tabla.rows[j].cells[13].childNodes[0].data;
                    //var datas13  = tabla.rows[j].cells[14].childNodes[0].data;
                    var datas14  = tabla.rows[j].cells[15].childNodes[0].data;
                    
                    var cod_pago1  = new constructor();
                        cod_pago1.cod_pago  = datas;
                    var unidad1    = new constructor();
                        unidad1.unidad    = datas1;
                    var subunidad1 = new constructor();
                        subunidad1.subunidad = datas2;
                    var puesto1    = new constructor();
                        puesto1.puesto    = datas3;
                    var horas1     = new constructor();
                        horas1.horas     = datas4;
                    var plaza1     = new constructor();
                        plaza1.plaza     = datas5;
                    var mot_mov1   = new constructor();
                        mot_mov1.mot_mov   = datas6;
                    var nivel_sdo1 = new constructor();
                        nivel_sdo1.nivel_sdo = datas7;
                    var qna_ini1   = new constructor();
                        qna_ini1.qna_ini   = datas8;
                    var qna_fin1   = new constructor();
                        qna_fin1.qna_fin   = datas9;
                    var num_doc1   = new constructor();
                        num_doc1.num_doc   = datas10;
                    var ct1        = new constructor();
                        ct1.ct        = datas11;
                    var valor21    = new constructor();
                        valor21.valor2    = datas12;
                    var areas1     = new constructor();
                        areas1.areas     = datas14;    

                        newarray.push(cod_pago1);
                        newarray.push(unidad1);
                        newarray.push(subunidad1);
                        newarray.push(puesto1);
                        newarray.push(horas1);
                        newarray.push(plaza1);
                        newarray.push(mot_mov1);
                        newarray.push(nivel_sdo1);
                        newarray.push(qna_ini1);
                        newarray.push(qna_fin1);
                        newarray.push(num_doc1);
                        newarray.push(ct1);
                        newarray.push(valor21);
                        newarray.push(areas1);                  
                }

      var json1 = JSON.stringify(BlockID(newarray)); 
      var valor = <?php echo $var; ?>; 
      var cve = <?php echo $cve_mov; ?>; 

      if( $('#plaza_ant').prop('checked') ) {

      if(totals!=0){
          json2 = JSON.stringify(BlockID1(newarrays));
      }        
 $.ajax({//otro_ajax
          url: url_C,
          type: 'POST',
          data: {
            valor: valor
          },
          success: function(result){//success

            if(result!="existe"){//if_result        
              $.ajax({
                  url: url,
                  type: 'POST',
                  data: {
                    valor: valor,
                    cve: cve,
                    men: window.btoa(json1),
                    movs: window.btoa(json2),
                    checO1: window.btoa(xe1),
                    checO2: window.btoa(xe2),
                    checO3: window.btoa(xe3),
                    checO4: window.btoa(xe4),
                    checA1: window.btoa(xf1),
                    checA2: window.btoa(xf2),
                    checA3: window.btoa(xf3),
                    checA4: window.btoa(xf4),
                    checA5: window.btoa(xf5),
                    dia: window.btoa("no"),
                    dias: window.btoa(""),
                    fec: window.btoa(fec_imp),
                    pa: "1",
                    descargar: descargar,
                    copiaUoriginal: "original",
                    usu: usuarios,
                    obs: "Creacion Original",
                    ops: "Creacion Original"
                  },
                  beforeSend: function() {
                    $('#exampleModal2').modal('show');
                    $('.fade').add();
                    $('body').addClass('modal-open');
                  },
                  success: function(result){
                    window.open(result);
                    $('#exampleModal2').modal('hide');
                    $('#exampleModal2').close();
                    /*$('.fade').remove();
                    $('body').removeClass('modal-open');*/              
                  }
                });
        }//if_result
          else{
            alert("El Número de Documento "+valor+" ya existe en Original");
            //window.close();
            $('#btnGetData').hide();
          }
        }//success
        });//otro_ajax
        //$('#btnGetData').hide();
        /*
          var miUrl2 = "crearPDF/crearFUP.php?valor="+valor+"&cve="+cve+"&men="+window.btoa(json1)+"&movs="+window.btoa(json2)+"&checO1="+window.btoa(xe1)+"&checO2="+window.btoa(xe2)+"&checO3="+window.btoa(xe3)+"&checO4="+window.btoa(xe4)+"&checA1="+window.btoa(xf1)+"&checA2="+window.btoa(xf2)+"&checA3="+window.btoa(xf3)+"&checA4="+window.btoa(xf4)+"&checA5="+window.btoa(xf5)+"&dia="+window.btoa("no")+"&dias="+window.btoa("")+"&fec="+window.btoa(fec_imp)+"&pa=1";
                 window.open(miUrl2,"_blank"); 
            */     
       }else{//else
       
 $.ajax({//otro_ajax
          url: url_C,
          type: 'POST',
          data: {
            valor: valor
          },
          success: function(result){//success

            if(result!="existe"){//if_result
              
              $.ajax({
                  url: url2,
                  type: 'POST',
                  data: {
                    valor: valor,
                    cve: cve,
                    men: window.btoa(json1),
                    movs: window.btoa("undefined"),
                    checO1: window.btoa(xe1),
                    checO2: window.btoa(xe2),
                    checO3: window.btoa(xe3),
                    checO4: window.btoa(xe4),
                    checA1: window.btoa(xf1),
                    checA2: window.btoa(xf2),
                    checA3: window.btoa(xf3),
                    checA4: window.btoa(xf4),
                    checA5: window.btoa(xf5),
                    dia: window.btoa("no"),
                    dias: window.btoa(""),
                    fec: window.btoa(fec_imp),
                    pa: "0",
                    descargar: descargar,
                    copiaUoriginal: "original",
                    usu: usuarios,
                    obs: "Creacion Original",
                    ops: "Creacion Original"
                  },
                  beforeSend: function() {
                          $('#exampleModal2').modal('show');
                        },
                  success: function(result){
                    window.open(result);
                    $('#exampleModal2').modal('hide');
                    $('#exampleModal2').close();
                    /*$('.fade').remove();
                    $('body').removeClass('modal-open');*/              
                  }
              });
             
             }//if_result
                  else{
                    alert("El Número de Documento "+valor+" ya existe en Original");
                    //window.close();
                    $('#btnGetData').hide();
                  }
                }//success
        });//otro_ajax
 
        //$('#btnGetData').hide();
/*
var miUrl2 = "crearPDF/crearFUP.php?valor="+valor+"&cve="+cve+"&men="+window.btoa(json1)+"&movs="+window.btoa("undefined")+"&checO1="+window.btoa(xe1)+"&checO2="+window.btoa(xe2)+"&checO3="+window.btoa(xe3)+"&checO4="+window.btoa(xe4)+"&checA1="+window.btoa(xf1)+"&checA2="+window.btoa(xf2)+"&checA3="+window.btoa(xf3)+"&checA4="+window.btoa(xf4)+"&checA5="+window.btoa(xf5)+"&dia="+window.btoa("no")+"&dias="+window.btoa("")+"&fec="+window.btoa(fec_imp)+"&pa=0";
                 window.open(miUrl2,"_blank"); 
*/
         }//else  
});
 });
/*----------------------------------------------------------- BOTON ORIGINAL ----------------------------------------------------------*/
 </script>
 <script type="text/javascript">
/*------------------------------------------------------------- BOTON COPIA ------------------------------------------------------------*/
$(document).ready(function() {
$("#btnGetDataC").click(function() {//btnGetDataC
        var total2  = new constructors();
        var json2 = "undefined"; 
        var json1 = "undefined";
        var descargar = "descargar";
        var url = "crearPDF/crearFUP.php";
        var url2 = "crearPDF/crearFUP.php";
        var url_C = "crearPDF/COriginal.php";
        var newarrays= new Array();
        var resus= new Array();
        var ids;
        var msgForIn = '';
        var usuarios = $('#usuario').val();

        ids = $('input[class=selecheck]:checked').map(function() {
            return $(this).attr('id');
        }).get();
        resus.push(ids);
        //var resu = ids.join(',');
        total2.totals  = resus[0].length;
        newarrays.push(total2);

        for (i = 0; i < resus[0].length; i++) {//for_i
          msgForIn = resus[0][i]; 
          var tablas = document.getElementById('movs').getElementsByTagName('tbody')[0]; 
          var totals=tablas.rows.length;

          function BlockID1(newarrays) {
           return {                                                                                                         
             newarrays
           };
          }                   
          for(j=0;j<totals;j++){//for
            var one = tablas.rows[j].cells[0].childNodes[0].data;
            if(msgForIn==one){
              var datas2   = tablas.rows[j].cells[2].childNodes[0].data;
              var datas3   = tablas.rows[j].cells[3].childNodes[0].data;
              var datas4   = tablas.rows[j].cells[4].childNodes[0].data;
              var datas5   = tablas.rows[j].cells[5].childNodes[0].data;
              var datas6   = tablas.rows[j].cells[6].childNodes[0].data;
              var datas7   = tablas.rows[j].cells[7].childNodes[0].data;
              var datas8   = tablas.rows[j].cells[8].childNodes[0].data;
              var datas9   = tablas.rows[j].cells[9].childNodes[0].data;
              var datas10  = tablas.rows[j].cells[10].childNodes[0].data;
              var datas11  = tablas.rows[j].cells[11].childNodes[0].data;
              var datas12  = tablas.rows[j].cells[12].childNodes[0].data;
              var datas13  = tablas.rows[j].cells[13].childNodes[0].data;
              var datas14  = tablas.rows[j].cells[14].childNodes[0].data;
              var datas15  = tablas.rows[j].cells[15].childNodes[0].data;
              var datas16  = tablas.rows[j].cells[16].childNodes[0].data;
              var datas17  = tablas.rows[j].cells[17].childNodes[0].data;
              var datas18  = tablas.rows[j].cells[18].childNodes[0].data;
              var datas19  = tablas.rows[j].cells[19].childNodes[0].data;
              var datas20  = tablas.rows[j].cells[20].childNodes[0].data;
              var datas21  = tablas.rows[j].cells[21].childNodes[0].data;

              var datas22  = tablas.rows[j].cells[22].childNodes[0].data;//cons_doc
              var datas23  = tablas.rows[j].cells[23].childNodes[0].data;//area
              var datas24  = tablas.rows[j].cells[24].childNodes[0].data;//oficio
              var datas25  = tablas.rows[j].cells[25].childNodes[0].data;//operador

              
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
              nombre_sus1.nombre_sus  = unescape( encodeURIComponent( datas13 ) );
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
              descripcion1.descripcion  = unescape( encodeURIComponent( datas21 ));

              var cons_doc1  = new constructors();
              cons_doc1.cons_doc  = datas22;
              var area1  = new constructors();
              area1.area  = datas23;
              var oficio1  = new constructors();
              oficio1.num_oficio  = datas24;
              var operador1  = new constructors();
              operador1.operador  = datas25;


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

              newarrays.push(cons_doc1);
              newarrays.push(area1);
              newarrays.push(oficio1);
              newarrays.push(operador1);
            }
          }//for
}//for_i


          var fec_imp = $("#fec_imp_a").val(); 

          var xe1 = $("#observacion1").val();
          var xe2 = $("#observacion2").val();
          var xe3 = $("#observacion3").val();
          var xe4 = $("#observacion4").val();

          var xf1 = $("#documentacion1").val(); 
          var xf2 = $("#documentacion2").val(); 
          var xf3 = $("#documentacion3").val(); 
          var xf4 = $("#documentacion4").val(); 
          var xf5 = $("#documentacion5").val(); 
          var pa  = $("#plaza_ant").val(); 
          

           var newarray= new Array();
            

           var tabla = document.getElementById('tabla2').getElementsByTagName('tbody')[0];
           var total=tabla.rows.length;
           
           var total1  = new constructor();
               total1.total  = total;
           newarray.push(total1);

           function BlockID(newarray) {
            return {                                                                                                         
              newarray
            };
          }                                                         
      
                 for(j=0;j<total;j++){

                    var datas    = tabla.rows[j].cells[1].childNodes[0].data;
                    var datas1   = tabla.rows[j].cells[2].childNodes[0].data;
                    var datas2   = tabla.rows[j].cells[3].childNodes[0].data;
                    var datas3   = tabla.rows[j].cells[4].childNodes[0].data;
                    var datas4   = tabla.rows[j].cells[5].childNodes[0].data;
                    var datas5   = tabla.rows[j].cells[6].childNodes[0].data;
                    var datas6   = tabla.rows[j].cells[7].childNodes[0].data;
                    var datas7   = tabla.rows[j].cells[8].childNodes[0].data;
                    var datas8   = tabla.rows[j].cells[9].childNodes[0].data;
                    var datas9   = tabla.rows[j].cells[10].childNodes[0].data;
                    var datas10  = tabla.rows[j].cells[11].childNodes[0].data;
                    var datas11  = tabla.rows[j].cells[12].childNodes[0].data;
                    var datas12  = tabla.rows[j].cells[13].childNodes[0].data;
                    //var datas13  = tabla.rows[j].cells[14].childNodes[0].data;
                    var datas14  = tabla.rows[j].cells[15].childNodes[0].data;
                    
                    var cod_pago1  = new constructor();
                        cod_pago1.cod_pago  = datas;
                    var unidad1    = new constructor();
                        unidad1.unidad    = datas1;
                    var subunidad1 = new constructor();
                        subunidad1.subunidad = datas2;
                    var puesto1    = new constructor();
                        puesto1.puesto    = datas3;
                    var horas1     = new constructor();
                        horas1.horas     = datas4;
                    var plaza1     = new constructor();
                        plaza1.plaza     = datas5;
                    var mot_mov1   = new constructor();
                        mot_mov1.mot_mov   = datas6;
                    var nivel_sdo1 = new constructor();
                        nivel_sdo1.nivel_sdo = datas7;
                    var qna_ini1   = new constructor();
                        qna_ini1.qna_ini   = datas8;
                    var qna_fin1   = new constructor();
                        qna_fin1.qna_fin   = datas9;
                    var num_doc1   = new constructor();
                        num_doc1.num_doc   = datas10;
                    var ct1        = new constructor();
                        ct1.ct        = datas11;
                    var valor21    = new constructor();
                        valor21.valor2    = datas12;
                    var areas1     = new constructor();
                        areas1.areas     = datas14;    

                        newarray.push(cod_pago1);
                        newarray.push(unidad1);
                        newarray.push(subunidad1);
                        newarray.push(puesto1);
                        newarray.push(horas1);
                        newarray.push(plaza1);
                        newarray.push(mot_mov1);
                        newarray.push(nivel_sdo1);
                        newarray.push(qna_ini1);
                        newarray.push(qna_fin1);
                        newarray.push(num_doc1);
                        newarray.push(ct1);
                        newarray.push(valor21);
                        newarray.push(areas1);                  
                }

      var json1 = JSON.stringify(BlockID(newarray)); 
      //console.log(json1);
      //console.log(window.btoa(json1));
      var valor = <?php echo $var; ?>; 
      var cve = <?php echo $cve_mov; ?>; 

      if( $('#plaza_ant').prop('checked') ) {

          json2 = JSON.stringify(BlockID1(newarrays));
          console.log(json2);
          //console.log(window.btoa(json2));
      
        $.ajax({
            url: url,
            type: 'POST',
            data: {
              valor: valor,
              cve: cve,
              men: window.btoa(json1),
              movs: window.btoa(json2),
              checO1: window.btoa(xe1),
              checO2: window.btoa(xe2),
              checO3: window.btoa(xe3),
              checO4: window.btoa(xe4),
              checA1: window.btoa(xf1),
              checA2: window.btoa(xf2),
              checA3: window.btoa(xf3),
              checA4: window.btoa(xf4),
              checA5: window.btoa(xf5),
              dia: window.btoa("no"),
              dias: window.btoa(""),
              fec: window.btoa(fec_imp),
              pa: "1",
              descargar: descargar,
              copiaUoriginal: "copia",
              usu: usuarios,
              obs: "Creacion Copia",
              ops: "Creacion Copia"
            },
            beforeSend: function() {
                    $('#exampleModal2').modal('show');
                  },
            success: function(result){
              window.open(result);
              $('#exampleModal2').modal('hide');
              $('#exampleModal2').close();
              /*$('.fade').remove();
              $('body').removeClass('modal-open');              */
            }
          });

/*       
          var miUrl2 = "crearPDF/crearFUP.php?valor="+valor+"&cve="+cve+"&men="+window.btoa(json1)+"&movs="+window.btoa(json2)+"&checO1="+window.btoa(xe1)+"&checO2="+window.btoa(xe2)+"&checO3="+window.btoa(xe3)+"&checO4="+window.btoa(xe4)+"&checA1="+window.btoa(xf1)+"&checA2="+window.btoa(xf2)+"&checA3="+window.btoa(xf3)+"&checA4="+window.btoa(xf4)+"&checA5="+window.btoa(xf5)+"&dia="+window.btoa("no")+"&dias="+window.btoa("")+"&fec="+window.btoa(fec_imp)+"&pa=1";
                 window.open(miUrl2,"_blank"); 
*/              
       }else{//else
  $.ajax({
            url: url2,
            type: 'POST',
            data: {
              valor: valor,
              cve: cve,
              men: window.btoa(json1),
              movs: window.btoa("undefined"),
              checO1: window.btoa(xe1),
              checO2: window.btoa(xe2),
              checO3: window.btoa(xe3),
              checO4: window.btoa(xe4),
              checA1: window.btoa(xf1),
              checA2: window.btoa(xf2),
              checA3: window.btoa(xf3),
              checA4: window.btoa(xf4),
              checA5: window.btoa(xf5),
              dia: window.btoa("no"),
              dias: window.btoa(""),
              fec: window.btoa(fec_imp),
              pa: "0",
              descargar: descargar,
              copiaUoriginal: "copia",
              usu: usuarios,
              obs: "Creacion Copia",
              ops: "Creacion Copia"
            },
            beforeSend: function() {
                $('#exampleModal2').modal('show');
                /*$('.fade').modal('show');
                $('body').addClass('modal-open');*/
            },
            success: function(result){
              window.open(result);
              $('#exampleModal2').modal('hide');
              //$('#exampleModal2').close();
              /*$('.fade').remove();
              $('body').removeClass('modal-open');*/
            }
          });

/*
var miUrl2 = "crearPDF/crearFUP.php?valor="+valor+"&cve="+cve+"&men="+window.btoa(json1)+"&movs="+window.btoa("undefined")+"&checO1="+window.btoa(xe1)+"&checO2="+window.btoa(xe2)+"&checO3="+window.btoa(xe3)+"&checO4="+window.btoa(xe4)+"&checA1="+window.btoa(xf1)+"&checA2="+window.btoa(xf2)+"&checA3="+window.btoa(xf3)+"&checA4="+window.btoa(xf4)+"&checA5="+window.btoa(xf5)+"&dia="+window.btoa("no")+"&dias="+window.btoa("")+"&fec="+window.btoa(fec_imp)+"&pa=0";
                 window.open(miUrl2,"_blank"); 
*/
         }//else  
      });//btnGetDataC

 /*------------------------------------------------------------- BOTON COPIA ------------------------------------------------------------*/
 /*------------------------------------------------------ BOTON ORIGINAL dd/mm/yy ------------------------------------------------------*/
            $("#btnGetData2").click(function() {
              var usuarios = $('#usuario').val();
                var xs = $("#dia1").val(); 
                if(xs==""){
                  alert("Agregar Fecha DIA");
                  $("#dia1").focus();
                }
              if(xs!=""){//if(xs!="")
                var fec_imp = $("#fec_imp_a").val(); 

                var xe1 = $("#observacion1").val();
                var xe2 = $("#observacion2").val();
                var xe3 = $("#observacion3").val();
                var xe4 = $("#observacion4").val();

                var xf1 = $("#documentacion1").val(); 
                var xf2 = $("#documentacion2").val(); 
                var xf3 = $("#documentacion3").val(); 
                var xf4 = $("#documentacion4").val(); 
                var xf5 = $("#documentacion5").val(); 
                var pa = $("#plaza_ant").val(); 

                 var newarray= new Array();
                 var tabla = document.getElementById('tabla2').getElementsByTagName('tbody')[0];
                 var total=tabla.rows.length;

                 var total1  = new constructor();
                     total1.total  = total;
                 newarray.push(total1);
                 //console.log(total);
                 function BlockID(newarray) {
                  return {                                                                                                                  
                    newarray
                  };
                } 

                 
                 for(j=0;j<total;j++){
                 
                    var datas    = tabla.rows[j].cells[1].childNodes[0].data;
                    var datas1   = tabla.rows[j].cells[2].childNodes[0].data;
                    var datas2   = tabla.rows[j].cells[3].childNodes[0].data;
                    var datas3   = tabla.rows[j].cells[4].childNodes[0].data;
                    var datas4   = tabla.rows[j].cells[5].childNodes[0].data;
                    var datas5   = tabla.rows[j].cells[6].childNodes[0].data;
                    var datas6   = tabla.rows[j].cells[7].childNodes[0].data;
                    var datas7   = tabla.rows[j].cells[8].childNodes[0].data;
                    var datas8   = tabla.rows[j].cells[9].childNodes[0].data;
                    var datas9   = tabla.rows[j].cells[10].childNodes[0].data;
                    var datas10  = tabla.rows[j].cells[11].childNodes[0].data;
                    var datas11  = tabla.rows[j].cells[12].childNodes[0].data;
                    var datas12  = tabla.rows[j].cells[13].childNodes[0].data;
                    //var datas13  = tabla.rows[j].cells[14].childNodes[0].data;
                    var datas14  = tabla.rows[j].cells[15].childNodes[0].data;

                   var cod_pago1  = new constructor();
                        cod_pago1.cod_pago  = datas;
                    var unidad1    = new constructor();
                        unidad1.unidad    = datas1;
                    var subunidad1 = new constructor();
                        subunidad1.subunidad = datas2;
                    var puesto1    = new constructor();
                        puesto1.puesto    = datas3;
                    var horas1     = new constructor();
                        horas1.horas     = datas4;
                    var plaza1     = new constructor();
                        plaza1.plaza     = datas5;
                    var mot_mov1   = new constructor();
                        mot_mov1.mot_mov   = datas6;
                    var nivel_sdo1 = new constructor();
                        nivel_sdo1.nivel_sdo = datas7;
                    var qna_ini1   = new constructor();
                        qna_ini1.qna_ini   = datas8;
                    var qna_fin1   = new constructor();
                        qna_fin1.qna_fin   = datas9;
                    var num_doc1   = new constructor();
                        num_doc1.num_doc   = datas10;
                    var ct1        = new constructor();
                        ct1.ct        = datas11;
                    var valor21    = new constructor();
                        valor21.valor2    = datas12;
                    var areas1     = new constructor();
                        areas1.areas     = datas14;    

                        newarray.push(cod_pago1);
                        newarray.push(unidad1);
                        newarray.push(subunidad1);
                        newarray.push(puesto1);
                        newarray.push(horas1);
                        newarray.push(plaza1);
                        newarray.push(mot_mov1);
                        newarray.push(nivel_sdo1);
                        newarray.push(qna_ini1);
                        newarray.push(qna_fin1);
                        newarray.push(num_doc1);
                        newarray.push(ct1);
                        newarray.push(valor21);
                        newarray.push(areas1);                      
                }

                var json1 = JSON.stringify(BlockID(newarray)); 
 
                  var valor = <?php echo $var; ?>; 
                  var cve = <?php echo $cve_mov; ?>; 
                  var descargar = "descargar";
        var url5 = "crearPDF/crearFUPBja.php";
        //var url = "crearPDF/copia.php";

        $.ajax({
          url: url5,
          type: 'POST',
          data: {
            valor: valor,
            cve: cve,
            men: window.btoa(json1),
            movs: window.btoa("undefined"),
            checO1: window.btoa(xe1),
            checO2: window.btoa(xe2),
            checO3: window.btoa(xe3),
            checO4: window.btoa(xe4),
            checA1: window.btoa(xf1),
            checA2: window.btoa(xf2),
            checA3: window.btoa(xf3),
            checA4: window.btoa(xf4),
            checA5: window.btoa(xf5),
            dia: window.btoa("si"),
            dias: window.btoa(xs),
            fec: window.btoa(fec_imp),
            pa: "0",
            descargar: descargar,
            copiaUoriginal: "original",
              usu: usuarios,
              obs: "Creacion Original",
              ops: "Creacion Original"
          },
          beforeSend: function() {
            $('#exampleModal2').modal('show');
          },
          success: function(result){
           window.open(result);
           $('#exampleModal2').modal('hide');
           $('#exampleModal2').close();
              /*$('.fade').remove();
              $('body').removeClass('modal-open');*/           
           //$('#exampleModal2').remove();
          }
        });
       
     
/*
           var miUrl2 = "crearPDF/crearFUP.php?valor="+valor+"&cve="+cve+"&men="+window.btoa(json1)+"&checO1="+window.btoa(xe1)+"&checO2="+window.btoa(xe2)+"&checO3="+window.btoa(xe3)+"&checO4="+window.btoa(xe4)+"&checA1="+window.btoa(xf1)+"&checA2="+window.btoa(xf2)+"&checA3="+window.btoa(xf3)+"&checA4="+window.btoa(xf4)+"&checA5="+window.btoa(xf5)+"&dia="+window.btoa("si")+"&dias="+window.btoa(xs)+"&fec="+window.btoa(fec_imp)+"&pa=noactivo";
           
           window.open(miUrl2,"_blank");
*/           
       }//if(xs!="")

      });
/*------------------------------------------------------ BOTON ORIGINAL dd/mm/yy ------------------------------------------------------*/
/*------------------------------------------------------- BOTON COPIA dd/mm/yy -------------------------------------------------------*/
$("#btnGetData2C").click(function() {
  var usuarios = $('#usuario').val();
                var xs = $("#dia1").val(); 
                if(xs==""){
                  alert("Agregar Fecha DIA");
                  $("#dia1").focus();
                }
              if(xs!=""){//if(xs!="")
                var fec_imp = $("#fec_imp_a").val(); 

                var xe1 = $("#observacion1").val();
                var xe2 = $("#observacion2").val();
                var xe3 = $("#observacion3").val();
                var xe4 = $("#observacion4").val();

                var xf1 = $("#documentacion1").val(); 
                var xf2 = $("#documentacion2").val(); 
                var xf3 = $("#documentacion3").val(); 
                var xf4 = $("#documentacion4").val(); 
                var xf5 = $("#documentacion5").val(); 
                var pa = $("#plaza_ant").val(); 

                 var newarray= new Array();
                 var tabla = document.getElementById('tabla2').getElementsByTagName('tbody')[0];
                 var total=tabla.rows.length;

                 var total1  = new constructor();
                     total1.total  = total;
                 newarray.push(total1);
                 //console.log(total);
                 function BlockID(newarray) {
                  return {                                                                                                                  
                    newarray
                  };
                } 

                 
                 for(j=0;j<total;j++){
                 
                    var datas    = tabla.rows[j].cells[1].childNodes[0].data;
                    var datas1   = tabla.rows[j].cells[2].childNodes[0].data;
                    var datas2   = tabla.rows[j].cells[3].childNodes[0].data;
                    var datas3   = tabla.rows[j].cells[4].childNodes[0].data;
                    var datas4   = tabla.rows[j].cells[5].childNodes[0].data;
                    var datas5   = tabla.rows[j].cells[6].childNodes[0].data;
                    var datas6   = tabla.rows[j].cells[7].childNodes[0].data;
                    var datas7   = tabla.rows[j].cells[8].childNodes[0].data;
                    var datas8   = tabla.rows[j].cells[9].childNodes[0].data;
                    var datas9   = tabla.rows[j].cells[10].childNodes[0].data;
                    var datas10  = tabla.rows[j].cells[11].childNodes[0].data;
                    var datas11  = tabla.rows[j].cells[12].childNodes[0].data;
                    var datas12  = tabla.rows[j].cells[13].childNodes[0].data;
                    //var datas13  = tabla.rows[j].cells[14].childNodes[0].data;
                    var datas14  = tabla.rows[j].cells[15].childNodes[0].data;

                   var cod_pago1  = new constructor();
                        cod_pago1.cod_pago  = datas;
                    var unidad1    = new constructor();
                        unidad1.unidad    = datas1;
                    var subunidad1 = new constructor();
                        subunidad1.subunidad = datas2;
                    var puesto1    = new constructor();
                        puesto1.puesto    = datas3;
                    var horas1     = new constructor();
                        horas1.horas     = datas4;
                    var plaza1     = new constructor();
                        plaza1.plaza     = datas5;
                    var mot_mov1   = new constructor();
                        mot_mov1.mot_mov   = datas6;
                    var nivel_sdo1 = new constructor();
                        nivel_sdo1.nivel_sdo = datas7;
                    var qna_ini1   = new constructor();
                        qna_ini1.qna_ini   = datas8;
                    var qna_fin1   = new constructor();
                        qna_fin1.qna_fin   = datas9;
                    var num_doc1   = new constructor();
                        num_doc1.num_doc   = datas10;
                    var ct1        = new constructor();
                        ct1.ct        = datas11;
                    var valor21    = new constructor();
                        valor21.valor2    = datas12;
                    var areas1     = new constructor();
                        areas1.areas     = datas14;    

                        newarray.push(cod_pago1);
                        newarray.push(unidad1);
                        newarray.push(subunidad1);
                        newarray.push(puesto1);
                        newarray.push(horas1);
                        newarray.push(plaza1);
                        newarray.push(mot_mov1);
                        newarray.push(nivel_sdo1);
                        newarray.push(qna_ini1);
                        newarray.push(qna_fin1);
                        newarray.push(num_doc1);
                        newarray.push(ct1);
                        newarray.push(valor21);
                        newarray.push(areas1);                      
                }

                var json1 = JSON.stringify(BlockID(newarray)); 
 
                  var valor = <?php echo $var; ?>; 
                  var cve = <?php echo $cve_mov; ?>; 
                  var descargar = "descargar";
        var url = "crearPDF/crearFUP.php";
        //var url = "crearPDF/copia.php";

        $.ajax({
          url: url,
          type: 'POST',
          data: {
            valor: valor,
            cve: cve,
            men: window.btoa(json1),
            movs: window.btoa("undefined"),
            checO1: window.btoa(xe1),
            checO2: window.btoa(xe2),
            checO3: window.btoa(xe3),
            checO4: window.btoa(xe4),
            checA1: window.btoa(xf1),
            checA2: window.btoa(xf2),
            checA3: window.btoa(xf3),
            checA4: window.btoa(xf4),
            checA5: window.btoa(xf5),
            dia: window.btoa("si"),
            dias: window.btoa(xs),
            fec: window.btoa(fec_imp),
            pa: "0",
            descargar: descargar,
            copiaUoriginal: "copia",
              usu: usuarios,
              obs: "Creacion Copia Dia",
              ops: "Creacion Copia Dia"
          },
          beforeSend: function() {
            $('#exampleModal2').modal('show');
          },
          success: function(result){
           window.open(result);
           $('#exampleModal2').modal('hide');
           $('#exampleModal2').close();
              /*$('.fade').remove();
              $('body').removeClass('modal-open');*/           
           //$('#exampleModal2').remove();
          }
        });
       
     
/*
           var miUrl2 = "crearPDF/crearFUP.php?valor="+valor+"&cve="+cve+"&men="+window.btoa(json1)+"&checO1="+window.btoa(xe1)+"&checO2="+window.btoa(xe2)+"&checO3="+window.btoa(xe3)+"&checO4="+window.btoa(xe4)+"&checA1="+window.btoa(xf1)+"&checA2="+window.btoa(xf2)+"&checA3="+window.btoa(xf3)+"&checA4="+window.btoa(xf4)+"&checA5="+window.btoa(xf5)+"&dia="+window.btoa("si")+"&dias="+window.btoa(xs)+"&fec="+window.btoa(fec_imp)+"&pa=noactivo";
           
           window.open(miUrl2,"_blank");
*/           
       }//if(xs!="")

      });
/*------------------------------------------------------- BOTON COPIA dd/mm/yy -------------------------------------------------------*/
     });   
</script>