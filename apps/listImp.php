<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

session_start();
$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;
//$login = true;
if ($login){
	$btn_options = <<<EOPAGE
			<div class="btn-group .btn-mini" title="Opciones">
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a rel="{id}" class="view" href="#"><i class="fa fa-eye"></i>Ver detalles</a></li>
					<li><a rel="{id}" class="edit" href="#"><i class="fa fa-pencil"></i> Editar</a></li>
					<li class="divider"></li>
					<li><a rel="{id}" class="delete" href="#"><i class="fa fa-trash"></i> Eliminar</a></li>
				</ul>
			</div>
EOPAGE;
}else{
	$btn_options = '<button rel="{id}" class="btn btn-mini view" title="Ver detalles"><i class="fa fa-eye"></i></button>';
} 

$mes = date('m');
$f = isset($_GET['f']) ? $_GET['f'] : 'main';
$s = isset($_GET['s']) ? $_GET['s'] : 'void';
$m = isset($_GET['m']) ? $_GET['m'] : $mes;

//$iten = file_get_contents('http://ifsmexico.com/iten/json/listIten.php?expimp=imp&m=' . $m . '&f='. $f . '&s=' . $s);
//$iten = json_decode($iten);

$iten = new Iten ();
$search = $iten->search($s);
$listr = $iten->listr('imp', $m, $f);

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


$('.edit').on('click',function(e){
				e.preventDefault();
				var rel = $(this).attr('rel');
				$('#newIten').html('<h3>Cargando ...</h3>')
					.load('apps/edit.php?id=' + rel);
			});

			$('.delete').on('click',function(e){
				e.preventDefault();
				var rel = $(this).attr('rel');
				$('#newIten').html('<h3>Cargando ...</h3>')
					.load('apps/delete.php?id=' + rel);
			});
        

	});

    $('.view').on('click',function(e){
				e.preventDefault();
				var rel = $(this).attr('rel');
				$('#newIten').html('<h3>Cargando ...</h3>')
					.load('apps/view.php?id=' + rel);
			});


            $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });

</script>

		<table id="example2" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th></th>
					<th style="padding-right: 25px;">Origen</th>
					<th style ="padding-right: 25px;">Puerto de descarga</th>
					<th style="padding-right: 25px;">Buque</th>
					<th style="padding-right: 25px;">Fecha de salida</th>
					<th style="padding-right: 25px;">Cierre Doc.</th>
					<th style="padding-right: 25px;">Frecuencia</th>
					<th style="padding-right: 25px;">Tiempo de Tránsito</th>
					<th style="padding-right: 25px;">Conexiones</th>
				</tr>
			</thead>
			<tbody>
<?php
	for ($i = 0; $i < count($listr); $i++){
		$t = $listr[$i];
		$tmp = $codigo;
		$tmp = str_replace('{id}', $t['id'], $tmp);
		$tmp = str_replace('{destino}', $t['destino'], $tmp);
		$tmp = str_replace('{puerto}', $t['puerto'], $tmp);
		$tmp = str_replace('{buque}', $t['buque'], $tmp);
		$tmp = str_replace('{salida}', $t['salida'], $tmp);
		$tmp = str_replace('{origen}', $t['origen'], $tmp);
		$tmp = str_replace('{cierredoc}', $t['cierredoc'], $tmp);
		$tmp = str_replace('{frecuencia}', $t['frecuencia'], $tmp);
		$tmp = str_replace('{transito}', $t['transito'], $tmp);
		$tmp = str_replace('{conexiones}', $t['conexiones'], $tmp);

		echo $tmp;
	}
?>
			</tbody>
            <tfoot>

                <tr>
					<th></th>
					<th>Origen</th>
					<th>Puerto de descarga</th>
					<th>Buque</th>
					<th>Fecha de salida</th>
					<th>Cierre Doc.</th>
					<th>Frecuencia</th>
					<th>Tiempo de Tránsito</th>
					<th>Conexiones</th>
				</tr>

            </tfoot>
		</table>