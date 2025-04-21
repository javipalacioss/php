<?php
require_once 'funciones.php';
requerir_login();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Botón de volver
    if (isset($_POST['volver'])) {
        header("Location: principal.php");
        exit();
    }

    // Botón de guardar cita
    if (isset($_POST['guardar'])) {
        $texto = $_POST['texto'];
        $autor = $_POST['autor'];

        // Insertar cita
        if (!empty($texto) && !empty($autor)) {
            if (crear_cita($texto, $autor, $_SESSION['usuario_id'])) {
                header("Location: principal.php");
                exit();
            } else {
                $_SESSION['mensaje'] = "Error al guardar la cita";
            }
        } else {
            $_SESSION['mensaje'] = "Los campos deben estar rellenos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva Cita</title>
</head>

<body>
    <form method="POST">
        <h2>Nueva Cita</h2>

        <label for="texto">Texto:</label><br>
        <textarea
            name="texto"
            placeholder="Texto de la cita"
            rows="4"
            required value="
            <?php
                if (isset($texto)) {
                    echo $texto;
                }
            ?>">
        </textarea><br>

        <label for="autor">Autor:</label><br>
        <input
            type="text"
            name="autor"
            placeholder="Autor"
            required
            value="
            <?php
                if (isset($autor)) {
                    echo $autor;
                }
            ?>"><br><br>

        <button type="submit" name="guardar">Guardar Cita</button>
        <button type="submit" name="volver">Volver</button>
    </form>

    <?php if (isset($_SESSION['Mensaje'])) {
        // Muestro mensaje 
        echo $_SESSION['Mensaje'];
        // Borro mensaje
        unset($_SESSION['Mensaje']);
    }
    ?>
</body>

</html>