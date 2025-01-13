<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <?php

    /*Ejercicio 1 - Escriba un programa que cada vez que se ejecute muestre un código de color RGB elegido al azar. Un código de color puede tener el formato rgb(rojo, verde, azul), donde rojo, verde y azul son números enteros entre 0 y 255. */

    //Creamos las variables y las asignamos generandole un numero random 
    $rojo = rand(0, 255);
    $azul = rand(0, 255);
    $verde = rand(0, 255);

    $colorFondo = "rgb($rojo , $verde , $azul)";

    ?>
    <style>
        
        body{
            background-color: <?= $colorFondo ?>;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <h1>Color RGB generado aleatoriamente: <br> rgb(<?= $rojo ?>, <?= $verde ?>, <?= $azul ?>)</h1>
</body>
</html>