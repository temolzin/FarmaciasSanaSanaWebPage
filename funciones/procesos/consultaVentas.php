<?php
session_start();
if (isset($_SESSION['nombreUsuario'])==false){
  header('Location: ../../index.html');
} 
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
  require 'conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conexión

//Variables
  $fecha1=date_create_from_format('d-m-Y', $_POST['fechaInicio']);
  $fechaInicio=date_format($fecha1, 'd-m-Y');	
  $fecha2=date_create_from_format('d-m-Y', $_POST['fechaFin']);
  $fechaFin=date_format($fecha2, 'd-m-Y');

  $_SESSION['fechaInicioVentas'] = $fechaInicio;
  $_SESSION['fechaFinVentas'] = $fechaFin;

  $nombreDB = filter_var($_POST['sucursales'], FILTER_SANITIZE_STRING);
  $_SESSION['nombreDB'] = $nombreDB;

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

  echo '
    <div class="panel panel-default">
      <div align="center" class="panel-heading">
       	Ventas
      </div>
      <div class="panel-body">
        <div id="bodyTabla" name="bodyTabla" class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th align="center">Detalle Venta</th>
            <th align="center">Ticket </th>
            <th align="center">Total Venta</th>
            <th align="center">Fecha Venta</th>
            <th align="center">IVA</th>
            <th align="center">IEPS</th>
            </tr>
        </thead>
        <tbody>';

	 $sql="SELECT venta_Folio, venta_Total, venta_Fecha, venta_IVA, venta_IEPS FROM tVenta WHERE venta_Fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' ORDER BY venta_Folio";

    //Conexión a Sucursal Seleccionada
    try{
      $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
        if($conex->consultarByConex($conex2,$sql) != null){
          foreach ($conex->consultarByConex($conex2,$sql) as $row) {
            echo '<tr class="gradeA">';
            echo '<td align="center"><a target="_blank" href="../procesos/consultaVentaDetalle.php?ticket='.$row['venta_Folio'].'"><img src="../../images/formularios/buscar.png"/></a> </td>';
            echo '<td><p align="center">'.$row['venta_Folio'].'</p></td>';
            echo '<td><p align="center"> $ '.round($row['venta_Total'],2).'</p></td>';
            $formatoFecha = new DateTime($row['venta_Fecha']);
            echo '<td><p align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
            echo '<td><p align="center"> $ '.round($row['venta_IVA']).'</p></td>';
            echo '<td><p align="center"> $ '.round($row['venta_IEPS'],2).'</p></td>';
            echo '</tr>';
          }
         } else{
		      echo '<tr class="gradeA">';
			  echo '<td align="center"><input type="radio" id="detalleVenta" class="form-control" name="detalleVenta" disabled="disabled"></td>';
		      echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
		      echo '</tr>';
         }   
    }catch(PDOException $e){
      echo '<tr class="gradeA">';
      echo '<td align="center"><input type="radio" id="detalleVenta" class="form-control" name="detalleVenta" disabled="disabled"></td>';
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
    //Cerramos la conexión a la base de datos.
    $conex = null;
    $conex2 = null;
?>