<?php
$host = 'localhost'; // Servidor de la base de datos
$dbname = 'panaderia'; // Nombre de la base de datos
$username = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña del usuario

// Crear conexión
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurar el modo de error de PDO para excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En caso de error, mostrar un mensaje
    echo "Error de conexión: " . $e->getMessage();
}
?>