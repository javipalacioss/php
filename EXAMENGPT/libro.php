<?php
// Clase libro que hereda de papel e implementa la interfaz iembalaje
class Libro extends Papel implements iEmbalaje {
    // Variable accesible por todo el programa
    public $titulo;

    // Variables no accesibles
    private $paginas;
    private $ancho;

    // Constructor que inicializa el libro
    public function __construct($titulo, $alto, $largo, $npaginas) {
        parent::__construct($alto, $largo, true);  // Doble cara por defecto
        $this->titulo = $titulo;
        $this->paginas = $npaginas;
        $this->ancho = $npaginas / 100;  // Ancho basado en el número de páginas

        // Incrementar páginas gastadas
        $this->paginasGastadas++;
    }

    // Método para embalar
    public function embalar($unidades) {
        // Cálculo del volumen de envoltorio
        $margen = 2; // Supongamos un margen de 2
        $largo = $this->largo + $margen * 2;
        $alto = $this->alto + $margen * 2;
        $ancho = ($this->ancho * $unidades) + $margen * 2;

        $volumenEnvoltorio = $largo * $alto * $ancho;
        return $volumenEnvoltorio;
    }

    // Función __toString() para mostrar el libro
    public function __toString() {
        return "Libro de {$this->paginas} páginas titulado {$this->titulo}.<br>";
    }
}
?>
