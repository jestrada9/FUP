function clickaction( b, formatoperiodo ){
  if(b.id == "btnGetDataR"){

    var nr = $('#num_doctoRA').val(); 
    var xs1 = $("#rfc_num_doctoR").val();
    var xs2 = $("#num_doctoR").val();


    if(nr!="" ){
      
      var miUrl5 = "docs.php?buscar="+nr+"";
      window.open(miUrl5,"_blank");
      document.getElementById("formulario2").reset();
      $("#num_doctoRA").hide();
       $("#formulario2").find('input:text, select').reset();
       $("#formulario2").find('input:text, select').hide();
      //console.log("Aqui");
    }else{

 
      if(xs1 == null){

      var xs2 = $("#num_doctoR").val();  
      var usu = $("#usuario").val();
      //alert(xs2); 
        document.getElementById("formulario2").reset();
        var miUrl4 = "Pdf/Reimprimir/Reimpresion.php?buscar="+xs2+"&usuario="+usu+"&dia=inactivo";
        window.open(miUrl4,"_blank");
       $("#formulario2").find('input:text, select').reset();
       $("#formulario2").find('input:text, select').hide();
      }else{
        
          // alert(xs3);  
          document.getElementById("formulario2").reset();
          var miUrl4 = "Pdf/Reimprimir/Reimpresion.php?buscar="+xs1+"&usuario="+usu+"&dia=inactivo";
        window.open(miUrl4,"_blank"); 
               $("#formulario2").find('input:text, select').reset();
       $("#formulario2").find('input:text, select').hide();
      }
  }

  }

  if(b.id == "btnGetData2"){
    var usu = $("#usuario").val();
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
}   
