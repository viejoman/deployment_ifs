<?php
date_default_timezone_set('America/Mexico_City');
include_once('lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
  
$_GET["option"] = 5;

$GLOBALS['DEBUG_MODE'] = 0;
$GLOBALS['ct_recipient']   = 'info@ifsmexico.com';
$GLOBALS['ct_password']   = 'InfoIfsmexico1';
$GLOBALS['ct_msg_subject'] = 'Cotizacion enviada desde el portal IFS Mexico';

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>IFS M&eacute;xico  | Cotizaci&oacute;n</title>
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
				<h2 class="pageTitle">Cotizaci&oacute;n</h2>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
		<div class="container content">		
            
            <div class="row" style="margin-bottom: 0px;"> 
				<div class="col-md-12">
					<div class="about-logo">
						<h3>Envianos tu cotizaci&oacute;n</h3>
						<p>Una operadora se hara cargo de tu solicitud y te contestaremos en la brevedad posible.</p>
					</div>
								
				</div>
			</div>
												         
            <?php

			process_si_contact_form(); // Process the form, if it was submitted
			
			if (isset($_SESSION['ctform']['error']) &&  $_SESSION['ctform']['error'] == true): /* The last form submission had 1 or more errors */ ?>			
			<h4>
				<i class="fa fa-warning text-red"></i>
				Se present&oacute; un problema con los datos de envio. Por favor valide los comentarios en rojo.
			</h4>
			
			<?php elseif (isset($_SESSION['ctform']['success']) && $_SESSION['ctform']['success'] == true): /* form was processed successfully */ ?>
			<div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">Ã—</button>
                    <h4>	<i class="icon fa fa-check"></i> Cotizaci&oacute;n Enviada!</h4>
			Gracias por utilizar nuestro servicio en l&iacute;nea.</div>
			<?php endif; ?>
            
            <hr>
            
            <div class="contact-form">
                <div class="row">
				<form  method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']) ?>" id="contact-form" role="form" novalidate="novalidate">
                <input type="hidden" name="do" value="cotizacion" />
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Nombre*</label>
                       			<?php echo @$_SESSION['ctform']['name_error'] ?>
						        <input type="text" class="form-control" id="ct_nombre" name="ct_nombre" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_name']) ?>" >                            					
					</div>
					<div class="form-group">
						<label for="email">Email*</label>
                         <?php echo @$_SESSION['ctform']['email_error'] ?>
						<input type="email" class="form-control" id="ct_email" name="ct_email" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_email']) ?>" >
                             
					</div>
					<div class="form-group">
						<label for ="subject">Cargo*</label>
                        <?php echo @$_SESSION['ctform']['cargo_error'] ?>
    						<input type="text" class="form-control" id="ct_cargo" name="ct_cargo" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_cargo']) ?>" >
					</div>
                    <div class="form-group">
						<label for="subject">Tel&eacute;fono*</label>
                        <?php echo @$_SESSION['ctform']['telefono_error'] ?>
						<input type="text" class="form-control" id="ct_telefono" name="ct_telefono" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_telefono']) ?>" >
						
					</div>
                    <div class="form-group">
						<label for="subject">Estado</label>                                               
						    <input type="text" class="form-control" id="ct_estado" name="ct_estado" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_estado']) ?>" >						
					</div>
                    <div class="form-group">
						<label for="subject">N&uacute;mero de bultos</label>                                                  
						<input type="text" class="form-control" id="ct_numbultos" name="ct_numbultos" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_numbultos']) ?>" >						
					</div>
                    <div class="form-group">
						<label for="subject">Volumen m<sup>3</sup></label>
                        <input type="text" class="form-control" id="ct_volumen" name="ct_volumen" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_volumen']) ?>" >						
					</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
						<label for="name">Direcci&oacute;n</label>
						<input type="text" class="form-control" id="ct_direccion" name="ct_direccion" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_direccion']) ?>" >
					</div>
					<div class="form-group">
						<label for="email">Empresa</label>                        
						<input type="email" class="form-control" id="ct_empresa" name="ct_empresa" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_empresa']) ?>" >	
					</div>
					<div class="form-group">
						<label for="subject">Giro</label>
						<input type="text" class="form-control" id="ct_giro" name="ct_giro" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_giro']) ?>" >		
					</div>
                        <div class="form-group">
						<label for="subject">Ciudad</label>
						<input type="text" class="form-control" id="ct_ciudad" name="ct_ciudad" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_ciudad']) ?>" >	
					</div>
					<div class="form-group">
						<label for="subject">Pa&iacute;s</label>
						<input type="text" class="form-control" id="ct_pais" name="ct_pais" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_pais']) ?>" >		
					</div>
                        <div class="form-group">
						<label for="subject">Peso Mercanc&iacute;a</label>
						<input type="text" class="form-control" id="ct_pesomcia" name="ct_pesomcia" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_pesomcia']) ?>" >		
					</div>
                        <div class="form-group">
						<label for="subject">Tipo Mercanc&iacute;a</label>
						<input type="text" class="form-control" id="ct_tipomcia" name="ct_tipomcia" placeholder="" value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_tipomcia']) ?>" >	
					</div>

                        </div>
						<div class="col-md-4">
                         <div class="form-group">
						    <label for="message">Comentarios* <?php echo @$_SESSION['ctform']['message_error'] ?></label>
						    <textarea class="form-control" rows="6" id="ct_comentarios" name="ct_comentarios" placeholder=""><?php echo htmlspecialchars(@$_SESSION['ctform']['ct_message']) ?></textarea>
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
                        
                        <input type="submit" value="Enviar Cotizaci&oacute;n" class="btn">
					
                        </div>
				</form>
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
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'cotizacion') {
  	
    foreach($_POST as $key => $value) {
      if (!is_array($key)) {
      	// Limpiar datos del formulario
        if ($key != 'ct_comentarios') $value = strip_tags($value);
        $_POST[$key] = htmlspecialchars(stripslashes(trim($value)));
      }
    }

    $nombre 	= @$_POST['ct_nombre']; /* Requerido */
    $email 		= @$_POST['ct_email']; /* Requerido */
    $cargo 		= @$_POST['ct_cargo']; /* Requerido */
	$telefono 	= @$_POST['ct_telefono']; /* Requerido */
	$estado 	= @$_POST['ct_estado'];
	$numbultos 	= @$_POST['ct_numbultos'];
	$volumen 	= @$_POST['ct_volumen'];
	$direccion 	= @$_POST['ct_direccion'];
	$empresa 	= @$_POST['ct_empresa'];
	$giro 		= @$_POST['ct_giro'];
	$ciudad 	= @$_POST['ct_ciudad'];
	$pais 		= @$_POST['ct_pais'];
	$pesomcia 	= @$_POST['ct_pesomcia'];
	$tipomcia 	= @$_POST['ct_tipomcia'];
    $message 	= @$_POST['ct_comentarios'];
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

      //Valida el cargo
      if (strlen($cargo) == 0) {
        $errors['cargo_error'] = 'El Cargo es un dato requerido';
      }
      
      //Valida el telefono
      if (strlen($telefono) == 0) {        
        $errors['telefono_error'] = 'El Tel&eacute;fono es un dato requerido';
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
      $message = "Cotizaci&oacute;n solicitada desde el portal de IFS M&eacute;xico. Se enviaron los siguientes datos:<br /><br />"
                    . "<em>Nombre: $nombre</em><br />"
                    . "<em>Email: $email</em><br />"
                    . "<em>Cargo: $cargo</em><br />"
                    . "<em>Empresa: $empresa</em><br />"
                    . "<em>Giro: $giro</em><br />"
                    . "<em>Direcci&oacute;n: $direccion</em><br />"
                    . "<em>Ciudad: $ciudad</em><br />"
                    . "<em>Estado: $estado</em><br />"
                    . "<em>Pa&iacute;s: $pais</em><br />"
                    . "<em>Tel&eacute;fono: $telefono</em><br />"
                    . "<em>N&uacute;mero de Bultos: $numbultos</em><br />"
                    . "<em>Volumen: $volumen</em><br />"
                    . "<em>Peso Mercanc&iacute;a: $pesomcia</em><br />"
                    . "<em>Tipo Mercanc&iacute;a: $tipomcia</em><br />"                        		
                    . "<em>Comentarios:</em><br />"
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
      	
      	$oMail = new cEnvioMail($sTo,$sFrom,$sSubject, 'IFS Cotizaciones Online');
      	$oMail->authenticateSmtp($GLOBALS['ct_recipient'],$GLOBALS['ct_password']);
      	
      	//$oMail->agregarCC('arturorascon@mdf.ifsneutral.com', 'Regional Manager'); Ya no labora en IFS México
      	$oMail->agregarCC('victortapia@mdf.ifsneutral.com', 'Export Manager');
      	$oMail->agregarCC('carlosrios@mdf.ifsneutral.com', 'Sales Executive');
      	$oMail->agregarBcc('jennybuenrostro@gmail.com', 'Import Executive');
      	
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

      $_SESSION['ctform']['ct_name'] 		= $nombre;       	// Almacena nombre para presentar los datos en el formulario
      $_SESSION['ctform']['ct_email'] 		= $email;     		// Almacena email
      $_SESSION['ctform']['ct_cargo'] 		= $cargo;     		// Almacena cargo
      $_SESSION['ctform']['ct_telefono'] 	= $telefono;     	// Almacena telefono
      $_SESSION['ctform']['ct_estado'] 		= $estado;     		// Almacena estado
      $_SESSION['ctform']['ct_volumen'] 	= $volumen;     	// Almacena volumen
      $_SESSION['ctform']['ct_numbultos'] 	= $numbultos;     	// Almacena numbultos      
      $_SESSION['ctform']['ct_direccion'] 	= $direccion;     	// Almacena direccion
      $_SESSION['ctform']['ct_empresa'] 	= $empresa;     	// Almacena empresa
      $_SESSION['ctform']['ct_giro'] 		= $giro;     		// Almacena giro
      $_SESSION['ctform']['ct_ciudad'] 		= $ciudad;     		// Almacena ciudad
      $_SESSION['ctform']['ct_pais'] 		= $pais;     		// Almacena pais
      $_SESSION['ctform']['ct_pesomcia'] 	= $pesomcia;     	// Almacena pesomcia
      $_SESSION['ctform']['ct_tipomcia'] 	= $tipomcia;     	// Almacena tipomcia      
      $_SESSION['ctform']['ct_message'] 	= $message; 		// Almacena message

      foreach($errors as $key => $error) {
        $_SESSION['ctform'][$key] = "<small class=\"label pull-right bg-red\">$error</small>";
      }

      $_SESSION['ctform']['error'] = true;
      
    }
  } // POST
}

$_SESSION['ctform']['success'] = false;

?>

</body>
</html>
