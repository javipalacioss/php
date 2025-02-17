<?php
    //No se recomienda el usa exec para las consultas de acción. En su lugar se aconseja
    //el uso de consultas preparadas por motivos de seguridad.
    //Si la consulta genera un conjunto de datos, como es el caso de SELECT, debes utilizar el
    //método query, que devuelve un objeto de la clase PDOStatement.

try {
    $mysql ="mysql:host=localhost;dbname=ejercicio_examen;charset=UTF8";
    $user = "root";
    $password = "";
    $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $conexion = new PDO($mysql, $user, $password);

    //metemos la consulta
    $resultado = $conexion -> query('select * FROM mensajes');

    $conexion = null;
} catch (PDOException $e) {
    // Mostramos mensaje en caso de error
    echo "<p>" . $e->getMessage() . "</p>";
}
