<?php 
// Incluir la barra de navegación
include('navbar.php');

// Incluir archivo de conexión a la base de datos
include('db_conection.php');

// Inicializamos las variables de reporte
$reporte_tipo = '';
$fecha_inicio = '';
$fecha_fin = '';

// Si se envió el formulario para generar el reporte
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reporte_tipo = $_POST['reporte_tipo'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
}

// Consultar según tipo de reporte
if ($reporte_tipo == 'ventas') {
    // Filtrar ventas por fecha
    $sql = "SELECT * FROM Ventas WHERE fecha_venta BETWEEN :fecha_inicio AND :fecha_fin";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($reporte_tipo == 'productos') {
    // Filtrar productos (puedes adaptar este filtro según sea necesario)
    $sql = "SELECT * FROM Productos";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($reporte_tipo == 'inventario') {
    // Filtrar movimientos de inventario
    $sql = "SELECT * FROM Inventario WHERE fecha_movimiento BETWEEN :fecha_inicio AND :fecha_fin";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $result = [];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Tortas y Pongues Lucy</title>
    <link rel="stylesheet" href="../CSS/styles.css"> <!-- Enlace a los estilos -->
</head>
<body>
    <header>
        <h1>Reportes</h1>
    </header>

    <main>
        <!-- Formulario para seleccionar el tipo de reporte -->
        <section>
            <h2>Generar Reporte</h2>
            <form method="POST" action="reportes.php">
                <label for="reporte_tipo">Tipo de Reporte:</label>
                <select name="reporte_tipo" id="reporte_tipo" required>
                    <option value="ventas" <?php if ($reporte_tipo == 'ventas') echo 'selected'; ?>>Ventas</option>
                    <option value="productos" <?php if ($reporte_tipo == 'productos') echo 'selected'; ?>>Productos</option>
                    <option value="inventario" <?php if ($reporte_tipo == 'inventario') echo 'selected'; ?>>Inventario</option>
                </select>

                <label for="fecha_inicio">Fecha Inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" value="<?php echo $fecha_inicio; ?>" required>

                <label for="fecha_fin">Fecha Fin:</label>
                <input type="date" name="fecha_fin" id="fecha_fin" value="<?php echo $fecha_fin; ?>" required>

                <button type="submit">Generar Reporte</button>
            </form>
        </section>

        <!-- Mostrar el reporte -->
        <section>
            <?php if (!empty($result)): ?>
                <h2>Resultados del Reporte</h2>
                <?php if ($reporte_tipo == 'ventas'): ?>
                    <table>
                        <tr>
                            <th>ID Venta</th>
                            <th>Cliente</th>
                            <th>Fecha de Venta</th>
                            <th>Total de Venta</th>
                        </tr>
                        <?php foreach ($result as $venta): ?>
                            <tr>
                                <td><?php echo $venta['id_venta']; ?></td>
                                <td><?php echo $venta['id_cliente']; ?></td>
                                <td><?php echo $venta['fecha_venta']; ?></td>
                                <td><?php echo $venta['total_venta']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php elseif ($reporte_tipo == 'productos'): ?>
                    <table>
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Descripción</th>
                        </tr>
                        <?php foreach ($result as $producto): ?>
                            <tr>
                                <td><?php echo $producto['id_producto']; ?></td>
                                <td><?php echo $producto['nombre_producto']; ?></td>
                                <td><?php echo $producto['precio']; ?></td>
                                <td><?php echo $producto['stock']; ?></td>
                                <td><?php echo $producto['descripcion']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php elseif ($reporte_tipo == 'inventario'): ?>
                    <table>
                        <tr>
                            <th>ID Movimiento</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Tipo de Movimiento</th>
                            <th>Fecha de Movimiento</th>
                        </tr>
                        <?php foreach ($result as $movimiento): ?>
                            <tr>
                                <td><?php echo $movimiento['id_movimiento']; ?></td>
                                <td><?php echo $movimiento['id_producto']; ?></td>
                                <td><?php echo $movimiento['cantidad']; ?></td>
                                <td><?php echo $movimiento['tipo_movimiento']; ?></td>
                                <td><?php echo $movimiento['fecha_movimiento']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            <?php else: ?>
                <p>No se encontraron resultados para este reporte.</p>
            <?php endif; ?>
        </section>
    </main>

    <!--<footer>
        <p>&copy; 2024 Tortas y Pongues Lucy. Todos los derechos reservados.</p>
    </footer>-->
</body>
</html>

<?php $conn = null; ?> <!-- Cerrar la conexión -->