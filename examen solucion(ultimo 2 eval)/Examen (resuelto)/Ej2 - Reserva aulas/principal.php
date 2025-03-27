<?php
session_start();
require_once 'funciones.php';

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['profesor_id'])) {
    $_SESSION['mensaje'] = "Debe iniciar sesión";
    header('Location: index.php');
    exit;
}

// Procesamiento de acciones POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cerrar sesión
    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    // Crear nueva reserva
    if (isset($_POST['crear_reserva'])) {
        $aula_id = $_POST['aula_id'];
        $motivo = $_POST['motivo'];
        $fecha = !empty($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d');

        crearReserva($_SESSION['profesor_id'], $aula_id, $fecha, $motivo);

        header('Location: principal.php');
        exit;
    }

    // Eliminar reserva
    if (isset($_POST['eliminar'])) {
        $reserva_id = $_POST['reserva_id'];

        eliminarReserva($reserva_id, $_SESSION['profesor_id']);

        header('Location: principal.php');
        exit;
    }

    // Cambiar estado de reserva
    if (isset($_POST['cambiar_estado'])) {
        $reserva_id = $_POST['reserva_id'];

        cambiarEstadoReserva($reserva_id, $_SESSION['profesor_id']);

        header('Location: principal.php');
        exit;
    }
}

// Obtener aulas y reservas
$aulas = obtenerAulas();
$reservas = obtenerReservas($_SESSION['profesor_id']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Reservas de Aulas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
    <table>
        <tr>
            <th colspan="2">Sistema de Reservas de Aulas</th>
        </tr>
        <tr>
            <td colspan="2">
                Bienvenido, <?php echo htmlspecialchars($_SESSION['profesor_nombre']); ?>
                <form method="post" action="">
                    <input type="submit" name="logout" value="Cerrar sesión">
                </form>
            </td>
        </tr>
    </table>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <table class="mensaje">
            <tr>
                <td><?php echo $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']); ?></td>
            </tr>
        </table>
    <?php endif; ?>

    <!-- Formulario para crear reserva -->
    <form method="post" action="">
        <table>
            <tr>
                <th colspan="2">Nueva Reserva</th>
            </tr>
            <tr>
                <td><label for="aula_id">Aula:</label></td>
                <td>
                    <select id="aula_id" name="aula_id" required>
                        <option value="">Seleccione un aula</option>
                        <?php
                         if($aulas) {
                            while($aula = $aulas->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $aula['id']; ?>">
                                <?php echo htmlspecialchars($aula['nombre']) . ' (Capacidad: ' . $aula['capacidad'] . ')'; ?>
                            </option>
                        <?php endwhile; 
                    }?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="fecha">Fecha:</label></td>
                <td>
                    <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>">
                </td>
            </tr>
            <tr>
                <td><label for="motivo">Motivo:</label></td>
                <td>
                    <textarea id="motivo" name="motivo" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="crear_reserva" value="Crear Reserva">
                </td>
            </tr>
        </table>
    </form>

    <!-- Listado de reservas -->
    <table>
        <tr>
            <th colspan="5">Mis Reservas</th>
        </tr>
        <?php if (empty($reservas)): ?>
            <tr>
                <td colspan="5">No tienes reservas actualmente.</td>
            </tr>
        <?php else: ?>
            <tr>
                <th>Aula</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php while ($reserva = $reservas->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($reserva['aula_nombre']); ?></td>
                    <td><?php echo $reserva['fecha']; ?></td>
                    <td><?php echo htmlspecialchars($reserva['motivo']); ?></td>
                    <td>
                        <?php if ($reserva['reservada']) {
                            echo "Reservada";
                        } else {
                            echo "Terminada";
                        } ?>
                    </td>
                    <td>
                        <?php if ($reserva['reservada']): ?>
                            <form method="post" action="">
                                <input type="hidden" name="reserva_id" value="<?php echo $reserva['id']; ?>">
                                <input type="submit" name="cambiar_estado" value="Terminar">
                                <input type="submit" name="eliminar" value="Eliminar" >
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </table>
</body>

</html>