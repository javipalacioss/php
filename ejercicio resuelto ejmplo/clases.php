<?php

// Clase Producto
class Producto {
    private $codigo;
    private $nombre;
    private $precio;

    public function __construct($codigo, $nombre, $precio) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    // Métodos SET
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    // Métodos GET
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function __toString() {
        return "Producto: [Código: {$this->codigo}, Nombre: {$this->nombre}, Categoría: {$this->categoria}, Precio: {$this->precio}€]";
    }
}

// Clase Usuario
class Usuario {
    private $dni;
    private $nombre;
    private $clave;
    private $carrito = [];

    public function __construct($dni, $nombre, $clave) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->clave = $clave;
    }

    // Métodos SET
    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    // Métodos GET
    public function getDni() {
        return $this->dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getClave() {
        return $this->clave;
    }

    // Métodos del carrito
    public function agregarAlCarrito($producto) {
        $this->carrito[] = $producto;
    }

    public function eliminarDelCarrito($codigoProducto) {
        foreach ($this->carrito as $posicion => $producto) {
            if ($producto->getCodigo() == $codigoProducto) {
                unset($this->carrito[$posicion]);
                break;
            }
        }
    }

    public function getCarrito() {
        return $this->carrito;
    }

    public function __toString() {
        return "Usuario: [DNI: {$this->dni}, Nombre: {$this->nombre}]";
    }
}

?>
