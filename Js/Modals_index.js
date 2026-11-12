function reim() {
     $(document).ready(function() {  
          $('#exampleModal').on('shown.bs.modal', function() {
               $("#re-num_docto").show();
               $('#re-num_docto').trigger('focus');
          });
     });
}
function reim1() {
     $(document).ready(function() {
          $('#exampleModalOriginal').on('shown.bs.modal', function() {
                $("#re-num_docto").show();
                $('#re-num_docto').trigger('focus');
          });
     });
}