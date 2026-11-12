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

        