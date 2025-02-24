<?php
require_once('clases.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // CONEXION A BBDD

    //indicamos la ip de donde se encuentra nuestro servidor (si fuera una ip indicariamos hacia la ip)
    $host = 'localhost';

    //indicamos el nombre de la base de datos
    $dbname = 'instituto';

    //indicamos el usuario
    $username = 'root';

    //indicamos la contraseña
    $password = '';


    try {
        $conexion = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Establecer mi 
    } catch (PDOException $e) {
        echo "Error de conexion: " . $e->getMessage();
        exit();
    }

    /**
     *  BOTÓN INICIAR
     */
    if (isset($_POST['iniciar'])) {
        $email = $_POST['email'];
        $clave = $_POST['clave'];

        $sql = "SELECT email, clave, rol FROM usuarios WHERE EMAIL = :email";
        $stmt = $conexion->prepare($sql);

        $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            //otra forma de verificar la contraseña
            //if(password_hash($_POST['clave'], PASSWORD_BCRYPT) == $ususario['clave']);

            if (password_verify($_POST['clave'], $usuario['clave'])) {
                $_SESSION['usuario'] = $usuario;

                switch ($usuario['rol']) {
                        //caso profesor
                    case 'p':
                        header('Location: profesor.php');
                        exit();
                        //break no necesario al indicar exit

                        //caso alumno
                    case 'a':
                        header('Location: alumno.php');
                        exit();
                        //break no necesario al indicar exit

                    default:
                        echo "El tipo de usuario indicado no existe";
                        break;
                }
            } else {
                echo "La contraseña es incorrecta.";
            }
        } else {
            echo "El usuario no ha podido ser encontrado";
        }
    }


    /**
     *  BOTÓN REGISTRO
     */
    if (isset($_POST['registro'])) {

        // Establecer cookie de duración
        setcookie("registro", time(), time() + 5);
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
        <label for="email">Email:</label>
        <input type="text" name="email"><br>
        <label for="clave">Contraseña:</label>
        <input type="text" name="clave"><br>
        <button type="submit" name="iniciar">Iniciar sesión</button>
        <button type="submit" name="registro">Registro</button>
    </form>
</body>

</html>