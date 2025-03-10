<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ejercicio 2 - Tabla de alumnos con su edad</title>
</head>
<body>

	<?php
		$clase1 = [
			["Juan"=>21],
			["María"=>19],
			["Pedro"=>24],
			["Antonio"=>30],
			["Carmen"=>24],
			["Carlos"=>26],
			["Lucía"=>22]
		];


		$clase2 = [
			["Jaime"=>27],
			["Luisa"=>21],
			["Aitor"=>33],
			["Macarena"=>22],
			["María"=>27],
			["Pedro"=>28],
			["Juan"=>24]
		];

		$clase3 = ["Juan"=> 10, "Juan"=>20];

		$unionClases = array_merge($clase1,$clase2);

		print "<p>Datos de la clase de primero</p>";
		print "<pre>";
		print_r ($clase1);
		print "</pre>";

		print "<p>Datos de la clase de segundo</p>";
		print "<pre>";
		print_r ($clase2);
		print "</pre>";
	
		print "<p>Unión de las clases</p>";
		print "<pre>";
		print_r ($unionClases);
		print "</pre>";
	?>

</body>
</html>