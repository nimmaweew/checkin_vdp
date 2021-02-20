<?php
include 'connect.php';
$com = $_GET['comid'];
$sqlcom = "select * from tb_site where com_id = '$com'";
$query = mysqli_query($conn,$sqlcom);

$json = array();
while($result = mysqli_fetch_assoc($query)){
	array_push($json, $result);
}
echo json_encode($json);
?>
