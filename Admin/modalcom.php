<?php 
include('connect.php');
$com = $_POST['com'];
$sql = "select * from tb_com where name = '$com'";
$row = mysqli_fetch_assoc(mysqli_query($conn,$sql));
$comid = $row['id'];
echo $comid;
?>