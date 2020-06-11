<?php
	session_start();
	if (isset($_SESSION['nombreUsuario'])==false){
	  header('Location: ../../index.html');
	} 
	require('conexion.php');
	$conex = Conexion::getInstance();

	$sku = $_GET['sku'];
	$id_proveedor = $_SESSION['id_proveedor'];
	$sql = "DELETE FROM skuProveedor where id_usuario = :id_usuario and sku = :sku";
	$valoresDelete = array(':id_usuario' => $id_proveedor , ':sku' => $sku);
	$conex->ejecutarAccion($sql, $valoresDelete);

	header("Location: ../vistas/consultaSKUProveedorView.php");
?>