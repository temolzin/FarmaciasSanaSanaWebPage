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

$fechaInicio = $_SESSION['fechaInicioKardex'];
$fechaFin = $_SESSION['fechaFinKardex'];
$skuCompleto = $_SESSION['skuCompletoKardex'];

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
    <td colspan="7" bgcolor="skyblue"><CENTER><strong>REPORTE KARDEX SUCURSAL '. $nombreSucursal.' </strong></CENTER></td>
  </tr>
  <tr>
  	<td colspan="7" bgcolor="skyblue"><CENTER><strong> Fechas: '.$_SESSION['fechaInicioKardex'].' al '.$_SESSION['fechaFinKardex'].'</strong></td></CENTER>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">SKU </th>
    <th bgcolor="#0FEC76" align="center">Costo</th>
    <th bgcolor="#0FEC76" align="center">Fecha de Movimiento</th>
    <th bgcolor="#0FEC76" align="center">Piezas</th>
    <th bgcolor="#0FEC76" align="center">Ticket</th>
    <th bgcolor="#0FEC76" align="center">Existencia Total</th>
    <th bgcolor="#0FEC76" align="center">Usuario</th>
   </tr>
   </thead>';

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

  $sql="SELECT art_Clave, art_Costo, kar_Fecha, kar_Cantidad, kar_Origen, alma_Existencia, usu_Clave FROM tArticuloKardex WHERE art_Clave='".$skuCompleto."' AND (kar_Fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."') ORDER BY kar_Fecha";

    //Conexión a Sucursal Local
      try{
      	$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center">'.$row['art_Clave'].'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['art_Costo'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['kar_Fecha'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.round($row['kar_Cantidad']).'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['kar_Origen'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.round($row['alma_Existencia']).'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['usu_Clave'].'</p></td>';
            $codigoHtml .= '</tr>';
          }
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