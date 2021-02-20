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
$status_tel = $_POST['status_tel'];
$sql = "INSERT INTO `tb_user`(`tel`, `id`, `type`, `name`, `lname`, `grop`, `loc`, `com`, `site`, `dept`, `lati1`, `lon1`, `lati2`, `lon2`, `lati3`, `lon3`, `namegps1`, `namegps2`, `namegps3`, `phone`, `line`,`chk`,`status_tel`,admin,comment,distance,lati,lon,dis_com) VALUES ('$tel','$id','$type','$name','$lname','$grop','$loc','$com','$site','$dept','','','','','','','','','','','','1','$status_tel','','','','','','')";
if(mysqli_query($conn,$sql)){
	echo json_encode(array("statusCode"=>200));
}else{
	echo json_encode(array("statusCode"=>201));
}
?>