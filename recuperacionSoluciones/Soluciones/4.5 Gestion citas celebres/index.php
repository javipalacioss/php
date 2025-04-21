<?php
require_once 'funciones.php';

// Obtener la cita más valorada
$cita_destacada = obtener_cita_destacada();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Botón de registro
    if (isset($_POST['ir_registro'])) {
        header("Location: registro.php");
        exit();
    }

    // Botón de login
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        // Validar credenciales
        if (login_usuario($email, $clave)) {
            header("Location: principal.php");
            exit();
        } else {
            $error = "Credenciales incorrectas";
            header("Location: index.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Citas Célebres - Login</title>
</head>

<body>
    <h1 class="titulo">Citas Célebres</h1>

    <?php 
    if ($cita_destacada){
        echo $cita_destacada['texto'] . " - " . $cita_destacada['autor'];
    }
    ?>

    <form method="POST">
        <h2>Iniciar Sesión</h2>

        <input type="email" name="email" placeholder="Correo"><br>
        <input type="password" name="clave" placeholder="Contraseña"><br>

        <button type="submit" name="login">Iniciar Sesión</button>
        <button type="submit" name="ir_registro">Registrarse</button>
    </form>

    <?php if (isset($_SESSION['Mensaje'])) {
        // Muestro mensaje 
        echo $_SESSION['Mensaje'];
        // Borro mensaje
        unset($_SESSION['Mensaje']);
    }
    ?>
</body>

</html>