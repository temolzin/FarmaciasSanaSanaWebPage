<?php
/**
 PHP que obtiene la dirección de un cliente por medio del código Postal
*/
require('../procesos/conexion.php');
$conex = Conexion::getInstance();

if (isset($_POST['codigoPostal']) != false) {
	$codPostal = $_POST['codigoPostal'];
	$sql = "select distinct cp, asentamiento from codigosPostales where cp = ".$codPostal." order by asentamiento asc";
	echo "<option value='default' selected='selected'>Selecciona una Colonia</option>";
	foreach ($conex->consultar($sql) as $row) {
		echo "<option value='".$row['asentamiento']."'>";
		echo $row['asentamiento'];
		echo "</option>";
	}
}

if (isset($_POST['colonia']) != false) {
	$colonia = $_POST['colonia'];
	$codPostal = $_POST['codPostalColonia'];
	$sql = "select distinct municipio from codigosPostales where cp= ".$codPostal." and asentamiento = '".$colonia."'";
	foreach ($conex->consultar($sql) as $row) {
		echo "<option value='default' selected='selected'>Selecciona un Municipio</option>";
		echo "<option value='".$row['municipio']."'>";
		echo $row['municipio'];
		echo "</option>";
	}
}

if (isset($_POST['municipio']) != false) {
	$municipio = $_POST['municipio'];
	$codPostal = $_POST['codPostalMunicipio'];
	echo "<option value='default' selected='selected'>Selecciona una Ciudad</option>";
	$sql = "select count(ciudad) as numCiudad from codigosPostales where municipio= '".$municipio."' and cp = " .$codPostal;
	$consulta = $conex->consultar($sql);
	foreach ($consulta as $row) {
		if($row['numCiudad'] != 0){
			$sql = "select distinct ciudad from codigosPostales where municipio= '".$municipio."' and cp = " .$codPostal;
			$consulta = $conex->consultar($sql);
			foreach ($consulta as $row) {
				echo "<option value='".$row['ciudad']."'>";
				echo $row['ciudad'];
				echo "</option>";
			}
		} else{
			echo "<option value='No Aplica'>";
			echo "No aplica";
			echo "</option>";
		}
	}

}

if (isset($_POST['ciudad']) != false) {
	$municipio = $_POST['municipioCiudad'];
	$ciudad = $_POST['ciudad'];
	$codPostal = $_POST['codPostalCiudad'];
	$sql = "select distinct estado from codigosPostales where municipio = '".$municipio."' and cp = " .$codPostal;
	echo "<option value='default' selected='selected'>Selecciona un Estado</option>";
	foreach ($conex->consultar($sql) as $row) {
		echo "<option value='".$row['estado']."'>";
		echo $row['estado'];
		echo "</option>";
	}
}
$conex->cerrarConex();
