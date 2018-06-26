<?php
//-----------------------------------------------------------------------------------------------------------			
	set_time_limit(0); 
	date_default_timezone_set('America/Mexico_City');
	
	include_once('../config.php');
	include_once('../php/functions.php');
	include_once('../class/iten.php');
	include_once('../class/user.php');
	
	require_once('../class/cEnvioMail.php');
	
	require_once('lib/nusoap.php');
	require_once 'lib/class.soap_wrapper.php';
	
	
	$server = new Soap_wrapper();
	$server->soap_defencoding = 'UTF-8';
	$server->configureWSDL('wsNotificaciones','urn:'.$server->script_uri);
	
	$server->wsdl->addComplexType('oEmailCC',
								'complexType',
								'struct',
								'all',
								'',
							    array(
										
										'sAlias' => array('name' => 'sAlias', 'type' => 'xsd:string'),
										'sEmailCC' => array('name' => 'sEmailCC', 'type' => 'xsd:string')
								)
	);
	
	$server->wsdl->addComplexType(
	    'ListEmailCC',
	    'complexType',
	    'array',
	    '',
	    'SOAP-ENC:Array',
	    array(),
	    array( array('ref' => 'SOAP-ENC:arrayType','wsdl:arrayType' => 'tns:oEmailCC[]') ),
	    'tns:oEmailCC'
	);
	
    $server->wsdl->addComplexType('Notificacion',
								'complexType',
								'struct',
								'all',
								'',
							    array(
										'sUsername' => array('name' => 'sUsername', 'type' => 'xsd:string'),
							    		'sSubject' => array('name' => 'sSubject', 'type' => 'xsd:string'),
										'sEmailTo' => array('name' => 'sEmailTo', 'type' => 'xsd:string'),
										'bCopiaPara' => array('name' => 'bCopiaPara', 'type' => 'xsd:boolean'),
							    		'EmailCC' => array('name' => 'EmailCC', 'type' => 'tns:ListEmailCC'),
										'sMensaje' => array('name' => 'sMensaje', 'type' => 'xsd:string')
								)
	);
	
    
	$server->register('setEnvioNotificacion',
			array('newNotificacion' => 'tns:Notificacion'),
			array('return' => 'xsd:boolean'),
			'urn:wsNotificaciones',
			'urn:wsNotificaciones#setEnvioNotificacion',
			'rpc',
			'encoded',
			'Envio de Notificaciones'
	);
  	
  	function setEnvioNotificacion($aNotificacion) {
  		
		$_bResponse = false;
		
  		$_sLog = "";
  		
  		$oUser = new User();
  		
  		$sUsername = isset($aNotificacion['sUsername']) ? $aNotificacion['sUsername'] : "";
  		$sSubject = isset($aNotificacion['sSubject']) ? $aNotificacion['sSubject'] : "";
  		$sEmailTo = isset($aNotificacion['sEmailTo']) ? $aNotificacion['sEmailTo'] : "";
  		$bCopiaPara = isset($aNotificacion['bCopiaPara']) ? $aNotificacion['bCopiaPara'] : false;
  		
  		$aListaEmailCC = array();
  		
  		if (isset($aNotificacion['EmailCC'])) 
  		{
  			if (count($aNotificacion['EmailCC']) > 0) {
  				$aListaEmailCC = $aNotificacion['EmailCC'];
  			}
  		}  		
  		
  		$sMensaje = isset($aNotificacion['sMensaje']) ? $aNotificacion['sMensaje'] : "";
  		
  		$_sLog .= "ARRAY : " . print_r($aNotificacion, true). "\r\n\r\n";
  		
  		$_sLog .= "sUsername : " . $sUsername ."\r\n";
  		$_sLog .= "sSubject : " .  $sSubject ."\r\n";
  		$_sLog .= "sEmailTo : " . $sEmailTo ."\r\n";
  		$_sLog .= "bCopiaPara : " . $bCopiaPara ."\r\n";
  		$_sLog .= "EmailCC : " . count($aListaEmailCC) ."\r\n";
  		$_sLog .= "sMensaje : " . $sMensaje ."\r\n";
  		
  		
  		if ($oUser->exist($sUsername) && strlen(trim($sUsername)) > 0) {
  			
	  		$sTo = $sEmailTo;
	  		$sFrom = "info@ifsmexico.com";
	  		$sSubject = $sSubject;
	  		
	  		$_sLog .= "sMensaje (decode): " . base64_decode($sMensaje) ."\r\n";
	  		
	  		$sMensaje = decrypt($sMensaje, "12EstaClave34es56dificil489ssswf");
	  		
			$_sLog .= "sMensaje (DesEncrypt): " . $sMensaje ."\r\n";
	  		
			$oMail = new cEnvioMail($sTo,$sFrom,$sSubject);		
			$oMail->authenticateSmtp("info@ifsmexico.com","InfoIfsmexico1");
			
			$oMail->agregarCC('jennybuenrostro@gmail.com','Responsable');
			
			//$sImg = $oMail->agregarImgBody("/var/www/html/imgs/logo_proceda_small.png", 'logo.png', 'Logo.png');
			
			$sImg = "<IMAGEN>";
			$sMensajeBody = "";
			$sMensajeBody .= "<font face=\"fixedsys\" style=\"color:red\">[".date("d/m/Y H:i:s")."] ".$sSubject."</font><br />";
			$sMensajeBody .= $sMensaje."<br /><div align=\"center\"><p style=\"color: #3333CC; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;font-weight: bold;\">Notificaci&oacute;n IFS<br />".$sImg."<br /></div>";
			
			$oMail->agregarContenido($sMensajeBody);
			
			/*
			if ($oMail->enviar()) {	
				return true;
			}
			else {
				return false;
			}
			*/
			
			$_bResponse = true;
		
  		} else {
  			$_bResponse = false;
  		}  	  	
  		
  		
  		
  		$_sLog .= "bResponse : " . $_bResponse; 
  		
  		file_put_contents("NOTIFICACION-Test".date("dmYHis").".txt", $_sLog);
  		
  		//return new soapval('return','xsd:boolean',$_bResponse);
  		return $_bResponse;
  		
	}	
	
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:'';
	$server->service_start($HTTP_RAW_POST_DATA);
   
//-----------------------------------------------------------------------------------------------------------
?>