<?php

// Si existe la cookie de dni, la eliminamos para "cerrar sesión"
if (isset($_COOKIE["dni_usuario"])) {
    setcookie("dni_usuario", "", time() - 3600);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dni']) && !empty($_POST['dni'])) {
        // Guardar DNI en cookie (24 horas)
        setcookie("dni_usuario", $_POST['dni'], time() + 30);
        header("Location: principal.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Banco</title>
</head>
<body>
    <h1>Bienvenido a Mi Banco</h1>
    <p>Ingresa tus datos para acceder a tu cuenta bancaria.</p>
    <form method="post">
        <label for="dni">Ingresa tu DNI:</label>
        <input type="text" id="dni" name="dni" required>
        <br><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>