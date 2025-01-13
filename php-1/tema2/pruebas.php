

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays</title>
</head>
<body>
    <?php
    //Array con valores
    $nombres = ["Sergio" , "María", "Pepito", "Juanito", "Jose"];

    echo "<pre>";
    //Mostrar array
    var_dump($nombres);
    echo"</pre>";

    //quita hasta el indice del array si es un nombre
    //unset($nombres[4]);

    //cambiamos el primero de sergio a sergi.
    $nombres[0]="Sergi";

    $nombres[] = "Laura";

    $nombres[6] = "Jesus";

    //otra forma de enseñar hecha por mi
    for ($i=0; $i < 7; $i++) { 
        print("Nombre:   " . $nombres[$i] . " <br>");
    }

    //el indice puede ser cambiado por un simple string con comillas, nombre y ap1 pasarian a ser indices
    $personas["nombre"] = "Pepe";
    $personas["ap1"] = "Lopez";
    $personas["ap2"] = "Perez";

    echo "<br>";

    echo "migente: ";
    $migente = &$nombres;

    echo "<pre>";
    //Mostrar array
    var_dump($migente);
    echo"</pre>";
    ?>
</body>
</html>