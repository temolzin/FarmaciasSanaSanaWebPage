<?php
session_start();
if (isset($_SESSION['nombreUsuario'])==false){
  header('Location: ../../index.html');
} 
require('conexion.php');
$conex = Conexion::getInstance();


	$valoresSucursal= array(':nombreSucursal' => $_POST['nombreSucursal'],
	':nombreDB' => $_POST['nombreDB'],
	':ipSucursal' => $_POST['ipSucursal']
	,':urlGoogleMaps' => $_POST['urlGoogleMaps']
	,':direccionSucursal' => $_POST['direccionSucursal']
	,':extensionSucursal' => $_POST['extensionSucursal']);

	$sentencia = $conex->ejecutarAccion("INSERT INTO sucursales VALUES (:nombreSucursal, :nombreDB, :ipSucursal,:urlGoogleMaps,:direccionSucursal,:extensionSucursal)", $valoresSucursal);

	if($sentencia == true) {
	    echo 'ok';
	} else{
	    echo 'error';
	}
//Cerramos Conexión
$conex->cerrarConex();
?>