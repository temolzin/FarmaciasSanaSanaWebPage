<?php  
require('../conexion.php');
$conex = Conexion::getInstance();
//Variables para consultar sucursales
$sqlSucursales = "SELECT * FROM sucursales";

$tipoReporte = $_POST['tipoReporte'];

if(isset($_POST['fechaInicio']) and isset($_POST['fechaFin'])){
  $fechaInicio = $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];
} 
$fechaHoy = date('Ymd');

$contenidoTxt="";
$nombreArchivo="34".$fechaHoy;
//Cabecera del archivo TXT
if($tipoReporte == 'venta'){
  $contenidoTxt = "Fecha|CodCadena|CodigoEAN|Unidades|VentaBruta|Descuentos|VentaNeta|CostoVenta|".PHP_EOL;
  $nombreArchivo .= "_Vta.txt";
} else if ($tipoReporte == 'inventario') {
  $contenidoTxt = "FechaInv|CodCadena|CodigoEAN|Existencia|CostoPromInv|UltimoCosto|".PHP_EOL;
  $nombreArchivo .= "_Inv.txt";
} else if($tipoReporte == 'catalogo'){
  $contenidoTxt = "CodigoCadena|CodigoEAN|NombreProducto|Laboratorio|Familia01|Familia02|Familia03|Familia04|".PHP_EOL;
  $nombreArchivo .= "_Cat.txt";
}


  //Se hace el procedimiento para consultar en todas las sucursales.
    try{
      foreach ($conex->consultar($sqlSucursales) as $rowSucursal) {      
      //Validación para la conexión a otro servidor  
        $conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1',$rowSucursal['nombreDB']);
        //En Caso que el usuario pida un reporte de Venta.
        if($tipoReporte == "venta") {
          $sqlVenta = "select * from tVentaDetalle where vdet_Fecha between '".$fechaInicio."' and '".$fechaFin."'";
          $consulta = $conex->consultarByConex($conex2,$sqlVenta);
          if($consulta != null) {
            foreach ($consulta as $row) {
              $formatoFecha= new DateTime($row['vdet_Fecha']);
              $contenidoTxt .= $formatoFecha->format('Ymd'); 
              $contenidoTxt .= "|";
              $contenidoTxt .= "34";
              $contenidoTxt .= "|";
              $contenidoTxt .= $row['art_Clave'];
              $contenidoTxt .= "|";
              $contenidoTxt .= $row['vdet_Cantidad'];
              $contenidoTxt .= "|";
              $contenidoTxt .= number_format($row['vdet_Importe'], 2, '.', '');
              $contenidoTxt .= "|";
              $contenidoTxt .= number_format($row['vdet_Descuento'],2,'.','');
              $contenidoTxt .= "|";
              $contenidoTxt .= number_format($row['vdet_Total'],2,'.','');
              $contenidoTxt .= "|";
              $contenidoTxt .= number_format($row['vdet_Costo'],2,'.','');
              $contenidoTxt .= "|";
              $contenidoTxt .= PHP_EOL;
            }            
           } else{
              //En caso que no haya registros en la tabla tDetalleVenta mostrará lo siguiente.
              //$contenidoTxt = "No hay registros en la sucursal ".$rowSucursal['nombreSucursal']." , en las fechas. ". $fechaInicio . " al ".$fechaFin . PHP_EOL;
           }   
        } //En caso que el usuario pida un reporte de Inventario. 
        else if($tipoReporte == "inventario") {
            $sqlInventario = "select * from tArticulo where art_FecExistencia between '".$fechaInicio."' and '".$fechaFin."'";
            $consulta = $conex->consultarByConex($conex2, $sqlInventario);
            if($consulta != null) {
              foreach ($consulta as $row) {
                $formatoFecha = new DateTime($row["art_FecExistencia"]);
                $contenidoTxt .= $formatoFecha->format('Ymd');
                $contenidoTxt .= "|";
                $contenidoTxt .= "34";
                $contenidoTxt .= "|";
                $contenidoTxt .= $row['art_Clave'];
                $contenidoTxt .= "|";
                $contenidoTxt .= $row['art_Existencia'];
                $contenidoTxt .= "|";
                $contenidoTxt .= number_format($row['art_CostoPromedio'],2,'.','');
                $contenidoTxt .= "|";
                $contenidoTxt .= number_format($row['art_Costo'],2,'.','');
                $contenidoTxt .= "|";
                $contenidoTxt .= PHP_EOL;
              }            
             } else{
                //En caso que no haya registros en la tabla tDetalleVenta mostrará lo siguiente.
                //$contenidoTxt = "No hay registros en la sucursal ".$rowSucursal['nombreSucursal']." , en las fechas. ". $fechaInicio . " al ".$fechaFin . PHP_EOL;
             }   
        } 
        //En caso que el usuario pida un reporte de catálogo (Sólo se muestra la información de Tecámac Centro). 
        else if($tipoReporte == "catalogo" and $rowSucursal['nombreDB'] == 'dbsavTecCen') {
            $sqlCatalogo = "select * from tArticulo WHERE art_Existencia > 0";
            $consulta = $conex->consultarByConex($conex2,$sqlCatalogo);
            if($consulta != null) {
              foreach ($consulta as $row) {
                $contenidoTxt .= "34";
                $contenidoTxt .= "|";
                $contenidoTxt .= $row['art_Clave'];
                $contenidoTxt .= "|";
                $contenidoTxt .= $row['art_Nombre'];
                $contenidoTxt .= "|";
                $contenidoTxt .= $row['fab_Clave'];
                $contenidoTxt .= "|";
                $contenidoTxt .= $row['tart_Clave'];
                $contenidoTxt .= "|";
                $contenidoTxt .= "";
                $contenidoTxt .= "|";
                $contenidoTxt .= "";
                $contenidoTxt .= "|";
                $contenidoTxt .= "";
                $contenidoTxt .= "|";
                $contenidoTxt .= PHP_EOL;
              }            
             } else{
                //En caso que no haya registros en la tabla tDetalleVenta mostrará lo siguiente.
                //$contenidoTxt = "No hay registros consulta al programador";
             }   
        } 
      }
    }catch(Exception $e){
      $contenidoTxt = "No hay conexión al server";
    } 

$conex->cerrarConex();
$conex2 = null;

header("Content-disposition: attachment; filename=$nombreArchivo");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".strlen($contenidoTxt));
header("Pragma: no-cache");
header("Expires: 0");
     
echo $contenidoTxt;
  ?>