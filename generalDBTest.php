<?php
	include 'generalDatabaseInteractions.php';
	$orderId = 34;
	$status = "ReadyForDelivery";

	$out = updateOrderStatus($orderId,$status);
	var_dump($out);


?>