<?php

function tirar (int $cant, string $tipo):array
{
    if ($tipo == "d") {
        return tiraDados($cant, $tipo);
    }else {
        # code...
    }

}
/**
 * laksdfj
 *  
 */
function tiraDados(int $cantidad): array
{
    // Se asignan dados aleatoriamente
    for ($i = 0; $i < $cantidad; $i++) {
        $dados[] = rand(1, 6);
    }
    return $dados;
}

/**
 * laksdfj
 *  
 */
function tiraCartas(int $cantidad): array
{
    // Se asignan dados aleatoriamente
    for ($i = 0; $i < $cantidad; $i++) {
        $dados[] = rand(1, 6);
    }
    return $dados;
}

/**
 * Imprime gráficamente los dados de los jugadores de una partida.
 * 
 * @param array $jugadores Array multidimensional [jugador][numTirada]
 * @param string $objeto Pueden ser cartas (c) o dados (d)
 */
function mostrar(array $jugadores, string $objeto):void
{
    
    switch ($objeto) {
        case 'd':
            echo "<p>";
            foreach ($jugadores as $nombreJugador => $tiradas) {
                // Para cada jugador
                echo "<p>Tirada de $nombreJugador :</p>";
                echo "<p>";
                foreach ($tiradas as $dado) {
                    // Para cada jugada del jugador
                    echo "<img src=\"dados/$dado.svg\" alt=\"$dado\" width=\"140\" height=\"140\">";
                }
                echo "</p>";
            }
            echo "</p>";
            break;

        case 'c':
            foreach ($jugadores as $nombreJugador => $tiradas) {
                // Para cada jugador
                echo "<p>Tirada de $nombreJugador:</p>";
                echo "<p>";
                foreach ($tiradas as $carta) {
                    // Para cada jugada del jugador
                    echo "<img src=\"dados/c$carta.svg\" alt=\"$carta\" width=\"140\" height=\"100\">";
                }
                echo "</p>";
            }
            echo "</p>";
            break;
            break;
        default:
            echo "<p>Tipo de objeto no reconocido (carta/dado)";
            break;
    }
}

/**  
 *   Simula hace el recuento de dados de los jugadores en el array (actualmente 2), y se informan
 *   los resultados. 
 *   @param array $jugadores La primera dimensión es el id del jugador; la segunda, el número de la tirada.
 *   @param array $resultados La posición 0, guarda el número de empates; la posición 1, veces que gana el jugador1;
 *   la posición 2, veces que gana el jugador2. 
 */
function partidaDados(array $jugadores, array &$resultados): void
{
    $jugador1 = reset($jugadores);
    $jugador2 = next($jugadores);
    $longitud = count($jugador1);

    // Se compara cada jugada y se suma el recuento

    for ($i = 0; $i < $longitud; $i++) {

        switch (true) {

            case ($jugador1[$i] > $jugador2[$i]):
                $resultados[1]++;
                break;

            case ($jugador1[$i] < $jugador2[$i]):
                $resultados[2]++;
                break;

            default:
                $resultados[0]++;
                break;
        }
    }
}

/* 
*   MOSTRAR GANADOR 
*   
*/
function mostrarGanador(array $jugadores, array $resultados): void
{
    // Obtener las claves de los jugadores
    $jugadores_keys = array_keys($jugadores);

    echo "<b><u>";

    // Se calcula el ganador de la partida y se devuelve
    switch (true) {
        case $resultados[1] > $resultados[2]:
            echo "<p>En conjunto, ha ganado $jugadores_keys[0].</p>";
            break;

        case $resultados[2] > $resultados[1]:
            echo "<p>En conjunto, ha ganado $jugadores_keys[1].</p>";
            break;

        default:
            echo "<p>En conjunto, han empatado.</p>";
            break;
    }
    echo "</u></b>";
}

/* 
*   MOSTRAR RONDAS 
*   
*/
function mostrarRondas(array $jugadores, array $resultados): void
{
    // Obtener las claves de los jugadores
    $jugadores_keys = array_keys($jugadores);

    // Recuento empates
    if ($resultados[0] == 1) {
        echo "<p>Los jugadores han empatado 1 vez.</p>";
    } else {
        echo "<p>Los jugadores han empatado $resultados[0] veces.</p>";
    }

    // Recuento victorias jugador 1
    if ($resultados[1] == 1) {
        echo "<p>$jugadores_keys[0] ha ganado 1 vez.</p>";
    } else {
        echo "<p>$jugadores_keys[0] ha ganado $resultados[1] veces.</p>";
    }

    // Recuento victorias jugador 2
    if ($resultados[2] == 1) {
        echo "<p>$jugadores_keys[1] ha ganado 1 vez.</p>";
    } else {
        echo "<p>$jugadores_keys[1] ha ganado $resultados[2] veces.</p>";
    }
}
