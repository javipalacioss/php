<?php
require_once 'clases.php';

// Función para generar el nombre de archivo específico para el usuario
function obtenerArchivoUsuario($dni) {
    return $dni . ".dat";
}

// Función para leer movimientos de un usuario específico
function leerMovimientos($dni) {
    $archivo = obtenerArchivoUsuario($dni);
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        if (!empty($contenido)) {
            return unserialize($contenido);
        }
    }
    return [];
}

// Función para guardar todos los movimientos de un usuario
function guardarMovimientos($dni, $movimientos) {
    $archivo = obtenerArchivoUsuario($dni);
    file_put_contents($archivo, serialize($movimientos));
}

// Función para añadir un nuevo movimiento
function anadirMovimiento($dni, $movimiento) {
    $movimientos = leerMovimientos($dni);
    $movimientos[] = $movimiento;
    guardarMovimientos($dni, $movimientos);
}

// Función para eliminar un movimiento
function eliminarMovimiento($dni, $id) {
    $movimientos = leerMovimientos($dni);
    $nuevosMovimientos = [];
    
    foreach ($movimientos as $movimiento) {
        if ($movimiento->id != $id) {
            $nuevosMovimientos[] = $movimiento;
        }
    }
    
    guardarMovimientos($dni, $nuevosMovimientos);
}

// Función para modificar un movimiento
function modificarMovimiento($dni, $id, $nuevoMovimiento) {
    $movimientos = leerMovimientos($dni);
    
    foreach ($movimientos as $key => $movimiento) {
        if ($movimiento->id == $id) {
            $movimientos[$key] = $nuevoMovimiento;
            break;
        }
    }
    
    guardarMovimientos($dni, $movimientos);
}

?>