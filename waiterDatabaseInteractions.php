<?php
    ob_start();
	require_once 'db-connect.php';

	/**
	 * This function get the list of tables for a particular waiter
	 */
	function getTableList(){
		if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
			if($_SESSION['userType'] != 'manager' && $_SESSION['userType'] != 'waiter') {
				return false;
			}
			$con = dbConnect();
			$userId = $_SESSION['userId'];
			$sql = "SELECT u.id,u.username,u.Status FROM user as u, userTables as ut WHERE ut.userID = ? and u.id = ut.tableID";
			$stmt = $con->prepare($sql);
			$stmt->bind_param('s',$userId);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			return $result;
		}
   	}

?>