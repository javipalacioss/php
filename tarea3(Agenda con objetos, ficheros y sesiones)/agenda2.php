<?php
//iniciamos la sesion
session_start();

//vverificar si el usuario ha iniciado sesion
if (!isset($_SESSION['nombre'])) {
    header('Location: agenda1.php'); //redirigimos al inicio si no hay sesion
    exit();
}

//inicializamos el array de contactos en la sesion si no existe
if (!isset($_SESSION['contactos'])) {
    $_SESSION['contactos'] = [];
}

//añadir un contacto
if (isset($_POST['nuevo_nombre']) && isset($_POST['nuevo_telefono'])) {
    $nombre = $_POST['nuevo_nombre'];
    $telefono = $_POST['nuevo_telefono'];

    //crear un contacto como un arreglo
    $contacto = ['nombre' => $nombre, 'telefono' => $telefono];
    $_SESSION['contactos'][] = $contacto; //guardar el contacto en la sesion
}

//exportamos contactos (serializar)
if (isset($_POST['exportar'])) {
    $archivo = fopen('contactos.txt', 'w');
    fwrite($archivo, serialize($_SESSION['contactos']));
    fclose($archivo);
    echo "Contactos exportados correctamente.<br>";
}

//importarmos contactos (deserializar)
if (isset($_POST['importar'])) {
    if (file_exists('contactos.txt')) {
        $contenido = file_get_contents('contactos.txt');
        $_SESSION['contactos'] = unserialize($contenido);
        echo "Contactos importados correctamente.<br>";
    } else {
        echo "No hay archivo para importar.<br>";
    }
}

//cerrar sesion
if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header('Location: agenda1.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
</head>

<body>
    <h1>Bienvenido, <?php
                    // Se imprime el nombre del usuario desde la sesión actual
                    // htmlspecialchars() se utiliza para prevenir vulnerabilidades, escapando caracteres especiales como <, >, &, etc.
                    echo htmlspecialchars($_SESSION['nombre']);
                    ?></h1>
    <h2>Añadir persona</h2>
    <form method="post" action="">
        <label for="nuevo_nombre">Nombre:</label>
        <input type="text" id="nuevo_nombre" name="nuevo_nombre" required>
        <label for="nuevo_telefono">Teléfono:</label>
        <input type="text" id="nuevo_telefono" name="nuevo_telefono" required>
        <button type="submit">Guardar</button>
    </form>

    <h2>Acciones</h2>
    <form method="post" action="">
        <button type="submit" name="exportar">Exportar</button>
        <button type="submit" name="importar">Importar</button>
        <button type="submit" name="cerrar_sesion">Cerrar sesión</button>
    </form>

    <h2>Contactos guardados:</h2>
    <ul>
        <?php foreach ($_SESSION['contactos'] as $contacto): ?>
            <!-- Muestra el nombre y teléfono de cada contacto -->
            <li><?php
                // Se imprime el nombre del contacto, asegurándose de escapar caracteres especiales
                echo htmlspecialchars($contacto['nombre']) . " - ";
                // Se imprime el teléfono del contacto, también escapando caracteres
                echo htmlspecialchars($contacto['telefono']);
                ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>