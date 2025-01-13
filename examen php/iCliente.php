<?php 

interface iCliente
{
    // Constantes
    public const LIMITE_EDAD = 18;

    
    // Funciones

    //funcion que muestra la lista de clientes (dni, nombre, edad)
    public function listarClientes();

    //funcion que muuestra por pantallala cantidad de jugadores creados
    public function aforo();

    //funcion que ordena el array jugadores de la clase jugador
    public function ordenarDNI();
}

?>