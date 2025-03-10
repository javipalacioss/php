<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Array 6 - Contar cartas repetidos
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Contar cartas repetidos</h1>

  <p>Actualice la página para mostrar un nuevo grupo de valores de cartas de corazones.</p>

<?php
    // Obtenemos un número aleatorio entre 10 y 20
    $numero = rand(10, 20);

    // Guardamos los valores de las cartas en el array $corazones
    $corazones = [];
    for ($i = 0; $i < $numero; $i++) 
    {
        $corazones[$i] = rand(1, 10);
    }

    // Mostramos las imágenes de las cartas obtenidas
    echo "<h2>$numero cartas de corazones</h2>";

    echo "<p>";
    foreach ($corazones as $carta) 
    {
      echo "<img src=\"cartas/c$carta.svg\" alt=\"$carta de corazones\" width=\"100\">";
    }
    print "</p>";

    // Contamos las cartas
    $cuenta = array_count_values($corazones);

    // Mostramos el resultado de contar las cartas
    echo "<h2>Conteo</h2>";
    echo "<p>";
    foreach ($cuenta as $carta => $numero) 
    {
      echo "<span style=\"font-size: 5em; margin: 0;\">$numero - </span><img src=\"cartas/c$carta.svg\" width=\"70\"><br>";
    //  echo '<span style="font-size: 5em; margin: 0;">' . $numero . '- </span><img src="cartas/c' . $carta . '.svg" width="70"><br>';
    }
    echo "</p>";

?>

</body>
</html>
