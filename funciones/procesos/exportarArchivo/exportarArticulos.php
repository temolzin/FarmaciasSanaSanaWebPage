<?php
session_start();

//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';

//Consulta a la base de datos para saber el nombre de la sucursal
$sql = $_SESSION['consultaArticulos'];
$txtBuscar = $_SESSION['txtBuscarArticulos'];
$tipoBusqueda = $_SESSION['tipoBusquedaArticulos'];

//Consulta para recorrer todas las sucursales de la base de datos
$sqlSucursales = "SELECT * FROM sucursales";

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
    <td colspan="5" bgcolor="skyblue"><CENTER><strong>REPORTE DE ARTÍCULOS</strong></CENTER></td>
  </tr>
  <tr>
  	<td colspan="5" bgcolor="skyblue"><CENTER><strong> '.$tipoBusqueda.' : '.$txtBuscar.' </strong></td></CENTER>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">Sucursal </th>
    <th bgcolor="#0FEC76" align="center">SKU</th>
    <th bgcolor="#0FEC76" align="center">Nombre</th>
    <th bgcolor="#0FEC76" align="center">Precio Venta</th>
    <th bgcolor="#0FEC76" align="center">Existencias</th>
   </tr>
   </thead>';

    if($_SESSION['tipoUsuario'] == 'Cliente') { 
    $sqlSucursalesCliente = "SELECT id_sucursal FROM accesoCliente where id_usuario = ".$_SESSION['id_usuario'];
      foreach ($conex->consultar($sqlSucursalesCliente) as $rowIdSucursal) {
        $sqlSucursales = 'SELECT * FROM sucursales where id_sucursal = '.$rowIdSucursal['id_sucursal'];
      	try{
            foreach ($conex->consultar($sqlSucursales) as $rowSucursal) {      
            //Validación para la conexión a otro servidor  
              $conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1',$rowSucursal['nombreDB']);

              if($conex->consultarByConex($conex2, $sql) != null){
                foreach ($conex->consultarByConex($conex2, $sql) as $row) {
                  if($row['art_Existencia'] == ""){
                    $existenciaProducto = 0;
                  } else{
                    $existenciaProducto = round($row['art_Existencia']);
                  }
                  $codigoHtml .= '<tr class="gradeA">';
                  $codigoHtml .= '<td><p align="center">'.$rowSucursal['nombreSucursal'].'</p></td>';
                  $codigoHtml .= '<td><p align="center">'.$row['art_Clave'].'</p></td>';
                  $codigoHtml .= '<td><p align="center">'.$row['art_Nombre'].'</p></td>';
                  $codigoHtml .= '<td><p align="center"> $ '.round($row['art_Total'],2).'</p></td>';
                  $codigoHtml .= '<td><p align="center">'.$existenciaProducto.'</p></td>';
                  $codigoHtml .= '</tr>';
                }
               } else{
                  $codigoHtml .= '<tr class="gradeA">';
                  $codigoHtml .= '<td><p align="center" class="text-warning">'.$rowSucursal['nombreSucursal'].'</p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-warning">No hay datos</p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-warning">No hay datos</p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-warning">No hay datos</p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-warning">No hay datos</p></td>';
                  $codigoHtml .= '</tr>';
               }   
            }
          }catch(Exception $e){
                  $codigoHtml .= '<tr class="gradeA">';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor Fuera de línea </p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                  $codigoHtml .= '</tr>';
          }
      }
    } else {
          try{
            foreach ($conex->consultar($sqlSucursales) as $rowSucursal) {      
            //Validación para la conexión a otro servidor  
              $conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1',$rowSucursal['nombreDB']);

              if($conex->consultarByConex($conex2, $sql) != null){
                foreach ($conex->consultarByConex($conex2, $sql) as $row) {
                  if($row['art_Existencia'] == ""){
                    $existenciaProducto = 0;
                  } else{
                    $existenciaProducto = round($row['art_Existencia']);
                  }
                  $codigoHtml .= '<tr class="gradeA">';
                  $codigoHtml .= '<td><p align="center">'.$rowSucursal['nombreSucursal'].'</p></td>';
                  $codigoHtml .= '<td><p align="center">'.$row['art_Clave'].'</p></td>';
                  $codigoHtml .= '<td><p align="center">'.$row['art_Nombre'].'</p></td>';
                  $codigoHtml .= '<td><p align="center"> $ '.round($row['art_Total'],2).'</p></td>';
                  $codigoHtml .= '<td><p align="center">'.$existenciaProducto.'</p></td>';
                  $codigoHtml .= '</tr>';
                }
               } else{
                  $codigoHtml .= '<tr class="gradeA">';
                  $codigoHtml .= '<td><p align="center" class="text-warning">'.$rowSucursal['nombreSucursal'].'</p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-warning">No hay datos</p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-warning">No hay datos</p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-warning">No hay datos</p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-warning">No hay datos</p></td>';
                  $codigoHtml .= '</tr>';
               }   
            }
          }catch(Exception $e){
                  $codigoHtml .= '<tr class="gradeA">';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor Fuera de línea </p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                  $codigoHtml .= '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                  $codigoHtml .= '</tr>';
          }      
    }
    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=FarmaciasSanaSana$extension");
    header("Pragma: no-cache");
    header("Expires: 0");    
    echo $codigoHtml;

$conex->cerrarConex();
$conex2 = null;