<?php
include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

$do = isset($_POST['do']) ? $_POST['do'] : 'not';

if ( $do == 'it' ){
	$mes = explode('-', $_POST['mes']);
	$mes = $mes[1];

	$post = Array(
		'expimp' => $_POST['expimp'],
		'origen' => $_POST['origen'],
		'destino' => $_POST['destino'],
		'puerto' => $_POST['puerto'],
		'buque' => $_POST['buque'],
		'salida' => $_POST['salida'],
		'cierredoc' => $_POST['cierredoc'],
		'cierredesp' => $_POST['cierredesp'],
		'frecuencia' => $_POST['frecuencia'],
		'transito' => $_POST['transito'],
		'conexiones' => $_POST['conexiones'],
		'usuario' => 'dannegm',
		'mes' => $mes
	);

	$iten = new Iten ();
	$insert = $iten->insert($post);
	if( !$insert ){
		echo $iten->error();
	}else{
		echo 'success';
	}
}