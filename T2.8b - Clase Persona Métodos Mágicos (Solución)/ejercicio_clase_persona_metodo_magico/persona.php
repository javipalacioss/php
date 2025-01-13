<?php
class Persona {
    private $nombre;
    private $apellidos;
    private $edad;

    public function __construct($nombre = "", $apellidos = "", $edad = 18) 
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
    }

    public function __get($propiedad)
    {
        if(property_exists($this, $propiedad))
        {
            return $this->$propiedad;
        }
    }

    public function getNombre()
    {
        return $this->nombre;
    }


    public function __set($propiedad, $valor)
    {
        if(property_exists($this, $propiedad))
        {
            return $this->$propiedad = $valor;
        }
    }

    public function setNombre($valor)
    {
        $this->nombre = $valor;
    }

    public function mayorEdad()
    {
        return $this->edad >= 18;
    }

    public function nombreCompleto()
    {
        return $this->nombre . " " . $this->apellidos; 
    }
}

?>