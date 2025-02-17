<?php
//Por defecto, el método fetch genera y devuelve a partir de cada registro 
//un array con claves numéricas y asociativas.
try {
    $mysql ="mysql:host=localhost;dbname=ejercicio_examen;charset=UTF8";
    $user = "root";
    $password = "";
    $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $conexion = new PDO($mysql, $user, $password);


    
} catch (PDOException $e) {
    // Mostramos mensaje en caso de error
    echo "<p>" . $e->getMessage() . "</p>";
    exit();
}

$resultado = $conexion -> query('select * FROM mensajes');
while ($registro = $resultado->fetch()) {
    echo "<p>Nombre: " . $registro['nombre'] . "</p>";
    //o tambien $registro [1];
}

$conexion = null;
?>

