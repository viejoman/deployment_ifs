<?php
// JSon Entries Global

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

$iten = new Iten ();

$mes = date("m");

$expimp = isset($_GET['expimp']) ? $_GET['expimp'] : 'imp';
$f = isset($_GET['f']) ? $_GET['f'] : 'main';
$s = isset($_GET['s']) ? $_GET['s'] : 'void';
$m = isset($_GET['m']) ? $_GET['m'] : $mes;

$search = $iten->search($s);
$listr = $iten->listr($expimp, $m, $f);

header('Content-type: text/javascript');
echo json_encode($listr);

?>