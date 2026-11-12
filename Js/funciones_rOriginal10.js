function clickaction( b, formatoperiodo ){//clickaction
    var usu = $("#usuario").val();


    if(b.id == "btnGetDataR"){//btnGetDataR

        var xs1 = $("#rfc_num_doctoR").val();
        var xs2 = $("#num_doctoR").val();

        if( (xs1 == "" || xs1 == null) && xs2 == ""){//xs_xs2

          }else{

            if(xs1 == null || xs1 == ""){

            var xs2 = $("#num_doctoR").val();  

            $.ajax({
                url: '../pantallas/checar.php',
                type: 'POST',
                data: {
                  docto: xs2
                },
                success: function(result){
                  var trimStr = $.trim(result);
                  if(trimStr=='pasar'){  
                    //if(result!="" && result!="'pasar'"){
                    
                    document.getElementById("formulario3").reset();
                    //var miUrl4 = "../Pdf/Reimprimir/crearPDF_rOriginal.php?buscar="+xs2+"&usuario="+usu+"&dia=inactivo"+"&rO=activo";
                    var miUrl4 = "../pantallas/editar_fup.php?buscar="+xs2+"&usuario="+usu+"&rO=activo";
                    window.open(miUrl4,"_blank");
                    $('#labelR').hide();
                    $('#rfc_num_doctoR').hide();
                    $('#rfcR').hide();
                    $('#rfcR').val("");
                    $("#formulario3").find('input:text, select').reset();
                    $("#formulario3").find('input:text, select').hide();                            
                  }else{
                      alert(result);
                  }
                  
                }
              });  

          }else{
              $.ajax({
                url: '../pantallas/checar.php',
                type: 'POST',
                data: {
                  docto: xs1
                },
                success: function(result){
                  console.log(result);
                  console.log($.trim(result));
                  var trimStr = $.trim(result);
                  if(trimStr=='pasar'){  
                    
                    document.getElementById("formulario3").reset();
                    //var miUrl4 = "../Pdf/Reimprimir/crearPDF_rOriginal.php?buscar="+xs1+"&usuario="+usu+"&dia=inactivo"+"&rO=activo";
                    var miUrl4 = "../pantallas/editar_fup.php?buscar="+xs1+"&usuario="+usu+"&rO=activo";
                    window.open(miUrl4,"_blank"); 
                    $('#labelR').hide();
                    $('#rfc_num_doctoR').hide();
                    $('#rfcR').hide();
                    $('#rfcR').val("");
                    $("#formulario3").find('input:text, select').reset();
                    $("#formulario3").find('input:text, select').hide();                      
                  }else{
                    alert(result);
                  }
                  
                }
              }); 

          }
      }//xs_xs2
    }//btnGetDataR
}//clickaction   