<?php

require_once('parametros.php');

function conectar()
{
    try {
        $conexion = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USERNAME, PASSWORD);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        return $e->getMessage(); //devolvemos el mensaje de error
    }
}

function desconectar($conexion)
{
    $conexion = null; //asignar null cierra la conexion
}

function crearProducto($nombre, $descripcion, $precio)
{
    $conexion = conectar();

    //preparamos la sentencia sql
    $sql = "INSERT INTO productos (nombre, descripcion, precio) VALUES (:nombre, :descripcion, :precio)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':precio', $precio);

    $resultado = $stmt->execute();
    //cerramos la conexion
    desconectar($conexion);

    //devolvemos true si el producto fue creado(insertado) correctamente en la BBDD
    return $resultado; 
}

function obtenerProductos()
{
    $conexion = conectar();

    //preparamos la sentencia sql
    $sql = "SELECT * FROM productos";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    //obtenemos todos los productos en un array asociativo
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    desconectar($conexion);

    //devolvemos todos los productos de la tabla correspondiente(productos)
    return $productos;
}

function obtenerProductoPorId($id)
{
    $conexion = conectar();

    //preparamos la sentencia sql
    $sql = "SELECT * FROM productos WHERE id = :id"; //obtenemos los productos por su id
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    //obetenemos solo el producto con el id indicado
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    //cerramos la conexion
    desconectar($conexion);
    //devolvemos el producto obtenido
    return $producto;
}

function actualizarProducto($id, $nombre, $descripcion, $precio)
{
    $conexion = conectar();

    //prepramos la sentencia SQL
    $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':precio', $precio);

    $resultado = $stmt->execute();

    //cerramos la conexion
    desconectar($conexion);
     //devolvemos true si el producto fue actualizado(update) correctamente en la BBDD
    return $resultado;
}

function eliminarProducto($id)
{
    $conexion = conectar();

    //preparamos la sentencia SQL
    $sql = "DELETE FROM productos WHERE id = :id"; //eliminamos producto por su id
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $resultado = $stmt->execute();

    //cerramos la conexion  
    desconectar($conexion);
    //devolvemos true si el producto fue eliminado(delete) correctamente en la BBDD
    return $resultado;
}
?>