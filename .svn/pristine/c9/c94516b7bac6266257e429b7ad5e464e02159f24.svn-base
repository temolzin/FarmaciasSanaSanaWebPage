<?php
session_start();
if (isset($_SESSION['nombreUsuario'])==false){
  header('Location: ../../index.html');
} 
require('conexion.php');
$conex = Conexion::getInstance();

if(isset($_POST['checkSucursal'])) {
	$valoresUsuario = array(
	':nombreUsuario'=>$_POST['nombreUsuario'],
	':nombre' => $_POST['nombre'],
	':ap_pat' => $_POST['ap_pat'],
	':ap_mat' => $_POST['ap_mat'],
	':edad' => $_POST['edad'],
	':email' => $_POST['email'],
	':genero' => $_POST['comboGenero'],
	':telefono' => $_POST['telefono'],
	':direccion' => $_POST['direccion'],
	':password' => $_POST['password'],
	':status' => $_POST['comboStatus'],
	':tipoUsuario' => $_POST['comboPrivilegios']);

	$sentencia = $conex->ejecutarAccion("INSERT INTO usuario VALUES (:nombreUsuario, :nombre, :ap_pat, :ap_mat, :edad, :email, :genero, :telefono, :direccion, :password, :tipoUsuario, :status)", $valoresUsuario);

	$sql = "Select max(id_usuario) as id from usuario";
	$consulta = $conex->consultar($sql);
	$id_usuario = "";
	foreach ($consulta as $row) {
		$id_usuario = $row['id'];
	}
    $arrarySucursalesSeleccionadas =  $_POST['checkSucursal'];
	foreach ($arrarySucursalesSeleccionadas as $row) {
		$valoresCliente = array(':id_usuario' => $id_usuario, 
								':id_sucursal' => $row);
		$sentencia = $conex->ejecutarAccion("INSERT INTO accesoCliente VALUES (:id_usuario, :id_sucursal)", $valoresCliente);
	}
	echo 'ok';
} else {
	$valoresUsuario2 = array(':nombreUsuario' => $_POST['nombreUsuario'],
	':nombre' => $_POST['nombre'],
	':ap_pat' => $_POST['ap_pat'],
	':ap_mat' => $_POST['ap_mat'],
	':edad' => $_POST['edad'],
	':email' => $_POST['email'],
	':genero' => $_POST['comboGenero'],
	':telefono' => $_POST['telefono'],
	':direccion' => $_POST['direccion'],
	':password' => $_POST['password'],
	':status' => $_POST['comboStatus'],
	':tipoUsuario' => $_POST['comboPrivilegios']);

	$sentencia = $conex->ejecutarAccion("INSERT INTO usuario VALUES (:nombreUsuario, :nombre, :ap_pat, :ap_mat, :edad, :email, :genero, :telefono, :direccion, :password, :tipoUsuario, :status)", $valoresUsuario2);

	if($sentencia == true) {
	    echo 'ok';
	} else{
	    echo 'error';
	}
}
//Cerramos Conexión
$conex->cerrarConex();
?>