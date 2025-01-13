<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ejercicio 3 - Números</title>
</head>
<body>

	<?php
		
		$numero = rand(0, 9);
		$numeroLetra = ["cero", "uno", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve"];
		echo "<p>El número $numero se escribe en letras 
		      como " . $numeroLetra[$numero] . "</p>";
	?>

</body>
</html>