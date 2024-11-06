<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>

<body>
    <?php
    // Generar 6 números aleatorios del 1 al 6
    $numerosAleatorios = [];
    for ($i = 0; $i < 6; $i++) {
        $numerosAleatorios[] = rand(1, 6);
    }

    // Mostrar el array generado
    echo "Array generado: " . implode(", ", $numerosAleatorios) . "<br>";

    // Contar ocurrencias
    $conteo = array_count_values($numerosAleatorios);
    echo "<h3>Conteo de ocurrencias:</h3>";
    for ($i = 1; $i <= 6; $i++) {
        echo "Número $i: " . ($conteo[$i] ?? 0) . " veces<br>";
    }

    // Número aleatorio adicional
    $numeroExtra = rand(1, 6);
    echo "<h3>Número aleatorio adicional: $numeroExtra</h3>";

    // Comprobar si está en el array
    if (in_array($numeroExtra, $numerosAleatorios)) {
        echo "El número $numeroExtra se encuentra en el array en los índices: ";
        foreach (array_keys($numerosAleatorios, $numeroExtra) as $indice) {
            echo "$indice ";
        }
        echo "<br>";
    } else {
        echo "El número $numeroExtra no se encuentra en el array.<br>";
    }

    // Mostrar array ordenado de mayor a menor
    rsort($numerosAleatorios);
    echo "Array ordenado de mayor a menor: " . implode(", ", $numerosAleatorios) . "<br>";

    // Array sin duplicados
    $numerosUnicos = array_unique($numerosAleatorios);
    echo "Array sin duplicados: " . implode(", ", $numerosUnicos) . "<br>";
    ?>
</body>

</html>
