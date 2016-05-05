    <?php 
        if(isset($_SESSION['sessionOrder'])){
            var_dump($_SESSION['sessionOrder']);
            $orderItems = $_SESSION['sessionOrder'];
            $numberOfItems = 0;
            $total = 0;
            foreach ($orderItems as $item) {
                $numberOfItems += $item['quantity'];
                $total += $item['price'] * $item['quantity'];
            }
        }
    ?>
    <div id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container dropdown keep-open">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder" style="background-color:rgba(235, 235, 235, 1);"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $_SESSION['username']; ?></a>
            </div>
            <div class="collapse navbar-collapse navbar-menubuilder">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="Game/snake.php<?php if(isset($_SESSION['customerId'])) echo '?customerId=' . $_SESSION['customerId']; ?>">Play Game</a></li>
                    <li id="callButton"><a onclick="pubnubAlert(<?php echo $_SESSION['userId']; ?>,'<?php echo $_SESSION['username']; ?>','NeedAssistance')" style="cursor: pointer;">
                        <i class="fa fa-user-plus fa-lg"></i> Call Waiter
                    </a></li>
                    <?php if(isset($_SESSION['customerId'])) : ?>
                        <li><a href="#">Hello <?php echo $_SESSION['customerName']; ?></a></li>
                        <li><a href="#" onclick="logoutCustomer()">Logout</a></li>
                    <?php else : ?>
                        <li><a href="login.php?customer">Login</a></li>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a id="dropdownTitle" href="#" class="dropdown-toggle blog-nav-item" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo isset($_SESSION['sessionOrder']) ? $numberOfItems . ' Order ' : '0 Order ' ?><span class="caret"></span></a>
                        <ul id="orderDropDown" class="dropdown-menu">
                            <?php if(isset($_SESSION['sessionOrder'])) :?>
                                <li id="dishHeader">
                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-xs-5">
                                            <a class="dropdown-col-lt">Title</a>
                                        </div>
                                        <div class="col-xs-2">
                                            <a id="quantity" class="dropdown-col-rt edit">Qty</a>
                                        </div>
                                        <div class="col-xs-2 dropdown-col-rt">
                                            <a id="price" class="dropdown-col-rt">Price</a>
                                        </div>
                                        <div class="col-xs-1">
                                            
                                        </div>
                                    </div>
                                </li>
                                <?php foreach ($orderItems as $item) : ?>

                                    <li id="dish<?php echo $item['id']; ?>">
                                        <div class="row" style="margin-top:10px;">
                                            <div class="col-xs-5"><a class="dropdown-col-lt"><?php echo $item['title'];?></a></div>
                                            <div class="col-xs-2"><input type="text" data="quantity" class="form-control qty-input" maxlength="2" value="<?php echo $item['quantity']; ?>" onchange="updateQuantity(this)"></div>
                                            <div class="col-xs-2 dropdown-col-rt"><a id="price" class="dropdown-col-rt"><?php echo $item['price']; ?></a></div>
                                            <div class="col-xs-1 dropdown-col-rt"><a class="dropdown-col-rt" data-toggle="modal" data-target="#commentModal" onclick="commentObject(this)"><i class="fa fa-comment-o" title="Comments" rel="tooltip"></i></a></div>
                                        </div>
                                    </li>

                                <?php endforeach; ?>
                                <li id="totalDivider" role="separator" class="divider"></li>
                                <li id="dishTotal"><div class="row" style="margin-top:10px;"><div class="col-xs-5"><a class="dropdown-col-lt">Total</a></div><div class="col-xs-2"><a id="quantity" class="dropdown-col-rt edit"></a></div><div class="col-xs-2 dropdown-col-rt"><a id="price" class="dropdown-col-rt">16</a></div><div class="col-xs-1"></div></div></li>
                                <li><div style="width100%;text-align:center;margin-top:10px;"><button style="width:90%;margin:auto 0;" type="button" onclick="submitOrder()" class="btn btn-success">SubmitOrder</button></div></li>
                            <?php else : ?>
                                <li id="emptyOrder"><a href="#">Nothing added</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php if($orderExists) : ?>
                        <li id="payBillLink"><a href="payBillPage.php?tableId=<?php echo $_SESSION['userId'];?>">Pay Bill</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div id="userId" data="<?php echo $_SESSION['userId']; ?>" style="display: none;"></div>
    <div id="userType" data="<?php echo $_SESSION['userType']; ?>" style="display: none;"></div>

 