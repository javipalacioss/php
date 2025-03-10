<?php

    require_once("persona.php");
    $persona = new Persona ("Fernando", "Díaz Moreno", 20);
    if ($persona->mayorEdad())
    {
        echo $persona->nombreCompleto() . " es mayor de edad";
    }
    else
    {
        echo $persona->nombreCompleto() . " no es mayor de edad";
    }
    
    echo "<p>".$persona->getNombre()."</p>";
    $persona->setNombre ("Pedro");
    echo "<p>".$persona->getNombre()."</p>";
    
?>