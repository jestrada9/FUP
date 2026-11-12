<?php
require_once('../Conexion/ServicioWeb.php');
$usuario = $_GET['usuario'] ?? '';
$valor = "";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FUP CAMBIO CT</title>
    
    <!-- CSS y JS externos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript">
    // Función para mostrar/ocultar elementos del menú
    function menu_origenes(o1,o2,o3,o4,o5,o6,o7,o8,o9) {
        if(o1==1) { $("#Todos").show(); $('#Todos').removeAttr('disabled'); }  
        if(o1==1) { $("#Temporales").show(); $('#Temporales').removeAttr('disabled'); }
        if(o2==1) { $("#Permisos").show(); $('#Permisos').removeAttr('disabled'); }
        if(o3==1) { $("#Definitivos").show(); $('#Definitivos').removeAttr('disabled'); }
        if(o4==1) { $("#Reingreso").show(); $('#Reingreso').removeAttr('disabled'); }
        if(o5==1) { $("#Historico").show(); $('#Historico').removeAttr('disabled'); }
        if(o6==1) { $("#Historico_o").show(); $('#Historico_o').removeAttr('disabled'); }
        if(o7==1) { $("#Num_Docto").show(); $('#Num_Docto').removeAttr('disabled'); }
        if(o8==1) { $("#TodosSND").show(); $('#TodosSND').removeAttr('disabled'); }
        if(o9==1) { $("#Actuales").show(); $('#Actuales').removeAttr('disabled'); }
    }
    
    // Función para agregar filas a la tabla
    $(document).on('click', '.envio', function (event) {
        var hermano = $(this).parent();
        $("#tabla2 tbody").prepend("<tr>\
            <td style='text-align: center; font-size:80%; padding:0px;'><input type='image' src='../Logo/subtract2.png' class='borrar' /></td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(0)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(1)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(2)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(3)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(4)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(5)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(6)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(7)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(8)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(9)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(10)").text()+"</td>\
            <td style='text-align: center; font-size:80%; padding:0px;'>"+hermano.siblings("td:eq(11)").text()+"</td>\
            <td style='display:none;'>"+hermano.siblings("td:eq(12)").text()+"</td>\
            <td style='display:none;'>"+hermano.siblings("td:eq(14)").text()+"</td>\
            <td style='display:none;'>"+hermano.siblings("td:eq(15)").text()+"</td>\
            <td style='display:none;'>"+hermano.siblings("td:eq(16)").text()+"</td>\
            <td style='display:none;'>"+hermano.siblings("td:eq(17)").text()+"</td>\
        </tr>");
    });
    
    // Función para prevenir comportamiento por defecto en enlaces
    $(function () {
        $('#tbody tr').click(function (e) {
            var a = $(this).closest('tr').find('a');
            e.preventDefault();
        });
    });
    
    // Función para eliminar filas
    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
    });
    
    // Función para mostrar/ocultar campo de documento
    function mostrar(id) {
        if(id == "Num_Docto") {
            $("#por_documento").show();     
        } else {
            $("#por_documento").hide();
        }
    }
    
    // Clase constructora para manejar datos
    class constructors {
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

    // Función para formatear detalles de fila
    function format(d) {
        return (
            '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr><td>Movimiento:</td><td>' + d[5] + '</td></tr>' +
            '<tr><td>Número Oficio:</td><td>' + d[9] + '</td></tr>' +
            '<tr><td>Plazas:</td><td>' + d[3] + '</td></tr>' +        
            '</table>'
        );
    }

    // Función para cargar datos
    function load(){
        var seleccion = $('#seleccion').val();
        var id = $('#id').val();
        var oficio = $('#oficio').val();
        var area = $('#area').val();        
        var rfc = $('#rfc').val();    
        var usuario = $('#usuario').val();    
        var por_documento = $('#por_documento').val();
        
        $('#load_data').empty();
        $loader = $('<tr id="loaders"><td colspan = "13"><center><img src="../Logo/loader.gif" alt="loading" /><br/>Un momento, por favor...</center></td></tr>');
        $loader.appendTo('#load_data');
        
        $.ajax({
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
            success: function(result){
                if(result != ""){
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
        });
    }
    
    // Variables globales
    var hoy = new Date();
    var hora = hoy.getHours() + '-' + hoy.getMinutes();
    var fecha1 = new Date();
    var fecha = fecha1.toLocaleDateString();
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
    var usuario = "<?php echo $usuario; ?>";
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

    // Función para formatear fecha
    function formatoFecha(fecha, formato) {
        const map = {
            dd: fecha.getDate(),
            mm: fecha.getMonth() + 1,
            yy: fecha.getFullYear().toString().slice(-2),
            yyyy: fecha.getFullYear()
        };
        return formato.replace(/dd|mm|yy|yyy/gi, matched => map[matched]);
    }
    
    var presente = formatoFecha(fecha1, 'dd-mm-yy');
    var fechaYHora = presente + '_' + hora;

    // Document ready
    $(document).ready(function () {
        // Cerrar modal
        $('#cerrar').click(function (e) {
            $("#exampleModalM").modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });
        
        // Inicializar tabla DataTable
        tabla = "#myTable";     
        $("#example-select-all").show();
        
        table = $('#myTable').DataTable({
            destroy: true,
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Total de _TOTAL_ registros",
                "sInfoEmpty": "Total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
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
            ordering: false,
            initComplete: function(settings, json) {
                $("th").removeClass('sorting_asc');
            },
            ajax: {
                url: "data_cambio_CT.php",
                rowId: function(a) {
                    return 'id_' + a.uid;
                },
            },
            "lengthChange": false,
            "paging": false,
            "bAutoWidth": false,
            "info": true,
            "searching": true,
            columnDefs: [
                {
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (aaData, type, full, meta){
                        return '<input type="checkbox" class=selecheck name="id[]" value="' + $('<div/>').text(aaData).html() + '">';
                    },
                    width: 50,  
                },
                {
                    'targets': 1,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (aaData, type, full, meta){
                        return '<input type="button" class="btn btn-info" name="previo" value="Previo" id="previo">';
                    }
                },
                {
                    targets: 2,//num_docto
                    visible: true,
                    width: 70,                  
                },              
                {
                    targets: 3,//num_oficio
                    visible: true,
                    searchable: true,                   
                },
                {
                    targets: 4,//rfc
                    visible: true,
                    searchable: false,
                },  
                {
                    targets: 5,//plaza
                    visible: true,
                    searchable: true,
                },                     
                {
                    targets: 6,//area nombre
                    visible: true,
                    searchable: true,
                },   
                {
                    targets: 7,//ct nuevo
                    visible: true,
                    searchable: true,
                }, 
                {
                    targets: 8,//ct anterior
                    visible: true,
                    searchable: true,
                },  
                {
                    targets: 9,//area hide
                    visible: true,
                    searchable: true,
                    className: "hide_me",
                },
                {
                    targets: 10,//idAutorizar hide
                    visible: true,
                    searchable: true,
                    className: "hide_me",
                },   
                {
                    targets: 11,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (aaData, type, full, meta){
                        if(aaData && aaData.match(/[00000]/g) != null && aaData.match(/[00000]/g).length == 5) {
                            return '';
                        } else {
                            return '<input type="button" class="btn btn-danger" name="FUP" value="FUP" id="FUP">';
                        }
                    }   
                }                             
            ],
            dom: "<'row dom_wrapper fh-fixedHeader'<'col-sm col-md'>i<'col-sm col-md'>f<'col-sm col-md'>>" +
                "<'row'<'col-sm col-md'tr>>" +
                "<'row '<'col-sm col-md'>p<'col-sm col-md'>>",    
        });

        // Evento para botón Previo
        table.on('click', '#previo', function (e) {
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
            var usuario = "<?php echo $usuario; ?>";

            $.ajax({
                url: '../Pdf/CrearPDF/CrearPrevio.php',
                type: 'POST',
                data: {
                    id: id,
                    oficio: oficio,
                    area: area,
                    rfc: rfc,
                    usuario: usuario
                },
                success: function(result){
                    if(result != ""){
                        $('#pdf_qna').attr('src', result+"#toolbar=0&navpanes=0&scrollbar=1&zoom=77");
                        $("#dialog-confirmPDF").show();
                        $("#dialog-confirmPDF").dialog({
                            resizable: false,
                            height: 600,
                            width: 1100,
                            modal: true,
                            showCloseButton: true,
                            closeOnEscape: false,    
                            open: function(event, ui) {
                            },                         
                            buttons: {
                                Salir: function() {
                                    $(this).dialog("close");
                                },
                                Editar: function() {
                                    document.getElementById('load_data').innerHTML = '';
                                    document.querySelector('#tabla2 tbody').innerHTML = '';
                                    $("#exampleModalM").attr("title", "Agregar o Editar Antecedentes: "+oficio);
                                    $("#exampleModalM").show();
                                    $("#exampleModalM").dialog({
                                        resizable: false,
                                        height: 600,
                                        width: 1100,
                                        modal: true,
                                        showCloseButton: true,
                                        closeOnEscape: false, 
                                    });
                                    $('#load_data').empty();
                                    $('#exampleModalLabel1').text("Antecedentes de: "+rfc+" "+oficio);
                                    $('#id').val(id);
                                    $('#oficio').val(oficio);
                                    $('#area').val(area);
                                    $('#rfc').val(rfc);
                                    $('#usuario').val(usuario);
                                }
                            }
                        });
                    } else {
                        $("#dialog-confirm2").show();
                        $("#dialog-confirm2").dialog({
                            resizable: false,
                            height: "auto",
                            width: 400,
                            modal: true,
                            buttons: {
                                Salir: function() {
                                    $(this).dialog("close");
                                }
                            }
                        });
                    }
                }
            });
        });

        // Evento para botón FUP
       table.on('click', '#FUP', function (e) {
    frame = document.getElementById("pdf_qnaFUP");
    html = "";
    frame.contentWindow.document.open();
    frame.contentWindow.document.write(html);
    frame.contentWindow.document.close();

    var data = table.row($(this).parents('tr')).data();
    var id = data[2];

    $.ajax({
        url: 'buscar_PDF_local_Previo.php',
        type: 'POST',
        dataType: 'json', // Esperar respuesta JSON
        data: {
            id: id,
        },
        success: function(result){
            if(result.archivo != ""){ // Cambiar a result.archivo
                var fechaHora = result.fecha_hora;
                
                $('#pdf_qnaFUP').attr('src', result.archivo + "#toolbar=0&navpanes=0&scrollbar=1&zoom=77");
                $("#dialog-confirmPDFFUP").show();
                
                // Actualizar el título del modal con la fecha/hora
                $("#dialog-confirmPDFFUP").attr("title", "Vista Previa FUP - " + fechaHora);
                
                $("#dialog-confirmPDFFUP").dialog({
                    resizable: false,
                    height: 600,
                    width: 1100,
                    modal: true,
                    showCloseButton: false,
                    closeOnEscape: false,    
                    open: function(event, ui) {
                        // Agregar la fecha/hora dentro del modal
                        if (!$('.fecha-documento-fup').length) {
                            $(this).prepend('<div class="fecha-documento-fup" style="padding: 10px; background: #f0f0f0; border-bottom: 1px solid #ccc; font-size: 14px; text-align: center;">Fecha y hora del documento: <strong>' + fechaHora + '</strong></div>');
                        } else {
                            $('.fecha-documento-fup').html('Fecha y hora del documento: <strong>' + fechaHora + '</strong>');
                        }
                    },                         
                    buttons: {
                        Salir: function() {
                            $(this).dialog("close");
                        },
                    }
                });
            } else {
                $("#dialog-confirm2").show();
                $("#dialog-confirm2").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    buttons: {
                        Salir: function() {
                            $(this).dialog("close");
                        }
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar el PDF:", error);
            // Manejar error si es necesario
        }
    });
});

        // Evento para mostrar/ocultar detalles de fila
        table.on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
     
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
            } else {
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });

        // Evento para botón cancelar
        $(tabla+' tbody').on('click', '#cancelar', function () {
            var data = table.row($(this).parents('tr')).data();
            var json1 = "undefined";
            var url = "cancelar_cgrh.php";
            var newarrays = new Array();

            $("#dialog-confirm_cancelar").show();
            $("#dialog-confirm_cancelar").dialog({
                resizable: false,
                height: "auto",
                width: 400,
                modal: true,
                buttons: {
                    "Si": function() {
                        var num_docto  = data[2];
                        var num_oficio = data[3];
                        var area       = data[8];
                        var usuario    = "<?php echo $usuario; ?>";
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
                            success: function(result){
                                alert(result);
                                $(tabla).DataTable().ajax.reload();
                            }
                        });
                        table.row(':eq(0)', { page: 'current' }).remove().draw();
                        $(this).dialog("close");
                    },
                    Cancelar: function() {
                        $(this).dialog("close");
                    }
                }
            });
        });

        // Evento para seleccionar todos los checkboxes
        $('#example-select-all').on('click', function(){
            var data = table.row({ 'search': 'applied' }).data();
            tablas = document.getElementsByTagName('tbody')[0];
            totals2 = tablas.rows.length;    
            for (j = 0; j < totals2; j++) {
                var num_doctos = tablas.rows[j].cells[0].childNodes[0].value;
                $('input[value="'+num_doctos+'"]').prop('checked', this.checked);
            }
        });

        // Evento para cambios en checkboxes individuales
        $(tabla+' tbody').on('change', 'input[type="checkbox"]', function(){
            if(!this.checked){
                var el = $('#example-select-all').get(0);
                if(el && el.checked && ('indeterminate' in el)){
                    el.indeterminate = true;
                }
            }
        });

        // Manejo de checkboxes en el DOM
        table.$('input[type="checkbox"]').each(function(){
            if(!$.contains(document, this)){
                if(this.checked){
                    $(form).append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'id[]')
                            .val(this.value)
                    );
                }
            }
        });

        // Evento para búsqueda
        var val2 = false;
        $('input[type="search"]').change(function() {
            var val = "";
            var input = $('input[type="search"]');
            val = input.val();

            if (val != "") {
                val2 = true;
            }
        });

        // Evento para botón Autorizar
        $("#btnGetDataP").click(function() {
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
            
            resus.push(ids);
            total2.totals = resus[0].length;
            
            if(resus[0].length == 0) {
                $('[id$=textValidarAviso]').text("Seleccione al menos un registro");
                $("#dialog-ValidarSeleccion").show();
                $("#dialog-ValidarSeleccion").dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                    buttons: {
                        OK: function() {
                            $(this).dialog("close");
                        }
                    }
                });
            } else {
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
                
                ids2 = $('input[class="selecheck"]:checked').map(function() {
                    return $(this).attr('value');
                }).get();
                
                resus2.push(ids2); 
                tot = resus2[0].length;
                tablas = document.getElementsByTagName('tbody')[0];
                totals2 = tablas.rows.length;    
                
                for (i = 0; i < tot; i++) {
                    msgForIn = resus[0][i];

                    if(msgForIn == resus2[0][i]) {
                        for (j = 0; j < totals2; j++) {
                            var num_doctos = tablas.rows[j].cells[3].childNodes[0].data;

                            if(num_doctos == msgForIn) {
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
                                
                                newarrays2.push(tm1);
                                newarrays.push(tm1);
                                newarrays.push(tm2);
                                newarrays.push(tm3);
                                newarrays.push(tm4);
                                table.row('.selected').remove().draw(false);
                            }
                        }
                    }
                }

                json2 = JSON.stringify(BlockID2(newarrays2));
                obj = JSON.parse(json2);
                nt = obj['newarrays2'][0]['totals'];
                ndt = "";
                
                for(let i = 1; i <= nt; i++) {
                    ndt = ndt + obj['newarrays2'][i]['num_docto'] + ",";
                }
                
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
                $("#dialog-aviso").dialog({
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
                    buttons: {
                        "Aceptar": function() {
                            json1 = JSON.stringify(BlockID1(newarrays));
                            $('#p_barra').val("Cuando termine el proceso, ésta ventana se cerrará, por favor, espere.");
                            $(".ui-button").hide();
                            $("#p_barra").show();
                            
                            $.ajax({
                                url: "../pantallas/update_autorizar_Paty_ct.php",
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
                                    if(result != ""){
                                        $("#prof").css('height', '30px');
                                        $("#progressBar1").css('height', '30px');
                                        $("#progressBar1").css('color', 'black');
                                        $("#progressBar1").text('100% - Carga realizada');
                                        $("#dialog-aviso").hide();
                                        $("#dialog-aviso").dialog("close");                                
                                        resus = [];
                                        resus2 = [];        
                                        $('input:checkbox').prop('checked', false);
                                        $("#btnGetDataP").removeAttr("disabled");
                                        $('#myTable').DataTable().ajax.reload();
                                        $(".ui-button").show();
                                        $("#p_barra").hide();  
                                    }
                                },
                                complete: function(){
                                    clearInterval(timer);
                                    ndt = "";
                                    resus = [];
                                    resus2 = [];
                                    $(tabla).DataTable().ajax.reload();
                                    $(this).dialog("close");
                                }   
                            }); 
                        },
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
                    }
                });                            
            }
        });
    });
    </script>
    
    <?php
        include "../Scripts/script_Tabla_CT_Previo.php";
    ?>
    
    <style type="text/css">
    #letra{
        color: black;
    }    
    #pdf_qna, #pdf_qnaFUP {
        width: 100%;
        height: 97%;
        padding:0;
        border: none;
    }
    .dataTable label {
        color: white;
    }
    #myTable2_filter label{
        color:black;
    }    
    #myTable{        
        height: 500px;
        max-height: 500px;
        width: 100%;
        clear: both;
        border-collapse: collapse;
        table-layout: fixed;
    }
    #myTables{
        height: 200px;
        max-height: 200px;
        width: 100%;
        clear: both;
        border-collapse: collapse;
        table-layout: fixed;
    }
    th{
        background-color: #393939;
        text-align: center;
    }
    td{
        text-align: center;
    }
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
    #divatabla{
        position: absolute;
        top: 50px;
        left: 0px;
        width: 100%;
    }    
    #seleccion{
        position: absolute;
        top: 5px;
        left: 0px;
        width: 188px;
        height: 30px;
    }
    #por_documento{
        position: absolute;
        top: 7px;
        left: 200px;
        border-width: 2px; 
        border-style: dotted;
        border-color: #0069D9;
    }
    #btn_search{
        position: absolute;
        top: 7px;
        left: 415px;
        height: 30px;
        width: 118px; 
    }    
    thead tr th{ 
        position: sticky;
        top: 0;
        z-index: 10;
    }    
    #btnGetData{
        position: absolute;
        top: 6px;
        left: 590px;
        height: 30px; 
        width: 118px;
    }
    #divTabla{
        position: absolute;
        top: 100px;
        left: 0px;
        height: 270px;
    }
    #divTabla2{
        position: absolute;
        top: 290px;
        left: 0px;
        height: 220px;
    }

    #exampleModalM {
        padding: 15px;
        max-height: 80vh;
        overflow-y: auto;
    }
    .table-container {
        margin-bottom: 15px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        overflow: hidden;
    }
    .table-header {
        color: white;
        padding: 8px 10px;
        border-bottom: 1px solid #dee2e6;
        font-weight: bold;
        font-size: 0.95rem;
    }
    .observaciones-container {
        display: flex;
        gap: 8px;
        margin: 12px 0;
        width: 100%;
        flex-wrap: nowrap;
        overflow-x: auto;
    }
    .observaciones-container input {
        min-width: 140px;
        flex: 1;
        font-size: 0.85rem;
        padding: 6px 10px;
        height: 20px; 
    }
    .controles-superiores {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 12px;
    }
    .controles-superiores select, 
    .controles-superiores button, 
    .controles-superiores input {
        flex: 1;
        min-width: 110px;
        font-size: 0.85rem;
        padding: 6px 10px;
    }
    .table-responsive {
        max-height: 180px;
        overflow-y: auto;
        font-size: 0.8rem;
    }
    #divTabla2 {
        margin-top: 15px;
    }
    table {
        margin-bottom: 0;
        width: 100%;
    }
    thead th {
        position: sticky;
        top: 0;
        color: white;
        z-index: 10;
        font-size: 0.8rem;
        padding: 6px 8px;
        vertical-align: middle;
    }
    tbody td {
        padding: 5px 8px;
        vertical-align: middle;
    }
    .sticky-footer {
        position: sticky;
        bottom: 0;
        background: white;
        padding: 8px;
        border-top: 1px solid #dee2e6;
        z-index: 10;
        margin-top: 10px;
    }
    .btn-sm {
        padding: 3px 8px;
        font-size: 0.8rem;
    }
    .table-responsive::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #a0a0a0;
        border-radius: 4px;
    }
    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #808080;
    }
            :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #34495e;
        }
        
        .modal-container {
            padding: 20px;
            max-height: 85vh;
            overflow-y: auto;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .header-controls {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            margin-bottom: 15px;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .header-controls select, 
        .header-controls input, 
        .header-controls button {
            flex: 1;
            min-width: 150px;
            margin: 0;
        }
        
        .observations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }
        
        .observations-grid input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        
        .table-section {
            margin-bottom: 25px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .table-header {
            background: var(--primary-color);
            color: white;
            padding: 12px 15px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-container {
            overflow-x: auto;
            max-height: 300px;
        }
        
        .custom-table {
            width: 100%;
            margin-bottom: 0;
            font-size: 0.85rem;
        }
        
        .custom-table thead th {
            background-color: var(--dark-color);
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
            padding: 10px 8px;
            text-align: center;
            vertical-align: middle;
            font-weight: 600;
            border: none;
        }
        
        .custom-table tbody td {
            padding: 8px;
            vertical-align: middle;
            text-align: center;
        }
        
        .custom-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .custom-table tbody tr:hover {
            background-color: #e9f7fe;
        }
        
        .btn-action {
            padding: 4px 8px;
            font-size: 0.8rem;
            border-radius: 4px;
            margin: 2px;
        }
        
        .btn-add {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }
        
        .btn-remove {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        
        .hidden-fields {
            display: none;
        }
        
        /* Scroll personalizado */
        .table-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        .table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        .table-container::-webkit-scrollbar-thumb {
            background: #a0a0a0;
            border-radius: 4px;
        }
        
        .table-container::-webkit-scrollbar-thumb:hover {
            background: #808080;
        }
    @media (max-width: 992px) {
            .header-controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .observations-grid {
                grid-template-columns: 1fr;
            }
        }
    @media (max-width: 768px) {
            .custom-table {
                font-size: 0.75rem;
            }
            
            .custom-table thead th,
            .custom-table tbody td {
                padding: 6px 4px;
            }
            
            .btn-action {
                padding: 3px 5px;
                font-size: 0.7rem;
            }
        }
        /* Mejoras para el scroll en las tablas */
.table-container {
    max-height: 250px; /* Altura fija para el scroll */
    overflow-y: auto;
    overflow-x: auto;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    position: relative;
}

/* Asegurar que el header sea sticky */
.custom-table thead th {
    position: sticky;
    top: 0;
    z-index: 10;
    background-color: var(--dark-color);
    color: white;
    padding: 10px 8px;
    text-align: center;
    vertical-align: middle;
    font-weight: 600;
    border: none;
}

/* Estilo para el tbody con scroll */
.custom-table tbody {
    display: block;
    overflow-y: auto;
    max-height: 200px; /* Altura para el scroll */
}

.custom-table thead,
.custom-table tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}

.custom-table tbody tr {
    width: 100%;
}

/* Asegurar que las celdas mantengan el ancho definido */
.custom-table th,
.custom-table td {
    word-break: break-word;
}

/* Mejoras para la segunda tabla */
#tabla2 tbody {
    display: block;
    overflow-y: auto;
    max-height: 200px;
}

#tabla2 thead,
#tabla2 tbody tr {
    display: table;
    width: 100%;
    table-layout: fixed;
}

/* Ajuste para los botones de acción */
.btn-action {
    padding: 4px 8px;
    font-size: 0.8rem;
    border-radius: 4px;
    margin: 2px;
}

/* Mejora para el scrollbar en la tabla */
.table-container::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

.table-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 5px;
}

.table-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 5px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Para Firefox */
.table-container {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}

/* Ajuste para mensaje de "sin registros" */
.text-center.py-4 {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    padding: 20px;
    color: #6c757d;
}

/* Asegurar que el modal no se desborde */
.modal-container {
    max-height: 85vh;
    overflow-y: auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
    </style>    
</head>

<body>
    <label id="pendientes">FUP Cambio CT</label>
    <div id="divatabla">
        <form name="frm-example" id="frm-example">
            <table id="myTable" cellspacing="0">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="select_all" value="1" id="example-select-all"><strong><label>Crear</label></strong></th>
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
                        <th><strong><label>Crear</label></strong></th>
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
                </tfoot>
            </table>
        </form>
    </div>
    
    <button type="submit" name="btnGetDataP" class="btn btn-success" id="btnGetDataP">Autorizar</button>
    <input type="text" class="form-control producto" name="BuscarRelacion" id="relac" autocomplete="off" style="display: none;">
    
    <div id="dialog-confirmPDF" title="¿Ver PDF?" style="display: none;">
        <iframe name="pdf_qna" id="pdf_qna"></iframe>
    </div> 
    <div id="dialog-confirmPDFFUP" title="¿Ver PDF?" style="display: none;">
        <iframe name="pdf_qnaFUP" id="pdf_qnaFUP"></iframe>
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
    <div id="dialog-fup_mal" title="¡ATENCIÓN!" style="display: none;">
        <textarea id="text_fup_mal"></textarea>
    </div>

    <div id="exampleModalM" title="Gestión de FUP Cambio CT" class="modal-container" style="display:none;">
        <!-- Controles superiores -->
        <div class="header-controls">
            <select name="seleccion" id="seleccion" class="form-control form-control-sm" onchange="mostrar(this.value);">
                <option value="" disabled selected hidden>Seleccionar filtro</option>
                <option value="Actuales" id="Actuales" style="display: none;">Actuales</option>
                <option value="Todos" id="Todos" style="display: none;">Todos</option>
                <option value="TodosSND" id="TodosSND" style="display: none;">Todos Sin Número Documento</option>
                <option value="Historico" id="Historico" style="display: none;">Histórico de Plazas del Movimiento</option>
                <option value="Historico_o" id="Historico_o" style="display: none;">Histórico Otras Plazas</option>
                <option value="Num_Docto" id="Num_Docto" style="display: none;">Por Documento</option>
            </select>
            
            <input type="text" id="por_documento" placeholder="Número de documento" value="" maxlength="10" style="display: none;">
            
            <button type="submit" name="btn_search" class="btn btn-primary btn-sm" id="btn_search" onclick="load()">
                <i class="fas fa-search"></i> Ver Registros
            </button>
            
            <button type="submit" name="btnGetData" class="btn btn-danger btn-sm" id="btnGetData">
                <i class="fas fa-file-pdf"></i> Crear FUP
            </button>
        </div>
        
        <!-- Campos de observaciones -->
        <div class="observations-grid">
            <input type="text" id="observacion1" placeholder="Observación 1" value="" maxlength="64" style="text-transform:uppercase;">
            <input type="text" id="observacion2" placeholder="Observación 2" value="" maxlength="64" style="text-transform:uppercase;">
            <input type="text" id="observacion3" placeholder="Observación 3" value="" maxlength="64" style="text-transform:uppercase;">
            <input type="text" id="observacion4" placeholder="Observación 4" value="" maxlength="64" style="text-transform:uppercase;">
        </div>
        
        <!-- Primera tabla -->
        <div class="table-section">
            <div class="table-header">
            </div>
            <div class="table-container">
                <table class="custom-table">
                    <thead>
                        <tr>             
                            <th width="80"><strong>Agregar</strong></th>
                            <th width="70"><strong>CP</strong></th>
                            <th><strong>Unidad</strong></th>
                            <th><strong>Subunidad</strong></th>
                            <th><strong>Puesto</strong></th>
                            <th width="70"><strong>Horas</strong></th>
                            <th width="80"><strong>Plaza</strong></th>
                            <th><strong>Motivo</strong></th>
                            <th width="90"><strong>Nivel S.</strong></th>
                            <th width="90"><strong>Qna. Ini</strong></th>
                            <th width="90"><strong>Qna. Fin</strong></th>
                            <th width="100"><strong>Documento</strong></th>
                            <th width="80"><strong>CT</strong></th>
                        </tr>
                    </thead>
                    <tbody id="load_data"> 
                        <!-- Los datos se cargarán aquí -->
                        <tr>
                            <td colspan="13" class="text-center py-4">Seleccione un filtro y haga clic en "Ver Registros"</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Segunda tabla -->
        <div class="table-section">
            <div class="table-header">
            </div>
            <div class="table-container">
                <table id="tabla2" class="custom-table">
                    <thead>
                        <tr>           
                            <th width="80"><strong>Eliminar</strong></th>  
                            <th width="70"><strong>CP</strong></th>
                            <th><strong>Unidad</strong></th>
                            <th><strong>Subunidad</strong></th>
                            <th><strong>Puesto</strong></th>
                            <th width="70"><strong>Horas</strong></th>
                            <th width="80"><strong>Plaza</strong></th>
                            <th><strong>Motivo</strong></th>
                            <th width="90"><strong>Nivel S.</strong></th>
                            <th width="90"><strong>Qna. Ini</strong></th>
                            <th width="90"><strong>Qna. Fin</strong></th>
                            <th width="100"><strong>Documento</strong></th>
                            <th width="80"><strong>CT</strong></th>
                            <th style="display:none;"><strong>Valor2</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="13" class="text-center py-4">No hay registros seleccionados</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Campos ocultos -->
        <div class="hidden-fields">
            <input type="hidden" name="id" id="id" value="" />
            <input type="hidden" name="oficio" id="oficio" value="" />
            <input type="hidden" name="rfc" id="rfc" value="" />
            <input type="hidden" name="area" id="area" value="" />
            <input type="hidden" name="usuario" id="usuario" value="" />
        </div>
    </div>
</body>
</html>

<script type="text/javascript">menu_origenes(1,1,1,1,1,1,1,1,1);</script>