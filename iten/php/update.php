<?php
include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

$do = isset($_POST['do']) ? $_POST['do'] : 'not';
$id = isset($_POST['id']) ? $_POST['id'] : 'undefined';

if ( $do == 'it' ){
	$mes = explode('-', $_POST['mes']);
	$mes = $mes[1];

	$post = Array(
		'origdest' => $_POST['origdest'],
		'puerto' => $_POST['puerto'],
		'buque' => $_POST['buque'],
		'salida' => $_POST['salida'],
		'cierredoc' => $_POST['cierredoc'],
		'cierredesp' => $_POST['cierredesp'],
		'frecuencia' => $_POST['frecuencia'],
		'transito' => $_POST['transito'],
		'conexiones' => $_POST['conexiones'],
		'mes' => $mes
	);

	$iten = new Iten ();
	$update = $iten->updateThis($id, $post);
	if( !$update ){
		echo $iten->error();
	}else{
		echo 'success';
	}
}