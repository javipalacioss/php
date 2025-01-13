<?php
 class  juegoAzar {

    //Atributos
    protected $nombreJuego = "El Metodo Magico 3000";
    protected $tirada = [];

    //Metodos

      //Constructor 
      function __construct($nombre)
      {
          // Inicialización
          $nombre ->nombre = $nombre;     }


    // Método mostrar información
     public function __toString()
     {
        
             $mensaje = "<p>Nombre: " . $nombre ." </p>";
         
            
       
         return $mensaje;
     }
}
    //Metodos

    function tirar($jugadores){
        
    }


    function obtenerGanador(){
        
    }




?>