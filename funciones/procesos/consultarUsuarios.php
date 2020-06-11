<?php
session_start();
require '../vistas/menuView.php';
?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Consulta de usuarios</title>
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
                  menu('editarUsuario');
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
                        Usuarios Registrados en el Sistema.
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
                             Usuarios
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Nombre Usuario</th>
                                            <th>Nombre Completo</th>
                                            <th>Privilegios</th>
                                            <th>Teléfono</th>
                                            <th>Email</th>
                                            <th>Contraseña</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        require 'conexion.php';
                                        $conex = Conexion::getInstance();
                                        $consulta = $conex->consultar("select * from usuario where nombreUsuario NOT IN ('". $_SESSION['nombreUsuario'] . "', 'T.Roldan')");

                                        foreach ($consulta as $row) {
                                           //Consulta para saber el nombre del privilegio
                                            $consultaPrivilegio = $conex->consultar("select * from privilegios where id_privilegio = ". $row['tipoUsuario']);
                                            foreach ($consultaPrivilegio as $resultado) {
                                              $tipoUsuario = $resultado["nombrePrivilegio"];
                                            }
                                            $nombreCompleto = $row['nombre']." ".$row['ap_pat']." ".$row["ap_mat"];
                                            $id_usuario = $row["id_usuario"];
                                            $nombreUsuario = $row['nombreUsuario'];
                                            $nombre = $row['nombre'];
                                            $ap_pat = $row["ap_pat"];
                                            $ap_mat = $row["ap_mat"];
                                            $edad = $row["edad"];
                                            $email = $row["email"];
                                            $genero = $row["genero"];
                                            $telefono = $row["telefono"];
                                            $direccion = $row["direccion"];
                                            $password = $row["password"];
                                            $status = $row["status"];
                                            if($status == 1){
                                              $imagen = "<img src= '../../images/formularios/ok.png'>";
                                            } else{
                                              $imagen = "<img src= '../../images/formularios/error.png'";
                                            }
                                          echo '
                                          <tr>
                                            <td align="center" >'.$imagen.'</td>
                                            <td>'.$nombreUsuario.'</td>
                                            <td>'.$nombreCompleto.'</td>
                                            <td>'.$tipoUsuario.'</td>
                                            <td>'.$telefono.'</td>
                                            <td>'.$email.'</td>
                                            <td>'.$password.'</td>
                                            <td align="center"> <a href="../vistas/actualizarDatosUsuarioView.php?nombreUsuario='.$nombreUsuario .'"><img src="../../images/formularios/if_compose_1055085.png" /> </td>
                                            ';
                                          echo '</tr>';
                                        }
                                        $conex = null;
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

