<?php
//	Brandon Zhou
//	CS160 OSD Project

class Database {
	//	Private variables for the database details and credentials
	private $host = "localhost";
	private $db_name = "officesupplydepot";
	private $username = "root";
	private $password = "";

	//	$conn is the variable that is important for external use, effectively returns the database
	public $conn;

	public function getConn() {
		$this->conn = null;

		try {
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			echo "Connected to database successfully.<br>";
		} catch (PDOException $exception) {
			echo "Connection error: " . $exception.getMessage();
		}

		return $this->conn;
	}
}
?>