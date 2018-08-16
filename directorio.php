<?php
date_default_timezone_set('America/Mexico_City');
include_once('lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
  
$_GET["option"] = 8;

$GLOBALS['DEBUG_MODE'] = 0;
$GLOBALS['ct_recipient']   = 'info@ifsmexico.com';
$GLOBALS['ct_password']   = 'InfoIfsmexico1';
$GLOBALS['ct_msg_subject'] = 'Contacto desde el portal IFS Mexico';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>IFS M&eacute;xico  | Directorio</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://ifsmexico.com" />
<!-- css -->
<?php require_once("views/shared/LayoutCSS.php"); ?>
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body class="layout-boxed">
<div id="wrapper" class="layout-boxed">

	<!-- start header -->
    <?php require_once("views/shared/LayoutHeader.php"); ?>
    <!-- end header -->
	<section id="inner-headline-servicios">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Directorio</h2>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
		<div class="container content">		
            <div class="contact-form">
                <div class="row">
				
				    <div class="col-md-6">
                        <div class="box" style="margin-bottom: 0px;">     
                        	<div class="box-header">
			                  <h3 class="box-title">Oficinas del Grupo IFS M&eacute;xico</h3>
			                </div>                       
                            <div class="box-body">
        					   <img src="img/___fabrica/ubicacion_oficinas_ifs.png" alt="IFS México" />
                            </div>
                        </div>
                        <a name="contactanos">&nbsp;</a>
                        <div class="box contacto"> 
                        	
                        	<div class="box-header">
			                  <h3 class="box-title">Contacta con nosotros</h3>
			                </div>                                                                       
                                                   
                            <div class="box-body">
        					   
        					   Deseas conocer sobre alguno de nuestros servicios, enviar retroalimentación o resolver tus dudas. 
        					   Puedes hacerlo a trav&eacute;s del formulario o marc&aacute;ndonos directamente.				   
        					   <?php

								process_si_contact_form();
								
								if (isset($_SESSION['ctform']['error']) &&  $_SESSION['ctform']['error'] == true):  ?>			
								<h4>
									<i class="fa fa-warning text-red"></i>
									Se present&oacute; un problema con los datos de envio. Por favor valide los comentarios en rojo.
								</h4>
								
								<?php elseif (isset($_SESSION['ctform']['success']) && $_SESSION['ctform']['success'] == true):  ?>
								<div class="alert alert-success alert-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								<h4>
									<i class="icon fa fa-check"></i> Notificaci&oacute;n Enviada!
								</h4>
									Gracias por utilizar nuestro servicio en l&iacute;nea.</div>
								<?php endif; ?>
					            
					            <hr>
        					   
        					   <div class="contact-form">
										<form method="post" id="contact-form" role="form" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']) ?>#contactanos" novalidate="novalidate">
										
										<input type="hidden" name="do" id="do"  value="contactanos" />
										
										    <div class="form-group">
											    <label>Nombre* :</label>
											    <?php echo @$_SESSION['ctform']['name_error'] ?>
												<div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-user"></i>
							                      </div>
							                      <input type="text" name="ct_nombre" id="ct_nombre" class="form-control" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_nombre']) ?>" >
							                    </div>
						                    </div>
											<div class="form-group">
												<label>Email* :</label>
												<?php echo @$_SESSION['ctform']['email_error'] ?>
												<div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-envelope"></i>
							                      </div>
							                      <input type="text" name="ct_email" id="ct_email" class="form-control" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_email']) ?>" >
							                    </div>
											</div>
											<div class="form-group">
												<label>Asunto* :</label>
												<?php echo @$_SESSION['ctform']['subject_error'] ?>
												<div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-navicon"></i>
							                      </div>
							                      <input type="text" name="ct_subject" id="ct_subject" class="form-control" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_subject']) ?>" >
							                    </div>
											</div>
											<div class="form-group">
												<label for="message">Mensaje* :</label>
												<?php echo @$_SESSION['ctform']['message_error'] ?>
												<textarea class="form-control" name="ct_mensaje" id="ct_mensaje" rows="6" id="message" name="message" placeholder=""><?php echo htmlspecialchars(@$_SESSION['ctform']['ct_mensaje']) ?></textarea>												
											</div>
											
											<div class="form-group">
											    <?php
					
											      require_once 'incl/captcha/securimage/securimage.php';
											      $options = array();
											      $options['input_name'] = 'ct_captcha';
												  $options['input_text'] = 'Introduzca el Texto :';
											      if (!empty($_SESSION['ctform']['captcha_error'])) {
											        $options['error_html'] = $_SESSION['ctform']['captcha_error'];
											      }
											
											      echo Securimage::getCaptchaHtml($options);
											    ?>
										    </div>
											
											<input type="submit" value="Enviar" class="btn">
										</form>
									</div>
        					   
        					   
        					   <!--  -->
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        
                        <div class="row" style="margin-bottom: 0px;">
                            <div class="col-xs-12">
                                <h2 class="page-header" style="padding-bottom: 0px; border-bottom-width: 0px;">
                                    <i class="fa fa-globe"></i>
                                    Contactos de la oficina:
                                   <span class="pull-right">
                                    <select id="cmbOficina" name="cmbOficina" class="form-control">                                    	
			                            <option value="1" selected>Veracruz, Ver.</option>
			                            <option value="2">Cd. de M&eacute;xico</option>
			                            <option value="5">Manzanillo, Col.</option>
			                            <option value="3">Altamira, Tamps.</option>
			                            <option value="4">Monterrey, Nvo. L&eacute;on</option>
			                            <option value="6">Guadalajara, Jal.</option>
										<option value="7">Quer&eacute;taro, Qro.</option>
										<option value="8">Aeropuerto Intl. de la Cd. de M&eacute;xico</option>
			                        </select>
                                    </span>
                                </h2>
                            </div>
                        </div>

                        <div id="directorio-body" style="padding-top: 15px;">
                        	&nbsp;
                       	</div>                      
                        
                    </div>									
                    </div>
			</div>
             
        </div>
    </section>
 
	<?php include_once("views/shared/LayoutFooter.php"); ?>	
	
</div>

<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<?php 
include_once("views/shared/LayoutScripts.php"); 

function process_si_contact_form()
{
	$_SESSION['ctform'] = array(); // Inicalizar los datos del formulario setteados en _SESSION

	// Valida que exista el POST del formulario
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'contactanos') {
		 
		foreach($_POST as $key => $value) {
			if (!is_array($key)) {
				// Limpiar datos del formulario
				if ($key != 'ct_mensaje') $value = strip_tags($value);
				$_POST[$key] = htmlspecialchars(stripslashes(trim($value)));
			}
		}

		$nombre 	= @$_POST['ct_nombre']; /* Requerido */
		$email 		= @$_POST['ct_email']; /* Requerido */
		$subject	= @$_POST['ct_subject']; /* Requerido */		
		$message 	= @$_POST['ct_mensaje'];
		$captcha 	= @$_POST['ct_captcha']; // Codigo Captcha registrado por el usuario.
		$nombre 	= substr($nombre, 0, 64);  // Se limita el nombre a 64 caracteres

		$errors = array();  // Inicializa el arrego de Errores

		// Se validan los datos si el DEBUG_MODE esta setteado en false
		if (isset($GLOBALS['DEBUG_MODE']) && $GLOBALS['DEBUG_MODE'] == false) {

			//Valida el nombre
			if (strlen($nombre) < 3) {
				$errors['name_error'] = 'El Nombre es un dato requerido';
			}

			//Valida el email
			if (strlen($email) == 0) {
				$errors['email_error'] = 'El Email es dato requerido';
			} else if ( !preg_match('/^(?:[\w\d-]+\.?)+@(?:(?:[\w\d]\-?)+\.)+\w{2,4}$/i', $email)) {

				$errors['email_error'] = 'El Email no es un formato valido';
			}

			//Valida el telefono
			if (strlen($subject) == 0) {
				$errors['subject_error'] = 'El Asunto es un dato requerido';
			}

			//Valida los comentarios
			if (strlen($message) < 20) {
				$errors['message_error'] = 'La longitud del mensaje tiene que ser mayor a 20 caracteres';
			}
		}

		// Valida el texto captcha introducido por el cliente
		if (sizeof($errors) == 0) {
			require_once 'incl/captcha/securimage/securimage.php';
			$securimage = new Securimage();

			if ($securimage->check($captcha) == false) {
				$errors['captcha_error'] = 'C&oacute;digo de seguridad incorrecto.<br />';
			}
		}

		// Se verifica que no existan errores en el arreglo
		if (sizeof($errors) == 0) {
			$time       = date('r');
			$message = "Notificaci&oacute;n enviada desde el portal de IFS M&eacute;xico. Se enviaron los siguientes datos:<br /><br />"
					. "<em>Nombre: $nombre</em><br />"
					. "<em>Email: $email</em><br />"
					. "<em>Asunto: $subject</em><br />"
					. "<em>Mensaje:</em><br />"
					. "<pre style=\"font-size: 12px\">$message</pre>"
					. "<br /><br /><em>Direcci&oacute;n IP:</em> {$_SERVER['REMOTE_ADDR']}<br />"
					. "<em>Fecha:</em> $time<br />"
					. "<em>Browser:</em> {$_SERVER['HTTP_USER_AGENT']}<br />";

      	//$message = wordwrap($message, 70);

		if (isset($GLOBALS['DEBUG_MODE']) && $GLOBALS['DEBUG_MODE'] == false) {
    
							// TODO: Enviar Correo

		require_once 'class/cEnvioMail.php';

		$sTo = 'auximpo@ver.ifsneutral.com';
		$sFrom = $GLOBALS['ct_recipient'];
		$sSubject = $GLOBALS['ct_msg_subject'];
															 
      	$oMail = new cEnvioMail($sTo,$sFrom,$sSubject, 'IFS Contactos Online');
      	$oMail->authenticateSmtp($GLOBALS['ct_recipient'],$GLOBALS['ct_password']);
      	    
      	$oMail->agregarCC('jennybuenrostro@gmail.com','Auxiliar de Importacion');
      	//$oMail->agregarCC('rodolfo.ortiz.mtz@gmail.com','Tester');
      			 
      	$sImg = $oMail->agregarImgBody("/home/ifsmexic/public_html/img/logo.ifsmexico.min.png", 'logo.ifsmexico.min.png');
      			 
      			$sMensaje = "";
      			$sMensaje = "<font face=\"fixedsys\" style=\"color:#3333CC;\">[".date("d/m/Y H:i:s")."] ".$message."</font><br />";
      					$sMensaje = $sMensaje."<br />
      					<div align=\"center\">
				<p style=\"color: #3333CC; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;
				font-weight: bold;\">Notificaci&oacute;n IFS M&eacute;xico<br />
				".$sImg."<br />
				</div>";
      	$oMail->agregarContenido($sMensaje);
      	$oMail->enviar();
    
      }

      $_SESSION['ctform']['timetosolve'] = $securimage->getTimeToSolve();
      $_SESSION['ctform']['error'] = false;  // no hay errores en el formulario
	  $_SESSION['ctform']['success'] = true; // envio de mensaje OK

	} else {

		$_SESSION['ctform']['ct_nombre'] 	= $nombre;       	// Almacena nombre para presentar los datos en el formulario
		$_SESSION['ctform']['ct_email'] 	= $email;     		// Almacena email
		$_SESSION['ctform']['ct_subject']	= $subject;     	// Almacena cargo														
		$_SESSION['ctform']['ct_mensaje'] 	= $message; 		// Almacena message

		foreach($errors as $key => $error) {
			$_SESSION['ctform'][$key] = "<small class=\"label pull-right bg-red\">$error</small>";
		}

		$_SESSION['ctform']['error'] = true;

		}
	} // POST
}

$_SESSION['ctform']['success'] = false;


?>

<script src="js/demo.js" type="text/javascript"></script>

<script>
		$(function () {
			listDirectorio(1);
		});
	</script>

</body>
</html>
