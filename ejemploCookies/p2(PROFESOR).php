<?php
// Se comprueba si la cookie 'usuario' está disponible
if(isset($_COOKIE['usuario']))
{
    $nombre = $_COOKIE['usuario'];
    $edad = 30;
    setcookie('usuario', $nombre, time() + 5, '/'); // Refresca la cookie
}
else
{
    header("Location: p1.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 2 - Mostrar Nombre</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <p>
        <?php
        if (!empty($nombre)) {
            echo "Hola " . htmlspecialchars($nombre) . ".";
        }
        ?>
    </p>
</body>
</html>
