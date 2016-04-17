<?php 
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	session_start();


	if(isset($_POST['userAction'])){
		$userAction = $_POST['userAction'];
		switch ($userAction) {
		case 'submitOrder':
			require_once 'customerDatabaseInteractions.php';
			if(isset($_POST['order'])){
				$order = $_POST['order'];
				$tableId = $_SESSION['userId'];
				$orderId = submitOrder($order,$tableId);
				if($orderId != false){
					$arr = array('orderId' => $orderId);
					echo json_encode($arr);
				} else {
					echo "false";
				}
			}
			break;
		case 'updateOrderStatus':
			require_once 'generalDatabaseInteractions.php';
			if(isset($_POST['status']) && isset($_POST['orderId'])){
				$orderId = $_POST['orderId'];
				$status = $_POST['status'];
				$updateStatus = updateOrderStatus($orderId,$status);
				return $updateStatus;
			} else {
				return "nothing";
			}
			break;
		case 'updateTableStatus':
			require_once 'generalDatabaseInteractions.php';
			if(isset($_POST['tableId']) && isset($_POST['status'])){
				$tableId = $_POST['tableId'];
				$status = $_POST['status'];
				$updateStatus = updateTableStatus($tableId,$status);
				return $updateStatus;
			} else {
				return 'false';
			}
			break;
		default:
			echo "Not an action";
			break;
		}
	} else {
		echo "false";
	}
?>