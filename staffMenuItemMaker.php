<?php 
	require_once 'header.php'; 

  $results = false;
  if(isset($_GET['menuItemId'])){
    require_once 'generalDatabaseInteractions.php';
    $results = getMenuItem($_GET['menuItemId']);
  }

  echo '<h1 class="page-title">Menu Item maker</h1>';
	if(isset($_SESSION['userType'])) {
		if($_SESSION['userType'] != 'manager') {
			exit(header('Location: /SEProject/index.php'));
		}
	} else {
		exit(header('Location: /SEProject/index.php'));
	}

  function findCategory($id,$res) {
    $cats = $res['categories'];
    foreach($cats as $cat){
      if($cat['categoryId'] == $id){
        return true;
      }
    }
    return false;
  }
?>
<form action="<?php if($results!=false){echo 'updateMenuItem.php?';}else{echo 'uploadMenuItem.php'; } ?>" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-xs-6">
      <div class="form-group">
        <label for="title">Name of item</label>
        <input id="title" type="text" name="title" class="form-control"
        <?php if($results != false) echo 'value="' . $results['menuItem']['title'] . '"'; ?>
         placeholder="name">
      </div>
    </div>
    <div class="col-xs-6">
      <div class="form-group">
        <label for="price">Price</label>
        <input id="price" type="number" name="price" class="form-control" 
        <?php if($results != false) echo 'value="' . $results['menuItem']['price'] . '"'; ?>
        placeholder="10.50" step="0.01">
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="description">Description of item</label>
    <textarea type="description" name="description" rows="3" class="form-control" id="description" placeholder="Short description of the item"><?php if($results != false) echo $results['menuItem']['desc']; ?></textarea>
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Select a category</label>
    <select multiple class="form-control" name="category[]">
      <option value="1" <?php if(findCategory(1,$results)) { echo 'selected'; } ?>>Appetizer</option>
      <option value="5" <?php if(findCategory(5,$results)) { echo 'selected'; } ?>>Lunch</option>
      <option value="2" <?php if(findCategory(2,$results)) { echo 'selected'; } ?>>Entree</option>
      <option value="4" <?php if(findCategory(4,$results)) { echo 'selected'; } ?>>Desert</option>
      <option value="3" <?php if(findCategory(3,$results)) { echo 'selected'; } ?>>Drink</option>
    </select>
  </div>

  <div class="form-group">
    <label for="ingred">Ingredients</label>
    <label for="ingred">separated by a , with a title and an amount (Example: Cheese:10,Pepper:10)</label>
    <input id="ingred" type="text" name="ingred" class="form-control" id="exampleInputEmail1" placeholder="beef, cheese ..." value="<?php if($results != false) {foreach ($results['ingredients'] as $key => $value) {if($key == count($results['ingredients'])+1){echo $value['ingredient'] . ':' . $value['amount'];} else {echo $value['ingredient'] . ':' . $value['amount'] . ',';}}} ?>"
    >
  </div>

  <div class="form-group">
    <label for="exampleInputFile">Image of menu Item</label>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <?php if($results != false) : ?>
      <p class="help-block">Current Photo is : <?php echo $results['pic']['path']; ?></p>
    <?php else : ?>
      <p class="help-block">Pick something that makes it look snazy.</p>
    <?php endif; ?>
  </div>
  <?php if($results != false) : ?>
    <button type="submit" class="btn btn-default">Update Item</button>
  <?php else : ?>
    <button type="submit" class="btn btn-default">Submit Item</button>
  <?php endif; ?>
</form>

<?php require_once 'footer.php'; ?>
