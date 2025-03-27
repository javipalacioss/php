<?php
session_start();
require_once 'funciones.php';

// BOTÓN DE REGISTRO
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['registrar'])) {
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        
        // VALIDACIÓN BÁSICA DE CAMPOS RELLENOS Y CLAVE = CLAVECONFIRMACION
        $error = false;
        
        if (empty($nombre) || empty($email)) {
            $error = true;
            $_SESSION['mensaje'] = "Completa todos los valores.";
        }elseif (empty($password) || $password != $password_confirm)
        {
            $error = true;
            $_SESSION['mensaje'] = "La clave está vacía o no coincide.";        
        }

        // SI SE REGISTRA, VA A INDEX. EN CASO DE ERROR, MENSAJE Y SE QUEDA EN REGISTRO.
        if (!$error) {
            if (registrarProfesor($nombre, $email, $password)) {
                header('Location: index.php');
                exit;
            }
        }
    }

    // BOTÓN DE VOLVER A PAGINA PRINCIPAL
    if (isset($_POST['volver'])) {
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Profesores - Sistema de Reservas de Aulas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <table>
        <tr>
            <th>Registro de Profesores - Sistema de Reservas de Aulas</th>
        </tr>
    </table>
    
    <?php if (isset($_SESSION['mensaje'])): ?>
        <table class="mensaje">
            <tr>
                <td><?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></td>
            </tr>
        </table>
    <?php endif; ?>
    
    <form method="post" action="">
        <table>
            <tr>
                <th colspan="2">Registro de Nuevo Profesor</th>
            </tr>
            <tr>
                <td><label for="nombre">Nombre completo:</label></td>
                <td><input type="text" id="nombre" name="nombre" required value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>"></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"></td>
            </tr>
            <tr>
                <td><label for="password">Contraseña:</label></td>
                <td><input type="password" id="password" name="password" required></td>
            </tr>
            <tr>
                <td><label for="password_confirm">Confirmar contraseña:</label></td>
                <td><input type="password" id="password_confirm" name="password_confirm" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="registrar" value="Registrar">
                    <input type="submit" name="volver" value="Volver" formnovalidate>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>