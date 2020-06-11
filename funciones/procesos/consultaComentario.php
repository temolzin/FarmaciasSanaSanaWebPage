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
            <th align="center">Sucursal</th>
            <th align="center">Edad</th>
            <th align="center">Sexo</th>
            <th align="center">Comentario</th>
            <th align="center">Fecha</th>
          </tr>
        </thead>
        <tbody>';

    $txtBuscar = filter_var($_POST['sucursal'], FILTER_SANITIZE_STRING);

    try{
      
        if($txtBuscar=='Global'){
        	$sql = "SELECT sucursal, edad, sexo, comentario, SUBSTRING(fecha,1,10)fecha FROM cuestionario";

        }else{
        $sql = "SELECT scurusal, edad, sexo, comentario, SUBSTRING(fecha,1,10)fecha FROM cuestionario where sucursal='".$txtBuscar."'";
        }
        
          foreach ($conex->consultar($sql) as $row) {
            echo '<tr class="gradeA">';
            echo '<td><p align="center">'.$row['sucursal'].'</p></td>';
            echo '<td><p align="center">'.$row['edad'].'</p></td>';
            echo '<td><p align="center">'.$row['sexo'].'</p></td>';
            echo '<td><p align="center">'.$row['comentario'].'</p></td>';
            echo '<td><p align="center">'.$row['fecha'].'</p></td>';
            echo '</tr>';
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