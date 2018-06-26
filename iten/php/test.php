<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/user.php');

$user = new User ();
$user->setUser('dannegm');
echo $user->consult('nombre');

?>