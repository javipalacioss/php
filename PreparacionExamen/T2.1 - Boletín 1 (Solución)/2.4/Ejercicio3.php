<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Operadores</title>
</head>

<body>

    <!-- EJERCICIO 3 -->
    <h1>Ejercicio 3</h1>
    <p> Escribe un ejercicio de nombre en el que se definan 2 variables, $a y $b. A esas variables habrá que darle
        valores numéricos. A continuación, para cada operador +,-,*,/ deberá mostrarte unos mensajes del siguiente tipo:
        Realizarlo con echo, print y printf.
    </p>
    <p>
        El resultado se sumar $a y $b es: xxx
        <br>El resultado se restar $a y $b es: xxx
        <br>El resultado se multiplicar $a y $b es: xxx
        <br>El resultado se dividir $a y $b es: xxx
        <br>El título de la página deberá ser Operadores.
    </p>
    <h3>Solución:</h3>
    <?php

    // Definición de variables y asignación de valor.
    $a = 30;
    $b = 15;
    $resultado;

    // Suma
    $resultado = $a + $b;
    echo "El resultado de sumar $a y $b es: $resultado";

    // Resta
    $resultado = $a - $b;
    print "<br>";
    print "El resultado de restar $a y $b es: $resultado";

    // Multiplicación
    $resultado = $a * $b;
    print "<br>";
    print "El resultado de multiplicar $a y $b es: $resultado";

    // División
    $resultado = $a / $b;
    printf ("<br>");
    printf ("El resultado de dividir %d y %d es: %d", $a, $b, $resultado);

    ?>

</body>

</html>