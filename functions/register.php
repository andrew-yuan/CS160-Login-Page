<?php
//	Brandon Zhou
//	CS160 OSD Project

require_once "../classes/database.php";
require_once "../classes/user.php";

//	Initialize database and connection
$database = new Database();
$dbc = $database->getConn();

//	Initialize an object for our User table
$user = new User($dbc);

//	Replace with form elements when ready for integration
/*$temp_username = "Brandon Zhou";
$temp_password = "CS160";*/
//	Scrapes HTML form for elements "username" and "password" and stores them in PHP variables
if ($_SERVER["REQUEST_METHOD"] == "POST")
    if ($_POST["email"])
{
$username = $_POST["email"];
$password = md5($_POST["psw"]);

//	First check whether the user has been registered in the past
//	$num will be 0 if the user has not registered before, 1 if they have already registered before
$stmt = $user->reg_check($username);
$num = $stmt->rowCount();

if($num !== 0) {
	echo "Error: user already exists<br>";
}
else {
	//	Since the user has never been registered, we can use the register function to add them to the table
	$stmt = $user->reg_new_user($username, $password);
	$num = $stmt->rowCount();
	echo "The user ". $username . " has been added to the server" . "<br>";
}
}
?>

