<?php
require_once('funciones.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['volver'])) {
        // Listado
        header('Location: principal.php');
        exit();
    }

    if (isset($_POST['guardar'])) {
        guardarValoracion($_SESSION['usuario']['id'], $_SESSION['id'], $_POST['puntuacion'], $_POST['comentario'], $_POST['favorito']);
        // Listado
        header('Location: detalle.php');
        exit();
    }
}

$detalle = obtenerDetalle($_SESSION['id']);
$valoracion = getvaloracion($_SESSION['usuario']['id'], $_SESSION['id']);
// OBtengo los ingredientes de la receta
$stmtIngredientes = obtenerIngredientesPorReceta($_SESSION['id']);
// Los meto en un array
while ($ingrediente = $stmtIngredientes->fetch(PDO::FETCH_NUM)) {
    $_SESSION['ingreReceta'][$ingrediente[0]] = $ingrediente;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Principal</title>
</head>

<body>
    <h1>Recetario</h1>

    <form action="" method="POST">
        <!-- Botones para editar y eliminar -->
        <button type="submit" name="volver">Volver</button>
        <button type="submit" name="guardar">Guardar</button>
        <br><br>


        <h2><?php echo $detalle['categoria'] . ": " . $detalle['titulo'] ?></h2>
        <TABLE border=1>
            <tr>
                <th>Categoría</th>
                <td><?php echo $detalle['categoria']; ?> </td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td><?php echo $detalle['descripcion']; ?> </td>
            </tr>
            <tr>
                <th>Pasos</th>
                <td><?php echo $detalle['pasos']; ?> </td>
            </tr>

            <tr>
                <th>Ingredientes</th>
                <td>
                    <ol>
                        <?php
                        //Imprimo una lista numerada de ingredientes
                        if (isset($_SESSION['ingreReceta'])) {
                            foreach ($_SESSION['ingreReceta'] as $ingrediente) {
                        ?>
                                <li><?php echo "$ingrediente[1]: $ingrediente[2]" ?></li>
                        <?php
                            }
                        }
                        ?>
                    </ol>
                </td>
            </tr>
            <?php
            ?>
            </td>
            </tr>
            <tr>
                <th>Puntuación</th>
                <td><input type="number" name="puntuacion" value=<?php if (isset($valoracion['puntuacion'])) echo $valoracion['puntuacion']; ?>>Min: 1, Max: 5<br> </td>
            </tr>
            <tr>
                <th>Comentario</th>
                <td><input type="content" name="comentario" value="<?php if (isset($valoracion['comentario'])) echo $valoracion['comentario']; ?>"><br> </td>
            </tr>
            <tr>
                <th>Favorito</th>
                <td><input type="checkbox" name="favorito" <?php if (esFavorito($_SESSION['usuario']['id'], $detalle['receta_id'])) echo "checked" ?>><br> </td>
            </tr>
        </TABLE>
    </form>
    <!-- Mensaje -->
    <p><?php if (isset($_SESSION['mensaje'])) {
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        } ?></p>
</body>

</html>