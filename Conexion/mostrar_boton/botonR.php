
<script type="text/javascript">
$(document).ready(function(){

	$('#num_doctoR').val();	
	boton();
	

});
function boton(){

var  $num_d = $("#num_doctoR").val();	

//alert(num_d);	
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
 //
}
</script>
