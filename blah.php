<?php 
	session_start();
	
	if(isset($_SESSION['sessionOrder'])){
		unset($_SESSION['sessionOrder']);
		echo 'unset';
	} else {
		echo 'nothing';
	}

?>