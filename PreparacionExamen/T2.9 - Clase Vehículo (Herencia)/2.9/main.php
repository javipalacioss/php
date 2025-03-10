<?php
require_once("vehiculo.php");
require_once("coche.php");

    /*
    *   Se crean varios vehículos   
    */

    // Bicicleta
    $bicicleta  = new vehiculo();
    $bicicleta->setMarca("BH");
    $bicicleta->setColor("Amarillo");
    $bicicleta->setPlazas(1);
    $bicicleta->arrancar();
    echo $bicicleta->__toString();

    // Moto
    $moto = new vehiculo();
    $moto ->setMarca("Kawasaki");
    $moto ->setColor("Negro");
    $moto ->setPlazas(2);
    echo $moto ->__toString();

    // Camión
    $camion     = new vehiculo();
    $camion ->setMarca("Man");
    $camion ->setColor("Blanco");
    $camion ->setPlazas(3);
    echo $camion -> __toString();

    // Coche
    $c1 = new coche("1234 BBB",1000);
    $c1 ->setMarca("Audi");
    $c1 ->setColor("Azul");
    $c1 ->setPlazas(5);
    echo $c1 ->__toString();

    $c2 = new coche("4321 AAA");
    $c2 ->setMarca("Ford");
    $c2 ->setColor("Rojo");
    $c2 ->setPlazas(5);
    echo $c2 ->__toString();

?>