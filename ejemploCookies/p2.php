<?php
if (isset($_COOKIE["usuario"])){
    $nombre = $_COOKIE["usuario"];
    setcookie("usuario", $nombre, time() + 5);
} else {
    header("Location: p2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>p2</title>
</head>

<body>
 

    <?php
    if (!empty($nombre)){
        echo "<p>La cookie se llama: " . $nombre . "</p>";
    }
    ?>

    <h1>Hola, <?php echo $nombre; ?></h1>
    <p>Bienvenido a la página p2.php</p>
</body>

</html>