<?php
	ob_start();
		require_once 'db-connect.php';
		
		function getMasterTableList(){
			if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
				if($_SESSION['userType'] != 'manager'){
					return false;
				}
				$con = dbConnect();
				$userId = $_SESSION['userId'];
				$sql = "SELECT u.id, u.username, u.Status FROM user as u WHERE u.userType='table'";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt->close();
				return $result;
			}
		}
		//need way to navigat to this
		function getWaitStaff(){
			if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
				if($_SESSION['userType'] != 'manager'){
					return false;
				}
				$con = dbConnect();
				$userId = $_SESSION['userId'];
				$sql = "SELECT u.id, u.username FROM user as u WHERE u.userType='waiter'";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$result = $ssmt->get_result();
				$stmt->close();
				return $result;
			}
		}
		
		function getKitchenStaff(){
			if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
				if($_SESSION['userType'] != 'manager'){
					return false;
				}
				$con = dbConnect();
				$userId = $_SESSION['userId'];
				$sql = "SELECT u.id, u.username FROM user as u WHERE u.userType='chef'";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$result = $ssmt->get_result();
				$stmt->close();
				return $result;
			}
		}

?>
