<?php
// Incluir la conexión a la base de datos
include('db_conection.php');

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $tipo = $_POST['tipo'];  // Ingreso o Egreso
    $monto = $_POST['monto'];  // Monto de la transacción
    
    // Insertar la transacción en la base de datos
    $sql = "INSERT INTO transacciones (tipo, monto) VALUES (:tipo, :monto)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':monto', $monto);
    $stmt->execute();
    
    echo "Transacción registrada correctamente.";
}
?>

<form method="POST" action="agregar_transaccion.php">
    <label for="tipo">Tipo de Transacción:</label>
    <select name="tipo" id="tipo" required>
        <option value="Ingreso">Ingreso</option>
        <option value="Egreso">Egreso</option>
    </select>
    <br><br>
    
    <label for="monto">Monto:</label>
    <input type="number" name="monto" id="monto" step="0.01" required>
    <br><br>
    
    <button type="submit">Registrar Transacción</button>
</form>
