<?php
//	Brandon Zhou
//	CS160 OSD Project

class User {
	//	Private variables for connection and pre-determined table name
	private $conn;
	private $table_name = "users";

	public $userID;
	public $level;
	public $username;
	public $password;

	//	Constructor with database connection
	public function __construct($db) {
		$this->conn = $db;
	}

	/*	Function for checking duplicate user during registration
		Checks User table for existing user
		Returns empty entry set when no existing user found */
	public function reg_check($reg_username)
	{
		//	Select passwords from user table that match login
		//	If the entry set is empty, we can register the user.  Otherwise, should prompt error
		$query = "SELECT password FROM " . $this->table_name . " WHERE username=\"" . $reg_username . "\"";

		//	Prepare query statement
		$stmt = $this->conn->prepare($query);

		//	Execute query
		$stmt->execute();

		return $stmt;
	}

	/*	Function for registering a new user
		Logic has called reg_check so we know new user is valid
		Returns the entry set containing the new user */
	public function reg_new_user($reg_username, $reg_password) {
		//	Inserts the new user into the User table
		$query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (\"" . $reg_username . "\", \"" . $reg_password . "\")";
		//	Prepare query statement
		$stmt = $this->conn->prepare($query);

		//	Execute query statement
		$stmt->execute();

		return $stmt;
	}
}
?>