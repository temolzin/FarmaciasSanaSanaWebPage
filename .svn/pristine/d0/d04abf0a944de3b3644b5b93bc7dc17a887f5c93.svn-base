<?php
session_start();
require '../vistas/menuView.php';
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
    <title>Seguimiento de Crédito</title>
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
                  menu('creditoCliente');
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
                        Seguimiento de Crédito.
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                <br /> <br />
                 <div class="col-md-3"></div>
                   <div class="col-md-2">
                      <font size="4" color="black">Sucursal</font>
                    </div>
                    <form id="formulario" name="formulario">
                    <div class="col-md-3">
                      <select id="comboSucursal" name="comboSucursal" class="form-control">
                        <option value="default">Selecciona Sucursal</option>
                        <option value = "512" > 512 </option>
                        <option value = "517" > 517 </option>
                        <option value = "E21" > E21 </option>
                        <option value = "GH45" > GH-45 </option>
                      </select>
                    </div><br>
                    <div class="col-md-4"></div><br/><br/>
                    <div name="divClientes" id="divClientes" style="display:none">
                    <div class="col-md-3"></div>
                    <div class="col-md-2" id="cliente" name="cliente">
                      <font size="4" color="black">Cliente</font>
                    </div>
                    <div class="col-md-3" id="nombreClientes" name="nombreClientes"></div>
                    <div></div><br><br><br>
                    <div class="col-md-5"></div>
                    <div class="col-md-4" name="divBoton" id="divBoton">
                      <button class="btn btn-success btn-lg" name="btnBuscar" id="btnBuscar">Buscar</button> 
                    </div>
                    </div>
                    </form><br><br><br><br><br>
                    <div id="informacionCredito" name="informacionCredito">
                      <!-- Muestra los del cliente seleccionado-->
                    </div>
<script>
  $(document).ready(function() {
      $("#comboSucursal").change(function() {
        var sucursalSeleccionada = $(this).val();
        $.ajax({
              type: "POST",
              url: '../procesos/seguimientoCreditoClienteAdmin.php',
              data: $('#comboSucursal').serialize(),
              success: function(data) {
                if(sucursalSeleccionada=="default") {
                  document.getElementById('divClientes').style.display = 'none';
                  $('#informacionCredito').html("");
                } else if(data == '<select id="comboClientes" name="comboClientes" class="form-control"><option value="default">Ningún cliente tiene crédito</option></select>'){
                    document.getElementById('divBoton').style.display = 'none';
                    document.getElementById('divClientes').style.display = 'block';
                    $('#nombreClientes').html(data);
                    $('#informacionCredito').html("");
                } else {
                  if(data == 'error') {
                    swal({title: "¡Error!",text: "Ha ocurrido un error en el sistema. ",type: "error" ,closeOnConfirm: "Aceptar"},
                      function(){
                        window.location.href="../procesos/panelAdmin.php";
                    });
                  } else {
                    document.getElementById('divBoton').style.display = 'block';
                    document.getElementById('divClientes').style.display = 'block';
                    $('#nombreClientes').html(data);
                  }
                }
            }
          });
      });
});
    </script>
<script>
$(document).ready(function() {
$("#btnBuscar").click(function(){
  $('#informacionCredito').html('<div align="center"><img src="../../images/formularios/cargando.gif"/><br><p class="text-info lead">Cargando...</p></div>');
    $.ajax({
           type: "POST",
           url: "../procesos/seguimientoCreditoClienteAdmin.php",
           data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
           success: function(data)
           {
               $("#informacionCredito").html(data); // Mostrar la respuestas del script PHP.
           }
         });
    return false; // Evitar ejecutar el submit del formulario.
 });
});
</script>
    <script src="../../js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
    <script src="../../js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="../../js/dataTables/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/dataTables.bootstrap.js"></script>
    <script src="../../js/custom.js"></script>
    </div></div></div></body></html>