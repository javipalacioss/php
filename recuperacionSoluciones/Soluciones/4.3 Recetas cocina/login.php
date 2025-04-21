<?php
require_once('funciones.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['iniciar'])) {
        // Login

        // Obtener los datos del formulario
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        $conexion = conectar();
        //Buscar el usuario en la base de datos
        $sql = "SELECT id, nombre, email, password FROM usuarios WHERE email = :email";
        //Preparar la consulta
        $stmt = $conexion->prepare($sql);

        //Vincular los parámetros con los valores
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        //Ejecutar la consulta
        $stmt->execute();

        //Obtiene la primera fila
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y si la clave es correcta
        if ($usuario) {
            if (password_verify($clave, $usuario['password'])) {
                $_SESSION['usuario'] = $usuario;
                header('Location: principal.php');
                exit();
            } else {
                $_SESSION['mensaje'] = "Contraseña incorrecta.";
            }
        } else {
            $_SESSION['mensaje'] = "Usuario incorrecto.";
        }

        desconectar($conexion);
        header("Location: login.php");
        exit();


    }

    if (isset($_POST['volver'])) {
        // Cancelar
        header('Location: index.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Recetario</title>
</head>

<body>
    <h1>Recetario</h1>
    <h2>Login</h2>
    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type="text" name="email"><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave"><br>
        <button type="submit" name="iniciar">Iniciar sesión</button>
        <button type="submit" name="volver">Volver</button>
    </form>
    <!-- Mensaje -->
    <p><?php if(isset($_SESSION['mensaje'])) 
    {
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
    }?></p>
</body>

</html>