<?php
session_start();
require '../vistas/menuView.php';
?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Consulta de Facturas recibidas</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../../css/bootstrap.css" rel="stylesheet" />
    <link href="../../css/sweetalert.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../../css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../../css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <!-- TABLE STYLES-->
    <link href="../../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

   <!-- Favicon -->
   <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="#"><?php echo $_SESSION['tipoUsuario']?></a>-->
                <p class="navbar-brand" href="#"><?php echo $_SESSION['tipoUsuario']?></p> 
            </div>
              <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> 
                Farmacias Sana Sana &nbsp; 
                <a href="../procesos/cerrarSesion.php" class="btn btn-danger square-btn-adjust">Cerrar Sesión</a> 
              </div>
        </nav>   
           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <?php 
                  menu('facturasCorreo');
                 ?>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2 align="center">
                        Facturas Solicitadas via WEB.
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div align="center">
                    <!-- Inicio del Datable -->                  
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Facturas recibidas por correo.
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th>Estado</th>
                                        	<th>Fecha Petición</th>
                                            <th>Ticket</th>
                                            <th>Sucursal</th>
                                            <th>Tipo Pago</th>
                                            <th>Email</th>
                                            <th>RFC</th>
                                            <th>Nombre(Razón Social)</th>
                                            <th>CURP</th>
                                            <th>Teléfono</th>
                                            <th>Calle</th>
                                            <th>Colonia</th>
                                            <th>Delegación ó Municipio</th>
                                            <th>Ciudad</th>
                                            <th>Estado</th>
                                            <th>País</th>
                                            <th>No.Exterior</th>
                                            <th>No.Interior</th>
                                            <th>Código Postal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    require 'conexion.php';
                                        $conex = Conexion::getInstance();
                                        $consulta = $conex->consultar("select id_factura, fecha_factura, numTicket, tipoPago, nombreSucursal, email, rfc, nombre, curp, telefono,
                                        	calle, colonia, municipio, ciudad, estado, pais, codigoPostal,numExterior, numInterior from factura inner join 
                                        	cliente on factura.id_cliente = cliente.id_cliente inner join
                                        	sucursales on factura.id_sucursal = sucursales.id_sucursal 
                                        	where id_factura NOT IN (select id_factura from facturaRealizada) order by fecha_factura desc");
                                        if($consulta != null) {
                                            foreach ($consulta as $row) {
                                                $id_factura = $row['id_factura'];
                                                $imagen = "<a href='actualizarStatusFactura.php?fact=".$id_factura."''>
                                                <img src= '../../images/formularios/faltanteFactura.png'></a>";
                                                $fecha1 = date_create($row['fecha_factura']);
                                                $fecha_factura = date_format($fecha1,'d-m-Y H:i:s');
                                                $numTicket = $row["numTicket"];
                                                $nombreSucursal = $row['nombreSucursal'];
                                                $telefono = $row['telefono'];
                                                $tipoPago = $row["tipoPago"];
                                                $email = $row['email'];
                                                $rfc = $row["rfc"];
                                                $nombre = $row["nombre"];
                                                $curp = $row["curp"];
                                                $calle = $row["calle"];
                                                $colonia = $row["colonia"];
                                                $municipio = $row["municipio"];
                                                $ciudad = $row["ciudad"];
                                                $estado = $row["estado"];
                                                $pais = $row["pais"];
                                                $numExterior = $row["numExterior"];
                                                $numInterior= $row["numInterior"];
                                                $codigoPostal = $row["codigoPostal"]; 

                                              echo '
                                              <tr>
                                                <td align="center" >'.$imagen.'</td>
                                                <td>'.$fecha_factura.'</td>
                                                <td>'.$numTicket.'</td>
                                                <td>'.$nombreSucursal.'</td>
                                                <td>'.$tipoPago.'</td>
                                                <td>'.$email.'</td>
                                                <td>'.$rfc.'</td>
                                                <td>'.$nombre.'</td>
                                                <td>'.$curp.'</td>
                                                <td>'.$telefono.'</td>
                                                <td>'.$calle.'</td>
                                                <td>'.$colonia.'</td>
                                                <td>'.$municipio.'</td>
                                                <td>'.$ciudad.'</td>
                                                <td>'.$estado.'</td>
                                                <td>'.$pais.'</td>
                                                <td>'.$numExterior.'</td>
                                                <td>'.$numInterior.'</td>
                                                <td>'.$codigoPostal.'</td>
                                               </tr>';
                                            }
                                        }
                                        $conex->cerrarConex();
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Fin DataTable-->
                 </div>
                 </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../../js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../../js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
    <script src="../../js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="../../js/dataTables/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    <!-- CUSTOM SCRIPTS -->
    <script src="../../js/custom.js"></script>
    <script type="text/javascript" src="../../js/sweetalert.min.js"></script>S
</body>
</html>

