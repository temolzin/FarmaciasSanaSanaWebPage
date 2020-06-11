<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="../../js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.validate.js"></script>
    <script type="text/javascript" src="../../js/jquery-ui-1.9.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.prettyPhoto.js"></script>
    <script src="../../js/jquery.isotope.min.js"></script>  
	<script src="../../js/wow.min.js"></script>
	<script src="../../js/functions.js"></script>
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

    <title>Solicita tu factura</title>

    <!-- Bootstrap -->
    <link rel="shortcut icon" type="image/x-icon" href="../../favicon.ico" />
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../css/font-awesome.min.css">
	<link rel="stylesheet" href="../../css/animate.css">
	<link href="../../css/prettyPhoto.css" rel="stylesheet">
	<link href="../../css/style.css" rel="stylesheet" />	
	    <!-- SWEETALERT -->
	<link href="../../css/sweetalert.css" rel="stylesheet" />
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
	
	<br><br><br><br><br><br>
	<section>
        <div class="container">
            <div class="center">        
                <h2>Solicita tu Factura</h2>
                <p>Todos los datos con * son requeridos.</p>
            </div> 
            <div class="row contact-wrap"  id="principal" name="principal" > 
                <form id="formulario" class="contact-form" name="formulario" method="post">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                        	<label>* Ticket: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="preview" style="color:black;" href="../../images/factura/ticket.png" rel="prettyPhoto"><u>Ayuda</u></a></label> 
                            <input type="text" readonly="readonly" value="<?php echo $_SESSION['ticket']; ?>" placeholder="Número de Ticket" onkeypress="return soloNumeros(event);" id="ticket" name="ticket" class="form-control">
                        </div>  
                        <div class="form-group">
                            <label>* Sucursal: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="preview" style="color:black;" href="../../images/factura/sucursal.png" rel="prettyPhoto"><u>Ayuda</u></a></label>
                            <input type="text" id="sucursal" readonly="readonly" value="<?php echo $_SESSION['sucursal']; ?>" name="sucursal" class="form-control">
                        </div>  
                        <div class="form-group">
                            <label>* Tipo de pago: </label>
                            <input type="text" id="tipoPago" name="tipoPago" readonly="readonly" value="<?php echo $_SESSION['tipoPago']; ?>" class="form-control">
                        </div>  
	                    <div class="form-group">
                            <label>* RFC: </label>
                            <input type="text" value="<?php echo $_SESSION['rfc']; ?>" name="rfc" id="rfc" placeholder="RFC" class="form-control">
                        </div>
                    	<div class="form-group">
                            <label>* Nombre o Razón Social: </label>
                            <input type="text" value="<?php echo $_SESSION['nombre']; ?>" placeholder="Nombre o Razón Social" id="nombre" name="nombre" class="form-control">
                        </div> 
                     	<div class="form-group">
                            <label>CURP: </label>
                            <input type="text" placeholder="CURP" value="<?php echo $_SESSION['curp']; ?>" id="curp" name="curp" class="form-control">
                        </div>      
                        <div class="form-group">
                            <label>* Email:</label>
                            <input type="email" value="<?php echo $_SESSION['email']; ?>" placeholder="Email donde llegará la factura" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>* Teléfono:</label>
                            <input type="text" maxlength="10" onkeypress="return soloNumeros(event);"  value="<?php echo $_SESSION['telefono']; ?>" placeholder="Número de contacto" name="telefono" id="telefono" class="form-control">
                        </div>               
                    </div>
                    <div class="col-sm-5">
	                    <div class="form-group">
	                        <label>* Calle: </label>
	                        <input type="text" placeholder="Calle" value="<?php echo $_SESSION['calle']; ?>" id="calle" name="calle" class="form-control">
	                    </div>   
                        <div class="form-group">
                            <label>* # Exterior: </label>
                            <input type="text" value="<?php echo $_SESSION['numExterior']; ?>" placeholder="Número Exterior" id="numExterior" onkeypress="return soloNumeros(event);" name="numExterior" class="form-control">
                        </div>  
                        <div class="form-group">
                            <label># Interior: </label>
                            <input type="text" value="<?php echo $_SESSION['numInterior']; ?>" placeholder="Número Interior" id="numInterior" onkeypress="return soloNumeros(event);" name="numInterior" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>* País: </label>
                            <select placeholder="País" id="pais" name="pais" class="form-control">
                            	<option value="México" selected="selected">México</option>
                            </select>
                            <!--<input type="text" value="<?php echo $_SESSION['pais']; ?>" class="form-control">-->
                        </div> 
                        <div class="form-group">
                            <label>* Código Postal: </label>
                            <input type="text" value="<?php echo $_SESSION['codigoPostal']; ?>" placeholder="Escribe un Código Postal" onkeypress="return soloNumeros(event);" id="codigoPostal" name="codigoPostal" class="form-control">
                        </div> 
                        <div class="form-group">
                            <label>* Colonia: </label>
                            <select class="form-control" id="colonia"  name="colonia">
                            	<?php 
                            	require('../procesos/conexion.php');
								$conex = Conexion::getInstance();
								$sql = "select distinct asentamiento from codigosPostales where cp = ".$codPostal." order by asentamiento asc";
								/*foreach ($pdo->query($sql) as $row) {
									echo "<option value='".$row['asentamiento']."'>";
									echo $row['asentamiento'];
									echo "</option>";
								}*/
                            	if ($_SESSION['colonia'] != "") {
                            		echo "<option value='".$_SESSION['colonia']."' selected='selected'>".$_SESSION['colonia'];
                            	} else{
									echo "<option value='default' selected='selected'>Escribe tu Código Postal</option>";
                            	}
                            	echo "</option>";
                                $conex = null;
                            	?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label>* Delegación o municipio: </label>
                            <select class="form-control" id="municipio" name="municipio">
                            	<?php 
                            	if ($_SESSION['municipio'] != "") {
                            		echo "<option value='".$_SESSION['municipio']."' selected='selected'>".$_SESSION['municipio'];
                            	} else{
									echo "<option value='default' selected='selected'>Escribe tu Código Postal</option>";
                            	}
                            	echo "</option>";
                            	?>
                            </select>
                        </div> 
						<div class="form-group">
                            <label>* Ciudad: </label>
                            <select class="form-control" id="ciudad" name="ciudad">
                            	<?php 
                            	if ($_SESSION['ciudad'] != "") {
                            		echo "<option value='".$_SESSION['ciudad']."' selected='selected'>".$_SESSION['ciudad'];
                            	} else{
									echo "<option value='default' selected='selected'>Escribe tu Código Postal</option>";
                            	}
                            	echo "</option>";
                            	?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label>* Estado: </label>
                            <select placeholder="Estado" id="estado" name="estado" class="form-control">
                            	<?php 
                            	if ($_SESSION['estado'] != "") {
                            		echo "<option value='".$_SESSION['estado']."' selected='selected'>".$_SESSION['estado'];
                            	} else{
									echo "<option value='default' selected='selected'>Escribe tu Código Postal</option>";
                            	}
                            	echo "</option>";
                            	?>
                            </select>
                        </div>  
                        <div class="form-group" align="center">
                      		<button name="enviar" id="enviar" class="btn btn-primary btn-lg">Solicitar Factura</button>
                    	</div>                 
                    </div>   
                </form> 
	<script>
	$("#codigoPostal").change(function(){
        var codPostal = $('#codigoPostal').val();
        $.ajax({
	        type: "POST",
	        url: 'consultaCodigoPostal.php',
	        data: {"codigoPostal":codPostal},
	        success: function(data) {
	        	$("#colonia").html(data);
	        	$("#municipio").html("<option>Selecciona una Colonia</option>");
	        	$("#ciudad").html("<option>Selecciona una Colonia</option>");
	        	$("#estado").html("<option>Selecciona una Colonia</option>");
	        }
		});
    });
    $('#codigoPostal').keypress(function(e){   
        if(e.which == 13){      
            var codPostal = $('#codigoPostal').val();
	        $.ajax({
		        type: "POST",
		        url: 'consultaCodigoPostal.php',
		        data: {"codigoPostal":codPostal},
		        success: function(data) {
		        	$("#colonia").html(data);
		        	$("#municipio").html("<option>Selecciona una Colonia</option>");
		        	$("#ciudad").html("<option>Selecciona una Colonia</option>");
		        	$("#estado").html("<option>Selecciona una Colonia</option>");
		        }
			});   
        }   
    });

    $( "#colonia" ).change(function() {
		var colonia = $("#colonia option:selected").val();
		var codPostal = $('#codigoPostal').val();
	  	$.ajax({
	        type: "POST",
	        url: 'consultaCodigoPostal.php',
	        data: {"codPostalColonia":codPostal, "colonia":colonia},
	        success: function(data) {
	        	$("#municipio").html(data);
	        	$("#ciudad").html("<option>Selecciona un Municipio</option>");
	        	$("#estado").html("<option>Selecciona un Municipio</option>");
	        }
		});
	});
	
	$( "#municipio" ).change(function() {
		var municipio = $("#municipio option:selected").val();
		var codPostal = $('#codigoPostal').val();
	  	$.ajax({
	        type: "POST",
	        url: 'consultaCodigoPostal.php',
	        data: {"municipio":municipio, "codPostalMunicipio":codPostal},
	        success: function(data) {
	        	$("#ciudad").html(data);
	        	$("#estado").html("<option>Selecciona una Ciudad</option>");
	        }
		});
	});
	$( "#ciudad" ).change(function() {
		var ciudad = $("#ciudad option:selected").val();
		var codPostal = $('#codigoPostal').val();
		var municipio = $("#municipio option:selected").val();
	  	$.ajax({
	        type: "POST",
	        url: 'consultaCodigoPostal.php',
	        data: {"ciudad":ciudad, "codPostalCiudad":codPostal, "municipioCiudad":municipio},
	        success: function(data) {
	        	$("#estado").html(data);
	        }
		});
	});

	$(document).ready(function() {
	  $.validator.addMethod("validarComboVacio", 
      function(value, element, arg){ 
      return arg != value; }, 
      "<p class='text-danger'>Selecciona una opción</p>"); 
	    	$("#formulario").validate({
		        rules: {
		        	ticket: {
		              required: true,
		              remote: {
					    url: "validarTicket.php",
					    type: "post",
					    data: {
						   	sucursal: function() {
		                   	return $("#sucursal").val();
		                },
		                    ticket: function() {
		                    return $("#ticket").val();
		                    }
				        }
				      }
		            },
		            nombre: {
		              required: true
		            },
		            numExterior: {
		              required: true
		            },
	            	email: {
	            		required: true,
	             		email: true
	            	},
		            calle: {
		              required: true
		            },
		            rfc: {
		              required: true
		            },
		            colonia: {
		              validarComboVacio: "default"
		            },
		            municipio: {
		              validarComboVacio: "default"
		            },
		            ciudad: {
		              validarComboVacio: "default"
		            },
		            estado: {
		              validarComboVacio: "default"
		            },
		            pais: {
		              validarComboVacio: "default"
		            },
		            codigoPostal: {
		              required: true
		            }
		    },
	        messages: {
	            nombre: {
	              required: "<p align='center' class='text-danger'> * Ingresa nombre o razón social</p>"
	            }, 
	            rfc: {
	              required: "<p align='center' class='text-danger'> * Ingresa un RFC</p>"
	            },
	            email: {
	              required: "<p align='center' class='text-danger'> * Debes ingresar una cuenta de correo.</p>",
	              email: "<p align='center' class='text-danger'> * Ingresa un Email correcto </p>"
	            },
	            calle: {
	              required: "<p align='center' class='text-danger'> * Ingresa una calle</p>"
	            },
	            colonia: {
	              required: "<p align='center' class='text-danger'> * Ingresa una colonia</p>"
	            },
	            municipio: {
	              required: "<p align='center' class='text-danger'> * Ingresa un municipio</p>"
	            },
	            pais: {
	              required: "<p align='center' class='text-danger'> * Ingresa un País</p>"
	            },
	            codigoPostal: {
	              required: "<p align='center' class='text-danger'> * Ingresa un Código Postal</p>"
	            },
	            ciudad: {
	              required: "<p align='center' class='text-danger'> * Ingresa una Ciudad</p>"
	            },
	            estado: {
	              required: "<p align='center' class='text-danger'> * Ingresa un Estado</p>"
	            },
	            ticket: {
	              required: "<p align='center' class='text-danger'> * Ingresa tu Ticket de Compra</p>",
	              remote: "<p align='center' class='text-danger'> Número de Ticket no Válido, consulta a la sucursal</p>" 
	            },
	            numExterior: {
	              required: "<p align='center' class='text-danger'> * Ingresa un Número Exterior</p>"
	            }
        	},
	        submitHandler: function(){
	        	document.getElementById('cargando').style.display = 'block';
	        	document.getElementById('principal').style.display = 'none';
	  	        $.ajax({
	        	      type: "POST",
	                  url: 'enviarMailInsertarFactura.php',
	                  data: $('#formulario').serialize(),
	                  success: function(data) {
	                    if(data == 'error') {
	                        swal({title: "¡Error!",text: "Ha ocurrido un error al enviar el formulario, por favor intentalo más tarde.", type: "error",closeOnConfirm: "Aceptar"},
	                        	function(){
		                          window.location.href='../../index.html';
		                        });
	                        limpiarCajas();
	                    } else if(data == 'errorActualizacion') {
	                        swal({title: "¡Error Actualización!",text: "Ha ocurrido un error al enviar el formulario, por favor intentalo más tarde.", type: "error",closeOnConfirm: "Aceptar"},
	                        	function(){
		                          window.location.href='../../index.html';
		                        });
	                        limpiarCajas();
	                    } else if(data == 'errorCorreoEnviado') {
	                        swal({title: "¡Error!",text: "Tú solicitud ya ha sido envíada anteriormente, si no has recibido respuesta en máximo 48 hrs. marcanos. 40-00-56-99, Ext. 7001, 7002, 7003.", type: "error",closeOnConfirm: "Aceptar"},
	                        	function(){
		                          window.location.href='../../index.html';
		                        });
	                        limpiarCajas();
	                    }
	                    else {
	                       swal({title: "¡Éxito!",text: "Tu mensaje se ha enviado correctamente, tendrás una contestación en un máximo de 24 horas a tu email registrado.", type: "success",closeOnConfirm: "Aceptar"},
	                       	function(){
	                          window.location.href='../../index.html';
	                        });
	                      limpiarCajas();
	                  }
					}
	             });
	        }
	    });
	  });
    </script>
            </div><!--/.row-->
                <div style="display:none" id="cargando" name="cargando">
                	<div align="center"><img src="../../images/principal/Cargando.gif"/><br><p class="text-info lead">Cargando...</p><br></div>
                </div>
        </div><!--/.container-->
    </section><!--/#contact-page-->
	<br><br><br><br><br><br>

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
  </body>
</html>