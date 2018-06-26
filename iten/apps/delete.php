<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

$id = isset($_GET['id']) ? $_GET['id'] : 'undefined';

session_start();
$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;
if ($login):
?>
	<script>
		$(function(){
			$('#deleteyn').modal();
			$('#delcancel').click(function(e){
				e.preventDefault();
				$('#deleteyn').modal('hide');
				$('#newIten').html('');
			});
			$('#dodelete').click(function(e){
				e.preventDefault();
				$.get('php/delete.php?id=<?php echo $id; ?>');
				listIten();
				$('#deleteyn').modal('hide');
				$('#newIten').html('');
			});
		});
	</script>

	<div class="modal fade" id="deleteyn">
		<div class="modal-header">
			<button class="close" data-dismiss="modal">×</button>
			<h3>Eliminar itinerario</h3>
		</div>
		<div class="modal-body">
			<p>¿Estas seguro que deseas eliminar este registro?
		</div>
		<div class="modal-footer">
			<a id="dodelete" class="btn btn-danger">Sí, estoy seguro</a>
			<a id="delcancel" class="btn btn-success">No, no lo estoy</a>
		</div>
	</div>
<?php
else:
	echo 'No tienes permisos para hacer esto';
endif;
?>