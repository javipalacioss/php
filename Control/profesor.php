<?php
require_once('clases.php');

session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'instituto';
$username = 'root';
$password = '';

try {
    // Crear la conexión
    $conexion = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Manejo de errores
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit();
}

// Obtener el usuario de la sesión
$usuario = $_SESSION['usuario'];

// Verificar si el formulario de asignación de nota fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Asignar una nueva nota a un alumno
    if (isset($_POST['asignar'])) {

        $nombreAlumno = $_POST['nombreAlumno'];
        $asignatura = $_POST['asignatura'];
        $nota = $_POST['nota'];

        // Buscar al alumno en la base de datos
        $sql = "SELECT id FROM usuarios WHERE nombre = :nombreAlumno AND rol = 'a'";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombreAlumno', $nombreAlumno);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // El alumno existe, asignamos la nota
            $alumno = $stmt->fetch(PDO::FETCH_ASSOC);
            $idAlumno = $alumno['id'];

            // Insertar la nota en la tabla "notas"
            $sql = "INSERT INTO notas (id_usuario, asignatura, nota) VALUES (:id_usuario, :asignatura, :nota)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id_usuario', $idAlumno);
            $stmt->bindParam(':asignatura', $asignatura);
            $stmt->bindParam(':nota', $nota);
            $stmt->execute();

            echo "Nota asignada correctamente.";
        } else {
            echo "Alumno no encontrado.";
        }
    }

    // Cerrar sesión
    if (isset($_POST['cerrar'])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Profesor</title>
</head>
<body>
    <h2>Asignar Notas</h2>
    <form action="profesor.php" method="POST">
        <label for="nombreAlumno">Nombre del alumno:</label>
        <input type="text" name="nombreAlumno" required><br>
        <label for="asignatura">Asignatura:</label>
        <input type="text" name="asignatura" required><br>
        <label for="nota">Nota:</label>
        <input type="number" name="nota" min="0" max="10" required><br>
        <button type="submit" name="asignar">Asignar nota</button>
    </form>

    <form action="profesor.php" method="POST">
        <button type="submit" name="cerrar">Cerrar</button>
    </form>
</body>
</html>
