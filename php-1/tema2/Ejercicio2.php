<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    
    <!--Estilos-->
    <style>
        body{
            text-align: center;
        }
    </style>

</head>
<body>
    <?php
    /*
    Ejercicio 2 - Emoji - Escriba un programa que cada vez que se ejecute muestre un emoticono elegido al azar entre los caracteres Unicode 128512 y 128586. 
    Nota: Para mostrar el emoticono en HTML hay que anteponer &# al número
    */

    // Generamos un numero aleatorio entre 128512 y 128586 
    $emoji = rand(128512, 128586);

    ?> 
    <!-- Mostramos el emoji--> 
     <h1>Emoji generado aleatoriamente: &#<?= $emoji ?></h1>

</body>
</html>