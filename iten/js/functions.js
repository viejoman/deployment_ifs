
var d = new Date(), m = d.getMonth(), y = d.getFullYear();
	m = m +1;
	if( m < 10 ){ m = '0' + m; }
var
	expimp = 'exp', f = 'main', s = 'void',
	exito = '<div class="alert alert-success"><button class="close" data-dismiss="alert">Ã—</button>Se ha actualizado el itinerario con exito.</div>',
	error = '<div class="alert alert-error"><button class="close" data-dismiss="alert">Ã—</button>No se pudo actualizar el itinerario.<br >{r}</div>',

	exito_u = '<div class="alert alert-success"><button class="close" data-dismiss="alert">Ã—</button>Se ha registrado el usuario con exito.</div>',
	error_u = '<div class="alert alert-error"><button class="close" data-dismiss="alert">Ã—</button>No se pudo resgistrar el usuario.<br >{r}</div>',

	exito_p = '<div class="alert alert-success"><button class="close" data-dismiss="alert">Ã—</button>Se ha cambiado la contraseÃ±a con exito.</div>',
	error_p = '<div class="alert alert-error"><button class="close" data-dismiss="alert">Ã—</button>No se pudo cambiar la contraseÃ±a.<br >{r}</div>',
	listIten = function (){
		var path;
		m = m + '|' + y;
		switch(expimp){
			case 'imp': path = 'apps/listImp.php?m=' + m + '&f=' + f + '&s=' + s; break;
			case 'exp': path = 'apps/listExp.php?m=' + m + '&f=' + f + '&s=' + s; break;
		}
		$('#listIten').html('<h6>Cargando ...</h6>')
			.load(path);
	},
	newIten = function (_expimp){
		var path;
		switch(_expimp){
			case 'imp': path = 'apps/newImp.php'; break;
			case 'exp': path = 'apps/newExp.php'; break;
		}
		$('#newIten').html('<h6>Cargando ...</h6>')
			.load(path);
	},
	format_date = function( _da ){
		var _mess,
			_dia = _da.split('-')[0],
			_mes = _da.split('-')[1],
			_ani = _da.split('-')[2];

		switch(_mes){
			case '01': _mess = 'enero'; break;
			case '02': _mess = 'febrero'; break;
			case '03': _mess = 'marzo'; break;
			case '04': _mess = 'abril'; break;
			case '05': _mess = 'mayo'; break;
			case '06': _mess = 'junio'; break;
			case '07': _mess = 'julio'; break;
			case '08': _mess = 'agosto'; break;
			case '09': _mess = 'septiembre'; break;
			case '10': _mess = 'octubre'; break;
			case '11': _mess = 'noviembre'; break;
			case '12': _mess = 'diciembre'; break;
		}
		var res = _dia + ' de ' + _mess + ' del ' + _ani;
		return res;
	},
	n2month = function( _da ){
		var _mess,
			_dia = _da.split('-')[0],
			_mes = _da.split('-')[1],
			_ani = _da.split('-')[2];

		switch(_mes){
			case '01': _mess = 'Enero'; break;
			case '02': _mess = 'Febrero'; break;
			case '03': _mess = 'Marzo'; break;
			case '04': _mess = 'Abril'; break;
			case '05': _mess = 'Mayo'; break;
			case '06': _mess = 'Junio'; break;
			case '07': _mess = 'Julio'; break;
			case '08': _mess = 'Agosto'; break;
			case '09': _mess = 'Septiembre'; break;
			case '10': _mess = 'Octubre'; break;
			case '11': _mess = 'Noviembre'; break;
			case '12': _mess = 'Diciembre'; break;
		}
		return _mess;
	};