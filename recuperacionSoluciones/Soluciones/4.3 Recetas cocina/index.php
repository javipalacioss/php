<?php
require_once('funciones.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['login'])) {
        // Eliminar producto
        header('Location: login.php');
        exit();
    }

    if (isset($_POST['registrar'])) {
        // Eliminar producto
        header('Location: registro.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Recetario</title>
</head>

<body>
    <h1>Recetario</h1>
    <?php
    $fav = recetafavorita();
    mostrarReceta($fav);
    ?>
    <form action="" method="POST">
        <!-- Botones para editar y eliminar -->
        <button type="submit" name="login" >Log in</button>
        <button type="submit" name="registrar" >Registrarse</button>
    </form>
</body>

</html>