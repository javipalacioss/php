<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio 2</title>
</head>

<body>

    <!-- EJERCICIO 2 -->
    <h1>Ejercicio 2</h1>
    <p>Escribe un ejercicio en el que se definan 2 variables: $a y $b. A la variable a se le dará un valor numérico y la
        variable $b sea una referencia a la $a. Comprueba ambos valores, de forma que te muestre:
        La variable $a vale: 22
        La variable $b vale: 22
        Elimina a continuación la referencia y muestra de nuevo el valor de las 2 variables
    </p>
    <h3>Solución:</h3>
    <?php
    // Definición de variables
    $a;
    $b;

    // Asignación de valor
    $a = 22;

    // Asignación de referencia
    $b = &$a;

    // Comprobación de valores
    echo "La variable \$a vale $a.";
    echo "<br>";
    echo "La variable \$b vale $b.";
    echo "<br>";

    // Eliminamos la referencia
    echo "Eliminamos la referencia.";
    unset($b);

    // Comprobación de valores
    echo "La variable \$a vale $a.";
    echo "<br>";
    echo "La variable \$b vale $b.";
    ?>

</body>

</html>