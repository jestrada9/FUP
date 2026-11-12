function mostrarSma(id) {
      if (id == "num_oficioma") {
        $("#num_oficio1ma").show();
        $('#num_oficio1ma').removeAttr('disabled');
        $('#num_oficio1ma').focus();
        $("#num_docto1ma").hide();
        $("#rfc1ma").hide();
        $("#captura1ma").hide();
        $("#fec_captura1ma").hide();
        $("#fec_cancelacion1ma").hide();
        $("#estatus1ma").hide();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
        $("#relacion2ma").hide();
        $("#curp1ma").hide();
        $("#num_docto1ma").attr('disabled','disabled');
        $("#rfc1ma").attr('disabled','disabled');         
        $("#captura1ma").attr('disabled','disabled');
        $("#fec_captura1ma").attr('disabled','disabled');
        $("#fec_cancelacion1ma").attr('disabled','disabled');
        $("#plaza1ma").attr('disabled','disabled');
        $("#plaza2ma").attr('disabled','disabled');
        $("#plaza3ma").attr('disabled','disabled');
        $("#plaza4ma").attr('disabled','disabled');
        $("#plaza5ma").attr('disabled','disabled');
        $("#plaza6ma").attr('disabled','disabled');
        $("#estatus1ma").attr('disabled','disabled');
        $("#relacion2ma").attr('disabled','disabled');
        $("#curp1ma").attr('disabled','disabled');

        $("#labelma").show();
        $('#labelma').removeAttr('disabled');
        $("#rfc_num_doctoma").show();
        $('#rfc_num_doctoma').removeAttr('disabled');

      }

      if (id != "num_oficioma") {
        $('#num_oficio1ma').blur();
        $('#num_oficio1ma').val("");
        $("#num_oficio1ma").hide();
        $('#num_oficio1ma').attr('disabled','disabled');
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
        }
      
      if (id == "num_doctoma") {
        $("#num_docto1ma").show();
        $('#num_docto1ma').removeAttr('disabled');
        $('#num_docto1ma').focus();
        $("#btnGetDaten_ori2ma").show();
        $('#btnGetDaten_ori2ma').removeAttr('disabled');        
        $("#mfupma").show();
        $('#mfupma').removeAttr('disabled');
        $("#num_oficio1ma").hide();
        $("#rfc1ma").hide();
        $("#captura1ma").hide();
        $("#fec_captura1ma").hide();
        $("#fec_cancelacion1ma").hide();
        $("#estatus1ma").hide();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
        $("#relacion2ma").hide();
        $("#curp1ma").hide();
        $("#num_oficio1ma").attr('disabled','disabled');
        $("#rfc1ma").attr('disabled','disabled');         
        $("#captura1ma").attr('disabled','disabled');
        $("#fec_captura1ma").attr('disabled','disabled');
        $("#fec_cancelacion1ma").attr('disabled','disabled');
        $("#plaza1ma").attr('disabled','disabled');
        $("#plaza2ma").attr('disabled','disabled');
        $("#plaza3ma").attr('disabled','disabled');
        $("#plaza4ma").attr('disabled','disabled');
        $("#plaza5ma").attr('disabled','disabled');
        $("#plaza6ma").attr('disabled','disabled');
        $("#estatus1ma").attr('disabled','disabled');
        $("#relacion2ma").attr('disabled','disabled');
        $("#curp1ma").attr('disabled','disabled');

        $("#labelma").hide();
        $('#labelma').attr('disabled','disabled');
        $("#rfc_num_doctoma").hide();
        $('#rfc_num_doctoma').attr('disabled','disabled');
      }
      if (id != "num_doctoma") {
        $('#num_docto1ma').blur();
        $('#num_docto1ma').val("");
        $("#num_docto1ma").hide();
        $("#btnGetDaten_ori2ma").hide();
        $('#btnGetDaten_ori2ma').attr('disabled');            
        $("#mfupma").hide();
        $('#num_docto1ma').attr('disabled','disabled');
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
        
      }
      
      if (id == "rfcma") {
        $("#rfc1ma").show();
        $('#rfc1ma').removeAttr('disabled');
        $('#rfc1ma').focus();
        //$("#nomEmp1ma").show();
        //$('#nomEmp1ma').removeAttr('disabled');
        $("#labelma").show();
        $('#labelma').removeAttr('disabled');
        $("#rfc_num_doctoma").show();
        $('#rfc_num_doctoma').removeAttr('disabled');
        $("#num_oficio1ma").hide();
        $("#num_docto1ma").hide();
        $("#captura1ma").hide();
        $("#fec_captura1ma").hide();
        $("#fec_cancelacion1ma").hide();
        $("#estatus1ma").hide();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
        $("#curp1ma").hide();
        $("#relacion2ma").hide();
        $("#num_oficio1ma").attr('disabled','disabled');
        $("#num_docto1ma").attr('disabled','disabled');         
        $("#captura1ma").attr('disabled','disabled');
        $("#fec_captura1ma").attr('disabled','disabled');
        $("#fec_cancelacion1ma").attr('disabled','disabled');
        $("#plaza1ma").attr('disabled','disabled');
        $("#plaza2ma").attr('disabled','disabled');
        $("#plaza3ma").attr('disabled','disabled');
        $("#plaza4ma").attr('disabled','disabled');
        $("#plaza5ma").attr('disabled','disabled');
        $("#plaza6ma").attr('disabled','disabled');
        $("#estatus1ma").attr('disabled','disabled');
        $("#relacion2ma").attr('disabled','disabled');
        $("#curp1ma").attr('disabled','disabled');

        
        
        
        
        
      }
      if (id != "rfcma") {
        $('#rfc1ma').blur();
        $("#rfc1ma").hide();
        $('#rfc1ma').attr('disabled','disabled');
        $('#rfc1ma').val("");
        $("#nomEmp1ma").hide();
        $('#nomEmp1ma').attr('disabled','disabled');
        /*$('#nomEmp').empty();    
        $('#nomEmp').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#nomEmp').change();*/
        //$('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>').hide().show(); 
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
        
      }

      if (id == "capturama") {
        $("#captura1ma").show();
        $('#captura1ma').removeAttr('disabled');
        $('#captura1ma').focus();
        $("#num_oficio1ma").hide();
        $("#num_docto1ma").hide();
        $("#rfc1ma").hide();
        $("#fec_captura1ma").hide();
        $("#fec_cancelacion1ma").hide();
        $("#estatus1ma").hide();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
        $("#curp1ma").hide();
        $("#relacion2ma").hide();
        $("#num_oficio1ma").attr('disabled','disabled');
        $("#num_docto1ma").attr('disabled','disabled');         
        $("#rfc1ma").attr('disabled','disabled');
        $("#fec_captura1ma").attr('disabled','disabled');
        $("#fec_cancelacion1ma").attr('disabled','disabled');
        $("#plaza1ma").attr('disabled','disabled');
        $("#plaza2ma").attr('disabled','disabled');
        $("#plaza3ma").attr('disabled','disabled');
        $("#plaza4ma").attr('disabled','disabled');
        $("#plaza5ma").attr('disabled','disabled');
        $("#plaza6ma").attr('disabled','disabled');
        $("#estatus1ma").attr('disabled','disabled');
        $("#relacion2ma").attr('disabled','disabled');
        $("#curp1ma").attr('disabled','disabled');

        $("#labelma").show();
        $('#labelma').removeAttr('disabled');
        $("#rfc_num_doctoma").show();
        $('#rfc_num_doctoma').removeAttr('disabled');
        
      }
      if (id != "capturama") {
        $('#captura1ma').blur();
        $('#captura1ma').val("");
        $("#captura1ma").hide();
        $('#captura1ma').attr('disabled','disabled');
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
      }
      
      if (id == "fecha_capturama") {
        $("#fec_captura1ma").show();
        $('#fec_captura1ma').removeAttr('disabled');
        $('#fec_captura1ma').focus();
        $("#num_oficio1ma").hide();
        $("#num_docto1ma").hide();
        $("#rfc1ma").hide();
        $("#captura1ma").hide();
        $("#fec_cancelacion1ma").hide();
        $("#estatus1ma").hide();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
        $("#curp1ma").hide();
        $("#relacion2ma").hide();
        $("#num_oficio1ma").attr('disabled','disabled');   
        $("#num_docto1ma").attr('disabled','disabled');         
        $("#rfc1ma").attr('disabled','disabled');
        $("#captura1ma").attr('disabled','disabled');
        $("#fec_cancelacion1ma").attr('disabled','disabled');
        $("#plaza1ma").attr('disabled','disabled');
        $("#plaza2ma").attr('disabled','disabled');
        $("#plaza3ma").attr('disabled','disabled');
        $("#plaza4ma").attr('disabled','disabled');
        $("#plaza5ma").attr('disabled','disabled');
        $("#plaza6ma").attr('disabled','disabled');
        $("#estatus1ma").attr('disabled','disabled');
        $("#relacion2ma").attr('disabled','disabled');
        $("#curp1ma").attr('disabled','disabled');

        $("#labelma").show();
        $('#labelma').removeAttr('disabled');
        $("#rfc_num_doctoma").show();
        $('#rfc_num_doctoma').removeAttr('disabled');
        
      }
      if (id != "fecha_capturama") {
        $('#fec_captura1ma').blur();
        $('#fec_captura1ma').val("");
        $("#fec_captura1ma").hide();
        $('#fec_captura1ma').attr('disabled','disabled');
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
      }

      if (id == "fecha_cancelacionma") {
        $("#fec_cancelacion1ma").show();
        $('#fec_cancelacion1ma').removeAttr('disabled');
        $('#fec_cancelacion1ma').focus();
        $("#num_oficio1ma").hide();
        $("#num_docto1ma").hide();
        $("#rfc1ma").hide();
        $("#captura1ma").hide();
        $("#fec_captura1ma").hide();
        $("#estatus1ma").hide();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
        $("#curp1ma").hide();
        $("#relacion2ma").hide();
        $("#num_oficio1ma").attr('disabled','disabled');
        $("#num_docto1ma").attr('disabled','disabled');         
        $("#rfc1ma").attr('disabled','disabled');
        $("#captura1ma").attr('disabled','disabled');
        $("#fec_captura1ma").attr('disabled','disabled');
        $("#plaza1ma").attr('disabled','disabled');
        $("#plaza2ma").attr('disabled','disabled');
        $("#plaza3ma").attr('disabled','disabled');
        $("#plaza4ma").attr('disabled','disabled');
        $("#plaza5ma").attr('disabled','disabled');
        $("#plaza6ma").attr('disabled','disabled');
        $("#estatus1ma").attr('disabled','disabled');
        $("#relacion2ma").attr('disabled','disabled');
        $("#curp1ma").attr('disabled','disabled');

        $("#labelma").show();
        $('#labelma').removeAttr('disabled');
        $("#rfc_num_doctoma").show();
        $('#rfc_num_doctoma').removeAttr('disabled');
        
      }
      if (id != "fecha_cancelacionma") {
        $('#fec_cancelacion1ma').blur();
        $('#fec_cancelacion1ma').val("");
        $("#fec_cancelacion1ma").hide();
        $('#fec_cancelacion1ma').attr('disabled','disabled');
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
      }

      if (id == "plazasma") {
        $("#plaza1ma").show();
        $("#plaza2ma").show();
        $("#plaza3ma").show();
        $("#plaza4ma").show();
        $("#plaza5ma").show();
        $("#plaza6ma").show();
        $("#plaza1ma").removeAttr('disabled');
        $("#plaza2ma").removeAttr('disabled');
        $("#plaza3ma").removeAttr('disabled');
        $("#plaza4ma").removeAttr('disabled');
        $("#plaza5ma").removeAttr('disabled');
        $("#plaza6ma").removeAttr('disabled');
        $('#plaza1ma').focus();
        $("#fec_cancelacion1ma").attr('disabled','disabled');
        $('#fec_cancelacion1ma').hide();
        $("#num_oficio1ma").hide();
        $("#num_docto1ma").hide();
        $("#rfc1ma").hide();
        $("#captura1ma").hide();
        $("#fec_captura1ma").hide();
        $("#estatus1ma").hide();
        $("#curp1ma").hide();
        $("#relacion2ma").hide();
        $("#num_oficio1ma").attr('disabled','disabled');   
        $("#num_docto1ma").attr('disabled','disabled');         
        $("#rfc1ma").attr('disabled','disabled');
        $("#captura1ma").attr('disabled','disabled');
        $("#fec_captura1ma").attr('disabled','disabled');
        $("#estatus1ma").attr('disabled','disabled');
        $("#relacion2ma").attr('disabled','disabled');
        $("#curp1ma").attr('disabled','disabled');

        $("#labelma").show();
        $('#labelma').removeAttr('disabled');
        $("#rfc_num_doctoma").show();
        $('#rfc_num_doctoma').removeAttr('disabled');
        
      }
      if (id != "plazasma") {
        $('#plaza1ma').blur();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
         $("#plaza1ma").val("");
        $("#plaza2ma").val("");
        $("#plaza3ma").val("");
        $("#plaza4ma").val("");
        $("#plaza5ma").val("");
        $("#plaza6ma").val("");
        $('#plaza1ma').attr('disabled','disabled');
        $('#plaza2').attr('disabled','disabled');
        $('#plaza3').attr('disabled','disabled');
        $('#plaza4').attr('disabled','disabled');
        $('#plaza5').attr('disabled','disabled');
        $('#plaza6').attr('disabled','disabled');
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
      }

      if (id == "estatusma") {
        $("#estatus1ma").show();
        $('#estatus1ma').removeAttr('disabled');
        $('#estatus1ma').focus();
        $("#num_oficio1ma").hide();
        $("#num_docto1ma").hide();
        $("#rfc1ma").hide();
        $("#captura1ma").hide();
        $("#fec_captura1ma").hide();
        $("#fec_cancelacion1ma").hide();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
        $("#curp1ma").hide();
        $("#relacion2ma").hide();
        $("#num_oficio1ma").attr('disabled','disabled');   
        $("#num_docto1ma").attr('disabled','disabled');         
        $("#rfc1ma").attr('disabled','disabled');
        $("#captura1ma").attr('disabled','disabled');
        $("#fec_captura1ma").attr('disabled','disabled');
        $("#fec_cancelacion1ma").attr('disabled','disabled');
        $("#plaza1ma").attr('disabled','disabled');
        $("#plaza2ma").attr('disabled','disabled');
        $("#plaza3ma").attr('disabled','disabled');
        $("#plaza4ma").attr('disabled','disabled');
        $("#plaza5ma").attr('disabled','disabled');
        $("#plaza6ma").attr('disabled','disabled');
        $("#relacion2ma").attr('disabled','disabled');
        $("#curp1ma").attr('disabled','disabled');

        $("#labelma").show();
        $('#labelma').removeAttr('disabled');
        $("#rfc_num_doctoma").show();
        $('#rfc_num_doctoma').removeAttr('disabled');
      }
      if (id != "estatusma") {
        $('#estatus1ma').blur();
        $('#estatus1ma').val("");
        $("#estatus1ma").hide();
        $('#estatus1ma').attr('disabled','disabled');
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
      }

      if (id == "relacion_oficioma") {
        $("#relacion2ma").show();
        $('#relacion2ma').removeAttr('disabled');
        $('#relacion2ma').focus();
        $("#num_oficio1ma").hide();
        $("#num_docto1ma").hide();
        $("#rfc1ma").hide();
        $("#captura1ma").hide();
        $("#fec_captura1ma").hide();
        $("#fec_cancelacion1ma").hide();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
        $("#curp1ma").hide();
        $("#estatus1ma").hide();
        $("#num_oficio1ma").attr('disabled','disabled');   
        $("#num_docto1ma").attr('disabled','disabled');         
        $("#rfc1ma").attr('disabled','disabled');
        $("#captura1ma").attr('disabled','disabled');
        $("#fec_captura1ma").attr('disabled','disabled');
        $("#fec_cancelacion1ma").attr('disabled','disabled');
        $("#plaza1ma").attr('disabled','disabled');
        $("#plaza2ma").attr('disabled','disabled');
        $("#plaza3ma").attr('disabled','disabled');
        $("#plaza4ma").attr('disabled','disabled');
        $("#plaza5ma").attr('disabled','disabled');
        $("#plaza6ma").attr('disabled','disabled');
        $("#estatus1ma").attr('disabled','disabled');
        $("#curp1ma").attr('disabled','disabled');

        $("#labelma").show();
        $('#labelma').removeAttr('disabled');
        $("#rfc_num_doctoma").show();
        $('#rfc_num_doctoma').removeAttr('disabled');
        
      }
      if (id != "relacion_oficioma") {
        $('#relacion2ma').blur();
        $('#relacion2ma').val("");
        $("#relacion2ma").hide();
        $('#relacion2ma').attr('disabled','disabled');
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
      }

      if (id == "curpma") {
        //$("#nomEmp4ma").show();
        $("#curp1ma").show();
        $('#curp1ma').removeAttr('disabled');
        $('#curp1ma').focus();
        $("#num_oficio1ma").hide();
        $("#num_docto1ma").hide();
        $("#rfc1ma").hide();
        $("#captura1ma").hide();
        $("#fec_captura1ma").hide();
        $("#fec_cancelacion1ma").hide();
        $("#plaza1ma").hide();
        $("#plaza2ma").hide();
        $("#plaza3ma").hide();
        $("#plaza4ma").hide();
        $("#plaza5ma").hide();
        $("#plaza6ma").hide();
        $("#relacion2ma").hide();
        $("#estatus1ma").hide();
        $("#num_oficio1ma").attr('disabled','disabled');   
        $("#num_docto1ma").attr('disabled','disabled');         
        $("#rfc1ma").attr('disabled','disabled');
        $("#captura1ma").attr('disabled','disabled');
        $("#fec_captura1ma").attr('disabled','disabled');
        $("#fec_cancelacion1ma").attr('disabled','disabled');
        $("#plaza1ma").attr('disabled','disabled');
        $("#plaza2ma").attr('disabled','disabled');
        $("#plaza3ma").attr('disabled','disabled');
        $("#plaza4ma").attr('disabled','disabled');
        $("#plaza5ma").attr('disabled','disabled');
        $("#plaza6ma").attr('disabled','disabled');
        $("#estatus1ma").attr('disabled','disabled');
        $("#relacion2ma").attr('disabled','disabled');

        $("#labelma").show();
        $('#labelma').removeAttr('disabled');
        $("#rfc_num_doctoma").show();
        $('#rfc_num_doctoma').removeAttr('disabled');
        
      }
      if (id != "curpma") {
        $('#curp1ma').blur();
        $('#curp1ma').val("");
        $('#curp1ma').hide();
        $('#curp1ma').attr('disabled','disabled');
        $('#nomEmp4').hide();
        //$('#nomEmp4').empty();
        $('#rfc_num_doctoma').empty();    
        $('#rfc_num_doctoma').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_doctoma').change();
      }
}