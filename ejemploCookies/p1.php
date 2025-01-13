<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Obtener el nombre del formulario
        $nombre = $_POST['nombre'];
        // Guardar el nombre en una cookie
        setcookie("usuario", $nombre, time() + 5); // La cookie expira en 5 segundos
        header("Location: p2.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>p1</title>
</head>
<body>
    <form action="p2.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre" required>
        <input type="submit" value="Enviar">

    </form>

    
</body>
</html>