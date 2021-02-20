<?php 
include('connect.php');
$id = $_POST['id'];
$sql = "select * from tb_user where id = '$id'";
$result = mysqli_query($conn,$sql);
$rowcount = mysqli_num_rows($result);
if($rowcount == 0){
	echo json_encode(array("statusCode"=>200));
}else{
	echo json_encode(array("statusCode"=>201));
}
?>