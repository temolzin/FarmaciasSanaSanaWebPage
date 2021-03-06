<?php
session_start();

//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';

//Consulta a la base de datos para saber el nombre de la sucursal
$nombreDB = $_SESSION['nombreDB'];
$sql = "SELECT nombreSucursal from sucursales where nombreDB = '".$nombreDB."'";
$nombreSucursal = "nombreSucursal";
foreach ($conex->consultar($sql) as $row) {
	$nombreSucursal = $row['nombreSucursal'];
}
//Termina consulta
$codigoHtml = '
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Existencias</title>
</head>
<body>	
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" bgcolor="skyblue"><CENTER><strong>REPORTE VENTAS SUCURSAL '. $nombreSucursal.' </strong></CENTER></td>
  </tr>
  <tr>
  	<td colspan="5" bgcolor="skyblue"><CENTER><strong> Fechas: '.$_SESSION['fechaInicioVentas'].' al '.$_SESSION['fechaFinVentas'].'</strong></td></CENTER>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">Folio </th>
    <th bgcolor="#0FEC76" align="center">Total Venta</th>
    <th bgcolor="#0FEC76" align="center">Fecha Venta</th>
    <th bgcolor="#0FEC76" align="center">IVA</th>
    <th bgcolor="#0FEC76" align="center">IEPS</th>
   </tr>
   </thead>';

    $sql = "SELECT venta_Folio, venta_Total, venta_Fecha, venta_IVA, venta_IEPS FROM tVenta WHERE venta_Fecha BETWEEN '".$_SESSION['fechaInicioVentas']."' AND '".$_SESSION['fechaFinVentas']."'";

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';
    
    //Conexión a Sucursal Local
      try{
      	$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center">'.$row['venta_Folio'].'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['venta_Total'],2).'</p></td>';
            $formatoFecha = new DateTime($row['venta_Fecha']);
            $codigoHtml .='<td><p align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['venta_IVA'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['venta_IEPS'],2).'</p></td>';
            $codigoHtml .= '</tr>';
          }
      } catch(Exception $e){
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            $codigoHtml .= '</tr>';
      }

    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=FarmaciasSanaSana$extension");
    header("Pragma: no-cache");
    header("Expires: 0");    
    echo $codigoHtml;

    $conex->cerrarConex();
    $conex2 = null;
