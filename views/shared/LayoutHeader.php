<?php
date_default_timezone_set('America/Mexico_City');
//include_once('../../lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';

$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

$arrayDias = array( 'Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'); 

$_opcion = isset($_GET["option"]) ? $_GET["option"] : 1;
    
?>

<header>
        <div class="navbar navbar-default navbar-static-top navbar-banner-ifs" style="height: 115px;">
            <div class="container" style="background-image: url('img/___fabrica/banner_main_menu.png'); background-position:right top; background-repeat: no-repeat">
                <!--
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>                    
                </div>
                -->                

					<div class="navigation">
						<nav>
						<ul class="nav topnav bold">
							<li class="dropdown <?php echo ($_opcion == 1 ? "active" : ""); ?>">
							<a href="index.php"><?php echo $label[$lang]['menu']['home']; ?></a>							
							</li>
							<li class="dropdown <?php echo ($_opcion == 2 ? "active" : ""); ?>">
							<a href="acercade.php"><?php echo $label[$lang]['menu']['about']; ?></a>							
							</li>
							<li class="dropdown <?php echo ($_opcion == 3 ? "active" : ""); ?>">
							<a href="servicios.php"><?php echo $label[$lang]['menu']['services']; ?></a>							
							</li>
							<li class="dropdown <?php echo ($_opcion == 4 ? "active" : ""); ?>">
							<a href="http://ifsversoftcargo.dyndns.biz/tracking/index.asp?id=1"><?php echo $label[$lang]['menu']['tracking']; ?></a>							
							</li>
							<li class="dropdown <?php echo ($_opcion == 5 ? "active" : ""); ?>">
							<a href="#"><?php echo $label[$lang]['menu']['online']; ?><i class="fa fa-angle-down"></i></a>
							<ul class="dropdown-menu bold">
                                <!--<li><a href="itinerarios.php">Itinerarios</a></li>-->
                                <li><a href="iten/index.php">Itinerarios</a></li>
                                <!--<li><a href="rutas.php">Rutas</a></li>-->                                
								<li><a href="cotizacion.php">Cotizaci&oacute;n</a></li>								                                							
							</ul>
							</li>
							<li class="dropdown <?php echo ($_opcion == 6 ? "active" : ""); ?>">
							    <a href="#"><?php echo $label[$lang]['menu']['contact']; ?> <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu bold">
                                <!--<li><a href="itinerarios.php">Sugerencias</a></li>-->
                                <!--<li><a href="rutas.php">Contacto</a></li>-->
                                <li><a href="directorio.php">Directorio</a></li>								
							</ul>
							</li>
						</ul>
						</nav>
					</div>
					<!-- end navigation -->

                    <div class="row" style="margin-bottom: 0px; margin-top: 75px; text-align: right; color: #fff;">
                        <?php echo $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');?>
                    </div>
            </div>
        </div>
	</header>
<!--
<section id="fecha" style="background-color: #000;">
	<div class="container" style="background-color: #000; color: #fff; text-align: right">
        <?php echo $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');?>
        </div>
    </section>-->
