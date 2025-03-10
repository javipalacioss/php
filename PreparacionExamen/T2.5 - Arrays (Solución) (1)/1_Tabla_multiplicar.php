<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ejercicio 1 - Tabla de multiplicar</title>
</head>
<body>

	<?php
		$min = 1;
		$max = 10;
		$numero = rand ($min, $max); 

		$tablaMultiplicar = range(1*$numero,10*$numero,$numero);

		print "<p>Tabla de multiplicar del número $numero</p>";
		print "<pre>";
		print_r ($tablaMultiplicar);
		print "</pre>";

		print "<p>El mínimo es: " .min($tablaMultiplicar). "</p>";
		print "<p>El máximo es: " .max($tablaMultiplicar). "</p>";
	?>

</body>
</html>