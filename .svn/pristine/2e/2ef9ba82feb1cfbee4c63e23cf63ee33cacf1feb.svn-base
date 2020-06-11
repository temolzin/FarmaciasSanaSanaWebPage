<?php
session_start();
require '../vistas/menuView.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/sweetalert.min.js"></script>
    <script type="text/javascript">
       function soloLetras(e) {
          key = e.keyCode || e.which;
          tecla = String.fromCharCode(key).toLowerCase();
          letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
          especiales = [8, 37, 39, 46];
          tecla_especial = false;
          for (var i in especiales) {
            if (key == especiales[i]) {
              tecla_especial = true;
              break;
            }
          }
          if (letras.indexOf(tecla) == -1 && !tecla_especial)
             return false;
          }

          function soloNumeros(e)
          {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
              return true;
            return /\d/.test(String.fromCharCode(keynum));
          }
    </script>
    <title>Seguimiento de Crédito</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../../css/bootstrap.css" rel="stylesheet" />
    <link href="../../css/sweetalert.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../../css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../../css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <!-- TABLE STYLES-->
  <link href="../../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
  <link href="../../css/jquery-ui.min.css" rel="stylesheet" />
  <link href="../../css/jquery-ui.theme.min.css" rel="stylesheet" />
   <!-- Favicon -->
   <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <p class="navbar-brand" href="#"><?php echo $_SESSION['tipoUsuario']?></p> 
            </div>
              <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> 
                Farmacias Sana Sana &nbsp; 
                <a href="../procesos/cerrarSesion.php" class="btn btn-danger square-btn-adjust">Cerrar Sesión</a> 
              </div>
        </nav>   
           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <?php 
                  menu('seguimientoCreditoCliente');
                ?>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2 align="center">
                        Seguimiento de Crédito.
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                <br /> <br />
                
 <?php
//Creación del objeto de conexión
  require '../procesos/conexion.php';
  $conex = new Conexion();
//Termino de la creación del objeto conexión

//Se separa el nombre de la sucursal, del nombre de usuario.
  $datos = explode("-", $_SESSION['nombreUsuario']);
  $sucursal = trim($datos[0]);
//Variables para la conexión a la base de datos
  $passwordSucursal = "admin01";
  $ipSucursal = '192.168.1.151';
//Sucursal 512
  if($sucursal == '512'){
	  $nombreDB = 'dbsav300';
  	$passwordSucursal = "Admin01";
	  $ipSucursal = '192.168.1.90';
   } // Sucursal 517
  else if($sucursal == '517') {
    $nombreDB = 'dbsav300';
    $passwordSucursal = "Admin01";
    $ipSucursal = '192.168.1.100';
  } else if($sucursal == 'E21') {
	  $nombreDB = 'dbsavE21';
  } else if($sucursal == 'GH45') {
	  $nombreDB = 'dbsavGH45';
  } 
  $_SESSION['nombreDB'] = $nombreDB;
 $sqlTCliente = "SELECT * FROM tCliente where cli_Clave = '".$_SESSION['nombreUsuario']."'";
 $sqlTCobranza = "SELECT * FROM tCobranza where cli_Clave = '".$_SESSION['nombreUsuario']."'";
 try{
 	$pdo = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal,$nombreDB);
 	$consulta = $pdo->query($sqlTCliente);
  if ($consulta->rowCount() != 0) {
   	foreach ($consulta as $row) {
   		$credito = $row['cli_Credito'];
   		$pendientePago = 0;
   		echo '
   		<div class="form-horizontal">
   		 	<div class="col-md-3"></div>
    			<div align="center" class="form-group">
    				<label for="nombre" class="col-lg-2 control-label">Nombre:</label>
    	 			<div class="col-lg-3"><input align="center" type="text" class="form-control" id="nombre" name="nombre" readonly="readonly" value="'.$_SESSION['nombreCompleto'].'"/></div>
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
    				<label for="credito" class="col-lg-2 control-label">Pago Pendiente:</label>
    				';
    				$consulta = $pdo->query($sqlTCobranza);
    				if($consulta->rowCount() != 0){
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
              window.location.href="../procesos/cerrarSesion.php";x
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
	$sqlTVenta="SELECT * FROM tVenta where cli_Clave = '".$_SESSION['nombreUsuario']."'";

    try{
      $pdo = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal,$nombreDB);
        if($pdo->query($sqlTVenta)->rowCount() != 0){
          foreach ($pdo->query($sqlTVenta) as $row) {
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
$sqlTCobranza = "SELECT * FROM tCobranza where cli_Clave = '".$_SESSION['nombreUsuario']."' and ecob_Clave = 'COBRADA'";
$consulta = $pdo->query($sqlTCobranza);
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
        if($consulta->rowCount() != 0){
          foreach ($consulta as $row) {
            echo '<tr class="gradeA">';
            echo '<td><p class="text-success" align="center">'.$row['cob_Clave'].'</p></td>';
            $formatoFecha = new DateTime($row["cob_FecReg"]);
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
$sqlTCobranzaVencida = "SELECT * FROM tCobranza where cli_Clave = '".$_SESSION['nombreUsuario']."' and ecob_Clave = 'VENCIDA'";
$consulta = $pdo->query($sqlTCobranzaVencida);
    try{
        if($consulta->rowCount() != 0){
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
?>
    <div class="col-md-4"></div>
    <div class="col-md-4">
      	<p class="text-danger lead" align="center"><strong>Sí tienes alguna duda o deseas alguna aclaración, contactános,<br> Teléfono: 40-00-56-99, Ext. 7001, 7002, 7003, 7004.</strong></p>
      </div><br/><br/><br/><br/><br/><br/><br/><br/>
   
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
        <script>
            $(document).ready(function () {
                $("#tablaDevolucion").dataTable();
            });
    </script>
    <script>
            $(document).ready(function () {
                $("#datatable-creditoVencido").dataTable();
            });
    </script>
    <script src="../../js/custom.js"></script>
    </div></div></div></body></html>