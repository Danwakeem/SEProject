<?php
	ob_start();
	session_start();
	require 'db-connect.php';

	if(isset($_GET["username"]) && isset($_GET["password"])){
		$con = dbConnect();
		$username = $_GET["username"];
		$pass = $_GET["password"];
		$sql = "SELECT id,userType FROM user WHERE username = ? and password = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ss',$username, $pass);
		$stmt->bind_result($id,$userType);
		$stmt->execute();
		if($stmt->fetch()){
			$_SESSION['userId'] = $id;
			$_SESSION['username'] = $username;
			$_SESSION['userType'] = $userType;
			$stmt->close();
			exit(header('Location: /SEProject/index.php'));
		} else {
			exit(header('Location: /HCI/login.php?error=1'));
		}
	}

?>