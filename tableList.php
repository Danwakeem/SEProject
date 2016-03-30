<?php while($row = $result->fetch_assoc()): ?>
	<?php 
		if($row['Status'] == "needAssistance") {
			$msg = ' This table <a class="alert-link" href="#">requires assistance</a> ';
			$class = "alert alert-danger table-info";
			$extra = true;
		} elseif($row['Status'] == "Ready") {
			$msg = " Waiting for table to order ";
			$class = "alert alert-info table-info";
			$extra = false;
		} elseif($row['Status'] == "waitingForFood") {
			$msg = " Waiting for food ";
			$class = "alert alert-success table-info";
			$extra = false;
		} elseif($row['Status'] == "paid") {
			$msg = ' Paid and <span class="alert-link">needs to be cleared.</span>';
			$class = "alert alert-warning table-info";
			$extra = false;
		}
	?>
		
		<div id="table<?php echo $row['id']; ?>" class="<?php echo $class; ?>" role="alert">
            <p>
            	<strong><?php echo $row['username']; ?></strong><?php echo $msg; ?>
            	<a href="#"class="view-bill">View bill &gt;</a>
            	<?php if($extra == true) :?>
            		<a class="clear-notification" onclick="resetTable(<?php echo $row['id']; ?>,<?php echo "'".$row['username']."'";?>)">Done</a>
            	<?php endif; ?>
            </p>
        </div>

<?php endwhile; ?>