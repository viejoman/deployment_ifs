<?php
include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/directorio.php');
$idOficina = isset($_POST['idOficina']) ? $_POST['idOficina'] : '1';
$directorio = new Directorio();
$details_dir = $directorio->getAllEmpleadosByIdOficina($idOficina);
//echo nl2br(print_r($details_dir, true));
?>