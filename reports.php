<?php
	include_once 'header.php';
	require_once 'managerDatabaseInteractions.php';
	$result = getDailyOrders();
	$appetizers = getPopularItems("Appetizer");
	$entrees = getPopularItems("Entree");
	$drinks = getPopularItems("Drink");
	$deserts = getPopularItems("Desert");
	$revenue = 0;
	while($row = $result->fetch_assoc()){
		$revenue = $revenue + ($row['quantity'] * $row['Price']);
	}
	echo "<h1 class='page-title'>Daily Reports</h1>";
	echo "<h1>Revenue Today: " . $revenue . "</h1>";
	
	echo "<h1> Popular Appetizers: ";
	while($row = $appetizers->fetch_assoc()){
		echo $row['title'] . ", ";
	}
	echo "</h1>";
	
	echo "<h1> Popular Entrees: ";
	while($row = $entrees->fetch_assoc()){
		echo $row['title'] . ", ";
	}
	echo "</h1>";
	
	echo "<h1> Popular Drinks: ";
	while($row = $drinks->fetch_assoc()){
		echo $row['title'] . ", ";
	}
	echo "</h1>";
	
	echo "<h1> Popular Desserts: ";
	while($row = $deserts->fetch_assoc()){
		echo $row['title'] . ", ";
	}
	echo "</h1>";
	?>
<?php include_once 'footer.php'?>
