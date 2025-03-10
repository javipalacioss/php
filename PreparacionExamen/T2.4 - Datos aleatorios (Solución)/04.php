<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ejercicio 4 - Ciudades</title>
</head>
<body>

	<?php
		
		$ciudades = ["Almería", "Cádiz", "Córdoba", "Granada", "Huelva", "Jaén", "Málaga", "Sevilla"];

		print "<pre>";
		print_r($ciudades);
		print "</pre>";

		$indice = rand(0, count($ciudades)-1);
		
		$ciudadEliminada = $ciudades[$indice];

		unset($ciudades[$indice]);

		print "<p>Del listado de ciudades hemos eliminado la ciudad $ciudadEliminada</p>";

		print "<pre>";
		print_r($ciudades);
		print "</pre>";

	?>

</body>
</html>