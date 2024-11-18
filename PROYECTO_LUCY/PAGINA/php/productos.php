<?php 
// Incluir la barra de navegación
include('navbar.php');

// Incluir archivo de conexión a la base de datos
include('db_conection.php');

// Procesar el formulario para agregar un producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_producto = $_POST['nombre_producto'];
    $id_categoria = $_POST['categoria'];  // Cambié esta variable a $id_categoria, debe ser un ID numérico
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];

    // Insertar producto
    $sql = "INSERT INTO Productos (nombre_producto, id_categoria, precio, stock, descripcion) 
            VALUES (:nombre_producto, :id_categoria, :precio, :stock, :descripcion)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre_producto', $nombre_producto, PDO::PARAM_STR);
    $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT); // Ahora estamos usando 'id_categoria' y debe ser un valor numérico
    $stmt->bindParam(':precio', $precio, PDO::PARAM_INT);
    $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "<p>Producto agregado exitosamente.</p>";
    } else {
        echo "<p>Error al agregar el producto.</p>";
    }
}

// Obtener productos
$sql = "SELECT * FROM Productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Tortas y Pongues Lucy</title>
    <link rel="stylesheet" href="../CSS/styles.css"> <!-- Estilo CSS -->
</head>
<body>
    <header>
        <h1>Productos</h1>
    </header>

    <main>
        <!-- Formulario para agregar productos -->
        <section>
            <h2>Agregar Producto</h2>
            <form method="POST" action="productos.php">
                <label for="nombre_producto">Nombre del Producto:</label>
                <input type="text" name="nombre_producto" id="nombre_producto" required>

                <label for="categoria">Categoría (ID):</label>
                <input type="number" name="categoria" id="categoria" required> <!-- Ahora debería ingresar el ID de la categoría -->

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" required>

                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" required>

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" required></textarea>

                <button type="submit">Agregar Producto</button>
            </form>
        </section>

        <!-- Mostrar los productos en una tabla -->
        <section>
            <h2>Lista de Productos</h2>
            <?php if ($result->rowCount() > 0): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Descripción</th>
                    </tr>
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $row['id_producto']; ?></td>
                            <td><?php echo $row['nombre_producto']; ?></td>
                            <td><?php echo $row['id_categoria']; ?></td> <!-- Aquí se muestra el ID de categoría -->
                            <td><?php echo $row['precio']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No hay productos registrados.</p>
            <?php endif; ?>
        </section>
    </main>
    
    <!--<footer>
        <p>&copy; 2024 Tortas y Pongues Lucy. Todos los derechos reservados.</p>
    </footer>-->
</body>
</html>

<?php $conn = null; ?> <!-- Cerrar la conexión -->
