
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
 

/*----------------------------------------------------------- BOTON ORIGINAL ----------------------------------------------------------*/     
//   $(document).ready(function() {
//     $("#btnGetData").click(function() {//boton_original
//         var usuarios = $('#usuario').val();
//         var id = $('#id').val();
//         var oficio = $('#oficio').val();
//         var area = $('#area').val();        
//         var rfc = $('#rfc').val();  
//         var usuario = $('#usuario').val();
//         var json2 = "undefined"; 
//         var json1 = "undefined";
//         var descargar = "descargar";
//         var url = "../Pdf/crearPDF/CreacionFUPOriginal_CT_Editar90_Foliacion.php";
//         var resus= new Array();
//         var ids;
//         var msgForIn = '';
//         var newarray= new Array();
//         var tabla = document.getElementById('tabla2').getElementsByTagName('tbody')[0];
//         var total=tabla.rows.length;
//         var total1  = new constructor();
//            total1.total  = total;
//         newarray.push(total1);

//         function BlockID(newarray) {
//             return {                                                                                                         
//               newarray
//             };
//         }                                                         

//         for(j=0;j<total;j++){

//             var datas    = tabla.rows[j].cells[1].childNodes[0].data;
//             var datas1   = tabla.rows[j].cells[2].childNodes[0].data;
//             var datas2   = tabla.rows[j].cells[3].childNodes[0].data;
//             var datas3   = tabla.rows[j].cells[4].childNodes[0].data;
//             var datas4   = tabla.rows[j].cells[5].childNodes[0].data;
//             var datas5   = tabla.rows[j].cells[6].childNodes[0].data;
//             var datas6   = tabla.rows[j].cells[7].childNodes[0].data;
//             var datas7   = tabla.rows[j].cells[8].childNodes[0].data;
//             var datas8   = tabla.rows[j].cells[9].childNodes[0].data;
//             var datas9   = tabla.rows[j].cells[10].childNodes[0].data;
//             var datas10  = tabla.rows[j].cells[11].childNodes[0].data;
//             var datas11  = tabla.rows[j].cells[12].childNodes[0].data;
//             var datas12  = tabla.rows[j].cells[13].childNodes[0].data;
//             //var datas13  = tabla.rows[j].cells[14].childNodes[0].data;
//             var datas14  = tabla.rows[j].cells[15].childNodes[0].data;
                    
//             var cod_pago1  = new constructor();
//                 cod_pago1.cod_pago  = datas;
//             var unidad1    = new constructor();
//                 unidad1.unidad    = datas1;
//             var subunidad1 = new constructor();
//                 subunidad1.subunidad = datas2;
//             var puesto1    = new constructor();
//                 puesto1.puesto    = datas3;
//             var horas1     = new constructor();
//                 horas1.horas     = datas4;
//             var plaza1     = new constructor();
//                 plaza1.plaza     = datas5;
//             var mot_mov1   = new constructor();
//                 mot_mov1.mot_mov   = datas6;
//             var nivel_sdo1 = new constructor();
//                 nivel_sdo1.nivel_sdo = datas7;
//             var qna_ini1   = new constructor();
//                 qna_ini1.qna_ini   = datas8;
//             var qna_fin1   = new constructor();
//                 qna_fin1.qna_fin   = datas9;
//             var num_doc1   = new constructor();
//                 num_doc1.num_doc   = datas10;
//             var ct1        = new constructor();
//                 ct1.ct        = datas11;
//             var valor21    = new constructor();
//                 valor21.valor2    = datas12;
//             var areas1     = new constructor();
//                 areas1.areas     = datas14;    

//             newarray.push(cod_pago1);
//             newarray.push(unidad1);
//             newarray.push(subunidad1);
//             newarray.push(puesto1);
//             newarray.push(horas1);
//             newarray.push(plaza1);
//             newarray.push(mot_mov1);
//             newarray.push(nivel_sdo1);
//             newarray.push(qna_ini1);
//             newarray.push(qna_fin1);
//             newarray.push(num_doc1);
//             newarray.push(ct1);
//             newarray.push(valor21);
//             newarray.push(areas1);                  
//         }

//         var json1 = JSON.stringify(BlockID(newarray)); 
//               $.ajax({//ajax
//                   url: url,
//                   type: 'POST',
//                   data: {
//                     id: id,
//                     oficio: oficio,
//                     area: area,
//                     rfc: rfc,
//                     men: window.btoa(json1),
//                     usu: usuarios,
//                     obs: "Creacion Original CT 90",
//                     ops: "Creacion Original CT 90"
//                   },
//                   beforeSend: function() {
//                         //$('#exampleModal2').modal('show');
//                   },
//                   success: function(result){
//                     $( "#exampleModalM" ).dialog( "close" );
//                     $( "#dialog-confirmPDF" ).dialog( "close" );
//                     $('#myTable').DataTable().ajax.reload();
//                     //console.log(result);
//                     //window.open(result);
//                     //$('#exampleModal2').modal('hide');
//                     //$('#exampleModal2').close();         
//                   }
//               });//ajax  

//     });//boton_original
//  });
/*----------------------------------------------------------- BOTON ORIGINAL ----------------------------------------------------------*/
 
