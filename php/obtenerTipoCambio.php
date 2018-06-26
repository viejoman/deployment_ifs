<?php
// JSon Tipo de Cambio
include_once('../ws/lib/nusoap.php');
include_once('../config.php');
include_once('functions.php');
include_once('../class/tipocambio.php');

$oTipoCambio = new TipoCambio();
$output = $oTipoCambio->getByDate(date("Y-m-d"));

if( !$output ){	

	$output = obtenerTC_aux();
          
	if (isset($output['fecha_tc'])) {
		if ($output['fecha_tc'] !=  'null') {
			$oTipoCambio->insert($output);            
		} else {
			
			$output = obtenerTCDofGobMX();
		}
	} 

}

//header('Content-type: text/javascript');
echo json_encode( $output );

//echo nl2br(print_r($output, true));

function obtenerTC() {
    $resultado = '';
    $fecha_tc = '';
    $tc = '';
    
    /*
    $bConexionWS = false;
    
    $client = new SoapClient(null, array('location' => 'http://www.banxico.org.mx:80/DgieWSWeb/DgieWS?WSDL',
                'uri' => 'http://DgieWSWeb/DgieWS?WSDL',
                'encoding' => 'ISO-8859-1',
                'trace' => 1));
    
    try {
        $resultado = $client->tiposDeCambioBanxico();
        $bConexionWS = true;
    } catch (SoapFault $exception) {

    }
    */
    
    $bConexionWS = true;
    
    $oClient = new soapclient('http://www.banxico.org.mx:80/DgieWSWeb/DgieWS?WSDL', true);
    
    
    $err = $oClient->getError();

	if ($err) {
		$bConexionWS = false;
	} else {
    
		$resultado = $oClient->call('tiposDeCambioBanxico');

		if ($oClient->fault) {
												
			$bConexionWS = false;
			
		} else {

			$err = $oClient->getError();
			
			if ($err) {
			
				$bConexionWS = false;
			
			} 
		}	
	}	

    

    $output = Array(
		'fecha_tc' => 'null',
		'tc' => 0
	);
    
	if ($bConexionWS) {
	
	    if (!empty($resultado)) {
	        $dom = new DomDocument();
	        $dom->loadXML($resultado);
	        $xmlDatos = $dom->getElementsByTagName("Obs");
	        if ($xmlDatos->length > 1) {
	            //$item = $xmlDatos->item(1);
	            //$tc = $item->getAttribute('OBS_VALUE') + 0.50;
	            //$fecha_tc = $item->getAttribute('TIME_PERIOD');
	        	for ($i = 0; $i < $xmlDatos->length; $i++) {
	        		$item = $xmlDatos->item($i);
	        		if ($item->getAttribute('TIME_PERIOD') == date("Y-m-d")) {
	        			$tc = $item->getAttribute('OBS_VALUE') + 0.50;
	        			$fecha_tc = $item->getAttribute('TIME_PERIOD');
	        		}
	        	}
	        }
	        
	        $output = Array(
				'fecha_tc' => date("Y-m-d"),//$fecha_tc,
				'tc' => $tc
			);
			
			
	    }
    
	}
    
    return $output;
}


function obtenerTC_aux() {

	$resultado = '';
	$fecha_tc = '';
	$tc = '';

	$bConexionWS = true;

	$oClient = new SoapClient("http://www.banxico.org.mx:80/DgieWSWeb/DgieWS?WSDL");

	$resultado = $oClient->tiposDeCambioBanxico();

	$output = Array(
			'fecha_tc' => 'null',
			'tc' => 0
	);

	if ($bConexionWS) {

		if (!empty($resultado)) {
			$dom = new DomDocument();
			$dom->loadXML($resultado);
			$xmlDatos = $dom->getElementsByTagName("Obs");
			if ($xmlDatos->length > 1) {
				$item = $xmlDatos->item(1);
				$tc = $item->getAttribute('OBS_VALUE') + 0.50;
				$fecha_tc = $item->getAttribute('TIME_PERIOD');
				/*
				for ($i = 0; $i < $xmlDatos->length; $i++) {
					$item = $xmlDatos->item($i);
					if ($item->getAttribute('TIME_PERIOD') == date("Y-m-d")) {
						$tc = $item->getAttribute('OBS_VALUE') + 0.50;
						$fecha_tc = $item->getAttribute('TIME_PERIOD');
					}
				}
				*/
			}

			$output = Array(
					'fecha_tc' => date("Y-m-d"),//$fecha_tc,
					'tc' => $tc
			);
				
		}

	}

	return $output;
}

function obtenerTCDofGobMX() {
	
	$output = Array(
		'fecha_tc' => 'null',
		'tc' => 0
	);
	
	$current_date = date("Y-m-d");
	
	list($nAnnio, $nMes, $nDia) = explode('-', $current_date);
	
	$pagina_dofgobmx = file_get_contents("http://dof.gob.mx/indicadores_detalle.php?cod_tipo_indicador=158&dfecha=$nDia%2F$nMes%2F$nAnnio&hfecha=$nDia%2F$nMes%2F$nAnnio");
	
	echo $pagina_dofgobmx;
}

?>