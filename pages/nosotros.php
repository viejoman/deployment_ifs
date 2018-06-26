<?php
include_once('../lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
?>
		<section id="nosotros">
			<article>
				<img src="img/logo.min.png" />
				<div>
					<h1>Neutral Maritime Services de México S.A. de C.V.</h1>
					<div><?php echo $label[$lang]['text']['aboutus']; ?></div>
				</div>
			</article>
		</section>