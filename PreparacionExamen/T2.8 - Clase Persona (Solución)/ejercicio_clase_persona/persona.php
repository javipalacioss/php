<?php
class Persona 
{
    private $nombre;
    private $apellidos;
    private $edad;

    public function __construct($nombre = "", $apellidos = "", $edad = 0) 
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function setEdad($edad)
    {
        $this->edad = $edad;
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