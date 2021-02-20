<?php 
include('connect.php');
$loc = $_POST['loc'];
$sql = "select * from tb_location where name = '$loc'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
echo $row['id'];
?>