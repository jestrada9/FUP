$(document).ready(function () {
    $("#btn_search").click(function() {
        // Capturamnos el boton de envío
        var btnEnviar     = $("#btn_search");
        var id            = $("#num_docto1").val();
        var descripcion   = $("#descripcion").val();
        var rfc_num_docto = $("#rfc_num_docto").val();
        var key           = $("#key").val();

        if((id!="" && rfc_num_docto==null) || (id=="" && rfc_num_docto!=null)){
        $.ajax({
            type: 'POST',
            url: "Js/recibir.php",
            data: {
                num_docto : id,
                descripcion: descripcion,
                rfc_num_docto: rfc_num_docto,
                key: key
            },
            beforeSend: function(){
                /*
                * Esta función se ejecuta durante el envió de la petición al
                * servidor.
                * */
                // btnEnviar.text("Enviando"); Para button 
                btnEnviar.val("Enviando"); // Para input de tipo button
                btnEnviar.attr("disabled","disabled");
            },
            complete:function(data){
                /*
                * Se ejecuta al termino de la petición
                * */
                btnEnviar.val("Enviar formulario");
                btnEnviar.removeAttr("disabled");
            },
            success: function(data){
                //console.log(data);
                
                function is_json(str) {
                    try {
                        JSON.parse(str);
                    } catch (e) {
                        return false;
                    }
                    return true;
                }
                
                if(is_json(data) == true){
                    var parse = JSON.parse(data);

                    cve_mov = parse['cve_mov'];
                    num_doc = parse['var'];
                    mot_mov = parse['mot_mov'];
                    keys = parse['key'];
                    array = parse['array'];

                    yes = "Pdf/Antecedentes.php?cve_mov="+cve_mov+";&var="+num_doc+"&mot_mov="+mot_mov+"&key="+keys+"&array="+array+"";
                    window.open(yes,"_blank");

                }else{
                
                $('[id$=textobs]').text(data);
                $('#dialog-confirmPDF').show();
                $('#dialog-confirmPDF').dialog({//dialog
                  resizable: false,
                  height: 170,
                  width: 400,
                  modal: true,
                  buttons: {
                        OK: function() {
                      $( this ).dialog( 'close' );
                    }
                          }
                });//dialog
                
                }//else array
            },
            error: function(data){
                /*
                * Se ejecuta si la peticón ha sido erronea
                * */
                alert("Problemas al tratar de enviar el formulario");
            }
            
        });
        // Nos permite cancelar el envio del formulario
        return false;
        }
        
    });
});