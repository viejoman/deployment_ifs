<?php
include_once('../lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
?>
		<section id="coti">
			<article>
				<h1>Envianos tu  cotización</h1>
				<p>una operadora se hara cargo de tu solicitud <br />y te contestaremos en la brevedad posible.</p>
			</article>
			<form action="#" method="post">
				<div>
					<p>
						<label>Nombre</label>
						<input type="text" name="nombre" />
					</p>
					<p>
						<label>Email</label>
						<input type="email" name="email" />
					</p>
					<p>
						<label>Cargo</label>
						<input type="text" name="cargo" />
					</p>
					<p>
						<label>Teléfono</label>
						<input type="tel" name="tel" />
					</p>
					<p>
						<label>Estado</label>
						<input type="text" name="estado" />
					</p>
					<p>
						<label>N° de bultos</label>
						<input type="text" name="bultos" />
					</p>
					<p>
						<label>Volumen m<sup>3</sup></label>
						<input type="text" name="volumen" />
					</p>
				</div>
				<div>
					<p>
						<label>Dirección</label>
						<input type="text" name="direccion" />
					</p>
					<p>
						<label>Empresa</label>
						<input type="text" name="empresa" />
					</p>
					<p>
						<label>Giro</label>
						<input type="text" name="giro" />
					</p>
					<p>
						<label>Ciudad</label>
						<input type="text" name="ciudad" />
					</p>
					<p>
						<label>País</label>
						<input type="text" name="pais" />
					</p>
					<p>
						<label>Peso mercancía</label>
						<input type="text" name="pesomercancia" />
					</p>
					<p>
						<label>Tipo mercancía</label>
						<input type="text" name="tipomercancia" />
					</p>
				</div>
				<div>
					<p>
						<label class="solito">Cometarios</label>
						<textarea name="comentarios"></textarea>
					</p>
					<p>
						<button>Enviar</button>
					</p>
				</div>
			</form>
		</section>