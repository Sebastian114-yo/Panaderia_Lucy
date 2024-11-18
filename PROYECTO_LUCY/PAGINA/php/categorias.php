<?php 
// Incluir la barra de navegación
include('navbar.php');

// Incluir archivo de conexión a la base de datos
include('db_conection.php');
// Consulta para obtener todas las categorías
$sql = "SELECT * FROM Categorias";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - Tortas y Pongues Lucy</title>
    <link rel="stylesheet" href="../CSS/styles.css"> <!-- Enlace a los estilos -->
</head>
<body>
    <header>
        <h1>Categorías</h1>
    </header>

    <main>
        <a href="productos.php">
            <button>Ir a Productos</button>
        </a>
        <a href="index.php">
            <button>Regresar al Inicio</button>
        </a>

        <!-- Mostrar las categorías en una tabla -->
        <section>
            <h2>Lista de Categorías</h2>
            <?php if ($result->rowCount() > 0): ?> <!-- Usamos rowCount() en vez de num_rows -->
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Categoría</th>
                    </tr>
                    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?> <!-- Usamos fetch(PDO::FETCH_ASSOC) -->
                        <tr>
                            <td><?php echo $row['id_categoria']; ?></td>
                            <td><?php echo $row['nombre_categoria']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>No hay categorías registradas.</p>
            <?php endif; ?>
        </section>
    </main>
    
    <!--<footer>
        <p>&copy; 2024 Tortas y Pongues Lucy. Todos los derechos reservados.</p>
    </footer>-->
</body>
</html>

<?php $conn = null; ?> <!-- Cerrar la conexión correctamente -->