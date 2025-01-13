<?php

//clase base para representar un vehiculo
class Vehiculo {
    private $marca;    //marca del vehiculo
    private $color;    //color del vehiculo
    private $plazas;   //numero de plazas (debe ser positivo)
    private $aparcado; //si esta aparcado (por defecto es true)

    //constructor con valores por defecto
    public function __construct($marca = "", $color = "", $plazas = 0) {
        $this->marca = $marca;
        $this->color = $color;
        $this->setPlazas($plazas);  //usamos el setter para validar las plazas
        $this->aparcado = true;     //el vehiculo esta aparcado por defecto
    }

    //metodos para obtener y modificar los atributos
    public function getMarca() {
        return $this->marca;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getPlazas() {
        return $this->plazas;
    }

    //validamos que las plazas sean un numero positivo
    public function setPlazas($plazas) {
        if ($plazas > 0) {
            $this->plazas = $plazas;
        } else {
            $this->plazas = 1; //si no es positivo, se pone el minimo de 1 plaza
        }
    }

    //metodos para aparcar y arrancar el vehiculo
    public function aparcar() {
        $this->aparcado = true; //establece que el vehiculo esta aparcado
    }

    public function arrancar() {
        $this->aparcado = false; //establece que el vehiculo esta arrancado
    }

    //metodo para comprobar si el vehiculo esta aparcado
    public function isAparcado() {
        return $this->aparcado; //devuelve true si esta aparcado, de lo contrario false
    }

    //devuelve la informacion del vehiculo en formato de texto
    public function toString() {
        //usamos el operador ternario para decidir si el vehiculo esta aparcado o no
        return "Marca: {$this->marca}, Color: {$this->color}, Plazas: {$this->plazas}, Aparcado: " . ($this->aparcado ? "Si" : "No");
    }
}

?>
