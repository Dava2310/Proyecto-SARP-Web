<?php
    $_titulo = "Recuperar contraseña";
    include('../templates/headRegistros.php');
?>
<body>
    <div class="container-fluid">
        <div class="row">
            
                <!-- IMAGEN DE FONDO -->
                <div class="fondo col-8" style="padding: 0;">
                    <img class="fondo-imagen" src="../../assets/images/LOGO.png" alt="fondo">
                </div>
                <!-- PARTE DEL FORMULARIO -->
                <div class="registro col-4 align-self-center">
                    <div class="registro-cabecera row justify-content-center">

                        <img src="../../assets/images/verificar.png" alt="" style="width: 50px; height: 50px;">
                        <h1>Recordar Contraseña</h1>

                    </div>
                    <!-- DESCRIPCION -->
                    <div class="descripcion row justify-content-center">
                        <p>Restaura la contraseña de tu cuenta.</p>
                    </div>
                    <hr>
                    <div class="contenedorform">
                        <h2>Datos de usuario:</h2> <hr>
                        <form id="form">
                            <div class="form-group">
                                <label for="email">Email de usuario:</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            <p id='errorCorreo'></p>
                            <div class="form-group">
                                <label for="newP">Nueva contraseña:</label>
                                <input type="password" name="newP" id="newP" class="form-control" required>
                            </div>
                            <p id='errorPassword'></p>
                            <div class="form-group">
                                <label for="question">Pregunta de seguridad:</label>
                                <input type="text" name="question" id="question" class="form-control" required>
                            </div>
                            <p id='errorPregunta'></p>
                            <div class="form-group">
                                <label for="answer">Respuesta:</label>
                                <input type="text" name="answer" id="answer" class="form-control" required>
                            </div>
                            <p id='errorRespuesta'></p>
                            <div class="descripcion">
                                <p> <b> Tipo de usuario debe ser el mismo de la cuenta original. </b></p>
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
                            <p class="inicioSesion">¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión aquí</a>.</p>
                            <p class="inicioSesion">¿No tienes una cuenta? <a href="register.php">Create una aquí</a>.</p>
                            <div class="botones">
                                <button type="reset" class="btn btn-primary">Limpiar</button>
                                <button name="submit" type="submit" class="btn btn-success">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            
        </div>
    </div>

    <!-- Insert script recover.js -->

    <script src="../../assets/js/registros/recover.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
	<script src="../../assets/js/jquery-3.2.1.min.js"></script>
</body>
</html>