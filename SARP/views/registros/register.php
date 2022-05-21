<?php
    $_titulo = "Registro de Usuario";
    include('../templates/headRegistros.php');
?>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="contenido">

                <!-- IMAGEN DE FONDO -->
                <div class="fondo">
                    <img class="fondo-imagen" src="../../assets/images/LOGO.png" alt="fondo">
                </div>
        
                <!-- PARTE DEL REGISTRO -->
                <div class="registro">
                    <div class="registro-cabecera">
                        <div class="registro-cabecera-imagen">
                            <img src="../../assets/images/verificar.png" alt="">
                        </div>
                        <h1>Registro</h1>
                    </div>

                    <div class="descripcion">
                        <h4>Registra tus datos para posteriormente ingresar al sistema.</h4>
                    </div>

                    <div class="contenedorform">
                        <h2>Datos Personales:</h2>
                        <hr>
                        <form action="../../controllers/registros/agregarUsuario.php" method="post">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido:
                                </label>
                                <input type="text" name="apellido" id="apellido" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cedula">Cedula:
                                </label>
                                <input type="text" name="cedula" id="cedula" class="form-control" required>
                            </div>
                            <h2>Datos de Usuario:</h2> <hr>
                            <div class="form-group">
                                <label for="email">Correo de Usuario:</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña: </label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tipoUsuario">Tipo de Usuario:</label>
                                <select name="tipoUsuario" id="tipoUsuario" class="form-control" required>
                                    <option value="">-- SELECCIONE TIPO -- </option>
                                    <option value="1">Contralor</option>
                                    <option value="2">Agropecuario</option>
                                    <option value="3">Proveedor</option>
                                    <option value="4">Fletero</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="codigo">Codigo de Seguridad:</label>
                                <input type="text" name="codigo" id="codigo" class="form-control" required>
                            </div>
                            <p class="inicioSesion">¿Ya tienes una cuenta? <a href="login.html">Inicia Sesión aquí</a>.</p>
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
    <script src="../../assets/js/bootstrap.min.js"></script>
	<script src="../../assets/js/jquery-3.2.1.min.js"></script>
</body>
</html>