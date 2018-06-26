<?php
include_once('../lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
?>

		<section id="principal" style="background: url('img/principal_<?php echo $lang; ?>.jpg');">
			<!-- <img src="img/logo.png" /> -->		
		</section>