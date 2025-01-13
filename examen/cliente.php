<?php

//clase Cliente
class cliente {
    public $nombre;    //nombre del cliente
    public $producto;  //producto comprado por el cliente
    public static $clientela = 0;  //contador de clientes
    public $apodo;     //apodo del cliente

    //constructor que inicializa el nombre, el producto y apodo
    public function __construct($nombre, $producto = "") {
        $this->nombre = $nombre;
        $this->producto = $producto;
        self::$clientela++; //incrementa el contador de clientes
        echo $this->nombre . " creado.\n";  //muestra mensaje de creación
    }

    //metodo para eliminar un cliente
    public function eliminar() {
        self::$clientela--; //decrementa el contador de clientes
    }

    //funcion para comprar un producto
    public function comprar($prod) {
        $this->producto = $prod;
    }

    //retorna el producto del cliente
    public function getProducto() {
        return $this->producto;
    }

    //muestra el nombre y apodo del cliente
    public function mostrar() {
        echo $this->nombre . " es conocido como " . $this->apodo . ".\n";
    }
}
?>
