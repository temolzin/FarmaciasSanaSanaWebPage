<?php
session_start();

//Creación del objeto de conexión
  require '../procesos/conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conexión

//Variables
  $numTicket = filter_var($_POST['numTicket'], FILTER_SANITIZE_STRING);
  $nombreDB = filter_var($_POST['comboSucursal'], FILTER_SANITIZE_STRING);

  //Variable que establece el nombre con la dirección de la factura
  $nombreFactura = "";

  //para saber el nombre de la sucursal 
  $sql = "select * from sucursales where nombreDB = '".$nombreDB."'";
  $nombreSucursal = "";
  foreach ($conex->consultar($sql) as $row) {
    $nombreSucursal = $row['nombreSucursal'];
  }
  //Referencio el nombre de la carpeta donde se encuentran las facturas de cada sucursal
  $nombreFactura = "http://www.farmaciassanasana.com.mx/facturas/".$nombreSucursal."/";
  $passwordSucursal = "Admin01";
  $ipSucursal = '192.168.1.151';

  //Se recupera el RFC de la sucursal seleccionada
	$sql="SELECT emp_RFC from tEmpresa";
	$sqlTicket = "SELECT * FROM tVenta where venta_folio = ".$numTicket;
    //Conexión a Sucursal Seleccionada
    try{
        $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
        //Verifico si el Ticket Existe.
        if($conex->consultarByConex($conex2,$sqlTicket) != null){
          if($conex->consultarByConex($conex2, $sql)) {
            foreach ($conex->consultarByConex($conex2, $sql) as $row) {
              $nombreFactura .= $row['emp_RFC'];
              $sql="SELECT distinct(tfe.femi_clave) FROM tFacturaEmitidaDetalle tfed inner join tFacturaEmitida tfe on tfed.femi_clave = tfe.femi_clave WHERE venta_folio = '" .$numTicket . "' and eFemi_clave = 'Vigente'";
              $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
              $consulta = $conex->consultarByConex($conex2, $sql);
              if($consulta != null) {
                foreach ($consulta as $row) {
                  $nombreFactura .= "_".$row['femi_clave'];
                }
                  echo $nombreFactura;
                  $nombreFactura = "";
              } else {
                echo 'noFacturado';
              }    
            }
          //Finaliza consulta del nombre de la factura
           } else{
            echo 'No se encuentra la IP de la sucursal, comuniquese con el administrador';
           } 
        }  else {
          echo 'error';
        }
    }catch(PDOException $e){
    	echo "Error en la base de datos, consulte al programador";
    }

    $conex->cerrarConex();
    $conex2 = null;
 
?>