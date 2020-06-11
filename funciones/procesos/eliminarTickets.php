<?php
session_start();

//Creación del objeto de conexión
  require 'conexion.php';
  $conex = Conexion::getInstance();
//Termino de la creación del objeto conexión

//Variables
  $sucursal = $_POST['comboSucursal'];
  $numTicket = $_POST['txtTicket'];
  $ipSucursal="";
  $nombreDB="dbsav300";

  $consulta = $conex->consultar("SELECT * FROM sucursales WHERE nombreSucursal='".$sucursal."'");
  foreach ($consulta as $row) {
    $ipSucursal=$row['ipSucursal'];
  }
  $passwordSucursal="S@na*s1";

  //echo "Sucursal: ".$sucursal." numero de Ticket: ".$numTicket;
  //echo "Ip de sucursal: ".$ipSucursal." Nombre DB: ".$nombreDB." Contraseña: ".$passwordSucursal;

  /*foreach ($conex->consultarByConex($conex2,$sqlTicket) as $row) {
            
            echo 'Dato: '.$row['term_Clave'];
          }*/
  if(isset($_POST['btnEliminar'])){
    $sql1="DELETE from tVenta where venta_Folio=:numTicket";
    $sql2="DELETE from tVentaDetalle where venta_Folio=:numTicket";

    $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
    $sqlTicket = "SELECT * FROM tVenta where venta_Folio = ".$numTicket;

    try{
      $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
      //Verifico si el Ticket Existe.
      if($conex->consultarByConex($conex2,$sqlTicket) != null){
        $valoresDelete = array(':numTicket' => $numTicket );
            $conex->ejecutarAccionByConex($conex2, $sql1, $valoresDelete);
            $conex->ejecutarAccionByConex($conex2, $sql2, $valoresDelete);
            ?>
            <script>
            swal({title: "¡Éxito!",text: "El Ticket se elimino correctamente",   type: "success",closeOnConfirm: "Aceptar"});
            </script>
            <?php           
      }  else {
            ?>
            <script>
             swal({title: "¡Error!",text: "El Ticket no existe",   type: "error",closeOnConfirm: "Aceptar"});
           </script>
           <?php            
          }
      }catch(PDOException $e){
        echo "Error en la base de datos, consulte al programador";
      }
      
  }else if(isset($_POST['btnActualizar'])){
  $sql1="UPDATE tVentaDetalle set eventa_Clave='REGISTRADA' where venta_Folio=:numTicket";
  $sqlVenta="UPDATE tVenta set eventa_Clave='REGISTRADA' where venta_Folio=:numTicket";

  $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
  $sqlTicket = "SELECT * FROM tVenta where venta_Folio = ".$numTicket;
try{
            $conex2 = $conex->conectarByIPandPasswordandDBName($ipSucursal, $passwordSucursal, $nombreDB);
          //Verifico si el Ticket Existe.
          if($conex->consultarByConex($conex2,$sqlTicket) != null){
            $valoresDelete = array(':numTicket' => $numTicket );
            $conex->ejecutarAccionByConex($conex2, $sql1, $valoresDelete);           
            $conex->ejecutarAccionByConex($conex2, $sqlVenta, $valoresDelete);   
             ?> 
            <script>
            swal({title: "¡Éxito!",text: "El Ticket se actualizo correctamente",   type: "success",closeOnConfirm: "Aceptar"});
            </script>
            <?php           
          }  else {
            ?>
            <script>
             swal({title: "¡Error, no se pudo actualizar el ticket!",text: "El Ticket no existe",   type: "error",closeOnConfirm: "Aceptar"});
           </script>
           <?php            
          }
      }catch(PDOException $e){
        echo "Error en la base de datos, consulte al programador";
      }
}
  //$conex->cerrarConex();
  //$conex2 = null;
  //header("location: ../vistas/eliminarTicketsView.php");
?>