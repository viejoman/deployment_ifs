<?php
// Usuario
class User
{
	private $_uid;
	private $_user;

	private $_db_server = db_server;
	private $_db_user = db_user;
	private $_db_pass = db_password;
	private $_db_bdata = db_bdata;
	private $_tb_users = tb_users;

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

	public function uid (){
		return $this->_uid;
	}

	public function error (){
		return $this->_error;
	}

	public function consult ($what, $key = "username") {
		if ( $what == "password" ){
			$this->_error = "No se puede consultar este dato";
			return false;
		}else{
			switch( $key ){
				case "uid": $query = "SELECT `{$what}` FROM `{$this->_tb_users}` WHERE `uid` = '{$this->_uid}'"; break;
				default: $query = "SELECT `{$what}` FROM `{$this->_tb_users}` WHERE `username` = '{$this->_user}'"; break;
			}
			$conexion = $this->_mysqli;
			if ($get_data = $conexion->query($query)){
				while($result = $get_data->fetch_assoc()){
					return $result[$what];
				}
			}
		}
	}

	private function _password () {
		$query = "SELECT `password` FROM `{$this->_tb_users}` WHERE `username` = '{$this->_user}'";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return $result['password'];
			}
		}
	}

	public function password () {
		$query = "SELECT `password` FROM `{$this->_tb_users}` WHERE `username` = '{$this->_user}'";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return $result['password'];
			}
		}
	}
	
	
	// Setter

	public function setUid ($uid) {
		$this->_uid = $uid;
		$this->_user = $this->consult("username", "uid");
	}

	public function setUser ($user) {
		$this->_user = $user;
		$this->_uid = $this->consult("uid");
	}

	// Functions

	public function register ($data){
		$conexion = $this->_mysqli;

		$uid = genKey("uid");
			$this->_uid = $uid;

		$this->_user = $data['username'];

		$pass = md5($data['pass']);
		
		date_default_timezone_set("America/Mexico_City"); 
		$date = date("j-m-Y");

		$permisos = "all";

		$query = "INSERT INTO `{$this->_tb_users}` (`uid`, `nombre`, `username`, `password`, `reg`, `permisos`)"
			. "VALUES (?, ?, ?, ?, ?, ?)"
		;
		$ins = $conexion->prepare($query);
		$ins->bind_param( 'ssssss', $uid, $data['nombre'], $data['username'], $pass, $date, $permisos );
		$insert = $ins->execute();

		if ( !$insert ) {
			$this->_error = "No se pudo registrar usuario";
			return false;
		}else{
			return true;
		}
	}

	public function exist ( $who ){
		$conexion = $this->_mysqli;
		$sql = "SELECT `username` FROM `{$this->_tb_users}` WHERE `username` = '{$who}'";
		$conexion->query($sql);
		if ( $conexion->affected_rows > 0 ){
			return true;
		}else{
			return false;
		}
	}

	private function _update ($what, $newVal){
		$conexion = $this->_mysqli;
		$query = "UPDATE `{$this->_tb_users}` SET `{$what}` = ? WHERE `username` = '{$this->_user}'";
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

	public function chagepassword ( $lastPass, $newPass ){
		if ( $this->_password() == md5($lastPass) ){
			$update = $this->_update('password', md5($newPass) );
			if ($update){
				return true;
			}else{
				$this->_error = "Hubo un error inesperado";
				return false;
			}
		}else{
			$this->_error = "No tienes el permiso para modificar este dato";
			return false;
		}
	}

	public function login ($pass){
		if ( $this->_password() == md5($pass) ){
			$_SESSION['login'] = 1;
			return true;
		}else{
			$this->_error = "La contraseña no coincide";
			return false;
		}
	}

	public function logout (){
		$_SESSION['login'] = 0;
		return true;
	}

	public function close (){
		$conexion = $this->_mysqli;
		$conexion->close();
	}
}