<?php
require_once('clases.php');

if (!isset($_COOKIE['registro'])) {
    header('Location: index.php');
    exit();
}

//cambiamos a 30 segundos la cookie para que nos de tiempo a introducir todos los datos y no caduque
setcookie("registro", time(), time() + 30);




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
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Establecer mi 
} catch (PDOException $e) {
    echo "Error de conexion: " . $e -> getMessage();
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])) {

    //se recogen ñps datos del frontend
    $dni = $_POST['dni']; //Vallor 1111
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $ciudad = $_POST['ciudad'];
    $clave = $_POST['clave'];
    $tipo = $_POST['tipo'];

    //PREPARACION DE LA SQL
    $sql = "INSERT INTO usuarios (dni, nombre, telefono, email, ciudad, clave, rol)
VALUES(:dni, :nombre, :telefono, :email, :ciudad, :clave, :rol)";

    $stmt = $conexion -> prepare($sql);

    //vinculamos los parametros con los valores
    $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':ciudad', $ciudad, PDO::PARAM_STR);

    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT); //clave encriptada
    $stmt->bindParam(':clave', $clave, PDO::PARAM_STR);

    $stmt->bindParam(':rol', $tipo, PDO::PARAM_STR);

    //$dni = '2222';

    //Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Usuario añadido correctamente";
    } else {
        echo "Error al añadir cliente";
    }
    header('Location: index.php');
    exit();
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
        <label for="dni">DNI:</label>
        <input type="text" name="dni"><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"><br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono"><br>
        <label for="email">email:</label>
        <input type="text" name="email"><br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad"><br>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave"><br>
        <label for="tipo">Tipo:</label>
        <select name="tipo">
            <option value="profesor">Profesor</option>
            <option value="alumno">Alumno</option>
        </select><br>
        <button type="submit" name="registrar">Registrar</button>
    </form>
</body>

</html>