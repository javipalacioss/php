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

        /*******************************************
            Comparamos todas las situaciones.
            - Tres iguales
            - Dos iguales (tres posibilidades)
            - Todos diferentes
                - Primero mayor, luego desempate
                - Segundo mayor, luego desempate
                - Tercero mayor, luego desempate
        ********************************************/
        if ($num1 == $num2 && $num2== $num3) {
            // Los tres son iguales
            echo "<p>Los tres números valen $num1.</p>";
        } elseif ($num1 == $num2) {
            // Primero y segundo iguales
            if ($num1 > $num3) {
                echo "<p>Primero y segundo valen $num1, y son mayores que el tercero; que vale $num3.</p>";
            }else {
                echo "<p>Primero y segundo valen $num1, y son menores que el tercero; que vale $num3.</p>";
            }
        } elseif ($num1 == $num3) {
            // Primero y tercero iguales
            if ($num1 > $num2) {
                echo "<p>Primero y tercero valen $num1, y son mayores que el segundo; que vale $num2.</p>";
            }else {        
                echo "<p>Primero y tercero valen $num1, y son menores que el segundo; que vale $num2.</p>";
            }
        } elseif ($num2 == $num3) {
            // Segundo y tercero iguales
            if ($num1 > $num2) {
                echo "<p>Segundo y tercero valen $num2, y son mayores que el primero; que vale $num1.</p>";
            }else {        
                echo "<p>Segundo y tercero valen $num2, y son menores que el primero; que vale $num1.</p>";
            }
        } else {
            // Todos diferentes
            if ($num1 > $num2 && $num1 > $num3) {
                // El primero es el mayor
                if ($num2 > $num3) {
                    // El tercero es el menor
                    echo "<p>El primero es el mayor ($num1), luego el segundo ($num2) y el tercero es el menor ($num3).</p>";
                }else {
                    // El segundo es el menor
                    echo "<p>El primero es el mayor ($num1), luego el tercero ($num3) y el tercero es el menor ($num3).</p>";
                }
            }elseif ($num2 > $num1 && $num2 > $num3) {
                // El segundo es el mayor
                if ($num1 > $num3) {
                    // El tercero es el menor
                    echo "<p>El segundo es el mayor ($num2), luego el primero ($num1) y el tercero es el menor ($num3).</p>";
                }else {
                    // El segundo es el menor
                    echo "<p>El segundo es el mayor ($num2), luego el tercero ($num3) y el primero es el menor ($num1).</p>";
                }
            }else {
                // El tercero es el mayor
                if ($num1 > $num2) {
                    // El tercero es el menor
                    echo "<p>El tercero es el mayor ($num3), luego el primero ($num1) y el segundo es el menor ($num3).</p>";
                }else {
                    // El segundo es el menor
                    echo "<p>El tercero es el mayor ($num3), luego el segundo ($num2) y el primero es el menor ($num1).</p>";
                }
            }
        }
    }

    /*
        IMPLEMENTACIÓN SWITCH
    */
    if (isset($_POST["switch"])) {

        $num1 =$_POST['num1'];
        $num2 =$_POST['num2'];
        $num3 =$_POST['num3'];

        /************************************************************************
            Comparamos todas las situaciones, entrando por la cláusula verdadera
            - Tres iguales (default)
            - Dos iguales (3 posibilidades)
            - Todos diferentes (6 posibilidades)
        *************************************************************************/
        switch(true) {

            // Primero y segundo iguales
            case ($num1 == $num2 && $num1 > $num3):
                // Mayores que el tercero
                echo "<p>Primero y segundo valen $num1, y son mayores que el tercero; que vale $num3.</p>";
                break;
            case ($num1 == $num2 && $num3 > $num1):
                // Menores que el tercero      
                    echo "<p>Primero y segundo valen $num1, y son menores que el tercero; que vale $num3.</p>";
                    break;
            
            // Primero y tercero iguales
            case ($num1 == $num3 && $num1 > $num2):
                // Mayores que el segundo
                echo "<p>Primero y tercero valen $num1, y son mayores que el segundo; que vale $num2.</p>";
                break;
            case ($num1 == $num3 && $num2 > $num1):
                // Menores que el segundo
                echo "<p>Primero y tercero valen $num1, y son menores que el segundo; que vale $num2.</p>";
                break;
            
            // Segundo y tercero iguales    
            case ($num2 == $num3 && $num2 > $num1):
                // Mayores que el primero
                echo "<p>Segundo y tercero valen $num2, y son mayores que el primero; que vale $num1.</p>";
                break;
            case ($num2 == $num3 && $num1 > $num2):
                // Menores que el primero
                echo "<p>Segundo y tercero valen $num2, y son menores que el primero; que vale $num1.</p>";
                break;

            // Todos diferentes
            case ($num1 > $num2 && $num2 > $num3):
                echo "<p>El primero es el mayor ($num1), luego el segundo ($num2) y el tercero es el menor ($num3).</p>";
                break;
            case ($num1 > $num3 && $num3 > $num2):
                echo "<p>El primero es el mayor ($num1), luego el tercero ($num3) y el segundo es el menor ($num3).</p>";
                break;
            case ($num2 > $num1 && $num1 > $num3):
                echo "<p>El segundo es el mayor ($num2), luego el primero ($num1) y el tercero es el menor ($num3).</p>";
                break;
            case ($num2 > $num3 && $num3 > $num1):
               echo "<p>El segundo es el mayor ($num2), luego el tercero ($num3) y el primero es el menor ($num1).</p>";
               break;
            case ($num3 > $num1 && $num1 > $num2):
               echo "<p>El tercero es el mayor ($num3), luego el primero ($num1) y el segundo es el menor ($num3).</p>";
               break;
            case ($num3 > $num2 && $num2 > $num1):
                        echo "<p>El tercero es el mayor ($num3), luego el segundo ($num2) y el primero es el menor ($num1).</p>";
                        break;

            default:
                // Los tres son iguales
                echo "<p>Los tres números valen $num1.</p>";
                break;
        }
    }
    ?>

</body>

</html>