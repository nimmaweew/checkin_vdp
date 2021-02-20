<?php 
include('connect.php');
$loc = $_POST['loc'];
$sql = "select * from tb_location where name = '$loc' ";
$row = mysqli_fetch_assoc(mysqli_query($conn,$sql));
$locid = $row['id'];
echo $locid;
?>