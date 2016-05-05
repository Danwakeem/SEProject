<?php
   /**
    * This is where we can put all of the functions to retrieve things from
    * the database for the waiter
    */
    ob_start();
    require_once 'db-connect.php';

    /**
     * function that will submit an order to the database for a customer
     * @param $orders is an array of order items 
     * @param $tableId is the id for the table that placed the order
     */
	function submitOrder($orders,$tableId) {
		//Check if they have an open order
		$orderId = findCurrentOrder($tableId)['id'];
		$con = dbConnect();
		if($orderId == false){
			$sql = "SELECT id from orders where tableId = ? and status != 'Paid'";

			$sql = "INSERT INTO orders (tableId) VALUES (?)";
			$insertStmt = $con->prepare($sql);
			$insertStmt->bind_param('s',$tableId);
			if(!$insertStmt->execute()) {
				$insertStmt->close();
				return false;
			}
			$orderId = $insertStmt->insert_id;
			$insertStmt->close();
		}
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
		if(updateStatus("WaitingForFood",$tableId))
			return $orderId;
		else
			return false;
	}

	/**
	 * This updates the status for a given table
	 * @param $status is the new status of the table
	 * @param $tableId is the id of the table to be updated
	 */
	function updateStatus($status,$tableId){
		$con = dbConnect();
		$sql = "UPDATE user set Status = ? where id = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ss',$status,$tableId);
		if($stmt->execute()){
			$stmt->close();
			return true;
		} else {
			return false;
		}
	}

	/**
	 * This function get the order items a customer has submitted
	 * @param $tableId is the id of the table
	 */
	function getOrderItems($tableId){
		$con = dbConnect();
		$results = [];
		$sql = "SELECT u.username, o.id, m.id as itemId, o.tableId, oi.quantity, oi.comped , oi.notes, m.title, m.price from orders as o, orderItems as oi, menuItems as m, user as u where o.tableId = ? and oi.orderId = o.id and oi.menuId = m.id and u.id = o.tableId and o.status != 'Paid'";
		$orderItemsStmt = $con->prepare($sql);
		$orderItemsStmt->bind_param('s', $tableId);
		if($orderItemsStmt->execute()){
			$orderItems = $orderItemsStmt->get_result();
			$orderItemsStmt->close();
			$results = array('orderItems' => $orderItems);
			$sql = "SELECT sum(m.Price) as sum from orders as o, orderItems as oi, menuItems as m, user as u where o.tableId = ? and oi.comped != 1 and oi.orderId = o.id and oi.menuId = m.id and u.id = o.tableId and o.status != 'Paid'";
			$priceStmt = $con->prepare($sql);
			$priceStmt->bind_param('s',$tableId);
			if($priceStmt->execute()){
				$sum = $priceStmt->get_result();
				$priceStmt->close();
				$results['sum'] = $sum;
				return $results;
			} else {
				return false;
			}
		} else {
			return false;
		}

	}

	function checkCouponStatus($id) {
		$con = dbConnect();
		$sql = "SELECT coupon from user where id = ? and coupon = true";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s',$id);
		$stmt->execute();
		$results = $stmt->get_result()->fetch_assoc();
		$stmt->close();
		if($results['coupon']){
			return true;
		} else {
			return false;
		}
	}

	function setCouponStatus($id,$status = true){
		$con = dbConnect();
		$sql = "UPDATE user set coupon = ? where id = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('is',$status,$id);
		$stmt->execute();
		$result = $stmt->affected_rows;
		$stmt->close();
		if($result > 0){
			return true;
		} else {
			return false;
		}
	}

	function existingOrder(){
		$tableId = $_SESSION['userId'];
		$val = findCurrentOrder($tableId);
		if($val != false) {
			return true;
		}
		else {
			return $val;
		}
	}

	function findCurrentOrder($tableId){
		$con = dbConnect();
		$sql = "SELECT id from orders where tableId = ? and status != 'Paid'";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s', $tableId);
		if($stmt->execute()){
			$res = $stmt->get_result();
			$stmt->close();
			if($res->num_rows > 0){
				return $res->fetch_assoc();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
?>