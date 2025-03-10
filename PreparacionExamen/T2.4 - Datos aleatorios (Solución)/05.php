<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ejercicio 5 - Datos países</title>
</head>
<body>

<form method="POST" action="">
<label for="pais">País:</label>
<select name="pais" id="pais">
  <option value="España">España</option>
  <option value="Hungría">Hungría</option>
  <option value="Italia">Italia</option>
  <option value="Paises Bajos">Paises Bajos</option>
  <option value="República Checa">República Checa</option>
  <option value="Suecia">Suecia</option>
</select>
<input type="submit" name="Ver" value="Ver">

</form>
	<?php

		$paises = ["España" => ["capital" => "Madrid","poblacion" => 46940000,"idiomas" => ["castellano","catalán","gallego","euskera","valenciano"],"costa" => true] ,
				"Hungría" =>["capital" => "Budapest", "poblacion" => 9773000, "idiomas" => ["húngaro"], "costa" => false] ,
				"Italia" =>["capital" => "Roma", "poblacion" => 60360000, "idiomas" => ["italiano"], "costa" => true] ,
				"Paises Bajos" =>["capital" => "Amsterdam", "poblacion" => 17280000, "idiomas" => ["neerlandés", "inglés"], "costa" => true] ,
				"República Checa" =>["capital" => "Praga", "poblacion" => 10650000, "idiomas" => ["checo"], "costa" => false] ,
				"Suecia" =>["capital" => "Estocolmo", "poblacion" => 10230000, "idiomas" => ["sueco", "sami", "inglés"], "costa" => true] ,
				];

		if(isset($_POST['Ver']))
		{
		$pais = $_POST['pais'];
		$datosPais = $paises[$pais];
			
		// Mostrar la capital
		echo "<p>La capital de $pais es $datosPais[capital]</p>";

		// Mostrar la población
		echo "<p>La población del $pais es de aproximadamente $datosPais[poblacion]</p>";

		// Mostrar los idiomas
		//$idiomas = implode("," , $datosPais["idiomas"]);
		echo "<p>Los idiomas principales de $pais son: " . implode(",", $datosPais["idiomas"]) . "</p>";
		echo "<pre>";
		print_r($datosPais["idiomas"]);
		echo "</pre>";

		// Sacar si un país tiene costa o no
		$datosPais = $paises[$pais];
		if ($datosPais["costa"]) {
			echo "<p>El país $pais tiene costa</p>";	
		} else {
			echo "<p>El país $pais no tiene costa</p>";
		}
	}
	?>

</body>
</html>