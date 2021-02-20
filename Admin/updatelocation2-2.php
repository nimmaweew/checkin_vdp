<?php 
include('connect.php');
$dataid = $_POST['dataid'];
$sql = "select * from tb_locat where data_id = '$dataid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$lati = $row['lati2'];
$lon = $row['lon2'];
$name = $row['nameloc2'];
$sql2 = "update tb_user set lati2 = '$lati' , lon2 = '$lon' , namegps2 = '$name' where id = '$id'";
if(mysqli_query($conn,$sql2)){
	echo('true');
}
else{
	echo('false');
}
?>