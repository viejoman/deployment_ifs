<?php
class Directorio 
{
	
	private $_itid;
	private $_search;

	private $_db_server = db_server;
	private $_db_user = db_user;
	private $_db_pass = db_password;
	private $_db_bdata = db_bdata;
	private $_tb_oficina = tb_oficina;
	private $_tb_empleado = tb_empleado;
	private $_tb_puesto = tb_puesto;

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
	
	public function getAllOficinas () {
		$conexion = $this->_mysqli;

		$query = "SELECT * FROM `{$this->_tb_oficina}` ORDER BY `idoficina` DESC";
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
			while($result = $get_data->fetch_assoc()){
				return Array(
					'idoficina' 		=> $result['idoficina'],
					'oficina' 			=> $result['oficina'],
					'direccion' 		=> $result['direccion'],
					'colonia' 			=> $result['colonia'],
					'cp' 				=> $result['cp'],
					'telefono' 			=> $result['telefono'],
					'extension' 		=> $result['extension'],
					'fax' 				=> $result['fax'],
					'ciudad' 			=> $result['ciudad'],
					'estado' 			=> $result['estado'],
					'pais' 				=> $result['pais'],
					'idoficina_matriz' 	=> $result['idoficina_matriz']
				);
			}
		}
	}
	
	public function getAllEmpleadosByIdOficina ($idoficina) {
		$conexion = $this->_mysqli;

		$aListaEmpleados = array();
		
$query = <<<EOPAGE
		SELECT 
			emp.idempleado as idempleado
			,emp.nombre as nombre
			,emp.correoe as correoe
			,oficina.telefono as telefono
			,emp.extension as extension
			,emp.movil as movil
			,emp.idoficina as idoficina
			,emp.idpuesto as idpuesto
			,puesto.nombre as nompuesto
		FROM 
			{$this->_tb_empleado} emp
			inner join {$this->_tb_puesto} puesto
			on emp.idpuesto = puesto.idpuesto
			inner join {$this->_tb_oficina} oficina
			on emp.idoficina = oficina.idoficina
		WHERE 
			emp.idoficina = {$idoficina}
			and emp.activo = 1 
		ORDER BY emp.idempleado ASC
EOPAGE;
		$conexion = $this->_mysqli;
		if ($get_data = $conexion->query($query)){
								
			while($result = $get_data->fetch_assoc()){
				$aListaEmpleados[] =  Array(
					'idempleado' 		=> $result['idempleado'],
					'nombre' 			=> $result['nombre'],
					'correoe' 			=> isset($result['correoe']) ? $result['correoe'] : "&nbsp;" ,
					'telefono' 			=> isset($result['telefono']) ? $result['telefono'] : "&nbsp;" ,
					'extension' 		=> isset($result['extension']) ? $result['extension'] : "&nbsp;" ,
					'movil' 			=> isset($result['movil']) ? $result['movil'] : "&nbsp;" ,
					'idoficina' 		=> $result['idoficina'],
					'idpuesto' 			=> $result['idpuesto'],
					'nompuesto' 		=> $result['nompuesto']
				
				);
			}
			
			
			 
		}
		
		return $aListaEmpleados;
	}
	
	
	
}

?> 