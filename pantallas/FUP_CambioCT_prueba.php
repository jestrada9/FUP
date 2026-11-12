<?php
require_once('../Conexion/ServicioWeb.php');
	$usuario = $_GET['usuario'];
	$valor = "";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FUP CAMBIO CT</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="
    sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
		<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">    

<!--link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"-->
	<script>
		
 	class constructors{ //class constructor Plazas Selecionadas
      get total(){return this._total;}
      set total(total){this._total = total;}

      get nd(){return this.num_docto;}
      set nd(nd){this.num_docto = nd;}
	  
	  get rfc_(){return this.rfc;}
      set rfc_(rfc_){this.rfc = rfc_;}

      get ara(){return this.area;}
      set ara(ara){this.area = ara;}  

      get no(){return this.num_oficio;}
      set no(no){this.num_oficio = no;}            
    }

	function format(d) {
	    // `d` is the original data object for the row
	    //console.log(d);
	    return (
	        '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
	        '<tr>' +
	        '<td>Movimiento:</td>' +
	        '<td>' +
	        d[5] +
	        '</td>' +
	        '</tr>' +
	        '<tr>' +
	        '<td>Número Oficio:</td>' +
	        '<td>' +
	        d[9] +
	        '</td>' +
	        '</tr>' +
			'<tr>' +
	        '<td>Plazas:</td>' +
	        '<td>' +
	        d[3] +
	        '</td>' +
	        '</tr>' +	        
	        '</table>'
	    );
	}    
        function mostrar(id) {
          
          if(id == "select1") {
            let sele1 = $('#select1 option:selected').val();
            if (sele1=="Todos") {
                $("#select").hide();   
                $("#BuscarRelacion").hide();  
                $("#BuscarRelacion_Checar").hide();  
                $("#BuscarRelacionBtt").hide();  
                /*
                $("#select").show(); 
                $("option[value='Ordenamiento']").hide();
                */
            }else if (sele1=="Relacion") {
                $("#select").hide(); 
                $("#BuscarRelacion_Checar").hide();  
                $("#BuscarRelacion").show();   
                $("#BuscarRelacionBtt").show();  
                $("#BuscarRelacion").focus(); 
            }else if (sele1=="Relacion_Checar") {
                $("#select").hide(); 
                $("#BuscarRelacion").hide();   
                $("#BuscarRelacion_Checar").show()
                $("#BuscarRelacionBtt").show();  
                $("#BuscarRelacion_Checar").focus(); 
            }else{
                $("#select").show();  
                $("#BuscarRelacion").hide();   
                $("#BuscarRelacionBtt").hide();
                $("#BuscarRelacion_Checar").hide();  
            }
          }   
        }


	var hoy = new Date();
	var hora = hoy.getHours() + '-' + hoy.getMinutes();

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

	$(document).ready( function () {
        $('#cerrar').click(function (e) {
            
            $("#exampleModalM").modal('hide');//ocultamos el modal
  			$('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
  			$('.modal-backdrop').remove();//eliminamos el backdrop del modal
            console.log("hola");
        })
        
		tabla = "#myTable1"; 	


      $("#example-select-all").show();
			table = $('#myTable').DataTable({//myTable
				destroy: true,
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
			responsive: false,
      		ordering: false, //disable ordering
                initComplete: function( settings, json ) {
                  $("th").removeClass('sorting_asc'); //remove sorting_desc class
                },
      		ajax:{
      			url: "data_cambio_CT.php",
      			//rowId: 'staffId'
      			rowId: function(a) {
    				return 'id_' + a.uid;
  				},
      			//url: "id.txt",
      		},
				"lengthChange": false,
				"paging": false,
				"bAutoWidth": false,
				"info":     true,
	      columnDefs: [
		        {
		        	'targets': 0,
			        'searchable': false,
			        'orderable': false,
			        'className': 'dt-body-center',
		        	'render': function (aaData, type, full, meta){
	             	return '<input type="checkbox" class=selecheck name="id[]" value="' + $('<div/>').text(aaData).html() + '">';
		        	}
		    		},
	            {
                	targets: 1,//num_docto
                	visible: true,
                	width: 70,                	
            	},	            
	            {
                	targets: 2,//num_oficio
                	visible: true,
                	searchable: true,               	
            	},
            	{
                	targets: 3,//rfc
                	visible: true,
                	searchable: false,
                	//className: "hide_me",
                	
            	},  
            	{
                	targets: 4,//plaza
                	visible: true,
                	searchable: true,
            	},             	          	           	
            	{
                	targets: 5,//area nombre
                	visible: true,
                	searchable: true,
            	},   
            	{
                	targets: 6,//ct nuevo
                	visible: true,
                	searchable: true,
            	}, 
            	{
                	targets: 7,//ct anterior
                	visible: true,
                	searchable: true,
            	},  
            	{
                	targets: 8,//area hide
                	visible: true,
                	searchable: true,
                	className: "hide_me",
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
	                filename: 'Cambio_CT_'+fechaYHora,
	                text: '<button id="ExportCGRH" class="btn btn-primary">Exportar a Excel</button>',
	                exportOptions: {
	                    columns: [ 1, 2, 3, 4, 5,6,7]
	                }
	            },
	        ]
			}	        
			});//myTable
			
			//$("#myTable_filter").remove();
			//$("input[type=search]").hide();
			table.on('click', '#mostrar', function (e) {//boton tabla
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

		$(tabla+' tbody').on('click', '#obsers', function () {//boton observacion

	        var data = table.row($(this).parents('tr')).data();
	        var obs = data[10];
				//$('#textobs').text(obs);
				$('[id$=textobs]').text(obs);

		      $("#dialog-obsr").show();
			    $("#dialog-obsr" ).dialog({//dialog
			      resizable: false,
			      height: "auto",
			      width: 400,
			      modal: true,
			      buttons: {//buttons	
			        Cancelar: function() {
			          $( this ).dialog( "close" );
			        }
			      }//buttons
			    });//dialog
		});//boton observacion

		table.on('click', 'td.dt-control', function () {
		 	//$(tabla+' tbody').on('click', 'td.dt-control', function () {
	        var tr = $(this).closest('tr');
	        var row = table.row(tr);
	 
	        if (row.child.isShown()) {
	            // This row is already open - close it
	            row.child.hide();
	            tr.removeClass('shown');
	        } else {
	            // Open this row
	            row.child(format(row.data())).show();
	            tr.addClass('shown');
	        }
	    });

		$(tabla+' tbody').on('click', '#cancelar', function () {//boton rechazar tabla
	        var data = table.row($(this).parents('tr')).data();
	        var json1 = "undefined";
			var url = "cancelar_cgrh.php";
			var newarrays= new Array();

				             

		        $("#dialog-confirm_cancelar").show();
			    $("#dialog-confirm_cancelar" ).dialog({//dialog
			      resizable: false,
			      height: "auto",
			      width: 400,
			      modal: true,
			      buttons: {//buttons
			        "Si": function() {//funcion si
		          		var num_docto  = data[1];
		          		var area 	   	 = data[8];
		          		var num_oficio = data[9];
		          		var usuario    = "<?php echo $usuario ?>";
		          		var obs = "Cancelar Captura";

					          $.ajax({
					              url: url,
					              type: 'POST',
					              data: {
					                num_d : num_docto,
					                area:area,
					                num_oficio: num_oficio,
					                usuario: usuario,
					                obs: obs
					              },
					              success: function(result){
					                alert(result);
					                $(tabla).DataTable().ajax.reload();
					              }
					          });
					          table.row(':eq(0)', { page: 'current' }).remove().draw();

		          		
			            $( this ).dialog( "close" );
			        },//funcion si
			        Cancelar: function() {
			          $( this ).dialog( "close" );
			        }
			      }//buttons
			    });//dialog
			});//boton rechazar tabla

	$('#example-select-all').on('click', function(){
			var data = table.row({ 'search': 'applied' }).data();
			tablas = document.getElementsByTagName('tbody')[0];
      totals2=tablas.rows.length;	    
      for (j = 0; j < totals2;j++){//for_j
    	var num_doctos   = tablas.rows[j].cells[0].childNodes[0].value;
            //if(j<=99){
/*    	
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
                //}
*/
                $('input[value="'+num_doctos+'"]').prop('checked', this.checked);
            //}
    	}//for_j 
   });

$(tabla+' tbody').on('change', 'input[type="checkbox"]', function(){
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

		var val2 = false;
		$('input[type="search"]').change(function() {
		  	var val = "";
		  	var input = $('input[type="search"]');
		  	val = input.val();

		  	if (val != "") {
		     	val2 = true;
		  	}
		});

		$("#btnGetDataP").click(function() {//boton_autorizar
			//$("#btnGetDataP").attr("disabled", "disabled");
			$("#BuscarRelacion").val("");
			$("#BuscarRelacion_Checar").val("");

			var newarrays= new Array();
			var newarrays2= new Array();
			var resus= new Array();
			var resus2= new Array();  

			data = table.$('input[type="checkbox"]').serialize();

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
	                        	var num_doctos   = tablas.rows[j].cells[2].childNodes[0].data;

	                        	if(num_doctos == msgForIn){
								  	var num_docto   = tablas.rows[j].cells[1].childNodes[0].data;				                        
					              	var num_oficio 	= tablas.rows[j].cells[2].childNodes[0].data;
					              	var rfc  	    = tablas.rows[j].cells[3].childNodes[0].data;
					              	var plaza  	    = tablas.rows[j].cells[4].childNodes[0].data;
					              	var area  		= tablas.rows[j].cells[8].childNodes[0].data;
					          		console.log(num_docto);
					          		console.log(num_oficio);
					              	var tm1  = new constructors();
					              	tm1.nd  = num_docto;
					              	var tm2  = new constructors();
					              	tm2.no  = num_oficio;
					              	var tm3  = new constructors();
					              	tm3.rfc_  = rfc;
					              	var tm4  = new constructors();
					              	tm4.ara  = area;
					              	
					              	newarrays2.push(tm1);
					              	newarrays.push(tm1);
					              	newarrays.push(tm2);
					              	newarrays.push(tm3);
					              	newarrays.push(tm4);
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
				//$("#nd_aut").attr('readonly','readonly');
				$('#nd_aut').val("Total Folios: "+nt+"\r\n"+ndt);

		        $("#progressBar1").css('color', 'black');
		        $("#prof").css('height', '30px');
		  	    $("#progressBar1").css('height', '30px');
		        $("#progressBar1").text('0%');
		        $("#progressBar1").css('width', '0%');

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
							console.log(window.btoa(json1));
				          	$('#p_barra').val("Cuando termine el proceso, ésta ventana se cerrará, por favor, espere.");
							$(".ui-button").hide();
							$("#p_barra").show();
							console.log(json1);
/*
		                    $.ajax({
		                    	url: "../Pdf/CrearPDF/crearFUP_CambioCT.php",
		                      	type: 'POST',
		                      	data: {
		                        	num_docto: window.btoa(json1),
		                        	pendientes: "Captura",
		                        	usu: usuario
		                    	},
		                        xhr: function () {
			                        var xhr = $.ajaxSettings.xhr();
			                        xhr.upload.onprogress = function (event) {
			                            perc = Math.round((event.loaded / event.total) * 1000);
			                            $("#prof").css('height', '30px');
			                            $("#progressBar1").css('height', '30px');
			                            $("#progressBar1").css('color', 'black');
			                          
								        timer = setInterval(function(){
								      	percentage = percentage + 10;
								      	punto = punto + ".";
								      	$("#progressBar1").text("Procesando."+punto);
								      	$("#progressBar1").css('width', percentage + '%');
								      }, perc);
			                        };
			                        return xhr;
			                    },                            
		                        beforeSend: function (xhr) {
		                            $("#prof").css('height', '30px');
		                            $("#progressBar1").css('height', '30px');
		                            $("#progressBar1").css('color', 'black');
		                            $("#progressBar1").text('0%');
		                            $("#progressBar1").css('width', '0%');                                    
		                        },                      
		                        success: function(result){
		                        	//console.log(result);//hecho
		                          if(result!=""){
		                              $("#prof").css('height', '30px');
		                              $("#progressBar1").css('height', '30px');
		                              $("#progressBar1").css('color', 'black');
									  $("#progressBar1").text('100% - Carga realizada');
									  $("#dialog-aviso").hide();
									  $("#dialog-aviso" ).dialog( "close" );                                
		                              resus = [];
		                              resus2 = [];        
		                              //$('#nd_aut').val("");    
		                              $('input:checkbox').prop('checked', false);
		                              $("#btnGetDataP").removeAttr("disabled");
		                              //$('#myTable').DataTable().ajax.reload();
		                              //$("button[class='ui-widget']").removeAttr("disabled");
		                              $(".ui-button").show();
		                              $("#p_barra").hide();  

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
		                          	//$('#nd_aut').val("");
									$(tabla).DataTable().ajax.reload();
									$( this ).dialog( "close" );
								}  	
		                	}); 

*/
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
});		
	</script>
	<style type="text/css">
/*		
.ui-state-default .ui-icon {
    background-image: url(http://download.jqueryui.com/themeroller/images/ui-icons_ffffff_256x240.png) !important;
}

input#opener {
   height: 30px;
   width: 200px;
   left: 50%;
   margin-top: -15px;
   margin-left: -100px;
   position: fixed;
   top: 80%;
   background: rgba(4, 115, 184, 0.9);
   color: #fff;
   font-style: Arial;
   font-size: 16px;
   font-weight: 700;
   line-height: 1.5;
   border-style: outset;
   display: flex;
   transition: .5s ease;
   vertical-align: middle;
   justify-content: center;
 }
 
 .myTitleClass .ui-dialog-title {
   white-space: normal;
 }
 
 .myTitleClass .ui-dialog-titlebar {
   background: rgba(4, 115, 184, 0.9);
   color: #fff;
   font-size: 16px;
   font-weight: 700;
   height: 60px;
 }
 .myTitleClass .ui-widget-content .ui-state-default {
   background-image: none;

   color: #fff;
   font-size: 16px;
   font-weight: 700;
   border-style: none;
 }
 
 .myTitleClass .ui-widget-content .ui-state-hover {
   background-image: none;
   background-color: rgb(4, 127, 184);
   color: #fff;
   font-size: 16px;
   font-weight: 700;
   border-style: none;
 }
 
 .ui-widget-overlay {
   position: fixed;
   background: black;
 }
 
 .myTitleClass .ui-dialog-titlebar-close {
   background: rgba(4, 115, 184, 0.9);
   border-radius: 17px;
   height: 33px;
   margin: -10px 0 0;
   padding: 1px;
   position: absolute;
   right: -28px;
   top: -24%;
   width: 33px;
 }
 .ui-dialog-titlebar-close
 .myTitleClass.ui-icon-close {
   background-image: url("images/ui-icons_ffffff_256x240.png");
 }
 
 .ui-dialog {
   overflow: visible;
 }
}
*/
	#letra{
		color: black;
	}	
	#pdf_qna {
		width: 100%;
		height: 97%;
    	padding:0;
		/*position: absolute;
		top: 400px;
		left: 0px;	*/
		/*border: 1px solid red;*/
		border: none;
	}

	.dataTable label {
		color: white;
	}
	#myTable2_filter label{
		color:black;
	}	
	#myTable{		
		/*position: absolute;
		top: 28px;
		right: 15px;*/	
		/*width: 98%;*/
		height: 500px;
		max-height: 500px;
		/*margin: 0 auto;*/
		  width: 100%;
		  clear: both;
		  border-collapse: collapse;
		  table-layout: fixed;
		  /*word-wrap:break-word;*/
	}
	##myTables{
				height: 200px;
		max-height: 200px;
		/*margin: 0 auto;*/
		  width: 100%;
		  clear: both;
		  border-collapse: collapse;
		  table-layout: fixed;
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
                left: 300px;
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
                left: 665px;
        }   
        #BuscarRelacion, #BuscarRelacion_Checar{
                position: absolute;
                top: 6px;
                left: 455px;
                width: 18%;
        }   
        #BuscarRelacionBtt{
                position: absolute;
                top: 6px;
                left: 770px;
        }  	
	#textobs{
		color: black;	
	}
	#nd_aut{
		resize: none;
		border: none;
		width: 100%;
		height: 70px;
    	white-space: normal;
    	text-align: justify;
    	color: transparent;
  		text-shadow: 0px 0px 0px black;
		font-size: 15px;
	}
	#p_barra{
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
	#divatabla{
		position: absolute;
	 	top: 50px;
	 	left: 0px;
	 	width: 100%;
	}	
	#exampleModalM .modal{
		padding: 0 !important;
	}
	#exampleModalM .modal-dialog {
		max-width: 100% !important;
		height: 100%;
		padding: 0;
		margin: 0;
		position: absolute;
		top: 0px;
	 	left: 0px;
	}
	/*
	@media (max-width: 1440px) {
		#exampleModalM .modal-dialog {
			max-width: 100% !important;
			height: 100%;
			padding: 0;
			margin: 0;
			position: absolute;
			top: 0px;
		 	right: 0px;
		}
	}
	*/
	#exampleModalM .modal-content {
	border-radius: 0 !important;
	height: 100%;
	}
	</style>	
</head>

<body>
	
	<label id="pendientes">FUP Cambio CT</label>
	<!--a href="#fin" id="link"><span></span></a-->
	<div style="text-align:center;">
	<!--select class="form-control" name="select" id="select" >
		<option value="value0" selected>Seleccionar...</option>
  		<option value="Ordenamiento">Ordenamiento</option>
  		<option value="NO_Ordenamiento">NO Ordenamiento</option>
  		<option value="Bajas">Bajas</option>
  		<option value="Licencias">Licencias</option>
	</select-->
	</div>
	<br>
	<div id="divatabla">
	<form name="frm-example" id="frm-example">
   <table id="myTable" cellspacing="0">
        <thead>
            <tr>
               <th><input type="checkbox" name="select_all" value="1" id="example-select-all"><strong><label>Autorizar</label></strong></th>
			   <th><strong><label>Documento</label></strong></th>
			   <th><strong><label>Num Oficio</label></strong></th>
			   <th><strong><label>RFC</label></strong></th>
			   <th><strong><label>Plaza</label></strong></th>
			   <th><strong><label>Area</label></strong></th>
			   <th><strong><label>CT Nuevo</label></strong></th>
			   <th><strong><label>Ct Anterior</label></strong></th>
			   <th  class="hide_me"><strong><label>Area Hide</label></strong></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
			   <th><strong><label>Autorizar</label></strong></th>
			   <th><strong><label>Documento</label></strong></th>
			   <th><strong><label>Num Oficio</label></strong></th>
			   <th><strong><label>RFC</label></strong></th>
			   <th><strong><label>Plaza</label></strong></th>
			   <th><strong><label>Area</label></strong></th>
			   <th><strong><label>CT Nuevo</label></strong></th>
			   <th><strong><label>Ct Anterior</label></strong></th>
			   <th  class="hide_me"><strong><label>Area Hide</label></strong></th>
            </tr>
        </tfoot>
    </table>
    </form>
	</div>
        <!--input type="text" name="BuscarRelacion" id="BuscarRelacion" placeholder="Relacion" class="form-control"-->
        <button type = "submit" name="btnGetDataP" class = "btn btn-success" id = "btnGetDataP" >Crear</button>
        <input type="text" class="form-control producto" name="BuscarRelacion" id="relac" autocomplete="off" style="display: none;">
        <!--button type = "submit" name="BuscarRelacionBtt" class = "btn btn-info" id = "BuscarRelacionBtt" >Buscar</button-->
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
    <div id="dialog-confirm_cancelar" title="¡ADVERTENCIA!"  style="display: none;">
    <p>
    	<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿En verdad quieres cancelarlo?
    </p>
    </div>    
    <div id="dialog-aviso" title="¡AVISO!"  style="display: none;">
    	<textarea id="nd_aut"></textarea>
    	<p style="font-size: 15px">
    		Con fundamento en lo dispuesto en el Titulo Cuarto artículos 108, 109 fracción III de la Constitución Política de Los Estados Unidos Mexicanos, por los artículos 7, 8 fracciones I, IV, V de la Ley Federal de Responsabilidades Administrativas; artículos 7 fracciones III y VI, 16, 25 fracciones I, II, III, IV y V, 52, 56, 57, 62 y 63 de la Ley General de Responsabilidades Administrativas, y Ley Orgánica del Tribunal Federal de Justicia Administrativa, artículo 56 fracción I de la Ley de Responsabilidades de los Servidores Públicos del Estado y Municipios de San Luis Potosí, articulo 6 y 16 de la ley de responsabilidades administrativas del Estado.
    	</p>
     	<p style="font-size: 15px">
     		Una vez revisados y validados los Formatos Unicos de Personal, y en términos de la legislacion vigente solicito su firma.
     	</p>
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
    <!--h2 id="fin"></h2-->
    <iframe id="iframePagina1" src="../index.php" style="display: none;"></iframe> 
    <div id="dialog-fup_mal" title="¡ATENCIÓN!"  style="display: none;">
    	<textarea id="text_fup_mal"></textarea>
    </div>
</body>

</html>
