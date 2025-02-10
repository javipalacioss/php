<?php
class Usuario {
    //Atributos
    private $nombre;
    private $clave;
    private $color;

    //constructor
    public function __construct($nombre, $clave, $color) {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->color = $color;
    }

    //metodos SET
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    //metodos GET
    public function getNombre() {
        return $this->nombre;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getColor() {
        return $this->color;
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

  //metodos GET
  public function getAutor() {
    return $this->autor;
}

public function getMensaje() {
    return $this->mensaje;
}

}
?>