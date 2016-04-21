<?php 

session_start(); 
require_once 'dbConnect.php';
$userType;
if(isset($_SESSION['userType'])){
    $userType = $_SESSION['userType'];
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
    <link href="css/main.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"rel="stylesheet">
</head>
<body>
    <?php 
        switch ($userType) {
            case 'table':
                //Load the customerNav
                require_once 'customerDatabaseInteractions.php';
                $orderExists = existingOrder();
                require_once 'customerNav.php';
                break;
            case 'waiter':
                //Load the waiterNav
                require_once 'waiterNav.php';
                break;
            case 'manager':
                //Load the managerNav
                break;
            case 'chef':
                //Load the cookNav
                require_once 'chefNav.php';
                break;
            default:
                require_once 'customerNav.php';
                break;
        }
    ?>
    <div class="container" style="margin-bottom: 40px;min-height: 700px; margin-top: 30px;">