<?php 
include('connect.php');
if(isset($_POST['id'])){
	$id = $_POST['id'];
	$line = $_POST['line'];
	$sql = "select * from tb_user where id='$id'and line<>''";
	$result = mysqli_query($conn,$sql);
	$rowcount=mysqli_num_rows($result);
	if($rowcount > 0){
		echo json_encode(array("statusCode"=>201));
	}
	else{
		$sql = "select * from tb_user where id = '$id'";
		$result = mysqli_query($conn,$sql);
		$rowcount = mysqli_num_rows($result);
		if($rowcount > 0){
			echo json_encode(array("statusCode"=>200));
		}
		else{
			echo json_encode(array("statusCode"=>199));
		}
		
	}
}
?>