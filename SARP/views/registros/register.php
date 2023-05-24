<?php
    $_titulo = "Registro de Usuario";
    include('../templates/headRegistros.php');
?>
<body>
    <div class="container-fluid">
        <div class="row">
    
                <!-- IMAGEN DE FONDO -->
                <div class="fondo col-8" style="padding: 0;">
                    <img class="fondo-imagen" src="../../assets/images/LOGO.png" alt="fondo">
                </div>
        
                <!-- PARTE DEL REGISTRO -->
                <div class="registro col-4 align-self-center">
                    <div class="registro-cabecera row justify-content-center ">

                        <img src="../../assets/images/verificar.png" alt="" style="width: 50px; height: 50px;">
                        <h1>Registro</h1>

                    </div>

                    <div class="descripcion row justify-content-center">
                        <p>Registra tus datos para posteriormente ingresar al sistema.</p>
                    </div>
                    <hr>

                    <div class="contenedorform">
                        <h2>Datos Personales:</h2>
                        <hr>
                        <form id="form" >
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>
                            <p id='errorName'></p>

                            <div class="form-group">
                                <label for="Apellido">Apellido:
                                </label>
                                <input type="text" name="Apellido" id="Apellido" class="form-control" required>
                            </div>
                            <p id='errorApellido'></p>

                            <div class="form-group">
                                <label for="Cedula">Cedula:
                                </label>
                                <input type="text" name="Cedula" id="Cedula" class="form-control" required>
                            </div>
                            <p id='errorCedula'></p>
                            
                            <h2>Datos de Usuario:</h2> <hr>
                            <div class="form-group">
                                <label for="email">Email de Usuario:</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            <p id='errorCorreo'></p>

                            <div class="form-group">
                                <label for="password">Contraseña: </label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <p id='errorPassword'></p>

                            <div class="descripcion">
                                <p> <b> Asegúrese de resguardar la pregunta de seguridad y su respuesta </b></p>
                            </div>
                            <div class="form-group">
                                <label for="question">Pregunta de seguridad: </label>
                                <input type="text" name="question" id="question" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="answer">Respuesta: </label>
                                <input type="text" name="answer" id="answer" class="form-control" required>
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
                            <p class="inicioSesion">¿Olvidaste la contraseña de tu cuenta? <a href="login.php">Recupera tu contraseña aquí.</a>.</p>
                            <p class="inicioSesion">¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión aquí</a>.</p>
                            <div class="botones">
                                <button type="reset" class="btn btn-primary">Limpiar</button>
                                <button name="submit" type="submit" class="btn btn-success">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            
        </div>
    </div>

    <!-- Include formulario.js -->

    <script src="../../assets/js/registros/formulario.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
	<script src="../../assets/js/jquery-3.2.1.min.js"></script>
</body>
</html>