<?php
//codigo para conectarnos a nuestra base de datos
//PDO maneja los errores en forma de excepciones, por lo que la conexion siempre ha de ir encerrada en un bloque try catch

//Para ejecutar una consulta SQL utilizando PDO, debes diferenciar aquellas sentencias SQL
//que no devuelven como resultado un conjunto de datos, de aquellas otras que sí lo devuelven.
//En el caso de las consultas de acción, como INSERT, DELETE o UPDATE, el método exec
//devuelve el número de registros afectados
try {
    $mysql = "mysql : host = localhost; dbname=ejercicio_examen; charset = UTF8";

    $user = "root";
    $password = "";

    //Añadimos $opciones
    $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    $conexion = new PDO($mysql, $user, $password, $opciones);

   
    } catch (PDOException $e) {
   
    //mostramos mensaje en caso de error
    echo "<p>" .$e->getMessage() . "</p>";
    exit();
}

// PDO::exec() devuelve el número de filas modificadas o borradas por la 
//sentencia SQL ejecutada. Si no hay filas afectadas, PDO::exec() devuelve 0.

// consultas de acción, como INSERT, DELETE o UPDATE 
$registros = $conexion->exec('DELETE FROM mensajes WHERE mensaje="Texto del Mensaje"');
echo "<p>Se han borrado $registros registros.</p>";
$conexion = null;

?>