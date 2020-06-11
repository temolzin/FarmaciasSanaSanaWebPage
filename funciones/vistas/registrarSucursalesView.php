<?php
session_start();
  if (isset($_SESSION['nombreUsuario'])==false){
    header('Location: ../../index.html');
  } 
require 'menuView.php';
?>
<!DOCTYPE html>
<html>
<head>
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui-1.9.2.min.js"></script>
    <script type="text/javascript" src="../../js/sweetalert.min.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script type="text/javascript" src="../../js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script type="text/javascript" src="../../js/morris/raphael-2.1.0.min.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registra Sucursales</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../../css/bootstrap.css" rel="stylesheet" />
    <link href="../../css/sweetalert.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../../css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../../css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <!-- Favicon -->
   <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" />
   <script type="text/javascript">
     function limpiarCajas() {
         $(":text").each(function() {
            $($(this)).val('');
          });
      }

          function soloNumeros(e)
          {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
              return true;
            return /\d/.test(String.fromCharCode(keynum));
          }
    </script>
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
                    menu('registrarSucursales');
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
                     <?php 
                        menuBienvenida();
                     ?>
                     </h2>   
                        <h5 align="center">Registro de nueva sucursal</h5>
                    </div>
                    <h5 align="center"><strong>Nota: Los datos con * son obligatorios.</strong></h5>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <!--Empieza el formulario de registro-->
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>  Registra una nueva sucursal </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form" method="POST" name="formulario" id="formulario">
                                    <br/>
                                  <div align="center" class="form-group input-group">
                                      <span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
                                      <input type="text" id="nombreSucursal" name="nombreSucursal" class="form-control" placeholder="* Ingresa el nombre de la sucursal" />
                                  </div>
                                  <div align="center" class="form-group input-group">
                                      <span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
                                      <input type="text" id="nombreDB" name="nombreDB" class="form-control" placeholder="* Ingresa el nombre de la base de datos" />
                                  </div>
                                  <div align="center" class="form-group input-group">
                                      <span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
                                      <input type="text" id="ipSucursal" name="ipSucursal" maxlength="15" class="form-control" placeholder="* Ingresa la dirección IP de la sucursal" onkeypress="return soloNumeros(event);"/>
                                  </div>

                                  <div class="form-group">           
                                      <textarea class="form-control" id="urlGoogleMaps" name="urlGoogleMaps"  rows="3" placeholder="* Ingresa la Url de Google maps"></textarea>
                                  </div>

                                  <div class="form-group">           
                                      <textarea class="form-control" id="direccionSucursal" name ="direccionSucursal" rows="3" placeholder="* Ingresa la dirección de la Sucursal"  ></textarea>
                                  </div>

                                   <div align="center" class="form-group input-group">
                                      <span class="input-group-addon"><i class="fa fa-circle-o"></i></span>
                                      <input type="text" id="extensionSucursal" name="extensionSucursal" maxlength="15" class="form-control" placeholder="* Ingresa extensión de la sucursal"/>
                                  </div>

                                     <div align="center">
                                      <button id="btnAceptar" name="btnAceptar" class="btn btn-success">Registrar</button>
                                    </div>
                                    <hr />
                                    </form>
                            </div>
    <script>
    $(document).ready(function() {

    $("#formulario").validate({
        rules: {
            nombreSucursal: {
              required: true,
              remote: "../procesos/validarSucursalIngresada.php"
            },
            nombreDB: {
              required: true
            },
            ipSucursal: {
              required: true
            },
            urlGoogleMaps:{
              required: true
            },
            direccionSucursal:{
              required: true
            },
            extensionSucursal:{
              required: true
            }
        },
        messages: {
            nombreSucursal: {
              required: "<p align='center' class='text-danger'> Debes ingresar un nombre de usuario</p>",
              remote: "<font color='red' align='center'> <img src='../../images/formularios/err.png'/> No disponible</font>"
            }, 
            nombreDB: {
              required: "<p align='center' class='text-danger'> Debes ingresar el nombre de la base de datos</p>"
            },
            ipSucursal: {
              required: "<p align='center' class='text-danger'> Debes ingresar la IP de la sucursal</p>"
            },
            urlGoogleMaps: {
              required: "<p align='center' class='text-danger'> Debes ingresar la URL de la sucursal</p>"
            },
            direccionSucursal:{
              required: "<p align='center' class='text-danger'> Debes ingresar dirección de la sucursal</p>"
            },
            extensionSucursal:{
              required: "<p align='center' class='text-danger'> Debes ingresar la extensión de la sucursal</p>"
            }
        },
        submitHandler: function(){
            $.ajax({
                  type: "POST",
                  url: '../procesos/registrarSucursales.php',
                  data: $('#formulario').serialize(),
                  success: function(data) {
                    if(data == 'error') {
                        swal({title: "¡Error!",text: "Ha ocurrido un error al registrar la sucursal, por favor contacta al programador.",   type: "error",closeOnConfirm: "Aceptar"});
                    } else {
                       swal({title: "¡Éxito!",text: "La sucursal ha sido registrado de manera correcta.",   type: "success",closeOnConfirm: "Aceptar"},
                        function(){
                          window.location.href='../vistas/registrarSucursalesView.php';
                        });
                      limpiarCajas();
                    }
                  }
             });
        }
    });
  });
    </script>
                        </div>
                    </div>
                    <!--Finaliza Formulario de registro-->


              </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
         <!-- METISMENU SCRIPTS -->
    <script src="../../js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../../js/custom.js"></script>
</body>
</html>

