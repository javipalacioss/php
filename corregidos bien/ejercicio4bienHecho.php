<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diccionario de Meses</title>
</head>
<body>
    <h1>Diccionario de Meses</h1>
    
    <form method="post">
        <label for="idioma_origen">Idioma origen:</label>
        <select name="idioma_origen" id="idioma_origen">
            <option value="español">Español</option>
        </select>
        
        <label for="idioma_destino">Idioma destino:</label>
        <select name="idioma_destino" id="idioma_destino">
            <option value="ingles">Inglés</option>
            <option value="frances">Francés</option>
            <option value="aleman">Alemán</option>
        </select>
        
        <button type="submit">Traducir</button>
    </form>

    <?php
    // Definir los meses en español y sus traducciones
    $meses = [
        'enero' => ['ingles' => 'January', 'frances' => 'Janvier', 'aleman' => 'Januar'],
        'febrero' => ['ingles' => 'February', 'frances' => 'Février', 'aleman' => 'Februar'],
        'marzo' => ['ingles' => 'March', 'frances' => 'Mars', 'aleman' => 'März'],
        'abril' => ['ingles' => 'April', 'frances' => 'Avril', 'aleman' => 'April'],
        'mayo' => ['ingles' => 'May', 'frances' => 'Mai', 'aleman' => 'Mai'],
        'junio' => ['ingles' => 'June', 'frances' => 'Juin', 'aleman' => 'Juni'],
        'julio' => ['ingles' => 'July', 'frances' => 'Juillet', 'aleman' => 'Juli'],
        'agosto' => ['ingles' => 'August', 'frances' => 'Août', 'aleman' => 'August'],
        'septiembre' => ['ingles' => 'September', 'frances' => 'Septembre', 'aleman' => 'September'],
        'octubre' => ['ingles' => 'October', 'frances' => 'Octobre', 'aleman' => 'Oktober'],
        'noviembre' => ['ingles' => 'November', 'frances' => 'Novembre', 'aleman' => 'November'],
        'diciembre' => ['ingles' => 'December', 'frances' => 'Décembre', 'aleman' => 'Dezember'],
    ];

    // Comprobar si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idioma_destino = $_POST['idioma_destino'];

        echo "<h2>Meses en Español y su traducción en " . $idioma_destino . "</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Mes (Español)</th><th>Mes ($idioma_destino)</th></tr>";
        
        // Mostrar la tabla con las traducciones
        foreach ($meses as $mes => $traducciones) {
            echo "<tr>";
            echo "<td>" . $mes . "</td>"; // Mes en español
            echo "<td>" . $traducciones[$idioma_destino] . "</td>"; // Mes en el idioma destino
            echo "</tr>";
        }
        
        echo "</table>";
    }
    ?>
</body>
</html>