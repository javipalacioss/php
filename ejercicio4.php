<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>

<body>
    <form method="POST">
        <label for="idiomaOrigen">Idioma Origen:</label>
        <select id="idiomaOrigen" name="idiomaOrigen">
            <option value="es">Español</option>
            <option value="en">Inglés</option>
            <option value="de">Alemán</option>
            <option value="fr">Francés</option>
        </select>
        
        <label for="idiomaDestino">Idioma Destino:</label>
        <select id="idiomaDestino" name="idiomaDestino">
            <option value="es">Español</option>
            <option value="en">Inglés</option>
            <option value="de">Alemán</option>
            <option value="fr">Francés</option>
        </select>

        <button type="submit">Traducir</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $meses = [
            "es" => ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            "en" => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "de" => ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
            "fr" => ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"]
        ];

        $origen = $_POST['idiomaOrigen'];
        $destino = $_POST['idiomaDestino'];

        echo "<h3>Traducción de meses de " . ($origen == 'es' ? "Español" : ($origen == 'en' ? "Inglés" : ($origen == 'de' ? "Alemán" : "Francés"))) . " a " . ($destino == 'es' ? "Español" : ($destino == 'en' ? "Inglés" : ($destino == 'de' ? "Alemán" : "Francés"))) . ":</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Mes en $origen</th><th>Mes en $destino</th></tr>";

        foreach ($meses[$origen] as $index => $mes) {
            echo "<tr><td>$mes</td><td>{$meses[$destino][$index]}</td></tr>";
        }
        echo "</table>";
    }
    ?>
</body>

</html>
