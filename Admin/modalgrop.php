<?php 
include('connect.php');
$grop = $_POST['grop'];
$row = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_grop where name = '$grop'"));
echo $row['id'];
?>