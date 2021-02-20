<?php 
include 'connect.php';
$site = $_GET['siteid'];
$sqldept = "select * from tb_dept where site_id ='$site'";
$query = mysqli_query($conn,$sqldept);

$json = array();
while($result = mysqli_fetch_assoc($query)){
	array_push($json, $result);
}
echo json_encode($json);
?>