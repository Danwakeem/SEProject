<?php
	require_once 'header.php';
	require_once 'customerDatabaseInteractions.php';
	$userId = false;
	if(isset($_GET['tableId'])){
		$userId = $_GET['tableId'];
	}
	$staff = false;
	if(isset($_GET['staffEdit'])){
		$staff = true;
	}

    $discount = 0.5;
    $hasCoupon = false;
    if(isset($_SESSION['customerId'])){
        $hasCoupon = checkCouponStatus($_SESSION['customerId']);
    }
	$payInfo = getOrderItems($userId);
	$results = $payInfo['orderItems'];
	$singleResult;
	$sum = array('sum' => 0.00);
	if($payInfo['orderItems']->num_rows > 0) {
		$singleResult = get_object_vars($payInfo['orderItems']->fetch_object());
		$sum = get_object_vars($payInfo['sum']->fetch_object());
        if($sum['sum'] == NULL) {
            $sum['sum'] = 0;
        }
	}

?>

<?php if($staff) : ?>
    <script>
        var tableId = <?php echo $userId; ?>;
    </script>
	<div class="row" style=" margin-top: 50px; margin-bottom: 50px;">
		<div class="col-md-6">
			<h1>Final Bill Summary</h1>
		</div>
		<div class="col-md-3">
			<a href="staffMenu.php?tableId=<?php echo $userId; ?>"><button type="button" class="btn btn-default" style="width:100%;">Add Menu Items</button></a>
		</div>
        <?php if($_SESSION['userType'] == 'manager') : ?>
        <div class="col-md-3">
            <a href="#" onclick="saveCompItems()"><button type="button" class="btn btn-primary" style="width:100%;">Save Changes</button></a>
        </div>
        <?php endif; ?>
	</div>
<?php else : ?>
	<h1 style=" margin-top: 50px; margin-bottom: 50px;">Final Bill Summary</h1>
<?php endif; ?>

<table class="table table-striped" style=" margin-top: 30px; border-bottom: 1px solid gray;">
	<thead>
		<tr>
			<th>#</th>
			<th>Dish</th>
			<th>Modifications</th>
			<th>Price</th>
            <th>Comped</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($results as $item) : ?>
			<tr id="<?php echo $item['id']; ?>">
				<th scope="row"><?php echo $item['quantity']; ?></th>
				<td><?php echo $item['title']; ?></td>
				<td><?php echo $item['notes']; ?></td>
				<td>$<?php echo $item['price']; ?></td>
                <td>
                    <div class="checkbox <?php echo $_SESSION['userType'] == 'manager' ? '' : 'disabled'; ?>" style="margin:0;">
                        <label><input id="<?php echo $item['id']; ?>" class="compCheck" data-item="<?php $json = json_encode($item); echo htmlentities($json, ENT_QUOTES, 'UTF-8'); ?>" onclick="checkPayBillRadios(this)" type="checkbox" <?php echo $_SESSION['userType'] == 'manager' ? '' : 'disabled'; ?><?php echo $item['comped'] ? ' checked' : ''; ?>></label>
                    </div></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>

        <?php if($hasCoupon) :?>
            <div class="row">
                <div class="col-xs-8">
                    <p><strong><i>Coupon discount</i></strong></p>
                </div>    
                <div class="col-xs-4">
                    <p style="text-align: center;margin-left: 30px;">   <?php echo '-' . $sum['sum'] * $discount; ?></p>
                </div>
            </div>    
            <hr>
            <?php $sum['sum'] = $sum['sum'] - $sum['sum'] * $discount; ?>
        <?php endif; ?>
        <div class="row" style=" margin-bottom: 30px;">
            <div class="col-xs-8">
                <p><strong><i>sub-total</i></strong></p>
            </div>
            <div class="col-xs-4">
                <p id="sub-total" style="text-align: center;margin-left: 30px;"><?php echo $sum['sum']; ?></p>
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
        <div class="row">
            <div class="col-xs-8">
                <p><strong><i>total</i></strong></p>
            </div>
            <div class="col-xs-4">
                <p id="total" style="text-align: center;margin-left: 30px;"><?php echo $sum['sum']; ?></p>
            </div>
        </div>
        <hr>
        <button class="btn btn-success" style=" width: 100%;" type="button" onclick="payBill(<?php echo $singleResult['id']; ?>)">Pay Bill</button>

        <?php if($_SESSION['userType'] != 'manager') : ?>
            <script>
                var payBillUpdateSubscriber = true;
            </script>
        <?php endif; ?>

<?php include 'footer.php'; ?>