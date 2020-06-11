<?php

require('conexion.php');
$conex = Conexion::getInstance();

$valoresActualizarSucursal = array(':id_sucursal' => $_POST['id_sucursal'],
':nombreSucursal' => $_POST['nombreSucursal'],
':nombreDB' => $_POST['nombreDB'],
':ipSucursal' => $_POST['ipSucursal']
,':urlGoogleMaps' => $_POST['urlGoogleMaps']
,':direccionSucursal' => $_POST['direccionSucursal']
,':extensionSucursal' => $_POST['extensionSucursal']);
$sentencia = $conex->ejecutarAccion("UPDATE sucursales SET nombreSucursal = :nombreSucursal, nombreDB = :nombreDB, ipSucursal = :ipSucursal, maps = :urlGoogleMaps, direccion = :direccionSucursal, extension = :extensionSucursal where id_sucursal = :id_sucursal", $valoresActualizarSucursal);
if($sentencia == true) {
    echo 'ok';
} else{
    echo 'error';
}
?>