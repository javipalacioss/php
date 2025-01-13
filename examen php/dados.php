<?php

class dados extends juegoAzar{
    
    //Atributos
    public const DADOS = [1,2,3,4,5,6];
    public const JUEGO = parent :: $nombreJuego;
    public $numRonda;


    //Metodos
    //Constructor 
    function __construct($numRonda)
    {
        // Inicialización
        $numRonda ->numeroRondas = $numRonda;    
        $nombreJuego = "";
        $numRonda = "";
    }

 }
 



?>