<?php
//codigo para conectarnos a nuestra base de datos
//PDO maneja los errores en forma de excepciones, por lo que la conexion siempre ha de ir encerrada en un bloque try catch
try {
    $mysql = "mysql : host = localhost; dbname=ejercicio_examen; charset = UTF8";

    $user = "root";
    $password = "";

    //Añadimos $opciones
    $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    $conexion = new PDO($mysql, $user, $password, $opciones);

    echo "<p> Conectado a la BBDD</p>";
    
    //Cerar la conexion 
    $conexion = null;

} catch (PDOException $e) {
   
    //mostramos mensaje en caso de error
    echo "<p>" .$e->getMessage() . "</p>";

}


?>