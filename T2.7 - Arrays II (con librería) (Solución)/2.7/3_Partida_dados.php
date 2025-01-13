<?php require_once("azar.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>
    Array 3 - Partida dados
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Partida dados</h1>
  <p>Actualice la página para mostrar una nueva partida de dados.</p>

  <?php
  // Definimos un número constante de tiradas() y jugadores (2).
  define("numero", 6);
  define("numJug", 2);

  // Jugadores: Tirar dados.

  $jugadores["Paco"] = tiraDados(numero);
  $jugadores["Lola"] = tiraDados(numero);

  // Mostrar dados
  mostrar($jugadores, 'd');

  // En los acumuladores $gana1 $gana2 y $empate contamos cuántas partidas ha ganado cada uno
  echo " <h2>Resultado:</h2>";

  // Array de resultados (posición 0 -> empates, posición 1 ->rondas ganadas por dados1...)
  $resultados = [0, 0, 0];
  partidaDados($jugadores, $resultados);

  // Mostrar rondas
  mostrarRondas($jugadores, $resultados);

  // Mostramos quién ha ganado la partida
  mostrarGanador($jugadores, $resultados);
  ?>
</body>

</html>