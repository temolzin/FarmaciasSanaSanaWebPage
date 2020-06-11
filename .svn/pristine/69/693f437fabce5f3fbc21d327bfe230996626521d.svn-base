<?php
//Código para verificar al momento de registrar al usuario,
//si ese nombre de usuario, existe en la base de datos.
session_start();
if (isset($_SESSION['nombreUsuario'])==false){
  header('Location: ../../index.html');
} 
require('conexion.php');

$conex = Conexion::getInstance();

$nombreUsuario = $_REQUEST['nombreUsuario'];
$consulta = $conex->consultar("select id_usuario from usuario where nombreUsuario = '". $nombreUsuario."'");

if($consulta != null) {
	foreach ($consulta as $id) {
		if($_SESSION['id_usuario'] == $id[0]) {
			echo 'true';
		} else{
			echo 'false';
		}
	}
} else{
	echo 'true';
}
?>
