<?php
session_start();

require_once('funciones.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['volver'])) {
        unset($_SESSION['ingreReceta']);
        header('Location: misRecetas.php');
        exit();
    }

    if (isset($_POST['agregarIngrediente'])) {
        if (isset($_POST['idIngrediente']) && !empty($_POST['cantidad'])) {
            $nuevoIngrediente = obtenerIngreCompletoPorID($_POST['idIngrediente']);
            $_SESSION['ingreReceta'][$nuevoIngrediente['id']] = [$nuevoIngrediente['id'], $nuevoIngrediente['nombre'], $_POST['cantidad']];
        } else {
            $_SESSION['mensaje'] = "<p> Los campos no pueden estar vacíos.</p>";
        }

        header('Location: nuevaReceta.php');
        exit();
    }

    if (isset($_POST['eliminar'])) {
        unset($_SESSION['ingreReceta'][$_POST['eliminar']]);
        header('Location: nuevaReceta.php');
        exit();
    }

    if (isset($_POST['guardar'])) {
        // Mis recetas
        if (isset($_POST['categoria'], $_POST['titulo'], $_POST['descripcion'], $_POST['pasos'])) {

            // Guardo en base de datos.
            nuevaReceta($_SESSION['usuario']['id'], $_POST['categoria'], $_POST['titulo'], $_POST['descripcion'], $_POST['pasos'], $_SESSION['ingreReceta']);

            // REcargo la página
            header('Location: misRecetas.php');
            exit();
        } else {
            echo "Los campos no pueden estar vacíos.";
        }
        // Borro la lista de ingredientes
        unset($_SESSION['ingreReceta']);
    }

    if (isset($_POST['cerrar'])) {
        // Cerrar sesión
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

$categorias = obtenerCategorias();
$ingredientes = obtenerIngredientes();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Principal</title>
</head>

<body>
    <h1>Recetario: Nueva Receta</h1>
    <h2>Hola <?php echo $_SESSION['usuario']['nombre']; ?></h2>
    <form action="" method="POST">
        <!-- Botones para editar y eliminar -->
        <button type="submit" name="volver">Volver</button>
        <button type="submit" name="guardar">Guardar receta</button>
        <br><br>

        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria">
            <?php
            // Genero el select list con lo obtenido en la funcion anterior
            while ($categoria = $categorias->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['nombre'] ?></option>
            <?php
            }
            ?>
        </select><br>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo"><br>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion"><br>
        <label for="pasos">Pasos:</label>
        <input type="text" name="pasos"><br>
    </form>

    <h3>Ingredientes</h3>
    <?php if (isset($ingredientes)) {
    ?>

        <form action="" method="POST">
            <select name="idIngrediente" id="idIngrediente">
                <?php
                while ($ingrediente = $ingredientes->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option value="<?php echo $ingrediente['id'] ?>"><?php echo $ingrediente['nombre'] ?></option>
                <?php
                }
                ?>
            </select>
            <label for="cantidad">Cantidad:</label>
            <input type="text" name="cantidad">
            <!-- Botones para editar y eliminar -->
            <button type="submit" name="agregarIngrediente">Agregar ingrediente</button>
        </form><br>
    <?php
    } else {
        echo "No se han encontrado ingredientes para añadir.";
    }

    // Mensaje
    if (isset($_SESSION['mensaje'])) {
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
    }

    ?>
    <TABLE border=1>
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Imprimo la tabla de ingredientes
        if (isset($_SESSION['ingreReceta'])) {
            foreach ($_SESSION['ingreReceta'] as $ingrediente) {
        ?>
                <tr>
                    <td><?php echo $ingrediente[1] ?></td>
                    <td><?php echo $ingrediente[2] ?></td>
                    <td>
                        <form action="" method="POST">
                            <button type="submit" name="eliminar" value=<?php echo $ingrediente[0] ?>>Eliminar</button>
                        </form>
                    </td>
                </tr>
        <?php
            }
        }
        ?>

</body>

</html>