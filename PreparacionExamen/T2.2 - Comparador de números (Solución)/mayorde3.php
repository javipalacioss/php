<!DOCTYPE html>
<html lang="es">

<style>
    label {
        display: inline-block;
        width: 120px;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Comparador</title>
</head>

<body>

    <!-- EJERCICIO 1 -->
    <h1>Ejercicio 1</h1>
    <p>Realiza un comparador de 3 números: </p>
    <h3>Solución:</h3>

    <!-- Formulario -->
    <form method="post" action="">
        <label for="num1">Primer número:</label>
        <input type="number" id="num1" name="num1" required>
        <br>
        <label for="num2">Segundo número:</label>
        <input type="number" id="num2" name="num2" required>
        <br>
        <label for="num3">Tercer número:</label>
        <input type="number" id="num3" name="num3" required>
        <br><br>
        <input type="submit" id="if" name="if" value="Comparar IF">
        <input type="submit" id="switch" name="switch" value="Comparar SWITCH">
    </form>

    <?php
    /*
        IMPLEMENTACIÓN IF
    */
    if (isset($_POST["if"])) {

        $num1 =$_POST['num1'];
        $num2 =$_POST['num2'];
        $num3 =$_POST['num3'];

        // Hallamos el mayor, comparando cada uno con el primero.
        $mayor = $num1;

        if ($num2 > $mayor)
            $mayor = $num2;
        if ($num3 > $mayor)
            $mayor = $num3;

        // Se imprime la solución.
        echo "<p>El mayor es $mayor.</p>";
    }

    /*
        IMPLEMENTACIÓN IF
    */
    if (isset($_POST["switch"])) {

        $num1 =$_POST['num1'];
        $num2 =$_POST['num2'];
        $num3 =$_POST['num3'];

        // Hallamos el mayor, entrando por la condicion verdadera
        switch(true) {
            case $num1 > $num2 && $num1 > $num3:
                $mayor = $num1;
                break;
            case $num2 > $num1 && $num2 > $num3:
                $mayor = $num2;
                break;
            case $num3 > $num1 && $num3 > $num2:
                $mayor = $num3;
                break;
            default:
                $mayor = $num1; // En caso de que dos o más números sean iguales y los mayores.
        }

        // Se imprime la solución.
        echo "<p>El mayor es $mayor.</p>";
    }

    ?>
</body>

</html>