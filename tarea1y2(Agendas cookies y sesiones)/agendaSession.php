<?php

//iniciamos la sesion para poder almacenar y recuperar datos en $_SESSION
session_start();

//inicializamos las variables $agenda y $mensaje
$agenda = ''; //en esta variable guardaremos los nombres almacenados
$mensaje = ''; //en esta variable guardaremos los mensajes de confirmacion hacia el usuario para saber que hemos guardado un nombre en la agenda correctamente

//guardar un nombre en la agenda
if (isset($_POST['guardar'])) { //verificamos si hemos presionado el boton guardar
    $nombre = trim($_POST['nombre']); //eliminamos los espacios en blanco con trim
    if (empty($nombre)) {  //verificamos si esta vacio
        $mensaje = "No se puede guardar un nombre vacio"; //mensaje si el nombre esta vacio
    }

    //si ya existe una agenda en la sesion
    if (isset($_SESSION['agenda'])) {
        $agenda = $_SESSION['agenda']; //obtenemos los nombres que ya tenemos almacenados previamente en nuestra agenda
        $agenda .= ", $nombre"; //añadimos el nuevo nombre separado por una coma
    } else {
        $agenda = $nombre; //si no existe la agenda la creamos con el primer nombre
    }

    //guardamos la agenda actualizada en la sesion
    $_SESSION['agenda'] = $agenda; //almacenamos la lista en $_SESSION

    //mostramos el mensaje confirmando que el nombre se ha guardado correctamente
    $mensaje = "Nombre guardado: $nombre";
}


//leemos la lista de los nombres guardados
if (isset($_POST['leer'])) { //verificamos que hemos pulsado el boton leer
    if (isset($_SESSION['agenda'])) { //comprobamos que la agenda existe en la sesion
        $agenda = $_SESSION['agenda']; //obtenemos los nombres almacenados
    } else {
        //si no hay nombres guardados mostramos un mensaje confirmando que no hay nombres almacenados en la agenda
        $mensaje = "No hay nombres almacenados en la agenda"; //mensaje si no hay nombres en la agenda
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda con sesiones</title>
</head>
<body>
    <!--formulario para interactuar con la agenda-->
    <form method="post">
        <h1>Agenda</h1>
        <label for="nombre" id="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">

        <button type="submit" id="guardar" name="guardar">Guardar</button>
        <button type="submit" id="leer" name="leer">Leer</button>

    </form>

    <p>La agenda contiene los siguientes nombres:</p>

    <ul>
        <?php
        //mostramos los nombres guardados en la agenda

        if (isset($_POST['leer']) && isset($_SESSION['agenda'])) {
            //dividimos la lista en un array por comas
            $nombres = explode(", ", $agenda); //convertimos la cadena en un array de nombres

            //recorremos el array para mostrar cada nombre como un elemento de la lista
            foreach ($nombres as $nombre) {
                echo "<li>$nombre</li>";
            }
        } elseif (isset($_POST['leer'])) {
            //si no hay nombres guardados mostramos un mensaje
            echo "<li> no hay nombres guardados </li>"; //mensaje si no hay nombres en la agenda
        }
        ?>
    </ul>

    <?php
    //mostramos mensaje de confirmacion si se ha guardado un nombre
    if ($mensaje) echo "<p> $mensaje </p>"; //mostramos el mensaje de confirmacion
    ?>

</body>

</html>

<!--si guardo un nombre vacio el programalo guarda, pedir solucion al profesor
 una posible solucion podria ser required en el input nombre, pero no es asi por que si le doy a leer no me deja ya que me pide el nombre que seria required-->
 