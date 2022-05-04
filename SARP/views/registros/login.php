<?php
    $_titulo = "Inicio de Sesión";
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

                <!-- PARTE DEL LOGIN -->
                <div class="registro">
                    <div class="registro-cabecera" style="margin-top: 100px;">
                        <div class="registro-cabecera-imagen">
                            <img src="/SARP/assets/images/verificar.png" alt="">
                        </div>
                        <h1>Inicio de Sesión</h1>
                    </div>
                    <!-- DESCRIPCION DEL INICIO DE SESION -->
                    <div class="descripcion">
                        <h4>Ingresa tus datos para acceder a tu cuenta.</h4>
                    </div>
                    <!-- FORMULARIO -->
                    <div class="contenedorform">
                        <form action="../../controllers/registros/validarUsuario.php" method="post">
                            <h2>Datos de Usuario:</h2> <hr>
                            <div class="form-group">
                                <label for="email">Correo de Usuario</label>
                                <input class="form-control" type="text" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input class="form-control" type="password" name="password" id="password" required>
                            </div>
                            <div class="form-group">
                                <label for="tipoUsuario">Cargo Designado:</label>
                                <select name="tipoUsuario" id="tipoUsuario" class="form-control" required>
                                    <option value="">-- SELECCIONE TIPO -- </option>
                                    <option value="1">Contralor</option>
                                    <option value="2">Agropecuario</option>
                                    <option value="3">Proveedor</option>
                                    <option value="4">Fletero</option>
                                </select>
                            </div>
                            <p class="inicioSesion">¿Olvidazte tu contraseña?<a href="recover.php"> Haz clic aquí</a>.</p>
                            <p class="inicioSesion">¿No tienes una cuenta?<a href="register.php"> Crea una cuenta aquí</a>.</p>
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

