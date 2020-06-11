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

    </script>
    <title>Buscador de Facturas</title>
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
                  menu('buscaFacturas');
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
                        Buscador de Facturas.
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
                 <div align="center">
                 <div class="col-md-3"></div>
                 <form method="POST" id="formulario" name="formulario">
                  	<div class="col-md-2">
                    	<font size="4" color="black">Sucursal</font>
                    </div>
                    <div class="col-md-3">
	                    <select id="comboSucursal" name="comboSucursal" class="form-control">
	                      <?php 
	                        require '../procesos/conexion.php';
	                          $conex = Conexion::getInstance();
	                          $consulta = $conex->consultar("select * from sucursales");
	                          foreach ($consulta as $row) {
	                            echo '<option value = "'.$row['nombreDB'].'" > '.$row['nombreSucursal'].' </option>';
	                          }
	                          $conex=null;
	                      ?> 
	                    </select>
					</div>
                   <br><br><br><br>
                    <div class="col-md-3"></div>
                    <div class="col-md-2">
                     <select id="comboBuscarFactura" name="comboBuscarFactura" class="form-control">
                       <option value="folio">Folio Factura</option>
                       <option value="ticket">Ticket</option>
                     </select>
                    </div>
                    <div class="col-md-3">
                      <input class="form-control" type="text" name="txtBuscar" id="txtBuscar"/> 
                    </div>
					<br><br><br><br>
					<div class="col-md-5"></div>
                    <div class="col-md-1">
                      <button type="submit" class="btn btn-lg btn-success" name="btnBuscar" id="btnBuscar">Buscar</button> 
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
              required: "<div align = 'center'><font size='2' color='red'> Ingresa un número de Folio o Ticket para buscar</font></div>"
            }
        },
        submitHandler: function(){
          $('#solicitaFactura').html('<img src="../../images/formularios/loading.gif"/><br><p class="text-danger lead">Cargando...</p><br>');
          document.getElementById('btnPDF').style.display = 'none';
          document.getElementById('btnXML').style.display = 'none';
            $.ajax({
                  type: "POST",
                  url: '../procesos/buscaFacturas.php',
                  data: $('#formulario').serialize(),
                  success: function(data) {
                     $("#btnPDF").unbind("click"); 
                     $("#btnXML").unbind("click"); 
                    if(data == 'error') {
                      swal({title: "¡Error!",text: "El número de Folio o Ticket no ha sido encontrado",   type: "error",closeOnConfirm: "Aceptar"},
                        function(){
                          window.location.href='buscaFacturasView.php';
                        });
                      document.getElementById('btnPDF').style.display = 'none';
                      document.getElementById('solicitaFactura').innerHTML = '';
                      document.getElementById('btnXML').style.display = 'none';
                      document.getElementById('factura').style.display = 'none';
                    } else if(data == 'noFacturado'){
                      swal({title: "¡Aviso!",text: "El Ticket no ha sido facturado",   type: "info",closeOnConfirm: "Aceptar"},
                        function(){
                          window.location.href='buscaFacturasView.php';
                        });
                        document.getElementById('solicitaFactura').innerHTML = '';
                    } else {
                        $("#btnPDF").bind("click",function(){ 
    	                    window.open(data+".pdf", "_blank");
                        }); 
         	            $("#btnXML").bind("click",function(){ 
             	           window.open(data+".xml", "_blank");
               	        }); 
                   	    document.getElementById('btnPDF').style.display = 'block';
                    	document.getElementById('btnXML').style.display = 'block';
                      	document.getElementById('regresar').style.display = 'block';
                      	document.getElementById('solicitaFactura').style.display = 'none';
                   }
                  }
             });
        }
    });
  	});
    </script>
                    </br></br>
                  
                  <br><br><br><br>
					<div class="col-md-2" align="center"></div>
                   <div class="col-md-4" align="center" style="display:none" id="btnPDF" name="btnPDF">
                      <button class="btn btn-danger btn-lg" value="pdf"><img width="18px" height="18px" src="../../images/formularios/pdf.png"> Descarga PDF</button>
                   </div>
                   <div class="col-md-4" style="display:none;" align="center" id="btnXML" name="btnXML">
                      <button class="btn btn-info btn-lg" value="xml"><img width="18px" height="18px" src="../../images/formularios/xml.png"> Descargar XML</button>
                   </div><br><br>
                    <div class="col-md-12" align="center" style="display:none;" id="solicitaFactura" name="solitaFactura">
                    <br />
                    </div>
                  </div>
                  <div class="clearfix"></div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
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

