<?php
require("papel.php");

class fotocopia extends papel
{

    // Constructor
    public function __construct($lar, $alt, $dob)
    {
        parent::__construct($lar, $alt, $dob);
        papel::$paginasGastadas += 1;
    }

    // Destructor
    public function __destruct()
    {
        papel::$paginasRecicladas += 1;
    }

    // Método heredado
    public function calcularEspacio()
    {
        return "<p>La superficie es " . $this->largo * $this->alto . " centímetros cuadrados.</p>";
    }

    // ToString
    public function __toString()
    {
        $cadena = parent::__toString();

        if ($this->getDobleCara()) {
            $cadena = $cadena . "Fotocopia a doble cara. ";
        } else {
            $cadena = $cadena . "Fotocopia a una cara. ";
        }

        return $cadena;
    }
}
