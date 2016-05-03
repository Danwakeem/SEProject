<?php
	session_start();
	if(isset($_SESSION['userType'])){
		$userType = $_SESSION['userType'];
		require_once 'header.php';
		switch ($userType) {
		case 'table':
			//Load the menu
			//This is obviously just a place holder until we actually make this page populate itself using the database
			require_once 'generalDatabaseInteractions.php';
			$results = getMenuItems(true);
			require_once 'menu.php';
			break;
		case 'waiter':
			//Load table list
			require_once 'waiterDatabaseInteractions.php';
			echo '<h1 class="page-title">Your Tables</h1>';
			$result = getTableList();
			require_once 'tableList.php';
			break;
		case 'manager':
			//Load the master table list
			//For now I am just going to automatically take them to the upload file page
			//require_once 'staffMenuItemMaker.php';
			require_once 'managerDatabaseInteractions.php';
			echo '<h1 class = "page-title"> All Tables</h1>';
			$result = getMasterTableList();
			//$staffResult = getWaitStaff(); 
			//kitchResult = getKitchenStaff();//not sure what the plan is to navigate to pages that are not table lists
			require_once 'tableList.php';
			break;
		case 'chef':
			//Load the list orders
			require_once 'chefDatabaseInteractions.php';
			echo '<h1 class="page-title">Incoming meals</h1>';
			$results = getOrders();
			require_once 'mealList.php';
			break;
		default:
			//Redirect to login on error
			exit(header('Location: login.php'));
			break;
		}
	} else {
		//Redirect to login if this devce has not been signed in
		exit(header('Location: login.php'));
	}
	require_once 'footer.php';
?>
