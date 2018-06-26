<?php
include_once('../lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
?>
		<script>
		var
			m_expimp = 'exp',
			changemap = function(ExpImp){
				$('#btnimp, #btnexp').removeClass('active');
				$('#btn' + ExpImp).addClass('active');
				$('.points').hide();
				$('#' + ExpImp).show();
				m_expimp = ExpImp;
			}
		;
		jQuery(function(){

			$('#btnimp').click(function(e){
				e.preventDefault();
				changemap('imp');
			});
			$('#btnexp').click(function(e){
				e.preventDefault();
				changemap('exp');
			});

			$('.points li').hover(function(){
				var popupito = '<div class="map_popup"><dl><dt>Próximas salidas</dt><dd>{salidas}</dd></dl><dl><dt>Cierre doc</dt><dd>{cierredoc}</dd></dl><a href="iten/?view={itid}">Ver más</a></div>',
					urlJson = 'iten/json/listmap.php?expimp=' + m_expimp + '&country=' + $(this).attr('rel');
				var estee = $(this);
				$.getJSON( urlJson,
					function(res){
						popupito = popupito.replace('{itid}', res.id).replace('{salidas}', res.salida).replace('{cierredoc}', res.cierredoc);
						estee.append(popupito);

						$('#map_popup').css({
							'display': 'block'
						});
					}
				);
			},function(){
				$('#map_popup').remove();
			});
		});
		</script>
		<section id="mapa">
			<ul class="botonera">
				<li><a id="btnimp" href="#importados">Importacion</a></li>
				<li><a id="btnexp" class="active" href="#exportados">Exportacion</a></li>
			</ul>
			<img src="img/mapa.png" />
			<ul class="points" id="exp">
				<li rel="usa"><a href="#" class="dot"></a><span>USA</span></li>
				<li rel="cart"><span class="dot"></span><span>Cartagena</span></li>
				<li rel="callao"><span class="dot"></span><span>Callao</span></li>
				<li rel="brasil"><span class="dot"></span><span>Brasil</span></li>
				<li rel="urug"><span class="dot"></span><span>Uruguay</span></li>
				<li rel="bueaires"><span class="dot"></span><span class="voltear">Buenos Aires</span></li>
				<li rel="ingland"><span class="dot"></span><span class="voltear">Inglaterra</span></li>
				<li rel="esp"><span class="dot"></span><span class="voltear">España</span></li>
				<li rel="rottr"><span class="dot"></span><span>Rotterdam</span></li>
				<li rel="amberes"><span class="dot"></span><span>Amberes</span></li>
				<li rel="itali"><span class="dot"></span><span>Italia</span></li>
				<li rel="india"><span class="dot"></span><span>India</span></li>
				<li rel="quing"><span class="dot"></span><span class="voltear">Quingdao</span></li>
				<li rel="shang"><span class="dot"></span><span>Shangai</span></li>
				<li rel="tianjin"><span class="dot"></span><span>Tianjin</span></li>
				<li rel="taiwan"><span class="dot"></span><span class="voltear">Taiwan</span></li>
				<li rel="hkong"><span class="dot"></span><span>Hong Kong</span></li>

				<!-- Aqui agregue mas -->
				<li rel="sudaf"><span class="dot"></span><span>Sudáfrica</span></li>
				<li rel="marru"><span class="dot"></span><span class="voltear">Marruecos</span></li>
				<li rel="egip"><span class="dot"></span><span>Egipto</span></li>
				<li rel="aust"><span class="dot"></span><span>Australia</span></li>
				<li rel="pana"><span class="dot"></span><span class="voltear">Panamá</span></li>
			</ul>
			<ul class="points" id="imp" style="display: none;">
				<li rel="cart"><span class="dot"></span><span>Cartagena</span></li>
				<li rel="callao"><span class="dot"></span><span>Callao</span></li>
				<li rel="bueaires"><span class="dot"></span><span>Buenos Aires</span></li>
				<li rel="rottr"><span class="dot"></span><span>Rotterdam</span></li>
				<li rel="shang"><span class="dot"></span><span>Shangai</span></li>
				<li rel="rio"><span class="dot"></span><span>Rio Jaina</span></li>
				<li rel="buenaven"><span class="dot"></span><span class="voltear">Buenaventura</span></li>
				<li rel="guaya"><span class="dot"></span><span>Guayaquil</span></li>
				<li rel="valpa"><span class="dot"></span><span>Valparaiso</span></li>
				<li rel="barca"><span class="dot"></span><span>Barcelona</span></li>
			</ul>
		</section>