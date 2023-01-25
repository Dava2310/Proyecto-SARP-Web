<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Planificacion arrime";
    include('../templates/headFletero.php');
    include("../../controllers/conexion.php");
    $connection = Connection::getInstance();
    $con = $connection->getConnection();

    if(!(isset($usuario))){
        echo "<script> window.alert('No ha iniciado sesion');</script>";
        echo "<script> window.location='../registros/login.php'; </script>";
        die();
    }
    
    $result = $con->query("SELECT
    *
    FROM
    solicitud_proveedor
    INNER JOIN solicitud_fletero ON solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero
    INNER JOIN siembras ON solicitud_proveedor.ID_Siembra = siembras.ID_Siembra
    INNER JOIN usuario ON siembras.ID_Proveedor = usuario.ID_Usuario
    INNER JOIN planificaciones ON solicitud_proveedor.ID_Planificacion = planificaciones.ID_Planificacion
    WHERE
    solicitud_fletero.Estado_Aprobacion = 1 AND
    solicitud_proveedor.Estado_Aprobacion = 1");

    $fletero = $con->query("SELECT
    *
    FROM
    solicitud_proveedor
    INNER JOIN solicitud_fletero ON solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero
    INNER JOIN camiones ON solicitud_fletero.Placa = camiones.Placa
    INNER JOIN usuario ON camiones.ID_Fleteros = usuario.ID_Usuario
    WHERE
    solicitud_fletero.Estado_Aprobacion = 1 AND
    solicitud_proveedor.Estado_Aprobacion = 1");

    $Chofer = $con->query("SELECT
    *
    FROM
    solicitud_proveedor
    INNER JOIN solicitud_fletero ON solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero
    INNER JOIN camion_chofer ON solicitud_fletero.ID_chofer = camion_chofer.ID_Chofer
    INNER JOIN choferes ON camion_chofer.ID_Chofer = choferes.Cedula
    WHERE
    solicitud_fletero.Estado_Aprobacion = 1 AND
    solicitud_proveedor.Estado_Aprobacion = 1");
?>
<body>
    <div class="container-fluid">
        <div class="row"> 
    
                <?php
                    include("../templates/menuAgropecuaria.php");
                ?>
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <h2>Planificaciones Confirmadas</h2>
                                <img class="imagen-titulo" src="../../assets/images/report.png" alt="" style="width: 50px; height: 50px;">
                            </div>
                        
                           
                        </header>
                        <hr>
                        <div class="row">
                            <table class=" table  table-bordered" style="background-color: white;">
                                <thead>
                                    <tr>
                                    <th scope="col">ID Solicitud</th>
                                    <th scope="col">ID Siembra</th>
                                    <th scope="col">Observaciones</th>
                                    <th scope="col">Cantidad MP</th>
                                    <th scope="col">Semana</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">Fletero</th>
                                    <th scope="col">Camion</th>
                                    <th scope="col">Chofer</th>
                                    <th scope="col">Dia de retiro</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php	
                                    while($row = $result->fetch_object()){
                                        
                                        echo "<tr>";
                                        echo "<th scope='row'>$row->ID_Solicitud_Proveedor</th>";
                                        echo "<td>$row->ID_Siembra</td>";
                                        echo "<td>$row->Observaciones</td>";
                                        echo "<td>$row->Cantidad_MP</td>";
                                        echo "<td>$row->Semana</td>";
                                        echo "<td>$row->Nombre $row->Apellido</td>";
                                        while($row2 = $fletero -> fetch_object()){
                                            echo "<td>$row2->Nombre $row2->Apellido</td>";
                                            break;

                                        }
                                        echo "<td>$row->Placa</td>";
                                        
                                        while($row3 = $Chofer-> fetch_object()){
                                            echo "<td>$row3->Nombre $row3->Apellido</td>";
                                            break;
                                        }
                                        echo "<td>$row->Dia</td>";
                                        echo "</tr>";
                                    }
                                ?>
                                   
                                </tbody>
                            </table> 
                        </div>
                                
                          
                         
                       
                        
<?php
    include ("../templates/footerFletero.php")
?>