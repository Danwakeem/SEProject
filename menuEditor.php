<?php 
	include_once 'header.php'; 
	require_once 'generalDatabaseInteractions.php';
	$results = getMenuItems(false);
	echo '<h1 class="page-title">Menu items</h1>';
?>
	<div id="success-menu-edit" class="alert alert-success messages" role="alert" style="display:none;"> 
        <strong id="bold">Alright Alright.</strong> Your changes were saved
    </div>
    <div id="danger-menu-edit" class="alert alert-danger messages" role="alert" style="display:none;"> 
        <strong id="bold">Oh NOOOO!</strong> Your changes were not saved!
    </div>

	<div class="row">
		<div class="col-md-6">
			<a href="staffMenuItemMaker.php" type="button" class="btn btn-default" style="width:100%;margin-top:10px;margin-bottom:10px;">Add Menu Item</a>
		</div>
		<div class="col-md-6">
			<button type="button" onclick="saveMenuItemChanges()" class="btn btn-primary" style="width:100%;margin-top:10px;margin-bottom:10px;">Save Changes</button>
		</div>
	</div>
	<script>
		var menuEditorItems = {};
	</script>
<?php 
	require_once 'menuItemsEditor.php';
	include_once 'footer.php';
?>