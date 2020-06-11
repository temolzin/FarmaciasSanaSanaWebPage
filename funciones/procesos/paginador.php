<?php

  $paginaActual = $_POST['partida'];

    $nroProductos = 65;//Numero de las imagenes, es la uúnica linea que se tiene que modificar
    $nroLotes = 12;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '<ul class="pagination">';
    $tabla = '';

    if($paginaActual > 1){
        //$lista = $lista.'<li><a href="javascript:pagination('.($paginaActual-1).');">Anterior</a></li>';
        $lista = $lista.'<li><a href="#"; onClick="pagination('.($paginaActual-1).');">&laquo;</a></li>';
    }
    for($i=1; $i<=$nroPaginas; $i++){
        if($i == $paginaActual){
          //$lista = $lista.'<li class="active"><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
          $lista = $lista.'<li class="active"><a href="#"; onClick="pagination('.$i.');">'.$i.'</a></li>';
        }else{
          //$lista = $lista.'<li><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
          $lista = $lista.'<li><a href="#"; onClick="pagination('.$i.');">'.$i.'</a></li>';
        }
    }
    if($paginaActual < $nroPaginas){
        //$lista = $lista.'<li><a href="javascript:pagination('.($paginaActual+1).');">Siguiente</a></li>';
        $lista = $lista.'<li><a href="#"; onClick="pagination('.($paginaActual+1).');">&raquo;</a></li>';
    }
    $lista = $lista.'</ul>';
  
    if($paginaActual <= 1){
      $limit = 0;
      $limit2 = $nroLotes;
    }else{
      $limit = $nroLotes*($paginaActual-1);
      $limit2 =$nroLotes*$paginaActual;
    }


    $tabla = $tabla.'
    
    <ul class="pagination pagination-lg" id="portfolio-list" data-animated="fadeIn">';

    
    for($i=$limit+1;$i<=$limit2;$i++){
		$tabla = $tabla.'<li>
		<img src="images/promociones/'.$i.'.png" alt="" />
		<div class="portfolio-item-content">
		<span class="header">Promoción</span>
		</div>
		<div class="icon-list">
		<a class="zoom lightbox" href="images/promociones/'.$i.'.png"><i class="fa fa-arrows-alt"></i></a>
		</div>
		</li>';   
    }
        

    $tabla = $tabla.'</ul>';



    $array = array(0 => $tabla,
      1 => $lista);

    echo json_encode($array);
    
?>