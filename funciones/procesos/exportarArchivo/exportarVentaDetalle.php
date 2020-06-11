<?php
session_start();

//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';

$nombreDB = $_SESSION['nombreDB'];
$ticket = $_SESSION['ticketVentasDetalle'];

$sql = "SELECT nombreSucursal from sucursales where nombreDB = '".$nombreDB."'";
$nombreSucursal = "nombreSucursal";
foreach ($conex->consultar($sql) as $row) {
  $nombreSucursal = $row['nombreSucursal'];
}
//Variable que llega de funciones/procesos/consultaTickets para saber que tipo de pago es.
$tipoPago = $_SESSION['tipoPago'];

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
    <td colspan="7" bgcolor="skyblue"><CENTER><strong>REPORTE DETALLE DE VENTA TICKET '. $ticket .' , SUCURSAL ' .$nombreSucursal. ', Fecha: '.$_SESSION['fechaTicket']. ', Tipo de Pago: '.$tipoPago. ' </strong></CENTER></td>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">SKU </th>
    <th bgcolor="#0FEC76" align="center">Artículo</th>
    <th bgcolor="#0FEC76" align="center">Cantidad</th>
    <th bgcolor="#0FEC76" align="center">Descuento</th>
    <th bgcolor="#0FEC76" align="center">Importe</th>
    <th bgcolor="#0FEC76" align="center">Subtotal</th>
    <th bgcolor="#0FEC76" align="center">Total</th>
   </tr>
   </thead>';

   $sql="SELECT art_Clave as 'SKU', art_Nombre as 'ARTICULO', vdet_Cantidad as 'CANTIDAD', vdet_Descuento as 'Descuento' , vdet_Importe as 'IMPORTE', vdet_Total as 'TOTAL', vdet_Fecha as 'FECHA', vdet_SubTotal as 'SUBTOTAL' FROM tVentaDetalle WHERE venta_Folio = '". $ticket ."' and eventa_clave not in('devuelta')";

    $passwordSucursal = "S@na*s1";
    $ipSucursal = '192.168.100.21';

    //Variables para sumar los totales
    $sumaTotal = 0;
    $sumaSubTotal = 0;
    $sumaImporte = 0;

    //Conexión a la sucursal deseada y consulta de Ticket
      try{
      	$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal,$nombreDB);
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center">'.$row['SKU'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['ARTICULO'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.round($row['CANTIDAD']).'</p></td>';
            $codigoHtml .= '<td><p align="center"> % '.round($row['Descuento']).'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['IMPORTE'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['SUBTOTAL'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['TOTAL'],2).'</p></td>';
            $codigoHtml .= '</tr>';
            $sumaTotal = $sumaTotal + round($row['TOTAL'],2);
            $sumaImporte = $sumaImporte + round($row['IMPORTE'],2);
            $sumaSubTotal = $sumaSubTotal + round($row['SUBTOTAL'],2);
          }
            $codigoHtml .= '
            <tr>
              <td colspan="4" bgcolor="#0FEC76"><CENTER><strong>Total: </strong></CENTER></td>
              <td bgcolor="#0FEC76"><CENTER><strong>$ '.$sumaImporte.' </strong></CENTER></td>
              <td bgcolor="#0FEC76"><CENTER><strong>$ '.$sumaSubTotal.' </strong></CENTER></td>
              <td bgcolor="#0FEC76"><CENTER><strong>$ '.$sumaTotal.' </strong></CENTER></td>
            </tr>
            <tr>
              <td colspan = "7" align="center"></td>
             </tr>
             <tr>
              <td colspan = "7" align="center"></td>
             </tr>
             <tr>
              <td colspan = "7" align="center"></td>
             </tr>';
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

      //Impresión de DEVOLUCIONES
      $codigoHtml .= '
            <tr>
              <td colspan="7" bgcolor="#EF5B5B"><CENTER><strong>DEVOLUCIONES: </strong></CENTER></td>
            </tr>
            <thead>
            <tr>
              <th bgcolor="#EF5B5B" align="center">SKU </th>
              <th bgcolor="#EF5B5B" align="center">Artículo</th>
              <th bgcolor="#EF5B5B" align="center">Cantidad</th>
              <th bgcolor="#EF5B5B" align="center">Descuento</th>
              <th bgcolor="#EF5B5B" align="center">Importe</th>
              <th bgcolor="#EF5B5B" align="center">Subtotal</th>
              <th bgcolor="#EF5B5B" align="center">Total</th>
             </tr>
             </thead>';

      //CONSULTA DEVOLUCIONES
      $sql = "SELECT art_Clave as 'SKU', art_Nombre as 'NOMBRE', vdet_Cantidad as 'CANTIDAD', vdet_Descuento as 'Descuento' , vdet_Importe as 'IMPORTE', vdet_SubTotal as 'SUBTOTAL', vdet_Total as 'TOTAL' FROM tDevolucion WHERE venta_Folio = ".$ticket;
      
      //Reasigno las variables de suma de totales
      $sumaSubTotal = 0;
      $sumaTotal = 0;
      $sumaImporte = 0;
      try{
        $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal,$nombreDB);
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center">'.$row['SKU'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['NOMBRE'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.round($row['CANTIDAD']).'</p></td>';
            $codigoHtml .= '<td><p align="center"> % '.round($row['Descuento'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['IMPORTE'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['SUBTOTAL'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['TOTAL'],2).'</p></td>';
            $codigoHtml .= '</tr>';
            $sumaTotal = $sumaTotal + round($row['TOTAL'],2);
            $sumaImporte = $sumaImporte + round($row['IMPORTE'],2);
            $sumaSubTotal = $sumaSubTotal + round($row['SUBTOTAL'],2);
          }
            $codigoHtml .= '
            <tr>
              <td colspan="4" bgcolor="#EF5B5B"><CENTER><strong>Total Devoluciones: </strong></CENTER></td>
              <td bgcolor="#EF5B5B"><CENTER><strong>$ '.$sumaImporte.' </strong></CENTER></td>
              <td bgcolor="#EF5B5B"><CENTER><strong>$ '.$sumaSubTotal.' </strong></CENTER></td>
              <td bgcolor="#EF5B5B"><CENTER><strong>$ '.$sumaTotal.' </strong></CENTER></td>
            </tr>';
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
