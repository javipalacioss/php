<?php
// p1.php
if (isset($_POST['Login'])) {
    // Inicia la sesión
    session_start();
    $_SESSION['nombre'] = $_POST['nombre']; // Aseguramos que se use el nombre correctamente
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
        <button type="submit" name="Login">Iniciar sesión</button> 
    </form>
</body>
</html>
