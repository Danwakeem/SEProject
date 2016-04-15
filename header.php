<?php session_start(); ?>
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
                require 'customerNav.php';
                break;
            case 'waiter':
                //Load the waiterNav
                require 'waiterNav.php';
                break;
            case 'manager':
                //Load the managerNav
                break;
            case 'cook':
                //Load the cookNav
                break;
            default:
                require 'customerNav.php';
                break;
        }
    ?>
    <div class="container" style="margin-bottom: 40px;min-height: 700px; margin-top: 30px;">