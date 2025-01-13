<?php

//incluimos las clases
include 'Vehiculo.php';
include 'Coche.php';

// creamos un vehiculo
$vehiculo1 = new Vehiculo("Toyota", "Rojo", 4);
$vehiculo2 = new Vehiculo("Honda", "Azul", 2);

//mostramos informacion del vehiculo
echo $vehiculo1->toString() . "\n";  //muestra la info del vehiculo
$vehiculo1->arrancar();  // arrancamos el vehiculo
echo "¿Esta aparcado? " . ($vehiculo1->isAparcado() ? "Si" : "No") . "\n";  //usamos el operador ternario para mostrar si esta aparcado o no

//creamos un coche con matricula valida
$coche1 = new Coche("Ford", "Negro", 5, "1234 ABC", 5000);
echo $coche1->toString() . "\n";  // informacion del coche

//el coche viaja 100 kilometros
$coche1->viajar(100);
echo "Kilometros despues de viajar: " . $coche1->getKilometros() . "\n";  //muestra los kilometros despues del viaje

//creamos un coche con matricula invalida
$coche2 = new Coche("BMW", "Blanco", 4, "ABCD 123", 2000);
echo $coche2->toString() . "\n";  //la matricula no es valida, debe estar vacia
echo "¿Puede circular? " . ($coche2->puedeCircular() ? "Si" : "No") . "\n";  //verificamos si puede circular usando el operador ternario

?>
