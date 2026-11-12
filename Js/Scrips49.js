function mostrarS(id) {
      if (id == "num_oficio") {
        $("#num_oficio1").show();
        $('#num_oficio1').removeAttr('disabled');
        $('#num_oficio1').focus();
        $("#num_docto1").hide();
        $("#rfc1").hide();
        $("#captura1").hide();
        $("#fec_captura1").hide();
        $("#fec_cancelacion1").hide();
        $("#estatus1").hide();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
        $("#relacion2").hide();
        $("#curp1").hide();
        $("#num_docto1").attr('disabled','disabled');
        $("#rfc1").attr('disabled','disabled');         
        $("#captura1").attr('disabled','disabled');
        $("#fec_captura1").attr('disabled','disabled');
        $("#fec_cancelacion1").attr('disabled','disabled');
        $("#plaza1").attr('disabled','disabled');
        $("#plaza2").attr('disabled','disabled');
        $("#plaza3").attr('disabled','disabled');
        $("#plaza4").attr('disabled','disabled');
        $("#plaza5").attr('disabled','disabled');
        $("#plaza6").attr('disabled','disabled');
        $("#estatus1").attr('disabled','disabled');
        $("#relacion2").attr('disabled','disabled');
        $("#curp1").attr('disabled','disabled');

        $("#label").show();
        $('#label').removeAttr('disabled');
        $("#rfc_num_docto").show();
        $('#rfc_num_docto').removeAttr('disabled');

      }

      if (id != "num_oficio") {
        $('#num_oficio1').blur();
        $('#num_oficio1').val("");
        $("#num_oficio1").hide();
        $('#num_oficio1').attr('disabled','disabled');
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
        }
      
      if (id == "num_docto") {
        $("#num_docto1").show();
        $('#num_docto1').removeAttr('disabled');
        $('#num_docto1').focus();
        $("#btnGetDaten_ori2").show();
        $('#btnGetDaten_ori2').removeAttr('disabled');        
        $("#mfup").show();
        $('#mfup').removeAttr('disabled');
        $("#num_oficio1").hide();
        $("#rfc1").hide();
        $("#captura1").hide();
        $("#fec_captura1").hide();
        $("#fec_cancelacion1").hide();
        $("#estatus1").hide();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
        $("#relacion2").hide();
        $("#curp1").hide();
        $("#num_oficio1").attr('disabled','disabled');
        $("#rfc1").attr('disabled','disabled');         
        $("#captura1").attr('disabled','disabled');
        $("#fec_captura1").attr('disabled','disabled');
        $("#fec_cancelacion1").attr('disabled','disabled');
        $("#plaza1").attr('disabled','disabled');
        $("#plaza2").attr('disabled','disabled');
        $("#plaza3").attr('disabled','disabled');
        $("#plaza4").attr('disabled','disabled');
        $("#plaza5").attr('disabled','disabled');
        $("#plaza6").attr('disabled','disabled');
        $("#estatus1").attr('disabled','disabled');
        $("#relacion2").attr('disabled','disabled');
        $("#curp1").attr('disabled','disabled');

        $("#label").hide();
        $('#label').attr('disabled','disabled');
        $("#rfc_num_docto").hide();
        $('#rfc_num_docto').attr('disabled','disabled');
      }
      if (id != "num_docto") {
        $('#num_docto1').blur();
        $('#num_docto1').val("");
        $("#num_docto1").hide();
        $("#btnGetDaten_ori2").hide();
        $('#btnGetDaten_ori2').attr('disabled');            
        $("#mfup").hide();
        $('#num_docto1').attr('disabled','disabled');
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
        
      }
      
      if (id == "rfc") {
        $("#rfc1").show();
        $('#rfc1').removeAttr('disabled');
        $('#rfc1').focus();
        //$("#nomEmp1").show();
        //$('#nomEmp1').removeAttr('disabled');
        $("#label").show();
        $('#label').removeAttr('disabled');
        $("#rfc_num_docto").show();
        $('#rfc_num_docto').removeAttr('disabled');
        $("#num_oficio1").hide();
        $("#num_docto1").hide();
        $("#captura1").hide();
        $("#fec_captura1").hide();
        $("#fec_cancelacion1").hide();
        $("#estatus1").hide();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
        $("#curp1").hide();
        $("#relacion2").hide();
        $("#num_oficio1").attr('disabled','disabled');
        $("#num_docto1").attr('disabled','disabled');         
        $("#captura1").attr('disabled','disabled');
        $("#fec_captura1").attr('disabled','disabled');
        $("#fec_cancelacion1").attr('disabled','disabled');
        $("#plaza1").attr('disabled','disabled');
        $("#plaza2").attr('disabled','disabled');
        $("#plaza3").attr('disabled','disabled');
        $("#plaza4").attr('disabled','disabled');
        $("#plaza5").attr('disabled','disabled');
        $("#plaza6").attr('disabled','disabled');
        $("#estatus1").attr('disabled','disabled');
        $("#relacion2").attr('disabled','disabled');
        $("#curp1").attr('disabled','disabled');

        
        
        
        
        
      }
      if (id != "rfc") {
        $('#rfc1').blur();
        $("#rfc1").hide();
        $('#rfc1').attr('disabled','disabled');
        $('#rfc1').val("");
        $("#nomEmp1").hide();
        $('#nomEmp1').attr('disabled','disabled');
        /*$('#nomEmp').empty();    
        $('#nomEmp').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#nomEmp').change();*/
        //$('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>').hide().show(); 
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
        
      }

      if (id == "captura") {
        $("#captura1").show();
        $('#captura1').removeAttr('disabled');
        $('#captura1').focus();
        $("#num_oficio1").hide();
        $("#num_docto1").hide();
        $("#rfc1").hide();
        $("#fec_captura1").hide();
        $("#fec_cancelacion1").hide();
        $("#estatus1").hide();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
        $("#curp1").hide();
        $("#relacion2").hide();
        $("#num_oficio1").attr('disabled','disabled');
        $("#num_docto1").attr('disabled','disabled');         
        $("#rfc1").attr('disabled','disabled');
        $("#fec_captura1").attr('disabled','disabled');
        $("#fec_cancelacion1").attr('disabled','disabled');
        $("#plaza1").attr('disabled','disabled');
        $("#plaza2").attr('disabled','disabled');
        $("#plaza3").attr('disabled','disabled');
        $("#plaza4").attr('disabled','disabled');
        $("#plaza5").attr('disabled','disabled');
        $("#plaza6").attr('disabled','disabled');
        $("#estatus1").attr('disabled','disabled');
        $("#relacion2").attr('disabled','disabled');
        $("#curp1").attr('disabled','disabled');

        $("#label").show();
        $('#label').removeAttr('disabled');
        $("#rfc_num_docto").show();
        $('#rfc_num_docto').removeAttr('disabled');
        
      }
      if (id != "captura") {
        $('#captura1').blur();
        $('#captura1').val("");
        $("#captura1").hide();
        $('#captura1').attr('disabled','disabled');
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
      }
      
      if (id == "fecha_captura") {
        $("#fec_captura1").show();
        $('#fec_captura1').removeAttr('disabled');
        $('#fec_captura1').focus();
        $("#num_oficio1").hide();
        $("#num_docto1").hide();
        $("#rfc1").hide();
        $("#captura1").hide();
        $("#fec_cancelacion1").hide();
        $("#estatus1").hide();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
        $("#curp1").hide();
        $("#relacion2").hide();
        $("#num_oficio1").attr('disabled','disabled');   
        $("#num_docto1").attr('disabled','disabled');         
        $("#rfc1").attr('disabled','disabled');
        $("#captura1").attr('disabled','disabled');
        $("#fec_cancelacion1").attr('disabled','disabled');
        $("#plaza1").attr('disabled','disabled');
        $("#plaza2").attr('disabled','disabled');
        $("#plaza3").attr('disabled','disabled');
        $("#plaza4").attr('disabled','disabled');
        $("#plaza5").attr('disabled','disabled');
        $("#plaza6").attr('disabled','disabled');
        $("#estatus1").attr('disabled','disabled');
        $("#relacion2").attr('disabled','disabled');
        $("#curp1").attr('disabled','disabled');

        $("#label").show();
        $('#label').removeAttr('disabled');
        $("#rfc_num_docto").show();
        $('#rfc_num_docto').removeAttr('disabled');
        
      }
      if (id != "fecha_captura") {
        $('#fec_captura1').blur();
        $('#fec_captura1').val("");
        $("#fec_captura1").hide();
        $('#fec_captura1').attr('disabled','disabled');
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
      }

      if (id == "fecha_cancelacion") {
        $("#fec_cancelacion1").show();
        $('#fec_cancelacion1').removeAttr('disabled');
        $('#fec_cancelacion1').focus();
        $("#num_oficio1").hide();
        $("#num_docto1").hide();
        $("#rfc1").hide();
        $("#captura1").hide();
        $("#fec_captura1").hide();
        $("#estatus1").hide();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
        $("#curp1").hide();
        $("#relacion2").hide();
        $("#num_oficio1").attr('disabled','disabled');
        $("#num_docto1").attr('disabled','disabled');         
        $("#rfc1").attr('disabled','disabled');
        $("#captura1").attr('disabled','disabled');
        $("#fec_captura1").attr('disabled','disabled');
        $("#plaza1").attr('disabled','disabled');
        $("#plaza2").attr('disabled','disabled');
        $("#plaza3").attr('disabled','disabled');
        $("#plaza4").attr('disabled','disabled');
        $("#plaza5").attr('disabled','disabled');
        $("#plaza6").attr('disabled','disabled');
        $("#estatus1").attr('disabled','disabled');
        $("#relacion2").attr('disabled','disabled');
        $("#curp1").attr('disabled','disabled');

        $("#label").show();
        $('#label').removeAttr('disabled');
        $("#rfc_num_docto").show();
        $('#rfc_num_docto').removeAttr('disabled');
        
      }
      if (id != "fecha_cancelacion") {
        $('#fec_cancelacion1').blur();
        $('#fec_cancelacion1').val("");
        $("#fec_cancelacion1").hide();
        $('#fec_cancelacion1').attr('disabled','disabled');
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
      }

      if (id == "plazas") {
        $("#plaza1").show();
        $("#plaza2").show();
        $("#plaza3").show();
        $("#plaza4").show();
        $("#plaza5").show();
        $("#plaza6").show();
        $("#plaza1").removeAttr('disabled');
        $("#plaza2").removeAttr('disabled');
        $("#plaza3").removeAttr('disabled');
        $("#plaza4").removeAttr('disabled');
        $("#plaza5").removeAttr('disabled');
        $("#plaza6").removeAttr('disabled');
        $('#plaza1').focus();
        $("#fec_cancelacion1").attr('disabled','disabled');
        $('#fec_cancelacion1').hide();
        $("#num_oficio1").hide();
        $("#num_docto1").hide();
        $("#rfc1").hide();
        $("#captura1").hide();
        $("#fec_captura1").hide();
        $("#estatus1").hide();
        $("#curp1").hide();
        $("#relacion2").hide();
        $("#num_oficio1").attr('disabled','disabled');   
        $("#num_docto1").attr('disabled','disabled');         
        $("#rfc1").attr('disabled','disabled');
        $("#captura1").attr('disabled','disabled');
        $("#fec_captura1").attr('disabled','disabled');
        $("#estatus1").attr('disabled','disabled');
        $("#relacion2").attr('disabled','disabled');
        $("#curp1").attr('disabled','disabled');

        $("#label").show();
        $('#label').removeAttr('disabled');
        $("#rfc_num_docto").show();
        $('#rfc_num_docto').removeAttr('disabled');
        
      }
      if (id != "plazas") {
        $('#plaza1').blur();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
         $("#plaza1").val("");
        $("#plaza2").val("");
        $("#plaza3").val("");
        $("#plaza4").val("");
        $("#plaza5").val("");
        $("#plaza6").val("");
        $('#plaza1').attr('disabled','disabled');
        $('#plaza2').attr('disabled','disabled');
        $('#plaza3').attr('disabled','disabled');
        $('#plaza4').attr('disabled','disabled');
        $('#plaza5').attr('disabled','disabled');
        $('#plaza6').attr('disabled','disabled');
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
      }

      if (id == "estatus") {
        $("#estatus1").show();
        $('#estatus1').removeAttr('disabled');
        $('#estatus1').focus();
        $("#num_oficio1").hide();
        $("#num_docto1").hide();
        $("#rfc1").hide();
        $("#captura1").hide();
        $("#fec_captura1").hide();
        $("#fec_cancelacion1").hide();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
        $("#curp1").hide();
        $("#relacion2").hide();
        $("#num_oficio1").attr('disabled','disabled');   
        $("#num_docto1").attr('disabled','disabled');         
        $("#rfc1").attr('disabled','disabled');
        $("#captura1").attr('disabled','disabled');
        $("#fec_captura1").attr('disabled','disabled');
        $("#fec_cancelacion1").attr('disabled','disabled');
        $("#plaza1").attr('disabled','disabled');
        $("#plaza2").attr('disabled','disabled');
        $("#plaza3").attr('disabled','disabled');
        $("#plaza4").attr('disabled','disabled');
        $("#plaza5").attr('disabled','disabled');
        $("#plaza6").attr('disabled','disabled');
        $("#relacion2").attr('disabled','disabled');
        $("#curp1").attr('disabled','disabled');

        $("#label").show();
        $('#label').removeAttr('disabled');
        $("#rfc_num_docto").show();
        $('#rfc_num_docto').removeAttr('disabled');
      }
      if (id != "estatus") {
        $('#estatus1').blur();
        $('#estatus1').val("");
        $("#estatus1").hide();
        $('#estatus1').attr('disabled','disabled');
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
      }

      if (id == "relacion_oficio") {
        $("#relacion2").show();
        $('#relacion2').removeAttr('disabled');
        $('#relacion2').focus();
        $("#num_oficio1").hide();
        $("#num_docto1").hide();
        $("#rfc1").hide();
        $("#captura1").hide();
        $("#fec_captura1").hide();
        $("#fec_cancelacion1").hide();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
        $("#curp1").hide();
        $("#estatus1").hide();
        $("#num_oficio1").attr('disabled','disabled');   
        $("#num_docto1").attr('disabled','disabled');         
        $("#rfc1").attr('disabled','disabled');
        $("#captura1").attr('disabled','disabled');
        $("#fec_captura1").attr('disabled','disabled');
        $("#fec_cancelacion1").attr('disabled','disabled');
        $("#plaza1").attr('disabled','disabled');
        $("#plaza2").attr('disabled','disabled');
        $("#plaza3").attr('disabled','disabled');
        $("#plaza4").attr('disabled','disabled');
        $("#plaza5").attr('disabled','disabled');
        $("#plaza6").attr('disabled','disabled');
        $("#estatus1").attr('disabled','disabled');
        $("#curp1").attr('disabled','disabled');

        $("#label").show();
        $('#label').removeAttr('disabled');
        $("#rfc_num_docto").show();
        $('#rfc_num_docto').removeAttr('disabled');
        
      }
      if (id != "relacion_oficio") {
        $('#relacion2').blur();
        $('#relacion2').val("");
        $("#relacion2").hide();
        $('#relacion2').attr('disabled','disabled');
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
      }

      if (id == "curp") {
        //$("#nomEmp4").show();
        $("#curp1").show();
        $('#curp1').removeAttr('disabled');
        $('#curp1').focus();
        $("#num_oficio1").hide();
        $("#num_docto1").hide();
        $("#rfc1").hide();
        $("#captura1").hide();
        $("#fec_captura1").hide();
        $("#fec_cancelacion1").hide();
        $("#plaza1").hide();
        $("#plaza2").hide();
        $("#plaza3").hide();
        $("#plaza4").hide();
        $("#plaza5").hide();
        $("#plaza6").hide();
        $("#relacion2").hide();
        $("#estatus1").hide();
        $("#num_oficio1").attr('disabled','disabled');   
        $("#num_docto1").attr('disabled','disabled');         
        $("#rfc1").attr('disabled','disabled');
        $("#captura1").attr('disabled','disabled');
        $("#fec_captura1").attr('disabled','disabled');
        $("#fec_cancelacion1").attr('disabled','disabled');
        $("#plaza1").attr('disabled','disabled');
        $("#plaza2").attr('disabled','disabled');
        $("#plaza3").attr('disabled','disabled');
        $("#plaza4").attr('disabled','disabled');
        $("#plaza5").attr('disabled','disabled');
        $("#plaza6").attr('disabled','disabled');
        $("#estatus1").attr('disabled','disabled');
        $("#relacion2").attr('disabled','disabled');

        $("#label").show();
        $('#label').removeAttr('disabled');
        $("#rfc_num_docto").show();
        $('#rfc_num_docto').removeAttr('disabled');
        
      }
      if (id != "curp") {
        $('#curp1').blur();
        $('#curp1').val("");
        $('#curp1').hide();
        $('#curp1').attr('disabled','disabled');
        $('#nomEmp4').hide();
        //$('#nomEmp4').empty();
        $('#rfc_num_docto').empty();    
        $('#rfc_num_docto').append('<option disabled selected hidden>Seleccionar </option>'); 
        $('#rfc_num_docto').change();
      }
}
