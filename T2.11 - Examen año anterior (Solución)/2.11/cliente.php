<?php

class cliente
{
    // Variables
    private $nombre;
    private $producto;
    public $apodo;
    public static $clientela=0;

    // Constructor
    public function __construct($nom, $pro = "")
    {
        // Inicialización
        $this->nombre = $nom;
        $this->producto = $pro;

        // Aumenta la clientela
        //cliente::$clientela++;
        self::$clientela++;
        echo "<p>Creado $nom</p>";
    }

    // Destructor
    public function __destruct()
    {
        // Desciende la clientela
        cliente::$clientela--;
    }

    // Setter
    public function comprar($prod)
    {
        $this->producto = $prod;
    }

    // Getter
    public function getProducto()
    {
        // Devuelve el producto
        return $this->producto;
    }

    // Método mostrar información
    public function mostrar()
    {
        if (isset($this->cartera)) {
            return "<p>$this->nombre, conocido como $$this->apodo, tiene cuenta.</p>";
        } else {
            return "<p>$this->nombre, conocido como $$this->apodo, no tiene cuenta.</p>";
        }

        if (isset($this->producto))
            return "<p>El cliente ha comprado" . $this->producto . ".</p>";
    }
}
