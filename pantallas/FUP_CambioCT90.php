<?php
	require_once('../Conexion/ServicioWeb.php');
	
	// Obtener usuario de forma segura
	$usuario = isset($_GET['usuario']) ? $_GET['usuario'] : (isset($_POST['usuario']) ? $_POST['usuario'] : '');
	
	if(empty($usuario) && isset($_SERVER['HTTP_REFERER'])) {
		$referer = $_SERVER['HTTP_REFERER'];
		if(strpos($referer, 'usuario=') !== false) {
			preg_match('/usuario=([^&]+)/', $referer, $matches);
			if(isset($matches[1])) $usuario = urldecode($matches[1]);
		}
	}
	
	$valor = "";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FUP CAMBIO CT 90</title>
	
	<!-- CSS Libraries -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
	
	<style type="text/css">
		* { box-sizing: border-box; }
		
		body { 
			background: #f0f2f5; 
			padding: 6px 15px 15px;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}
		
		.page-header {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 1rem;
			flex-wrap: wrap;
			margin-bottom: 12px;
		}
		
		#pendientes {
			font-size: 24px;
			font-weight: bold;
			color: #2c3e50;
			margin: 0;
			padding-bottom: 10px;
			border-bottom: 3px solid #3498db;
			display: inline-block;
		}
		
		#divatabla {
			margin-top: 0;
			width: 100%;
			overflow-x: auto;
			background: white;
			border-radius: 8px;
			padding: 15px;
			box-shadow: 0 2px 4px rgba(0,0,0,0.1);
		}
		
		#myTable {
			width: 100%;
			border-collapse: collapse;
		}
		
		#myTable th, #myTable td {
			padding: 10px 8px;
			text-align: center;
			font-size: 12px;
			border: 1px solid #ddd;
		}
		
		#myTable th {
			background-color: #34495e;
			color: white;
			position: sticky;
			top: 0;
			z-index: 10;
		}
		
		#myTable tr:nth-child(even) { background-color: #f9f9f9; }
		#myTable tr:hover { background-color: #f0f0f0; }
		
		.hide_me, th.hide_me, td.hide_me { display: none !important; }
		
		#btnGetDataP {
			position: static;
			padding: 8px 20px;
			font-weight: bold;
			white-space: nowrap;
		}
		
		.modal-xl { max-width: 95% !important; width: 95% !important; }
		.modal-body { max-height: calc(100vh - 150px); overflow-y: auto; }
		.sticky-top { position: sticky; top: 0; z-index: 10; }
		
		.table th, .table td {
			vertical-align: middle;
			font-size: 11px;
			padding: 6px 4px;
		}
		
		.table th { white-space: nowrap; background-color: #34495e; color: white; }
		.card-header { padding: 10px 15px; font-weight: bold; }
		.card-header i { margin-right: 8px; }
		.table-responsive { max-height: 280px; overflow-y: auto; }
		.btn-sm { padding: 3px 6px; font-size: 11px; }
		
		.ui-dialog { z-index: 9999 !important; }
		.ui-widget-overlay { z-index: 9998 !important; }
		
		iframe { border: none; }
		#pdf_qna, #pdf_qnaFUP { width: 100%; height: 85vh; }
		
		.envio { cursor: pointer; transition: transform 0.2s; }
		.envio:hover { transform: scale(1.1); }
		.borrar { cursor: pointer; }
		
		.dataTables_wrapper .dataTables_filter input {
			margin-left: 5px;
			padding: 4px 8px;
			border-radius: 4px;
			border: 1px solid #ccc;
		}
		
		.dataTables_info { font-size: 12px; }

		@media (max-width: 768px) {
			body { padding: 8px; }
			.page-header { justify-content: center; text-align: center; }
			#pendientes { font-size: 20px; }
			#btnGetDataP { width: 100%; }
		}
	</style>
</head>
<body>

<div class="page-header">
	<label id="pendientes">
		<i class="fas fa-exchange-alt"></i> FUP Cambio CT 90 | Usuario: <?php echo htmlspecialchars($usuario); ?>
	</label>

	<button type="button" class="btn btn-success" id="btnGetDataP">
		<i class="fas fa-check-circle"></i> Autorizar Seleccionados
	</button>
</div>

<div id="divatabla">
	<form name="frm-example" id="frm-example">
		<table id="myTable" class="display" style="width:100%">
			<thead>
				<tr>
					<th width="40"><input type="checkbox" id="example-select-all"><br><small>Crear</small></th>
					<th width="60"><small>Previo</small></th>
					<th><small>Documento</small></th>
					<th><small>Num Oficio</small></th>
					<th><small>RFC</small></th>
					<th><small>Plaza</small></th>
					<th><small>Area</small></th>
					<th><small>CT Nuevo</small></th>
					<th><small>Ct Anterior</small></th>
					<th class="hide_me"><small>Area Hide</small></th>
					<th class="hide_me"><small>idAutorizar</small></th>
					<th width="60"><small>Ver FUP</small></th>
				</tr>
			</thead>
			<tbody><tr><td colspan="12" class="text-center">Cargando datos...</td></tr></tbody>
			<tfoot>
				<tr>
					<th><small>Crear</small></th>
					<th><small>Previo</small></th>
					<th><small>Documento</small></th>
					<th><small>Num Oficio</small></th>
					<th><small>RFC</small></th>
					<th><small>Plaza</small></th>
					<th><small>Area</small></th>
					<th><small>CT Nuevo</small></th>
					<th><small>Ct Anterior</small></th>
					<th class="hide_me"><small>Area Hide</small></th>
					<th class="hide_me"><small>idAutorizar</small></th>
					<th><small>Ver FUP</small></th>
				</tr>
			</tfoot>
		</table>
	</form>
</div>

<button type="button" class="btn btn-success" id="btnGetDataP">
	<i class="fas fa-check-circle"></i> Autorizar Seleccionados
</button>

<!-- DIALOGO 1: Ver PDF con opción Editar -->
<div id="dialog-confirmPDF" title="Vista Previa del Documento" style="display: none;">
	<iframe id="pdf_qna"></iframe>
</div> 

<!-- DIALOGO 2: Ver FUP -->
<div id="dialog-confirmPDFFUP" title="Ver FUP" style="display: none;">
	<iframe id="pdf_qnaFUP"></iframe>
</div> 

<!-- DIALOGO 3: Error -->
<div id="dialog-confirm2" title="Error" style="display: none;">
	<p><i class="fas fa-exclamation-triangle" style="color: red;"></i> No Hay Archivo PDF disponible</p>
</div>

<!-- DIALOGO 4: Procesamiento -->
<div id="dialog-aviso" title="Procesando Documentos" style="display: none;">
	<textarea id="nd_aut" rows="3" class="form-control" readonly></textarea>
	<p class="mt-3 small"><i class="fas fa-gavel"></i> Con fundamento en lo dispuesto en la legislación vigente...</p>
	<textarea id="p_barra" class="form-control" readonly>Procesando...</textarea>
	<div class="progress mt-2">
		<div id="progressBar1" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%">0%</div>
	</div>
</div> 

<!-- DIALOGO 5: Validación -->
<div id="dialog-ValidarSeleccion" title="Atención" style="display: none;">
	<p><i class="fas fa-info-circle"></i> <span id="textValidarAviso"></span></p>
</div>

<!-- DIALOGO 6: Confirmación de borrado -->
<div id="dialog-sin_datos" title="¡ATENCIÓN!" style="display: none;">
    <p>
        <i class="fas fa-exclamation-triangle" style="color: orange;"></i> 
        <span id="textValidarAviso2"></span>
    </p>
    <p class="small text-muted">Esta acción no se puede deshacer.</p>
</div>

<!-- MODAL PRINCIPAL PARA EDICIÓN (el que se muestra al hacer clic en Editar) -->
<div class="modal fade" id="exampleModalM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title">
					<i class="fas fa-edit"></i> Editar Documento - Antecedentes y Gestión de Cambio CT
				</h5>
				<button type="button" class="close text-white" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Información del documento actual -->
				<div class="alert alert-info">
					<i class="fas fa-file-alt"></i> 
					<strong>Documento:</strong> <span id="info_documento"></span> &nbsp;|&nbsp;
					<strong>RFC:</strong> <span id="info_rfc"></span> &nbsp;|&nbsp;
					<strong>Área:</strong> <span id="info_area"></span>
				</div>
				
				<!-- Filtros -->
				<div class="row mb-3">
					<div class="col-md-4">
						<label>Tipo de búsqueda:</label>
						<select id="seleccion" class="form-control form-control-sm" onchange="mostrar(this.value);">
							<option value="">-- Seleccionar --</option>
							<option value="Actuales">Actuales</option>
							<option value="Todos">Todos</option>
							<option value="TodosSND">Todos sin documento</option>
							<option value="Historico">Histórico</option>
							<option value="Num_Docto">Por Documento</option>
						</select>
					</div>
					<div class="col-md-3">
						<label>&nbsp;</label>
						<div class="input-group">
							<input type="text" id="por_documento" class="form-control form-control-sm" placeholder="N° Documento" style="display:none;">
							<button type="button" class="btn btn-primary btn-sm" onclick="load()">
								<i class="fas fa-search"></i> Ver Registros
							</button>
						</div>
					</div>
					<div class="col-md-3">
						<label>&nbsp;</label>
						<button type="button" class="btn btn-danger btn-sm btn-block" id="btnGetData">
							<i class="fas fa-file-pdf"></i> Crear FUP
						</button>
					</div>
				</div>
				
				<!-- Observaciones -->
				<div class="card mb-3">
					<div class="card-header bg-secondary text-white">
						<i class="fas fa-comment-dots"></i> Observaciones
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-3"><input type="text" id="observacion1" class="form-control form-control-sm" placeholder="Observación 1" maxlength="64"></div>
							<div class="col-md-3"><input type="text" id="observacion2" class="form-control form-control-sm" placeholder="Observación 2" maxlength="64"></div>
							<div class="col-md-3"><input type="text" id="observacion3" class="form-control form-control-sm" placeholder="Observación 3" maxlength="64"></div>
							<div class="col-md-3"><input type="text" id="observacion4" class="form-control form-control-sm" placeholder="Observación 4" maxlength="64"></div>
						</div>
					</div>
				</div>
				
				<!-- Tabla de resultados disponibles -->
				<div class="card mb-3">
					<div class="card-header bg-info text-white">
						<i class="fas fa-database"></i> Plazas Disponibles
					</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table table-sm table-striped mb-0">
								<thead class="thead-dark sticky-top">
									<tr>
										<th width="40"><i class="fas fa-plus-circle"></i> Agregar</th>
										<th>Cód.Pago</th><th>Unidad</th><th>Subunidad</th><th>Puesto</th>
										<th>Horas</th><th>Plaza</th><th>Motivo</th><th>Nivel</th>
										<th>Qna.Ini</th><th>Qna.Fin</th><th>Documento</th><th>CT</th>
									</tr>
								</thead>
								<tbody id="load_data">
									<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-info-circle"></i> Seleccione una opción</td></tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<!-- Tabla de plazas seleccionadas -->
				<div class="card">
					<div class="card-header bg-success text-white">
						<i class="fas fa-check-circle"></i> Plazas Seleccionadas para el Documento
					</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table id="tabla2" class="table table-sm table-striped mb-0">
								<thead class="thead-dark sticky-top">
									<tr>
										<th width="40"><i class="fas fa-trash-alt"></i> Eliminar</th>
										<th>Cód.Pago</th><th>Unidad</th><th>Subunidad</th><th>Puesto</th>
										<th>Horas</th><th>Plaza</th><th>Motivo</th><th>Nivel</th>
										<th>Qna.Ini</th><th>Qna.Fin</th><th>Documento</th><th>CT</th>
									</tr>
								</thead>
								<tbody>
									<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-inbox"></i> No hay plazas seleccionadas</td></tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				
				<!-- Campos ocultos -->
				<input type="hidden" id="id" value="" />
				<input type="hidden" id="oficio" value="" />
				<input type="hidden" id="rfc" value="" />
				<input type="hidden" id="area" value="" />
				<input type="hidden" id="usuario" value="<?php echo htmlspecialchars($usuario); ?>" />
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- <script src="../Scripts/script_Tabla_CT_Previo90.js"></script> -->
<script>
// Variables globales
var table;
var documentoActual = {};

$(document).ready(function() {
	console.log('Documento listo');
	
	// Inicializar DataTable de la tabla principal
	table = $('#myTable').DataTable({
		ajax: {
			url: "data_cambio_CT90.php",
			dataSrc: function(json) {
				return json.data || [];
			}
		},
		language: {
			"sProcessing": "Procesando...",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible",
			"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
			"sSearch": "Buscar:",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			}
		},
		ordering: false,
		paging: true,
		pageLength: 20,
		lengthChange: false,
		columnDefs: [
    { targets: 0, width: "40px", orderable: false, render: function(data) { 
        return '<input type="checkbox" class="selecheck" value="'+data+'">'; 
    } },
    { targets: 1, width: "60px", orderable: false, render: function() { 
        return '<button class="btn btn-info btn-sm previo-btn"><i class="fas fa-eye"></i> Previo</button>'; 
    } },
    { targets: 9, visible: false, searchable: false },
    { targets: 10, visible: false, searchable: false },
    { 
        targets: 11, 
        width: "60px", 
        orderable: false, 
        render: function(data, type, full, meta) {
            // Obtener el número de documento (columna índice 2)
            var num_docto = full[2];
            
            // NO mostrar botón si contiene "000001" o es "00000" o "000000" (IGUAL QUE EL ORIGINAL)
            if (num_docto && (
                num_docto.includes("000001") || 
                num_docto === "00000" || 
                num_docto === "000000"
            )) {
                return '';
            }
            
            // Si hay PDF disponible, mostrar botón
            if (data && data != "") {
                return '<button class="btn btn-danger btn-sm verfup-btn"><i class="fas fa-file-pdf"></i> FUP</button>';
            }
            return '';
        } 
    }
],
		drawCallback: function() {
			$('#myTable thead th.hide_me, #myTable tfoot th.hide_me').hide();
		}
	});
	
	// Evento para botón Previo (MUESTRA EL PDF CON OPCIÓN EDITAR)
	$('#myTable').on('click', '.previo-btn', function(e) {
		e.preventDefault();
		var data = table.row($(this).closest('tr')).data();
		console.log('Datos del registro:', data);
		if(data) {
			// Guardar datos del documento actual
			documentoActual = {
				id: data[2],
				oficio: data[3],
				area: data[9],
				rfc: data[4]
			};
			mostrarPrevioPDF(documentoActual.id, documentoActual.oficio, documentoActual.area, documentoActual.rfc);
		}
	});
	
	// Evento para botón Ver FUP
	$('#myTable').on('click', '.verfup-btn', function(e) {
		e.preventDefault();
		var data = table.row($(this).closest('tr')).data();
		if(data) mostrarFUP(data[2]);
	});
	
	// Select all
	$('#example-select-all').on('click', function() {
		var rows = table.rows({ 'search': 'applied' }).nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
	});
	
	// Limpiar modal de edición al cerrar
	$('#exampleModalM').on('hidden.bs.modal', function() {
		$('#load_data').html('<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-info-circle"></i> Seleccione una opción</td></tr>');
		$('#tabla2 tbody').html('<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-inbox"></i> No hay plazas seleccionadas</td></tr>');
		$('#por_documento').hide();
		$('#seleccion').val('');
		$('#observacion1, #observacion2, #observacion3, #observacion4').val('');
	});
	
// Botón "Crear FUP" dentro del modal de edición
$('#btnGetData').click(function() {
    console.log("=== INICIO Crear FUP ===");
    
    // Verificar que haya plazas seleccionadas
    var plazasSeleccionadas = [];
    var totalPlazas = 0;
    
    // Recorrer la tabla de plazas seleccionadas (tabla2)
    $('#tabla2 tbody tr').each(function() {
        // Verificar que no sea el mensaje de "No hay plazas seleccionadas"
        if(!$(this).find('td[colspan]').length) {
            var plaza = {
                _cod_pago: $(this).find('td:eq(1)').text().trim(),
                _unidad: $(this).find('td:eq(2)').text().trim(),
                _subunidad: $(this).find('td:eq(3)').text().trim(),
                _puesto: $(this).find('td:eq(4)').text().trim(),
                _horas: $(this).find('td:eq(5)').text().trim(),
                _plaza: $(this).find('td:eq(6)').text().trim(),
                _mot_mov: $(this).find('td:eq(7)').text().trim(),
                _nivel_sdo: $(this).find('td:eq(8)').text().trim(),
                _qna_ini: $(this).find('td:eq(9)').text().trim(),
                _qna_fin: $(this).find('td:eq(10)').text().trim(),
                _num_doc: $(this).find('td:eq(11)').text().trim(),
                _ct: $(this).find('td:eq(12)').text().trim(),
                _areas: $('#area').val(),
                _valor2: $('#id').val()
            };
            
            console.log("Plaza agregada:", plaza);
            plazasSeleccionadas.push(plaza);
            totalPlazas++;
        }
    });
    
    console.log("Total de plazas seleccionadas:", totalPlazas);
    
    // if(totalPlazas === 0) {
    //     $('#textValidarAviso').text('Debe seleccionar al menos una plaza');
    //     $('#dialog-ValidarSeleccion').dialog({ 
    //         modal: true, 
    //         buttons: { 
    //             OK: function() { $(this).dialog('close'); } 
    //         } 
    //     });
    //     return;
    // }
    
    // Obtener datos del documento actual
    var documento_id = $('#id').val();
    var oficio = $('#oficio').val();
    var area = $('#area').val();
    var rfc = $('#rfc').val();
    var usuario = $('#usuario').val();
    
    // Obtener observaciones
    var observacion1 = $('#observacion1').val();
    var observacion2 = $('#observacion2').val();
    var observacion3 = $('#observacion3').val();
    var observacion4 = $('#observacion4').val();
    //var observaciones = observacion1 + " " + observacion2 + " " + observacion3 + " " + observacion4;
    
    console.log("Documento ID:", documento_id);
    console.log("Oficio:", oficio);
    console.log("Área:", area);
    console.log("RFC:", rfc);
    
    // Determinar si es documento para folear (termina en 000001 o es 00000)
    var esParaFolear = (documento_id && (
        documento_id.includes("000001") || 
        documento_id === "00000" || 
        documento_id === "000000"
    ));
    
    console.log("¿Es para folear?", esParaFolear);
    
    // Construir el array de plazas en el formato esperado por los PHP
    var jsonPlazas = [];
    var objetoPlazas = {};
    objetoPlazas[0] = { _total: totalPlazas };
    jsonPlazas.push(objetoPlazas);
    
    var index = 1;
    for(var i = 0; i < plazasSeleccionadas.length; i++) {
        jsonPlazas[index] = plazasSeleccionadas[i];
        index++;
    }
    
    var men = JSON.stringify(jsonPlazas);
    // btoa() lanza InvalidCharacterError con acentos/enie (puesto, area, mot_mov).
    // Se codifica a UTF-8 primero; el PHP recibe UTF-8 y pdfant.php ya hace
    // mb_convert_encoding(..., 'ISO-8859-1', 'UTF-8').
    var menBase64 = btoa(encodeURIComponent(men).replace(/%([0-9A-F]{2})/g, function(m, p1) {
        return String.fromCharCode('0x' + p1);
    }));
    
    console.log("JSON de plazas:", men);
    console.log("Base64 length:", menBase64.length);
    
    // Confirmar antes de crear
    var mensajeConfirmacion = esParaFolear ? 
        '<i class="fas fa-exclamation-triangle" style="color: orange;"></i> <strong>¡ATENCIÓN!</strong> Este documento NO tiene folio asignado.<br><br>Se le asignará un nuevo número de documento.<br><br>' :
        '<i class="fas fa-edit"></i> Se actualizará el documento existente: <strong>' + documento_id + '</strong><br><br>';
    
    mensajeConfirmacion += '<strong>Plazas seleccionadas:</strong> ' + totalPlazas + '<br>' +
        '<strong>RFC:</strong> ' + rfc + '<br>' +
        '<strong>Área:</strong> ' + area + '<br>' +
        '<strong>Oficio:</strong> ' + oficio;
    
    $('#textValidarAviso').html(mensajeConfirmacion);
    
    $('#dialog-ValidarSeleccion').dialog({
        modal: true,
        width: 500,
        title: "Confirmar creación de FUP",
        buttons: {
            "Si, Crear FUP": function() {
                $(this).dialog('close');
                
                // Mostrar diálogo de progreso
                $("#dialog-aviso").dialog({
                    resizable: false,
                    draggable: false,
                    height: "auto",
                    width: 600,
                    modal: true,
                    title: "Creando FUP - Procesando...",
                    showCloseButton: false,
                    closeOnEscape: false,
                    open: function(event, ui) {
                        $('.ui-dialog-titlebar-close').hide();
                    },
                    buttons: {
                        "Cerrar": function() {
                            $(this).dialog("close");
                        }
                    }
                });
                
                // Inicializar progreso
                $("#progressBar1").css('width', '0%').text('0%');
                $("#p_barra").val('Iniciando creación del FUP...');
                
                var progress = 0;
                var timer = setInterval(function() {
                    progress += 10;
                    if(progress <= 100) {
                        $("#progressBar1").css('width', progress + '%').text(progress + '%');
                        if(progress < 50) {
                            $("#p_barra").val('Procesando plazas...');
                        } else if(progress < 80) {
                            $("#p_barra").val('Generando PDF...');
                        } else {
                            $("#p_barra").val('Finalizando...');
                        }
                    }
                    if(progress >= 100) {
                        clearInterval(timer);
                    }
                }, 300);
                
                // Determinar URL según el caso
                var url = esParaFolear ? 
                    "../Pdf/CrearPDF/CreacionFUPOriginal_CT_Editar90_Foliacion.php" : 
                    "../Pdf/CrearPDF/CreacionFUPOriginal_CT_Editar90.php";
                
                console.log("URL a llamar:", url);
                
                // Realizar la petición AJAX
                $.ajax({
    url: url,
    type: 'POST',
    data: {
        id: documento_id,
        oficio: oficio,
        area: area,
        rfc: rfc,
        men: menBase64,
        usu: usuario,
        obs1: observacion1,
    obs2: observacion2,
    obs3: observacion3,
    obs4: observacion4,
        ops: esParaFolear ? "crear_fup" : "editar_fup"
    },
    dataType: 'json',  // ← importante
    timeout: 60000,
    success: function(response) {
        console.log("Respuesta del servidor:", response);
        clearInterval(timer);
        $("#progressBar1").css('width', '100%').text('100%');
        $("#p_barra").val('¡Completado!');

        setTimeout(function() {
            $("#dialog-aviso").dialog("close");

            if (response.success) {
                // Éxito: solo mostramos el mensaje y un botón "Aceptar"
                var mensajeExito = esParaFolear ?
                    '<i class="fas fa-check-circle" style="color: green;"></i> FUP creado correctamente con nuevo folio.<br><br>Se han procesado ' + totalPlazas + ' plaza(s).' :
                    '<i class="fas fa-check-circle" style="color: green;"></i> FUP actualizado correctamente.<br><br>Se han procesado ' + totalPlazas + ' plaza(s).';

                $('#textValidarAviso').html(mensajeExito);

                // Solo un botón "Aceptar" que cierra el modal y recarga la tabla
                $('#dialog-ValidarSeleccion').dialog({
                    modal: true,
                    width: 450,
                    buttons: {
                        "Aceptar": function() {
                            $(this).dialog('close');
                            $('#exampleModalM').modal('hide');
                            if (table) table.ajax.reload();
                        }
                    }
                });
            } else {
                // Error del servidor
                $('#textValidarAviso').html('<i class="fas fa-exclamation-triangle" style="color: red;"></i> ' + (response.message || 'Error desconocido al crear el FUP'));
                $('#dialog-ValidarSeleccion').dialog({
                    modal: true,
                    width: 500,
                    buttons: { "Aceptar": function() { $(this).dialog('close'); } }
                });
            }
        }, 500);
    },
    error: function(xhr, status, error) {
        // Error HTTP o de parseo JSON
        clearInterval(timer);
        $("#dialog-aviso").dialog("close");
        var errorDetalle = xhr.responseText ? xhr.responseText.substring(0, 300) : error;
        $('#textValidarAviso').html('<i class="fas fa-exclamation-triangle" style="color: red;"></i> Error al crear el FUP.<br><br><strong>Error:</strong> ' + error + '<br><br><strong>Detalle:</strong> ' + errorDetalle);
        $('#dialog-ValidarSeleccion').dialog({
            modal: true,
            width: 550,
            buttons: { "Aceptar": function() { $(this).dialog('close'); } }
        });
    }
});
            },
            "Cancelar": function() {
                $(this).dialog('close');
            }
        }
    });
});

// Función para crear el FUP
function crearFUP(documento_id, oficio, area, rfc, usuario, plazas, observaciones) {
	// Mostrar diálogo de progreso
	$("#dialog-aviso").show();
	$("#dialog-aviso").dialog({
		resizable: false,
		draggable: false,
		height: "auto",
		width: 600,
		modal: true,
		title: "Creando FUP - Procesando...",
		showCloseButton: false,
		closeOnEscape: false,
		open: function(event, ui) {
			$('.ui-dialog-titlebar-close', ui.dialog | ui).hide();
			$(".ui-dialog .ui-dialog-titlebar-close").hide();
		},
		buttons: {
			"Cerrar": function() {
				$(this).dialog("close");
			}
		}
	});
	
	// Inicializar progreso
	$("#progressBar1").css('width', '0%').text('0%');
	var progress = 0;
	var timer = setInterval(function() {
		progress += 10;
		if(progress <= 100) {
			$("#progressBar1").css('width', progress + '%').text(progress + '%');
			$("#p_barra").val('Procesando plaza ' + Math.floor(progress / (100 / plazas.length)) + ' de ' + plazas.length + '...');
		}
		if(progress >= 100) {
			clearInterval(timer);
		}
	}, 300);
	
	// Preparar datos para enviar
	var datosEnvio = {
		documento_id: documento_id,
		oficio: oficio,
		area: area,
		rfc: rfc,
		usuario: usuario,
		plazas: JSON.stringify(plazas),
		observaciones: JSON.stringify(observaciones),
		accion: 'crear_fup'
	};
	
	// Enviar AJAX para crear el FUP
	$.ajax({
		url: '../Pdf/CrearPDF/crearFUP_CambioCT90.php',
		type: 'POST',
		data: datosEnvio,
		dataType: 'json',
		success: function(response) {
			clearInterval(timer);
			$("#progressBar1").css('width', '100%').text('100%');
			
			setTimeout(function() {
				$("#dialog-aviso").dialog("close");
				
				if(response.success) {
					// Mostrar éxito
					$('#textValidarAviso').html('<i class="fas fa-check-circle" style="color: green;"></i> ' + 
						response.message + '<br><br>Se generó el FUP correctamente.');
					
					$('#dialog-ValidarSeleccion').dialog({
						modal: true,
						width: 400,
						buttons: {
							"Ver FUP": function() {
								$(this).dialog('close');
							},
							"Aceptar": function() {
								$(this).dialog('close');
								// Cerrar modal de edición
								$('#exampleModalM').modal('hide');
								// Recargar tabla principal
								if(table) table.ajax.reload();
							}
						}
					});
				} else {
					// Mostrar error
					$('#textValidarAviso').html('<i class="fas fa-exclamation-triangle" style="color: red;"></i> ' + 
						response.message || 'Error al crear el FUP');
					
					$('#dialog-ValidarSeleccion').dialog({
						modal: true,
						width: 400,
						buttons: {
							"Aceptar": function() {
								$(this).dialog('close');
							}
						}
					});
				}
			}, 500);
		},
		error: function(xhr, status, error) {
			clearInterval(timer);
			$("#dialog-aviso").dialog("close");
			
			console.error('Error en AJAX:', error);
			console.error('Respuesta:', xhr.responseText);
			
			$('#textValidarAviso').html('<i class="fas fa-exclamation-triangle" style="color: red;"></i> ' + 
				'Error al crear el FUP: ' + error + '<br><br>Por favor, intente nuevamente o contacte al administrador.');
			
			$('#dialog-ValidarSeleccion').dialog({
				modal: true,
				width: 450,
				buttons: {
					"Aceptar": function() {
						$(this).dialog('close');
					}
				}
			});
		}
	});
}
	
	// Botón autorizar principal
$('#btnGetDataP').click(function() {
    var seleccionados = $('.selecheck:checked').length;
    
    if (seleccionados === 0) {
        $('#textValidarAviso').text('Seleccione al menos un registro');
        $('#dialog-ValidarSeleccion').dialog({ 
            modal: true, 
            buttons: { 
                OK: function() { $(this).dialog('close'); } 
            } 
        });
        return;
    }
    
	var newarrays = [];
    var ids = [];
    var datosFila = [];

    // Recorrer checkboxes seleccionados
    $('input[class="selecheck"]:checked').each(function() {
        var checkbox = $(this);
        var value = checkbox.val(); // número de documento
        // Obtener la fila correspondiente en la DataTable
        var rowData = table.row(checkbox.closest('tr')).data();
        if (rowData) {
            var num_docto = rowData[2];      // Documento
            var num_oficio = rowData[3];     // Num Oficio
            var rfc = rowData[4];            // RFC
            var area = rowData[9];           // Area Hide (columna 9)
            ids.push(num_docto);
            datosFila.push({ nd: num_docto, num_oficio: num_oficio, rfc: rfc, area: area });
        }
    });

    // Construir newarrays: primero el total, luego los documentos
    newarrays.push({ totals: ids.length });
    for (var i = 0; i < datosFila.length; i++) {
        newarrays.push(datosFila[i]);
    }
    
    var json1 = JSON.stringify({ newarrays: newarrays });
    var num_docto_b64 = btoa(json1);
    var usuario = $('#usuario').val();
    
    // Mostrar diálogo de progreso
    $("#dialog-aviso").dialog({
        resizable: false,
        draggable: false,
        height: "auto",
        width: 600,
        modal: true,
        title: "Procesando Documentos",
        showCloseButton: false,
        closeOnEscape: false,
        open: function(event, ui) {
            $('.ui-dialog-titlebar-close').hide();
        },
        buttons: {
            "Cancelar": function() {
                $(this).dialog("close");
            }
        }
    });
    
    // Inicializar progreso
    $("#progressBar1").css('width', '0%').text('0%');
    var progress = 0;
    var timer = setInterval(function() {
        progress += 10;
        if (progress <= 100) {
            $("#progressBar1").css('width', progress + '%').text(progress + '%');
        }
        if (progress >= 100) clearInterval(timer);
    }, 100);
    
    // Petición AJAX
    $.ajax({
        url: "../Pdf/CrearPDF/Actualizar_cambios_ct_90.php",
        type: 'POST',
        data: {
            num_docto: num_docto_b64,
            pendientes: "Captura",
            usu: usuario
        },
        success: function(result) {
            clearInterval(timer);
            $("#progressBar1").css('width', '100%').text('100%');
            
            setTimeout(function() {
                $("#dialog-aviso").dialog("close");
                
                $('#textValidarAviso').html('<i class="fas fa-check-circle" style="color: green;"></i> ' + 
                    'Documentos procesados correctamente.<br><br>Total: ' + seleccionados + ' documento(s)');
                
                $('#dialog-ValidarSeleccion').dialog({
                    modal: true,
                    width: 400,
                    buttons: {
                        "Aceptar": function() {
                            $(this).dialog('close');
                            $('input:checkbox').prop('checked', false);
                            if (table) table.ajax.reload();
                        }
                    }
                });
            }, 500);
        },
        error: function(xhr, status, error) {
            clearInterval(timer);
            $("#dialog-aviso").dialog("close");
            
            $('#textValidarAviso').html('<i class="fas fa-exclamation-triangle" style="color: red;"></i> ' + 
                'Error al procesar: ' + error);
            
            $('#dialog-ValidarSeleccion').dialog({
                modal: true,
                width: 400,
                buttons: {
                    "Aceptar": function() {
                        $(this).dialog('close');
                    }
                }
            });
        }
    });
});



});

// Función mostrar
function mostrar(id) {
	if(id == "Num_Docto") {
		$("#por_documento").show();
	} else {
		$("#por_documento").hide();
	}
}

// Función load - Carga datos en el modal de edición
function load() {
	var seleccion = $('#seleccion').val();
	var por_documento = $('#por_documento').val();
	
	if(!seleccion) {
		$('#textValidarAviso').text('Seleccione un tipo de búsqueda');
		$('#dialog-ValidarSeleccion').dialog({ modal: true, buttons: { OK: function() { $(this).dialog('close'); } } });
		return;
	}
	
	$('#load_data').html('<tr><td colspan="13" class="text-center"><i class="fas fa-spinner fa-spin"></i> Cargando...</td></tr>');
	
	$.ajax({
		url: '../Pdf/AntecedentesPrevio.php',
		type: 'POST',
		data: {
			seleccion: seleccion,
			id: $('#id').val(),
			oficio: $('#oficio').val(),
			area: $('#area').val(),
			rfc: $('#rfc').val(),
			por_documento: por_documento,
			usuario: $('#usuario').val()
		},
		success: function(result) {
			if(result && result.trim() != '' && !result.includes('no se encontraron')) {
				$('#load_data').html(result);
			} else {
				$('#load_data').html('<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-exclamation-circle"></i> No se encontraron resultados</td></tr>');
			}
		},
		error: function(xhr, status, error) {
			console.error('Error en load:', error);
			$('#load_data').html('<tr><td colspan="13" class="text-center text-danger"><i class="fas fa-exclamation-triangle"></i> Error al cargar: ' + error + '</td></tr>');
		}
	});
}

// Función mostrarPrevioPDF - MUESTRA EL PDF CON BOTÓN EDITAR (CORREGIDO - CON ESPACIOS)
function mostrarPrevioPDF(id, oficio, area, rfc) {
    console.log('Generando PDF para:', {id, oficio, area, rfc});
    
    // Limpiar el iframe
    $('#pdf_qna').attr('src', '');
    
    // Mostrar loading
    mostrarLoadingEnIframe();
    
    $.ajax({
        url: '../Pdf/CrearPDF/CrearPrevio90.php',
        type: 'POST',
        data: { 
            buscar: id, 
            oficio: oficio, 
            area: area, 
            rfc: rfc, 
            usuario: $('#usuario').val() 
        },
        dataType: 'html',
        success: function(result) {
            console.log('Respuesta de CrearPrevio90:', result);
            
            if(result && result != "" && result !== "null" && !result.includes("error")) {
                // Limpiar la respuesta
                var pdfPath = result.trim();
                pdfPath = pdfPath.replace(/\n/g, '').replace(/\r/g, '');
                
                console.log('Ruta original:', pdfPath);
                
                // Obtener solo el nombre del archivo
                var fileName = pdfPath.split('/').pop();
                console.log('Nombre del archivo:', fileName);
                
                // CODIFICAR LA URL CORRECTAMENTE (reemplazar espacios por %20)
                var encodedFileName = encodeURIComponent(fileName);
                console.log('Nombre codificado:', encodedFileName);
                
                // Construir la URL con el nombre codificado
                var pdfUrl = window.location.protocol + '//' + window.location.host + 
                             '/Formato_Unico_Personal/FUPs/Masivo_Original/Previo/' + encodedFileName;
                
                console.log('URL final del PDF (codificada):', pdfUrl);
                
                // También preparar la URL sin codificar como alternativa
                var pdfUrlSinCodificar = window.location.protocol + '//' + window.location.host + 
                                         '/Formato_Unico_Personal/FUPs/Masivo_Original/Previo/' + fileName;
                
                console.log('URL sin codificar:', pdfUrlSinCodificar);
                
                // Verificar si el archivo existe con la URL codificada
                $.ajax({
                    url: pdfUrl,
                    type: 'HEAD',
                    timeout: 10000,
                    success: function() {
                        console.log('PDF encontrado (con codificación):', pdfUrl);
                        cargarPDFEnIframe(pdfUrl, id, oficio, area, rfc);
                    },
                    error: function() {
                        console.log('No encontrado con codificación, intentando sin codificar...');
                        // Intentar con la URL sin codificar
                        $.ajax({
                            url: pdfUrlSinCodificar,
                            type: 'HEAD',
                            timeout: 10000,
                            success: function() {
                                console.log('PDF encontrado (sin codificación):', pdfUrlSinCodificar);
                                cargarPDFEnIframe(pdfUrlSinCodificar, id, oficio, area, rfc);
                            },
                            error: function() {
                                console.error('PDF no encontrado en ninguna ruta');
                                mostrarErrorPDF(fileName);
                            }
                        });
                    }
                });
            } else {
                $("#dialog-confirm2").dialog({ 
                    modal: true, 
                    buttons: { 
                        "Salir": function() { $(this).dialog("close"); } 
                    } 
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en AJAX:', error);
            $("#dialog-confirm2").dialog({ 
                modal: true, 
                buttons: { 
                    "Salir": function() { $(this).dialog("close"); } 
                } 
            });
        }
    });
}

// Función para mostrar loading en el iframe
function mostrarLoadingEnIframe() {
    var loadingHtml = '<html><body style="display:flex;justify-content:center;align-items:center;height:100vh;font-family:Arial;flex-direction:column">' +
                      '<i class="fas fa-spinner fa-spin fa-3x" style="color:#3498db"></i>' +
                      '<p style="margin-top:20px;color:#555">Generando PDF, espere un momento...</p>' +
                      '</body></html>';
    $('#pdf_qna').attr('srcdoc', loadingHtml);
}

// Función para cargar el PDF en el iframe
function cargarPDFEnIframe(pdfUrl, id, oficio, area, rfc) {
    console.log('Cargando PDF en iframe:', pdfUrl);

    // Limpiar el srcdoc y cargar la URL
    $('#pdf_qna').removeAttr('srcdoc');

    // Evitar que el navegador muestre una copia en caché del PDF de preview
    // (el nombre del archivo es siempre el mismo, así que sin esto no se ve el cambio
    // al volver a dar clic en "Previo" después de editar)
    var pdfUrlSinCache = pdfUrl + (pdfUrl.indexOf('?') === -1 ? '?' : '&') + 'v=' + Date.now();

    // Forzar recarga del iframe
    $('#pdf_qna').attr('src', pdfUrlSinCache + "#toolbar=0&navpanes=0&scrollbar=1&zoom=100");
    
    // Esperar a que el iframe cargue
    $('#pdf_qna').on('load', function() {
        console.log('Iframe cargado correctamente');
        
        // Mostrar diálogo con botones
        $("#dialog-confirmPDF").dialog({
            resizable: false,
            height: 700,
            width: 1300,
            modal: true,
            showCloseButton: false,
            closeOnEscape: false,
            open: function(event, ui) {
                $('.ui-dialog-titlebar-close', ui.dialog | ui).hide();
            },
            buttons: {
                "Salir": function() {
                    $(this).dialog("close");
                    $('#pdf_qna').attr('src', '');
                    $('#pdf_qna').off('load');
                },
                "Editar": function() {
                    $(this).dialog("close");
                    $('#pdf_qna').attr('src', '');
                    $('#pdf_qna').off('load');
                    
                    // Confirmar antes de borrar
                    $('#textValidarAviso2').text("Se borrará la información del documento " + id);
                    $("#dialog-sin_datos").dialog({
                        resizable: false,
                        height: "auto",
                        width: 400,
                        modal: true,
                        title: "¡ATENCIÓN!",
                        buttons: {
                            "Aceptar": function() {
                                $(this).dialog("close");
                                
                                // Borrar la información del documento
                                $.ajax({
                                    url: 'Borrar_doc.php',
                                    type: 'POST',
                                    data: { doc: id },
                                    success: function(result) {
                                        console.log('Documento borrado:', result);
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error al borrar:', error);
                                    }
                                });
                                
                                // Abrir modal de edición
                                abrirModalEdicion(id, oficio, area, rfc);
                            },
                            "Cancelar": function() {
                                $(this).dialog("close");
                            }
                        }
                    });
                }
            }
        });
    });
    
    // Timeout por si el iframe no carga
    setTimeout(function() {
        console.log('Timeout: verificando si el iframe cargó');
        // Forzar el diálogo aunque el iframe no haya terminado de cargar
        if ($("#dialog-confirmPDF").dialog("isOpen") !== true) {
            $("#dialog-confirmPDF").dialog({
                resizable: false,
                height: 700,
                width: 1300,
                modal: true,
                showCloseButton: false,
                closeOnEscape: false,
                open: function(event, ui) {
                    $('.ui-dialog-titlebar-close', ui.dialog | ui).hide();
                },
                buttons: {
                    "Salir": function() {
                        $(this).dialog("close");
                        $('#pdf_qna').attr('src', '');
                        $('#pdf_qna').off('load');
                    },
                    "Editar": function() {
                        $(this).dialog("close");
                        $('#pdf_qna').attr('src', '');
                        $('#pdf_qna').off('load');
                        
                        $('#textValidarAviso2').text("Se borrará la información del documento " + id);
                        $("#dialog-sin_datos").dialog({
                            resizable: false,
                            height: "auto",
                            width: 400,
                            modal: true,
                            title: "¡ATENCIÓN!",
                            buttons: {
                                "Aceptar": function() {
                                    $(this).dialog("close");
                                    $.ajax({
                                        url: 'Borrar_doc.php',
                                        type: 'POST',
                                        data: { doc: id },
                                        success: function(result) {
                                            console.log('Documento borrado:', result);
                                        }
                                    });
                                    abrirModalEdicion(id, oficio, area, rfc);
                                },
                                "Cancelar": function() {
                                    $(this).dialog("close");
                                }
                            }
                        });
                    }
                }
            });
        }
    }, 3000);
}

// Función para mostrar error de PDF
function mostrarErrorPDF(fileName) {
    $('#textValidarAviso').html('No se pudo generar el PDF. El archivo no existe.<br><br>' +
        '<strong>Nombre del archivo:</strong> ' + fileName + '<br>' +
        '<strong>Posible causa:</strong> La carpeta "Previo" no existe o el PDF no se generó correctamente.');
    $("#dialog-ValidarSeleccion").dialog({
        modal: true,
        width: 550,
        buttons: {
            "Aceptar": function() {
                $(this).dialog('close');
            }
        }
    });
}
// Función para abrir el modal de edición (segundo modal)
function abrirModalEdicion(id, oficio, area, rfc) {
    console.log('Abriendo modal de edición para:', {id, oficio, area, rfc});
    
    // Actualizar campos ocultos
    $('#id').val(id);
    $('#oficio').val(oficio);
    $('#area').val(area);
    $('#rfc').val(rfc);
    
    // Actualizar información mostrada
    $('#info_documento').text(id);
    $('#info_rfc').text(rfc);
    $('#info_area').text(area);
    
    // Limpiar tablas anteriores
    $('#load_data').html('<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-info-circle"></i> Seleccione una opción para cargar datos</td></tr>');
    $('#tabla2 tbody').html('<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-inbox"></i> No hay plazas seleccionadas</td></tr>');
    $('#por_documento').hide();
    $('#seleccion').val('');
    $('#observacion1, #observacion2, #observacion3, #observacion4').val('');
    
    // Mostrar el modal de edición
    $('#exampleModalM').modal('show');
}

// Función para abrir el modal de edición (segundo modal)
function abrirModalEdicion(id, oficio, area, rfc) {
	console.log('Abriendo modal de edición para:', {id, oficio, area, rfc});
	
	// Actualizar campos ocultos
	$('#id').val(id);
	$('#oficio').val(oficio);
	$('#area').val(area);
	$('#rfc').val(rfc);
	
	// Actualizar información mostrada
	$('#info_documento').text(id);
	$('#info_rfc').text(rfc);
	$('#info_area').text(area);
	
	// Limpiar tablas anteriores
	$('#load_data').html('<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-info-circle"></i> Seleccione una opción</td></tr>');
	$('#tabla2 tbody').html('<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-inbox"></i> No hay plazas seleccionadas</td></tr>');
	$('#por_documento').hide();
	$('#seleccion').val('');
	
	// Mostrar el modal de edición
	$('#exampleModalM').modal('show');
}

// Función mostrar FUP
function mostrarFUP(id) {
	// Limpiar el iframe primero para forzar que el navegador pida el archivo de nuevo
	$('#pdf_qnaFUP').attr('src', '');
	$.ajax({
		url: 'buscar_PDF_local_CT.php',
		type: 'POST',
		data: { id: id },
		success: function(result) {
			if(result && result != "") {
				// Evitar que el navegador muestre una copia en caché del FUP
				// (el nombre del archivo es siempre el mismo cuando se edita/regenera)
				var resultSinCache = result + (result.indexOf('?') === -1 ? '?' : '&') + 'v=' + Date.now();
				$('#pdf_qnaFUP').attr('src', resultSinCache + "#toolbar=0&navpanes=0&scrollbar=1&zoom=77");
				$("#dialog-confirmPDFFUP").dialog({
					resizable: false, height: 600, width: 1100, modal: true,
					showCloseButton: false, closeOnEscape: false,
					open: function(event, ui) { $('.ui-dialog-titlebar-close').hide(); },
					buttons: { "Salir": function() { $(this).dialog("close"); $('#pdf_qnaFUP').attr('src', ''); } }
				});
			} else {
				$("#dialog-confirm2").dialog({ modal: true, buttons: { "Salir": function() { $(this).dialog("close"); } } });
			}
		},
		error: function() {
			$("#dialog-confirm2").dialog({ modal: true, buttons: { "Salir": function() { $(this).dialog("close"); } } });
		}
	});
}

// Agregar a seleccionados
// Agregar a seleccionados
$(document).on('click', '.envio', function() {
    var row = $(this).closest('tr');
    var exists = false;

    // Verificar si la plaza ya fue seleccionada (comparar por algún campo único, ej. cons_plaza)
    var plazaId = row.find('td:eq(6)').text().trim();  // cons_plaza (Plaza)
    $('#tabla2 tbody tr').each(function() {
        if (!$(this).find('td[colspan]').length && $(this).find('td:eq(6)').text().trim() === plazaId) {
            exists = true;
        }
    });

    if (exists) {
        alert('Esta plaza ya ha sido seleccionada');
        return;
    }

    // Limpiar mensaje vacío si existe
    if ($('#tabla2 tbody tr td[colspan]').length) {
        $('#tabla2 tbody').empty();
    }

    // Obtener valores de las celdas de la fila origen (índices correctos)
    var cod_pago   = row.find('td:eq(1)').text().trim();   // Cód.Pago
    var unidad     = row.find('td:eq(2)').text().trim();   // Unidad
    var subunidad  = row.find('td:eq(3)').text().trim();   // Subunidad
    var puesto     = row.find('td:eq(4)').text().trim();   // Puesto
    var horas      = row.find('td:eq(5)').text().trim();   // Horas
    var plaza      = row.find('td:eq(6)').text().trim();   // Plaza
    var motivo     = row.find('td:eq(7)').text().trim();   // Motivo
    var nivel      = row.find('td:eq(8)').text().trim();   // Nivel
    var qna_ini    = row.find('td:eq(9)').text().trim();   // Qna.Ini
    var qna_fin    = row.find('td:eq(10)').text().trim();  // Qna.Fin
    var documento  = row.find('td:eq(11)').text().trim();  // Documento
    var ct         = row.find('td:eq(12)').text().trim();  // CT

    // Agregar fila a la tabla de seleccionadas
    $('#tabla2 tbody').append(
        '<tr>' +
        '<td><button class="btn btn-sm btn-danger borrar"><i class="fas fa-trash"></i></button></td>' +
        '<td>' + cod_pago + '</td>' +
        '<td>' + unidad + '</td>' +
        '<td>' + subunidad + '</td>' +
        '<td>' + puesto + '</td>' +
        '<td>' + horas + '</td>' +
        '<td>' + plaza + '</td>' +
        '<td>' + motivo + '</td>' +
        '<td>' + nivel + '</td>' +
        '<td>' + qna_ini + '</td>' +
        '<td>' + qna_fin + '</td>' +
        '<td>' + documento + '</td>' +
        '<td>' + ct + '</td>' +
        '</tr>'
    );
});

// Eliminar seleccionado
$(document).on('click', '.borrar', function() {
	$(this).closest('tr').remove();
	if($('#tabla2 tbody tr').length === 0 || $('#tabla2 tbody tr:first-child td[colspan]').length) {
		$('#tabla2 tbody').html('<tr><td colspan="13" class="text-center text-muted"><i class="fas fa-inbox"></i> No hay plazas seleccionadas</td></tr>');
	}
});

// Función menu_origenes
function menu_origenes(o1,o2,o3,o4,o5,o6,o7,o8,o9) {
	var elementos = ['Todos','Temporales','Permisos','Definitivos','Reingreso','Historico','Historico_o','Num_Docto','TodosSND','Actuales'];
	for(var i=0; i<elementos.length; i++) {
		var show = false;
		if(i==0) show = (o1==1);
		else if(i==1) show = (o1==1);
		else if(i==2) show = (o2==1);
		else if(i==3) show = (o3==1);
		else if(i==4) show = (o4==1);
		else if(i==5) show = (o5==1);
		else if(i==6) show = (o6==1);
		else if(i==7) show = (o7==1);
		else if(i==8) show = (o8==1);
		else if(i==9) show = (o9==1);
		
		if(show) {
			$('#'+elementos[i]).show().removeAttr('disabled');
		} else {
			$('#'+elementos[i]).hide();
		}
	}
}

// Inicializar
setTimeout(function() {
	menu_origenes(1,1,1,1,1,1,1,1,1);
}, 100);
</script>

</body>
</html>
