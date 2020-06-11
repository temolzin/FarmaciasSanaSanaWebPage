<?php 
session_start();
require_once('../../lib/phpMailer/class.phpmailer.php');
require_once('../../lib/phpMailer/class.smtp.php');
require_once('../../lib/phpMailer/PHPMailerAutoload.php');
require('../procesos/conexion.php');
$conex = Conexion::getInstance();

	define("destino", "facturacionsanasana@farmaciassanasana.com.mx");
	define("nombre", "Farmacias Sana Sana");

		
		$de=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$id_cliente = filter_var($_SESSION['id_cliente'], FILTER_SANITIZE_STRING);
		$nombre=filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
		$ticket = filter_var($_POST['ticket'], FILTER_SANITIZE_STRING);
		$sucursal = filter_var($_POST['sucursal'], FILTER_SANITIZE_STRING);
		$rfc = filter_var($_POST['rfc'], FILTER_SANITIZE_STRING);
		$curp = filter_var($_POST['curp'], FILTER_SANITIZE_STRING);
		$calle = filter_var($_POST['calle'], FILTER_SANITIZE_STRING);
		$numExterior = filter_var($_POST['numExterior'], FILTER_SANITIZE_STRING);
		$numInterior = filter_var($_POST['numInterior'], FILTER_SANITIZE_STRING);
		$colonia = filter_var($_POST['colonia'], FILTER_SANITIZE_STRING);
		$municipio = filter_var($_POST['municipio'], FILTER_SANITIZE_STRING);
		$ciudad = filter_var($_POST['ciudad'], FILTER_SANITIZE_STRING);
		$estado = filter_var($_POST['estado'], FILTER_SANITIZE_STRING);
		$pais = filter_var($_POST['pais'], FILTER_SANITIZE_STRING);
		$codigoPostal = filter_var($_POST['codigoPostal'], FILTER_SANITIZE_STRING);
		$tipoPago = filter_var($_POST['tipoPago'], FILTER_SANITIZE_STRING);
		$telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);

		if($curp == ""){
			$curp = "N/A";
		} else if ($numInterior == ""){
			$numInterior = "N/A";
		}

		$mensaje = '
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Facturas</title>
		</head>
		<body>
			<h1>Página Farmacias Sana Sana</h1>
			<table border="1">
				<tr>
					<td bgcolor="#0FEC76">Ticket</td>
					<td bgcolor="#0FEC76">Sucursal</td>
					<td bgcolor="#0FEC76">Tipo de Pago</td>
					<td bgcolor="#0FEC76">Email</td>
					<td bgcolor="#0FEC76">RFC</td>
					<td bgcolor="#0FEC76">Nombre(Razón Social)</td>
					<td bgcolor="#0FEC76">CURP</td>
					<td bgcolor="#0FEC76">Calle</td>
					<td bgcolor="#0FEC76">Colonia</td>
					<td bgcolor="#0FEC76">Delegación o Municipio</td>
					<td bgcolor="#0FEC76">Ciudad</td>
					<td bgcolor="#0FEC76">Estado</td>
					<td bgcolor="#0FEC76">País</td>
					<td bgcolor="#0FEC76"># Exterior</td>
					<td bgcolor="#0FEC76"># Interior</td>
					<td bgcolor="#0FEC76">Código Postal</td>
				</tr>
				<tr>
					<td>'.$ticket.'</td>
					<td>'.$sucursal.'</td>
					<td>'.$tipoPago.'</td>
					<td>'.$de.'</td>
					<td>'.$rfc.'</td>
					<td>'.$nombre.'</td>
					<td>'.$curp.'</td>
					<td>'.$calle.'</td>
					<td>'.$colonia.'</td>
					<td>'.$municipio.'</td>
					<td>'.$ciudad.'</td>
					<td>'.$estado.'</td>
					<td>'.$pais.'</td>
					<td>'.$numExterior.'</td>
					<td>'.$numInterior.'</td>
					<td>'.$codigoPostal.'</td>
				</tr>
			</table>
			<img src="../../images/email/imagenMailer.png" alt="Farmacias Sana Sana" align="center">
		</body>
		</html>
		';

		//$mensaje.=filter_var($_POST['mensaje'], FILTER_SANITIZE_STRING);
		
		$correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()

		$correo->IsSMTP();
		$correo->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));

		// optional
		// used only when SMTP requires authentication  
		$correo->SMTPAuth = true;
		$correo->SMTPSecure = 'tls';
		$correo->Host = 'smtp.farmaciassanasana.com.mx';
		$correo->Port = 35;
		$correo->Username = 'facturacionsanasana@farmaciassanasana.com.mx';
		$correo->Password = 'Facturacion02';
 
		//Usamos el SetFrom para indicar quien envia el correo
		$correo->From = $de;
		$correo->FromName = $nombre;
		$correo->SetFrom($de, $nombre);
		 
		//Usamos el AddReplyTo para indicart a quien tiene que responder el correo
		$correo->AddReplyTo($de, $nombre);
		 
		//Usamos el AddAddress para agregar un destinatario
		$correo->AddAddress(destino, nombre);
		 
		//Ponemos el asunto del mensaje
		$correo->Subject = "Solicitud de Factura";
		 
		/*
		 * Si deseamos enviar un correo con formato HTML utilizaremos MsgHTML:
		 * $correo->MsgHTML("<strong>Mi Mensaje en HTML</strong>");
		 * Si deseamos enviarlo en texto plano, haremos lo siguiente:
		 * $correo->IsHTML(false);
		 * $correo->Body = "Mi mensaje en Texto Plano";
		$correo->MsgHTML($mensaje);*/

		$correo->MsgHTML($mensaje);
		
		//Si deseamos agregar un archivo adjunto utilizamos AddAttachment
		//$correo->AddAttachment("images/phpmailer.gif");
		$correo->CharSet = "UTF-8";
		//$correo->Encoding = "quoted­printable";

		//Enviamos el correo
		if(!$correo->Send()) {
		  echo'error';
		  //echo "Hubo un error: " . $correo->ErrorInfo;
		} else {
		  if ($id_cliente == "") {
		  	$valoresInsertarCliente = array(":rfc" => $rfc,
		  		":email" => $de,
		  		":nombre" => $nombre,
		  		":curp" => $curp,
		  		":calle" => $calle,
		  		":numExterior" => $numExterior,
		  		":numInterior" => $numInterior,
		  		":colonia" => $colonia,
		  		":municipio" => $municipio,
		  		":ciudad" => $ciudad, 
		  		":estado" => $estado,
		  		":telefono" => $telefono,
		  		":codigoPostal" => $codigoPostal);
			$sentencia = $conex->ejecutarAccion("INSERT INTO cliente VALUES (:rfc, :email , :nombre, :curp , :calle , :numExterior , :numInterior , :colonia , :municipio , :ciudad , :estado , :pais , :codigoPostal, :telefono)", $valoresInsertarCliente);
		  } else{
		  	$valoresActualizarCliente = array(":rfc" => $rfc,
		  		":email" => $de,
		  		":nombre" => $nombre,
		  		":curp" => $curp,
		  		":calle" => $calle,
		  		":numExterior" => $numExterior,
		  		":numInterior" => $numInterior,
		  		":colonia" => $colonia,
		  		":municipio" => $municipio,
		  		":ciudad" => $ciudad, 
		  		":estado" => $estado,
		  		":pais" => $pais,
		  		":telefono" => $telefono,
		  		":codigoPostal" => $codigoPostal,
		  		":id_cliente" => $id_cliente);
			$sentencia = $conex->ejecutarAccion("UPDATE cliente set rfc = :rfc , email = :email , nombre = :nombre , curp = :curp , calle = :calle, numExterior = :numExterior , numInterior = :numInterior , colonia = :colonia , municipio = :municipio , ciudad = :ciudad , estado = :estado , pais = :pais , codigoPostal = :codigoPostal, telefono = :telefono where id_cliente = :id_cliente", $valoresActualizarCliente);
			if($sentencia == true){
				echo "ok";
			} else {
		  		echo "errorActualizacion";
		  	}
		  }

		/*********************APARTADO PARA REGISTRAR LA FACTURA EN LA BASE DE DATOS DE FARMACIAS SANA SANA***************/
		//Recuperamos el id de la sucursal seleccionada por el usuario
	    $consulta = $conex->consultar("select * from sucursales where nombreSucursal = '".$sucursal."'");
	    $id_sucursal = 0;
	    foreach ($consulta as $row) {
	        $id_sucursal = $row['id_sucursal'];
	    }
	    //Recuperamos el id del cliente
	    $consulta = $conex->consultar("select * from cliente where rfc = '".$rfc."'");
	    $id_cliente = 0;
	    foreach ($consulta as $row) {
	        $id_cliente = $row['id_cliente'];
	    }
	    //Consulta a la base FarmaciaSanaSana a la tabla factura, para ver si esa petición ya está en el sistema.
		$consulta = $conex->consultar("select * from factura where id_cliente = '".$id_cliente."' and id_sucursal = ".$id_sucursal." and numTicket = ".$ticket);
	      if ($consulta != null) {
	        echo 'Su Ticket ya está registrado, su factura está en proceso, en un máximo de 24 hrs. será generada su factura.';
	    } else {
	    	setlocale(LC_ALL,"es_MX");
			date_default_timezone_set('UTC');
			date_default_timezone_set("America/Mexico_City");
	    	$valoresInsertarFactura = array(":id_cliente" => $id_cliente,
	    		":id_sucursal" => $id_sucursal,
	    		":numTicket" => $ticket,
	    		":tipoPago" => $tipoPago,
	    		":fecha_factura" => date ("Ymd H:i:s"));
	     	$sentencia = $conex->ejecutarAccion("INSERT INTO factura VALUES (:id_cliente, :id_sucursal, :numTicket , :tipoPago,:fecha_factura)",$valoresInsertarFactura);
			echo "Mensaje enviado con exito.";
	    }
	 }
	 $conex = null;		
 ?>