<?php
// Importar ficheros
require_once("entregable.php");

// Declaración de clase
class serie implements iEntregable
{
    // Variable estática
    public static $cantidad;
    public static $max = null;

    // Declaración de variables
    private $titulo;
    private $ntemp;
    private $entregado;
    private $genero;

    // Constructor
    public function __construct($tit, $tem, $gen)
    {
        // Inicializar
        $this->titulo = $tit;
        $this->ntemp = $tem;
        $this->genero = $gen;
        $this->entregado = False;
        self::$cantidad = 0;

        // Calcular serie con más temporadas
        if(isset(self::$max) )
        {
            if($tem >= self::$max->getTemporadas())
            {
                self::$max = $this;
            }          
        }
        else
        {
            self::$max = $this;
        }
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

    public function getTemporadas()
    {
        return $this->ntemp;
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

    public function setTemporadas($temp)
    {
        $this->ntemp = $temp;
    }

    public function setGenero($gen)
    {
        $this->genero = $gen;
    }

    // Función toString
    public function toString()
    {
        // Datos serie
        $texto1 = "<p>Serie con título: " . $this->getTitulo() . ", con " . $this->ntemp . " temporadas, está ";
        if ($this->entregado) {
            $texto2 = "entregado.</p>";
        } else {
            $texto2 = "sin entregar.</p>";
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
