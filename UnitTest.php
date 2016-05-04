<html>
<head>
	
</head>
<body>
	<h1>Testing adding an item to an order</h1>
	<p id="test1">Waiting...</p>
	<h1>Testing adding new item to an order</h1>
	<p id="test2">Waiting...</p>
	<h1>Testing adding same item to an order</h1>
	<p id="test3">Waiting...</p>
	<h1>Testing in Order search function</h1>
	<p id="test4">Waiting...</p>
	<h1>Testing in update quantity function with 0</h1>
	<p id="test5">Waiting...</p>
	<h1>Testing in update quantity function with non 0</h1>
	<p id="test6">Waiting...</p>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="http://cdn.pubnub.com/pubnub-3.14.4.min.js"></script>
	<script src="js/common.js"></script>

	<script type="text/javascript">
		var testItemCount = 1;
		var testOrderTotal = 2;
		var testInList = false;
		var testAdded = true;
		$(document).ready(function(){
			startTestScript();
		});

		function startTestScript(){
			test1();

			testItemCount++;
			testOrderTotal += 4;
			test2();

			testItemCount++;
			testOrderTotal += 2;
			testInList = true;
			test3();

			test4();

			test5();

			test6();
		}

		function test1(){
			var insertItem = {id:1,title:'Blah',price:2,path:'blah',quantity:1,notes:'N/A'};
			var data = addItemToOrderStructure(insertItem);
			niceLogging('#test1',data);
		}

		function test2(){
			var insertItem = {id:2,title:'Blah',price:4,path:'blah',quantity:1,notes:'N/A'};
			var data = addItemToOrderStructure(insertItem);
			niceLogging('#test2',data);	
		}

		function test3(){
			var insertItem = {id:1,title:'Blah',price:2,path:'blah',quantity:1,notes:'N/A'};
			var data = addItemToOrderStructure(insertItem);
			niceLogging('#test3',data);	
		}

		function test4(){
			if(inOrder(1) !== false) {
				if(inOrder(2) !== false) {
					$('#test4').empty().append('Test 4 Passed');
				} else {
					$('#test4').empty().append('Test 4 Failed').after('<p>Could not find id 2 in orderItem structure</p>');
				}
			} else {
				$('#test4').empty().append('Test 4 Failed').after('<p>Could not find id 1 in orderItem structure</p>');
			}
		}

		function test5(){
			if(updateQuantityInStructure(1,0)) {
				if(!inOrder(1))
					$('#test5').empty().append('Test 5 Passed');
				else 
					$('#test5').empty().append('Test 5 Failed').after('<p>Item was not removed from structure</p>');	
			} else {
				$('#test5').empty().append('Test 5 Failed').after('<p>Quantity was not able to be updated</p>');
			}
		}

		function test6(){
			if(!updateQuantityInStructure(2,5)) {
				$('#test6').empty().append('Test 6 Passed');
			} else {
				$('#test6').empty().append('Test 6 Failed').after('<p>Quantity was not able to be updated</p>');
			}
		}

		function niceLogging(tag,data){
			if(itemCount === testItemCount) {
				if(orderTotal === testOrderTotal){
					if(data.inList === testInList) {
						if(data.added === testAdded) {
							$(tag).empty().append('Test 1 Passed');
						} else {
							$(tag).empty().append('Test 1 Failed.').after('<p>Data added was false and should have been true</p>');
						}
					} else {
						$(tag).empty().append('Test 1 Failed.').after('<p>inList was true and should have been false</p>');
					}
				} else {
					$(tag).empty().append('Test 1 Failed.').after('<p>There was an error with the orderTotal</p>');
				}
			} else {
				$(tag).empty().append('Test 1 Failed.').after('<p>ItemCount was incorrect</p>');
			}
		}

	</script>


</body>
</html>