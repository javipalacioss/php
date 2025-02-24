<?php
//CONEXION BBDD
$host = 'localhost';
$dbname = 'instituto';
$username = 'root';
$password = '';

try {
    $conexion = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configuración para manejo de errores
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

session_start();

//verificamos si el usuario esta logueado
if (!isset($_SESSION['usuario']) || isset($_POST['cerrar'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}


$usuario = $_SESSION['usuario']; 


//Esto esta mal pq no loguea como alumno
//Comprobamos: Si no es un objeto de la clase Alumno, redirigir o mostrar error
if (!($usuario instanceof Alumno)) {
    echo "El usuario no es válido o no es un alumno";
    exit;
}

echo "<h1>Hola, {$usuario->getNombre()}</h1>";
echo "<h2>Tus notas:</h2>";

//consultamos las notas del alumno en la base de datos
$sql = "SELECT asignatura, nota FROM notas WHERE id_usuario = :id_usuario";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id_usuario', $usuario->getNombre(), PDO::PARAM_STR);  // Asumiendo que 'nombre' es único para el alumno
$stmt->execute();
$notas = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($notas)) {
    echo "No tienes notas asignadas.";
} else {
    echo "<ul>";
    foreach ($notas as $nota) {
        echo "<li>{$nota['asignatura']}: {$nota['nota']}</li>";
    }
    echo "</ul>";
}

?>

<form method="POST">
    <button type="submit" name="cerrar">Cerrar sesión</button>
</form>
