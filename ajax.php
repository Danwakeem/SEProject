<?php 
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	session_start();

	/**
	 * This file contains the actions that can be performed via an ajax request from a clients browser. I am going to call the different actions params.
	 * @param submitOrder submits an order to the database
	 * @param updateOrderStatus updates the status of an order
	 * @param updateTableStatus updates the status of a table
	 * @return false if an error occured in the database transaction
	 * @return object if success
	 */

	if(isset($_POST['userAction'])){
		$userAction = $_POST['userAction'];
		switch ($userAction) {
		case 'submitOrder':
			require_once 'customerDatabaseInteractions.php';
			if(isset($_POST['order'])){
				$order = $_POST['order'];
				$tableId = $_POST['tableId'];
				$orderId = submitOrder($order,$tableId);
				if($orderId != false){
					$arr = array('orderId' => $orderId);
					echo json_encode($arr);
				} else {
					echo false;
				}
			}
			break;
		case 'updateMenuItems':
			if(isset($_POST['menuItems'])){
				require_once 'generalDatabaseInteractions.php';
				if(isset($_POST['menuItems'])){
					$menuItems = $_POST['menuItems'];
					$success = updateMenuItems($menuItems);
				}
				$results = getMenuItems(true);
				require_once 'menu.php';
			}
			break;
		case 'getOrderList':
			require_once 'chefDatabaseInteractions.php';
			$results = getOrders();
			require_once 'mealList.php';
			break;
		case 'getTableList':
			require_once 'waiterDatabaseInteractions.php';
			$result = getTableList();
			require_once 'tableList.php';
			break;
		case 'updateOrderStatus':
			require_once 'generalDatabaseInteractions.php';
			if(isset($_POST['status']) && isset($_POST['orderId'])){
				$orderId = $_POST['orderId'];
				$status = $_POST['status'];
				$updateStatus = updateOrderStatus($orderId,$status);
				echo $updateStatus;
			} else {
				echo false;
			}
			break;
		case 'updateTableStatus':
			require_once 'generalDatabaseInteractions.php';
			if(isset($_POST['tableId']) && isset($_POST['status'])){
				$tableId = $_POST['tableId'];
				$status = $_POST['status'];
				$updateStatus = updateTableStatus($tableId,$status);
				echo $updateStatus;
			} else {
				echo false;
			}
			break;
		default:
			echo false;
			break;
		}
	} else {
		echo false;
	}
?>