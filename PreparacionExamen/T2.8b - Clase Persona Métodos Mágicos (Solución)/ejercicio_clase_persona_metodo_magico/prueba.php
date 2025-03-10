<?php

    require_once("persona.php");
    $persona = new Persona ("Fernando", "Díaz Moreno", 20);
    if ($persona->mayorEdad())
    {
        print $persona->nombreCompleto() . " es mayor de edad";
    }
    else
    {
        print $persona->nombreCompleto() . " no es mayor de edad";
    }
    
    print "<p>".$persona->nombre."</p>";
    $persona->nombre = "Pedro";
    print "<p>".$persona->nombre."</p>";
    
?>