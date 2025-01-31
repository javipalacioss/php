<?php

//Clase Alumno
class Alumno{
    //atributos
    private $nombre;
    private $tipo;
    private $notas = [];

    //constructor
    public function __construct($nombre, $tipo, $notas){
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->notas = $notas;
    }

    //metodos GET
    public function getNombre() {
        return $this->nombre;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getNotas() {
        return $this->notas;
    }

    public function __toString() {
        return "Alumno: [Nombre: {$this->nombre}, Tipo: {$this->tipo}, Notas: {$this->notas}]";
    }
    
}

class Profesor {
    //atributos
    private $nombre;
    private $tipo;

    //constructor
    public function __construct($nombre, $tipo){
        $this->nombre = $nombre;
        $this->tipo = $tipo;
    }

    //metodos GET
    public function getNombre() {
        return $this->nombre;
    }

    public function getTipo() {
        return $this->tipo;
    }

}