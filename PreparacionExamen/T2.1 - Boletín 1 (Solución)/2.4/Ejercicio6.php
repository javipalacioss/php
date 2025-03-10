<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicios</title>
</head>

<body>

    <!-- EJERCICIO 6 -->
    <h1>Ejercicio 6</h1>
    <p> Realiza un ejercicio que asigne los siguientes valores a variables $a1 a $a10 y después te muestre la variable y el tipo, 
        usando gettype($var).
        <br>347
        <br>2147483647
        <br>-2147483647
        <br>23.7678
        <br>3.1416
        <br>"347" 
        <br>"3.1416" 
        <br>"Solo literal" 
        <br>"12.3 Literal con número"
    </p>
    <h3>Solución:</h3>

    <?php
    // Definimos las variables y asignamos valores
    $a = 347;
    $b = 2147483647;
    $c = -2147483647;
    $d = 23.7678;
    $e = 3.1416;
    $f = "347" ;
    $g = "3.1416";
    $h = "Solo literal" ;
    $i = "12.3 Literal con número";

    // Imprimimos variables y tipos
    echo "<br>El valor de la variable es '$a' y su tipo " . gettype($a);
    echo "<br>El valor de la variable es '$b' y su tipo " . gettype($b);
    echo "<br>El valor de la variable es '$c' y su tipo " . gettype($c);
    echo "<br>El valor de la variable es '$d' y su tipo " . gettype($d);
    echo "<br>El valor de la variable es '$e' y su tipo " . gettype($e);
    echo "<br>El valor de la variable es '$f' y su tipo " . gettype($f);
    echo "<br>El valor de la variable es '$g' y su tipo " . gettype($g);
    echo "<br>El valor de la variable es '$h' y su tipo " . gettype($h);
    echo "<br>El valor de la variable es '$i' y su tipo " . gettype($i);

    ?>
</body>

</html>