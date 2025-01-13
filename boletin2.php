<?php

//Asignar valores
$a = 22;
$b = &$a;


//Salida
echo "La variable: " . $a . " vale:" . $a . "<br>" ;
echo "La variable: " . $b . " vale:" .$b . "<br>";

//Quitamos valor b
unset($b);

//Salida otra vez
echo "La variable: " . $a . " sigue valiendo: " . $a ;
?>