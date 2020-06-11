<?php
require('../ProductoExistencia.class.php');
session_start();
//Creación del objeto de conexión
require '../conexion.php';
$conex = Conexion::getInstance();
$tipo = $_REQUEST['tipo'];
if($tipo == 'excel') $extension = '.xls';
if($tipo == 'word') $extension = '.doc';
$codigoHtml = "";

//Consulta a la base de datos para saber el nombre de la sucursal
$archivo = $_SESSION['archivo'];
$nombreDB = $_SESSION['nombreDB'];
$nombresProductos = $_SESSION['nombres'];
$fechaInicio = $_SESSION['fechaInicio'];
$fechaFin = $_SESSION['fechaFin'];


//Se hace el procedimiento para consultar los SKU en todas las sucursales.
    if($nombreDB == "all") {
    $codigoHtml .= '
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <title>Document</title>
      </head>
      <body>
        <table border="1">
          <tr>
            <td colspan="68" align="center" bgcolor="#82BDF8"> 
              <strong>Reporte Ventas Existencias del '.$fechaInicio.' al ' .$fechaFin. ' </strong>
            </td>
          </tr>
          <tr>
            <td rowspan="2" align="center" bgcolor="#81F781">SKU</td>
            <td rowspan="2" align="center" bgcolor="#81F781">Nombre</td>
            <td colspan="3" align="center" bgcolor="#F5DA81">512</td>
            <td colspan="3" align="center" bgcolor="#81F79F">517</td>
            <td colspan="3" align="center" bgcolor="#81BEF7">E-21</td>
            <td colspan="3" align="center" bgcolor="#B18904">TULTITLÁN</td>
            <td colspan="3" align="center" bgcolor="#0080FF">CENTRO</td>
            <td colspan="3" align="center" bgcolor="#2ECCFA">NUEVO LAREDO</td>
            <td colspan="3" align="center" bgcolor="#CEF6F5">GH-45</td>
            <td colspan="3" align="center" bgcolor="#F2F5A9">CASAS ALEMÁN</td>
            <td colspan="3" align="center" bgcolor="#81DAF5">TEZONTEPEC</td>
            <td colspan="3" align="center" bgcolor="#BDBDBD">CIUDAD AZTECA</td>
            <td colspan="3" align="center" bgcolor="#F5A9BC">CIUDAD NEZA</td>
            <td colspan="3" align="center" bgcolor="#CECEF6">SAN PABLO</td>
            <td colspan="3" align="center" bgcolor="#BCF5A9">LA RIOJA</td>
            <td colspan="3" align="center" bgcolor="#81F7F3">TECÁMAC CENTRO</td>
            <td colspan="3" align="center" bgcolor="#F7BE81">VÍA MORELOS</td>
            <td colspan="3" align="center" bgcolor="#E2A9F3">CIUDAD CUAUHTEMOC</td>
            <td colspan="3" align="center" bgcolor="#F3E2A9">TECÁMAC LP</td>
            <td colspan="3" align="center" bgcolor="#CEF6CE">IZCALLI</td>
            <td colspan="3" align="center" bgcolor="#CEF6CE">SAN CRISTÓBAL</td>
            <td colspan="3" align="center" bgcolor="#CEF6CE">TECÁMAC PRESIDENCIA</td>
            <td colspan="3" align="center" bgcolor="#CEF6CE">JARDINES MORELOS</td>
            <td colspan="3" align="center" bgcolor="#CEF6CE">VIA REAL</td>
          </tr>
          <tr>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
          </tr>';
       //Variable para obtener el nombre de todas las sucursales
       $sqlSucursales = "SELECT * FROM sucursales";
      //Se recorre arreglo con los nombres y sku de los productos
      foreach ($nombresProductos as $lin) {
        $codigoHtml .= "<tr>";
        $codigoHtml .= "<td>".$lin->getSku()."</td>";
        $codigoHtml .= "<td>".$lin->getNombre()."</td>";         
        //Se recorre el arreglo de objetos de ProductoExistencia para obtener su existencia y Total de venta
        foreach ($archivo as $sku2 ) {
            if($sku2->getSku() == $lin->getSku()){
              $sqlSucursales = "select * from sucursales";
              foreach ($conex->consultar($sqlSucursales) as $sucursal) {
                if($sku2->getSucursal() == $sucursal['nombreSucursal']) {
                  $codigoHtml .= "<td>".$sku2->getExistencia()."</td>";
                  $codigoHtml .= "<td>".$sku2->getTotalVenta()."</td>";
                  $codigoHtml .= "<td>$ ".$sku2->getPrecioVenta()."</td>";
                } else {
                  $codigoHtml .= "";
                }
              }
          }     
        }    
        $codigoHtml .= "</tr>";
      }
    } else{
      $codigoHtml .= '
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="UTF-8">
        <title>Document</title>
      </head>
      <body>
        <table border="1">
          <tr>
            <td colspan="5" align="center" bgcolor="#82BDF8"> 
              <strong>Reporte Ventas Existencias del '.$fechaInicio.' al ' .$fechaFin. ' </strong>
            </td>
          </tr>
          <tr>
            <td rowspan="2" align="center" bgcolor="#81F781">SKU</td>
            <td rowspan="2" align="center" bgcolor="#81F781">Nombre</td>';
            //Se obtiene el nombre de la sucursal.
              $sqlSucursales = "select * from sucursales where nombreDB = '".$nombreDB."'";
              foreach ($conex->consultar($sqlSucursales) as $sucursal) {
                $codigoHtml .= '<td colspan="3" align="center" bgcolor="#F5DA81">'.$sucursal['nombreSucursal'].'</td>';
              } 
          $codigoHtml .= '
          </tr>
          <tr>
            <td>Existencias</td>
            <td>Ventas</td>
            <td>PrecioVenta</td>
          </tr>';
          //Se itera sobre el arreglo de objetos para imprimirlos en el excel
          foreach ($archivo as $obj) {
            $codigoHtml .= '
            <tr>
              <td>'.$obj->getSku().'</td>
              <td>'.$obj->getNombre().'</td>
              <td>'.$obj->getExistencia().'</td>
              <td>'.$obj->getTotalVenta().'</td>
              <td>$ '.$obj->getPrecioVenta().'</td>
            </tr>';
          }
    }
    $codigoHtml .= '
      </table>
      </body>
      </html>';
//Se imprimen las cabeceras para el excel
header("Content-type: application/vnd.ms-$tipo");
header("Content-Disposition: attachment; filename=FarmaciasSanaSana$extension");
header("Pragma: no-cache");
header("Expires: 0");    
echo $codigoHtml;

$conex->cerrarConex();