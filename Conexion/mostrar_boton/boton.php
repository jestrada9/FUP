
<script type="text/javascript">
  function doSomething(param) {
$(document).ready(function () {
    //if ($(param.selected)) {
    	var  $num_d = param;
    	setTimeout(function(){
				$.ajax({
					url: 'Conexion/mostrar_boton/boton1.php',
					type: 'POST',
					data: {
						num_d: $num_d
					},
					success: function(res){
						//console.log(res);
						$('#load_data10').html(res);
						//alert(res);
						
					}
				});
}, 1000);
        
    //}
  });
}


</script>
