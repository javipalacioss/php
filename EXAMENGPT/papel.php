<?php
// Clase papel que guarda información sobre el papel
class Papel {
    // Variables para páginas gastadas y recicladas
    public $paginasGastadas = 0;
    public $paginasRecicladas = 0;

    // Variable privada para doble cara
    private $dobleCara;

    // Variables de tamaño (no públicas)
    private $alto;
    private $largo;

    // Constructor que inicializa el papel
    public function __construct($alto, $largo, $dobleCara = false) {
        $this->alto = $alto;
        $this->largo = $largo;
        $this->dobleCara = $dobleCara;
    }

    // Métodos getter para acceder a las propiedades privadas
    public function getAlto() {
        return $this->alto;
    }

    public function getLargo() {
        return $this->largo;
    }

    // Método para obtener el valor de dobleCara
    public function getDobleCara() {
        return $this->dobleCara;
    }

    // Método abstracto para calcular espacio, será implementado en subclases
    public function calcularEspacio() {
        // Este método será implementado por subclases
    }

    // Método mágico __toString() para representar el objeto
    public function __toString() {
        return "Se usa un papel de tamaño ({$this->alto} x {$this->largo}): {$this->alto} x {$this->largo}.<br>";
    }
}
?>
