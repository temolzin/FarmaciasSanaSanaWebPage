<?php
session_start();
//Código para verificar al momento de ingresar un número de ticket en la solicitud de factura,
//si este ticket existe en la base de datos
require('../procesos/conexion.php');
$conex = Conexion::getInstance();

$ticket = filter_var($_POST['ticket'], FILTER_SANITIZE_STRING);
$nombreDB = filter_var($_POST['sucursal'], FILTER_SANITIZE_STRING);
$rfc = filter_var($_POST['rfc'], FILTER_SANITIZE_STRING);
$_SESSION['rfc']=$rfc;
$_SESSION['ticket']=$ticket;
$_SESSION['id_cliente']="";
$_SESSION['email']="";
$_SESSION['nombre']="";
$_SESSION['curp']="";
$_SESSION['calle']="";
$_SESSION['numExterior']="";
$_SESSION['numInterior']="";
$_SESSION['colonia']="";
$_SESSION['municipio']="";
$_SESSION['ciudad']="";
$_SESSION['sucursal']=$nombreDB;
$_SESSION['estado']="";
$_SESSION['pais']="";
$_SESSION['codigoPostal']="";
$_SESSION['telefono']="";

//Depende la sucursal, asigna base de datos y contraseña
$passwordSucursal = "Admin01";
$ipSucursal = '192.168.1.151';

$sql = "SELECT * from sucursales where nombreSucursal = '".$nombreDB."'";
$consulta = $conex->consultar($sql);
foreach ($consulta as $row) {
    $nombreDB = $row['nombreDB'];
}

$conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);

$sql = "SELECT * FROM tFacturaEmitidaDetalle where venta_Folio = '".$ticket."'";
$sqlFechaVenta = "SELECT venta_Fecha FROM tVenta where venta_Folio = '".$ticket."'";
$fechaTicket = new DateTime();
$fechaHoy = new DateTime("now");

$consulta = $conex->consultarByConex($conex2,$sqlFechaVenta);
foreach ($consulta as $row) {
    $fechaTicket = new DateTime($row['venta_Fecha']);
}

//Consulta para saber el tipo de pago del ticket
$sqlTipoPago = "SELECT tpago_Clave from tVentaPago tvp where venta_Folio = '".$ticket."'";
$tipoPago = "";
$consulta = $conex->consultarByConex($conex2, $sqlTipoPago);
foreach ($consulta as $row) {
    $tipoPago = $row['tpago_Clave'];
    $_SESSION['tipoPago'] = $tipoPago;
}

$diasFecha = date_diff($fechaTicket, $fechaHoy);
$diasTicket =  $diasFecha->format('%a');

    $consulta = $conex->consultarByConex($conex2, $sql);
    if($consulta != null){
        echo "ticketFacturado";
    } else if($diasTicket > 7){
        echo 'errorDias';
    } else {
        $sql = "SELECT * FROM cliente where rfc = '".$rfc."'";
        $consulta = $conex->consultar($sql);
        if($consulta != null) {
              foreach ($consulta as $row) {
                echo 'datos';
                $_SESSION['id_cliente']=$row['id_cliente'];
                $_SESSION['rfc']=$row['rfc'];
                $_SESSION['email']=$row['email'];
                $_SESSION['nombre']=$row['nombre'];
                $_SESSION['curp']=$row['curp'];
                $_SESSION['calle']=$row['calle'];
                $_SESSION['numExterior']=$row['numExterior'];
                $_SESSION['numInterior']=$row['numInterior'];
                $_SESSION['colonia']=$row['colonia'];
                $_SESSION['municipio']=$row['municipio'];
                $_SESSION['ciudad']=$row['ciudad'];
                $_SESSION['estado']=$row['estado'];
                $_SESSION['pais']=$row['pais'];
                $_SESSION['codigoPostal']=$row['codigoPostal'];
                $_SESSION['telefono']=$row['telefono'];
              }
                echo 'ok';
            } else {
                echo 'vacio';
            }
    }
    $conex->cerrarConex();
    $conex2 = null;
?>
