<?php
	require_once 'header.php';
	require_once 'customerDatabaseInteractions.php';
	$userId = false;
	if(isset($_GET['tableId'])){
		$userId = $_GET['tableId'];
	}

	echo $userId;
	$payInfo = getOrderItems($userId);
	$results = $payInfo['orderItems'];
	$singleResult = get_object_vars($payInfo['orderItems']->fetch_object());
	$sum = get_object_vars($payInfo['sum']->fetch_object());

?>
<h1 style=" margin-top: 50px; margin-bottom: 50px;">Final Bill Summary</h1>

<table class="table table-striped" style=" margin-top: 30px; border-bottom: 1px solid gray;">
	<thead>
		<tr>
			<th>#</th>
			<th>Dish</th>
			<th>Modifications</th>
			<th>Price</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($results as $item) : ?>
			<tr id="<?php echo $item['id']; ?>">
				<th scope="row"><?php echo $item['quantity']; ?></th>
				<td><?php echo $item['title']; ?></td>
				<td><?php echo $item['notes']; ?></td>
				<td>$<?php echo $item['price']; ?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>


<div class="row" style=" margin-bottom: 30px;">
            <div class="col-xs-8">
                <p><strong><i>sub-total</i></strong></p>
            </div>
            <div class="col-xs-4">
                <p style="text-align: center;margin-left: 30px;"><?php echo $sum['sum']; ?></p>
            </div>
        </div>
        <hr>
        <div class="row" style=" margin-top: 40px; margin-bottom: 40px;">
            <div class="col-xs-6">
                <h3 style=" margin-bottom: 35px;">Billing info</h3>
                <input class="form-control" id="exampleInputEmail1" placeholder="First Name" style="margin: 20px 0px 10px 0px;" type="email"> 
                <input class="form-control" id="exampleInputEmail1" placeholder="Last Name" style="margin: 20px 0px 10px 0px;" type="email"> 
                <input class="form-control" id="exampleInputEmail1" placeholder="Email" style=" margin: 20px 0px 10px 0px;" type="email"> 
                <input class="form-control" id="exampleInputEmail1" placeholder="Address" style=" margin: 20px 0px 10px 0px;" type="email">
            </div>
            <div class="col-xs-6">
                <h3 style=" margin-bottom: 35px;">Card information</h3>
                <input class="form-control" id="exampleInputEmail1" placeholder="Name on Card" style="margin: 20px 0px 10px 0px;" type="text"> 
                <input class="form-control" id="exampleInputEmail1" placeholder="Card Number" style=" margin: 20px 0px 10px 0px;" type="number">
                <input class="form-control" id="exampleInputEmail1" placeholder="CVC" style=" margin: 20px 0px 10px 0px;" type="number">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-6">
                <h3 style="margin-bottom: 35px;margin-left: 13px;">Tip</h3>
                <div class="radio">
                    <label><input checked id="optionsRadios1" name=
                    "optionsRadios" type="radio" value="option1"> 15%</label>
                </div>
                <div class="radio">
                    <label><input id="optionsRadios2" name="optionsRadios"
                    type="radio" value="option2"> 20%</label>
                </div>
                <div class="radio">
                    <label><input disabled id="optionsRadios3" name=
                    "optionsRadios" type="radio" value="option3"> 25%</label>
                </div>
            </div>
            <div class="col-xs-6">
                <h4 style="margin-bottom: 35px;margin-left: 13px;">
                Other</h4><label class="sr-only" for=
                "exampleInputAmount">Amount (in dollars)</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        $
                    </div><input class="form-control" id="exampleInputAmount" placeholder="Amount" type="text">
                    <div class="input-group-addon">
                        .00
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row" style=" /* margin-bottom: 30px; */">
            <div class="col-xs-8">
                <p><strong><i>total</i></strong></p>
            </div>
            <div class="col-xs-4">
                <p style="text-align: center;margin-left: 30px;"><?php echo $sum['sum']; ?></p>
            </div>
        </div>
        <hr>
        <button class="btn btn-success" style=" width: 100%;" type="button" onclick="payBill(<?php echo $singleResult['id']; ?>)">Pay Bill</button>

<?php include 'footer.php'; ?>