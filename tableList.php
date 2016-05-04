<div id="tableList">
<?php while($row = $result->fetch_assoc()): ?>
	<?php 
		if($row['Status'] == "NeedAssistance") {
			$msg = ' This table <a class="alert-link" href="#">requires assistance</a> ';
			$class = "alert alert-danger table-info";
			$extra = true;
		} elseif($row['Status'] == "Ready") {
			$msg = " Table is ready for customer ";
			$class = "alert alert-info table-info";
			$extra = false;
		} elseif($row['Status'] == "WaitingForOrder") {
			$msg = " Waiting for table to order ";
			$class = "alert alert-info table-info";
			$extra = false;
		} elseif($row['Status'] == "WaitingForFood") {
			$msg = " Waiting for food ";
			$class = "alert alert-info table-info";
			$extra = false;
		} elseif($row['Status'] == "Paid") {
			$msg = ' Paid and <span class="alert-link">needs to be cleared.</span>';
			$class = "alert alert-warning table-info";
			$extra = false;
		} else if($row['Status'] == "FoodDelivered"){ 
			$msg = " Waiting For payment ";
			$class = "alert alert-info table-info";
			$extra = false;
		} else if ($row['Status'] == "OrderReady") {
			$msg = " Food is ready ";
			$class = "alert alert-success table-info";
			$extra = false;
		}
	?>
		<div id="table<?php echo $row['id']; ?>" class="<?php echo $class; ?>" role="alert">
			<div class="row">
				<div class="col-xs-6">
					<strong class="vertical-center" style="float:left;"><?php echo $row['username']; ?>&nbsp;</strong>
					<p id="msg<?php echo $row['id']; ?>"class="vertical-center">
						<?php echo ' ' . $msg; ?>
					</p>
				</div>
				<div class="col-xs-4">
					<div class="dropdown status clearfix" style="float:right;"> 
	            		<button class="btn btn-<?php 
	            			switch ($row['Status']) {
	            				case 'Ready':
	            					echo 'primary';
	            					break;
	            				case 'NeedAssistance':
	            					echo 'danger';
	            					break;
	            				case 'OrderReady':
	            					echo 'success';
	            					break;
	            				case 'Paid':
	            					echo 'warning';
	            					break;
	            				default:
	            					echo 'primary';
	            					break;
	            			}

	            		?> dropdown-toggle" type="button" id="statusButton<?php echo $row['id'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		            		 <?php echo $row['Status']; ?>
		            		 <span class="caret"></span> 
	            		 </button> 
	            		 <ul id="dropDownMenu<?php echo $row['id']; ?>" class="dropdown-menu status-dropdown-menu <?php 
	            		 	switch ($row['Status']) {
	            		 	case 'NeedAssistance':
	            		 		echo 'dropdown-red';
	            		 		break;
	            		 	case 'OrderReady':
	            		 		echo 'dropdown-green';
	            		 		break;
	            		 	case 'Paid':
	            		 		echo 'dropdown-yellow';
	            		 		break;
	            		 	default:
	            		 		echo '';
	            		 		break;
	            		 }
	            		 ?>" aria-labelledby="statusButton<?php echo $row['id'];?>"> 
	            		 	<li><a onclick="changeTableStatus(<?php echo $row['id']?>,'Ready',true)">Ready</a></li> <!-- Empty table -->
						    <li><a onclick="changeTableStatus(<?php echo $row['id']?>,'NeedAssistance',true)">Needs Assistance</a></li> <!-- Set any time -->
						    <li><a onclick="changeTableStatus(<?php echo $row['id']?>,'WaitingForOrder',true)">Waiting for Order</a></li>  <!-- Set when seated -->
						    <li><a onclick="changeTableStatus(<?php echo $row['id']?>,'WaitingForFood',true)">Waiting for Food</a></li> <!-- Set when order is placed -->
						    <li><a onclick="changeTableStatus(<?php echo $row['id']?>,'OrderReady',true)">Order Ready</a></li> <!-- Set by chef -->
						    <li><a onclick="changeTableStatus(<?php echo $row['id']?>,'FoodDelivered',true)">Food Delivered</a></li> <!-- Set when food is delivered -->
						    <li><a onclick="changeTableStatus(<?php echo $row['id']?>,'Paid',true)">Paid</a></li> <!-- Set when paid -->
	            		 </ul> 
	            	</div>
				</div>
				<div id="viewBillCol" class="col-xs-2">
					<?php if($row['Status'] != 'Paid' && $row['Status'] != 'Ready') : ?>
						<p id="viewBillLink" class="vertical-center middle-align"><a href="payBillPage.php?waiterEdit&tableId=<?php echo $row['id']; ?>">View Bill ></a></p>
					<?php endif; ?>
				</div>
			</div>
        </div>

<?php endwhile; ?>
</div>