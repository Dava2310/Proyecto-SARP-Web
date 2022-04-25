<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Plantillas de ODP</title>
</head>
<body>
    <header>
        <h1>Plantillas de ODP</h1>
        <img src="/SARP/views/images/payment-method.png" alt="">
    </header>
    <nav>
        <a href="./datosPersonales.html">Datos Personales</a>
        <a href="./datosProveedores.html">Datos Proveedores</a>
        <a href="./datosFleteros.html">Datos Fleteros</a>
        <a href="./reportes.html">Generación de Reportes</a>
        <a href="./tarifas.html">Tarifas</a>
        <a href="./ODP.html">Plantillas de ODP</a>
        <img src="/SARP/views/images/LOGOTIPO SARP+.png" alt="">
    </nav>
    <div class="contenido">
        <div class="contenido-generarodp">
            <label for="generarodp">Generar plantillas de ODP.</label>
            <select name="semana-1" id="semana-1">
                <!-- opciones -->
            </select>
            <button class="boton">Generar Reporte.</button>
        </div>
        <div class="contenido-confirmacion">
            <label for="confirmacion">Confirmar estado de confirmación.</label>
            <select name="semana-2" id="semana-2">
                <!-- opciones -->
            </select>
            <button class="boton">Generar Reporte.</button>
        </div>
        <div class="contenido-odpno">
            <label for="odpno">Reporte de ODP no pagadas.</label>
            <select name="semana-3" id="semana-3">
                <!-- opciones -->
            </select>
            <button class="boton">Generar Reporte.</button>
        </div>
        <div class="contenido-odpsi">
            <label for="odpsi">Reporte de ODP pagadas.</label>
            <select name="semana-4" id="semana-4">
                <!-- opciones -->
            </select>
            <button class="boton">Generar Reporte.</button>
        </div>
    </div>
</body>
</html>