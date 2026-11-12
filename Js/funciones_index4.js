function clickaction( b, formatoperiodo ){
    var usu = $("#usuario").val();


    if(b.id == "btnGetDataR"){

        var xs1 = $("#rfc_num_doctoR").val();
        var xs2 = $("#num_doctoR").val();

        if(xs1 == null){

          var xs2 = $("#num_doctoR").val();  
          document.getElementById("formulario3").reset();
          //var miUrl4 = "../Pdf/Reimprimir/crearPDF_rOriginal.php?buscar="+xs2+"&usuario="+usu+"&dia=inactivo"+"&rO=activo";
          var miUrl4 = "../pantallas/editar_fup.php?buscar="+xs2+"&usuario="+usu+"&rO=activo";
          window.open(miUrl4,"_blank");
          $("#formulario3").find('input:text, select').reset();
          $("#formulario3").find('input:text, select').hide();
        }else{
          document.getElementById("formulario3").reset();
          //var miUrl4 = "../Pdf/Reimprimir/crearPDF_rOriginal.php?buscar="+xs1+"&usuario="+usu+"&dia=inactivo"+"&rO=activo";
          var miUrl4 = "../pantallas/editar_fup.php?buscar="+xs2+"&usuario="+usu+"&rO=activo";
          window.open(miUrl4,"_blank"); 
          $("#formulario3").find('input:text, select').reset();
          $("#formulario3").find('input:text, select').hide();
        }
    }
}   