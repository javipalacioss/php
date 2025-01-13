<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $alumnosdelaclasedeprimero = [
        ['nombre' => 'Juan', 'edad' => 21],
        ['nombre' => 'Maria', 'edad' => 19],
        ['nombre' => 'Pedro', 'edad' => 24],
        ['nombre' => 'Antonio', 'edad' => 30],
        ['nombre' => 'Carmen', 'edad' => 24],
        ['nombre' => 'Carlos', 'edad' => 26],
        ['nombre' => 'Lucia', 'edad' => 22]
    ];
    $alumnosdelaclasedesegundo = [
        ['nombre' => 'Jaime', 'edad' => 27],
        ['nombre' => 'Luisa', 'edad' => 21],
        ['nombre' => 'Aitor', 'edad' => 33],
        ['nombre' => 'Macarena', 'edad' => 22],
        ['nombre' => 'Maria', 'edad' => 27],
        ['nombre' => 'Pedro', 'edad' => 28],
        ['nombre' => 'Juan', 'edad' => 24]
    ];
    // Unir los arrays
    $alumnos = array_merge($alumnosdelaclasedeprimero, $alumnosdelaclasedesegundo);

    // Mostrar los alumnos
    echo "<h2>Lista de Alumnos</h2>";
    echo "<ul>";
    foreach ($alumnos as $alumno) {
        echo "<li>Nombre: {$alumno['nombre']}, Edad: {$alumno['edad']}</li>";
    }
    echo "</ul>";
    ?>
</body>
</html>