<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>

  <title>Farmacia Sana Sana</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


  <!--sección de CSS-->
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/settings.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/animate.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/colors/green.css" media="screen" />
  <!-- / Termina sección de css-->

  <!--Inicia sección de JS-->
  <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="js/jquery.migrate.js"></script>
  <script type="text/javascript" src="js/modernizrr.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.fitvids.js"></script>
  <script type="text/javascript" src="js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
  <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
  <script type="text/javascript" src="js/jquery.appear.js"></script>
  <script type="text/javascript" src="js/count-to.js"></script>
  <script type="text/javascript" src="js/jquery.textillate.js"></script>
  <script type="text/javascript" src="js/jquery.lettering.js"></script>
  <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
  <script type="text/javascript" src="js/smooth-scroll.js"></script>
  <script type="text/javascript" src="js/skrollr.js"></script>
  <script type="text/javascript" src="js/jquery.parallax.js"></script>
  <script type="text/javascript" src="js/mediaelement-and-player.js"></script>
  <script type="text/javascript" src="js/jquery.slicknav.js"></script>
  <script type="text/javascript" src="js/style.changer.js"></script>   
  <!--Termina sección de JS-->
 
  <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

</head>

<body>

  <!-- Inicio del Body Container -->
  <div id="container">

    <!-- Inicio del header -->
    <header class="clearfix">
      <!-- Inicia  Logo y Navegación  -->
      <div class="navbar navbar-default navbar-top" role="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
          <div class="navbar-header">
            <!-- Comienza cambio de enlaces para moviles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
            <!-- Termina cambio de enlaces para moviles  -->
            <a class="navbar-brand" href="index.html">
              <img class="imageLogo" alt="" src="images/lOGO SANASANAREDUC.png"> 
            </a>
          </div>
          <div class="navbar-collapse collapse">
            
            <!-- Inicia barra de navegación -->
            <ul class="nav navbar-nav navbar-right">
              <li><a class="active" href="index.html">Inicio</a></li>
              <li><a href="about.html">Acerca de nosotros</a></li>
              <li><a href="promociones.html">Promociones</a></li>
              <li><a href="contact.html">Contacto</a></li>
              <li><a href="sucursales.php">Sucursales</a></li>
              <li><a href="login.html">Inicia sesión</a></li>
            </ul>
            <!-- Termina barra de navegación -->
          </div>
        </div>

        <!-- Inicia menu para moviles -->
        <ul class="wpb-mobile-menu">
          <li><a class="active" href="index.html">Inicio</a></li>
          <li><a href="about.html">Acerca de nosotros</a></li>
          <li><a href="promociones.html">Promociones</a></li>
          <li><a href="contact.html">Contacto</a></li>
          <li><a href="sucursales.php">Sucursales</a></li>
          <li><a href="login.html">Inicia sesion</a></li>
        </ul>
        <!-- Termina menu para moviles -->
      </div>
      <!-- Final de logo y navegación -->

    </header>
    <!-- Termina header -->

  <br>
<br>
<br>

<div class="modal-dialog modal-lg" role="document">     
      <div class="modal-content">
        <div class="modal-header">
          <h1 align="center" class="modal-title" id="tituloEncuesta">ENCUESTA</h1>
          <label class="col-md-5">Los campos marcados con * son obligatorios</label>
        </div>

        <div class="container-fluid"> 
          <!--Se modifico el form 15/01/2018 -->
          <form role="form" method="POST" id="formEncuesta" name="formEncuesta">
          <br>
          <div class="text-center" align="center">
              <!--EDAD DE LA PERSONA-->
              <div class="row">
              <div class="col-md-3"></div>
                <div class="col-md-2"><label>*EDAD:</label></div>
                <div class="col-md-3"><input type="number" min="1" max="99" name="edad" class="form-control" id="edad"></div>                
              </div>
              <br>
              <!--SEXO DE LA PERSONA-->
              <div class="row">          
                <div class="col-md-3"></div> 
                <div class="col-md-2"><label>*SEXO:</label></div>
                <div class="col-md-3">
                  <label class="radio-inline"><input type="radio" name="sexo" id="hombre" value="H">HOMBRE</label>
                  <label class="radio-inline"><input type="radio" name="sexo" id="mujer" value="M">MUJER</label>              
                </div>
              </div>
              <br>
              <!--SUCURSAL-->
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-2"><label>*SUCURSAL:</label></div>
                <div class="col-md-3">
                  <select name="sucursal" class="form-control" id="sucursal"><!--Se agreo esta select parte para poder seleccionar la sucursal-->
                    <?php 
                        require 'funciones/procesos/conexion.php';
                        $conex = Conexion::getInstance();
                        $consulta = $conex->consultar("select * from sucursales");
                        foreach ($consulta as $row) {
                          echo '<option value = "'.$row['nombreSucursal'].'" > '.$row['nombreSucursal'].' </option>';
                        }
                        $conex = null;
                    ?> 
                  </select>
                </div>            
              </div>
              <br>
            </div>
            <br>
            <!-- INSTRUCCIONES-->
            <div class="text-center row">
            <div class="col-md-2"></div>
              <div class="col-md-8"><label class="text-center">SELECCIONE LA OPCIÓN U OPCIONES CON LAS QUE MÁS SE IDENTIFIQUE</label></div>
            </div>
            <br>
            <!-- PREGUNTA 1-->
            <div class="text-inline row">
              <div class="col-md-2"></div>
              <div class="col-md-8"><label class="text-inline" name="uno" id="uno">*1. ¿HACE CUANTO TIEMPO HA ESTADO COMPRANDO PRODUCTOS EN NUESTRA SUCURSAL?</label></div>
            </div>  
            <!-- RADIO BUTTON -->
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <ol>
                  <li><div class="radio"><label><input type="radio" name="tiempoCompra" value=1>HACE MENOS DE 6 MESES</label></div></li>
                  <li><div class="radio"><label><input type="radio" name="tiempoCompra" value=2>DE 6 MESES A 1 AÑO</label></div></li>
                  <li><div class="radio"><label><input type="radio" name="tiempoCompra" value=3>MÁS DE 1 AÑO A 3 AÑOS</label></div></li>
                  <li><div class="radio"><label><input type="radio" name="tiempoCompra" value=4>MÁS DE 5 AÑOS</label></div></li>
                </ol>
              </div>
            </div>  
            <br>
            <!-- PREGUNTA 2-->
            <div class="text-inline row">
              <div class="col-md-2"></div>
              <div class="col-md-8"><label class="text-inline">*2. ¿CON QUE FRECUENCIA NOS COMPRA?</label></div>
            </div>  
            <!-- RADIO BUTTON -->
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <ol>
                  <li><div class="radio"><label><input type="radio" name="frecuenciaCompra" id="cadaSemana" value=1>CADA SEMANA</label></div></li>
                  <li><div class="radio"><label><input type="radio" name="frecuenciaCompra" id="cadaMes" value=2>CADA MES</label></div></li>
                  <li><div class="radio"><label><input type="radio" name="frecuenciaCompra" id="cadaTresMeses" value=3>CADA 3 MESES A 6 MESES</label></div></li>
                  <li><div class="radio"><label><input type="radio" name="frecuenciaCompra" id="masDeDosanos" value=4>UNA O DOS VECES AL AÑOS</label></div></li>
                </ol>
              </div>
            </div>  
            <br>
            <!-- PREGUNTA 3-->
            <div class="text-inline row">
            <div class="col-md-2"></div>
              <div class="col-md-8"><label class="text-inline">*3. ¿POR QUE PREFIERE COMPRAR EN FARMACIAS SANA SANA? (SELECCIONE MINIMO UNA)</label></div>
            </div>  

            <!-- CEHACKBOX PREGUNTA 3 -->
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <ol><!--En esta parte los chekBox se pusiron como arreglos para poder enviarlos-->      
                  <div class="checkbox"><label><input type="checkbox" name="preferencia[]" id="ubicacion" value=1>UBICACIÓN O CERCANIA</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="preferencia[]" id="calidad" value=2>CALIDAD DE SERVICIO AL CLIENTE</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="preferencia[]" id="precio" value=3>PRECIO</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="preferencia[]" id="surtido" value=4>SURTIDO</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="preferencia[]" id="recomendacion" value=5>RECOMENDACIÓN</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="preferencia[]" id="volante" value=6>LO VI EN EL VOLANTE</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="preferencia[]" id="web" value=7>LO VI EN LA WEB</label></div>
                </ol>
                </div>
            </div>              
            <br>

            <!-- PREGUNTA 4-->
            <div class="text-inline row">
              <div class="col-md-2"></div>
              <div class="col-md-8"><label class="text-inline">*4. ¿COMO NOS CALIFICARIA EN LOS SIGUIENTES ASPECTOS ?</label></div>
            </div>  
            <br>
            <!--RADIO SERVICIO AL CLIENTE-->
            <div class="row">
              <div class="col-md-2"> <label>SERVICIO AL CLIENTE</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="servicioCliente" id="servicioClienteMuyMalo" value=1>MUY MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="servicioCliente" id="servicioClienteMalo" value=2>MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="servicioCliente" id="servicioClienteRegular" value=3>REGULAR</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="servicioCliente" id="servicioClienteBueno" value=4>BUENO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="servicioCliente" id="servicioClienteMuyBueno" value=5>MUY BUENO</label></div>
            </div>  
            <br>
            <!--RADIO TIEMPO DE ESPERA-->
            <div class="row">
              <div class="col-md-2"> <label>TIEMPO DE ESPERA</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="tiempoEspera" id="tiempoEsperaMuyMalo" value=1>MUY MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="tiempoEspera" id="tiempoEsperaMalo" value=2>MALO</label></div>
              <div class="col-sm-2"> <label class="radio-inline"><input type="radio" name="tiempoEspera" id="tiempoEsperaRegular" value=3>REGULAR</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="tiempoEspera" id="tiempoEsperaBueno" value=4>BUENO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="tiempoEspera" id="tiempoEsperaMuyBueno" value=5>MUY BUENO</label></div>
            </div>
            <br>
            <!--RADIO IMAGEN GENERAL FARMACIA-->
            <div class="row">
              <div class="col-md-2"> <label>IMAGEN GENERAL FARMACIA</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="imagenGeneral" id="imagenGeneralMuyMalo" value=1>MUY MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="imagenGeneral" id="imagenGeneralMalo" value=2>MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="imagenGeneral" id="imagenGeneralRegular" value=3>REGULAR</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="imagenGeneral" id="imagenGeneralBueno" value=4>BUENO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="imagenGeneral" id="imagenGeneralMuyBueno" value=5>MUY BUENO</label></div>
            </div>  
            <br>
            <!--RADIO PERSONAL DE VENTA-->
            <div class="row">
              <div class="col-md-2"> <label>PERSONAL DE VENTA</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="personalVenta" id="personalVentaMuyMalo" value=1>MUY MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="personalVenta" id="personalVentaMalo" value=2>MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="personalVenta" id="personalVentaRegular" value=3>REGULAR</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="personalVenta" id="personalVentaBueno" value=4>BUENO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="personalVenta" id="personalVentaMuyBueno" value=5>MUY BUENO</label></div>
            </div>  
            <br>
            <!--RADIO PRECIO-->
            <div class="row">
              <div class="col-md-2"> <label>PRECIO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="precio" id="precioMuyMalo" value=1>MUY MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="precio" id="precioMalo" value=2>MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="precio" id="precioRegular" value=3>REGULAR</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="precio" id="precioBueno" value=4>BUENO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="precio" id="precioMuyBueno" value=5>MUY BUENO</label></div>
            </div>  
            <br>
            <!--RADIO SURTIDO-->
            <div class="row">
              <div class="col-md-2"> <label>SURTIDO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="surtido" id="surtidoMuyMalo" value=1>MUY MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="surtido" id="surtidoMalo" value=2>MALO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="surtido" id="surtidoRegular" value=3>REGULAR</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="surtido" id="surtidoBueno" value=4>BUENO</label></div>
              <div class="col-md-2"> <label class="radio-inline"><input type="radio" name="surtido" id="surtidoMuyBueno" value=5>MUY BUENO</label></div>
            </div>  
            <br>
            <!-- PREGUNTA 5 -->
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8"><label class="text-inline">*5. ¿CUÁL ES LA PROBABILIDAD DE QUE NOS RECOMIENDE?</label></div>
            </div>  
            <!-- rADIO BUTTON -->
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <ol>
                  <li><div class="radio"><label><input type="radio" name="probabilidadRecomendacion" id="probabilidadRecomendacionMuyProbable" value=1>MUY PROBABLE</label></div></li>
                  <li><div class="radio"><label><input type="radio" name="probabilidadRecomendacion" id="probabilidadRecomendacionAlgoProbable" value=2>ALGO PROBABLE</label></div></li>
                  <li><div class="radio"><label><input type="radio" name="probabilidadRecomendacion" id="probabilidadRecomendacionPocoProbable" value=3>ALGO POCO PROBABLE</label></div></li>
                  <li><div class="radio"><label><input type="radio" name="probabilidadRecomendacion" id="probabilidadRecomendacionMuyPocoProbable" value=4>MUY POCO PROBABLE</label></div></li>
                </ol>
              </div>
            </div>  
            <br>
            <!-- PREGUNTA 6 -->
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8"><label class="text-inline">*6. SELECCIONE EL ASPECTO QUE CONSIDERA DEBERIAMOS MEJORAR</label></div>
            </div>
            <!--checkbox aspectos a mejorar-->
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <ol><!--También se pusieron como arreglos en esta parte-->      
                  <div class="checkbox"><label><input type="checkbox" name="aspectoConsiderar[]" id="aspectoConsiderarServicioCliente" value=1>SERVICIO AL CLIENTE</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="aspectoConsiderar[]" id="aspectoConsiderarTiempoEspera" value=2>TIEMPO DE ESPERA</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="aspectoConsiderar[]" id="aspectoConsiderarImagenGeneral" value=3>IMAGEN GENERAL FARMACIA</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="aspectoConsiderar[]" id="aspectoConsiderarPersonalVenta" value=4>PERSONAL DE VENTAS</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="aspectoConsiderar[]" id="aspectoConsiderarPrecio" value=5>PRECIO</label></div>
                  <div class="checkbox"><label><input type="checkbox" name="aspectoConsiderar[]" id="aspectoConsiderarSurtido" value=6>SURTIDO</label></div>
                </ol>
              </div>
            </div>  
            <br>
            <!-- PREGUNTA 6 -->
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8"><label for="comentario">COMENTARIO:</label><label><span>0</span>/255</label><textarea class="form-control" maxlength="255" rows="5" id="comentario" name="comentario"></textarea></div>
            </div>

            <!--Inicia Contador de caracteres en la parte del comentario-->
            <script>
              var inputs = "textarea[maxlength]";
              $(document).on('keyup', "[maxlength]", function (e) {
                var este = $(this),
                currentCharacters = este.val().length;
                remainingCharacters = 0 + currentCharacters,
                espan = este.prev('label').find('span');            
                if (document.addEventListener && !window.requestAnimationFrame) {
                  if (remainingCharacters <= -1) {
                    remainingCharacters = 0;            
                  }
                }
                espan.html(remainingCharacters);  
              });
            </script>
            <!--Finaliza contador de caracteres-->

          </div><!-- fin ventana container-->
          <div class="modal-footer">
            <span class="error_label" name="errores" id="errores"></span> 
           <a href="index.html"> <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button></a>
            <button class="btn btn-success" id="btn_aceptar" name="btn_aceptar">ACEPTAR</button>      
          </div><!-- fin pie de la ventana modal-->
            </form> <!-- fin formulario-->

         
    <script>
    //Inician validaciones
    $(document).ready(function() {

       jQuery.validator.setDefaults({
        errorPlacement: function(error, element) {
          $("#errores").empty();
          error.appendTo("#errores");

        }
      });

    $("#formEncuesta").validate({
      rules: {
            tiempoCompra: { 
              required: true,
            },

            frecuenciaCompra: {
              required: true
            },

            servicioCliente: {
              required: true
            },

            tiempoEspera: {
              required: true
            },
            imagenGeneral: {
              required: true
            },
            personalVenta: {
              required: true
            },
            precio: {
              required: true
            },
            surtido: {
               required: true
            },
            probabilidadRecomendacion: {
              required: true
            },
            preferencia:{
              required: true, minlength: 1
            },
            aspectoConsiderar:{
              required: true, minlength: 1
            },
            edad:{
              required: true
            },
            sexo:{
              required: true
            },
            sucursal:{
              required: true
            }
          },
      messages: {
            tiempoCompra: { 
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            frecuenciaCompra: {
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },

            servicioCliente: {
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },

            tiempoEspera: {
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            imagenGeneral: {
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            personalVenta: {
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            precio: {
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            surtido: {
               required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            probabilidadRecomendacion: {
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            preferencia: {
             required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            aspectoConsiderar: {
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            edad:{
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            sexo:{
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            },
            sucursal:{
              required: "<p align='center' class='text-danger'> Completa la encuesta </p>"
            }

          },//Terminan validaciones
          submitHandler: function(){
            $.ajax({
                  type: "POST",
                  url: 'funciones/procesos/registrarEncuesta.php',
                  data: $('#formEncuesta').serialize(),
                  success: function(data) {
                    //alert(data);
                    if(data == 'error') {
                        swal({title: "¡Error!",text: "No se pudo registrar la encuesta, por favor intentelo mas tarde",   type: "error",closeOnConfirm: "Aceptar"});
                    } else {
                       swal({title: "¡Éxito!",text: "Encuesta realizada de manera exitosa",   type: "success",closeOnConfirm: "Aceptar"},
                        function(){
                          window.location.href='index.html';
                        });
                      //limpiarCajas();
                    }
                  }
             });
        }
    }); 
    }); 
    </script>
  </div><!-- fin contenido de la modal-->
</div><!-- fin tamaño modal-->

    <!-- Inicia footer -->
    <footer>
      <div class="container">
        <!--Inicia contenido de footer-->
        <div class="row footer-widgets">
          <div class="col-md-3">

            <!--Inicia contenido de redes sociales-->
            <div class="footer-widget social-widget">
              <h4>SIGUENOS EN: <span class="head-line"></span></h4>
              <ul class="social-icons">
                <li>
                  <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                </li>
              </ul>
            </div>
            <!--Termina contenido de redes sociales-->
          </div>

          <div class="col-md-3"></div>
          <div class="col-md-3"></div>


          <!--Inicia inofrmación adicional--> 
          <div class="col-md-3">
            <div class="footer-widget contact-widget">
              <ul>
                <li><span>¿Tienes alguna duda?</span></li>
                <li><span>Teléfono: 40-00-56-99, Ext. 7001, 7002, 7003.</span></li>
              </ul>
            </div>
          </div>
          <!-- / Termina inofrmación adicional -->
        </div>
        <!-- Termina contenido de footer -->

        <!-- Inicia sección de copyright -->
        <div class="copyright-section">
          <div class="row">
            <div class="col-md-6">
              <p>Copyright &copy; 2017 by <a href="http://www.farmaciassanasana.com.mx">Farmacias Sana Sana.</a>  All Rights Reserved.</p>
            </div>
          </div>
        </div>
        <!-- Termina sección de copyright -->
      </div>
    </footer>
    <!--/ Termina footer -->


  </div>
  <!-- End Full Body Container -->

  <!-- Go To Top Link -->
  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!--Inicio de loader-->
  <!--<div id="loader">
    <div class="spinner">
      <div class="f1078404_sup">
        <div class="f978404_petit">
          <div class="f1078404_fond">
            <div class="f1078404">              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>-->
  <!--Final de loader-->



  <script type="text/javascript" src="js/script.js"></script>

</body>

</html>