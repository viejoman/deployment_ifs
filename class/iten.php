<?php
// Itinerarios
class Iten
{
	private $_itid;
	private $_search;

	private $_db_server = db_server;
	private $_db_user = db_user;
	private $_db_pass = db_password;
	private $_db_bdata = db_bdata;
	private $_tb_iten = tb_itinerarios;

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

	// Getter

	public function itid (){
		return $this->_itid;
	}

	public function error (){
		return $this->_error;
	}

	public function consult ($what, $who, $by = 'itid') {
		switch($by){
			case 'id': $query = "SELECT `{$what}` FROM `{$this->_tb_iten}` WHERE `id` = '{$who}'"; break;
			default: $query = "SELECT `{$what}` FROM `{$this->_tb_iten}` WHERE `itid` = '{$who}'"; break;
		}
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return $result[$what];
			}
		}
	}

    public function listrByDiaMes ($expimp, $dia, $mes, $what) {
		$conexion = $this->_mysqli;

		$query = "SELECT * FROM `{$this->_tb_iten}` WHERE `expimp` = '{$expimp}' AND `mes` LIKE '%{$mes}%' AND  `{$what}` LIKE '%{$this->_search}%' ORDER BY `id` DESC";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			$res = Array();
			while($result = $get_data->fetch_assoc()){
				$res[] = Array(
					'id' => $result['itid'],
					'origen' => $result['origen'],
					'destino' => $result['destino'],
					'puerto' => $result['puerto'],
					'buque' => $result['buque'],
					'salida' => $result['salida'],
					'cierredoc' => $result['cierredoc'],
					'cierredesp' => $result['cierredesp'],
					'frecuencia' => $result['frecuencia'],
					'transito' => $result['transito'],
					'conexiones' => $result['conexiones'],
					'mes' => $result['mes']
				);
			}
			return $res;
		}
	}

public function listr ($expimp, $mes, $what) {
	
		$conexion = $this->_mysqli;

		date_default_timezone_set("America/Mexico_City");
		$currentYear = date("Y");
		
		if ($expimp == 'imp') {
		
		$query = "SELECT
		id
		,origen
		,destino
		,puerto
		,buque
		,DATE_FORMAT(STR_TO_DATE(salida, '%d-%m-%Y'),'%d/%m/%Y') salida
		,cierredoc
		,cierredesp
		,frecuencia
		,transito
		,conexiones
		,mes
		FROM `{$this->_tb_iten}` 
		WHERE 
			`expimp` = '{$expimp}' 		
			AND year(STR_TO_DATE(`salida`, '%d-%m-%Y')) = {$currentYear} 
			AND (month(STR_TO_DATE(`salida`, '%d-%m-%Y')) >= {$mes} AND month(STR_TO_DATE(`salida`, '%d-%m-%Y')) <= {$mes}+1) 
		ORDER BY  month(STR_TO_DATE(`salida`, '%d-%m-%Y')), origen, puerto, conexiones, STR_TO_DATE(`salida`, '%d-%m-%Y') ASC
		";
		
		} else {

		$query = "SELECT
		id
		,origen
		,destino
		,puerto
		,buque
		,DATE_FORMAT(STR_TO_DATE(salida, '%d-%m-%Y'),'%d/%m/%Y') salida
		,cierredoc
		,cierredesp
		,frecuencia
		,transito
		,conexiones
		,mes
		FROM `{$this->_tb_iten}` 
		WHERE 
			`expimp` = '{$expimp}' 		
			AND year(STR_TO_DATE(`salida`, '%d-%m-%Y')) = {$currentYear} 
			AND (month(STR_TO_DATE(`salida`, '%d-%m-%Y')) >= {$mes} AND month(STR_TO_DATE(`salida`, '%d-%m-%Y')) <= {$mes}+1)
		ORDER BY month(STR_TO_DATE(`salida`, '%d-%m-%Y')), destino, puerto, conexiones, STR_TO_DATE(`salida`, '%d-%m-%Y') ASC
		";
			
		}
		
		$_SESSION['SQListr'] = $query;
		$_SESSION['Operacion'] = $expimp;
		
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			$res = Array();
			while($result = $get_data->fetch_assoc()){
				$res[] = Array(
					'id' => $result['itid'],
					'origen' => $result['origen'],
					'destino' => $result['destino'],
					'puerto' => $result['puerto'],
					'buque' => $result['buque'],
					'salida' => $result['salida'],
					'cierredoc' => $result['cierredoc'],
					'cierredesp' => $result['cierredesp'],
					'frecuencia' => $result['frecuencia'],
					'transito' => $result['transito'],
					'conexiones' => $result['conexiones'],
					'mes' => $result['mes']
				);
			}
			return $res;
		}
	}
	
public function getItinerarios($expimp, $fechaini, $fechafin, $origdest=false, $puerto=false, $buque=false,  $what) {
		$conexion = $this->_mysqli;

		date_default_timezone_set("America/Mexico_City");
		$currentYear = date("Y");
		
		if ($expimp == 'imp') {
		
		$query = "SELECT
		id
		,origen origdest
		,puerto
		,buque
		,DATE_FORMAT(STR_TO_DATE(salida, '%d-%m-%Y'),'%d/%m/%Y') salida
		,cierredoc
		,cierredesp
		,frecuencia
		,transito
		,conexiones
		,mes
		FROM `{$this->_tb_iten}` 
		WHERE 
			`expimp` = '{$expimp}' 		
			AND (STR_TO_DATE(`salida`, '%d-%m-%Y') >= STR_TO_DATE('{$fechaini}','%d-%m-%Y') AND STR_TO_DATE(`salida`, '%d-%m-%Y') <= STR_TO_DATE('{$fechafin}','%d-%m-%Y'))
			".($origdest ? " AND origen LIKE '%{$origdest}%' " : " ") ."
			".($puerto ? " AND puerto LIKE '%{$puerto}%' " : " ") ." 
			".($buque ? " AND buque LIKE '%{$buque}%' " : " ") ."  
		ORDER BY  STR_TO_DATE(`salida`, '%d-%m-%Y'), origen, puerto, conexiones ASC
		";
		
		} else {

		$query = "SELECT
		id
		,destino origdest
		,puerto
		,buque
		,DATE_FORMAT(STR_TO_DATE(salida, '%d-%m-%Y'),'%d/%m/%Y') salida
		,cierredoc
		,cierredesp
		,frecuencia
		,transito
		,conexiones
		,mes
		FROM `{$this->_tb_iten}` 
		WHERE 
			`expimp` = '{$expimp}' 		
			AND (STR_TO_DATE(`salida`, '%d-%m-%Y') >= STR_TO_DATE('{$fechaini}','%d-%m-%Y') AND STR_TO_DATE(`salida`, '%d-%m-%Y') <= STR_TO_DATE('{$fechafin}','%d-%m-%Y'))
			".($origdest ? " AND destino LIKE '%{$origdest}%' " : " ") ." 
			".($puerto ? " AND puerto LIKE '%{$puerto}%' " : " ") ."  
			".($buque ? " AND buque LIKE '%{$buque}%' " : " ") ."  
		ORDER BY STR_TO_DATE(`salida`, '%d-%m-%Y'), destino, puerto, conexiones ASC
		";
			
		}
		
		$_SESSION['SQListr'] = $query;
		$_SESSION['Operacion'] = $expimp;
		
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			$res = Array();
			while($result = $get_data->fetch_assoc()){
				$res[] = Array(
					'id' => $result['itid'],
					'origdest' => $result['origdest'],
					'puerto' => $result['puerto'],
					'buque' => $result['buque'],
					'salida' => $result['salida'],
					'cierredoc' => $result['cierredoc'],
					'cierredesp' => $result['cierredesp'],
					'frecuencia' => $result['frecuencia'],
					'transito' => $result['transito'],
					'conexiones' => $result['conexiones'],
					'mes' => $result['mes']
				);
			}
			return $res;
		}
	}
	
	public function details ($itid) {
		$conexion = $this->_mysqli;

		$query = "SELECT * FROM `{$this->_tb_iten}` WHERE `itid` = '{$itid}'";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return Array(
					'id' => $result['itid'],
					'expimp' => $result['expimp'],
					'origen' => $result['origen'],
					'destino' => $result['destino'],
					'puerto' => $result['puerto'],
					'buque' => $result['buque'],
					'salida' => $result['salida'],
					'cierredoc' => $result['cierredoc'],
					'cierredesp' => $result['cierredesp'],
					'frecuencia' => $result['frecuencia'],
					'transito' => $result['transito'],
					'conexiones' => $result['conexiones'],
					'mes' => $result['mes']
				);
			}
		}
	}

	// $->consult( campo a buscar, contenido a buscar, campo devuelto)
	public function getCountry ($expimp, $country) {
		$conexion = $this->_mysqli;

		if ( $expimp == 'imp' ){
			$key = 'origen';
		}else{
			$key = 'destino';
		}

		$query = "SELECT * FROM `{$this->_tb_iten}` WHERE `expimp` = '{$expimp}' AND `{$key}` = '{$country}' ORDER BY `id` DESC";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return Array(
					'id' => $result['itid'],
					'expimp' => $expimp,
					'country' => $country,
					'salida' => $result['salida'],
					'cierredoc' => $result['cierredoc']
				);
			}
		}
	}

	public function getListCountry() {
	
		$conexion = $this->_mysqli;
	
		$aPaises = array();
	
	$query = <<<EOPAGE
	
		SELECT
			trim(origen) as pais  FROM `{$this->_tb_iten}`
	    WHERE
	    	origen != '' AND origen is not null AND origen != 'null'
		GROUP BY  origen
		UNION ALL
		SELECT
			trim(destino) as pais  FROM `{$this->_tb_iten}`
	    WHERE
	    	destino != '' AND destino is not null AND destino != 'null'
		GROUP BY  destino
	
EOPAGE;
		$conexion = $this->_mysqli;
			if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
	
			$aPaises[]=  Array('pais' => $result['pais']);
	
		}
		}
	
		return $aPaises;
	}
	
public function getListPuerto() {
	
		$conexion = $this->_mysqli;
	
		$aPuertos = array();
	
	$query = <<<EOPAGE
	
		SELECT
			trim(puerto) as puerto  FROM `{$this->_tb_iten}`
	    WHERE
	    	puerto != '' AND puerto is not null AND origen != 'null'
		GROUP BY  puerto;
	
EOPAGE;
		$conexion = $this->_mysqli;
			if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
	
			$aPuertos[]=  Array('puerto' => $result['puerto']);
	
		}
		}
	
		return $aPuertos;
	}
	
	// Setter

	public function search ($s){
		$this->_search = $s;
	}

	public function setItid ($itid) {
		$this->_itid = $itid;
	}

	// Functions

	public function insert ($data, $p_itid = false){
		$conexion = $this->_mysqli;

		if (!$p_itid)		
			$itid = genKey("itid");			
		else {
			if (isset($data["itid"])) {
				$itid = $data["itid"];
			} else {
				return false;
			}
		}
		
		$this->_itid = $itid;
				
		$expimp = $data['expimp'];
		$origen = $data['origen'];
		$destino = $data['destino'];
		$puerto = $data['puerto'];
		$buque = $data['buque'];
		$salida = $data['salida'];
		$cierredoc = $data['cierredoc'];
		$cierredesp = $data['cierredesp'];
		$frecuencia = $data['frecuencia'];
		$transito = $data['transito'];
		$conexiones = $data['conexiones'];

		if (!$p_itid) {
			session_start();
			$usuario = $_SESSION['user'];
		} else {
			$usuario = $data['user'];
		}
		
		$main = 'void';

		date_default_timezone_set("America/Mexico_City");
			$reg = date("w j-m-Y g:i:s:a");

		$mes = $data['mes'];

		$query = "INSERT INTO `{$this->_tb_iten}` (`itid`, `expimp`, `origen`, `puerto`, `destino`, `salida`, `buque`, `cierredoc`, `cierredesp`, `frecuencia`, `transito`, `conexiones`, `usuario`, `reg`, `mes`, `main`)"
			. "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
		;
		$ins = $conexion->prepare($query);
		$ins->bind_param( 'ssssssssssssssss', $itid, $expimp, $origen, $puerto, $destino, $salida, $buque, $cierredoc, $cierredesp, $frecuencia, $transito, $conexiones, $usuario, $reg, $mes, $main );
		$insert = $ins->execute();

		if ( !$insert ) {
			$this->_error = "No se pudo insertar nuevo itinerario";
			return false;
		}else{
			return true;
		}
	}

	public function updateThis ($itid, $data, $p_itid = false){
		$conexion = $this->_mysqli;

		$origen = $data['origen'];
		$destino = $data['destino'];
		$puerto = $data['puerto'];
		$buque = $data['buque'];
		$salida = $data['salida'];
		$cierredoc = $data['cierredoc'];
		$cierredesp = $data['cierredesp'];
		$frecuencia = $data['frecuencia'];
		$transito = $data['transito'];
		$conexiones = $data['conexiones'];

		if (!$p_itid) {
			session_start();
			$usuario = $_SESSION['user'];
		} else {
			$usuario = $data['user'];
		}

		date_default_timezone_set("America/Mexico_City");
			$reg = date("w j-m-Y g:i:s:a");

		$mes = $data['mes'];

		$query = "UPDATE `{$this->_tb_iten}` SET `origen` = ?, `puerto` = ?, `destino` = ?, `salida` = ?, `buque` = ?, `cierredoc` = ?, `cierredesp` = ?, `frecuencia` = ?, `transito` = ?, `conexiones` = ?, `usuario` = ?, `reg` = ?, `mes` = ? WHERE `itid` = '{$itid}'";
		$up = $conexion->prepare($query);
		$up->bind_param( 'sssssssssssss', $origen, $puerto, $destino, $salida, $buque, $cierredoc, $cierredesp, $frecuencia, $transito, $conexiones, $usuario, $reg, $mes );
		$upd = $up->execute();

		if ( !$upd ) {
			$this->_error = "No se pudo actualizar itinerario";
			return false;
		}else{
			return true;
		}
	}

	public function update ($what, $newVal){
		$conexion = $this->_mysqli;
		$query = "UPDATE `{$this->_tb_iten}` SET `{$what}` = ? WHERE `itid` = '{$this->_pid}'";
		$up = $conexion->prepare($query);
		$up->bind_param ( 's', $newVal );
		$upd = $up->execute();
		if ( !$upd ) {
			$this->_error = "No se pudo actualizar";
			return false;
		}else{
			return true;
		}
	}

	public function delete ($what){
		$conexion = $this->_mysqli;
		$query = "DELETE FROM `{$this->_tb_iten}` WHERE `itid` = '{$what}'";
		$conexion->query($query);
		return true;
	}

	public function count ($what = ''){
		$conexion = $this->_mysqli;
		switch($what){
			default: $sql = "SELECT * FROM `{$this->_tb_iten}`"; break;
		}
		$conexion->query($sql);
		return $conexion->affected_rows;
	}

	public function close (){
		$conexion = $this->_mysqli;
		$conexion->close();
	}
}