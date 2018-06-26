<?php
	include_once('../php/functions.php');
	date_default_timezone_set("America/Mexico_City");

session_start();

$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;

if ($login):
?>
<script>
	$(function(){
		$('#mess').popover({
			'placement': 'bottom',
			'content': 'Sea cual sea la fecha que elijas, solo guardaremos el mes.'
		});
		$('.input-prepend').popover({
			'placement': 'right',
			'content': 'Da click en el icono del calendario para cambiar la fecha.',
			'title': 'Cambiar fecha'
		});
		$('#origen').popover({
			'placement': 'right',
			'content': 'Para mayor comodidad, este campo te ayudará a establecer el país de origen ó destino ya que si algo está mal escrito, el mapa no funcionará correctamente.',
			'title': 'Autocompletado'
		});


		$('#mess').datepicker()
			.on('changeDate', function(){
				var _da = $('#mess').data('date'),
					datee = n2month(_da);
				$('#mess').text( datee );
				$('#mess').datepicker('hide');
			});

		$('#date1').datepicker()
			.on('changeDate', function(){
				var _da = $('#date1').data('date'),
					datee = format_date(_da);
				$('#salida').val( datee );
				$('#date1').datepicker('hide');
			});

		$('#date2').datepicker()
			.on('changeDate', function(){
				var _da = $('#date2').data('date'),
					datee = format_date(_da);
				$('#cierredoc').val( datee );
				$('#date2').datepicker('hide');
			});

		$('#date3').datepicker()
			.on('changeDate', function(){
				var _da = $('#date3').data('date'),
					datee = format_date(_da);
				$('#cierredesp').val( datee );
				$('#date3').datepicker('hide');
			});

		$('.reg').click(function(){
			$.post(
				'php/newIten.php',
				{
					'do': 'it',
					'mes': $('#mess').data('date'),
					'expimp': 'exp',
					'origen': 'null',
					'destino': $('#origen').val(),
					'puerto': $('#puerto').val(),
					'buque': $('#buque').val(),
					'salida': $('#date1').data('date'),
					'cierredoc': $('#date2').data('date'),
					'cierredesp': $('#date3').data('date'),
					'frecuencia': $('#frecuencia').val(),
					'transito': $('#transito').val(),
					'conexiones': $('#conexiones').val()
				},
				function(r){
					if( r == 'success' ){
						listIten();
						$('#alerts').append(exito);
					}else{
						var errr = error.replace('{r}', r);
						$('#alerts').append(errr);
					}
				}
			);
			$('input, textarea').val('');
		});

		$('#origen').typeahead({
			source: [
				'USA'
				, 'Cartagena'
				, 'Callao'
				, 'Brasil'
				, 'Uruguay'
				, 'Buenos Aires'
				, 'Inglaterra'
				, 'España'
				, 'Rotterdam'
				, 'Amberes'
				, 'Italia'
				, 'India'
				, 'Quingdao'
				, 'Shanghai'
				, 'Tianjin'
				, 'Taiwan'
				, 'Hong Kong'
				, 'Sudáfrica'
				, 'Marruecos'
				, 'Egipto'
				, 'Australia'
				, 'Panamá'
				, 'Rio Haina'
				, 'Buenaventura'
				, 'Guayaquil'
				, 'Valparaiso'
				, 'Barcelona'
				, 'Montevideo'
				, 'Miami'
				, 'San Jose'
				, 'Colon'
				, 'Santos'
				, 'Port Everglades'
				, 'Istambul'
				, 'Valencia'
				, 'Hamburto'
				, 'Milan'
				, 'Lisboa'
				, 'Thamesport'
				, 'Busan'
				, 'Yokohama'
				, 'Port Klang'
				, 'Singapore'
				, 'Kaoshiung'
				, 'Keelung'
				, 'Ningbo'
				, 'Quingdao'				
				, 'Shenzhen'
			],
			items: 4
		});
	});
</script>

		<form class="form-horizontal">
			<fieldset>
				<legend>Nuevo itinerario de <em>Exportación</em> del mes de <span id="mess" class="badge badge-info" title="Cambiar mes" data-date="<?php echo date("j-m-Y"); ?>" data-date-format="d-mm-yyyy"><?php $m = date("m");  echo format_mes($m); ?></span></legend>
				<div class="row">
					<div class="span5">
						<div class="control-group">
							<label class="control-label" for="origen">Destino</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="origen" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="puerto">Puerto de carga</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="puerto" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="buque">Buque</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="buque" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="salida">Fecha de salida</label>
							<div class="controls">
								<div class="input-prepend">
									<span id="date1" class="add-on" data-date="<?php echo date("j-m-Y"); ?>" data-date-format="d-mm-yyyy">
										<i class="icon-calendar"></i>
									</span>
									<input type="text" class="span2" id="salida" disabled />
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="cierredoc">Cierre doc</label>
							<div class="controls">
								<div class="input-prepend datee">
									<span id="date2" class="add-on" data-date="<?php echo date("j-m-Y"); ?>" data-date-format="d-mm-yyyy">
										<i class="icon-calendar"></i>
									</span>
									<input type="text" class="span2" id="cierredoc" disabled />
								</div>
							</div>
						</div>
					</div>
					<div class="span5">
						<div class="control-group">
							<label class="control-label" for="cierredesp">Cierre desp</label>
							<div class="controls">
								<div class="input-prepend datee">
									<span id="date3" class="add-on" data-date="<?php echo date("j-m-Y"); ?>" data-date-format="d-mm-yyyy">
										<i class="icon-calendar"></i>
									</span>
									<input type="text" class="span2" id="cierredesp" disabled />
								</div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="frecuencia">Frecuencia</label>
							<div class="controls">
								<input type="text" class="input-xlarge" id="frecuencia" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="transito">Tiempo de transito</label />
							<div class="controls">
								<input type="text" class="input-xlarge" id="transito">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="conexiones">Conexiones</label />
							<div class="controls">
								<textarea id="conexiones" class="input-xlarge"></textarea>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<button id="save" class="btn btn-success reg finish">Guardar y terminar</button>
				<button id="save" class="btn btn-primary reg">Guardar y continuar</button>
				<button id="save" class="btn btn-danger finish">Terminar sin guardar</button>
			</div>
		</form>
<?php
else:
?>
Debes iniciar sesión
<?php
endif;
?>
