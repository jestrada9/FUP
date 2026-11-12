function clickaction( b, formatoperiodo ){
   var usu = $("#usuario").val();


  if(b.id == "btnGetDataR"){

    var nr = $('#num_doctoRA').val(); 
    var xs1 = $("#rfc_num_doctoR").val();
    var xs2 = $("#num_doctoR").val();
    console.log(nr);
    console.log(xs1);
    console.log(xs2);

    if(nr!=""){
      
      var miUrl5 = "docs.php?buscar="+nr+"";
      window.open(miUrl5,"_blank");
      document.getElementById("formulario2").reset();
      $("#num_doctoRA").hide();
       $("#formulario2").find('input:text, select').reset();
       $("#formulario2").find('input:text, select').hide();
      //console.log("Aqui");
    }else{

    if(nr != "" || xs1 != null || xs2 !=""){
      if(xs1 == null && xs2 !=""){

      var xs2 = $("#num_doctoR").val();  
      
        document.getElementById("formulario2").reset();
        var miUrl4 = "Pdf/Reimprimir/Reimpresion.php?buscar="+xs2+"&usuario="+usu+"&dia=inactivo";
        window.open(miUrl4,"_blank");
        //$("#formulario2").find('input:text, select').reset();
        //$("#formulario2").find('input:text, select').hide();
        console.log("num_doctoR"+usu);
      }else{
      
        document.getElementById("formulario2").reset();
        var miUrl4 = "Pdf/Reimprimir/Reimpresion.php?buscar="+xs1+"&usuario="+usu+"&dia=inactivo";
        window.open(miUrl4,"_blank"); 
        //$("#formulario2").find('input:text, select').reset();
        //$("#formulario2").find('input:text, select').hide();
        console.log("num_doctoR"+usu);
      }
    }
  }

  }

  if(b.id == "btnGetData2"){
    var xs1 = $("#rfc_num_doctoR").val(); 
      if(xs1 == null && xs2 !=""){
    var xs2 = $("#num_doctoR").val();  
      //document.getElementById("formulario2").reset();
      var miUrl4 = "Pdf/Reimprimir/Reimpresion.php?buscar="+xs2+"&usuario="+usu+"&dia=activo";
      window.open(miUrl4,"_blank");
      //$("#formulario2").find('input:text, select').reset();
      //$("#formulario2").find('input:text, select').hide();
    }else{
      var xs3 = $("#rfc_num_doctoR").val();
      //document.getElementById("formulario2").reset();
      //var miUrl4 = "Pdf/Reimprimir/Reimpresion.php?buscar="+xs3+"&usuario="+usu+"&dia=activo";
      window.open(miUrl4,"_blank");
      //$("#formulario2").find('input:text, select').reset();
      //$("#formulario2").find('input:text, select').hide();
    }

    }  
}   
