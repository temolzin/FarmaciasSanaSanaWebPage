<?php
//Código para verificar al momento de registrar al usuario,
//si ese nombre de usuario, existe en la base de datos.
require('conexion.php');
$conex = Conexion::getInstance();

$nombreUsuario = $_REQUEST['nombreUsuario'];
$consulta = $conex->consultar("select * from usuario where nombreUsuario = '". $nombreUsuario."'");

if($consulta == null) {
	echo 'true';
} else {
	echo 'false';
}
$conex->cerrarConex();

?>
