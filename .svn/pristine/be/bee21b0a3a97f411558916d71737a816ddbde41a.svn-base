<?php
session_start();
require('conexion.php');
    //Patrón Singleton
    $conex = Conexion::getInstance();
        
        $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
        $contraseña = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $consulta = $conex->consultar("select * from usuario where nombreUsuario =  '".$usuario."' and password = '".$contraseña."'");

        if($consulta != null){
            foreach ($consulta as $row) {
                //Recuperamos el nombre del privilegio, según el ID.
                $consultaNombrePrivilegio = $conex->consultar("select nombrePrivilegio from privilegios where id_privilegio = " . $row['tipoUsuario']);
                foreach ($consultaNombrePrivilegio as $resultado) {
                    $_SESSION["tipoUsuario"] = $resultado['nombrePrivilegio'];
                }
                //Se valida si los apellidos maternos y paternos son direfentes de N/A
                if($row["ap_mat"] == 'N/A' or $row["ap_mat"] == 'NA' or $row["ap_pat"] == 'N/A' or $row["ap_pat"] == 'N/A'){
                    $nombreCompleto = $row['nombre'];
                } else{
                   $nombreCompleto = $row['nombre']." ".$row['ap_pat']." ".$row["ap_mat"];
                }
                $_SESSION["nombreCompleto"] = $nombreCompleto;
                $_SESSION["id_usuario"] = $row["id_usuario"];
                $_SESSION["nombreUsuario"] = $row['nombreUsuario'];
                $_SESSION["nombre"] = $row['nombre'];
                $_SESSION["ap_pat"] = $row["ap_pat"];
                $_SESSION["ap_mat"] = $row["ap_mat"];
                $_SESSION["edad"] = $row["edad"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["genero"] = $row["genero"];
                $_SESSION["telefono"] = $row["telefono"];
                $_SESSION["direccion"] = $row["direccion"];
                $_SESSION["password"] = $row["password"];
                $_SESSION["status"] = $row["status"];
                echo 'ok';
            }
        } else {
            echo 'error';
        }        
?>