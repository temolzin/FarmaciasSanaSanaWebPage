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
                  menu('facturasRealizadas');
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
                        Facturas Realizadas.
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
                             Facturas realizadas.
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th>Estado</th>
                                        	<?php
                                        	if($_SESSION['tipoUsuario'] == 'Administrador'){
                                        		echo '<th>Realizó</th>';
                                        	}
                                        	?>
                                        	<th>Fecha Petición</th>
                                            <th>Fecha Realizada</th>
                                            <th>Ticket</th>
                                            <th>Sucursal</th>
                                            <th>Tipo Pago</th>
                                            <th>email</th>
                                            <th>RFC</th>
                                            <th>Nombre</th>
                                            <th>CURP</th>
                                            <th>Teléfono</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    require 'conexion.php';
                                        $conex = Conexion::getinstance();
                                        $consulta = $conex->consultar("select facturaRealizada.id_factura,nombreUsuario,fecha_realizada, tipoPago, fecha_factura, numTicket, 
                                        	nombreSucursal, cliente.email, rfc, cliente.nombre, curp, cliente.telefono from facturaRealizada inner join 
                                        	factura on facturaRealizada.id_factura = factura.id_factura inner join
                                        	cliente on factura.id_cliente = cliente.id_cliente inner join
                                        	sucursales on factura.id_sucursal = sucursales.id_sucursal inner join
                                        	usuario on facturaRealizada.id_usuario = usuario.id_usuario order by fecha_realizada desc");

                                      if($consulta != null) {
                                        foreach ($consulta as $row) {
                                        	$id_factura = $row['id_factura'];
                                        	$imagen = "<img src= '../../images/formularios/facturaOk.png'>";
                                            $fecha1 = date_create($row['fecha_factura']);
                                            $fecha_factura = date_format($fecha1,'d-m-Y H:i:s');
                                            $numTicket = $row["numTicket"];
                                            $nombreSucursal = $row['nombreSucursal'];
                                            $tipoPago = $row["tipoPago"];
                                            $email = $row['email'];
                                            $telefono = $row['telefono'];
                                            $rfc = $row["rfc"];
                                            $nombre = $row["nombre"];
                                            $curp = $row["curp"];
                                            $fecha2 = date_create($row['fecha_realizada']);
                                            $fecha_realizada = date_format($fecha2,'d-m-Y H:i:s');
                                            $nombreUsuario = $row["nombreUsuario"];                                        
                                          echo '
                                          <tr>
                                            <td align="center" >'.$imagen.'</td>
                                            ';
                                            if($_SESSION['tipoUsuario'] == 'Administrador'){
                                            	echo'<td>'.$nombreUsuario.'</td>';
                                            }
                                            echo'
                                            <td>'.$fecha_factura.'</td>
                                            <td>'.$fecha_realizada.'</td>
                                            <td>'.$numTicket.'</td>
                                            <td>'.$nombreSucursal.'</td>
                                            <td>'.$tipoPago.'</td>
                                            <td>'.$email.'</td>
                                            <td>'.$rfc.'</td>
                                            <td>'.$nombre.'</td>
                                            <td>'.$curp.'</td>
                                            <td>'.$telefono.'</td>
                                            ';
                                          echo '</tr>';
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
    
   
</body>
</html>

