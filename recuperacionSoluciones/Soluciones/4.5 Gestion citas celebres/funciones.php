<?php
require_once('parametros.php');
// Iniciar sesión y conexión a base de datos
session_start();

function conectar()
{
    try {

        $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DB, USUARIO, CLAVE, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

// Función para redirigir si no hay sesión
function requerir_login()
{
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php");
        exit();
    }
}

// Función para obtener la cita más valorada
function obtener_cita_destacada()
{
    $pdo = conectar();

    $stmt = $pdo->prepare("
            SELECT c.texto, c.autor, (rp.likes - rp.dislikes) AS puntuacion
            FROM citas c LEFT JOIN resumen_puntuaciones rp ON c.id = rp.cita_id
            ORDER BY puntuacion DESC 
            LIMIT 1
        ");

    $stmt->execute();
    return $stmt->fetch();
}

// Función de login
function login_usuario($email, $clave)
{
    // Conectar
    $pdo = conectar();
    // Preparar consulta
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    // Vincular
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    // Ejecutar
    $stmt->execute();
    // Leer el usuario
    $usuario = $stmt->fetch();

    // Si se ha leído de la bbdd, comprobamos la clave.
    if ($usuario && password_verify($clave, $usuario['clave'])) {
        // Si es correcta, guardo info en la sesión y devuelvo true
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        return true;
    } else {
        // Si es incorrecta, devuelvo false
        return false;
    }
}

// Función de registro
function registrar_usuario($email, $nombre, $clave)
{
    // Conectar
    $pdo = conectar();

    // Verificar si el email o nombre ya existen
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email OR nombre = :nombre");

    // Vincular
    $stmt->bindParam(":email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);

    // Ejecutar
    $stmt->execute();

    if ($stmt->fetchColumn() > 0) {
        $_SESSION['mensaje'] = "Email o nombre ya registrado";
        return false;
    } else {
        // Hashear contraseña
        $clave_hash = password_hash($clave, PASSWORD_BCRYPT);

        // Preparar consulta
        $stmt = $pdo->prepare("INSERT INTO usuarios (email, nombre, clave) VALUES (:email, :nombre, :clave)");

        // Vincular
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":clave", $clave_hash, PDO::PARAM_STR);

        $stmt->execute();

        // Cargo la información en la sesión y devuelvo true (con ello, luego redireccionamos ya a principal)
        $usuario_id = $pdo->lastInsertId();
        $_SESSION['usuario_id'] = $usuario_id;
        $_SESSION['nombre'] = $nombre;

        return true;
    }
}

// Función para obtener citas
function obtener_citas()
{
    $pdo = conectar();

    $stmt = $pdo->prepare("SELECT c.*, u.nombre AS usuario_nombre
            FROM citas c      JOIN usuarios u              ON c.usuario_id = u.id       ");
    $stmt->execute();
    return $stmt;
}

// Función para crear cita
function crear_cita($texto, $autor, $usuario_id)
{
    // Conectar
    $pdo = conectar();
    // Preparar consulta
    $stmt = $pdo->prepare("INSERT INTO citas (texto, autor, usuario_id) VALUES (:texto, :autor, :usuario_id)");
    // Vincular
    $stmt->bindParam(":texto", $texto);
    $stmt->bindParam(":autor", $autor);
    $stmt->bindParam(":usuario_id", $usuario_id);

    // Ejecutar    
    if ($stmt->execute()) {
        return true;
    } else {
        return true;
    }
}

// Función para votar cita
function votar_cita($usuario_id, $cita_id, $puntuacion)
{
    // Conectar
    $pdo = conectar();

    // Insertar o actualizar puntuación
    $stmt = $pdo->prepare("INSERT INTO puntuaciones (usuario_id, cita_id, puntuacion) 
                                VALUES (:usuario_id, :cita_id, :puntuacion)
                                    ON DUPLICATE KEY UPDATE puntuacion = :puntuacion");

    // Vincular
    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->bindParam(":cita_id", $cita_id);
    $stmt->bindParam(":puntuacion", $puntuacion);

    // Ejecutar y devolver si es true o false
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Función para cerrar sesión
function cerrar_sesion()
{
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

function meGusta($usuario_id, $cita_id)
{
    $pdo = conectar();

    // Verificar puntuación actual
    $stmt = $pdo->prepare("SELECT usuario_id, cita_id, puntuacion FROM puntuaciones 
                            WHERE usuario_id = :usuario_id AND cita_id = :cita_id");

    // Vincular
    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->bindParam(":cita_id", $cita_id);

    // Ejecutar
    $stmt->execute();

    // Leer la puntuacion
    $valoracion = $stmt->fetch(PDO::FETCH_ASSOC);

    $puntuacion_actual = $valoracion['puntuacion'];

    // Determinar nueva puntuación
    if ($puntuacion_actual == '1') {
        $nueva_puntuacion = 0;
    } else {
        $nueva_puntuacion = 1;
    }

    // Insertar o actualizar puntuación
    if ($nueva_puntuacion == 0) {

        // Prepare
        $stmt = $pdo->prepare("DELETE FROM puntuaciones WHERE usuario_id = :usuario_id AND cita_id = :cita_id");
        // Vincular
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":cita_id", $cita_id);
        // Ejecutar
        $stmt->execute();
    } else {
        // Prepare
        $stmt = $pdo->prepare("INSERT INTO puntuaciones (usuario_id, cita_id, puntuacion) 
                                    VALUES (:usuario_id, :cita_id, :nueva_puntuacion) 
                                        ON DUPLICATE KEY UPDATE puntuacion = :nueva_puntuacion");
        // Vincular
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":cita_id", $cita_id);
        $stmt->bindParam(":nueva_puntuacion", $nueva_puntuacion);
        $stmt->execute();
    }
}

function noMeGusta($usuario_id, $cita_id)
{
    $pdo = conectar();

    // Verificar puntuación actual
    $stmt = $pdo->prepare("SELECT usuario_id, cita_id, puntuacion FROM puntuaciones 
                            WHERE usuario_id = :usuario_id AND cita_id = :cita_id");

    // Vincular
    $stmt->bindParam(":usuario_id", $usuario_id);
    $stmt->bindParam(":cita_id", $cita_id);

    // Ejecutar
    $stmt->execute();

    // Leer la puntuacion
    $valoracion = $stmt->fetch(PDO::FETCH_ASSOC);

    $puntuacion_actual = $valoracion['puntuacion'];

    // Determinar nueva puntuación
    if ($puntuacion_actual == '-1') {
        $nueva_puntuacion = 0;
    } else {
        $nueva_puntuacion = -1;
    }

    // Insertar o actualizar puntuación
    if ($nueva_puntuacion == 0) {

        // Prepare
        $stmt = $pdo->prepare("DELETE FROM puntuaciones WHERE usuario_id = :usuario_id AND cita_id = :cita_id");
        // Vincular
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":cita_id", $cita_id);
        // Ejecutar
        $stmt->execute();
    } else {
        // Prepare
        $stmt = $pdo->prepare("INSERT INTO puntuaciones (usuario_id, cita_id, puntuacion) 
                                    VALUES (:usuario_id, :cita_id, :nueva_puntuacion) 
                                        ON DUPLICATE KEY UPDATE puntuacion = :nueva_puntuacion");
        // Vincular
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":cita_id", $cita_id);
        $stmt->bindParam(":nueva_puntuacion", $nueva_puntuacion);
        $stmt->execute();
    }
}

function obtener_puntos_cita($cita_id)
{
    $pdo = conectar();

    // Verificar puntuación actual
    $stmt = $pdo->prepare("SELECT SUM(puntuacion) as puntuacion
                             FROM puntuaciones
                            WHERE cita_id = :cita_id");

    // Vincular
    $stmt->bindParam(":cita_id", $cita_id);

    // Ejecutar
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado['puntuacion'] > '') {
        return $resultado['puntuacion'];
    } else {
        return 0;
    }
}

function obtener_puntos_cita_usuario($usuario_id, $cita_id)
{
    $pdo = conectar();

    // Verificar puntuación actual
    $stmt = $pdo->prepare("SELECT puntuacion
                             FROM puntuaciones
                            WHERE cita_id = :cita_id
                              AND usuario_id = :usuario_id");

    // Vincular
    $stmt->bindParam(":cita_id", $cita_id);
    $stmt->bindParam(":usuario_id", $usuario_id);

    // Ejecutar
    $stmt->execute();
    if ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)) {
        return $resultado['puntuacion'];
    } else {
        return 0;
    }
}
