<?php
	ob_start();
	require_once 'db-connect.php';

	function getMenuItems($activeOnly) {
		$con = dbConnect();
		$sqlApp = ''; $sqlLunch = ''; $sqlDinner = ''; $sqlDesert = ''; $sqlTopItems = '';
		if($activeOnly) {
			$resultArray = array();

			$sqlApp = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p, menuItemCategory as mc, category as c where mi.active = 1 and mi.id = p.menuItemId and mi.id = mc.menuItemId and mc.categoryId = c.id and c.name = 'Appetizer'";
			$sqlLunch = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p, menuItemCategory as mc, category as c where mi.active = 1 and mi.id = p.menuItemId and mi.id = mc.menuItemId and mc.categoryId = c.id and c.name = 'Lunch'";
			$sqlDinner = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p, menuItemCategory as mc, category as c where mi.active = 1 and mi.id = p.menuItemId and mi.id = mc.menuItemId and mc.categoryId = c.id and c.name = 'Entree'";
			$sqlDesert = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p, menuItemCategory as mc, category as c where mi.active = 1 and mi.id = p.menuItemId and mi.id = mc.menuItemId and mc.categoryId = c.id and c.name = 'Desert'";
			$sqlTopItems = "SELECT mi.id,mi.title,mi.desc,p.path,mi.price from menuItems as mi, pictures as p where mi.active = 1 and mi.id = p.menuItemId order by mi.timesOrdered desc limit 3";
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
		} else {
			$sql = "SELECT id,title,`desc`,price,active from menuItems";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$resultArray['all'] = $stmt->get_result();
			$stmt->close();
		}

		return $resultArray;
	}

	function getMenuItem($itemId){
		$con = dbConnect();
		$resultArray = array();
		$sql = "SELECT id,title,price,`desc` from menuItems where id = ?";
		$menuItem = $con->prepare($sql);
		$menuItem->bind_param('s',$itemId);
		$menuItem->execute();
		$resultArray['menuItem'] = $menuItem->get_result()->fetch_assoc();;
		$menuItem->close();
		$sql = "SELECT categoryId from menuItemCategory where menuItemId = ?";
		$categories = $con->prepare($sql);
		$categories->bind_param('s',$itemId);
		$categories->execute();
		$resultArray['categories'] = $categories->get_result();
		$categories->close();
		$sql = "SELECT ingredient from ingredients where menuItemId = ?";
		$ingredient = $con->prepare($sql);
		$ingredient->bind_param('s',$itemId);
		$ingredient->execute();
		$resultArray['ingredients'] = $ingredient->get_result();
		$ingredient->close();
		$sql = "SELECT `path` from pictures where menuItemId = ?";
		$pic = $con->prepare($sql);
		$pic->bind_param('s',$itemId);
		$pic->execute();
		$resultArray['pic'] = $pic->get_result()->fetch_assoc();
		$pic->close();
		return $resultArray;
	}

	function updateMenuItems($orderItems){
		$con = dbConnect();
		$success = false;
		foreach ($orderItems as $id => $value) {
			$sql = "UPDATE menuItems set active = ? where id = ?";
			$stmt = $con->prepare($sql);
			$stmt->bind_param('dd',$value,$id);
			$success = $stmt->execute();
			$stmt->close();
		}
		return $success;
	}

	function getTableName($tableId) {
		$con = dbConnect();
		$sql = "SELECT username from user where id = ?";
		$stmt = $con->prepare($sql);
		$stmt->bind_param('s',$tableId);
		$stmt->execute();
		$results = $stmt->get_result();
		$stmt->close();
		return $results->fetch_assoc();
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