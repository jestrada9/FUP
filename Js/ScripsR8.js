function mostrarR_(id) {
      if (id == "num_oficioR_") {
        $("#num_oficioR").show();
        $('#num_oficioR').removeAttr('disabled');
        $('#num_oficioR').focus();
        $("#num_doctoR").hide();
        $("#num_doctoRA").hide();
        $("#rfcR").hide();
        $("#masivo").hide();
        $("#capturaR").hide();
        $("#fec_capturaR").hide();
        $("#fec_cancelacionR").hide();
        $("#estatusR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#relacionR").hide();
        $("#curpR").hide();
        $("#num_doctoR").attr('disabled','disabled');
        $("#rfcR").attr('disabled','disabled');         
        $("#capturaR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#fec_cancelacionR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        $("#labelR").show();
        $('#labelR').removeAttr('disabled');
        $("#rfc_num_doctoR").show();
        $('#rfc_num_doctoR').removeAttr('disabled');

      }

      if (id != "num_oficioR_") {
        $('#num_oficioR').blur();
        $('#num_oficioR').val("");
        $("#num_oficioR").hide();
        $('#num_oficioR').attr('disabled','disabled');
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
        }
      
      if (id == "num_doctoR_") {
        $("#num_doctoR").show();
        $('#num_doctoR').removeAttr('disabled');
        $('#num_doctoR').focus();
        $("#masivo").show();
        $("#num_oficioR").hide();
        $("#rfcR").hide();
        $("#capturaR").hide();
        $("#fec_capturaR").hide();
        $("#fec_cancelacionR").hide();
        $("#estatusR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#relacionR").hide();
        $("#curpR").hide();
        $("#num_oficioR").attr('disabled','disabled');
        $("#rfcR").attr('disabled','disabled');         
        $("#capturaR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#fec_cancelacionR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        $("#labelR").hide();
        $('#labelR').attr('disabled','disabled');
        $("#rfc_num_doctoR").hide();
        $('#rfc_num_doctoR').attr('disabled','disabled');
      }
      if (id != "num_doctoR_") {
        $('#num_doctoR').blur();
        $('#num_doctoR').val("");
        $("#num_doctoR").hide();
        //$("#masivo").hide();
        $('#num_doctoR').attr('disabled','disabled');
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
        
      }
      
if (id == "num_doctoR_A") {
        $("#num_doctoRA").show();
        $('#num_doctoRA').removeAttr('disabled');
        $('#num_doctoRA').focus();
        $("#num_oficioR").hide();
        $("#masivo").show();
        $("#rfcR").hide();
        $("#capturaR").hide();
        $("#fec_capturaR").hide();
        $("#fec_cancelacionR").hide();
        $("#estatusR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#relacionR").hide();
        $("#curpR").hide();
        $("#num_oficioR").attr('disabled','disabled');
        $("#rfcR").attr('disabled','disabled');         
        $("#capturaR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#fec_cancelacionR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        $("#labelR").hide();
        $('#labelR').attr('disabled','disabled');
        $("#rfc_num_doctoR").hide();
        $('#rfc_num_doctoR').attr('disabled','disabled');
      }
      if (id != "num_doctoR_A") {
        $('#num_doctoRA').blur();
        $('#num_doctoRA').val("");
        $("#num_doctoRA").hide();
        //$("#masivo").hide();
        $('#num_doctoRA').attr('disabled','disabled');
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
        
      }      
      if (id == "rfcR_") {
        $("#rfcR").show();
        $('#rfcR').removeAttr('disabled');
        $('#rfcR').focus();
        $("#masivo").hide();
        /*$("#nomEmp1R").show();
        $('#nomEmp1R').removeAttr('disabled');*/
        $('#nomEmpsR').show();
        $("#labelR").show();
        $('#labelR').removeAttr('disabled');
        $("#rfc_num_doctoR").show();
        $('#rfc_num_doctoR').removeAttr('disabled');
        $('#rfc_num_doctoR').removeAttr('selected');
        $("#num_oficioR").hide();
        $("#num_doctoR").hide();
        $("#num_doctoRA").hide();
        $("#capturaR").hide();
        $("#fec_capturaR").hide();
        $("#fec_cancelacionR").hide();
        $("#estatusR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#curpR").hide();
        $("#relacionR").hide();
        $("#num_oficioR").attr('disabled','disabled');
        $("#num_doctoR").attr('disabled','disabled');         
        $("#capturaR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#fec_cancelacionR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        
        
        
        
        
      }
      if (id != "rfcR_") {
        $('#rfcR').blur();
        $("#rfcR").hide();
        $('#rfcR').attr('disabled','disabled');
        $('#rfcR').val("");
        $('#nomEmp1R').hide();
        $('#nomEmp1R').val("");
        $('#nomEmp1R').attr('disabled','disabled');
        $('#nomEmpsR').hide();
        /*$('#nomEmp').empty();    
        $('#nomEmp').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#nomEmp').change();*/
        //$('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>').hide().show(); 
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
        
      }

      if (id == "capturaR_") {
        $("#capturaR").show();
        $('#capturaR').removeAttr('disabled');
        $('#capturaR').focus();
        $("#num_oficioR").hide();
        $("#num_doctoR").hide();
        $("#num_doctoRA").hide();
        $("#masivo").hide();
        $("#rfcR").hide();
        $("#fec_capturaR").hide();
        $("#fec_cancelacionR").hide();
        $("#estatusR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#curpR").hide();
        $("#relacionR").hide();
        $("#num_oficioR").attr('disabled','disabled');
        $("#num_doctoR").attr('disabled','disabled');         
        $("#rfcR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#fec_cancelacionR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        $("#labelR").show();
        $('#labelR').removeAttr('disabled');
        $("#rfc_num_doctoR").show();
        $('#rfc_num_doctoR').removeAttr('disabled');
        
      }
      if (id != "capturaR_") {
        $('#capturaR').blur();
        $('#capturaR').val("");
        $("#capturaR").hide();
        $('#capturaR').attr('disabled','disabled');
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
      }
      
      if (id == "fecha_capturaR_") {
        $("#fec_capturaR").show();
        $('#fec_capturaR').removeAttr('disabled');
        $('#fec_capturaR').focus();
        $("#num_oficioR").hide();
        $("#num_doctoR").hide();
        $("#num_doctoRA").hide();
        $("#rfcR").hide();
        $("#masivo").hide();
        $("#capturaR").hide();
        $("#fec_cancelacionR").hide();
        $("#estatusR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#curpR").hide();
        $("#relacionR").hide();
        $("#num_oficioR").attr('disabled','disabled');   
        $("#num_doctoR").attr('disabled','disabled');         
        $("#rfcR").attr('disabled','disabled');
        $("#capturaR").attr('disabled','disabled');
        $("#fec_cancelacionR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        $("#labelR").show();
        $('#labelR').removeAttr('disabled');
        $("#rfc_num_doctoR").show();
        $('#rfc_num_doctoR').removeAttr('disabled');
        
      }
      if (id != "fecha_capturaR_") {
        $('#fec_capturaR').blur();
        $('#fec_capturaR').val("");
        $("#fec_capturaR").hide();
        $('#fec_capturaR').attr('disabled','disabled');
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
      }

      if (id == "fecha_cancelacionR_") {
        $("#fec_cancelacionR").show();
        $('#fec_cancelacionR').removeAttr('disabled');
        $('#fec_cancelacionR').focus();
        $("#num_oficioR").hide();
        $("#num_doctoR").hide();
        $("#num_doctoRA").hide();
        $("#rfcR").hide();
        $("#masivo").hide();
        $("#capturaR").hide();
        $("#fec_capturaR").hide();
        $("#estatusR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#curpR").hide();
        $("#relacionR").hide();
        $("#num_oficioR").attr('disabled','disabled');
        $("#num_doctoR").attr('disabled','disabled');         
        $("#rfcR").attr('disabled','disabled');
        $("#capturaR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        $("#labelR").show();
        $('#labelR').removeAttr('disabled');
        $("#rfc_num_doctoR").show();
        $('#rfc_num_doctoR').removeAttr('disabled');
        
      }
      if (id != "fecha_cancelacionR_") {
        $('#fec_cancelacionR').blur();
        $('#fec_cancelacionR').val("");
        $("#fec_cancelacionR").hide();
        $('#fec_cancelacionR').attr('disabled','disabled');
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
      }

      if (id == "plazasR_") {
        $("#plazaR").show();
        $("#plaza2R").show();
        $("#plaza3R").show();
        $("#plaza4R").show();
        $("#plaza5R").show();
        $("#plaza6R").show();
        $("#plazaR").removeAttr('disabled');
        $("#plaza2R").removeAttr('disabled');
        $("#plaza3R").removeAttr('disabled');
        $("#plaza4R").removeAttr('disabled');
        $("#plaza5R").removeAttr('disabled');
        $("#plaza6R").removeAttr('disabled');
        $('#plaza').focus();
        $("#masivo").hide();
        $("#fec_cancelacionR").attr('disabled','disabled');
        $('#fec_cancelacionR').hide();
        $("#num_oficioR").hide();
        $("#num_doctoR").hide();
        $("#num_doctoRA").hide();
        $("#rfcR").hide();
        $("#capturaR").hide();
        $("#fec_capturaR").hide();
        $("#estatusR").hide();
        $("#curpR").hide();
        $("#relacionR").hide();
        $("#num_oficioR").attr('disabled','disabled');   
        $("#num_doctoR").attr('disabled','disabled');         
        $("#rfcR").attr('disabled','disabled');
        $("#capturaR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        $("#labelR").show();
        $('#labelR').removeAttr('disabled');
        $("#rfc_num_doctoR").show();
        $('#rfc_num_doctoR').removeAttr('disabled');
        
      }
      if (id != "plazasR_") {
        $('#plaza').blur();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
         $("#plazaR").val("");
        $("#plaza2R").val("");
        $("#plaza3R").val("");
        $("#plaza4R").val("");
        $("#plaza5R").val("");
        $("#plaza6R").val("");
        $('#plaza').attr('disabled','disabled');
        $('#plaza2R').attr('disabled','disabled');
        $('#plaza3R').attr('disabled','disabled');
        $('#plaza4R').attr('disabled','disabled');
        $('#plaza5R').attr('disabled','disabled');
        $('#plaza6R').attr('disabled','disabled');
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
      }

      if (id == "estatusR_") {
        $("#estatusR").show();
        $('#estatusR').removeAttr('disabled');
        $('#estatusR').focus()
        $("#masivo").hide();;
        $("#num_oficioR").hide();
        $("#num_doctoR").hide();
        $("#num_doctoRA").hide();
        $("#rfcR").hide();
        $("#capturaR").hide();
        $("#fec_capturaR").hide();
        $("#fec_cancelacionR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#curpR").hide();
        $("#relacionR").hide();
        $("#num_oficioR").attr('disabled','disabled');   
        $("#num_doctoR").attr('disabled','disabled');         
        $("#rfcR").attr('disabled','disabled');
        $("#capturaR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#fec_cancelacionR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        $("#labelR").show();
        $('#labelR').removeAttr('disabled');
        $("#rfc_num_doctoR").show();
        $('#rfc_num_doctoR').removeAttr('disabled');
      }
      if (id != "estatusR_") {
        $('#estatusR').blur();
        $('#estatusR').val("");
        $("#estatusR").hide();
        $('#estatusR').attr('disabled','disabled');
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
      }

      if (id == "relacion_oficioR_") {
        $("#relacionR").show();
        $('#relacionR').removeAttr('disabled');
        $('#relacionR').focus();
        $("#num_oficioR").hide();
        $("#num_doctoR").hide();
        $("#num_doctoRA").hide();
        $("#rfcR").hide();
        $("#masivo").hide();
        $("#capturaR").hide();
        $("#fec_capturaR").hide();
        $("#fec_cancelacionR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#curpR").hide();
        $("#estatusR").hide();
        $("#num_oficioR").attr('disabled','disabled');   
        $("#num_doctoR").attr('disabled','disabled');         
        $("#rfcR").attr('disabled','disabled');
        $("#capturaR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#fec_cancelacionR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#curpR").attr('disabled','disabled');

        $("#labelR").show();
        $('#labelR').removeAttr('disabled');
        $("#rfc_num_doctoR").show();
        $('#rfc_num_doctoR').removeAttr('disabled');
        
      }
      if (id != "relacion_oficioR_") {
        $('#relacionR').blur();
        $('#relacionR').val("");
        $("#relacionR").hide();
        $('#relacionR').attr('disabled','disabled');
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
      }

      if (id == "curpR_") {
        //$("#nomEmp4").show();
        $("#curpR").show();
        $('#curpR').removeAttr('disabled');
        $('#curpR').focus();
        $("#num_oficioR").hide();
        $("#num_doctoR").hide();
        $("#num_doctoRA").hide();
        $("#rfcR").hide();
        $("#masivo").hide();
        $("#capturaR").hide();
        $("#fec_capturaR").hide();
        $("#fec_cancelacionR").hide();
        $("#plazaR").hide();
        $("#plaza2R").hide();
        $("#plaza3R").hide();
        $("#plaza4R").hide();
        $("#plaza5R").hide();
        $("#plaza6R").hide();
        $("#relacionR").hide();
        $("#estatusR").hide();
        $("#num_oficioR").attr('disabled','disabled');   
        $("#num_doctoR").attr('disabled','disabled');         
        $("#rfcR").attr('disabled','disabled');
        $("#capturaR").attr('disabled','disabled');
        $("#fec_capturaR").attr('disabled','disabled');
        $("#fec_cancelacionR").attr('disabled','disabled');
        $("#plazaR").attr('disabled','disabled');
        $("#plaza2R").attr('disabled','disabled');
        $("#plaza3R").attr('disabled','disabled');
        $("#plaza4R").attr('disabled','disabled');
        $("#plaza5R").attr('disabled','disabled');
        $("#plaza6R").attr('disabled','disabled');
        $("#estatusR").attr('disabled','disabled');
        $("#relacionR").attr('disabled','disabled');

        $("#labelR").show();
        $('#labelR').removeAttr('disabled');
        $("#rfc_num_doctoR").show();
        $('#rfc_num_doctoR').removeAttr('disabled');
        
      }
      if (id != "curpR_") {
        $('#curpR').blur();
        $('#curpR').val("");
        $('#curpR').hide();
        $('#curpR').attr('disabled','disabled');
        $('#nomEmp4R').hide();
        //$('#nomEmp4').empty();
        $('#rfc_num_doctoR').empty();    
        $('#rfc_num_doctoR').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoR').change();
      }

           
}