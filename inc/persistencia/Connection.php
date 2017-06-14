<?php 
class Connection{
	
	function getConnection(){
		
		$servername = "localhost";
		$username   = "root";
		$password   = "root";
		$dbname   	= "anubis";
		
		// Create connection
		$mysqli = new mysqli($servername, $username, $password, $dbname, 3306);
		if ($mysqli->connect_errno) {
			return "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		return $mysqli;
		
	}
}
?>