 <?php
 session_start();
 if (isset($_SESSION['nombreUsuario'])==false){
  header('Location: ../../index.html');
} 
//Creación del objeto de conexión
  require_once 'conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conexión

//Variables
  $ticket = filter_var($_POST['ticket'], FILTER_SANITIZE_STRING);
  $_SESSION['ticketVentasDetalle'] = $ticket; 
  $nombreDB = ($_POST['sucursales']);
  $_SESSION['nombreDB'] = $nombreDB;

  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

//Variables para Sumar Totales
  $sumaSubTotal = 0;
  $sumaImporte = 0;
  $sumaTotal = 0;

    try{
      $sql="SELECT vdet_Fecha as 'Fecha', art_Clave as 'SKU', art_Nombre as 'ARTICULO', vdet_Cantidad as 'CANTIDAD', vdet_Descuento as 'Descuento', vdet_Importe as 'IMPORTE', vdet_Total as 'TOTAL', vdet_Fecha as 'FECHA', vdet_SubTotal as 'SUBTOTAL' FROM tVentaDetalle WHERE venta_Folio = '". $ticket ."' and eventa_clave not in('devuelta')";
      $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal,$nombreDB);
      $consulta = $conex->consultarByConex($conex2,$sql);
        if($consulta != null) {
        		  echo '
				<script type="text/javascript" src="../../js/jquery.js"></script>
				    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
				    <script type="text/javascript" src="../../js/jquery-ui-1.9.2.min.js"></script>

				    <link href="../../css/bootstrap.css" rel="stylesheet" />
				    <link href="../../css/font-awesome.css" rel="stylesheet" />
				    <link href="../../css/custom.css" rel="stylesheet" />
				   <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
				<link href="../../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        		  <br /><br />';
				      //Consulta para saber el tipo de pago del ticket
					  $sqlTipoPago = "SELECT tpago_Clave from tVentaPago tvp where venta_Folio = '".$ticket."'";
					  $tipoPago = "";
					  $consulta = $conex->consultarByConex($conex2,$sqlTipoPago);
					  if($consulta != null){
						  foreach ($consulta as $row) {
						    $tipoPago = $row['tpago_Clave'];
						  }
					  } else {
					  	$tipoPago = "No Registrado";
					  }
					  $_SESSION['tipoPago'] = $tipoPago;

					echo "
					<div class='col-md-3'></div>
                	<div class='col-md-2' align='center'>
                      <font size='4' color='black'>Tipo de Pago</font>
                    </div>
	                <div align='center' class='col-md-3'>
	                	<input type='text' class='form-control' disabled='disabled' value='".$tipoPago."' name='tipoPago' id='tipoPago'>
	                </div>
	                <div class='col-md-4'></div> <br><br><br>";
				    	
				    echo '<div class="panel panel-default">
				      	<div align="center" class="panel-heading">';
				      //Código para poner Fecha en el Ticket.
				      $sql2="SELECT top 1 vdet_Fecha as 'Fecha' FROM tVentaDetalle WHERE venta_Folio = '". $ticket ."' and eventa_clave not in('devuelta')";
				      foreach ($conex->consultarByConex($conex2,$sql2) as $row) {
				      	$formatoFecha = new DateTime($row['Fecha']);
				      }
				      echo "<font size='5'>Detalle Venta <br> Fecha: " .$formatoFecha->format('d-m-Y H:i:s')." </font>";
				      $_SESSION['fechaTicket'] = $formatoFecha->format('d-m-Y H:i:s');
				      echo '
				      </div>
				      <div class="panel-body">
				        <div id="tablaDetalleVentas" name="tablaDetalleVentas" class="table-responsive">
				      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
				        <thead>
				          <tr>
				            <th align="center">SKU </th>
				            <th align="center">Artículo</th>
				            <th align="center">Cantidad</th>
				            <th align="center">Descuento</th>
				            <th align="center">Importe</th>
				            <th align="center">Subtotal</th>
				            <th align="center">Total</th>
				           </tr>
				        </thead>
				        <tbody>';
	          foreach ($conex->consultarByConex($conex2,$sql) as $row) {
	            echo '<tr class="gradeA">';
	            echo '<td><p align="center">'.$row['SKU'].'</p></td>';
	            echo '<td><p align="center">'.$row['ARTICULO'].'</p></td>';
	            echo '<td><p align="center">'.round($row['CANTIDAD'],2).'</p></td>';
	            echo '<td><p align="center"> % '.round($row['Descuento'],2).'</p></td>';
	            echo '<td><p align="center"> $ '.round($row['IMPORTE'],2).'</p></td>';
	            echo '<td><p align="center"> $ '.round($row['SUBTOTAL'],2).'</p></td>';
	            echo '<td><p align="center"> $ '.round($row['TOTAL'],2).'</p></td>';
	            echo '</tr>';
	            $sumaTotal = $sumaTotal + round($row['TOTAL'],2);
	            $sumaSubTotal = $sumaSubTotal + round($row['SUBTOTAL'],2);
	            $sumaImporte = $sumaImporte + round($row['IMPORTE'],2);
          	   }
          	    echo'</tbody> 
				      </table> 
				      </div>
				      </div>
				      </div>
				  <div class="col-md-1"></div>
				  <div class="col-md-2 text-info lead text-center"> Total: </div>
				  <div class="col-md-2 text-info" align = "center"> 
				      Importe 
				      <input type="text" class="form-control lead" align="center" readonly="readonly" value= "$ '.round($sumaImporte,2).'">
				  </div>
				  <div class="col-md-2 text-info" align="center"> 
				      Subtotal
				      <center><input type="text" readonly="readonly" align="center" class="form-control lead" value= $'.round($sumaSubTotal,2).'></center>
				  </div>
				  <div class="col-md-2 text-info" align="center"> 
				      Total
				      <center><input type="text" readonly="readonly" align="center" class="form-control lead" value= $'.round($sumaTotal,2).'></center>
				  </div>
				      <br><br><br><br>
				      <hr/>';

				      //Muestra la tabla de Devoluciones
					$sql = "SELECT art_Clave as 'SKU', art_Nombre as 'NOMBRE', vdet_Cantidad as 'CANTIDAD', vdet_Descuento as 'Descuento' ,vdet_Importe as 'IMPORTE', vdet_SubTotal as 'SUBTOTAL', vdet_Total as 'TOTAL' FROM tDevolucion WHERE venta_Folio = ".$ticket;
					  echo '
					  <div class="col-md-4"></div>
					    <div class="panel panel-default">
					      <div align="center" class="panel-heading">
					        <font size="5" color="red">Devoluciones</font>
					      </div>
					      <div class="panel-body">
					        <div id="tablaDevolucionDiv" name="tablaDevolucionDiv" class="table-responsive">
					      <table class="table table-striped table-bordered table-hover" id="tablaDevolucion">
					        <thead>
					          <tr>
					            <th align="center">SKU </th>
					            <th align="center">Artículo</th>
					            <th align="center">Cantidad</th>
					            <th align="center">Descuento</th>
					            <th align="center">Importe</th>
					            <th align="center">SubTotal</th>
					            <th align="center">Total</th>
					           </tr>
					        </thead>
					        <tbody>';

					    //Reasigno el valor a las variables
					    $sumaTotal = 0;
					    $sumaImporte = 0;
					    $sumaSubTotal = 0;
					    try{
					        if($conex->consultarByConex($conex2, $sql) != null) {
					          foreach ($conex->consultarByConex($conex2,$sql) as $row) {
					            echo '<tr class="gradeA">';
					            echo '<td><p class="text-danger" align="center">'.$row['SKU'].'</p></td>';
					            echo '<td><p class="text-danger" align="center">'.$row['NOMBRE'].'</p></td>';
					            echo '<td><p class="text-danger" align="center">'.round($row['CANTIDAD'],2).'</p></td>';
					            echo '<td><p class="text-danger" align="center"> % '.round($row['Descuento'],2).'</p></td>';
					            echo '<td><p class="text-danger" align="center"> $ '.round($row['IMPORTE'],2).'</p></td>';
					            echo '<td><p class="text-danger" align="center"> $ '.round($row['SUBTOTAL'],2).'</p></td>';
					            echo '<td><p class="text-danger" align="center"> $ '.round($row['TOTAL'],2).'</p></td>';
					            echo '</tr>';
					            $sumaTotal = $sumaTotal + round($row['TOTAL'],2);
					            $sumaSubTotal = $sumaSubTotal + round($row['SUBTOTAL'],2);
					            $sumaImporte = $sumaImporte + round($row['IMPORTE'],2);
					          }
					         } else{
					          echo '<tr class="gradeA">';
					          echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
					          echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
					          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
					          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
					          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
					          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
					          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
					          echo '</tr>';
					         }   
					    }catch(PDOException $e){
					      echo '<tr class="gradeA">';
					      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
					      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
					      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
					      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
					      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
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
					      <div class="col-md-1"></div>
					      <div class="col-md-2 text-center text-danger lead"> Total Devolución: </div>
					      <div class="col-md-2 text-danger" align = "center"> 
					          Importe 
					          <input type="text" class="form-control lead" align="center" readonly="readonly" value= "$ '.round($sumaImporte,2).'">
					      </div>
					      <div class="col-md-2 text-danger" align="center"> 
					         Subtotal
					         <center><input type="text" readonly="readonly" align="center" class="form-control lead" value= $'.round($sumaSubTotal,2).'></center>
					      </div>
					      <div class="col-md-2 text-danger" align="center"> 
					         Total
					         <center><input type="text" readonly="readonly" align="center" class="form-control lead" value= $'.round($sumaTotal,2).'></center>
					      </div>
					      <br><br><br><br><br><br>
					      <!-- DATA TABLE SCRIPTS -->
						    <script src="../../js/dataTables/jquery.dataTables.js"></script>
						    <script src="../../js/dataTables/dataTables.bootstrap.js"></script>
						        <script>
						            $(document).ready(function () {
						                $("#dataTables-example").dataTable();
						            });
						    </script>
						    <script>
						            $(document).ready(function () {
						                $("#tablaDevolucion").dataTable();
						            });
						    </script>';
        	
        } else {
        	return false;
        }    
    } catch(PDOException $e){
    	echo 'errorServer';
    }
 	
 	$conex2 = null;
 	$conex = null;

?>