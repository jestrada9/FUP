<script>
    $(document).ready(function () {
        $('#num_oficioR').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/NUM_OFICIO.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>


<!--script>
    $(document).ready(function () {
        $('#num_doctoR').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/NUM_DOCTO.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script-->

<!--script>
    $(document).ready(function () {
        $('#re-num_docto').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/NUM_DOCTO.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script-->


<script>
    $(document).ready(function () {
        $('#rfcR').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/RFC.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#estatusR').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/ESTATUS2.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#relacionR').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/RELACIONES.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>
<!------------------------------------------------------------------- PLAZA ------------------------------------------------->
<script>
    $(document).ready(function () {
        $('#plazaR').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/COD_PAGO.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#plaza2R').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/UNIDAD.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#plaza3R').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/SUBUNIDAD.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#plaza4R').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/CAT_PUESTO.php",
          data: 'query=' + query,     //"  "+
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#plaza5R').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/HORAS.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#plaza6R').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/CONS_PLAZA.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#curpR').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "../Conexion/DatosR/CURP.php",
          data: 'query=' + query,     
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>

<!-------------------------------------------------------------------------- FIN DE PLAZA -------------------------------------------------------------->
 <!--script>
             $(document).ready(function () {
            $("#descripcionR").change(function () {
              $("#descripcionR option:selected").each(function () {
                  descripcion = $(this).val();
                $.post("Pdf/mostrar.php", {descripcion: descripcion })
                });
                 });
               });
          </script-->

