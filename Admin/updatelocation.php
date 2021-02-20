<?php
include('connect.php');
$dataid= $_POST['dataid'];
$round = $_POST['round'];
if($round == '1'){
	$sql = "select * from tb_rep_mon where tb_id = '$dataid'";
}else if($round == '2'){
	$sql = "select * from tb_rep_after where tb_id = '$dataid'";
}else if($round == '3'){
	$sql = "select * from tb_rep_eve where tb_id = '$dataid'";
}
$resultlocat = mysqli_query($conn,$sql);
$rowlocat = mysqli_fetch_assoc($resultlocat);
$id = $rowlocat['id'];
$lati = $rowlocat['lati'];
$lon = $rowlocat['lon'];
$detail = $rowlocat['detail'];
$subdis = $rowlocat['subdistrict'];
$district = $rowlocat['district'];
$province = $rowlocat['province'];
$nameloc = $detail.' '.$subdis.' '.$district.' '.$province;
$sqlupdate = "update tb_user set lati1 = '$lati' , lon1 = '$lon' , namegps1 = '$nameloc' where id = '$id'";
if(mysqli_query($conn,$sqlupdate)){
	echo json_encode(array("statusCode"=>200));
}else{
	echo json_encode(array("statusCode"=>201));
}
?>

