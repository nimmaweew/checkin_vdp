<?php 
include('connect.php');
$id = $_POST['id'];
$type = $_POST['type'];
$name = $_POST['name'];
$lname = $_POST['lname'];
$tel = $_POST['tel'];
$loc = $_POST['loc'];
$com = $_POST['com'];
$site = $_POST['site'];
$dept = $_POST['dept'];
$grop = $_POST['grop'];
$status_tel = $_POST['status_tel'];
$sql = "update tb_user set type = '$type' , name = '$name', lname='$lname', tel='$tel', loc='$loc', com='$com',site='$site',dept='$dept',grop='$grop',status_tel='$status_tel' where id='$id' ";
if(mysqli_query($conn,$sql)){
	echo json_encode(array("statusCode"=>200));
}else{
	echo json_encode(array("statusCode"=>201));
}
?>