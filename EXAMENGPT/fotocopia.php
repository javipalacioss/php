<?php
// Clase fotocopia que hereda de papel
class Fotocopia extends Papel {
    // Variable visible solo desde fotocopia
    public $color;

    // Constructor que inicializa largo, alto, y doble cara
    public function __construct($alto, $largo, $color, $dobleCara = false) {
        parent::__construct($alto, $largo, $dobleCara);
        $this->color = $color;

        // Incrementar páginas gastadas
        $this->paginasGastadas++;
    }

    // Método destructor que incrementa las páginas recicladas
    public function __destruct() {
        $this->paginasRecicladas++;
    }

    // Sobrescribir el __toString() para incluir información extra
    public function __toString() {
        $dobleCara = $this->getDobleCara() ? "a doble cara" : "a una cara";
        return parent::__toString() . "La fotocopia es de color {$this->color} y es {$dobleCara}.<br>";
    }
}
?>
