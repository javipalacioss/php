<?php

require_once('parametros.php');

function conectar()
{
    // Intento de conexión
    try {
        $bbdd = "mysql:host=" . HOST . ";dbname=" . DBNAME;
        $pdo = new PDO($bbdd, USERNAME, PASSWORD);
        // Establecemos el modo de error de PDO a excepción
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo 'Error de conexión: ' . $e->getMessage();
    }
}

function desconectar($conexion)
{
    // Se desconecta
    $conexion = NULL;
}

function recetafavorita()
{
    $pdo = conectar();
    $stmt = $pdo->prepare("SELECT recetas.id, recetas.titulo, COUNT(favoritos.id) AS favs FROM recetas INNER JOIN favoritos ON recetas.id = favoritos.receta_id GROUP BY recetas.id ORDER BY favs DESC LIMIT 1;");
    $stmt->execute();
    $receta = $stmt->fetch();
    desconectar($pdo);
    return $receta;
}

function mostrarReceta($idReceta)
{
    if ($idReceta) {
        echo '<h3>Receta favorita: ' . $idReceta['titulo'] . '. Seleccionada favorita ' . $idReceta['favs'] . ' veces.<br></h3>';
        echo '';
    } else {
        echo "Aun no hay recetas.<br>";
    }
}

function obtenerRecetas()
{
    $pdo = conectar();
    $stmt = $pdo->prepare("SELECT cat.nombre, rec.id, rec.titulo, AVG(com.puntuacion) as puntuacion
                             FROM categorias cat  INNER JOIN recetas rec ON cat.id = rec.categoria_id
                                                  LEFT JOIN comentarios com ON rec.id = com.receta_id
                            GROUP BY rec.id");
    $stmt->execute();
    desconectar($pdo);
    return $stmt;
}

function obtenerMisRecetas($idUsuario)
{
    $pdo = conectar();
    $stmt = $pdo->prepare("SELECT cat.nombre, rec.id, rec.titulo as titulo
                             FROM categorias cat  INNER JOIN recetas rec ON cat.id = rec.categoria_id
                            WHERE rec.usuario_id = :id");

    $stmt->bindParam(':id', $idUsuario, PDO::PARAM_STR);

    $stmt->execute();

    desconectar($pdo);
    return $stmt;
}

function obtenerDetalle($id)
{
    $pdo = conectar();
    $stmt = $pdo->prepare("SELECT cat.nombre as categoria, rec.*, recing.*, ing.nombre as ingrediente
                             FROM categorias cat  INNER JOIN recetas rec ON cat.id = rec.categoria_id
                                                  INNER JOIN receta_ingredientes recing ON rec.id = recing.receta_id
                                                  INNER JOIN ingredientes ing ON recing.ingrediente_id = ing.id
                            WHERE rec.id = :id
                            GROUP BY rec.id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    desconectar($pdo);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function guardarValoracion($usuario, $receta, $puntuacion, $comentario, $marcarFavorito)
{
    $actualizado = false;
    $pdo = conectar();

    // Actualizar valoración
    // Comprobamos si tengo valoración
    $stmt = $pdo->prepare("SELECT * FROM comentarios WHERE receta_id = :receta AND usuario_id = :usuario");
    $stmt->bindParam(':receta', $receta, PDO::PARAM_INT);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $stmt = $pdo->prepare("UPDATE comentarios SET comentario = :comentario, puntuacion = :puntuacion
        WHERE usuario_id = :usuario AND receta_id = :receta");

        $stmt->bindParam(':receta', $receta, PDO::PARAM_INT);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
        if (empty($puntuacion))
            $puntuacion = NULL;
        $stmt->bindParam(':puntuacion', $puntuacion, PDO::PARAM_INT);


        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $actualizado = true;
        }
    } else {
        $stmt = $pdo->prepare("INSERT INTO comentarios (usuario_id, receta_id,  comentario, puntuacion) 
                                    VALUES (:usuario, :receta, :comentario, :puntuacion)");

        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
        $stmt->bindParam(':receta', $receta, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
        if (empty($puntuacion))
            $puntuacion = NULL;
        $stmt->bindParam(':puntuacion', $puntuacion, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $actualizado = true;
        }
    }


    // Actualizar favorito
    // Comprobamos si ya es favorito
    $stmt = $pdo->prepare("SELECT * FROM favoritos WHERE receta_id = :receta AND usuario_id = :usuario");
    $stmt->bindParam(':receta', $receta, PDO::PARAM_INT);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);

    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        $eraFavorito = false;
    } else {
        $eraFavorito = true;
    }

    if ($marcarFavorito == 'on') // Si debe ser favorito
    {
        // Crear favorito
        if (!$eraFavorito) {
            // Si no era favorito, y debe serlo, hago insert
            $stmt = $pdo->prepare("INSERT INTO favoritos (usuario_id, receta_id) VALUES (:usuario, :receta)");
            $stmt->bindParam(':receta', $receta, PDO::PARAM_INT);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $actualizado = true;
            }
        }
    } else {
        // Eliminar favorito
        if ($eraFavorito) {
            // Si era favorito, y no debe serlo, hago delete
            $stmt = $pdo->prepare("DELETE FROM favoritos WHERE usuario_id = :usuario AND receta_id = :receta");
            $stmt->bindParam(':receta', $receta, PDO::PARAM_INT);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $actualizado = true;
            }
        }
    }

    desconectar($pdo);

    // Mensaje
    if ($actualizado) {
        $_SESSION['mensaje'] = 'Valoración actualiada.';
    } else {
        $_SESSION['mensaje'] = 'La valoración no ha sido actualizada.';
    }
}

function esFavorito($usuario, $receta): bool
{
    $pdo = conectar();

    $stmt = $pdo->prepare("SELECT * FROM favoritos WHERE usuario_id = :usuario AND receta_id = :receta");

    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':receta', $receta, PDO::PARAM_INT);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $fav = true;
    } else {
        $fav = false;
    }

    return $fav;
}

function getValoracion($usuario, $receta)
{
    $pdo = conectar();

    $stmt = $pdo->prepare("SELECT * FROM comentarios WHERE usuario_id = :usuario AND receta_id = :receta");

    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->bindParam(':receta', $receta, PDO::PARAM_INT);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $valoracion = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $valoracion = NULL;
    }

    return $valoracion;
}

function eliminarReceta($idReceta): bool
{
    $pdo = conectar();
    $stmt = $pdo->prepare("DELETE FROM recetas WHERE id = :receta");
    $stmt->bindParam(':receta', $idReceta, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() == 1) { // Puedo devolver un true, para confirmar que se ha eliminado
        return true;
    } else {
        return false;
    }
}

function obtenerCategorias()
{
    $pdo = conectar();

    $stmt = $pdo->prepare("SELECT id, nombre FROM categorias");

    $stmt->execute();

    return $stmt;
}

function nuevaReceta($usuario, $cat, $tit, $des, $pasos, $ingredientes)
{
    $pdo = conectar();

    $stmt = $pdo->prepare("INSERT INTO recetas (titulo, descripcion, pasos, categoria_id, usuario_id) 
    VALUES (:titulo, :descripcion, :pasos, :categoria, :usuario_id)");

    $stmt->bindParam(':titulo', $tit, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $des, PDO::PARAM_STR);
    $stmt->bindParam(':pasos', $pasos, PDO::PARAM_STR);
    $stmt->bindParam(':categoria', $cat, PDO::PARAM_STR);
    $stmt->bindParam(':usuario_id', $usuario, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Obtengo el último id, de la receta que acabo de introducir.
        $ultimoId = $pdo->lastInsertId();
        // Si se ha añadido la receta, se añaden los ingredientes
        foreach ($ingredientes as $ingrediente) {

            $stmt2 = $pdo->prepare("INSERT INTO receta_ingredientes (receta_id, ingrediente_id, cantidad) 
                                                            VALUES (:receta_id, :ingrediente_id, :cantidad)");

            $stmt2->bindParam(':receta_id', $ultimoId, PDO::PARAM_INT);
            $stmt2->bindParam(':ingrediente_id', $ingrediente[0], PDO::PARAM_INT);
            $stmt2->bindParam(':cantidad', $ingrediente[2], PDO::PARAM_STR);

            $stmt2->execute();


            if ($stmt2->rowCount() == 0) {
                $_SESSION['mensaje'] = "Fallo al añadir ingrediente.";
            }
        }
    } else {
        $_SESSION['mensaje'] = "Fallo al añadir receta.";
    }
    desconectar($pdo);
}


function editarReceta($usuario, $cat, $tit, $des, $pasos, $ingredientes)
{
    $pdo = conectar();

    $stmt = $pdo->prepare("INSERT INTO recetas (titulo, descripcion, pasos, categoria_id, usuario_id) 
    VALUES (:titulo, :descripcion, :pasos, :categoria, :usuario_id)");

    $stmt->bindParam(':titulo', $tit, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $des, PDO::PARAM_STR);
    $stmt->bindParam(':pasos', $pasos, PDO::PARAM_STR);
    $stmt->bindParam(':categoria', $cat, PDO::PARAM_STR);
    $stmt->bindParam(':usuario_id', $usuario, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Obtengo el último id, de la receta que acabo de introducir.
        $ultimoId = $pdo->lastInsertId();
        // Si se ha añadido la receta, se añaden los ingredientes
        foreach ($ingredientes as $ingrediente) {

            $stmt2 = $pdo->prepare("INSERT INTO receta_ingredientes (receta_id, ingrediente_id, cantidad) 
                                                            VALUES (:receta_id, :ingrediente_id, :cantidad)");

            $stmt2->bindParam(':receta_id', $ultimoId, PDO::PARAM_INT);
            $stmt2->bindParam(':ingrediente_id', $ingrediente[0], PDO::PARAM_INT);
            $stmt2->bindParam(':cantidad', $ingrediente[2], PDO::PARAM_STR);

            $stmt2->execute();


            if ($stmt2->rowCount() == 0) {
                $_SESSION['mensaje'] = "Fallo al añadir ingrediente.";
            }
        }
    } else {
        $_SESSION['mensaje'] = "Fallo al añadir receta.";
    }
    desconectar($pdo);
}


function obtenerIngredientes()
{
    $pdo = conectar();

    $stmt = $pdo->prepare("SELECT id, nombre FROM ingredientes");

    $stmt->execute();

    return $stmt;
}

function obtenerIngreCompletoPorID($id)
{
    // Conectar
    $pdo = conectar();
    //Preparar
    $stmt = $pdo->prepare("SELECT id, nombre FROM ingredientes WHERE id = :id");
    // Vincular
    $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    // Ejercutar
    $stmt->execute();
    // Devuelvo el primero
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenerIngredientesPorReceta($idReceta)
{
        // Conectar
        $pdo = conectar();
        //Preparar
        $stmt = $pdo->prepare("SELECT r.ingrediente_id, i.nombre, r.cantidad FROM receta_ingredientes r INNER JOIN ingredientes i ON r.ingrediente_id = i.id WHERE r.receta_id = :receta");
        // Vincular
        $stmt->bindParam(":receta", $idReceta, PDO::PARAM_STR);
        // Ejercutar
        $stmt->execute();
        // Devuelvo el primero
        return $stmt;
    
}

function actualizarReceta($rec,$cat, $tit, $des, $pasos, $ingredientes)
{
    $pdo = conectar();

    $stmt = $pdo->prepare("UPDATE recetas SET titulo = :titulo,
                                              descripcion = :descripcion,
                                              pasos = :pasos,
                                              categoria_id = :categoria 
                            WHERE id = :receta");

    $stmt->bindParam(':titulo', $tit, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $des, PDO::PARAM_STR);
    $stmt->bindParam(':pasos', $pasos, PDO::PARAM_STR);
    $stmt->bindParam(':categoria', $cat, PDO::PARAM_STR);
    $stmt->bindParam(':receta', $rec, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Es más facil eliminar todos los ingredientes y añadirlos, que comparar uno a uno para eliminarlo, crearlo o actualizarlo.
         $stmt2 = $pdo->prepare("DELETE FROM receta_ingredientes WHERE receta_id = :receta_id");
         $stmt2->bindParam(':receta_id', $rec, PDO::PARAM_INT);
         $stmt2->execute();
        // Si se ha añadido la receta, se añaden los ingredientes
        foreach ($ingredientes as $ingrediente) {

            $stmt3 = $pdo->prepare("INSERT INTO receta_ingredientes (receta_id, ingrediente_id, cantidad) 
                                                            VALUES (:receta_id, :ingrediente_id, :cantidad)");

            $stmt3->bindParam(':receta_id', $rec, PDO::PARAM_INT);
            $stmt3->bindParam(':ingrediente_id', $ingrediente[0], PDO::PARAM_INT);
            $stmt3->bindParam(':cantidad', $ingrediente[2], PDO::PARAM_STR);

            $stmt3->execute();


            if ($stmt3->rowCount() == 0) {
                $_SESSION['mensaje'] = "Fallo al añadir ingrediente.";
            }
        }
    } else {
        $_SESSION['mensaje'] = "Fallo al añadir receta.";
    }
    desconectar($pdo);
}