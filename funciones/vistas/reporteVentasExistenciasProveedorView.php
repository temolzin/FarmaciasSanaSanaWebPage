<?php
session_start();
require 'menuView.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrap-filestyle.min.js"> </script>
    <script type="text/javascript">
       function soloLetras(e) {
          key = e.keyCode || e.which;
          tecla = String.fromCharCode(key).toLowerCase();
          letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
          especiales = [8, 37, 39, 46];
          tecla_especial = false;
          for (var i in especiales) {
            if (key == especiales[i]) {
              tecla_especial = true;
              break;
            }
          }
          if (letras.indexOf(tecla) == -1 && !tecla_especial)
             return false;
          }
          function soloNumeros(e)
          {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
              return true;
            return /\d/.test(String.fromCharCode(keynum));
          }
    </script>
    <title>Reporte Ventas Existencias</title>
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
                  menu('reporteVentasProveedor');
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
                        Reporte Ventas Existencias (Sell Out).
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div align="center">
                 <div class="col-md-3"></div>
                 <form method="POST" enctype="multipart/form-data" id="formulario" name="formulario">
                    <br>
                    <div class="col-md-3"></div>
                    <div class="col-md-2">
                      <font size="4" color="black">Sucursal</font>
                    </div>
                    <div class="col-md-3">
                    <select id="sucursales" name="sucursales" class="form-control">
                      <option value="all">Todas las sucursales</option>
                      <?php 
                        require '../procesos/conexion.php';
                        $conex = Conexion::getInstance();
                        $consulta = $conex->consultar("select * from sucursales");
                        foreach ($consulta as $row) {
                          echo '<option value = "'.$row['nombreDB'].'" > '.$row['nombreSucursal'].' </option>';
                        }
                        $conex->cerrarConex();
                        ?> 
                      </select>
                    </div>
                    <br><br><br><br>
                    <div class="col-md-3"></div> 
                    <div class="col-md-3">
                      <font size="4" color="black">Fecha Inicio</font>
                      <input type="text" placeholder="Selecciona Fecha" name="fechaInicio" class="form-control fecha" id="fechaInicio">
                    </div>
                    <div class="col-md-3">
                      <font size="4" color="black">Fecha Fin</font>
                      <input type="text" placeholder="Selecciona Fecha Fin" name="fechaFin" class="form-control fecha" id="fechaFin">
                    </div>
                    <br><br><br><br>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <button class="btn btn-success btn-lg" name="btnBuscar" id="btnBuscar">Buscar</button> 
                    </div>
                  </form>
                  </div>
                      <script>
    $(document).ready(function() {
    $("#formulario").validate({
        rules: {
            fechaInicio: {
              required: true
            },fechaFin: {
              required: true
            },
            txtBuscar: {
              required: true
            }
        },
        messages: {
            txtBuscar: {
              required: "<font color='red'> Ingresa un producto para buscar</p>"
            },
            fechaInicio: {
              required: "<font color='red'> Seleccion una fecha</p>"
            },
            fechaFin: {
              required: "<font color='red'> Selecciona una fecha</p>"
            }
        },
        submitHandler: function(){
        var form_data = new FormData();                  
        var sucursal = document.getElementById('sucursales');
        var fechaInicio = document.getElementById('fechaInicio');
        var fechaFin =  document.getElementById('fechaFin');
        form_data.append('sucursales', sucursal.value);
        form_data.append('fechaFin', fechaFin.value);
        form_data.append('fechaInicio', fechaInicio.value);
          $('#bodyTabla').html('<div align="center"><img src="../../images/formularios/cargando.gif"/><br><p class="text-info lead">Cargando...</p></div>');
            $.ajax({
                type: "POST",
                url: '../procesos/reporteVentasExistenciasProveedor.php',
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                  data: form_data,
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
                    <a href="../procesos/exportarArchivo/exportarReporteVentasExistenciasProveedor.php?tipo=excel"><button class="btn btn-success btn-lg"  id="btnExcel" value="excel" style="display:none" name="btnExcel"><img width="18px" height="18px" src="../../images/formularios/excel.png"> Exportar a Excel</button></a>
                </div>
                <div class="col-md-3">
                    <a href="../procesos/exportarArchivo/exportarReporteVentasExistenciasProveedor.php?tipo=word"><button class="btn btn-info btn-lg" id="btnWord" value="word" style="display:none" name="btnWord"><img width="18px" height="18px" src="../../images/formularios/word.png"> Exportar a Word</button></a>
                </div>
                    <br><br><br>
                 </div>
                 </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
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

