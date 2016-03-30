<?php
   /**
    * This is where we can put all of the functions to retrieve things from
    * the database for the waiter
    */
    ob_start();
	require 'db-connect.php';

	function updateStatus($message){
		$con = dbConnect();
		$id = $_SESSION['userId'];
		//needAssistance
	}
?>