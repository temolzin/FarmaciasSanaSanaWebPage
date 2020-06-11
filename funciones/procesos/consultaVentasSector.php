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

  $_SESSION['fechaInicioVentasSector'] = $fechaInicio;
  $_SESSION['fechaFinVentasSector'] = $fechaFin;

  $nombreDB = filter_var($_POST['sucursales'], FILTER_SANITIZE_STRING);
  $sector = filter_var($_POST['comboSector'], FILTER_SANITIZE_STRING);
  $_SESSION['sector'] = $sector;
  $_SESSION['nombreDB'] = $nombreDB;

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

  echo '
    <div class="panel panel-default">
      <div align="center" class="panel-heading">
       	Ventas Por Sector
      </div>
      <div class="panel-body">
        <div id="bodyTabla" name="bodyTabla" class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th align="center">SKU</th>
            <th align="center">Artículo</th>
            <th align="center">Cantidad</th>
            <th align="center">Importe</th>
            <th align="center">Total</th>
            <th align="center">Fecha</th>
            <th align="center">Folio</th>
            </tr>
        </thead>
        <tbody>';

	 $sql="SELECT tvtaDetalle.art_Clave as sku , tvtaDetalle.art_Nombre as nombre, vdet_Cantidad, vdet_Importe, vdet_Total, vdet_Fecha, venta_Folio FROM tVentaDetalle tvtaDetalle INNER JOIN tArticulo ta ON tvtaDetalle.art_Clave = ta.art_Clave WHERE (eventa_Clave='REGISTRADA' OR eventa_Clave='RESURTIDO') AND (tart_Clave='".$sector."') AND (vdet_Fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."') ";

	$totalCantidad = 0;
    $total = 0.0;
    //Conexión a Sucursal Seleccionada
    try{
      $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
        if($conex->consultarByConex($conex2, $sql) != null){
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            echo '<tr class="gradeA">';
            echo '<td><p align="center"> '.$row['sku'].'</p></td>';
            echo '<td><p align="center"> '.$row['nombre'].'</p></td>';
            echo '<td><p align="center"> '.round($row['vdet_Cantidad']).'</p></td>';
            echo '<td><p align="center"> $ '.round($row['vdet_Importe'],2).'</p></td>';
            echo '<td><p align="center"> $ '.round($row['vdet_Total'],2).'</p></td>';
            $formatoFecha = new DateTime($row['vdet_Fecha']);
            echo '<td><p align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
            echo '<td><p align="center">'.$row['venta_Folio'].'</p></td>';            
            echo '</tr>';
            $totalCantidad = $totalCantidad + round($row['vdet_Cantidad']);
            $total = $total + round($row['vdet_Total'],2);
          }
         } else{
		      echo '<tr class="gradeA">';
		      echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
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
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
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
      <div class="col-md-2"></div>
     	<div class="col-md-2 text-info lead"> Total </div>
    	<div class="col-md-3 text-info" align = "center"> Cantidad 
    		 <input type="text" class="form-control lead" align="center" readonly="readonly" value="'.$totalCantidad.'"></div>
    	<div class="col-md-3 text-info" align="center"> Total
    		  <center><input type="text" readonly="readonly" align="center" class="form-control lead" value= $'.round($total,2).'></center>
    	</div>
		  <br><br><br><br>
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