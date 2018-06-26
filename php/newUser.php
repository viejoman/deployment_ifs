<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/user.php');

$do = isset($_POST['do']) ? $_POST['do'] : 'not';

if ( $do == 'it' ){

	$post = Array(
		'nombre'=> $_POST['nombre'],
		'username'=> $_POST['username'],
		'pass'=> $_POST['password']
	);

	$user = new User ();
	$register = $user->register($post);
	if( !$register ){
		echo $user->error();
	}else{
		echo 'success';
	}
}