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
            <th align="center">Tipo</th>
            <th align="center">Sucursal</th>
            <th align="center">Precio</th>
          </tr>
        </thead>
        <tbody>';

    $txtBuscar = filter_var($_POST['txtBuscar'], FILTER_SANITIZE_STRING);
    $skuCompleto = "";
      if(strlen($txtBuscar) < 15) {
        $condicion = 15 - strlen($txtBuscar);
        for($i = 1; $i <=$condicion; $i++){
          $skuCompleto.= "0";
        }
      }
    $skuCompleto.= $txtBuscar;

    $_SESSION['skuCompletoPrecios'] = $skuCompleto;
    //Aquí trae todas las sucursales registradas en la base de datos
    $sql = "SELECT * FROM sucursales";
    
    //Mayorista o Tradicional
    $tipoSucursal = "";

    try{
      foreach ($conex->consultar($sql) as $rowSucursal) {      
      //Validación para la conexión a otro servidor  
        $conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21','S@na*s1',$rowSucursal['nombreDB']);
        //Validación para ver si es Mayorista y Tradicional
        if($rowSucursal['nombreDB'] == 'dbsavE21' or $rowSucursal['nombreDB'] == 'dbsavGH45' or $rowSucursal['nombreDB'] == 'dbsavTultitlan' or $rowSucursal['nombreDB'] == 'dbsavCentro' or $rowSucursal['nombreDB'] == 'dbsavVia' or $rowSucursal['nombreDB'] == 'dbsavNeza' or $rowSucursal['nombreDB'] == 'dbsav517' or $rowSucursal['nombreDB'] == 'dbsav512' or $rowSucursal['nombreDB'] == 'dbsavLaredo') {
          $tipoSucursal = 'MAYORISTA';
        } else {
          $tipoSucursal = 'TRADICIONAL';
        }
        //Consulta para saber los precios.
        $sql = "SELECT art_Total FROM tArticulo WHERE art_Clave ='".$skuCompleto."'";
        if($conex->consultarByConex($conex2,$sql) != null){
          foreach ($conex->consultarByConex($conex2,$sql) as $row) {
            echo '<tr class="gradeA">';
            echo '<td><p align="center">'.$tipoSucursal.'</p></td>';
            echo '<td><p align="center">'.$rowSucursal['nombreSucursal'].'</p></td>';
            echo '<td><p align="center">$ '.round($row['art_Total'],2).'</p></td>';
            echo '</tr>';
          }
         } else{
            echo '<tr class="gradeA">';
            echo '<td><p align="center" class="text-warning">'.$tipoSucursal.'</p></td>';
            echo '<td><p align="center" class="text-warning">'.$rowSucursal['nombreSucursal'].'</p></td>';
            echo '<td><p align="center" class="text-warning">No hay datos</p></td>';
            echo '</tr>';
         }   
      }
    }catch(Exception $e){
      echo '<tr class="gradeA">';
      echo '<td><p align="center" class="text-danger">No hay sucursales Servidor fuera de Línea </p></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '</tr>';
    }
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
    $conex = null;
    $conex2 = null;
?>