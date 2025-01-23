<?php
// Verificar si la cookie "usuario" está establecida
if (isset($_COOKIE["usuario"])) {
    // Obtener el nombre de usuario de la cookie
    $nombre = $_COOKIE["usuario"];
    // Renovar la cookie por 5 segundos más
    setcookie("usuario", $nombre, time() + 5);
} else {
    // Si la cookie no está establecida, redirigir a la página de inicio de sesión
    header("Location: iniciarSesion.php");
    exit();
}

// Establecer el nombre de la sesión y comenzar la sesión
session_name($nombre);
session_start();

// Verificar si se ha enviado el formulario de cierre de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrarSesion'])) {
    // Eliminar la cookie "usuario" estableciendo su tiempo de expiración en el pasado
    setcookie("usuario", $nombre, time() - 5);
    // Destruir todas las variables de sesión
    session_unset();
    // Destruir la sesión
    session_destroy();
    // Redirigir a la página de inicio de sesión
    header("Location: iniciarSesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesion</title>
</head>

<body>
    <form action="cerrarSesion.php" method="post">
    <?php
    // Mostrar el nombre de la sesión si está disponible
    if (!empty($nombre)) {
        echo "<p>La sesion se llama: " . $nombre . "</p>"; 
    }
    ?>

    <h1>Hola, <?php echo $nombre; ?></h1>
    <p>Bienvenido a la página cerrarSesion.php</p>

    <!-- Botón para cerrar sesión -->
    <button type="submit" name="cerrarSesion" value="Cerrar sesión">Cerrar Sesion</button>
    </form>
</body>
</html>