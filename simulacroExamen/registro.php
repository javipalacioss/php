<?php 
require_once('clases.php');

// si no existe la cookie, la creamos con el tiempo actual y expiracion de 5 segundos
if (!isset($_COOKIE['tiempo_restante'])) {
    setcookie('tiempo_restante', time(), time() + 5);  
    header("Location: ".$_SERVER['PHP_SELF']);  
    exit;
}

// comprobamos el tiempo transcurrido desde que se establecio la cookie
$tiempo_transcurrido = time() - $_COOKIE['tiempo_restante'];

if ($tiempo_transcurrido > 5) {
    // si han pasado mas de 5 segundos, redirigimos a index.php
    header("Location: index.php");
    exit;
}

// si el formulario fue enviado (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];

    // verificamos que los datos esten completos
    if (empty($nombre) || empty($tipo)) {
        echo "<p>por favor, complete todos los campos del formulario.</p>";
        exit;
    }

    // cargamos los usuarios desde el archivo o creamos un array vacio
    $usuarios = file_exists('usuarios.txt') ? unserialize(file_get_contents('usuarios.txt')) : [];

    // crear el objeto de acuerdo al tipo de usuario
    if ($tipo == 'profesor') {
        $profesor = new Profesor($nombre, $tipo);
        $usuarios[] = $profesor; 
    } elseif ($tipo == 'alumno') {
        // verificamos si las notas estan presentes (si no estan, se guardara como vacio)
        $notas = isset($_POST['notas']) ? $_POST['notas'] : '';
        
        // puedes anadir una validacion mas estricta sobre las notas si es necesario
        $alumno = new Alumno($nombre, $tipo, $notas);
        $usuarios[] = $alumno; 
    } else {
        echo "<p>tipo de usuario invalido.</p>";
        exit;
    }

    // guardamos los usuarios actualizados en el archivo
    file_put_contents('usuarios.txt', serialize($usuarios));

    // mensaje de exito y redireccion
    echo "<p>¡registro exitoso! puedes iniciar sesion.</p>";
    header("Location: index.php");
    exit;
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="registro.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" ><br>
        <label for="tipo">Tipo:</label>
        <select name="tipo">
            <option value="profesor">Profesor</option>
            <option value="alumno">Alumno</option>
        </select><br>
        <button type="submit" name="registrar">Registrar</button>
    </form>
</body>
</html>
