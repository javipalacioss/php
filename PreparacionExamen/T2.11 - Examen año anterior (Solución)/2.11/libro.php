<?php
require("i_embalar.php");

class libro extends papel implements iembalaje
{
    // Variables
    private const DOBLECARA = true;
    public $titulo;
    private $paginas;
    protected $alto;

    // Constructor
    public function __construct($lar, $anc, $pag)
    {
        parent::__construct($lar, $anc, self::DOBLECARA);
        $this->paginas = $pag;
        $this->alto = $pag / 100;
        papel::$paginasGastadas += $pag;
    }

    // Destructor
    public function __destruct()
    {
        papel::$paginasRecicladas +=$this->paginas;
    }

    // Método heredado
    public function calcularEspacio()
    {
        return "<p>La superficie es " . $this->lar * $this->anc . " centímetros cuadrados.</p>";
    }

    // toString
    public function __toString()
    {
        return "<p>Libro de $this->paginas titulado $this->titulo.</p>";
    }

    // Métodos mágicos
    public function __get($propiedad)
    {
        if (property_exists($this, $propiedad)) {
            return $this->$propiedad;
        }
    }

    public function __set($propiedad, $valor)
    {

        return $this->$propiedad = $valor;
    }

    // Implementación de embalar
    public function embalar($unid)
    {
        $largo = $this->largo + (iembalaje::margen * 2);
        $ancho = ($this->ancho * $unid) + (iembalaje::margen * 2);
        $alto  = $this->alto + (iembalaje::margen * 2);
        $this->volumenEnvoltorio = $largo * $ancho * $alto;
    }
}
