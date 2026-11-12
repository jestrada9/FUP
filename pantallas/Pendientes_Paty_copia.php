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
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.5/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">

	<script>
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
		/*
	    function mostrar(id) {
          //alert(id);
          if(id == "select1") {
            $("#select").show();     
          }   
        }
        */
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
		var url = "update_autorizar_1.php";

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

			$("#example-select-all").hide();
			table = $('#myTable').DataTable({ //myTable
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
				searching: false,
				ordering: false,
				"lengthChange": false,
				"paging": false,
				"bAutoWidth": false,
				"info": false,
			});

			$("#select1").change(function() {
				var estado = $("#select1").val();
				$('#select').val('value0');
			});

			$("#select1").change(function() { //select1			
				sele1 = $(this).children("option:selected").val();
				url_baja = "buscar_PDF_local.php";
				//urlCrearPDF = "../Pdf/Reimprimir/crearPDF.php";  
				urlCrearPDF = "editar_fup.php";

				if (sele1 == "Todos") {
					aaData = "data_Paty_Unico.php?cons=1";
					$("#myTable").attr("id", "myTable1");
					$("#myTable2").attr("id", "myTable1");
					$("#myTable3").attr("id", "myTable1");
					tabla = "#myTable1";
				} else if (sele1 == "Bajas") {
					aaData = "data_Paty_Unico.php?cons=2";
					$("#myTable").attr("id", "myTable2");
					$("#myTable1").attr("id", "myTable2");
					$("#myTable3").attr("id", "myTable2");
					tabla = "#myTable2";
				} else if (sele1 == "Guiones") {
					aaData = "data_Paty_Unico.php?cons=3";
					$("#myTable").attr("id", "myTable3");
					$("#myTable1").attr("id", "myTable3");
					$("#myTable2").attr("id", "myTable3");
					tabla = "#myTable3";
				}

				$("#example-select-all").show();
				table = $(tabla).DataTable({ //myTable
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
						url: aaData
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
							}
						},
						{
							targets: 0, //checkbox
							visible: true,
							width: 50,
						},
						{
							targets: 3, //plazas
							visible: true,
							width: 90,
						},
						{
							targets: 4, //fecha
							visible: true,
							searchable: true,
						},
						{
							targets: 5, //movs
							visible: true,
							searchable: false,
							className: "hide_me",

						},
						{
							targets: 6, //info
							className: 'dt-control',
							visible: true,
							orderable: false,
							data: null,
							defaultContent: '',
							width: 10,
						},
						{
							targets: 7, //area nombre
							visible: true,
							searchable: true,
						},
						{
							targets: 8, //area
							visible: true,
							searchable: false,
							className: "hide_me",

						},
						{
							targets: 9, //num folio
							visible: true,
							searchable: false,
							className: "hide_me",

						},
						{
							targets: 10, //observaciones
							visible: true,
							className: "hide_me",
						},
						{
							targets: 11,
							data: null,
							"mRender": function(data, type, value) {
								if (value[10] != "") {
									return '<button type="button" id="obsers" class="btn btn-outline-danger btn-sm">VER</button>';
								} else {
									return '<button type="button" id="obsers" class="btn btn-outline-dark btn-sm">VER</button>';
								}
							}
							//defaultContent: '<button type="button" id="obsers" class="btn btn-outline-dark btn-sm">Observaciones</button>',
						},
						{
							targets: 12,
							data: null,
							defaultContent: '<button type="button" id="mostrar" class="btn btn-outline-dark btn-sm">Ver</button>',
						},
						{
							targets: -1,
							data: null,
							defaultContent: '<button type="button" id="cancelar" class="btn btn-outline-danger btn-sm">Cancelar</button>',
						}
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

						buttons: [{
							extend: 'excelHtml5',
							filename: 'Autorizar Captura_' + sele1 + '_' + fechaYHora,
							text: '<button id="ExportCGRH" class="btn btn-primary">Exportar a Excel</button>',
							exportOptions: {
								columns: [1, 2, 3, 4, 5, 7, 8, 9]
							}
						}, ]
					}
				}); //myTable

				//$("#myTable_filter").remove();
				//$("input[type=search]").hide();
				table.on('click', '#mostrar', function(e) { //boton tabla
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
						success: function(result) { //funcion
							//console.log(result);
							if (result != "") {

								$('#pdf_qna').attr('src', result + "#toolbar=1&navpanes=1&scrollbar=1&zoom=67");
								$("#dialog-confirmPDF").show();
								$("#dialog-confirmPDF").dialog({ //dialog
									resizable: false,
									height: 590,
									width: 990,
									modal: true,
									buttons: {
										OK: function() {
											$(this).dialog("close");
										}
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
										OK: function() {
											$(this).dialog("close");
										}
									}
								}); //dialog
							} //else
						} //funcion
					}); //ajax
				}); //boton tabla

				$(tabla + ' tbody').on('click', '#obsers', function() { //boton observacion

					var data = table.row($(this).parents('tr')).data();
					var obs = data[10];
					//$('#textobs').text(obs);
					$('[id$=textobs]').text(obs);

					$("#dialog-obsr").show();
					$("#dialog-obsr").dialog({ //dialog
						resizable: false,
						height: "auto",
						width: 400,
						modal: true,
						buttons: { //buttons	
							Cancelar: function() {
								$(this).dialog("close");
							}
						} //buttons
					}); //dialog

				}); //boton observacion

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
								var num_docto = data[1];
								var area = data[8];
								var num_oficio = data[9];
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
						//console.log("j: "+j);
						var num_doctos = tablas.rows[j].cells[0].childNodes[0].value;
						//console.log("num_doctos: "+num_doctos);
						if (j <= 99) {
							$('[id$=textaviso]').text("Solo se permiten seleccionar 100 registros");
							$("#dialog-seleccion").show();
							$("#dialog-seleccion").dialog({ //dialog
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
							$('input[value="' + num_doctos + '"]').prop('checked', this.checked);
						}
					}
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
				$('span[class="ui-button-icon ui-icon ui-icon-closethick"]').click(function() { //boton_autorizar
					console.log("aqui");
				});

				$("#btnGetDataP").click(function() { //boton_autorizar
					$("#btnGetDataP").attr("disabled", "disabled");
					/*				var iframeDocument = document.getElementById('iframePagina1').contentDocument;
									var miDiv = iframeDocument.getElementById('containers');
									console.log(miDiv);
					  			$(miDiv).css('pointer-events','none');*/

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
						//console.log(tabla);		
						//console.log(table);		
						tablas = document.getElementsByTagName('tbody')[0];
						totals2 = tablas.rows.length;

						for (i = 0; i < tot; i++) { //for_i
							msgForIn = resus[0][i]; //for_i

							if (msgForIn == resus2[0][i]) {

								for (j = 0; j < totals2; j++) { //for_j
									//console.log("j: "+j);
									var num_doctos = tablas.rows[j].cells[1].childNodes[0].data;

									if (num_doctos == msgForIn) {
										var num_docto = tablas.rows[j].cells[1].childNodes[0].data;
										var area_nombre = tablas.rows[j].cells[7].childNodes[0].data;
										var area = tablas.rows[j].cells[8].childNodes[0].data;
										var num_oficio = tablas.rows[j].cells[9].childNodes[0].data;

										var tm1 = new constructors();
										tm1.nd = num_docto;
										var tm2 = new constructors();
										tm2.ara = area;
										var tm3 = new constructors();
										tm3.no = num_oficio;

										newarrays2.push(tm1);
										newarrays.push(tm1);
										newarrays.push(tm2);
										newarrays.push(tm3);
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
							ndt = ndt + obj['newarrays2'][i]['num_docto'] + ",";
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
							height: "auto",
							width: 600,
							modal: true,
							title: "Documentos a Autorizar Captura",
							showCloseButton: false,
							closeOnEscape: false,
							open: function(event, ui) {
								$('.ui-dialog-titlebar-close', ui.dialog | ui);
								$(".ui-dialog .ui-dialog-titlebar-close").hide();
							},
							buttons: { //buttons
								"Aceptar": function() { //funcion si
									json1 = JSON.stringify(BlockID1(newarrays));
									console.log(json1);
									console.log(urlCrearPDF);


									$('#p_barra').val("Cuando termine el proceso, ésta ventana se cerrará, por favor, espere.");
									$(".ui-button").hide();
									$("#p_barra").show();

									$.ajax({
										url: urlCrearPDF,
										type: 'POST',
										data: {
											num_docto: window.btoa(json1),
											copiaUoriginal: "original",
											pendientes: "Captura",
											usu: usuario
										},
										xhr: function() {
											var xhr = $.ajaxSettings.xhr();
											xhr.upload.onprogress = function(event) {
												//console.log(event);
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
											console.log(result);
											if (result != "") {
												$("#prof").css('height', '30px');
												$("#progressBar1").css('height', '30px');
												$("#progressBar1").css('color', 'black');
												$("#progressBar1").text('100% - Carga realizada');
												$("#dialog-aviso").dialog("close");
												resus = [];
												resus2 = [];
												$('#nd_aut').val("");
												$('input:checkbox').prop('checked', false);
												$("#btnGetDataP").removeAttr("disabled");
												//$('#myTable').DataTable().ajax.reload();
												//$("button[class='ui-widget']").removeAttr("disabled");
												$(".ui-button").show();
												$("#p_barra").hide();
											}
										},
										complete: function() {
											clearInterval(timer);
											ndt = "";
											resus = [];
											resus2 = [];
											$('#nd_aut').val("");
											$(tabla).DataTable().ajax.reload();
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

			}); //select1	

		});
	</script>
	<style type="text/css">
		#letra {
			color: black;
		}

		#pdf_qna {
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
			color: #FFFFFF;
		}

		#myTable {
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

		th {
			/*border: 1px solid blue;*/
			background-color: #393939;
			text-align: center;
		}

		td {
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
		#fin {
			position: absolute;
			top: 950px;
		}

		#select1 {
			width: 12%;
			position: absolute;
			top: 6px;
			left: 280px;
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
			left: 580px;
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

		/*	
	.mrm {
	    position: absolute;
	 	top: -20px;
	 	left: 800px;
	 	width: 200px;
	}
	*/
		#textaviso {
			color: black;
		}

		#divatabla {
			position: absolute;
			top: 50px;
			left: 0px;
			width: 100%;
		}
	</style>
</head>

<body>

	<label id="pendientes">Pendientes Captura</label>
	<!--a href="#fin" id="link"><span></span></a-->
	<div style="text-align:center;">
		<select class="form-control" name="select1" id="select1">
			<option value="value" selected>Seleccionar...</option>
			<!--option value="Docentes">Docentes</option>
  		<option value="Administrativos">Administrativos</option-->
			<option value="Todos">Todos</option>
			<option value="Bajas">Bajas</option>
			<option value="Guiones">Guiones - Perc/Deduc</option>
		</select>
	</div>
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
			<table id="myTable">
				<thead>
					<tr>
						<th><input type="checkbox" name="select_all" value="1" id="example-select-all"><strong><label>Autorizar</label></strong></th>
						<th><strong><label>Num Docto</label></strong></th>
						<th><strong><label>RFC</label></strong></th>
						<th><strong><label>Plaza</label></strong></th>
						<!--th class="hide_me"><strong><label>Plazas</label></strong></th-->
						<th><strong><label>Fecha</label></strong></th>
						<th class="hide_me"><strong><label>Movs</label></strong></th><!-- class="hide_me" -->
						<th><strong><label>Info</label></strong></th>
						<th><strong><label>Area</label></strong></th>
						<th class="hide_me"><strong><label>Area Num</label></strong></th><!-- class="hide_me" -->
						<th class="hide_me"><strong><label>Num_Oficio</label></strong></th><!-- class="hide_me" -->
						<th class="hide_me"><strong><label>ObservacionesL</label></strong></th>
						<th><strong><label>Obs</label></strong></th>
						<th><strong><label>PDF</label></strong></th>
						<th><strong><label>Cancelar</label></strong></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><strong><label>Autorizar</label></strong></th>
						<th><strong><label>Num Docto</label></strong></th>
						<th><strong><label>RFC</label></strong></th>
						<th><strong><label>Plaza</label></strong></th>
						<!--th class="hide_me"><strong><label>Plazas</label></strong></th-->
						<th><strong><label>Fecha</label></strong></th>
						<th class="hide_me"><strong><label>Movs</label></strong></th> <!-- class="hide_me" -->
						<th><strong><label>Info</label></strong></th>
						<th><strong><label>Area</label></strong></th>
						<th class="hide_me"><strong><label>Area Num</label></strong></th><!-- class="hide_me" -->
						<th class="hide_me"><strong><label>Num_Oficio</label></strong></th><!-- class="hide_me" -->
						<th class="hide_me"><strong><label>ObservacionesL</label></strong></th>
						<th><strong><label>Obs</label></strong></th>
						<th><strong><label>PDF</label></strong></th>
						<th><strong><label>Cancelar</label></strong></th>
					</tr>
				</tfoot>
			</table>
		</form>
	</div>
	<button type="submit" name="btnGetDataP" class="btn btn-success" id="btnGetDataP">Autorizar</button>
	<div id="dialog-confirmPDF" title="¿Ver PDF?" style="display: none;">
		<iframe name="pdf_qna" id="pdf_qna"></iframe>
	</div>

	<div id="dialog-confirm" title="¿Ver PDF?" style="display: none;">
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Quieres Ver el Archivo PDF?
		</p>
	</div>
	<div id="dialog-confirm2" title="¡ERROR!" style="display: none;">
		<p>
			<span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>No Hay Archivo PDF
		</p>
	</div>
	<div id="dialog-obsr" title="OBSERVACIÓN" style="display: none;">
		<label id="textobs"></label>
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
	<div id="dialog-seleccion" title="¡ATENCIÓN!" style="display: none;">
		<label id="textaviso"></label>
	</div>
	<div id="dialog-ValidarSeleccion" title="¡ATENCIÓN!" style="display: none;">
		<label id="textValidarAviso"></label>
	</div>
	<!--h2 id="fin"></h2-->
	<iframe id="iframePagina1" src="../index.php" style="display: none;"></iframe>
</body>

</html>