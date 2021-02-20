<?php
include('connect.php');
if(isset($_POST['type'])){
	$type = $_POST['type'];
	if($type == 'login'){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$sql = "select * from tb_admin where user = '$user' and pass = '$pass'";
		$result = mysqli_query($conn,$sql);
		$numrow = mysqli_num_rows($result);
		if($numrow > 0){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'changpass'){
		$pass = $_POST['pass'];
		$sql = "update tb_admin set pass = '$pass' where id = '1'";
		if($result = mysqli_query($conn,$sql)){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'insert_location'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$sql = "INSERT INTO `tb_location`(`id`, `name`) VALUES ('$id','$name')";
		if($result = mysqli_query($conn,$sql)){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'delete_location'){
		$id = $_POST['id'];
		$sql = "DELETE FROM `tb_location` WHERE id = '$id'";
		if($result = mysqli_query($conn,$sql)){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'save_company'){
		$id = $_POST['com_id'];
		$name = $_POST['com_name'];
		$sql = "insert into tb_com (id,name) values ('$id','$name')";
		if($result = mysqli_query($conn,$sql)){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'delete_compamy'){
		$id = $_POST['id'];
		$sql = "delete from tb_com where id = '$id'";
		if($result = mysqli_query($conn,$sql)){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'insert_site'){
		$site_id = $_POST['siteid'];
		$site_name = $_POST['sitename'];
		$com_id = $_POST['comid'];
		if($row = mysqli_num_rows(mysqli_query($conn,"select * from tb_site where id = '$site_id'")) > 0){
			echo json_encode(array("statusCode"=>201));
		}
		else{
			if(mysqli_query($conn,"insert into tb_site (id,name,com_id) values ('$site_id','$site_name','$com_id')")){
				echo json_encode(array("statusCode"=>200));
			}else{
				echo json_encode(array("statusCode"=>202));
			}
		}
		
	}
	
	if($type == 'site_delete'){
		$com_id = $_POST['com_id'];
		$site_id = $_POST['site_id'];
		if(mysqli_query($conn,"delete from tb_site where id = '$site_id' and com_id = '$com_id'")){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'insert_dept'){
		$dept_id = $_POST['deptid'];
		$dept_name = $_POST['deptname'];
		$site_id = $_POST['siteid'];
		if($row = mysqli_num_rows(mysqli_query($conn,"select * from tb_dept where id = '$dept_id' and site_id = '$site_id'")) > 0){
			echo json_encode(array("statusCode"=>201));
		}
		else{
			if(mysqli_query($conn,"insert into tb_dept (id,name,site_id) values ('$dept_id','$dept_name','$site_id')")){
				echo json_encode(array("statusCode"=>200));
			}else{
				echo json_encode(array("statusCode"=>202));
			}
		}
		
	}
	
	if($type == 'dept_delete'){
		$dept_id = $_POST['dept_id'];
		$site_id = $_POST['site_id'];
		if(mysqli_query($conn,"delete from tb_dept where id = '$dept_id' and site_id = '$site_id'")){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'insert_grop'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$sql = "select * from tb_grop where id = '$id'";
		if($row = mysqli_num_rows(mysqli_query($conn,$sql)) > 0){
			echo json_encode(array("statusCode"=>201));
		}
		else{
			if(mysqli_query($conn,"insert into tb_grop (id,name) values ('$id','$name')")){
				echo json_encode(array("statusCode"=>200));
			}else{
				echo json_encode(array("statusCode"=>202));
			}
		}
		
	}
	
	if($type == 'delete_grop'){
		$id = $_POST['id'];
		$sql = "delete from tb_grop where id = '$id'";
		if(mysqli_query($conn,$sql)){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
		
	}
	
	if($type == 'login_save'){
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$level = $_POST['level'];
		$grop = $_POST['grop'];
		$sql = "select * from tb_login where user = '$user'";
		$result = mysqli_query($conn,$sql);
		$numrow = mysqli_fetch_assoc($result);
		if($numrow > 0){
			echo json_encode(array("statusCode"=>202));
		}else{
			$sql = "insert into tb_login (user,pass,level,grop_id) values ('$user','$pass','$level','$grop')";
		if($result = mysqli_query($conn,$sql)){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
		}
		
	}
	
	if($type == 'delete_login'){
		$id = $_POST['id'];
		$sql = "delete from tb_login where id = '$id'";
		if($result = mysqli_query($conn,$sql)){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'get_label'){
		$id = $_POST['id'];
		$sql = "select * from tb_label where id = '$id'";
		$result = mysqli_query($conn,$sql);
		$numrow = mysqli_num_rows($result);
		if($numrow > 0){
			$row = mysqli_fetch_assoc($result);
			$text = $row['text'];
			$name = $row['name'];
			echo json_encode(array("statusCode"=>200,"text"=>$text,"name"=>$name));
		}
		else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'label_save'){
		$id = $_POST['id'];
		$text = $_POST['text'];
		$sql = "update tb_label set text = '$text' where id = '$id'";
		if($result = mysqli_query($conn,$sql)){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
	
	if($type == 'update_tb_time'){
		$id = $_POST['id'];
		$st_time = $_POST['st_time'];
		$en_time = $_POST['en_time'];
		if($result = mysqli_query($conn,"update tb_time set st_time = '$st_time' , en_time = '$en_time' where id = '$id'")){
			echo json_encode(array("statusCode"=>200));
		}else{
			echo json_encode(array("statusCode"=>201));
		}
	}
}
?>