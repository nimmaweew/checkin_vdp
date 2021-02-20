<?php 
include('connect.php');
if(isset($_POST['id'])){
	$id = $_POST['id'];
	$sql = "select * from tb_user where id = '$id'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	$status_tel = $row['status_tel'];
	echo $status_tel;
}
?>