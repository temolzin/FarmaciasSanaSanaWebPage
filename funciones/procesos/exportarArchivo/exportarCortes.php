<?php
session_start();

//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';

$nombreDB = $_SESSION['nombreDBCortes'];
$fechaInicio = $_SESSION['fechaInicioCortes'];
$fechaFin = $_SESSION['fechaFinCortes'];

//Consulta para saber el nombre de la sucursal
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
    <td colspan="2" bgcolor="skyblue"><CENTER><strong>REPORTE CORTES DE CAJA SUCURSAL '. $nombreSucursal .' </strong></CENTER></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="skyblue"><CENTER><strong>Fecha: '. $fechaInicio .' al ' . $fechaFin . ' </strong></CENTER></td>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">Fecha del corte </th>
    <th bgcolor="#0FEC76" align="center">Total del corte</th>
   </tr>
   </thead>';

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

    $sql = "SELECT cierre_Fecha, cierre_Total FROM tCierre WHERE cierre_Fecha BETWEEN '".$fechaInicio."' and '".$fechaFin."'";
    //Conexión a Sucursales locales
      try{
          $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
          if($conex->consultarByConex($conex2, $sql) != null){
           foreach ($conex->consultarByConex($conex2, $sql) as $row) {
             $codigoHtml .= '<tr class="gradeA">';
             $formatoFecha = new DateTime($row['cierre_Fecha']);
             $codigoHtml .='<td><p align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
             $codigoHtml .= '<td><p align="center"> $ '.round($row['cierre_Total'],2).'</p></td>';
             $codigoHtml .= '</tr>';
           }
          } else{
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
            $codigoHtml .= '<td><p align="center" class="text-danger">No hay datos </p></td>';
            $codigoHtml .= '</tr>';
           }   
          }catch(PDOException $e){
            $codigoHtml .= '<tr class="gradeA">';
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