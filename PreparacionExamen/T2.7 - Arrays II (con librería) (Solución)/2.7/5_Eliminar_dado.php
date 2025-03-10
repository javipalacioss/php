<?php require_once("azar.php") ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>
    Array 5 - Eliminar dado
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Eliminar dado</h1>
  <p>Actualice la página para mostrar una nueva tirada.</p>
  <?php
  // Obtenemos un número aleatorio entre 1 y 10
  $veces = rand(1, 10);

  // Jugadores: Tirar dados.
  $jugadores["prueba"] = tiraDados($veces);

  // Mostramos las imágenes de los dados obtenidos
  echo "<p> Cantidad de tiradas: $veces:</p>";
  mostrar($jugadores, 'd');

  // Guardamos el valor del dado a descartar
  $descarta[] = rand(1, 6);
  $descarta[] = rand(1, 6);

  // Mostramos el dado a descartar
  echo "<h2>Dado a eliminar</h2>";
  echo "<p><img src=\"dados/$descarta[0].svg\" alt=\"$descarta[0]\" width=\"140\" height=\"140\"></p>";

  // Eliminamos el dado del array
  $jugadores["prueba"] = array_diff($jugadores["prueba"], $descarta);

  // Mostramos las imágenes de los dados restantes
  echo "<h2>Dados restantes</h2>";
  mostrar($jugadores, 'd');

  ?>

</body>
</html>