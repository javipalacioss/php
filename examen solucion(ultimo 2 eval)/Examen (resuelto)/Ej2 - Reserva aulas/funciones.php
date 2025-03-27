<?php
require_once 'parametros.php';

// Función de conexión a la base de datos
function conectarBD()
{
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}

function desconectar($conex)
{
    $conex = null;
}

// Función para registrar un nuevo profesor
function registrarProfesor($nombre, $email, $password): bool
{
    $pdo = conectarBD();

    // Comprobar si el email ya existe
    $stmt = $pdo->prepare("SELECT id FROM profesores WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensaje'] = "Email ya registrado";
        return false;
    }

    // Insertar el nuevo profesor
    $stmt = $pdo->prepare("INSERT INTO profesores (nombre, email, password) VALUES (:nombre, :email, :password)");
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password_hash, PDO::PARAM_STR);


    if ($stmt->execute()) {

        desconectar($pdo);
        $_SESSION['mensaje'] = "Registrado correctamente";
        return true;
    } else {

        desconectar($pdo);
        $_SESSION['mensaje'] = "Error al registrar";
        return false;
    }
}

// Iniciar sesión del profesor
function iniciarSesion($email, $password): bool
{
    $pdo = conectarBD();
    $stmt = $pdo->prepare("SELECT * FROM profesores WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $profesor = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $profesor['password'])) {
            $_SESSION['profesor_id'] = $profesor['id'];
            $_SESSION['profesor_nombre'] = $profesor['nombre'];
            $_SESSION['mensaje'] = "Bienvenido";
            desconectar($pdo);
            return true;
        } else {
            $_SESSION['mensaje'] = "Contraseña incorrecta";
        }
    } else {
        $_SESSION['mensaje'] = "Email no encontrado";
    }

    desconectar($pdo);
    return false;
}

// Función para comprobar si un aula está disponible
function comprobarDisponibilidad($aula_id): bool
{
    $pdo = conectarBD();
    $sql = "SELECT * FROM reservas WHERE aula_id = :aula_id AND reservada = TRUE";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':aula_id', $aula_id, PDO::PARAM_INT);

    $stmt->execute();

    desconectar($pdo);
    // Si hay resultados, significa que el aula ya está reservada
    return $stmt->rowCount() == 0;
}

// Crear nueva reserva
function crearReserva($profesor_id, $aula_id, $fecha, $motivo): bool
{
    $pdo = conectarBD();
    // Comprobar disponibilidad
    if (comprobarDisponibilidad($aula_id)) {
        $stmt = $pdo->prepare("INSERT INTO reservas (profesor_id, aula_id, fecha, motivo) VALUES (:profesor_id, :aula_id, :fecha, :motivo)");
        $stmt->bindParam(':profesor_id', $profesor_id, PDO::PARAM_INT);
        $stmt->bindParam(':aula_id', $aula_id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':motivo', $motivo, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Reserva creada";
            desconectar($pdo);
            return true;
        } else {
            $_SESSION['mensaje'] = "Error al crear";
        }
    } else {
        $_SESSION['mensaje'] = "Aula no disponible";
    }

    desconectar($pdo);
    return false;
}

// Eliminar reserva
function eliminarReserva($reserva_id, $profesor_id): bool
{
    $pdo = conectarBD();
    $stmt = $pdo->prepare("DELETE FROM reservas WHERE id = :reserva_id AND profesor_id = :profesor_id");
    $stmt->bindParam(':reserva_id', $reserva_id, PDO::PARAM_INT);
    $stmt->bindParam(':profesor_id', $profesor_id, PDO::PARAM_INT);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $_SESSION['mensaje'] = "Reserva eliminada";
        desconectar($pdo);
        return true;
    } else {
        $_SESSION['mensaje'] = "Error al eliminar";
    }

    desconectar($pdo);
    return false;
}

// Obtener reservas del profesor actual
function obtenerReservas($profesor_id)
{
    $pdo = conectarBD();
    $stmt = $pdo->prepare("SELECT r.*, a.nombre as aula_nombre 
                             FROM reservas r JOIN aulas a ON r.aula_id = a.id 
                            WHERE r.profesor_id = :profesor_id 
                            ORDER BY r.fecha DESC
    ");
    $stmt->bindParam(':profesor_id', $profesor_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        desconectar($pdo);
        return $stmt;
    } else {
        return false;
    }
}

// OBTENER AULAS LIBRES
function obtenerAulas()
{
    $pdo = conectarBD();

    $sql = "SELECT a.* FROM aulas a 
             WHERE a.id NOT IN (SELECT DISTINCT r.aula_id 
                                  FROM reservas r 
                                 WHERE r.reservada = TRUE) 
             ORDER BY a.nombre";

    $stmt = $pdo->query($sql);

    desconectar($pdo);
    
    if ($stmt->rowCount() > 0) {
        return $stmt;
    } else {
        return false;
    }
}

// Cambiar estado de reserva (activar/terminar)
function cambiarEstadoReserva($reserva_id, $profesor_id)
{
    $pdo = conectarBD();

    // Obtener estado actual
    $stmt = $pdo->prepare("SELECT reservada FROM reservas WHERE id = :reserva_id AND profesor_id = :profesor_id");
    $stmt->bindParam(':reserva_id', $reserva_id, PDO::PARAM_INT);
    $stmt->bindParam(':profesor_id', $profesor_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $reserva = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($reserva['reservada']) {
            $nuevo_estado = 0;
        } else {
            $nuevo_estado = 1;
        }

        $stmt = $pdo->prepare("UPDATE reservas SET reservada = :reservada WHERE id = :reserva_id AND profesor_id = :profesor_id");
        $stmt->bindParam(':reservada', $nuevo_estado, PDO::PARAM_INT);
        $stmt->bindParam(':reserva_id', $reserva_id, PDO::PARAM_INT);
        $stmt->bindParam(':profesor_id', $profesor_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = $reserva['reservada'] ? "Reserva terminada" : "Reserva activada";
            desconectar($pdo);
            return true;
        } else {
            $_SESSION['mensaje'] = "Error al cambiar estado";
        }
    } else {
        $_SESSION['mensaje'] = "Reserva no encontrada";
    }

    desconectar($pdo);
    return false;
}
