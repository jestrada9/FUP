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
      		ordering: false,
      		ajax:{
      			url: "data_fups_autorizados.php"
      			//url: "id.txt",
      		},
			//"sAjaxSource": aaData,
			//"iDisplayLength": 4,
			"lengthChange": false,
			"bPaginate":false,
			"bAutoWidth": false,
			"info":     true,	
			'ordering': false,	
	        columnDefs: [
	        	/*
		        {
		        	'targets': 0,
			         'searchable': false,
			         'ordering': false,
			         'className': 'dt-body-center',
		        	'render': function (aaData, type, full, meta){
	             		return '<input type="checkbox" class=selecheck name="id[]" value="' + $('<div/>').text(aaData).html() + '">';
		        }
		    	},
		    	*/
	        	/*{
	                targets: 1,
	                data: null,
	                defaultContent: '<input type="checkbox" class="selecheck" id="id" name="id[]" value="">',
	            },*/
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
            	/*
	            {
	                targets: -2,
	                data: null,
	                defaultContent: '<button type="button" id="mostrar" class="btn btn-outline-dark btn-sm">Ver PDF</button>',
	            },
	            */
	            {
	                targets: -1,
	                data: null,
	                defaultContent: '<button type="button" id="imprimir" class="btn btn-outline-dark btn-sm">Imprimir</button>',
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
                        filename: 'Autorizar_'+fechaYHora,
                        text: '<button id="ExportCGRH" class="btn btn-primary">Exportar a Excel</button>',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4]
                        }
                    },
                ]
            },
            /*
			initComplete: function () {
		            this.api()
		                .columns()
		                .every(function () {
		                    var column = this;
		                    sis=sis+1;
		                   
		                    var select = $('<select id="sis'+sis+'"><option value=""></option></select>')
		                        .appendTo($(column.footer()).empty())
		                        .on('change', function () {
		                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
		                            column.search(val ? '^' + val + '$' : '', true, false).draw();
		                        });

						 		$("#sis1").hide();
						 		$("#sis2").hide();
						 		$("#sis3").hide();
						 		$("#sis5").hide();
								$("#sis6").hide();
								$("#sis7").hide();	
								$("#sis8").hide();	
		                    column
		                        .data()
		                        .unique()
		                        .sort()
		                        .each(function (d, j) {
		                        	if(d==1){
		                        		mots = "PROVISIONAL POR LEY GENERAL DEL SERVICIO PROFESIONAL DOCENTE";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}
		                        	if(d==2){
		                        		mots = "TIEMPO FIJO POR LEY GENERAL DEL SERVICIO PROFESIONAL DOCENTE";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}
		                        	if(d==3){
		                        		mots = "DEFINITIVA POR LEY GENERAL DEL SERVICIO PROFESIONAL DOCENTE";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}
		                        	if(d==8){
		                        		mots = "PRORROGA DE NOMBRAMIENTO POR ALTA INTERINA";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}                        	
		                        	if(d==9){
		                        		mots = "INICIAL";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==10){
		                        		mots = "DEFINITIVO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}
		                        	if(d==20){
		                        		mots = "INTERINA LIMITADA";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}                        	
		                        	if(d==22){
		                        		mots = "POR SUSTITUTO DE BECARIO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==24){
		                        		mots = "EN GRAVIDEZ";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==25){
		                        		mots = "EN PENSIÓN";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==31){
		                        		mots = "POR DEFUNCIÓN";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}  
		                        	if(d==32){
		                        		mots = "POR RENUNCIA";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==33){
		                        		mots = "POR JUBILACIÓN O PENSIÓN";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==34){
		                        		mots = "POR ABANDONO DE EMPLEO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==35){
		                        		mots = "POR TÉRMINO DE NOMBRAMIENTO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}  
		                        	if(d==36){
		                        		mots = "POR DICTÁMEN ESCALAFONARIO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==37){
		                        		mots = "POR PASAR A OTRO EMPLEO ";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==38){
		                        		mots = "POR INSUBSISTENCIA DE NOMBRAMIENTO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==39){
		                        		mots = "POR REGULARIZACION DE PLANTILLA";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}  
		                        	if(d==40){
		                        		mots = "LIC. POR CRIANZA DE HIJOS";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==41){
		                        		mots = "LIC. POR ASUNTOS PARTICULARES";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==42){
		                        		mots = "LIC. POR PASAR A OTRO EMPLEO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==43){
		                        		mots = "LIC. POR COMISIÓN SINDICAL O ELECCIÓN POPULAR";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}  
		                        	if(d==44){
		                        		mots = "LIC. POR GRAVIDEZ";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==45){
		                        		mots = "LIC. POR INCAPACIDAD MÉDICA CON MEDIO DE SUELDO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==46){
		                        		mots = "LIC. POR INCAPACIDAD MÉDICA SIN SUELDO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==47){
		                        		mots = "LIC. POR BECA PARA CURSAR EST. EN INST. NAC. O EL EXTRANJERO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}                          	                        	                        	                        	
		                        	if(d==48){
		                        		mots = "LIC. PREPENS.(JUB.,PENSIÓN,RET.POR EDAD AVANZADA,CESANTÍA)";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==50){
		                        		mots = "LIC. POR INCAPACIDAD MÉDICA CON GOCE DE SUELDO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==51){
		                        		mots = "PRÓRROGA DE LICENCIA POR ASUNTOS PARTICULARES";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==52){
		                        		mots = "PRÓRROGA DE LICENCIA POR PASAR A OTRO EMPLEO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==53){
		                        		mots = "PRÓRR. DE LICENCIA POR COMISIÓN SINDICAL O ELECCIÓN POPULAR";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==54){
		                        		mots = "PRORR. DE LIC. POR INCAPACIDAD MÉDICA CON GOCE DE SUELDO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==55){
		                        		mots = "PRÓRROGA DE LICENCIA POR INCAPACIDAD MÉDICA CON MEDIO SUELDO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==56){
		                        		mots = "PRÓRROGA DE LICENCIA POR INCAPACIDAD MÉDICA SIN SUELDO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==57){
		                        		mots = "PRÓRR.POR BECA P/CURSAR ESTUDIOS EN INST.NAC. O EL EXTRANJ.";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==60){
		                        		mots = "REANUD.AL TERM.LIC.P/CRIANZA HIJOS MN.DE 2 AÑOS";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==61){
		                        		mots = "REANUD. AL TERM.DE LIC.POR ASUNTOS PARTICULARES";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==62){
		                        		mots = "REANUD. AL TERM.DE LIC.POR PASAR A OTRO EMPLEO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==63){
		                        		mots = "REANUD. AL TERM.DE LIC.POR COM. SINDICAL O ELECCIÓN POPULAR";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==64){
		                        		mots = "REANUD. AL TERM.DE LIC.POR INCAPAC.MÉDICA CON GOCE DE SUELDO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==65){
		                        		mots = "REANUD. AL TERM.DE LIC.POR INCAPAC.MÉDICA CON MEDIO SUELDO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==66){
		                        		mots = "REANUD. AL TERM.DE LIC.POR INCAPACIDAD MÉDICA SIN SUELDO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==67){
		                        		mots = "REANUD.AL TERM.DE LIC.X BECA P/CURS.EST.EN INS.NAC.O EXTRNJ.";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==70){
		                        		mots = "TERM.DE SUSPENSIÓN TEMPORAL POR RESOLUCIÓN ADMINISTRATIVA";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==71){
		                        		mots = "RES. DEF.DEL TRIBUNAL FEDERAL DE CONCILIACIÓN Y ARBITRAJE";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==73){
		                        		mots = "POR SENTENCIA JUDICIAL";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==74){
		                        		mots = "POR RES. DEL TRIBUNAL FEDERAL DE CONCILIACIÓN Y ARBITRAJE ";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==75){
		                        		mots = "POR INCAPACIDAD";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==76){
		                        		mots = "POR TRANSFERENCIA";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==77){
		                        		mots = "ADMVA./SECR.FUNC.PÚB./ÓRGANO INT.DE CONTROL EN LA SEP";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==78){
		                        		mots = "DEL TRIBUNAL FEDERAL DE CONCILIACIÓN Y ARBITRAJE";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==79){
		                        		mots = "POR PÉRDIDA DE LA CONFIANZA ";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==80){
		                        		mots = "RES. DEF.DEL TRIBUNAL FEDERAL DE CONCILIACIÓN Y ARBITRAJE";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==83){
		                        		mots = "RES. DEF.DEL TRIBUNAL FEDERAL DE CONCILIACIÓN Y ARBITRAJE";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==84){
		                        		mots = "INTERINA LIMITADA EN VACANTE DEFINITIVA";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==86){
		                        		mots = "RES. DEF.DEL TRIBUNAL FEDERAL DE CONCILIACIÓN Y ARBITRAJE";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==87){
		                        		mots = "POR DESTIT. O INHAB. O RES. DE SFP U OIC EN LA SEP";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==95){
		                        		mots = "PROVISIONAL ";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==96){
		                        		mots = "EN CONFIANZA";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==97){
		                        		mots = "PRORROGA DE NOMBRAMIENTO";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==98){
		                        		mots = "RES. DEF.DEL TRIBUNAL FEDERAL DE CONCILIACIÓN Y ARBITRAJE ";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	} 
		                        	if(d==99){
		                        		mots = "PROVISIONAL EN PLAZA DEFINITIVA";
		                        		select.append('<option value="' + d + '">'+ d + "-" + mots + '</option>');
		                        	}                         	                        	                        	
		                        });
		                });

		        },
		        */
			});//myTable
			
			//$("#myTable_filter").remove();
			//$("input[type=search]").hide();
			table.on('click', '#mostrar', function (e) {//boton tabla
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
			                        $('#pdf_qna').attr('src', result+"#toolbar=1&navpanes=1&scrollbar=1&zoom=67");
			                        $("#dialog-confirmPDF").show();
			                        $("#dialog-confirmPDF" ).dialog({//dialog
			                          resizable: false,
			                              height: 590,
			                              width: 990,
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
			        },//funcion si
			        Cancelar: function() {
			          $( this ).dialog( "close" );
			        }
			      }//buttons
			    });//dialog
			});//boton tabla

			table.on('click', '#imprimir', function (e) {//boton tabla

				var data = table.row($(this).parents('tr')).data();
				var id = data[0];
				var area = data[3];
				var num_oficio = data[4];
				var usuario = "<?php echo $usuario ?>";

				$.ajax({
                  	url: 'update_autorizar_41.php',
                  	type: 'POST',
                  	data: {
                    	id: id,
                    	ara: area,
                    	no: num_oficio,
                    	us: usuario
                  	},
                  	success: function(result){//funcion
	                	if(result!=""){
        				    var iframe1 = document.createElement('iframe');  
					        // Hide the IFrame.  
					        iframe1.style.visibility = "hidden"; 
					        // Define the source.  
					        iframe1.src = result;        
					        // Add the IFrame to the web page.
					        document.body.appendChild(iframe1);  
					        iframe1.contentWindow.focus();
					        iframe1.contentWindow.print(); // Print.		
					        
	                        $('#pdf_frame').attr('src', result+"#toolbar=0&navpanes=0&scrollbar=0&zoom=67");
	                        $("#dialog-confirmPDF_imprimir").show();
	                        $("#dialog-confirmPDF_imprimir" ).dialog({//dialog
	                        	resizable: false,
                              	height: 710,
                              	width: 1050,
                              	modal: true,
                              	buttons: {
                        			Imprimir: function() {
			                	    	var frame1 = document.getElementById('pdf_frame');
		        						frame1.contentWindow.focus();
		        						frame1.contentWindow.print();                   	
                                  		$( this ).dialog( "close" );
                                	}
	                        	}
	                        });//dialog	    
	                	}
              	  	}//funcion
	            });//ajax				
			});

table.on('click', '#obsers', function () {//boton observacion

	        var data = table.row($(this).parents('tr')).data();
	        var obs = data[6];
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

 

});		
	</script>
	<style type="text/css">
		/*
	#progressBar1{
		background-color: white;	
	}
	*/
	#letra{
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
	#textaviso{
		color: black;
	}	
    #divatabla{
            position: absolute;
            top: 50px;
            left: 0px;
            width: 100%;
            height: 100%;

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
	<a href="#fin" id="link"><span></span></a>
	<br>
	<div id="divatabla">
	<form name="frm-example" id="frm-example">
   <table id="myTable">
        <thead>
            <tr>
               <!--th><input type="checkbox" name="select_all" value="1" id="example-select-all"><strong><label>Autorizar</label></strong></th-->
			   <th><strong><label>Num Docto</label></strong></th>
			   <th><strong><label>RFC</label></strong></th>
			   <th><strong><label>Mot Mov</label></strong></th>
			   <th><strong><label>Area</label></strong></th>
			   <th><strong><label>Num_Oficio</label></strong></th>			   
			   <!--th><strong><label>Mostrar</label></strong></th-->
			   <th><strong><label>Imprimir</label></strong></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
			   <!--th><strong><label>Autorizar</label></strong></th-->
			   <th><strong><label>Num Docto</label></strong></th>
			   <th><strong><label>RFC</label></strong></th>
			   <th><strong><label>Mot Mov</label></strong></th>
			   <th><strong><label>Area</label></strong></th>
			   <th><strong><label>Num_Oficio</label></strong></th>			   
			   <!--th><strong><label>Mostrar</label></strong></th-->
			   <th><strong><label>Imprimir</label></strong></th>
            </tr>
        </tfoot>
    </table>
    </form>
	</div>
    <button type = "submit" name="btnGetData" class = "btn btn-success" id = "btnGetData" >Autorizar Fups</button>
    
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
</body>
</html>
