<?php
session_start();
if (isset($_SESSION['nombreUsuario'])==false){
  header('Location: ../../index.html');
} 
require('conexion.php');
$conex = Conexion::getInstance();

$nombreUser = $_POST['btnStatus'];
$sql = "select * from usuario where nombreUsario = ".$nombreUser;

$statusActual = 2;
$id_usuario = 0;
foreach ($conex->consultar($sql) as $row) {
	$statusActual = $row['status'];
	$id_usuario = $row['id_usuario'];
}

$statusCambiado = 3;
if($statusActual == 1) {
	$statusCambiado = 0;
} else{
	$statusCambiado = 1;
}

$valoresUpdate = array(':id_usuario'=>$id_usuario, ':status'=>$statusCambiado);
$sentencia = $conex->ejecutarAccion("UPDATE usuario SET status = :status where id_usuario = :id_usuario", $valoresUpdate);

if($sentencia == true) {
    echo 'ok';
} else{
    echo 'error';
}
?>