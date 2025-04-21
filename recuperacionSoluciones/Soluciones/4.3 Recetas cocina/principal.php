<?php
session_start();

require_once('funciones.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['misRecetas'])) {
        // Recetas filtradas por mi id
        header('Location: misRecetas.php');
        exit();
    }


    if (isset($_POST['cerrar'])) {
        // Cerrar sesión
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }

    if (isset($_POST['detalle'])) {
        $_SESSION['id'] = $_POST['detalle'];
        header('Location: detalle.php');
        exit();
    }
}

$recetas = obtenerRecetas();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Principal</title>
</head>

<body>
    <h1>Recetario</h1>
    <h2>Hola <?php echo $_SESSION['usuario']['nombre']; ?></h2>
    <form action="" method="POST">
        <!-- Botones para editar y eliminar -->
        <button type="submit" name="misRecetas">Mis recetas</button>
        <button type="submit" name="cerrar">Cerrar sesión</button>
        <br><br>
    </form>

    <TABLE border=1>
        <tr>
            <th>Núm. Receta</th>
            <th>Categoría</th>
            <th>Título</th>
            <th>Puntuación</th>
            <th>Favorito</th>
            <th>Acciones</th>

        </tr>
        <?php
        if (!empty($recetas)) {
            while ($receta = $recetas->fetch(PDO::FETCH_ASSOC)) {
        ?>

                <tr>
                    <td><?php echo $receta['id']; ?></td>
                    <td><?php echo $receta['nombre']; ?></td>
                    <td><?php echo $receta['titulo']; ?></td>
                    <td><?php echo $receta['puntuacion']; ?></td>
                    <td><?php
                        if (esFavorito($_SESSION['usuario']['id'], $receta['id'])) {
                            echo "Sí";
                        } else {
                            echo "No";
                        } ?>
                    </td>
                    <td>
                        <form action="" method="POST">
                            <button type="submit" name="detalle" value=<?php echo $receta['id']; ?>>Detalle</button>
                        </form>
                    </td>

                </tr>


        <?php
            }
        }
        ?>
    </TABLE>
</body>

</html>