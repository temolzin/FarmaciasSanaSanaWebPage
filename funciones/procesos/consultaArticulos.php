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
  $conex = Conexion::getInstance();
  //CONEX es la variable que obtiene la instancia de la clase conexión.
  //CONEX2 alamacena la conexión a otro servidor, diferente al local.
//Termino de la creación del objeto conexión

//Variable para almacenar las existencias
  $existenciaProducto = 0; 

//Conexión a la Sucursal 512
  echo '
    <div class="panel panel-default">
      <div class="panel-heading">
        Artículos
      </div>
      <div class="panel-body">
        <div id="bodyTabla" name="bodyTabla" class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th align="center">Selecciona</th>
            <th align="center">Sucursal</th>
            <th align="center">SKU</th>
            <th align="center">Nombre</th>
            <th align="center">Precio Venta</th>
            <th align="center">Existencias</th>
            </tr>
        </thead>
        <tbody>';
    $sql = "";
    $txtBuscar = filter_var($_POST['txtBuscar'], FILTER_SANITIZE_STRING);
    $tipoBusqueda = filter_var($_POST['comboArticulo'], FILTER_SANITIZE_STRING);
    $_SESSION['txtBuscarArticulos'] = $txtBuscar;
    $_SESSION['comboArticuloArticulos'] = $tipoBusqueda;
    $skuCompleto = "";
    if($tipoBusqueda == "SKU") {
      if(strlen($txtBuscar) < 15) {
        $condicion = 15 - strlen($txtBuscar);
        for($i = 1; $i <=$condicion; $i++){
          $skuCompleto.= "0";
        }
      }
        $skuCompleto.= $txtBuscar;
      $sql = "SELECT art_Clave, art_Nombre, art_Total, art_Existencia FROM tArticulo WHERE art_Clave = '".$skuCompleto."'";
    } else {
      $sql = "SELECT art_Clave, art_Nombre, art_Total, art_Existencia FROM tArticulo WHERE art_Nombre LIKE '%".$txtBuscar."%'";
    }
    //Variables de sesión para envíar a Excel (exportarArticulos)
    $_SESSION['consultaArticulos'] = $sql;
    $_SESSION['tipoBusquedaArticulos'] = $tipoBusqueda;
    $_SESSION['txtBuscarArticulos'] = $txtBuscar;

    if($_SESSION['tipoUsuario'] == 'Cliente') {
    $sqlSucursalesCliente = "SELECT id_sucursal FROM accesoCliente where id_usuario = ".$_SESSION['id_usuario'];
      foreach ($conex->consultar($sqlSucursalesCliente) as $rowIdSucursal) {
        $sqlSucursales = 'SELECT * FROM sucursales where id_sucursal = '.$rowIdSucursal['id_sucursal'];
        try{
          foreach ($conex->consultar($sqlSucursales) as $rowSucursal) {      
          //Validación para la conexión a otro servidor  
            $conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1',$rowSucursal['nombreDB']);

            $consulta = $conex->consultarByConex($conex2,$sql);
            if($consulta != null){
              foreach ($consulta as $row) {
                if($row['art_Existencia'] == ""){
                  $existenciaProducto = 0;
                } else{
                  $existenciaProducto = round($row['art_Existencia']);
                }
                echo '<tr class="gradeA">
                <td align="center"><input type="checkbox" class="form-control" id="selecciona" value="'.$existenciaProducto.'" name="selecciona"></td>';
                echo '<td><p align="center">'.$rowSucursal['nombreSucursal'].'</p></td>';
                echo '<td><p align="center">'.$row['art_Clave'].'</p></td>';
                echo '<td><p align="center">'.$row['art_Nombre'].'</p></td>';
                echo '<td><p align="center"> $ '.round($row['art_Total'],2).'</p></td>';
                echo '<td><p align="center">'.$existenciaProducto.'</p></td>';
                echo '</tr>';
              }
             } else{
                echo '<tr class="gradeA">
                <td align="center"><input type="checkbox" class="form-control" id="selecciona" name="selecciona" disabled="disabled"></td>';
                echo '<td><p align="center" class="text-warning">'.$rowSucursal['nombreSucursal'].'</p></td>';
                echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
                echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
                echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
                echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
                echo '</tr>';
             }   
          }
        }catch(Exception $e){
                echo '<tr class="gradeA">
                <td align="center"><input type="checkbox" class="form-control" align="center" id="selecciona" name="selecciona" disabled="disabled"></td>';
                echo '<td><p align="center" class="text-danger">Servidor Fuera de línea </p></td>';
                echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
                echo '</tr>';
        }
      }
    } else {
      $sqlSucursales = "SELECT * FROM sucursales";
      try{
        foreach ($conex->consultar($sqlSucursales) as $rowSucursal) {  
        //Validación para la conexión a otro servidor  
          $conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1',$rowSucursal['nombreDB']);
          
          $consulta = $conex->consultarByConex($conex2,$sql);
          if($consulta != null){
            foreach ($consulta as $row) {
              if($row['art_Existencia'] == ""){
                $existenciaProducto = 0;
              } else{
                $existenciaProducto = round($row['art_Existencia']);
              }
              echo '<tr class="gradeA">
              <td align="center"><input type="checkbox" class="form-control" id="selecciona" value="'.$existenciaProducto.'" name="selecciona"></td>';
              echo '<td><p align="center">'.$rowSucursal['nombreSucursal'].'</p></td>';
              echo '<td><p align="center">'.$row['art_Clave'].'</p></td>';
              echo '<td><p align="center">'.$row['art_Nombre'].'</p></td>';
              echo '<td><p align="center"> $ '.round($row['art_Total'],2).'</p></td>';
              echo '<td><p align="center">'.$existenciaProducto.'</p></td>';
              echo '</tr>';
            }
           } else{
              echo '<tr class="gradeA">
              <td align="center"><input type="checkbox" class="form-control" id="selecciona" name="selecciona" disabled="disabled"></td>';
              echo '<td><p align="center" class="text-warning">'.$rowSucursal['nombreSucursal'].'</p></td>';
              echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
              echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
              echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
              echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
              echo '</tr>';
           }   
        }
      }catch(Exception $e){
              echo '<tr class="gradeA">
              <td align="center"><input type="checkbox" class="form-control" align="center" id="selecciona" name="selecciona" disabled="disabled"></td>';
              echo '<td><p align="center" class="text-danger">Servidor Fuera de línea </p></td>';
              echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
              echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
              echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
              echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
              echo '</tr>';
      }
   }
   $conex->cerrarConex();
   $conex2=null;
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
    <script src="../../js/custom.js"></script>
                    ';
?>