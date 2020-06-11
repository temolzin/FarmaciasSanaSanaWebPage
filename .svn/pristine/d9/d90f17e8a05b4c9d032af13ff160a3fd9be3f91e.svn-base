<?php 
if (isset($_SESSION['nombreUsuario'])==false){
  header('Location: ../../index.html');
} 
require_once('../../lib/phpMailer/class.phpmailer.php');
require_once('../../lib/phpMailer/class.smtp.php');
require_once('../../lib/phpMailer/PHPMailerAutoload.php');

	define("destino", "mercadotecnia@farmaciassanasana.com.mx");
	define("nombre", "Farmacias Sana Sana");

		$nombre=filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
		$de=filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$telefono=filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
		$asunto=filter_var($_POST['asunto'], FILTER_SANITIZE_STRING);
		$message = filter_var($_POST['mensaje'], FILTER_SANITIZE_STRING);;
		$mensaje='
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Formulario de contacto</title>
		</head>
		<body>
			<h1>Página Farmacias Sana Sana</h1>
			<table border="1">
				<tr>
					<td bgcolor="#0FEC76">Nombre</td>
					<td bgcolor="#0FEC76">Email</td>
					<td bgcolor="#0FEC76">Teléfono</td>
					<td bgcolor="#0FEC76">Asunto</td>
					<td bgcolor="#0FEC76">Mensaje</td>
				</tr>
				<tr>
					<td>'.$nombre.'</td>
					<td>'.$de.'</td>
					<td>'.$telefono.'</td>
					<td>'.$asunto.'</td>
					<td>'.$message.'</td>
				</tr>
			</table>
			<img src="../../images/email/imagenMailer.png" alt="Farmacias Sana Sana" align="left">
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
		$correo->Username = 'mercadotecnia@farmaciassanasana.com.mx';
		$correo->Password = 'Mercadotecnia*1288@';
 
		//Usamos el SetFrom para indicar quien envia el correo
		$correo->From = $de;
		$correo->FromName = $nombre;
		$correo->SetFrom($de, $nombre);
		 
		//Usamos el AddReplyTo para indicart a quien tiene que responder el correo
		$correo->AddReplyTo($de, $nombre);
		 
		//Usamos el AddAddress para agregar un destinatario
		$correo->AddAddress(destino, nombre);
		 
		//Ponemos el asunto del mensaje
		$correo->Subject = $asunto;
		 
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
		$correo->CharSet = "UTF­8";
		//$correo->Encoding = "quoted­printable";
		 
		//Enviamos el correo
		if(!$correo->Send()) {
		  //echo'error';
		  echo "Hubo un error: " . $correo->ErrorInfo;
		} else {
		  echo "Mensaje enviado con exito.";
		}
 ?>