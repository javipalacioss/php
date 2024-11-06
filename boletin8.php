<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salario</title>
    <style>
        body {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Calcular Salario</h1>

<form method="post">
    <label for="salario">Salario:</label>
    <input type="number" id="salario" name="salario" required>
    <br><br>
    
    <label for="impuesto">Impuesto (%):</label>
    <input type="number" id="impuesto" name="impuesto" required>
    <br><br>
    
    <input type="submit" name="mostrar" value="Mostrar salario sin impuesto">
    <input type="submit" name="mostrar" value="Mostrar salario con impuesto descontado">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Obtener valores formulario
    $salario = $_POST['salario'];
    $impuesto = $_POST['impuesto'];

    //Calcular impuesto y salario final
    $descuento = ($salario * $impuesto) / 100;
    $resultado = $salario - $descuento;

    //Mostrar la info segun comportamiento
    if ($_POST['mostrar'] == "Mostrar salario sin impuesto") {
        echo "<br> El salario sin descontar el impuesto: " . $salario . "€";
    } elseif ($_POST['mostrar'] == "Mostrar salario con impuesto descontado") {
        echo "<br> El salario \"$salario\" una vez descontado: " . $resultado . "€";
    }
}
?>

</body>
</html>
