<?php
// inicia la sesion
session_start();

// inicializa la variable mensaje
$mensaje = '';

// verifica si se pulsa iniciar sesion
if (isset($_POST['iniciar'])) {
    $_SESSION['agenda'] = array();
}

// verifica si el usuario ha cerrado sesion
if (isset($_POST['cerrar'])) {
    // borra variables de sesion
    session_unset();
    // cierra sesion
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// verifica si el usuario ha guardado un contacto
if (isset($_POST['guardar'])) {
    if (!empty($_POST['contacto'])) {
        $_SESSION['agenda'][] = $_POST['contacto'];
        $mensaje = "Contacto guardado correctamente.";
    } else {
        $mensaje = "Informa de un nombre para guardar.";
    }
}

// funcion para exportar la agenda a un archivo
if (isset($_POST['exportar'])) {
    if (isset($_SESSION['agenda']) && count($_SESSION['agenda']) > 0) {
        // convertir la agenda en formato JSON para exportar
        $agenda_json = json_encode($_SESSION['agenda'], JSON_PRETTY_PRINT);
        // guardar la agenda en un archivo
        file_put_contents('agenda.json', $agenda_json);
        $mensaje = "Agenda exportada correctamente a 'agenda.json'.";
    } else {
        $mensaje = "No hay contactos para exportar.";
    }
}

// funcion para importar la agenda desde un archivo
if (isset($_POST['importar'])) {
    // verificar si el archivo existe
    if (file_exists('agenda.json')) {
        // leer el contenido del archivo
        $agenda_json = file_get_contents('agenda.json');
        // convertir el contenido JSON en un array
        $_SESSION['agenda'] = json_decode($agenda_json, true);
        $mensaje = "Agenda importada correctamente desde 'agenda.json'.";
    } else {
        $mensaje = "No se encontro el archivo 'agenda.json' para importar.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página PHP - Agenda con Sesiones</title>
    <h1>Agenda con sesiones</h1>
</head>

<body>

    <?php
    // si el usuario ha iniciado sesion, muestra los elementos correspondientes
    if (isset($_SESSION['agenda'])) {
        ?>

        <form method="post">
            <input type="text" id="contacto" name="contacto" placeholder="Nombre del contacto">
            <button type="submit" name="guardar">Guardar</button>
            <button type="submit" name="leer">Leer</button>
            <button type="submit" name="exportar">Exportar Agenda</button> <!-- boton exportar -->
            <button type="submit" name="importar">Importar Agenda</button> <!-- boton importar -->
            <button type="submit" name="cerrar">Cerrar Sesion</button>
        </form>

        <?php
        // mostrar mensaje si existe
        if (!empty($mensaje)) {
            echo "<p>$mensaje</p>";
        } 

    } else {
        // si el usuario no ha iniciado sesion, se muestra el boton de iniciar sesion
        ?>

        <form method="post">
            <button type="submit" name="iniciar">Iniciar Sesion</button>
        </form>

        <?php
    }
    ?>

    <?php
    // muestra los contactos si se ha presionado el boton de leer
    if (isset($_POST['leer']) && isset($_SESSION['agenda']) && count($_SESSION['agenda']) > 0) {

        // titulillo
        echo '<h2>Contactos Guardados</h2>';

        // lista
        echo '<ul>';

        foreach ($_SESSION['agenda'] as $contacto) {
            echo '<li>' . $contacto . '</li>';
        }
        echo '</ul>';
    }
    ?>

</body>

</html>
