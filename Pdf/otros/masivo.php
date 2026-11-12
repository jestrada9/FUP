<?php

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="
    sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript">
$(document).ready( function () {
 $("#activar").button().click(function(){
    array = ['2220293080','2220293082','2220293068','2220293076','2220293067','2220293078','2220292998','2220293084','2220292968','2220293053','2220293001','2220293041','2220293018','2220293069','2220293077','2220293066','2220293073','2220293081','2220293075','2220293079','2220293083','2220293071','2220293072','2220293074','2220293013','2220293085','2220292969'];
/*
  results = array("data"=>$data);
*/
    var json1 = "undefinided";
      
      $.ajax({
         //async: true,
          type: "POST",
          //url: "Reimprimir/Reimpresion_manual.php",
          url: "data_masivo.php",
          data: {
            //buscar: window.btoa(json1),
            buscar: json1,
          },
       success: function(data1)
             {
               json1 = JSON.stringify(data1);
                  $.ajax({
                    type: "POST",
                    url: "Reimprimir/Reimpresion_manual.php",
                    data: {
                      //buscar: window.btoa(json1),
                      buscars: json1,
                    },
                    success: function(data)
                     {
                      console.log("echo");
                     },
                   //cache: false
                });
             },
         //cache: false
      });
    
      
    }); 
  });
  </script>
</head>
<body>
<button type = "submit" name="activar" class = "btn btn-success" id = "activar" >activar</button>
</body>
</html>