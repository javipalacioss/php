<?php
require_once('clases.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['login'])){
    $dni = $_POST['dni'];
    $clave = $_POST['clave'];

    // Cargar usuarios desde el archivo de texto
    if(file_exists('usuarios.txt')){
    $usuarios = unserialize(file_get_contents('usuarios.txt'));

    if(!empty($usuarios)){
    foreach ($usuarios as $usuario) {
        if ($usuario->getDni() === $dni && $usuario->getClave() === $clave) {
            // Si las credenciales coinciden, iniciar sesión
            $_SESSION['usuario'] = $usuario;
            header('Location: principal.php');
            exit();
        }
    }
    }
    else {
        echo "<p>Credenciales incorrectas.</p>";
    }
}
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Frutería</title>
</head>
<body>
    <h1>Login - Frutería</h1>
    <form method="POST">
        <input type="text" name="dni" placeholder="DNI" required><br>
        <input type="password" name="clave" placeholder="Contraseña" required><br>
        <input type="submit" name="login" value="Login">
    </form>
    <form action="registro.php">
        <input type="submit" name="registrar" value="Registrar">
    </form>
</body>
</html>
