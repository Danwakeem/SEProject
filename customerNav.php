    <div id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container dropdown keep-open">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse navbar-menubuilder">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="/">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a onclick="pubnubAlert(<?php echo $_SESSION['userId']; ?>,'<?php echo $_SESSION['username']; ?>')" style="cursor: pointer;">
                        <i class="fa fa-user-plus fa-lg"></i> Call Waiter
                    </a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a id="dropdownTitle" href="#" class="dropdown-toggle blog-nav-item" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">0 Order <span class="caret"></span></a>
                        <ul id="orderDropDown" class="dropdown-menu">
                            <li id="emptyOrder"><a href="#">Nothing added</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

 