<?php
//Inciamos la sesion

//sesion_ID('123')
session_name("misesion");
session_start();

//Comprovamos que existe una sesion
if (!isset($_SESSION['veces'])) {
    //No existe
   $_SESSION['veces'] = 1;
   echo "La sesion se llama: " . session_name();
} else{
    //Si existe lo actualizo
    $_SESSION['veces']++;
}

if($_SESSION['veces'] == 5){
    session_destroy();
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de accesos</title>
</head>
<body>
    <h1>Bienvenido a la página de contador de accesos</h1>
    <p>Has visitado esta pagina
        <?php echo $_SESSION['veces']; ?> 
        veces!</p>
        <p>Recarga la página para aumentar el contador</p>
</body>
</html>