<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

$id = isset($_GET['id']) ? $_GET['id'] : 'undefined';

session_start();
$login = isset($_SESSION['login']) ? $_SESSION['login'] : 0;
if ($login){
	$iten = new Iten ();
	$iten->delete($id);
}else{
	echo "No tienes permisos para hacer esto";
}
?>