    <div id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container dropdown keep-open">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse navbar-menubuilder">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="/">Incoming Meals</a></li>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Hello <?php echo $_SESSION['username']; ?></a></li>
                </ul>
            </div>
        </div>
    </div>