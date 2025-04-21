<?php
require_once 'funciones.php';
require_once 'clases.php';

// Verificar si la sesión está activa y renovar cookie
if (!isset($_COOKIE["id_cliente"])) {
    header("Location: index.php");
    exit();
}else {
    $id_cliente = $_COOKIE['id_cliente'];
    // Renovar la cookie
    setcookie("id_cliente", $id_cliente, time() + 30);
}

// Inicializar tipo seleccionado (normal por defecto o el enviado en el formulario)
$id_cliente = $_COOKIE['id_cliente'];
$mensaje = "";

// Inicializar archivo del cliente si no existe
$archivoCliente = obtenerArchivoCliente($id_cliente);

if (!file_exists($archivoCliente)) {
    file_put_contents($archivoCliente, serialize([]));
}

// Procesar acciones de formularios
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Registrar nuevo paquete
    if (isset($_POST['nuevoPaquete'])) {
        $id = generarIdPaquete();
        $peso = $_POST['peso'];
        $destino = $_POST['destino'];
        $fecha_envio = $_POST['fecha_envio'];

        $tipo_seleccionado = $_POST['tipo'];

    // Si se cambia el tipo, solo actualizar la variable
    if ($tipo_seleccionado == 'normal') {
        $tipo_seleccionado = 'normal';
       $paquete = new Paquete($id, $peso, $destino, $fecha_envio);
       $mensaje = "Paquete añadido correctamente";

    } elseif($tipo_seleccionado == 'urgente'){
        $tipo_seleccionado = 'urgente';
        $tiempo_garantizado = 24;
        $paquete = new Urgente($id, $peso, $destino, $fecha_envio, $tiempo_garantizado);
        $mensaje = "Paquete añadido correctamente";

    } elseif($tipo_seleccionado == 'fragil') {
        $tipo_seleccionado = 'fragil';
        $instrucciones_especiales = "Manipular con cuidado";
        $paquete = new Fragil($id, $peso, $destino, $fecha_envio, $instrucciones_especiales);
        $mensaje = "Paquete añadido correctamente";
    }

    anadirPaquete($id_cliente, $paquete);
    header("Location: principal.php");

}
    // Cerrar sesión
    if (isset($_POST['cerrar'])) {
        header("Location: index.php");
        exit();
    }
}


// Obtener paquetes para mostrar
$paquetes = leerPaquetes($id_cliente);

// Calcular coste total
    $coste_total = 0;
    foreach ($paquetes as $paquete) {
            $saldo += $paquete->calcularCoste();
    }

// Establecer etiqueta y valor predeterminado según el tipo seleccionado
$fecha_hoy = date('d-m-Y'); // Fecha actual en formato DD-MM-YYYY
 //valores por defecto
 $tiempo_garantizado = 24;
 $instrucciones_especiales = "Manipular con cuidado";

$tipo_seleccionado = $_POST['tipo'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Paquetería - Panel Principal</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenido, Cliente <?php echo $id_cliente ?></h1>
            <form method="post">
                <input type="submit" name="cerrar" value="Cerrar sesión" class="logout">
            </form>
        </div>

        <?php if (!empty($mensaje)): ?>
        <p><strong><?php echo $mensaje; ?></strong></p>
    <?php endif; ?>

        <h2>Seleccionar Tipo de Paquete</h2>
        <form method="POST">
            <div class="form-row">
                <label for="tipo">Tipo de paquete:</label>
                <select name="tipo" id="tipo">
                    <option value="normal" <?php echo ($tipo_seleccionado == 'normal') ? 'selected' : ''; ?>>Normal</option>
                    <option value="urgente" <?php echo ($tipo_seleccionado == 'urgente') ? 'selected' : ''; ?>>Urgente</option>
                    <option value="fragil" <?php echo ($tipo_seleccionado == 'fragil') ? 'selected' : ''; ?>>Frágil</option>
                </select>
                <input type="submit" name="cambiarTipo" value="Seleccionar">
            </div>
        </form>

        <h2>Registrar Nuevo Paquete  <?php echo $_POST['tipo'];?></h2>
        <form method="POST">
            <input type="hidden" name="tipo" value="">
            <table border="0">
                <tr>
                    <td><label for="peso">Peso (kg):</label></td>
                    <td><input type="number" id="peso" name="peso" step="0.01" min="0.01" required></td>
                </tr>
                <tr>
                    <td><label for="destino">Destino:</label></td>
                    <td><input type="text" id="destino" name="destino" required></td>
                </tr>
                <tr>
                    <td><label for="fecha_envio">Fecha de envío:</label></td>
                    <td><input type="date" id="fecha_envio" name="fecha_envio" value="" required></td>
                </tr>
                <?php if($tipo_seleccionado!='normal')://SI EL PAQUETE NO ES NORMAL MUESTRAS LA ETIQUETA DETALLE: ?>
                <tr>
                    <td><label for="detalle"><?php $paquetes -> detalle ?></label></td>
                    <td><input type="text" id="detalle" name="detalle" value="" required></td>
                </tr>
                <?php endif;?>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="nuevoPaquete" value="Registrar Paquete">
                    </td>
                </tr>
            </table>
        </form>

        <h2>Mis Paquetes (Coste total: <?php echo number_format($coste_total, 2); ?> €)</h2>

        <?php if (empty($paquetes)): //SI NO HAY PAQUETES ?>
            <p>No hay paquetes registrados.</p>
        <?php  else: // SI HAY PAQUETES ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Peso</th>
                    <th>Destino</th>
                    <th>Fecha Envío</th>
                    <th>Detalles</th>
                    <th>Coste</th>
                </tr>
                <?php foreach ($paquetes as $paquete): ?>
                    <tr>
                        <td><?php echo $paquete->id; ?></td>
                        <td><?php 
                            echo $paquete->tipo;
                        ?></td>
                        <td><?php echo $paquete->peso; ?> kg</td>
                        <td><?php echo $paquete->destino; // IMPRIME EL DESTINO; ?></td>
                        <td><?php echo $paquete->fecha_envio;// IMPRIME EL FECHA ENVÍO; ?></td>
                        <td><?php echo $paquete-> mostrarInfo();// IMPRIME EL MOSTRAR INFO ?></td>
                        <td><?php echo $paquete->calcularCoste(); ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>