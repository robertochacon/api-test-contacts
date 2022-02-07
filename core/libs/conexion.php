<?php

require('./vendor/autoload.php');

class Conexion{

	private $host = null;
	private $user = null;
	private $pass = null;
	private $db = null;

	public static $objeto = null;
	public $conn;
 
	public function getConexion(){
		if (self::$objeto == null) {
			self::$objeto = new Conexion();
		}

		return self::$objeto->conn;
	}

	public function __construct(){

		$dotenv = Dotenv\Dotenv::createImmutable("./");
		$dotenv->load();

		$this->host = $_ENV['HOST'];
		$this->user = $_ENV['DB_USER'];
		$this->pass = $_ENV['DB_PASS'];
		$this->db = $_ENV['DB_NAME'];

		$this->conn =  mysqli_connect($this->host,$this->user,$this->pass,$this->db) or die("sin conexion.");
	}

	public function ejecutar($sql){
		$cx = self::getConexion();
		$query = mysqli_query($cx, $sql);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function consultar($sql){
		$cx = self::getConexion();
		$ResultSet = mysqli_query($cx, $sql);
		$resultado = array();
		foreach($ResultSet as $filas) {
			$resultado[] = $filas;
		}
		return $resultado;
	}

	public function __destruct(){
		mysqli_close($this->conn);
	}

}

?>