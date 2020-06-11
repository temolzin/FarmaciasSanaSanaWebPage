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
    <script type="text/javascript" src="../../js/bootstrap-filestyle.min.js"> </script>
    <script type="text/javascript">
      function limpiarCajas() {
        $('#comboProveedor').val($('#comboProveedor > option:first').val());
         $(":text").each(function() {
            $($(this)).val('');
          });
      }
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
    <title>Registrar SKU a Proveedor</title>
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
                  menu('skuProveedor');
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
                        Registrar SKU a Proveedor.
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                <br /> <br />
                 <div class="col-md-3"></div>
                   <div class="col-md-2">
                      <font size="4" color="black">Proveedor</font>
                    </div>
                    <form id="formulario" enctype="multipart/form-data" name="formulario">
                      <div class="col-md-3">
                        <select id="comboProveedor" name="comboProveedor" class="form-control">
                          <option value="default">Selecciona Proveedor</option>
                          <?php
                            require '../procesos/conexion.php';
                            $conex = Conexion::getInstance();
                            //El tipo de usuario 5 es Proveedor.
                            $consulta = $conex->consultar("select * from usuario where tipoUsuario = 5");
                            foreach ($consulta as $row) {
                              echo '<option value = "'.$row['id_usuario'].'" > '.$row['nombreUsuario'].' </option>';
                            }
                            $conex = null;
                          ?>
                        </select>
                      </div><br><br><br><br><br>
                      <div class="col-md-3"></div>
                      <div class="col-md-2">
                        <font size="4" color="black">Selecciona Archivo </font>
                      </div>
                      <div class="col-md-3">
                        <!-- Cargar el archivo de excel -->
                        <input id="archivo" multiple="multiple" accept=".csv" class="filestyle" data-buttonText="Archivo" name="archivo" type="file" /> 
                        <input class="form-control"  name="MAX_FILE_SIZE" type="hidden" value="20000" /> 
                      </div><br><br><br><br>
                      <div class="col-md-5"></div>
                      <div class="col-md-4">
                        <button class="btn btn-success btn-lg" name="btnAceptar" id="btnAceptar">Registrar</button> 
                      </div>
                    </form><br><br><br><br><br>
                    <div id="bodyTabla" name="bodyTabla">
                      <!-- Muestra los del cliente seleccionado-->
                    </div>
<script>
    $(document).ready(function() {
      $.validator.addMethod("validarComboVacio", 
        function(value, element, arg){ 
        return arg != value; }, 
      "<p class='text-danger'>Selecciona una opción</p>"); 
      $("#formulario").validate({
          rules: {
              comboProveedor: {
                validarComboVacio: "default"
              }
          },
          messages: {
              comboProveedor: {
                required: "<font color='red'> Selecciona un Proveedor</p>"
              }
          },
          submitHandler: function(){
          var file_data = $('#archivo').prop('files')[0];   
          var form_data = new FormData();                  
          var comboProveedor = document.getElementById('comboProveedor');
          form_data.append('archivo', file_data);
          form_data.append('comboProveedor', comboProveedor.value);
            $('#bodyTabla').html('<div align="center"><img src="../../images/formularios/cargando.gif"/><br><p class="text-info lead">Cargando...</p></div>');
              $.ajax({
                  type: "POST",
                  url: '../procesos/registrarSKUProveedor.php',
                  dataType: 'text',  // what to expect back from the PHP script, if anything
                  cache: false,
                  contentType: false,
                  processData: false,
                    data: form_data,
                    success: function(data) {
                      if(data == '') {
                        swal({title: "¡Éxito!",text: "Los SKU se registraron correctamente.",   type: "success",closeOnConfirm: "Aceptar"},
                          function(){
                            window.location.href='../vistas/registrarSKUProveedorView.php';
                          });
                        limpiarCajas();
                      } else {
                        swal({title: "¡Error!",text: "Ha ocurrido un error al registrar los SKU al Proveedor, por favor contacta al programador. " + data, type: "error",closeOnConfirm: "Aceptar"},
                          function(){
                            window.location.href='../vistas/registrarSKUProveedorView.php';
                          });
                      }
                    }
               });
          }
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