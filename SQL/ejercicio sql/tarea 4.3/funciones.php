<?php
require_once('parametros.php');
// PUEDES USAR ESTAS FUNCIONES U OTRAS QUE TU ELIJAS
function conectar()
{
    try {
    } catch (PDOException $e) {
        echo 'Erro de conexion ' . $e->getMessage();
    }
}

function desconectar($conexion)
{
    $conexion = null;
}

function recetafavorita() {
    //conectar
    $pdo = conectar();

    //consulta
    $sql = 'SELECT recetas.id, recetas.titulo, COUNT(favoritos.id) AS favs
            FROM recetas INNER JOIN favoritos ON recetas.id = favoritos.receta_id GROUP BY recetas.id
            ORDER BY favs DESC LIMIT 1;';

    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    $receta = $stmt -> fetch(PDO::FETCH_ASSOC);

    desconectar($pdo);

    return $receta;
}

function mostrarReceta($idReceta) {}

function obtenerRecetas() {}

function obtenerDetalle($id) {}

function guardarValoracion($usuario, $receta, $puntuacion, $comentario, $marcarFavorito) {}

function esFavorito($usuario, $receta): bool {}

function getValoracion($usuario, $receta) {}
