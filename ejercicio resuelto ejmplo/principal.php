<?php
require_once('clases.php');

session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

// Obtener el usuario actual
$usuario = $_SESSION['usuario'];

// Productos
$productos = [
    new Producto(1, 'Manzana', 2.50),
    new Producto(2, 'Pera', 2.00),
    new Producto(3, 'Plátano', 1.80)
];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if(isset($_POST['anadir']) && isset($_POST['producto'])) {
    // Agregar el producto seleccionado al carrito
    $codigoProducto = $_POST['producto'];

    // Se recorre el array de productos para recoger la info del seleccionado
    // e incluirla en el carrito del usuario (siempre trabajamos con el producto como objeto)
    foreach ($productos as $producto) {
        if ($producto->getCodigo() == $codigoProducto) {
            $usuario->agregarAlCarrito($producto);
            break;
        }
    }

    // Guardar los cambios en el archivo de sesión
    $_SESSION['usuario'] = $usuario;
    }

    // Cerrar la sessión
    if(isset($_POST['cerrar']))
    {

    // Cargar usuarios desde el archivo de texto
        $usuariosfichero = unserialize(file_get_contents('usuarios.txt'));
    
        if(!empty($usuariosfichero)){
            foreach ($usuariosfichero as $posicion =>$usuariofichero) {
                
                if ($usuariofichero->getDni() === $usuario->getDni() ) {
                    // Si las credenciales coinciden, lo sustituyo
                    $usuariosfichero[$posicion] = $usuario;
                    break;
                }

            }

            // Guardo el array usuarios
            file_put_contents('usuarios.txt', serialize($usuariosfichero));

            session_unset();
            session_destroy();
            header('Location: index.php');
            exit();
        }   
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal - Frutería</title>
</head>
<body>
    <h1>Bienvenido a la Frutería, <?php echo $usuario->getNombre(); ?></h1>
    
    <h2>Productos</h2>
    <form method="POST">
        <select name="producto">
            <?php foreach ($productos as $producto) { // Inicio el foreach?> 

                <option value="<?php echo $producto->getCodigo(); ?>"><?php echo $producto->getNombre(); ?> - <?php echo $producto->getPrecio(); ?>€</option>
            <?php } // Termino el foreach?>
        </select>
        <br>
        <input type="submit" name="anadir" value="Añadir al carrito">
        <input type="submit" name="cerrar" value="Cerrar sessión">
    </form>
    
    <!-- Navegación con href -->
    <a href="carrito.php">Ver carrito</a>
</body>
</html>
