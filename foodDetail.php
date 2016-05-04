<?php 
	include_once 'generalDatabaseInteractions.php';
	$itemInfo = getMenuItem($itemId);
	$menuItem = $itemInfo['menuItem'];
	$ingredients = $itemInfo['ingredients'];
	$pic = $itemInfo['pic'];
?>

	<button class="btn btn-default" style="width:100%;margin-top:40px;margin-bottom:30px;" type="button" onclick="returnToMenu()">< Back</button>
	<div class="row">
    	<div class="col-xs-4">
			<img data-holder-rendered="true" src="<?php echo $pic['path']; ?>" style="width: 100%;"> 
			<button class="btn btn-primary" style="margin-top: 20px; margin-bottom: 1px; width: 100%;" type="button" onclick="addItemToOrder(<?php echo $menuItem['id'] . ",'" . $menuItem['title'] . "'," . $menuItem['price'] . ",'" . $pic['path'] . "'"; ?>)">Add to order</button>
            <hr>
            <h4 style="margin-top: 20px;">Nutrition</h4>
            <table class="table table-striped" style="margin-bottom: 70px;">
                <thead>
                    <tr>
                        <th>Per serving</th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach($ingredients as $ing) :?>
                		<tr>
                        	<td><?php echo $ing['ingredient']; ?></td>
                        	<td><?php echo $ing['amount']; ?>%</td>
                    	</tr>
                	<?php endforeach; ?>
                </tbody>
            </table>
        </div>
		<div class="col-xs-8">
			<div class="row">
				<div class="col-xs-8">
					<h1><?php echo $menuItem['title']; ?></h1>
                </div>
                <div class="col-xs-4">
					<h3 style=" margin-top: 7px; float: right;"><?php echo $menuItem['price']; ?></h3>
                </div>
            </div>
            <hr>
            	<p><?php echo $menuItem['desc']; ?></p>
            </div>
        </div><!-- /.row -->