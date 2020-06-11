<?php
session_start();
set_time_limit(500);
require('ProductoExistencia.class.php');
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

  $fechaInicio = $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];
  $nombreDB = filter_var($_POST['sucursales'], FILTER_SANITIZE_STRING);
  $_SESSION['nombreDB'] = $nombreDB;
  $_SESSION['fechaInicio'] = $fechaInicio;
  $_SESSION['fechaFin'] = $fechaFin;

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

    echo '
    <div class="panel panel-default">
      <div align="center" class="panel-heading">
        Reporte Ventas Existencias
      </div>
      <div class="panel-body">
        <div id="bodyTabla" name="bodyTabla" class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th align="center">Sucursal</th>
            <th align="center">Cédula Médico</th>
            <th align="center">Nombre Médico</th>
            <th align="center">Ticket</th>
            <th align="center">Fecha Venta</th>
            <th align="center">SKU</th>
            <th align="center">Descripción</th>
            <th align="center">Piezas</th>
            <th align="center">Cajero</th>
          </tr>
        </thead>
        <tbody>';

$sql = "select tvd.alm_Clave, tm.med_Cedula, tm.med_Nombre, tvd.venta_Folio,tvd.vdet_Fecha, tvd.art_Clave, tvd.art_Nombre, tvd.vdet_Cantidad, tv.usu_Clave 
from tVenta tv 
inner join tVentaDetalle tvd on tv.venta_Folio = tvd.venta_Folio 
inner join tMedico tm on tv.med_Clave = tm.med_Clave
where tv.med_Clave != '' and tv.med_Clave != '0' and tvd.vdet_Fecha BETWEEN '".$fechaInicio."' and '".$fechaFin."'";

    try{
      $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
        if($conex->consultarByConex($conex2, $sql) != null){
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            echo '<tr class="gradeA">';
            echo '<td><p align="center">'.$row['alm_Clave'].'</td>';
            echo '<td><p align="center">'.$row['med_Cedula'].'</p></td>';
            echo '<td><p align="center">'.$row['med_Nombre'].'</p></td>';
            echo '<td><p align="center">'.$row['venta_Folio'].'</p></td>';
            $formatoFecha = new DateTime($row['vdet_Fecha']);
            echo '<td><p align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
            echo '<td><p align="center">'.$row['art_Clave'].'</p></td>';
            echo '<td><p align="center">'.$row['art_Nombre'].'</p></td>';
            echo '<td><p align="center">'.round($row['vdet_Cantidad']).'</p></td>';
            echo '<td><p align="center">'.$row['usu_Clave'].'</p></td>';
            echo '</tr>';
          }
         } else{
          echo '<tr class="gradeA">';
          echo '<td align="center">'.$nombreDB.'</td>';
          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
          echo '</tr>';
         }   
    }catch(conex2Exception $e){
      echo '<tr class="gradeA">';
          echo '<td align="center">'.$nombreDB.'</td>';
          echo '<td><p align="center" class="text-danger">Servidor Fuera de Línea</p></td>';
          echo '<td><p align="center" class="text-danger">Servidor Fuera de Línea</p></td>';
          echo '<td><p align="center" class="text-danger">Servidor Fuera de Línea</p></td>';
          echo '<td><p align="center" class="text-danger">Servidor Fuera de Línea</p></td>';
          echo '<td><p align="center" class="text-danger">Servidor Fuera de Línea</p></td>';
          echo '<td><p align="center" class="text-danger">Servidor Fuera de Línea</p></td>';
          echo '<td><p align="center" class="text-danger">Servidor Fuera de Línea</p></td>';
          echo '<td><p align="center" class="text-danger">Servidor Fuera de Línea</p></td>';
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
  $conex->cerrarConex();
  $conex2 = null; 
?>