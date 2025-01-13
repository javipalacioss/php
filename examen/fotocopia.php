<?php

//clase Fotocopia que hereda de Papel
class fotocopia extends papel {
    private $color;  //color de la fotocopia

    //constructor que inicializa el tamaño, si es doble cara, y el color
    public function __construct($alto, $largo, $color, $dobleCara = false) {
        parent::__construct($alto, $largo, $dobleCara);  //llama al constructor de Papel
        $this->color = $color;
        $this->páginasGastadas++;  //se incrementa el contador de paginas gastadas
    }

    //metodo para calcular el espacio de la fotocopia
    public function calcularEspacio() {
        return $this->alto * $this->largo;  //el espacio es simplemente el área
    }

    //metodo __toString para mostrar informacion de la fotocopia
    public function __toString() {
        return parent::__toString() . " Es a doble cara: " . ($this->getDobleCara() ? "Sí" : "No");
    }

    //destructor que incrementa las paginas recicladas
    public function __destruct() {
        $this->páginasRecicladas++;  //incrementa las páginas recicladas
    }
}
?>
