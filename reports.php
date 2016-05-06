<?php
	include_once 'header.php';
	require_once 'managerDatabaseInteractions.php';
	$result = getDailyOrders();
	$appetizers = getPopularItems("Appetizer");
	$entrees = getPopularItems("Entree");
	$drinks = getPopularItems("Drink");
	$deserts = getPopularItems("Desert");
	$compReport = getCompedItems();
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
	
	//display comped items in a table
	echo "<h1>Today's Comped Items</h1>";
	echo "<table border='1'>
			<tr>
				<td>Order ID</td>
				<td>Table ID</td>
				<td>Item Comped</td>
				<td>Price</td>
				<td>Time</td>
			</tr>";
	while ($row = $compReport->fetch_assoc()){
		echo "<tr>
				<td>" . $row['OrderID'] . "</td>
				<td>" . $row['TableID'] . "</td>
				<td>" . $row['Item'] . "</td>
				<td>" . $row['Price'] . "</td>
				<td>" . $row['Time'] . "</td>
			  </tr>";
	}
			
	echo "</table>";
		
	
	?>
<?php include_once 'footer.php'?>
