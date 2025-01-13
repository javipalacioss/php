<?php

//clase que hereda de vehiculo y representa un coche
class Coche extends Vehiculo {
    private $matricula;   //matricula del coche
    private $kilometros;  //kilometros recorridos (inicialmente 0)

    //constructor que recibe los parametros para el coche
    public function __construct($marca = "", $color = "", $plazas = 0, $matricula = "", $kilometros = 0) {
        parent::__construct($marca, $color, $plazas);  //llamamos al constructor de la clase base
        $this->setMatricula($matricula);  //establecemos la matricula del coche
        $this->kilometros = $kilometros;  //establecemos los kilometros del coche
    }

    //metodo para validar la matricula (formato: 4 numeros, espacio, 3 letras sin ciertas vocales)
    public function setMatricula($matricula) {
        //validacion simple: 4 numeros, un espacio, y 3 letras
        if (preg_match("/^\d{4} [BCDFGHJKLMNPRSTVWXYZ]{3}$/", $matricula)) {
            $this->matricula = $matricula; //si es valida, la asignamos
        } else {
            $this->matricula = "";  //si no es valida, se deja vacia
        }
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getKilometros() {
        return $this->kilometros;
    }

    //metodo para saber si el coche puede circular (si tiene matricula valida)
    public function puedeCircular() {
        return strlen($this->matricula) > 0;  //si la matricula no esta vacia, puede circular
    }

    //metodo para simular un viaje, incrementando los kilometros si es posible
    public function viajar($km) {
        if ($this->puedeCircular() && !$this->isAparcado() && $km >= 0) {
            $this->kilometros += $km; //sumamos los kilometros si el coche puede circular y no esta aparcado
        }
    }

    //metodo para devolver toda la informacion del coche
    public function toString() {
        $base_info = parent::toString();  //usamos el metodo toString de la clase base
        return "{$base_info}, Matricula: {$this->matricula}, Kilometros: {$this->kilometros}";
    }
}

?>
