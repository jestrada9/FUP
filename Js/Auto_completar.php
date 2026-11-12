<script src="Js/typeahead.js"></script>
<script>
    $(document).ready(function () {
        $('#num_oficio1').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/NUM_OFICIO.php",
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
        $('#num_docto1').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/NUM_DOCTO.php",
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
        $('#re-num_docto').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/NUM_DOCTO.php",
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
        $('#rfc1').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/RFC.php",
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
        $('#estatus1').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/ESTATUS2.php",
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
        $('#relacion2').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/RELACIONES.php",
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
        $('#plaza1').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/COD_PAGO.php",
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
        $('#plaza2').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/UNIDAD.php",
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
        $('#plaza3').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/SUBUNIDAD.php",
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
        $('#plaza4').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/CAT_PUESTO.php",
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
        $('#plaza5').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/HORAS.php",
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
        $('#plaza6').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/CONS_PLAZA.php",
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
        $('#curp1').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "Conexion/Datos/CURP.php",
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


