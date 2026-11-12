<?php
if ((strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'))
{
  $Gcve_mov = $_POST['cve_mov'];
  $Gnum_doc = $_POST['num_doc'];
  unset($_POST['cve_mov']);
  unset($_POST['num_doc']);

  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'uebenpost2.php';
  header("Location: http://$host$uri/$extra");
  exit;
}
else echo "ingrese desde el inicio por favor...1";
?>