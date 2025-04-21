<?php
require_once 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Botón de volver al login
    if (isset($_POST['ir_login'])) {
        header("Location: index.php");
        exit();
    }

    // Botón de registro
    if (isset($_POST['registro'])) {
        // Se recogen los datos de pantalla
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $clave = $_POST['clave'];
        $confirmar_clave = $_POST['confirmar_clave'];

        // Validaciones
        if (empty($nombre) || empty($email) || empty($clave)) {
            // Campos vacíos
            $_SESSION['mensaje'] = "Todos los campos son obligatorios";
        } elseif ($clave !== $confirmar_clave) {
            // La clave no coincide
            $_SESSION['mensaje'] = "Las contraseñas no coinciden";
        } else {

            // Registrar usuario
            if (empty($error)) {
                $resultado = registrar_usuario($email, $nombre, $clave);

                if ($resultado == true) {
                    header("Location: principal.php");
                    exit();
                } else {
                    $_SESSION['mensaje'] = $resultado;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro - Citas Célebres</title>
</head>

<body>
    <form method="POST">
        <h2>Registro</h2>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"?><br>
        <label for="email">Correo:</label>
        <input type="email" name="email"?><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave"><br>
        <label for="confirmar_clave">Confirmar contraseña:</label>
        <input type="password" name="confirmar_clave"><br>

        <button type="submit" name="registro">Registrarse</button>
        <button type="submit" name="ir_login">Volver a Login</button>
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