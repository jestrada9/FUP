<?php
// Especifica la ruta del archivo que deseas eliminar
$archivo = '../Fups/Masivo_Original/'.$_GET["doc"].'';

// Verifica si el archivo existe antes de intentar eliminarlo
if (file_exists($archivo)) {
    // Usa unlink() para eliminar el archivo
    if (unlink($archivo)) {
        echo "El archivo ha sido eliminado correctamente.";
    } else {
        echo "Hubo un error al intentar eliminar el archivo.";
    }
} else {
    echo "El archivo no existe.";
}
?>