<?php

class Usuario {
    //Atributos
    private $correo;
    private $nombre;
    private $clave;

    //constructor
    public function __construct($correo, $nombre, $clave) {
        $this->correo = $correo;
        $this->nombre = $nombre;
        $this->clave = $clave;
    }

    //metodos SET
    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    //metodos GET
    public function getNombre() {
        return $this->nombre;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getCorreo() {
        return $this->correo;
    }
}

class Mensaje {
    //Atributos
    private $autor;
    private $mensaje;

    //constructor
    public function __construct($autor, $mensaje) {
        $this->autor = $autor;
        $this->mensaje = $mensaje;
    }

     //metodos SET
     public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getMensaje() {
        return $this->mensaje;
    }

}


?>