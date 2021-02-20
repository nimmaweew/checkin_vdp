<?php 
include('connect.php');
if(isset($_POST['id'])){
	$id = $_POST['id'];
	$line = $_POST['line'];
	$sql = "update tb_user set line='$line' where id='$id'";
	if($conn->query($sql) === TRUE){
		echo json_encode(array("statusCode"=>200));
	}
	else{
		echo json_encode(array("statusCode"=>201));

	}
}

?>