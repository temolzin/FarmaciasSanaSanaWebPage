<?php
require('conexion.php');
$conex = Conexion::getInstance();
$passwordSucursal = 'S@na*s1';
$ipSucursal = '192.168.100.21';
$nombreDB = 'dbsav517';
$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);

	$sql = "select prov_Nombre from tProveedor";
	foreach ($conex->consultarByConex($conex2,$sql) as $row) {
		echo "<option value='".$row['prov_Nombre']."'>";
		echo $row['prov_Nombre'];
		echo "</option>";
	}
$conex = null;
$conex2 = null;
?>