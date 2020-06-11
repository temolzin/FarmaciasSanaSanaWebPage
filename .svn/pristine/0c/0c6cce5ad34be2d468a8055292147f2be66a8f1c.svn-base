<?php
session_start();
set_time_limit(900);

//Creación del objeto de conexión
  require 'conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conexión

$idUsuario = filter_var($_POST['comboProveedor'], FILTER_SANITIZE_STRING);


//obtenemos el archivo .csv
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$archivotmp = $_FILES['archivo']['tmp_name'];


//cargamos el archivo
$lineas = file($archivotmp);
//Variable para concatenar los 0 a el SKU
$skuCompleto = "";

$valoresDelete = array(":id_usuario"=>$idUsuario);
$sentenciaDelete = $conex->ejecutarAccion("DELETE FROM skuProveedor where id_usuario = :id_usuario", $valoresDelete);	
if($sentenciaDelete == false) {
  echo 'Error al eliminar SKU';
}	

//Recorremos el bucle para leer línea por línea
foreach ($lineas as $linea_num => $linea)
{ 
  //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
  /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
  leyendo hasta que encuentre un ; */
  $datos = explode(PHP_EOL,$linea);
  //Almacenamos los datos que vamos leyendo en una variable
  $sku = trim($datos[0]);
  //guardamos en base de datos la línea leida
  if(strlen($sku) < 15) {
    $condicion = 15 - strlen($sku);
    for($i = 1; $i <=$condicion; $i++){
        $skuCompleto.= "0";
     }
   }
  $skuCompleto.= $sku;

$valoresInsert = array(":id_usuario"=>$idUsuario,
                       ":sku"=>$skuCompleto);
$sentenciaInsert = $conex->ejecutarAccion("INSERT INTO skuProveedor VALUES (:id_usuario, :sku)",$valoresInsert);			
if($sentenciaInsert == false) {
  echo 'Error al insertar SKU';
} 

$skuCompleto = "";
//cerramos bucle
}
$conex = null;
?>