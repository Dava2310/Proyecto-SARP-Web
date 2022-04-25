<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Camión</title>
</head>
<body>
    <header>
        <h1>Buscar Camión</h1>
        <hr>
        <img src="/SARP/views/images/camion.png" alt="">
        <h4>Lista de Camiones:</h4>
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
        <form action="">
            Placa:
            <input type="text" name ="" id="">
            Capacidad en Toneladas:
            <input type="text" name="" id="">
            Modelo:
            <input type="text" name="" id="">
            <button>Cambiar datos</button>
            <button type="reset">Deshacer</button>
            <button>Guardar Cambios</button>
        </form>
        <h2>Choferes</h2> <img src="/SARP/views/images/chofer.png" alt=""> <hr> 
        <form action="">          
            Nombre Completo (1):
            <input type="text" name ="" id="">
            Cédula de Identidad (1):
            <input type="tex t" name="" id="">
            <button>Cambiar datos</button>
            <button type="reset">Guardar Cambios</button>
            <button>Eliminar</button> 
        </form>
        <form action="">          
            Nombre Completo (2):
            <input type="text" name ="" id="">
            Cédula de Identidad (2):
            <input type="tex t" name="" id="">
            <button>Cambiar datos</button>
            <button type="reset">Guardar Cambios</button>
            <button>Eliminar</button> 
        </form>
    </div>
</body>
</html>