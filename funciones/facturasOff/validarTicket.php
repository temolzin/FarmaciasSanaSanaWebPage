<?php
//Código para verificar al momento de ingresar un número de ticket en la solicitud de factura,
//si este ticket existe en la base de datos
require('../procesos/conexion.php');

$conex = Conexion::getInstance();

$ticket = filter_var($_POST['ticket'], FILTER_SANITIZE_STRING);
$nombreDB = filter_var($_POST['sucursal'], FILTER_SANITIZE_STRING);

$passwordSucursal = "Admin01";
$ipSucursal = '192.168.1.151';

$sql = "SELECT * from sucursales where nombreSucursal = '".$nombreDB."'";
$consulta = $conex->consultar($sql);
foreach ($consulta as $row) {
  $nombreDB = $row['nombreDB'];
}

$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);

$sql = "SELECT * FROM tVenta where venta_Folio = '".$ticket."'";
$consulta = $conex->consultarByConex($conex2, $sql);

if($consulta != null) {
	echo 'true';
} else{
	echo 'false';
}

$conex->cerrarConex();
$conex2 = null;
?>
