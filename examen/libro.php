<?php

//clase Libro que hereda de Papel e implementa la interfaz iEmbalaje
class libro extends papel implements iEmbalaje {
    public $titulo;        //titulo del libro
    private $páginas;      //numero de páginas
    private $ancho;        //ancho calculado a partir del numero de paginas

    //constructor que inicializa el libro
    public function __construct($alto, $largo, $páginas) {
        parent::__construct($alto, $largo, true);  //el libro siempre es doble cara
        $this->páginas = $páginas;
        $this->titulo = "Libro de {$páginas} páginas";
        $this->ancho = $páginas / 100;  //el ancho se calcula a partir del número de paginas
        $this->páginasGastadas++;  //incrementa las páginas gastadas
    }

    //implementacion de calcularEspacio() que debe estar en todas las subclases de Papel
    public function calcularEspacio() {
        //el espacio es simplemente el área del libro (alto * largo)
        return $this->alto * $this->largo;
    }

    //metodo que implementa la interfaz iEmbalaje
    public function embalar($unidades) {
        $margen = 2;  // Margen fijo
        $largo = $this->largo + $margen * 2;
        $alto = $this->alto + $margen * 2;
        $ancho = ($this->ancho * $unidades) + $margen * 2;
        $volumenEnvoltorio = $largo * $alto * $ancho;  //volumen del envoltorio
        return $volumenEnvoltorio;
    }

    //metodo __toString para mostrar la informacion del libro
    public function __toString() {
        return "Libro de {$this->páginas} páginas titulado {$this->titulo}.";
    }

    //destructor para reciclar las paginas del libro
    public function __destruct() {
        $this->páginasRecicladas += $this->páginas;  //recicla todas las páginas
    }
}
?>
