<?php

require('conexion.php');
$conex = Conexion::getInstance();

//El número 7 es el tipo de Usuario CLIENTE.
if($_POST['comboPrivilegios'] == '7') {
	$valoresEliminar = array(':id_usuario'=>$_POST['id_usuario']);
	$sqlEliminar = "DELETE FROM accesoCliente where id_usuario = :id_usuario";
	$sentencia = $conex->ejecutarAccion($sqlEliminar, $valoresEliminar);


    $arrarySucursalesSeleccionadas =  $_POST['checkSucursal'];
	foreach ($arrarySucursalesSeleccionadas as $row) {

		$valoresInsertarAcceso = array(':id_usuario' => $_POST['id_usuario'],
										':id_sucursal' => $row);
		$sentencia = $conex->ejecutarAccion("INSERT INTO accesoCliente VALUES (:id_usuario, :id_sucursal)",$valoresInsertarAcceso);
	}
}

$valoresActualizarUsuario = array(':id_usuario' => $_POST['id_usuario'],
':status' => $_POST['comboStatus'],
':nombreUsuario' => $_POST['nombreUsuario'],
':nombre' => $_POST['nombre'],
':ap_pat' => $_POST['ap_pat'],
':ap_mat' => $_POST['ap_mat'],
':edad' => $_POST['edad'],
':email' => $_POST['email'],
':genero' => $_POST['comboGenero'],
':telefono' => $_POST['telefono'],
':direccion' => $_POST['direccion'],
':password'=> $_POST['password'],
':status' => $_POST['comboStatus'],
':tipoUsuario'=> $_POST['comboPrivilegios']);
$sentencia = $conex->ejecutarAccion("UPDATE usuario SET nombreUsuario = :nombreUsuario, nombre = :nombre, ap_pat = :ap_pat, ap_mat = :ap_mat, edad = :edad, email = :email, genero = :genero, telefono = :telefono, direccion = :direccion, password = :password, tipoUsuario = :tipoUsuario, status = :status where id_usuario = :id_usuario", $valoresActualizarUsuario);
if($sentencia == true) {
    echo 'ok';
} else{
    echo 'error';
}
?>