<?php 
// Incluir la barra de navegación
include('navbar.php');

// Incluir archivo de conexión a la base de datos
include('db_conection.php');

// Procesar el formulario para agregar una venta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $fecha_venta = $_POST['fecha_venta'];
    $total_venta = $_POST['total_venta'];

    // Insertar venta
    $sql = "INSERT INTO Ventas (id_cliente, fecha_venta, total_venta) 
            VALUES (:id_cliente, :fecha_venta, :total_venta)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt->bindParam(':fecha_venta', $fecha_venta, PDO::PARAM_STR);
    $stmt->bindParam(':total_venta', $total_venta, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<p>Venta registrada exitosamente.</p>";
    } else {
        echo "<p>Error al registrar la venta.</p>";
    }
}

// Obtener ventas
$sql = "SELECT * FROM Ventas";
$result = $conn->query($sql);

// Obtener todos los clientes para mostrar en el formulario
$sql_clientes = "SELECT * FROM Clientes";
$clientes = $conn->query($sql_clientes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas - Tortas y Pongues Lucy</title>
    <link rel="stylesheet" href="../CSS/styles.css"> <!-- Enlace a los estilos -->
</head>
<body>
    <header>
        <h1>Ventas</h1>
    </header>

    <main>
        <!-- Formulario para agregar una venta -->
        <section>
            <h2>Agregar Venta</h2>
            <form method="POST" action="ventas.php">
                <label for="id_cliente">Cliente:</label>
                <select name="id_cliente" id="id_cliente" required>
                    <?php while ($cliente = $clientes->fetch(PDO::FETCH_ASSOC)): ?>
                        <option value="<?php echo $cliente['id_cliente']; ?>"><?php echo $cliente['nombre_cliente']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="fecha_venta">Fecha de Venta:</label>
                <input type="date" name="fecha_venta" id="fecha_venta" required>

                <label for="total_venta">Total de la Venta:</label>
                <input type="number" name="total_venta" id="total_venta" required>

                <button type="submit">Registrar Venta</button>
            </form>
        </section>

        <!-- Mostrar las ventas en una tabla -->
        <section>
            <h2>Lista de Ventas</h2>
            <?php if ($result->rowCount() > 0): ?>
                <table>
                    <tr>
                        <th>ID Venta</th>
                        <th>Cliente</th>
                        <th>Fecha de Venta</th>
                        <th>Total de Venta</th>
                    </tr>
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $row['id_venta']; ?></td>
                            <td><?php echo $row['id_cliente']; ?></td>
                            <td><?php echo $row['fecha_venta']; ?></td>
                            <td><?php echo $row['total_venta']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No hay ventas registradas.</p>
            <?php endif; ?>
        </section>
    </main>
    
    <!--<footer>
        <p>&copy; 2024 Tortas y Pongues Lucy. Todos los derechos reservados.</p>
    </footer>-->
</body>
</html>

<?php $conn = null; ?> <!-- Cerrar la conexión -->