$(document).ready(function () {
            $("#num_oficio1ma").change(function () {
              $("#num_oficio1ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/NumOficio_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_doctoma").html(data);
                   });
                });
                 });
               });
             

             $(document).ready(function () {
            $("#rfc1ma").change(function () {
              $("#rfc1ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/RFC_Num_M.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_doctoma").html(data);
                   });
                });
                 });
               });

              $(document).ready(function () {
            $("#rfc1ma").change(function () {
              $("#rfc1ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNomEmp/RFC_NomEmp_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#nomEmpsma").html(data);
                   });
                });
                 });
               });

/*-------------------------------------------------------------------------------------------------*/              
       /*       $(document).ready(function () {
            $("#re-num_doctoma").change(function () {
              $("#re-num_doctoma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNomEmp/NumDocto_DatosFup.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#DatosEmpsma").html(data);
                   });
                });
                 });
               });*/
/*-------------------------------------------------------------------------------------------------*/              
             $(document).ready(function () {
            $("#captura1ma").change(function () {
              $("#captura1ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Captura_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_doctoma").html(data);
                   });
                });
                 });
               });

              $(document).ready(function () {
            $("#fec_captura1ma").change(function () {
              $("#fec_captura1ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Fecha_Captura_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_doctoma").html(data);
                   });
                });
                 });
               });

               $(document).ready(function () {
            $("#fec_cancelacion1ma").change(function () {
              $("#fec_cancelacion1ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Fecha_Cancelacion_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_doctoma").html(data);
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
                        $("#rfc_num_doctoma").html(data);
                   });
                });
                 });
               });

                $(document).ready(function () {
            $("#estatus1ma").change(function () {
              $("#estatus1ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Estatus_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_doctoma").html(data);
                   });
                });
                 });
               });


                $(document).ready(function () {
            $("#relacion2ma").change(function () {
              $("#relacion2ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/Relacion_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_doctoma").html(data);
                   });
                });
                 });
               });


                $(document).ready(function () {
            $("#curp1ma").change(function () {
              $("#curp1ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNum_Docto/CURP_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#rfc_num_doctoma").html(data);
                   });
                });
                 });
               });

                $(document).ready(function () {
            $("#curp1ma").change(function () {
              $("#curp1ma").each(function () {
                  rfc_num_docto = $(this).val();
                $.post("Conexion/ObtenerNomEmp/CURP_NomEmp_NumD.php",
                     {
                      rfc_num_docto: rfc_num_docto
                       }, 
                       function(data){
                        $("#nomEmp3ma").html(data);
                   });
                });
                 });
               });