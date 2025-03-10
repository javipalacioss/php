<?php include "azar.php" ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Array 4 - Eliminar valores repetidos
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Eliminar valores repetidos</h1>
  <p>Actualice la página para mostrar un nuevo grupo de valores de cartas de corazones.</p>

<?php
    // Obtenemos un número aleatorio entre 5 y 15
    $numero = rand(5, 15);

    // Guardamos los valores de las cartas en el array $corazones
    $corazones = [];
    for ($i = 0; $i < $numero; $i++) 
    {
        $corazones[$i] = rand(1, 10);
    }

    // Mostramos las imágenes de las cartas obtenidas
    echo "<h2>Entre estas $numero cartas corazones ...</h2>";

  mostrar($corazones, 'c');

    // Eliminamos las cartas duplicadas
    $resultado = array_unique($corazones);

    // Mostramos las imágenes de las cartas restantes
    echo "<h2>... hay " . count($resultado) . " cartas corazones distintas</h2>\n";
    echo "<p>";
    foreach ($resultado as $carta) 
    {
      echo " <img src=\"cartas/c$carta.svg\" alt=\"$carta de corazones\" width=\"100\">";
    }
    echo "</p>";

?>

</body>
</html>
