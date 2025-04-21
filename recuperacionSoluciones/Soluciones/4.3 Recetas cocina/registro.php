<?php
require_once('funciones.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['registrar'])) {
        // Login

        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $clave = $_POST['clave'];
        $clave2 = $_POST['clave2'];

        if ($clave != $clave2) {
            $_SESSION['mensaje'] = 'Las claves no coinciden.';
            header("Location: registro.php");
            exit();
        }

        if (!empty($nombre) && !empty($email) && !empty($clave)) {

            $conexion = conectar();

            // Buscar el usuario por si ya está registrado
            $sql = "SELECT id, nombre, email, password FROM usuarios WHERE email = :email";
            //Preparar la consulta
            $stmt = $conexion->prepare($sql);

            //Vincular los parámetros con los valores
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            //Ejecutar la consulta
            $stmt->execute();

            //Obtiene la primera fila
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario) {
                $_SESSION['mensaje'] = "El usuario ya está registrado.";
            } else {
                //Insertar el usuario en la base de datos
                $sql = "INSERT INTO usuarios (nombre, email, password) 
                             VALUES (:nombre, :email, :password)";
                //Preparar la consulta
                $stmt = $conexion->prepare($sql);

                //Vincular los parámetros con los valores
                $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);

                $clavebcrypt = password_hash($clave, PASSWORD_BCRYPT);
                $stmt->bindParam(':password', $clavebcrypt, PDO::PARAM_STR);

                //Ejecutar la consulta
                $stmt->execute();

                if ($stmt->rowCount() == 1) {
                    $_SESSION['mensaje'] = 'Usuario registrado correctamente.';
                }
            }
            desconectar($conexion);
        } else {
            $_SESSION['mensaje'] = 'Los campos no pueden estar vacíos.';
        }

        header("Location: registro.php");
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
    <h2>Registro</h2>
    <form action="" method="POST">
        <label for="email">Nombre:</label>
        <input type="text" name="nombre"><br>
        <label for="email">Email:</label>
        <input type="text" name="email"><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave"><br>
        <label for="clave">Confirmar contraseña:</label>
        <input type="password" name="clave2"><br>
        <button type="submit" name="registrar">Registrar</button>
        <button type="submit" name="volver">Volver</button>
    </form>
    <!-- Mensaje -->
    <p><?php if (isset($_SESSION['mensaje'])) {
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        } ?></p>
</body>

</html>