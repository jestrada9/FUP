$(document).ready(function () {
  $("#btn_searchma").click(function () {
    // Capturamnos el boton de envío
    var btnEnviar = $("#btn_searchma");
    var id = $("#num_docto1ma").val();
    var descripcion = $("#descripcionma").val();
    var rfc_num_docto = $("#rfc_num_doctoma").val();
    var key = $("#key").val();
    var opc = $("input[name=opc]:checked").val();
    console.log(opc);
    if (id == "" && rfc_num_docto != "") {
      num_doc = rfc_num_docto;
    } else {
      num_doc = id;
    }

    if (opc == "Original") {
      $.ajax({
        type: "POST",
        url: "Js/recibir_ma.php",
        data: {
          num_docto: id,
          descripcion: descripcion,
          rfc_num_docto: rfc_num_docto,
          key: key,
        },
        beforeSend: function () {
          /*
           * Esta función se ejecuta durante el envió de la petición al
           * servidor.
           * */
          // btnEnviar.text("Enviando"); Para button
          btnEnviar.val("Enviando"); // Para input de tipo button
          btnEnviar.attr("disabled", "disabled");
        },
        complete: function (data) {
          /*
           * Se ejecuta al termino de la petición
           * */
          btnEnviar.val("Enviar formulario");
          btnEnviar.removeAttr("disabled");
        },
        success: function (data) {
          //console.log(data);

          function is_json(str) {
            try {
              JSON.parse(str);
            } catch (e) {
              return false;
            }
            return true;
          }

          if (is_json(data) == true) {
            var parse = JSON.parse(data);

            cve_mov = parse["cve_mov"];
            num_doc = parse["var"];
            mot_mov = parse["mot_mov"];
            keys = parse["key"];

            yes =
              "Pdf/Antecedentes_manual.php?cve_mov=" +
              cve_mov +
              ";&var=" +
              num_doc +
              "&mot_mov=" +
              mot_mov +
              "&key=" +
              keys +
              "";
            window.open(yes, "_blank");
          } else {
            $("[id$=textobsma]").text(data);
            $("#dialog-confirmPDFma").show();
            $("#dialog-confirmPDFma").dialog({
              //dialog
              resizable: false,
              height: 170,
              width: 400,
              modal: true,
              buttons: {
                OK: function () {
                  $(this).dialog("close");
                },
              },
            }); //dialog
          } //else array
        },
        error: function (data) {
          alert("Problemas al tratar de enviar el formulario");
        },
      });
      // Nos permite cancelar el envio del formulario
      //return false;
    } else {
      if (id != "") {
        console.log("BORRADO");
        /*
                $.ajax({
                    type: "POST",
                    url: "Js/borrar.php",
                    data: {
                        num_doc : num_doc
                    },
                    success: function(response) {     
                        alert(response);
                    }
                });   
                */
      } else {
        alert("No se ha enviado ningún documento");
      }
    }
  });
});
