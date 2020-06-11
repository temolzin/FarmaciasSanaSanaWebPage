<?php
/*
Clase para almacenar los datos del reporte Ventas existencias
*/
class ProductoExistencia {
	private $sku;
	private $nombre;
	private $existencia;
	private $sucursal;
 	private $totalVenta;
 	private $sugerido;
 	private $precioVenta;


 	//Setter y Getters
 	public function getSku() {
 		return $this->sku;
 	}
 	public function setSku($sku) {
 		$this->sku = $sku;
 	}

 	public function getNombre(){
 		return $this->nombre;
 	}
 	public function setNombre($nombre) {
 		$this->nombre = $nombre;
 	}

 	public function getExistencia(){
 		return $this->existencia;
 	}
 	public function setExistencia($existencia) {
 		$this->existencia = $existencia;
 	}

 	public function getTotalVenta(){
 		return $this->totalVenta;
 	}
 	public function setTotalVenta($totalVenta) {
 		$this->totalVenta = $totalVenta;
 	}

 	public function getSucursal(){
 		return $this->sucursal;
 	}
 	public function setSucursal($sucursal) {
 		$this->sucursal = $sucursal;
 	}
 	public function getSugerido(){
 		return $this->sugerido;
 	}
 	public function setSugerido($sugerido) {
 		$this->sugerido = $sugerido;
 	}
 	public function getPrecioVenta() {
 		return $this->precioVenta;
 	}
 	public function setPrecioVenta($precioVenta) {
 		$this->precioVenta = $precioVenta;
 	}

}

?>