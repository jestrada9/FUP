<?php
	$usuario = $_GET['usuario'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fups Autorizados Paty</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="
    sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  
  
	<script>
 	class constructors{ //class constructor Plazas Selecionadas
      get total(){return this._total;}
      set total(total){this._total = total;}
      get nd(){return this.num_docto;}
      set nd(nd){this.num_docto = nd;}
    }		
	$(document).ready( function () {
		idv = 0;
	var sis = 0;
	var mots = "";
	var aaData = "";
  
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
			
			var table = $('#myTable').DataTable({//myTable
		    searching: true,
      		ordering: false,
      		ajax:{
      			url: "data_fups_autorizados4_Paty.php"
      			//url: "id.txt",
      		},
			//"sAjaxSource": aaData,
			//"iDisplayLength": 4,
			"lengthChange": false,
			"bPaginate":false,
			"bAutoWidth": false,
			"info":     false,	
			'ordering': false,	
	        columnDefs: [
	        	{
	                targets: 0,
	                data: null,
	                className: "hide_me",
	            },
	            {
                	targets: 4,
                	visible: true,
                	searchable: true
            	},
            	{
                	targets: 5,
                	visible: true,
                	searchable: true
            	},
	            {
	                targets: -1,
	                data: null,
	                defaultContent: '<button type="button" id="mostrar" class="btn btn-outline-dark btn-sm">Ver PDF</button>',
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

                buttons: [
                    {
                        extend: 'excelHtml5',
                        filename: 'Autorizar Original_'+fechaYHora,
                        text: '<button id="ExportAdmin" class="btn btn-primary">Exportar a Excel</button>',
                        exportOptions: {
                            columns: [ 1, 2, 4, 5, 6, 8, 9, 10]
                        }
                    },
                ]
            }
			});//myTable
			
			//$("#myTable_filter").remove();
			//$("input[type=search]").hide();
			$('#myTable tbody').on('click', '#mostrar', function () {//boton tabla
			//$('#pdf_qna').clear();
			var frame = document.getElementById("pdf_qna");
			var html = "";
			frame.contentWindow.document.open();
			frame.contentWindow.document.write(html);
			frame.contentWindow.document.close();
	        var data = table.row($(this).parents('tr')).data();
		        $("#dialog-confirm").show();
			    $("#dialog-confirm" ).dialog({//dialog
			      resizable: false,
			      height: "auto",
			      width: 400,
			      modal: true,
			      buttons: {//buttons
			        "Si": function() {//funcion si
			          $( this ).dialog( "close" ); 
		          		var id = data[1];
						$.ajax({
		                  url: 'buscar_PDF_local.php',
		                  type: 'POST',
		                  data: {
		                    id: id
		                  },
		                  success: function(result){//funcion
		                  	if(result!=""){
		                    	$('#pdf_qna').attr('src', result+"#toolbar=1&navpanes=1&scrollbar=1&zoom=100");
		                    	$('#link').find('span').trigger('click'); // Works 								
		                    	//$('#pdf_qna').attr('src', result+"#toolbar=0&navpanes=0&scrollbar=1&zoom=60&view=Fit");
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
			        },//funcion si
			        Cancelar: function() {
			          $( this ).dialog( "close" );
			        }
			      }//buttons
			    });//dialog
			});//boton tabla


});		
	</script>
	<style type="text/css">
	thead th {
		position: sticky;
		z-index: 1;
		top: 0;
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

	label{
		color: #FFFFFF;
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
	#btnGetData{
		position: absolute;
	 	top: 6px;
	 	left: 400px;
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
	 	width: auto;
	}
	#pdf_4{
		position: absolute;
	 	left: 0px;		
	 	width: 100%;
	 	height: 100%;
	}	
	/*#pdf_5{
		position: absolute;
	 	right: 0px;	
	 	width: 50%;
	 	height: 100%;
	}*/		
	</style>	
</head>
<body>
	
	<label id="pendientes">Fup´s Autorizados Paty</label>
	<a href="#fin" id="link"><span></span></a>
	<br>
	<form name="frm-example" id="frm-example">
   <table id="myTable">
        <thead>
            <tr>
               <th class="hide_me"><strong><label>ID</label></strong></th>
			   <th><strong><label>Num Docto</label></strong></th>
			   <th><strong><label>RFC</label></strong></th>
			   <th><strong><label>Mot Mov</label></strong></th>
			   <th><strong><label>Area</label></strong></th>
			   <th><strong><label>Num_Oficio</label></strong></th>			   
			   <th><strong><label>Mostrar</label></strong></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
               <th class="hide_me"><strong><label>ID</label></strong></th>
			   <th><strong><label>Num Docto</label></strong></th>
			   <th><strong><label>RFC</label></strong></th>
			   <th><strong><label>Mot Mov</label></strong></th>
			   <th><strong><label>Area</label></strong></th>
			   <th><strong><label>Num_Oficio</label></strong></th>			   
			   <th><strong><label>Mostrar</label></strong></th>
            </tr>
        </tfoot>
    </table>
    </form>
    <iframe  name="pdf_qna" id="pdf_qna"></iframe>
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
    <div id="dialog-aviso" title="¡AVISO!"  style="display: none;">
    	<textarea id="nd_aut"></textarea>
     	<p>
     		<!--span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 40px 0;"></span-->Con fundamento en lo dispuesto en el Titulo Cuarto artículos 108, 109 fracción III de la Constitución Política de Los Estados Unidos Mexicanos, por los artículos 7, 8 fracciones I, IV, V de la Ley Federal de Responsabilidades Administrativas; artículos 7 fracciones III y VI, 16, 25 fracciones I, II, III, IV y V, 52, 56, 57, 62 y 63 de la Ley General de Responsabilidades Administrativas, y Ley Orgánica del Tribunal Federal de Justicia Administrativa, artículo 56 fracción I de la Ley de Responsabilidades de los Servidores Públicos del Estado y Municipios de San Luis Potosí, articulo 6 y 16 de la ley de responsabilidades administrativas del Estado.
     	</p>
    </div>
    <div id="dialog-a4" title="¡PDF CREADO!"  style="display: none;">
    	<iframe  name="pdf_4" id="pdf_4"></iframe>
    	<!--iframe  name="pdf_5" id="pdf_5"></iframe-->
    </div>
    <h2 id="fin"></h2>
</body>
</html>
