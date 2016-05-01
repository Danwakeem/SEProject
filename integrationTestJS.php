<?php 
	session_start();
	session_unset();
	$_SESSION['userId'] = 3; //Simulate a user
	$_SESSION['username'] = 'table1';
	$_SESSION['userType'] = 'customer';
?>

<html>
<head>
</head>
<body>

	<!-- Output for test 1 goes here -->
	<div id="test1">
		<p id='wait1'>Wating...</p>
	</div>

	<!-- Output for test 2 goes here -->
	<div id="test2">
		<p id='wait2'>Wating...</p>
	</div>

	<!-- Output for test 3 goes here -->
	<div id="test3">
		<p id='wait3'>Wating...</p>
	</div>

	<!-- Output for test 4 goes here -->
	<div id="test4">
		<p id='wait4'>Wating...</p>
	</div>

	<!-- Include jQuery to make my life easier -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript">

		var orderId = 0;
		var tableId = 3;

		$(document).ready(function(){
			startTest();
		});

		function startTest(){
			testOrderSubmit();
		}

		function testOrderSubmit(){
			var data = {userAction:"submitOrder",order: [{id:1,quantity:2,notes:'No Cheese'},{id:2,quantity:1,notes:'N/A'}], tableId: 3};
			$.ajax({
			  url: "ajax.php",
			  type: "POST",
			  data: data,
			  success: function(e){
			  	$('#wait1').remove();
			  	if(e !== false) {
			  		$('#test1').append('<p>Test 1 Passed.</p>');
			  		$('#test1').append('<p>Order was able to be submit properly</p>');
			  		var obj = JSON.parse(e);
			  		testOrderStatus(obj.orderId);
			  	} else {
			  		$('#test1').append('<p>Test 1 Failed.</p>');
			  		$('#test1').append('<p>Order was not able to be submit properly</p>');
			  		$('#test1').append('<p>Skipping to test 4</p>');
			  	}
			  },
			  error: function(jqXHR, textStatus, errorThrown) {
			  	$('#wait1').remove();
			  	$('#test1').append("AJAX ERROR");
 				console.log(textStatus, errorThrown);
		  	  }
			});
		}

		function testOrderStatus(orderId){
			var data = {userAction:'updateOrderStatus',orderId:orderId,status:'Paid'};
			$.ajax({
			  url: "ajax.php",
			  type: "POST",
			  data: data,
			  success: function(e){
			  	$('#wait2').remove();
			  	if(e){
			  		$('#test2').append('<p>Test 2 Passed.</p>');
			  		$('#test2').append('<p>Order Status was able to be updated</p>');
			  		testTableStatus();
			  	} else {
			  		$('#test2').append('<p>Test 2 Failed.</p>');
			  		$('#test2').append('<p>Order Status was not able to be updated</p>');
			  		$('#test2').append('<p>Skipping to test 4</p>');
			  	}
			  },
			  error: function(jqXHR, textStatus, errorThrown) {
			  	$('#wait2').remove();
			  	$('#test2').append("AJAX ERROR");
	 			console.log(textStatus, errorThrown);
			  }
			});
		}

		function testTableStatus(){
			var data = {userAction: 'updateTableStatus', tableId: tableId, status: 'Paid'};
			$.ajax({
			  url: "ajax.php",
			  type: "POST",
			  data: data,
			  success: function(e){
			  	$('#wait3').remove();
				if(e){
					$('#test3').append('<p>Test 3 Passed.</p>');
			  		$('#test3').append('<p>Table Status was able to be updated</p>');
				} else {
					$('#test3').append('<p>Test 3 Failed.</p>');
			  		$('#test3').append('<p>Table Status was not able to be updated</p>');
				}
				testInvalidAction();
			  },
			  error: function(jqXHR, textStatus, errorThrown) {
			  	$('#wait3').remove();
			  	$('#test3').append("AJAX ERROR");
		 		console.log(textStatus, errorThrown);
			  }
			});
		}

		function testInvalidAction(){
			var data = {userAction: 'hello'};
			$.ajax({
			  url: "ajax.php",
			  type: "POST",
			  data: data,
			  success: function(e){
			  	$('#wait4').remove();
				if(e){
					$('#test4').append('<p>Test 4 Failed.</p>');
			  		$('#test4').append('<p>Ajax responded to an invalid action</p>');
				} else {
					$('#test4').append('<p>Test 4 Passed.</p>');
			  		$('#test4').append('<p>Invalid action failed</p>');
				}
			  },
			  error: function(jqXHR, textStatus, errorThrown) {
			  	$('#wait4').remove();
			  	$('#test4').append("AJAX ERROR");
		 		console.log(textStatus, errorThrown);
			  }
			});
		}

	</script>
</body>
</html>