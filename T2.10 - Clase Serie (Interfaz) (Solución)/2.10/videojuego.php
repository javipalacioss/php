<?php

// Importar fichero
require_once("entregable.php");

// Declaración de clase
class videojuego implements iEntregable
{
    // Variable estática
    public static $cantidad;

    // Declaración de variables
    private $titulo;
    private $nhoras;
    private $entregado;
    private $genero;

    // Constructor
    public function __construct($tit, $tem, $gen)
    {
        // Inicializar
        $this->titulo = $tit;
        $this->nhoras = $tem;
        $this->genero = $gen;
        $this->entregado = "False";
        self::$cantidad = 0;

        // Incrementar estática
        self::$cantidad++;
    }

    // Método destruct
    public function __destruct()
    {
        // Decrementar variable estática
        self::$cantidad--;
    }

    // Getters
    public function contar()
    {
        // Return de la variable estática
        return self::$cantidad;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getHoras()
    {
        return $this->nhoras;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    // Setters
    public function setTitulo($tit)
    {
        $this->titulo = $tit;
    }

    public function setTemporadas($hor)
    {
        $this->nhoras = $hor;
    }

    public function setGenero($gen)
    {
        $this->genero = $gen;
    }

    // Función toString
    public function toString()
    {
        // Datos videojuego
        $texto1 = "<p>Videojuego con título: " . $this->getTitulo() .", con " . $this->nhoras . " horas, está ";

        if($this->entregado)
        {
            $texto2="entregado.</p>";
        }
        else{
            $texto2="sin entregar.</p>";
        }
 
        return $texto1 . $texto2;
    }

    // Función entregar
    public function entregar()
    {
        $this->entregado = true;
    }

    // Función devolver
    public function devolver()
    {
        $this->entregado = false;
    }

    // Función consulta
    public function isEntregado()
    {
        // Devuelve el valor
        return $this->entregado;
    }
}
