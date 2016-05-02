<?php
	include_once 'header.php';
	require_once 'managerDatabaseInteractions.php';
	$result = getAssignedTables();
	echo "<h1 class='page-title'>Assign Tables</h1>";
	while($row = $result->fetch_assoc()):?>
	<div class="row">
		<div class="col-xs-6">
			<strong class="vertical-center" style="float:left;"><?php echo $row['username'];?>&nbsp;</strong>
		</div>
		<div class="col-xs-4">
			<div class="dropdown status clearfix" style="float:right;">
				<button class="btn btn-primary dropdown-toggle" type="button" id="assignedTo<?php echo $row['id'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				
				<?php echo $row['userID']; ?>
				<span class="caret"></span>
				</button>
				<ul id="dropDownMenu<?php echo $row['id']; ?>" class="dropdown-menu status-dropdown-menu" aria-labelledby="assignedTo<?php echo$row['id'];?>">
				<?php
					require_once 'managerDatabaseInteractions.php';
					$waitresult = getWaitStaff();
					while($wrow = $waitresult->fetch_assoc()):?>
					<li><a onclick="assignTable(<?php echo $row['id']?>,<?php echo $wrow['id']?>, true)"><?php echo $wrow['username']?></a></li>
					<?php endwhile; ?>
				</ul>
			
			</div>
		</div>
	</div>
<?php endwhile ?>
