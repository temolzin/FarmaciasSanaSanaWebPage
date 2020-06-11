<?php
session_start();
require 'menuView.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/sweetalert.min.js"></script>
    <title>Reporte Anefar</title>
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
                  menu('reporteAnefar');
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
                        Reporte Anefar
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div align="center">
                 <div class="col-md-3"></div>
                 <form method="POST" action="../procesos/exportarArchivo/exportarReporteAnefartxt.php" id="formulario" name="formulario">
                    <div class="col-md-2">
                      <font size="4" color="black">Tipo de Reporte</font>
                    </div>
                    <div class="col-md-3">
                    <select id="tipoReporte" name="tipoReporte" class="form-control">
          						  <option value="venta">Venta</option>
          						  <option value="inventario">Inventario</option>
                        <option value="catalogo">Catálogo</option>
                    </select>
                    </div>
                    <br><br><br><br>
                    <div class="col-md-3"></div> 
                    <div name="fechas" id="fechas">
                    <div class="col-md-3">
                      <font size="4" color="black">Fecha Inicio</font>
                      <input type="text" placeholder="Selecciona Fecha" name="fechaInicio" class="form-control fecha" id="fechaInicio">
                    </div>
                    <div class="col-md-3">
                      <font size="4" color="black">Fecha Fin</font>
                      <input type="text" placeholder="Selecciona Fecha Fin" name="fechaFin" class="form-control fecha" id="fechaFin">
                    </div>
                    </div>
                    <br><br><br><br>
                    <div class="col-md-4"></div>
                  </form>
                  <div class="col-md-4">
                  	<a onclick="javascript:document.formulario.submit();" href="#"><button class="btn btn-success btn-lg" name="btnGenerar" id="btnGenerar">Generar txt</button></a>
                  </div>
                  </div>
                 </div>
                 </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
        <script>
  $(document).ready(function() {
      $("#tipoReporte").change(function() {
        var reporteSeleccionado = $(this).val();
        if(reporteSeleccionado == 'catalogo'){
          document.getElementById('fechas').style.display = 'none';
        } else{
          document.getElementById('fechas').style.display = 'block';
        }
      });
});
    </script>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
        <script type="text/javascript">
        $(document).ready( function () {
              $(".fecha").datepicker();
               $.datepicker.regional['es'] = {
                  closeText: 'Cerrar',
                  prevText: 'Anterior',
                  nextText: 'Siguiente',
                  currentText: 'Hoy',
                  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                  monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                  dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                  dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                  weekHeader: 'Sm',
                  dateFormat: 'dd-mm-yy',
                  firstDay: 7,
                  isRTL: false,
                  showMonthAfterYear: false,
                  yearSuffix: ''
              };
              $.datepicker.setDefaults($.datepicker.regional['es']);
        } );
      </script>
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

