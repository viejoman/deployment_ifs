<?php
// JSon Entries Global

include_once('../config.php');
include_once('../php/functions.php');
include_once('../class/iten.php');

$iten = new Iten ();

$mes = date("m");

$expimp = isset($_GET['expimp']) ? $_GET['expimp'] : 'imp';
$country = isset($_GET['country']) ? $_GET['country'] : 'undefine';

switch( $country ){
	case 'usa': $country = 'USA'; break;
	case 'cart': $country = 'Cartagena'; break;
	case 'callao': $country = 'Callao'; break;
	case 'brasil': $country = 'Brasil'; break;
	case 'urug': $country = 'Uruguay'; break;
	case 'bueaires': $country = 'Buenos Aires'; break;
	case 'ingland': $country = 'Inglaterra'; break;
	case 'esp': $country = 'España'; break;
	case 'rottr': $country = 'Rotterdam'; break;
	case 'amberes': $country = 'Amberes'; break;
	case 'itali': $country = 'Italia'; break;
	case 'india': $country = 'India'; break;
	case 'quing': $country = 'Quingdao'; break;
	case 'shang': $country = 'Shangai'; break;
	case 'tianjin': $country = 'Tianjin'; break;
	case 'taiwan': $country = 'Taiwan'; break;
	case 'hkong': $country = 'Hong Kong'; break;
	case 'sudaf': $country = 'Sudáfrica'; break;
	case 'marru': $country = 'Marruecos'; break;
	case 'egip': $country = 'Egipto'; break;
	case 'aust': $country = 'Australia'; break;
	case 'pana': $country = 'Panamá'; break;

	case 'rio': $country = 'Rio Jaina'; break;
	case 'buenaven': $country = 'Buenaventura'; break;
	case 'guaya': $country = 'Guayaquil'; break;
	case 'valpa': $country = 'Valparaiso'; break;
	case 'barca': $country = 'Barcelona'; break;
}

$output = $iten->getCountry($expimp, $country);

if( !$output ){
	$output = Array(
		'id' => 'nonot',
		'expimp' => $expimp,
		'country' => $country,
		'salida' => 'No disponible',
		'cierredoc' => 'No disponible'
	);
}

header('Content-type: text/javascript');
echo json_encode( $output );

?>