<?php
	include_once('../php/functions.php');
	date_default_timezone_set("America/Mexico_City");

session_start();

$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;

if ($login):
?>
<script>
	$(function(){

        $('.finish').on('click', function(){
				$('#newIten').html('');
			});

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

		$('.reg').click(function(){
			$.post(
				'php/newIten.php',
				{
					'do': 'it',
					'mes': $('#mess').data('date'),
					'expimp': 'imp',
					'origen': $('#origen').val(),
					'destino': 'null',
					'puerto': $('#puerto').val(),
					'buque': $('#buque').val(),
					'salida': $('#date1').data('date'),
					'cierredoc': $('#date2').data('date'),
					'cierredesp': 'null',
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
				'USA', 'Cartagena', 'Callao', 'Brasil', 'Uruguay', 'Buenos Aires', 'Inglaterra', 'España', 'Rotterdam', 'Amberes', 'Italia', 'India', 'Quingdao', 'Shangai', 'Tianjin', 'Taiwan', 'Hong Kong', 'Sudáfrica', 'Marruecos', 'Egipto', 'Australia', 'Panamá', 'Rio Jaina', 'Buenaventura', 'Guayaquil', 'Valparaiso', 'Barcelona'
			],
			items: 4
		});
	});
</script>

    <h2 style="margin-top: 10px; margin-bottom: 10px; font-weight: normal">
    Nuevo itinerario de <span style="color: #bbb;">Importación</span> del mes de <?php $m = date("m");  echo format_mes($m); ?></h2>

		<form class="form-horizontal">
			
            <!--=====================================================================================-->

            <table id="edit" class="table table-striped table-condensed">
			<tbody>
				<tr>
					<td>Mes</td>
					<td>                                            <span id="mess" class="badge badge-info" title="Cambiar mes" data-date="<?php echo date("j-m-Y"); ?>" data-date-format="d-mm-yyyy"><?php $m = date("m");  echo format_mes($m); ?></span>                    </td>

					<td>Cierre Doc.</td>
					<td>
						<div class="input-group">
							<div id="date2" class="input-group-addon" data-date="<?php echo date("j-m-Y"); ?>" data-date-format="d-mm-yyyy">
                            <i class="fa fa-calendar"></i>
                            </div>
							<input id="cierredoc" type="text" class="form-control pull-right" value="" disabled  />
						</div>
					</td>
								
				</tr>
				<tr>
					<td>Origen</td>
					<td><input id="origdest" type="text" class="form-control" value="" /></td>

					<td>Cierre Desp.</td>
					<td>                        <div class="input-group">
							No Disponible
						</div>                    </td>
				</tr>
				<tr>
					<td>Puerto de Carga</td>
					<td><input id="puerto" type="text" class="form-control" value="" /></td>

					<td>Frecuencia</td>
					<td><input id="frecuencia" type="text" class="form-control" value="" /></td>
				</tr>
				<tr>
					<td>Buque</td>
					<td><input id="buque" type="text" class="form-control" value="" /></td>

					<td>Tiempo de Tr&aacute;nsito</td>
					<td><input id="transito" class="form-control" type="text" value="" /></td>
				</tr>
				<tr>
					<td>Fecha de Salida</td>
					<td>
						<div class="input-group">
							<div id="date1" class="input-group-addon" data-date="<?php echo date("j-m-Y"); ?>" data-date-format="d-mm-yyyy">
                            <i class="fa fa-calendar"></i>
                            </div>
							<input id="salida" type="text" class="form-control pull-right" value=""  disabled/>
						</div> 
					</td>

					<td>Conexiones</td>
					<td><textarea id="conexiones" class="form-control"></textarea></td>
				</tr>
			</tbody>
		</table>

            <!--=====================================================================================-->

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