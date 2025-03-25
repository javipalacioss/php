<?php
require_once('funciones.php');
require_once('clases.php');

 // SI LOS CAMPOS NO ESTÁN VACÍOS SE VA A PRINCIPAL
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['entrar'])){
            //crear cookie con el dni del usuario
            $dni = $_POST['dni'];
            setcookie("dni", $dni, time() + 30);
            //redirigimos a principal
            header("Location: principal.php");
            exit();
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
        <input type="submit" value="Entrar" name="entrar">
    </form>
</body>
</html>