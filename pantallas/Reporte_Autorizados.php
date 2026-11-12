<?php
    $usuario = $_GET['usuario'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pendientes CGRH</title>
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
<script type="text/javascript" language="javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js">
</script>
<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js">
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
    class constructors{ //class constructor Plazas Selecionadas
      get total(){return this._total;}
      set total(total){this._total = total;}
      get nd(){return this.num_docto;}
      set nd(nd){this.num_docto = nd;}
      get areas(){return this.area;}
      set areas(areas){this.area = areas;} 
      get num_oficios(){return this.num_oficio;}
      set num_oficios(num_oficios){this.num_oficio = num_oficios;}
      get obs(){return this.observacion;}
      set obs(obs){this.observacion = obs;}   
      get us(){return this.usuario;}
      set us(us){this.usuario = us;}   
      get ara(){return this.area;}
      set ara(ara){this.area = ara;}  
      get no(){return this.num_oficio;}
      set no(no){this.num_oficio = no;}                          
    }           
    function format(d) {
        // `d` is the original data object for the row
        //console.log(d);
        return (
            '<table cellpadding="0" cellspacing="0" border="0" style="padding-left:50px;">' +
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
            $("#BuscarRelacionBtt").hide();  
            /*
            $("#select").show(); 
            $("option[value='Ordenamiento']").hide();
            */
        }else if (sele1=="Relacion") {
            $("#select").hide(); 
            $("#BuscarRelacion").show();   
            $("#BuscarRelacionBtt").show();  
            $("#BuscarRelacion").focus(); 
        }else{
            $("#select").show();  
            $("#BuscarRelacion").hide();   
            $("#BuscarRelacionBtt").hide();
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
    var table;
    function seleccionar(sele1,sele,aaData){//seleccionar
            //$("class=['sorting_asc']").hide();
            //$('th.sorting_asc').hide();
        $("#example-select-all").show();
        table= $('#myTable').DataTable().clear().destroy();
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
            searching: true,
            ordering: false, //disable ordering
            initComplete: function( settings, json ) {
              $("th").removeClass('sorting_asc'); //remove sorting_desc class
            },
            ajax:{
                    url: aaData
            },
            "lengthChange": false,
            "paging": false,
            "bAutoWidth": false,
            "info":     true,       
            columnDefs: [
            {
                targets: 0,//num_docto
                visible: true,
                searchable: true,
                width: 50,
                
            },                  
            {
                targets: 1,//Recibida CGRH
                visible: true,
                searchable: true,
                width: 50,
                
            },                
            {
                targets: 2,//num_docto
                visible: true,
                searchable: true,
                width: 50,
                
            },
            {
                targets: 3,//rfc
                visible: true,
                searchable: true,
                width: 60,  
                
            },                                  
            {
                targets: 4,//plaza
                visible: true,
                width: 90,
                
            },
            {
                targets: 5,//ct
                visible: true,
                width: 50,
                //className: "hide_me",
            },
            {
                targets: 6,//dir ct
                visible: true,
                width: 90,
                //className: "hide_me",
            },                
            {
                targets: 7,//qna_ini
                visible: true,
                width: 45,
            },
            {
                targets: 8,//qna_fin
                visible: true,
                searchable: true,
                width: 45,
            },                              
            {
                targets: 9,//mot
                visible: true,
                width: 20,
            },
            {
                targets: 10,//admin/doc
                visible: true,
                width: 40,
            },              
            {
                targets: 11,//fec/aut/admin
                visible: true,
                searchable: true,
                width: 40,
            },                            
            {
                targets: 12,//qna_afectada
                visible: true,
                searchable: true,
                 width: 40,
            },  
            /*                
            {
                targets: 11,//envio_fone
                visible: true,
                searchable: true,
                 width: 30,
            },
            */
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
                filename: 'Reporte_Autorizados_'+sele+'_'+sele1+'_'+fechaYHora,
                text: '<button id="ExportCGRH" class="btn btn-primary">Exportar a Excel</button>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                }
            },
            ]
            }       
        });//myTable
                    //$("#myTable_filter").remove();        
                    //$("input[type=search]").hide();
                    //$('#myTable').DataTable().ajax.reload();

        $('#myTable tbody').on('click', 'td.dt-control', function () {
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

    }//seleccionar  

        var fec1 = "";
        var fec2 = "";
        var quin = "";
        var radiio = "";

    $(document).ready( function () {

        $("input[name=selecheck]").click(function () {
 
            radiio = $(this).val();
            if(radiio=="fechas"){
                $("#dia1").show();
                $("#dia1").focus();
                $("#dia2").show();
                $("#BuscarQuincena").hide();
                $("#BuscarQuincena").val("");
                $("#BuscarRFC").hide();
                $("#BuscarRFC").val("");                
                $("#select1").show();
                $('#select1').val("value");
                $('#select').val("value0"); 
            }
            if(radiio=="quincenas"){
                $("#dia1").hide();
                $("#dia2").hide();
                $("#dia1").val("");
                $("#dia2").val("");
                $("#BuscarQuincena").show();
                $("#BuscarQuincena").focus();
                $("#BuscarRFC").hide();
                $("#BuscarRFC").val("");                                
                $("#select1").show();
                $('#select1').val("value");
                $('#select').val("value0");             
            } 
            if(radiio=="rfc"){
                $("#dia1").hide();
                $("#dia2").hide();
                $("#dia1").val("");
                $("#dia2").val("");
                $("#BuscarQuincena").hide();
                $("#BuscarQuincena").val("");
                $("#BuscarRFC").show();
                $("#BuscarRFC").focus();                
                $("#select1").show();
                $('#select1').val("value");
                $('#select').val("value0");             
            }            
        });

        idv = 0;
        sis = 0;
        mots = "";
/**/
        $("#reset").click(function() {//boton reset
        $("#example-select-all").hide();
        //$('th.sorting_asc').hide();
        $('#myTable').DataTable().clear().destroy();
        $("#BuscarQuincena").hide();
        $("#BuscarRFC").hide();
        $("#select1").hide();
        $("#select").hide();
        $("#dia1").hide();
        $("#dia2").hide();        
        $("#dia1").val("");
        $("#dia2").val("");   
        $("#BuscarQuincena").val("");    
        $("#BuscarRFC").val("");
        var table = $('#myTable').DataTable({//myTable
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
/**/        
        $("#example-select-all").hide();
        //$('th.sorting_asc').hide();
        var table = $('#myTable').DataTable({//myTable
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

        $("#select1").change(function(){
            let sele1 = $('#select1 option:selected').val();
            $('#select').val('value0');

            if(sele1 == 'Todos'){
                $('#myTable').DataTable().clear().destroy();
                fec1 = $("#dia1").val();
                fec2 = $("#dia2").val();                
                quin = $("#BuscarQuincena").val();
                rfc  = $("#BuscarRFC").val();


                if(radiio == "rfc"){
                    if(rfc.length==0){
                        alert("Falta Filiación");
                        $("#BuscarRFC").focus();                   
                    }
                    if(rfc.length!=0){
                        sele = "";
                        aaData = "data_fups_reportes_autorizados.php?cons=11&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";
                        seleccionar(sele1,sele,aaData);
                    }
                }
                if(radiio == "quincenas"){
                    if(quin.length==0){
                        alert("Falta Quincena");
                        $("#BuscarQuincena").focus();                   
                    }
                    if(quin.length!=0){
                        sele = "";
                        aaData = "data_fups_reportes_autorizados.php?cons=11&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";
                        seleccionar(sele1,sele,aaData);
                    }
                }
                if(radiio == "fechas"){
                    if(fec1.length==0){
                        alert("Falta Fecha Inicio");
                        $("#dia1").focus();         
                        $('#select1').val("value");
                        $('#select').val("value0");                                 
                    }else if(fec2.length==0){
                        alert("Falta Fecha Fin");
                        $("#dia2").focus();
                        $('#select1').val("value");
                        $('#select').val("value0");                         
                    }
                    if(fec1.length!=0 && fec2.length!=0){
                        sele = "";
                        aaData = "data_fups_reportes_autorizados.php?cons=11&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";
                        seleccionar(sele1,sele,aaData);
                    }                   
                }               

                  
           }else{
                $('#myTable').DataTable().clear().destroy();
           }
        });

        $("#select").change(function(){//select
            let sele = "";
            var aaData = "";

            $('#myTable').DataTable().clear().destroy();
            let sele1 = $('#select1 option:selected').val();
            sele = $('#select option:selected').val();
            seleA = $('#select option:selected').val();
            fec1 = $("#dia1").val();
            fec2 = $("#dia2").val();                
            quin = $("#BuscarQuincena").val();
            rfc = $("#BuscarRFC").val();

            if(sele=="Ordenamiento" && sele1=="Docentes"){
                aaData = "data_fups_reportes_autorizados.php?cons=1&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";
            }
            if(sele=="NO_Ordenamiento"  && sele1=="Docentes"){
                aaData = "data_fups_reportes_autorizados.php?cons=2&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";    
            }
            else if(seleA=="NO_Ordenamiento" && sele1=="Administrativos"){
                aaData = "data_fups_reportes_autorizados.php?cons=7&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";    
            }
            if(sele=="Bajas"  && sele1=="Docentes"){
                aaData = "data_fups_reportes_autorizados.php?cons=3&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";
            } 
            else if(seleA=="Bajas" && sele1=="Administrativos"){
                aaData = "data_fups_reportes_autorizados.php?cons=8&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";
            }     
            if(sele=="Licencias" && sele1=="Docentes"){
                aaData = "data_fups_reportes_autorizados.php?cons=4&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";     
            } 
            else if(seleA=="Licencias" && sele1=="Administrativos"){
                aaData = "data_fups_reportes_autorizados.php?cons=9&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";             
            }   
            if(sele=="Guiones" && sele1=="Docentes"){
                aaData = "data_fups_reportes_autorizados.php?cons=5&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";
            }else if(seleA=="Guiones" && sele1=="Administrativos"){
                aaData = "data_fups_reportes_autorizados.php?cons=10&fec1="+fec1+"&fec2="+fec2+"&quin="+quin+"&rfc="+rfc+"";
            }             

            if (sele1 == 'Administrativos'){
                if(radiio == "rfc"){
                    if(rfc.length==0){
                        alert("Falta Filiación");
                        $("#BuscarRFC").focus();
                        $('#select1').val("value");
                        $('#select').val("value0");                                             
                    }
                    if(rfc.length!=0){
                        if(aaData!=""){
                            $('#myTable').DataTable().clear().destroy();
                            seleccionar(sele1,sele,aaData);     
                        }
                    }
                }                 
                if(radiio == "quincenas"){
                    if(quin.length==0){
                        alert("Falta Quincena");
                        $("#BuscarQuincena").focus();
                        $('#select1').val("value");
                        $('#select').val("value0");                                             
                    }
                    if(quin.length!=0){
                        if(aaData!=""){
                            $('#myTable').DataTable().clear().destroy();
                            seleccionar(sele1,sele,aaData);     
                        }
                    }
                }
                if(radiio == "fechas"){
                    if(fec1.length==0){
                        alert("Falta Fecha Inicio");
                        $("#dia1").focus();         
                        $('#select1').val("value");
                        $('#select').val("value0");                                 
                    }else if(fec2.length==0){
                        alert("Falta Fecha Fin");
                        $("#dia2").focus();
                        $('#select1').val("value");
                        $('#select').val("value0");                         
                    }
                    if(fec1.length!=0 && fec2.length!=0){
                        if(aaData!=""){
                            $('#myTable').DataTable().clear().destroy();
                            seleccionar(sele1,sele,aaData);     
                        }
                    }                   
                }

            }else if(sele1 == 'Docentes'){
                if(radiio == "rfc"){
                    if(rfc.length==0){
                        alert("Falta Filiación");
                        $("#BuscarRFC").focus();
                        $('#select1').val("value");
                        $('#select').val("value0");                                             
                    }
                    if(rfc.length!=0){
                        if(aaData!=""){
                            $('#myTable').DataTable().clear().destroy();
                            seleccionar(sele1,sele,aaData);     
                        }
                    }
                }                
                if(radiio == "quincenas"){
                    if(quin.length==0){
                        alert("Falta Quincena");
                        $("#BuscarQuincena").focus();
                        $('#select1').val("value");
                        $('#select').val("value0");                                             
                    }
                    if(quin.length!=0){
                        if(aaData!=""){
                            $('#myTable').DataTable().clear().destroy();
                            seleccionar(sele1,sele,aaData);     
                        }
                    }
                }
                if(radiio == "fechas"){
                    if(fec1.length==0){
                        alert("Falta Fecha Inicio");
                        $("#dia1").focus();         
                        $('#select1').val("value");
                        $('#select').val("value0");                                 
                    }else if(fec2.length==0){
                        alert("Falta Fecha Fin");
                        $("#dia2").focus();
                        $('#select1').val("value");
                        $('#select').val("value0");                         
                    }
                    if(fec1.length!=0 && fec2.length!=0){
                        if(aaData!=""){
                            $('#myTable').DataTable().clear().destroy();
                            seleccionar(sele1,sele,aaData);     
                        }
                    }                   
                }
            }
        }); 
    });             
</script>
<style type="text/css">
    #letra{
        color: black;
    }               
    #pdf_qna {
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
    th{
        /*border: 1px solid blue;*/
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
        top: -35px;
        left: 650px;
        height: 37px;
    }       
    #select{
        width: 12%;
        position: absolute;
        top: -35px;
        left: 800px;
        height: 37px;
    }
    #pendientes{
        width: 50%;
        position: absolute;
        top: 0px;
        left: 10px;
        color: black;   
        font-size: 20px;        
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
    #textaviso,#textValidarAviso{
        color: black;
    }                       
    #divatabla{
        position: absolute;
        top: 50px;
        left: 0px;
        width: auto;
    }  
    #fech{
        position:absolute; top: -25px; left:25px;
        color: black;
    }
    #quinc{
        position:absolute; top:-25px; left:100px;
        color: black;
    }
    #rf_c{
        position:absolute; top:-25px; left:200px;
        color: black;
    }    
    #fechas{
        position:absolute; top:-20px; left:10px; 

    }
    #quincenas{
        position:absolute; top:-20px; left:80px; 
    } 
    #rfc_{
        position:absolute; top:-20px; left:180px; 
    }       
    #dia1{
        position:absolute; top: -35px; left:330px; 
        width: 150px;       
        border-width: 2px;
        border-style: dotted;
        border-color: #E0A800;
    }     
    #dia2{
        position:absolute; top: -35px; left:480px; 
        width: 150px;       
        border-width: 2px;
        border-style: dotted;
        border-color: #258125;
    }   
    #BuscarQuincena{
        position: absolute;
        top: -35px;
        left: 250px;
        width: 18%;     
    }
    #BuscarRFC{
        position: absolute;
        top: -35px;
        left: 250px;
        width: 18%;     
    }    
    #reset{
        width: 12%;
        position: absolute;
        top: -35px;
        left: 950px;
        height: 37px;       
    }
</style>        
</head>
<body>
    <label id="pendientes">Reporte Autorizados</label>

    <!--div id="divatabla"-->
    <form id="divatabla" name="divatabla" action="Reporte_Autorizados.php">
    <div style="text-align:center;">
    <select class="form-control" name="select0" id="select0" onchange="mostrar('select0');" style="display: none;">
        <option value="value" >Seleccionar...</option>
        <option id="rfc" name="rfc" value="rfc">FILIACION</option>
        <!--option id="num_docto" name="num_docto" value="num_docto">NUMERO DE DOCUMENTO</option-->
    </select>
    </div>         
    <div style="text-align:center;">
    <select class="form-control" name="select1" id="select1" onchange="mostrar('select1');" style="display: none;">
        <option value="value" >Seleccionar...</option>
        <option value="Todos">Todos</option>
        <option value="Docentes">Docentes</option>
        <option value="Administrativos">Administrativos</option>
    </select>
    </div>  
    <div style="text-align:center;">
    <select class="form-control" name="select" id="select" style="display: none;">
            <option value="value0">Seleccionar...</option>
            <option value="Ordenamiento">Ordenamiento</option>
            <option value="NO_Ordenamiento">NO Ordenamiento</option>
            <option value="Bajas">Bajas</option>
            <option value="Licencias">Licencias</option>
            <option value="Guiones">Guiones - Perc/Deduc</option>
    </select>
    </div>
    <br>        
<table id="myTable" cellspacing="0">
    <thead>
        <tr>
           <th><strong><label>Captura Nivel</label></strong></th>
           <th><strong><label>Recibe CGRH</label></strong></th>
           <th><strong><label>Folio</label></strong></th>
           <th><strong><label>RFC</label></strong></th>
           <th><strong><label>Plaza</label></strong></th>
           <th><strong><label>CT</label></strong></th>
           <th><strong><label>Dir. CT</label></strong></th>                    
           <th><strong><label>Qna Ini</label></strong></th>
           <th><strong><label>Qna Fin</label></strong></th>
           <th><strong><label>Mot.</label></strong></th>
           <th><strong><label>Admin/Doc</label></strong></th>
           <th><strong><label>Aut.CGRH</label></strong></th>
           <th><strong><label>Qna Afectada</label></strong></th>
           <!--th><strong><label>Envio FONE</label></strong></th-->
        </tr>
    </thead>
    <tfoot>
        <tr>
           <th><strong><label>Captura Nivel</label></strong></th>
           <th><strong><label>Recibe CGRH</label></strong></th>
           <th><strong><label>Folio</label></strong></th>
           <th><strong><label>RFC</label></strong></th>
           <th><strong><label>Plaza</label></strong></th>
           <th><strong><label>CT</label></strong></th>
           <th><strong><label>Dir. CT</label></strong></th>                    
           <th><strong><label>Qna Ini</label></strong></th>
           <th><strong><label>Qna Fin</label></strong></th>
           <th><strong><label>Mot.</label></strong></th>
           <th><strong><label>Admin/Doc</label></strong></th>
           <th><strong><label>Aut.CGRH</label></strong></th>
           <th><strong><label>Qna Afectada</label></strong></th>
           <!--th><strong><label>Envio FONE</label></strong></th-->            
        </tr>
    </tfoot>
</table>
<input type="radio" name="selecheck" id="fechas" value="fechas"> <label id="fech">Fechas</label>
<input type="radio" name="selecheck" id="quincenas" value="quincenas"> <label id="quinc">Quincenas</label>
<input type="radio" name="selecheck" id="rfc_" value="rfc"> <label id="rf_c">RFC</label>

<input type="date" name="dia1" class = "form-control" placeholder = "DIA" id = "dia1"  maxlength="2" style="display: none;"/>
<input type="date" name="dia2" class = "form-control" placeholder = "DIA2" id = "dia2"  maxlength="2" style="display: none;"/>
<input type="text" class="form-control producto"  id="BuscarQuincena" autocomplete="off" placeholder="Buscar por Quincena" style="display: none;" maxlength="6">
<input type="text" class="form-control producto"  id="BuscarRFC" autocomplete="off" placeholder="Buscar por Filiación" style="display: none;" maxlength="13">
<button type="reset" class = "btn btn-danger" id = "reset">Borrar
</form>

<!--/div-->

</body>
</html>