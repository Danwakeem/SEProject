<?php 
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	session_start();

	if(isset($_POST['userAction'])){
		$userAction = $_POST['userAction'];
		switch ($userAction) {
		case 'submitOrder':
			require 'customerDatabaseInteractions.php';
			if(isset($_POST['order'])){
				$order = $_POST['order'];
				$status = submitOrder($order);
				if($status != false){
					echo "true";
				} else {
					echo "false";
				}
			}
			break;
		
		default:
			echo "false";
			break;
		}
	} else {
		echo "false";
	}
?>