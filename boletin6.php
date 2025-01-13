<?php
//Asignamos las variables
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

//Mostramos los tipos de las variables 
foreach ($variables as $name => $value) {
    echo "La variable " . $name .  " tiene el valor: " . $value . " y su tipo es: " . gettype($value) . "<br>";
}
?>
