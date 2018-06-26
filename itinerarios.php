<?php

include_once('lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';

$_GET["option"] = 5;

include_once('config.php');
include_once('php/functions.php');
include_once('class/user.php');


$user = new User ();

session_start();
$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;

$menu = ""; $nuevo = ""; $script = ""; $formlogin = ""; $modal = "";


if(isset($_POST['user']) && isset($_POST['pass'])):
	$user->setUser($_POST['user']);
	$user->login($_POST['pass']);
	$_SESSION['user'] = $_POST['user'];
	header('location: itinerarios.php');
endif;

if(isset($_GET['logout'])):
	$user->logout();
	header('location: itinerarios.php');
endif;

if (!$login):
	//nologin
	$menu = <<<EOPAGE
			<a class="login btn btn-default" data-toggle="modal" href="#login">
				<i class="icon-user"></i>
				  Iniciar sesión
			</a>
EOPAGE;
	$script = <<<EOPAGE
			$('.modal').modal('hide');
			
			
			$('#login').on('show.bs.modal', function (e) {
			  $('#msg-login').html('');
			 
			})
			
			$('#dologin').click(function(e){
				e.preventDefault();
			
				if ($('#user').val() != '' && $('#pass').val() != '') { 		
					$('#loginn').submit();
				} else
				{
					$('#msg-login').html('Verifique que el usuario y contraseña sean validos.');
				}
			});
EOPAGE;
	$modal = <<<EOPAGE
	<div class="modal modal-primary fade" id="login">

    <div class="modal-dialog"  style="width: 380px;">
                <div class="modal-content">

		<div class="modal-header">			
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h3>Iniciar sesión</h3>
		</div>
		<div class="modal-body">
            
            <div class="login-box-body">
			<form id="loginn" action="itinerarios.php" method="post" class="form-horizontal">
				<div class="form-group has-feedback">
                    <input class="form-control" id="user" name="user" type="text" placeholder="Usuario">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
				<div class="form-group has-feedback">
                    <input class="form-control" id="pass" name="pass" type="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
			</form>
            </div>
			<div id="msg-login" >&nbsp;</div>
		</div>
		
		<div class="modal-footer">
			<a id="closeLogin" class="btn btn-default" data-dismiss="modal">Cerrar</a><a id="dologin" class="btn btn-success">Iniciar</a>
		</div>

        </div>
        </div>

	</div>
EOPAGE;
else:

	$user->setUser($_SESSION['user']);
	$username = $user->consult('nombre');
	//login
	$menu = <<<EOPAGE
			<div class="btn-group">
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user"></i>
					{$username}
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a class="newUser" href="#">Nuevo usuario</a></li>
					<li><a class="changePass" href="#">Cambiar contraseña</a></li>
					<li class="divider"></li>
					<li><a class="" href="?logout">Salir</a></li>
				</ul>
			</div>
EOPAGE;
	$nuevo = <<<EOPAGE
			<div class="btn-group">
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="icon-file"></i>
					Nuevo
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a class="newExp" href="#">Exportación</a></li>
					<li><a class="newImp" href="#">Importación</a></li>
				</ul>
			</div>
EOPAGE;
	$script = <<<EOPAGE

			$('.newImp').on('click', function(){
				newIten('imp');
			});

			$('.newExp').on('click', function(){
				newIten('exp');
			});

			$('.newUser').on('click', function(){
				$('#newIten').html('<h6>Cargando ...</h6>')
					.load('apps/newUser.php');
			});

			$('.changePass').on('click', function(){
				$('#newIten').html('<h6>Cargando ...</h6>')
					.load('apps/changePass.php');
			});

			$('.edit').on('click',function(e){
				e.preventDefault();
				var rel = $(this).attr('rel');
				$('#newIten').html('<h6>Cargando ...</h6>')
					.load('apps/edit.php?id=' + rel);
			});

			$('.delete').on('click',function(e){
				e.preventDefault();
				var rel = $(this).attr('rel');
				$('#newIten').html('<h6>Cargando ...</h6>')
					.load('apps/delete.php?id=' + rel);
			});
EOPAGE;

endif;


$view = isset($_GET['view']) ? $_GET['view'] : 'none';
$viewiten = "";
if ($view != 'none'){
	$viewiten = <<<EOPAGE
			$('#newIten').html('<h6>Cargando ...</h6>')
				.load('apps/view.php?id={$view}');
EOPAGE;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>IFS México | Itinerarios</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://ifsmexico.com" />
<!-- css -->

<?php 
 
require_once("views/shared/LayoutCSS.php"); 
 
?>
<!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">-->

<!-- DATA TABLES -->
<link href="js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/datepicker.css" rel="stylesheet" type="text/css" />

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

<![endif]-->

<?php include_once("views/shared/LayoutScripts.php"); ?>



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
				<h2 class="pageTitle">Itinerarios</h2>
			</div>
		</div>
	</div>
	</section>    
	<section id="content">
		<div class="container content">		                                                  
            
            <div class="row" style="margin-bottom: 10px;">
				<div class="col-lg-12">		
					<p><i class="glyphicon glyphicon-info-sign text-blue"></i>
					Para buscar un itinerario en especifico, solo tienes que escribir el dato que quieres 
					buscar seguido de una coma y el valor que quieres buscar, por ejemplo: 
					<strong>origen,valencia</strong></p>
				</div>
                <div class="col-xs-3" style="width: 220px; padding-right: 0px;">
                        <div class="btn-group">
                             <button id="importacion-btn" class="btn btn-default">
                                    Importacion
                            </button>
                            <button id="exportacion-btn" class="btn btn-default active">
                                    Exportacion
                            </button>                                                       
                        </div>
                </div><!--col-->
                <div class="col-xs-4" style="padding-left: 0px; padding-right: 0px;">
                    
                            <input id="buscariten-btn" class="form-control" type="text" placeholder="Buscar Itinerario">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                           
                    
                </div>
                <div class="col-xs-1" style="padding-right: 0px; width: 50px;">                    
                              <div class="btn-group">
                            
                            <button id="reload-btn" class="btn btn-default" data-toggle="tooltip" data-original-title="Recargar tabla">
                                <i class="fa fa-refresh"></i>
                            </button>
                                  </div>
                </div>
                <div class="col-xs-2" style="padding-right: 0px; width: 180px;">                    
                              <div class="btn-group">
                            
                                  
                            <button class="btn btn-default bm" data-toggle="tooltip" data-original-title="Mes Anterior">
                                <i class="fa fa-chevron-left"></i>
                            </button>
                            <button id="fmes" class="btn btn-default" data-toggle="tooltip" data-original-title="Selecciona un Mes del calendario" data-date="<?php echo date("j-m-Y"); ?>" data-date-format="d-mm-yyyy">
                            <i class="fa fa-calendar"></i>
                            <span class="cmes"><?php $m = date("m");  echo format_mes($m); ?></span>
                            <i class="fa fa-caret-down"></i>
                            </button>
                            <button class="btn btn-default nm" data-toggle="tooltip" data-original-title="Mes Siguiente">
                                <i class="fa fa-chevron-right"></i>
                            </button>
                        </div>                                      
                    </div>
                <!--col-->
                <!--<div class="col-xs-1" style="padding-left: 15px;">                                      
                    <a href="#login" data-toggle="modal">
                           <button id="inciosesion-btn" class="btn btn-default btn-sm">
                               
                                <i class="fa fa-user"></i> Iniciar Sesión
                                
                            </button>
                    </a>
                </div>
                -->
                <?php echo $nuevo ?>
			    <?php echo $menu ?>
            </div>

            <div id="alerts"></div>
            <div id="newIten" style="padding-bottom: 15px;"></div>

            <div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-body">
                                                                                                
                        <div id="listIten"></div>

                    </div>
                  </div>
                </div>
            </div>

        </div>
    </section>
    
    
          
	<?php include_once("views/shared/LayoutFooter.php"); ?>	

	
	<?php echo $modal; ?>
	
</div>



<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

    <!-- javascript================================================== -->
    
    <!-- <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>-->
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <!-- <script src="js/typeahead.js" type="text/javascript"></script>-->
    <!-- DATA TABES SCRIPT -->
    <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="js/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

    <script src="js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="js/functions.js" type="text/javascript"></script>   

    <script>
		jQuery(function(){

			listIten();

			$('#daterange-btn').on('click', function(e){
				e.preventDefault();
			})

			//--[list]
			$('#importacion-btn').on('click', function(){
				expimp = 'imp';
				listIten();
			});
			$('#exportacion-btn').on('click', function(){
				expimp = 'exp';
				listIten();
			});

			<?php echo $script; ?>

			$('#reload-btn').on('click', function(){
				listIten();
			});
		
        	//--[Buscar]
        	/*
			$('#buscariten-btn').on('click',function(){
				if ( $('#buscariten-btn').val() == ""){ $('#buscariten-btn').val('main,void'); }
				var _search = $('#buscariten-btn').val().split(',');
					f = _search[0];
					s = _search[1];
					listIten();
			});
			*/

        	/*
			$('#buscariten-btn').popover({
				'placement': 'right',
				'content': 'Para buscar un itinerario en especifico, solo tienes que escribir el dato que quieres buscar seguido de una coma y el valor que quieres buscar, por ejemplo:<br /><br /><strong>origen,valencia</strong>',
				'title': '¿Cómo buscar?'
			});
			*/			
            
			$('#buscariten-btn').typeahead({
				source: [
					'origen', 'destino', 'puerto', 'buque', 'salida', 'cierredoc', 'cierredesp', 'frecuencia', 'transito', 'conexiones', 'mes', 'main'
				],
				minLength: 4,
				hint: true,
				highlight: true
			});
			
            /*
			$('#buscariten-btn').keypress(function(e){
				if( e.keyCode == 13 ){
					$('#buscariten-btn').trigger('click');
				}
			});
			*/
          
			//--[Navegar meses]
			$('#fmes').datepicker()
				.on('changeDate', function(){
					var _da = $('#fmes').data('date'),
						datee = n2month(_da);
					$('.cmes').text( datee );
					$('#fmes').datepicker('hide');
					m = _da.split('-')[1];
                    nDia = _da.split('-')[0];
					listIten();
		    });

			$('.nm').click(function(){
				m = parseInt(m) +1;
				if( m < 10 ){ m = '0' + m; }
				var _da = '00-' + m + '-00', datee = n2month(_da);
				$('.cmes').text( datee );
				listIten();
			});

			$('.bm').click(function(){
				m = parseInt(m) -1;
				if( m < 10 ){ m = '0' + m; }
				var _da = '00-' + m + '-00', datee = n2month(_da);
				$('.cmes').text( datee );
				listIten();
			});

			$('[title]').tooltip({'placement':'top'});

			$('.finish').on('click', function(){
				$('#newIten').html('');
			});            		

			<?php echo $viewiten; ?>
                                
		    });

	</script>
   
    <script type="text/javascript">
      $(function () {       
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>    

</body>
</html>
