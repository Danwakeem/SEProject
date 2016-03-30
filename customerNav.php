    <div class="blog-masthead">
        <div class="container">
            <nav class="blog-nav">
                <a class="blog-nav-item active" href="#">Home</a> 
                <a class="blog-nav-item" href="#">About</a> 
                <a class="blog-nav-item"href="#">Login</a> 
                <a class="blog-nav-item" onclick="pubnubAlert(<?php echo $_SESSION['userId']; ?>,'<?php echo $_SESSION['username']; ?>')" style="cursor: pointer;">
                    <i class="fa fa-user-plus fa-lg"></i> Call Waiter
                </a> 
                <a class="blog-nav-item" href="#" style="float: right;margin-right: 15px;">Order</a>
            </nav>
        </div>
    </div>