<?php
require_once('funciones.php');
require_once('clases.php');
session_start();
// Verificar si la cookie está activa y renovar cookie
// Si la cookie ha caducado, nos manda a index.php
 if (!isset($_COOKIE['dni'])) {
    header("Location: index.php");
    exit();
 }elseif(!isset($_COOKIE['dni'])) {
    $dni = $_SESSION['dni'];
    //renovamos la cookie
    setcookie("dni", $dni, time() + 30);
}

// Inicializar archivo del usuario si no existe. 
// Cada usuario tiene su fichero dni.dat, el cual resulta de concatenar el dni con ".dat"


$tipoSeleccionado = isset($_POST['tipo']) ? $_POST['tipo'] : 'gasto';

// Procesar acciones de formularios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // BOTON Agregar movimiento
    if (isset($_POST['nuevoMovimiento'])) {
        $fecha = $_POST['fecha'];
        $concepto = $_POST['concepto'];
        $cantidad = $_POST['cantidad'];
        $desdeHasta = $_POST['desdeHasta'];
        anadirMovimiento($dni, new Movimiento($fecha, $concepto, $cantidad));
        $mensaje = "Movimiento añadido Correctamente , que seria desde " . $this->desdeHasta;
        
    }

    // BOTÓN Cerrar sessión, caducando la cookie
    if (isset($_POST['cerrar'])) {
        setcookie("dni", $dni, time() + 0);
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

// Obtener movimientos de tu propio fichero, para mostrar
$movimientos = leerMovimientos($dni);

// Calcular saldo, recorriendo los movimientos y sumando/restando


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Banco - Principal</title>
</head>

<body>
    <h1>Bienvenido,<?php echo $_SESSION['dni']; ?></h1>

    <!--  Botón cerrar sesión -->
    <form method="post">
        <input type="submit" name="cerrar" value="Cerrar sesión">
    </form>

    <!--  MENSAJE INFORMATIVO -->

    <h2><?php echo 'Añadir nuevo movimiento'; ?></h2>

    <!--  FORMULARIO DE AÑADIR -->
    <form method="POST">
        <table border="0">

            <tr>
                <label for="tipo">Tipo de movimiento:</label>
                <select name="tipo" id="tipo">
                    <option value="gasto">Gasto</option>
                    <option value="ingreso">Ingreso</option>
                </select>
            </tr>
            <tr>
                <td><label for="fecha">Fecha:</label></td>
                <td><input type="date" id="fecha" name="fecha" required></td>
            </tr>
            <tr>
                <td><label for="concepto">Concepto:</label></td>
                <td><input type="text" id="concepto" name="concepto" required></td>
            </tr>
            <tr>
                <td><label for="cantidad">Cantidad (€):</label></td>
                <td><input type="number" id="cantidad" step="0.01" name="cantidad" required>
                </td>
            </tr>
            <tr>
                <td><label for="desdeHasta">Desde/hacia (persona)</label></td>
                <td><input type="text" name="desdeHasta"></td>
            </tr>
            <tr>
                <td>

                    <form method="POST">
                        <input type="submit" name="nuevoMovimiento" value="Añadir">
                    </form>
                </td>
            </tr>
        </table>
    </form>

    <!-- Tabla de movimientos -->
    <h2>Movimientos (Saldo actual: <?php //Aqui iria la variable de $calcularSaldo pero no la tengo completada ?>€)</h2>

    <?php if (empty($movimientos)):
     ?>
        <p>No hay movimientos registrados.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Detalles</th>
            </tr>
            <?php foreach($movimientos as $movimiento): ?>
                <tr>
                    <td><?php echo ($movimiento instanceof Movimiento) ? "Ingreso" : "Gasto"; ?></td>
                    <td><?php echo $movimiento->fecha; ?></td>
                    <td><?php echo $movimiento->concepto; ?></td>
                    <td><?php echo $movimiento->cantidad; ?>€</td>
                    <td><?php echo $movimiento->desdeHacia;?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php  endif;?>

</body>

</html>