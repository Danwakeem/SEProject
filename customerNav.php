    <div class="blog-masthead">
        <div class="container dropdown keep-open">
            <nav class="blog-nav">
                <ul class="nav navbar-nav">
                    <li><a class="blog-nav-item active" href="#">Home</a></li> 
                    <li><a class="blog-nav-item" href="#">About</a></li>
                    <li><a class="blog-nav-item"href="#">Login</a></li>
                    <li><a class="blog-nav-item" onclick="pubnubAlert(<?php echo $_SESSION['userId']; ?>,'<?php echo $_SESSION['username']; ?>')" style="cursor: pointer;">
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
            </nav>
        </div>
    </div>