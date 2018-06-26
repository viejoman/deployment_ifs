<?php
include_once('../lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
?>
		<section id="servicios">
			<div id="slide">
				<div class="slide" style="background: url('img/bgBarco3.jpg');">
					<article>
						<h1><?php echo $label[$lang]['text']['services']['tab1']['title']; ?></h1>
						<p><?php echo $label[$lang]['text']['services']['tab1']['text']; ?></p>
					</article>
				</div>
				<div class="slide" style="background: url('img/bgCamion2.jpg');">
					<article>
						<h1><?php echo $label[$lang]['text']['services']['tab2']['title']; ?></h1>
						<p><?php echo $label[$lang]['text']['services']['tab2']['text']; ?></p>
					</article>
				</div>
				<div class="slide" style="background: url('img/bgBarco2.jpg');">
					<article>
						<h1><?php echo $label[$lang]['text']['services']['tab3']['title']; ?></h1>
						<p><?php echo $label[$lang]['text']['services']['tab3']['text']; ?></p>
					</article>
				</div>
			</div>
			<div id="sArrows">
				<a href="#" id="ar"><img src="img/right-arrow.png" /></a>
				<a href="#" id="al" style="display: none;"s><img src="img/left-arrow.png" /></a>
			</div>
		</section>