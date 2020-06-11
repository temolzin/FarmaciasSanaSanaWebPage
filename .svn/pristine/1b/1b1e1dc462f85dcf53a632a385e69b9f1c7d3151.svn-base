<?php
//Código para verificar al momento de registrar al usuario,
//si ese nombre de usuario, existe en la base de datos.
require('conexion.php');
$conex = Conexion::getInstance();

$nombreSucursal = $_REQUEST['nombreSucursal'];
$consulta = $conex->consultar("select * from sucursales where nombreSucursal = '". $nombreSucursal."'");

if($consulta == null) {
	echo 'true';
} else {
	echo 'false';
}
$conex->cerrarConex();

?>
