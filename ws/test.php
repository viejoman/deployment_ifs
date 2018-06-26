<?php 

date_default_timezone_set('America/Mexico_City');

/* The following code snippet with set the maximum execution time
 * of your script to 300 seconds (5 minutes)
 * Note: set_time_limit() does not work with safe_mode enabled
 */

/*
$safeMode = ( @ini_get("safe_mode") == 'On' || @ini_get("safe_mode") === 1 ) ? TRUE : FALSE;
if ( $safeMode === FALSE ) {
	set_time_limit(300); // Sets maximum execution time to 5 minutes (300 seconds)
	// ini_set("max_execution_time", "300"); // this does the same as "set_time_limit(300)"
}

echo "max_execution_time " . ini_get('max_execution_time') . "<br>";
*/
require_once('../class/cEnvioMail.php');

//----------------------------------------------
$sTo="rodolfo.ortiz.mtz@gmail.com";
$sFrom="info@ifsmexico.com";
$sSubject ="Cotizacion enviada por el servicio: Notificacion IFS";
//$host = "smtp.ver.ifsneutral.com";
//--//--------------------------------------------

echo "TEST DESDE LA PAGINA <br />";

$sMensaje = "Prueba Notificacion IFS desde la p&aacute;gina web";
/*
$errno = -1;
$errstr = "";

$socket = fsockopen("ssl://".$host, 465, $errno, $errstr, 10);
if(!$socket)
{
	echo "ERROR: $host 465 - $errstr ($errno)<br>\n";
}
else
{
	echo "SUCCESS: $host 465 - ok<br>\n";
}

$socket = fsockopen($host, 587, $errno, $errstr, 10);
if(!$socket)
{
	echo "ERROR: $host 587 - $errstr ($errno)<br>\n";
}
else
{
	echo "SUCCESS: $host 587 - ok<br>\n";
}

$socket = fsockopen($host, 25, $errno, $errstr, 10);
if(!$socket)
{
	echo "ERROR: $host 25 - $errstr ($errno)<br>\n";
}
else
{
	echo "SUCCESS: $host 25 - ok<br>\n";
}
*/

//enviarEmail($sTo, $sFrom, false, $sSubject, $sMensaje);

/*
echo md5("1234") . "<br/>";
$str = md5("1234")."|d".date("z")."|".date("Y");
echo $str."<br />";
echo sha1($str);

echo "<br/>";

//echo (sha1($str) == "e") ? "OKAY" : "FAIL";

echo "<br/>";

echo base64_encode(sha1($str));


echo "<br/>".date("z");
echo "<br/>".date("Y");

//$headers = "From: auximpo@ver.ifsneutral.com";
//mail("rodolfo.ortiz.mtz@gmail.com", "Testing", "TEST", $headers);
*/

function enviarEmail($sTo, $sFrom, $sCopiaPara=false, $sSubject, $sContenido) {
		
		$oMail = new cEnvioMail($sTo,$sFrom,$sSubject);		
		$oMail->authenticateSmtp("info@ifsmexico.com","InfoIfsmexico1");
		
			//$oMail->agregarCC('jennybuenrostro@gmail.com','Responsable');
		
		//$sImg = $oMail->agregarImgBody("/var/www/html/imgs/logo_proceda_small.png", 'logo.png', 'Logo.png');
			$sImg = "<IMAGEN>";
		$sMensaje = "";
		$sMensaje = "<font face=\"fixedsys\" style=\"color:red\">[".date("d/m/Y H:i:s")."] ".$sContenido."</font><br />";
		$sMensaje = $sMensaje."<br />
				<div align=\"center\">
				<p style=\"color: #3333CC; font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif;
				font-weight: bold;\">Notificaci&oacute;n IFS<br />
				".$sImg."<br />					
				</div>";
		$oMail->agregarContenido($sMensaje);
		echo "Enviar Mail<br/>";
		$oMail->enviar();
		echo $oMail->getError();
		return true;
		
} //endFunction enviarEmail

?>