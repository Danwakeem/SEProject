<?php
	include_once 'header.php';
	require_once 'managerDatabaseInteractions.php';
	$result = getDailyOrders();
	$revenue = 0;
	while($row = $result->fetch_assoc()){
		$revenue = $revenue + ($row['quantity'] * $row['Price']);
	}
	echo "<h1 class='page-title'>Daily Reports</h1>";
	echo "<h1>Revenue Today: " . $revenue . "</h1>";
	?>
<?php include_once 'footer.php'?>
