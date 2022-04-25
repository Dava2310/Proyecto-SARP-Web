<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes Pendientes</title>
</head>
<body>
    <header>
        <h1>Solicitudes Pendientes</h1> <hr>
        <img src="/SARP/views/images/boton-x.png" alt="">
        <h2>Lista de Cupos:</h2>
        <input type="text" name="" id="">
    </header>
    <nav>
        <a href="./datosPersonales.html">Datos Personales</a>
        <a href="./datosBancarios.html">Datos Bancarios</a>
        Camión
        <a href="./addCamion.html">Añadir Camión</a>
        <a href="./buscarCamion.html">Consultar Camiones</a>
        Notificaciones
        <a href="./solicitudesPendientes.html">Solicitudes Pendientes</a>
        <a href="./solicitudesAceptadas.html">Solicitudes Aceptadas</a>
        <a href="./solicitudesDenegadas.html">Solicitudes Denegadas</a>
        <img src="/SARP/views/images/LOGOTIPO SARP+.png" alt="">
    </nav>
    <div class="contenido">
        <form action="" class="contenidoform">
            <div class="contenidoform-datos_solicitud">
                <div class="contenido-datos_solicitud-cantidadkilos">
                    <label for="cantidadkilos">Cantidad en Kilos:
                        <input type="text" name="cantidadkilos" id="cantidadkilos">
                    </label>
                </div>
                <div class="contenidoform-datos_solicitud-semana">
                    <label for="semana">Semana:
                        <input type="text" name="semana" id="semana">
                    </label>
                </div>
                <div class="contenidoform-datos_solicitud-sector">
                    <label for="cantidadkilos">Sector:
                        <input type="text" name="sector" id="sector">
                    </label>
                </div>
            </div>
            <div class="contenidoform-dias_solicitud">
                <!-- Dias -->
                <div class="contenidoform-dias_solicitud-dias">
                    <label for="dias">Días:</label>
                    <img src="/SARP/views/images/si.png" alt="">
                </div>
                <!-- Martes -->
                <div class="contenidoform-dias_solicitud-martes">
                    <label for="martes">Martes:
                        <input type="text" name="martes" id="martes">
                    </label>
                </div>
                <!-- Miercoles -->
                <div class="contenidoform-dias_solicitud-miercoles">
                    <label for="miercoles">Miércoles:
                        <input type="text" name="miercoles" id="miercoles">
                    </label>
                </div>
                <!-- Jueves -->
                <div class="contenidoform-dias_solicitud-jueves">
                    <label for="jueves">Jueves:
                        <input type="text" name="jueves" id="jueves">
                    </label>
                </div>
                <!-- Viernes -->
                <div class="contenidoform-dias_solicitud-viernes">
                    <label for="viernes">Viernes:
                        <input type="text" name="viernes" id="viernes">
                    </label>
                </div>
                <!-- Sabado -->
                <div class="contenidoform-dias_solicitud-sabado">
                    <label for="sabado">Sábado:
                        <input t ype="text" name="sabado" id="sabado">
                    </label>
                </div>
            </div>
            <div class="contenidoform-observacion">
                <label for="observacion">Observacion</label>
                <p><textarea name="observacion" placeholder="Coloca tus observaciones!"></textarea></p>
            </div>
        </form>
    </div>
</body>
</html>