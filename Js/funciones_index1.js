function _eeap(ne, a, v, x) { try { var e = document.getElementById(ne); if (x == 0) e.style[a] = v; else if (x == 1) e.setAttribute(a, v); else if (x == 2) e[a] = v; return true; } catch (e) { } return false; }
        function _oeap(ne, a, x) { try { var v = undefined; var e = document.getElementById(ne); if (x == 0) v = e.style[a]; else if (x == 1) v = e.getAttribute(a); else if (x == 2) v = e[a]; return v; } catch (e) { } return undefined; }

    function nchstR() {
    docaprocR = docsaprocR[++idocaprocR];
    document.getElementById("num_doctoR").value=docaprocR.value;
    }

    var docsaprocR = null;
    var docaprocR = null;
    var ndocaprocR = null;
    var idocaprocR = -1;

    function tldocusR() {
      $.ajax({
              type: "POST",
        
               url: "Conexion/ldocus.php",
              data: {nfj:"nfj"},
           success: function(cbr)
                 {
                    $('#ldocusR').html(cbr);
    ndocaprocR = document.getElementById("ldocusR").options.length;
    alert('se van a procesar ' + ndocaprocR + ' documentos copias');
    docsaprocR = document.getElementById('ldocusR');
                 }
                 });
    }

    var cdstartR = new Date().getTime();
    var cdendR = new Date().getTime();
    var cdctimeR = cdendR - cdstartR;
    var cdltimeR = 10000;

    function prodocuR() {
      nchstR();
      cdstartR = new Date().getTime();
      $.ajax({
             async: true,
              type: "POST",
        
               url: "Pdf/Reimprimir/reimprimir2_Masivo.php",
              data: {"num_doctoR":document.getElementById("num_doctoR").value},
           success: function(cbr)
                 {
      cdendR = new Date().getTime();
      cdctimeR = cdendR - cdstartR;
      if(idocaprocR<ndocaprocR)
      {
        if(cdctimeR<cdltimeR) { //se mejoró el tiempo de procesamiento respecto de la ocasión anterior
          cdltimeR=cdctimeR;
        }
      }
      
                 },
    error : function(xhr, status) {
      cdltimeR = 10000;
        },
    complete : function(xhr, status) {
      if(idocaprocR<ndocaprocR)
      {
        prodocuR();        
      }
        },
             cache: false
                 });
    }

/*
  cdendR = new Date().getTime();
  cdctimeR = cdendR - cdstartR;
  if(idocaprocR<ndocaprocR)
  {
    if(cdctimeR<cdltimeR) { //se mejoró el tiempo de procesamiento respecto de la ocasión anterior
      cdltimeR=cdctimeR;      
    }
    else { //se llevó más tiempo que la ocasión anterior
      for (i = 0; i < cdctimeR; ++i);
    }
    prodocuR();
  }
*/


//01marzo2022
    function CAD_checkEnter(e) {
            var characterCode
            if (e && e.which) {
                e = e
                characterCode = e.which
            }
            else {
                e = event
                characterCode = e.keyCode
            }
var valueND = document.getElementById('num_doctoR').value;
            if (characterCode == 13 && valueND.length == 10) { //if generated character code is equal to ascii 13 (if enter key)
                doSomething(valueND);
                return false;
            }
            else {
                return true;
            }
        }
//01marzo2022

    function nchst() {
    docaproc = docsaproc[++idocaproc];
    document.getElementById("num_doctoR_ori").value=docaproc.value;
    }

    var docsaproc = null;
    var docaproc = null;
    var ndocaproc = null;
    var idocaproc = -1;

    function tldocus_ori() {
      $.ajax({
              type: "POST",
        
               url: "Conexion/ldocus_ori.php",
              data: {nfj:"nfj"},
           success: function(cbr)
                 {
                    $('#ldocus_ori').html(cbr);
    ndocaproc = document.getElementById("ldocus_ori").options.length;
    alert('se van a procesar ' + ndocaproc + ' documentos originales');

    docsaproc = document.getElementById('ldocus_ori');
                 }
                 });
    }

    var cdstart = new Date().getTime();
    var cdend = new Date().getTime();
    var cdctime = cdend - cdstart;
    var cdltime = 10000;

    function prodocu_ori() {
      nchst();
      cdstart = new Date().getTime();
      //aqui
      if( $('#cbox1').is(':checked') ) {
    //alert('Seleccionado');
    var selected = "activo";
}
      $.ajax({
             async: true,
              type: "POST",
        
               url: "Pdf/CrearPDF/Original1_Masivo.php",
              data: {"num_doctoR_ori":document.getElementById("num_doctoR_ori").value,
                     "Activa_si": document.getElementById("esta_plaza").value,
                     "checkbox_ac": selected
                     /*"Activa_no":document.getElementById("Activa_no").value*/},
           success: function(cbr)
                 {
      cdend = new Date().getTime();
      cdctime = cdend - cdstart;
      if(idocaproc<ndocaproc)
      {
        if(cdctime<cdltime) { //se mejoró el tiempo de procesamiento respecto de la ocasión anterior
          cdltime=cdctime;
        }
      }
                 },
    error : function(xhr, status) {
      cdltime = 10000;
        },
    complete : function(xhr, status) {
      if(idocaproc<ndocaproc)
      {
        prodocu_ori();        
      }
        },
             cache: false
                 });
    }

function activa_boton(id){
  if (id != "") {
  $('#btnGetDaten_ori').removeAttr('disabled');
  }
}
     function modal(){
       $("#exampleModal1").modal('toggle')
        $('.modal-admin2').css('width', '800px');
        //$('.modal-admin2').css('height', '2000px'); 
        $('.modal-admin2').css('margin', '100px  300px'); 
        $('.modal-admin2').modal('show');
     }

window.onload=function() {
       var seleccion2 = document.getElementById("esta_plaza").value;
       //alert(seleccion2);
    if(seleccion2 != ""){
    $('#btnGetDaten_ori').removeAttr('disabled');
    } 
  }

      window.onload=function() {

             $(document).ready(function () {
            $("#num_oficioR").change(function () {
              $("#num_oficioR").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNum_DoctoR/NumOficio_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#rfc_num_doctoR").html(data);
                   });
                });
                 });
               });
             

             $(document).ready(function () {
            $("#rfcR").change(function () {
              $("#rfcR").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNum_DoctoR/RFC_NumDR.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#rfc_num_doctoR").html(data);
                   });
                });
                 });
               });

              /*$(document).ready(function () {
            $("#rfcR").change(function () {
              $("#rfcR").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNomEmpR/RFC_NomEmp_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#nomEmpsR").html(data);
                   });
                });
                 });
               });*/
          
             $(document).ready(function () {
            $("#capturaR").change(function () {
              $("#capturaR").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNum_DoctoR/Captura_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#rfc_num_doctoR").html(data);
                   });
                });
                 });
               });

              $(document).ready(function () {
            $("#fec_capturaR").change(function () {
              $("#fec_capturaR").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNum_DoctoR/Fecha_Captura_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#rfc_num_doctoR").html(data);
                   });
                });
                 });
               });

               $(document).ready(function () {
            $("#fec_cancelacionR").change(function () {
              $("#fec_cancelacionR").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNum_DoctoR/Fecha_Cancelacion_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#rfc_num_doctoR").html(data);
                   });
                });
                 });
               });

  /*       $(document).ready(function(){
           $('#plazaR').val(); 
            $('#plaza2R').val(); 
             $('#plaza3R').val(); 
               $('#plaza4R').val(); 
                 $('#plaza5R').val(); 
                   $('#plaza6R').val(); 
          
          botons();
          

        });
        function botons(){
          var valor1 = $('#plazaR').val(); 
          var valor2 = $('#plaza2R').val(); 
          var valor3 = $('#plaza3R').val(); 
          var valor4 = $('#plaza4R').val(); 
          var valor5 = $('#plaza5R').val(); 
          var valor6 = $('#plaza6R').val(); 
    //var $rfc_num_docto =      
    var $rfc_num_doctoR = $(valor1).val() + $(valor2).val() + $(valor3).val() + $(valor4).val() + $(valor5).val() + $(valor6).val();

        //alert(num_d); 
        setTimeout(function(){
                $.ajax({
                  url: 'Conexion/ObtenerNum_DoctoR/Plaza_NumD.php',
                  type: 'POST',
                  data: {
                    rfc_num_doctoR: $rfc_num_doctoR
                  },
                  success: function(res){
                    //console.log(res);
                    $('#rfc_num_doctoR').html(res);
                    alert("yes");
                    
                  }
                });
        }, 1000);
         //
        }*/


              
                $(document).ready(function () {
                  var valorR1 = $('#plazaR');
                  var valorR2 = $('#plaza2R');
                  var valorR3 = $('#plaza3R');
                  var valorR4 = $('#plaza4R');
                  var valorR5 = $('#plaza5R');
                  var valorR6 = $('#plaza6R');
                  //var plaza = valorR1 , valorR2 , valorR3 , valorR4 , valorR5 , valorR6;

            valorR6.change(function () {
              valorR6.each(function () {
                  rfc_num_doctoR = $(valorR1).val() + $(valorR2).val() + $(valorR3).val() + $(valorR4).val() + $(valorR5).val() + $(valorR6).val();
                $.post("Conexion/ObtenerNum_DoctoR/Plaza_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#rfc_num_doctoR").html(data);
                   });
                });
                 });
               });

                $(document).ready(function () {
            $("#estatusR").change(function () {
              $("#estatusR").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNum_DoctoR/Estatus_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#rfc_num_doctoR").html(data);
                   });
                });
                 });
               });


                $(document).ready(function () {
            $("#relacion2").change(function () {
              $("#relacion2").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNum_DoctoR/Relacion_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#rfc_num_doctoR").html(data);
                   });
                });
                 });
               });


                $(document).ready(function () {
            $("#curpR").change(function () {
              $("#curpR").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNum_DoctoR/CURP_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#rfc_num_doctoR").html(data);
                   });
                });
                 });
               });

             /*   $(document).ready(function () {
            $("#curpR").change(function () {
              $("#curpR").each(function () {
                  rfc_num_doctoR = $(this).val();
                $.post("Conexion/ObtenerNomEmpR/CURP_NomEmp_NumD.php",
                     {
                      rfc_num_doctoR: rfc_num_doctoR
                       }, 
                       function(data){
                        $("#nomEmp3R").html(data);
                   });
                });
                 });
               });*/


             $(document).ready(function () {
            $("#num_oficio1").change(function () {
              $("#num_oficio1").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/NumOficio_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_docto").html(data);
                   });
                });
                 });
               });
             

             $(document).ready(function () {
            $("#rfc1").change(function () {
              $("#rfc1").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/RFC_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_docto").html(data);
                   });
                });
                 });
               });

              $(document).ready(function () {
            $("#rfc1").change(function () {
              $("#rfc1").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNomEmp/RFC_NomEmp_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#nomEmps").html(data);
                   });
                });
                 });
               });

/*-------------------------------------------------------------------------------------------------*/              
       /*       $(document).ready(function () {
            $("#re-num_docto").change(function () {
              $("#re-num_docto").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNomEmp/NumDocto_DatosFup.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#DatosEmps").html(data);
                   });
                });
                 });
               });*/
/*-------------------------------------------------------------------------------------------------*/              
             $(document).ready(function () {
            $("#captura1").change(function () {
              $("#captura1").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Captura_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_docto").html(data);
                   });
                });
                 });
               });

              $(document).ready(function () {
            $("#fec_captura1").change(function () {
              $("#fec_captura1").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Fecha_Captura_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_docto").html(data);
                   });
                });
                 });
               });

               $(document).ready(function () {
            $("#fec_cancelacion1").change(function () {
              $("#fec_cancelacion1").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Fecha_Cancelacion_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_docto").html(data);
                   });
                });
                 });
               });

                 
                
                $(document).ready(function () {
                  var valor1 = $('#plaza1');
                  var valor2 = $('#plaza2');
                  var valor3 = $('#plaza3');
                  var valor4 = $('#plaza4');
                  var valor5 = $('#plaza5');
                  var valor6 = $('#plaza6');
                  var plaza = valor1 , valor2 , valor3 , valor4 , valor5 , valor6;

            valor6.change(function () {
              valor6.each(function () {
                  rfc_num_docto = $(valor1).val() + $(valor2).val() + $(valor3).val() + $(valor4).val() + $(valor5).val() + $(valor6).val();
                $.post("Conexion/ObtenerNum_Docto/Plaza_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_docto").html(data);
                   });
                });
                 });
               });

                $(document).ready(function () {
            $("#estatus1").change(function () {
              $("#estatus1").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Estatus_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_docto").html(data);
                   });
                });
                 });
               });


                $(document).ready(function () {
            $("#relacion2").change(function () {
              $("#relacion2").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Relacion_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_docto").html(data);
                   });
                });
                 });
               });


                $(document).ready(function () {
            $("#curp1").change(function () {
              $("#curp1").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/CURP_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_docto").html(data);
                   });
                });
                 });
               });

                $(document).ready(function () {
            $("#curp1").change(function () {
              $("#curp1").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNomEmp/CURP_NomEmp_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#nomEmp3").html(data);
                   });
                });
                 });
               });





           }           