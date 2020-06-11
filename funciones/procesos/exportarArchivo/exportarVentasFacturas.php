<?php
session_start();

//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';


  $fechaInicio = $_SESSION['fechaInicioVentasFacturas'];
  $fechaFin = $_SESSION['fechaFinVentasFacturas'];

  $nombreDB = $_SESSION['nombreDB'];

  $passwordSucursal = "Admin";
  $ipSucursal = '192.168.100.21';

//Consulta a la base de datos para saber el nombre de la sucursal
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
    <td colspan="12" bgcolor="skyblue"><CENTER><strong>REPORTE FACTURAS SUCURSAL '. $nombreSucursal.' </strong></CENTER></td>
  </tr>
  <tr>
  	<td colspan="12" bgcolor="skyblue"><CENTER><strong> Fechas: '.$fechaInicio.' al '.$fechaFin.'</strong></td></CENTER>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">Fecha</th>
    <th bgcolor="#0FEC76" align="center">Clave</th>
    <th bgcolor="#0FEC76" align="center">RFC</th>
    <th bgcolor="#0FEC76" align="center">Nombre</th>
    <th bgcolor="#0FEC76" align="center">Importe</th>
    <th bgcolor="#0FEC76" align="center">IVA</th>
    <th bgcolor="#0FEC76" align="center">TOTAL</th>
    <th bgcolor="#0FEC76" align="center">UUID</th>
    <th bgcolor="#0FEC76" align="center">Cadena Original</th>
    <th bgcolor="#0FEC76" align="center">Sello Digital</th>
    <th bgcolor="#0FEC76" align="center">Sello SAT</th>
    <th bgcolor="#0FEC76" align="center">Metodo Pago</th>
   </tr>
   </thead>';

$sql="SELECT femi_Fecha, femi_Clave, cli_RFC, cli_NombreFis, femi_Importe, femi_IVA, femi_Total, femi_CadenaOriginal, femi_SelloDigital, femi_SelloSAT, femi_UUID,femi_MetodoPago FROM tFacturaEmitida WHERE femi_Fecha between '".$fechaInicio."' and '".$fechaFin."'";

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

  //Conexión a Sucursal Seleccionada
    try{
      $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
        if($conex->consultarByConex($conex2, $sql) != null){
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            $codigoHtml .= '<tr class="gradeA">';
            $formatoFecha = new DateTime($row['femi_Fecha']);
            $codigoHtml .='<td><p align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
            $codigoHtml .= '<td><p align="center"> '.$row['femi_Clave'].'</p></td>';
            $codigoHtml .= '<td><p align="center"> '.$row['cli_RFC'].'</p></td>';
            $codigoHtml .= '<td><p align="center"> '.$row['cli_NombreFis'].'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['femi_Importe'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['femi_IVA'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['femi_Total'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['femi_UUID'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['femi_CadenaOriginal'].'</p></td>';            
            $codigoHtml .= '<td><p align="center">'.$row['femi_SelloDigital'].'</p></td>';            
            $codigoHtml .= '<td><p align="center">'.$row['femi_SelloSAT'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['femi_MetodoPago'].'</p></td>';
            $codigoHtml .= '</tr>';
          }
         } else{
          $codigoHtml .= '<tr class="gradeA">';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
          $codigoHtml .= '</tr>';
         }   
    }catch(PDOException $e){
      $codigoHtml .= '<tr class="gradeA">';
      $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
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
