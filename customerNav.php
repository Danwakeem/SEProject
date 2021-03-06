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
                        <a id="dropdownTitle" href="#" class="dropdown-toggle blog-nav-item" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">0 Order <span class="caret"></span></a>
                        <ul id="orderDropDown" class="dropdown-menu">
                            <li id="emptyOrder"><a href="#">Nothing added</a></li>
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

 