<?php
session_start();
//Creación del objeto de conexión
  require 'conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conexión

  $sucursal = $_POST['comboSucursal'];
  if($sucursal == "default"){
  	echo "Selecciona Sucursal";
  } else{
	//Variables para la conexión a la base de datos
	$passwordSucursal = "S@na*s1";
  	$ipSucursal = '192.168.1.151';
	//Sucursal 512
	if($sucursal == '512') {
	  //Variable para envíar el nombre de la base de datos al detalle de venta 
	  $_SESSION['nombreDB'] = 'dbsav512';
	  $nombreDB = 'dbsav512';
	} // Sucursal 517
	else if($sucursal == '517') {
	  $_SESSION['nombreDB'] = 'dbsav517';
	  $nombreDB = 'dbsav517';
	} else if($sucursal == 'E21') {
	  $_SESSION['nombreDB'] = 'dbsavE21';
	  $nombreDB = 'dbsavE21';
	} else if($sucursal == 'GH45') {
	  $_SESSION['nombreDB'] = 'dbsavGH45';
	  $nombreDB = 'dbsavGH45';
	} 
	
	//Se válida que comboClientes exista.
	//Sí la variable existe consulta la información de crédito del cliente
	if(isset($_POST['comboClientes'])) {
	//Se imprimen las librerías para los dataTables.
	echo '<script type="text/javascript" src="../../js/jquery.js"></script>
	    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
	    <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
	    <script type="text/javascript" src="../../js/sweetalert.min.js"></script>';
		$claveCliente = $_POST['comboClientes'];
		$sqlTCliente = "SELECT * FROM tCliente where cli_Clave = '".$claveCliente."'";
	    $sqlTCobranza = "SELECT * FROM tCobranza where cli_Clave = '".$claveCliente."'";
	 try{
	 	$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal,$nombreDB);
	 	$consulta = $conex->consultarByConex($conex2, $sqlTCliente);
	  if ($consulta != null) {
	   	foreach ($consulta as $row) {
	   		$credito = $row['cli_Credito'];
	   		$pendientePago = 0;
	   		echo '
	   		<div class="form-horizontal">
	   		 	<div class="col-md-3"></div>
	    			<div align="center" class="form-group">
	    				<label for="nombre" class="col-lg-2 control-label">Nombre:</label>
	    	 			<div class="col-lg-3"><input align="center" type="text" class="form-control" id="nombre" name="nombre" readonly="readonly" value="'.$row['cli_Nombre'].'"/></div>
	    			</div><br/>
	   			<div class="col-md-3"></div>
	    			<div align="center" class="form-group">
	    				<label for="credito" class="col-lg-2 control-label">Límite de Crédito:</label>
	    	 			<div class="col-lg-3"><input align="center" type="text" class="form-control" id="credito" name="credito" readonly="readonly" value="$ '.$row['cli_Credito'].'"/>
	    	 			</div>
	    			</div><br/>
	    			<div class="col-md-3"></div>
	    			<div align="center" class="form-group">
	    				<label for="periodo" class="col-lg-2 control-label">Período de crédito:</label>
	    	 			<div class="col-lg-3"><input align="center" type="text" class="form-control" id="periodo" name="periodo" readonly="readonly" value="'.$row['cli_Periodo'].' '.$row['per_Clave'].'"/>
	    	 			</div>
	    			</div><br/>
	    			 <div class="col-md-3"></div>
	    			<div align="center" class="form-group">
	    				<label for="credito" class="col-lg-2 control-label">Pago Pendiente:</label>';
	    				$consulta = $conex->consultarByConex($conex2, $sqlTCobranza);
	    				if($consulta != null){
	    					foreach ($consulta as $row) {
	    						if($row['ecob_Clave'] == 'PENDIENTE'){
	    							$pendientePago = $pendientePago + $row['cob_Importe'];
	    						}
	    					}
	    					echo '<div class="col-lg-3"><input align="center" type="text" class="form-control" id="credito" name="credito" readonly="readonly" value="$ '.$pendientePago.'"/>
	  				  	 			</div>
	  				  			<br/>';
	    				} else {
	    					echo '<div class="col-lg-3"><input align="center" type="text" class="form-control" id="credito" name="credito" readonly="readonly" value="$ '.$pendientePago.'"/>
	  				  	 			</div>
	  				  			<br/>';
	    				}
	    				//Variable para calcular el crédito disponible del cliente.
	    				$creditoDisponible = $credito-$pendientePago;
	    				echo '</div><div class="col-md-3"></div>
	  		  			<div align="center" class="form-group">
	  		  				<label for="creditoDispobible" class="col-lg-2 control-label">Credito Disponible:</label>
	  		  	 			<div class="col-lg-3"><input align="center" type="text" class="form-control" id="creditoDisponible" name="creditoDisponible" readonly="readonly" value= "$ '.$creditoDisponible.'"/>
	  		  	 			</div>
	  		  			</div>
	  		  		</div>	
	  		  		<br/><br/><br/>';
	   	  }
	  } else {
	    echo '<script>swal({title: "¡Error!",text: "Existe un error en su cuenta, por favor contáctenos. Teléfono: 40-00-56-99, Ext. 7001, 7002, 7003, 7004. ",type: "error" ,closeOnConfirm: "Aceptar"},
	            function(){
	              window.location.href="../procesos/cerrarSesion.php";
	          });</script>';
	    echo '<p align="center" class="text-danger lead"><strong>Hay un problema en tu cuenta, por favor contactános Teléfono: 40-00-56-99, Ext. 7001, 7002, 7003, 7004.</strong></p>';
	  }
	 } catch(Exception $e){
		echo "Ha ocurrido un error: ".$e;
	 }

	 //Se imprime la tabla de compras hechas por el cliente.
	  echo '
	    <div class="panel panel-default">
	      <div align="center" class="panel-heading">
	       	<font size="5">Compras</font>
	      </div>
	      <div class="panel-body">
	        <div id="tablaDetalleVentas" name="tablaDetalleVentas" class="table-responsive">
	      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
	        <thead>
	          <tr>
	            <th align="center">Detalle de Compra</th>
	            <th align="center">No. Ticket </th>
	            <th align="center">Fecha</th>
	            <th align="center">Total de Venta</th>
	           </tr>
	        </thead>
	        <tbody>';
	    //Consulta para saber las compras del cliente.
		$sqlTVenta="SELECT * FROM tVenta where cli_Clave = '".$claveCliente."'";

	    try{
	      $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal,$nombreDB);
	        if($conex->consultarByConex($conex2, $sqlTVenta) != null) {
	          foreach ($conex->consultarByConex($conex2, $sqlTVenta) as $row) {
	            echo '<tr class="gradeA">';
	            echo '<td align="center"><a target="_blank" href="../procesos/consultaVentaDetalle.php?ticket='.$row['venta_Folio'].'"><img src="../../images/formularios/buscar.png"/></a> </td>';
	            echo '<td><p align="center">'.$row['venta_Folio'].'</p></td>';
	            $formatoFecha = new DateTime($row['venta_Fecha']);
	            echo '<td><p align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
	            echo '<td><p align="center">$ '.round($row['venta_Total'],2).'</p></td>';
	            echo '</tr>';
	          }
	        } else{
	        	/*
			    echo '<tr class="gradeA">';
				  echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
				  echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
			    echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
			    echo '</tr>';*/
	         }   
	    }catch(PDOException $e){
	      echo '<tr class="gradeA">';
	      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
	      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
	      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
	      echo '</tr>';
	    }
	 
	 echo'
	      </tbody> 
	      </table> 
	      </div></div></div>
	      <hr/>
	      <br>
	      ';

	//Se imprime la tabla de los pagos hechos por el cliente.
	$sqlTCobranza = "SELECT * FROM tCobranza where cli_Clave = '".$claveCliente."' and ecob_Clave = 'COBRADA'";
	$consulta = $conex->consultarByConex($conex2, $sqlTCobranza);
	  echo '
	  <div class="col-md-4"></div>
	    <div class="panel panel-default">
	      <div align="center" class="panel-heading">
	        <font size="5" color="green">Pagos Realizados</font>
	      </div>
	      <div class="panel-body">
	        <div id="tablaDevolucionDiv" name="tablaDevolucionDiv" class="table-responsive">
	      <table class="table table-striped table-bordered table-hover" id="tablaDevolucion">
	        <thead>
	          <tr>
	            <th align="center">Clave de Pago </th>
	            <th align="center">Fecha del Pago </th>
	            <th align="center">Total de Pago </th>
	           </tr>
	        </thead>
	        <tbody>';
	    try{
	        if($consulta != null){
	          foreach ($consulta as $row) {
	            echo '<tr class="gradeA">';
	            echo '<td><p class="text-success" align="center">'.$row['cob_Clave'].'</p></td>';
	            $formatoFecha = new DateTime($row["cob_FecCob"]);
	            echo '<td><p class="text-success" align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
	            echo '<td><p class="text-success" align="center"> $ '.round($row['cob_Importe'],2).'</p></td>';
	            echo '</tr>';
	          }
	         } else{
	         	/*
	          echo '<tr class="gradeA">';
	          echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
	          echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
	          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
	          echo '</tr>';*/
	         }   
	    }catch(PDOException $e){
	      echo '<tr class="gradeA">';
	      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
	      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
	      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
	      echo '</tr>';
	    }
	 
	 echo'
	      </tbody> 
	      </table> 
	      </div></div></div>
	      <hr/>
	      <br>
	      ';

	//Se imprime la tabla de los pagos vencidos de el cliente.
	$sqlTCobranzaVencida = "SELECT * FROM tCobranza where cli_Clave = '".$claveCliente."' and ecob_Clave = 'VENCIDA'";
	$consulta = $conex->consultarByConex($conex2, $sqlTCobranzaVencida);
	    try{
	        if($consulta != null) {
			  	echo '
			     <div class="panel panel-default">
			      <div align="center" class="panel-heading">
			        <font size="5" color="red">Crédito Vencido</font>
			      </div>
			      <div class="panel-body">
			        <div id="creditoVencido" name="creditoVencido" class="table-responsive">
			      <table class="table table-striped table-bordered table-hover" id="datatable-creditoVencido">
			        <thead>
			          <tr>
			            <th align="center">Clave de Pago </th>
			            <th align="center">Fecha del Pago </th>
			            <th align="center">Total de Pago </th>
			           </tr>
			        </thead>
			        <tbody>';
		          foreach ($consulta as $row) {
		            echo '<tr class="gradeA">';
		            echo '<td><p class="text-danger" align="center">'.$row['cob_Clave'].'</p></td>';
		            $formatoFecha = new DateTime($row["cob_FecReg"]);
		            echo '<td><p class="text-danger" align="center">'.$formatoFecha->format('d-m-Y H:i:s').'</p></td>';
		            echo '<td><p class="text-danger" align="center"> $ '.round($row['cob_Importe'],2).'</p></td>';
		            echo '</tr>';
		          }
		           echo'
				      </tbody> 
				      </table> 
				      </div></div></div>
				      <hr/>
				      <br>';
	         } else{
	         	/*
	          echo '<tr class="gradeA">';
	          echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
	          echo '<td><p align="center" class="text-danger">No hay datos  </p></td>';
	          echo '<td><p align="center" class="text-danger">No hay datos </p></td>';
	          echo '</tr>';*/
	         }   
	    }catch(PDOException $e){
	      echo '<tr class="gradeA">';
	      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
	      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
	      echo '<td><p align="center" class="text-danger">Servidor fuera de línea </p></td>';
	      echo '</tr>';
	    }
	    echo '    <script src="../../js/bootstrap.min.js"></script>
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
	        <script>
	            $(document).ready(function () {
	                $("#tablaDevolucion").dataTable();
	            });
	    </script>
	    <script>
	            $(document).ready(function () {
	                $("#datatable-creditoVencido").dataTable();
	            });
	    </script>';
	} else {
		 $sqlTCliente = "SELECT * FROM tCliente where cli_Credito > 0";

		  try{
		 	$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal,$nombreDB);
		 	$consulta = $conex->consultarByConex($conex2, $sqlTCliente);
		 	echo '<select id="comboClientes" name="comboClientes" class="form-control">';
			if ($consulta != null) {
				foreach ($consulta as $row) {
					echo '<option value="'.$row['cli_Clave'].'">'.$row['cli_Nombre'].'</option>';
				} 
			} else {
			    echo '<option value="default">Ningún cliente tiene crédito</option>';
			}
		 } catch(Exception $e){
			echo "Ha ocurrido un error: ".$e;
		 }
		 echo "</select>";
		}
}

$conex->cerrarConex();
$conex2 = null;
?>