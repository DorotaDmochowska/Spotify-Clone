<?php  
	ob_start();

	session_start();

	$timezone = date_default_timezone_set("Europe/Warsaw"); 

	$conn = mysqli_connect("localhost", "root", "", "slotify");

	if(mysqli_connect_errno()) {
		echo "Fail to connect: " . mysqli_connect_errno();
	}

?>