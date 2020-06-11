<?php
session_start();
if (isset($_SESSION['nombreUsuario'])==false){
  header('Location: ../../index.html');
} 

 	echo '
<script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui-1.9.2.min.js"></script>

    <link href="../../css/bootstrap.css" rel="stylesheet" />
    <link href="../../css/font-awesome.css" rel="stylesheet" />
    <link href="../../css/custom.css" rel="stylesheet" />
   <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
<link href="../../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />';

//Creación del objeto de conexión
require 'conexion.php';

//Mediante funciones se recupera el valor de las variables, excepto con la variable de pregunta la cual no esta dentro de una función 
function valorSucursal(){
$txtSucursal = $_POST['sucursal'];//Se recupera la sucursal seleccionada
return $txtSucursal;
}
function valorGrafica(){
$txtGrafica = $_POST['grafica'];//Se recupera la grafica seleccionada
return $txtGrafica;
}

//
if(isset($_POST['pregunta'])){//Se utliza un "isset" para saber si la variable fue creada o no(Si fue seleccionada en el checkBox o no)
$txtPregunta = $_POST['pregunta'];
}else{
    $txtPregunta = "TODAS";//En caso de que la variable no haya sido creada(El checkbox no fue seleccionado), la variable toma el valor de "TODAS"
}

function valorEdadInicial(){
if(isset($_POST['edadInicial'])){
$txtEdadInicial = $_POST['edadInicial'];
}else{
    $txtEdadInicial = "1";
}
return $txtEdadInicial;
}
function valorEdadFinal(){
if(isset($_POST['edadFinal'])){
$txtEdadFinal = $_POST['edadFinal'];
}else{
    $txtEdadFinal = "1";
}
return $txtEdadFinal;
}
function valorSexo(){
if(isset($_POST['sexo'])){
$txtSexo = $_POST['sexo'];
}else{
    $txtSexo = "0";
}
return $txtSexo;
}
function valorFecha(){
if(isset($_POST['fecha'])){
$fecha1=date_create_from_format('Y-m-d', $_POST['fecha']);//Se le da el formato de fecha seleccionada
$txtFecha=date_format($fecha1, 'Y-m-d');   
}else{
    $txtFecha = "1";
}
return $txtFecha;
}

//Se crean otras dos variables las cuales estaremos ocupando para realizar nuestras consultas
//$sqlPrincipal = "select COUNT(";
//$sqlSecundaria = ")cantidad from cuestionario where ";






//Tenemos 11 preguntas clasificadas en 4 diferentes grupos por su cantidad de respuestas . Se hace una función para cada grupo de preguntas(4)
//Inicia función del grupo uno, el cual solo tiene cuatro posibles respuestas
function consultaGrupo1(){
    global $txtPregunta;//La variable "txtPregunta" es una de las tres variable que se utiliza como global
    //Se crea un array el cual almacenara las consultas que se realizaran
	$arregloConsultas=array ();   
    //Se ejecuta una sentencia for para llenar el arreglo anterior 
	for($i=1;$i<=4;$i++){
		$arregloConsultas[$i] = "select COUNT(".$txtPregunta.")cantidad from cuestionario where ".$txtPregunta."=".$i; 
	}
    return $arregloConsultas;
}
//Finaliza función del grupo uno

//Inicia función del grupo dos, Este grupo de preguntas contienen siete posibles repuestas
function consultaGrupo2(){
    global $txtPregunta;
	$arregloConsultas=array ();

	for($i=1;$i<=7;$i++){
		$aux="";
		if($i==1){
			$aux="a";
			}else if($i==2){
				$aux="b";
			}else if($i==3){
				$aux="c";
			}else if($i==4){
				$aux="d";
			}else if($i==5){
				$aux="e";
			}else if($i==6){
				$aux="f";
			}else if($i==7){
				$aux="g";

			}
		$arregloConsultas[$i] ="select COUNT(".$txtPregunta.$aux.")cantidad from cuestionario where ".$txtPregunta.$aux."=1";
	}
	return $arregloConsultas;
}
//Finaliza función del grupo dos

//Inicia función del grupo tres. Este grupo contiene cuatro posibles respuestas
function consultaGrupo3(){
    global $txtPregunta;
	$arregloConsultas=array ();

	for($i=1;$i<=5;$i++){
		$arregloConsultas[$i] = "select COUNT(".$txtPregunta.")cantidad from cuestionario where ".$txtPregunta."=".$i; 
	}	
        return $arregloConsultas;
}
//Finaliza función del grupo tres

//Inicia funcion de grupo cuatro. Este grupo contiene seis posibles respuestas
function consultaGrupo4(){
    global $txtPregunta;
    $arregloConsultas=array ();

    for($i=1;$i<=6;$i++){
        $aux="";
        if($i==1){
            $aux="a";
            }else if($i==2){
                $aux="b";
            }else if($i==3){
                $aux="c";
            }else if($i==4){
                $aux="d";
            }else if($i==5){
                $aux="e";
            }else if($i==6){
                $aux="f";
            }
        $arregloConsultas[$i] ="select COUNT(".$txtPregunta.$aux.")cantidad from cuestionario where ".$txtPregunta.$aux."=1";
    }
    return $arregloConsultas;
}	
//Finaliza función del grupo 4

//Inicia la función de consulta por sucursal
function consultaPorSucusal(){//Esta y las siguientes tres funciones lo unico que hacen es recoger el valor correspondiente a cada una y concatenarselo para ser utilizados posteriormente	
		$sucursal=" and sucursal='".valorSucursal()."'";
	return $sucursal;
}
//Finaliza función de consulta por sucursal

//Inicia la función de consulta por sucursal
function consultaPorSexo(){	
		$sexo=" and sexo='".valorSexo()."'";
	return $sexo;
}
//Finaliza función de consulta por sucursal

//Inicia la función de consulta por edad
function consultaPorEdad(){
    $edad=" and edad BETWEEN ".valorEdadInicial()." AND ".valorEdadFinal();
    return $edad;   
}
//Finaliza función de consulta por edad

//Inicia la función de consulta por fecha
function consultaPorFecha(){
    $fecha=" and SUBSTRING(fecha,1,10)="."'".valorFecha()."'";
    return $fecha;   
}
//Finaliza función de consulta por edad

$conex = Conexion::getInstance();
function validaciones($limite){//Recibe un parametro el cual sirve para determinar el grupo al que pertenece la pregunta seleccionada.
    global $conex;//La variable "$conex" es la segunda variable de las tres que se utilizan como globales.
    $arreglocons = array();//"arreglocons"Es el arreglo que guardara las consultas de los arregelos de las funciones de "consultaGrupo" segun el grupo que haya sido seleccionado. 
    $newArreglo= array();//"newArreglo" Es el arreglo que contiene las consultas de "$arreglocons" ya concatenadas con las consultas por sucursal, sexo, edad o fecha y/o dependiendo de que haya seleccionado.

    if($limite==4){//Con este if se valida que tipo de pregunta fue seleccionada
        $arreglocons=consultaGrupo1();
    }else if($limite==7){
        $arreglocons=consultaGrupo2();
    }else if($limite==5){
        $arreglocons=consultaGrupo3();
    }else if($limite==6){
        $arreglocons=consultaGrupo4();
    }

    if(valorSucursal()!='Global'){//Valida que la sucursal seleccionada sea diferente de global
        if(valorSexo()=='M'||valorSexo()=='F'){//Valida que haya un sexo seleccionado
            if(valorEdadInicial()!="1"&&valorEdadFinal()!="1"){//Valida que haya una edad seleccionada
                if(valorFecha()!="1"){//valida que haya una fecha seleccionada
                    for($i=1;$i<=$limite;$i++){//Se utiliza un for para recorrer "$arreglocons" se detiene hasta que llegue a "$limite" pues es la cantidad de respuestas que tiene la pregunta y por lo tento la cantidad de consultas que se generaran 
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSucusal().consultaPorSexo().consultaPorEdad().consultaPorFecha();//Aqui se va concatenando a la consulta las partes de esta, en este fueron sellcionados todos los filtos posibles (Sucursal, sexo, edad y fecha)
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {//Mediante un for each se ejecuta la consulta
                            $newArreglo[$i]=$row['cantidad'];  //El resultado de la consulta es almacenado en "$newArreglo"
                        }
                    }
                }else{//Termina validación de la fecha -- Inicia "En caso contrario de que no haya seleccionado fecha"
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSucusal().consultaPorSexo().consultaPorEdad();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  ;
                        }
                    }
                }//Termina "En caso contrario de que no haya seleccionado fecha"
            }else{//Termina validación de edad -- Inicia "En caso contrario de que no haya seleccionado edad"
                if(valorFecha()!="1"){//Inicia "validación de fecha 2"
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSucusal().consultaPorSexo().consultaPorFecha();//Ahora se concatena la fehca pero sin la edad
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];
                        }
                    }
                }else{// Termina "Validación de fecha 2" -- Inicia "En caso contrario de que no haya seleccionado fecha" sobre validación fecha 2
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSucusal().consultaPorSexo();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }//Termina "En caso contrazrio de que no haya seleccionado fecha" sobre validación fecha 2

            }//Termina "En caso contrario de que no haya seleccionado edad"
        }else{//Termina validación de edad -- Inicia "En caso contrario de que no haya seleccionado sexo"
            if(valorEdadInicial()!="1"&&valorEdadFinal()!="1"){//Inicia validación de edades dentro de "En caso contrario de que no haya seleccionado sexo"
                if(valorFecha()!="1"){//Inicia validación de fecha dentro de "En caso de que no haya seleccionado fecha"
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSucusal().consultaPorEdad().consultaPorFecha();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }else{//Termina validación de fecha dentro de "En caso de que no haya seleccionado edades" -- Incia en caso contrario de que no haya seleccionado fecha dentro de "En caso contrario que no haya seleccionado fecha"
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSucusal().consultaPorEdad();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }
            }else{
                if(valorFecha()!="1"){
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSucusal().consultaPorFecha();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }else{
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSucusal();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }

            }
        }

    }else{//EN CASO DE QUE SEA GLOBAL
        if(valorSexo()=='M'||valorSexo()=='F'){
            if(valorEdadInicial()!="1"&&valorEdadFinal()!="1"){
                if(valorFecha()!="1"){
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSexo().consultaPorEdad().consultaPorFecha();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }else{
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSexo().consultaPorEdad();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }
            }else{
                if(valorFecha()!="1"){
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSexo().consultaPorFecha();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }else{
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorSexo();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }

            }
        }else{//else de sexo
            if(valorEdadInicial()!="1"&&valorEdadFinal()!="1"){//Falta cerrar llave
                if(valorFecha()!="1"){
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorEdad().consultaPorFecha();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }else{
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorEdad();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }
            }else{
                if(valorFecha()!="1"){
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i].consultaPorFecha();
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  
                        }
                    }
                }else{
                    for($i=1;$i<=$limite;$i++){
                        $arreglocons[$i]=$arreglocons[$i];
                        foreach ($conex->consultar($arreglocons[$i]) as $row) {
                            $newArreglo[$i]=$row['cantidad'];  

                        }
                    }
                }

            }
        }

    }            
return $newArreglo;
$conex->cerrarConex();
}
//Conesta función se elige el tipo de grafica que se va a utlizar
function elegirGrafica($numContainer){//recibe un parametro el cual es numero de container que se creara, se agrego ya que era necesario en caso de que se seleccionaran todas las preguntas
    if(valorGrafica()=='Pastel'){
        graficar($numContainer);
    }else if(valorGrafica()=='Barras'){
        graficaEjemplo($numContainer);
    }else if(valorGrafica()=='Polar'){
        graficaPolar($numContainer);
    }else if(valorGrafica()=='Pastel3d'){
        graficarPastel3d($numContainer);
    }

}

$newArreglo=array();//Esta es la ultima variable que se utilizara como global
function nuevaConsulta(){
    global $newArreglo;//Es la ultima variable de las tres que seran utilizadas como globales
    global $txtPregunta;
    
    if($txtPregunta=='TODAS'){//En esta validación en caso de que se haya seleccionado la opción todas, generan las 11 graficas
        $txtPregunta='pregunta1';
        $newArreglo=validaciones(4);
        elegirGrafica(1);
        $txtPregunta='pregunta2';
        $newArreglo=validaciones(4);
        elegirGrafica(2);
        $txtPregunta='pregunta3';
        $newArreglo=validaciones(7);
        elegirGrafica(3);
        $txtPregunta='pregunta4a';
        $newArreglo=validaciones(5);
        elegirGrafica(4);
        $txtPregunta='pregunta4b';
        $newArreglo=validaciones(5);
        elegirGrafica(5);
        $txtPregunta='pregunta4c';
        $newArreglo=validaciones(5);
        elegirGrafica(6);
        $txtPregunta='pregunta4d';
        $newArreglo=validaciones(5);
        elegirGrafica(7);
        $txtPregunta='pregunta4e';
        $newArreglo=validaciones(5);
        elegirGrafica(8);
        $txtPregunta='pregunta4f';
        $newArreglo=validaciones(5);
        elegirGrafica(9);
        $txtPregunta='pregunta5';
        $newArreglo=validaciones(4);
        elegirGrafica(10);
        $txtPregunta='pregunta6';
        $newArreglo=validaciones(6);
        elegirGrafica(11);


    }else if($txtPregunta=='pregunta1'||$txtPregunta=='pregunta2'||$txtPregunta=='pregunta5'){//Si solo se selecciona una pregunta en especifico solo se genera una grafica

        $newArreglo=validaciones(4);
        elegirGrafica(1);


    }else if($txtPregunta=='pregunta3'){
        $newArreglo=validaciones(7);
        elegirGrafica(1);

    }else if($txtPregunta=='pregunta4a'||$txtPregunta=='pregunta4b'||$txtPregunta=='pregunta4c'||$txtPregunta=='pregunta4d'||$txtPregunta=='pregunta4e'||$txtPregunta=='pregunta4f'){
        $newArreglo=validaciones(5);
        elegirGrafica(1);

    }else if($txtPregunta=='pregunta6'){
        $newArreglo=validaciones(6);
        elegirGrafica(1);
    }
}


//Esta función sirve para mandar la pregunta seleccionada a la grafica
function obtenerPregunta(){
    global $txtPregunta;
    $pregunta="";

    if($txtPregunta=='pregunta1'){
        $pregunta='1. ¿TIEMPO QUE HA ESTADO COMPRANDO PRODUCTOS EN NUESTRA SUCURSAL?';
    }else if($txtPregunta=='pregunta2'){
        $pregunta='2. ¿CON QUE FRECUENCIA NOS COMPRA?';
    }else if($txtPregunta=='pregunta3'){
        $pregunta='3. ¿POR QUE PREFIERE COMPRAR EN FARMACIAS SANA SANA?';
    }else if($txtPregunta=='pregunta4a'){
        $pregunta='4.1. CALIFICACIÓN: SERVICIO AL CLIENTE';
    }else if($txtPregunta=='pregunta4b'){
        $pregunta='4.2. CALIFICACIÓN: TIEMPO DE ESPERA';
    }else if($txtPregunta=='pregunta4c'){
        $pregunta='4.3. CALIFICACIÓN: IMAGEN GENERAL FARMACIA';
    }else if($txtPregunta=='pregunta4d'){
        $pregunta='4.4. CALIFICACIÓN: PERSONAL DE VENTA';
    }else if($txtPregunta=='pregunta4e'){
        $pregunta='4.5. CALIFICACIÓN: PRECIO';
    }else if($txtPregunta=='pregunta4f'){
        $pregunta='4.6. CALIFICACIÓN:SURTIDO';
    }else if($txtPregunta=='pregunta5'){
        $pregunta='5. ¿CUÁL ES LA PROBABILIDAD DE QUE NOS RECOMIENDE?';
    }else if($txtPregunta=='pregunta6'){
        $pregunta='6. SELECCIONE EL ASPECTO QUE CONSIDERA DEBERIAMOS MEJORAR';
    }
    return $pregunta;
}

//Esta función sirve para mandar las respuestas seleccionadas a la grafica
function obtenerRespuestas(){
    global $txtPregunta;
    $respuestas= array ();
    if($txtPregunta=='pregunta1'){
        $respuestas = array ('1' => 'HACE MENOS DE 6 MESES',
        '2' => 'DE 6 MESES A 1 AÑO',
        '3' => 'MÁS DE 1 AÑO A 3 AÑOS',
        '4' => 'MÁS DE 5 AÑOS',);
    }else if($txtPregunta=='pregunta2'){
        $respuestas = array ('1' => 'CADA SEMANA',
        '2' => 'CADA MES',
        '3' => 'CADA 3 MESES A 6 MESES',
        '4' => 'UNA O DOS VECES AL AÑO',);
    }else if($txtPregunta=='pregunta3'){
        $respuestas = array ('1' => 'UBICACIÓN O CERCANIA',
        '2' => 'CALIDAD DE SERVICIO AL CLIENTE',
        '3' => 'PRECIO',
        '4' => 'SURTIDO',
        '5' => 'RECOMENDACIÓN',
        '6' => 'LO VI EN EL VOLANTE',
        '7' => 'LO VI EN LA WEB',);
    }else if($txtPregunta=='pregunta4a'||$txtPregunta=='pregunta4b'||$txtPregunta=='pregunta4c'||$txtPregunta=='pregunta4d'||$txtPregunta=='pregunta4e'||$txtPregunta=='pregunta4f'){
         $respuestas = array ('1' => 'Muy malo',
        '2' => 'malo',
        '3' => 'regular',
        '4' => 'bueno',
        '5' => 'muy bueno',);
    }else if($txtPregunta=='pregunta5'){
        $respuestas = array ('1' => 'MUY PROBABLE',
        '2' => 'ALGO PROBABLE',
        '3' => 'ALGO POCO PROBABLE',
        '4' => 'MUY POCO PROBABLE',);

    }else if($txtPregunta=='pregunta6'){
        $respuestas = array ('1' => 'SERVICIO AL CLIENTE',
        '2' => 'TIEMPO DE ESPERA',
        '3' => 'IMAGEN GENERAL FARMACIA',
        '4' => 'PRESONAL DE VENTAS',
        '5' => 'PRECIO',
        '6' => 'SURTIDO',);

    }
    return $respuestas;

}
//Función que genera una grafica de barras en 3D
function graficarPastel3d($numContainer){//Recibe un parametro el cual es el numero del container que se genera
    global $newArreglo;
    $datos=$newArreglo;//A la variable datos se le asignan los valores de "$newArreglo"
    $cantidadDatos=count($newArreglo);//Se cuentan cuantos datos hay en "$newArreglo"
    $respuestas=obtenerRespuestas();//Se obtienen las respuestas de la pregunta seleccionada

    $parteInicial ="
    <div id='container".$numContainer."' name='container".$numContainer."' style='width: 100%'>
     </div>

     <style type='text/css'>
     #container".$numContainer." {
     height: 400px; 
     min-width: 310px; 
     max-width: 800px;
     margin: 0 auto;
     }
     </style>

     <script>
     Highcharts.chart('container".$numContainer."', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: '".obtenerPregunta()."'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Cantidad',
        data: [";
        

        $parteFinal="]
    }]
});
     </script>
    ";

    echo $parteInicial;//Aqui empieza a generarse la grafica, mandando primero la parte inical de esta
    for($i=1;$i<=$cantidadDatos;$i++){//Despues mediante una sentencia for se genera cada una de las partes de la grafica con su respectiva respuesta y datos
        echo "['".$respuestas[$i]."',".$datos[$i]."],"; 
    }
    echo $parteFinal;//Se termina de generar la pagina terminando el script 



}



function graficar($numContainer){//Imprime una grafica de pastel normal
    global $newArreglo;
    $datos= $newArreglo;
    $cantidadDatos=count($newArreglo);
    $respuestas=obtenerRespuestas();

    $parteFinalGrafica = "]
    }]
    });
    </script>";

	$grafica = "
    <div id='container".$numContainer."' name='container".$numContainer."' style='width: 100%'>
     </div>

     <style type='text/css'>
     #container".$numContainer." {
     height: 400px; 
     min-width: 310px; 
     max-width: 800px;
     margin: 0 auto;
     }
     </style>

	<script>
	Highcharts.chart('container".$numContainer."', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '".obtenerPregunta()."'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [
         ";

         echo $grafica;
         for($i=1;$i<=$cantidadDatos;$i++){
            echo "{
            name: '".$respuestas[$i]."',
            y: ".$datos[$i]."
        },"; 
         }
         echo $parteFinalGrafica;

}

function graficaPolar($numContainer){//Imprime una grafica de polar o telaraña
    global $newArreglo;
    $datos=$newArreglo;
    $cantidadDatos=count($newArreglo);
    $respuestas=obtenerRespuestas();

    $primeraParte ='
    <div id="container'.$numContainer.'" name="container'.$numContainer.'" style="width: 100%">
     </div>

     <style type="text/css">
     #container'.$numContainer.' {
     height: 400px; 
     min-width: 310px; 
     max-width: 800px;
     margin: 0 auto;
     }
     </style>


    <script>
    Highcharts.chart("container'.$numContainer.'", {

    chart: {
        polar: true,
        type: "line"
    },

    title: {
        text: "'.obtenerPregunta().'",
        x: -80
    },

    pane: {
        size: "80%"
    },

    xAxis: {
        categories: [';

        $segundaParte='],
        tickmarkPlacement: "on",
        lineWidth: 0
    },

    yAxis: {
        gridLineInterpolation: "polygon",
        lineWidth: 0,
        min: 0
    },

    tooltip: {
        shared: true,
       
    },

    legend: {
        align: "right",
        verticalAlign: "top",
        y: 70,
        layout: "vertical"
    },

    series: [{
        name: "'.obtenerPregunta().'",
        data: [';
    $ultimaParte='],
        pointPlacement: "on"
    }]

});
</script>';

echo $primeraParte;
for($i=1;$i<=$cantidadDatos;$i++){
    echo '"'.$respuestas[$i].'",'; 
    }
    echo $segundaParte;
    for($i=1;$i<=$cantidadDatos;$i++){        
        echo $datos[$i].',';

    }
    echo $ultimaParte;


}

function graficaEjemplo($numContainer){//Imprime una grafica de barras en 3D
global $newArreglo;
$datos=$newArreglo;
$cantidadDatos=count($newArreglo);
$respuestas=obtenerRespuestas();

        
$primeraParte = "
<div id='container".$numContainer."' name='container".$numContainer."' style='width: 100%'>
         
</div>

<style type='text/css'>
#container".$numContainer." {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
</style>

<script>
Highcharts.chart('container".$numContainer."', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: '".obtenerPregunta()."'
    },

    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: [";


$segundaParte= "],
        labels: {
            skew3d: true,
            style: {
                fontSize: '16px'
            }
        }
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: 'Cantidad',
        data: [";


        $terceraParte= "]
    }]
});
</script>
";

echo $primeraParte;
for($i=1;$i<=$cantidadDatos;$i++){
    echo "'".$respuestas[$i]."',"; 
}
echo $segundaParte;
for($i=1;$i<=$cantidadDatos;$i++){
    echo "".$datos[$i].","; 
}
echo $terceraParte;

}


nuevaConsulta();//Este metodo es el que inicia a generar la grafica

