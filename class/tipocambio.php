<?php
// Tipo de Cambio
class TipoCambio
{
	private $_itid;
	private $_search;

	private $_db_server = db_server;
	private $_db_user = db_user;
	private $_db_pass = db_password;
	private $_db_bdata = db_bdata;
	private $_tb_tipocambio = tb_tipocambio;

	private $_mysqli;
	private $_error = "No hay error";

	public function __construct (){
		$mysqli = new mysqli($this->_db_server, $this->_db_user, $this->_db_pass, $this->_db_bdata);
		if ( mysqli_connect_errno ()) {
			$this->_error = "No se pudo conectar con la base de datos";
			return false;
		}else{
			$this->_mysqli = $mysqli;
			return true;
		}
	}
	
	public function getByDate($date_search) {
		$conexion = $this->_mysqli;

		$query = "SELECT * FROM `{$this->_tb_tipocambio}` WHERE fecha_publicacion = '".$date_search."' ORDER BY fecha_publicacion LIMIT 1";

		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return Array(
					'fecha_tc' => $result['fecha_publicacion'],
					'tc' => $result['valor']
				);
			}
		}
	}
	
	public function insert($data) {
	
		$conexion = $this->_mysqli;
		
		$fecha_publicacion = $data['fecha_tc'];
		$tipocambio = $data['tc'];
		
		date_default_timezone_set("America/Mexico_City");
		
		$query = "INSERT INTO `{$this->_tb_tipocambio}` (`fecha_publicacion`, `valor`) VALUES (?, ?)";
		
		$ins = $conexion->prepare($query);
		$ins->bind_param('ss', $fecha_publicacion, $tipocambio);
		$insert = $ins->execute();

		if ( !$insert ) {
			$this->_error = "No se pudo insertar nuevo itinerario";
			return false;
		}else{
			return true;
		}
		
	}

}

?>