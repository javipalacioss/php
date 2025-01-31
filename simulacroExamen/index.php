<?php
require_once('clases.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['iniciar'])){
    $nombre = $_POST['nombre'];
    //$tipo = $_POST['tipo'];

    // Cargar usuarios desde el archivo de texto
    if(file_exists('usuarios.txt')){
    $usuarios = unserialize(file_get_contents('usuarios.txt'));

    if(!empty($usuarios)){
    foreach ($usuarios as $usuario) {
        // comprobamos si es alumno
        if ($usuario->getNombre() === $nombre && $usuario->getTipo() === "alumno") {
            // Si las credenciales coinciden, iniciar sesión
            $_SESSION['alumno'] = $usuario;
            header('Location: alumno.php');
            exit();
        
        //Comprobamos si es profesor    
        } else if($usuario->getNombre() === $nombre && $usuario->getTipo() === "profesor"){
             // Si las credenciales coinciden, iniciar sesión
             $_SESSION['profesor'] = $usuario;
             header('Location: profesor.php');
             exit();
        }
    }
    }
    else {
        echo "<p>Credenciales incorrectas.</p>";
    }
}
}
 
if (isset($_POST['registro'])) {
    header('Location: registro.php');
    exit();
}

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="index.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" ><br>
        <button type="submit" name="iniciar">Iniciar sesión</button>
        <button type="submit" name="registro" >Registro</button>
    </form>
</body>
</html>
