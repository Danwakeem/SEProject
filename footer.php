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
            function pubnubAlert(id){
                console.log(id);
                sendMessageFromTable(id);
            }
        </script>
    <?php endif; ?>
    <script>
        $(document).ready(function(){
            subscribeToTables();
        });
    </script>

    <style>
    .tb_button {padding:1px;cursor:pointer;border-right: 1px solid #8b8b8b;border-left: 1px solid #FFF;border-bottom: 1px solid #fff;}.tb_button.hover {borer:2px outset #def; background-color: #f8f8f8 !important;}.ws_toolbar {z-index:100000} .ws_toolbar .ws_tb_btn {cursor:pointer;border:1px solid #555;padding:3px}   .tb_highlight{background-color:yellow} .tb_hide {visibility:hidden} .ws_toolbar img {padding:2px;margin:0px}
    </style>
</body>
</html>