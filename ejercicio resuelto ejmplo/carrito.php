<?php
require_once('clases.php');
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

// Obtener el usuario actual
$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['borrar'])) {
    // Recoger los productos seleccionados, es un array
    $productosAEliminar = $_POST['eliminar'];

    // Eliminar cada producto seleccionado, debería comprobar que el array trae algo
    // pero si viene vacío, simplemente no hace nada
    foreach ($productosAEliminar as $codigoProducto) {
        $usuario->eliminarDelCarrito($codigoProducto);
    }

    // Guardar los cambios en el archivo de sesión
    $_SESSION['usuario'] = $usuario;

    // Redirigir a sí misma, para que se refresque la pantalla y no aparezcan los eliminados
    header('Location: carrito.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - Frutería</title>
</head>
<body>
    <h1>Carrito de <?php echo $usuario->getNombre(); ?></h1>
    <form method="POST">
        <table border="1">
            <!-- cabecera -->
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Producto</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <!-- cuerpo, le meto bucle -->
            <tbody>
                <?php foreach ($usuario->getCarrito() as $producto) { ?>
                    <!-- cada vuelta del bucle un tr -->
                    <tr>
                        <td>
                            <!-- el name lleva corchetes para traerme un array de códigos y hacer foreach luego -->
                            <input type="checkbox" name="eliminar[]" value="<?php echo $producto->getCodigo(); ?>">
                        </td>
                        <td><?php echo $producto->getNombre(); ?></td>
                        <td><?php echo $producto->getPrecio(); ?>€</td>
                    </tr>
                    <!-- acabada la linea, acabado el foreach -->
                <?php } ?>
            </tbody>
        </table>
        <button name ="borrar" type="submit">Borrar seleccionados</button>
    </form>

    <a href="principal.php">Volver a la tienda</a>
</body>
</html>
