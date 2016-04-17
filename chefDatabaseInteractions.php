<?php 
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	ob_start();
	require_once 'db-connect.php';

	function getOrders(){
		$con = dbConnect();
		$sql = "SELECT u.username, o.id, o.tableId, oi.quantity, oi.notes, m.title from orders as o, orderItems as oi, menuItems as m, user as u where oi.orderId = o.id and oi.menuId = m.id and u.id = o.tableId and o.status = 'InProgress' order by o.id";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}

	
?>