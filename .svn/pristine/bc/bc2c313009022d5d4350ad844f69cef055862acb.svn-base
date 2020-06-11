<?php
session_start();
require('conexion.php');
$conex = Conexion::getInstance();

$id_factura = $_GET['fact'];
$id_usuario = $_SESSION['id_usuario'];

setlocale(LC_ALL,"es_MX");
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");

$valoresInsertarFactura = array(':id_usuario' => $id_usuario,
	':id_factura' => $id_factura,
	':fecha_realizada' => date ("Ymd H:i:s"));
$sentencia = $conex->ejecutarAccion("INSERT INTO facturaRealizada VALUES(:id_factura, :id_usuario, :fecha_realizada)", $valoresInsertarFactura);

if($sentencia == true) {
    header('Location: consultaFacturaCorreo.php');
} else{
    header('Location: consultaFacturaCorreo.php?respuesta=error');
}
?>