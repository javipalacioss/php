
<!DOCTYPE html>
<html>
<head>
    <title>Foro</title>
    <style>
    body {
      
    }
    </style>
</head>
<body>
    <h2>Foro</h2>
    <div id="content">
        <?php 
        //MOSTRAR CONTENIDO
        ?>
    </div>
    <form method="POST">
        <textarea name="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea><br>
        <button type="submit" name="enviar">Enviar</button>
    </form>
    <form method="POST">
        <button type="submit" name="volver">Volver</button>
        <?php
         if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['volver']))
         {
         // Volver atrás
         header('Location: index.php');
         exit();
         }
         ?>
        ?>
    </form>

</body>
</html>
