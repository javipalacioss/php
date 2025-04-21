<?php
session_start();
require_once('funciones.php');

unset($_SESSION['ingreReceta']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['volver'])) {
        header('Location: principal.php');
        exit();
    }

    if (isset($_POST['misRecetas'])) {
        // Mis recetas
        header('Location: misRecetas.php');
        exit();
    }

    if (isset($_POST['eliminar'])) {
        // Mis recetas
        eliminarReceta($_POST['eliminar']);
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

    if (isset($_POST['nueva'])) {
        // Nueva
        header('Location: nuevaReceta.php');
        exit();
    }
    
    if (isset($_POST['editar'])) {
        // Nueva
        $_SESSION['editar']= $_POST['editar'];
        header('Location: editarReceta.php');
        exit();
    }
}

$misRecetas = obtenerMisRecetas($_SESSION['usuario']['id']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Principal</title>
</head>

<body>
    <h1>Recetario: Tus recetas</h1>
    <h2>Hola <?php echo $_SESSION['usuario']['nombre']; ?></h2>
    <form action="" method="POST">
        <!-- Botones para editar y eliminar -->
        <button type="submit" name="volver">Volver</button>
        <button type="submit" name="nueva">Nueva receta</button>
        <br><br>
    </form>

    <TABLE border=1>
        <tr>
            <th>Categoría</th>
            <th>Título</th>
            <th>Acciones</th>

        </tr>
        <?php
        if (!empty($misRecetas)) {
            while ($receta = $misRecetas->fetch(PDO::FETCH_ASSOC)) {
        ?>

                <tr>
                    <td><?php echo $receta['nombre']; ?></td>
                    <td><?php echo $receta['titulo']; ?></td>
                    <td>
                        <form action="" method="POST">
                        <button type="submit" name="editar" value=<?php echo $receta['id']; ?>>Editar</button>
                        <button type="submit" name="eliminar" value=<?php echo $receta['id']; ?>>Eliminar</button>
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