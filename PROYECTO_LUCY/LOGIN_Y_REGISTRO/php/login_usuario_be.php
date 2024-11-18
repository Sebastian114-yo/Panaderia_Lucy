<?php
include 'conexion_be.php';

if (isset($_POST['correo']) && isset($_POST['contrasena'])) {
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);

    // Consulta para validar login
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'");

    if (mysqli_num_rows($validar_login) > 0) {
        header("Location: http://localhost/PROYECTO_LUCY/PAGINA/php/index.php"); //ESTE ES EL DEL LINKKKKKKKKKKKKKKKKKKK
        exit;
    } else {
        echo '
            <script>
                alert("Usuario no existe, por favor verifique los datos introducidos");
                window.location = "../login.php";
            </script>
        ';
        exit;
    }
} else {
    echo '<script>alert("Error: Datos no recibidos."); window.location = "../login.php";</script>';
    exit;
}
?>