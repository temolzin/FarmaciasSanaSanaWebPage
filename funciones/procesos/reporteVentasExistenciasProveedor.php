<?php
session_start();
set_time_limit(900);
require('ProductoExistencia.class.php');
if (isset($_SESSION['nombreUsuario'])==false){
  header('Location: ../../index.html');
} 

//Scripts para visualizar los DATATABLES
echo '
<script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui-1.9.2.min.js"></script>
    <link href="../../css/bootstrap.css" rel="stylesheet" />
    <link href="../../css/font-awesome.css" rel="stylesheet" />
    <link href="../../css/custom.css" rel="stylesheet" />
   <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
<link href="../../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />';

//Creación del objeto de conexión
  require 'conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conexión

  $fechaInicio = $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];
  $nombreDB = filter_var($_POST['sucursales'], FILTER_SANITIZE_STRING);
  $_SESSION['nombreDB'] = $nombreDB;
  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

  echo '
    <div class="panel panel-default">
      <div align="center" class="panel-heading">
        Reporte Ventas Proveedor
      </div>
      <div class="panel-body">
        <div id="bodyTabla" name="bodyTabla" class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th align="center">Sucursal</th>
            <th align="center">SKU</th>
            <th align="center">Nombre</th>
            <th align="center">Existencias Actuales</th>
            <th align="center">Total de venta</th>
            <th align="center">PrecioVenta</th>
          </tr>
        </thead>
        <tbody>';

$_SESSION['fechaInicio'] = $fechaInicio;
$_SESSION['fechaFin'] = $fechaFin;

$nombresProductos = "";
$arregloCompleto = array();
$arregloNombres = array();

$consulta = $conex->consultar("select * from skuProveedor where id_usuario = " .$_SESSION['id_usuario']);
foreach ($consulta as $fila) {

  $sql = "SELECT ta.art_Clave as 'SKU', ta.art_Total as 'PrecioVenta' ,ta.art_Nombre 'Nombre', ISNULL(ta.art_Existencia,0) as 'Existencias', " .
                    "(SELECT ISNULL (SUM(vdet_Cantidad),0) as 'Total de venta' FROM tVentaDetalle " .
                    "where art_Clave = '" . $fila['sku'] . "' and (vdet_Fecha BETWEEN '" . $fechaInicio . "' and '" . $fechaFin . "') " .
                    "AND term_Clave NOT IN ('TERMINAL85','TERMINAL1')) AS 'Total de Venta' " .
                    "from tArticulo ta  where art_Clave = '" . $fila['sku'] . "'" .
                    "GROUP BY ta.art_Clave,ta.art_Total, ta.art_Nombre, ta.art_Existencia";

$sqlNombre = "select art_Nombre from tArticulo where art_Clave = '".$fila['sku']."'";
//Se obtienen los nombres que saldran en el excel.
$conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1','dbsav517');
//Se crea un objeto para asignarle el nombre y el sku de los productos consultados
$objeto2 = new ProductoExistencia();
$objeto2->setSku($fila['sku']);
  //Verifica si está el sku registrado en 517 y si no le pone de nombre N/A.
  $consulta = $conex->consultarByConex($conex2, $sqlNombre);
  if($consulta != null){
    foreach ($consulta as $row) {
      $objeto2->setNombre($row['art_Nombre']);
      array_push($arregloNombres, $objeto2);
    }
  } else {
      $objeto2->setNombre("N/A");
      array_push($arregloNombres, $objeto2);
  }

  //Variables para consultar sucursales
  $sqlSucursales = "SELECT * FROM sucursales";
  $sqlNombreSucursal = "select nombreSucursal from sucursales where nombreDB = '".$nombreDB."'";

  //Se hace el procedimiento para consultar los SKU en todas las sucursales.
    if($nombreDB == "all") {
    try{
      foreach ($conex->consultar($sqlSucursales) as $rowSucursal) {      
      //Validación para la conexión a otro servidor  
        $conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1',$rowSucursal['nombreDB']);
        $consulta = $conex->consultarByConex($conex2, $sql);
        if($consulta != null) {
          foreach ($consulta as $row) {
            echo '<tr class="gradeA">';
            $sqlNombreSucursal = "select nombreSucursal from sucursales where nombreDB = '".$rowSucursal['nombreDB']."'";
            //Se crea el objeto para asignar Existencias y Ventas
            $objeto = new ProductoExistencia();
            foreach ($conex->consultar($sqlNombreSucursal) as $nameSucursal) {
              echo '<td><p align="center">'.$nameSucursal['nombreSucursal'].'</p></td>';
              $objeto->setSucursal($nameSucursal['nombreSucursal']);
            }
            echo '<td><p align="center">'.$row['SKU'].'</p></td>';
            echo '<td><p align="center">'.$row['Nombre'].'</p></td>';
            echo '<td><p align="center">'.round($row['Existencias']).'</p></td>';
            echo '<td><p align="center">'.round($row['Total de Venta'],2).'</p></td>';
            echo '<td><p align="center">'.round($row['PrecioVenta'],2).'</p></td>';
            echo '</tr>';
            //Asignación de valores al objeto con existencias y Total de Venta
            $objeto->setSku($fila['sku']);
            $objeto->setExistencia(round($row['Existencias']));
            $objeto->setTotalVenta($row['Total de Venta']);
            $objeto->setPrecioVenta(round($row['PrecioVenta'],2));
            //Se agregar el objeto al arreglo
            array_push($arregloCompleto, $objeto);
          }
          
         } else{
            //Asignación de valores al objeto con existencias y Total de Venta
            $objeto = new ProductoExistencia();
            $objeto->setSku($fila['sku']);
            $objeto->setSucursal($rowSucursal['nombreSucursal']);
            $objeto->setExistencia("N/A");
            $objeto->setTotalVenta("N/A");
            $objeto->setPrecioVenta("N/A");
            //Se agregar el objeto al arreglo
            array_push($arregloCompleto, $objeto);
            echo '<tr class="gradeA">';
            echo '<td><p align="center" class="text-warning">'.$rowSucursal['nombreSucursal'].'</p></td>';
            echo '<td><p align="center" class="text-warning">'.$fila['sku'].'</p></td>';
            echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
            echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
            echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
            echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
            echo '</tr>';
         }   
      }
    }catch(Exception $e){
            echo '<tr class="gradeA">';
            echo '<td><p align="center" class="text-danger">Servidor Fuera de línea </p></td>';
            echo '<td><p align="center" class="text-danger">Servidor Fuera de línea </p></td>';
            echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            echo '</tr>';
    }
  } 
  //Termina procedimiento para consultar en todas las sucursales, e inicia para consultar en sucursal individualmente
  else {
      //Validación para la conexión a otro servidor  
      $conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1',$nombreDB);
        
      $consulta = $conex->consultarByConex($conex2, $sql);
      if($consulta != null){
        foreach ($consulta as $row) {
            echo '<tr class="gradeA">';
            $objeto = new ProductoExistencia();
            foreach ($conex->consultar($sqlNombreSucursal) as $nameSucursal) {
              echo '<td><p align="center">'.$nameSucursal['nombreSucursal'].'</p></td>';
              $objeto->setSucursal($nameSucursal['nombreSucursal']);
            }
            $objeto->setSku($fila['sku']);
            $objeto->setExistencia(round($row['Existencias']));
            $objeto->setTotalVenta(round($row['Total de Venta'],2));
            $objeto->setPrecioVenta(round($row['PrecioVenta'],2));
            $objeto->setNombre($row['Nombre']);
            array_push($arregloCompleto, $objeto);
            echo '<td><p align="center">'.$row['SKU'].'</p></td>';
            echo '<td><p align="center">'.$row['Nombre'].'</p></td>';
            echo '<td><p align="center">'.round($row['Existencias']).'</p></td>';
            echo '<td><p align="center">'.round($row['Total de Venta'],2).'</p></td>';
            echo '<td><p align="center">'.round($row['PrecioVenta'],2).'</p></td>';
            echo '</tr>';
          }
        } else {
            //Asignación de valores al objeto con existencias y Total de Venta
            $objeto = new ProductoExistencia();
            $objeto->setSku($fila['sku']);
            $objeto->setNombre("N/A");
            $objeto->setSucursal("N/A");
            $objeto->setExistencia("N/A");
            $objeto->setTotalVenta("N/A");
            $objeto->setPrecioVenta("N/A");
            //Se agregar el objeto al arreglo
            array_push($arregloCompleto, $objeto);
            echo '<tr class="gradeA">';
            echo '<td><p align="center" class="text-danger">'.$fila['sku'].'</p></td>';
            echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
            echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
            echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
            echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
            echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
            echo '</tr>';
    }   
  }
//cerramos bucle
}
$_SESSION['archivo'] = $arregloCompleto;
$_SESSION['nombres'] = $arregloNombres;
$conex->cerrarConex();
$conex2 = null;
echo'
      </tbody> 
      </table> 
      </div>
      </div>
      </div>
    <script src="../../js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
    <script src="../../js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="../../js/dataTables/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $("#dataTables-example").dataTable();
            });
    </script>
    <script src="../../js/custom.js"></script>';
?>