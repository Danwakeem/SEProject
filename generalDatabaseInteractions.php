<?php
	ob_start();
	require_once 'db-connect.php';

	function getMenuItems($activeOnly) {
		$con = dbConnect();
		$resultArray = array();
		$activeQueryString = ' and mi.active = 1';

		$sqlApp = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p, menuItemCategory as mc, category as c where mi.id = p.menuItemId and mi.id = mc.menuItemId and mc.categoryId = c.id and c.name = 'Appetizer'";
		$sqlLunch = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p, menuItemCategory as mc, category as c where mi.id = p.menuItemId and mi.id = mc.menuItemId and mc.categoryId = c.id and c.name = 'Lunch'";
		$sqlDinner = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p, menuItemCategory as mc, category as c where mi.id = p.menuItemId and mi.id = mc.menuItemId and mc.categoryId = c.id and c.name = 'Entree'";
		$sqlDesert = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p, menuItemCategory as mc, category as c where mi.id = p.menuItemId and mi.id = mc.menuItemId and mc.categoryId = c.id and c.name = 'Desert'";
		$sqlTopItems = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p where mi.active = 1 and mi.id = p.menuItemId ";

		if($activeOnly) {
			$sqlApp .= $activeQueryString;
			$sqlLunch .= $activeQueryString;
			$sqlDesert .= $activeQueryString;
			$sqlDesert .= $activeQueryString;
			$sqlTopItems .= $activeQueryString . " order by mi.timesOrdered desc limit 3";
			return $resultArray;
		} else {
			$sqlTopItems .= " order by mi.timesOrdered desc limit 3";
		}

		$stmtApp = $con->prepare($sqlApp);
		$stmtApp->execute();
		$resultArray['app'] = $stmtApp->get_result();
		$stmtApp->close();

		$stmtLunch = $con->prepare($sqlLunch);
		$stmtLunch->execute();
		$resultArray['lunch'] = $stmtLunch->get_result();
		$stmtLunch->close();

		$stmtDinner = $con->prepare($sqlDinner);
		$stmtDinner->execute();
		$resultArray['entree'] = $stmtDinner->get_result();
		$stmtDinner->close();

		$stmtDesert = $con->prepare($sqlDesert);
		$stmtDesert->execute();
		$resultArray['desert'] = $stmtDesert->get_result();
		$stmtDesert->close();

		$stmtTop = $con->prepare($sqlTopItems);
		$stmtTop->execute();
		$resultArray['top'] = $stmtTop->get_result();
		$stmtTop->close();
	}

	function updateTableStatus($tableId,$status) {
		$con = dbConnect();
		$sql = "UPDATE user SET Status = ? where id = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ss',$status,$tableId);
		$success = $stmt->execute();
		$stmt->close();
		return $success;
	}

	function updateOrderStatus($orderId,$status) {
		$con = dbConnect();
		$sql = "UPDATE orders SET status = ? where id = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('ss',$status,$orderId);
		$success = $stmt->execute();
		$stmt->close();
		if($status == "ReadyForDelivery"){
			$sql = "UPDATE user as u, orders as o SET u.Status = 'OrderReady' where o.tableId = u.id and o.id = ?";
			$stmt = $con->prepare($sql);
			$stmt->bind_param('s',$orderId);
			$success = $stmt->execute();
			$stmt->close();
		} else if ($status == "Paid") {
			$sql = "UPDATE user as u, orders as o SET u.Status = 'Paid' where o.tableId = u.id and o.id = ?";
			$stmt = $con->prepare($sql);
			$stmt->bind_param('s',$orderId);
			$success = $stmt->execute();
			$stmt->close();
		}
		return $success;
	}
?>