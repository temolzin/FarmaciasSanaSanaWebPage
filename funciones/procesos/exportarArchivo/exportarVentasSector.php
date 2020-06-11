<?php
session_start();

//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';

//Variables que recibe con las fechas seleccionadas por el usuario
$fechaInicio = $_SESSION['fechaInicioVentasSector'];
$fechaFin = $_SESSION['fechaFinVentasSector'];
$sector = $_SESSION['sector'];
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
    <td colspan="7" bgcolor="skyblue"><CENTER><strong>REPORTE VENTAS POR SECTOR SUCURSAL '. $nombreSucursal.' </strong></CENTER></td>
  </tr>
  <tr>
  	<td colspan="7" bgcolor="skyblue"><CENTER><strong> Fechas: '.$fechaInicio.' al '.$fechaFin.'</strong></td></CENTER>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">SKU </th>
    <th bgcolor="#0FEC76" align="center">Artículo</th>
    <th bgcolor="#0FEC76" align="center">Cantidad</th>
    <th bgcolor="#0FEC76" align="center">Importe</th>
    <th bgcolor="#0FEC76" align="center">Total</th>
    <th bgcolor="#0FEC76" align="center">Fecha</th>
    <th bgcolor="#0FEC76" align="center">Folio</th>
   </tr>
   </thead>';

 	 $sql="SELECT tvtaDetalle.art_Clave as sku , tvtaDetalle.art_Nombre as nombre, vdet_Cantidad, vdet_Importe, vdet_Total, vdet_Fecha, venta_Folio FROM tVentaDetalle tvtaDetalle INNER JOIN tArticulo ta ON tvtaDetalle.art_Clave = ta.art_Clave WHERE (eventa_Clave='REGISTRADA' OR eventa_Clave='RESURTIDO') AND (tart_Clave='".$sector."') AND (vdet_Fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."') ";

  //variables para sumar las cantidades
  $totalCantidad = 0;
  $total = 0.0; 

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';
    
  //Conexión a Sucursal Local
      try{
      	$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .=  '<td><p align="center"> '.$row['sku'].'</p></td>';
            $codigoHtml .=  '<td><p align="center"> '.$row['nombre'].'</p></td>';
            $codigoHtml .=  '<td><p align="center"> '.round($row['vdet_Cantidad']).'</p></td>';
            $codigoHtml .=  '<td><p align="center"> $ '.round($row['vdet_Importe'],2).'</p></td>';
            $codigoHtml .=  '<td><p align="center"> $ '.round($row['vdet_Total'],2).'</p></td>';
            $formatoFecha = new DateTime($row['vdet_Fecha']);
            $codigoHtml .=  '<td><p align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
            $codigoHtml .=  '<td><p align="center">'.$row['venta_Folio'].'</p></td>';            
            $codigoHtml .=  '</tr>';
            $totalCantidad = $totalCantidad + round($row['vdet_Cantidad']);
            $total = $total + round($row['vdet_Total'],2);
          }
           $codigoHtml .= '<tr>';
           $codigoHtml .=  '<td colspan="2" bgcolor="#0FEC76"><p align="center">Total</p></td>'; 
           $codigoHtml .=  '<td bgcolor="#0FEC76"><p align="center">'.$totalCantidad.'</p></td>'; 
           $codigoHtml .=  '<td bgcolor="#0FEC76"><p align="center"></p></td>';
           $codigoHtml .=  '<td bgcolor="#0FEC76"><p align="center"> $ '.$total.'</p></td>';
           $codigoHtml .=  '<td bgcolor="#0FEC76"><p align="center"></p></td>';
           $codigoHtml .=  '<td bgcolor="#0FEC76"><p align="center"></p></td>';
           $codigoHtml .= '</tr>';
      } catch(Exception $e){
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
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