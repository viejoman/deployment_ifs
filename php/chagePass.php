<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/user.php');

$do = isset($_POST['do']) ? $_POST['do'] : 'not';

if ( $do == 'it' ){

	session_start();
	$user = new User ();
	$user->setUser($_SESSION['user']);
	$update = $user->chagepassword($_POST['lastPass'], $_POST['newPass']);
	if( !$update ){
		echo $user->error();
	}else{
		echo 'success';
	}
}