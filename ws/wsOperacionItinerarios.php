<?php
//-----------------------------------------------------------------------------------------------------------			
	set_time_limit(0);
	date_default_timezone_set('America/Mexico_City'); 
	
	include_once('../config.php');
	include_once('../php/functions.php');
	include_once('../class/iten.php');
	include_once('../class/user.php');
	
	require_once('lib/nusoap.php');
	require_once 'lib/class.soap_wrapper.php';
	
	
	$server = new Soap_wrapper();
	$server->soap_defencoding = 'UTF-8';
	$server->configureWSDL('wsOperacionItinerarios','urn:'.$server->script_uri);
	
	$server->wsdl->addComplexType('Itinerario',
								'complexType',
								'struct',
								'all',
								'',
							    array(
							    		'sUID' => array('name' => 'sUID', 'type' => 'xsd:string'),
										'sExpImp' => array('name' => 'sExpImp', 'type' => 'xsd:string'),
							    		'sOrigen' => array('name' => 'sOrigen', 'type' => 'xsd:string'),
										'sDestino' => array('name' => 'sDestino', 'type' => 'xsd:string'),
										'sPuerto' => array('name' => 'sPuerto', 'type' => 'xsd:string'),
							    		'sBuque' => array('name' => 'sBuque', 'type' => 'xsd:string'),
							    		'sNumViaje' => array('name' => 'sNumViaje', 'type' => 'xsd:string'),
										'sSalida' => array('name' => 'sSalida', 'type' => 'xsd:string'),
						    			'sCierredoc' => array('name' => 'sCierredoc', 'type' => 'xsd:string'),
							    		'sCierredesp' => array('name' => 'sCierredesp', 'type' => 'xsd:string'),
							    		'sFrecuencia' => array('name' => 'sFrecuencia', 'type' => 'xsd:string'),
							    		'sTransito' => array('name' => 'sTransito', 'type' => 'xsd:string'),
							    		'sConexiones' => array('name' => 'sConexiones', 'type' => 'xsd:string'),
							    		'nCRUDAction' => array('name' => 'nCRUDAction', 'type' => 'xsd:int'),
							    		'sUsuario' => array('name' => 'sUsuario', 'type' => 'xsd:string'),
							    		'nMes' => array('name' => 'nMes', 'type' => 'xsd:int')
								)
	);
	
	$server->wsdl->addComplexType(
	    'ListItinerarios',
	    'complexType',
	    'array',
	    '',
	    'SOAP-ENC:Array',
	    array(),
	    array( array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType' => 'tns:Itinerario[]') ),
	    'tns:Itinerario'
	);
	
	$server->wsdl->addComplexType(
	    'ItinerarioResponse',
	    'complexType',
	    'struct',
	    'all',
	    '',    	
	    array(
	    		'sUID'   => array('name' => 'sUID', 'type' => 'xsd:string'),
	    		'nEstatus'   => array('name' => 'nEstatus', 'type' => 'xsd:int'),
	    		'sLog'   => array('name' => 'sLog', 'type' => 'xsd:string'),
	    )	    
	);
	
	$server->wsdl->addComplexType(
	    'ListItinerariosResponse',
	    'complexType',
	    'array',
	    '',
	    'SOAP-ENC:Array',
	    array(),
	    array( array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType' => 'tns:ItinerarioResponse[]') ),
	    'tns:ItinerarioResponse'
	);
	
	$server->wsdl->addComplexType(
	    'catPuertos',
	    'complexType',
	    'struct',
	    'all',
	    '',    	
	    array(
	    	'puerto'   => array('name' => 'puerto', 'type' => 'xsd:string')
	    )	    
	);
	
	$server->wsdl->addComplexType(
	    'catPuertosArray',
	    'complexType',
	    'array',
	    '',
	    'SOAP-ENC:Array',
	    array(),
	    array( array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType' => 'tns:catPuertos[]') ),
	    'tns:catPuertos'
	);
	
    $server->wsdl->addComplexType(
	    'catPaises',
	    'complexType',
	    'struct',
	    'all',
	    '',    	
	    array(
	    	'pais'   => array('name' => 'pais', 'type' => 'xsd:string')
	    )	    
	);
	
	$server->wsdl->addComplexType(
	    'catPaisesArray',
	    'complexType',
	    'array',
	    '',
	    'SOAP-ENC:Array',
	    array(),
	    array( array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType' => 'tns:catPaises[]') ),
	    'tns:catPaises'
	);
	
    
	$server->register('getCatalagoOrigenDestino',
			array('nOrigen'   => 'xsd:int'),
			array('return' => 'tns:catPaisesArray'),
			'urn:wsOperacionItinerarios',
			'urn:wsOperacionItinerarios#getCatalagoOrigenDestino',
			'rpc',
			'encoded'
  	);
  	  	  	
  	function getCatalagoOrigenDestino($nOrigen) {		
		
  		$iten = new Iten ();
  		$aPaises = array();
  		$aPaises = $iten->getListCountry();
				
		return $aPaises;
	}	

	$server->register('getCatalagoPuertos',
			array('nOrigen'   => 'xsd:int'),
			array('return' => 'tns:catPuertosArray'),
			'urn:wsOperacionItinerarios',
			'urn:wsOperacionItinerarios#getCatalagoPuertos',
			'rpc',
			'encoded'
  	);
	
  	function getCatalagoPuertos($nOrigen) {		
		
  		$iten = new Iten ();
  		$aPuertos = array();
  		$aPuertos = $iten->getListPuerto();
				
		return $aPuertos;
		
	}
  	
	$server->register('setNuevoItinerario',
			array('newListItinerario' => 'tns:ListItinerarios'),
			array('return' => 'tns:ListItinerariosResponse'),
			'urn:wsOperacionItinerarios',
			'urn:wsOperacionItinerarios#setNuevoItinerario',
			'rpc',
			'encoded',
			'Web Method para registrar un nuevo Itinerario'
	);
	
	function setNuevoItinerario($aItinerario) {
		
		$_bResponse = false;
		$_aListResponse = array();
		$_aItinerariosResponse = array();
		$_sPivote = date("d-m-Y H:i:s") . " - ";
		$_sLog = "";
		$_sLog .= $_sPivote . "INI setNuevoItinerario" . "\r\n";
		
		if (count($aItinerario) > 0) {
			
			$_sLog .= $_sPivote . "NUM REGISTROS : " . count($aItinerario) . "\r\n";
			
			$_nContReg = 0;
			
			foreach ($aItinerario as $oItinerario) {
				$_sLog .= $_sPivote . "REGISTRO [$_nContReg] : ITINERARIO => " . print_r($oItinerario, true) .  "\r\n";
				
				if (isset($oItinerario['nCRUDAction'])) {
					
					$_aData = array();
					
					$_sLog .= $_sPivote . "REGISTRO [$_nContReg] : Se crea objeto itinerario\r\n";
					
					$oItinerarioAux = new Iten();
					
					$_aData['itid'] 		= $oItinerario['sUID'];
					$_aData['expimp']		= substr($oItinerario['sExpImp'],0,3);
					$_aData['origen'] 		= isset($oItinerario['sOrigen']) ? base64_decode($oItinerario['sOrigen']) : "";
					$_aData['destino'] 		= isset($oItinerario['sDestino']) ? base64_decode($oItinerario['sDestino']) : "";
					$_aData['puerto'] 		= base64_decode($oItinerario['sPuerto']);
					$_aData['buque'] 		= base64_decode($oItinerario['sBuque']);
					$_aData['numviaje'] 	= base64_decode($oItinerario['sNumViaje']);
					$_aData['buque']		= $_aData['buque'] . " " . $_aData['numviaje'];
					$_aData['salida'] 		= str_replace("/", "-", $oItinerario['sSalida']);
					$_aData['cierredoc'] 	= str_replace("/", "-", $oItinerario['sCierredoc']);
					
					if ($_aData['expimp'] == 'imp') {
						$_aData['cierredesp'] 	= 'null';
					} else {
						$_aData['cierredesp'] 	= str_replace("/", "-", $oItinerario['sCierredesp']);
					}
					
					$_aData['frecuencia'] 	= base64_decode($oItinerario['sFrecuencia']);
					$_aData['transito'] 	= base64_decode($oItinerario['sTransito']);
					$_aData['conexiones'] 	= base64_decode($oItinerario['sConexiones']);
					$_aData['user'] 		= $oItinerario['sUsuario'];
					$_aData['mes'] 			= sprintf("%02d", $oItinerario['nMes']);
					
					$_sLog .= $_sPivote . "REGISTRO [$_nContReg] : DATA => " . print_r($_aData, true) .  "\r\n";
					
					if ($oItinerario['nCRUDAction'] == 1) {
						
						$_sLog .= $_sPivote . "REGISTRO [$_nContReg] : Operacion INSERT\r\n";
						
						if ($oItinerarioAux->insert($_aData, true)) {
							$_aItinerariosResponse['sUID'] = $oItinerario['sUID']; 
							$_aItinerariosResponse['nEstatus'] = 0;
							$_aItinerariosResponse['sLog'] = "OK";
						} else {
							$_sLog .= $_sPivote . "REGISTRO [$_nContReg] : " .$oItinerarioAux->error(). "\r\n";
							$_aItinerariosResponse['sUID'] = $oItinerario['sUID']; 
							$_aItinerariosResponse['nEstatus'] = 1;
							$_aItinerariosResponse['sLog'] = $oItinerarioAux->error();
						}
						
					} else if ($oItinerario['nCRUDAction'] == 2) {
						
						$_sLog .= $_sPivote . "REGISTRO [$_nContReg] : Operacion UPDATE\r\n";
						
						if ($oItinerarioAux->updateThis($_aData['itid'], $_aData, true)) {
							$_aItinerariosResponse['sUID'] = $oItinerario['sUID']; 
							$_aItinerariosResponse['nEstatus'] = 0;
							$_aItinerariosResponse['sLog'] = "OK";
						} else {
							$_sLog .= $_sPivote . "REGISTRO [$_nContReg] : " .$oItinerarioAux->error(). "\r\n";
							$_aItinerariosResponse['sUID'] = $oItinerario['sUID']; 
							$_aItinerariosResponse['nEstatus'] = 1;
							$_aItinerariosResponse['sLog'] = $oItinerarioAux->error();
						}
						
					} else if ($oItinerario['nCRUDAction'] == 3) { 
						
						$_sLog .= $_sPivote . "REGISTRO [$_nContReg] : Operacion DELETE\r\n";
						
						if ($oItinerarioAux->delete($_aData['itid'])) {
							$_aItinerariosResponse['sUID'] = $oItinerario['sUID']; 
							$_aItinerariosResponse['nEstatus'] = 0;
							$_aItinerariosResponse['sLog'] = "OK";
						}
						
					}
					
					$_aListResponse[] = $_aItinerariosResponse;
					
				}
				
				$_nContReg++;
			}
			
			$_bResponse = true;
			
		} else {
			$_bResponse = false;
		}
		
		$_sLog .= $_sPivote . "RESPONSE " . print_r($_aListResponse, true) .  "\r\n";
		
		$_sLog .= $_sPivote . "FIN setNuevoItinerario" . "\r\n";
		
		file_put_contents("setNuevoItinerario-".date("dmY-His").".txt", $_sLog);
		
		return $_aListResponse;
	}
	
	/*$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);*/
	
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:'';
	$server->service_start($HTTP_RAW_POST_DATA);
   
//-----------------------------------------------------------------------------------------------------------
?>