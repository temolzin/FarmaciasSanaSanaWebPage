<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">

<head>
  <title>Sucursales</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/colors/green.css" media="screen" />
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />


  <!-- JS  -->
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



  <!-- Google Maps -->
  <style>
    #google-map,
    body,
    html {
      padding: 0;
      height: 400px;
    }
  </style>
  <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>

<body>
  <!--Pestañas de redes sociales-->
  <div class="cont_pestanias">
    <a href="https://www.facebook.com/Farmacias-Sana-Sana-Gpo-Santoyo-189978141135355/" target="_blank">
      <div class="facebookPestania">
        <img src="images/logo_sociales/facebook_78404.png" border="0"/>
      </div>
    </a>
    <a href="https://twitter.com/SanaFarmacias" target="_blank">
      <div class="twitterPestania">
        <img src="images/logo_sociales/twitter_78404.png" border="0"/>
      </div>
    </a>
  </div>
  <!--Final de pestañas de redes sociales-->

  <!-- Container -->
  <div id="container">

    <!-- Start Header -->
    
    <header class="clearfix">

       <!-- Start Header ( Logo & Naviagtion ) -->
      <div class="navbar navbar-default navbar-top" role="navigation" data-spy="affix" data-offset-top="50">
        <div class="container">
          <div class="navbar-header">
            <!-- Stat Toggle Nav Link For Mobiles -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
            <!-- End Toggle Nav Link For Mobiles -->
            <a class="navbar-brand" href="index.html"><img alt="" src="images/lOGO SANASANAREDUC.png"></a>
          </div>
          <div class="navbar-collapse collapse">
            
            <!-- Start Navigation List -->
            <ul class="nav navbar-nav navbar-right">
              <li><a href="index.html">Inicio</a>
              </li>
              <li><a href="about.html">Acerca de nosotros</a>
              </li>
              <li><a href="promociones.html">Promociones</a> 
              </li>
              <li><a href="contact.html">Contacto</a>
              </li>
              <li><a class="active" href="sucursales.php">Sucursales</a>
              </li>
              <li><a href="login.html">Inicia Sesión</a>
              </li>
            </ul>
            <!-- End Navigation List -->
          </div>
        </div>

        <!-- Mobile Menu Start -->
        <ul class="wpb-mobile-menu">
          <li><a href="index.html">Inicio</a>
          </li>
          <li><a href="about.html">Acerca de nosotros</a>
          </li>
          <li><a href="promociones.html">Promociones</a>
          </li>
          <li><a href="contact.html">Contacto</a>
          </li>
          <li><a class="active" href="sucursales.php">Sucursales</a>
          </li>
          <li><a href="login.html">Inicia sesión</a>
          </li>
        </ul>
        <!-- Mobile Menu End -->

      </div>
      <!-- End Header ( Logo & Naviagtion ) -->

    </header>
    <!-- End Header -->

    <!-- Start Content -->

    <!-- End content -->

<div class="map">
      <!--<div class="center">        
            <h2>Nuestras Tiendas</h2>
            <p>Busca la sucursal más cercana.</p>
        </div>--> 
        <div class="col-md-4"></div>
        <div class="col-md-4" align="center">
            <h1 style="color: #00923f; text-transform: uppercase; font-weight:400; font-size: 24px">Sucursal</h1>
            <br>  
            <select id="comboSucursal" name="comboSucursal" class="form-control">
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
        <div id="mapa" name="mapa">
          <br><br><br><br><br><div id="direccionSucursal" align="center" name="direccionSucursal">Sucursal Ceda Ecatepec Patente <br>
direccion: Av.Central Nave E517 Colonia Santa Cruz Venta de Carpio, Ecatepec de Morelos
Estado de Mexico C.P. 55065 <br>Tel. 40005699<br>
      Sucursal: Ceda Ecatepec 512 Genericos<br>
      Dirección:Central de Abastos Nave E Local 512 colonia Santa Cruz Venta de Carpio, Ecatepec de Morelos
      Estado de Mexico C.P.55065 <br>Tel. 40005699</div>
      <br><br><br>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3758.2463497670497!2d-99.00602468572563!3d19.616763039850593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDM3JzAwLjMiTiA5OcKwMDAnMTMuOCJX!5e0!3m2!1ses-419!2sco!4v1474127129219" width="600" height="450" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe>
    </div>
  </div>
  <script>
  $(document).ready(function() {
      $("#comboSucursal").change(function() {
        $('#mapa').html('<br><br><br><br><br><div align="center"><img src="images/principal/Cargando.gif"/><br><p class="text-info lead">Cargando...</p><br></div>');
          $.ajax({
              type: "POST",
              url: 'funciones/procesos/consultarMapa.php',
              data: $('#comboSucursal').serialize(),
              success: function(data) {
                if(data == 'error') {
                    $('#mapa').html("<h1 align='center' class='text-danger'>Ha ocurrido un error interno, por favor intentelo más tarde.</h1>");
                } else {
                    $('#mapa').html(data);
                }
            }
          });
      });
});
    </script>

<!-- Start Footer Section -->
    <footer>
      <div class="container">
<div class="row footer-widgets">

<div class="col-md-3">

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
</div>

<div class="col-md-3">
</div>



<div class="col-md-3">

</div>



<div class="col-md-3">
<div class="footer-widget contact-widget">
<p></p>
<ul>
<li><span>¿Tienes alguna duda?</span></li>
<li><span>Teléfono: 40-00-56-99, Ext. 7001, 7002, 7003.</span></li>
</ul>
</div>
</div>


</div>


<div class="copyright-section">
<div class="row">
<div class="col-md-6">
<p>Copyright &copy; 2017 by <a href="http://www.farmaciassanasana.com.mx">Farmacias Sana Sana.</a>  All Rights Reserved.</p>
</div>
</div>
</div>

</div>    </footer>
    <!-- End Footer Section -->

  </div>
  <!-- End Container -->

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
  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?v=3.expsensor=false">
  </script>

</body>

</html>