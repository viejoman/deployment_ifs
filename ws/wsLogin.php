<?php				
    set_time_limit(0); 	
	include_once('../config.php');	
	include_once('../php/functions.php');	
	include_once('../class/iten.php');	
	include_once('../class/user.php');		
	require_once('lib/nusoap.php');	
	require_once 'lib/class.soap_wrapper.php';
	
	$server = new Soap_wrapper();	
	
	$server->soap_defencoding = 'UTF-8';	
	
	$server->configureWSDL('wsLogin','urn:'.$server->script_uri);	
	
	$server->register('authenticate',
                    array('username'=>'xsd:string','key'=>'xsd:string'),
                    array('return'=>'xsd:string'),
                    'urn:'.$server->script_uri,
                    'urn:'.$server->script_uri.'#authenticate' 
                    );	
                    	
	function authenticate($username, $key) {            	
		$oUser = new User();	
		//if ($oUser->exist($username) && ($key == 'd'.str_pad(date('z')+1, 3, "0", STR_PAD_LEFT).'|'.date('Y'))) {
		if ($oUser->exist($username) && ($key == 'd'.(date('z')+1).'|'.date('Y'))) {
			return 'OK';
		} else {
			return 'ERROR - Verifique los datos de autenticacion';
		}
	}	

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:'';	
	$server->service_start($HTTP_RAW_POST_DATA);	
?>