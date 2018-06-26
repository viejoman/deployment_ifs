<?php
	include_once('../php/functions.php');
	date_default_timezone_set("America/Mexico_City");

session_start();

$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;

if ($login):
?>
<script>
	$(function(){
		$('.change').click(function(){
			$.post(
				'php/chagePass.php',
				{
					'do': 'it',
					'lastPass': $('#lastPass').val(),
					'newPass': $('#newPass').val()
				},
				function(r){
					if( r == 'success' ){
						$('#alerts').append(exito_p);
					}else{
						var errr = error_p.replace('{r}', r);
						$('#alerts').append(errr);
					}
				}
			);
		});
	});
</script>

		<form class="form-horizontal">
			<fieldset>
				<legend>Cambiar contraseña</legend>
				<div class="row">
					<div class="span5">
						<div class="control-group">
							<label class="control-label" for="lastPass">Antigua contraseña</label>
							<div class="controls">
								<input type="password" class="input-xlarge" id="lastPass" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="newPass">Nueva contraseña</label>
							<div class="controls">
								<input type="password" class="input-xlarge" id="newPass" />
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<button id="save" class="btn btn-success change finish">Cambiar</button>
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