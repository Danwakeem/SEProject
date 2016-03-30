<?php
	ini_set('display_errors',1); 
	error_reporting(E_ALL);
	GLOBAL $con;

	/**
	 * @return $con
	 */
	function dbConnect(){

		//NOTE: It will not be set up this way on my server. This is for your development enviroment
		$host = "localhost"; // Host name 
		$username = "root"; // Mysql username 
		$password = "root"; // Mysql password 
		$db_name = "superfood"; // Database name

		// Connect to server and select databse.
		$con = mysqli_connect("$host", "$username", "$password", "$db_name") or die("cannot connect"); 
	
		return $con;
	}

	function closeMySQL(){
		mysql_close($con);
	}

?> 