<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <?php

    /*Ejercicio 1 - Escriba un programa que cada vez que se ejecute muestre un código de color RGB elegido al azar. Un código de color puede tener el formato rgb(rojo, verde, azul), donde rojo, verde y azul son números enteros entre 0 y 255. */

    //Creamos las variables y las asignamos generandole un numero random mediante la funcion rand, asginamos 0 como min y 255 como numero maximo
    $rojo = rand(0, 255);
    $azul = rand(0, 255);
    $verde = rand(0, 255);

    //Creamos una variable $colorFondo que guarda un color en formato RGB
    // Usamos los valores de $rojo, $verde y $azul para definir el color
    $colorFondo = "rgb($rojo , $verde , $azul)";

    ?>
    <style>
        /*
        Estilos, donde definimos que el color de nuestro fondo sera la variable $colorFondo
        */
        body{
            /*
             <  ?=: Es una sintaxis corta para < ?php echo, la utilizamos para mostrar contenido en la salida
            */
            background-color: <?= $colorFondo ?>;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <!--Definimos un h1 con el color generado-->
    <!-- ?=: Es una sintaxis corta para < ?php echo, la utilizamos para mostrar contenido en la salida -->
    <h1>Color RGB generado aleatoriamente: <br> rgb(<?= $rojo ?>, <?= $verde ?>, <?= $azul ?>)</h1>
</body>
</html>