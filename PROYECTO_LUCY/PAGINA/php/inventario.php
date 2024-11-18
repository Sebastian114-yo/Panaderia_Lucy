<?php 
// Incluir la barra de navegación
include('navbar.php');

// Incluir archivo de conexión a la base de datos
include('db_conection.php');

// Procesar el formulario para agregar un movimiento de inventario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $tipo_movimiento = $_POST['tipo_movimiento']; // Entrada o salida
    $fecha_movimiento = $_POST['fecha_movimiento'];

    // Insertar movimiento en inventario
    $sql = "INSERT INTO Inventario (id_producto, cantidad, tipo_movimiento, fecha_movimiento) 
            VALUES (:id_producto, :cantidad, :tipo_movimiento, :fecha_movimiento)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
    $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    $stmt->bindParam(':tipo_movimiento', $tipo_movimiento, PDO::PARAM_STR);
    $stmt->bindParam(':fecha_movimiento', $fecha_movimiento, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "<p>Movimiento de inventario registrado exitosamente.</p>";
    } else {
        echo "<p>Error al registrar el movimiento de inventario.</p>";
    }
}

// Obtener productos para mostrar en el formulario
$sql_productos = "SELECT * FROM Productos";
$productos = $conn->query($sql_productos);

// Obtener movimientos de inventario
$sql_inventario = "SELECT * FROM Inventario";
$movimientos = $conn->query($sql_inventario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Tortas y Pongues Lucy</title>
    <link rel="stylesheet" href="../CSS/styles.css"> <!-- Enlace a los estilos -->
</head>
<body>
    <header>
        <h1>Inventario</h1>
    </header>

    <main>
        <!-- Formulario para agregar un movimiento de inventario -->
        <section>
            <h2>Agregar Movimiento de Inventario</h2>
            <form method="POST" action="inventario.php">
                <label for="id_producto">Producto:</label>
                <select name="id_producto" id="id_producto" required>
                    <?php while ($producto = $productos->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['nombre_producto']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" required>

                <label for="tipo_movimiento">Tipo de Movimiento:</label>
                <select name="tipo_movimiento" id="tipo_movimiento" required>
                    <option value="Entrada">Entrada</option>
                    <option value="Salida">Salida</option>
                </select>

                <label for="fecha_movimiento">Fecha del Movimiento:</label>
                <input type="date" name="fecha_movimiento" id="fecha_movimiento" required>

                <button type="submit">Registrar Movimiento</button>
            </form>
        </section>

        <!-- Mostrar los movimientos de inventario -->
        <section>
            <h2>Movimientos de Inventario</h2>
            <?php if ($movimientos->rowCount() > 0): ?>
                <table>
                    <tr>
                        <th>ID Movimiento</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Tipo de Movimiento</th>
                        <th>Fecha de Movimiento</th>
                    </tr>
                    <?php while ($row = $movimientos->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $row['id_movimiento']; ?></td>
                            <td><?php echo $row['id_producto']; ?></td>
                            <td><?php echo $row['cantidad']; ?></td>
                            <td><?php echo $row['tipo_movimiento']; ?></td>
                            <td><?php echo $row['fecha_movimiento']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No hay movimientos de inventario registrados.</p>
            <?php endif; ?>
        </section>
    </main>
    
    <!--<footer>
        <p>&copy; 2024 Tortas y Pongues Lucy. Todos los derechos reservados.</p>
    </footer>-->
</body>
</html>

<?php $conn = null; ?> <!-- Cerrar la conexión -->