<?php
	include_once('../php/functions.php');
	date_default_timezone_set("America/Mexico_City");

session_start();

$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;

if ($login):
?>
<script>
	$(function(){
		$('.reg').click(function(){
			$.post(
				'php/newUser.php',
				{
					'do': 'it',
					'nombre': $('#nombre').val(),
					'username': $('#username').val(),
					'password': $('#password').val()
				},
				function(r){
					if( r == 'success' ){
						$('#alerts').append(exito_u);
					}else{
						var errr = error_u.replace('{r}', r);
						$('#alerts').append(errr);
					}
				}
			);
		});
	});
</script>

		<form class="form-horizontal">
			<fieldset>
				<legend>Nuevo usuario</legend>
				<div class="row">
					<div class="span5">
						<div class="control-group">
							<label class="control-label" for="nombre">Nombre Completo</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="nombre" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="username">Nombre de usuario</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="username" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="password">Contraseña</label>
							<div class="controls">
								<input type="password" class="input-xlarge" id="password" />
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<button id="save" class="btn btn-success reg finish">Crear usuario</button>
				<button id="save" class="btn btn-danger finish">Cancelar</button>
			</div>
		</form>
<?php
else:
?>
Debes iniciar sesión
<?php
endif;
?>