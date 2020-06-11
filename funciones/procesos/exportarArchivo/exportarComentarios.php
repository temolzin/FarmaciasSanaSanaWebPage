<?php
//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';

$codigoHtml = '
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>comentarios</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" bgcolor="skyblue"><CENTER><strong>REPORTE DE COMENTARIOS </strong></CENTER></td>
  </tr>
  <thead>
  <tr>
    <th bgcolor="#0FEC76" align="center">SUCURSAL</th>
    <th bgcolor="#0FEC76" align="center">EDAD</th>
    <th bgcolor="#0FEC76" align="center">SEXO</th>
    <th bgcolor="#0FEC76" align="center">COMENTRARIO</th>
    <th bgcolor="#0FEC76" align="center">FECHA</th>
   </tr>
   </thead>';

    $sql = "SELECT sucursal, edad, sexo, comentario, SUBSTRING(fecha,1,10)fecha FROM cuestionario";
    //$passwordSucursal = "Admin01";
    //$ipSucursal = '192.168.1.151';
    
    //Conexión a 512
      try{
          foreach ($conex->consultar($sql) as $row) {
            $codigoHtml .= '<tr class="gradeA">';
            $codigoHtml .= '<td><p align="center">'.$row['sucursal'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['edad'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['sexo'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['comentario'].'</p></td>';
            $codigoHtml .= '<td><p align="center">'.$row['fecha'].'</p></td>';
            $codigoHtml .= '</tr>';
          }
      } catch(Exception $e){
           $codigoHtml .= '<tr class="gradeA">';
           $codigoHtml .= '<td><p align="center" class="text-danger">No hay sucursales Servidor fuera de Línea </p></td>';
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