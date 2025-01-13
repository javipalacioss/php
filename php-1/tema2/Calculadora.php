<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>

    <!--Estilos-->
    <style>
        body {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
    $resultado = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Obtenemos los valores del formulario
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $operacion = $_POST['operacion'];

        //Realizamos la operación seleccionada
        switch ($operacion) {
            case 'sumar':
                $resultado = $numero1 + $numero2;
                break;
            case 'restar':
                $resultado = $numero1 - $numero2;
                break;
            case 'multiplicar':
                $resultado = $numero1 * $numero2;
                break;
            case 'dividir':
                $resultado = $numero2 != 0 ? $numero1 / $numero2 : 'Error: División por cero';
                break;
        }
    }
    ?>

    <h1>Calculadora</h1>
    <form method="post" action="">
        <input type="number" name="numero1" placeholder="Número 1" required>
        <input type="number" name="numero2" placeholder="Número 2" required>
        <select name="operacion">
            <option value="sumar">Sumar</option>
            <option value="restar">Restar</option>
            <option value="multiplicar">Multiplicar</option>
            <option value="dividir">Dividir</option>
        </select>
        <button type="submit">=</button>
    </form>

    
    <?php if ($resultado !== null): // Verificamos si la variable $resultado no es nula ?>
    <h2>Resultado: <?= $resultado // Mostramos el resultado de la operación ?></h2>
    <?php endif; // Fin de la condición ?>

</body>
</html>
