$(document).ready(function(){

	$('#cve_mov').val();
	$('#mot_mov1').val();
	$('#mot_mov').val();
	$('#var').val();
    $('#por_documento').val();
	$('#por_movimiento option:selected').val();
	
//	load();
	
	$('#reset').on('click', function(){
		//location.reload();
	});
});

function load(){
	
            //async: true,
			$cve_mov = $('#cve_mov').val();
			$mot_mov1 = $('#mot_mov1').val();
			$mot_mov = $('#mot_mov').val();
			$('#btnGetData').show();
			$('#btnGetDataC').show();
			$('#dia1').show();
			$('#plaza_ant').show();
			$('#label_plaza_ant').show();
			
			$var = $('#var').val();
            $por_documento = $('#por_documento').val();
			$por_movimiento = $('#por_movimiento option:selected').val();
			
			$('#load_data').empty();
			$loader = $('<tr id="loaders"><td colspan = "16"><center><img src="../Logo/loader.gif" alt="loading" /><br/>Un momento, por favor...</center></td></tr>');
			$loader.appendTo('#load_data');
//			setTimeout(function(){
				
				$.ajax({
					url: 'tabla.php',
					type: 'POST',
					data: {
						cve_mov: $cve_mov,
						mot_mov1: $mot_mov1	,
						mot_mov: $mot_mov	,
						var: $var,
                        por_documento: $por_documento,
                        por_movimiento: $por_movimiento
					},
					success: function(res){
						if(res!=""){
							$('#load_data').html(res);
							$loader.remove();	
						}else{
							$('#load_data').html("<tr><td>no se encontraron resultados</td></tr>");$loader.remove();
						}
						
					},
					error: function() {$('#load_data').html("<tr><td>no se encontraron resultados</td></tr>");$loader.remove();}
				});
				
//			}, 1000);	
}