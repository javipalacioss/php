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
    $numero = rand(1, 10);

    // Guardamos los valores de los dados en el array $dados
    for ($i = 0; $i < $numero; $i++) 
    {
        $dados[] = rand(1, 6);
    }

    // Mostramos las imágenes de los dados obtenidos
    if ($numero == 1) 
    {
        echo "<h2>Tirada de $numero dado</h2>";
    } else {
        echo "<h2>Tirada de $numero dados</h2>";
    }

    echo "<p>";
    foreach ($dados as $dado) 
    {
        echo "<img src=\"dados/$dado.svg\" alt=\"$dado\" width=\"140\" height=\"140\">";
    }
    echo "</p>";


    // Guardamos el valor del dado a descartar
    $descarta = rand(1, 6);

    // Mostramos el dado a descartar
    echo "<h2>Dado a eliminar</h2>";
    echo "<p><img src=\"dados/$descarta.svg\" alt=\"$descarta\" width=\"140\" height=\"º40\"></p>";

    // Eliminamos el dado del array
    for ($i = 0; $i < $numero; $i++) 
    {
        if ($dados[$i] == $descarta) 
        {
            unset($dados[$i]);
        }
    }

    // Mostramos las imágenes de los dados restantes
    echo "<h2>Dados restantes</h2>";
    if (count($dados) == 0) 
    {
        echo "<p>No quedan dados.</p>\n";
    } else 
    {
        echo "<p>";
        foreach ($dados as $dado) 
        {
            echo "<img src=\"dados/$dado.svg\" alt=\"$dado\" width=\"140\" height=\"140\">";
        }
        echo "</p>";
    }

?>

</body>
</html>
