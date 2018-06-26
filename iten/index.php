<?php

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
	header('location: index.php');
endif;

if(isset($_GET['logout'])):
	$user->logout();
	header('location: index.php');
endif;

if (!$login):
	//nologin
	$menu = <<<EOPAGE
			<a class="login btn" data-toggle="modal" href="#login">
				<i class="icon-user"></i>
				  Iniciar sesi&oacute;n
			</a>
EOPAGE;
	$script = <<<EOPAGE
			$('.modal').modal('hide');
			$('#dologin').click(function(e){
				e.preventDefault();
				$('#loginn').submit();
			});
EOPAGE;
	$modal = <<<EOPAGE
	<div class="modal fade" id="login">
		<div class="modal-header">
			<button class="close" data-dismiss="modal">x</button>
			<h3>Iniciar sesi&oacute;n</h3>
		</div>
		<div class="modal-body">
			<form id="loginn" action="#" method="post" class="form-horizontal">
				<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on">
								<i class="icon-user"></i>
							</span>
							<input type="text" class="input-xlarge" name="user" placeholder="Usuario" />
						</div>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on">
								<i class="icon-lock"></i>
							</span>
							<input type="password" class="input-xlarge" name="pass" placeholder="Contrase&ntilde;a" />
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<a data-toggle="modal" href="#login" class="btn">Cancelar</a>
			<a id="dologin" class="btn btn-success">Iniciar</a>
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
					<i class="icon-user"></i>
					{$username}
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a class="newUser" href="#">Nuevo usuario</a></li>
					<li><a class="changePass" href="#">Cambiar contrase&ntilde;a</a></li>
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
					<li><a class="newExp" href="#">Exportaci&oacute;n</a></li>
					<li><a class="newImp" href="#">Importaci&oacute;n</a></li>
				</ul>
			</div>
EOPAGE;
	$script = <<<EOPAGE
			//--[new]
			$('.newImp').live('click', function(){
				newIten('imp');
			});
			$('.newExp').live('click', function(){
				newIten('exp');
			});
			$('.newUser').live('click', function(){
				$('#newIten').html('<h6>Cargando ...</h6>')
					.load('apps/newUser.php');
			});
			$('.changePass').live('click', function(){
				$('#newIten').html('<h6>Cargando ...</h6>')
					.load('apps/changePass.php');
			});

			$('.edit').live('click',function(e){
				e.preventDefault();
				var rel = $(this).attr('rel');
				$('#newIten').html('<h6>Cargando ...</h6>')
					.load('apps/edit.php?id=' + rel);
			});
			$('.delete').live('click',function(e){
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
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Itinerarios</title>

	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/datepicker.css">
	<link rel="stylesheet/less" href="css/default.less">

	<script src="js/jquery.js"></script>
	<script src="js/less.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/functions.js"></script>
	<script>
		jQuery(function(){
			listIten();

			$('.btn').live('click', function(e){
				e.preventDefault();
			})
			//--[list]
			$('.listImp').live('click', function(){
				expimp = 'imp';
				listIten();
			});
			$('.listExp').live('click', function(){
				expimp = 'exp';
				listIten();
			});
			<?php echo $script; ?>

			$('.refresh').live('click', function(){
				listIten();
			});
			//--[Buscar]
			$('.search').live('click',function(){
				if ( $('#search').val() == ""){ $('#search').val('main,void'); }
				var _search = $('#search').val().split(',');
					f = _search[0];
					s = _search[1];
					listIten();
			});
			$('#search').popover({
				'placement': 'right',
				'content': 'Para buscar un itinerario en especifico, solo tienes que escribir el dato que quieres buscar seguido de una coma y el valor que quieres buscar, por ejemplo:<br /><br /><strong>origen,valencia</strong>',
				'title': '�Como buscar?'
			});
			$('#search').typeahead({
				source: [
					'origen', 'destino', 'puerto', 'buque', 'salida', 'cierredoc', 'cierredesp', 'frecuencia', 'transito', 'conexiones', 'mes', 'main'
				],
				items: 4
			});
			$('#search').keypress(function(e){
				if( e.keyCode == 13 ){
					$('.search').trigger('click');
				}
			});
			//--[Navegar meses]
			$('#fmes').datepicker()
				.on('changeDate', function(){
					var _da = $('#fmes').data('date'),
						datee = n2month(_da);
					$('.cmes').text( datee );
					$('#fmes').datepicker('hide');
					m = _da.split('-')[1];
					y = _da.split('-')[2];
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

			$('.finish').live('click', function(){
				$('#newIten').html('');
			});

			/////////////////////////////////////////////////////////////////////////

			<?php echo $viewiten; ?>

			$('.view').live('click',function(e){
				e.preventDefault();
				var rel = $(this).attr('rel');
				$('#newIten').html('<h6>Cargando ...</h6>')
					.load('apps/view.php?id=' + rel);
			});
		});
	</script>
</head>
<body>

	<div class="container">
		<h1><a href="../">IFS México</a> Itinerarios</h1>

		<div class="btn-toolbar">
			<div class="btn-group" data-toggle="buttons-radio">
				<button class="listExp btn active">Exportación</button>
				<button class="listImp btn">Importación</button>
			</div>
			<div class="input-append">
				<input class="span3" type="text" id="search" /><button id="buscar" class="btn search" type="button"><i class="icon-search"></i></button>
			</div>
			<button class="btn refresh" title="Recargar tabla">
				<i class="icon-refresh"></i>
			</button>
			<div class="btn-group">
				<button class="btn bm" title="Mes anterior"><i class="icon-chevron-left"></i></button>
				<button id="fmes" class="btn" title="Selecciona un mes del calendario" data-date="<?php echo date("j-m-Y"); ?>" data-date-format="d-mm-yyyy">
					<i class="icon-calendar"></i>
					<span class="cmes"><?php $m = date("m");  echo format_mes($m); ?></span>
					<span class="caret"></span>
				</button>
				<button class="btn nm" title="Mes siguiente"><i class="icon-chevron-right"></i></button>
			</div>
			<?php echo $nuevo ?>
			<?php echo $menu ?>
			<a href="apps/exportarExcel.php"><img src="img/table-excel-icon.png" border="0" /> Descargar XLS</a>
		</div>

		<div id="alerts"></div>
		<div id="newIten"></div>
		<div id="listIten"></div>

		<!-- <button class="btn btn-large" style="display: block; width: 30%; margin: auto; margin-bottom: 10px;"><i class=" icon-plus-sign"></i> Ver mas</button> -->
		<footer>
			<h6>Power by <a href="//dannegm.com" target="_blank" title="Ir a la web del autor">Dannegm</a> &copy; 2012</h6>
		</footer>
<?php echo $modal; ?>
	</div>

</body>
</html>