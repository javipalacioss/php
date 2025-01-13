<?php
// Incluir la clase Persona
include_once 'Persona.php';

// Crear una instancia de Persona
$persona = new Persona("Juan", "Pérez", 25);

// Usar los métodos
echo "Nombre completo: " . $persona->nombreCompleto() . "<br>";
echo "Edad: " . $persona->getEdad() . "<br>";
echo "¿Es mayor de edad? " . ($persona->mayorEdad() ? "Sí" : "No") . "<br>";

// Modificar algunos atributos usando los métodos set
$persona->setNombre("Carlos");
$persona->setApellidos("Gómez");
$persona->setEdad(17);

// Mostrar la información actualizada
echo "<br>Después de modificar datos:<br>";
echo "Nombre completo: " . $persona->nombreCompleto() . "<br>";
echo "Edad: " . $persona->getEdad() . "<br>";
echo "¿Es mayor de edad? " . ($persona->mayorEdad() ? "Sí" : "No") . "<br>";
?>
