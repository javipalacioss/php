<?php
// inicia la sesion
session_start();

// si se presiona el boton para seleccionar el tema
if (isset($_POST['seleccionar_tema'])) {
    // guarda la seleccion del tema en una cookie
    $tema = $_POST['tema'];
    setcookie('tema', $tema, time() + 3600 * 24 * 30, '/'); // cookie expira en 30 dias
    $_SESSION['tema'] = $tema; // guarda en la sesion tambien
}

// si se presiona el boton reset, elimina la cookie y la sesion
if (isset($_POST['reset'])) {
    setcookie('tema', '', time() - 3600, '/'); // elimina la cookie
    unset($_SESSION['tema']); // elimina la sesion
}

// verifica si hay una cookie guardada para el tema
if (isset($_COOKIE['tema'])) {
    $_SESSION['tema'] = $_COOKIE['tema'];
}

// si no hay tema en la sesion, usa el tema por defecto (claro)
if (!isset($_SESSION['tema'])) {
    $_SESSION['tema'] = 'claro'; // tema por defecto
}

// define las clases CSS para el tema claro y oscuro
$tema_css = ($_SESSION['tema'] == 'oscuro') ? 'oscuro' : 'claro';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Tema</title>
    <style>
        /* tema claro */
        .claro {
            background-color: #ffffff;
            color: #000000;
        }

        /* tema oscuro */
        .oscuro {
            background-color: #333333;
            color: #ffffff;
        }
    </style>
</head>
<body class="<?php echo $tema_css; ?>">

    <h1>Selecciona el tema</h1>

    <!-- formulario para seleccionar el tema -->
    <form method="post">
        <label for="tema">Selecciona el tema: </label>
        <select name="tema" id="tema">
            <option value="claro" <?php if ($_SESSION['tema'] == 'claro') echo 'selected'; ?>>Claro</option>
            <option value="oscuro" <?php if ($_SESSION['tema'] == 'oscuro') echo 'selected'; ?>>Oscuro</option>
        </select>
        <button type="submit" name="seleccionar_tema">Aplicar Tema</button>
    </form>

    <!-- boton para resetear la sesion -->
    <form method="post">
        <button type="submit" name="reset">Resetear Tema</button>
    </form>

    <p>El tema actual es: <?php echo ($_SESSION['tema'] == 'claro') ? 'Claro' : 'Oscuro'; ?></p>

</body>
</html>
