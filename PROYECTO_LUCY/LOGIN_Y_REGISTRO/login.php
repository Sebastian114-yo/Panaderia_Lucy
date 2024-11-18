<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Y Register</title>
    <link rel="stylesheet" href="RECURSOS/css/estilos.css">

</head>
<body>
    <main>

        <div class="contenedor__todo">

        <!--Esto son las ventanas que permiten cambiar entre el login y el registro-->
            <div class="caja__trasera">

                <div class="caja_trasera_login">
                    <h3>¿Ya tienes una cuenta?  </h3>
                    <p>Inicia Sesión para ingresar a la pagina principal</p>
                    <button id="btn_login">Iniciar Sesión</button>
                </div>

                <div class="caja_trasera_register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Registrate para que puedas ingresar a la pagina principal</p>
                    <button id="btn_registro">Registro</button>
                </div>


            </div>
    

        <!--Estos son los formularios de login y registro-->
            <div class="contenedor__login-registro">

                <form action="php/login_usuario_be.php" method="POST" class="formulario_login">
                    <h2>Inicio Sesión</h2>
                    <input type="text" placeholder="Correo Electronico" name="correo">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <button>Ingresar</button>
                </form>

                <form action="php/registro_usuario_be.php" method="POST" class="formulario_registro">
                    <h2>Registro</h2>
                    <input type="text" placeholder="Nombre Completo" name="nombre_completo">
                    <input type="text" placeholder="Correo Electronico" name="correo">
                    <input type="text" placeholder="Usuario" name="usuario">
                    <input type="password" placeholder="Contraseña" name="contrasena">
                    <button>Registrar</button>
                </form>

            </div>


        </div>

    </main>
    
    <script src="RECURSOS/js/script.js"></script>
</body>
</html>