<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicios</title>
</head>

<body>

    <!-- EJERCICIO 1 -->
    <h1>Ejercicio 1</h1>
    <p>Define dos constantes, una numérica y otra de cadena y mediante una de las opciones, print y echo,
        aparezca en la página web resultante un texto sobre el tipo de cada una de ellas seguido de su valor.
    </p>
    <h3>Solución:</h3>

    <?php
    // Definición de constante numérica
    define('cNum', '2000');

    // Impresión por pantalla con PRINT
    print "La constante cNUM es de tipo '" . gettype(cNum) . "' y tiene valor '" . cNum . "'." . PHP_EOL;

    // Definición de constante cadena
    define('cStr', "Dos mil");

    // Impresión por pantalla con ECHO
    echo "La constante cStr es de tipo '" . gettype(cStr) . "' y tiene valor '" . cStr . "'.";
    ?>
</body>

</html>