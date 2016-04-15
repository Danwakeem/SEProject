<?php
	ob_start();
	require 'db-connect.php';

	function getMenuItems($activeOnly) {
		$con = dbConnect();
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

			return $resultArray;
		} else {

		}
	}

	function getTableList(){
		if(isset($_SESSION['userId'])){
			$con = dbConnect();
			$userId = $_SESSION['userId'];
			$sql = "SELECT u.id,u.username,u.Status FROM user as u, userTables as ut WHERE ut.userID = ? and u.id = ut.tableID";
			$stmt = $con->prepare($sql);
			$stmt->bind_param('s',$userId);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			return $result;
		}
   	}
?>