	<div id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container dropdown keep-open">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder" style="background-color:rgba(235, 235, 235, 1);">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $_SESSION['username']; ?></a>
            </div>
            <div class="collapse navbar-collapse navbar-menubuilder">
                <ul class="nav navbar-nav navbar-left">
                    <a class="blog-nav-item active" href="index.php">Table list</a>
                	<a class="blog-nav-item" href="#">Menu</a> 
                	<a class="blog-nav-item" href="#">Hello <?php echo $_SESSION['username']; ?></a>
                </ul>
            </div>
        </div>
    </div>
    <div id="userId" data="<?php echo $_SESSION['userId']; ?>" style="display: none;"></div>