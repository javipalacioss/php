<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Array 7 - Repartir cartas
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Repartir cartas</h1>

  <p>Actualice la página para mostrar un nuevo reparto de cartas de corazones.</p>

<?php

  /* Guardamos los valores de las cartas en el array $cartas
    $n es el número de cartas que repartiremos a cada jugador,
    por lo que generamos 2 * $n cartas
  */
  $numCartas = rand(2, 5) * 2;
  $cartas = [];
  // Obtenemos tantas cartas como número aleatorio hayamos obtenido
  for ($i = 0; $i < $numCartas; $i++) 
  {
    do
    {
      $numero = rand(1, 10);
      // mientras la carta no esté en el array saco una
    }
    while (in_array($numero, $cartas));
    
    $cartas[] = $numero;
  }

  // Otra forma de obtener las cartas 
  // número de cartas disponibles
  /*$numCartasDisponible = range(1,10);
  for ($i = 0; $i < $numCartas; $i++) 
  {
    $numero = array_rand($numCartasDisponible);
    $carta = $numCartasDisponible[$numero];
    $cartas[] = $carta;

    unset($numCartasDisponible[$numero]);

  }*/

  // Mostramos las imágenes de las cartas obtenidas
  echo "<h2>Las $numCartas cartas a repartir</h2>";

  echo "<p>";
  foreach ($cartas as $carta) 
  {
      echo "<img src=\"cartas/c$carta.svg\" alt=\"$carta de corazones\" width=\"100\">\n";
  }
  echo "</p>";

  // Barajamos los valores de las cartas
  shuffle($cartas);

  // Creamos una matriz con las cartas pares y otras las impares
  $cartasA = [];
  $cartasB = [];
  for ($i = 0; $i < $numCartas/2; $i++) 
  {
    $cartasA[] = $cartas[$i*2];
    $cartasB[] = $cartas[$i*2+1];
  }


  // Mostramos las imágenes de las cartas del primer jugador
  echo "<h2>Las " .$numCartas/2 . " cartas del jugador 1</h2>";

  echo "<p>";
  foreach ($cartasA as $carta) 
  {
    echo "<img src=\"cartas/c$carta.svg\" alt=\"$carta de corazones\" width=\"100\">\n";
  }
  echo "</p>";

  // Mostramos las imágenes de las cartas del segundo jugador
  echo "<h2>Las " .$numCartas/2 . " cartas del jugador 2</h2>";

  // Mostramos las imágenes de las cartas del segundo jugador
  echo "<p>";
  foreach ($cartasB as $carta) 
  {
    echo "<img src=\"cartas/c$carta.svg\" alt=\"$carta de corazones\" width=\"100\">\n";
  }
  echo "</p>";

?>

</body>
</html>
