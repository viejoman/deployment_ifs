<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

$id = isset($_GET['id']) ? $_GET['id'] : 'undefined';
$iten = new Iten ();
$details = $iten->details($id);


$mess = format_mes($details['mes']);

switch($details['expimp']){
	case 'exp':
		$expipm = 'Exportación';
		$torigdest = 'Destino';
		$rorigdest = $details['destino'];
		break;
	case 'imp': $expipm = 'Importación';
		$torigdest = 'Origen';
		$rorigdest = $details['origen'];
		break;
}

if ($details['cierredesp'] != 'null'){
	$cdesp = $details['cierredesp'];
}else{
	$cdesp = 'No disponible';
}
session_start();
$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;
if ($login){
	$btn_edit = <<<EOPAGE
		<button rel="{$id}" class="btn btn-primary edit"><i class="icon-pencil icon-white"></i> Editar</button>
		<button rel="{$id}" class="btn btn-danger delete"><i class="icon-trash icon-white"></i> Eliminar</button>
EOPAGE;
}else{
	$btn_edit = '';
}

$pcarga = $details['puerto'];
$buque = $details['buque'];
$salida = $details['salida'];
$cdoc = $details['cierredoc'];
$frec = $details['frecuencia'];
$trans = $details['transito'];
$conex = $details['conexiones'];

$output = <<<EOPAGE
	<h2 style="margin-top: 10px; margin-bottom: 10px; font-weight: normal">Detalles de <span style="color: #bbb;">{$expipm}</span></h2>
	<table id="details" class="table table-striped table-condensed">
		<tbody>
			<tr>
				<td>Mes</td>
				<td>{$mess}</td>

				<td>Cierre doc</td>
				<td>{$cdoc}</td>
			</tr>
			<tr>
				<td>{$torigdest}</td>
				<td>{$rorigdest}</td>

				<td>Cierre desp</td>
				<td>{$cdesp}</td>
			</tr>
			<tr>
				<td>Puerto de carga</td>
				<td>{$pcarga}</td>

				<td>Frecuencia</td>
				<td>{$frec}</td>
			</tr>
			<tr>
				<td>Buque</td>
				<td>{$buque}</td>

				<td>Tiempo de transito</td>
				<td>{$trans}</td>
			</tr>
			<tr>
				<td>Fecha de salida</td>
				<td>{$salida}</td>

				<td>Conexiones</td>
				<td>{$conex}</td>
			</tr>
		</tbody>
	</table>
	<div class="form-actions">
		<button class="btn btn-success finish"><i class="icon-remove icon-white"></i> Cerrar</button>
		{$btn_edit}
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
echo $output;
?>