<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Ejercicio q - Gestos manos
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Gestos manos</h1>

  <p>Actualice la página para mostrar un nuevo dibujo.</p>

<?php
    // Creamos un array con todos los emojis disponibles
    $emojis = [128070, 128071, 128072, 128073, 128074, 128075, 128076, 128077, 128078, 128079, 128080, 128133, 128170, 128400, 128405, 128406, 128588, 128591, 129295, 129304, 129305, 129306, 129307, 129308, 129310, 129311, 129330];

    // Saco un elemento con arrar_rand
    $emoji = array_rand ($emojis);

    // También se puede usar un número aleatorio entre 0 y uno menos que el número de elementos
    //$emoji = rand(0, count($emojis) - 1);

    // Sacamos la piel como un número aleatorio
    $piel = rand(127995, 127999);

    //echo "<p style=\"font-size: 8em\">&#$emojis[$emoji];&#$piel;</p>";

?>

<!-- También se puede hacer en HTML -->
<p style="font-size: 8em">&#<?php echo $emojis[$emoji]?>;&#<?php echo $piel?>;</p>

</body>
</html>
