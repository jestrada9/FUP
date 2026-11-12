<?php
/* ---------------------------------------------------------------------
   normaliza_xml.php

   CAUSA DEL ERROR:
     "strpos() expects parameter 1 to be string, array given" en fpdf.php:1212
     "Array to string conversion" en fpdf.php:634

   Al convertir el XML del web service con
        json_decode(json_encode(simplexml_load_string($xml)), true)
   los nodos VACÍOS (<emp_dom/> o <emp_dom></emp_dom>) NO se convierten en
   cadena vacía: se convierten en un ARRAY VACÍO array().

   Como isset(array()) es TRUE, validaciones tipo
        if(isset($valuestra["emp_dom"])) $CALLE = $valuestra['emp_dom'];
   asignan un array a $CALLE, y ese array termina en $pdf->Cell(...)
   -> FPDF hace strpos($array,'(') -> Warning.

   SOLUCIÓN: pasar el arreglo por fup_normaliza() justo después del
   json_decode. Convierte todo array vacío en "" de forma recursiva.
   --------------------------------------------------------------------- */

if (!function_exists('fup_normaliza')) {

    /**
     * Convierte recursivamente los arrays vacíos (nodos XML vacíos) en "".
     * @param  mixed $v
     * @return mixed
     */
    function fup_normaliza($v)
    {
        if (!is_array($v)) {
            return $v;
        }
        if (count($v) === 0) {
            return '';          // <nodo/>  ->  ""
        }
        $out = array();
        foreach ($v as $k => $item) {
            $out[$k] = fup_normaliza($item);
        }
        return $out;
    }

    /**
     * Red de seguridad para imprimir cualquier valor en el PDF.
     * Úsala si algún dato sigue llegando como array/objeto.
     * @param  mixed $v
     * @return string
     */
    function fup_txt($v)
    {
        if (is_array($v)) {
            return '';
        }
        if (is_object($v)) {
            return method_exists($v, '__toString') ? (string)$v : '';
        }
        if (is_null($v)) {
            return '';
        }
        return (string)$v;
    }
}
