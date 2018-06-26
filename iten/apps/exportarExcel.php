<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

if(!isset($_SESSION)) 
{ 
        session_start(); 
}

$aColHeaders = array(
	    'origen' 			=> 'Origen',
		'destino' 			=> 'Destino',
		'puertocarga' 		=> 'Puerto de Carga',
		'puertodescarga'	=> 'Puerto de Descarga',
		'buque' 			=> 'Buque',
		'salida'			=> 'Fecha de Salida',
		'cierredoc' 		=> 'Cierre Doc.',
		'cierredesp' 		=> 'Cierre Desp.',
		'frecuencia' 		=> 'Frecuencia',
		'transito' 			=> 'Tiempo de Transito',
		'conexiones' 		=> 'Conexiones'
	);

$query = isset($_SESSION['SQListr']) ? $_SESSION['SQListr'] : "";
$expimp = isset($_SESSION['Operacion']) ? $_SESSION['Operacion'] : "";

if (strlen($query) > 0) 
{
	//echo $query ."<br/>";
	//echo $expimp ."<br/>";
	
	$filename = "itinerarios_data_" . date('Ymd') . ".xls";
	
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Type: application/vnd.ms-excel");

	$oIten = new Iten();
	
	$data = $oIten->listrByQuery($query, $expimp);
	
	$flag = false;
	
	foreach($data as $row) {
		
		if(!$flag) {
			
			$firstline = array_map("map_colnames", array_keys($row));
      		echo implode("\t", $firstline) . "\n";
			$flag = true;
		}
		
		array_walk($row, 'cleanData');
		echo implode("\t", array_values($row)) . "\n";
		
	}
	
}

exit;

function cleanData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    
    $str = preg_replace("/\r?\n/", "\\n", $str);
    
    //if($str == 'null') $str = '';
    
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    
    $str = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');
}

function map_colnames($input)
{
	global $aColHeaders;
	return isset($aColHeaders[$input]) ? $aColHeaders[$input] : $input;
}

?>