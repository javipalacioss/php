<?php
// p1.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si se envió el formulario, guardamos el nombre en la cookie
    $nombre = $_POST['nombre'];
    // Establecemos la cookie con duración de 5 segundos
    setcookie('usuario', $nombre, time() + 5, '/'); // time() + 5 es la expiración de 5 segundos
    // Redirigimos a la página p2.php
    header("Location: p2.php");
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
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
