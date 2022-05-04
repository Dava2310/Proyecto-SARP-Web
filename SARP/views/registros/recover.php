<?php
    $_titulo = "Recuperar contraseña";
    include('../templates/headRegistros.php');
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="contenido">
                <!-- IMAGEN DE FONDO -->
                <div class="fondo">
                    <img class="fondo-imagen" src="/SARP/assets/images/LOGO.png" alt="fondo">
                </div>
                <!-- PARTE DEL FORMULARIO -->
                <div class="registro">
                    <div class="registro-cabecera">
                        <div class="registro-cabecera-imagen">
                            <img src="/SARP/assets/images/verificar.png" alt="">
                        </div>
                        <h1>Recordar Contraseña</h1>
                    </div>
                    <!-- DESCRIPCION -->
                    <div class="descripcion">
                        <h4>Restaura la contraseña de tu cuenta.</h4>
                    </div>

                    <div class="contenedorform">
                        <h2>Datos de usuario:</h2> <hr>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email">Correo de usuario:</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="newP">Nueva contraseña:</label>
                                <input type="text" name="newP" id="newP" class="form-control" required>
                            </div>
                            <div class="descripcion">
                                <h4>El cargo designado debe ser el mismo de la cuenta.</h4>
                            </div>
                            <div class="form-group">
                                <label for="cargo">Cargo designado:</label>
                                <input type="text" name="cargo" id="cargo" class="form-control" required>
                            </div>
                            <p class="inicioSesion">¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión aquí</a>.</p>
                            <div class="botones">
                                <button type="reset" class="btn btn-primary">Limpiar</button>
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/SARP/assets/js/bootstrap.min.js"></script>
	<script src="/SARP/assets/js/jquery-3.2.1.min.js"></script>
</body>
</html>