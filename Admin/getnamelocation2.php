<?php 
include('connect.php');
$id = $_POST['id'];
$sql = "select * from tb_user where id = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
echo $row['namegps2'];
?>