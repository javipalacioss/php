<?php
session_start();
require_once 'funciones.php';
// Verificar que el usuario esté autenticado o se vuelva a index
if (!isset($_SESSION['paciente_id'])) {
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
    // Crear nueva cita
    if (isset($_POST['crear_cita'])) {
        $medico_id = $_POST['medico_id'];
        $motivo = $_POST['motivo'];
        $fecha = !empty($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d');

        crearCita($_SESSION['paciente_id'], $medico_id, $fecha, $motivo);

        header('Location: principal.php');
        exit;
    }

    // Cancelar cita
 if (isset($_POST['cancelar'])) {
    cancelarCita($_SESSION['cita_id'], $_SESSION['paciente_id']);

    header('Location: principal.php');
    exit;
}

    // Cambiar estado de cita
    if (isset($_POST['cambiar_cita'])) {

        cambiarEstadoCita($_SESSION['cita_id'], $_SESSION['paciente_id']);

        header('Location: principal.php');
        exit;
    }
}
// Obtener médicos para el select list
$medicos = obtenerMedicos();
// Obtener citas, para mostrar en la tabla
$citas = obtenerCitas($_SESSION['paciente_id']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión de Citas Médicas</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
    <table>
        <tr>
            <th colspan="2">Sistema de Gestión de Citas Médicas</th>
        </tr>
        <tr>
            <td colspan="2">
                Bienvenido, <?php echo htmlspecialchars($_SESSION['paciente_nombre']); ?>
                <form method="post" action="">
                    <input type="submit" name="logout" value="Cerrar sesión">
                </form>
            </td>
        </tr>
    </table>

    <!-- MENSAJES INFORMATIVOS -->
    <?php if (isset($_SESSION['mensaje'])):?>
        <table class="mensaje">
            <tr>
                <td><?php echo $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']); ?></td>
            </tr>
        </table>
    <?php endif; ?>

    <!-- Formulario para crear cita -->
    <form method="post" action="">
        <table>
            <tr>
                <th colspan="2">Nueva Cita</th>
            </tr>
            <tr>
                <td><label for="medico_id">Médico:</label></td>
                <td>
                    <select id="medico_id" name="medico_id" required>
                        <option value="">Seleccione un médico</option>
                                <?php //INFORMACIÓN DE LOS MÉDICOS, ESPECIALIDAD Y CONSULTA PARA MOSTRAR EN EL LISTADO 
                                if($medicos) {
                                    while($medico = $medicos->fetch(PDO::FETCH_ASSOC)):
                                    ?>
                                     <option value="<?php echo $medico['id']; ?>">
                                <?php echo htmlspecialchars( ' (Nombre ' .$medico['nombre'] . ' Especialidad: ' . $medico['especialidad']. ' Consulta:' .  $medico['consulta']  . ')'); ?>
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
                    <input type="submit" name="crear_cita" value="Solicitar Cita">
                </td>
            </tr>
        </table>
    </form>

    <!-- Listado de citas -->
    <table>
        <tr>
            <th colspan="6">Mis Citas</th>
        </tr>
        <?php if (empty($citas)):?>
            <tr>
                <td colspan="6">No tienes citas actualmente.</td>
            </tr>
        <?php else:?>
            <tr>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Consulta</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php  while ($cita = $citas->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cita['medico_nombre']); ?></td>
                    <td><?php echo htmlspecialchars('Especialidad: ' . $cita['especialidad']); ?></td>
                    <td><?php echo htmlspecialchars('Consulta: ' . $cita['consulta']); ?></td>
                    <td><?php echo htmlspecialchars('Fecha: ' . $cita['fecha']); ?></td>
                    <td><?php echo htmlspecialchars('Motivo: ' . $cita['motivo']); ?></td>
                    <td><?php if ($cita['programada']) {
                            echo "Ocupada";
                        } else {
                            echo "Libre";
                        } ?></td>
                    <td>
                        <?php if ($cita['programada']): ?>
                            <form method="post" action="">
                                <button type="submit" name="cambiar_estado" value="">Atender</button>
                                <button type="submit" name="cancelar" value="">Cancelar</button>
                            </form>
                        <?php endif;?>
                    </td>
                </tr>
            <?php endwhile;?>
        <?php endif; ?>
    </table>
</body>

</html>