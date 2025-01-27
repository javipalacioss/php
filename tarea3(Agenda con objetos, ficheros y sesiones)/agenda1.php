<?php
//iniciamos la sesion
session_start();

//Comprobamos si ya se ingresamos un nombre
if (isset($_POST['nombre'])) {
    $_SESSION['nombre']=$_POST['nombre']; //Guardamos el nombre en la sesion
    header('Location: agenda2.php'); //Redirigimos a la segunda pagina llamada agenda2.php
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
</head>
<body>
    <h1>Bienvenido a la agenda</h1>
    <form method="post">
        <label for="nombre">Introduce tu nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>