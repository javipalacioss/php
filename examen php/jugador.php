<?php

class jugador implements iCliente{

    //Atributos

    //Privados
    public $jugadores = [];
    private $edad = 0;

    //Publicos
    public $dni;
    public $nombre;
    public $permitido;//Booleano

    //Metodos implementados

    //funcion que muestra la lista de clientes (dni, nombre, edad)
    public function listarClientes(){
        if ($permitido = true) {
            $mensaje = "<p>Nombre: $this->nombre , con dni $this->dni tiene permitido jugar $this->edad </p>";
        } else if ($permitido = false) {
            $mensaje = "<p>Nombre: $this->nombre , con dni $this->dni no tiene permitido jugar $this->edad </p>";
        }
        return $mensaje;
    }

    //funcion que muuestra por pantallala cantidad de jugadores creados
    public function aforo(){
        $cantidad = count($jugadores);
        return $cantidad;
    }

    //funcion que ordena el array jugadores de la clase jugador
    public function ordenarDNI(){
        sort($jugadores, $dni = SORT_REGULAR);
    }


    //Constructor 
    function __construct($dni, $nombre, $edad = 0)
    {
        // Inicialización
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->edad = $edad;//por defecto tiene que ser 0
        echo("Creado" . $nombre);
        
       
        array_fill('0', 1, $this -> jugadores);


             
}

/*function rellenarArray() {
    for ($i = 0; $i < 1; $i++) 
    {
        array_fill($i, $i, __construct());
    }
}
    */

    public function getNombre()
       {
       return $this->nombre;
       }

    //Metodo para eliminar jugador 
    public function __destruct()
    {
        for ($i=0; $i < 1; $i++) { 
   
            $jugadores[$i] = array_diff($this -> jugadores[$i], $i);
        }
        echo "el nombre del jugador eliminado es " . $this -> nombre;
    }

    //funcion para saber si es mayor de edad
    public function mayorEdad($edad)
    {
        if (($this->edad) >= 18) {
            //Si tiene mas de 18 si esta permitido
            $permitido = true;
        }
        //devolvemos boolean
        return $permitido;
       }
   
   
    //metodos getter y setter de edad
    public function getEdad()
    {
    return $this->edad;
    }

    public function setEdad($edad)
    {
        if (($this->edad) >= 18) {
            //Si tiene mas de 18 si esta permitido
            $permitido = true;
            
        } else {
            //si no tiene 18 o mas no esta permitido
            $permitido = false;
            
        }
        $this->edad = $edad;
    }

   
 

    
 
}


?>