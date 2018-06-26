<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

session_start();
$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;
if ($login){
	$btn_options = <<<EOPAGE
			<div class="btn-group .btn-mini" title="Opciones">
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a rel="{id}" class="view" href="#"><i class="icon-eye-open"></i> Ver detalles</a></li>
					<li><a rel="{id}" class="edit" href="#"><i class="icon-pencil"></i> Editar</a></li>
					<li class="divider"></li>
					<li><a rel="{id}" class="delete" href="#"><i class="icon-trash"></i> Eliminar</a></li>
				</ul>
			</div>
EOPAGE;
}else{
	$btn_options = '<button rel="{id}" class="btn btn-mini view" title="Ver detalles"><i class="icon-eye-open"></i></button>';
} 

$mes = date('m');
$f = isset($_GET['f']) ? $_GET['f'] : 'main';
$s = isset($_GET['s']) ? $_GET['s'] : 'void';
$m = isset($_GET['m']) ? $_GET['m'] : $mes;

$iten = file_get_contents('http://ifsmexico.com/iten/json/listIten.php?expimp=imp&m=' . $m . '&f='. $f . '&s=' . $s);

$iten = json_decode($iten);
$codigo = <<<EOPAGE
	<tr>
		<td>
			{$btn_options}
		</td>
		<td>{origen}</td>
		<td>{puerto}</td>
		<td>{buque}</td>
		<td>{salida}</td>
		<td>{cierredoc}</td>
		<td>{frecuencia}</td>
		<td>{transito}</td>
		<td>{conexiones}</td>
	</tr>
EOPAGE;

?>
<script>
	$(function(){
		$('[title]').tooltip({'placement':'top'});
	});
</script>

		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th></th>
					<th>Origen</th>
					<th>Puerto de descarga</th>
					<th>Buque</th>
					<th>Fecha de salida</th>
					<th>Cierre doc</th>
					<th>Frecuencia</th>
					<th>Tiempo de transito</th>
					<th>Conexiones</th>
				</tr>
			</thead>
			<tbody>
<?php
	for ($i = 0; $i < count($iten); $i++){
		$t = $iten[$i];
		$tmp = $codigo;
		$tmp = str_replace('{id}', $t->id, $tmp);
		$tmp = str_replace('{origen}', $t->origen, $tmp);
		$tmp = str_replace('{puerto}', $t->puerto, $tmp);
		$tmp = str_replace('{buque}', $t->buque, $tmp);
		$tmp = str_replace('{salida}', $t->salida, $tmp);
		$tmp = str_replace('{origen}', $t->origen, $tmp);
		$tmp = str_replace('{cierredoc}', $t->cierredoc, $tmp);
		$tmp = str_replace('{frecuencia}', $t->frecuencia, $tmp);
		$tmp = str_replace('{transito}', $t->transito, $tmp);
		$tmp = str_replace('{conexiones}', $t->conexiones, $tmp);

		echo $tmp;
	}
?>
			</tbody>
		</table>