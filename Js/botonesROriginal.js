function clickaction( b, formatoperiodo ){
   var usu = $("#usuario").val();


  if(b.id == "btnGetDataR"){

    var nr = $('#num_doctoR_A').val(); 
    var xs1 = $("#rfc_num_doctoRs").val();
    var xs2 = $("#num_doctoR_").val();


    if(nr!="" ){
      
      var miUrl5 = "../docs.php?buscar="+nr+"";
      window.open(miUrl5,"_blank");
      document.getElementById("formulario3").reset();
      $("#num_doctoRA").hide();
       $("#formulario3").find('input:text, select').reset();
       $("#formulario3").find('input:text, select').hide();
      //console.log("Aqui");
    }else{

 
      if(xs1 == null){

      var xs2 = $("#num_doctoR").val();  
      //alert(xs2); 
        var miUrl4 = "../Pdf/Reimprimir/crearPDF_rOriginal.php?buscar="+xs2+"&usuario="+usu+"&dia=inactivo";
        window.open(miUrl4,"_blank");
      }else{
          // alert(xs3);  
        var miUrl4 = "../Pdf/Reimprimir/crearPDF_rOriginal.php?buscar="+xs1+"&usuario="+usu+"&dia=inactivo";
        window.open(miUrl4,"_blank"); 
      }
  }

  }
/*
  if(b.id == "btnGetData2"){
    var xs1 = $("#rfc_num_doctoR").val(); 
      if(xs1 == null){
    var xs2 = $("#num_doctoR").val();  
    //alert(xs2); 
    document.getElementById("formulario2").reset();
      var miUrl4 = "Pdf/Reimprimir/Reimpresion.php?buscar="+xs2+"&usuario="+usu+"&dia=activo";
      window.open(miUrl4,"_blank");
             $("#formulario2").find('input:text, select').reset();
       $("#formulario2").find('input:text, select').hide();
    }else{
      var xs3 = $("#rfc_num_doctoR").val();
      //alert(xs3); 
      document.getElementById("formulario2").reset();
     var miUrl4 = "Pdf/Reimprimir/Reimpresion.php?buscar="+xs3+"&usuario="+usu+"&dia=activo";
      window.open(miUrl4,"_blank");
             $("#formulario2").find('input:text, select').reset();
       $("#formulario2").find('input:text, select').hide();
    }

    }  
    */
}   
