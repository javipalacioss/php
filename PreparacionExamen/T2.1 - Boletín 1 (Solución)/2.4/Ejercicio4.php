<!DOCTYPE html>
<html lang="es">

<style>
    /* Estilo de bloque para las etiquetas */
    label {
        display: inline-block;
        width: 80px;
    }

    /* Estilo de texto rojo */
    .textoError {
        color: red;
    }

    /* Estilo de fondo verde */
    .fondoExito {
        color: white;
        background-color: green;
    }
</style>

<head>
    <meta charset="UTF-8">
    <title>Área de un triángulo</title>
</head>

<body>

    <!-- EJERCICIO 3 -->
    <h1>Ejercicio 4</h1>
    <p> Realiza otro ejercicio que para 2 variables, $base y $altura, asigne a otra variable, $area, el área del
        triángulo. A continuación te deberá mostrar el siguiente mensaje:
        El área del triángulo cuya base es $base y altura $altura es: $area.
        Los datos de entrada se introducirán a mediante un formulario. Habrá que cambiar el color del texto, del fondo
        de la página y deberá tener el siguiente texto:
    </p>
    <p>
        CALCULAR ÁREA TRIÁNGULO
        Escribe la base:
        Escribe la altura:
        El título de la página será: Área de un triángulo.
    </p>

    <h3>Solución:</h3>

    <!--    FORMULARIO      -->
    <form method="post" action="">
        <h4>Calculadora de área de triángulo:</h4>
        <label for="base">Base (cm):</label>
        <input type="number" id="base" name="base" required>
        <br>
        <label for="altura">Altura (cm):</label>
        <input type="number" id="altura" name="altura" required>
        <br><br>
        <input type="submit" name="Calcular" value="Calcular Área">
    </form>

    <?php
    // Si se ha pulsado name=Calcular
    if (isset($_POST["Calcular"])) {
        // Obtén los valores de base y altura desde el formulario
        $base = $_POST['base'];
        $altura = $_POST['altura'];

        // Calcula el área del triángulo (Área = Base * Altura / 2)
        if ($base > 0 && $altura > 0) {
            $area = $base * $altura / 2;
            // Muestra el resultado
            echo "<p <div class=\"fondoExito\">>El área del triángulo cuya base es $base y altura $altura es: $area.</p>";
        } else {
            // Añado la clase para que el texto sea rojo.
            echo '<p class="textoError">Los valores introducidos deben ser mayores que 0.</p>';
        }
    }
    ?>
</body>

</html>