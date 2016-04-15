<?php
	session_start();
	if(isset($_SESSION['userType'])){
		$userType = $_SESSION['userType'];
		require 'header.php';
		switch ($userType) {
		case 'table':
			//Load the menu
			//This is obviously just a place holder until we actually make this page populate itself using the database
			//require 'Templates/Customer/FakeMenu.html';
			include 'generalDatabaseInteractions.php';
			$results = getMenuItems(true);
			require 'menu.php';
			break;
		case 'waiter':
			//Load table list
			include 'waiterDatabaseInteractions.php';
			echo '<h1 class="page-title">Your Tables</h1>';
			$result = getTableList();
			require 'tableList.php';
			break;
		case 'manager':
			//Load the master table list
			break;
		case 'cook':
			//Load the list orders
			break;
		default:
			//Redirect to login on error
			exit(header('Location: /SEProject/login.php'));
			break;
		}
	} else {
		//Redirect to login if this devce has not been signed in
		exit(header('Location: /SEProject/login.php'));
	}
	require 'footer.php';
?>