<?php 
	$items;
	if(isset($results['all'])){
		$items = $results['all'];
	}
?>
<?php foreach($results['all'] as $item): ?>
	<div class="row">
		<div class="alert alert-info table-info" role="alert">
			<div class="row">
				<div class="col-xs-2">
					<div class="checkbox">
					  <label>
					    <input onchange="checkBoxChange(this)" type="checkbox" data="<?php echo $item['id']; ?>" <?php if($item['active']===1) echo 'checked'; ?>>
					    Active
					  </label>
					</div>
				</div>
				<div class="col-xs-8">
					<p style="margin-top:10px;"><?php echo $item['title']; ?></p>
				</div>
				<div id="viewBillCol" class="col-xs-2" style="margin-top:10px;"><a href="staffMenuItemMaker.php?menuItemId=<?php echo $item['id']; ?>"> Edit Item ></a></div>
			</div>
        </div>
	</div>	
<?php endforeach; ?>