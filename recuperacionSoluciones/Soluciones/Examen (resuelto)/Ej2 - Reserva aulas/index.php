<?php
session_start();
require_once 'funciones.php';

// Procesar inicio de sesión, o va a principal o se queda en index.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if (iniciarSesion($email, $password)) {
            header('Location: principal.php');
            exit;
        }
        
        header('Location: index.php');
        exit;
    }

    // PROCESAR BOTÓN REGISTRO, VA A REGISTRO
    if (isset($_POST['registro'])) {
        header('Location: registro.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas de Aulas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <table>
        <tr>
            <th colspan="2">Sistema de Reservas de Aulas</th>
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
                <th colspan="2">Iniciar Sesión</th>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="password">Contraseña:</label></td>
                <td><input type="password" id="password" name="password" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="login" value="Iniciar Sesión">
                    <input type="submit" name="registro" value="Registrarse" formnovalidate>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>