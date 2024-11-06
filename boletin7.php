<?php
//Definimos las variables
$variables = [
    'a1' => 347,
    'a2' => 2147483647,
    'a3' => -2147483647,
    'a4' => 23.7678,
    'a5' => 3.1416,
    'a6' => "347",
    'a7' => "3.1416",
    'a8' => "Solo literal",
    'a9' => "12.3 Literal con número",
];

$tipos_nuevos = [
    'a1' => 'double',
    'a2' => 'double',
    'a3' => 'double',
    'a4' => 'integer',
    'a5' => 'integer',
    'a6' => 'double',
    'a7' => 'integer',
    'a8' => 'double',
    'a9' => 'integer',
];

foreach ($variables as $name => $value) {
    //Mostrar la info original
    echo "La variable " . $name . " tiene el valor: $value y su tipo es: " . gettype($value) . "<br>";
    
    //Forzar el tipo
    settype($variables[$name], $tipos_nuevos[$name]);
    
    //Mostrar la info despues de forzar el tipo
    echo "Después de forzar el tipo: " . $name . " tiene el valor: " . $variables[$name] . " y su nuevo tipo es: " . gettype($variables[$name]) . "<br><br>";
}
?>
