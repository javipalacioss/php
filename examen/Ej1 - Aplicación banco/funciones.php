<?php
require_once 'clases.php';

// Comprobamos si existe el archivo de datos, si no, lo creamos
define("DNI", "DNI.dat");
if (!file_exists(DNI)) {
    file_put_contents(DNI, serialize([]));
}

// Función para leer movimientos de un usuario específico
function leerMovimientos($dni) {
    return unserialize(file_get_contents(DNI));
}

// Función para guardar todos los movimientos de un usuario
function guardarMovimientos($dni, $movimientos) {
    file_put_contents(DNI, serialize($dni, $movimientos));
}

// Función para añadir un nuevo movimiento
function anadirMovimiento($dni, $movimiento) {
    $movimientos = leerMovimientos($dni);
    $movimientos[] = $movimiento;
    guardarMovimientos($dni, $movimientos);
}

?>