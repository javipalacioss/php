<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Ejercicio 2 - Negación de bits
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Negación de bits</h1>

  <p>Actualice la página para mostrar una secuencia aleatoria de bits y su complementaria.</p>

<?php
    // Definimos el número de bits a obtener
    define("numero", 10);

    // Creamos el array de bits aleatorios
    $inicial = [];
    for ($i = 0; $i < numero; $i++) 
    {
        $inicial[$i] = rand(0, 1);
    }

    // Mostramos los bits aleatorios
    echo  "A: ". implode(",", $inicial);
    // Creamos el array con los valores complementarios
    $resultado = [];
    for ($i = 0; $i < numero; $i++) 
    {
        $resultado[$i] = 1 - $inicial[$i];
    }

    /* Otra forma de calcular los valores complementarios
    // Creamos el array con los valores complementarios
    $resultado = [];
    for ($i = 0; $i < numero; $i++) 
    {
        if ($inicial[$i] == 1) 
        {
            $resultado[$i] = 0;
        } else 
        {
            $resultado[$i] = 1;
        }
    }
    */

    // Mostramos los valores complementarios
    echo "<br>";
    echo "<span style=\"text-decoration: underline\">A</span>: " . implode(",", $resultado);
?>
</body>
</html>
