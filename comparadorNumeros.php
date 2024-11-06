<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparador Número</title>
</head>
<body>

<h1>Comparar Tres Números</h1>

<form method="post">
    <label for="numA">Número A:</label>
    <input type="number" id="numA" name="numA" required>

    <br>
    <br>

    <label for="numB">Número B:</label>
    <input type="number" id="numB" name="numB" required>

    <br>
    <br>

    <label for="numC">Número C:</label>
    <input type="number" id="numC" name="numC" required>

    <br>
    <br>

    <input type="submit" value="Comparar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los números del formulario
    $numA = $_POST['numA'];
    $numB = $_POST['numB'];
    $numC = $_POST['numC'];

    //inicializamos la variable mayor
    $mayor = '';

    //Comparar numeros
    if ($numA === $numB && $numB === $numC) {
        echo "Todos los números son iguales<br>";
        $mayor = 'igual';
    } elseif ($numA > $numB && $numA > $numC) {
        echo "A es mayor que B y C.<br>";
        $mayor = 'A';
    } elseif ($numB > $numA && $numB > $numC) {
        echo "B es mayor que A y C.<br>";
        $mayor = 'B';
    } elseif ($numC > $numA && $numC > $numB) {
        echo "C es mayor que A y B.<br>";
        $mayor = 'C';
    } else {
        echo "Hay números iguales.<br>";
        $mayor = 'igual';
    }

    //switch para mostrar resultado
    switch ($mayor) {
        case 'A':
            echo "Confirmacion: A es el mayor";
            break;
        case 'B':
            echo "Confirmacion: B es el mayor";
            break;
        case 'C':
            echo "Confirmacion: C es el mayor";
            break;
        case 'igual':
            //no es necesario imprimir nada por pantalla
            break;
        default:
            echo "No se ha podido determinar el mayor numero";
            break;
    }
}
?>

</body>
</html>
