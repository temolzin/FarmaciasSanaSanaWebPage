<?php
session_start();

//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';

//Variable que recibe el sku ingresado por el usuario
$skuCompleto = $_SESSION['skuCompletoPrecios'];

//Consulta a la base de datos todas las sucursales
$sql = "SELECT * FROM sucursales";

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
    <td colspan="3" bgcolor="skyblue"><CENTER><strong>REPORTE DE PRECIOS</strong></CENTER></td>
  </tr>
  <tr>
  	<td colspan="3" bgcolor="skyblue"><CENTER><strong> SKU: '.$skuCompleto.'</strong></td></CENTER>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">Tipo </th>
    <th bgcolor="#0FEC76" align="center">Sucursal</th>
    <th bgcolor="#0FEC76" align="center">Precio</th>
   </tr>
   </thead>';

    //Mayorista o Tradicional
    $tipoSucursal = "";

    try{
      foreach ($conex->consultar($sql) as $rowSucursal) {      
      //Validación para la conexión a otro servidor  
        $conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1',$rowSucursal['nombreDB']);
        
        //Validación para ver si es Mayorista y Tradicional
        if($rowSucursal['nombreDB'] == 'dbsavE21' or $rowSucursal['nombreDB'] == 'dbsavGH45' or $rowSucursal['nombreDB'] == 'dbsavTultitlan' or $rowSucursal['nombreDB'] == 'dbsavCentro' or $rowSucursal['nombreDB'] == 'dbsavVia' or $rowSucursal['nombreDB'] == 'dbsavNeza' or $rowSucursal['nombreDB'] == 'dbsav517' or $rowSucursal['nombreDB'] == 'dbsav512' or $rowSucursal['nombreDB'] == 'dbsavLaredo'){
          $tipoSucursal = 'MAYORISTA';
        } else{
          $tipoSucursal = 'TRADICIONAL';
        }
        //Consulta para saber los precios
        $sql = "SELECT art_Total FROM tArticulo WHERE art_Clave ='".$skuCompleto."'";
        if($conex->consultarByConex($conex2, $sql) != null){
          foreach ($conex->consultarByConex($conex2, $sql) as $row) {
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .=  '<td><p align="center">'.$tipoSucursal.'</p></td>';
            $codigoHtml .=  '<td><p align="center">'.$rowSucursal['nombreSucursal'].'</p></td>';
            $codigoHtml .=  '<td><p align="center">$ '.round($row['art_Total'],2).'</p></td>';
            $codigoHtml .=  '</tr>';
          }
         } else{
            $codigoHtml .=  '<tr class="gradeA">';
            $codigoHtml .=  '<td><p align="center" class="text-warning">'.$tipoSucursal.'</p></td>';
            $codigoHtml .=  '<td><p align="center" class="text-warning">'.$rowSucursal['nombreSucursal'].'</p></td>';
            $codigoHtml .=  '<td><p align="center" class="text-warning">No hay datos</p></td>';
            $codigoHtml .=  '</tr>';
         }   
      }
    }catch(Exception $e){
      $codigoHtml .=  '<tr class="gradeA">';
      $codigoHtml .=  '<td><p align="center" class="text-danger">No hay sucursales Servidor fuera de Línea </p></td>';
      $codigoHtml .=  '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      $codigoHtml .=  '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      $codigoHtml .=  '</tr>';
    }
    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=FarmaciasSanaSana$extension");
    header("Pragma: no-cache");
    header("Expires: 0");    
    echo $codigoHtml;

    $conex->cerrarConex();
    $conex2 = null;

?>
