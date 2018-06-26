<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

session_start();
$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;
if ($login){

	$id = isset($_GET['id']) ? $_GET['id'] : 'undefined';
	$iten = new Iten ();
	$details = $iten->details($id);

	$messn = $details['mes'];
	$mess = format_mes($messn);

	switch($details['expimp']){
		case 'exp':
			$expipm = 'Exportación';
			$torigdest = 'Destino';
			$rorigdest = $details['destino'];
			break;
		case 'imp':
			$expipm = 'Importación';
			$torigdest = 'Origen';
			$rorigdest = $details['origen'];
			break;
	}

	if ($details['cierredesp'] != 'null'){
		$c_desp = $details['cierredesp'];
		$c_desp_l = format_date($c_desp);
		$cdesp = <<<EOPAGE

						<div class="input-prepend">
							<span id="edate2" class="add-on" data-date="{$c_desp}" data-date-format="d-mm-yyyy">
								<i class="icon-calendar"></i>
							</span>
							<input id="cdesp" type="text" value="{$c_desp_l}" disabled />
						</div>
EOPAGE;

	}else{
		$cdesp = 'No disponible';
	}

	$pcarga = $details['puerto'];
	$buque = $details['buque'];
	$salida = $details['salida'];
	$cdoc = $details['cierredoc'];
	$frec = $details['frecuencia'];
	$trans = $details['transito'];
	$conex = $details['conexiones'];

	$anio = explode('-', $salida);
		$anio = $anio[2];

	$cdoc_l = format_date($cdoc);
	$salida_l = format_date($salida);

	$output = <<<EOPAGE
		<script>
			$(function(){
				$('#origdest').typeahead({
					source: [
						'USA', 'Cartagena', 'Callao', 'Brasil', 'Uruguay', 'Buenos Aires', 'Inglaterra', 'España', 'Rotterdam', 'Amberes', 'Italia', 'India', 'Quingdao', 'Shangai', 'Tianjin', 'Taiwan', 'Hong Kong', 'Sudáfrica', 'Marruecos', 'Egipto', 'Australia', 'Panamá', 'Rio Jaina', 'Buenaventura', 'Guayaquil', 'Valparaiso', 'Barcelona'
					],
					items: 4
				});

				$('#emess').datepicker()
					.on('changeDate', function(){
						var _da = $('#emess').data('date'),
							datee = n2month(_da);
						$('#emess').text( datee );
						$('#emess').datepicker('hide');
					});
				$('#edate1').datepicker()
					.on('changeDate', function(){
						var _da = $('#edate1').data('date'),
							datee = format_date(_da);
						$('#cdoc').val( datee );
						$('#edate1').datepicker('hide');
					});
				$('#edate2').datepicker()
					.on('changeDate', function(){
						var _da = $('#edate2').data('date'),
							datee = format_date(_da);
						$('#cdesp').val( datee );
						$('#edate2').datepicker('hide');
					});
				$('#edate3').datepicker()
					.on('changeDate', function(){
						var _da = $('#edate3').data('date'),
							datee = format_date(_da);
						$('#salida').val( datee );
						$('#edate3').datepicker('hide');
					});

				$('.save').click(function(){
					$.post(
						'php/update.php',
						{
							'do': 'it',
							'id': '{$id}',
							'mes': $('#emess').data('date'),
							'origdest': $('#origdest').val(),
							'puerto': $('#puerto').val(),
							'buque': $('#buque').val(),
							'salida': $('#edate3').data('date'),
							'cierredoc': $('#edate1').data('date'),
							'cierredesp': $('#edate2').data('date'),
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
				});
			});
		</script>
		<h2 style="margin-top: 10px; margin-bottom: 10px; font-weight: normal">Detalles de <span style="color: #bbb;">{$expipm}</span></h2>
		<table id="edit" class="table table-striped table-condensed">
			<tbody>
				<tr>
					<td>Mes</td>
					<td><span id="emess" class="badge badge-info" data-date="1-{$messn}-{$anio}" data-date-format="d-mm-yyyy">{$mess}</span></td>

					<td>Cierre doc</td>
					<td>
						<div class="input-prepend">
							<span id="edate1" class="add-on" data-date="{$cdoc}" data-date-format="d-mm-yyyy">
								<i class="icon-calendar"></i>
							</span>
							<input id="cdoc" type="text" value="{$cdoc_l}" disabled />
						</div>
					</td>
								
				</tr>
				<tr>
					<td>{$torigdest}</td>
					<td><input id="origdest" type="text" value="{$rorigdest}" /></td>

					<td>Cierre desp</td>
					<td>{$cdesp}</td>
				</tr>
				<tr>
					<td>Puerto de carga</td>
					<td><input id="puerto" type="text" value="{$pcarga}" /></td>

					<td>Frecuencia</td>
					<td><input id="frecuencia" type="text" value="{$frec}" /></td>
				</tr>
				<tr>
					<td>Buque</td>
					<td><input id="buque" type="text" value="{$buque}" /></td>

					<td>Tiempo de transito</td>
					<td><input id="transito" type="text" value="{$trans}" /></td>
				</tr>
				<tr>
					<td>Fecha de salida</td>
					<td>
						<div class="input-prepend">
							<span id="edate3" class="add-on" data-date="{$salida}" data-date-format="d-mm-yyyy">
								<i class="icon-calendar"></i>
							</span>
							<input id="salida" type="text" value="{$salida_l}" disabled />
						</div>
					</td>

					<td>Conexiones</td>
					<td><textarea id="conexiones">{$conex}</textarea></td>
				</tr>
			</tbody>
		</table>
		<div class="form-actions">
			<button rel="{$id}" class="btn btn-success view save">Guardar</button>
			<button class="btn btn-danger finish">Cancelar</button>
		</div>
EOPAGE;

	if ($id == 'nonot'){
		$output = <<<EOPAGE
		<script>
			$(function(){
				$('#newIten').html('');
			});
		</script>
EOPAGE;
	}


}else{
	$output = "Debes iniciar sesión";
}

echo $output;
?>