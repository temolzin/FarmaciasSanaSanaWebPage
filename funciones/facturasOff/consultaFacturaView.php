<!DOCTYPE html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farmacias Sana Sana</title>

    <!-- Bootstrap -->
    <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" />
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" href="../../css/font-awesome.min.css">
  	<link rel="stylesheet" href="../../css/animate.css">
  	<link href="../../css/prettyPhoto.css" rel="stylesheet">
    <link rel="stylesheet" href= "../../css/sweetalert.css">
  	<link href="../../css/style.css" rel="stylesheet" />	
    <script type="text/javascript">
     function limpiarCajas() {
         $(":text").each(function() {
            $($(this)).val('');
          });
         $('#email').each(function() {
            $($(this)).val('');
         });
         $('#mensaje').each(function() {
            $($(this)).val('');
         });
      }
       function soloLetras(e) {
          key = e.keyCode || e.which;
          tecla = String.fromCharCode(key).toLowerCase();
          letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
          especiales = [8, 37, 39, 46];
          tecla_especial = false;
          for (var i in especiales) {
            if (key == especiales[i]) {
              tecla_especial = true;
              break;
            }
          }
          if (letras.indexOf(tecla) == -1 && !tecla_especial)
             return false;
          }
          function soloNumeros(e)
          {
            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
              return true;
            return /\d/.test(String.fromCharCode(keynum));
          }
    </script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<header>		
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="navigation">
				<div class="container">					
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="navbar-brand">
							<a href="../../index.html"><h1><span>Farmacias Sana Sana</span></h1></a>
						</div>
					</div>
					
					<div class="navbar-collapse collapse">							
						<div class="menu">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation"><a href="../../index.html" class="active">Inicio</a></li>
								<li role="presentation"><a href="../../about.html">Acerca de Nosotros</a></li>						
								<li role="presentation"><a href="../../promociones.php">Promociones</a></li>
								<li role="presentation"><a href="../../contact.html">Contacto</a></li>
								<li role="presentation"><a href="../../login.html">Inicia Sesión</a></li>						
							</ul>
						</div>
					</div>						
				</div>
			</div>	
		</nav>		
	</header>

	<section id="main-slider">
  <div class="container">
    <div class="row">
    <br><br><br><br>
      <div class="box">
          <div class="col-md-6">
              <div align="center">
                <h1 style="color: black;" class="col-xs-12"><strong>Busca tu Factura</strong></h1>
				<p class="col-xs-12 text-info lead"> Si ya realizaste tu factura, busca aquí tu PDF y XML. </p><br>
              </div> <br>
                  <form id="formulario" method="POST" name="formulario">
                  <div class="col-md-12" align="center">
                    <font size="5" color="#000">Sucursal</font>
                    <select id="comboSucursal" name="comboSucursal" class="form-control">
                      <?php 
                        require '../procesos/conexion.php';
                          $conex = Conexion::getInstance();
                          $consulta = $conex->consultar("select * from sucursales");
                          foreach ($consulta as $row) {
                            echo '<option value = "'.$row['nombreDB'].'" > '.$row['nombreSucursal'].' </option>';
                          }
                          $conex=null;
                      ?> 
                    </select>
                    <a class="preview" href="../../images/factura/sucursal.png" rel="prettyPhoto"><i class="fa fa-eye"></i> Ayuda</a>
                   </div>
               
                   <br><br>
                   <div class="col-md-12" align="center">
                      <font size="5" color="#000">Número del Ticket</font>
                      <input type="text" name="numTicket" id="numTicket" onkeypress="return soloNumeros(event);" class="form-control"/>
                      <a class="preview" href="../../images/factura/ticket.png" rel="prettyPhoto"><i class="fa fa-eye"></i> Ayuda</a>
                   </div>
                   <br><br>
                   
                   <div class="col-md-12" align="center">
                     <button class="btn btn-default btn-lg">Aceptar</button>
                   </div>
                   </form>
          		</div>
                  <div class="col-md-6" align="center">
                  <br><br><br><br>

                    <br>
                   <div class="col-md-6" align="center" style="display:none" id="btnPDF" name="btnBuscar">
                      <button class="btn btn-danger btn-lg" value="pdf"><img width="18px" height="18px" src="../../images/formularios/pdf.png"> Descarga PDF</button>
                   </div>
                   <div class="col-md-6" style="display:none;" align="center" id="btnXML" name="btnXML">
                      <button class="btn btn-info btn-lg" value="xml"><img width="18px" height="18px" src="../../images/formularios/xml.png"> Descargar XML</button>
                   </div>

                    <div align="center" class="col-md-12 text-center" id="regresar" style="display:none;" name="regresar">
                        <a href="consultaFacturaView.php"><button class="btn btn-primary btn-lg">Regresar</button></a>
                    </div>

                    <div class="col-md-12" align="center" id="solicitaFactura" name="solitaFactura">
                      <font color="black" size="4">Sí aún no tienes una factura solicitala y te llegará vía correo electrónico, en un período máximo de 24 horas.</font><br /><br />
                      <font size="5" color="blue"><a style="color:blue;" href="consultaRFCView.php"><u>Solicita factura</u></a></font>
                    <br />
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <br>
            </div>
        </div>
    </div><!--/.carousel-->
    <br><br>
  </section><!--/#main-slider-->	

	<footer>
		<div class="footer">
			<div class="container">
				<div class="social-icon">
					<div class="col-md-4">
						<ul class="social-network">
							<li><a href="https://www.facebook.com/Farmacias-Sana-Sana-M%C3%A9xico-1620411704876862/" class="fb tool-tip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="https://twitter.com/SanaFarmacias" class="twitter tool-tip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
						</ul>	
					</div>
				</div>
				
				<div class="col-md-4 col-md-offset-4">
					<div class="copyright">
						Copyright &copy; 2016 by <a target="_blank" href="http://farmaciassanasana.com.mx/" title="Farmacias Sana Sana">Farmacias Sana Sana</a>. All Rights Reserved.
				</div>						
			</div>
			
			<div class="pull-right">
				<a href="#home" class="scrollup"><i class="fa fa-angle-up fa-3x"></i></a>
			</div>		
		</div>
	</footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="../../js/jquery-2.1.1.min.js"></script>	
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../../js/sweetalert.min.js"></script>
	<script src="../../js/jquery.prettyPhoto.js"></script>
    <script src="../../js/jquery.isotope.min.js"></script>  
	<script src="../../js/wow.min.js"></script>
	<script src="../../js/functions.js"></script>
	<script>
    $(document).ready(function() {
    $("#formulario").validate({
        rules: {
            numTicket: {
              required: true
            }
        },
        messages: {
            numTicket: {
              required: "<div align = 'center'><font size='2' color='red'> Ingresa un número de Ticket para buscar</font></div>"
            }
        },
        submitHandler: function(){
          $('#solicitaFactura').html('<img src="../../images/formularios/loading.gif"/><br><p class="text-danger lead">Cargando...</p><br>');
          document.getElementById('btnPDF').style.display = 'none';
          document.getElementById('btnXML').style.display = 'none';
          document.getElementById('regresar').style.display = 'none';
            $.ajax({
                  type: "POST",
                  url: 'consultaFactura.php',
                  data: $('#formulario').serialize(),
                  success: function(data) {
                     $("#btnPDF").unbind("click"); 
                     $("#btnXML").unbind("click"); 
                    if(data == 'error') {
                      swal({title: "¡Error!",text: "Su ticket no ha sido encontrado, por favor verifique sus datos, o comuniquese al 4000-5699 ext. 2002.",   type: "error",closeOnConfirm: "Aceptar"},
                        function(){
                          window.location.href='consultaFacturaView.php';
                        });
                      document.getElementById('regresar').style.display = 'block';
                      document.getElementById('btnPDF').style.display = 'none';
                      document.getElementById('solicitaFactura').innerHTML = '';
                      document.getElementById('btnXML').style.display = 'none';
                      document.getElementById('factura').style.display = 'none';
                    } else if(data == 'noFacturado'){
                      swal({title: "¡Aviso!",text: "Su ticket no ha sido facturado, en el siguiente formulario podrá solicitar su factura y en un período máximo de 24 hrs. le envíaremos su factura a su correo. Dudas: Comuniquese al 4000-5699 ext. 2002.",   type: "info",closeOnConfirm: "Aceptar"},
                        function(){
                          window.location.href='consultaRFCView.php';
                        });
                        document.getElementById('solicitaFactura').innerHTML = '';
                    } else{
                      document.getElementById('btnPDF').style.display = 'block';
                      document.getElementById('btnXML').style.display = 'block';
                      document.getElementById('regresar').style.display = 'block';
                      document.getElementById('solicitaFactura').style.display = 'none';
                     $("#btnPDF").bind("click",function(){ 
                        window.open(data+".pdf", "_blank");
                      }); 
                     $("#btnXML").bind("click",function(){ 
                        window.open(data+".xml", "_blank");
                     }); 
                   }
                  }
             });
        }
    });
  	});
    </script>
  </body>
</html>