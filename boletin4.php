<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de un triangulo</title>
    <style>
        body {
            /*fondo claro */
            background-color: #f0f8ff; 
            /*texto oscuro */
            color: #2c3e50;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>CALCULAR ÁREA TRIÁNGULO</h1>

<form method="post">
    <label for="base">Escribe la base:</label>
    <input type="number" id="base" name="base" required>
    <br><br>
    
    <label for="altura">Escribe la altura:</label>
    <input type="number" id="altura" name="altura" required>
    <br><br>
    
    <input type="submit" value="Calcular area">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Obtener valores formulario
    $base = $_POST['base'];
    $altura = $_POST['altura'];

    //Verificar q los valores mayores que 0
    if ($base > 0 && $altura > 0) {
        // Calcular el area del triangulo
        $area = ($base * $altura) / 2;

        //Mostrar el resultado
        echo "<br> El área del triángulo cuya base es " . $base . " y altura " . $altura . " es: " . $area ;
    } else {
        echo "La base y la altura deben ser mayores que 0.";
    }
}
?>

</body>
</html>
