<?php

//clase que representa una persona
class Persona {
    private $nombre;    //nombre de la persona
    private $apellidos; //apellidos de la persona
    private $edad;      //edad de la persona

    //constructor con valores por defecto
    public function __construct($nombre = "", $apellidos = "", $edad = 18) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->edad = $edad;  //por defecto la edad es 18
    }

    //metodo para obtener el nombre
    public function getNombre() {
        return $this->nombre;
    }

    //metodo para establecer el nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    //metodo para obtener los apellidos
    public function getApellidos() {
        return $this->apellidos;
    }

    //metodo para establecer los apellidos
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    //metodo para obtener la edad
    public function getEdad() {
        return $this->edad;
    }

    //metodo para establecer la edad
    public function setEdad($edad) {
        $this->edad = $edad;
    }

    //metodo que devuelve true si la persona es mayor de edad (18 o mas años)
    public function mayorEdad() {
        return $this->edad >= 18;  //devuelve true si tiene 18 o mas años
    }

    //metodo que devuelve el nombre completo (nombre + apellidos)
    public function nombreCompleto() {
        return $this->nombre . " " . $this->apellidos;  //concatenamos nombre y apellidos
    }
}

?>
