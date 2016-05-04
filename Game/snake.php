<!DOCTYPE HTML>
<html>
  <head>
    <link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"rel="stylesheet">
    <style>
      body {
        margin: 0px;
        padding: 0px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div id="custom-bootstrap-menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container dropdown keep-open">
          <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder" style="background-color:rgba(235, 235, 235, 1);"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Return to menu</a>
            </div>
        </div>
      </div>
      <canvas style="margin-top:60px;border:1px solid;" id="myCanvas" width="640" height="640" style="border:1px solid #000000;"></canvas>
    </div>
    <?php if(isset($_GET['customerId'])) :?>
      <script> 
        var loggedIn = true; 
        var customerId = <?php echo $_GET['customerId']; ?>
      </script>
    <?php else : ?>
      <script> 
        var loggedIn = false; 
      </script>
    <?php endif; ?>
    <script>
      var canvas = document.getElementById('myCanvas');
      var context = canvas.getContext('2d');
    </script>
    <script src="snake_core.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="http://cdn.pubnub.com/pubnub-3.14.4.min.js"></script>
  </body>
</html>