<?php 
session_start();
require 'menuView.php';
require '../procesos/conexion.php';
$conex = Conexion::getInstance();
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="../../js/jquery.js"></script>

<script type="text/javascript" src="../../js/jquery-ui-1.9.2.min.js"></script>

<script type="text/javascript" src="../../js/sweetalert.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/jquery.prettyPhoto.js"></script>
<script src="../../js/jquery.isotope.min.js"></script>     
<script src="../../js/wow.min.js"></script>
<script src="../../js/functions.js"></script>
<script type="text/javascript" src="../../js/jquery.validate.js"></script>

<link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" />
<link href="../../css/bootstrap.css" rel="stylesheet">
<link href="../../css/sweetalert.css" rel="stylesheet" />
<link rel="stylesheet" href="../../css/font-awesome.min.css">

<link href="../../css/bootstrap.css" rel="stylesheet" />
<link href="../../css/font-awesome.css" rel="stylesheet" />
<link href="../../css/custom.css" rel="stylesheet" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
<link href="../../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />




<!--Esta hoja de estilos pertence al calendario datepicker-->
<link href="../../css/jquery-ui.min.css" rel="stylesheet" />


<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--Libreriras de highcharts, por medio de estos se generan las graficas-->
<script type="text/javascript" src="../../js/highcharts.js"></script>
<script type="text/javascript" src="../../js/highcharts-3d.js"></script>
<script type="text/javascript" src="../../js/highcharts-more.js"></script>
<script type="text/javascript" src="../../js/exporting.js"></script>


<meta charset="utf-8" />
<title>Graficas de Encuestas</title>
</head>

<body>
    <!--Esta función sirve para activar y desactivar los campos-->
  <script>
    function habilitaCampo(campo){//recibe un paramatro el cueal es el nombre del campo que se desactivara y activara  
      var estadoActual = document.getElementById(campo);
      estadoActual.disabled = !estadoActual.disabled;
    }        
  </script>

  <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <p class="navbar-brand" href="#"><?php echo $_SESSION['tipoUsuario']?></p> 
            </div>
              <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> 
                Farmacias Sana Sana &nbsp; 
                <a href="../procesos/cerrarSesion.php" class="btn btn-danger square-btn-adjust">Cerrar Sesión</a> 
              </div>
        </nav>   
           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <?php 
                  menu('reporteEncuesta');
                 ?>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2 align="center">
                        Consulta de Encuestas.
                     </h2>   
                        <h5 align="center">Farmacias Sana Sana</h5>
                    </div>
                </div>
                 <!-- /. ROW  -->

                 <div align="center">
    <form method="POST" id="formulario" name="formulario">
    <div class="col-md-3"></div> 
    <div class="col-md-3">
        <font size="4" color="black">SUCURSAL:</font>
        <select name="sucursal" class="form-control" id="sucursal" >
            <option value="Global">Global</option> 
            <?php 
            $consulta = $conex->consultar("select * from sucursales");
            foreach ($consulta as $row) {
                echo '<option value = "'.$row['nombreSucursal'].'" > '.$row['nombreSucursal'].' </option>';
            }    
            ?> 
        </select>
    </div>
  

    <!--INICIA SELECCIÓN DE PREGUNTA-->
    <div class="col-md-3">
        <font size="4" color="black">PREGUNTA:</font>
        <input class="form-check-input" type="checkbox" name="activarPregunta" id="c1" onclick="habilitaCampo('pregunta')" />
        <label for="c1"><span></span></label>
        <select name="pregunta" class="form-control" id="pregunta" disabled> 
            <option value="TODAS" selected>TODAS</option>
            <option value="pregunta1">1. ¿HACE CUANTO TIEMPO HA ESTADO COMPRANDO PRODUCTOS EN NUESTRA SUCURSAL?</option>
            <option value="pregunta2">2. ¿CON QUE FRECUENCIA NOS COMPRA?</option>
            <option value="pregunta3">3. ¿POR QUE PREFIERE COMPRAR EN FARMACIAS SANA SANA?</option>
            <option value="pregunta4a">4.1. CALIFICACIÓN: SERVICIO AL CLIENTE</option>
            <option value="pregunta4b">4.2. CALIFICACIÓN: TIEMPO DE ESPERA</option>
            <option value="pregunta4c">4.3. CALIFICACIÓN: IMAGEN GENERAL FARMACIA</option>
            <option value="pregunta4d">4.4. CALIFICACIÓN: PERSONAL DE VENTA</option>
            <option value="pregunta4e">4.5. CALIFICACIÓN: PRECIO</option>
            <option value="pregunta4f">4.6. CALIFICACIÓN:SURTIDO</option>
            <option value="pregunta5">5. ¿CUÁL ES LA PROBABILIDAD DE QUE NOS RECOMIENDE?</option>
            <option value="pregunta6">6. SELECCIONE EL ASPECTO QUE CONSIDERA DEBERIAMOS MEJORAR</option>
        </select>
    </div>
    <!--FINALIZA SELECCIÓN DE PREGUNTA-->
    <br><br><br><br>

    <div class="col-md-3"></div> 
    <!--INICIA SELECCIÓN DE FECHA-->
    <div class="col-md-3">
        <font size="4" color="black">FECHA:</font>
        <input class="form-check-input" type="checkbox" name="activarFecha" id="c2" onclick="habilitaCampo('fecha')"/>
        <label for="c2"><span></span></label>
        <input type="text" placeholder="Selecciona Fecha" name="fecha" class="form-control fecha" id="fecha" disabled>
    </div>
    <!--FINALIZA SELECCIÓN DE FECHA-->
    <!--INICIA SELECCIÓN DE EDAD-->
    <div class="col-md-3">
        <font size="4" color="black">EDAD:</font>
        <input class="form-check-input" type="checkbox" name="activarEdad" id="c3" onclick="habilitaCampo('edadInicial'),habilitaCampo('edadFinal')"/>
        <label for="c3"><span></span></label>
        <br>
        <div class="col-md-5"><input type="number" min="1" max="99" value="1" name="edadInicial" class="form-control" id="edadInicial" disabled></div>
        <div class="col-md-1"></div>
        <div class="col-md-5"><input type="number" min="1" max="99" value="1" name="edadFinal" class="form-control" id="edadFinal" disabled></div>
    </div>
    <!--FINALIZA SELECCIÓN DE EDAD-->
    <br><br><br><br>





    <div class="col-md-3"></div>
    <!--INICIA SELECCIÓN DE SEXO--> 
    <div class="col-md-3">
        <font size="4" color="black">SEXO:</font>
        <input class="form-check-input" type="checkbox" name="activarSexo" id="c4" onclick="habilitaCampo('sexo')" />
        <label for="c4"><span></span></label>
        <select name="sexo" class="form-control" id="sexo" disabled>
            <option value=0 selected>Selecciona una opcion</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
    </div>
    <!--FINALIZA SELECCIÓN DE SEXO-->
    <!--INICIA SELECCIÓN DE GRAFICA-->
    <div class="col-md-3">
        <font size="4" color="black">GRAFICA:</font>
        <select name="grafica" class="form-control" id="grafica">
            <option value="Pastel">Pastel</option>
            <option value="Barras">Barras</option>
            <option value="Polar">Polar</option>
            <option value="Pastel3d">Pastel 3D</option>
        </select>
        
    </div>
    <!--FINALIZA SELECCIÓN DE GRAFICA-->
    <br><br><br><br>

    <div class="col-md-4"></div>
    <div class="col-md-4">
         <button class="btn btn-success " name="btnGraficar" id="btnGraficar">Graficar</button> 
         <div><span name="errores" id="errores"></span></div><!--Aquí se generan los mensajes de error-->
    </div>
    </form><!--Finaliza el formulario -->

    <form id="formGraficas">
     <!--Dentro de este Form se generan las graficas-->   
    </form>
    </div>
  </div>
</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
               
<script>
    $(document).ready(function() {
      jQuery.validator.setDefaults({//Mediante "jQuery validator" se determina en donde se mostraran todos los mensajes de error
        errorPlacement: function(error) {
          error.appendTo("#errores");//el mensaje se agrega en el elemento "#errores" con "appendTo"
        }
      });

//"addMethod" nos permite crear nuestras propias reglas de validación 
jQuery.validator.addMethod("mayorQue", function(value, element, param) {
return this.optional(element) || value > $(param).val();//En este caso creamos una validcación en caso de que la edad inicial sea mayor que la edad final
}, "<p align='center' class='text-danger'>Selecciona una edad mayor a la edad inicial </p>");
    $("#formulario").validate({
        rules: {
            edadFinal: {
              mayorQue: "#edadInicial"
            },
            fecha : {
              required: true
            }
        },
        messages: {
            edadFinal: {
              required: "<p align='center' class='text-danger'> Selecciona una edad mayor que la edad inicial </p>"
            },
            fecha: {
              required: "<p align='center' class='text-danger'>Selecciona una fecha </p>"
            }
        },
        submitHandler: function(){
          $('#container').html('<div align="center"><img src="../../images/formularios/cargando.gif"/><br><p class="text-info lead">Cargando...</p><br></div>');
            $.ajax({

                  type: "POST",
                  url: '../procesos/consultaEncuesta.php',
                  data: $('#formulario').serialize(),
                  success: function(data) {
                    document.getElementById('formGraficas').innerHTML='';
                    $('#formGraficas').fadeIn(5000).html(data);
                  }
             });
        }
    });
  });
    </script>
 
<style type="text/css">/*Esta hoja de estilos es para los checkBox*/
  input[type="checkbox"]{
    position: absolute;
    right: 9000px;
  }

  input[type="checkbox"] + label span:before{
    content: "\f096";
    font-family: "FontAwesome";
    speak: none;
    font-style: normal;
    font-weight: normal;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing:antialiased;
    width: 1em;
    display: inline-block;
    margin-right: 5px;
  }

  input[type="checkbox"]:checked + label span:before{
    content: "\f14a";
    color: #04B404;
    animation: effect 250ms ease-in;
  }
</style>



<script type="text/javascript">//Función que crea el calendario(DatePicker)
  $(document).ready( function () {
    $(".fecha").datepicker();
    $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: 'Anterior',
      nextText: 'Siguiente',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
      dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
      weekHeader: 'Sm',
      dateFormat: 'yy-mm-dd',
      firstDay: 7,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
        } );
      </script>
      <!--Finaliza Script de datepicker-->

      <script src="../../js/jquery.metisMenu.js"></script>
      <script src="../../js/custom.js"></script>

</body>
</html>
