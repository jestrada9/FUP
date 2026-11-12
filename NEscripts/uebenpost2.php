<html>
<head>
</head>
<body>
<form id="uebenpost3" action="uebenpost3" method="post" target="_self">
<?php
echo $Gcve_mov;
  if(isset($Gcve_mov) && isset($Gnum_doc))
  {
      if(isset($_SERVER['HTTP_REFERER']))
      {
        echo "se cumple: ".' 1.- '.$_SERVER['HTTP_HOST'].' 2.- '.$_SERVER['SCRIPT_NAME'].' 3.- '.basename($_SERVER['HTTP_REFERER']).' 4.- '.$Gnum_doc;
        header('consola operativa...');
      }
      else echo "ingrese desde el inicio por favor...3";
  }
  else echo "ingrese desde el inicio por favor...2";  
?>
</form>
</body>
</html>