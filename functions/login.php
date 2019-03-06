<?php
//	Brandon Zhou
//	CS160 OSD Project

require_once "../classes/database.php";
require_once "../classes/user.php";

//	Initialize database and connection

function login($user_name, $password)
{
    $database = new Database();
    $dbc = $database->getConn();
    
    $query = "SELECT password FROM users WHERE username=\"" . $user_name . "\"";
    try{
    $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbc->prepare($query);

    $stmt->execute();
    if ($stmt->rowCount() === 0)
    {
        echo "<br/>" ."The username does not exist" . "<br/>";
        return;
    }
    
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $row = $stmt->fetch();
    $pass = $row['password'];
    if ($pass === $password)
        echo "Welcome to OSD" . "<br\>";
    else
        echo "<br\> The password you entered is not correct" . "<br\>";
    
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
    if ($_POST["username"])
{

        $username = $_POST["username"];
        $password = md5($_POST["psw"]); // Use MD5 to generate a hash value for password and store that hash into mySQL
        login($username,$password);
        
}
?>

