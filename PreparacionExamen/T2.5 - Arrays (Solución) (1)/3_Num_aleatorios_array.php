<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ejercicio 3 - Números aleatorios</title>
</head>
<body>

	<?php
		
		$min = 1;
		$max = 6;

		$numerosGenerar = 6;
		$numerosAleatorios = [];

		for ($i=0; $i<$numerosGenerar; $i++){
			$numerosAleatorios[] = rand ($min, $max); 
		}

		print "<p>Array de números aleatorios generado</p>";
		print "<pre>";
		print_r ($numerosAleatorios);
		print "</pre>";
		

		print "<p>Número de veces que aparece cada valor</p>";
		print "<pre>";
		print_r (array_count_values($numerosAleatorios));
		print "</pre>";

		$numeroAzar = rand ($min, $max); 
		print "<p>Número al azar obtenido $numeroAzar</p>";

		if (in_array($numeroAzar, $numerosAleatorios)){
			print "<p>Índices donde aparece el número $numeroAzar</p>";
			print "<pre>";
			print_r (array_keys($numerosAleatorios, $numeroAzar));
			print "</pre>";
		}else{
			print "<p>El número $numeroAzar no se encuentra en el array generado</p>";
		}

		rsort($numerosAleatorios);
		print "<p>Ordenamos el array original de mayor a menor</p>";
		print "<pre>";
		print_r ($numerosAleatorios);
		print "</pre>";

		$numerosAleatoriosUnicos = array_unique($numerosAleatorios);
		print "<p>Eliminamos elementos repetidos del array original</p>";
		print "<pre>";
		print_r ($numerosAleatoriosUnicos);
		print "</pre>";

		print "<p>Renumeromos los índices desde cero</p>";
		print "<pre>";
		print_r (array_values($numerosAleatoriosUnicos));
		print "</pre>";

	?>

</body>
</html>