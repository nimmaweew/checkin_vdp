<?php 
include('connect.php');
$dataid = $_POST['dataid'];
$sql = "select * from tb_locat where data_id = '$dataid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$phone = $row['phone1'];
$id = $row['id'];
$sql = "update tb_user set phone = '$phone' where id = '$id'";
if(mysqli_query($conn,$sql)){
	echo 'Pass' ;
}else{
	echo 'False';
}
?>