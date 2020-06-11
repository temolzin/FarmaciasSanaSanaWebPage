<?php
session_start();
require 'menuView.php';
?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui-1.9.2.min.js"></script>
    <script type="text/javascript" src="../../js/sweetalert.min.js"></script>
    <title>Eliminar/Actualizar Tickets</title>
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
</head>
<script>
  function limpiarCajas(){//Función para limpiar imput y regresar combo a su valor original
    $('#comboSucursal').val($('#comboSucursal > option:first').val());
    $(":text").each(function() {
            $($(this)).val('');
          });
  }
  function soloNumeros(e){//Función para que el imput solo pueda recibir numeros, puntos y la tecla de borrar
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
      return true;
    return /\d/.test(String.fromCharCode(keynum));
  }
</script>
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
                  menu('EliminarTickets');
                 ?>
                </ul>
               
            </div>
            
        </nav>  

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2 align="center">
                        Eliminar Tickets.
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                 <!-- /. ROW  -->

                 <div align="center">
    <form role="form" method="POST" id="formulario" name="formulario">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <font size="4" color="black">Sucursal</font>
      <select id="comboSucursal" name="comboSucursal" class="form-control">
        <?php //Se hace una consulta de las sucursales
        require '../procesos/conexion.php';
        $conex = Conexion::getInstance();
        $consulta = $conex->consultar("select * from sucursales");
        foreach ($consulta as $row) {
          echo '<option>'.$row['nombreSucursal'].' </option>';
        }
        $conex=null;
        ?> 
      </select>
    </div>
    <br><br><br><br> 
    <div class="col-md-4"></div> 
    <div class="col-md-4">
        <font size="4" color="black">No. de Ticket:</font>
        <input class="form-control" onkeypress="return soloNumeros(event);" type="text" name="txtTicket" id="txtTicket" placeholder="Buscar"/>
    </div>

    <br><br><br><br><br><br>
     <div class="col-md-4"></div>

    <div class="col-md-4">
        <button class="btn btn-success" name="btnActualizar" id="btnActualizar" onclick="ejecutarAccion('Act')">Actualizar</button>
        <button class="btn btn-success" name="btnEliminar" id="btnEliminar" onclick="ejecutarAccion('Elim')">Eliminar</button>    
    </div>
    <br><br><br><br>


    <script>
    function ejecutarAccion(opcion){
      if(opcion="Elim"){
        document.getElementById("btnEliminar").value = "Activado";   

      }else if(opcion="Act"){
        document.getElementById("btnActualizar").value = "Activado";
      }

      $("#formulario").validate({
        rules: {
          txtTicket: { 
            required: true,
          },
        },
        messages: {
          txtTicket: { 
            required: "<p align='center' class='text-danger'> Ingresa un valor </p>"
          }
        },//Terminan validaciones

          submitHandler: function(){
            $.ajax({
                  type: "POST",
                  url: '../procesos/eliminarTickets.php',
                  data: $('#formulario').serialize(),
                  success: function(data) {
                    if(data == 'error') {
                        swal({title: "¡Error!",text: "No se pudo realizar la acción, por favor intentelo mas tarde",   type: "error",closeOnConfirm: "Aceptar"});
                    } else {
                         //swal({title: "¡Éxito!",text: "El Ticket se elimino",   type: "success",closeOnConfirm: "Aceptar"});
                        document.getElementById('formResultados').innerHTML='';
                        $('#formResultados').fadeIn(5000).html(data);                       
                    }
                  }//success
             });//Ajax
        }//SubmitHandler
      });//Validate
      }
      
    </script>
  </form>
  <form id="formResultados">
    
  </form>
    </div>
  </div>
</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
              
    <!-- JQUERY SCRIPTS -->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../../js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
    <script src="../../js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="../../js/dataTables/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/dataTables.bootstrap.js"></script>
          <!-- CUSTOM SCRIPTS -->
    <script src="../../js/custom.js"></script>
    
   
</body>
</html>