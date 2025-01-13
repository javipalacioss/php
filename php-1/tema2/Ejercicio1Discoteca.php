<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <?php
    /* Ejercicio 1 - Generar un código de color RGB aleatorio */
    $rojo = rand(0, 255);
    $verde = rand(0, 255);
    $azul = rand(0, 255);
    ?>
    <style>
        body {
            background-color: rgb(<?= $rojo ?>, <?= $verde ?>, <?= $azul ?>);
            transition: background-color 2s ;
        }
    </style>
</head>
<body>
    <h1>Código de Color RGB: rgb(<?= $rojo ?>, <?= $verde ?>, <?= $azul ?>)</h1>
    <script>
        // Función para cambiar el color de fondo
        function cambiarFondo() {
            const rojo = Math.floor(Math.random() * 256);
            const verde = Math.floor(Math.random() * 256);
            const azul = Math.floor(Math.random() * 256);
            document.body.style.backgroundColor = `rgb(${rojo}, ${verde}, ${azul})`;
            document.querySelector('h1').textContent = `Código de Color RGB: rgb(${rojo}, ${verde}, ${azul})`;
        }

        // Cambiar el fondo cada 2 segundos
        setInterval(cambiarFondo, 2000);
    </script>
</body>
</html>
