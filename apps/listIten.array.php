<?php

$iten = new Iten ();

$mes = date("m");

$expimp = isset($_GET['expimp']) ? $_GET['expimp'] : 'exp';
$f = isset($_GET['f']) ? $_GET['f'] : 'main';
$s = isset($_GET['s']) ? $_GET['s'] : 'void';
$m = isset($_GET['m']) ? $_GET['m'] : $mes;

$search = $iten->search($s);

global $listr;
$listr = $iten->listr($expimp, $m, $f);


?>