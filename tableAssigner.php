<?php
	include_once 'header.php';
	require_once 'managerDatabaseInteractions.php';
	$result = getAssignedTables();
	$waitresult = getWaitStaff();
	echo "<h1 class='page-title'>Assign Tables</h1>"; ?>
	<?php while($row = $result->fetch_assoc()):?>
		<div class="alert alert-info table-info" role="alert">
			<div class="row">
				<div class="col-xs-6">
					<strong class="vertical-center" style="float:left;"><?php echo $row['username'];?>&nbsp;</strong>
				</div>
				<div class="col-xs-4">
					<div class="dropdown status clearfix" style="float:right;">
						<button class="btn btn-primary dropdown-toggle" type="button" id="assignedTo<?php echo $row['id'];?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						
						<?php echo getWaiterName($row['userID'])['username']; ?>
						<span class="caret"></span>
						</button>
						<ul id="dropDownMenu<?php echo $row['id']; ?>" class="dropdown-menu status-dropdown-menu" aria-labelledby="assignedTo<?php echo$row['id'];?>">
							<?php foreach ($waitresult as $wrow) :?>
							<li><a onclick="assignTable(<?php echo $row['id']?>,<?php echo $wrow['id']?>, true)"><?php echo $wrow['username']?></a></li>
							<?php endforeach; ?>
						</ul>
					
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
<?php include_once 'footer.php'; ?>
