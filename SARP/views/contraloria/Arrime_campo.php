<?php
    session_start();
    $usuario = $_SESSION['ID'];

    $_titulo = "Arrime en el campo";
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
    usuario
    INNER JOIN siembras ON siembras.ID_Proveedor = usuario.ID_Usuario where siembras.Analisis = 'APROBADO'");

?>
<body>
    <div class="container-fluid">
        <div class="row"> 
    
                <?php
                    include("../templates/menuContraloria.php");
                ?>
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 col-12" style="background-color: #99BC78; height: 100vh; overflow-y: scroll;">
                    <div class="contenidoInterno" style="padding-top: 25px;">
                        <header class="row" style="margin-left: 10px;">
                            <div class=" col-md-6 col-sm-12 ">
                                <h2>Disponibilidad de arrime en el campo</h2>
                                <img class="imagen-titulo" src="../../assets/images/report.png" alt="" style="width: 50px; height: 50px;">
                            </div>
                        
                           
                        </header>
                        <hr>
                        <div class="row">
                            <table class=" table  table-bordered" style="background-color: white;">
                                <thead>
                                    <tr>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">N# de siembra</th>
                                    <th scope="col">Disponibilidad(kg)</th>
                                    <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php	
                                    while($row = $result->fetch_object()){
                                        
                                        echo "<tr>";
                                        echo "<th scope='row'>$row->Cedula</th>";
                                        echo "<td>$row->Nombre</td>";
                                        echo "<td>$row->Apellido</td>";
                                        echo "<td>$row->ID_Siembra</td>";
                                        echo "<td>$row->Kilos_Totales</td>";
                                        echo "<td>$row->Analisis</td>";
                                        echo "</tr>";
                                    }
                                ?>
                                   
                                </tbody>
                            </table> 
                        </div>
                                
                          
                         
                       
                        
<?php
    include ("../templates/footerFletero.php")
?>