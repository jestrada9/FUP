
  $( function() {
    $( "#dialog-confirm2" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Si": function() {
          $( this ).dialog( "close" ); 

        
        //console.log(dataString);
        $.ajax({
            type: "POST",
            url: "process.php",
            data: dataString,
            success: function(response) {     
               //console.log("logrado");
              
              window.open(miUrls,"_blank");
              //window.location=locacion;
              $("#form").submit();
            }
        }); 
              


        },
        Cancelar: function() {
          $( this ).dialog( "close" );
          //window.location=locacion;
          $("#form").submit();
        }
      }
    });
  } );
  