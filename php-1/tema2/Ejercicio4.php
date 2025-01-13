<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <?php

    /*Ejercicio 4 - Ciudades - Escriba un array de ocho ciudades de España. Elimina al azar una de ellas y muestra el nuevo array de ciudades.*/

    //Creamos un array con ocho ciudades de España 
    $ciudades = ["Madrid", "Barcelona", "Valencia", "Sevilla", "Bilbao", "Zaragoza", "Malaga", "Granada"]; 

    echo "Las 8 ciudades son las siguientes: ";
    //Mostrar array
    echo "<pre>";
    print_r($ciudades);
    echo"</pre>";


    //Elegimos un indice al azar para eliminar una ciudad 
    $indiceAleatorio = rand(0, count($ciudades) - 1); 

    //Mostramos la ciudad eliminada
    echo "La ciudad que se elimina es: " . $ciudades[$indiceAleatorio] . "<br> <br>";

    //Eliminamos la ciudad en el indice aleatorio 
    unset($ciudades[$indiceAleatorio]);

    //Reindexamos el array para evitar huecos en las claves 
    $ciudades = array_values($ciudades);

    echo "Las 7 ciudades restantes son las siguientes: ";
    //Mostrar array
    echo "<pre>";
    //Queda mas bonito si ponemos print_r para mostrar el array
    print_r($ciudades);
    echo"</pre>";


    ?>
</body>
</html>