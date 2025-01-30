<?php
session_start();

// verificar si existe el array del tesoro en la sesión
if (!isset($_SESSION['tesoro'])) {
    $_SESSION['tesoro'] = []; // inicializar el tesoro si no existe
}

// funcion para actualizar la cookie de ultima modificacion
function actualizar_cookie() {
    setcookie('ultima_actualizacion', time(), time() + 7200); // expira en 2 horas
}

// verificar si la cookie ha expirado
$mensaje_cookie = "";
if (isset($_COOKIE['ultima_actualizacion'])) {
    $tiempo_transcurrido = time() - $_COOKIE['ultima_actualizacion'];
    if ($tiempo_transcurrido > 7200) {
        $mensaje_cookie = "¡atencion! el tesoro no se ha actualizado en mas de 2 horas.";
    }
} else {
    $mensaje_cookie = "no se han realizado actualizaciones recientes en el tesoro.";
}

// anadir un nuevo tesoro
if (isset($_POST['descripcion']) && isset($_POST['valor']) && isset($_POST['procedencia'])) {
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];
    $procedencia = $_POST['procedencia'];

    // crear un nuevo tesoro como un array
    $nuevo_tesoro = ['descripcion' => $descripcion, 'valor' => $valor, 'procedencia' => $procedencia];
    $_SESSION['tesoro'][] = $nuevo_tesoro; // guardarlo en la sesión

    actualizar_cookie(); // actualizar la cookie
}

// exportar el tesoro a un archivo
if (isset($_POST['exportar'])) {
    $archivo = fopen('tesoro.txt', 'w');
    fwrite($archivo, serialize($_SESSION['tesoro']));
    fclose($archivo);
    echo "el tesoro ha sido exportado correctamente.<br>";
}

// importar el tesoro desde un archivo
if (isset($_POST['importar'])) {
    if (file_exists('tesoro.txt')) {
        $contenido = file_get_contents('tesoro.txt');
        $_SESSION['tesoro'] = unserialize($contenido);
        echo "el tesoro ha sido importado correctamente.<br>";
    } else {
        echo "no existe ningun archivo para importar.<br>";
    }
}

// vaciar el tesoro
if (isset($_POST['vaciar'])) {
    $_SESSION['tesoro'] = [];
    actualizar_cookie(); // actualizar la cookie
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tesoro del Castillo</title>
</head>
<body>
    <h1>Gestion del Tesoro del Castillo</h1>

    <!-- mostrar el mensaje de la cookie -->
    <?php if ($mensaje_cookie): ?>
        <p style="color: red;"><?php echo $mensaje_cookie; ?></p>
    <?php endif; ?>

    <h2>Anadir un Tesoro</h2>
    <form method="post" action="">
        <label for="descripcion">Descripcion:</label>
        <input type="text" id="descripcion" name="descripcion" required>
        <label for="valor">Valor (en monedas de oro):</label>
        <input type="number" id="valor" name="valor" required>
        <label for="procedencia">Procedencia:</label>
        <input type="text" id="procedencia" name="procedencia" required>
        <button type="submit">Guardar Tesoro</button>
    </form>

    <h2>Acciones</h2>
    <form method="post" action="">
        <button type="submit" name="exportar">Exportar Tesoro</button>
        <button type="submit" name="importar">Importar Tesoro</button>
        <button type="submit" name="vaciar">Vaciar Tesoro</button>
    </form>

    <h2>Lista del Tesoro</h2>
    <ul>
        <?php foreach ($_SESSION['tesoro'] as $tesoro): ?>
            <li>
                <?php echo htmlspecialchars($tesoro['descripcion']); ?> - 
                <?php echo htmlspecialchars($tesoro['valor']); ?> monedas de oro - 
                <?php echo htmlspecialchars($tesoro['procedencia']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>