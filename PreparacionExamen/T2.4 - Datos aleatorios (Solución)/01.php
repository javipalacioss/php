<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ejercicio 1</title>
</head>
<body>
<?php
    // Declaración de variables
	$min = 0;
	$max = 255;

	$red = rand($min,$max);
	$green = rand($min,$max);
	$blue = rand($min,$max);


	// Pintamos el código RGB por pantalla
	echo  "<h2>Código de color: rgb($red,$green,$blue)</h2>";

	// Aplicacmos el código RGB al background de un h1
	print "<h3 style = 'background-color: rgb($red,$green,$blue)'>Texto</h3>";
?>
<!-- Pintamos código RGB con etiqueta PHP dentro de HTML -->
<h3 style = 'background-color: <?php echo "rgb($red,$green,$blue)"; ?>'>Texto 2</h3>

<h3 style = 'background-color: <?= "rgb($red,$green,$blue)" ?>'>Texto 3</h3>

<h3 style = 'background-color: <?php print "rgb($red,$green,$blue)" ?>'>Texto 4</h3>

</body>
</html>