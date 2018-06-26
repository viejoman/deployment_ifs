var _toolTipItinerarioTemplate = "Proxima Salida:<br/>{$proximasalida}<br/>Cierre Doc.:<br/>{$cierredoc}";

'use strict';
$(function () {
	
	/* jVector Maps
	   * ------------
	   * Create a world map with markers
	   */
	  
	  var _markers_expo = [
	                       
	{latLng: [37.09, -95.71], name: 'USA', id: 'usa', ofsx: 2, ofsy: 0},
	{latLng: [37.62, -0.99], name: 'Cartagena', id: 'cart', ofsx: 2, ofsy: 5},
	{latLng: [-12.05, -77.12], name: 'Callao', id: 'callao', ofsx: -10, ofsy: -15},
	{latLng: [-14.23, -51.92], name: 'Brasil', id: 'brasil', ofsx: 0, ofsy: -10},
	{latLng: [-32.52, -55.76], name: 'Uruguay', id: 'urug', ofsx: -10, ofsy: -12},
	{latLng: [-34.60, -58.38], name: 'Buenos Aires', id: 'bueaires', ofsx: -5, ofsy: 15},
	{latLng: [52.35, -1.17], name: 'Inglaterra', id: 'ingland', ofsx: -80, ofsy: -15},
	{latLng: [40.46, -3.74], name: 'Espa\u00f1a', id: 'esp', ofsx: -60, ofsy: -15},
	{latLng: [51.94, 4.14], name: 'Rotterdam', id: 'rottr', ofsx: 0, ofsy: -15},
	{latLng: [51.21, 4.40], name: 'Amberes', id: 'amberes', ofsx: 2, ofsy: 0},
	{latLng: [41.87, 12.56], name: 'Italia', id: 'itali', ofsx: 2, ofsy: 0},
	 {latLng: [26.90, 76.35], name: 'India', id: 'india', ofsx: 2, ofsy: 0},
	 {latLng: [36.06, 120.38], name: 'Quingdao', id: 'quing', ofsx: 2, ofsy: -5},
	 {latLng: [31.23, 121.47], name: 'Shangai', id: 'shang', ofsx: 2, ofsy: 0},
	 {latLng: [39.08, 117.20], name: 'Tianjin', id: 'tianjin', ofsx: -5, ofsy: -15},
	 {latLng: [23.69, 120.96], name: 'Taiwan', id: 'taiwan', ofsx: 2, ofsy: 0},
	 {latLng: [22.31, 114.04], name: 'Hong Kong', id: 'hkong', ofsx: -10, ofsy: 15},
	 {latLng: [-30.55, 22.93], name: 'Sudafrica', id: 'sudaf', ofsx: 2, ofsy: 0},
	 {latLng: [31.79, -7.09], name: 'Marruecos', id: 'marru', ofsx: -80, ofsy: 15},
	 {latLng: [26.82, 30.80], name: 'Egipto', id: 'egip', ofsx: 2, ofsy: 0},
	 {latLng: [-25.27, 133.77], name: 'Australia', id: 'aust', ofsx: 2, ofsy: 0},
	 {latLng: [8.53, -80.78], name: 'Panama', id: 'pana', ofsx: 2, ofsy: 0}
	     
	 ];

	 var _markers_impo = [

		{latLng: [37.62, -0.99], name: 'Cartagena', id: 'cart', ofsx: 2, ofsy: 5},
		{latLng: [-12.05, -77.12], name: 'Callao', id: 'callao', ofsx: 2, ofsy: 0},
		{latLng: [-34.60, -58.38], name: 'Buenos Aires', id: 'bueaires', ofsx: 2, ofsy: 0},
		{latLng: [51.94, 4.14], name: 'Rotterdam', id: 'rottr', ofsx: -5, ofsy: -10},
		{latLng: [31.23, 121.47], name: 'Shangai', id: 'shang', ofsx: 2, ofsy: 0},
		{latLng: [18.42, -70.01], name: 'Rio Haina', id: 'rio', ofsx: 2, ofsy: 0},
		{latLng: [3.88, -77.07], name: 'Buenaventura', id: 'buenaven', ofsx: -5, ofsy: -10},
		{latLng: [-2.20, -79.89], name: 'Guayaquil', id: 'guaya', ofsx: 2, ofsy: 0},
		{latLng: [-33.04, -71.61], name: 'Valparaiso', id: 'valpa', ofsx: -5, ofsy: -10},
		{latLng: [41.38, 2.17], name: 'Barcelona', id: 'barca', ofsx: -5, ofsy: -10}

	 ];
	 
	 var _markers = _markers_impo;

	 var
	 m_expimp = 'exp',
	 changemap = function(ExpImp){
		$('#btnimp, #btnexp').removeClass('active');
		$('#btn' + ExpImp).addClass('active');	
		m_expimp = ExpImp;
		
		$('#world-map-markers').off().empty();
	       $('.jvectormap-label').remove();
	       
	       init(ExpImp);
	 };

	 init = function (ExpImp) {
		  
		  _markers = ExpImp == 'imp' ? _markers_impo : _markers_expo;
		  
		  var _color_marker = ExpImp == 'imp' ? '#eb4228' : '#00a65a';
		  
		  $('#world-map-markers').vectorMap({
		    map: 'world_mill_en',
		    /*
		    onRegionClick:function(event, code, region){ 
		    	alert("code: "+ code +", region: " + region);
		    },
		    */
		    normalizeFunction: 'polynomial',
		    hoverOpacity: 0.7,
		    hoverColor: false,
		    backgroundColor: 'transparent',
		    regionStyle: {
		      initial: {
		        fill: 'rgba(210, 214, 222, 1)',
		        "fill-opacity": 1,
		        stroke: 'none',
		        "stroke-width": 0,
		        "stroke-opacity": 1
		      },
		      hover: {
		        "fill-opacity": 0.7,
		        cursor: 'pointer'
		      },
		      selected: {
		        fill: 'yellow'
		      },
		      selectedHover: {
		      }
		    },
		    onRegionOver: function(e, code) {
		    	e.preventDefault();
		    },
		    onRegionOut: function(e, code) {
		    	e.preventDefault();
		    },
		    onMarkerOut: function(e, code) {
		        document.body.style.cursor = 'default';
		    },
		    onMarkerOver: function(e, code) {
		        document.body.style.cursor = 'pointer';
		    },
		    /*i don't want to show country name when mouse hover over the map.*/
		    /*
		    onRegionTipShow: function (e, el, code) {
		        e.preventDefault();
		    },
		    */
		    /*
		    onMarkerClick: function(event, index) {
		        alert(_markers[index].name);
		    },
		    */
		    markerStyle: {
		      initial: {
		    	  fill: _color_marker,
		    	  stroke: '#111'
		      },
		      hover: {
		    	  fill: '#000'
		      }
		    },
		    markers: _markers,
		    labels : {
		    	markers: {
		            render: function(index){
		            	return  _markers[index].name;
		            },
		            offsets: function(index){
		                var offset = [0, 0];
		                return [offset[0] + _markers[index].ofsx , offset[1] + _markers[index].ofsy];
		              }
		        }
		    },    
		    onMarkerTipShow: function(event, label, code) {
		    	
		    	//event.preventDefault();
		    	
		    	var _label = label.html();
		    	label.html('');
		    	var namecountry = _markers[code].id == 'esp' ? "Espa&ntilde;a" : _markers[code].name;
		    	
		    	label.html(namecountry);
		    	//var _splitLabel = _label.split('|');   
		    	
		    	var v_expimp = ExpImp;
		    	var v_country =  _markers[code].id;
		    	
		    	var urlJson = 'iten/json/listmap.php?expimp=' + v_expimp + '&country=' + v_country;
		    	
		  		$.getJSON( urlJson,
					function(res){
		  				$('#tituloItinerario').html(namecountry);
		  				var _toolTipAux = getItinerarioTemplateToolTip(_markers[code].name, res.salida, res.cierredoc);
		  				$('#descItinerario').html(_toolTipAux);
					}
				)
		  		
		    }
		    
		  });

	 }
	  
	  $('#btnimp').click(function(e){
			e.preventDefault();
			changemap('imp');
		});
		$('#btnexp').click(function(e){
			e.preventDefault();
			changemap('exp');
	  });
	  
	  init(m_expimp);

	
});



function getItinerarioTemplateToolTip(label, proximasalida, cierredoc) {
  //$('#labelVisitas').html(label);
  var _toolTipItinerarioTemplate_aux = _toolTipItinerarioTemplate;
  return _toolTipItinerarioTemplate_aux.replace('{$label}', label).replace('{$proximasalida}', proximasalida).replace('{$cierredoc}', cierredoc);
}