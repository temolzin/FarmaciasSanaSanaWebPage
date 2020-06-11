<?php
session_start();
require('conexion.php');
$conex = Conexion::getInstance();

$resp1A=0;
$resp1B=0;
$resp1C=0;
$resp1D=0;
$resp1E=0;
$resp1F=0;
$resp1G=0;

$resp2A=0;
$resp2B=0;
$resp2C=0;
$resp2D=0;
$resp2E=0;
$resp2F=0;

$preferencia=$_POST['preferencia'];
$aspectoConsiderar=$_POST['aspectoConsiderar']; 


for ($i=0;$i<count($preferencia);$i++){
	switch($preferencia[$i]){

		case 1:
		$resp1A=1;
		break;

		case 2:
	    $resp1B=1;
	    break;

	    case 3:
	    $resp1C=1;
	    break;

	    case 4:
	    $resp1D=1;
	    break;

	    case 5:
	    $resp1E=1;
	    break;

	    case 6:
	    $resp1F=1;
	    break;

	    case 7:
	    $resp1G=1;
	    break;
	}
}

for ($i=0;$i<count($aspectoConsiderar);$i++){
	switch($aspectoConsiderar[$i]){

		case 1:
		$resp2A=1;
		break;

		case 2:
	    $resp2B=1;
	    break;

	    case 3:
	    $resp2C=1;
	    break;

	    case 4:
	    $resp2D=1;
	    break;

	    case 5:
	    $resp2E=1;
	    break;

	    case 6:
	    $resp2F=1;
	    break;
	}
}

$valoresEncuesta=array(
':edad'=>$_POST['edad'],
':sexo'=>$_POST['sexo'],
':sucursal'=>$_POST['sucursal'],
':tiempoCompra'=>$_POST['tiempoCompra'],
':frecuenciaCompra'=>$_POST['frecuenciaCompra'],
':servicioCliente'=>$_POST['servicioCliente'],
':tiempoEspera'=>$_POST['tiempoEspera'],
':imagenGeneral'=>$_POST['imagenGeneral'],
':personalVenta'=>$_POST['personalVenta'],
':precio'=>$_POST['precio'],
':surtido'=>$_POST['surtido'],
':probabilidadRecomendacion'=>$_POST['probabilidadRecomendacion'],
':comentario'=>$_POST['comentario'],
':resp1A'=>$resp1A,
':resp1B'=>$resp1B,
':resp1C'=>$resp1C,
':resp1D'=>$resp1D,
':resp1E'=>$resp1E,
':resp1F'=>$resp1F,
':resp1G'=>$resp1G,
':resp2A'=>$resp2A,
':resp2B'=>$resp2B,
':resp2C'=>$resp2C,
':resp2D'=>$resp2D,
':resp2E'=>$resp2E,
':resp2F'=>$resp2F,
);


$sentencia = $conex->ejecutarAccion("INSERT INTO cuestionario VALUES (:edad, :sexo, :sucursal, :tiempoCompra, :frecuenciaCompra, :resp1A, :resp1B, :resp1C, :resp1D, :resp1E, :resp1F, :resp1G, :servicioCliente, :tiempoEspera, :imagenGeneral, :personalVenta, :precio, :surtido, :probabilidadRecomendacion, :resp2A, :resp2B, :resp2C, :resp2D, :resp2E, :resp2F, :comentario, SYSDATETIME())", $valoresEncuesta);


/*if($sentencia == true) {
	    echo 'ok';
	} else{
	    echo 'error';
	}*/

$conex->cerrarConex();
?>