<?php
// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nombre del formulario
    $nombre = $_POST['nombre'];
    // Establecer una cookie con el nombre del usuario y una duración de 5 segundos
    setcookie('usuario', $nombre, time() + 5, '/'); // time() + 5 es la expiración de 5 segundos
    // Redirigir a la página cerrarSesion.php
    header("Location: cerrarSesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario (cookies)</title>
</head>
<body>
    <h1>Introduce tu nombre</h1>
    <!-- Formulario para iniciar sesión -->
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit" name="iniciarSesion" value="iniciarSesion">Iniciar Sesión</button>
    </form>
</body>
</html>
