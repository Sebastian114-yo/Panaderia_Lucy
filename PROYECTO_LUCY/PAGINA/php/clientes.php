<?php 
// Incluir la barra de navegación
include('navbar.php');

// Incluir archivo de conexión a la base de datos
include('db_conection.php');

// Procesar el formulario para agregar un cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_cliente = $_POST['nombre_cliente'];
    $email_cliente = $_POST['email_cliente'];

    // Insertar cliente
    $sql = "INSERT INTO Clientes (nombre_cliente, email_cliente) 
            VALUES (:nombre_cliente, :email_cliente)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre_cliente', $nombre_cliente, PDO::PARAM_STR);
    $stmt->bindParam(':email_cliente', $email_cliente, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "<p>Cliente agregado exitosamente.</p>";
    } else {
        echo "<p>Error al agregar el cliente.</p>";
    }
}

// Obtener los clientes
$sql = "SELECT * FROM Clientes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - Tortas y Pongues Lucy</title>
    <link rel="stylesheet" href="../CSS/styles.css"> <!-- Estilo CSS -->
</head>
<body>
    <header>
        <h1>Clientes</h1>
    </header>

    <main>
        <!-- Formulario para agregar clientes -->
        <section>
            <h2>Agregar Cliente</h2>
            <form method="POST" action="clientes.php">
                <label for="nombre_cliente">Nombre:</label>
                <input type="text" name="nombre_cliente" id="nombre_cliente" required>

                <label for="email_cliente">Correo electrónico:</label>
                <input type="email" name="email_cliente" id="email_cliente" required>

                <button type="submit">Agregar Cliente</button>
            </form>
        </section>

        <!-- Mostrar los clientes en una tabla -->
        <section>
            <h2>Lista de Clientes</h2>
            <?php if ($result->rowCount() > 0): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                    </tr>
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?php echo $row['id_cliente']; ?></td>
                            <td><?php echo $row['nombre_cliente']; ?></td>
                            <td><?php echo $row['email_cliente']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No hay clientes registrados.</p>
            <?php endif; ?>
        </section>
    </main>
    
    <!--<footer>
        <p>&copy; 2024 Tortas y Pongues Lucy. Todos los derechos reservados.</p>
    </footer>-->
</body>
</html>

<?php $conn = null; ?> <!-- Cerrar la conexión -->