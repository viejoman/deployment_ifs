<?php

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

date_default_timezone_set('America/Mexico_City');

$aError = array();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if (!empty($request->opera)) {
	    
	$mes = date('m');
	//$mes = date('m')+1;
	
	$f = 'main';
	$s = 'void';
	$operacion = $request->opera == 1 ? 'imp' : 'exp'; 
	$fechaini = $request->salidaini;
	$fechafin = $request->salidafin;
	$origdest = !empty($request->origdest) ? $request->origdest : false;
	$puerto = !empty($request->puerto) ? $request->puerto : false;
	$buque = !empty($request->buque) ? $request->buque : false;
	$m = $mes;
	
	$iten = new Iten ();
	$search = $iten->search($s);
	
	$listr = $iten->getItinerarios($operacion, $fechaini, $fechafin, $origdest, $puerto, $buque, $f);
	
	$headers = apache_request_headers();
	
	header('Content-Type: application/json');
	
	$aError = array("error" => array("desc" => "No hay header valido", "id" => 22));
	
	if (validateToken($headers)) {
		echo json_encode($listr);	
	} else {
		echo json_encode($aError);
	}


} else {
	
	$aError = array("error" => array("desc" => "No hay header valido", "id" => 22));
	header('Content-Type: application/json');
	echo json_encode($aError);
	
}

function validateToken($headers) 
	{
		/*
		$bTokenValido = false;        				
		
		foreach ($headers as $header => $value) {				
			if ($header == "Authentication-IFS")			    	
			if (base64_decode($value) == (sha1('test1234|d215|2015'))) {			    		
				$bTokenValido = true;			    		
				break;			    	}			    				
		}					
			
		return $bTokenValido;
		*/
		return true; 
	}

?>