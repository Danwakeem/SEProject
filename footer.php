    </div> <!-- ./container -->

    <div id="warning" class="alert alert-warning messages" role="alert" style="display:none;"> 
        <strong id="bold">Hold on!</strong> We are sending your order to the kitchen. 
    </div>
    <div id="success" class="alert alert-success messages" role="alert" style="display:none;"> 
        <strong id="bold">Woopie!</strong> Your order was recieved by the kitchen.
    </div>
    <div id="danger" class="alert alert-danger messages" role="alert" style="display:none;"> 
        <strong id="bold">Oh NOOOO!</strong> Your order was lost in the eather. Try Again please.
    </div>

    <footer class="blog-footer">
        <p>Super cafe menu brought to you by the super group.</p>
        <p><a href="#">Back to top</a></p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://cdn.pubnub.com/pubnub-3.14.4.min.js"></script>
    <script src="js/common.js"></script>

    <?php if($userType == 'table') : ?>
        <script>
            var userType = 'table';
            var tableId = <?php echo $_SESSION['userId']; ?>;
            var tableName = "<?php echo $_SESSION['username']; ?>";
            subscribeToWaiterUpdates();
            subscribeToMenuUpdates();
        </script>
    <?php endif; ?>
    <?php if($userType == 'waiter') : ?>
        <script>
            var userType = 'waiter';
            $(document).ready(function(){
                subscribeToOrderUpdates();
                subscribeToTableUpdates();
            });
        </script>
    <?php endif; ?>
    <?php if($userType == 'manager') : ?>
        <script>
        var userType = 'manager';
        $(document).ready(function(){
            subscribeToTableUpdates();
        });
        </script>
    <?php endif; ?>
    <?php if($userType ==  'chef') :?>
        <script>
            var userType = 'chef';
            $(document).ready(function(){
               subscribeToTableUpdates(); 
            });
        </script>
    <?php endif; ?>

    <?php if(isset($_SESSION['sessionOrder'])) : ?>
        <script>
            var orderItems = <?php echo json_encode($orderItems); ?>;
            var orderTotal = <?php echo $total; ?>;
            var itemCount = <?php echo $numberOfItems; ?>;
        </script>
    <?php else : ?>
        <script>
            var orderItems = [];
            var orderTotal = 0;
            var itemCount = 0;
        </script>
    <?php endif; ?>
    <style>
    .tb_button {padding:1px;cursor:pointer;border-right: 1px solid #8b8b8b;border-left: 1px solid #FFF;border-bottom: 1px solid #fff;}.tb_button.hover {borer:2px outset #def; background-color: #f8f8f8 !important;}.ws_toolbar {z-index:100000} .ws_toolbar .ws_tb_btn {cursor:pointer;border:1px solid #555;padding:3px}   .tb_highlight{background-color:yellow} .tb_hide {visibility:hidden} .ws_toolbar img {padding:2px;margin:0px}
    </style>
</body>
</html>