<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ejercicio 4 - Diccionario de meses</title>
	<style>
	table, td, th 
	{
		border: 0.5px solid;
		border-collapse: collapse;
	}
	</style>
</head>
<body>

<form action="" method="post">
<label for="origen">Idioma origen:</label>

<select name="origen" id="origen">
  <option value="español">español</option>
  <option value="inglés">inglés</option>
  <option value="francés">francés</option>
  <option value="alemán">alemán</option>
</select>

<label for="destino">Idioma destino:</label>

<select name="destino" id="destino">
  <option value="español">español</option>
  <option value="inglés">inglés</option>
  <option value="francés">francés</option>
  <option value="alemán">alemán</option>
</select>

<input type="submit" name="Traducir" id="Traducir" value="Traducir">
<input type="reset" value="Reset">


	<?php
		
		$mesesIdiomas = [
		"español" => ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		"inglés" => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
		"francés" => ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Julilet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
		"alemán" => ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"]
    	];

		if(isset($_POST['Traducir']))
		{ 
		$idiomaOrigen = $mesesIdiomas[$_POST['origen']];
		$idiomaDestino = $mesesIdiomas[$_POST['destino']];
		
		if(!isset($_POST['reset']))
		{
		?>

		<table>
			<tr><th>Origen</th><th>Destino</th></tr>
			<tr><td><?php echo $idiomaOrigen[0]?></td><td><?php echo $idiomaDestino[0]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[1]?></td><td><?php echo $idiomaDestino[1]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[2]?></td><td><?php echo $idiomaDestino[2]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[3]?></td><td><?php echo $idiomaDestino[3]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[4]?></td><td><?php echo $idiomaDestino[4]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[5]?></td><td><?php echo $idiomaDestino[5]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[6]?></td><td><?php echo $idiomaDestino[6]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[7]?></td><td><?php echo $idiomaDestino[7]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[8]?></td><td><?php echo $idiomaDestino[8]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[9]?></td><td><?php echo $idiomaDestino[9]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[10]?></td><td><?php echo $idiomaDestino[10]?></td></tr>
			<tr><td><?php echo $idiomaOrigen[11]?></td><td><?php echo $idiomaDestino[11]?></td></tr>
		</table>
		<?php
		}
	}

	?>
</form>
<?php 
if(isset($_POST['reset']))
 unset($_POST['Traducir']); ?>
</body>
</html>