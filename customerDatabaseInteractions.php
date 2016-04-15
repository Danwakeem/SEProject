<?php
   /**
    * This is where we can put all of the functions to retrieve things from
    * the database for the waiter
    */
    ob_start();
    require 'db-connect.php';

	if(isset($_GET['runTest'])){
		session_start();
		$order = $_GET['order'];
		var_dump(submitOrder($order));
	}

	function submitOrder($orders) {
		$con = dbConnect();
		$tableId = $_SESSION['userId'];
		$sql = "INSERT INTO orders (tableId) VALUES (?)";
		$insertStmt = $con->prepare($sql);
		$insertStmt->bind_param('s',$tableId);
		if(!$insertStmt->execute()) {
			$insertStmt->close();
			return false;
		}
		$orderId = $insertStmt->insert_id;
		$insertStmt->close();
		foreach ($orders as $item) {
			$newSQL = "INSERT INTO orderItems (orderId,menuId,quantity,notes) VALUES (?,?,?,?)";
			$insertItem = $con->prepare($newSQL);
			$insertItem->bind_param('ssss',$orderId, $item['id'], $item['quantity'], $item['notes']);
			if(!$insertItem->execute()){
				$insertItem->close();
				return false;
			}
			$insertItem->close();
		}
		return true;
		
	}
?>