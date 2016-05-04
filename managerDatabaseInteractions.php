<?php
	ob_start();
		require_once 'db-connect.php';
		
		function getMasterTableList(){
			if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
				if($_SESSION['userType'] != 'manager'){
					return false;
				}
				$con = dbConnect();
				$userId = $_SESSION['userId'];
				$sql = "SELECT u.id, u.username, u.Status FROM user as u WHERE u.userType='table'";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt->close();
				return $result;
			}
		}
		//need way to navigat to this
		function getWaitStaff(){
			if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
				if($_SESSION['userType'] != 'manager'){
					return false;
				}
				$con = dbConnect();
				$userId = $_SESSION['userId'];
				$sql = "SELECT u.id, u.username FROM user as u WHERE u.userType='waiter'";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt->close();
				return $result;
			}
		}
		
		function getKitchenStaff(){
			if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
				if($_SESSION['userType'] != 'manager'){
					return false;
				}
				$con = dbConnect();
				$userId = $_SESSION['userId'];
				$sql = "SELECT u.id, u.username FROM user as u WHERE u.userType='chef'";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt->close();
				return $result;
			}
		}
		function getAssignedTables(){
			if(isset($_SESSION['userId']) && isset($_SESSION['userType'])){
				if($_SESSION['userType'] != 'manager'){
					return false;
				}
				$con = dbConnect();
				$userId = $_SESSION['userId'];
				$sql = "SELECT user.id, user.username, user.userType, userTables.userID 
						FROM user 
						LEFT JOIN userTables 
						ON user.id=userTables.tableID 
						WHERE user.userType='table'";
				$stmt = $con->prepare($sql);
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt->close();
				return $result;
			}
		}
		
		function getWaiterName($id){
			$con = dbConnect();
			$sql = "SELECT username from user where id = ?";
			$stmt = $con->prepare($sql);
			$stmt->bind_param('s',$id);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();
			return $result->fetch_assoc();
		}
		function getDailyOrders(){
			$con=dbConnect();
			$sql = "SELECT * FROM orders 
					INNER JOIN orderItems ON orders.id=orderItems.orderId 
					INNER JOIN menuItems ON orderItems.menuId=menuItems.id 
					INNER JOIN menuItemCategory ON menuItems.id=menuItemCategory.menuItemId 
					INNER JOIN category ON menuItemCategory.categoryId=category.id 
					WHERE DATE(orders.date)=CURDATE()";
			$stmt = $con->prepare($sql);
			$stmt->execute();
			$result = $stmt->get_result()
			return $result;
		}

?>
