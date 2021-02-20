<?php 
include('connect.php');
$loc  = $_POST['loc'];
$sql = "select * from tb_grop";
$query = mysqli_query($conn,$sql);

$json = array();
while($result = mysqli_fetch_assoc($query)){
	array_push($json, $result);
}
echo json_encode($json);
?>