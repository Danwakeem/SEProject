<?php
	require_once 'accountLogin.php';
	require_once 'db-connect.php';
	require_once 'generalDatabaseInteractions.php';
	require_once 'waiterDatabaseInteractions.php';
	require_once 'chefDatabaseInteractions.php';
	require_once 'customerDatabaseInteractions.php';

	/* Function abstraction */

	/**
	 * Function to test the login script
	 * @param $username
	 * @param $password
	 */ 
	function testLogin($username,$pass){
		login($username,$pass);
	}

	/**
	 * Function to test getTableList
	 * @param $userId
	 * @param $userType
	 */
	function testTableList($userId,$userType){
		session_unset();
		$_SESSION['userId'] = $userId;
		$_SESSION['userType'] = $userType;
		return getTableList();
	}

	/**
	 * Function to test a chefs abiltiy to get current orders
	 */
	function testGetOrders(){
		return getOrders();
	}

	/**
	 * Function to test the ability for an order to be saved to the DB
	 * @param $orders is the array of order objects
	 * @param $tableId
	 */
	function testOrderSubmit($orders,$tableId) {
		return submitOrder($orders,$tableId);
	}

	/**
	 * Function to test the ability for an order status to be updated
	 * @param $orderId
	 * @param $status is the status of the order
	 */
	function testOrderStatusUpdate($orderId,$status) {
		return updateOrderStatus($orderId,$status);
	}

	/**
	 * Function to test the ability for a table status to be updated
	 * @param $tableId
	 * @param $status is the status of the order
	 */
	function testTableStatusUpdate($tableId,$status) {
		return updateTableStatus($tableId,$status);
	}

	/**
	 * Function to test the ability for an existing order to be queried
	 * @param $tableId
	 */
	function testExistingOrder($tableId) {
		session_unset();
		$_SESSION['userId'] = $tableId;
		return existingOrder();
	}

	/* End Function abstraction */

	/* General database tests */

	/**
	 * Test 1: Login with existing user
	 */
	echo '*********** Begin Test 1 ***********<br>';
	$username = 'table1';
	$password = 'table1';
	$success = login($username,$password);
	if($success) {
		echo 'Test 1 Passed<br>';
		echo 'User was able to be logged in successfully<br>';
	}
	else 
		echo 'Test 1 failed to log user in<br>';
	echo '***********  End Test 1  ***********<br><br>';
	

	/**
	 * Test 2: Check that session variables were set
	 */
	echo '*********** Begin Test 2 ***********<br>';
	if(isset($_SESSION['userId'])) {
		if(isset($_SESSION['username'])) {
			if(isset($_SESSION['userType'])){
				echo 'Test 2 Passed<br>';
				echo 'All session variables were set properly<br>';
			} else {
				echo 'Test 2 Failed<br>';
				echo 'Session variable userType was not set<br>';
			}
		} else {
			echo 'Test 2 Failed<br>';
			echo 'Session variable username was not set<br>';
		}
	} else {
		echo 'Test 2 Failed<br>';
		echo 'Session variable userId was not set<br>';
	}
	echo '***********  End Test 2  ***********<br><br>';

	/**
	 * Clear PHP session for next test
	 */
	session_unset();

	/**
	 * Test 3: Check that an invalid username and password combo returns false
	 */
	echo '*********** Begin Test 3 ***********<br>';
	$username = 'table1';
	$password = 'table5'; //invalid password
	$success = login($username,$password);
	if($success){
		echo 'Test 3 Failed<br>';
		echo 'Was able to login with invalid credentials<br>';
	}
	else {
		echo 'Test 3 Passed<br>';
		echo 'Was not able to login with invalid credentials<br>';
	}
	echo '***********  End Test 3  ***********<br><br>';

	/* End General database tests */

	/* Waiter tests */

	/**
	 * Test 4: Check that the table list does not return for a non waiter/manager
	 */
	echo '*********** Begin Test 4 ***********<br>';
	$userId = 5;
	$userType = 'customer';
	$success = testTableList($userId,$userType);
	if($success != false) {
		echo 'Test 4 has Failed<br>';
		echo 'Was able to retrieve tableList<br>';
	} else {
		echo 'Test 4 Passed<br>';
		echo 'Was not able to retrieve tableList<br>';
	}
	echo '***********  End Test 4  ***********<br><br>';

	/**
	 * Test 5: Check that the table list returns properly for a waiter/manager
	 */
	echo '*********** Begin Test 5 ***********<br>';
	$userId = 2;
	$userType = 'waiter';
	$success = testTableList($userId,$userType);
	if($success != false) {
		echo 'Test 5 Passed<br>';
		echo 'Was able to retrieve tableList<br>';
	} else {
		echo 'Test 5 has Failed<br>';
		echo 'Was not able to retrieve tableList<br>';
	}
	echo '***********  End Test 5  ***********<br><br>';

	/* End Waiter tests */

	/* Chef tests */

	/**
	 * Test 6 : Check that the get orders has a correct MySql query
	 */
	echo '*********** Begin Test 6 ***********<br>';
	$success = testGetOrders();
	if($success != false) {
		echo 'Test 6 Passed<br>';
		echo 'Was able to retrieve orders<br>';
	} else {
		echo 'Test 6 has Failed<br>';
		echo 'Was not able to retrieve orders<br>';
	}
	echo '***********  End Test 6  ***********<br><br>';	

	/* End Chef tests */

	/* Customer tests */

	/**
	 * Test 7 : Check that there is no current order
	 * Not nesicarily an error if there is I will just want to skip the other tests
	 */
	$shouldContinue = true;
	$orderId = 0;

	echo '*********** Begin Test 7 ***********<br>';
	$tableId = 3;
	$success = testExistingOrder($tableId);
	if($success != false) {
		echo 'Test 7 says an order exists<br>';
		$orderId = $success;
		$shouldContinue = false;
	} else 
		echo 'Test 7 says no order exists<br>';
	echo '***********  End Test 7  ***********<br><br>';

	if($shouldContinue) {
		/**
	 	 * Test 7.1 : Check that an order is able to be submitted
	 	 */
		echo '*********** Begin Test 7.1 ***********<br>';
		$orders = array(
				array('id' => 1, 'quantity' => 2, 'notes' => 'No cheese'),
				array('id' => 2, 'quantity' => 1, 'notes' => 'N/A')
			);
		$success = testOrderSubmit($orders,$tableId);
		if($success != false) {
			$orderId = $success;
			echo 'Test 7.1 Passed<br>';
			echo 'Order was submitted properly<br>';
		} else {
			echo 'Test 7.1 has Failed<br>';
			echo 'Order was not submitted properly<br>';
		}
		echo '***********  End Test 7.1  ***********<br><br>';

		/**
		 * Test 7.2 : Check that order is showing up in db
		 */
		echo '*********** Begin Test 7.2 ***********<br>';
		$success = testExistingOrder($tableId);
		if($success != false) {
			echo 'Test 7.2 Passed<br>';
			echo 'The order was able to be retrieved from the database<br>';
		} else {
			echo 'Test 7 has Failed to query for current order<br>';
		}
		echo '***********  End Test 7.2  ***********<br><br>';	
	}

	if($orderId != 0){
		/**
		 * Test 8 : Check that order status can be updated
		 */
		echo '*********** Begin Test 8 ***********<br>';
		$status = 'Paid';
		$success = testOrderStatusUpdate($orderId,$status);
		if($success != false) {
			echo 'Test 8 Passed<br>';
			echo 'Order status was able to be updated<br>';
		} else {
			echo 'Test 8 has Failed<br>';
			echo 'Order status was not able to be updated<br>';
		}
		echo '***********  End Test 8  ***********<br><br>';

		/**
		 * Test 9 : Check that a table status can be updated
		 */
		echo '*********** Begin Test 9 ***********<br>';
		$status = 'Paid';
		$success = testTableStatusUpdate($tableId,$status);
		if($success != false) {
			echo 'Test 9 Passed<br>';
			echo 'Table status was able to be updated<br>';
		} else {
			echo 'Test 9 has Failed<br>';
			echo 'Table status not was able to be updated<br>';
		}
		echo '***********  End Test 9  ***********<br><br>';

	}

	/* End Customer Tests */
?>