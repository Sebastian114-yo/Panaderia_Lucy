<?php
// Incluir la conexión a la base de datos
include('db_conection.php');

// Obtener el balance total de la base de datos
$sql = "SELECT SUM(CASE WHEN tipo = 'Ingreso' THEN monto
                        WHEN tipo = 'Egreso' THEN -monto
                        ELSE 0 END) AS balance_total
        FROM transacciones";
$stmt = $conn->prepare($sql);
$stmt->execute();
$balance = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Total - Tortas y Ponqués Lucy</title>
    <link rel="stylesheet" href="../CSS/styles.css"> <!-- Enlace a tu archivo CSS -->
</head>
<body>

    <!-- Barra de navegación -->
    <?php include('navbar.php'); ?>

    <main>
        <header>
            <h1>Balance Total</h1>
        </header>

        <section>
            <h2>Balance Actual</h2>
            <p><strong>Balance Total:</strong> <?php echo number_format($balance['balance_total'], 2); ?> </p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Tortas y Ponqués Lucy. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
