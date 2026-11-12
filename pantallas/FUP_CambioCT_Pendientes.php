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
	<title>FUP CAMBIO CT PENDIENTES</title>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
	<script type="text/javascript">
		function menu_origenes(o1, o2, o3, o4, o5, o6, o7, o8, o9) {
			if (o1 == 1) {
				$("#Todos").show();
				$('#Todos').removeAttr('disabled');
			}
			if (o1 == 1) {
				$("#Temporales").show();
				$('#Temporales').removeAttr('disabled');
			}
			if (o2 == 1) {
				$("#Permisos").show();
				$('#Permisos').removeAttr('disabled');
			}
			if (o3 == 1) {
				$("#Definitivos").show();
				$('#Definitivos').removeAttr('disabled');
			}
			if (o4 == 1) {
				$("#Reingreso").show();
				$('#Reingreso').removeAttr('disabled');
			}
			if (o5 == 1) {
				$("#Historico").show();
				$('#Historico').removeAttr('disabled');
			}
			if (o6 == 1) {
				$("#Historico_o").show();
				$('#Historico_o').removeAttr('disabled');
			}
			if (o7 == 1) {
				$("#Num_Docto").show();
				$('#Num_Docto').removeAttr('disabled');
			}
			if (o8 == 1) {
				$("#TodosSND").show();
				$('#TodosSND').removeAttr('disabled');
			}
			if (o9 == 1) {
				$("#Actuales").show();
				$('#Actuales').removeAttr('disabled');
			}
		}
		$(document).on('click', '.envio', function(event) {
			var hermano = $(this).parent();
			$("#tabla2 tbody").prepend("<tr>\
          <td style='text-align: center; font-size:80%; padding:0px; '><input type='image' src='../Logo/subtract2.png' class='borrar' /></td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(0)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(1)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(2)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(3)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(4)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(5)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(6)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(7)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(8)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(9)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(10)").text() + "</td>\
          <td style='text-align: center; font-size:80%; padding:0px; '>" + hermano.siblings("td:eq(11)").text() + "</td>\
          <td style='display:none;' >" + hermano.siblings("td:eq(12)").text() + "</td>\
          <td style='display:none;'>" + hermano.siblings("td:eq(14)").text() + "</td>\
          <td style='display:none;'>" + hermano.siblings("td:eq(15)").text() + "</td>\
          <td style='display:none;'>" + hermano.siblings("td:eq(16)").text() + "</td>\
          <td style='display:none;'>" + hermano.siblings("td:eq(17)").text() + "</td>\
        </tr>")
		});
		$(function() {
			$('#tbody tr').click(function(e) {
				var a = $(this).closest('tr').find('a')
				e.preventDefault()
			})
		})
		$(document).on('click', '.borrar', function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});

		function mostrar(id) {
			if (id == "Num_Docto") {
				$("#por_documento").show();
			} else {
				$("#por_documento").hide();
			}
		}
		class constructors { //class constructor Plazas Selecionadas
			get total() {
				return this._total;
			}
			set total(total) {
				this._total = total;
			}

			get nd() {
				return this.num_docto;
			}
			set nd(nd) {
				this.num_docto = nd;
			}

			get rfc_() {
				return this.rfc;
			}
			set rfc_(rfc_) {
				this.rfc = rfc_;
			}

			get ara() {
				return this.area;
			}
			set ara(ara) {
				this.area = ara;
			}

			get no() {
				return this.num_oficio;
			}
			set no(no) {
				this.num_oficio = no;
			}
		}

		function format(d) {
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

		function load() {
			var seleccion = $('#seleccion').val();
			var id = $('#id').val();
			var oficio = $('#oficio').val();
			var area = $('#area').val();
			var rfc = $('#rfc').val();
			var usuario = $('#usuario').val();
			var por_documento = $('#por_documento').val();
			//async: true,			
			$('#load_data').empty();
			$loader = $('<tr id="loaders"><td colspan = "13"><center><img src="../Logo/loader.gif" alt="loading" /><br/>Un momento, por favor...</center></td></tr>');
			$loader.appendTo('#load_data');
			$.ajax({ //ajax
				url: '../Pdf/AntecedentesPrevio.php',
				type: 'POST',
				data: {
					seleccion: seleccion,
					id: id,
					oficio: oficio,
					area: area,
					rfc: rfc,
					por_documento: por_documento
				},
				success: function(result) { //funcion
					if (result != "") {
						$('#load_data').html(result);
						$loader.remove();
					} else {
						$('#load_data').html("<tr><td colspan = '13'>no se encontraron resultados</td></tr>");
						$loader.remove();
					}
				},
				error: function() {
					$('#load_data').html("<tr><td colspan = '13'>no se encontraron resultados</td></tr>");
					$loader.remove();
				}
			}); //ajax
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
		var table;
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
		var total2 = new constructors();
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

		$(document).ready(function() {
			$('#cerrar').click(function(e) {
				$("#exampleModalM").modal('hide'); //ocultamos el modal
				$('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
				$('.modal-backdrop').remove(); //eliminamos el backdrop del modal
			})

			tabla = "#myTable";

			$("#example-select-all").show();
			table = $('#myTable').DataTable({ //myTable
				destroy: true,
				"language": {
					"sProcessing": "Procesando...",
					"sLengthMenu": "Mostrar _MENU_ registros",
					"sZeroRecords": "No se encontraron resultados",
					"sEmptyTable": "Ningún dato disponible en esta tabla",
					"sInfo": "Total de _TOTAL_ registros",
					"sInfoEmpty": "Total de 0 registros",
					"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix": "",
					"sSearch": "Buscar:",
					"sUrl": "",
					"sInfoThousands": ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst": "Primero",
						"sLast": "Último",
						"sNext": "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				},
				responsive: false,
				ordering: false, //disable ordering
				initComplete: function(settings, json) {
					$("th").removeClass('sorting_asc'); //remove sorting_desc class
				},
				ajax: {
					url: "data_cambio_CT_Pendientes.php",
					//rowId: 'staffId'
					rowId: function(a) {
						return 'id_' + a.uid;
					},
					//url: "id.txt",
				},
				"lengthChange": false,
				"paging": false,
				"bAutoWidth": false,
				"info": true,
				columnDefs: [{
						'targets': 0,
						'searchable': false,
						'orderable': false,
						'className': 'dt-body-center',
						'render': function(aaData, type, full, meta) {
							return '<input type="checkbox" class=selecheck name="id[]" value="' + $('<div/>').text(aaData).html() + '">';
						},
						width: 50,
					},
					{
						'targets': 1,
						'searchable': false,
						'orderable': false,
						'className': 'dt-body-center',
						'render': function(aaData, type, full, meta) {
							return '<input type="button" class="btn btn-info" name="previo" value="Previo" id="previo">';
						}
					},
					{
						targets: 2, //num_docto
						visible: true,
						width: 70,
					},
					{
						targets: 3, //num_oficio
						visible: true,
						searchable: true,
					},
					{
						targets: 4, //rfc
						visible: true,
						searchable: false,
						//className: "hide_me",

					},
					{
						targets: 5, //plaza
						visible: true,
						searchable: true,
					},
					{
						targets: 6, //area nombre
						visible: true,
						searchable: true,
					},
					{
						targets: 7, //ct nuevo
						visible: true,
						searchable: true,
					},
					{
						targets: 8, //ct anterior
						visible: true,
						searchable: true,
					},
					{
						targets: 9, //area hide
						visible: true,
						searchable: true,
						className: "hide_me",
					},
					{
						targets: 10, //idAutorizar hide
						visible: true,
						searchable: true,
						className: "hide_me",
					},
					{
						targets: 11,
						'searchable': false,
						'orderable': false,
						'className': 'dt-body-center',
						'render': function(aaData, type, full, meta) {
							if (aaData != "") {
								return '<input type="button" class="btn btn-danger" name="FUP" value="FUP" id="FUP">';
							} else {
								return '';
							}
							// if(aaData.match(/[00000]/g) != null)
							// {
							// 	if (aaData.match(/[00000]/g).length == 5) 
							// 			{ 
							// 			return '';
							// 			}else{
							// 		return '<input type="button" class="btn btn-danger" name="FUP" value="FUP" id="FUP">';
							// 	}
							// }else{
							// 	return '<input type="button" class="btn btn-danger" name="FUP" value="FUP" id="FUP">';
							// }


						}
					}
				],

				dom: "<'row dom_wrapper fh-fixedHeader'B<'col-sm col-md'>i<'col-sm col-md'>l<'col-sm col-md'>f<'col-sm col-md'>>" +
					"<'row'<'col-sm col-md'tr>>" +
					"<'row '<'col-sm col-md'>p<'col-sm col-md'>>",


				/*	      		
							dom: "<'row dom_wrapper fh-fixedHeader'<'col-sm col-md'>i<'col-sm col-md'>>" +
							    "<'row'<'col-sm col-md'tr>>" +
							    "<'row '<'col-sm col-md'>p<'col-sm col-md'>>",	
				*/

				"buttons": {
					"dom": {
						"button": {
							"tag": "button",
							"className": "waves-effect waves-light btn mrm",
						}
					},

					buttons: [{
						extend: 'excelHtml5',
						filename: 'Cambio_CT_' + fechaYHora,
						text: '<button id="ExportCGRH" class="btn btn-primary">Exportar a Excel</button>',
						exportOptions: {
							columns: [2, 3, 4, 5, 6, 7, 8]
						}
					}, ]
				}

			}); //myTable


			table.on('click', '#previo', function(e) { //boton tabla
				//$(tabla+' tbody').on('click', '#mostrar', function (e) {//boton tabla

				frame = document.getElementById("pdf_qna");
				html = "";
				frame.contentWindow.document.open();
				frame.contentWindow.document.write(html);
				frame.contentWindow.document.close();

				var data = table.row($(this).parents('tr')).data();
				var id = data[2];
				var oficio = data[3];
				var area = data[9];
				var rfc = data[4];
				var usuario = "<?php echo $usuario ?>";

				$('#tabla2 > tbody').empty();
				$.ajax({
					//url: '../Pdf/CrearPDF/CrearPrevio_Pendientes.php',
					url: "../Pdf/Reimprimir/crearPDF_rOriginal_.php",
					type: 'POST',
					data: {
						//id: id,
						buscar: id,
						oficio: oficio,
						area: area,
						rfc: rfc,
						usuario: usuario
					},
					success: function(result) { //funcion
						if (result != "") {
							$('#pdf_qna').attr('src', result + "#toolbar=0&navpanes=0&scrollbar=1&zoom=100");
							$("#dialog-confirmPDF").show();
							$("#dialog-confirmPDF").dialog({ //dialog
								resizable: false,
								height: 700,
								width: 1300,
								modal: true,
								showCloseButton: false,
								closeOnEscape: false,
								open: function(event, ui) {
									$('.ui-dialog-titlebar-close', ui.dialog | ui);
									$(".ui-dialog .ui-dialog-titlebar-close").hide();
								},
								buttons: {
									Salir: function() {
										$(this).dialog("close");
									},
									Editar: function() { //Editar
										$('[id$=textValidarAviso]').text("Se borrará la información del documento.");
										$("#dialog-sin_datos").show();
										$("#dialog-sin_datos").dialog({ //dialog
											resizable: false,
											height: "auto",
											width: 400,
											modal: true,
											buttons: { //buttons	
												Aceptar: function() {
													$.ajax({
														url: 'Borrar_doc.php',
														type: 'POST',
														data: {
															doc: id,
														},
														success: function(result) { //funcion
															console.log(result);
														} //funcion
													}); //ajax
													//console.log("Editar");
													$("#exampleModalM").show();
													$("#exampleModalM").dialog({
														resizable: false,
														height: 700,
														width: 1300,
														modal: true,
														showCloseButton: true,
														closeOnEscape: false,
														/*
														open: function(event, ui) {
															$('.ui-dialog-titlebar-close', ui.dialog | ui);
															$(".ui-dialog .ui-dialog-titlebar-close").hide();
														},
														*/

														buttons: {
															Salir: function() {
																$(this).dialog("close");
															},
														}

													});
													$('#load_data').empty();
													$('#exampleModalLabel1').text("Antecedentes de: " + rfc + " " + oficio);
													$('#id').val(id);
													$('#oficio').val(oficio);
													$('#area').val(area);
													$('#rfc').val(rfc);
													$('#usuario').val(usuario);
													$(this).dialog("close");
												},
												Cancelar: function() {
													$(this).dialog("close");
												}
											} //buttons
										}); //dialog			
									} //Editar
								}
							}); //dialog
						} else { //else
							$("#dialog-confirm2").show();
							$("#dialog-confirm2").dialog({ //dialog
								resizable: false,
								height: "auto",
								width: 400,
								modal: true,
								buttons: {
									Salir: function() {
										$(this).dialog("close");
									}
								}
							}); //dialog
						} //else

					} //funcion
				}); //ajax
				/*
				$.ajax({
					url: 'Consultar_id',
					type: 'POST',
					data: {
					doc: id,
				},
					success: function(result){//funcion
						if(result == "Con Datos"){
							
						}//if hecho
						else{
							$('[id$=textValidarAviso]').text(result);
							$("#dialog-sin_datos").show();
							$("#dialog-sin_datos" ).dialog({//dialog
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
					}//funcion
				});//ajax
				*/

			}); //boton tabla
			table.on('click', '#FUP', function(e) { //boton tabla
				//$(tabla+' tbody').on('click', '#mostrar', function (e) {//boton tabla

				frame = document.getElementById("pdf_qnaFUP");
				html = "";
				frame.contentWindow.document.open();
				frame.contentWindow.document.write(html);
				frame.contentWindow.document.close();

				var data = table.row($(this).parents('tr')).data();
				var id = data[2];


				$.ajax({
					url: 'buscar_PDF_local.php',
					type: 'POST',
					data: {
						id: id,
					},
					success: function(result) { //funcion
						//console.log(result);
						if (result != "") {
							$('#pdf_qnaFUP').attr('src', result + "#toolbar=0&navpanes=0&scrollbar=1&zoom=77");
							$("#dialog-confirmPDFFUP").show();
							$("#dialog-confirmPDFFUP").dialog({ //dialog
								resizable: false,
								height: 600,
								width: 1100,
								modal: true,
								showCloseButton: false,
								closeOnEscape: false,
								open: function(event, ui) {
									$('.ui-dialog-titlebar-close', ui.dialog | ui);
									$(".ui-dialog .ui-dialog-titlebar-close").hide();
								},
								buttons: {
									Salir: function() {
										$(this).dialog("close");
									},
								}
							}); //dialog
						} else { //else
							$("#dialog-confirm2").show();
							$("#dialog-confirm2").dialog({ //dialog
								resizable: false,
								height: "auto",
								width: 400,
								modal: true,
								buttons: {
									Salir: function() {
										$(this).dialog("close");
									}
								}
							}); //dialog
						} //else

					} //funcion
				}); //ajax

			}); //boton tabla
			table.on('click', 'td.dt-control', function() {
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

			$(tabla + ' tbody').on('click', '#cancelar', function() { //boton rechazar tabla
				var data = table.row($(this).parents('tr')).data();
				var json1 = "undefined";
				var url = "cancelar_cgrh.php";
				var newarrays = new Array();

				$("#dialog-confirm_cancelar").show();
				$("#dialog-confirm_cancelar").dialog({ //dialog
					resizable: false,
					height: "auto",
					width: 400,
					modal: true,
					buttons: { //buttons
						"Si": function() { //funcion si
							var num_docto = data[2];
							var num_oficio = data[3];
							var area = data[8];
							var usuario = "<?php echo $usuario ?>";
							var obs = "Cancelar Captura";

							$.ajax({
								url: url,
								type: 'POST',
								data: {
									num_d: num_docto,
									area: area,
									num_oficio: num_oficio,
									usuario: usuario,
									obs: obs
								},
								success: function(result) {
									alert(result);
									$(tabla).DataTable().ajax.reload();
								}
							});
							table.row(':eq(0)', {
								page: 'current'
							}).remove().draw();


							$(this).dialog("close");
						}, //funcion si
						Cancelar: function() {
							$(this).dialog("close");
						}
					} //buttons
				}); //dialog
			}); //boton rechazar tabla

			$('#example-select-all').on('click', function() {
				var data = table.row({
					'search': 'applied'
				}).data();
				tablas = document.getElementsByTagName('tbody')[0];
				totals2 = tablas.rows.length;
				for (j = 0; j < totals2; j++) { //for_j
					var num_doctos = tablas.rows[j].cells[0].childNodes[0].value;
					$('input[value="' + num_doctos + '"]').prop('checked', this.checked);
				} //for_j 
			});

			$(tabla + ' tbody').on('change', 'input[type="checkbox"]', function() {
				// If checkbox is not checked
				if (!this.checked) {
					var el = $('#example-select-all').get(0);
					// If "Select all" control is checked and has 'indeterminate' property
					if (el && el.checked && ('indeterminate' in el)) {
						// Set visual state of "Select all" control
						// as 'indeterminate'
						el.indeterminate = true;
					}
				}
			});

			table.$('input[type="checkbox"]').each(function() {
				// If checkbox doesn't exist in DOM
				if (!$.contains(document, this)) {
					// If checkbox is checked
					if (this.checked) {
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

			$("#btnGetDataP").click(function() { //boton_autorizar
				//$("#btnGetDataP").attr("disabled", "disabled");
				$("#BuscarRelacion").val("");
				$("#BuscarRelacion_Checar").val("");

				var newarrays = new Array();
				var newarrays2 = new Array();
				var resus = new Array();
				var resus2 = new Array();

				data = table.$('input[type="checkbox"]').serialize();

				ids = $('input[class="selecheck"]:checked').map(function() {
					return $(this).attr('value');
				}).get();
				//console.log("ids: "+ids)
				resus.push(ids);
				//console.log(resus);
				total2.totals = resus[0].length;
				if (resus[0].length == 0) { //ifseleccion
					$('[id$=textValidarAviso]').text("Seleccione al menos un registro");
					$("#dialog-ValidarSeleccion").show();
					$("#dialog-ValidarSeleccion").dialog({ //dialog
						resizable: false,
						height: "auto",
						width: 400,
						modal: true,
						buttons: { //buttons	
							OK: function() {
								$(this).dialog("close");
							}
						} //buttons
					}); //dialog
				} else { //ifseleccion

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
					totals2 = tablas.rows.length;

					for (i = 0; i < tot; i++) { //for_i
						msgForIn = resus[0][i]; //for_i

						if (msgForIn == resus2[0][i]) {

							for (j = 0; j < totals2; j++) { //for_j
								//console.log("j: "+j);
								var num_doctos = tablas.rows[j].cells[3].childNodes[0].data;

								if (num_doctos == msgForIn) {
									var num_docto = tablas.rows[j].cells[2].childNodes[0].data;
									var num_oficio = tablas.rows[j].cells[3].childNodes[0].data;
									var rfc = tablas.rows[j].cells[4].childNodes[0].data;
									var plaza = tablas.rows[j].cells[5].childNodes[0].data;
									var area = tablas.rows[j].cells[9].childNodes[0].data;

									var tm1 = new constructors();
									tm1.nd = num_docto;
									var tm2 = new constructors();
									tm2.no = num_oficio;
									var tm3 = new constructors();
									tm3.rfc_ = rfc;
									var tm4 = new constructors();
									tm4.ara = area;

									newarrays2.push(tm2);
									newarrays.push(tm1);
									newarrays.push(tm2);
									newarrays.push(tm3);
									newarrays.push(tm4);
									table.row('.selected').remove().draw(false);
									//$('#myTable').DataTable().ajax.reload();
									//table.row(':eq(0)', { page: 'current' }).remove().draw();		
								}
							} //for_j
						}
					} //for_i

					json2 = JSON.stringify(BlockID2(newarrays2));
					//console.log(json2);
					obj = JSON.parse(json2);
					nt = obj['newarrays2'][0]['totals'];
					ndt = "";
					for (let i = 1; i <= nt; i++) {
						ndt = ndt + obj['newarrays2'][i]['num_oficio'] + ",";
					}
					//$("#nd_aut").attr('readonly','readonly');
					$('#nd_aut').val("Total Folios: " + nt + "\r\n" + ndt);

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
					$("#dialog-aviso").dialog({ //dialog
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
						buttons: { //buttons
							"Aceptar": function() { //funcion si
								json1 = JSON.stringify(BlockID1(newarrays));
								$('#p_barra').val("Cuando termine el proceso, ésta ventana se cerrará, por favor, espere.");
								$(".ui-button").hide();
								$("#p_barra").show();
								console.log(json1);
								console.log(window.btoa(json1));
								$.ajax({
									//url: "../Pdf/CrearPDF/CrearFUP_CambioCT_Pendientes.php",
									url: "../Pdf/CrearPDF/Actualizar_cambios_ct.php",
									type: 'POST',
									data: {
										num_docto: window.btoa(json1),
										usu: usuario
									},
									xhr: function() {
										var xhr = $.ajaxSettings.xhr();
										xhr.upload.onprogress = function(event) {
											perc = Math.round((event.loaded / event.total) * 1000);
											$("#prof").css('height', '30px');
											$("#progressBar1").css('height', '30px');
											$("#progressBar1").css('color', 'black');

											timer = setInterval(function() {
												percentage = percentage + 10;
												punto = punto + ".";
												$("#progressBar1").text("Procesando." + punto);
												$("#progressBar1").css('width', percentage + '%');
											}, perc);
										};
										return xhr;
									},
									beforeSend: function(xhr) {
										$("#prof").css('height', '30px');
										$("#progressBar1").css('height', '30px');
										$("#progressBar1").css('color', 'black');
										$("#progressBar1").text('0%');
										$("#progressBar1").css('width', '0%');
									},
									success: function(result) {
										if (result != "") {
											$("#prof").css('height', '30px');
											$("#progressBar1").css('height', '30px');
											$("#progressBar1").css('color', 'black');
											$("#progressBar1").text('100% - Carga realizada');
											$("#dialog-aviso").hide();
											$("#dialog-aviso").dialog("close");
											resus = [];
											resus2 = [];
											//$('#nd_aut').val("");    
											$('input:checkbox').prop('checked', false);
											$("#btnGetDataP").removeAttr("disabled");
											$('#myTable').DataTable().ajax.reload();
											//$("button[class='ui-widget']").removeAttr("disabled");
											$(".ui-button").show();
											$("#p_barra").hide();

										} else {

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
									complete: function() {
										clearInterval(timer);
										ndt = "";
										resus = [];
										resus2 = [];
										//$('#nd_aut').val("");
										$(tabla).DataTable().ajax.reload();
										$(this).dialog("close");
									}
								});
							}, //funcion si
							Cancelar: function() {
								$(this).dialog("close");
								$("#btnGetDataP").removeAttr("disabled");
								resus = [];
								resus2 = [];
								ndt = "";
								ids = "";
								ids2 = "";
								data = "";
							}
						} //buttons
					}); //dialog							
				} //ifseleccion
			}); //boton_autorizar		
		});
	</script>
	<?php
	include "../Scripts/script_Tabla_CT_Pendientes.php";
	?>

	<style type="text/css">
		#letra {
			color: black;
		}

		#pdf_qna,
		#pdf_qnaFUP {
			width: 100%;
			height: 97%;
			padding: 0;
			/*position: absolute;
		top: 400px;
		left: 0px;	*/
			/*border: 1px solid red;*/
			border: none;
		}

		.dataTable label {
			color: white;
		}

		#myTable2_filter label {
			color: black;
		}

		#myTable {
			height: 500px;
			max-height: 500px;
			width: 100%;
			clear: both;
			border-collapse: collapse;
			table-layout: fixed;
			/*word-wrap:break-word;*/
		}

		#myTables {
			height: 200px;
			max-height: 200px;
			width: 100%;
			clear: both;
			border-collapse: collapse;
			table-layout: fixed;
		}

		th {
			/*border: 1px solid blue;*/
			background-color: #393939;
			text-align: center;
		}

		td {
			text-align: center;
		}

		#fin {
			position: absolute;
			top: 950px;
		}

		#select1 {
			width: 12%;
			position: absolute;
			top: 6px;
			left: 300px;
			height: 40px;
		}

		#select {
			width: 12%;
			position: absolute;
			top: 6px;
			left: 430px;
			height: 40px;
		}

		#pendientes {
			width: 50%;
			position: absolute;
			top: 0px;
			left: 10px;
			color: black;
			font-size: 30px;
		}

		#btnGetDataP {
			position: absolute;
			top: 6px;
			left: 665px;
		}

		#BuscarRelacion,
		#BuscarRelacion_Checar {
			position: absolute;
			top: 6px;
			left: 455px;
			width: 18%;
		}

		#BuscarRelacionBtt {
			position: absolute;
			top: 6px;
			left: 770px;
		}

		#textobs {
			color: black;
		}

		#nd_aut {
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

		#p_barra {
			resize: none;
			border: none;
			width: 100%;
			height: 30px;
			white-space: normal;
			text-align: justify;
			font-weight: bold;
			font-size: 15px;
		}

		textarea:focus,
		input:focus {
			outline: none;
		}

		th {
			font-size: 12px;
		}

		td {
			font-size: 11px;
		}

		th.hide_me,
		td.hide_me {
			display: none;
		}

		#myTable_filter label {
			color: black;
		}

		#divatabla {
			position: absolute;
			top: 50px;
			left: 0px;
			width: 100%;
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
		/*	
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
	 	right: 0px;
	}
	#exampleModalM .modal-content {
		border-radius: 0 !important;
		height: 100%;
	}
*/
		#seleccion {
			position: absolute;
			top: 5px;
			left: 0px;
			width: 188px;
			height: 30px;
		}

		#por_documento {
			position: absolute;
			top: 7px;
			left: 200px;
			border-width: 2px;
			border-style: dotted;
			border-color: #0069D9;
		}

		#btn_search {
			position: absolute;
			top: 7px;
			left: 415px;
			height: 30px;
			width: 118px;
		}

		thead tr th {
			position: sticky;
			top: 0;
			z-index: 10;
			/*background-color: #ffffff;*/
		}

		#btnGetData {
			position: absolute;
			top: 6px;
			left: 548px;
			height: 30px;
			width: 118px;
		}

		#divTabla {
			position: absolute;
			top: 40px;
			left: 0px;
			height: 250px;
		}

		#divTabla2 {
			position: absolute;
			top: 270px;
			left: 0px;
			height: 220px;
		}
	</style>
</head>

<body>

	<label id="pendientes">FUP Cambio CT PENDIENTES</label>
	<div id="divatabla">
		<form name="frm-example" id="frm-example">
			<table id="myTable" cellspacing="0">
				<thead>
					<tr>
						<th><input type="checkbox" name="select_all" value="1" id="example-select-all"><strong><label>Autorizar</label></strong></th>
						<th><strong><label>Previo</label></strong></th>
						<th><strong><label>Documento</label></strong></th>
						<th><strong><label>Num Oficio</label></strong></th>
						<th><strong><label>RFC</label></strong></th>
						<th><strong><label>Plaza</label></strong></th>
						<th><strong><label>Area</label></strong></th>
						<th><strong><label>CT Nuevo</label></strong></th>
						<th><strong><label>Ct Anterior</label></strong></th>
						<th class="hide_me"><strong><label>Area Hide</label></strong></th>
						<th class="hide_me"><strong><label>idAutorizar Hide</label></strong></th>
						<th><strong><label>Ver FUP</label></strong></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><strong><label>Previo</label></strong></th>
						<th><strong><label>Autorizar</label></strong></th>
						<th><strong><label>Documento</label></strong></th>
						<th><strong><label>Num Oficio</label></strong></th>
						<th><strong><label>RFC</label></strong></th>
						<th><strong><label>Plaza</label></strong></th>
						<th><strong><label>Area</label></strong></th>
						<th><strong><label>CT Nuevo</label></strong></th>
						<th><strong><label>Ct Anterior</label></strong></th>
						<th class="hide_me"><strong><label>Area Hide</label></strong></th>
						<th class="hide_me"><strong><label>idAutorizar Hide</label></strong></th>
						<th><strong><label>Ver FUP</label></strong></th>
					</tr>
				</tfoot>
			</table>
		</form>
	</div>
	<button type="submit" name="btnGetDataP" class="btn btn-success" id="btnGetDataP">Autorizar</button>
	<input type="text" class="form-control producto" name="BuscarRelacion" id="relac" autocomplete="off" style="display: none;">
	<div id="dialog-confirmPDF" title="¿Ver PDF?" style="display: none;">
		<iframe name="pdf_qna" id="pdf_qna"></iframe>
	</div>
	<div id="dialog-confirm2" title="¡ERROR!" style="display: none;">
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>No Hay Archivo PDF
		</p>
	</div>
	<div id="dialog-confirm_cancelar" title="¡ADVERTENCIA!" style="display: none;">
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿En verdad quieres cancelarlo?
		</p>
	</div>
	<div id="dialog-aviso" title="¡AVISO!" style="display: none;">
		<textarea id="nd_aut"></textarea>
		<p style="font-size: 15px">
			Con fundamento en lo dispuesto en el Titulo Cuarto artículos 108, 109 fracción III de la Constitución Política de Los Estados Unidos Mexicanos, por los artículos 7, 8 fracciones I, IV, V de la Ley Federal de Responsabilidades Administrativas; artículos 7 fracciones III y VI, 16, 25 fracciones I, II, III, IV y V, 52, 56, 57, 62 y 63 de la Ley General de Responsabilidades Administrativas, y Ley Orgánica del Tribunal Federal de Justicia Administrativa, artículo 56 fracción I de la Ley de Responsabilidades de los Servidores Públicos del Estado y Municipios de San Luis Potosí, articulo 6 y 16 de la ley de responsabilidades administrativas del Estado.
		</p>
		<p style="font-size: 15px">
			Una vez revisados y validados los Formatos Unicos de Personal, y en términos de la legislacion vigente solicito su firma.
		</p>
		<textarea id="p_barra"></textarea>
		<div class="container">
			<div id="prof" class='progress'>
				<div id='progressBar1' class='progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%;height:30px;'>
					<label id="letra">0%</label>
				</div>
			</div>
		</div>
	</div>
	<div id="dialog-ValidarSeleccion" title="¡ATENCIÓN!" style="display: none;">
		<label id="textValidarAviso"></label>
	</div>
	<!--h2 id="fin"></h2-->
	<div id="dialog-fup_mal" title="¡ATENCIÓN!" style="display: none;">
		<textarea id="text_fup_mal"></textarea>
	</div>
	<div id="exampleModalM" title="Agregar o Editar Antecedentes" style="overflow-y: scroll; display: none;">
		<select name="seleccion" id="seleccion" class="form-control" onchange="mostrar(this.value);">
			<option value="" disabled selected hidden>Seleccionar </option> <!-- selected="yes" -->
			<option value="Actuales" id="Actuales" style="display: none;">Actuales</option>
			<option value="Todos" id="Todos" style="display: none;">Todos</option>
			<option value="TodosSND" id="TodosSND" style="display: none;">Todos Sin Numero Documento</option>
			<option value="Historico" id="Historico" style="display: none;">Histórico de Plazas del Movimiento</option>
			<!-- <option value="Historico_o" id="Historico_o" style="display: none;">Histórico Otras Plazas</option> -->
			<option value="Num_Docto" id="Num_Docto" style="display: none;">Por Documento</option>
		</select>

		<button type="submit" name="btn_search" class="btn btn-primary btn-sm" id="btn_search" onclick="load()">Ver Registros</button>
		<input type="text" id="por_documento" placeholder="Por Documento" value="" maxlength="10" style="display: none;">
		<button type="submit" name="btnGetData" class="btn btn-danger btn-sm" id="btnGetData">Crear FUP</button>

		<div id="divTabla" style="height:250px" class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th><strong>Agregar</strong></th>
						<th class="dt-head-center cod_pago"><strong>Cod. Pago</strong></th>
						<th class="dt-head-center unidad"><strong>Unidad</strong></th>
						<th class="dt-head-center subunidad"><strong>Subunidad</strong></th>
						<th class="dt-head-center cat_puesto"><strong>Puesto</strong></th>
						<th class="dt-head-center horas"><strong>Horas</strong></th>
						<th class="dt-head-center cons_plaza"><strong>Plaza</strong></th>
						<th class="dt-head-center mot_mov1"><strong>Motivo</strong></th>
						<th class="dt-head-center nivel_sueldo"><strong>Nivel Sueldo</strong></th>
						<th class="dt-head-center qna_ini"><strong>Qna. Inicial</strong></th>
						<th class="dt-head-center qna_fin"><strong>Qna. Fin</strong></th>
						<th class="dt-head-center num_docto"><strong>N°. de Documento</strong></th>
						<th class="dt-head-center ct"><strong>Centro Trabajo</strong></th>
					</tr>
				</thead>
				<tbody id="load_data" class="thead-light">
				</tbody>
			</table>
		</div>
		<div id="divTabla2" style="height:220px" class="table-responsive">
			<table id="tabla2" class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th class="dt-head-center cod_pago"><strong>Eliminar</strong></th>
						<th class="dt-head-center cod_pago"><strong>Codigo Pago</strong></th>
						<th class="dt-head-center unidad"><strong>Unidad</strong></th>
						<th class="dt-head-center subunidad"><strong>Subunidad</strong></th>
						<th class="dt-head-center cat_puesto"><strong>Puesto</strong></th>
						<th class="dt-head-center horas"><strong>Horas</strong></th>
						<th class="dt-head-center cons_plaza"><strong>Plaza</strong></th>
						<th class="dt-head-center mot_mov1"><strong>Motivo</strong></th>
						<th class="dt-head-center nivel_sueldo"><strong>Nivel Sueldo</strong></th>
						<th class="dt-head-center qna_ini"><strong>Qna. Inicial</strong></th>
						<th class="dt-head-center qna_fin"><strong>Qna. Fin</strong></th>
						<th class="dt-head-center num_docto"><strong>N°. Documento</strong></th>
						<th class="dt-head-center ct"><strong>Centro Trabajo</strong></th>
						<th style="display:none;" class="valor2"><strong>Valor2</strong></th>
					</tr>
				</thead>
				<tbody class="thead-light">
				</tbody>
			</table>
		</div>
		<input type="hidden" name="id" id="id" value="" />
		<input type="hidden" name="oficio" id="oficio" value="" />
		<input type="hidden" name="rfc" id="rfc" value="" />
		<input type="hidden" name="area" id="area" value="" />
		<input type="hidden" name="usuario" id="usuario" value="" />
	</div>
</body>
<div id="dialog-sin_datos" title="¡ATENCIÓN!" style="display: none;">
	<label id="textValidarAviso"></label>
</div>
<div id="dialog-confirmPDFFUP" title="¿Ver PDF?" style="display: none;">
	<iframe name="pdf_qnaFUP" id="pdf_qnaFUP"></iframe>
</div>

<script type="text/javascript">
	menu_origenes(1, 1, 1, 1, 1, 1, 1, 1, 1);
</script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">

</html>