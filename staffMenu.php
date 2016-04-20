<?php
	require_once 'generalDatabaseInteractions.php';
	session_start();

	switch ($_SESSION['userType']) {
		case 'waiter':
			$needsOrderBox = true;
			include 'header.php';
			break;
		case 'manager':
			include 'header.php';
			break;
		case 'chef':
			include 'header.php';
			break;
		default:
			//exit(header('Location: /SEProject/index.php'));
			break;
	}

	if(isset($_GET['tableId'])){
		$tableId = $_GET['tableId'];
	}

	$results = getMenuItems(true);
	include 'menu.php';
?>

<script>
	var tableId = <?php echo $tableId; ?>
</script>

<?php include 'footer.php'; ?>