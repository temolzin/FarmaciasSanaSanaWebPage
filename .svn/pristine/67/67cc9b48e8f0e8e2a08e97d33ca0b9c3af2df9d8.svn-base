<?php
	$sucursal = $_REQUEST['comboSucursal'];

	require 'conexion.php';
               $conex = Conexion::getInstance();
               $consulta = $conex->consultar("select * from sucursales where nombreSucursal='".$sucursal."'");
                foreach ($consulta as $row) {
                $nombreSucursal=$row['nombreSucursal'];
                $maps=$row['maps'];
                $direccion=$row['direccion'];
                $extension=$row['extension'];
               }

        echo '<br><br><br><br><br><div id="direccionSucursal" align="center" name="direccionSucursal">Sucursal: '.$nombreSucursal.'<br>
			Dirección: '.$direccion.' <br>tel. '.$extension.'</div><br><iframe src="'.$maps.'" width="600" height="450" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe>';
?>