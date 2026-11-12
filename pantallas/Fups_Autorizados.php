<?php
	$usuario = $_GET['usuario'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pendientes Paty</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="
    sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js">
        </script>
        <script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js">
        </script>
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
        </script>
        <script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">
        </script>
        <script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js">
        </script>
 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">
	<script>
 	class constructors{ //class constructor Plazas Selecionadas
      get total(){return this._total;}
      set total(total){this._total = total;}
      get nd(){return this.num_docto;}
      set nd(nd){this.num_docto = nd;}
    }		
	$(document).ready( function () {
	  	var hoy = new Date();
		var hora = hoy.getHours() + '-' + hoy.getMinutes();
		var idv = 0;
		var	table;
		var sis = 0;
		var url_baja = "";
		var urlCrearPDF = "";
		var aaData = "";
		var mots = "";
		var sele1;
		var tr;
    	var row;
		var usuario = "<?php echo $usuario ?>";
		var json1 = "undefined";
		var json2 = "undefined";
		var dir = "";
		var ids;
		var ids2;  
		
    	var msgForIn = '';
		var total2  = new constructors();
		var area = "";
		var num_oficio = "";
		var frame;
		var html = "";
		var tablas;
		var totals2;
		var data;
	  	var obj;
	  	var nt;
	  	var ndt = "";	
	let fecha1 = new Date(),
	fecha = fecha1.toLocaleDateString();

	function formatoFecha(fecha, formato) {
	    const map = {
	        dd: fecha.getDate(),
	        mm: fecha.getMonth() + 1,
	        yy: fecha.getFullYear().toString().slice(-2),
	        yyyy: fecha.getFullYear()
	    }
	    return formato.replace(/dd|mm|yy|yyy/gi, matched => map[matched])
	}
	var presente = formatoFecha(fecha1, 'dd-mm-yy');
	var fechaYHora = presente + '_' + hora;
	
	$("#select1").change(function(){
        let sele1 = $('#select1 option:selected').val();
        if(sele1 == 'Todos'){
            $('#myTable').removeAttr('width').DataTable().clear().destroy();
            sis = 0;
            aaData = "data_fups_autorizados.php?cons=1";   
            urlCrearPDF = "buscarFup_Crear1.php";  
            url_baja = "buscar_PDF_local.php";
            sele = "";
            dir = "";
            seleccionar(sele1,sis,url_baja,urlCrearPDF,sele,aaData,dir);        
            //$('#myTable').DataTable().ajax.reload();
       }else if(sele1 == 'Cambios_CT'){
            $('#myTable').removeAttr('width').DataTable().clear().destroy();
            sis = 0;
            aaData = "data_fups_autorizados.php?cons=2";   
            urlCrearPDF = "buscarFup_Crear1.php";  
            url_baja = "buscar_PDF_local_CT.php";
            sele = "";
            dir = "CT";
            seleccionar(sele1,sis,url_baja,urlCrearPDF,sele,aaData,dir);                    
	   }else if(sele1 == 'Cambios_CT90'){
            $('#myTable').removeAttr('width').DataTable().clear().destroy();
            sis = 0;
            aaData = "data_fups_autorizados.php?cons=3";   
            urlCrearPDF = "buscarFup_Crear1.php";  
            url_baja = "buscar_PDF_local_CT.php";
            sele = "";
            dir = "CT";
            seleccionar(sele1,sis,url_baja,urlCrearPDF,sele,aaData,dir);                    
       }

    });    
    function seleccionar(sele1,sis,url_baja,urlCrearPDF,sele,aaData,dir){//seleccionar
     table = $('#myTable').DataTable().clear().destroy(); 	

			table = $('#myTable').DataTable({//myTable
            "language": {
                    "sProcessing":    "Procesando...",
                    "sLengthMenu":    "Mostrar _MENU_ registros",
                    "sZeroRecords":   "No se encontraron resultados",
                    "sEmptyTable":    "Ningún dato disponible en esta tabla",
                    "sInfo":          "Total de _TOTAL_ registros",
                    "sInfoEmpty":     "Total de 0 registros",
                    "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":   "",
                    "sSearch":        "Buscar:",
                    "sUrl":           "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":    "Último",
                        "sNext":    "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
             }, 		
      		ajax:{
      			url: aaData
      		},
			//"sAjaxSource": aaData,
			//"iDisplayLength": 4,
			initComplete: function( settings, json ) {
              $("th").removeClass('sorting_asc'); //remove sorting_desc class
            },
			searching: true,
      		ordering: false,
			"lengthChange": false,
			"bPaginate":false,
			"autoWidth": false,
			"info":     true,	
			'ordering': false,	
			scrollY:        285,
	        columnDefs: [
	        	
		        {
		        	'targets': 0,
			         'searchable': false,
			         'ordering': false,
			         'className': 'dt-body-center',
		        	'render': function (aaData, type, full, meta){
	             		return '<input type="checkbox" class=selecheck name="id[]" value="' + $('<div/>').text(aaData).html() + '">';
		        	},
		        	width: 70
		    	},
	            {
                	targets: 1,
                	visible: true,
                	searchable: true,
                	width: 100, 
                	//'className': 'warning',
                	//background-color: lightgoldenrodyellow;
                	width: 80
            	},
            	 {
                	targets: 2,
                	visible: true,
                	searchable: true,
                	width: 80
            	},
				{
                	targets: 3,
                	visible: true,
                	searchable: true,
                	width: 50
            	},
	            {
                	targets: 4,
                	visible: true,
                	searchable: true,
                	width: 50
            	},
            	{
                	targets: 5,
                	visible: true,
                	searchable: true,
                	width: 80 
            	},
				{
                	targets: 6,
                	visible: true,
                	data: null,
	                defaultContent: '<button type="button" id="mostrar" class="btn btn-outline-dark btn-sm">Ver</button>',
					width: 80 
            	},      
	        ],
                dom: "<'row dom_wrapper fh-fixedHeader'B<'col-sm col-md'>i<'col-sm col-md'>l<'col-sm col-md'>f<'col-sm col-md'>>" +
                            "<'row'<'col-sm col-md'tr>>" +
                            "<'row '<'col-sm col-md'>p<'col-sm col-md'>>",
                "buttons": {
                   "dom": {
                      "button": {
                        "tag": "button",
                        "className": "waves-effect waves-light btn mrm",
                      }
                   },

                buttons: [
                    {
                        extend: 'excelHtml5',
                        filename: 'Autorizar_'+fechaYHora,
                        text: '<button id="ExportCGRH" class="btn btn-primary">Exportar a Excel</button>',
                        exportOptions: {
                            columns: [ 1, 2, 3, 4, 5]
                        }
                    },
                ]
            },
           
			});//myTable
		
	table.on('click', '#mostrar', function (e) {//boton tabla
			 e.preventDefault();
			//$(tabla+' tbody').on('click', '#mostrar', function (e) {//boton tabla

			frame = document.getElementById("pdf_qna");
			html = "";
			frame.contentWindow.document.open();
			frame.contentWindow.document.write(html);
			frame.contentWindow.document.close();
   		    var data = table.row($(this).parents('tr')).data();

		    var id = data[1];
			$.ajax({
		        url: url_baja,
		        type: 'POST',
		        data: {
		          id: id
				},
				success: function(result){//funcion
				//console.log(result);
					if(result!=""){

						$('#pdf_qna').attr('src', result+"#toolbar=0&navpanes=0&scrollbar=1&zoom=77");
						$("#dialog-confirmPDF").show();
						$("#dialog-confirmPDF" ).dialog({//dialog
							resizable: false,
							height: 600,
							width: 1100,
							modal: true,
							buttons: {
							OK: function() {
							$( this ).dialog( "close" );
							}
							}
						});//dialog
					}else{//else
						$("#dialog-confirm2").show();
						$("#dialog-confirm2" ).dialog({//dialog
							resizable: false,
							height: "auto",
							width: 400,
							modal: true,
							buttons: {
							OK: function() {
								$( this ).dialog( "close" );
								}
							}
						});//dialog
					}//else
				}//funcion
			});//ajax
	});//boton tabla

	$('#example-select-all').on('click', function(){
			var data = table.row({ 'search': 'applied' }).data();
			tablas = document.getElementsByTagName('tbody')[0];
      totals2=tablas.rows.length;	    
      for (j = 0; j < totals2;j++){//for_j
			//console.log("j: "+j);
    	var num_doctos   = tablas.rows[j].cells[0].childNodes[0].value;
    	//console.log("num_doctos: "+num_doctos);
            if(j<=99){
                if(j==99){
                $('[id$=textaviso]').text("Solo se permiten seleccionar 100 registros");
                  $("#dialog-seleccion").show();
                    $("#dialog-seleccion" ).dialog({//dialog
                      resizable: false,
                      height: "auto",
                      width: 400,
                      modal: true,
                      buttons: {//buttons   
                        OK: function() {
                          $( this ).dialog( "close" );
                        }
                      }//buttons
                    });//dialog
                }
                $('input[value="'+num_doctos+'"]').prop('checked', this.checked);
            }
    	}//for_j 


   });

$('#myTable tbody').on('change', 'input[type="checkbox"]', function(){
   // If checkbox is not checked
   if(!this.checked){
      var el = $('#example-select-all').get(0);
      // If "Select all" control is checked and has 'indeterminate' property
      if(el && el.checked && ('indeterminate' in el)){
         // Set visual state of "Select all" control
         // as 'indeterminate'
         el.indeterminate = true;
      }
   }
});

   table.$('input[type="checkbox"]').each(function(){
      // If checkbox doesn't exist in DOM
      if(!$.contains(document, this)){
         // If checkbox is checked
         if(this.checked){
            // Create a hidden element
            $(form).append(
               $('<input>')
                  .attr('type', 'hidden')
                  .attr('name', 'id[]')
                  .val(this.value)
            );
         }
      }
   });
}//seleccionar	

$("#btnGetDataP").click(function() {//boton_autorizar
			//$("#btnGetDataP").attr("disabled", "disabled");
			$("#BuscarRelacion").val("");
			$("#BuscarRelacion_Checar").val("");

			var newarrays= new Array();
			var newarrays2= new Array();
			var resus= new Array();
			var resus2= new Array();  
			

			data = $('#myTable input[type="checkbox"]').serialize();

	        ids = $('input[class="selecheck"]:checked').map(function() {
	            return $(this).attr('value');
	        }).get();
	        //console.log("ids: "+ids)
	        resus.push(ids);
	        //console.log(resus);
	        total2.totals  = resus[0].length;
	        if(resus[0].length==0){//ifseleccion
	        	$('[id$=textValidarAviso]').text("Seleccione al menos un registro");
				$("#dialog-ValidarSeleccion").show();
				$("#dialog-ValidarSeleccion" ).dialog({//dialog
				    resizable: false,
				    height: "auto",
				    width: 400,
				    modal: true,
				    buttons: {//buttons	
				        OK: function() {
				            $( this ).dialog( "close" );
					    }
				    }//buttons
				});//dialog
	        }else{//ifseleccion

		        newarrays.push(total2);
		        newarrays2.push(total2);

		        function BlockID1(newarrays) {
		            return {                                                                                                         
		        	    newarrays
		            };
		        }
		        function BlockID2(newarrays2) {
		            return {                                                                                                         
		        	    newarrays2
		            };
		        }
		        //var hy = $('.dataTables_filter input').length;
		        //console.log(hy);
	          	 ids2 = $('input[class="selecheck"]:checked').map(function() {
                        return $(this).attr('value');
                    }).get();
                resus2.push(ids2); 

				tot = resus2[0].length;
				tablas = document.getElementsByTagName('tbody')[0];
		        totals2=tablas.rows.length;	
							        
			        for (i = 0; i < tot; i++){//for_i
		          	msgForIn = resus[0][i]; //for_i

                        if(msgForIn==resus2[0][i]){
                        	
                        	for (j = 0; j < totals2;j++){//for_j
                    			//console.log("j: "+j);
	                        	var num_doctos   = tablas.rows[j].cells[1].childNodes[0].data;

	                        	if(num_doctos == msgForIn){
								  	var num_docto   = tablas.rows[j].cells[1].childNodes[0].data;				                        
					              	var area  	    = tablas.rows[j].cells[4].childNodes[0].data;
					              	var num_oficio  = tablas.rows[j].cells[5].childNodes[0].data;
					          
					              	var tm1  = new constructors();
					              	tm1.nd  = num_docto;
					              	var tm2  = new constructors();
					              	tm2.ara  = area;
					              	var tm3  = new constructors();
					              	tm3.no  = num_oficio;
					              
					              	newarrays2.push(tm1);
					              	newarrays.push(tm1);
					              	newarrays.push(tm2);
					              	newarrays.push(tm3);
							        table.row('.selected').remove().draw(false);
					              	//$('#myTable').DataTable().ajax.reload();
					              	//table.row(':eq(0)', { page: 'current' }).remove().draw();		
					            }                        			
                        	}//for_j
	                    }
		            }//for_i

		      	json2 = JSON.stringify(BlockID2(newarrays2));
		      	//console.log(json2);
		      	obj = JSON.parse(json2);
		      	nt = obj['newarrays2'][0]['totals'];
		      	ndt = "";
		      	for(let i = 1; i <= nt; i++) {
		      		ndt = ndt + obj['newarrays2'][i]['num_docto'] + ",";
				}
				//$("#nd_aut2").attr('readonly','readonly');
				$('#nd_aut2').val("Total Folios: "+nt+"\r\n"+ndt);

		        $("#progressBar2").css('color', 'black');
		        $("#prof2").css('height', '30px');
		  	    $("#progressBar2").css('height', '30px');
		        $("#progressBar2").text('0%');
		        $("#progressBar2").css('width', '0%');

		        var perc = 0;
		        var percentage = 0;
				var punto = ".";
				var timer;
		  		
   			    $("#dialog-aviso").show();
			    $("#dialog-aviso" ).dialog({//dialog
			      	resizable: false,
			      	draggable: false,
			      	height: "auto",
			      	width: 600,
			      	modal: true,
					title: "Documentos Revisados Captura",
					showCloseButton: false,
					closeOnEscape: false,
					open: function(event, ui) {
					    $('.ui-dialog-titlebar-close', ui.dialog | ui);
					    $(".ui-dialog .ui-dialog-titlebar-close").hide();
					},			      
			      	buttons: {//buttons
			        	"Aceptar": function() {//funcion si
				        	json1 = JSON.stringify(BlockID1(newarrays));
							//console.log(json1);
							//console.log(window.btoa(json1));
							console.log(urlCrearPDF);
							console.log(dir);
				          	$('#p_barra2').val("Cuando termine el proceso, ésta ventana se cerrará, por favor, espere.");
							$(".ui-button").hide();
							$("#p_barra2").show();

		                    $.ajax({
		                    	url: urlCrearPDF,
		                      	type: 'POST',
		                      	data: {
		                        	num_docto: window.btoa(json1),
		                        	usu: usuario,
		                        	dir: dir
		                    	},
		                        xhr: function () {
			                        var xhr = $.ajaxSettings.xhr();
			                        xhr.upload.onprogress = function (event) {
			                            perc = Math.round((event.loaded / event.total) * 1000);
			                            $("#prof2").css('height', '30px');
			                            $("#progressBar1").css('height', '30px');
			                            $("#progressBar1").css('color', 'black');
			                          
								        timer = setInterval(function(){
								      	percentage = percentage + 10;
								      	punto = punto + ".";
								      	$("#progressBar2").text("Procesando."+punto);
								      	$("#progressBar2").css('width', percentage + '%');
								      }, perc);
			                        };
			                        return xhr;
			                    },                            
		                        beforeSend: function (xhr) {
		                            $("#prof2").css('height', '30px');
		                            $("#progressBar2").css('height', '30px');
		                            $("#progressBar2").css('color', 'black');
		                            $("#progressBar2").text('0%');
		                            $("#progressBar2").css('width', '0%');                                    
		                        },                      
		                        success: function(result){
		                        	console.log(result);//hecho
		                        	
		                          if(result!=""){

		                              $("#prof2").css('height', '30px');
		                              $("#progressBar2").css('height', '30px');
		                              $("#progressBar2").css('color', 'black');
									  $("#progressBar2").text('100% - Carga realizada');
									  $("#dialog-aviso").hide();
									  $("#dialog-aviso" ).dialog( "close" );                                
		                              resus = [];
		                              resus2 = [];        
		                              //$('#nd_aut2').val("");    
		                              $('input:checkbox').prop('checked', false);
		                              $("#btnGetDataP").removeAttr("disabled");
		                              //$('#myTable').DataTable().ajax.reload();
		                              //$("button[class='ui-widget']").removeAttr("disabled");
		                              $(".ui-button").show();
		                              $("#p_barra2").hide();  
		                              var link = document.createElement('a');
				                      link.href = '../FUPs/Masivo_ORIGINAL/manual/'+result;
				                      link.download = result;
				                      link.click();
				                      
		                          }else{
		                          	
		                            // $('[id$=text_fup_mal]').text(result);
		                            // $("#dialog-fup_mal").show();
		                            // $("#dialog-fup_mal" ).dialog({//dialog
		                            //   resizable: false,
		                            //   height: "auto",
		                            //   width: 400,
		                            //   modal: true,
		                            //   buttons: {//buttons   
		                            //     OK: function() {
		                            //       $( this ).dialog( "close" );
		                            //     }
		                            //   }//buttons
		                            // });//dialog
		                            
		                          }
		                          
		                      	},
		                      	complete: function(){
							    	clearInterval(timer);
							    	ndt = "";
							    	resus = [];
		                         	resus2 = [];
		                          	//$('#nd_aut2').val("");
									$('#myTable').DataTable().ajax.reload();
									$( this ).dialog( "close" );
								}  	
		                	}); 

				        },//funcion si
				        Cancelar: function() {
					          $( this ).dialog( "close" );
					          $("#btnGetDataP").removeAttr("disabled");
					          resus = [];
					          resus2 = [];
					          ndt = "";
					          ids = "";
					          ids2 = "";
					          data = "";
				        }
			        }//buttons
			    });//dialog							
		    }//ifseleccion
		});//boton_autorizar

$('#myTable').DataTable({//myTable
                "language": {
                        "sProcessing":    "Procesando...",
                        "sLengthMenu":    "Mostrar _MENU_ registros",
                        "sZeroRecords":   "No se encontraron resultados",
                        "sEmptyTable":    "Ningún dato disponible en esta tabla",
                        "sInfo":          "Total de _TOTAL_ registros",
                        "sInfoEmpty":     "Total de 0 registros",
                        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":   "",
                        "sSearch":        "Buscar:",
                        "sUrl":           "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":    "Último",
                            "sNext":    "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                 },             
                searching: false,
                 ordering: false, //disable ordering
                initComplete: function( settings, json ) {
                  $("th").removeClass('sorting_asc'); //remove sorting_desc class
                },
                "iDisplayLength": 8,
                "lengthChange": false,
                "bPaginate":false,
                "bAutoWidth": false,
                "info":     false,
        });
});		
	</script>
	<style type="text/css">
	.warning {
	    background-color: #F99 !important;
	}		
		/*
	#progressBar1{
		background-color: white;	
	}
	*/
	#letra,#letra2,#textValidarAviso{
		color: black;
	}	
	thead th {
		position: sticky;
		z-index: 1;
		top: 0;
	}	
        #pdf_qna, #pdf_frame {
                width: 100%;
                height: 97%;
        padding:0;
                /*position: absolute;
                top: 400px;
                left: 0px;      */
                /*border: 1px solid red;*/
                border: none;
        }

	label{
		color: #FFFFFF;
	}
	#myTable{		
		/*position: absolute;
		top: 28px;
		right: 15px;*/	
		/*width: 98%;*/
		height: 420px;
		max-height: 420px;
		/*margin: 0 auto;*/
		  width: 100%;
		  clear: both;
		  border-collapse: collapse;
		  table-layout: fixed;
		  /*word-wrap:break-word;*/
	}
	th{
		/*border: 1px solid blue;*/
		background-color: #393939;
		text-align: center;
	}
	td{
	    text-align: center;
	}
	/*
	.dataTables_wrapper .dataTables_paginate {
		position: absolute;
	 	top: 522px;
	 	left: 400px;
	}
	.dataTables_wrapper .dataTables_info {
		position: absolute;
	 	top: -10px;
	 	left: 600px;
	}	
	*/
	#fin{
		position: absolute;
	 	top: 950px;
	}
	#select1{
		width: 12%;
		position: absolute;
		top: 6px;
	 	left: 280px;
	 	height: 40px;
	}	
	#select{
		width: 12%;
		position: absolute;
		top: 6px;
	 	left: 430px;
	 	height: 40px;
	}
	#pendientes{
		width: 50%;
		position: absolute;
	 	top: 0px;
	 	left: 10px;
	 	color: black;	
	 	font-size: 30px;	
	}
	#btnGetDataP{
		position: absolute;
	 	top: 6px;
	 	left: 500px;
	}	
	#textobs{
		color: black;	
	}
	#nd_aut,#nd_aut2{
		resize: none;
		border: none;
		width: 100%;
		height: 70px;
    	white-space: normal;
    	text-align: justify;
    	color: transparent;
  		text-shadow: 0px 0px 0px black;

	}
    #p_barra,#p_barra2{
        resize: none;
        border: none;
        width: 100%;        
        height: 30px;
        white-space: normal;
        text-align: justify;        
        font-weight: bold;
        font-size: 15px;
    } 	
	textarea:focus, input:focus{
    	outline: none;
	}
	th { font-size: 12px; }
	td { font-size: 11px; }
	th.hide_me, td.hide_me {
		display: none;
	}
	#myTable_filter label{
		color: black;
	}
	/*	
	.mrm {
	    position: absolute;
	 	top: -20px;
	 	left: 800px;
	 	width: 200px;
	}
	*/
	#textaviso{
		color: black;
	}	
    #divatabla{
            position: absolute;
            top: 50px;
            left: 0px;
            width: 98%;
            /*height: 100%;*/

    } 
	#pdf_4{
		position: absolute;
	 	left: 0px;		
	 	/*
	 	width: 100%;
	 	height: 100%;
	 	*/
	}	
	/*.progress{
		height: 100%;
	}*/
	/*#pdf_5{
		position: absolute;
	 	right: 0px;	
	 	width: 50%;
	 	height: 100%;
	}*/		
	</style>	
</head>
<body>
	
	<label id="pendientes">Fup´s Autorizados</label>
	<div style="text-align:center;">
        <select class="form-control" name="select1" id="select1">
                <option value="value" >Seleccionar...</option>
                <option value="Todos">Casi Todos</option>
                <option value="Cambios_CT">Cambios CT</option>
				<option value="Cambios_CT90">Cambios CT</option>
        </select>
        </div>
	<a href="#fin" id="link"><span></span></a>
	<br>
	<div id="divatabla">
	<form name="frm-example" id="frm-example">
   <table id="myTable" class="display">
        <thead>
            <tr>
               <th><input type="checkbox" name="select_all" value="1" id="example-select-all"><strong><label>Seleccionar</label></strong></th>
			   <th><strong><label>Número de Documento</label></strong></th>
			   <th><strong><label>RFC</label></strong></th>
			   <th><strong><label>Movimiento</label></strong></th>
			   <th><strong><label>Area</label></strong></th>
			   <th><strong><label>Número de Oficio</label></strong></th>			   		   
			   <th><strong><label>Mostrar</label></strong></th>
			   <!--th><strong><label>Imprimir</label></strong></th-->
            </tr>
        </thead>
        <tfoot>
            <tr>
			   <th><strong><label>Seleccionar</label></strong></th>
			   <th><strong><label>Número de Documento</label></strong></th>
			   <th><strong><label>RFC</label></strong></th>
			   <th><strong><label>Movimiento</label></strong></th>
			   <th><strong><label>Area</label></strong></th>
			   <th><strong><label>Número de Oficio</label></strong></th>			   
			   <th><strong><label>Mostrar</label></strong></th>
			   <!--th><strong><label>Imprimir</label></strong></th-->
            </tr>
        </tfoot>
    </table>
    </form>
	</div>
    <button type = "submit" name="btnGetDataP" class = "btn btn-success" id = "btnGetDataP" >Imprimir Fups</button>
    
    <div id="dialog-confirmPDF" title="¿Ver PDF?"  style="display: none;">
     	<iframe  name="pdf_qna" id="pdf_qna"></iframe>
    </div> 
    
    <div id="dialog-confirm" title="¿Ver PDF?"  style="display: none;">
     	<p>
     		<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Quieres Ver el Archivo PDF?
     	</p>
    </div> 
    <div id="dialog-confirm2" title="¡ERROR!"  style="display: none;">
    <p>
    	<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>No Hay Archivo PDF
    </p>
    </div>  
    <div id="dialog-obsr" title="OBSERVACIÓN"  style="display: none;">
		<label id="textobs"></label>
    </div>
    <div id="dialog-a4" title="¡Procesando..!"  style="display: none;">
    	<textarea id="p_barra"></textarea>       
        <div class="container">
        <div id="prof" class='progress' >
            <div id='progressBar1' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%;height:30px;' >
                <label id="letra">0%</label>
            </div>
        </div>
      </div>  
    </div> 
    <div id="dialog-seleccion" title="¡ATENCIÓN!"  style="display: none;">
		<label id="textaviso"></label>
    </div>  
    <div id="dialog-ValidarSeleccion" title="¡ATENCIÓN!"  style="display: none;">
		<label id="textValidarAviso"></label>
    </div>      
    <!--div id="dialog-confirmPDF_imprimir" title="¿Ver PDF?"  style="display: none;">
     	<iframe  name="pdf_frame" id="pdf_frame"></iframe>
    </div-->  
        <div id="dialog-aviso" title="¡AVISO!"  style="display: none;">
    	<textarea id="nd_aut2"></textarea>
    	<p style="font-size: 15px">
    		¡Creando FUPS Para Imprimir!
    	</p>
     	
     	<textarea id="p_barra2"></textarea>      	
    	<div class="container">
        <div id="prof2" class='progress' >
            <div id='progressBar2' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%;height:30px;' >
            	<label id="letra2">0%</label>
            </div>
        </div>
      </div>       	
    </div>    
</body>
</html>