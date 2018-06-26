<?php

include_once('lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
  
$_GET["option"] = 3;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>IFS México | Servicios</title>
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
				<h2 class="pageTitle">Servicios</h2>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
		<div class="container content">		
        <!-- Service Blcoks -->
        <div class="row service-v1 margin-bottom-40">
            <div class="col-md-4 md-margin-bottom-40">
               <img class="img-responsive" src="img/service1.png" alt="">   
                <h2>Consolidación y desconsolidación</h2>
                <p>Brindamos el servicio de consolidación de carga así como la desconsolidación de la misma, contamos con personal capacitado en los puertos, usamos los mejores almacenes, también contamos con las mejores tarifas de llegada de todo el mercado.</p>        
            </div>
            <div class="col-md-4">
                <img class="img-responsive" src="img/service2.png" alt="">            
                <h2>International Trucking México</h2>
                <p>Es el nombre de Nuestro servicio de consolidado terrestre, creado en el 2009 para satisfacer al 100% a nuestros clientes. A través de él podemos enviar mercancía a diferentes ciudades dentro del país desde Monterrey hacia el Norte de México.</p>        
            </div>
            <div class="col-md-4 md-margin-bottom-40">
              <img class="img-responsive" src="img/service3.png" alt="">  
                <h2>Asesoría</h2><br/>
                <p>Para complementar lo anterior contamos con servicios integrales para completar toda la logística de acuerdo a sus necesidades , como despachos aduanales, servicios aereos, etc.</p>        
            </div>
        </div>
                    
    </div>
    </section>

	<?php include_once("views/shared/LayoutFooter.php"); ?>	

</div>

<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<?php include_once("views/shared/LayoutScripts.php"); ?>

</body>
</html>