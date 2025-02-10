<?php
require_once('clases.php');
//Antes me funcionaba el boton de ir al foro y esta bien hecho al igual que iniciar sesion, al intentar hacer la lo del tema pues no fuinciona nada, yo lo siento pero es que mas de mi no puedo
session_start();

// Comprobar si se envió el formulario para cambiar el tema
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['color'])) {

    // Si se ha pulsado el botón del tema, y además, está relleno (siempre está relleno porque es una lista)
    if (isset($_POST['color'])) {
        $color = $_POST['color'];
         // Guardar el tema seleccionado en la sesión
         $_SESSION['color'] = $color;
        // Guardar el tema seleccionado en una cookie
        setcookie('color', $color, time() + (5));

    }
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Principal</title>
    <style>
         /* Estilo sin tema */
    body{
        
       
    }

    /* Estilo para tema claro (blanco) */
    body.white{
        background-color: rgb(255, 255, 255);
        color: white;
    }

        /* Estilo para tema claro (verde) */
        body.green {
            background-color:rgb(0, 255, 21);
            color: #1b5e20;
        }

        /* Estilo para tema oscuro (azul) */
        body.blue {
            background-color: #0d47a1;
            color:rgb(0, 140, 255);
        }

         /* Estilo para tema oscuro (rojo) */
         body.red {
            background-color:rgb(255, 0, 0);
            color:rgb(255, 0, 0);
        }


    </style>
</head>
<body>
    <h1>Bienvenido, <?php
        
    
?>
    </h1>
    <form method="POST">
        <button name="irForo">Ir al foro</button>
        <?php
        //funcionalidad para ir al foro
        if(isset($_POST['irForo'])){
            header('Location: foro.php');
            exit();
        }
        ?>

        <label for="color">Color del tema:</label>
        <select name="color" id="color">
            <option value="white" class="white">Blanco</option>
            <option value="green" class="green">Verde</option>
            <option value="blue" class="blue">Azul</option>
            <option value="red" class="red">Rojo</option>
        </select>

        <button name="colorear">Seleccionar color</button>
        <button name="cerrar_sesion">Cerrar sesión</button>
        <?php
        //funcionalidad para cerrar sesion
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cerrar_sesion']))
        {
        // Borrar variables
        session_unset();
        // Destruir sesión
        session_destroy();
        // Volver atrás
        header('Location: index.php');
        exit();
        }
        ?>
    </form>
</body>
</html>
