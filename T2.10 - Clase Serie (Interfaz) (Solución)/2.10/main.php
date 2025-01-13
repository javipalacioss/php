<?php

// Importar ficheros
require_once("serie.php");
require_once("videojuego.php");

// Crear arrays
$series = array();
$videojuegos = array();

// Informamos con 5 series
for($i =1; $i<=5; $i++)
{
    $tit = "Título " . $i;
    $tem = rand(1,5);
    $gen = "Género " . $i;
    $series[] = new serie($tit, $tem, $gen);
}

// Informamos con 5 videojuegos
for($i =1; $i<=5; $i++)
{
    $tit = "Título " . $i;
    $tem = rand(10,50);
    $gen = "Género " . $i;
    $videojuegos[] = new videojuego($tit, $tem, $gen);
}

// Entregar
$series[2]->entregar();
$series[4]->entregar();
$videojuegos[1]->entregar();
$videojuegos[3]->entregar();

// Imprimir
echo "<p><b>Series</b></p>";
foreach ($series as $serie) {
    echo $serie->toString();
}

echo "<br>";
echo "La serie con más temporadas es: " . serie::$max->getTitulo();
echo "Tiene : " . serie::$max->getTemporadas();
echo "<br>";

echo "<p><b>Videojuegos</b></p>";
foreach ($videojuegos as $videojuego) {
    echo $videojuego->toString();
}


?>