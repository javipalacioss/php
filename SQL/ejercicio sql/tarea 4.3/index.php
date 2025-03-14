<?php
//session_start();

require_once('funciones.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset(['login'])) {
        header('Location: login.php');
        exit();
    }

    if (isset(['registrar'])) {
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
    <!-- MOSTRAR LA RECETA QUE MAS VECES SEA FAVORITA -->
    <?php
    //recuperar receta favorita
    $fav = recetafavorita();

    if ($fav) {
    //mostrar receta
    echo '<h3>Receta favorita: ' . $fav['titulo'] . '. Seleccionada favorita ' . $fav['veces'];
    } else {
        echo 'Aun no hay recetas';
    }


    ?>
    
    <form action="" method="POST">
        <!-- Botones para editar y eliminar -->
        <button type="submit" name="login" >Log in</button>
        <button type="submit" name="registrar" >Registrarse</button>
    </form>
</body>

</html>