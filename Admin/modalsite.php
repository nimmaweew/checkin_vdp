<?php 
include('connect.php');
if(isset($_POST['com'])){
	$com = $_POST['com'];
	$site = $_POST['site'];
	$sql = "select * from tb_site where name = '$site' and com_id = '$com'";
	$result = mysqli_query($conn,$sql);
	$rowsite = mysqli_fetch_assoc($result);
	$numrow = mysqli_num_rows($result);
	echo $rowsite['id'];
	
}else{
	$site = $_POST['site'];
	$sql = "select * from tb_site where name = '$site'";
	$rowsite = mysqli_fetch_assoc(mysqli_query($conn,"select * from tb_site where name = '$site'"));
	echo $rowsite['id'];
}

?>