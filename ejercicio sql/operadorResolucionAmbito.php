<?php
//El Operador de Resolución de Ámbito o en términos simples, el doble dos-puntos, permite
//acceder a elementos estáticos y constantes de una clase.
class MiClase {const VALOR_CONST = 'Un valor constante';

    public static function dobleDosPuntos(){
        print "<p>Doble dos puntos</p>";
    }   
}

$clase = 'MiClase';
echo "<p>". $clase::VALOR_CONST ."</p>";
echo "<p>" . MiClase::VALOR_CONST . "</p>"; 
echo "<p>" . MiClase::dobleDosPuntos(). "</p>";

?>