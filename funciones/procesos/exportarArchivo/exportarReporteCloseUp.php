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
    <td colspan="9" bgcolor="skyblue"><CENTER><strong>REPORTE CLOSE UP, SUCURSAL: '. $nombreSucursal.' </strong></CENTER></td>
  </tr>
  <tr>
  	<td colspan="9" bgcolor="skyblue"><CENTER><strong> Fechas: '.$_SESSION['fechaInicio'].' al '.$_SESSION['fechaFin'].'</strong></td></CENTER>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">Sucursal</th>
    <th bgcolor="#0FEC76" align="center">Cédula Médico</th>
    <th bgcolor="#0FEC76" align="center">Nombre Médico</th>
    <th bgcolor="#0FEC76" align="center">Ticket</th>
    <th bgcolor="#0FEC76" align="center">Fecha Venta</th>
    <th bgcolor="#0FEC76" align="center">SKU</th>
    <th bgcolor="#0FEC76" align="center">Descripción</th>
    <th bgcolor="#0FEC76" align="center">Piezas</th>
    <th bgcolor="#0FEC76" align="center">Cajero</th>
   </tr>
   </thead>';

$sql = "select tvd.alm_Clave, tm.med_Cedula, tm.med_Nombre, tvd.venta_Folio,tvd.vdet_Fecha, tvd.art_Clave, tvd.art_Nombre, tvd.vdet_Cantidad, tv.usu_Clave 
from tVenta tv 
inner join tVentaDetalle tvd on tv.venta_Folio = tvd.venta_Folio 
inner join tMedico tm on tv.med_Clave = tm.med_Clave
where tv.med_Clave != '' and tv.med_Clave != '0' and tvd.vdet_Fecha BETWEEN '".$_SESSION['fechaInicio']."' and '".$_SESSION['fechaFin']."'";

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';
    
    //Conexión a Sucursal Local
      try{
      	$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center">'.$row['alm_Clave'].'</td>';
            $codigoHtml .= '<td><p align="center">'.$row['med_Cedula'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['med_Nombre'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['venta_Folio'].'</p></td>';
            $formatoFecha = new DateTime($row['vdet_Fecha']);
            $codigoHtml .= '<td><p align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['art_Clave'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['art_Nombre'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.round($row['vdet_Cantidad']).'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['usu_Clave'].'</p></td>';
            $codigoHtml .= '</tr>';
          }
      } catch(Exception $e){
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center" class="text-danger">'.$nombreSucursal.' </p></td>';
            $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
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

    ?>