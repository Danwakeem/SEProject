<?php
	session_start();
	session_unset();
	require_once 'customerDatabaseInteractions.php';
	$tableId = 3;
	$_SESSION['userId'] = 3;

	$v = existingOrder();

	var_dump($v);


?>