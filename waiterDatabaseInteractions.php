<?php
   /**
    * This is where we can put all of the functions to retrieve things from
    * the database for the waiter
    */
    ob_start();
	require 'db-connect.php';

	function getTableList(){
		if(isset($_SESSION['userId'])){
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