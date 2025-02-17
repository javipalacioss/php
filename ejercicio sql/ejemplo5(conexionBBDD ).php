<?php
//codigo para conectarnos a nuestra base de datos
//PDO maneja los errores en forma de excepciones, por lo que la conexion siempre ha de ir encerrada en un bloque try catch
//Una vez establecida la conexión, puedes utilizar el método getAttribute para obtener
//información del estado de la conexión y setAttribute para modificar algunos parámetros que afectan a la misma
try {
    $mysql = "mysql : host = localhost; dbname=ejercicio_examen; charset = UTF8";

    $user = "root";
    $password = "";

    //Añadimos $opciones
    $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    $conexion = new PDO($mysql, $user, $password, $opciones);

    //Añadimos $version
    $version = $conexion ->getAttribute(PDO::ATTR_SERVER_VERSION);

    //Mostramos mensaje de la version
    echo "Versión: $version";

    echo "<p> Conectado a la BBDD</p>";
} catch (PDOException $e) {
   
    //mostramos mensaje en caso de error
    echo "<p>" .$e->getMessage() . "</p>";

}


?>