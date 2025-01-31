
<?php
require_once('clases.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'];
    $clave = $_POST['clave'];
    $nombre = $_POST['nombre'];

    // Crear un nuevo objeto Usuario
    $usuario = new Usuario($dni, $nombre, $clave);

    // Cargar usuarios existentes
    $usuarios = unserialize(file_get_contents('usuarios.txt'));
    
    // Añadir nuevo usuario
    $usuarios[]= $usuario;

    // Guardar usuarios en el archivo
    file_put_contents('usuarios.txt', serialize($usuarios));

    echo "<p>¡Registro exitoso! Puedes iniciar sesión.</p>";
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Frutería</title>
</head>
<body>
    <h1>Registro - Frutería</h1>
    <form method="POST">
        <input type="text" name="dni" placeholder="DNI" required><br>
        <input type="password" name="clave" placeholder="Contraseña" required><br>
        <input type="text" name="nombre" placeholder="Nombre" required><br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
