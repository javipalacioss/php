<?php
abstract class papel
{

    // Variables
    protected $largo;
    protected $alto;
    private $dobleCara;
    public static $paginasGastadas = 0;
    public static $paginasRecicladas= 0;

    // Constructor
    public function __construct($lar, $alt, $dob)
    {
        // Inicialización
        $this->largo = $lar;
        $this->alto = $alt;
        $this->dobleCara = $dob;
    }

    // Métodos abstractos
    abstract function calcularEspacio();

    // Métodos auxiliares
    protected function getDobleCara()
    {
        return $this->dobleCara;
    }
    // Método mostrar información
    public function __toString()
    {
        return "<p>Está impreso en un papel de tamaño (largo x ancho): $this->largo x $this->alto</p>";
    }
}
