<?php
session_start();
require '../vistas/menuView.php';
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
    <title>Consulta Detalles del Pedido</title>
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
                <a href="cerrarSesion.php" class="btn btn-danger square-btn-adjust">Cerrar Sesión</a> 
              </div>
        </nav>   
           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <?php 
                  menu('consultaPedidos');
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
                        Consulta Detalles de Pedido.
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                <br /> <br />
 <?php
//Scripts para visualizar los DATATABLES
echo '
<script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui-1.9.2.min.js"></script>

    <link href="../../css/bootstrap.css" rel="stylesheet" />
    <link href="../../css/font-awesome.css" rel="stylesheet" />
    <link href="../../css/custom.css" rel="stylesheet" />
   <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
<link href="../../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />';

//Creación del objeto de conexión
  require_once 'conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conexión

//Variables
  $numPedido = filter_var($_REQUEST['numPedido'], FILTER_SANITIZE_STRING);
  $_SESSION['numPedido'] = $numPedido; 
  $nombreDB = ($_SESSION['nombreDB']);

  echo '
  <div class="col-md-4"></div>
  <div align="center" class="col-md-4">
  	No. Pedido: <input align="center" type="text" class="form-control"  readonly="readonly" value="'.$numPedido.'"/>
  </div><br /><br /><br /><br />
    <div class="panel panel-default">
      <div align="center" class="panel-heading">
       	Detalle Pedido
      </div>
      <div class="panel-body">
        <div id="tablaDetalleVentas" name="tablaDetalleVentas" class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th align="center">SKU </th>
            <th align="center">Artículo</th>
            <th align="center">Cantidad</th>
            <th align="center">Costo</th>
            <th align="center">IVA</th>
            <th align="center">Subtotal</th>
            <th align="center">Total</th>
           </tr>
        </thead>
        <tbody>';

	$sql = "select art_Clave as 'SKU', art_Nombre as 'ARTICULO', peda_Cantidad as 'CANTIDAD', peda_Costo as 'COSTO', peda_IVA as 'IVA', peda_SubTotal as 'SUBTOTAL', peda_Importe as 'TOTAL' FROM tPedidoArticulo WHERE ped_Clave = ".$numPedido;

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

    try{
      $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal,$nombreDB);
        if($conex->consultarByConex($conex2, $sql) != null){
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            echo '<tr class="gradeA">';
            echo '<td><p align="center">'.$row['SKU'].'</p></td>';
            echo '<td><p align="center">'.$row['ARTICULO'].'</p></td>';
            echo '<td><p align="center">'.round($row['CANTIDAD'],2).'</p></td>';
            echo '<td><p align="center"> $ '.round($row['COSTO'],2).'</p></td>';
            echo '<td><p align="center"> $ '.round($row['IVA']).'</p></td>';
            echo '<td><p align="center"> $ '.round($row['SUBTOTAL']).'</p></td>';
            echo '<td><p align="center"> $ '.round($row['TOTAL']).'</p></td>';
            echo '</tr>';
          }
         } else{
		      echo '<tr class="gradeA">';
			  echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
			  echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
		      echo '</tr>';
         }   
    }catch(conex2Exception $e){
      echo '<tr class="gradeA">';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '</tr>';
    }
 
 echo'
      </tbody> 
      </table> 
      </div>
      </div>
      </div>

      <a href="../vistas/consultaPedidosView.php"><button class="btn btn-danger"><img src="../../images/formularios/back.png" /> Regresar</button></a>
      <div class="col-md-3"></div>
      <div class="col-md-3">
            <a href="../procesos/exportarArchivo/exportarPedidosDetalle.php?tipo=excel"><button class="btn btn-success btn-lg"  id="btnExcel" value="excel" name="btnExcel"><img width="18px" height="18px" src="../../images/formularios/excel.png"> Exportar a Excel</button></a>
                 </div>
                 <div class="col-md-3">
                    <a href="../procesos/exportarArchivo/exportarPedidosDetalle.php?tipo=word"><button class="btn btn-info btn-lg" id="btnWord" value="word" name="btnWord"><img width="18px" height="18px" src="../../images/formularios/word.png"> Exportar a Word</button></a>
                 </div>
    <script src="../../js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
    <script src="../../js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="../../js/dataTables/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $("#dataTables-example").dataTable();
            });
    </script>
    <script src="../../js/custom.js"></script>';
    $conex = null;
    $conex2 = null;
?>