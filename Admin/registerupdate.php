<?php 
include('connect.php');
$loc = $_POST['loc'];
$com = $_POST['com'];
$site = $_POST['site'];
$dept = $_POST['dept'];
$grop = $_POST['grop'];
$id = $_POST['id'];
$type = $_POST['type'];
$name = $_POST['name'];
$lname = $_POST['lname'];
$tel = $_POST['tel'];
$sql = "update tb_user set `loc`='$loc',`com` = '$com' ,`site` = '$site' ,`dept` = '$dept' ,`grop` = '$grop' ,`type` = '$type' ,`name` = '$name' ,`lname` = '$lname' ,`tel` = '$tel' where `id` = '$id'";
if(mysqli_query($conn,$sql)){
	echo json_encode(array("statusCode"=>200));
}else{
	echo json_encode(array("statusCode"=>201));
}
?>