//01marzo2022
    function CAD_checkEnter(e) {
            var characterCode
            if (e && e.which) {
                e = e
                characterCode = e.which
            }
            else {
                e = event
                characterCode = e.keyCode
            }
var valueND = document.getElementById('num_doctoR').value;
            if (characterCode == 13 && valueND.length == 10) { //if generated character code is equal to ascii 13 (if enter key)
                doSomething(valueND);
                return false;
            }
            else {
                return true;
            }
        }
//01marzo2022

    window.onload=function() {
      $(document).ready(function () {
        $("#rfcR").change(function () {
          $("#rfcR").each(function () {
            rfc_num_doctoR = $(this).val();
            $.post("../Conexion/ObtenerNum_DoctorO/RFC_NumDR.php",
              {
                rfc_num_doctoR: rfc_num_doctoR
              }, 
              function(data){
                $("#rfc_num_doctoR").html(data);
              });
          });
        });
      });
    }           