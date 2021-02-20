<?php 
	$servername = "localhost";

	$username = "root" ;

	$password = "" ;

	$dbname = "vandapa1_checkin";

	$conn = new MySQLi($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	
	//check
	if($conn->connect_error)
	{
		die("เชื่อมต่อไม่สำเร็จ".$conn->connect_error);
	}
?>