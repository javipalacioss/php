<?php

//mostrar clientes
jugador :: listarClientes();

//crear jugador sin edad
$jugador1 = new jugador('12345678A', 'Juanito');

//crear jugador mayor edad
$jugador2 = new jugador('12345678B', 'Pepito', '19');

//crear jugador menor edad
$jugador3 = new jugador('12345678C', 'Antoñito' , '1');

//crear 2 jugadores mayores edad
$jugador4 = new jugador('12345678D', 'Miguelito' , '21');
$jugador5 = new jugador('12345678E', 'Manuelito' , '22');

//ordenar por dni
jugador :: ordenarDNI();

//mostrar clientes
jugador :: listarClientes();

//mostrar aforo 
jugador :: aforo();

//Crear partida dados(con 3 num de ronda por ejemplo)
$partida = new dados(3);

//tirar dados
juegoAzar :: tirar($jugadores);
//
?>