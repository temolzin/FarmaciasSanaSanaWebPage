<?php
session_start();

//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';


//Consulta a la base de datos para saber el nombre de la sucursal
$nombreDB = $_SESSION['sucursalExistencia'];
$sql = "SELECT nombreSucursal from sucursales where nombreDB = '".$nombreDB."'";
$nombreSucursal = "nombreSucursal";
foreach ($conex->consultar($sql) as $row) {
  $nombreSucursal = $row['nombreSucursal'];
}

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
    <td colspan="4" bgcolor="skyblue"><CENTER><strong>REPORTE EXISTENCIAS, SUCURSAL '. $nombreSucursal .' </strong></CENTER></td>
  </tr>
  <thead>
  <tr>
   	<th bgcolor="#0FEC76" align="center">SKU</th>
    <th bgcolor="#0FEC76" align="center">Nombre</th>
    <th bgcolor="#0FEC76" align="center">Precio Venta</th>
    <th bgcolor="#0FEC76" align="center">Existencias</th>
   </tr>
   </thead>';

    $sql = "SELECT art_Clave, art_Nombre, art_Total, art_Existencia FROM tArticulo where art_Existencia > 0 order by art_Existencia desc";
    $passwordSucursal = "S@na*s1";
    $ipSucursal = '192.168.100.21';
    
    //Conexión a 512
      try{
          $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            if($row['art_Existencia'] == ""){
              $existenciaProducto = 0;
            } else{
              $existenciaProducto = round($row['art_Existencia']);
            }
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center">'.$row['art_Clave'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['art_Nombre'].'</p></td>';
            $codigoHtml .= '<td><p align="center"> $ '.round($row['art_Total'],2).'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$existenciaProducto.'</p></td>';
            $codigoHtml .= '</tr>';
          }
      } catch(Exception $e){
            $codigoHtml .= '<tr class="gradeA">';
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