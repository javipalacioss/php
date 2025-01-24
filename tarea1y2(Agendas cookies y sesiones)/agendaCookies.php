<?php

//inicializamos la variable $mensaje y $agenda
$agenda = "";
$mensaje = "";

//guardar un nombre en la agenda
if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];

    //si la cookie existe debemos agregar el nombre al contenido que ya tenemos
    if (isset($_COOKIE['agenda'])) {
        $agenda = $_COOKIE['agenda']; //tendriamos que leer los nombres ya guardados
        $agenda .= ", $nombre";  //agregamos el nuevo nombre a la agenda separado por una coma
    } else {
        $agenda = $nombre; //creariamos la cookie con el primer nombre
    }

    //ahora deberiamos de guardar la cookie con los nombres actualizados, debemos de darle un tiempo para que expire la cookie que en nuestro caso sera de 15 minutos (900 segundos = 15 min)
    setcookie('agenda', $agenda, time() + 900);

    //mostramos por un mensaje el nombre que hemos guardado para saber que lo hemos guardado de manera correcta
    $mensaje = "Nombre guardado: $nombre";
}

//tendriamos que leer la lista de los nombres guardados
if (isset($_POST['leer'])) {
    if (isset($_COOKIE['agenda'])) {
        $agenda = $_COOKIE['agenda']; //leeriamos los nombres de la cookie
    } else {
        //si no hay cookie mostramos mensaje de que no hay nombres guardados
        $agenda = "No hay nombres guardados.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda con Cookies</title>
</head>

<body>
    <!--Creamos el formulario-->
    <form method="post">
        <!--Titulo-->
        <h1>Agenda</h1>
        <!--Label para poder recoger el input de tipo texto donde recogeremos el nombre-->
        <label for="nombre" id="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">

        <!--Creamos el primer boton (para guardar)-->
        <button type="submit" id="guardar" name="guardar"> Guardar </button>

        <!--Creamos el segundo boton (para leer)-->
        <button type="submit" id="leer" name="leer"> Leer </button>

    </form>

    <!--Mostramos los nombres de la agenda-->
    <p>La agenda contiene los siguientes nombres:</p>

    <!--Creamos la lista(no ordenada) para poder mostrar los nombres-->
    <ul>
        <?php
        //mostrar los nombres de la agenda como lista desordenada (ul, li)
        if (isset($_POST['leer']) && isset($_COOKIE['agenda'])) {

            //dividimos la cadena en un array por comas con el la funcion explode :)
            $nombres = explode(", ", $agenda);

            //usamos un foreach para recorrer el array y mostrar cada nombre como un elemento de la lista
            foreach ($nombres as $nombre) {
                echo "<li>$nombre</li>";
            }
            //si le doy a leer y no hay cookie creada, mostramos un mensaje diciendo que no hay nombres guardados
        } elseif (isset($_POST['leer'])) {
            echo "<li>No hay nombres guardados</li>";
        }
        ?>
    </ul>

    <?php
    //mostramos mensaje de confirmacion si se ha guardado un nombre para saberlo
    if ($mensaje) echo "<p>$mensaje</p>"

    ?>

</body>

</html>