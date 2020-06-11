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

//Creación del objeto de conex2ión
  require 'conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conex2ión

//Variables

  $id_proveedor = filter_var($_POST['comboProveedor'], FILTER_SANITIZE_STRING);
  $_SESSION['id_proveedor'] = $id_proveedor;

  echo '
    <div class="panel panel-default">
      <div align="center" class="panel-heading">
       	SKU del proveedor
      </div>
      <div class="panel-body">
        <div id="bodyTabla" name="bodyTabla" class="table-responsive">
      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr align="center">
          	<th align="center">Eliminar</th>
            <th align="center">SKU</th>
            <th align="center">Nombre</th>
           </tr>
        </thead>
        <tbody>';

	 $sql="SELECT sku FROM skuProveedor where id_usuario = ". $id_proveedor;

    //conex2ión a Sucursal Seleccionada
    try{
        if($conex->consultar($sql) != null){
          foreach ($conex->consultar($sql) as $row) {
            echo '<tr class="gradeA">';
            echo '<td align="center"><a align="center" href="../procesos/eliminarSKUPRoveedor.php?sku='.$row['sku'].'"><img src="../../images/formularios/eliminar.png"/></a> </td>';
            echo '<td><p align="center">'.$row['sku'].'</p></td>';
			$conex2 = $conex->conectarByIPandPasswordandDBName('192.168.100.21', 'S@na*s1', 'dbsav517');
			$consulta = "SELECT art_Nombre from tArticulo where art_Clave = '" . $row['sku'] ."'";
			$consultaPDO = $conex->consultarByConex($conex2, $consulta);
			if($consultaPDO != null) {
				foreach ($consultaPDO as $row2) {
					echo '<td><p align="center">'. $row2['art_Nombre'] . '</p></td>';
				}
			} else {
				echo '<td><p align="center"> No Registrado </p></td>';
			}
            echo '</tr>';
          }
        } else{
		      echo '<tr class="gradeA">';
			  echo '<td align="center"><input type="radio" id="tablaProveedor" class="form-control" name="tablaProveedor" disabled="disabled"></td>';
		      echo '<td><p align="center" class="text-danger">No hay SKU Registrados </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay SKU Registrados </p></td>';
		      echo '<td><p align="center" class="text-danger">No hay SKU Registrados </p></td>';
		      echo '</tr>';
         }   
    }catch(PDOException $e){
      echo '<tr class="gradeA">';
      echo '<td align="center"><input type="radio" id="tablaProveedor" class="form-control" name="tablaProveedor" disabled="disabled"></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
      echo '</tr>';
    }
 $conex2 = null;
 $conex = null;
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