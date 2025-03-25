<?php
require_once('parametros.php');
session_start();
// Función de conexión a la base de datos
function conectarBD()
{
    try {

        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

function desconectar($conex)
{
    $conex = null;
}

// Función para registrar un nuevo profesor
function registrarProfesor($nombre, $email, $password): bool
{

    // Conectar
    $pdo = conectarBD();

    // Comprobar si el email ya existe
    $stmt = $pdo->prepare("SELECT id FROM profesores WHERE email = :email");

    // Vincular
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);

    // Ejecutar
    $stmt->execute();



    if ($stmt->fetchColumn() > 0) {
        $_SESSION['mensaje'] = "Email ya registrado";
        return false;
    } else {
        // Hashear contraseña
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Insertar el nuevo profesor
        $stmt = $pdo->prepare("INSERT INTO profesores (nombre, email, password) VALUES (:nombre, :email, :password)");

        // Vincular
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":clave", $password_hash, PDO::PARAM_STR);

        $stmt->execute();

        // Cargo la información en la sesión y devuelvo true (con ello, luego redireccionamos ya a principal)
        $profesor_id = $pdo->lastInsertId();
        $_SESSION['profesor_id'] = $profesor_id;
        $_SESSION['nombre'] = $nombre;

        return true;
    }
}

// Iniciar sesión del profesor
function iniciarSesion($email, $password): bool
{
    // Conectar
    $pdo = conectarBD();

    $stmt = $pdo->prepare("SELECT * FROM profesores WHERE email = :email");

    // Vincular
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);

    // Ejecutar
    $stmt->execute();
    // Leer el usuario
    $profesor = $stmt->fetch();

    // Si se ha leído de la bbdd, comprobamos la clave.
    if ($profesor && password_verify($password, $profesor['password'])) {
        // Si es correcta, guardo info en la sesión y devuelvo true
        $_SESSION['usuario_id'] = $profesor['id'];
        $_SESSION['nombre'] = $profesor['nombre'];
        return true;
    } else {
        // Si es incorrecta, devuelvo false
        return false;
    }
}

// Función para comprobar si un aula está disponible
function comprobarDisponibilidad($aula_id): bool
{

    $pdo = conectarBD();

    $stmt = $pdo->prepare("SELECT * FROM reservas WHERE aula_id = :aula_id AND reservada = TRUE");

    $stmt->bindParam(":aula_id", $aula_id);

    // Ejecutar
    $stmt->execute();

    if ($stmt->execute()) {
        echo ("La aula esta diposnible");
        return true;
    } else {
        echo ("La aula no esta disponible");
        return false;
    }

}

// Crear nueva reserva
function crearReserva($profesor_id, $aula_id, $fecha, $motivo): bool
{
    $pdo = conectarBD();
    // Comprobar disponibilidad, usando la función anterior
    comprobarDisponibilidad($aula_id);

    // Si el aula está libre, hago la reserva
    $stmt = $pdo->prepare("INSERT INTO reservas (profesor_id, aula_id, fecha, motivo) VALUES (:profesor_id, :aula_id, :fecha, :motivo)");
    // Vincular
    $stmt->bindParam(":profesor_id", $profesor_id);
    $stmt->bindParam(":aula_id", $aula_id);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->bindParam(":motivo", $motivo);


    // Ejecutar
    $stmt->execute();

    if ($stmt->execute()) {
        echo ("La reserva se ha creado con exito");
        return true;
    } else {
        echo ("La reserva no se ha podido crear con exito");
        return false;
    }
}

// Eliminar reserva
function eliminarReserva($reserva_id, $profesor_id): bool
{

    $pdo = conectarBD();

    $stmt = $pdo->prepare("DELETE FROM reservas WHERE id = :reserva_id AND profesor_id = :profesor_id");
    // Vincular
    $stmt->bindParam(":profesor_id", $profesor_id);
    $stmt->bindParam(":reserva_id", $reserva_id);

    // Ejecutar
    $stmt->execute();

    // Ejecutar    
    if ($stmt->execute()) {
        echo ("La reserva se ha eliminado con exito");
        return true;
    } else {
        echo ("La reserva no se ha podido eliminar");
        return false;
    }
}

// Obtener reservas del profesor actual
function obtenerReservas($profesor_id)
{

    $pdo = conectarBD();

    $stmt = $pdo->prepare("SELECT r.*, a.nombre as aula_nombre 
                             FROM reservas r JOIN aulas a ON r.aula_id = a.id 
                            WHERE r.profesor_id = :profesor_id 
                            ORDER BY r.fecha DESC");



    $stmt->bindParam(":profesor_id", $profesor_id);
    //exec
    $stmt->execute();


    //return stmt para recorrer con while
    if (($stmt->rowCount() > 0)) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    // Vincular
    $stmt = $pdo -> prepare($sql);

    // Ejecutar
    $stmt->execute();

    //return stmt para recorrer con while
    if ($stmt->rowCount() > 0) {
        return $stmt;
    }
}

// Cambiar estado de reserva (de activa a terminada)
function cambiarEstadoReserva($reserva_id, $profesor_id)
{
    //SI NO HAY RESERVA, NO TIENE FILAS EN LA TABLA RESERVAS
    // SI TIENE UNA FILA CON "RESERVADA" VALOR 1, ESTÁ RESERVADA
    // SI TIENE UNA FILA CON "RESERVADA" VALOR 0, ESTÁ TERMINADA


    $pdo = conectarBD();

    // Obtener estado actual
    $stmt = $pdo->prepare("SELECT reservada FROM reservas WHERE id = :reserva_id AND profesor_id = :profesor_id");

    // Vincular
    $stmt->bindParam(":profesor_id", $profesor_id);
    $stmt->bindParam(":reserva_id", $reserva_id);

    $stmt->execute();

    // Actualizar desde reservada (reservada = 1), a terminada (reservada = 0)
    $stmt = $pdo->prepare("UPDATE reservas SET reservada = :reservada WHERE id = :reserva_id AND profesor_id = :profesor_id");

    // Vincular
    $stmt->bindParam(":profesor_id", $profesor_id);
    $stmt->bindParam(":reserva_id", $reserva_id);

    $stmt->execute();
}

function cerrar_sesion()
{
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}