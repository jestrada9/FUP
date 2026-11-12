<?php
        $usuario = $_GET['usuario'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
 <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="../Js/Numeros.js"></script>
  <script src="../Js/ScripsR8.js"></script>
  <script src="../Js/validacion.js"></script>
  <script src="../Js/func8.js"></script> 
  <script src="../Js/typeahead.js"></script>
  <script src="../Js/funciones_rOriginal10.js"></script>  
  <script src="../Js/funciones_rO1.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="../Css/css_reimpresionOriginal1.css" rel="stylesheet"/>
</head>
<body>
<form id="formulario3">
  <label id="pendientes">Re-impresion Original "<?php echo $usuario;?>"</label>
         <div class="modal-footer">
         <label id="buscarR_">BUSCAR POR:</label>
         <select id="descripcionR" name="descripcionR" class = "form-control" onchange="mostrarR_(this.value);" required >
          <option value="" disabled selected hidden>Selecciona Uno...</option>
          <option id="num_doctoR_" name="num_doctoR_" value="num_doctoR_">NUMERO DE DOCUMENTO</option>
          <option id="rfcR_" name="rfcR_" value="rfcR_">FILIACION</option>
        </select>
        <input type="text" name="num_doctoR" class="form-control" placeholder="NUM. DE DOCUMENTO" id="num_doctoR" style="display: none;" onkeypress="return numeros(event)"   autofocus maxlength="10" onkeydown="CAD_checkEnter(event);" required/>
        
        <input type="text" name="rfcR" class = "form-control" placeholder = "FILIACION" id = "rfcR" style="display: none;" required/>
       
        <div id="nomEmpsR">  
        </div>
        <div id="labelsR">
          <label id="labelR" style="display: none;">Numero de Documento</label>
        </div>
        <div id="rfc_num_doctosR" >          
          <select id="rfc_num_doctoR" name="rfc_num_doctoR" class = "form-control" style="display: none;"  onchange="var optionVal = $(this).find(':selected').val(); " required >
            
          </select>
        </div>      
        <div id="bttR2_" >
         <button type = "button" name="btnGetDataR" style="visibility:visible" class = "btnGetDataR" id = "btnGetDataR" onclick="clickaction(this,'Q')">Generar FUP</button>
         </div>  
                <!--input type="hidden" name="key" id="key" value="" /-->
        <input type="hidden" name="us" id="usuario" value="<?php echo  $usuario;?>" />                
    </form>
</body>
  <?php
  include '../Js/Auto_completarR_Original.php';
  include '../Conexion/mostrar_boton/boton.php';
  ?>
</html>    