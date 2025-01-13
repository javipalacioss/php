<!DOCTYPE html>
<html lang="es">
<style>
    /* Estilo de bloque para las etiquetas */
    label {
        display: inline-block;
        width: 100px;
    }

</style>

<head>
    <meta charset="UTF-8">
    <title>Salario</title>
</head>

<body>

    <!-- EJERCICIO 8 -->
    <h1>Ejercicio 8</h1>
    <p> Escribe un programa salario.php que calcule el salario de un trabajador una vez que se le descuente el impuesto.
        <br>Se usarán las variables: $salario, $impuesto, que vendrá dada en porcentaje.
        <br>Se deberá descontar el porcentaje del impuesto por ciento a $salario y se guardará en la variable $resultado. Después deberá mostrarse una de la siguiente información:
        <br>“El salario sin descontar el impuesto: xxxxx”
        <br>“El salario 'xxxx' una vez descontado: zzzz”
        <br>Deberán mostrarse las comillas, y el título de la página será: Salario.
        <br>Los datos del salario y del impuesto se introducirán mediante un formulario.
        <br>Habrá 2 botones, uno para que muestre la primera información y otro para que te muestre la segunda.
    
    </p>
    <h3>Solución:</h3>
    
    <form method="post" action="">
        <label for="salario">Salario (€):</label>
        <input type="number" id="salario" name="salario" required>
        <br>
        <label for="impuesto">Impuesto (%):</label>
        <input type="number" id="impuesto" name="impuesto" min="0" max="100" required>
        <br><br>
        <input type="submit" name="Calcular" value="Calcular Impuesto">

    </form>

    <?php

    if(isset($_POST["Calcular"]))
    {
        // Declaración de variables y lectura de valores
        $salario    = $_POST['salario'];
        $impuesto   = $_POST['impuesto'];

        // Cálculo del resultado
        $resultado  = $salario - ($salario / 100 * $impuesto);

        // Se muestra el resultado.
        echo "<br>";
        echo "<p>El salario sin descontar el impuesto: $salario €.</p>";
        echo "<p>El salario $salario una vez descontado el $impuesto % es $resultado €.</p>";
}       

    ?>
</body>

</html>