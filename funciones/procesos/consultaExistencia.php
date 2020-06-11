<?php
session_start();
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
  $conex = Conexion::getinstance();
//Termino de la creación del objeto conexión

//Variable para almacenar las existencias
  $existenciaProducto = 0; 

//Conexión a la Sucursal 512
  echo '
    <div class="panel panel-default">
      <div class="panel-heading" align="center">
        Existencias
      </div>
      <div class="panel-body">
        <div id="bodyTabla" name="bodyTabla" class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th align="center">SKU</th>
            <th align="center">Nombre</th>
            <th align="center">Precio Venta</th>
            <th align="center">Existencias</th>
            </tr>
        </thead>
        <tbody>';

    $nombreDB = filter_var($_POST['comboSucursal'], FILTER_SANITIZE_STRING);
    $_SESSION['sucursalExistencia'] = $nombreDB;
    $sql = "SELECT art_Clave, art_Nombre, art_Total, art_Existencia FROM tArticulo where art_Existencia > 0 order by art_Existencia desc";

    $passwordSucursal = "S@na*s1";
    $ipSucursal = '192.168.100.21';

    //Conexión a la sucursal seleccionada
      try{
        $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
          foreach ($conex->consultarByConex($conex2,$sql) as $row) {
            if($row['art_Existencia'] == ""){
              $existenciaProducto = 0;
            } else{
              $existenciaProducto = round($row['art_Existencia']);
            }
            echo '<tr class="gradeA">';
            echo '<td><p align="center">'.$row['art_Clave'].'</p></td>';
            echo '<td><p align="center">'.$row['art_Nombre'].'</p></td>';
            echo '<td><p align="center"> $ '.round($row['art_Total'],2).'</p></td>';
            echo '<td><p align="center">'.$existenciaProducto.'</p></td>';
            echo '</tr>';
          }
      } catch(Exception $e){
            echo '<tr class="gradeA">';
            echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
            echo '</tr>';
      }
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