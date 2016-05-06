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
	?>
	<h1 class='page-title'>Daily Reports</h1>
	<h3>Revenue Today: <?php echo $revenue; ?></h3>
	
	<hr>

	<h3> Popular Appetizers: </h3>
	<?php while($row = $appetizers->fetch_assoc()) : ?>
		<?php echo $row['title']; ?>,
	<?php endwhile; ?>

	<hr>	

	<h3> Popular Entrees: </h3>
	<?php while($row = $entrees->fetch_assoc()) : ?>
		<?php echo $row['title']; ?>,
	<?php endwhile; ?>

	<hr>

	<h3> Popular Drinks: </h3>
	<?php while($row = $drinks->fetch_assoc()) : ?>
		<?php echo $row['title']; ?>,
	<?php endwhile; ?>
	
	<hr>

	<h3> Popular Desserts: </h3>
	<?php while($row = $deserts->fetch_assoc()) : ?>
		<?php echo $row['title']; ?>, 
	<?php endwhile; ?>
	
	<hr>

	<!-- display comped items in a table -->
	<h3>Today's Comped Items</h3>
	<table class="table table-striped" style=" margin-top: 30px; border-bottom: 1px solid gray;">
		<thead>
			<tr>
				<td>Order ID</td>
				<td>Table ID</td>
				<td>Item Comped</td>
				<td>Price</td>
				<td>Time</td>
			</tr>
		</thead>
	<?php while ($row = $compReport->fetch_assoc()) : ?>
		<tbody>
			<tr>
				<td><?php echo $row['OrderID']; ?></td>
				<td><?php echo $row['TableID']; ?></td>
				<td><?php echo $row['Item']; ?></td>
				<td><?php echo $row['Price']; ?></td>
				<td><?php echo $row['Time']; ?></td>
			</tr>
		</tbody>
	<?php endwhile; ?>
			
	</table>
<?php include_once 'footer.php'?>
