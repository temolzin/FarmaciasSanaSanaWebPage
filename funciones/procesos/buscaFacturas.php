<?php
session_start();

//Creación del objeto de conexión
  require 'conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conexión

//Variables
  $tipoBusqueda = filter_var($_POST['comboBuscarFactura'], FILTER_SANITIZE_STRING);
  $numFolio = filter_var($_POST['txtBuscar'], FILTER_SANITIZE_STRING);
  $nombreDB = filter_var($_POST['comboSucursal'], FILTER_SANITIZE_STRING);

  //Variable que establece el nombre con la dirección de la factura
  $nombreFactura = "";

  if($tipoBusqueda == "ticket") {
    //para saber el nombre de la sucursal 
    $sql = "select * from sucursales where nombreDB = '".$nombreDB."'";
    $nombreSucursal = "";
    foreach ($conex->consultar($sql) as $row) {
      $nombreSucursal = $row['nombreSucursal'];
    }
    //Referencio el nombre de la carpeta donde se encuentran las facturas de cada sucursal
    $nombreFactura = "http://www.farmaciassanasana.com.mx/facturas/".$nombreSucursal."/";
    $passwordSucursal = "S@na*s1";
    $ipSucursal = '192.168.100.21';

    //Se recupera el RFC de la sucursal seleccionada
    $sql="SELECT emp_RFC from tEmpresa";
    $sqlTicket = "SELECT * FROM tVenta where venta_folio = ".$numFolio;
      //Conexión a Sucursal Seleccionada
      try{
          $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
          //Verifico si el Ticket Existe.
          if($conex->consultarByConex($conex2,$sqlTicket) != null){
            if($conex->consultarByConex($conex2, $sql)) {
              foreach ($conex->consultarByConex($conex2, $sql) as $row) {
                $nombreFactura .= $row['emp_RFC'];
                $sql="SELECT distinct(tfe.femi_clave) FROM tFacturaEmitidaDetalle tfed inner join tFacturaEmitida tfe on tfed.femi_clave = tfe.femi_clave WHERE venta_folio = '" .$numFolio . "' and eFemi_clave = 'Vigente'";
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
  } 
  // Si el usuario selecciona Buscar por el folio de la factura
  else if($tipoBusqueda == "folio") {
      //para saber el nombre de la sucursal 
  $sql = "select * from sucursales where nombreDB = '".$nombreDB."'";
  $nombreSucursal = "";
  foreach ($conex->consultar($sql) as $row) {
    $nombreSucursal = $row['nombreSucursal'];
  }
  //Referencio el nombre de la carpeta donde se encuentran las facturas de cada sucursal
  $nombreFactura = "http://www.farmaciassanasana.com.mx/facturas/".$nombreSucursal."/";
  $passwordSucursal = "S@na*s1";
  $ipSucursal = '192.168.100.21';

  //Se recupera el RFC de la sucursal seleccionada
  $sqlRfc="SELECT emp_RFC from tEmpresa";
  $sql="SELECT distinct(tfe.femi_clave) FROM tFacturaEmitidaDetalle tfed inner join tFacturaEmitida tfe on tfed.femi_clave = tfe.femi_clave WHERE tfe.femi_clave = '" .$numFolio . "' and eFemi_clave = 'Vigente'";
    //Conexión a Sucursal Seleccionada
    try{
        $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
        //Verifico si el Ticket Existe.
        if($conex->consultarByConex($conex2, $sqlRfc)) {
            foreach ($conex->consultarByConex($conex2, $sqlRfc) as $row) {
                $nombreFactura .= $row['emp_RFC'];
            }
	        if($conex->consultarByConex($conex2,$sql) != null) {
	            foreach ($conex->consultarByConex($conex2,$sql) as $row) {
	                $nombreFactura .= "_".$row['femi_clave'];
	            }
	            echo $nombreFactura;
	            $nombreFactura = "";
	          //Finaliza consulta del nombre de la factura
	        } else {
	          echo 'error';
	        } 
    	} else {
        	echo 'errorRFC';
        }
    }catch(PDOException $e){
      echo "Error en la base de datos, consulte al programador";
    }
  }

  $conex->cerrarConex();
  $conex2 = null;
 
?>