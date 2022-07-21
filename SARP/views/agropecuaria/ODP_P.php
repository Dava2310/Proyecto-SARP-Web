<?php
     session_start();
     $usuario = $_SESSION['ID'];
 
     $_titulo = "ODP GENERAL";
     include('../templates/headFletero.php');
     include("../../controllers/conexion.php");
 
     if(!(isset($usuario))){
         echo "<script> window.alert('No ha iniciado sesion');</script>";
         echo "<script> window.location='../registros/login.php'; </script>";
         die();
     }
     
     $result = $con->query("SELECT *
     FROM
     tarifas
     INNER JOIN solicitud_proveedor ON tarifas.ID_Solicitud_Proveedor = solicitud_proveedor.ID_Solicitud_Proveedor
     INNER JOIN siembras ON solicitud_proveedor.ID_Siembra = siembras.ID_Siembra
     INNER JOIN usuario ON siembras.ID_Proveedor = usuario.ID_Usuario
     ");

     $fletero = $con->query("SELECT *
     FROM
     tarifas
     INNER JOIN solicitud_proveedor ON tarifas.ID_Solicitud_Proveedor = solicitud_proveedor.ID_Solicitud_Proveedor
     INNER JOIN solicitud_fletero ON solicitud_proveedor.ID_Solicitud_Fletero = solicitud_fletero.ID_Solicitud_Fletero
     INNER JOIN camiones ON solicitud_fletero.Placa = camiones.Placa
     INNER JOIN usuario ON camiones.ID_Fleteros = usuario.ID_Usuario");

     
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
                                <h2>ODP Pagadas</h2>
                                <img class="imagen-titulo" src="../../assets/images/report.png" alt="" style="width: 50px; height: 50px;">
                            </div>
                        
                           
                        </header>
                        <hr>
                        <div class="row" style="margin-left: 10px; margin-right: 10px; margin-bottom: 20px;">
                            <h3>ODP Proveedores</h3>
                            <table class=" table  table-bordered" style="background-color: white;">
                                <thead>
                                    <tr>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Banco</th>
                                    <th scope="col">Nro Cuenta</th>
                                    <th scope="col">Tipo de Cta</th>
                                    <th scope="col">Materia Prima</th>
                                    <th scope="col">Cuadrilla</th>
                                    <th scope="col">Total</th>
                                    

                                    </tr>
                                </thead>
                                <tbody>
                                <?php	
                                    while($row = $result->fetch_object()){
                                        
                                        echo "<tr>";
                                        echo "<th scope='row'>$row->Cedula</th>";
                                        echo "<td>$row->Nombre $row->Apellido</td>";
                                        echo "<td>$row->Banco_P</td>";
                                        echo "<td>$row->Cuenta_P</td>";
                                        echo "<td>$row->TipoCuenta_P</td>";
                                        echo "<td>$row->Pago_MP</td>";
                                        echo "<td>$row->Pago_Cuadrilla</td>";
                                        echo "<td> $row->Pago_Cuadrilla+$row->Pago_MP </td>";
                                        echo "</tr>";
                                    }
                                ?>
                                   
                                </tbody>
                            </table> 
                        </div>
                        <div class="row" style="margin-left: 10px;  margin-right: 10px; margin-bottom: 20px;">
                            <h3>ODP Fleteros</h3>
                            <table class=" table  table-bordered" style="background-color: white;">
                                <thead>
                                <tr>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Banco</th>
                                    <th scope="col">Nro Cuenta</th>
                                    <th scope="col">Tipo de Cta</th>
                                    <th scope="col">Flete</th>
                                    <th scope="col">Total</th>
                                    

                                    </tr>
                                </thead>
                                <tbody>
                                <?php	
                                    while($row = $fletero->fetch_object()){
                                        
                                        echo "<tr>";
                                        echo "<th scope='row'>$row->Cedula</th>";
                                        echo "<td>$row->Nombre $row->Apellido</td>";
                                        echo "<td>$row->Banco_P</td>";
                                        echo "<td>$row->Cuenta_P</td>";
                                        echo "<td>$row->TipoCuenta_P</td>";
                                        echo "<td>$row->Pago_Flete</td>";
                                        echo "<td> $row->Pago_Flete </td>";
                                        echo "</tr>";
                                    }
                                ?>
                                   
                                </tbody>
                            </table> 
                        </div>
                                
                          
                         
                       
                        
<?php
    include ("../templates/footerFletero.php")
?>