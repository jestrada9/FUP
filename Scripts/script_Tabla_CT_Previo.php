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
  $(document).ready(function() {
/*----------------------------------------------------------- BOTON ORIGINAL ----------------------------------------------------------*/    
    $("#btnGetData").click(function() {//boton_original
        var usuarios = $('#usuario').val();
        var id = $('#id').val();
        var oficio = $('#oficio').val();
        var area = $('#area').val();        
        var rfc = $('#rfc').val();  
        var json2 = "undefined"; 
        var json1 = "undefined";
        var descargar = "descargar";
        var url = "../Pdf/crearPDF/CreacionFUPOriginal_CT_Editar.php";
        var resus= new Array();
        var ids;
        var msgForIn = '';
        var newarray= new Array();
        var tabla = document.getElementById('tabla2').getElementsByTagName('tbody')[0];

        /* Lectura segura del texto de una celda.
           Antes se leia cells[i].childNodes[0].data: cuando una celda venia
           vacia (sin nodos hijos) o la fila era el mensaje "No hay registros
           seleccionados" se lanzaba un TypeError, se abortaba el handler y el
           $.ajax nunca se ejecutaba; por eso no se guardaba ningun antecedente. */
        function celda(fila, i){
            if(!fila || !fila.cells || !fila.cells[i]){ return ""; }
            var txt = fila.cells[i].textContent;
            if(txt === null || txt === undefined){ txt = ""; }
            return txt.replace(/\u00a0/g, " ").trim();
        }

        /* Solo las filas que realmente son antecedentes: la fila placeholder
           tiene una unica celda con colspan. */
        var filas = [];
        for(var k = 0; k < tabla.rows.length; k++){
            if(tabla.rows[k].cells && tabla.rows[k].cells.length >= 16){
                filas.push(tabla.rows[k]);
            }
        }

        if(filas.length === 0){
            alert("No hay antecedentes seleccionados en la segunda tabla.");
            return;
        }

        var total = filas.length;
        var total1  = new constructor();
           total1.total  = total;
        newarray.push(total1);

        function BlockID(newarray) {
            return {
              newarray
            };
        }

        for(j=0;j<total;j++){

            var fila     = filas[j];
            var datas    = celda(fila,1);   // CP / codigo de pago
            var datas1   = celda(fila,2);   // Unidad
            var datas2   = celda(fila,3);   // Subunidad
            var datas3   = celda(fila,4);   // Puesto
            var datas4   = celda(fila,5);   // Horas
            var datas5   = celda(fila,6);   // Plaza
            var datas6   = celda(fila,7);   // Motivo
            var datas7   = celda(fila,8);   // Nivel de sueldo
            var datas8   = celda(fila,9);   // Qna. inicial
            var datas9   = celda(fila,10);  // Qna. final
            var datas10  = celda(fila,11);  // Numero de documento
            var datas11  = celda(fila,12);  // CT
            var datas12  = celda(fila,13);  // Valor2
            var datas14  = celda(fila,15);  // Area

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
        
        // console.log(json1);
        // console.log(window.btoa(json1));
        // console.log(usuarios);
        // console.log(id);
        // console.log(oficio);
        // console.log(area);
        // console.log(rfc);
         
        var xe1 = $("#observacion1").val();
        var xe2 = $("#observacion2").val();
        var xe3 = $("#observacion3").val();
        var xe4 = $("#observacion4").val();

              $.ajax({//ajax
                  url: url,
                  type: 'POST',
                  data: {
                    id: id,
                    oficio: oficio,
                    area: area,
                    rfc: rfc,
                    men: window.btoa(json1),
                    usu: usuarios,
                    obs: "Creacion Original CT",
                    ops: "Creacion Original CT",
                    checO1: window.btoa(xe1),
                    checO2: window.btoa(xe2),
                    checO3: window.btoa(xe3),
                    checO4: window.btoa(xe4)
                  },
                  beforeSend: function() {
                        //$('#exampleModal2').modal('show');
                  },
                  success: function(result){
                    console.log("CreacionFUPOriginal_CT_Editar.php ->", result);
                    $( "#exampleModalM" ).dialog( "close" );
                    $( "#dialog-confirmPDF" ).dialog( "close" );
                    $('#myTable').DataTable().ajax.reload();
                    //console.log(result);
                    //window.open(result);
                    //$('#exampleModal2').modal('hide');
                    //$('#exampleModal2').close();         
                  },
                  error: function(xhr, status, error){
                    console.error("Error al guardar los antecedentes:", status, error, xhr.responseText);
                    alert("Ocurrio un error al guardar los antecedentes. Revise la consola del navegador.");
                  }
              });//ajax  

    });//boton_original
 });
/*----------------------------------------------------------- BOTON ORIGINAL ----------------------------------------------------------*/
 </script>
