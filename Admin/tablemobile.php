<?php 
include('connect.php');
$id = $_POST['id'];
$sql  = "select * from tb_user where id = '$id'";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
$row = mysqli_fetch_assoc(mysqli_query($conn,$sql));
echo $row['phone'];

?>