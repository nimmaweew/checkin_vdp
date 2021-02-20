<?php 
include('connect.php');

if(isset($_POST['type'])){
	$type = $_POST['type'];
	
	if($type == 'login'){
		$id = $_POST['id'];
		$pass = $_POST['pass'];
		$sql = "select * from tb_login where user = '$id' and pass = '$pass'";
		$result = mysqli_query($conn,$sql);
		$numrow = mysqli_num_rows($result);
		if($numrow > 0){
			$row =  mysqli_fetch_assoc($result);
			$level = $row['level'];
			$grop = $row['grop_id'];
			echo json_encode(array("statusCode"=>200,"level"=>$level,"grop"=>$grop));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
}
?>