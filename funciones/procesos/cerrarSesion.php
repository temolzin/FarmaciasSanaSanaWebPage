<?php 
session_start(); 	

require_once 'conexion.php';
$conex = Conexion::getInstance();

$conex->cerrarConex();
session_destroy();
$_SESSION=array();

header('location: ../../index.html');

 ?>