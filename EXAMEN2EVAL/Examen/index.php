<?php
require_once('clases.php');
session_start();
$carpetaCredenciales = '/crendenciales';
//creamos la carpeta /credenciales
//el if me lo he inventado, a mi me ha funcionado antes de hacerlo lo de crear la carpeta
//es decir, a mi sin el if me crea la carpeta sola pero cuando vuelves al index te sale el error de mkdir de que la carpeta credenciales ya esta creada
if (!(dirname('/credenciales'))) {
    $carpetaCredenciales = getcwd() . DIRECTORY_SEPARATOR . mkdir('credenciales');
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /**
     *  //Boton Login
     */
    if(isset($_POST['login']))
    {
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];

        if (file_exists('usuarios.txt')){
        $usuarios = unserialize(file_get_contents('usuarios.txt'));

        if (!empty($usuarios)){
        foreach ($usuarios as $usuario) {
            if ($usuario->getNombre() == $nombre && $usuario->getClave() == $clave) {
                $_SESSION['usuario'] = $usuario;
                header('Location: principal.php');
                exit();
            }
        }
        echo 'Usuario o contraseña incorrectos.';
    }
    else
    {
        echo "El usuario no existe. '$nombre ' " ;
    }
    }

}

//Boton de registro
if(!isset($_POST['registro']))
{
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $clave = $_POST['clave'];
    $color = $_POST['color'];

    
        $usuario = new Usuario($nombre, $clave, $color);
    

    // Guardamos el usuario en el archivo
    $usuarios = file_exists('usuarios.txt') ? unserialize(file_get_contents('usuarios.txt')) : [];
    $usuarios[] = $usuario;
    //he intentado poner /credenciales o $carpetaCredenciales pero no funciona, no se como es, mucho es que lo crea ahi lo siento
    file_put_contents('usuarios.txt', serialize($usuarios));

    echo '¡Registro exitoso!';

    header('Location: index.php');
    exit();

}
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <label>Usuario:</label>
        <input type="text" name="nombre" required><br>
        <label>Clave:</label>
        <input type="password" name="clave" required><br>
        <button type="submit" name="registro">Registro</button>
        <button type="submit" name="login">Iniciar sesión</button>
    </form>
    <br>
    

    
    
   
    <?php 
     //falta arreglar la variable nombre(medio mal no se si es asi comprobar luego)
     if (isset($_POST['registro'])){
    $nombreUsuario =  $_SESSION['nombre']; 
   
        echo "<p>¡Registro exitoso!El usuario con nombre: ' $nombreUsuario '
    <br>Puedes iniciar sesión.</p>";
}
    ?>


</body>
</html>