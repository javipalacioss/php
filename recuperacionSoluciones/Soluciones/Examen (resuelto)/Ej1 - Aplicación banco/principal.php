<?php
require_once 'clases.php';
require_once 'funciones.php';

// Verificar si la sesión está activa y renovar cookie
if (!isset($_COOKIE["dni_usuario"])) {
    header("Location: index.php");
    exit();
} else {
    $dni = $_COOKIE['dni_usuario'];
    // Renovar la cookie
    setcookie("dni_usuario", $dni, time() + 30);
}

$dni = $_COOKIE['dni_usuario'];
$mensaje = "";

// Inicializar archivo del usuario si no existe
$archivoUsuario = obtenerArchivoUsuario($dni);

if (!file_exists($archivoUsuario)) {
    file_put_contents($archivoUsuario, serialize([]));
}

// Procesar acciones de formularios
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Agregar movimiento
    if (isset($_POST['nuevoMovimiento'])) {

        $fecha = $_POST['fecha'];
        $concepto = $_POST['concepto'];
        $cantidad = $_POST['cantidad'];
        $tipo = $_POST['tipo'];

        if ($tipo == 'gasto') {
            $destinatario = $_POST['desdeHasta'];
            $movimiento = new Gasto($fecha, $concepto, $cantidad, $destinatario);
            $mensaje = "Gasto añadido correctamente";
        } else {
            $origen = $_POST['desdeHasta'];
            $movimiento = new Ingreso($fecha, $concepto, $cantidad, $origen);
            $mensaje = "Ingreso añadido correctamente";
        }

        anadirMovimiento($dni, $movimiento);
        header("Location: principal.php");
    }

    // Cerrar sessión
    if (isset($_POST['cerrar'])) {
        header("Location: index.php");
        exit();
    }
}

// Obtener movimientos para mostrar
$movimientos = leerMovimientos($dni);

// Calcular saldo
$saldo = 0;
foreach ($movimientos as $movimiento) {
    if ($movimiento instanceof Ingreso) {
        $saldo += $movimiento->cantidad;
    } else {
        $saldo -= $movimiento->cantidad;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Banco - Principal</title>
</head>

<body>
    <h1>Bienvenido, <?php echo $dni; ?></h1>

    <!--  Botón cerrar sesión -->
    <form method="post">
        <input type="submit" name="cerrar" value="Cerrar sesión">
    </form>

    <!--  MENSAJE -->
    <?php if (!empty($mensaje)): ?>
        <p><strong><?php echo $mensaje; ?></strong></p>
    <?php endif; ?>

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
    <h2>Movimientos (Saldo actual: <?php echo number_format($saldo, 2); ?>€)</h2>


    <?php if (empty($movimientos)): ?>
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
            <?php foreach ($movimientos as $movimiento): ?>
                <tr>
                    <td><?php echo ($movimiento instanceof Gasto) ? "Gasto" : "Ingreso"; ?></td>
                    <td><?php echo $movimiento->fecha; ?></td>
                    <td><?php echo $movimiento->concepto; ?></td>
                    <td><?php echo $movimiento->cantidad; ?>€</td>
                    <td>
                        <?php
                        if ($movimiento instanceof Gasto) {
                            echo "Destinatario: " . $movimiento->destinatario;
                        } else {
                            echo "Origen: " . $movimiento->origen;
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</body>

</html>