<?php
// Se comprueba si la cookie 'usuario' está disponible
session_start();

if (isset($_POST['cerrar'])) {
    // Borra variables de sesión
    session_unset();
    // Cierra sesión
    session_destroy();
    header("Location: p1.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 2 - Mostrar Nombre</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <p>
        <?php
        $nombre = $_SESSION['nombre'];
        if (!empty($nombre)) {
            echo "Hola " . htmlspecialchars($nombre) . ".";
        }
        ?>
    </p>
    <form method="post">
        <button type="submit" name="cerrar">Cerrar Sesión</button>
    </form>
</body>
</html>
