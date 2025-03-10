<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Array 3 - Partida dados
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <h1>Partida dados</h1>

  <p>Actualice la página para mostrar una nueva partida de dados.</p>

<?php
    // Obtenemos un número aleatorio entre 3 y 9
    define("numero", 6);

    echo "<h2>Jugador 1</h2>";

    // Guardamos los valores del Jugador 1 en el array $dados1
    //$dados1 = [];
    for ($i = 0; $i < numero; $i++) 
    {
        $dados1[] = rand(1, 6);
    }

    // Mostramos los resultados obtenidos por el Jugador 1
    echo "<p>";
    foreach ($dados1 as $dado) 
    {
        echo "<img src=\"dados/$dado.svg\" alt=\"$dado\" width=\"140\" height=\"140\">";
    }
    echo "</p>";

    echo "<h2>Jugador 2</h2>";

    // Guardamos los valores del Jugador 2 en la array $dados2
    $dados2 = [];
    for ($i = 0; $i < numero; $i++) 
    {
        $dados2[$i] = rand(1, 6);
    }

    // Mostramos los resultados obtenidos por el Jugador 2
    echo "<p>";
    foreach ($dados2 as $dado) 
    {
        echo "<img src=\"dados/$dado.svg\" alt=\"$dado\" width=\"140\" height=\"140\">";
    }
    echo "</p>";

    // En los acumuladores $gana1 $gana2 y $empate contamos cuántas partidas ha ganado cada uno
    echo " <h2>Resultado:</h2>";

    $gana1 = 0;
    $gana2 = 0;
    $empate = 0;

    for ($i = 0; $i < numero; $i++) 
    {
        // Se compara cada jugada y se suma el recuento
        switch (true) {
            case ($dados1[$i] > $dados2[$i]):
                $gana1++;
                break;
            
            case ($dados1[$i] < $dados2[$i]):
                $gana2++;
                    break;
            default:
                $empate++;
                break;
        } 
    }

    /* ALTERNATIVA CON IF ELSIF ELSE
    for ($i = 0; $i < numero; $i++) 
    {
        if ($dados1[$i] > $dados2[$i]) 
        {
            $gana1++;
        } 
        elseif ($dados1[$i] < $dados2[$i]) 
        {
            $gana2++;
        } 
        else 
        {
            $empate++;
        }
    }
*/
    // Mostramos cuántas partidas ha ganado cada uno (controlando singular/plural)
    echo "<p>El jugador 1 ha ganado <strong>$gana1</strong> ";
    echo ($gana1 != 1) ? "veces" : "vez";
    echo ", el jugador 2 ha ganado <strong>$gana2</strong> ve";
    echo ($gana2 != 1) ? "ces" : "z";
    echo " y los jugadores han empatado <strong>$empate</strong> ve";
    echo ($empate != 1) ? "ces" : "z";
    echo ".</p>";

    // Mostramos quién ha ganado la partida
    if ($gana1 > $gana2) 
    {
        echo "<p>En conjunto, ha ganado el jugador <strong>1</strong>.</p>";
    } 
    elseif ($gana1 < $gana2) 
    {
        echo "<p>En conjunto, ha ganado el jugador <strong>2</strong>.</p>";
    } else 
    {
        echo "<p>En conjunto, han empatado.</p>";
    }

?>

</body>
</html>