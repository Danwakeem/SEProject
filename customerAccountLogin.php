<?php 
	ob_start();
	session_start();
	require_once 'db-connect.php';

	if(isset($_GET["username"]) && isset($_GET["password"])){
		if(login($_GET['username'],$_GET['password'])){
			exit(header('Location: index.php'));
		} else {
			exit(header('Location: login.php?customer&error=1'));
		}
	}

	function login($username,$pass){
		$con = dbConnect();
		$sql = "SELECT id,userType FROM user WHERE username = ? and password = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ss',$username, $pass);
		$stmt->bind_result($id,$userType);
		$stmt->execute();
		if($stmt->fetch()){
			$_SESSION['customerId'] = $id;
			$_SESSION['customerName'] = $username;
			$stmt->close();
			return true;
		} else {
			return false;
		}
	}
?>