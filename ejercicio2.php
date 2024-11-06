<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>
    <?php
    // Arrays de alumnos
    $clase1 = [
        "Juan" => 21,
        "Maria" => 19,
        "Pedro" => 24,
        "Antonio" => 30,
        "Carmen" => 24,
        "Carlos" => 26,
        "Lucia" => 22
    ];

    $clase2 = [
        "Jaime" => 27,
        "Luisa" => 21,
        "Aitor" => 33,
        "Macarena" => 22,
        "Maria" => 27,
        "Pedro" => 28,
        "Juan" => 24
    ];

    // Mostrar datos de ambas clases
    echo "<h3>Alumnos Clase 1:</h3>";
    foreach ($clase1 as $nombre => $edad) {
        echo "$nombre: $edad años<br>";
    }

    echo "<h3>Alumnos Clase 2:</h3>";
    foreach ($clase2 as $nombre => $edad) {
        echo "$nombre: $edad años<br>";
    }

    // Unir ambas tablas
    $todosLosAlumnos = array_merge($clase1, $clase2);
    
    echo "<h3>Todas las Clases:</h3>";
    foreach ($todosLosAlumnos as $nombre => $edad) {
        echo "$nombre: $edad años<br>";
    }
    ?>
</body>

</html>
