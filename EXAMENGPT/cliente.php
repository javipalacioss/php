<?php
// Clase cliente que tiene nombre, producto y apodo
class Cliente {
    // Variables accesibles desde cliente
    public $nombre;
    public $producto;
    
    // Variable accesible por todos
    public static $clientela = 0;  // Contador de clientes
    
    public $apodo;

    // Constructor para crear un cliente
    public function __construct($nombre, $apodo) {
        $this->nombre = $nombre;
        $this->producto = "";  // Producto por defecto es vacío
        $this->apodo = $apodo;

        // Incrementar la clientela
        self::$clientela++;

        // Mostrar mensaje de creación
        echo "{$this->nombre} creado.<br>";
    }

    // Función para comprar un producto
    public function comprar($prod) {
        $this->producto = $prod;
    }

    // Función para obtener el producto
    public function getProducto() {
        return $this->producto;
    }

    // Función para mostrar el cliente
    public function mostrar() {
        echo "{$this->nombre} es conocido como {$this->apodo}.<br>";
    }

    // Función para eliminar un cliente y decrementar la clientela
    public function __destruct() {
        self::$clientela--;
    }
}
?>
