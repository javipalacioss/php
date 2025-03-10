<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ejercicio 2</title>
</head>
<body>
<?php
	// Declaración de variables
	$min = 128512;
	$max = 128586;
	$emoticono = rand($min,$max);

	echo "<p>Emoticono: &#$emoticono</p>";

	// Vamos a pintar el tamaño del icono con un número aleatorio entre 12 y 30
	$tam = rand(12,30);
	print "<p style='font-size: ".$tam."px'>Emoticono: &#$emoticono</p>";
?>
</body>
</html>