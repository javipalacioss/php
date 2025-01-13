<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversion de monedas</title>
</head>
<body>
<!--Titulo de la pagina-->
    <h1>Conversor pesetas a Euros</h1>

    <?php
    //Definir constantes
    define("c_EurPta", 166.386); 
    define("c_PtaEur", number_format(1 / 166.386, 3)); 
    //Mostrar valores por pantalla
    echo 'Valor de la constante "  Eur/Pta" : ' . c_EurPta ;
    echo "<br>";
    echo 'Valor de la constante "  Pta/Eur" : ' . c_PtaEur ;  
    ?>

<!--Formulario-->
<form method="post" action="">
    <label for="cantidad">Cantidad a convertir: </label>
    <input type="number" name="cantidad" id="cantidad">
    <br>

<!--Radiobutton-->
<input type="radio" name="tipoConversion" value="eurosToPesetas" checked>Convertir a pesetas
<input type="radio" name="tipoConversion" value="PesetasToEuros">Convertir a euros
<br>

<!--Submit-->
<input type="submit" name="Convertir">

<?php
//Se compreba la llamada tipo "post"
if($_SERVER["REQUEST_METHOD"] == 'POST')

    //leer el valor de las variables input

    $v_cantidad = $_POST["cantidad"];
    $v_tipoConversion = $_POST["tipoConversion"];

    //Logica de conversion

    if(!empty($v_cantidad) && isset($_POST["Convertir"])){

    if ($v_tipoConversion =="eurosToPesetas"){
        //Convertir a pesetas
        $v_resultado = $v_cantidad * c_EurPta;
        echo "<br>" . $v_cantidad . " Euros son " . $v_resultado . " pesetas.";
    } elseif ($v_tipoConversion =="PesetasToEuros") {
        //Convertir a euros
        $v_resultado = $v_cantidad * c_PtaEur;
        echo "<br>" . $v_cantidad . " Pesetas son " . $v_resultado . " euros.";
    } else {
        echo "La conversion no es posible";
    }
}
?>

</body>
</html>