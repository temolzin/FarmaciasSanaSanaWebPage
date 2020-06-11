<?php
session_start();
require 'menuView.php';
require '../procesos/conexion.php';
$conex = Conexion::getInstance();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/sweetalert.min.js"></script>
    
    <title>Consulta de Comentarios</title>
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
  <link href="../../css/jquery-ui.min.css" rel="stylesheet" />
  <link href="../../css/jquery-ui.theme.min.css" rel="stylesheet" />
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
                  menu('reporteComentario');
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
                        Consulta Comentarios.
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div align="center">
                 <div class="col-md-2"></div>
                 <form method="POST" id="formulario" name="formulario">
                   <div class="col-md-2">
                      <font size="4" color="black">Sucursal:</font>
                    </div>
                    <div class="col-md-3">
                      <select name="sucursal" class="form-control" id="sucursal" >
                      	<option value="Global">Global</option> 
                      	<?php 
                      	$consulta = $conex->consultar("select * from sucursales");
                      	foreach ($consulta as $row) {
                      		echo '<option value = "'.$row['nombreSucursal'].'" > '.$row['nombreSucursal'].' </option>';
                      	}    
                      	?> 
                      </select> 
                    </div>
                    <div class="col-md-3">
                      <button class="btn btn-success " name="btnConsultar" id="btnBuscar">Consultar</button> 
                    </div>
                  </form>
                  </div>
                      <script>
    $(document).ready(function() {
    $("#formulario").validate({
        rules: {
            txtBuscar: {
              required: true
            }
        },
        messages: {
            txtBuscar: {
              required: "<font color='red'> Ingresa un producto para buscar</p>"
            }
        },
        submitHandler: function(){
          $('#bodyTabla').html('<div align="center"><img src="../../images/formularios/cargando.gif"/><br><p class="text-info lead">Cargando...</p><br></div>');
            $.ajax({
                  type: "POST",
                  url: '../procesos/consultaComentario.php',
                  data: $('#formulario').serialize(),
                  success: function(data) {
                    document.getElementById('bodyTabla').innerHTML='';
                    $('#bodyTabla').fadeIn(5000).html(data);
                    document.getElementById('btnExcel').style.display = 'block';
                    document.getElementById('btnWord').style.display = 'block';
                  }
             });
        }
    });
  });
    </script>
                    </br></br></br>
                    <!-- Inicio del Datable -->    
                    <div id="bodyTabla" name="bodyTabla">
                      <!-- Aquí va la tabla completa -->
                    </div>      
                    <!-- Fin DataTable-->

                    <div class="col-md-3"></div>
                <div class="col-md-3">
                    <a href="../procesos/exportarArchivo/exportarComentarios.php?tipo=excel"><button class="btn btn-success btn-lg"  id="btnExcel" value="excel" style="display:none" name="btnExcel"><img width="18px" height="18px" src="../../images/formularios/excel.png"> Exportar a Excel</button></a>
                </div>
                <div class="col-md-3">
                    <a href="../procesos/exportarArchivo/exportarComentarios.php?tipo=word"><button class="btn btn-info btn-lg" id="btnWord" value="word" style="display:none" name="btnWord"><img width="18px" height="18px" src="../../images/formularios/word.png"> Exportar a Word</button></a>
                </div>


                    <br/><br/>
                
                 </div>
                 </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
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
