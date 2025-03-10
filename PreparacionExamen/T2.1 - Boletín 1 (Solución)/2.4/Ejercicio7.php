<!DOCTYPE html>
<html lang="es">
<style>
    td {
        width: 200px;
        text-align: center;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Ejercicios</title>
</head>

<body>

    <!-- EJERCICIO 7 -->
    <h1>Ejercicio 7</h1>
    <p> Escribe otro ejercicio que le asigne una serie de valores a las siguientes variables y muestre el nombre de la
        variable,
        el valor y el tipo de datos al que pertenece. A continuación se le deberá forzar el tipo a lo que se indique,
        y mostrar el tipo nuevo al que pertenece, el nombre de la variable y su valor. Usar las funciones settype y
        gettype.
    <table>
        <tr>
            <th>Variable</th>
            <th>Valor</th>
            <th>Nuevo Tipo</th>
        </tr>
        <tr>
            <td>a1</td>
            <td>
                347</td>
            <td>double</td>
        </tr>
        <tr>
            <td>a2</td>
            <td>2147483647</td>
            <td>double</td>
        </tr>
        <tr>
            <td>a3</td>
            <td>-2147483647</td>
            <td>double</td>
        </tr>
        <tr>
            <td>a4</td>
            <td>23.7678</td>
            <td>integer</td>
        </tr>
        <tr>
            <td>a5</td>
            <td>3.1416</td>
            <td>integer</td>
        </tr>
        <tr>
            <td>a6</td>
            <td>"347"</td>
            <td>double</td>
        </tr>
        <tr>
            <td>a7</td>
            <td>"3.1416"</td>
            <td>integer</td>
        </tr>
        <tr>
            <td>a8</td>
            <td>"Solo literal"</td>
            <td>double</td>
        </tr>
        <tr>
            <td>a9</td>
            <td>"12.3 Literal con número"</td>
            <td>integer</td>
        </tr>
    </table>
    </p>
    <h3>Solución:</h3>

    <?php
    // Definimos las variables y asignamos valores
    $a1 = 347;
    $a2 = 2147483647;
    $a3 = -2147483647;
    $a4 = 23.7678;
    $a5 = 3.1416;
    $a6 = "347";
    $a7 = "3.1416";
    $a8 = "Solo literal";
    $a9 = "12.3 Literal con número";

    // Establecemos tipos nuevos
    settype($a1, "double");
    settype($a2, "double");
    settype($a3, "double");
    settype($a4, "integer");
    settype($a5, "integer");
    settype($a6, "double");
    settype($a7, "integer");
    settype($a8, "double");
    settype($a9, "integer");

    // Imprimimos variables y tipos
    echo"
    <table>
        <tr>
            <th>Variable</th>
            <th>Nuevo Valor</th>
        </tr>
        <tr>
            <td>a1</td>
            <td>$a1</td>
        </tr>
        <tr>
            <td>a2</td>
            <td>$a2</td>
        </tr>
        <tr>
            <td>a3</td>
            <td>$a3</td>
        </tr>
        <tr>
            <td>a4</td>
            <td>$a4</td>
        </tr>
        <tr>
            <td>a5</td>
            <td>$a5</td>
        </tr>
        <tr>
            <td>a6</td>
            <td>$a6</td>
        </tr>
        <tr>
            <td>a7</td>
            <td>$a7</td>
        </tr>
        <tr>
            <td>a8</td>
            <td>$a8</td>
        </tr>
        <tr>
            <td>a9</td>
            <td>$a9</td>
        </tr>
    </table>"

    ?>
</body>

</html>