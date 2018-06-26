(function($) {
	$.fn.mapop = function(options) {

		return this.each(function() {
			$('body').click(function(){ $('#map_popup').remove(); });

			$(this).click(function(e){
				e.preventDefault()
				this.focus();
			})
			.focus(function(){

				var popup = '<div id="map_popup"><dl><dt>Próximas salidas</dt><dd>' + options.salidas + '</dd></dl><dl><dt>Cierre doc</dt><dd>' + options.cierre + '</dd></dl><a href="iten/this">Ver más</a></div>',
					pos = $(this).position();
				$('#map_popup').css({
					'top': pos.top + 10 + 'px',
					'left': pos.left - 15 + 'px'
				})
				$('body').append(popup);
			})
			.blur(function(){
				$('#map_popup').remove();
			});
		});
	};
})(jQuery);