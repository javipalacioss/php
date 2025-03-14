<?php
require_once('funciones.php');
//session_start(); //solo necesario si utilizas el $_SESSION
//mejor utilizar mensaje $_SESSION['mensaje'] = "mensaje ok" o "mensaje error";
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset(['registrar'])) {

        //recuperar datos
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $clave = $_POST['clave'];
        $clave2 = $_POST['clave2'];

        if ($clave != $clave2) {
            $_SESSION['mensaje'] = 'Las claves no coinciden';
            header("Location: registro.php");
            exit();
        }

        if (!empty($nombre) && !empty($email) && !empty($clave) && !empty($clave2)) {
            //Los campos estan rellenos

            //preparar la consulta
            $stmt = $conexion->prepare($sql);

            //vincular datos
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            //ejecutar
            $stmt->execute();

            //extraigo la primera linea
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($usuario) {
                //ya esta registrado
                $mensaje = 'El usuario ya esta registrado';
            } else {
                //no esta registrado, se registra
                $sql = "SELECT id, nombre, email, `password` 
                FROM usuarios 
                WHERE email = :email";

                $sql = "INSERT INTO usuarios (nombre, email, `password`)
                    VALUES (:nombre, :email, :password)";

                //preparar la consulta
                $stmt = $conexion->prepare($sql);

                //vincular datos
                $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);

                $encriptado = password_hash($clave, PASSWORD_BCRYPT);
                $stmt->bindParam(':password', $encriptado, PDO::PARAM_STR);

                //ejecutar
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $mensaje =  "Se añadio el usuario correctamente.";
                } else {
                    $mensaje =  "El usuario ya esta registarado";
                }
            }

            desconectar($conexion);
        } else {
            $mensaje = 'Hay algun campo vacio';
        }

        //
        header('Location: registro.php');
        exit();
    }

    if (isset(['volver'])) {
        //
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
    <!-- Aquí informa del mensaje -->
    <?php
    if (!empty($mensaje)) {

        echo $mensaje;

        // si fuera con session
        // echo $_SESSION['mensaje'];
        // unset($_SESSION['mensaje']);
    }
    ?>
</body>

</html>