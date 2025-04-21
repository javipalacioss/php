<?php
require_once 'parametros.php';

// Función de conexión a la base de datos
function conectarBD() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}

function desconectar($conex) {
    $conex = null;
}

// Función para registrar un nuevo paciente
function registrarPaciente($nombre, $email, $clave): bool
{
    $pdo = conectarBD();
    // Comprobar si el email ya existe
    $stmt = $pdo->prepare("SELECT id FROM pacientes WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    //SELECT id FROM pacientes WHERE email = :email
    
    if ($stmt->rowCount() > 0) {
        $_SESSION['mensaje'] = "Email ya registrado";
        return false;
    }

    // Cifrar contraseña


    // Insertar el nuevo paciente
    //INSERT INTO pacientes (nombre, email, clave) VALUES (:nombre, :email, :clave)
    $stmt = $pdo->prepare("INSERT INTO pacientes (nombre, email, clave) VALUES (:nombre, :email, :clave)");
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $password_hash = password_hash($clave, PASSWORD_BCRYPT);
    $stmt->bindParam(':clave', $password_hash, PDO::PARAM_STR);

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

// Iniciar sesión del paciente
function iniciarSesion($email, $clave): bool
{
    $pdo = conectarBD();
    $stmt = $pdo->prepare("SELECT * FROM pacientes WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($clave, $paciente['clave'])) {
            $_SESSION['paciente_id'] = $paciente['id'];
            $_SESSION['paciente_nombre'] = $paciente['nombre'];
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

// Función para comprobar si un médico está disponible
function comprobarDisponibilidad($medico_id, $fecha): bool
{
    $pdo = conectarBD();
    //SELECT * FROM citas WHERE medico_id = :medico_id AND fecha = :fecha AND activa = TRUE
    $sql = "SELECT * FROM citas WHERE medico_id = :medico_id AND fecha = :fecha AND activa = TRUE";


    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':medico_id', $medico_id, PDO::PARAM_INT);
    $stmt->bindParam(':fecha', $fecha, PDO::PARAM_INT);

    $stmt->execute();

    desconectar($pdo);

    // Si hay resultados, significa que el médico ya está ocupado
    return $stmt->rowCount() == 0;

}

// Crear nueva cita
function crearCita($paciente_id, $medico_id, $fecha, $motivo): bool
{
    $pdo = conectarBD();
    // Comprobar disponibilidad, usando la función anterior
    if (comprobarDisponibilidad($medico_id, $fecha)) {
        $stmt = $pdo->prepare("INSERT INTO citas (paciente_id, medico_id, fecha, motivo) VALUES (:paciente_id, :medico_id, :fecha, :motivo)");
        $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
        $stmt->bindParam(':medico_id', $medico_id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $stmt->bindParam(':motivo', $motivo, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Cita creada correctamente";
        desconectar($pdo);
        return true;
    } else {
        $_SESSION['mensaje'] = "Error al crear la cita";
    }
} else {
    $_SESSION['mensaje'] = "Medico no disponible";
}
desconectar($pdo);
    return false;
}

// Cancelar cita
function cancelarCita($cita_id, $paciente_id): bool
{
    $pdo = conectarBD();
    $stmt = $pdo->prepare("DELETE FROM citas WHERE id = :cita_id AND paciente_id = :paciente_id");

    $stmt->bindParam(':cita_id', $cita_id, PDO::PARAM_INT);
    $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
    // MENSAJE 


    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $_SESSION['mensaje'] = "Cita cancelada correctamente";
        desconectar($pdo);
        return true;
    } else {
        $_SESSION['mensaje'] = "Error al cancelar la cita";
    }

    desconectar($pdo);
    return false;

}

// Obtener citas del paciente actual
function obtenerCitas($paciente_id)
{
    $pdo = conectarBD();
    $stmt = $pdo->prepare("SELECT c.*, m.nombre as medico_nombre, m.especialidad, m.consulta FROM citas c JOIN medicos m ON c.medico_id = m.id WHERE c.paciente_id = :paciente_id ORDER BY c.fecha DESC
");
    $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        desconectar($pdo);
        return $stmt;
    } else {
        return false;
    }
}

// OBTENER MÉDICOS DISPONIBLES
function obtenerMedicos()
{
    $pdo = conectarBD();
    $sql = "SELECT * FROM medicos ORDER BY nombre";
    $stmt = $pdo->query($sql);
    desconectar($pdo);
    if ($stmt->rowCount() > 0) {
        return $stmt;
    } else {
        return false;
    }
}

// Cambiar estado de cita (de programada a atendida)
function cambiarEstadoCita($cita_id, $paciente_id)
{
    $pdo = conectarBD();

    // Obtener estado actual
    $stmt = $pdo->prepare("SELECT activa FROM citas WHERE id = :cita_id AND paciente_id = :paciente_id");
    $stmt->bindParam(':cita_id', $reserva_id, PDO::PARAM_INT);
    $stmt->bindParam(':paciente_id', $profesor_id, PDO::PARAM_INT);
    $stmt->execute();

    //MENSAJE
    //"La cita no existe";

    if ($stmt->rowCount() > 0) {
        $programada = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($programada['programada']) {
            $nuevo_estado = 0;
        } else {
            $nuevo_estado = 1;
        }

    //"UPDATE citas SET activa = :activa WHERE id = :cita_id AND paciente_id = :paciente_id"

    
    $stmt = $pdo->prepare("UPDATE citas SET activa = :activa WHERE id = :cita_id AND paciente_id = :paciente_id");
    $stmt->bindParam(':activa', $activa, PDO::PARAM_INT);
    $stmt->bindParam(':cita_id', $cita_id, PDO::PARAM_INT);
    $stmt->bindParam(':paciente_id', $paciente_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = $programada['programada'] ? "Cita marcada como programada" : "Cita marcada como atendida";
        desconectar($pdo);
        return true;
    } else {
        $_SESSION['mensaje'] = "Error al cambiar el estado de la cita";
    }
} else {
    $_SESSION['mensaje'] = "Cita no encontrada";
}

desconectar($pdo);
return false;

}
