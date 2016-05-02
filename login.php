<?php 
  $error = false;
  if(isset($_GET["error"])){
    $error = true;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <title>Our site</title>
    <link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"rel="stylesheet">
</head>
<body>
    <div class="container">

      <div class="container">
      <form class="form-signin" method="get" action="<?php echo isset($_GET['customer']) ? 'customerAccountLogin.php' : 'accountLogin.php'; ?>">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label class="sr-only">Email address</label>
        <input type="username" id="inputUsername" name="username" class="form-control" placeholder="username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
      </form>
      <?php if($error) : ?>
      <div class="alert alert-danger login-warning" role="alert">
        <strong>Oh brother!</strong> It looks like your login info was incorrect. Try again.
      </div>
      <?php endif; ?>
    </div> <!-- /container -->
</body>
</html>