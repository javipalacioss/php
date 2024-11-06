<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <?php

    //creamos el numeroAleatorio utilizando la funcion rand, el num aleatorio debe de ser entre 1 y 10
    $numeroAleatorio = rand(1,10);


    //creamos el array
    $tablaMultiplicar = []; 

    for ($i=1; $i <=10 ; $i++) { 
        //agregamos el resultado al array
        $tablaMultiplicar[] = $numeroAleatorio * $i;
    }

    //mostramos la tabla de multiplicar
    echo "Tabla de multiplicar de ". $numeroAleatorio . ": <br>";
    for ($i = 0; $i < count($tablaMultiplicar); $i++) {
        //mostramos cada valor
        echo "<br> " . $tablaMultiplicar[$i] . " <br>"; 
        if ($i == 4) {
            echo "<br>";
        }
    }

    echo "<br>";

    //creamos el valor minimo y el valor maximo
    $valorMinimo = min($tablaMultiplicar);
    $valorMaximo = max($tablaMultiplicar);

    //mostramos los valores min y max
    echo "<br>Valor minimo:  ". $valorMinimo;
    echo "<br> Valor maximo:  ". $valorMaximo;

    ?>
</body>

</html>