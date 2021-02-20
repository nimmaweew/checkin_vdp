<?php 
include('connect.php');
$dept = $_POST['dept'];
$site = $_POST['siteid'];
$row = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_dept where name = '$dept' and site_id = '$site'"));
echo $row['id']
?>