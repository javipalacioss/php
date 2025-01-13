<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversión de monedas</title>
</head>
<body>
    
  <!-- Título para la página -->
   <h1>Conversor PTS/EUR</h1>

   <?php
    // Definir constantes
    define("c_EurPta", 166.386);
    define("c_PtaEur", number_format(1 / 166.386, 3));

    // Mostrar valores por pantalla
    echo 'Valor de la constante "EurPta": ' . c_EurPta . "<br>";
    echo "Valor de la constante \"PtaEur\": " . c_PtaEur . "<br>";
   ?>

    <!-- Formulario -->
    <form method="post" action="">
        <!-- Cantidad -->
        <label for="cantidad">Cantidad a convertir: </label>
        <input type="number" name="cantidad" id="cantidad">
        <br>

        <!-- Radiobutton -->
        <input type="radio" name="tipoConversion" value="eurosToPesetas" checked> Convertir a pesetas
        <input type="radio" name="tipoConversion" value="pesetasToEuros"> Convertir a euros
        <br>

        <!-- Submit -->
        <input type="submit" value="Convertir" name="Convertir">

    </form>

    <?php
    
        // Leer el valor de las variables input
        $v_cantidad = $_POST["cantidad"];
        $v_tipoConversion = $_POST["tipoConversion"];
    
        if (isset($_POST["Convertir"]) && !empty($v_cantidad))
        {

        // Lógica de conversión
        if ($v_tipoConversion == "eurosToPesetas") 
        {
            //Convertir a pesetas
            $v_resultado = $v_cantidad * c_EurPta;
            echo "<br>" . $v_cantidad . " Eur son " . $v_resultado . " pesetas.";
        } elseif ($v_tipoConversion == "pesetasToEuros") {
            //Convertir a Euros
            $v_resultado = $v_cantidad * c_PtaEur;
            echo "<br>" . $v_cantidad . " Pesetas son " . $v_resultado . " euros.";
        } 
        
    }else {
            echo "La conversión no es posible, introduce una cantidad.";
        }

    ?>

</body>
</html>