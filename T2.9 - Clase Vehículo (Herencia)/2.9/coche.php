<?php
require_once("vehiculo.php");

class coche extends vehiculo
{
    // Atributos
    private $matricula;
    private $kilometros;

    /**
     *  Crea un nuevo coche, con km a 0.
     */
    public function __construct(string $mat = "", int $km = 0)
    {
        parent::__construct();
        $this->matricula = $mat;
        $this->kilometros = $km;
    }

    // GETTERS y SETTERS
    public function getMatricula()
    {
        return $this->matricula;
    }

    public function setMatricula(string $mat)
    {
        $this->matricula = $mat;
    }

    // Métodos auxiliares

    /**
     *  Devuelve un booleano que indica si puede circular
     *  @return bool
     */
    public function puedeCircular()
    {
        // Definir la expresión regular
        $patron = '/^\d{4} [B-CDF-HJ-KLMPR-STVWXYZ]{3}$/';

        // Comprobar si la matrícula coincide con el patrón
        if (preg_match($patron, $this->matricula)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Devuelve string con información
     *  @return string
     */
    public function __toString(): string
    {

        $mensaje = parent::__toString();
        if ($this->puedeCircular()) {
            $mensaje = $mensaje . "Tiene $this->kilometros kilómetros y puede circular.";
        } else {
            $mensaje = $mensaje . "Tiene $this->kilometros kilómetros pero no puede circular.";
        }
        return $mensaje;
    }
}
