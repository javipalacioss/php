<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>

     <!--Estilos-->
     <style>
        body{
            text-align: center;
        }
    </style>
</head>
<body>
    <?php

    /*Ejercicio 3 - Números - Escriba un programa que muestre un número del cero al 9 al azar y escriba en letras el valor obtenido.*/

    //Creamos la variable numero que sera un numero aleatorio usando la funcion random desde 0 hasta 9
    $numero = rand(0,9);
    /*Creamos un array asociativo llamado $arrayNumeros que asocia números del 0 al 9.
    Los indices del array son los numeros(0-9) y los valores son los nombres de esos numeros en forma de cadena. */
    $arrayNumeros = [
        0 => "cero", 1 => "uno", 2 => "dos", 3 => "tres", 4 => "cuatro", 5 => "cinco", 6 => "seis", 7 => "siete", 8 => "ocho", 9 => "nueve"
    ];
    

    $numeroLetras = $arrayNumeros[$numero];
    ?>

    <!--Mostramos el nnmero y su equivalente en letras--> 
    <h1>Numero generado aleatoriamente: <br>  <?= $numero ?> = <?= $numeroLetras ?></h1>
</body>
</html>