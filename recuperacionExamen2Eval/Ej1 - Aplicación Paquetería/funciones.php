<?php
require_once 'clases.php';

// Función para generar el nombre de archivo específico para el cliente
function obtenerArchivoCliente($id_cliente) {
    return $id_cliente . ".dat";
}

// Función para leer paquetes de un cliente específico
function leerPaquetes($id_cliente) {
    $archivo = obtenerArchivoCliente($id_cliente);
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        if (!empty($contenido)) {
            return unserialize($contenido);
        }
    }
    return [];
}

// Función para guardar todos los paquetes de un cliente
function guardarPaquetes($id_cliente, $paquetes) {
    $archivo = obtenerArchivoCliente($id_cliente);
    file_put_contents($archivo, serialize($paquetes));
}

// Función para añadir un nuevo paquete
function anadirPaquete($id_cliente, $paquete) {
    $paquetes = leerPaquetes($id_cliente);
    $paquetes[] = $paquete;
    guardarPaquetes($id_cliente, $paquete);
}

// Función para calcular el coste total de los paquetes de un cliente
// function calcularCosteTotal($paquetes) {
//     $coste_total = 0;
//     foreach ($paquetes as $paquete) {
//             $coste_total += $paquete->calcularCoste();
//     }
// }

// Función para generar un ID único para un nuevo paquete (NO TOCAR, LLAMARLA CUANDO PROCEDA)
function generarIdPaquete() {
    return uniqid('PKG_');
}

?>