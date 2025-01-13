    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actividad 1</title>
    </head>
    <body>
        <p>Escriba un array de ocho ciudades de España. Elimina al azar una de ellas y muestra de nuevo el array de ciudades</p>



    <?php
    /*  
    */
    $ciudades = ["Sevilla" , "Cadiz", "Malaga", "Huelva", "Almeria","Cordoba","Jaen","Granada"];

    echo "Las 8 ciudades son las siguientes: ";
    //Mostrar array
    echo "<pre>";
    var_dump($ciudades);
    echo"</pre>";

    //Count sirve para contar cuantos elementos hay dentro de un array
    $numRandom =  rand(0, count($ciudades) - 1);
    echo "Se elimina: " . $ciudades[$numRandom] . "<br> <br>";
    unset($ciudades[$numRandom]);


    echo "Las 8 ciudades son las siguientes: ";
    //Mostrar array
    echo "<pre>";
    var_dump($ciudades);
    echo"</pre>";

    //Mostrar array
    echo "<pre>";
    //Queda mas bonito si ponemos print_r para mostrar el array
    print_r($ciudades);
    echo"</pre>";
    ?>












    </body>
    </html>